<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ReviewBack extends Mailable
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

        // try{
        //     //トランザクション開始
        //     DB::beginTransaction();

            //ログイン者の名前とメールアドレス取得
            $login = DB::table('t_user_basic')
                ->where('user_id', $data["login"])
                ->select('last_name', 'first_name')
                ->first();

            //ログイン情報格納
            $this->data["login"] = $login->last_name . " " . $login->first_name;

            //編集された人の所属IDとメールアドレスの取得
            $edited = DB::table('t_user')
                ->where('user_id', $data["user_id"])
                ->select('mail_address')
                ->first();

            //編集された人のメールアドレス格納
            $this->data['to_mail'] = $edited->mail_address;

        //     //対象のエンジニアを差し戻し状態へ
        //     DB::table("t_user")
        //         ->where("user_id", "=", $data["user_id"])
        //         ->update(['reviewee_flg' => 2]);
            
        //     //ゲストエンジニアと同じ部署の技術役職者のメールアドレス取得
        //     $engineers = DB::table('t_user as tu')
        //         ->leftJoin("r_user_belongs as rub", 'rub.user_id', '=', 'tu.user_id')
        //         ->leftJoin("m_belongs as mb", "mb.belongs_id", "=", "rub.belongs_id")
        //         ->leftJoin("r_user_authority as rua", 'rua.user_id', '=', 'tu.user_id')
        //         ->leftJoin("r_user_position as rup", 'rup.user_id', '=', 'tu.user_id')
        //         ->where("tu.engineer_flg", '=', $edited->engineer_flg)
        //         ->where('tu.del_flg', '=', 0)
        //         ->select('tu.user_id', 'tu.mail_address', 'tu.reviewer_flg', 'tu.guest_reviewer_flg', 'tu.reviewee_flg', 'rup.position_id', 'rua.auth_name', 'mb.belongs_id', 'mb.parent_id')
        //         ->get();

        //     //同じ部署のゲストエンジニアを取得
        //     $guests = DB::table('t_user')
        //         ->where('engineer_flg', '=', $edited->engineer_flg)
        //         ->where('guest_flg', '=', 1)
        //         ->select('reviewer_flg', 'reviewee_flg', 'guest_flg')
        //         ->get();
            

        //     // 編集された人の上長取得
        //     $edited_superior = DB::select
        //         ("WITH RECURSIVE manager_table AS (
        //                 SELECT * FROM m_belongs WHERE belongs_id = $edited->belongs_id
        //             UNION ALL
        //                 SELECT m_belongs.*
        //                 FROM m_belongs, manager_table
        //                 WHERE m_belongs.belongs_id = manager_table.parent_id)
        //             SELECT tu.user_id, tu.reviewee_flg, rua.auth_name, rup.position_id, tu.mail_address
        //             FROM t_user as tu
        //             left join r_user_belongs as rub on rub.user_id = tu.user_id
        //             left join manager_table as mt on mt.belongs_id = rub.belongs_id
        //             left join r_user_authority as rua on rua.user_id = tu.user_id
        //             left join r_user_position as rup on rup.user_id = tu.user_id
        //             where mt.belongs_id is not null
        //             and rup.position_id > $edited->position_id
        //             and tu.del_flg = '0'");

        //     $edited_superior = collect($edited_superior);
            
        //     //対象者が既存・ゲストエンジニアなのか判断
        //     //現在の仕様は、既存エンジニアの処理は使用しない
        //     if($edited->guest_flg == 0){
        //         //編集者の上長メール送信
        //         foreach($edited_superior as $row){
        //             array_push($this->data['cc'], $row->mail_address);
        //         }

        //         //対象者から役職を上に辿る
        //         $belongs_id = $edited->belongs_id;
        //         $parent_id = $edited->parent_id;
        //         $auth_name = $edited->auth_name;
        //         $superior_id = $edited->superior_id;

        //         //superior（上長）の初期データ
        //         if($auth_name == "manager"){
        //             $superior = DB::table('t_user as tu')
        //                 ->leftJoin("r_user_belongs as rub", "rub.user_id", "=", "tu.user_id")
        //                 ->leftJoin("r_user_authority as rua", "rua.user_id", "=", "tu.user_id")
        //                 ->leftJoin("m_belongs as mb", "mb.belongs_id", "=", "rub.belongs_id")
        //                 ->where('mb.parent_id', '=', $parent_id)
        //                 ->select('tu.reviewee_flg', 'tu.reviewer_flg')
        //                 ->get();
        //         }

        //         while(true){
        //             //member レビュー状態の判定
        //             $reviewee_bool = false;
        //             //manager レビュー状態の判定
        //             $reviewee_manager_bool = false;
        //             //guest のレビュー状態判定
        //             $guest_bool = false;
        //             //無駄な繰り返しを避けるため
        //             $count_bool = false;

        //             foreach($engineers as $row){
        //                 //「編集された人：メンバー」判定
        //                 if($row->belongs_id == $belongs_id && $row->auth_name == "member" && $auth_name == "member" && $row->reviewee_flg == 1){
        //                     $reviewee_bool = true;
        //                 }
        //                 //「編集された人：主任・課長・部長含む部下」判定
        //                 if($row->parent_id == $parent_id && $row->auth_name == "manager" && $auth_name == "manager"){
        //                     if($count_bool == false){
        //                         $count_bool = true;
        //                         foreach($superior as $col){
        //                             if($col->reviewer_flg == 1 || $col->reviewee_flg == 1){
        //                                 $reviewee_manager_bool = true;
        //                             }
        //                         }
        //                     }
        //                 }
        //             }

        //             //対象が member
        //             if($auth_name == "member"){
        //                 if($reviewee_bool == false){
        //                     DB::table("t_user as tu")
        //                         ->leftJoin("r_user_belongs as rub", "rub.user_id", "=", "tu.user_id")
        //                         ->leftJoin("r_user_authority as rua", "rua.user_id", "=", "tu.user_id")
        //                         ->where('rub.belongs_id', '=', $belongs_id)
        //                         ->where("rua.auth_name", "=", "manager")
        //                         ->update(["tu.reviewer_flg" => 0]);
        //                 }

        //                 $superior = DB::table('t_user as tu')
        //                     ->leftJoin("r_user_belongs as rub", "rub.user_id", "=", "tu.user_id")
        //                     ->leftJoin("r_user_authority as rua", "rua.user_id", "=", "tu.user_id")
        //                     ->leftJoin("m_belongs as mb", "mb.belongs_id", "=", "rub.belongs_id")
        //                     ->leftJoin("r_user_position as rup", "rup.user_id", "=", "tu.user_id")
        //                     ->leftjoin("m_position as mp", "mp.position_id", "=", "rup.position_id")
        //                     ->where('mb.parent_id', '=', $parent_id)
        //                     ->where("rua.auth_name", "=", "manager")
        //                     ->select('tu.reviewee_flg', 'tu.reviewer_flg', 'mb.belongs_id', 'mb.parent_id', "rua.auth_name", "mp.superior_id")
        //                     ->get();
        //             }

        //             //対象が manager
        //             if($auth_name == "manager"){
        //                 if($reviewee_manager_bool == false){
        //                     DB::table("t_user as tu")
        //                         ->leftJoin("r_user_belongs as rub", "rub.user_id", "=", "tu.user_id")
        //                         ->where('rub.belongs_id', '=', $parent_id)
        //                         ->update(["tu.reviewer_flg" => 0]);
        //                 }

        //                 $superior = DB::table('t_user as tu')
        //                     ->leftJoin("r_user_belongs as rub", "rub.user_id", "=", "tu.user_id")
        //                     ->leftJoin("r_user_authority as rua", "rua.user_id", "=", "tu.user_id")
        //                     ->leftJoin("m_belongs as mb", "mb.belongs_id", "=", "rub.belongs_id")
        //                     ->leftJoin("r_user_position as rup", "rup.user_id", "=", "tu.user_id")
        //                     ->leftjoin("m_position as mp", "mp.position_id", "=", "rup.position_id")
        //                     ->where("rua.auth_name", "=", "manager")
        //                     ->where("tu.engineer_flg", "=", $edited->engineer_flg)
        //                     ->where("rup.position_id", "=", $superior_id)
        //                     ->select('tu.reviewee_flg', 'tu.reviewer_flg', 'mb.belongs_id', 'mb.parent_id', "rua.auth_name", "mp.superior_id")
        //                     ->get();
        //             }

        //             //最高役職者（部長）まで辿ったかどうか判定
        //             if($superior->isEmpty()){
        //                 break;
        //             }else {
        //                 $belongs_id = $superior[0]->belongs_id;
        //                 $parent_id = $superior[0]->parent_id;
        //                 $auth_name = $superior[0]->auth_name;
        //                 $superior_id = $superior[0]->superior_id;
        //             }
        //         }
        //     }
        //     else{
        //         //ゲストエンジニアWF
        //         $guest_bool = false;

        //         foreach($guests as $row){
        //             if($row->reviewee_flg == 1){
        //                 $guest_bool = true;
        //             }
        //         }

        //         foreach($engineers as $row){
        //             if($row->auth_name == 'manager'){
        //                 //技術役職者にメール送信
        //                 array_push($this->data['cc'], $row->mail_address);

        //                 if($guest_bool == false){
        //                     //ゲスト用レビュアーフラグ更新
        //                     DB::table("t_user as tu")
        //                     ->where("tu.user_id", "=", $row->user_id)
        //                     ->update(["tu.guest_reviewer_flg" => 0]);
        //                 }
        //             }
        //         }
        //         /* 入力期間が終了後以下1行をコメントアウト解除 */
        //         // array_push($this->data['to_mail'], 'saiyou-jinji@salto.link');
        //     }

        //     //確認
        //     array_push($this->data['cc'], 'riku.harako@salto.link');

        //     DB::commit();
        // }catch(\Exception $e){
        //     session()->flash('flash_message', '通知が失敗しました\n' .$e->getMessage());
        //     DB::rollBack();
        // }
        //array_push($this->data['cc'], 'riku.harako@salto.link');
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
