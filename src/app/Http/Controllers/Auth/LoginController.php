<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\T_User;
use App\Models\Announcement;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __construct(
        private ?Announcement $announcementModel = null
    ){}

    /**
     * ログインページ
     *
     * @return View|RedirectResponse
     */
    public function index(): View|RedirectResponse
    {
        if (session()->has('user_id'))
            return redirect('/');

        return view('login.index', [
            'weekday_array' => config('resumeApp.WEEKDAY_ARRAY'),
            'announcements' => $this->announcementModel->findAllAnnouncements(config('resumeApp.ORDER_BY.DESC'))
        ]);
    }

    /**
     * パスワードログイン処理
     *
     * @param Request $request
     * @param T_User $t_userModel
     * @return RedirectResponse
     */
    public function login(Request $request, T_User $t_userModel): RedirectResponse
    {
        $user = $t_userModel->findUserByParams([
            'mail_address' => $request->email,
            'del_flg' => config('resumeApp.DEL_FLG.OFF')
        ]);

        $credentials = ([
            'mail_address' => $request->email,
            'password'     => $request->password,
            'del_flg'      => config('resumeApp.DEL_FLG.OFF')
        ]);

        if (is_null($user) || !Auth::attempt($credentials)) {
            return redirect('/login')->with([
                'flash_message'      => config('message.MESSAGE.LOGIN_PAGE.1'),
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
            'token'        => $request->_token,
            'guest_flg'    => $user->guest_flg,
            'engineer_flg' => $user->engineer_flg,
        ]);

        //Guest tokenを保存
        $t_userModel->updateGuestTokenByUserId($user->user_id, $request->_token);

        if ($referrerURL)
            return redirect($referrerURL);

        return redirect('/resume-list');
    }
}
