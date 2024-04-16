<?php

namespace App\Http\Api\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserSkillListRequest;
use App\Services\Api\SkillApiService;

class UserApiController extends Controller
{
    public function __construct(
        private ?SkillApiService $_skillApiService = null
    ) {
    }

    /**
     * ユーザースキル情報取得(全件)
     * @param UserSkillRequest $_request
     * @return JsonResponse
     */
    public function getUserSkillList(UserSkillListRequest $_request): JsonResponse
    {
        $_ret = $this->_skillApiService->getUserAllSkillList($_request->user_id);
        return response()->json($_ret);
    }
}
