<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserList extends Model
{
    use HasFactory;

    //ユーザー追加画面の所属部署選択部分
    public function getDepartment()
    {
        $query = DB::table('m_belongs')
            ->select('belongs_id', 'belongs_name')
            ->where('del_flg', '=', '0')
            ->orderBy('sort_order', 'asc')
            ->get();

        return $query;
    }
    
    //ユーザー追加画面の役職選択部分
    public function getPosition()
    {
        $query = DB::table('m_position')
            ->select('position_id', 'position_name')
            ->get();

        return $query;
    }

    //未承認画面へのリンク表示判定
    public function getReviewerFlg()
    {
        $query = DB::table("t_user")
            ->where("user_id", "=", session()->get('user_id'))
            ->select("reviewer_flg", 'guest_reviewer_flg')
            ->first();

        return $query;
    }

    //ユーザー追加
    public function createUser(Request $request)
    {
        DB::beginTransaction();

        if (is_null($request->guest)) {
            $guest = 0;
        } else {
            $guest = 1;
        }
        if (is_null($request->condition)) {
            $condition = 0;
        } else {
            $condition = 1;
        }

        if ($request->authority == 'admin' || $request->authority == 'recruitment') {
            $guest = 2;
        }

        try {

            DB::table('t_user')->insert([
                [
                    'mail_address' => $request->mail,
                    'password' => Hash::make($request->password),
                    'guest_flg' => $guest,
                    'engineer_flg' => $request->occupation,
                    'condition_flg' => $condition,
                    'member_id' => $request->member_id
                ]
            ]);
            $user_id = DB::table('t_user')
                ->select('user_id')
                ->max('user_id');

            DB::table('t_user_basic')->insert([
                [
                    'user_id' => $user_id,
                    'last_name' => $request->lastname,
                    'first_name' => $request->firstname,
                    'last_name_kana' => $request->lastname_kana,
                    'first_name_kana' => $request->firstname_kana,
                    'initial' => $request->initial
                ]
            ]);

            DB::table('r_user_belongs')->insert([
                [
                    'user_id' => $user_id,
                    'belongs_id' => $request->belongs,
                    'create_date' => date("Y-m-d H:i:s"),
                    'create_id' => session('user_id'),
                ]
            ]);
            DB::table('r_user_authority')->insert([
                [
                    'user_id' => $user_id,
                    'auth_name' => $request->authority,
                    'create_date' => date("Y-m-d H:i:s"),
                    'create_id' => session('user_id'),
                ]
            ]);
            DB::table('r_user_position')->insert([
                [
                    'user_id' => $user_id,
                    'position_id' => $request->position,
                    'create_date' => date("Y-m-d H:i:s"),
                    'create_id' => session('user_id'),
                ]
            ]);

            DB::table('t_user_contract')->insert([
                [
                    'user_id' => $user_id,
                    'matter_flg' => '0',
                    'create_date' => date("Y-m-d H:i:s"),
                    'create_id' => session('user_id'),
                ]
            ]);
            DB::table('t_user_contract')->insert([
                [
                    'user_id' => $user_id,
                    'matter_flg' => '1',
                    'create_date' => date("Y-m-d H:i:s"),
                    'create_id' => session('user_id'),
                ]
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', 'ユーザーの追加に失敗しました\n' . $e->getMessage());
        }

        return redirect()->route('list');
    }

    //レジュメ一覧画面表示用ユーザーデータ取得
    public function getUserlist()
    {
        $user = DB::table('r_user_authority as rua')
            ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'rua.user_id')
            ->leftjoin('t_user as tu', 'tu.user_id', '=', 'rub.user_id')
            ->where('rua.user_id', session('user_id'))
            ->select('rua.user_id', 'rua.auth_name', 'rub.belongs_id', 'tu.engineer_flg')
            ->first();

        //admin
        if ($user->auth_name == 'admin') {
            $query = DB::table('t_user_basic as tub')
                ->select('tub.user_id', 'tub.last_name', 'tub.first_name', 'mb.belongs_name', 'rua.auth_name', 'mp.position_name', 'tu.engineer_flg', DB::raw("DATE_FORMAT(MAX(tuc.modify_date), '%Y/%m/%d') as modify_date"))
                ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'tub.user_id')
                ->leftjoin('m_belongs as mb', 'mb.belongs_id', '=', 'rub.belongs_id')
                ->leftjoin('r_user_authority as rua', 'rua.user_id', '=', 'tub.user_id')
                ->leftjoin('t_user as tu', 'tu.user_id', '=', 'rua.user_id')
                ->leftjoin('r_user_position as rup', 'rup.user_id', '=', 'tu.user_id')
                ->leftJoin('m_position as mp', 'mp.position_id', '=', 'rup.position_id')
                ->leftJoin('t_user_career as tuc', 'tu.user_id', '=', 'tuc.user_id')
                ->where('tu.del_flg', '=', '0')
                ->groupBy('tub.user_id')
                ->orderby('tu.engineer_flg', 'asc')
                ->orderby('mb.belongs_id', 'asc')
                ->orderby('rua.auth_name', 'asc')
                ->get();
        }
        //sales
        else if ($user->auth_name == 'sales') {
            $query = DB::table('t_user_basic as tub')
                ->select('tub.user_id', 'tub.last_name', 'tub.first_name', 'mb.belongs_name', 'rua.auth_name', 'mp.position_name', 'tu.engineer_flg', DB::raw("DATE_FORMAT(MAX(tuc.modify_date), '%Y/%m/%d') as modify_date"))
                ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'tub.user_id')
                ->leftjoin('m_belongs as mb', 'mb.belongs_id', '=', 'rub.belongs_id')
                ->leftjoin('r_user_authority as rua', 'rua.user_id', '=', 'tub.user_id')
                ->leftjoin('t_user as tu', 'tu.user_id', '=', 'rua.user_id')
                ->leftjoin('r_user_position as rup', 'rup.user_id', '=', 'tu.user_id')
                ->leftJoin('m_position as mp', 'mp.position_id', '=', 'rup.position_id')
                ->leftJoin('t_user_career as tuc', 'tu.user_id', '=', 'tuc.user_id')
                ->where('rua.auth_name', '!=', 'sales')
                ->where('rua.auth_name', '!=', 'admin')
                ->where('rua.auth_name', '!=', 'recruitment')
                ->where('tu.del_flg', '=', '0')
                ->groupBy('tub.user_id')
                ->orderby('tu.engineer_flg', 'asc')
                ->orderby('mb.belongs_id', 'asc')
                ->orderby('rua.auth_name', 'asc')
                ->get();
        }
        //recruitment
        else if ($user->auth_name == 'recruitment') {
            $query = DB::table('t_user_basic as tub')
                ->select('tub.user_id', 'tub.last_name', 'tub.first_name', 'mb.belongs_name', 'rua.auth_name', 'mp.position_name', 'tu.engineer_flg', DB::raw("DATE_FORMAT(MAX(tuc.modify_date), '%Y/%m/%d') as modify_date"))
                ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'tub.user_id')
                ->leftjoin('m_belongs as mb', 'mb.belongs_id', '=', 'rub.belongs_id')
                ->leftjoin('r_user_authority as rua', 'rua.user_id', '=', 'tub.user_id')
                ->leftjoin('t_user as tu', 'tu.user_id', '=', 'rua.user_id')
                ->leftjoin('r_user_position as rup', 'rup.user_id', '=', 'tu.user_id')
                ->leftJoin('m_position as mp', 'mp.position_id', '=', 'rup.position_id')
                ->leftJoin('t_user_career as tuc', 'tu.user_id', '=', 'tuc.user_id')
                ->where('rua.auth_name', '!=', 'sales')
                ->where('rua.auth_name', '!=', 'admin')
                ->where('rua.auth_name', '=', 'manager')
                ->orwhere('tu.guest_flg', '=', '1')
                ->where('tu.del_flg', '=', '0')
                ->groupBy('tub.user_id')
                ->orderby('tu.engineer_flg', 'asc')
                ->orderby('mb.belongs_id', 'asc')
                ->orderby('rua.auth_name', 'asc')
                ->get();
        }
        //member
        else if ($user->auth_name == 'member') {
            $query = DB::table('t_user_basic as tub')
                ->select('tub.user_id', 'tub.last_name', 'tub.first_name', 'mb.belongs_name', 'rua.auth_name', 'mp.position_name', 'tu.engineer_flg', DB::raw("DATE_FORMAT(MAX(tuc.modify_date), '%Y/%m/%d') as modify_date"))
                ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'tub.user_id')
                ->leftjoin('m_belongs as mb', 'mb.belongs_id', '=', 'rub.belongs_id')
                ->leftjoin('r_user_authority as rua', 'rua.user_id', '=', 'tub.user_id')
                ->leftjoin('r_user_position as rup', 'rup.user_id', '=', 'tub.user_id')
                ->leftJoin('m_position as mp', 'mp.position_id', '=', 'rup.position_id')
                ->leftjoin('t_user as tu', 'tu.user_id', '=', 'rua.user_id')
                ->leftJoin('t_user_career as tuc', 'tu.user_id', '=', 'tuc.user_id')
                ->where('tub.user_id', $user->user_id)
                ->get();
        } else if ($user->auth_name == "manager") {
            $query = DB::select(
                "WITH RECURSIVE manager_table AS (
                    SELECT * FROM m_belongs WHERE belongs_id = $user->belongs_id
                UNION ALL
                    SELECT m_belongs.*
                    FROM m_belongs, manager_table
                    WHERE m_belongs.parent_id = manager_table.belongs_id)
                SELECT tub.user_id, tub.last_name, tub.first_name, mb.belongs_name, mb.belongs_id, rua.auth_name, mp.position_name, tu.engineer_flg, DATE_FORMAT(MAX(tuc.modify_date), '%Y/%m/%d') as modify_date
                FROM t_user_basic as tub
                left join r_user_belongs as rub on rub.user_id = tub.user_id
                left join m_belongs as mb on mb.belongs_id = rub.belongs_id
                left join manager_table as mt on mt.belongs_id = rub.belongs_id
                left join r_user_authority as rua on rua.user_id = tub.user_id
                left join t_user as tu on tu.user_id = tub.user_id
                left join r_user_position as rup on rup.user_id = tub.user_id
                left join m_position as mp on mp.position_id = rup.position_id
                left join t_user_career as tuc on tu.user_id = tuc.user_id
                where mt.belongs_id is not null
                and tu.del_flg = '0'
                and (tu.guest_flg = 1
                or tu.engineer_flg = $user->engineer_flg)
                group by tub.user_id
                order by mb.belongs_id, rua.auth_name asc"
            );

            $query = collect($query);
        }
        //idと権限はセッションに値を持たせておく
        return $query;
    }

    /* 未承認ユーザー一覧画面表示用データ取得 */
    public function getunApprovedUserList()
    {
        $user = DB::table('r_user_belongs as rub')
            ->leftjoin('r_user_position as rup', 'rup.user_id', '=', 'rub.user_id')
            ->leftjoin('t_user as tu', 'tu.user_id', '=', 'rub.user_id')
            ->where('rub.user_id', '=', session('user_id'))
            ->select('rub.belongs_id', 'rup.position_id', 'tu.engineer_flg')
            ->first();

        $query = DB::select(
            "WITH RECURSIVE manager_table AS (
                SELECT * FROM m_belongs WHERE belongs_id = $user->belongs_id
            UNION ALL
                SELECT mb.*
                FROM m_belongs as mb, manager_table as mt
                WHERE mb.parent_id = mt.belongs_id)
            SELECT tub.user_id, tub.last_name, tub.first_name, mb.belongs_name, mb.belongs_id, rua.auth_name, mp.position_name
            FROM t_user_basic as tub
            left join r_user_belongs as rub on rub.user_id = tub.user_id
            left join m_belongs as mb on mb.belongs_id = rub.belongs_id
            left join manager_table as mt on mt.belongs_id = rub.belongs_id
            left join r_user_authority as rua on rua.user_id = tub.user_id
            left join t_user as tu on tu.user_id = tub.user_id
            left join r_user_position as rup on rup.user_id = tub.user_id
            left join m_position as mp on mp.position_id = rup.position_id
            where mt.belongs_id is not null
            and rup.position_id < $user->position_id
            and tu.reviewee_flg = 1
            and tu.del_flg = '0'
            or (tu.guest_flg = 1
            and tu.engineer_flg = $user->engineer_flg
            and tu.reviewee_flg = 1)
            order by mb.belongs_id, rua.auth_name asc"
        );

        $query = collect($query);

        return $query;
    }

    /* ユーザー情報編集画面取得 */
    public function getUser($user_id)
    {
        $query = DB::table('t_user as tu')
            ->leftjoin('t_user_basic as tub', 'tub.user_id', '=', 'tu.user_id')
            ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'tu.user_id')
            ->leftjoin('m_belongs as mb', 'mb.belongs_id', '=', 'rub.belongs_id')
            ->leftjoin('r_user_authority as rua', 'rua.user_id', '=', 'tub.user_id')
            ->leftjoin('r_user_position as rup', 'rup.user_id', '=', 'tub.user_id')
            ->where('tu.user_id', $user_id)
            ->select('tu.user_id', 'tu.mail_address', 'tu.password', 'tu.guest_flg', 'tu.engineer_flg', 'tu.condition_flg', 'tub.last_name', 'tub.first_name', 'tub.last_name_kana', 'tub.first_name_kana', 'tub.initial', 'rub.belongs_id', 'mb.belongs_name', 'rua.auth_name', 'rup.position_id', 'member_id')
            ->get();

        return $query;
    }

    public function getDisplayedNum($request)
    {
        if (isset($request->display_select)) {
            $displayed_num = $request->display_select;
        } else {
            $displayed_num = 10;
        }
        return $displayed_num;
    }

    /* ユーザー情報編集 */
    public function updateUser(Request $request)
    {
        DB::beginTransaction();

        try {

            if (is_null($request->guest)) {
                $guest = 0;
            } else {
                $guest = 1;
            }
            if (is_null($request->condition)) {
                $condition = 0;
            } else {
                $condition = 1;
            }
            /* 管理・採用権限はゲストフラグ2にする */
            if ($request->authority == 'admin' || $request->authority == 'recruitment') {
                $guest = 2;
            }

            DB::table('t_user')
                ->where('user_id', $request->user_id)
                ->update(
                    [
                        'mail_address' => $request->mail,
                        'guest_flg' => $guest,
                        'engineer_flg' => $request->occupation,
                        'condition_flg' => $condition,
                        'member_id' => $request->member_id,
                        'modify_date' => date("Y-m-d H:i:s"),
                        'modify_id' => session('user_id'),
                    ]
                );

            if ($request->password != null) {
                DB::table('t_user')
                    ->where('user_id', $request->user_id)
                    ->update(
                        [
                            'password' => Hash::make($request->password),
                        ]
                    );
            }

            DB::table('t_user_basic')
                ->where('user_id', $request->user_id)
                ->update(
                    [
                        'last_name' => $request->lastname,
                        'first_name' => $request->firstname,
                        'last_name_kana' => $request->lastname_kana,
                        'first_name_kana' => $request->firstname_kana,
                        'initial' => $request->initial,
                        'modify_date' => date("Y-m-d H:i:s"),
                        'modify_id' => session('user_id'),
                    ]
                );

            $belongs_id = DB::table('m_belongs')
                ->select('belongs_id')
                ->where('belongs_name', $request->belongs)
                ->max('belongs_id');

            DB::table('r_user_belongs')
                ->where('user_id', $request->user_id)
                ->update(
                    [
                        'belongs_id' => $request->belongs,
                        'modify_date' => date("Y-m-d H:i:s"),
                        'modify_id' => session('user_id'),
                    ]
                );
            DB::table('r_user_authority')
                ->where('user_id', $request->user_id)
                ->update(
                    [
                        'auth_name' => $request->authority,
                        'modify_date' => date("Y-m-d H:i:s"),
                        'modify_id' => session('user_id'),
                    ]
                );
            DB::table('r_user_position')
                ->where('user_id', $request->user_id)
                ->update(
                    [
                        'position_id' => $request->position,
                        'create_date' => date("Y-m-d H:i:s"),
                        'create_id' => session('user_id'),
                    ]
                );
            DB::commit();
        } catch (\Exception $e) {
            session()->flash('flash_message', '編集に失敗しました\n' . $e->getMessage());
            DB::rollback();
        }
        return;
    }

    /* ユーザー削除 */
    public function deleteUser($user_id)
    {
        DB::beginTransaction();

        try {
            DB::table('t_user')->where('user_id', '=', $user_id)->update(['del_flg' => 1]);
            DB::commit();
            session()->flash('success_message', '削除しました');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '削除に失敗しました\n' . $e->getMessage());
        }
        return;
    }



    /*絞り込み機能*/
    public function filter_user($query, $request)
    {
        //Cookieパターン
        // $engineer_flg = json_decode(Cookie::get("filter_engineer_flg"));
        $engineer_flg = $request->filter_engineer_flg;

        if (isset($engineer_flg)) {
            $filtered = $query->whereIn("engineer_flg", $engineer_flg);
            return $filtered;
        }

        return $query;
    }
}
