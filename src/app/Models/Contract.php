<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class Contract extends Model
{
    use HasFactory;

    /**
     * select ContractList
     * @return Collection
     */
    public function getContractList(): Collection
    {
        $user = DB::table('r_user_authority as rua')
            ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'rua.user_id')
            ->where('rua.user_id', session('user_id'))
            ->select('rua.user_id', 'rua.auth_name', 'rub.belongs_id')
            ->first();

        if (session('auth_name') == 'admin' || session('auth_name') == 'sales') {

            $users = DB::table('t_user_contract as tuc')
                ->leftjoin('r_user_belongs as rub', 'rub.user_id', '=', 'tuc.user_id')
                ->leftjoin('m_belongs as mb', 'mb.belongs_id', '=', 'rub.belongs_id')
                ->leftjoin('t_user as tu', 'tu.user_id', '=', 'tuc.user_id')
                ->leftjoin('t_user_basic as tub', 'tub.user_id', '=', 'tuc.user_id')
                ->leftjoin('r_user_authority as rua', 'rua.user_id', '=', 'tub.user_id')
                ->leftjoin('r_user_position as rup', 'rup.user_id', '=', 'tu.user_id')
                ->leftJoin('m_position as mp', 'mp.position_id', '=', 'rup.position_id')
                ->whereIn('tu.engineer_flg', [0, 1])
                ->where('tuc.matter_flg', 0)
                ->select('tuc.user_id', 'mb.belongs_name', 'tub.last_name', 'tub.first_name', 'tuc.contract_name', 'tuc.end_month', 'tuc.contract_status', 'tu.engineer_flg', 'mp.position_name')
                ->orderby('tu.engineer_flg', 'asc')
                ->orderby('mb.belongs_id', 'asc')
                ->orderby('rua.auth_name', 'asc')
                ->get();
        } else if (session('auth_name') == 'manager') {
            $users = DB::select("WITH RECURSIVE manager_table AS (
                SELECT * FROM m_belongs WHERE belongs_id = $user->belongs_id
                UNION ALL
                SELECT m_belongs.* FROM m_belongs, manager_table WHERE m_belongs.parent_id = manager_table.belongs_id)
                SELECT tub.user_id, tub.last_name, tub.first_name, mt.belongs_name, mt.belongs_id, tuc.contract_name,tuc.end_month,tuc.contract_status,tu.engineer_flg,mp.position_name
                FROM t_user_basic as tub
                left join r_user_belongs as rub on rub.user_id = tub.user_id
                left join manager_table as mt on mt.belongs_id = rub.belongs_id
                left join r_user_authority as rua on rua.user_id = tub.user_id
                left join t_user as tu on tu.user_id = tub.user_id
                left join t_user_contract as tuc on tuc.user_id = tub.user_id
                left join r_user_position as rup on rup.user_id = tub.user_id
                left join m_position as mp on mp.position_id = rup.position_id
                where mt.belongs_id is not null
                and tu.del_flg = '0'
                and tuc.matter_flg = '0'
                order by rub.belongs_id, rua.auth_name asc");

            $users = collect($users);
        }

        return $users;
    }

    /**
     * filter user
     * @param mixed $query
     * @param Request $request
     * @return mixed
     */
    public function filter_user(mixed $query, Request $request): mixed
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

    /**
     * display pagination
     * @param Request $request
     * @return mixed
     */
    public function getDisplayedNum(Request $request): mixed
    {
        if (isset($request->display_select)) {
            $displayed_num = $request->display_select;
            Log::debug(print_r($displayed_num, true));
        } else {
            $displayed_num = 10;
        }
        return $displayed_num;
    }

    /**
     * select ContractUser
     * @param String $user_id
     * @return Collection
     */
    public function getContractUser(String $user_id): Collection
    {
        $user = DB::table('t_user_basic as tub')
            ->leftjoin('t_user_contract as tuc', 'tuc.user_id', '=', 'tub.user_id')
            ->where('tub.user_id', $user_id)
            ->where('tuc.matter_flg', 0)
            ->select('tub.user_id', 'tub.last_name', 'tub.first_name', 'tuc.continuation_flg', 'tuc.continuation_text', 'tuc.modify_date')
            ->get();

        return $user;
    }

    /**
     * select ContractDetail
     * @param String $user_id
     * @return Collection
     */
    public function getContractDetail(String $user_id): Collection
    {
        $user = DB::table('t_user_contract as tuc')
            ->leftjoin('t_user_basic as tub', 'tub.user_id', '=', 'tuc.sales_person_id')
            ->where('tuc.user_id', $user_id)
            ->where('tuc.modify_date', '>=', date('Y-m-d H:i:s', time() - 86400 * 182))
            ->orderByDesc('tuc.modify_date')
            ->select('tuc.user_id', 'tub.last_name', 'tub.first_name', 'tuc.contract_name', 'tuc.working_form', 'tuc.contract_cycle', 'tuc.contract_status', 'tuc.continuation_month', 'tuc.end_month', 'tuc.matter_flg', 'tuc.continuation_flg', 'tuc.continuation_text', 'tuc.sales_person_id')
            ->get();

        return $user;
    }

    /**
     * select SalesUser
     * @return Collection
     */
    public function getSalesUser(): Collection
    {
        $sales = DB::table('t_user_basic as tub')
            ->leftjoin('r_user_authority as rua', 'rua.user_id', '=', 'tub.user_id')
            ->where('rua.auth_name', "sales")
            ->select('tub.user_id', 'tub.last_name', 'tub.first_name')
            ->get();

        return $sales;
    }

    /**
     * update Contract
     * @param Request $request
     * @param String $user_id
     */
    public function updateContract(Request $request, String $user_id): void
    {
        DB::beginTransaction();
        try {

            if ($request->continuation_flg == 0) {
                $continuation_text = '';
            } else if ($request->continuation_flg == 1 || $request->continuation_flg == 2) {
                $continuation_text = $request->continuation_text;
            }

            if ($request->contract_status == 0) {
                $continuation_month = $request->continuation_year . $request->continuation_month;
                $end_month = '';
            } else if ($request->contract_status == 1) {
                $continuation_month = '';
                $end_month = $request->end_year . $request->end_month;
            }

            DB::table('t_user_contract as tuc')
                ->where('tuc.user_id', $user_id)
                ->where('tuc.matter_flg', 0)
                ->update([
                    'contract_name' => $request->contract_name,
                    'working_form' => $request->working_form,
                    'contract_cycle' => $request->contract_cycle,
                    'contract_status' => $request->contract_status,
                    'sales_person_id' => $request->sales_person_id,
                    'continuation_month' => $continuation_month,
                    'end_month' => $end_month,
                    'continuation_flg' => $request->continuation_flg,
                    'continuation_text' => $continuation_text,
                    'continuation_modify_date' => date("Y-m-d H:i:s"),
                    'modify_date' => date("Y-m-d H:i:s"),
                    'modify_id' => session('user_id'),
                ]);

            DB::table('t_user_contract as tuc')
                ->where('tuc.user_id', $user_id)
                ->where('tuc.matter_flg', 1)
                ->update([
                    'contract_name' => $request->next_contract_name,
                    'working_form' => $request->next_working_form,
                    'contract_cycle' => $request->next_contract_cycle,
                    'contract_status' => $request->next_contract_status,
                    'sales_person_id' => $request->next_sales_person_id,
                    'continuation_month' => $request->next_continuation_year . $request->next_continuation_month,
                    'end_month' => $request->next_end_year . $request->next_end_month,
                    'continuation_modify_date' => date("Y-m-d H:i:s"),
                    'modify_date' => date("Y-m-d H:i:s"),
                    'modify_id' => session('user_id'),
                ]);

            DB::commit();
        } catch (\Exception $e) {
            session()->flash('flash_message', '編集に失敗しました\n' . $e->getMessage());
            DB::rollback();
        }
    }

    /**
     * update ContractFlg
     * @param String $user_id
     */
    public function updateContractFlg(String $user_id): void
    {
        DB::beginTransaction();
        try {

            DB::table('t_user_contract as tuc')
                ->where('tuc.user_id', $user_id)
                ->where('tuc.matter_flg', 0)
                ->update([
                    'matter_flg' => '2',
                    'modify_date' => date("Y-m-d H:i:s"),
                    'modify_id' => session('user_id'),
                ]);

            DB::table('t_user_contract as tuc')
                ->where('tuc.user_id', $user_id)
                ->where('tuc.matter_flg', 1)
                ->update([
                    'matter_flg' => '0',
                    'modify_date' => date("Y-m-d H:i:s"),
                    'modify_id' => session('user_id'),
                ]);

            DB::table('t_user_contract')->insert([
                [
                    'user_id' => $user_id,
                    'matter_flg' => '1',
                ]
            ]);

            DB::commit();
        } catch (\Exception $e) {
            session()->flash('flash_message', '編集に失敗しました\n' . $e->getMessage());
            DB::rollback();
        }
    }
}
