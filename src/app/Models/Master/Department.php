<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Collection;
use Illuminate\Http\Request;

class Department extends Model
{
    use HasFactory;

    /**
     * select department list
     * @return Collection
     */
    public function getDepartmentList(): Collection
    {
        return DB::table('m_belongs')
            ->select('belongs_id', 'belongs_name', 'sort_order')
            ->orderBy('sort_order', 'asc')
            ->get();;
    }

    /**
     * insert department
     * @param array $addParams
     */
    public function addDepartment(array $insertParams): void
    {
        DB::beginTransaction();

        try {
            DB::table('m_belongs')->insert($insertParams);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '追加に失敗しました\n' . $e->getMessage());
        }
    }


    /**
     * delete department
     * @param String $belongs_id
     */
    public function deleteDepartment(String $belongs_id): void
    {
        DB::beginTransaction();
        try {
            $array = DB::table('m_belongs')
                ->select('belongs_id')
                ->where('parent_id', '=', $belongs_id)
                ->first();

            if ($array == null) {
                DB::table('m_belongs')->where('belongs_id', $belongs_id)->delete();
                DB::commit();
                session()->flash('success_message', '削除しました');
            } else {
                session()->flash('flash_message', 'この部署を親とする子部署があるため削除できません');
            }
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '削除に失敗しました\n' . $e->getMessage());
        }
    }
}
