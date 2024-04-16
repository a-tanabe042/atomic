<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;      //Mailableクラス
use App\Mail\SendDetailMail;      //Mailableクラス
use App\Mail\ReviewBack;    //Mailableクラス

class MailService
{
    /* ゲストユーザ登録時のメール通知 */
    public function send_list(Request $request)
    {

        $data = array(
            "firstname" => "",
            "lastname" => "",
            "password" => "",
            "to_mail" => "",
            "message" => "",
            "subject" => "",
            "from_mail" => "",
            "sender" => "",
            "cc" => ""
        );

        //modal 情報格納
        $data["firstname"] = $request->firstname;
        $data["lastname"] = $request->lastname;
        $data["password"] = $request->password;
        $data["to_mail"] = $request->mail;
        $data["from_mail"] = "noreply-resume@salto.link";

        if ($data["password"] != "") {
            $data['message'] = 'contact';
            $data['sender'] = '採用部';
            $data['subject'] = "レジュメweb管理システムのアカウント作成について | 株式会社SALTO";
            $data['cc'] = "saiyou-jinji@salto.link";
        } else {
            $data['message'] = 'register';
            $data['sender'] = '社内web運用保守チーム';
            $data['subject'] = 'ユーザーの登録が完了しました | レジュメweb';
        }

        //　data 情報を格納し、宛先に送信
        Mail::to($data["to_mail"])->send(new SendMail($data));
    }

    ///NOTE:Slackで通知しているため使用していないので後で削除
    /* ユーザ詳細編集時のメール通知 */
    /*
    public function send_detail(Request $request)
    {
        $data = array(
            "firstname" => "",
            "lastname" => "",
            "to_mail" => array(),
            "user_id" => "",
            "login" => "",
            "login_engineer_flg" => "",
            "message" => "",
            "subject" => "",
            "from_mail" => "",
            "sender" => "",
            "guest_flg" => "",
            "cc" => array()
        );

        $data["firstname"] = $request->firstname;
        $data["lastname"] = $request->lastname;
        $data["user_id"] = $request->user_id;
        $data["login"] = $request->login_id;
        $data["login_engineer_flg"] = $request->engineer_flg;
        $data["message"] = 'notificate';
        $data["subject"] =  $data['lastname'] . " " . $data['firstname'] .  'さんのレジュメが更新されました';
        $data["from_mail"] = "noreply-resume@salto.link";
        $data['sender'] = '社内web運用保守チーム';
        $data['guest_flg'] = $request->guest_flg;
        //入力期間が終了後以下1行をコメントアウト解除
        //array_push($this->data['to_mail'], 'eigyo_all@salto.link');

        $mail_data = new SendDetailMail($data);
        $data['to_mail'] = $mail_data->data["to_mail"];

        // data 情報を格納し、宛先に送信
        Mail::to($data["to_mail"])->send($mail_data);
    }
    */

    /* レビュー結果通知 */
    public function noticeReview(Request $request)
    {
        $data = array(
            "firstname" => "",
            "lastname" => "",
            "to_mail" => "",
            "user_id" => "",
            "login" => "",
            "login_engineer_flg" => "",
            "message" => "",
            "subject" => "",
            "from_mail" => "",
            "sender" => "",
            'guest_flg' => "",
            'user_guest_flg' => "",
            "judge" => "",
            "cc" => array()
        );

        $data["firstname"] = $request->firstname;
        $data["lastname"] = $request->lastname;
        $data["user_id"] = $request->user_id;
        $data["login"] = $request->login_id;
        $data["login_engineer_flg"] = $request->engineer_flg;
        $data['review'] = $request->message;
        $data["from_mail"] = "noreply-resume@salto.link";
        $data['sender'] = '社内web運用保守チーム';
        $data['guest_flg'] = $request->guest_flg;
        $data['user_guest_flg'] = $request->user_guest_flg;
        $data['judge'] = $request->judge;

        if ($data['judge'] == "approved") {
            $data["subject"] =  'レジュメ承認のお知らせ | 株式会社SALTO';
            $data["message"] = 'approved';
        } else {
            $data["subject"] =  'レジュメ修正依頼のお知らせ | 株式会社SALTO';
            $data["message"] = 'review';
        }

        //ゲストの場合、cc に採用ML追加
        if ($data['user_guest_flg'] == 1) {
            /* 入力期間が終了後以下1行をコメントアウト解除 */
            array_push($this->$data['cc'], 'saiyou-jinji@salto.link');
            // Log::debug(print_r("user_guest_flg == 1", true));
        }

        $mail_data = new ReviewBack($data);
        $data['to_mail'] = $mail_data->data["to_mail"];

        // data 情報を格納し、宛先に送信
        Mail::to($data["to_mail"])->send($mail_data);
    }
}
