<?php

namespace App\Models\Tables;

use App\Models\Core\BaseModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class SkillModel extends BaseModel
{
    private string $_table = 'm_skills';

    /**
     * スキル全件取得
     * @param void
     * @return array
     */
    public function getSkillList(): array
    {
        $_ret = DB::table($this->_table)->get();
        return $this->_convertArray($_ret);
    }

    /**
     * 分類(class)全件取得
     * @param string $_classId
     * @return array
     */
    public function getClassList(): array
    {
        $_ret = DB::table($this->_table)
            ->groupBy('class_id', 'class_name')
            ->orderBy('class_id')
            ->select('class_id', 'class_name')
            ->get();
        return $this->_convertArray($_ret);
    }

    /**
     * サブクラス(カテゴリ)全件取得
     * @param void
     * @return array
     */
    public function getSubClassList(): array
    {
        $_ret = DB::table($this->_table)
            ->where('sub_class_id', '!=', config('resumeApp.PARENT_CLASS_ID'))
            ->groupBy('class_id', 'class_name', 'sub_class_id', 'sub_class_name')
            ->orderBy('class_id')
            ->orderBy('sub_class_id')
            ->select('class_id', 'class_name', 'sub_class_id', 'sub_class_name')
            ->get();
        return $this->_convertArray($_ret);
    }

    /**
     * スキル条件付き取得
     * @param void
     * @return array
     */
    public function getSkillListByIds(array $_ids): array
    {
        $_query = DB::table($this->_table);
        foreach ($_ids as $_key => $_val) {
            $_query = $_query->whereIn($_key, $_val);
        }
        $_ret = $_query->get();

        return $this->_convertArray($_ret);
    }
}
