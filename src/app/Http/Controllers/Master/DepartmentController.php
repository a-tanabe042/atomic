<?php

namespace App\Http\Controllers\Master;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Master\Department;
use App\Models\UserList;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentStoreRequest;
use Google\Service\Books\OffersItems;

class DepartmentController extends Controller
{

    public function __construct(private Department $department, private UserList $userList)
    {
    }

    /**
     * 部署マスタ一覧
     * @param Request $request
     * @return View|Factory
     */
    public function index(): View|Factory
    {
        return view('master.department', [
            'belongs_list' => $this->department->getDepartmentList()
        ]);
    }

    /**
     * NOTE: 23/11/2 山口修正
     *
     * 部署追加
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function store(DepartmentStoreRequest $request): Redirector|RedirectResponse
    {
        $insertParams = $request->belongs;
        array_walk($insertParams, function(&$item, $key){
            $item['create_id'] = session('user_id');
        });
        $this->department->addDepartment($insertParams);

        return redirect()->route('department.index');
    }

    /**
     * 部署削除
     * @param String $belongs_id
     * @return Redirector|RedirectResponse
     */
    public function destroy(String $belongs_id): Redirector|RedirectResponse
    {
        $this->department->deleteDepartment($belongs_id);

        return redirect()->route('department.index');
    }
}
