<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class Company extends Model
{
    use HasFactory;

    protected $table = 'm_companys';

    /**
     * select CompanyList
     * @return Collection
     */
    public function getCompanyList(): Collection
    {
        return DB::table($this->table)
            ->select('company_name', 'create_date')
            ->get();
    }

    /**
     * insert Company
     * @param String $company_name
     */
    public function addCompany(String $company_name): void
    {
        try {
            DB::table($this->table)->insert([
                [
                    'company_name' => $company_name,
                ]
            ]);
            DB::commit();
            session()->flash('success_message', '追加しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('flash_message', '追加に失敗しました。' . $e->getMessage());
        }
    }
}
