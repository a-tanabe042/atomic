<?php

namespace App\Models\Tables;

use Illuminate\Support\Facades\DB;
use App\Models\Core\BaseModel;

class UserSkillModel extends BaseModel
{
    private string $_table = 't_user_skills';

    /**
     * user_idでユーザーの所持スキルを絞り込み取得
     * @param string $_userId
     * @return array
     */
    public function getUserSkillListByUserId(string $_userId): array
    {
        $_column = [
            't.user_id', 'm.class_id', 'm.sub_class_id',
            'm.skill_id', 'm.class_name', 'm.sub_class_name', 'm.skill_name',
            't.evaluation'
        ];
        $_ret = DB::table($this->_table . ' as t')
            ->join('m_skills as m', 't.skill_id', '=', 'm.skill_id')
            ->where('user_id', '=', $_userId)
            ->orderBy('m.class_id')
            ->orderBy('m.sub_class_id')
            ->orderBy('m.skill_id')
            ->select($_column)
            ->get();
        return $this->_convertArray($_ret);
    }
}
