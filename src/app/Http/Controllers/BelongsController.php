<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Belongs;
use App\Models\UserList;

class BelongsController extends Controller
{

    public function __construct(private Belongs $belongs, private UserList $userList){}

    /**
     * 部署一覧 取得
     * @param Request $request
     * @return View|Factory
     */
    public function getBelongsList(): View|Factory
    {
        return view('skill.belongs', [
            'belongs_list' => $this->userList->getBelongs()
        ]);
    }

    /**
     * 部署追加
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function addBelongs(Request $request): Redirector|RedirectResponse
    {
        $this->belongs->addBelongs($request);

        return redirect()->route('belongs');
    }

    /**
     * 部署削除
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function deleteBelongs($belongs_id): Redirector|RedirectResponse
    {
        $this->belongs->deleteBelongs($belongs_id);

        return redirect()->route('belongs');
    }
}
