<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //レジュメ一覧画面表示用ユーザーデータ取得
    public function getuser()
    {

        //Authがまだ使えない？から手動でユーザー情報を定義
        $user = [
            'auth_name' => 'sales',
            'user_id' => 1,
            'belongs_id' => 1100
        ];


        //managerの時のユーザー情報取得用変数
        $num = mb_strpos($user['belongs_id'], "0");
        $num = substr($user['belongs_id'], 0, $num);


        //admin or sales
        if ($user['auth_name'] == 'admin' || $user['auth_name'] == 'sales') {
            $query = DB::table('t_user_basic as tub')
                ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'tub.user_id')
                ->leftjoin('m_belongs as mb', 'mb.belongs_id', '=', 'rub.belongs_id')
                ->select('tub.user_id', 'tub.last_name', 'tub.first_name', 'mb.belongs_name')
                ->get();
        }

        //salesのメンバーは省く処理を入れる
        else if ($user['auth_name'] == 'sales') {
            $query = DB::table('t_user_basic as tub')
                ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'tub.user_id')
                ->leftjoin('m_belongs as mb', 'mb.belongs_id', '=', 'rub.belongs_id')
                ->leftjoin('r_user_authority as rua', 'rua.user_id', '=', 'tub.user_id')
                ->where('rua.auth_name', '!=', 'sales')
                ->select('tub.user_id', 'tub.last_name', 'tub.first_name', 'mb.belongs_name')
                ->get();
        }

        //member
        else if ($user['auth_name'] == 'member') {
            $query = DB::table('t_user_basic as tub')
                ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'tub.user_id')
                ->leftjoin('m_belongs as mb', 'mb.belongs_id', '=', 'rub.belongs_id')
                ->where('tub.user_id', $user['user_id'])
                ->select('tub.user_id', 'tub.last_name', 'tub.first_name', 'mb.belongs_name')
                ->get();
        }

        //maneger 木村さん持ち帰り？
        else if ($user['auth_name'] == "manager") {
            $query = DB::table('t_user_basic as tub')
                ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'tub.user_id')
                ->leftjoin('m_belongs as mb', 'mb.belongs_id', '=', 'rub.belongs_id')
                ->where('mb.parent_id', 'like', "$num%")
                ->select('tub.user_id', 'tub.last_name', 'tub.first_name', 'mb.belongs_name')
                ->get();
        }

        return $query;
    }

    public function getuserlist(Request $request)
    {
    }
}
