<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use App\Models\Resume_Details;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CareerListController extends Controller
{
    //Resume_Detailsを初期化
    public function __construct(private Resume_Details $resume_Details){}

    /**
     * レジュメ詳細(基本情報・経歴書一覧・案件希望)
     * @param $chosen_id
     * @return View|Factory
     */
    public function index($chosen_id):View|Factory
    {
        //レジュメ一覧にて選択された$user_idを
        $chosen_id = Crypt::decryptString($chosen_id);

        //基本情報のユーザー情報を取得
        $queryBasicInfo = $this->resume_Details->getBasicInfo($chosen_id);
        //基本情報の保有資格を取得
        $queryBasicInfocInfoLicense = $this->resume_Details->getBasicInfoLicense($chosen_id);
        //基本情報のスキルを取得
        $queryBasicInfoSkill = $this->resume_Details->getBasicInfoSkill($chosen_id);
        //基本情報のサマリー(プロジェクト件数・作業経歴・管理人数・役割)を取得
        $querySummary = $this->resume_Details->getSummary($chosen_id);

        //TODO: この辺まとめられそう　来週
        //経験一覧の経験したスキルを取得
        $queryCareerList = $this->resume_Details->getCareerList($chosen_id);
        //経験一覧の経験したスキルを取得
        $queryCareerSkill = $this->resume_Details->getCareerSkill($chosen_id);
        //経験一覧の編集にて経験したスキルを取得
        $queryCareerEditSkill = $this->resume_Details->getCareerEditSkill($chosen_id);

        //レジュメ詳細全般の選択用のスキルを取得
        $queryAllSkill = $this->resume_Details->getSkill();
        //レビューフラグ
        $reviewer_flg = $this->resume_Details->getReviewerFlg();
        $reviewee_flg = $this->resume_Details->getRevieweeFlg($chosen_id);
        //案件希望入力
        $condition = $this->resume_Details->getCondition($chosen_id);
        $condition_radio = $this->resume_Details->getConditionRadio($condition);

        return view('resumeDetail', [
            'basic_info_items' => $queryBasicInfo,
            'basic_info_license_items' => $queryBasicInfocInfoLicense,
            'basic_info_skill_list' => $queryBasicInfoSkill,
            'summary_sum' => $querySummary,
            'career_items' => $queryCareerList,
            'career_items_skill' => $queryCareerSkill,
            'skill_all_items' => $queryAllSkill,
            'career_skill_list_edit' => $queryCareerEditSkill,
            'reviewer' => $reviewer_flg,
            'reviewee' => $reviewee_flg,
            'condition' => $condition,
            'condition_radio' => $condition_radio,
            'user_id' => $chosen_id
        ]);
    }

    /**
     * レジュメ詳細(経歴書一覧)追加
     * @param $request
     * @return Redirector|RedirectResponse
     */
    public function create(Request $request): Redirector|RedirectResponse
    {
        //経歴一覧件数取得
        $no_num = DB::table('t_user_career')
            ->where('user_id', $request->user_id)
            ->count();

        //経歴一覧件数に＋１する
        $no_num_add = $no_num + 1;
        //経歴情報追加
        $this->resume_Details->updateNumber($no_num, $request->user_id);
        $this->resume_Details->addCareerInfo($request, $request->user_id, $no_num_add);
        //リクエストを配列で受け取る
        $allRequest = $request->all();

        foreach ($allRequest as $key => $value) {
        /*
            if(isset($key)){}
                $this ->addSkill($value,$request->user_id,$no_num_add);
        */
            switch ($key) {
                case 'modal_platform':
                    $this ->addSkill($value,$request->user_id,$no_num_add);
                    break;
                case 'modal_os':
                    $this ->addSkill($value,$request->user_id,$no_num_add);
                    break;
                case 'modal_middleware':
                    $this ->addSkill($value,$request->user_id,$no_num_add);
                    break;
                case 'modal_language':
                    $this ->addSkill($value,$request->user_id,$no_num_add);
                    break;
                case 'modal_db':
                    $this ->addSkill($value,$request->user_id,$no_num_add);
                    break;
                case 'modal_framework':
                    $this ->addSkill($value,$request->user_id,$no_num_add);
                    break;
                case 'modal_others':
                    $this ->addSkill($value,$request->user_id,$no_num_add);
                    break;
                default:
            }
        }

        return redirect()->action('CareerListController@index', [
            'user_id' => Crypt::encryptString($request->user_id),
            'token' => session()->get('token')
        ]);
    }

    private function addSkill($value,$chosen_id,$no_num_add){
        foreach ($value[0] as $SkilNameArray) {
            if ($SkilNameArray !== NULL) {
                //スキル名を取得
                $skillsTb = $this->resume_Details->getSkillName($SkilNameArray);
                //スキル名を配列で受け取る
                $skillsTbArry = $skillsTb->all();
                if (!empty($skillsTbArry)) {
                    //スキル追加
                    $this->resume_Details->addSkill($chosen_id, $no_num_add, $skillsTbArry);
                }
            }
        }
    }
    /**
     * レジュメ詳細(基本情報・経歴書一覧)編集
     * @param $request
     * @return Redirector|RedirectResponse
     */
    public function update(Request $request): Redirector|RedirectResponse
    {
        //ログインのsesstonnID取得
        $login_id = $request->session()->get('user_id');

        $allRequest = $request->all();

        if ($request->PressedEdit == 'myInf') {

            $authName = session()->get('auth_name');

            //基本情報
            $this->resume_Details->basicInfoUp($request->user_id, $login_id, $request, $authName);

            foreach ($allRequest as $key => $value) {

                if ($key == "license") {

                    //保有資格削除
                    $this->resume_Details->basicInfolicenseDelete($request->user_id);

                    foreach ($value as $licenseValue) {
                        if (isset($licenseValue['edit_license_input']) == true) {
                            //保有資格削除
                            $this->resume_Details->basicInfolicenseUp($request->user_id, $licenseValue);
                        }
                    }
                }
            }
        } else if ($request->PressedEdit == 'basicSkill') {

            //基本情報のスキル
            foreach ($allRequest as $key => $value) {
                switch ($key) {
                    case 'edit_platform':
                        $this ->editSkill($value,$request->user_id,5);
                        break;
                    case 'edit_os':
                        $this ->editSkill($value,$request->user_id,3);
                        break;
                    case 'edit_middleware':
                        $this ->editSkill($value,$request->user_id,4);
                        break;
                    case 'edit_language':
                        $this ->editSkill($value,$request->user_id,1);
                        break;
                    case 'edit_db':
                        $this ->editSkill($value,$request->user_id,2);
                        break;
                    case 'edit_framework':
                        $this ->editSkill($value,$request->user_id,6);
                        break;
                    case 'edit_others':
                        $this ->editSkill($value,$request->user_id,7);
                        break;
                    default:
                }
            }
        } else if ($request->PressedEdit == 'basicSummary') {

            //スキルアップデート
            $this->resume_Details->summaryUp($request->user_id, $request);
        } else if ($request->PressedEdit == 'careertDatail') {

            //経歴アップデート
            $this->resume_Details->careerUp($request->user_id, $request);

            //基本情報のスキル
            foreach ($allRequest as $key => $value) {

                switch ($key) {
                    case 'edit_platform':
                        $this->editSkillCareerList($value,$request->user_id,$request,5);
                        break;
                    case 'edit_os':
                        $this->editSkillCareerList($value,$request->user_id,$request,3);
                        break;
                    case 'edit_middleware':
                       $this->editSkillCareerList($value,$request->user_id,$request,4);
                        break;
                    case 'edit_language':
                        $this->editSkillCareerList($value,$request->user_id,$request,1);
                        break;
                    case 'edit_db':
                        $this->editSkillCareerList($value,$request->user_id,$request,2);
                        break;
                    case 'edit_framework':
                        $this->editSkillCareerList($value,$request->user_id,$request,6);
                        break;
                    case 'edit_others':
                        $this->editSkillCareerList($value,$request->user_id,$request,7);
                        break;
                    default:
                }
            }
        } else if ($request->PressedEdit == 'condition_self') {
            $this->resume_Details->updateConditionSelf($request);
        } else if ($request->PressedEdit == 'condition_manager') {
            $this->resume_Details->updateConditionManager($request);
        }

        return redirect()->action('CareerListController@index', [
            'user_id' => Crypt::encryptString($request->user_id),
            'token' => session()->get('token')
        ]);
    }

    private function editSkill($value,$user_id,$skillNo){
        //スキル削除
       $this->resume_Details->skillDelete($user_id, $skillNo);
       //TODO 同じことをしているので処理まとめる
       foreach ($value[0] as $SkilNameArray) {
           if ($SkilNameArray['skillName'] !== NULL) {
               $SkilName = $SkilNameArray['skillName'];
               //スキルを取得
               $skillsTb = $this->resume_Details->getSkillName($SkilName);
               $skillsTbArry = $skillsTb->all();
               if (empty($skillsTbArry) == false) {
                   //スキルアップデート
                   $this->resume_Details->skillUp($user_id, $SkilNameArray, $skillsTbArry);
               }
           }
       }
   }

   private function editSkillCareerList ($value,$user_id,$request,$skillNo){
       //経歴詳細の指定したクラスIDを削除
       $this->resume_Details->careerDetaillDelete($user_id, $request, $skillNo);

       foreach ($value[0] as $SkilNameArray) {
           if ($SkilNameArray !== NULL) {
               //スキル名取得
               $skillsTb = $this->resume_Details->getSkillName($SkilNameArray);
               $skillsTbArry = $skillsTb->all();
               if (empty($skillsTbArry) == false) {
                   $no_num_add = $request->career_id;
                   //スキル追加
                   $this->resume_Details->addSkill($user_id, $no_num_add, $skillsTbArry);
               }
           }
       }
   }

    /**
     * レジュメ詳細(経歴書一覧)削除
     * @param $request
     * @return Redirector|RedirectResponse
     */
    public function destroy(Request $request):Redirector|RedirectResponse
    {
        $this->resume_Details->detailResumeDetails($request->user_id, $request);

        return redirect()->action('CareerListController@index', [
            'user_id' => Crypt::encryptString($request->user_id),
            'token' => session()->get('token')
        ]);
    }

    /**
     *  経歴一覧順番変更
     * @param $request
     * @return RedirectResponse
     */
    public function changeCareerNo(Request $request): RedirectResponse
    {
        $this->resume_Details->changeNumber($request, $request->user_id);
        return back();
    }

    /**
     * レジュメ詳細メール通知
     * @param $request
     * @param $mail_service
     * @return void
     */
    //NOTE:Slackで通知しているため使用していないので後で削除
    /*
    public function send(Request $request, MailService $mail_service):void
    {
        $mail_service->send_detail($request);
    }
    */

    /**
     * レビュー通知
     * @param $request
     * @param $mail_service
     * @return void
     */
     //NOTE:Slackで通知しているため使用していないので後で削除
    /*
    public function review(Request $request, MailService $mail_service):void
    {
        $mail_service->review($request);
    }
    */
}
