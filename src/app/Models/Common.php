<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Common extends Model
{
    use HasFactory;

    public function authCheck()
    {
        session(['user_id' => '1']);
        $user_auth = session()->get('user_id');

        $query = DB::table('t_user_basic as tub')
            ->leftjoin('r_user_authority as rua', 'rua.user_id', '=', 'tub.user_id')
            ->select('tub.user_id', 'rua.auth_name')
            ->where('tub.user_id', $user_auth)
            ->get();

        return $query;
    }
}
