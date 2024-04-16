<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Login extends Model
{
    use HasFactory;

    public function getLoginAuth($login_mail_address)
    {
        $login_info_items = DB::table('t_user as user')
            ->leftJoin('r_user_authority as authority', 'user.user_id', '=', 'authority.user_id')
            ->where('user.mail_address', $login_mail_address)
            ->where('user.del_flg', '0')
            ->select(
                'user.user_id as user_id',
                'authority.auth_name as auth_name'
            )
            ->get();

        return $login_info_items;
    }

    public function guestToken($request, $user_id)
    {
        DB::table('t_user as user')
            ->where([
                'user_id' => $user_id,
            ])
            ->update([
                'guest_token' => $request->_token,
            ]);
    }

    public function googleGuestToken($user_id, $gUser)
    {
        DB::table('t_user as user')
            ->where([
                'user_id' => $user_id,
            ])
            ->update([
                'google_access_token' => $gUser->token,
                'google_reflesh_token' => $gUser->refreshToken,
            ]);
    }
}
