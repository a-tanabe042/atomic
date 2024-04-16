<div class="tab_content mb-0 label-style" id="career_list_content">
    <div class="tab_content_detail">
        <div class="career_list_area">
        @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')
            <div class="detail-btn my-2">
                <div class="change-btn1 col-md-8">
                    <button type="button" id="changeBtn" class="btn">並び替え</button>
                </div>
                <div class="change-btn num-changes col-md-8">
                    <input type="reset" value="キャンセル" id="changeCancelBtn" class="btn">
                    <form id="career_num" action="{{ route('no_num.update',  ['user_id' => $user_id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn menu_keep_button">並び替え保存</button>
                    </form>
                </div>
                <div class="text-right col-md-4">
                    <button type="button" class="btn--orange btn"  data-toggle="modal" data-target="#detailModal" onclick="addSelect2()">追加</button>
                </div>    
            </div>
        @endif 
            @include('resumeDetailModal', ['user_id' => $user_id])
        <div id="show_area">
            <div class="d-flex datail_title_style" id="career_list_title">
                <div id="changeArea" class="num-change"></div>
                <div class="career-no career-no-title">No</div>
                <div class="career-date career-no-title">期間</div>
                <div class="career-contents d-sm-block">プロジェクト概要</div>
                @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')     
                    <div class="career-action text-center"></div>
                @endif   
            </div>
            
            @foreach ($career_items as $career_item)
                <div id="career_list_itms_area-{{$career_item->career_id}}" class="career_list_itms_area d-block">
                
                <form id="del-career" action="{{ route('createDetail.destroy',  ['no' => $career_item->career_id, 'num' => $career_item->no_num, 'user_id' => $user_id]) }}" method="POST">
                    @csrf
                    @method('delete')
                    <input type="checkbox" id= label-id-{{$career_item->career_id}} name="detail-veim" class="d-none"  onchange="labelDisplay(this,{{$career_item->career_id}})">

                        <div class="career_list career_list_itms sukoshi">           

                            <label for="example-id-{{$career_item->career_id}}" class="w-100 d-flex">
                                <div id="changeArea" class="num-change">
                                    <input type="button" value="⇈" onclick="moveTop(this)">
                                    <input type="button" value="↑" onclick="moveUp(this)">
                                    <input type="button" value="↓" onclick="moveDown(this)">
                                    <input type="button" value="⇊" onclick="moveBottom(this)">
                                </div>
                                <div class="career-no text-center career-no-title">
                                    {{$career_item->no_num}}
                                    <input type="hidden" name="no_num[]" form="career_num" value="{{$career_item->career_id}}">
                                </div>
                                <div name="career_id" class="career-date text-center career-no-title">
                                    {{ Str::substr($career_item->start_period, 0, 4) }}年
                                    {{ Str::substr($career_item->start_period, 4, 2) }}月
                                    <br>
                                    ~
                                    <br>
                                    @if($career_item->current_period_flg == 0)
                                    {{ Str::substr($career_item->finish_period, 0, 4) }}年
                                    {{ Str::substr($career_item->finish_period, 4, 2) }}月
                                    @else
                                    現在
                                    @endif
                                </div>
                                <div name="pj_contents" class="career-contents d-sm-block">{{nl2br($career_item->pj_overview)}}</div>   
                            </label>
                            <div class="career-action text-center">  
                            <button data-user-id="{{ $user_id }}" data-career-id="{{ $career_item->career_id }}" id= career_datail_display-{{$career_item->career_id}} type="button" class="btn mt-1 data-toggle" onclick="DisplaBty(this,{{$career_item->career_id}})">詳細</button>
                            @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')         
                                <button id=career_datail_edit-{{$career_item->career_id}} type="button" class="btn mt-1" onclick="editMode(this,{{$career_item->career_id}})">編集</button>
                                <button type="submit" class="btn my-1 menu_keep_button" onClick="return delete_alert_detaill(event);">削除</button>
                            @endif
                            </div>                             
                        </div> 
                    </form>                                    
                    <input type="checkbox" id= example-id-{{$career_item->career_id}} name="checkbox_example" class="d-none" onchange="labelDisplay(this,{{$career_item->career_id}})">             
                    <div  id= career_list_datail-{{$career_item->career_id}} class="career_list_datail" onclick="myFnc(this,{{$career_item->career_id}})">
                        <div>
                            <div class="career-no career-no-border">
                                <label class="no_num">{{$career_item->no_num}}</lavel>
                            </div>
                        <div id=career_datail-{{$career_item->career_id}}  class="career_datail w-100">
                            <table class="career_datail_top w-100" border="1">
                                <tr class="sp-block pc-none">
                                    <th class="text-center sp-title">期間</th>
                                </tr>
                                <tr>
                                    <th class="text-center sp-none">期間</th>
                                    <td class="pl-2 sp_foam_height">

                                        {{ Str::substr($career_item->start_period, 0, 4) }}年
                                        {{ Str::substr($career_item->start_period, 4, 2) }}月
                                        ~
                                        @if($career_item->current_period_flg == 0)
                                        {{ Str::substr($career_item->finish_period, 0, 4) }}年
                                        {{ Str::substr($career_item->finish_period, 4, 2) }}月
                                        @else
                                        現在
                                        @endif
                                    </td>
                                </tr>
                                <tr class="sp-block pc-none">
                                    <th class="text-center sp-title">プロジェクト概要</th>
                                </tr>
                                <tr>
                                    <th class="text-center sp-none">プロジェクト概要</th>
                                    <td class="pl-2 sp_foam_height">{{$career_item->pj_overview}}</td>
                                </tr>
                                <tr class="sp-block pc-none">
                                    <th class="text-center sp-title">プロジェクト人数</th>
                                </tr>
                                <tr>
                                    <th class="text-center sp-none">プロジェクト人数</th>
                                    <td class="pl-2 sp_foam_height">{{$career_item->project_num}}人</td>
                                </tr>
                                <tr class="sp-block pc-none">
                                    <th class="text-center sp-title">業務内容</th>
                                </tr>
                                <tr>
                                    <th class="text-center sp-none">業務内容</th>
                                    <td class="pl-2 sp_foam_height">{!! nl2br($career_item->pj_contents) !!}</td>
                                </tr>
                                <tr class="sp-block pc-none">
                                    <th class="text-center sp-title">言語</th>
                                </tr>
                                {{-- ”言語カウント”スタート --}}
                                    <?php
                                        $language_count = 0;
                                        $db_count = 0;
                                        $os_count = 0;
                                        $platform_count = 0;
                                        $middleware_count = 0;
                                        $framework_count = 0;
                                        $others_count = 0;
                                    ?>
                                @foreach ($career_items_skill as $career_item_skill)
                                    @if($career_item_skill->career_id == $career_item->career_id && $career_item_skill->class_id == 1)
                                        <?php $language_count++; ?>
                                    @elseif($career_item_skill->career_id == $career_item->career_id && $career_item_skill->class_id == 2)
                                        <?php $db_count++; ?>
                                    @elseif($career_item_skill->career_id == $career_item->career_id && $career_item_skill->class_id == 3)
                                        <?php $os_count++; ?>
                                    @elseif($career_item_skill->career_id == $career_item->career_id && $career_item_skill->class_id == 4)
                                        <?php $middleware_count++; ?>
                                    @elseif($career_item_skill->career_id == $career_item->career_id && $career_item_skill->class_id == 5)
                                        <?php $platform_count++; ?>
                                    @elseif($career_item_skill->career_id == $career_item->career_id && $career_item_skill->class_id == 6)
                                        <?php $framework_count++; ?>
                                    @elseif($career_item_skill->career_id == $career_item->career_id && $career_item_skill->class_id == 7)
                                        <?php $others_count++; ?>
                                    @endif
                                @endforeach
                                {{-- 終了 --}}
                                <tr>
                                    <th class="text-center sp-none">言語</th>
                                    <td class="pl-2 sp_foam_height">
                                        <?php $i = 0; ?>                                      
                                        @foreach ($career_items_skill as $career_item_skill)
                                            @if($career_item_skill->career_id == $career_item->career_id && $career_item_skill->class_id == 1)
                                                {{$career_item_skill->skill_name}}
                                                <?php $i++; ?>
                                                @if($i < $language_count)
                                                    /
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr class="sp-block pc-none">
                                    <th class="text-center sp-title">DB</th>
                                </tr>
                                <tr>
                                    <th class="text-center sp-none">DB</th>
                                    <td class="pl-2 sp_foam_height">
                                        <?php $i = 0; ?>                                                
                                        @foreach ($career_items_skill as $career_item_skill)
                                            @if($career_item_skill->career_id == $career_item->career_id && $career_item_skill->class_id == 2)
                                                {{$career_item_skill->skill_name}}
                                                <?php $i++; ?>
                                                @if($i < $db_count)
                                                    /
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr class="sp-block pc-none">
                                    <th class="text-center sp-title">OS</th>
                                </tr>
                                <tr>
                                    <th class="text-center sp-none">OS</th>
                                    <td class="pl-2 sp_foam_height">
                                        <?php $i = 0; ?>                                                       
                                        @foreach ($career_items_skill as $career_item_skill)
                                            @if($career_item_skill->career_id == $career_item->career_id && $career_item_skill->class_id == 3)
                                                {{$career_item_skill->skill_name}}
                                                <?php $i++; ?>
                                                @if($i < $os_count)
                                                    /
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                </tr> 
                                <tr class="sp-block pc-none">
                                    <th class="text-center sp-title">プラットフォーム</th>
                                </tr>      
                                <tr>
                                    <th class="text-center sp-none">プラットフォーム</th>
                                    <td class="pl-2 sp_foam_height">
                                        <?php $i = 0; ?>                                                      
                                        @foreach ($career_items_skill as $career_item_skill)
                                            @if($career_item_skill->career_id == $career_item->career_id && $career_item_skill->class_id == 5)
                                                {{$career_item_skill->skill_name}}
                                                <?php $i++; ?>
                                                @if($i < $platform_count)
                                                    /
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>

                                <tr class="sp-block pc-none">
                                    <th class="text-center sp-title">ミドルウェア</th>
                                </tr>      
                                <tr>                                             
                                    <th class="text-center sp-none">ミドルウェア</th>
                                    <td class="pl-2 sp_foam_height">
                                        <?php $i = 0; ?>                                                      
                                        @foreach ($career_items_skill as $career_item_skill)
                                            @if($career_item_skill->career_id == $career_item->career_id && $career_item_skill->class_id == 4)
                                                {{$career_item_skill->skill_name}}
                                                <?php $i++; ?>
                                                @if($i < $middleware_count)
                                                    /
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr class="sp-block pc-none">
                                    <th class="text-center sp-title">Framework</th>
                                </tr>      
                                <tr>
                                    <th class="text-center sp-none">Framework</th>
                                    <td class="pl-2 sp_foam_height">
                                        <?php $i = 0; ?>                                                      
                                        @foreach ($career_items_skill as $career_item_skill)
                                            @if($career_item_skill->career_id == $career_item->career_id && $career_item_skill->class_id == 6)
                                                {{$career_item_skill->skill_name}}
                                                <?php $i++; ?>
                                                @if($i < $framework_count)
                                                    /
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr class="sp-block pc-none">
                                    <th class="text-center sp-title">その他</th>
                                </tr>      
                                <tr>
                                    <th class="text-center sp-none">その他</th>
                                    <td class="pl-2 sp_foam_height">
                                        <?php $i = 0; ?>                                                      
                                        @foreach ($career_items_skill as $career_item_skill)
                                            @if($career_item_skill->career_id == $career_item->career_id && $career_item_skill->class_id == 7)
                                                {{$career_item_skill->skill_name}}
                                                <?php $i++; ?>
                                                @if($i < $others_count)
                                                    /
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                 </tr>
                            </table>
                            <table class="career_datail_bottom w-100">
                                <tbody class="work_table sp-none">
                                    <tr>
                                        <th class="w-25 career_role_title text-center" rowspan="5">工程</th>
                                        <th class=" pl-2">要件定義</th>
                                        <td class="w-5">
                                             @if($career_item->requirement == 1)
                                                 <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class=" pl-2">開発</th>
                                        <td class="w-5">
                                            @if($career_item->development == 1)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class=" pl-2">総合試験</th>
                                        <td class="w-5">
                                            @if($career_item->comprehensive_test == 1)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class=" pl-2">運用保守</th>
                                        <td class="w-5">
                                          @if($career_item->operation_maintenance == 1)
                                              <p class="work_role">〇</p>
                                          @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class=" pl-2">基本設計</th>
                                        <td class="w-5">
                                            @if($career_item->basic_design == 1)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class=" pl-2">単体試験</th>
                                        <td class="w-5">
                                            @if($career_item->unit_test == 1)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class=" pl-2">運用試験</th>
                                        <td class="w-5">
                                            @if($career_item->operation_test == 1)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class=" pl-2">調査</th>
                                        <td class="w-5">
                                            @if($career_item->survey == 1)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class=" pl-2">詳細設計</th>
                                        <td class="w-5">
                                            @if($career_item->detail_design == 1)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class=" pl-2">結合試験</th>
                                        <td class="w-5">
                                          @if($career_item->integration_test == 1)
                                              <p class="work_role">〇</p>
                                          @endif
                                        </td>
                                        <th class=" pl-2">環境構築</th>
                                        <td class="w-5">
                                            @if($career_item->environment == 1)
                                                <p class="work_role">〇</p>
                                             @endif
                                        </td>
                                        <th class=" pl-2">教育</th>
                                        <td class="w-5">
                                            @if($career_item->education == 1)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody class="work_table sp-block pc-none">
                                    <tr>
                                        <th class="w-25 career_role_title text-center sp-title" colspan="4">工程</th>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">要件定義</th>
                                        <td class="w-5">
                                             @if($career_item->requirement == 1)
                                                 <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class=" pl-2">総合試験</th>
                                        <td class="w-5">
                                            @if($career_item->comprehensive_test == 1)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">基本設計</th>
                                        <td class="w-5">
                                            @if($career_item->basic_design == 1)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class="pl-2">運用試験</th>
                                        <td class="w-5">
                                            @if($career_item->operation_test == 1)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">詳細設計</th>
                                        <td class="w-5">
                                            @if($career_item->detail_design == 1)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class=" pl-2">環境構築</th>
                                        <td class="w-5">
                                            @if($career_item->environment == 1)
                                                <p class="work_role">〇</p>
                                             @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class=" pl-2">開発</th>
                                        <td class="w-5">
                                            @if($career_item->development == 1)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class="pl-2">運用保守</th>
                                        <td class="w-5">
                                          @if($career_item->operation_maintenance == 1)
                                              <p class="work_role">〇</p>
                                          @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class=" pl-2">単体試験</th>
                                        <td class="w-5">
                                            @if($career_item->unit_test == 1)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class=" pl-2">調査</th>
                                        <td class="w-5">
                                            @if($career_item->survey == 1)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">結合試験</th>
                                        <td class="w-5">
                                          @if($career_item->integration_test == 1)
                                              <p class="work_role">〇</p>
                                          @endif
                                        </td>
                                        <th class=" pl-2">教育</th>
                                        <td class="w-5">
                                            @if($career_item->education == 1)
                                                <p class="work_role">〇</p>
                                            @endif
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
                                        <td class="w-5">
                                            @if($career_item->role_pm)
                                               <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class="pl-2">SL</th>
                                        <td class="w-5">
                                            @if($career_item->role_sl)
                                                <p class="work_role">〇</p>
                                             @endif
                                        </td>
                                        <th class="pl-2">TS</th>
                                        <td class="w-5">
                                            @if($career_item->role_ts)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class="pl-2">HD</th>
                                        <td class="w-5">
                                            @if($career_item->role_hd)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">PMO</th>
                                        <td class="w-5">
                                            @if($career_item->role_pmo)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class="pl-2">SE</th>
                                        <td class="w-5">
                                            @if($career_item->role_se)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class="pl-2">PS</th>
                                        <td class="w-5">
                                            @if($career_item->role_ps)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class="pl-2">その他</th>
                                        <td class="w-5">
                                            @if($career_item->role_other)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">PL</th>
                                        <td class="w-5">
                                            @if($career_item->role_pl)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class="pl-2">PG</th>
                                        <td class="w-5">
                                            @if($career_item->role_pg)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class="pl-2">OM</th>
                                        <td class="w-5">
                                            @if($career_item->role_om)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody class="role_table sp-block pc-none">
                                    <tr>
                                        <th class="w-25 role_title position-relative text-center sp-title" colspan="4">役割
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
                                        <td class="w-5">
                                            @if($career_item->role_pm)
                                               <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class="pl-2">TS</th>
                                        <td class="w-5">
                                            @if($career_item->role_ts)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">PMO</th>
                                        <td class="w-5">
                                            @if($career_item->role_pmo)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class="pl-2">PS</th>
                                        <td class="w-5">
                                            @if($career_item->role_ps)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">PL</th>
                                        <td class="w-5">
                                            @if($career_item->role_pl)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class="pl-2">OM</th>
                                        <td class="w-5">
                                            @if($career_item->role_om)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">SL</th>
                                        <td class="w-5">
                                            @if($career_item->role_sl)
                                                <p class="work_role">〇</p>
                                             @endif
                                        </td>
                                        <th class="pl-2">HD</th>
                                        <td class="w-5">
                                            @if($career_item->role_hd)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">SE</th>
                                        <td class="w-5">
                                            @if($career_item->role_se)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                        <th class="pl-2">その他</th>
                                        <td class="w-5">
                                            @if($career_item->role_other)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="pl-2">PG</th>
                                        <td class="w-5">
                                            @if($career_item->role_pg)
                                                <p class="work_role">〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody class="training_table">
                                    <tr class="sp-block pc-none">
                                        <th class="w-25 role_title position-relative text-center sp-title" rowspan="5" style="border: none;">研修
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
                                            <th class="pl-2 sp-none">研修</th>
                                            <td class="w-5 sp-kensyu">
                                                @if($career_item->training_flg == 1)
                                                    <p class="work_role">〇</p>
                                                @endif
                                            </td>                                  
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="text-center career-close-click">
                            <button id= career_list_datail-bt{{$career_item->career_id}} type="button" class="btn mt-1 btn-hover" onclick="myFnc(this,{{$career_item->career_id}})">閉じる</button>
                        </div>
                    </div>

                    <!-- 編集画面 -->
                    <div id= careert_datail_edit-{{$career_item->career_id}}  class="careert_datail_edit_area border border-dark my-2">
                    <form action="{{ route('createDetail.update',  ['PressedEdit' => 'careertDatail','user_id'=> $career_item->user_id]) }}" method="post" id="{{$career_item->career_id}}" onsubmit="return careerEditCheck(this,{{$career_item->career_id}})">
                                @csrf
                                @method('PATCH')
                            <div class="pl-1 d-lg-flex">
                                <div class="career-no" value="{{$career_item->career_id}}">{{$career_item->no_num}}
                                <input name="career_id" class="w-100 d-none" value="{{$career_item->career_id}}">
                                </div>
                                <div id=career_datail-{{$career_item->career_id}}  class="career_datail w-100">
                                        <div class="px-2 float-right">
                                            <input type="reset" value="×" id="cancel_career_datail_edit-{{$career_item->career_id}}" class="text-center m-0" onclick="editMode(this,{{$career_item->career_id}})">
                                        </div>
                                        <table class="career_datail_top w-100" border="1">
                                            <tr class="sp-block pc-none">
                                                <th class="required text-center sp-title">期間</th>
                                            </tr>
                                            <tr>
                                                <th class="required text-center sp-none">期間</th>
                                                <td class="w-100 py-2 responsive px-2">
                                                    <div class="form-select-wrap">
                                                    <div id="edit_err_msg_period_{{$career_item->career_id}}" class="career_edit_err_msg"></div>
                                                        <div class="d-flex">
                                                                <select id="from-pj-year-{{$career_item->career_id}}" name="period_start_year" class="from-pj-year mr-1 edit_period_check">
                                                                    <option id="from-pj-year-op-{{$career_item->career_id}}" value="{{ Str::substr($career_item->start_period, 0, 4) }}" class="d-none">
                                                                        {{ Str::substr($career_item->start_period, 0, 4) }}
                                                                    </option>
                                                                </select>
                                                                <p class="m-0 period_text">年</p>
                                                                <select id="from-pj-month-{{$career_item->career_id}}" name="period_start_month" class="from-pj-month mx-1 edit_period_check">
                                                                    <option id="from-pj-month-op-{{$career_item->career_id}}" value="{{ Str::substr($career_item->start_period, 4, 2) }}" class="d-none">
                                                                        {{ Str::substr($career_item->start_period, 4, 2) }}
                                                                    </option>
                                                                </select>
                                                                <p class="m-0 period_text">月</p>
                                                        </div>
                                                        <p class="mx-1 my-0">~</p>
                                                        <div class="d-flex">
                                                            <select id="to-pj-year-{{$career_item->career_id}}"  name="period_finish_year" class="to-pj-year mr-1 edit_period_check {{ $career_item -> current_period_flg === 0 ? '' : 'period_none'}}">
                                                                <option id="to-pj-year-op-{{$career_item->career_id}}" value="{{ Str::substr($career_item->finish_period, 0, 4) }}" class="d-none">
                                                                    {{ Str::substr($career_item->finish_period, 0, 4) }}
                                                                </option>
                                                            </select>
                                                            <p id ="edit_text_year_{{$career_item->career_id}}" class="m-0 period_text {{ $career_item -> current_period_flg === 0 ? '' : 'period_none'}}">年</p>
                                                            <select id="to-pj-month-{{$career_item->career_id}}"  name="period_finish_month" class="to-pj-month mx-1 edit_period_check {{ $career_item -> current_period_flg === 0 ? '' : 'period_none'}}">
                                                                <option id="to-pj-month-op-{{$career_item->career_id}}" value="{{ Str::substr($career_item->finish_period, 4, 2) }}" class="d-none">
                                                                    {{ Str::substr($career_item->finish_period, 4, 2) }}
                                                                </option>
                                                            </select>
                                                            <p id ="edit_text_month_{{$career_item->career_id}}" class="m-0 period_text {{ $career_item -> current_period_flg === 0 ? '' : 'period_none'}}">月</p>
                                                            <p id="edit_text_current_{{$career_item->career_id}}" class="my-0 mx-1 period_text {{ $career_item -> current_period_flg === 0 ? 'period_none' : 'period_block'}}">現在<p>
                                                        </div>
                                                        <div class="mx-1">
                                                            <input id="to-pj-curt-{{$career_item->career_id}}" type="checkbox" name="current_period_flg" value="1" class="edit_text_current edit_month mr-2" onclick="current(this,{{$career_item->career_id}})" {{ $career_item -> current_period_flg === 0 ? '' : 'checked'}}  >現在
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="sp-block pc-none">
                                                <th class="text-center sp-title">プロジェクト概要</th>
                                            </tr>
                                            <tr>
                                                <th class="required text-center sp-none">プロジェクト概要</th>
                                                <td  class="w-100 py-2 responsive px-2">
                                                    <div id="edit_err_msg_pj_overview_{{$career_item->career_id}}" class="career_edit_err_msg"></div>
                                                    <input name="pj_overview" class="w-100 mr-1 career_edit_check"  value="{{$career_item->pj_overview}}">
                                                </td>
                                            </tr>
                                            <tr class="sp-block pc-none">
                                                <th class="text-center sp-title">プロジェクト人</th>
                                            </tr>
                                            <tr>
                                                <th class="required text-center sp-none">プロジェクト人</th>
                                                <td  class="w-100 py-2 responsive px-2">
                                                    <div id="edit_err_msg_project_num_{{$career_item->career_id}}" class="career_edit_err_msg"></div>
                                                    <input name="project_num" class="w-30 career_edit_check"  value="{{$career_item->project_num}}">人
                                                </td>
                                            </tr>
                                            <tr class="sp-block pc-none">
                                                <th class="text-center sp-title">業務内容</th>
                                            </tr>
                                            <tr class="pj_contents_row">
                                                <th class="required text-center sp-none">業務内容</th>
                                                <td class="w-100 py-2 responsive px-2">
                                                    <div id="edit_err_msg_pj_contents_{{$career_item->career_id}}" class="career_edit_err_msg"></div>
                                                    <textarea name="pj_contents" class="w-100 career_edit_check">{{$career_item->pj_contents}}</textarea >
                                                </td>
                                            </tr>
                                            <tr class="sp-block pc-none">
                                                <th class="text-center sp-title">言語</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center sp-none">言語</th>
                                                <td Id="career_edit_language_td_{{$career_item->career_id}}" class="w-100 p-2 text-center">
                                                    <div id="career_err_msg_skill_language_{{$career_item->career_id}}"></div>
                                                    
                                                    <div id="career_edit_language_{{$career_item->career_id}}" class="w-100 mt-1 mb-1 p-1 border border-dark btn btn--orange" onclick="formAdd(this,'career_edit_language','career','language','{{$career_item->career_id}}')">
                                                        <p class="m-1">＋</p>
                                                    </div>                                                    
                                                </td>
                                            </tr>
                                            <tr class="sp-block pc-none">
                                                <th class="text-center sp-title">DB</th>
                                            </tr>
                                            <tr>
                                                <th  class="text-center sp-none">DB</th>
                                                <td Id="career_edit_db_td_{{$career_item->career_id}}" class="w-100 p-2 text-center">
                                                    <div id="career_err_msg_skill_db_{{$career_item->career_id}}"></div>
                                                    
                                                    <div id="career_edit_db_{{$career_item->career_id}}" class="w-100 mt-1 mb-1 p-1 border border-dark btn btn--orange" onclick="formAdd(this,'career_edit_db','career','db','{{$career_item->career_id}}')">
                                                        <p class="m-1">＋</p>
                                                    </div>                                                    
                                                </td>                             
                                            </tr>
                                            <tr class="sp-block pc-none">
                                                <th class="text-center sp-title">OS</th>
                                            </tr>
                                            <tr>
                                                <th  class="text-center sp-none">OS</th>
                                                <td Id="career_edit_os_td_{{$career_item->career_id}}" class="w-100 p-2 text-center">
                                                    <div id="career_err_msg_skill_os_{{$career_item->career_id}}"></div>
                                                
                                                <div id="career_edit_os_{{$career_item->career_id}}" class="w-100 mt-1 mb-1 p-1 border border-dark btn btn--orange" onclick="formAdd(this,'career_edit_os','career','os','{{$career_item->career_id}}')">
                                                     <p class="m-1">＋</p>
                                               </div>                                                    
                                            </td>                                                             
                                           </tr>
                                           <tr class="sp-block pc-none">
                                                <th class="text-center sp-title">プラットフォーム</th>
                                            </tr>
                                            <tr>
                                                <th  class="text-center sp-none">プラットフォーム</th>
                                                <td Id="career_edit_platform_td_{{$career_item->career_id}}" class="w-100 p-2 text-center">
                                                    <div id="career_err_msg_skill_platform_{{$career_item->career_id}}"></div>
                                                
                                                <div id="career_edit_platform_{{$career_item->career_id}}" class="w-100 mt-1 mb-1 p-1 border border-dark btn btn--orange" onclick="formAdd(this,'career_edit_platform','career','platform','{{$career_item->career_id}}')">
                                                     <p class="m-1">＋</p>
                                               </div>                                                    
                                            </td>
                                            </tr>
                                            <tr class="sp-block pc-none">
                                                <th class="text-center sp-title">ミドルウェア</th>
                                            </tr>
                                            <tr>
                                                <th  class="text-center sp-none">ミドルウェア</th>
                                                <td Id="career_edit_middleware_td_{{$career_item->career_id}}" class="w-100 p-2 text-center">
                                                    <div id="career_err_msg_skill_middleware_{{$career_item->career_id}}"></div>
                                                    
                                                    <div id="career_edit_middleware_{{$career_item->career_id}}" class="w-100 mt-1 mb-1 p-1 border border-dark btn btn--orange" onclick="formAdd(this,'career_edit_middleware','career','middleware','{{$career_item->career_id}}')">
                                                        <p class="m-1">＋</p>
                                                    </div>                                                    
                                                </td>
                                            </tr>
                                            <tr class="sp-block pc-none">
                                                <th class="text-center sp-title">FrameWork</th>
                                            </tr>
                                            <tr>
                                                <th  class="text-center sp-none">FrameWork </th>
                                                <td Id="career_edit_framework_td_{{$career_item->career_id}}" class="w-100 p-2 text-center">
                                                    <div id="career_err_msg_skill_framework_{{$career_item->career_id}}"></div>
                                                
                                                <div id="career_edit_framework_{{$career_item->career_id}}" class="w-100 mt-1 mb-1 p-1 border border-dark btn btn--orange" onclick="formAdd(this,'career_edit_framework','career','framework','{{$career_item->career_id}}')">
                                                     <p class="m-1">＋</p>
                                               </div>                                                    
                                            </td>
                                            </tr>
                                            <tr class="sp-block pc-none">
                                                <th class="text-center sp-title">その他</th>
                                            </tr>
                                            <tr>
                                                <th  class="text-center sp-none">その他</th>
                                                <td Id="career_edit_others_td_{{$career_item->career_id}}" class="w-100 p-2 text-center">
                                                    <div id="career_err_msg_skill_others_{{$career_item->career_id}}"></div>
                                                    
                                                    <div id="career_edit_others_{{$career_item->career_id}}" class="w-100 mt-1 mb-1 p-1 border border-dark btn btn--orange" onclick="formAdd(this,'career_edit_others','career','others','{{$career_item->career_id}}')">
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
                                                        <input id="pc_requirement_{{$career_item->career_id}}" type="checkbox" name="requirement" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','requirement')"  {{$career_item -> requirement === 1 ? 'checked' : '' }} >
                                                    </td>
                                                    <th class="pl-2">開発</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_development_{{$career_item->career_id}}" type="checkbox" name="development" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','development')"  {{$career_item -> development === 1 ? 'checked' : '' }} >
                                                    </td>
                                                    <th class="pl-2">総合試験</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_comprehensive_test_{{$career_item->career_id}}" type="checkbox" name="comprehensive_test" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','comprehensive_test')"  {{$career_item -> comprehensive_test === 1 ? 'checked' : '' }} >
                                                    </td>
                                                    <th class="pl-2">運用保守</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_operation_maintenance_{{$career_item->career_id}}" type="checkbox" name="operation_maintenance" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','operation_maintenance')"  {{$career_item -> operation_maintenance === 1 ? 'checked' : '' }} >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="pl-2">基本設計</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_basic_design_{{$career_item->career_id}}" type="checkbox" name="basic_design" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','basic_design')"  {{$career_item -> basic_design === 1 ? 'checked' : '' }} >
                                                    </td>
                                                    <th class="pl-2">単体試験</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_unit_test_{{$career_item->career_id}}" type="checkbox" name="unit_test" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','unit_test')"  {{$career_item -> unit_test === 1 ? 'checked' : '' }} >
                                                    </td>
                                                    <th class="pl-2">運用試験</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_operation_test_{{$career_item->career_id}}" type="checkbox" name="operation_test" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','operation_test')"  {{$career_item -> operation_test === 1 ? 'checked' : '' }} >
                                                    </td>
                                                    <th class="pl-2">調査</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_survey_{{$career_item->career_id}}" type="checkbox" name="survey" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','survey')"  {{$career_item -> survey === 1 ? 'checked' : '' }} >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="pl-2">詳細設計</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_detail_design_{{$career_item->career_id}}" type="checkbox" name="detail_design" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','detail_design')"  {{$career_item -> detail_design === 1 ? 'checked' : '' }} >
                                                    </td>
                                                    <th class="pl-2">結合試験</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_integration_test_{{$career_item->career_id}}" type="checkbox" name="integration_test" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','integration_test')"  {{$career_item -> integration_test === 1 ? 'checked' : '' }} >
                                                    </td>
                                                    <th class="pl-2">環境構築</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_environment_{{$career_item->career_id}}" type="checkbox" name="environment" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','environment')"  {{$career_item -> environment === 1 ? 'checked' : '' }} >
                                                    </td>
                                                    <th class="pl-2">教育</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_education_{{$career_item->career_id}}" type="checkbox" name="education" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','education')"  {{$career_item -> education === 1 ? 'checked' : '' }} >
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tbody class="work_table sp-block pc-none">
                                                <tr>
                                                    <th class="w-25 career_role_title text-center sp-title" colspan="4">工程</th>
                                                </tr>
                                                <tr>
                                                    <th class="pl-2">要件定義</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_requirement_{{$career_item->career_id}}" type="checkbox" name="requirement" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','requirement')"  {{$career_item -> requirement === 1 ? 'checked' : '' }} >
                                                    </td>
                                                    <th class="pl-2">総合試験</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_comprehensive_test_{{$career_item->career_id}}" type="checkbox" name="comprehensive_test" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','comprehensive_test')"  {{$career_item -> comprehensive_test === 1 ? 'checked' : '' }} >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="pl-2">基本設計</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_basic_design_{{$career_item->career_id}}" type="checkbox" name="basic_design" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','basic_design')"  {{$career_item -> basic_design === 1 ? 'checked' : '' }} >
                                                    </td>
                                                    <th class="pl-2">運用試験</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_operation_maintenance_{{$career_item->career_id}}" type="checkbox" name="operation_maintenance" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','operation_maintenance')"  {{$career_item -> operation_maintenance === 1 ? 'checked' : '' }} >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="pl-2">詳細設計</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_detail_design_{{$career_item->career_id}}" type="checkbox" name="detail_design" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','detail_design')"  {{$career_item -> detail_design === 1 ? 'checked' : '' }} >
                                                    </td>
                                                    <th class="pl-2">環境構築</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_environment_{{$career_item->career_id}}" type="checkbox" name="environment" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','environment')"  {{$career_item -> environment === 1 ? 'checked' : '' }} >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="pl-2">開発</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_development_{{$career_item->career_id}}" type="checkbox" name="development" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','development')"  {{$career_item -> development === 1 ? 'checked' : '' }} >
                                                    </td>
                                                    <th class="pl-2">運用保守</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_operation_test_{{$career_item->career_id}}" type="checkbox" name="operation_test" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','operation_test')"  {{$career_item -> operation_test === 1 ? 'checked' : '' }} >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="pl-2">単体試験</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_unit_test_{{$career_item->career_id}}" type="checkbox" name="unit_test" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','unit_test')"  {{$career_item -> unit_test === 1 ? 'checked' : '' }} >
                                                    </td>
                                                    <th class="pl-2">調査</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_survey_{{$career_item->career_id}}" type="checkbox" name="survey" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','survey')"  {{$career_item -> survey === 1 ? 'checked' : '' }} >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="pl-2">結合試験</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_integration_test_{{$career_item->career_id}}" type="checkbox" name="integration_test" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','integration_test')"  {{$career_item -> integration_test === 1 ? 'checked' : '' }} >
                                                    </td>
                                                    <th class="pl-2">教育</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_education_{{$career_item->career_id}}" type="checkbox" name="education" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','education')"  {{$career_item -> education === 1 ? 'checked' : '' }} >
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tbody class="role_table sp-none">
                                                <tr>
                                                    <th class="w-25 role_title  position-relative  text-center" rowspan="5">役割
                                                    <div class="tooltip1">
                                                        <img src="{{ asset('img/Question.png') }}" class="posQ">
                                                        <div class="description1">
                                                            ※PM(プロジェクトマネージャー)、PMO(プロジェクトマネジメントオフィス)、PL(プロジェクトリーダー)、<br>
                                                            SL(サブリーダー)、SE(システムエンジニア)、PG(プログラマー)、TS(テスター)、OM(運用保守)、HD(ヘルプデスク)
                                                        </div>
                                                    </div>
                                                    </th>
                                                    <th class="pl-2">PM</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_role_pm_{{$career_item->career_id}}" type="checkbox" name="role_pm" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','role_pm')"  {{$career_item -> role_pm === 1 ? 'checked' : '' }} >                                             
                                                    </td>
                                                    <th class="pl-2">SL</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_role_sl_{{$career_item->career_id}}" type="checkbox" name="role_sl" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','role_sl')"  {{$career_item -> role_sl === 1 ? 'checked' : '' }}>
                                                    </td>
                                                    <th class="pl-2">TS</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_role_ts_{{$career_item->career_id}}" type="checkbox" name="role_ts" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','role_ts')"  {{$career_item -> role_ts === 1 ? 'checked' : '' }}>
                                                    </td>
                                                    <th class="pl-2">HD</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_role_hd_{{$career_item->career_id}}" type="checkbox" name="role_hd" value="1"  onchange="inputChange(this,'{{$career_item->career_id}}','pc','role_hd')"  {{$career_item -> role_hd === 1 ? 'checked' : '' }}>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="pl-2">PMO</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_role_pmo_{{$career_item->career_id}}" type="checkbox" name="role_pmo" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','role_pmo')"  {{$career_item -> role_pmo === 1 ? 'checked' : '' }}>
                                                    </td>
                                                    <th class="pl-2">SE</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_role_se_{{$career_item->career_id}}" type="checkbox" name="role_se" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','role_se')"  {{$career_item -> role_se === 1 ? 'checked' : '' }}>
                                                    </td>
                                                    <th class="pl-2">PS</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_role_ps_{{$career_item->career_id}}" type="checkbox" name="role_ps" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','role_ps')"  {{$career_item -> role_ps === 1 ? 'checked' : '' }}>
                                                    </td>
                                                    <th class="pl-2">その他</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_role_other_{{$career_item->career_id}}"  type="checkbox" name="role_other" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','role_other')"  {{$career_item -> role_other === 1 ? 'checked' : '' }}>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="pl-2">PL</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_role_pl_{{$career_item->career_id}}" type="checkbox" name="role_pl" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','role_pl')"  {{$career_item -> role_pl === 1 ? 'checked' : '' }}>
                                                    </td>
                                                    <th class="pl-2">PG</th>
                                                    <td class="text-center w-5">
                                                        <input id="pc_role_pg_{{$career_item->career_id}}" type="checkbox" name="role_pg" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','role_pg')"  {{$career_item -> role_pg === 1 ? 'checked' : '' }}>
                                                    </td>
                                                    <th class="pl-2">OM</th>
                                                    <td class="text-center w-5">
                                                        <input  id="pc_role_om_{{$career_item->career_id}}"  type="checkbox" name="role_om" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','pc','role_om')"  {{$career_item -> role_om === 1 ? 'checked' : '' }}>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            
                                            <tbody class="role_table sp-block pc-none">
                                                <tr>
                                                    <th class="w-25 role_title position-relative text-center sp-title" colspan="4">役割
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
                                                            <input id="sp_role_pm_{{$career_item->career_id}}" type="checkbox" name="role_pm" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','role_pm')"  {{$career_item -> role_pm === 1 ? 'checked' : '' }}>
                                                    </td>
                                                    <th class="pl-2">TS</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_role_ts_{{$career_item->career_id}}" type="checkbox" name="role_ts" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','role_ts')"  {{$career_item -> role_ts === 1 ? 'checked' : '' }}>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="pl-2">PMO</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_role_pmo_{{$career_item->career_id}}" type="checkbox" name="role_pmo" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','role_pmo')"  {{$career_item -> role_pmo === 1 ? 'checked' : '' }}>
                                                    </td>
                                                    <th class="pl-2">PS</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_role_ps_{{$career_item->career_id}}" type="checkbox" name="role_ps" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','role_ps')"  {{$career_item -> role_ps === 1 ? 'checked' : '' }}>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="pl-2">PL</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_role_pl_{{$career_item->career_id}}" type="checkbox" name="role_pl" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','role_pl')"  {{$career_item -> role_pl === 1 ? 'checked' : '' }}>
                                                    </td>
                                                    <th class="pl-2">OM</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_role_om_{{$career_item->career_id}}" type="checkbox" name="role_om" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','role_om')"  {{$career_item -> role_om === 1 ? 'checked' : '' }}>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="pl-2">SL</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_role_sl_{{$career_item->career_id}}" type="checkbox" name="role_sl" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','role_sl')"  {{$career_item -> role_sl === 1 ? 'checked' : '' }}>
                                                    </td>
                                                    <th class="pl-2">HD</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_role_hd_{{$career_item->career_id}}" type="checkbox" name="role_hd" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','role_hd')"  {{$career_item -> role_hd === 1 ? 'checked' : '' }}>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="pl-2">SE</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_role_se_{{$career_item->career_id}}" type="checkbox" name="role_se" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','role_se')"  {{$career_item -> role_se === 1 ? 'checked' : '' }}>
                                                    </td>
                                                    <th class="pl-2">その他</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_role_other_{{$career_item->career_id}}" type="checkbox" name="role_other" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','role_other')"  {{$career_item -> role_other === 1 ? 'checked' : '' }}>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="pl-2">PG</th>
                                                    <td class="text-center w-5">
                                                        <input id="sp_role_pg_{{$career_item->career_id}}" type="checkbox" name="role_pg" value="1" onchange="inputChange(this,'{{$career_item->career_id}}','sp','role_pg')"  {{$career_item -> role_pg === 1 ? 'checked' : '' }}>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tbody class="training_table">
                                                <tr class="sp-block pc-none">
                                                    <th class="w-25 role_title position-relative text-center sp-title" rowspan="5"  style="border: none;">研修
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
                                                    <div class="tooltip1">
                                                        <img src="{{ asset('img/Question.png') }}" class="posQ">
                                                        <div class="description1">
                                                         新卒研修またはその他の研修の場合は、チェックしてください。
                                                        </div>
                                                    </div>
                                                    </th>
                                                    <th class="pl-2 sp-none">研修</th>
                                                    <td class="text-center w-5">
                                                        @if($career_item->training_flg == 1)
                                                            <input type="checkbox" name="training_flg" checked="checked" value="1">
                                                        @else
                                                            <input type="checkbox" name="training_flg" value="1">
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="w-100 d-flex justify-content-center">
                                            <div class="my-3 mr-5 ml-3">
                                                <button type="submit" class="btn btn--orange menu_keep_button">保存</button>
                                            </div>
                                            <div class="my-3 mr-3 ml-5">
                                                <input type="reset" value="キャンセル" id="cancel_career_datail_edit-{{$career_item->career_id}}" class="btn btn--orange"  onclick="editMode(this,{{$career_item->career_id}})">
                                            </div>
                                        </div>
                                </div>  
                            </div>
                        </form> 
                    </div>
                    <!-- 編集画面終わり -->
                </div>
            @endforeach
        </div>
    </div>
</div>
    <?php
$param_json = json_encode($career_skill_list_edit); //JSONエンコード
?>
</div>
<script>
    var param = [];
  var param = JSON.parse('<?php echo $param_json; ?>');
</script>