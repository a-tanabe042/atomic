<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Calendar extends Model
{
    use HasFactory;

    /* 一覧表示 */
    public function getCalendarList()
    {
        //calendarテーブルの情報取って来る
        $query = DB::table('t_user_calendar')
            ->select('calendar_title', 'calendar_text', 'calendar_date', 'calendar_member')
            ->where('calendar_date', '>=', Carbon::now())
            ->orderBy('calendar_date', 'asc')
            ->get();

        return $query;
    }

    public function getInviteMemberList()
    {
        $query = DB::table('t_user_calendar')
            ->select('calendar_member')
            ->where('calendar_date', '>=', Carbon::now())
            ->orderBy('calendar_date', 'asc')
            ->get();

        // var_dump($query);
        $namelist = [];

        //1行ずつ取り出し
        foreach ($query as $data) {
            //calendar_memberのidを,で区切って取り出す
            $id = explode(",", $data->calendar_member);
            $cnt = count($id);
            $cnt = $cnt - 1;
            $names = "";
            //idの数だけfor文で回して姓名取得
            for ($i = 0; $i < $cnt; $i++) {

                $user = DB::table('t_user_basic')
                    ->select('last_name', 'first_name')
                    ->where('user_id', '=', $id[$i])
                    ->get();
                foreach ($user as $name) {
                    if ($i === 0) {
                        $names = $name->last_name . " " . $name->first_name . "    ";
                    } else {
                        $names = $names . $name->last_name . " " . $name->first_name . "    ";
                    }
                }
            }
            array_push($namelist, $names);
        }

        return $namelist;
    }

    /* 関係者一覧取得 */
    public function getMemberList()
    {
        $query = DB::table('t_user_basic as tub')
            ->leftjoin('t_user as tu', 'tu.user_id', '=', 'tub.user_id')
            ->select('tu.engineer_flg', 'tub.last_name', 'tub.first_name', 'tub.user_id')
            ->whereIn('tu.engineer_flg', [0, 1, 2])
            ->where('tu.del_flg', '0')
            ->get();

        return $query;
    }




    /* データ保存 */
    public function saveCalendar(Request $request)
    {
        try {
            $invite = "";
            $count = count($request->invited_member);
            for ($i = 0; $i < $count; $i++) {
                // array_push($invite,$request->invited_member[$i]);
                if ($i === 0) {
                    $invite = $request->invited_member[$i] . ",";
                } else if ($i > 0) {
                    $invite = $invite . $request->invited_member[$i] . ",";
                }
            }

            DB::table('t_user_calendar')->insert([
                [
                    'calendar_title' => $request->calendar_title,
                    'calendar_date' => $request->calendar_date . " " . $request->calendar_time,
                    'calendar_text' => $request->calendar_text,
                    'calendar_member' => $invite
                ]
            ]);
            DB::commit();
            session()->flash('success_message', '追加しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '追加に失敗しました。' . $e->getMessage());
        }
        return;
    }
}
