<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function __construct(private Company $company){}

    /**
     * 企業 取得
     * @return View|Factory
     */
    public function getCompanyList(): View|Factory
    {
        return view('company', ['companyList' => $this->company->getCompanyList()]);
    }


    /**
     * 企業 登録
     * @param Request $request
     * @return RedirectResponse
     */
    public function sendCompany(Request $request): RedirectResponse
    {
        $this->company->addCompany($request->company_name);
        return back();
    }
}
