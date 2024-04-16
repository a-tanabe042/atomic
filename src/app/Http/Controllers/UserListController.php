<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use App\Models\UserList;
use App\Services\MailService;


class UserListController extends Controller
{

    //UserListを初期化
    public function __construct(private UserList $userList){}

    /**
     * ユーザー情報登録
     * @param $request
     * @param$mail_service
     * @return Redirector|RedirectResponse
     */
    public function createuser(Request $request, MailService $mail_service):Redirector|RedirectResponse
    {
        //メール通知内容を設定
        $mail_service->send_list($request);
        //ユーザー情報登録
        $this->userList->createUser($request);

        return redirect()->route('list');
    }

     /**
     * ユーザーリスト取得
     * @param $request
     * @return View|Factory
     */
    public function getuserlist(Request $request):View|Factory
    {
        //ユーザー一覧取得
        $query = $this->userList->getUserlist();
        //所属部署取得
        $belongs_list = $this->userList->getDepartment($request);
        //役職取得
        $position_list = $this->userList->getPosition();
        //レビューの承認状態のフラグ取得
        $reviewer_flg = $this->userList->getReviewerFlg();
        //レジュメの表示件数取得
        $displayed_num = $this->userList->getDisplayedNum($request);

        //エンジニアorインフラ判定絞り込み
        if (isset($request->filter_engineer_flg)) {
            $query =  $this->userList->filter_user($query, $request);
        }

        return view('users.list', [
            'query' => $query->paginate($displayed_num),
            'belongs_list' => $belongs_list,
            'position_list' => $position_list,
            'reviewer' => $reviewer_flg,
            'display_num' => $displayed_num
        ]);
    }

    /**
     * ユーザー情報編集
     * @param $user_id
     * @return View|Factory
     */
    public function getuser($user_id):View|Factory
    {
        $query = $this->userList->getUser($user_id);
        $belongs_list = $this->userList->getDepartment($user_id);
        $position_list =$this->userList->getPosition();

        return view('users.userupdate', [
            'query' => $query,
            'belongs_list' => $belongs_list,
            'position_list' => $position_list
        ]);
    }

    /**
     * ユーザー情報編集
     * @param $request
     * @return Redirector|RedirectResponse
     */
    public function updateuser(Request $request):Redirector|RedirectResponse
    {
        $this->userList->updateUser($request);
        $this->userList->getDepartment($request);

        return redirect()->route('list');
    }

    /**
     * ユーザー削除
     * @param $skill_id
     * @return Redirector|RedirectResponse
     */
    public function delete($skill_id):Redirector|RedirectResponse
    {
        $this->userList->deleteUser($skill_id);

        // 削除したら一覧画面にリダイレクト
        return redirect()->route('list');
    }

    /**
     * 未承認一覧
     * @return View|Factory
     */
    public function getUnapprovedUser():View|Factory
    {
        $query = $this->userList->getunApprovedUserlist();

        return view('unApprovedList', [
            'query' => $query->paginate(10)
        ]);
    }
}
