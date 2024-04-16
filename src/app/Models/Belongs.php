<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;


class Belongs extends Model
{
    use HasFactory;

    /**
     * select BelongsList
     * @return Collection
     */
    public function getBelongsList(): Collection
    {
        return DB::table('m_belongs')
            ->select('belongs_id', 'belongs_name')
            ->where('del_flg', '=', '0')
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * insert Belongs
     * @param Request $request
     */
    public function addBelongs(Request $request): void
    {
        DB::beginTransaction();

        try {
            $count = count($request->belongs_name);

            for ($i = 0; $i < $count; $i++) {
                DB::table('m_belongs')->insert([
                    [
                        'belongs_name' => $request->belongs_name[$i],
                        'parent_id' => $request->belongs[$i],
                        'create_id' => session('user_id'),
                    ]
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '追加に失敗しました\n' . $e->getMessage());
        }
    }


    /**
     * delete Belongs
     * @param String $belongs_id
     */
    public function deleteBelongs(String $belongs_id): void
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
                session()->flash('flash_message', '親IDに設定している部署があるため削除できません');
            }
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '削除に失敗しました\n' . $e->getMessage());
        }
    }
}
