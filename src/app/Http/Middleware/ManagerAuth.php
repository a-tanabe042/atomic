<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\T_User;
use Carbon\Carbon;

class ManagerAuth
{
    public function __construct(
        private ?T_User $t_userModel = null
    ){}

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // 未ログインcheck
        if (!session()->has('user_id')) {
            session()->put('referrer', url()->current());
            return redirect('/login');
        }

        //sessionのuser_idでユーザー情報取得
        $user = $this->t_userModel->findUserByParams([
            'user_id' => session('user_id'),
            'del_flg' => config('resumeApp.DEL_FLG.OFF')
        ]);

        //tokenの日付 + 1month の年月日を取得
        $loginOneMonthAfterDate = Carbon::create($user->guest_limit)->addMonth()->toDateString();

        //現在の年月日取得
        $nowDate = Carbon::now()->toDateString();

        if ($nowDate >= $loginOneMonthAfterDate) {
            //T_Userのtoken期限から一ヶ月後の場合は、ログアウト
            session()->flush();
            return redirect('/login');
        }

        return $next($request);
    }
}
