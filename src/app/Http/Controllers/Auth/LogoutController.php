<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * ログアウト処理
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        //セッション削除
        session()->flush();

        return redirect('/login')->with([
            'flash_message'      => config('message.MESSAGE.LOGIN_PAGE.2'),
            'flash_message_type' => config('message.TYPE.success')
        ]);
    }
}
