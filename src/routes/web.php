<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** login **/
Route::get('/login', 'Auth\LoginController@index')->name('login.index');
Route::post('/login', 'Auth\LoginController@login')->name('login');

/** logout */
Route::get('/logout', 'Auth\LogoutController@logout')->name('logout');

/** Google login **/
Route::get('/login/google', 'Auth\GoogleLoginController@redirectToGoogle');
Route::get('/google/callback', 'Auth\GoogleLoginController@handleGoogleCallback');

Route::group(['middleware' => ['managerAuth']], function () {
    /* ユーザー追加モーダル表示 & メール通知*/
    Route::post('/resume-list', [App\Http\Controllers\UserListController::class, 'createuser'])->name('create.user');

    /* ユーザー一覧表示 */
    Route::get('/',[App\Http\Controllers\UserListController::class, 'getuserlist'])->name('root');
    Route::get('/resume-list',[App\Http\Controllers\UserListController::class, 'getuserlist'])->name('list');

    /* ユーザー編集画面 */
    Route::get('/resume-list/update{user_id}', [App\Http\Controllers\UserListController::class, 'getuser'])->name('get.user');

    /* ユーザー編集 */
    Route::post('/resume-list/update', [App\Http\Controllers\UserListController::class, 'updateuser'])->name('update.user');

    /* ユーザー削除 */
    Route::post('/delete{user_id}', [App\Http\Controllers\UserListController::class, 'delete'])->name('delete.user');

    /* ユーザー詳細 */
    Route::get('/resume_detail/{user_id}_{token}', 'CareerListController@index')->name('detail.user')->middleware('token');
    Route::post('/resume_detail', 'CareerListController@create')->name('createDetail.create');
    Route::patch('/resume_detail', 'CareerListController@update')->name('createDetail.update');
    Route::delete('/resume_detail', 'CareerListController@destroy')->name('createDetail.destroy');
     //NOTE:Slackで通知しているため使用していないので後で削除
    //Route::post("/sendmail", [App\Http\Controllers\CareerListController::class, 'send']);

    Route::post('/review', [App\Http\Controllers\SlackController::class, 'review_send']);
    Route::post('/request_slack', [App\Http\Controllers\SlackRequestController::class, 'request_send']);

    Route::get('/unapproved-resume-list',[App\Http\Controllers\UserListController::class, 'getUnapprovedUser'])->name('unapproved.list');
    Route::post("/cahnge_number", [App\Http\Controllers\CareerListController::class, 'changeCareerNo'])->name('no_num.update');

    /* スキルマスタ一覧表示 */
    Route::get('/master/skill',  [App\Http\Controllers\Master\SkillController::class, 'show'])->name('master.skill');

    /* スキル詳細 */
    Route::resource('/master/skill/list', \Master\SkillController::class)
    ->only(['index', 'store','update','destroy'])
    ->parameters(['list'=> 'skill_id']);

    /* 部署 */
    Route::resource('/master/department', \Master\DepartmentController::class)->only([
        'index', 'store','destroy'
    ]);

    /* お知らせ管理 */
    Route::resource('/master/announcements', \Master\AnnouncementController::class)->only([
        'index', 'store', 'destroy'
    ]);

    /* Excel出力 */
    Route::post('/output{user_id}', [App\Http\Controllers\ExportController::class,'export'])->name('export');

    /* 契約管理・延長情報管理 */
    Route::get('/contract-list', [App\Http\Controllers\ContractController::class, 'getContractList'])->name('get.contract.list');
    Route::get('/contract-list/detail/{user_id}', [App\Http\Controllers\ContractController::class, 'getContractDetail'])->name('get.contract.detail');
    Route::post('/contract-list/detail/{user_id}', [App\Http\Controllers\ContractController::class, 'updateContract'])->name('update.contract');
    Route::post('/contract-list/detail/changeflg/{user_id}', [App\Http\Controllers\ContractController::class, 'updateFlg'])->name('update.contract_flg');

    Route::get('/contract', [App\Http\Controllers\ContractSlackController::class, 'contract'])->name('slack.contract');
    Route::post('/contract-list/detail/slack/{last_name}{first_name}', [App\Http\Controllers\ContractSlackController::class, 'contractSend'])->name('slack.send');

    /* カレンダー招待 */
    Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'getCalendarList'])->name('get.calendar.list');
    Route::post('/calendar', [App\Http\Controllers\CalendarController::class, 'sendCalendar'])->name('send.calendar');

    /* 企業登録 */
    Route::get('/company', [App\Http\Controllers\CompanyController::class, 'getCompanyList'])->name('get.company.list');
    Route::post('/company', [App\Http\Controllers\CompanyController::class, 'sendCompany'])->name('send.company');


});

Route::fallback(function () {
	return view('errors.404');
});
