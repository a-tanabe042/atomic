<?php

namespace App\Services\Api;

use App\Models\Tables\SkillModel;
use App\Models\Tables\UserSkillModel;

class SkillApiService
{
    public function __construct(
        private ?SkillModel $_skillModel = null,
        private ?UserSkillModel $_userSkillModel = null
    ) {
    }

    /**
     * スキル情報取得(全件)
     * @param void
     * @return array
     */
    public function getAllSkillList() :array
    {
        return $this->_skillModel->getSkillList();
    }

    /**
     * 分類ID全件取得
     * @param void
     * @return array
     */
    public function getAllClassList() :array
    {
        return $this->_skillModel->getClassList();
    }

    /**
     * サブクラス(カテゴリ)全件取得
     * @param void
     * @return array
     */
    public function getAllSubClassList() :array
    {
        return $this->_skillModel->getSubClassList();
    }

    /**
     * スキル情報取得(絞り込み)
     * @param SkillListRequest $_request
     * @return array
     */
    public function searchSkillListByIds(array $_search): array
    {
        // If search criteria empty, retrieve all.
        if (is_array($_search) && empty($_search)) return $this->_skillModel->getSkillList();

        return $this->_skillModel->getSkillListByIds($_search);
    }

    /**
     * ユーザースキル情報取得(全件)
     * @param string $_user_id
     * @return array
     */
    public function getUserAllSkillList(string $_user_id) :array
    {
        return $this->_userSkillModel->getUserSkillListByUserId($_user_id);
    }
}
