<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use App\Models\T_User;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    /**
     * Googleへリダイレクト
     *
     * @return RedirectResponse
     */
    public function redirectToGoogle(): RedirectResponse
    {
        // 10/18 カレンダーの許可とリフレッシュトークンの取得追加
        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/calendar'])
            ->with(['access_type' => 'offline'])
            ->redirect();
    }

    /**
     * Google認証後の処理
     *
     * @param T_User $t_userModel
     * @return RedirectResponse
     */
    public function handleGoogleCallback(T_User $t_userModel): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = $t_userModel->findUserByParams([
            'mail_address' => $googleUser->email,
            'del_flg' => config('resumeApp.DEL_FLG.OFF')
        ]);

        if (is_null($user)) {
            return redirect('/login')->with([
                'flash_message'      => config('message.MESSAGE.LOGIN_PAGE.0'),
                'flash_message_type' => config('message.TYPE.danger')
            ]);
        }

        $referrerURL = session('referrer');
        session()->invalidate();

        // ログインユーザーの権限名取得
        $authName = $t_userModel->findAuthNameByUserId($user->user_id);

        session([
            'auth_name'    => $authName,
            'user_id'      => $user->user_id,
            'guest_flg'    => $user->guest_flg,
            'token'        => $googleUser->token,
            'engineer_flg' => $user->engineer_flg,
        ]);

        // Google tokenを保存
        $t_userModel->updateGoogleTokensByUserId($user->user_id, $googleUser->token, $googleUser->refreshToken);

        if ($referrerURL)
            return redirect($referrerURL);

        return redirect('/resume-list');
    }
}
