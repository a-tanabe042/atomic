<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SendDetailMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;


    //DBから取る

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;

        try{
            //トランザクション開始
            DB::beginTransaction();

            //ログイン者の名前とメールアドレス取得
            $login = DB::table('t_user as tu')
                ->leftjoin('t_user_basic as tub', 'tub.user_id', '=', 'tu.user_id')
                ->where('tub.user_id', $data["login"])
                ->select('tub.last_name', 'tub.first_name', 'tu.mail_address')
                ->first();

            //ログイン情報格納
            $this->data["login"] = $login->last_name . " " . $login->first_name;

            if($this->data['login_engineer_flg'] == 0 || $this->data['login_engineer_flg'] == 1){
                //レビュー依頼：エンジニア⇒上長
                array_push($this->data['cc'], $login->mail_address);
                //対象エンジニアが更新後、自身を「レビュー待ち」状態へ
                DB::table('t_user')
                    ->where('user_id','=', $data['login'])
                    ->where('reviewee_flg', '!=', 1)
                    ->update(['reviewee_flg' => 1]);
            }else {
                /* リリース後、以下1行をコメントアウト解除 */
                //更新依頼：営業⇒エンジニア
                //array_push($this->data['cc'], 'eigyo_all@salto.link');
            }

            //編集された人の所属IDとメールアドレスの取得
            $edited = DB::table('t_user_basic as tub')
                ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'tub.user_id')
                ->leftjoin('r_user_position as rup', 'rup.user_id', '=', 'tub.user_id')
                ->leftjoin('m_belongs as mb', 'mb.belongs_id', '=', 'rub.belongs_id')
                ->leftjoin('t_user as tu', 'tu.user_id', '=', 'tub.user_id')
                ->where('tub.user_id', $data["user_id"])
                ->select('mb.belongs_id', 'mb.parent_id', "tu.engineer_flg", 'rup.position_id', 'tu.mail_address')
                ->first();

            //編集された人の情報格納
            if($this->data['login_engineer_flg'] == 2){
                if($login->mail_address != $edited->mail_address) {
                    //更新依頼：営業⇒エンジニア
                    array_push($this->data['to_mail'], $edited->mail_address);
                }
            }

            //ゲスト、既存エンジニアで送信する相手が違う
            if($this->data['guest_flg'] == 0){
                //主任を探すため、親ID に所属ID を格納
                $parent_id = $edited->belongs_id;

                //編集された人の役職者ID 格納（上の役職者を判定するため）
                $position_id = $edited->position_id;

                //編集された人の上長全てのメールアドレス取得
                while ($parent_id != 1) {
                    $superiors = DB::table('t_user as tu')
                        ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'tu.user_id')
                        ->leftjoin('r_user_position as rup', 'rup.user_id', '=', 'tu.user_id')
                        ->leftjoin('r_user_authority as rua', 'rua.user_id', '=', 'rub.user_id')
                        ->leftjoin('m_belongs as mb', 'mb.belongs_id', '=', 'rub.belongs_id')
                        ->where('rub.belongs_id', $parent_id)
                        ->select('tu.mail_address', 'tu.user_id', 'mb.parent_id', 'rup.position_id')
                        ->get();

                    //更新された人の上長がデータベースにない場合
                    if($superiors->isEmpty()){
                        break;
                    }
                        
                    //所属ID の更新（組織構成を bottom-up で参照）
                    $parent_id = $superiors[0]->parent_id;

                    //編集された人の役職ID より大きい役職ID を持つ人のメールアドレスを格納
                    foreach ($superiors as $superior) {
                        if ($position_id < $superior->position_id) {
                            if($this->data['login_engineer_flg'] == 0 || $this->data['login_engineer_flg'] == 1){
                                //レビュー依頼：エンジニア⇒上長
                                array_push($this->data['to_mail'], $superior->mail_address);
                                //対象エンジニアが更新後、上長を「レビュー未完了」状態へ
                                DB::table('t_user')
                                    ->where('user_id','=', $superior->user_id)
                                    ->where('reviewer_flg', '!=', 1)
                                    ->update(['reviewer_flg' => 1]);
                            } else {
                                //更新依頼：営業⇒対象エンジニア
                                array_push($this->data['cc'], $superior->mail_address);
                            }
                        }
                    }
                }
            }else {
                //ゲストエンジニアと同じ部署の技術役職者のメールアドレス取得
                $managers = DB::table('t_user as tu')
                    ->leftJoin("r_user_authority as rua", 'rua.user_id', '=', 'tu.user_id')
                    ->where("tu.engineer_flg", '=', $edited->engineer_flg)
                    ->where('rua.auth_name', '=', 'manager')
                    ->where('tu.del_flg', '=', 0)
                    ->select('tu.user_id', 'tu.mail_address')
                    ->get();

                foreach($managers as $manager){
                    DB::table('t_user')
                        ->where('user_id','=', $manager->user_id)
                        ->where('guest_reviewer_flg', '!=', 1)
                        ->update(['guest_reviewer_flg' => 1]);

                    array_push($this->data['to_mail'], $manager->mail_address);
                }
            }

            /* 入力期間終了後、以下1行を削除 */
            //array_push($this->data['to_mail'], 'salto-web@salto.link');

            //確認
            // array_push($this->data['to_mail'], 'riku.harako@salto.link');

            DB::commit();
        }catch(\Exception $e){
            session()->flash('flash_message', '通知が失敗しました\n' .$e->getMessage());
            DB::rollBack();
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->data['message'])
            ->from($this->data['from_mail'], $this->data['sender'])    //送信者のメアド、名前
            ->cc($this->data['cc']) //CC
            ->subject($this->data['subject'])   //件名
            ->with('data', $this->data);    //MailService で獲得した data 格納
    }
}
