<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Contract;


class ContractController extends Controller
{

    public function __construct(private Contract $contract){}

    /**
     * 契約管理・延長情報管理
     * @param Request $request
     * @return View|Factory
     */
    public function getContractList(Request $request): View|Factory
    {
        $contract_List = $this->contract->getContractList();
        $displayed_num = $this->contract->getDisplayedNum($request);
        if (isset($request->filter_engineer_flg)) {
            $contract_List = $this->contract->filter_user($contract_List, $request);
        }

        return view('contract.contractList', [
            'contract_List' => $contract_List->paginate($displayed_num),
            'display_num' => $displayed_num
        ]);
    }


    /**
     * 契約管理・延長情報管理　詳細
     * @param Request $request
     * @param String $user_id
     * @return View|Factory
     */
    public function getContractDetail(Request $request, String $user_id): View|Factory
    {
        $user_id = Crypt::decryptString($user_id);
        $user = $this->contract->getContractUser($user_id);
        $contract_detail = $this->contract->getContractDetail($user_id);
        $sales = $this->contract->getSalesUser($user_id);

        return view('contract.contractDetail', [
            'user' => $user,
            'contract_detail' => $contract_detail,
            'sales' => $sales,
            'referer' => $request->headers->get("referer")
        ]);
    }

    /**
     * 契約管理・延長情報管理　更新
     * @param Request $request
     * @param String $user_id
     * @return RedirectResponse
     */
    public function updateContract(Request $request, String $user_id): RedirectResponse
    {
        $this->contract->updateContract($request, $user_id);

        return back();
    }

    /**
     * 契約管理・延長情報管理　フラグ更新
     * @param Request $request
     * @param String $user_id
     * @return RedirectResponse
     */
    public function updateFlg(String $user_id): RedirectResponse
    {
        $this->contract->updateContractFlg($user_id);

        return back();
    }
}
