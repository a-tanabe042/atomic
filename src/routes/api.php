<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// NOTE: 恐らく不要。使ってないはず。刷新時削除で。 23/10/17 山口
// Route::middleware(['auth:sanctum', 'token'])->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
 * RouteServiceProvider, added url prefix "api/".
 */

/* スキル情報一覧(全件) */
Route::get('/skill/list', [App\Http\Api\Controllers\SkillApiController::class, 'getSkillList']);

/* 分類(class)一覧取得 */
Route::get('/skill/class/list', [App\Http\Api\Controllers\SkillApiController::class, 'getClassList']);

/* サブクラス(カテゴリ)一覧取得 */
Route::get('/skill/sub-class/list', [App\Http\Api\Controllers\SkillApiController::class, 'getSubClassList']);

/* スキル情報一覧(絞り込み) */
// skill_id/class_id/sub_class_idはurlパラメータにそれぞれ「配列」指定。
// カラム単位でAND検索です。
// ex) /search/skill/list?skill_id[]=2&skill_id[]=3&class_id[]=1
Route::get('/search/skill/list', [App\Http\Api\Controllers\SkillApiController::class, 'getSkillListByIds']);

/** ユーザースキル情報一覧取得 */
// user_id指定。not配列。
Route::get('/user/skill/list', [App\Http\Api\Controllers\UserApiController::class, 'getUserSkillList']);

