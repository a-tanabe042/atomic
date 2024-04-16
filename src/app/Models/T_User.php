<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use stdClass;

class T_user extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $table = 't_user';
    protected $hidden = ['password'];
    protected $guarded = ['user_id'];

    /**
      * paramsでユーザー情報取得
      *
      * @param string $mailAddress
      * @return stdClass|null
      */
    public function findUserByParams(array $params = []): ?stdClass
    {
        return DB::table($this->table)
            ->where($params)
            ->first();
    }

    /**
     * Userの権限名取得
     *
     * @param integer $userId
     * @return string
     */
    public function findAuthNameByUserId(int $userId): string
    {
        $ret = DB::table('r_user_authority')
            ->select('auth_name')
            ->where('user_id', $userId)
            ->first();

        return $ret->auth_name;
    }

    /**
     * Guest Token のアップデート処理
     *
     * @param integer $userId
     * @param string $token
     * @return void
     */
    public function updateGuestTokenByUserId(int $userId, string $token): void
    {
        DB::table($this->table)
            ->where('user_id', $userId)
            ->update(['guest_token' => $token]);
    }

    /**
     * Google Tokensのアップデート処理
     *
     * @param integer $userId
     * @param string $token
     * @param string|null $refreshToken
     * @return void
     */
    public function updateGoogleTokensByUserId(int $userId, string $token, ?string $refreshToken): void
    {
        DB::table($this->table)
            ->where('user_id', $userId)
            ->update([
                'google_access_token' => $token,
                'google_reflesh_token' => $refreshToken,
            ]);
    }
}
