<?php

namespace App\Http\Api\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SkillListRequest;
use App\Services\Api\SkillApiService;

class SkillApiController extends Controller
{
    public function __construct(
        private ?SkillApiService $_skillApiService = null
    ) {
    }

    /**
     * スキル情報取得(全件)
     * @param void
     * @return JsonResponse
     */
    public function getSkillList(): JsonResponse
    {
        $_skillList = $this->_skillApiService->getAllSkillList();
        return response()->json($_skillList);
    }

    /**
     * スキル情報取得(絞り込み)
     * @param void
     * @return JsonResponse
     */
    public function getSkillListByIds(SkillListRequest $_request): JsonResponse
    {
        $_params = $_request->only(['skill_id', 'class_id', 'sub_class_id']);
        $_skillList = $this->_skillApiService->searchSkillListByIds($_params);
        return response()->json($_skillList);
    }

    /**
     * 分類ID全件取得
     * @param void
     * @return JsonResponse
     */
    public function getClassList(): JsonResponse
    {
        $_classList = $this->_skillApiService->getAllClassList();
        return response()->json($_classList);
    }

    /**
     * サブクラス(カテゴリ)全件取得
     * @param void
     * @return JsonResponse
     */
    public function getSubClassList(): JsonResponse
    {
        $_subClassList = $this->_skillApiService->getAllSubClassList();
        return response()->json($_subClassList);
    }
}
