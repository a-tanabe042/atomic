<div class="modal" id="detailModal" role="dialog" data-backdrop="static">
        <div class="modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-color-brown">
                    <h4 class="modal-title text-white" id="myModalLabel">経歴追加</h4></h4>
                </div>
                <div class="modal-body">

                <form action="{{ route('createDetail.create', ['user_id'=> $user_id]) }}" method="post" onsubmit="return careerModalCheck(this)" id="new-resume">
                    @csrf
                    <table class="career_datail_top w-100" border="1">  
                            <tr class="sp-block pc-none">
                                <th class="required text-center sp-modal-title">期間</th>
                            </tr>
                            <tr>
                                <th class="required text-center sp-none">期間</th>
                                <td class="w-100 py-2 responsive px-2">
                                    <div id="add_err_msg_period" class="career_modal_err_msg"></div>
                                    <div class="form-select-wrap">
                                        <div class="d-flex">
                                                <select id ="add_text_year_from"  name="period_start_year" class="mr-1 period_check">
                                                    <option id="add_from_pj_year_op" class="add_from_pj_year d-none"></option>
                                                </select>
                                                <p class="m-0 period_text">年</p>
                                                <select id ="add_text_month_from" name="period_start_month" class="mx-1 period_check">
                                                    <option id="add_from_pj_month_op" class="add_from_pj_month d-none"></option>
                                                </select>
                                                <p class="m-0 period_text">月</p>
                                        </div>
                                        <p class="mx-2 my-0">~</p>
                                        <div class="d-flex">
                                            <select id ="add_select_year_to" name="period_finish_year" class="mr-1 period_check">
                                                <option id="add_to_pj_year_op" class="add_to_pj_year d-none"></option>
                                            </select> 
                                            <p id ="add_text_year" class="m-0 period_text">年</p>
                                            <select id ="add_select_month_to" name="period_finish_month" class="mx-1 period_check">
                                                <option id="add_to_pj_month_op" class="add_to_pj_month d-none"></option>
                                            </select>
                                            <p id ="add_text_month" class="m-0 period_text">月</p>
                                            <p id="add_text_current" class="my-0 mx-1 period_text">現在<p>
                                        </div>
                                        <div class="mx-1">
                                        <input type="hidden" name="current_period_flg" value="0" >
                                        <input id ="add_month" type="checkbox" name="current_period_flg" value="1" class="mr-2" onclick="current(this)" >現在
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="sp-block pc-none">
                                <th class="required text-center sp-modal-title">プロジェクト概要</th>
                            </tr>
                            <tr>
                                <th class="required text-center sp-none">プロジェクト概要</th>
                                <td class="w-100 py-2 responsive px-2">
                                    <div id="add_err_msg_pj_overview" class="career_modal_err_msg"></div>
                                    <input name="pj_overview"class="w-100 career_modal_check" >
                                </td>
                            </tr>
                            <tr class="sp-block pc-none">
                                <th class="required text-center sp-modal-title">プロジェクト人数</th>
                            </tr>
                            <tr>
                                <th class="required text-center sp-none">プロジェクト人数</th>
                                <td class="w-30 py-2 responsive px-2">
                                    <div id="add_err_msg_project_num" class="career_modal_err_msg num_only"></div>
                                    <input name="project_num"class="w-30 mr-1 career_modal_check" >人
                                </td>
                            </tr>
                            <tr class="sp-block pc-none">
                                <th class="required text-center sp-modal-title">業務内容</th>
                            </tr>
                            <tr>
                                <th class="required text-center sp-none">業務内容</th>
                                <td class="w-100 py-2 responsive px-2">
                                    <div id="add_err_msg_pj_contents" class="career_modal_err_msg"></div>
                                    <textarea name="pj_contents" class="w-100 career_modal_check pj-textarea"></textarea >
                                </td>
                            </tr>
                            <tr class="sp-block pc-none">
                                <th class="required text-center sp-modal-title">言語</th>
                            </tr>                              
                            <tr>
                                @php
                                    $skill_select = 0;
                                @endphp     
                                <th class="text-center sp-none" name="language">言語</th>
                                <td id="modal_language_td" class="w-100 p-2 text-center">
                                    <div id="add_err_msg_skill_language" class="career_modal_err_msg"></div>
                                    @for($i = 1; $i <= 2; $i++)
                                        <div class="skill_foam_area">
                                            @for($j = 1; $j <= 3; $j++)
                                            @php
                                                $skill_select ++;
                                            @endphp
                                                <select id="modal_language_select_{{$skill_select}}" name="modal_language[0][modal_language_select_{{$skill_select}}]" class="skill_foam_input modal_search_language">
                                                <option value=""></option>
                                                    @foreach ($skill_all_items as $skill_language_item)
                                                        @if($skill_language_item -> class_id == 1)
                                                            <option class="mai-{{ $skill_language_item -> skill_name }}"value="{{ $skill_language_item -> skill_name }}">{{ $skill_language_item -> skill_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @endfor
                                        </div>
                                    @endfor
                                    <div id="modal_language" class="w-100 mt-2 p-1 border border-dark btn btn--orange" onclick="formAdd(this,'modal_language','modal','language','')">
                                        <p class="m-1">＋</p>
                                    </div>
                                </td>
                            </tr>
                            <tr class="sp-block pc-none">
                                <th class="required text-center sp-modal-title">DB</th>
                            </tr>                              
                            <tr>
                                @php
                                    $skill_select = 0;
                                @endphp 
                                <th class="text-center sp-none" name="db">DB</th>
                                <td id="modal_db_td" class="w-100 p-2 text-center">
                                    <div id="add_err_msg_skill_db" class="career_modal_err_msg"></div>
                                    @for($i = 1; $i <= 2; $i++)
                                        <div class="skill_foam_area">
                                            @for($j = 1; $j <= 3; $j++)
                                            @php
                                                $skill_select ++;
                                            @endphp
                                                <select id="modal_db_select_{{$skill_select}}" name="modal_db[0][modal_db_select_{{$skill_select}}]" class="skill_foam_input modal_search_db">
                                                <option value=""></option>
                                                    @foreach ($skill_all_items as $skill_db_item)
                                                        @if($skill_db_item -> class_id == 2)
                                                            <option class="mai-{{ $skill_db_item -> skill_name }}"value="{{ $skill_db_item -> skill_name }}">{{ $skill_db_item -> skill_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @endfor
                                        </div>
                                    @endfor
                                     <div id="modal_db" class="w-100 mt-2 p-1 border border-dark btn btn--orange" onclick="formAdd(this,'modal_db','modal','db','')">
                                         <p class="m-1">＋</p>
                                     </div>
                                </td>
                            </tr>
                            <tr class="sp-block pc-none">
                                <th class="required text-center sp-modal-title">OS</th>
                            </tr>                              
                            <tr>
                            @php
                                $skill_select = 0;
                            @endphp     
                                <th class="text-center sp-none">OS</th>
                                <td id="modal_os_td" class="w-100 p-2 text-center">
                                    <div id="add_err_msg_skill_os" class="career_modal_err_msg"></div>
                                    @for($i = 1; $i <= 2; $i++)
                                        <div class="skill_foam_area">
                                            @for($j = 1; $j <= 3; $j++)
                                            @php
                                                $skill_select ++;
                                            @endphp
                                                <select id="modal_os_select_{{$skill_select}}" name="modal_os[0][modal_os_select_{{$skill_select}}]" class="skill_foam_input modal_search_os" >
                                                <option value=""></option>
                                                    @foreach ($skill_all_items as $skill_os_item)
                                                        @if($skill_os_item -> class_id == 3)
                                                            <option class="mai-{{ $skill_os_item -> skill_name }}"value="{{ $skill_os_item -> skill_name }}">{{ $skill_os_item -> skill_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @endfor
                                        </div>
                                    @endfor
                                    <div id="modal_os" class="w-100 mt-2 p-1 border border-dark btn btn--orange" onclick="formAdd(this,'modal_os','modal','os','')">
                                        <p class="m-1">＋</p>
                                    </div>
                                </td>
                            </tr>
                            <tr class="sp-block pc-none">
                                <th class="required text-center sp-modal-title">プラットフォーム</th>
                            </tr>                              
                            <tr>
                                @php
                                    $skill_select = 0;
                                    $temp_skill_name = "";
                                @endphp 

                                <th class="text-center sp-none">プラットフォーム</th>
                                <td id="modal_platform_td" class="w-100 p-2 text-center">
                                    <div id="add_err_msg_skill_platform" class="career_modal_err_msg"></div>
                                    @for($i = 1; $i <= 2; $i++)
                                        <div class="skill_foam_area">
                                            @for($j = 1; $j <= 3; $j++) 
                                            @php
                                                $skill_select ++;
                                                $sub_class_name_flg = 0;
                                                $sub_class_name_array = [];
                                            @endphp    
                                            <select id="modal_platform_select_{{$skill_select}}" name="modal_platform[0][modal_platform_select_{{$skill_select}}]" class="skill_foam_input modal_search_platform" >
                                                 <option></option >
                                                 @foreach ($skill_all_items as $skill_platform_list_item)
                                                    @if($skill_platform_list_item -> class_id == 5)
                                                        @php
                                                            $temp_skill_name = $skill_platform_list_item -> sub_class_name;
                                                            $sub_class_name_flg = in_array($temp_skill_name, $sub_class_name_array);
                                                            array_push($sub_class_name_array, $temp_skill_name);
                                                        @endphp

                                                        @if($sub_class_name_flg == 1)
                                                            @php
                                                                continue;
                                                            @endphp
                                                        @endif
                                                        <optgroup id="{{ $skill_platform_list_item -> sub_class_name }}_{{$skill_select}}" class="mai-{{ $skill_platform_list_item -> sub_class_name }}" label="{{ $skill_platform_list_item -> sub_class_name }}">
                                                        @foreach ($skill_all_items as $skill_platform_item)
                                                            @if( $skill_platform_list_item -> sub_class_name == $skill_platform_item -> sub_class_name)
                                                                @if( $skill_platform_list_item -> sub_class_name !== $skill_platform_item -> skill_name)
                                                                    <option class="sub-option sub_option_select_{{ $skill_platform_item -> sub_class_name }}_{{$skill_select}} {{ $skill_platform_item -> sub_class_name }}"value="{{ $skill_platform_item -> skill_name }}">{{ $skill_platform_item -> skill_name }}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        </optgroup> 
                                                    @endif
                                                 @endforeach
                                            </select>  
                                            @endfor
                                        </div>
                                    @endfor
                                    <div id="modal_platform" class="w-100 mt-2 p-1 border border-dark btn btn--orange" onclick="formAdd(this,'modal_platform','modal','platform','')">
                                        <p class="m-1">＋</p>
                                    </div>
                                </td>
                            </tr>
                            <tr class="sp-block pc-none">
                                <th class="required text-center sp-modal-title">ミドルウェア</th>
                            </tr>                              
                            <tr>  
                            @php
                                $skill_select = 0;
                            @endphp                                                
                                <th class="text-center sp-none">ミドルウェア</th>
                                <td id="modal_middleware_td" class="w-100 p-2 text-center">
                                    <div id="add_err_msg_skill_middleware" class="career_modal_err_msg"></div>
                                    @for($i = 1; $i <= 2; $i++)
                                        <div class="skill_foam_area">
                                            @for($j = 1; $j <= 3; $j++)
                                            @php
                                                $skill_select ++;
                                            @endphp
                                                <select id="modal_middleware_select_{{$skill_select}}" name="modal_middleware[0][modal_middleware_select_{{$skill_select}}]" class="skill_foam_input modal_search_middleware">
                                                <option value=""></option>
                                                    @foreach ($skill_all_items as $skill_middleware_item)
                                                        @if($skill_middleware_item -> class_id == 4)
                                                            <option class="mai-{{ $skill_middleware_item -> skill_name }}"value="{{ $skill_middleware_item -> skill_name }}">{{ $skill_middleware_item -> skill_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @endfor
                                        </div>
                                    @endfor
                                    <div id="modal_middleware" class="w-100 mt-2 p-1 border border-dark btn btn--orange" onclick="formAdd(this,'modal_middleware','modal','middleware','')">
                                        <p class="m-1">＋</p>
                                    </div>
                                </td>
                            <tr class="sp-block pc-none">
                                <th class="required text-center sp-modal-title">Framework</th>
                            </tr>                              
                            <tr>
                            @php
                                $skill_select = 0;
                                $temp_skill_name = "";
                            @endphp 
                                <th class="text-center sp-none">Framework</th>
                                <td id="modal_framework_td" class="w-100 p-2 text-center">
                                    <div id="add_err_msg_skill_framework" class="career_modal_err_msg"></div>
                                    @for($i = 1; $i <= 2; $i++)
                                        <div class="skill_foam_area">
                                            @for($j = 1; $j <= 3; $j++) 
                                            @php
                                                $skill_select ++;
                                                $sub_class_name_flg = 0;
                                                $sub_class_name_array = [];
                                            @endphp    
                                            <select id="modal_framework_select_{{$skill_select}}" name="modal_framework[0][modal_framework_select_{{$skill_select}}]" class="skill_foam_input modal_search_framework" >
                                                 <option></option >
                                                 @foreach ($skill_all_items as $skill_framework_list_item)
                                                    @if($skill_framework_list_item -> class_id == 6)
                                                        @php
                                                            $temp_skill_name = $skill_framework_list_item -> sub_class_name;
                                                            $sub_class_name_flg = in_array($temp_skill_name, $sub_class_name_array);
                                                            array_push($sub_class_name_array, $temp_skill_name);
                                                        @endphp

                                                        @if($sub_class_name_flg == 1)
                                                            @php
                                                                continue;
                                                            @endphp
                                                        @endif
                                                        <optgroup id="{{ $skill_framework_list_item -> sub_class_name }}_{{$skill_select}}" class="mai-{{ $skill_framework_list_item -> sub_class_name }}" label="{{ $skill_framework_list_item -> sub_class_name }}">
                                                        @foreach ($skill_all_items as $skill_framework_item)
                                                            @if( $skill_framework_list_item -> sub_class_name == $skill_framework_item -> sub_class_name)
                                                                @if( $skill_framework_list_item -> sub_class_name !== $skill_framework_item -> skill_name)
                                                                    <option class="sub-option sub_option_select_{{ $skill_framework_item -> sub_class_name }}_{{$skill_select}} {{ $skill_framework_item -> sub_class_name }}"value="{{ $skill_framework_item -> skill_name }}">{{ $skill_framework_item -> skill_name }}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        </optgroup>  
                                                    @endif
                                                 @endforeach
                                            </select>  
                                            @endfor
                                        </div>
                                    @endfor
                                    <div id="modal_framework" class="w-100 mt-2 p-1 border border-dark btn btn--orange" onclick="formAdd(this,'modal_framework','modal','framework','')">
                                        <p class="m-1">＋</p>
                                    </div>
                                </td>
                            </tr>
                            <tr class="sp-block pc-none">
                                <th class="required text-center sp-modal-title">その他</th>
                            </tr>                              
                            <tr>
                            @php
                                $skill_select = 0;
                                $temp_skill_name = "";
                            @endphp 
                                <th class="text-center sp-none">その他</th>
                                <td id="modal_others_td" class="w-100 p-2 text-center">
                                    <div id="add_err_msg_skill_others" class="career_modal_err_msg"></div>
                                    @for($i = 1; $i <= 2; $i++)
                                        <div class="skill_foam_area">
                                            @for($j = 1; $j <= 3; $j++) 
                                            @php
                                                $skill_select ++;
                                                $sub_class_name_flg = 0;
                                                $sub_class_name_array = [];
                                            @endphp    
                                            <select id="modal_others_select_{{$skill_select}}" name="modal_others[0][modal_others_select_{{$skill_select}}]" class="skill_foam_input modal_search_others" >
                                                 <option></option >
                                                 @foreach ($skill_all_items as $skill_others_list_item)
                                                    @if($skill_others_list_item -> class_id == 7)
                                                        @php
                                                            $temp_skill_name = $skill_others_list_item -> sub_class_name;
                                                            $sub_class_name_flg = in_array($temp_skill_name, $sub_class_name_array);
                                                            array_push($sub_class_name_array, $temp_skill_name);
                                                        @endphp

                                                        @if($sub_class_name_flg == 1)
                                                            @php
                                                                continue;
                                                            @endphp
                                                        @endif
                                                        <optgroup id="{{ $skill_others_list_item -> sub_class_name }}_{{$skill_select}}" class="mai-{{ $skill_others_list_item -> sub_class_name }}" label="{{ $skill_others_list_item -> sub_class_name }}">
                                                        @foreach ($skill_all_items as $skill_others_item)
                                                            @if( $skill_others_list_item -> sub_class_name == $skill_others_item -> sub_class_name)
                                                                @if( $skill_others_list_item -> sub_class_name !== $skill_others_item -> skill_name)
                                                                    <option class="sub-option sub_option_select_{{ $skill_others_item -> sub_class_name }}_{{$skill_select}} {{ $skill_others_item -> sub_class_name }}"value="{{ $skill_others_item -> skill_name }}">{{ $skill_others_item -> skill_name }}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        </optgroup >
                                                    @endif
                                                 @endforeach
                                            </select>  
                                            @endfor
                                        </div>
                                    @endfor
                                    <div id="modal_others" class="w-100 mt-2 p-1 border border-dark btn btn--orange" onclick="formAdd(this,'modal_others','modal','others','')">
                                        <p class="m-1">＋</p>
                                    </div>
                                </td>
                             </tr>
                        </table>
                        <table class="career_datail_bottom w-100" border="1">
                            <tbody class="work_table sp-none">
                                <tr>
                                    <th class="w-25 career_role_title text-center" rowspan="5">工程</th>
                                    <th class="pl-2">要件定義</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_requirement" type="checkbox" name="requirement" value="1" onchange="inputChange(this,'','pc','requirement','modal')" >
                                    </td>
                                    <th class="pl-2">開発</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_development" type="checkbox" name="development" value="1" onchange="inputChange(this,'','pc','development','modal')" >
                                    </td>
                                    <th class="pl-2">総合試験</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_comprehensive_test" type="checkbox" name="comprehensive_test" value="1" onchange="inputChange(this,'','pc','comprehensive_test','modal')">
                                    </td>
                                    <th class="pl-2">運用保守</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_operation_maintenance" type="checkbox" name="operation_maintenance" value="1" onchange="inputChange(this,'','pc','operation_maintenance','modal')">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="pl-2">基本設計</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_basic_design" type="checkbox" name="basic_design" value="1" onchange="inputChange(this,'','pc','basic_design','modal')">
                                    </td>
                                    <th class="pl-2">単体試験</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_unit_test" type="checkbox" name="unit_test" value="1" onchange="inputChange(this,'','pc','unit_test','modal')" >
                                    </td>
                                    <th class="pl-2">運用試験</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_operation_test" type="checkbox" name="operation_test" value="1" onchange="inputChange(this,'','pc','operation_test','modal')">
                                    </td>
                                    <th class="pl-2">調査</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_survey" type="checkbox" name="survey" value="1" onchange="inputChange(this,'','pc','survey','modal')">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="pl-2">詳細設計</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_detail_design" type="checkbox" name="detail_design" value="1" onchange="inputChange(this,'','pc','detail_design','modal')">
                                    </td>
                                    <th class="pl-2">結合試験</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_integration_test" type="checkbox" name="integration_test" value="1" onchange="inputChange(this,'','pc','integration_test','modal')">
                                    </td>
                                    <th class="pl-2">環境構築</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_environment" type="checkbox" name="environment" value="1" onchange="inputChange(this,'','pc','environment','modal')">
                                    </td>
                                    <th class="pl-2">教育</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_education" type="checkbox" name="education" value="1" onchange="inputChange(this,'','pc','education','modal')">
                                    </td>
                                </tr>
                            </tbody>
                            <tbody class="work_table sp-block pc-none">
                                    <tr>
                                        <th class="w-25 career_role_title text-center sp-modal-title" colspan="4">工程</th>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">要件定義</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_requirement" type="checkbox" name="requirement" value="1" onchange="inputChange(this,'','sp','requirement','modal')">
                                        </td>
                                        <th class=" pl-2">総合試験</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_comprehensive_test" type="checkbox" name="comprehensive_test" value="1" onchange="inputChange(this,'','sp','comprehensive_test','modal')">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">基本設計</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_basic_design" type="checkbox" name="basic_design" value="1"  onchange="inputChange(this,'','sp','basic_design','modal')">
                                        </td>
                                        <th class="pl-2">運用試験</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_operation_maintenance" type="checkbox" name="operation_maintenance" value="1"  onchange="inputChange(this,'','sp','operation_maintenance','modal')">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">詳細設計</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_detail_design" type="checkbox" name="detail_design" value="1" onchange="inputChange(this,'','sp','detail_design','modal')">
                                        </td>
                                        <th class=" pl-2">環境構築</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_environment" type="checkbox" name="environment" value="1"  onchange="inputChange(this,'','sp','environment','modal')">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class=" pl-2">開発</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_development" type="checkbox" name="development" value="1" onchange="inputChange(this,'','sp','development','modal')">
                                        </td>
                                        <th class="pl-2">運用保守</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_operation_test" type="checkbox" name="operation_test" value="1" onchange="inputChange(this,'','sp','operation_test','modal')">
                                         </td>
                                    </tr>
                                    <tr>
                                        <th class=" pl-2">単体試験</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_unit_test" type="checkbox" name="unit_test" value="1" onchange="inputChange(this,'','sp','unit_test','modal')">
                                        </td>
                                        <th class=" pl-2">調査</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_survey"  type="checkbox" name="survey" value="1" onchange="inputChange(this,'','sp','survey','modal')">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">結合試験</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_integration_test" type="checkbox" name="integration_test" value="1"  onchange="inputChange(this,'','sp','integration_test','modal')">
                                        </td>
                                        <th class=" pl-2">教育</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_education" type="checkbox" name="education" value="1" onchange="inputChange(this,'','sp','education','modal')">
                                        </td>
                                    </tr>
                                </tbody>
                            <tbody class="role_table sp-none">
                            <tr>
                                <th class="w-25 role_title position-relative text-center" rowspan="5">役割
                                    <div class="tooltip1">
                                        <img src="{{ asset('img/Question.png') }}" class="posQ">
                                        <div class="description1">
                                            ※PM(プロジェクトマネージャー)、PMO(プロジェクトマネジメントオフィス)、PL(プロジェクトリーダー)、<br>
                                            SL(サブリーダー)、SE(システムエンジニア)、PG(プログラマー)、TS(テスター)、PS(プリセールス)、OM(運用保守)、HD(ヘルプデスク)
                                        </div>
                                    </div>
                                </th>
                                    <th class="pl-2">PM</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_pm" type="checkbox" name="pm" value="1" onchange="inputChange(this,'','pc','pm','modal')">
                                    </td>
                                    <th class="pl-2">SL</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_sl" type="checkbox" name="sl" value="1" onchange="inputChange(this,'','pc','sl','modal')">
                                    </td>
                                    <th class="pl-2">TS</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_ts" type="checkbox" name="ts" value="1" onchange="inputChange(this,'','pc','ts','modal')">
                                    </td>
                                    <th class="pl-2">HD</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_hd" type="checkbox" name="hd" value="1" onchange="inputChange(this,'','pc','hd','modal')">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="pl-2">PMO</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_pmo" type="checkbox" name="pmo" value="1" onchange="inputChange(this,'','pc','pmo','modal')">
                                    </td>
                                    <th class="pl-2">SE</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_se" type="checkbox" name="se" value="1" onchange="inputChange(this,'','pc','se','modal')">
                                    </td>
                                    <th class="pl-2">PS</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_ps" type="checkbox" name="ps" value="1" onchange="inputChange(this,'','pc','ps','modal')">
                                    </td>
                                    <th class="pl-2">その他</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_other" type="checkbox" name="other" value="1"  onchange="inputChange(this,'','pc','other','modal')">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="pl-2">PL</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_pl" type="checkbox" name="pl" value="1" onchange="inputChange(this,'','pc','pl','modal')">
                                    </td>
                                    <th class="pl-2">PG</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_pg" type="checkbox" name="pg" value="1" onchange="inputChange(this,'','pc','pg','modal')">
                                    </td>
                                    <th class="pl-2">OM</th>
                                    <td class="text-center w-5">
                                        <input id="modal_pc_om" type="checkbox" name="om" value="1" onchange="inputChange(this,'','pc','om','modal')">
                                    </td>
                                </tr>
                            </tbody>
                            <tbody class="role_table sp-block pc-none">
                                    <tr>
                                        <th class="w-25 role_title position-relative text-center sp-modal-title" colspan="4">役割
                                            <div class="tooltip1">
                                                <img src="{{ asset('img/Question.png') }}" class="posQ">
                                                <div class="description1">
                                                    ※PM(プロジェクトマネージャー)、PMO(プロジェクトマネジメントオフィス)、PL(プロジェクトリーダー)、<br>
                                                    SL(サブリーダー)、SE(システムエンジニア)、PG(プログラマー)、TS(テスター)、PS(プリセールス)、OM(運用保守)、HD(ヘルプデスク)
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">PM</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_pm" type="checkbox" name="pm" value="1" onchange="inputChange(this,'','sp','pm','modal')">
                                        </td>
                                        <th class="pl-2">TS</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_ts" type="checkbox" name="ts" value="1" onchange="inputChange(this,'','sp','ts','modal')">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">PMO</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_pmo" type="checkbox" name="pmo" value="1" onchange="inputChange(this,'','sp','pmo','modal')">
                                        </td>
                                        <th class="pl-2">PS</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_ps" type="checkbox" name="ps" value="1" onchange="inputChange(this,'','sp','ps','modal')">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">PL</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_pl" type="checkbox" name="pl" value="1" onchange="inputChange(this,'','sp','pl','modal')">
                                        </td>
                                        <th class="pl-2">OM</th>
                                        <td class="text-center w-5">
                                            <input  id="modal_sp_om" type="checkbox" name="om" value="1" onchange="inputChange(this,'','sp','om','modal')">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">SL</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_sl" type="checkbox" name="sl" value="1" onchange="inputChange(this,'','sp','sl','modal')">
                                        </td>
                                        <th class="pl-2">HD</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_hd" type="checkbox" name="hd" value="1"  onchange="inputChange(this,'','sp','hd','modal')">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">SE</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_se" type="checkbox" name="se" value="1" onchange="inputChange(this,'','sp','se','modal')">
                                        </td>
                                        <th class="pl-2">その他</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_other" type="checkbox" name="other" value="1" onchange="inputChange(this,'','sp','other','modal')">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">PG</th>
                                        <td class="text-center w-5">
                                            <input id="modal_sp_pg" type="checkbox" name="pg" value="1" onchange="inputChange(this,'','sp','pg','modal')">
                                        </td>
                                    </tr>
                                </tbody>
                            <tbody class="training_table">
                                <tr class="sp-block pc-none">
                                    <th class="w-25 role_title position-relative text-center sp-modal-title" rowspan="5">研修
                                        <div class="tooltip1">
                                            <img src="{{ asset('img/Question.png') }}" class="posQ">
                                            <div class="description1">
                                                新卒研修またはその他の研修の場合は、チェックしてください。
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="w-25 role_title position-relative text-center sp-none" rowspan="5">研修
                                        <div class="tooltip1 sp-none">
                                            <img src="{{ asset('img/Question.png') }}" class="posQ">
                                            <div class="description1">
                                                新卒研修またはその他の研修の場合は、チェックしてください。
                                            </div>
                                        </div>
                                    </th>
                                    </td>
                                       <th class="pl-2 sp-none">研修</th>
                                       <td class="text-center w-5">
                                           <input type="checkbox" name="training_flg" value="1">
                                       </td>
                                    </tr>
                            </tbody>

                        </table>
                        <div class="modal-footer">
                                <input type="reset" value="キャンセル" class="btn btn-default" data-dismiss="modal" form="new-resume" id="resumeReset" onclick="formReset(this.id)">
                                <button type="submit" class="btn btn-danger menu_keep_button">登録</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>