<?php

namespace App\Http\Controllers\Master;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\Skill;

class SkillController extends Controller
{

    public function __construct(private Skill $skill){}

    /**
     * スキルマスタ 表示
     * @return View|Factory
     */
    public function show(): View|Factory
    {
        return view('master.skill', ['skills' => config('skills.skillCategory.classId')]);
    }

    /**
     * スキル一覧 取得
     * @return View|Factory
     */
    public function index(Request $request): View|Factory
    {
        //class_idを入力値から取得
        $classId = $request->input('category');

        return view('master.skill.list', [
            'classId' => $classId,
            'skillCategory' => config('skills.skillCategory.classId')[$classId],
            'skillList' => $this->skill->getSkillList($classId)
        ]);
    }

    /**
     * スキル 登録
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function store(Request $request): Redirector|RedirectResponse
    {
        $this->skill->addSkill($request);

        return back();
    }

    /**
     * スキル 更新
     * @param Request $request
     * @param String $skill_id
     * @return RedirectResponse
     */
    public function update(Request $request,String $skill_id): RedirectResponse
    {
        // 指定されたIDのレコードを削除
        $this->skill->updateSkill($request,$skill_id);

        // 削除したら一覧画面にリダイレクト
        return back();
    }

    /**
     * スキル 削除
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy($skill_id): RedirectResponse
    {
        // 指定されたIDのレコードを削除
        $this->skill->deleteSkill($skill_id);

        return back();
    }
}
