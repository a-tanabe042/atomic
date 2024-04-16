<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\Notifiable;
use App\Notifications\SlackRequest;
use Illuminate\Http\Request;

class SlackRequestController extends Controller
{
    use Notifiable;
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
    public function request_send(Request $request)
    {
        /*通知処理*/
        $this->notify(new SlackRequest($request));
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
        return config('app.channel_manager_url');
    }
}
