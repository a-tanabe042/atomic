<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Slack extends Notification
{
    use Queueable;

    /**
     * @var string $message
     */
    private $message;
    private $lastname;
    private $firstname;
    private $login_id;
    private $judge;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->name = env('SLACK_NAME');

        try{
            //トランザクション開始
            DB::beginTransaction();

            //Slackメッセージ内容
            $this->message = "";
            //レビュー結果
            $this->judge = $request->judge;
            //差し戻し内容
            //$this->review = "";
            //$this->review .= "差し戻し理由: \n" . $request->message;

            //ログイン者の名前取得
            $login = DB::table('t_user as tu')
                ->leftjoin('t_user_basic as tub', 'tub.user_id', '=', 'tu.user_id')
                ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'tu.user_id')
                ->leftjoin('r_user_position as rup', 'rup.user_id', '=', 'tu.user_id')
                ->where('tub.user_id', $request->login_id)
                ->select('tub.last_name', 'tub.first_name', 'rup.position_id', 'rub.belongs_id')
                ->first();
            
            //編集された人の所属IDとメールアドレスの取得
            $edited = DB::table('t_user as tu')
                ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'tu.user_id')
                ->leftjoin('r_user_position as rup', 'rup.user_id', '=', 'tu.user_id')
                ->leftjoin('r_user_authority as rua', 'rua.user_id', '=', 'tu.user_id')
                ->leftjoin('m_belongs as mb', 'mb.belongs_id', '=', 'rub.belongs_id')
                ->leftjoin('m_position as mp', 'mp.position_id', '=', 'rup.position_id')
                ->leftjoin('t_user_basic as tub', 'tub.user_id', '=', 'tu.user_id')
                ->where('tu.user_id', $request->user_id)
                ->select('mb.belongs_id', 'mb.parent_id', 'mb.parent_id', 'rup.position_id', "mp.superior_id", 'rua.auth_name', 'tu.guest_flg', 'tu.engineer_flg', 'tu.member_id', 'tu.user_id', 'tub.last_name', 'tub.first_name')
                ->first();

            //差し戻し内容DBに保存
            if($request->judge == "approved"){
                DB::table('t_user')
                    ->where("user_id", "=", $request->user_id)
                    ->update(['review_message' => null]);
            }else {
                    DB::table('t_user')
                        ->where("user_id", "=", $request->user_id)
                        ->update(['review_message' => $request->message]);
            }

            if($request->judge == "approved"){
                //対象のエンジニアを普通状態へ
                DB::table("t_user")
                    ->where("user_id", "=", $request->user_id)
                    ->update(['reviewee_flg' => 0]);
            }else {
                //対象のエンジニアを差し戻し状態へ
                DB::table("t_user")
                    ->where("user_id", "=", $request->user_id)
                    ->update(['reviewee_flg' => 2]);
            }
            
            //ゲストエンジニアと同じ部署の技術役職者のメールアドレス取得
            $engineers = DB::table('t_user as tu')
                ->leftJoin("r_user_belongs as rub", 'rub.user_id', '=', 'tu.user_id')
                ->leftJoin("m_belongs as mb", "mb.belongs_id", "=", "rub.belongs_id")
                ->leftJoin("r_user_authority as rua", 'rua.user_id', '=', 'tu.user_id')
                ->leftJoin("r_user_position as rup", 'rup.user_id', '=', 'tu.user_id')
                ->where("tu.engineer_flg", '=', $edited->engineer_flg)
                ->where('tu.del_flg', '=', 0)
                ->select('tu.user_id', 'tu.reviewer_flg', 'tu.guest_reviewer_flg', 'tu.reviewee_flg', 'rup.position_id', 'rua.auth_name', 'mb.belongs_id', 'mb.parent_id', 'tu.mail_address')
                ->get();

            //同じ部署のゲストエンジニアを取得
            $guests = DB::table('t_user')
                ->where('engineer_flg', '=', $edited->engineer_flg)
                ->where('guest_flg', '=', 1)
                ->select('reviewer_flg', 'reviewee_flg', 'guest_flg')
                ->get();
            

            // 編集された人の上長取得
            $edited_superior = DB::select
                ("WITH RECURSIVE manager_table AS (
                        SELECT * FROM m_belongs WHERE belongs_id = $edited->belongs_id
                    UNION ALL
                        SELECT m_belongs.*
                        FROM m_belongs, manager_table
                        WHERE m_belongs.belongs_id = manager_table.parent_id)
                    SELECT tu.user_id, tu.reviewee_flg, tu.member_id, rua.auth_name, rup.position_id
                    FROM t_user as tu
                    left join r_user_belongs as rub on rub.user_id = tu.user_id
                    left join manager_table as mt on mt.belongs_id = rub.belongs_id
                    left join r_user_authority as rua on rua.user_id = tu.user_id
                    left join r_user_position as rup on rup.user_id = tu.user_id
                    where mt.belongs_id is not null
                    and rup.position_id > $edited->position_id
                    and tu.del_flg = '0'");

            $edited_superior = collect($edited_superior);
            
            //対象者が既存・ゲストエンジニアなのか判断
            if($edited->guest_flg == 0){
                /*ゲストエンジニアWF*/

                //対象者から役職を上に辿る
                $belongs_id = $edited->belongs_id;
                $parent_id = $edited->parent_id;
                $auth_name = $edited->auth_name;
                $superior_id = $edited->superior_id;

                //superior（上長）の初期データ
                if($auth_name == "manager"){
                    $superior = DB::table('t_user as tu')
                        ->leftJoin("r_user_belongs as rub", "rub.user_id", "=", "tu.user_id")
                        ->leftJoin("r_user_authority as rua", "rua.user_id", "=", "tu.user_id")
                        ->leftJoin("m_belongs as mb", "mb.belongs_id", "=", "rub.belongs_id")
                        ->where('mb.parent_id', '=', $parent_id)
                        ->select('tu.reviewee_flg', 'tu.reviewer_flg')
                        ->get();
                }

                //Slackのメンション（承認の場合は、営業＆上長？）
                if($request->judge == "approved"){
                    $this->message .= "<!here>\n" . $edited->last_name . " " . $edited->first_name . "さんのレビューが承認されました（レビュー者: " . $login->last_name . " " . $login->first_name .  "）。";
                }else{
                    foreach($edited_superior as $row){
                        $this->message .= "<@". $row->member_id . "> ";
                    }
                    $this->message .= "\n" . $edited->last_name . $edited->first_name . "さんのレビューが差し戻しされました（レビュー者: " . $login->last_name . " " . $login->first_name .  "）。";
                }
                    
                while(true){
                    //member レビュー状態の判定
                    $reviewee_bool = false;
                    //manager レビュー状態の判定
                    $reviewee_manager_bool = false;
                    //guest のレビュー状態判定
                    $guest_bool = false;
                    //無駄な繰り返しを避けるため
                    $count_bool = false;

                    foreach($engineers as $row){
                        //「編集された人：メンバー」判定
                        if($row->belongs_id == $belongs_id && $row->auth_name == "member" && $auth_name == "member" && $row->reviewee_flg == 1){
                            $reviewee_bool = true;
                        }
                        //「編集された人：主任・課長・部長含む部下」判定
                        if($row->parent_id == $parent_id && $row->auth_name == "manager" && $auth_name == "manager"){
                            if($count_bool == false){
                                $count_bool = true;
                                foreach($superior as $col){
                                    if($col->reviewer_flg == 1 || $col->reviewee_flg == 1){
                                        $reviewee_manager_bool = true;
                                    }
                                }
                            }
                        }
                    }

                    //対象が member
                    if($auth_name == "member"){
                        if($reviewee_bool == false){
                            DB::table("t_user as tu")
                                ->leftJoin("r_user_belongs as rub", "rub.user_id", "=", "tu.user_id")
                                ->leftJoin("r_user_authority as rua", "rua.user_id", "=", "tu.user_id")
                                ->where('rub.belongs_id', '=', $belongs_id)
                                ->where("rua.auth_name", "=", "manager")
                                ->update(["tu.reviewer_flg" => 0]);
                        }

                        $superior = DB::table('t_user as tu')
                            ->leftJoin("r_user_belongs as rub", "rub.user_id", "=", "tu.user_id")
                            ->leftJoin("r_user_authority as rua", "rua.user_id", "=", "tu.user_id")
                            ->leftJoin("m_belongs as mb", "mb.belongs_id", "=", "rub.belongs_id")
                            ->leftJoin("r_user_position as rup", "rup.user_id", "=", "tu.user_id")
                            ->leftjoin("m_position as mp", "mp.position_id", "=", "rup.position_id")
                            ->where('mb.parent_id', '=', $parent_id)
                            ->where("rua.auth_name", "=", "manager")
                            ->where("tu.del_flg", "=", 0)
                            ->select('tu.reviewee_flg', 'tu.reviewer_flg', 'mb.belongs_id', 'mb.parent_id', "rua.auth_name", "mp.superior_id")
                            ->get();
                    }

                    //対象が manager
                    if($auth_name == "manager"){
                        if($reviewee_manager_bool == false){
                            DB::table("t_user as tu")
                                ->leftJoin("r_user_belongs as rub", "rub.user_id", "=", "tu.user_id")
                                ->where('rub.belongs_id', '=', $parent_id)
                                ->update(["tu.reviewer_flg" => 0]);
                        }

                        $superior = DB::table('t_user as tu')
                            ->leftJoin("r_user_belongs as rub", "rub.user_id", "=", "tu.user_id")
                            ->leftJoin("r_user_authority as rua", "rua.user_id", "=", "tu.user_id")
                            ->leftJoin("m_belongs as mb", "mb.belongs_id", "=", "rub.belongs_id")
                            ->leftJoin("r_user_position as rup", "rup.user_id", "=", "tu.user_id")
                            ->leftjoin("m_position as mp", "mp.position_id", "=", "rup.position_id")
                            ->where("rua.auth_name", "=", "manager")
                            ->where("tu.engineer_flg", "=", $edited->engineer_flg)
                            ->where("tu.del_flg", "=", 0)
                            ->where("rup.position_id", "=", $superior_id)
                            ->where("tu.del_flg", "=", 0)
                            ->select('tu.reviewee_flg', 'tu.reviewer_flg', 'mb.belongs_id', 'mb.parent_id', "rua.auth_name", "mp.superior_id")
                            ->get();
                    }

                    //最高役職者（部長）まで辿ったかどうか判定
                    if($superior->isEmpty()){
                        break;
                    }else {
                        $belongs_id = $superior[0]->belongs_id;
                        $parent_id = $superior[0]->parent_id;
                        $auth_name = $superior[0]->auth_name;
                        $superior_id = $superior[0]->superior_id;
                    }
                }
            }else{
                /*ゲストエンジニアWF*/
                $guest_bool = false;

                //ゲストのレビュー待ち判断
                foreach($guests as $row){
                    if($row->reviewee_flg == 1){
                        $guest_bool = true;
                    }
                }

                //ゲスト自身のレビュー待ち状態を変更
                if($request->judge == "approved"){
                    //技術役職者にメンション（承認時は同時にゲスト⇒メール。さらに営業に通知）
                    $this->message .= "<!here>\n" . $edited->last_name . " " . $edited->first_name . " 様のレジュメが承認されました（レビュー者: " . $login->last_name . " " . $login->first_name . "）";
                }else{
                    //技術役職者にメンション
                    $this->message .= "<!here>\n" . $edited->last_name . " " . $edited->first_name . " 様のレジュメが差し戻しされました（レビュー者: " . $login->last_name . " " . $login->first_name . "）";
                }

                //ゲストエンジニアと同じ部署のゲストレビュアーフラグを解除
                if($guest_bool == false){
                    DB::table('t_user as tu')
                        ->leftJoin("r_user_authority as rua", 'rua.user_id', '=', 'tu.user_id')
                        ->where('tu.engineer_flg', '=', $edited->engineer_flg)
                        ->where('rua.auth_name', '=', 'manager')
                        ->where('tu.del_flg', '=', 0)
                        ->update(['tu.guest_reviewer_flg' => 0]);
                }
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
        if($this->judge == "approved"){
            return (new SlackMessage)
                ->from($this->name)
                ->content($this->message);
        }else{
            return (new SlackMessage)
                ->from($this->name)
                ->content($this->message);
                // ->attachment(function ($attachment){
                //     $attachment->content($this->review);
                // });
        }
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
