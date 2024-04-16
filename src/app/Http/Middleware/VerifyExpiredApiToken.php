<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\T_User;

/**
 * NOTE: 【重要】処理から見直し。
 * ユーザー詳細情報(/resume_detail/{user_id}_{token})でのみ使っている。
 * が、そもそもこのロジック要るか疑問。
 * 管理者(上長)も編集出来る仕様の為、そも不要では？
 * tokenにしている分処理が重くなってる気がする。
 * Kernel.phpからも削除の方向で。
 *
 * NOTE: 2023/11/06
 * レジュメ詳細表示前処理に使用中
 * guestではないユーザーはgoogle access tokenで、
 * gurstはguest tokenで判定。
 * 詳細画面遷移時のtoken(sessionから)を取得し、それと比較して変わっていれば404。
 * メーリングリスト系のログインなどgoogleログインを使わない系は全て弾かれる為、【要】guest_flg=2。
 * 後でロジック見直し。
 */
class VerifyExpiredApiToken
{

    public function __construct(
        private ?T_User $t_userModel = null
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //sessionのuser_idでユーザー情報取得
        $user = $this->t_userModel->findUserByParams([
            'user_id' => session('user_id'),
            'del_flg' => config('resumeApp.DEL_FLG.OFF')
        ]);

        // ﾕｰｻﾞｰのguest_flgが0(社員)だった場合は、google access tokenをｾｯﾄ
        // それ以外の場合はguest_tokenを使用
        $token = ($user->guest_flg === config('resumeApp.USER_TYPE.general')) ? $user->google_access_token : $user->guest_token;

        //レジュメ詳細のリンクtoken(sessionから取得)とT_Userのtokenが違う場合は、404
        if ($request->route('token') && $request->route('token') != $token) {
            //セッション削除
            session()->flush();
            abort(404);
        }

        return $next($request);
    }
}
