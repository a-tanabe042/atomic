<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Skill extends Model
{

    use HasFactory;

    /**
     * select skill　list
     * @return Collection
     */
    public function getSkillList(String $classId): Collection
    {
        if (in_array($classId, [1, 2, 3, 4])) {
            $skill = DB::table('m_skills')
                ->select('skill_id', 'skill_name')
                ->where('class_id', $classId)
                ->orderBy('skill_name', 'asc')
                ->get();
        } else {
            $skill = DB::table('m_skills')
                ->select('skill_id', 'skill_name', 'sub_class_name')
                ->where('class_id', $classId)
                ->orderBy('sub_class_name', 'asc')
                ->get();
        }

        return $skill;
    }

/**
 * Insert new skill
 * @param Request $request
 */
public function addSkill(Request $request): void
{
    $skillCategory = config('skills.skillCategory.classId')[$request->class_id];

    DB::beginTransaction();

    try {
        $count = count($request->skill_name);

        for ($i = 0; $i < $count; $i++) {
            $skillData = [
                'class_id' => $request->class_id,
                'skill_name' => $request->skill_name[$i],
                'class_name' => $skillCategory['category']
            ];

            if (isset($request->sub_class_name)) {
                $subClassId = $this->getSubClassId($request->class_id, $request->sub_class_name[$i]);

                $skillData['sub_class_name'] = $request->sub_class_name[$i];
                $skillData['sub_class_id'] = $subClassId->sub_class_id;
            }

            DB::table('m_skills')->insert($skillData);
        }

        DB::commit();
        session()->flash('success_message', '追加しました。');
    } catch (\Exception $e) {
        DB::rollback();
        session()->flash('flash_message', '追加に失敗しました。' . $e->getMessage());
    }
}

/**
 * Get SubClassId
 * @param String $classId
 * @param String $subClassName
 * @return object
 */
private function getSubClassId(String $classId, String $subClassName): object
{
    $subClassId = DB::table('m_skills')
        ->select('sub_class_id')
        ->where('class_id', '=', $classId)
        ->where('sub_class_name', '=', $subClassName)
        ->first();

    if (is_null($subClassId)) {
        $subClassId = DB::table('m_skills')
            ->select('sub_class_id')
            ->where('class_id', '=', $classId)
            ->orderBy('sub_class_id', 'desc')
            ->first();
        $subClassId->sub_class_id = $subClassId->sub_class_id + 1;
    }

    return $subClassId;
}


    /**
     * update skill
     * @param Request $request
     * @param String $skill_id
     */
    public function updateSkill(Request $request,String $skill_id): void
    {
        DB::beginTransaction();

        $skill =[
            'skill_name' => $request->skill_name,
            'modify_date' => Carbon::now()
        ];

        try {
            if ($request->sub_class_name) 
                $skill['sub_class_name'] = $request->sub_class_name;

            DB::table('m_skills')
                ->where('skill_id', '=', $request->skill_id)
                ->update($skill);

            DB::commit();

            session()->flash('success_message', '編集が完了しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '編集に失敗しました\n' . $e->getMessage());
        }

        return;
    }

    /**
     * delete skill
     * @param Request $skill_id
     */
    public function deleteSkill(String $skill_id): void
    {
        DB::beginTransaction();

        try {

            $skill = DB::table('m_skills')
                ->select('skill_name')
                ->where('skill_id', '=', $skill_id)
                ->get();
            echo $skill;

            DB::table('m_skills')->where('skill_id', '=', $skill_id)->delete();
            DB::commit();

            session()->flash('success_message', $skill[0]->skill_name . 'を削除しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '削除に失敗しました。\n' . $e->getMessage());
        }
        return;
    }
}
