<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\Notifiable;
use App\Http\Requests\ContractSlackRequest;
use App\Notifications\ContractSlack;

class ContractSlackController extends Controller
{
    use Notifiable;

    /**
     * Slackに通知する文字列入力ページの表示
     *
     * @return view
     */
    public function contract()
    {
        return view('slacks.contract');
    }

    /**
     * Slackへの通知
     *
     * @param ContractSlackRequest $request
     * @return redirect
     */
    public function contractSend(ContractSlackRequest $request, $last_name, $first_name)
    {
        try {
            $message = $last_name . $first_name . "さんの案件情報が更新されました";
            $requestBody = $request->validated();
            $this->notify(new ContractSlack($message));

            session()->flash('success_message', '通知が完了しました');
        } catch (\Exception $e) {
            session()->flash('flash_message', '通知に失敗しました' . $e->getMessage());
        }
        return back();
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
