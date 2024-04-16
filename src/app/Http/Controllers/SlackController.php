<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\Notifiable;
use App\Notifications\Slack;
use App\Services\MailService;
use Illuminate\Http\Request;

class SlackController extends Controller
{
    use Notifiable;

    //通知を送信するチャンネルの切り分け
    public $judge;
    public $user_guest_flg;

    /**
     * Slackに通知する文字列入力ページの表示
     *
     * @return view
     */
    public function index()
    {
        return view('slacks.index');
    }

    /**
     * Slackへの通知
     *
     * @param Request $request
     * @return redirect
     */
    public function review_send(Request $request, MailService $mail_service)
    {
        $this->judge = $request->judge;
        $this->user_guest_flg = $request->user_guest_flg;

        /* 通知処理 */
        //ゲストの時は、メールも送信
        if ($this->user_guest_flg == 1) {
            $mail_service->noticeReview($request);
        }

        $this->notify(new Slack($request));

        return;
    }

    /**
     * 通知を行うWebhook URLの設定
     *
     * @param mix $notification
     * @return slackWebhookUrl
     */
    public function routeNotificationForSlack($notification)
    {
        if ($this->judge == "approved") {
            if ($this->user_guest_flg == 1) {
                return config('app.channel_manager_url');
            } else {
                return config('app.channel_sales_url');
            }
        } else {
            return config('app.channel_manager_url');
        }
    }
}
