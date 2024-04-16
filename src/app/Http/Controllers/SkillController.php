<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{

    public function __construct(private Skill $skill){}

    /**
     * 言語 取得
     * @return View|Factory
     */
    public function indexLanguage(Request $request): View|Factory
    {
        $languageList = $this->skill->getLanguageList();

        return view('skill.language', compact('languageList'));
    }

    /**
     * 言語 登録
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function addLanguage(Request $request): Redirector|RedirectResponse
    {
        $this->skill->addLanguage($request);

        return redirect()->route('language');
    }


    /**
     * DB 取得
     * @return View|Factory
     */
    public function indexDb(): View|Factory
    {
        $dbList = $this->skill->getDbList();

        return view('skill.db', compact('dbList'));
    }

    /**
     * DB 登録
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function addDb(Request $request): Redirector|RedirectResponse
    {
        $this->skill->addDb($request);

        return redirect()->route('db');
    }


    /**
     * OS 取得
     * @return View|Factory
     */
    public function indexOs(): View|Factory
    {
        $osList = $this->skill->getOsList();

        return view('skill.os', compact('osList'));
    }

    /**
     * OS 登録
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function addOs(Request $request): Redirector|RedirectResponse

    {
        $this->skill->addOs($request);

        return redirect()->route('os');
    }

    /**
     * ミドルウェア 取得
     * @return View|Factory
     */
    public function indexMiddleware(): View|Factory
    {
        $middlewareList = $this->skill->getMiddlewareList();

        return view('skill.middleware', compact('middlewareList'));
    }

    /**
     * ミドルウェア 登録
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function addMiddleware(Request $request): Redirector|RedirectResponse
    {
        $this->skill->addMiddleware($request);

        return redirect()->route('middleware');
    }

    /**
     * プラットフォーム 取得
     * @return View|Factory
     */
    public function indexPlatform(): View|Factory
    {
        $platformList = $this->skill->getPlatformList();

        return view('skill.platform', compact('platformList'));
    }

    /**
     * プラットフォーム 登録
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function addPlatform(Request $request): Redirector|RedirectResponse
    {
        $this->skill->addPlatform($request);

        return redirect()->route('platform');
    }

    /**
     * フレームワーク 取得
     * @return View|Factory
     */
    public function indexFramework(): View|Factory
    {
        $frameworkList = $this->skill->getFrameworkList();

        return view('skill.framework', compact('frameworkList'));
    }

    /**
     * フレームワーク 登録
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function addFramework(Request $request): Redirector|RedirectResponse
    {
        $this->skill->addFramework($request);

        return redirect()->route('framework');
    }

    /**
     * その他 取得
     * @return View|Factory
     */
    public function indexOthers(): View|Factory
    {
        $othersList = $this->skill->getOthersList();

        return view('skill.others', compact('othersList'));
    }

    /**
     * その他 登録
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function addOthers(Request $request): Redirector|RedirectResponse
    {
        $this->skill->addOthers($request);

        return redirect()->route('others');
    }

    /**
     * スキル 更新
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        // 指定されたIDのレコードを削除
        $this->skill->updateSkill($request);

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
