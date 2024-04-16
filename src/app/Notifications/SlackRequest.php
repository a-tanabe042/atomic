<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SlackRequest extends Notification
{
    use Queueable;

    /**
     * @var string $str
     */
    private $str;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        //botの名前
        $this->name = env('SLACK_NAME');

        try{
            //トランザクション開始
            DB::beginTransaction();

            //slackメッセージ
            $this->message = "";

            //ログイン者の名前とメールアドレス取得
            $login = DB::table('t_user as tu')
                ->leftjoin('t_user_basic as tub', 'tub.user_id', '=', 'tu.user_id')
                ->where('tub.user_id', $request->login_id)
                ->select('tub.last_name', 'tub.first_name', 'tu.mail_address')
                ->first();

            // if($request->engineer_flg == 0 || $request->engineer_flg == 1){
            //     //レビュー依頼：エンジニア⇒上長
            //     // array_push($this->data['cc'], $login->mail_address);

            //     //対象エンジニアが更新後、自身を「レビュー待ち」状態へ
            //     DB::table('t_user')
            //         ->where('user_id','=', $request->login_id)
            //         ->where('reviewee_flg', '!=', 1)
            //         ->update(['reviewee_flg' => 1]);
            // }else {
            //     /* リリース後、以下1行をコメントアウト解除 */
            //     //更新依頼：営業⇒エンジニア
            //     //array_push($this->data['cc'], 'eigyo_all@salto.link');
            // }

            //編集された人の所属IDとメールアドレスの取得
            $edited = DB::table('t_user_basic as tub')
                ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'tub.user_id')
                ->leftjoin('r_user_position as rup', 'rup.user_id', '=', 'tub.user_id')
                ->leftjoin('m_belongs as mb', 'mb.belongs_id', '=', 'rub.belongs_id')
                ->leftjoin('t_user as tu', 'tu.user_id', '=', 'tub.user_id')
                ->where('tub.user_id', $request->user_id)
                ->select('mb.belongs_id', 'mb.parent_id', "tu.engineer_flg", 'rup.position_id', 'tu.member_id', 'tub.last_name', 'tub.first_name')
                ->first();

            if($request->guest_flg == 0){
                
                if($request->engineer_flg == 0 || $request->engineer_flg == 1){
                    //レビュー依頼：エンジニア⇒上長
                    //対象エンジニアが更新後、自身を「レビュー待ち」状態へ
                    DB::table('t_user')
                        ->where('user_id','=', $request->login_id)
                        ->update(['reviewee_flg' => 1]);
                }/*else {
                    //編集された人のメンバーIDをmessaageに追加
                    //$this->message .= "<@" . $edited->member_id . ">";
                }*/

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
                        ->select('tu.member_id', 'tu.user_id', 'mb.parent_id', 'rup.position_id')
                        ->get();

                    //更新された人の上長がデータベースにない場合
                    if($superiors->isEmpty()){
                        break;
                    }
                        
                    //所属ID の更新（組織構成を bottom-up で参照）
                    $parent_id = $superiors[0]->parent_id;

                    // 編集された人の役職ID より大きい役職ID を持つ人のメンバーIDを格納
                    foreach ($superiors as $superior) {
                        if ($position_id < $superior->position_id) {
                            $this->message .= "<@" . $superior->member_id . "> ";

                            if($request->engineer_flg == 0 || $request->engineer_flg == 1){
                                Log::debug(print_r($superior->user_id, true));
                                //レビュー依頼：エンジニア⇒上長
                                //対象エンジニアが更新後、上長を「レビュー未完了」状態へ
                                DB::table('t_user')
                                    ->where('user_id','=', $superior->user_id)
                                    ->update(['reviewer_flg' => 1]);
                            }/* else {
                                //更新依頼：営業⇒対象エンジニア
                                // array_push($this->data['cc'], $superior->mail_address);
                            }*/
                        }
                    }
                }
            }else {
                if($request->engineer_flg == 0 || $request->engineer_flg == 1){
                    //レビュー依頼：ゲストエンジニア⇒上長
                    DB::table('t_user')
                        ->where('user_id','=', $request->login_id)
                        ->update(['reviewee_flg' => 1]);

                    //ゲストエンジニアと同じ部署のゲストレビュアーフラグを立てる
                    DB::table('t_user as tu')
                        ->leftJoin("r_user_authority as rua", 'rua.user_id', '=', 'tu.user_id')
                        ->where('tu.engineer_flg', '=', $edited->engineer_flg)
                        ->where('rua.auth_name', '=', 'manager')
                        ->where('tu.del_flg', '=', 0)
                        ->update(['tu.guest_reviewer_flg' => 1]);
                }
            }

            if($request->engineer_flg == 0 || $request->engineer_flg == 1){
                //レビュー依頼：エンジニア⇒上長
                $this->message .= "\n". $login->last_name . " " . $login->first_name . " さんがレジュメを更新しました。\nレビューをお願いします。";
                if($request->guest_flg == 1){
                    $this->message = "<!here>\n" . $login->last_name . " " . $login->first_name . " 様がレジュメを更新しました。\nレビューをお願いします。";
                }
            }else {
                //編集された人のメンバーIDをmessaageに追加
                $this->message .= "\n" . $edited->last_name . " " . $edited->first_name . "さんのレジュメ更新依頼が来ています。\n更新依頼の連絡をよろしくお願いします。";
            }

            DB::commit();
        }catch(\Exception $e){
            session()->flash('flash_message', '通知が失敗しました\n' .$e->getMessage());
            DB::rollBack();
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Slack通知
     *
     * @param mixed $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->from($this->name)
            ->content($this->message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
