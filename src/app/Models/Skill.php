<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Illuminate\Support\Collection;
use Carbon\Carbon;

class Skill extends Model
{
    use HasFactory;

    /**
     * select LanguageList
     * @return Collection
     */
    public function getLanguageList(): Collection
    {
        $skill = DB::table('m_skills')
            ->select('skill_id', 'skill_name')
            ->where('class_id', 1)
            ->orderBy('skill_name', 'asc')
            ->get();

        return $skill;
    }

    /**
     * insert Language
     * @param Request $request
     */
    public function addLanguage(Request $request): void
    {
        DB::beginTransaction();

        try {
            $count = count($request->skill_name);

            for ($i = 0; $i < $count; $i++) {
                DB::table('m_skills')->insert([
                    [
                        'class_id' => 1,
                        'skill_name' => $request->skill_name[$i],
                        'class_name' => "言語",
                    ]
                ]);
            }
            DB::commit();
            session()->flash('success_message', '追加しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '追加に失敗しました。' . $e->getMessage());
        }
        return;
    }



    /**
     * select DbList
     * @return Collection
     */
    public function getDbList(): Collection
    {
        $skill = DB::table('m_skills')
            ->select('skill_id', 'skill_name')
            ->where('class_id', 2)
            ->orderBy('skill_name', 'asc')
            ->get();

        return $skill;
    }

    /**
     * insert Db
     * @param Request $request
     */
    public function addDb(Request $request): void
    {
        DB::beginTransaction();

        try {
            $count = count($request->skill_name);

            for ($i = 0; $i < $count; $i++) {
                DB::table('m_skills')->insert([
                    [
                        'class_id' => 2,
                        'skill_name' => $request->skill_name[$i],
                        'class_name' => "DB",
                    ]
                ]);
            }
            DB::commit();
            session()->flash('success_message', '追加しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '追加に失敗しました\n' . $e->getMessage());
        }
        return;
    }


    /**
     * select OsList
     * @return Collection
     */
    public function getOsList(): Collection
    {
        $skill = DB::table('m_skills')
            ->select('skill_id', 'skill_name')
            ->where('class_id', 3)
            ->orderBy('skill_name', 'asc')
            ->get();

        return $skill;
    }

    /**
     * insert Os
     * @param Request $request
     */
    public function addOs(Request $request): void
    {
        DB::beginTransaction();

        try {
            $count = count($request->skill_name);

            for ($i = 0; $i < $count; $i++) {
                DB::table('m_skills')->insert([
                    [
                        'class_id' => 3,
                        'skill_name' => $request->skill_name[$i],
                        'class_name' => "OS",
                    ]
                ]);
            }
            DB::commit();
            session()->flash('success_message', '追加しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '追加に失敗しました\n' . $e->getMessage());
        }
        return;
    }

    /**
     * select MiddlewareList
     * @return Collection
     */
    public function getMiddlewareList(): Collection
    {
        $skill = DB::table('m_skills')
            ->select('skill_id', 'skill_name')
            ->where('class_id', 4)
            ->orderBy('skill_name', 'asc')
            ->get();

        return $skill;
    }

    /**
     * insert Middleware
     * @param Request $request
     */
    public function addMiddleware(Request $request): void
    {
        DB::beginTransaction();
        try {

            $count = count($request->skill_name);

            for ($i = 0; $i < $count; $i++) {
                DB::table('m_skills')->insert([
                    [
                        'class_id' => 4,
                        'skill_name' => $request->skill_name[$i],
                        'class_name' => "ミドルウェア",
                    ]
                ]);
            }
            DB::commit();
            session()->flash('success_message', '追加しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '追加に失敗しました\n' . $e->getMessage());
        }
        return;
    }

    /**
     * select PlatformList
     * @return Collection
     */
    public function getPlatformList(): Collection
    {
        $skill = DB::table('m_skills')
            ->select('skill_id', 'skill_name', 'sub_class_name')
            ->where('class_id', 5)
            ->orderBy('sub_class_name', 'asc')
            ->get();

        return $skill;
    }

    /**
     * insert Platform
     * @param Request $request
     */
    public function addPlatform(Request $request): void
    {
        DB::beginTransaction();

        try {
            $count = count($request->skill_name);

            for ($i = 0; $i < $count; $i++) {
                $sub_class_id[$i] = DB::table('m_skills')
                    ->select('sub_class_id')
                    ->where('sub_class_name', '=', $request->sub_class_name[$i])
                    ->where('class_id', '=', 5)
                    ->first();

                if (is_null($sub_class_id[$i])) {
                    $sub_class_id[$i] = DB::table('m_skills')
                        ->select('sub_class_id')
                        ->where('class_id', '=', 5)
                        ->orderBy('sub_class_id', 'desc')
                        ->first();
                    $sub_class_id[$i]->sub_class_id = $sub_class_id[$i]->sub_class_id + 1;
                }

                DB::table('m_skills')->insert([
                    [
                        'class_id' => 5,
                        'skill_name' => $request->skill_name[$i],
                        'class_name' => "プラットフォーム",
                        'sub_class_name' => $request->sub_class_name[$i],
                        'sub_class_id' => $sub_class_id[$i]->sub_class_id,
                    ]
                ]);
            }
            DB::commit();
            session()->flash('success_message', '追加しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '追加に失敗しました\n' . $e->getMessage());
        }
        return;
    }

    /**
     * select FrameworkList
     * @return Collection
     */
    public function getFrameworkList(): Collection
    {
        $skill = DB::table('m_skills')
            ->select('skill_id', 'skill_name', 'sub_class_name')
            ->where('class_id', 6)
            ->orderBy('sub_class_name', 'asc')
            ->orderBy('skill_name', 'asc')
            ->get();

        return $skill;
    }

    /**
     * insert Framework
     * @param Request $request
     */
    public function addFramework(Request $request): void
    {
        DB::beginTransaction();

        try {

            $count = count($request->skill_name);

            for ($i = 0; $i < $count; $i++) {
                $sub_class_id[$i] = DB::table('m_skills')
                    ->where('sub_class_name', '=', $request->sub_class_name[$i])
                    ->where('class_id', '=', 6)
                    ->select('sub_class_id')
                    ->first();

                if (is_null($sub_class_id[$i])) {
                    $sub_class_id[$i] = DB::table('m_skills')
                        ->where('class_id', '=', 6)
                        ->orderBy('sub_class_id', 'desc')
                        ->select('sub_class_id')
                        ->first();
                    $sub_class_id[$i]->sub_class_id = $sub_class_id[$i]->sub_class_id + 1;
                }

                DB::table('m_skills')->insert([
                    [
                        'class_id' => 6,
                        'skill_name' => $request->skill_name[$i],
                        'class_name' => "Framework",
                        'sub_class_name' => $request->sub_class_name[$i],
                        'sub_class_id' => $sub_class_id[$i]->sub_class_id,
                    ]
                ]);
            }
            DB::commit();
            session()->flash('success_message', '追加しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '追加に失敗しました\n' . $e->getMessage());
        }
        return;
    }

    /**
     * select OthersList
     * @return Collection
     */
    public function getOthersList(): Collection
    {
        $skill = DB::table('m_skills')
            ->select('skill_id', 'skill_name', 'sub_class_name')
            ->where('class_id', 7)
            ->orderBy('sub_class_name', 'asc')
            ->orderBy('skill_name', 'asc')
            ->get();

        return $skill;
    }

    /**
     * insert Others
     * @param Request $request
     */
    public function addOthers(Request $request): void
    {
        DB::beginTransaction();
        try {
            $count = count($request->skill_name);

            for ($i = 0; $i < $count; $i++) {
                $sub_class_id[$i] = DB::table('m_skills')
                    ->select('sub_class_id')
                    ->where('class_id', '=', 7)
                    ->where('sub_class_name', '=', $request->sub_class_name[$i])
                    ->first();

                if (is_null($sub_class_id[$i])) {
                    $sub_class_id[$i] = DB::table('m_skills')
                        ->select('sub_class_id')
                        ->where('class_id', '=', 7)
                        ->orderBy('sub_class_id', 'desc')
                        ->first();
                    $sub_class_id[$i]->sub_class_id = $sub_class_id[$i]->sub_class_id + 1;
                }
                DB::table('m_skills')->insert([
                    [
                        'class_id' => 7,
                        'skill_name' => $request->skill_name[$i],
                        'class_name' => "その他",
                        'sub_class_name' => $request->sub_class_name[$i],
                        'sub_class_id' => $sub_class_id[$i]->sub_class_id,
                    ]
                ]);
            }
            DB::commit();
            session()->flash('success_message', '追加しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '追加に失敗しました\n' . $e->getMessage());
        }
        return;
    }


    /**
     * update Skill
     * @param Request $request
     */
    public function updateSkill(Request $request) :void
    {
        DB::beginTransaction();

        try {

            if ($request->sub_class_name) {
                $sub_class_name = $request->sub_class_name;
            } else {
                $sub_class_name = null;
            }

            DB::table('m_skills')
                ->where('skill_id', '=', $request->skill_id)
                ->update(
                    [
                        'skill_name' => $request->skill_name,
                        'sub_class_name' => $sub_class_name,
                        'modify_date' => Carbon::now()
                    ]
                );

            DB::commit();
            session()->flash('success_message', '編集が完了しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '編集に失敗しました\n' . $e->getMessage());
        }

        return;
    }

    /**
     * delete Skill
     * @param String $skill_id
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
