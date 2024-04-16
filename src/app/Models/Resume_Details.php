<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Resume_Details extends Model
{
    use HasFactory;

    public function getBasicInfo($chosen_id)
    {
        $basic_info_items = DB::select(
            'SELECT
                t_user_basic.user_id as user_id,
                t_user_basic.last_name as last_name,
                t_user_basic.first_name as first_name,
                t_user_basic.last_name_kana as last_name_kana,
                t_user_basic.first_name_kana as first_name_kana,
                t_user_basic.initial as initial,
                substring(t_user_basic.birthday, 1, 4) as year,
                substring(t_user_basic.birthday, 5, 2) as month,
                substring(t_user_basic.birthday, 7, 2) as day,
                TIMESTAMPDIFF(YEAR,t_user_basic.birthday, CURDATE()) as age,
                t_user_basic.gender as gender,
                t_user_basic.station as station,
                t_user_basic.real_years as real_years,
                t_user_basic.real_month as real_month,
                t_user_basic.start_year as start_year,
                t_user_basic.start_month as start_month,
                t_user_basic.my_pr as my_pr,
                t_user_basic.condition_text as condition_text,
                t_user_basic.experience as experience,
                t_user.condition_flg as condition_flg,
                t_user.engineer_flg,
                t_user.guest_flg,
                t_user.review_message
            FROM
                t_user_basic
            LEFT JOIN
                t_user
            ON
                t_user.user_id = t_user_basic.user_id
            WHERE
                t_user_basic.user_id = :chosen_id;',
            ['chosen_id' => $chosen_id]
        );

        return $basic_info_items;
    }

    public function getBasicInfoLicense($chosen_id)
    {
        $basic_info_license_items = DB::select(
            'SELECT
                user_id as user_id,
                license_id as license_id,
                license_name as license_name,
                output as output
            FROM
                t_user_license
            WHERE
                user_id = :chosen_id;',
            ['chosen_id' => $chosen_id]
        );

        return $basic_info_license_items;
    }

    public function getBasicInfoSkill($chosen_id)
    {
        $basic_info_skill = DB::select(
            'SELECT
                t_user_skills.class_id,
                t_user_skills.evaluation as evaluation,
                m_skills.skill_name as skill_name
            FROM
                t_user_skills
            LEFT JOIN
                m_skills
            ON
                t_user_skills.class_id = m_skills.class_id
            AND
                t_user_skills.skill_id = m_skills.skill_id
            AND
                t_user_skills.sub_class_id = m_skills.sub_class_id
            WHERE
                t_user_skills.user_id = :chosen_id',
            ['chosen_id' => $chosen_id]
        );

        return $basic_info_skill;
    }

    public function getBasicInfoSkilllanguage($chosen_id)
    {
        $basic_info_skil_language = DB::select(
            'SELECT
                t_user_skills.user_id as user_id,
                t_user_skills.skill_id as skill_id,
                t_user_skills.class_id as class_id,
                t_user_skills.sub_class_id as sub_class_id,
                t_user_skills.evaluation as evaluation,
                m_skills.skill_name as skill_name
            FROM
                t_user_skills
            LEFT JOIN
                m_skills
            ON
                t_user_skills.class_id = m_skills.class_id
            AND
                t_user_skills.skill_id = m_skills.skill_id
            AND
                t_user_skills.sub_class_id = m_skills.sub_class_id
            WHERE
                t_user_skills.user_id = :chosen_id
            AND
                t_user_skills.class_id = 1;',
            ['chosen_id' => $chosen_id]
        );

        return $basic_info_skil_language;
    }

    public function getBasicInfoSkillDb($chosen_id)
    {
        $basic_info_skil_db = DB::select(
            'SELECT
                t_user_skills.user_id as user_id,
                t_user_skills.skill_id as skill_id,
                t_user_skills.class_id as class_id,
                t_user_skills.sub_class_id as sub_class_id,
                t_user_skills.evaluation as evaluation,
                m_skills.skill_name as skill_name
            FROM
                t_user_skills
            LEFT JOIN
                m_skills
            ON
                t_user_skills.class_id = m_skills.class_id
            AND
                t_user_skills.skill_id = m_skills.skill_id
            AND
                t_user_skills.sub_class_id = m_skills.sub_class_id
            WHERE
                t_user_skills.user_id = :chosen_id
            AND
                t_user_skills.class_id = 2;',
            ['chosen_id' => $chosen_id]
        );

        return $basic_info_skil_db;
    }

    public function getBasicInfoSkillOs($chosen_id)
    {
        $basic_info_skil_os = DB::select(
            'SELECT
                t_user_skills.user_id as user_id,
                t_user_skills.skill_id as skill_id,
                t_user_skills.class_id as class_id,
                t_user_skills.sub_class_id as sub_class_id,
                t_user_skills.evaluation as evaluation,
                m_skills.skill_name as skill_name
            FROM
                t_user_skills
            LEFT JOIN
                m_skills
            ON
                t_user_skills.class_id = m_skills.class_id
            AND
                t_user_skills.skill_id = m_skills.skill_id
            AND
                t_user_skills.sub_class_id = m_skills.sub_class_id
            WHERE
                t_user_skills.user_id = :chosen_id
            AND
                t_user_skills.class_id = 3;',
            ['chosen_id' => $chosen_id]
        );

        return $basic_info_skil_os;
    }

    public function getBasicInfoSkillPlatform($chosen_id)
    {
        $basic_info_skil_platform = DB::select(
            'SELECT
                t_user_skills.user_id as user_id,
                t_user_skills.skill_id as skill_id,
                t_user_skills.class_id as class_id,
                t_user_skills.sub_class_id as sub_class_id,
                t_user_skills.evaluation as evaluation,
                m_skills.skill_name as skill_name
            FROM
                t_user_skills
            LEFT JOIN
                m_skills
            ON
                t_user_skills.class_id = m_skills.class_id
            AND
                t_user_skills.skill_id = m_skills.skill_id
            AND
                t_user_skills.sub_class_id = m_skills.sub_class_id
            WHERE
                t_user_skills.user_id = :chosen_id
            AND
                t_user_skills.class_id = 5;',
            ['chosen_id' => $chosen_id]
        );

        return $basic_info_skil_platform;
    }

    public function getBasicInfoSkillMiddleware($chosen_id)
    {

        $basic_info_skil_middleware = DB::select(
            'SELECT
                t_user_skills.user_id as user_id,
                t_user_skills.skill_id as skill_id,
                t_user_skills.class_id as class_id,
                t_user_skills.sub_class_id as sub_class_id,
                t_user_skills.evaluation as evaluation,
                m_skills.skill_name as skill_name
            FROM
                t_user_skills
            LEFT JOIN
                m_skills
            ON
                t_user_skills.class_id = m_skills.class_id
            AND
                t_user_skills.skill_id = m_skills.skill_id
            AND
                t_user_skills.sub_class_id = m_skills.sub_class_id
            WHERE
                t_user_skills.user_id = :chosen_id
            AND
                t_user_skills.class_id = 4;',
            ['chosen_id' => $chosen_id]
        );

        return $basic_info_skil_middleware;
    }

    public function getBasicInfoSkillFrameWork($chosen_id)
    {
        $basic_info_skil_frameWork = DB::select(
            'SELECT
                t_user_skills.user_id as user_id,
                t_user_skills.skill_id as skill_id,
                t_user_skills.class_id as class_id,
                t_user_skills.sub_class_id as sub_class_id,
                t_user_skills.evaluation as evaluation,
                m_skills.skill_name as skill_name
            FROM
                t_user_skills
            LEFT JOIN
                m_skills
            ON
                t_user_skills.class_id = m_skills.class_id
            AND
                t_user_skills.skill_id = m_skills.skill_id
            AND
                t_user_skills.sub_class_id = m_skills.sub_class_id
            WHERE
                t_user_skills.user_id = :chosen_id
            AND
                t_user_skills.class_id = 6;',
            ['chosen_id' => $chosen_id]
        );

        return $basic_info_skil_frameWork;
    }

    public function getBasicInfoSkillOthers($chosen_id)
    {
        $basic_info_skil_others = DB::select(
            'SELECT
                t_user_skills.user_id as user_id,
                t_user_skills.skill_id as skill_id,
                t_user_skills.class_id as class_id,
                t_user_skills.sub_class_id as sub_class_id,
                t_user_skills.evaluation as evaluation,
                m_skills.skill_name as skill_name
            FROM
                t_user_skills
            LEFT JOIN
                m_skills
            ON
                t_user_skills.class_id = m_skills.class_id
            AND
                t_user_skills.skill_id = m_skills.skill_id
            AND
                t_user_skills.sub_class_id = m_skills.sub_class_id
            WHERE
                t_user_skills.user_id = :chosen_id
            AND
                t_user_skills.class_id = 7;',
            ['chosen_id' => $chosen_id]
        );

        return $basic_info_skil_others;
    }

    public function getSummary($chosen_id)
    {
        //サマリー
        $summary_sum = DB::select(
            'SELECT
                COUNT(*) as pj_sum,
                COUNT(requirement = 1 OR NULL) as requirement,
                COUNT(basic_design = 1 OR NULL) as basic_design,
                COUNT(detail_design = 1 OR NULL) as detail_design,
                COUNT(development = 1 OR NULL) as development,
                COUNT(unit_test = 1 OR NULL) as unit_test,
                COUNT(integration_test = 1 OR NULL) as integration_test,
                COUNT(comprehensive_test = 1 OR NULL) as comprehensive_test,
                COUNT(operation_test = 1 OR NULL) as operation_test,
                COUNT(environment = 1 OR NULL) as environment,
                COUNT(operation_maintenance = 1 OR NULL) as operation_maintenance,
                COUNT(survey = 1 OR NULL) as survey,
                COUNT(education = 1 OR NULL) as education,
                COUNT(training_flg = 1 OR NULL) as training_flg,
                COUNT(role_pm = 1 OR NULL) as pm,
                COUNT(role_pmo = 1 OR NULL) as pmo,
                COUNT(role_pl = 1 OR NULL) as pl,
                COUNT(role_sl = 1 OR NULL) as sl,
                COUNT(role_se = 1 OR NULL) as se,
                COUNT(role_pg = 1 OR NULL) as pg,
                COUNT(role_ts = 1 OR NULL) as ts,
                COUNT(role_ps = 1 OR NULL) as ps,
                COUNT(role_om = 1 OR NULL) as om,
                COUNT(role_hd = 1 OR NULL) as hd,
                COUNT(role_other = 1 OR NULL) as other
            FROM
                t_user_career
            WHERE
                user_id = :chosen_id
            AND
                training_flg IS NULL',
            ['chosen_id' => $chosen_id]
        );

        return $summary_sum;
    }

    public function getCareerList($chosen_id)
    {
        $career_items = DB::select(
            'SELECT
                user_id,
                career_id,
                no_num,
                project_title,
                start_period,
                finish_period,
                current_period_flg,
                pj_overview,
                pj_contents,
                role_pm,
                role_pmo,
                role_pl,
                role_sl,
                role_se,
                role_pg,
                role_ts,
                role_ps,
                role_om,
                role_hd,
                role_other,
                project_num,
                requirement,
                basic_design,
                detail_design,
                development,
                unit_test,
                integration_test,
                comprehensive_test,
                operation_test,
                environment,
                operation_maintenance,
                survey,
                education,
                training_flg,
                del_flg
            FROM
                t_user_career
            WHERE
                user_id = :chosen_id
            ORDER BY no_num asc',
            ['chosen_id' => $chosen_id]
        );

        return $career_items;
    }

    public function getCareerSkill($chosen_id)
    {
        //経歴一覧　スキル
        $career_items_skill = DB::select(
            'SELECT
                t_user_career_detail.career_id,
                t_user_career_detail.class_id,
                m_skills.skill_name
            FROM
                t_user_career_detail
            JOIN
                t_user_career
            ON
                t_user_career.user_id = t_user_career_detail.user_id
            AND
                t_user_career.career_id = t_user_career_detail.career_id
            RIGHT JOIN
                m_skills
            ON
                m_skills.skill_id = t_user_career_detail.skill_id
            WHERE
                t_user_career_detail.user_id = :chosen_id',
            ['chosen_id' => $chosen_id]
        );

        return $career_items_skill;
    }

    public function getCareerEditSkill($chosen_id)
    {
        $career_items_skill = DB::select(
            'SELECT
                t_user_career_detail.class_id as class_id,
                t_user_career_detail.career_id as career_id,
                m_skills.skill_name as skill_name
            FROM
                t_user_career_detail
            LEFT JOIN
                m_skills
            ON
                m_skills.skill_id = t_user_career_detail.skill_id
            WHERE
                t_user_career_detail.user_id = :chosen_id',
            ['chosen_id' => $chosen_id]
        );

        return $career_items_skill;
    }

    public function getCareerSkillLanguage($chosen_id)
    {
        $career_items_skill_language = DB::select(
            'SELECT
                t_user_career_detail.user_id as user_id,
                t_user_career_detail.career_id as career_id,
                t_user_career_detail.skill_id as skill_id,
                t_user_career_detail.class_id as class_id,
                t_user_career_detail.sub_class_id as sub_class_id,
                m_skills.class_name as class_name,
                m_skills.skill_name as skill_name,
                m_skills.sub_class_name as sub_class_name
            FROM
                t_user_career_detail
            JOIN
                t_user_career
            ON
                t_user_career.user_id = t_user_career_detail.user_id
            AND
                t_user_career.career_id = t_user_career_detail.career_id
            LEFT JOIN
                m_skills
            ON
                m_skills.skill_id = t_user_career_detail.skill_id
            WHERE
                t_user_career_detail.user_id = :chosen_id
            AND
                t_user_career_detail.class_id = 1',
            ['chosen_id' => $chosen_id]
        );

        return $career_items_skill_language;
    }


    //経歴一覧　編集モード時のスキル表示　DB
    public function getCareerSkillDb($chosen_id)
    {
        $career_items_skill_db = DB::select(
            'SELECT
                t_user_career_detail.user_id as user_id,
                t_user_career_detail.career_id as career_id,
                t_user_career_detail.skill_id as skill_id,
                t_user_career_detail.class_id as class_id,
                t_user_career_detail.sub_class_id as sub_class_id,
                m_skills.class_name as class_name,
                m_skills.skill_name as skill_name,
                m_skills.sub_class_name as sub_class_name
            FROM
                t_user_career_detail
            JOIN
                t_user_career
            ON
                t_user_career.user_id = t_user_career_detail.user_id
            AND
                t_user_career.career_id = t_user_career_detail.career_id
            LEFT JOIN
                m_skills
            ON
                m_skills.skill_id = t_user_career_detail.skill_id
            WHERE
                t_user_career_detail.user_id = :chosen_id
            AND
                t_user_career_detail.class_id = 2',
            ['chosen_id' => $chosen_id]
        );

        return $career_items_skill_db;
    }

    //経歴一覧　編集モード時のスキル表示　OS
    public function getCareerSkillOs($chosen_id)
    {
        $career_items_skill_os = DB::select(
            'SELECT
                t_user_career_detail.user_id as user_id,
                t_user_career_detail.career_id as career_id,
                t_user_career_detail.skill_id as skill_id,
                t_user_career_detail.class_id as class_id,
                t_user_career_detail.sub_class_id as sub_class_id,
                m_skills.class_name as class_name,
                m_skills.skill_name as skill_name,
                m_skills.sub_class_name as sub_class_name
            FROM
                t_user_career_detail
            JOIN
                t_user_career
            ON
                t_user_career.user_id = t_user_career_detail.user_id
            AND
                t_user_career.career_id = t_user_career_detail.career_id
            LEFT JOIN
                m_skills
            ON
                m_skills.skill_id = t_user_career_detail.skill_id
            WHERE
                t_user_career_detail.user_id = :chosen_id
            AND
                t_user_career_detail.class_id = 3',
            ['chosen_id' => $chosen_id]
        );

        return $career_items_skill_os;
    }

    //経歴一覧　編集モード時のスキル表示　プラットフォーム
    public function getCareerSkillPlatform($chosen_id)
    {
        $career_items_skill_platform = DB::select(
            'SELECT
                t_user_career_detail.user_id as user_id,
                t_user_career_detail.career_id as career_id,
                t_user_career_detail.skill_id as skill_id,
                t_user_career_detail.class_id as class_id,
                t_user_career_detail.sub_class_id as sub_class_id,
                m_skills.class_name as class_name,
                m_skills.skill_name as skill_name,
                m_skills.sub_class_name as sub_class_name
            FROM
                t_user_career_detail
            JOIN
                t_user_career
            ON
                t_user_career.user_id = t_user_career_detail.user_id
            AND
                t_user_career.career_id = t_user_career_detail.career_id
            LEFT JOIN
                m_skills
            ON
                m_skills.skill_id = t_user_career_detail.skill_id
            WHERE
                t_user_career_detail.user_id = :chosen_id
            AND
                t_user_career_detail.class_id = 5',
            ['chosen_id' => $chosen_id]
        );

        return $career_items_skill_platform;
    }

    //経歴一覧　編集モード時のスキル表示　ミドルウェア
    public function getCareerSkillMiddleware($chosen_id)
    {
        $career_items_skill_middleware = DB::select(
            'SELECT
                t_user_career_detail.user_id as user_id,
                t_user_career_detail.career_id as career_id,
                t_user_career_detail.skill_id as skill_id,
                t_user_career_detail.class_id as class_id,
                t_user_career_detail.sub_class_id as sub_class_id,
                m_skills.class_name as class_name,
                m_skills.skill_name as skill_name,
                m_skills.sub_class_name as sub_class_name
            FROM
                t_user_career_detail
            JOIN
                t_user_career
            ON
                t_user_career.user_id = t_user_career_detail.user_id
            AND
                t_user_career.career_id = t_user_career_detail.career_id
            LEFT JOIN
                m_skills
            ON
                m_skills.skill_id = t_user_career_detail.skill_id
            WHERE
                t_user_career_detail.user_id = :chosen_id
            AND
                t_user_career_detail.class_id = 4',
            ['chosen_id' => $chosen_id]
        );

        return $career_items_skill_middleware;
    }

    //経歴一覧　編集モード時のスキル表示　FrameWork
    public function getCareerSkillFrameWork($chosen_id)
    {
        $career_items_skill_frameWork = DB::select(
            'SELECT
                t_user_career_detail.user_id as user_id,
                t_user_career_detail.career_id as career_id,
                t_user_career_detail.skill_id as skill_id,
                t_user_career_detail.class_id as class_id,
                t_user_career_detail.sub_class_id as sub_class_id,
                m_skills.class_name as class_name,
                m_skills.skill_name as skill_name,
                m_skills.sub_class_name as sub_class_name
            FROM
                t_user_career_detail
            JOIN
                t_user_career
            ON
                t_user_career.user_id = t_user_career_detail.user_id
            AND
                t_user_career.career_id = t_user_career_detail.career_id
            LEFT JOIN
                m_skills
            ON
                m_skills.skill_id = t_user_career_detail.skill_id
            WHERE
                t_user_career_detail.user_id = :chosen_id
            AND
                t_user_career_detail.class_id = 6',
            ['chosen_id' => $chosen_id]
        );

        return $career_items_skill_frameWork;
    }

    //経歴一覧　編集モード時のスキル表示　その他
    public function getCareerSkillOthers($chosen_id)
    {
        $career_items_skill_others = DB::select(
            'SELECT
                t_user_career_detail.user_id as user_id,
                t_user_career_detail.career_id as career_id,
                t_user_career_detail.skill_id as skill_id,
                t_user_career_detail.class_id as class_id,
                t_user_career_detail.sub_class_id as sub_class_id,
                m_skills.class_name as class_name,
                m_skills.skill_name as skill_name,
                m_skills.sub_class_name as sub_class_name
            FROM
                t_user_career_detail
            JOIN
                t_user_career
            ON
                t_user_career.user_id = t_user_career_detail.user_id
            AND
                t_user_career.career_id = t_user_career_detail.career_id
            LEFT JOIN
                m_skills
            ON
                m_skills.skill_id = t_user_career_detail.skill_id
            WHERE
                t_user_career_detail.user_id = :chosen_id
            AND
                t_user_career_detail.class_id = 7',
            ['chosen_id' => $chosen_id]
        );

        return $career_items_skill_others;
    }

    public function getSkill()
    {
        $allSkill = DB::select(
            'SELECT
                class_id,
                sub_class_name,
                skill_name
            FROM
                m_skills
            ORDER BY
                sub_class_name, skill_name ASC'
        );

        return $allSkill;
    }

    //レビューボタン表示判定
    public function getReviewerFlg()
    {
        $query = DB::table("t_user")
            ->where("user_id", "=", session()->get('user_id'))
            ->select("reviewer_flg", "guest_reviewer_flg")
            ->first();

        return $query;
    }

    //レビューボタン表示判定
    public function getRevieweeFlg($chosen_id)
    {
        $query = DB::table("t_user")
            ->where("user_id", "=", $chosen_id)
            ->select("reviewee_flg")
            ->first();

        return $query;
    }

    //案件希望入力データ取得
    public function getCondition($chosen_id)
    {
        $query = DB::table("t_user_career_request")
            ->where("user_id", "=", $chosen_id)
            ->select(
                "priority_condition_1",
                "priority_condition_2",
                "plus_condition_1",
                "plus_condition_2",
                "condition_reason",
                "condition_addition_1",
                "condition_addition_2",
                "condition_editor_1",
                "condition_editor_2",
                "career_path_goal",
                "career_path_reason",
                "remarks",
                "transmission"
            )
            ->first();

        return $query;
    }

    //案件希望入力の radio ボタン判定
    public function getConditionRadio($condition)
    {
        $radio = new \stdClass();
        //radioボタンデフォルト
        $radio->priority = "no";
        $radio->plus = "no";

        if ($condition != null) {
            if ($condition->priority_condition_1 != null || $condition->priority_condition_2 != null) {
                $radio->priority = "yes";
            }
            if ($condition->plus_condition_1 != null || $condition->plus_condition_2 != null) {
                $radio->plus = "yes";
            }
        }

        return $radio;
    }

    //経歴追加時no_numの変更
    public function updateNumber($no_num, $chosen_id)
    {
        for ($i = $no_num; $i >= 0; $i--) {
            log::debug($i);
            DB::table('t_user_career')
                ->where([
                    'user_id' => $chosen_id,
                    'no_num' => $i
                ])
                ->update([
                    'no_num' => $i + 1

                ]);
        }
    }
    //追加処理
    //経歴情報追加
    public function addCareerInfo($request, $chosen_id, $no_num_add)
    {
        DB::table('t_user_career')->insert([
            [
                'user_id' => $chosen_id,
                'career_id' => $no_num_add,
                'no_num' => '1',
                'start_period' => $request->period_start_year . $request->period_start_month,
                'project_title' => $request->pj_name,
                'finish_period' => $request->period_finish_year . $request->period_finish_month,
                'current_period_flg' => $request->current_period_flg,
                'role_pm' => $request->pm,
                'role_pmo' => $request->pmo,
                'role_pl' => $request->pl,
                'role_sl' => $request->sl,
                'role_se' => $request->se,
                'role_pg' => $request->pg,
                'role_ts' => $request->ts,
                'role_ps' => $request->ps,
                'role_om' => $request->om,
                'role_hd' => $request->hd,
                'role_other' => $request->other,
                'pj_contents' => $request->pj_contents,
                'pj_overview' => $request->pj_overview,
                'project_num' => $request->project_num,
                'requirement' => $request->requirement,
                'basic_design' => $request->basic_design,
                'detail_design' => $request->detail_design,
                'development' => $request->development,
                'unit_test' => $request->unit_test,
                'integration_test' => $request->integration_test,
                'comprehensive_test' => $request->comprehensive_test,
                'operation_test' => $request->operation_test,
                'environment' => $request->environment,
                'operation_maintenance' => $request->operation_maintenance,
                'survey' => $request->survey,
                'education' => $request->education,
                'training_flg' => $request->training_flg
            ]
        ]);

        log::debug('ユーザーID' . $chosen_id . 'の経歴が追加されました。経歴No.' . $no_num_add);
    }

    //スキル名を取得
    public function getSkillName($SkilNameArray)
    {
        $skill_name = DB::table('m_skills')
            ->where([
                'skill_name' => $SkilNameArray,
            ])
            ->get();

        return $skill_name;
    }


    //経歴スキル追加
    public function addSkill($chosen_id, $no_num_add, $skillsTbArry)
    {
        $skill_id = $skillsTbArry['0']->skill_id;
        $class_id = $skillsTbArry['0']->class_id;
        $sub_class_id = $skillsTbArry['0']->sub_class_id;

        DB::table('t_user_career_detail')->insert([
            [
                'user_id' => $chosen_id,
                'career_id' => $no_num_add,
                'skill_id' => $skill_id,
                'class_id' => $class_id,
                'sub_class_id' => $sub_class_id,
                'create_id' => session('user_id'),
                'modify_id' => session('user_id'),
            ]
        ]);
    }

    //編集
    //基本情報
    public function basicInfoUp($chosen_id, $login_id, $request, $authName)
    {
        if ($authName == 'member' || $authName == 'manager' || $authName == 'admin') {
            DB::table('t_user_basic')
                ->where([
                    'user_id' => $chosen_id,
                ])
                ->update([
                    'birthday' => $request->birthday_year . $request->birthday_month . $request->birthday_day,
                    'gender' => $request->gender,
                    'station' => $request->station,
                    'real_years' => $request->real_year,
                    'real_month' => $request->real_month,
                    'start_year' => $request->operable_years,
                    'start_month' => $request->operable_month,
                    'my_pr' => $request->my_pr,
                    'condition_text' => $request->condition_text,
                    'modify_date' => date("Y-m-d H:i:s"),
                    'modify_id' => $login_id,
                ]);
        } else {
            DB::table('t_user_basic')
                ->where([
                    'user_id' => $chosen_id,
                ])
                ->update([
                    'start_year' => $request->operable_years,
                    'start_month' => $request->operable_month,
                    'modify_date' => date("Y-m-d H:i:s"),
                    'modify_id' => $login_id,
                ]);
        }
    }

    //基本情報 保有資格削除
    public function basicInfolicenseDelete($chosen_id)
    {
        DB::table('t_user_license')
            ->where([
                'user_id' => $chosen_id,
            ])->delete();
    }

    //基本情報 保有資格アップデート
    public function basicInfolicenseUp($chosen_id, $licenseValue)
    {
        if (count($licenseValue) > 1) {

            DB::table('t_user_license')->insert([
                [
                    'user_id' => $chosen_id,
                    'license_name' => $licenseValue['edit_license_input'],
                    'output' => $licenseValue['check_license_input'],
                    'modify_date' => date("Y-m-d H:i:s"),
                    'modify_id' => session('user_id'),
                ]
            ]);
        } else {
            DB::table('t_user_license')->insert([
                [
                    'user_id' => $chosen_id,
                    'license_name' => $licenseValue['edit_license_input'],
                    'output' => '0',
                    'modify_date' => date("Y-m-d H:i:s"),
                    'modify_id' => session('user_id'),
                ]
            ]);
        }

        log::debug('ユーザーID' . $chosen_id . 'の資格が更新されました。更新者：' . session('user_id'));
    }

    //基本情報スキル削除
    public function skillDelete($chosen_id, $classId)
    {
        DB::table('t_user_skills')->where([
            'user_id' => $chosen_id,
            'class_id' => $classId,
        ])->delete();

        log::debug('ユーザーID' . $chosen_id . 'のスキル' . $classId . 'が削除されました。更新者：' . session('user_id'));
    }

    //基本情報スキルアップデート
    public function skillUp($chosen_id, $SkilNameArray, $skillsTbArry)
    {
        $skill_id = $skillsTbArry['0']->skill_id;
        $class_id = $skillsTbArry['0']->class_id;
        $sub_class_id = $skillsTbArry['0']->sub_class_id;

        DB::table('t_user_skills')->insert([
            [
                'user_id' => $chosen_id,
                'skill_id' => $skill_id,
                'class_id' => $class_id,
                'sub_class_id' => $sub_class_id,
                'evaluation' => $SkilNameArray['evaluation'],
                'modify_date' => date("Y-m-d H:i:s"),
                'modify_id' => session('user_id'),
            ]
        ]);

        log::debug('ユーザーID' . $chosen_id . 'のスキル' . $skill_id . 'が更新されました。更新者：' . session('user_id'));
    }

    //サマリー
    public function summaryUp($chosen_id, $request)
    {
        DB::table('t_user_basic')
            ->where([
                'user_id' => $chosen_id,
            ])
            ->update([
                'experience' => $request->mgmt_input,
                'modify_date' => date("Y-m-d H:i:s"),
                'modify_id' => session('user_id'),
            ]);

        log::debug('ユーザーID' . $chosen_id . 'のサマリーが更新されました。更新者：' . session('user_id'));
    }

    //経歴アップデート
    public function careerUp($chosen_id, $request)
    {
        DB::table('t_user_career')
            ->where([
                'user_id' => $chosen_id,
                'career_id' => $request->career_id,
            ])
            ->update([
                'project_title' => $request->pj_name,
                'start_period' => $request->period_start_year . $request->period_start_month,
                'finish_period' => $request->period_finish_year . $request->period_finish_month,
                'current_period_flg' => $request->current_period_flg,
                'project_num' => $request->project_num,
                'pj_overview' => $request->pj_overview,
                'pj_contents' => $request->pj_contents,
                'role_pm' => $request->role_pm,
                'role_pmo' => $request->role_pmo,
                'role_pl' => $request->role_pl,
                'role_sl' => $request->role_sl,
                'role_se' => $request->role_se,
                'role_pg' => $request->role_pg,
                'role_ts' => $request->role_ts,
                'role_ps' => $request->role_ps,
                'role_om' => $request->role_om,
                'role_hd' => $request->role_hd,
                'role_other' => $request->role_other,
                'project_num' => $request->project_num,
                'requirement' => $request->requirement,
                'basic_design' => $request->basic_design,
                'detail_design' => $request->detail_design,
                'development' => $request->development,
                'unit_test' => $request->unit_test,
                'integration_test' => $request->integration_test,
                'comprehensive_test' => $request->comprehensive_test,
                'operation_test' => $request->operation_test,
                'environment' => $request->environment,
                'operation_maintenance' => $request->operation_maintenance,
                'survey' => $request->survey,
                'education' => $request->education,
                'training_flg' => $request->training_flg,
                'modify_date' => date("Y-m-d H:i:s"),
                'modify_id' => session('user_id'),
            ]);
    }

    //経歴詳細削除
    public function careerDelete($chosen_id, $request)
    {
        DB::table('t_user_basic')
            ->where([
                'user_id' => $chosen_id,
            ])
            ->update([
                'experience' => $request->mgmt_input
            ]);
    }

    //経歴詳細の指定したクラスIDを削除
    public function careerDetaillDelete($chosen_id, $request, $classId)
    {
        DB::table('t_user_career_detail')->where([
            'user_id' => $chosen_id,
            'career_id' => $request->career_id,
            'class_id' => $classId,
        ])->delete();
    }

    //削除処理
    public function detailResumeDetails($chosen_id, $request)
    {
        //案件の個数
        $career_count = DB::table('t_user_career')->where('user_id', $chosen_id)->count();

        DB::table('t_user_career_detail')->where([
            'user_id' => $chosen_id,
            'career_id' => $request->no,
        ])->delete();

        DB::table('t_user_career')->where([
            'user_id' => $chosen_id,
            'career_id' => $request->no,
        ])->delete();

        // 案件番号振り直し（案件番号入れ替えはあとまわし）

        //削除された案件の番号
        $career_id = $request->no; //2
        $no_num = $request->num; //4

        //案件番号の初期化
        for ($i = 1; $i <= $career_count; $i++) {
            if ($i > $career_id) {
                DB::table('t_user_career')
                    ->where('user_id', $chosen_id)
                    ->where('career_id', $i)
                    ->update([
                        'career_id' => $i - 1,
                    ]);

                DB::table('t_user_career_detail')
                    ->where('user_id', $chosen_id)
                    ->where('career_id', $i)
                    ->update([
                        'career_id' => $i - 1
                    ]);
            }
            if ($i > $no_num) {
                DB::table('t_user_career')
                    ->where('user_id', $chosen_id)
                    ->where('no_num', $i)
                    ->update([
                        'no_num' => $i - 1
                    ]);
            }
        }
    }

    public function changeNumber($request, $chosen_id)
    {
        log::debug($request->no_num[0]);
        $count = count($request->no_num);
        log::debug($count);

        for ($i = 0; $i < $count; $i++) {
            DB::table('t_user_career')
                ->where([
                    'user_id' => $chosen_id,
                    'career_id' => $request->no_num[$i]
                ])
                ->update([
                    'no_num' => $i + 1,
                ]);
            log::debug($request->no_num[$i]);
            log::debug($i + 1);
        }
    }

    /* 案件希望入力*/
    //selfテーブル update
    public function updateConditionSelf($request)
    {
        $user_condition = DB::table("t_user_career_request")
            ->where("user_id", "=", $request->user_id)
            ->select("user_id")
            ->first();

        //初入力かどうか判定
        if ($user_condition == null) {
            //常に活性化しているもののみ、insert
            DB::table("t_user_career_request")
                ->insert([
                    "user_id" => $request->user_id,
                    "career_path_goal" => $request->career_path_goal_text,
                    "career_path_reason" => $request->career_path_reason_text,
                    "remarks" => $request->remarks_text,
                    'create_id' => session('user_id'),
                    'modify_id' => session('user_id')
                ]);

            //優先条件が "あり" の場合
            if ($request->priority_condition_radio == "yes") {
                DB::table("t_user_career_request")
                    ->where("user_id", "=", $request->user_id)
                    ->update([
                        "priority_condition_1" => $request->priority_condition_text_1,
                        "priority_condition_2" => $request->priority_condition_text_2
                    ]);
            }

            //尚可条件が "あり" の場合
            if ($request->plus_condition_radio == "yes") {
                DB::table("t_user_career_request")
                    ->where("user_id", "=", $request->user_id)
                    ->update([
                        "plus_condition_1" => $request->plus_condition_text_1,
                        "plus_condition_2" => $request->plus_condition_text_2
                    ]);
            }

            //優先条件・尚可条件のどちらかが "あり" の場合
            if ($request->priority_condition_radio == "yes" || $request->plus_condition_radio == "yes") {
                DB::table("t_user_career_request")
                    ->where("user_id", "=", $request->user_id)
                    ->update(["condition_reason" => $request->condition_reason_text]);
            }
        } else {
            //update
            DB::table("t_user_career_request")
                ->where("user_id", "=", $request->user_id)
                ->update([
                    "priority_condition_1" => $request->priority_condition_text_1,
                    "priority_condition_2" => $request->priority_condition_text_2,
                    "plus_condition_1" => $request->plus_condition_text_1,
                    "plus_condition_2" => $request->plus_condition_text_2,
                    "condition_reason" => $request->condition_reason_text,
                    "career_path_goal" => $request->career_path_goal_text,
                    "career_path_reason" => $request->career_path_reason_text,
                    "remarks" => $request->remarks_text,
                    'modify_date' => date("Y-m-d H:i:s"),
                    'modify_id' => session('user_id')
                ]);
        }
    }

    //managerテーブル update
    public function updateConditionManager($request)
    {
        //update前データ取得
        $before_user_condition = DB::table("t_user_career_request")
            ->where("user_id", "=", $request->user_id)
            ->select("condition_addition_1", "condition_addition_2")
            ->first();

        //更新者の名前のため
        $login_name = DB::table("t_user_basic")
            ->where("user_id", "=", session()->get("user_id"))
            ->select("last_name", "first_name")
            ->first();

        $editor = $login_name->last_name . " " . $login_name->first_name;

        //初入力かどうか判定
        if ($before_user_condition == null) {
            DB::table("t_user_career_request")
                ->insert([
                    "user_id" => $request->user_id,
                    "condition_addition_1" => $request->condition_addition_text_1,
                    "condition_addition_2" => $request->condition_addition_text_2,
                    "transmission" => $request->transmission_text,
                    'create_id' => session('user_id'),
                    'modify_id' => session('user_id')
                ]);

            $after_user_condition = DB::table("t_user_career_request")
                ->where("user_id", "=", $request->user_id)
                ->select("condition_addition_1", "condition_addition_2")
                ->first();

            if ($after_user_condition->condition_addition_1 != "") {
                DB::table("t_user_career_request")
                    ->where("user_id", "=", $request->user_id)
                    ->update(["condition_editor_1" => $editor]);
            }
            if ($after_user_condition->condition_addition_2 != "") {
                DB::table("t_user_career_request")
                    ->where("user_id", "=", $request->user_id)
                    ->update(["condition_editor_2" => $editor]);
            }
        } else {
            //update
            DB::table("t_user_career_request")
                ->where("user_id", "=", $request->user_id)
                ->update([
                    "condition_addition_1" => $request->condition_addition_text_1,
                    "condition_addition_2" => $request->condition_addition_text_2,
                    "transmission" => $request->transmission_text,
                    'modify_date' => date("Y-m-d H:i:s"),
                    'modify_id' => session('user_id')
                ]);

            //update後の条件補足
            $after_user_condition = DB::table("t_user_career_request")
                ->where("user_id", "=", $request->user_id)
                ->select("condition_addition_1", "condition_addition_2")
                ->first();

            //条件補足に変更が加えられていたら、更新者を変更
            if ($after_user_condition->condition_addition_1 != $before_user_condition->condition_addition_1) {
                DB::table("t_user_career_request")
                    ->where("user_id", "=", $request->user_id)
                    ->update(["condition_editor_1" => $editor]);

                if ($after_user_condition->condition_addition_1 == "") {
                    DB::table("t_user_career_request")
                        ->where("user_id", "=", $request->user_id)
                        ->update(["condition_editor_1" => ""]);
                }
            }
            if ($after_user_condition->condition_addition_2 != $before_user_condition->condition_addition_2) {
                DB::table("t_user_career_request")
                    ->where("user_id", "=", $request->user_id)
                    ->update(["condition_editor_2" => $editor]);

                if ($after_user_condition->condition_addition_2 == "") {
                    DB::table("t_user_career_request")
                        ->where("user_id", "=", $request->user_id)
                        ->update(["condition_editor_2" => ""]);
                }
            }
        }
    }
}
