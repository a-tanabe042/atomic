<div class="basic_info_skill_area my-2">
    <div id="basic_info_skil_show" class="basic_info_skil_show">             
        <form action="{{ route('createDetail.update',  ['PressedEdit' => 'basicSkill','user_id'=>$basic_info_items[0]->user_id]) }}" method="post" onsubmit="return basicInfoSkillCheck()">
            @csrf
            @method('PATCH')
            @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')
                <div id="basic_skill_edit_bt_area" class="basic_skill_edit_bt_area text-right">
                    <button id="basic_info_skill_bt_e" type="button" class="btn btn--orange"  onclick=editMode(this)>編集</button>
                </div>
            @endif
             <div id="basic_skill_cancel_bt_area" class="basic_skill_cancel_bt_area text-right">
                 <button id="basic_info_skill_bt_c" type="submit button" class="btn btn--orange menu_keep_button">保存</button>
                 <input id="basic_info_skill_bt_c" type="reset" class="btn btn--orange"  onclick=editMode(this) value="キャンセル">
             </div>
            <div id="basic_skill_edit">
                <table class="basic_info datail_title_style w-100 my-2" border="1">
                    <div id="err_msg_skill"></div>
                    <div id="err_msg_evaluation"></div>
                    <div id="err_msg_duplicate"></div>
                    <tr>
                        <th class="basic_info_th">言語</th>
                        <td id="base_edit_language_td" class="px-2 skill-tb-w">
                            @php
                               $basicSkillCounter = 0;
                               $counter = 0;
                               $idSelectNo = 0;
                            @endphp
                            @foreach ($basic_info_skill_list as $basic_info_skil_language)
                                @if($basic_info_skil_language->class_id == 1)

                                    @php
                                        $counter ++;
                                        $idSelectNo ++;
                                    @endphp
                            
                                    @if($counter <= 2 )
                                        @if($counter == 1)
                                            <div class="basic_skill_area">
                                        @endif
                                        <div class="basic_skill_item_area">
                                            <select id="edit_language_select_{{$idSelectNo}}" name="edit_language[0][edit_language_select_{{$idSelectNo}}[0][skillName]]"  class="basic_skil_name_select basic_search_language" disabled  >
                                                <option></option>        
                                                @foreach ($skill_all_items as $skill_language_item)
                                                    @if($skill_language_item -> class_id == 1)
                                                        <option class="mai-{{ $skill_language_item -> skill_name }}" value="{{ $skill_language_item -> skill_name }}"  {{$basic_info_skil_language -> skill_name ==  $skill_language_item -> skill_name ? 'selected' : ''}}>{{ $skill_language_item -> skill_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <select id="edit_language_select_ev_{{$idSelectNo}}" name="edit_language[0][edit_language_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select"  disabled >
                                                    <option></option>
                                                @if($basic_info_skil_language -> evaluation == 1 )
                                                    <option value=1 selected>△1年未満</option>
                                                    <option value=2>〇1年以上</option>
                                                    <option value=3>◎3年以上</option>
                                                @elseif($basic_info_skil_language -> evaluation == 2)
                                                    <option value=1>△1年未満</option>
                                                    <option value=2 selected>〇1年以上</option>
                                                    <option value=3>◎3年以上</option>
                                                @elseif($basic_info_skil_language -> evaluation == 3)
                                                    <option value=1>△1年未満</option>
                                                    <option value=2>〇1年以上</option>
                                                    <option value=3 selected>◎3年以上</option>
                                                @endif
                                            </select>
                                        </div>
                                        @php
                                            $basicSkillCounter ++;
                                        @endphp  
                                        @if($counter == 2 )
                                            @php
                                                $counter = 0;
                                            @endphp 
                                            </div>
                                        @endif 
                                    @endif
                                @endif
                            @endforeach

                            @for($i = 1; $i <= 3; $i++)
                    
                                @if($basicSkillCounter < 4)
                                    @if($basicSkillCounter % 4 == $i)
                                        @if($i == 2)
                                            <div class="basic_skill_area">
                                        @endif
                                            @for($k = 1; $k <= (4-$i); $k++)
                                                @php
                                                    $endDiv = 4-$i;
                                                    $idSelectNo++;
                                                @endphp
                                                <div class="basic_skill_item_area">
                                                    <select id="edit_language_select_{{$idSelectNo}}" name="edit_language[0][edit_language_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_language"  disabled >
                                                        <option></option>
                                                        @foreach ($skill_all_items as $skill_language_item)
                                                            @if($skill_language_item -> class_id == 1)
                                                                <option  class="mai-{{ $skill_language_item -> skill_name }}"  value="{{ $skill_language_item -> skill_name }}">{{ $skill_language_item -> skill_name }}</option>
                                                            @endif
                                                        @endforeach
                                                   </select>    
                                                    <select id="edit_language_select_ev_{{$idSelectNo}}" name="edit_language[0][edit_language_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled >
                                                        <option></option>
                                                        <option value=1>△1年未満</option>
                                                        <option value=2>〇1年以上</option>
                                                        <option value=3>◎3年以上</option>
                                                    </select>
                                                </div>
                                                @if($endDiv == 3 && $k == 1)
                                                    </div>
                                                    <div class="basic_skill_area">
                                                @endif      
                                            @endfor    
                                            </div>
                                        @endif
                                @endif
                                @if($basicSkillCounter > 4)
                                    @if($basicSkillCounter % 2 == $i)
                                        @php
                                            $idSelectNo++;
                                        @endphp
                                        <div class="basic_skill_item_area">
                                            <select id="edit_language_select_{{$idSelectNo}}" name="edit_language[0][edit_language_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_language"  disabled >
                                                <option></option>
                                                @foreach ($skill_all_items as $skill_language_item)
                                                    @if($skill_language_item -> class_id == 1)
                                                        <option  class="mai-{{ $skill_language_item -> skill_name }}"  value="{{ $skill_language_item -> skill_name }}">{{ $skill_language_item -> skill_name }}</option>
                                                    @endif
                                                @endforeach
                                           </select>
                                            <select id="edit_language_select_ev_{{$idSelectNo}}" name="edit_language[0][edit_language_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select"  disabled >
                                                <option></option>
                                                <option value=1>△1年未満</option>
                                                <option value=2>〇1年以上</option>
                                                <option value=3>◎3年以上</option>
                                            </select>
                                        </div>
                                        </div>
                                    @endif
                                @endif
                            @endfor

                            @if($basicSkillCounter == 0)             
                                @for($i = 1; $i <= 2; $i++)
                                    <div class="basic_skill_area">
                                        @for($k = 1; $k <= 2; $k++)
                                            @php
                                                $idSelectNo++;
                                            @endphp
                                            <div class="basic_skill_item_area">
                                                <select id="edit_language_select_{{$idSelectNo}}" name="edit_language[0][edit_language_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_language"  disabled >
                                                    <option></option>
                                                    @foreach ($skill_all_items as $skill_language_item)
                                                        @if($skill_language_item -> class_id == 1)
                                                            <option  class="mai-{{ $skill_language_item -> skill_name }}"  value="{{ $skill_language_item -> skill_name }}">{{ $skill_language_item -> skill_name }}</option>
                                                        @endif
                                                    @endforeach
                                               </select>
                                                <select id="edit_language_select_ev_{{$idSelectNo}}" name="edit_language[0][edit_language_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled>
                                                        <option></option>
                                                        <option value=1>△1年未満</option>
                                                        <option value=2>〇1年以上</option>
                                                        <option value=3>◎3年以上</option>
                                                </select>
                                            </div>
                                        @endfor
                                    </div>
                                @endfor
                            @endif                  
                            <div id="base_edit_language" class="basic_skil_bt w-100 mt-1 mb-1 p-1 border border-dark btn btn--orange" onclick="formAdd(this,'base_edit_language','base','language','')">
                                 <p class="m-1">＋</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                       <th class="basic_info_th">DB</th>
                       <td id="base_edit_db_td" class="px-2 skill-tb-w">
                            @php
                               $basicSkillCounter = 0;
                               $counter = 0;
                               $idSelectNo = 0;
                            @endphp
                            @foreach ($basic_info_skill_list as $basic_info_skil_db)
                                @if($basic_info_skil_db->class_id == 2)
                                        
                                    @php
                                        $counter ++;
                                        $idSelectNo ++;
                                    @endphp
                                        
                                    @if($counter <= 2 )
                                        @if($counter == 1)
                                            <div class="basic_skill_area">
                                        @endif
                                        <div class="basic_skill_item_area">
                                            <select id="edit_db_select_{{$idSelectNo}}" name="edit_db[0][edit_db_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_db" disabled>
                                            <option></option>
                                                @foreach ($skill_all_items as $skill_db_item)
                                                    @if($skill_db_item -> class_id == 2)
                                                        <option class="mai-{{ $skill_db_item -> skill_name }}" value="{{ $skill_db_item -> skill_name }}"  {{$basic_info_skil_db -> skill_name ==  $skill_db_item -> skill_name ? 'selected' : ''}}>{{ $skill_db_item -> skill_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <select id="edit_db_select_ev_{{$idSelectNo}}" name="edit_db[0][edit_db_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled>
                                                    <option></option>
                                                @if($basic_info_skil_db -> evaluation == 1 )
                                                    <option value=1 selected>△1年未満</option>
                                                    <option value=2>〇1年以上</option>
                                                    <option value=3>◎3年以上</option>
                                                @elseif($basic_info_skil_db -> evaluation == 2)
                                                    <option value=1>△1年未満</option>
                                                    <option value=2 selected>〇1年以上</option>
                                                    <option value=3>◎3年以上</option>
                                                @elseif($basic_info_skil_db -> evaluation == 3)
                                                    <option value=1>△1年未満</option>
                                                    <option value=2>〇1年以上</option>
                                                    <option value=3 selected>◎3年以上</option>
                                                @endif
                                            </select>
                                        </div>
                                            @php
                                                $basicSkillCounter ++;
                                            @endphp  
                                            @if($counter == 2 )
                                                @php
                                                    $counter = 0;
                                                @endphp 
                                                </div>
                                            @endif 
                                        @endif
                                    @endif
                                @endforeach

                                @for($i = 1; $i <= 3; $i++)
                    
                                @if($basicSkillCounter < 4)
                                    @if($basicSkillCounter % 4 == $i)
                                        @if($i == 2)
                                            <div class="basic_skill_area">
                                        @endif
                                            @for($k = 1; $k <= (4-$i); $k++)
                                                @php
                                                    $endDiv = 4-$i;
                                                    $idSelectNo++;
                                                @endphp
                                                <div class="basic_skill_item_area">
                                                    <select id="edit_db_select_{{$idSelectNo}}" name="edit_db[0][edit_db_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_db" disabled>
                                                        <option></option>
                                                        @foreach ($skill_all_items as $skill_db_item)
                                                            @if($skill_db_item -> class_id == 2)
                                                                <option  class="mai-{{ $skill_db_item -> skill_name }}"  value="{{ $skill_db_item -> skill_name }}">{{ $skill_db_item -> skill_name }}</option>
                                                            @endif
                                                        @endforeach
                                                   </select>    
                                                    <select id="edit_db_select_ev_{{$idSelectNo}}" name="edit_db[0][edit_db_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled >
                                                        <option></option>
                                                        <option value=1>△1年未満</option>
                                                        <option value=2>〇1年以上</option>
                                                        <option value=3>◎3年以上</option>
                                                    </select>
                                                </div>
                                                @if($endDiv == 3 && $k == 1)
                                                    </div>
                                                    <div class="basic_skill_area">
                                                @endif      
                                            @endfor    
                                            </div>
                                        @endif
                                @endif
                                @if($basicSkillCounter > 4)
                                    @if($basicSkillCounter % 2 == $i)
                                        @php
                                            $idSelectNo++;
                                        @endphp
                                        <div class="basic_skill_item_area">
                                            <select id="edit_db_select_{{$idSelectNo}}" name="edit_db[0][edit_db_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_db" disabled>
                                                <option></option>
                                                @foreach ($skill_all_items as $skill_db_item)
                                                    @if($skill_db_item -> class_id == 2)
                                                        <option  class="mai-{{ $skill_db_item -> skill_name }}"  value="{{ $skill_db_item -> skill_name }}">{{ $skill_db_item -> skill_name }}</option>
                                                    @endif
                                                @endforeach
                                           </select>
                                            <select id="edit_db_select_ev_{{$idSelectNo}}" name="edit_db[0][edit_db_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select"  disabled >
                                                <option></option>
                                                <option value=1>△1年未満</option>
                                                <option value=2>〇1年以上</option>
                                                <option value=3>◎3年以上</option>
                                            </select>
                                        </div>
                                        </div>
                                    @endif
                                @endif
                            @endfor

                            @if($basicSkillCounter == 0)             
                                @for($i = 1; $i <= 2; $i++)
                                    <div class="basic_skill_area">
                                        @for($k = 1; $k <= 2; $k++)
                                            @php
                                                $idSelectNo++;
                                            @endphp
                                            <div class="basic_skill_item_area">
                                                <select id="edit_db_select_{{$idSelectNo}}" name="edit_db[0][edit_db_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_db" disabled>
                                                    <option></option>
                                                    @foreach ($skill_all_items as $skill_db_item)
                                                        @if($skill_db_item -> class_id == 2)
                                                            <option  class="mai-{{ $skill_db_item -> skill_name }}"  value="{{ $skill_db_item -> skill_name }}">{{ $skill_db_item -> skill_name }}</option>
                                                        @endif
                                                    @endforeach
                                               </select>
                                                <select id="edit_db_select_ev_{{$idSelectNo}}" name="edit_db[0][edit_db_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled>
                                                        <option></option>
                                                        <option value=1>△1年未満</option>
                                                        <option value=2>〇1年以上</option>
                                                        <option value=3>◎3年以上</option>
                                                </select>
                                            </div>
                                        @endfor
                                    </div>
                                @endfor
                            @endif                  
                            <div id="base_edit_db" class="w-100 mt-1 mb-1 p-1 border border-dark btn btn--orange basic_skil_bt" onclick="formAdd(this,'base_edit_db','base','db','')">
                                 <p class="m-1">＋</p>
                            </div>               
                        </td>
                    </tr>
                    <tr>
                        <th class="basic_info_th">OS</th>
                        <td id="base_edit_os_td"  class="px-2 skill-tb-w">
                            @php
                               $basicSkillCounter_os = 0;
                               $counter_os = 0;
                               $idSelectNo_os = 0;
                            @endphp
                            @foreach ($basic_info_skill_list as $basic_info_skil_os)
                                @if($basic_info_skil_os->class_id == 3)
                                        
                                    @php
                                        $counter_os ++;
                                        $idSelectNo_os ++;
                                    @endphp
                                        
                                    @if($counter_os <= 2 )
                                        @if($counter_os == 1)
                                            <div class="basic_skill_area">
                                        @endif
                                        <div class="basic_skill_item_area">
                                            <select id="edit_os_select_{{$idSelectNo_os}}" name="edit_os[0][edit_os_select_{{$idSelectNo_os}}[0][skillName]]" class="basic_skil_name_select basic_search_os" disabled>
                                                <option></option>
                                                @foreach ($skill_all_items as $skill_os_item)
                                                    @if($skill_os_item -> class_id == 3)
                                                        <option class="mai-{{ $skill_os_item -> skill_name }}" value="{{ $skill_os_item -> skill_name }}" {{$basic_info_skil_os -> skill_name ==  $skill_os_item -> skill_name ? 'selected' : ''}}>{{ $skill_os_item -> skill_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <select id="edit_os_select_ev_{{$idSelectNo_os}}" name="edit_os[0][edit_os_select_{{$idSelectNo_os}}[0][evaluation]]" class="basic_evaluation_name_select" disabled>
                                                    <option></option>
                                                @if($basic_info_skil_os -> evaluation == 1 )
                                                    <option value=1 selected>△1年未満</option>
                                                    <option value=2>〇1年以上</option>
                                                    <option value=3>◎3年以上</option>
                                                @elseif($basic_info_skil_os -> evaluation == 2)
                                                    <option value=1>△1年未満</option>
                                                    <option value=2 selected>〇1年以上</option>
                                                    <option value=3>◎3年以上</option>
                                                @elseif($basic_info_skil_os -> evaluation == 3)
                                                    <option value=1>△1年未満</option>
                                                    <option value=2>〇1年以上</option>
                                                    <option value=3 selected>◎3年以上</option>
                                                @endif
                                            </select>
                                        </div>
                                        @php
                                            $basicSkillCounter_os ++;
                                        @endphp  
                                        @if($counter_os == 2 )
                                            @php
                                                $counter_os = 0;
                                            @endphp 
                                            </div>
                                        @endif 
                                    @endif
                                @endif
                            @endforeach

                            @for($i = 1; $i <= 3; $i++)
                    
                            @if($basicSkillCounter_os < 4)
                                @if($basicSkillCounter_os % 4 == $i)
                                    @if($i == 2)
                                        <div class="basic_skill_area">
                                    @endif
                                        @for($k = 1; $k <= (4-$i); $k++)
                                            @php
                                                $endDiv = 4-$i;
                                                $idSelectNo_os++;
                                            @endphp
                                            <div class="basic_skill_item_area">
                                                <select id="edit_os_select_{{$idSelectNo_os}}" name="edit_os[0][edit_os_select_{{$idSelectNo_os}}[0][skillName]]" class="basic_skil_name_select basic_search_os" disabled>
                                                    <option></option>
                                                    @foreach ($skill_all_items as $skill_os_item)
                                                        @if($skill_os_item -> class_id == 3)
                                                            <option  class="mai-{{ $skill_os_item -> skill_name }}"  value="{{ $skill_os_item -> skill_name }}">{{ $skill_os_item -> skill_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <select id="edit_os_select_ev_{{$idSelectNo_os}}" name="edit_os[0][edit_os_select_{{$idSelectNo_os}}[0][evaluation]]" class="basic_evaluation_name_select" disabled >
                                                    <option></option>
                                                    <option value=1>△1年未満</option>
                                                    <option value=2>〇1年以上</option>
                                                    <option value=3>◎3年以上</option>
                                                </select>
                                            </div>
                                            @if($endDiv == 3 && $k == 1)
                                                </div>
                                                <div class="basic_skill_area">
                                            @endif      
                                        @endfor    
                                        </div>
                                    @endif
                            @endif
                            @if($basicSkillCounter_os > 4)
                                @if($basicSkillCounter_os % 2 == $i)
                                    @php
                                        $idSelectNo_os++;
                                    @endphp
                                    <div class="basic_skill_item_area">
                                        <select id="edit_os_select_{{$idSelectNo_os}}" name="edit_os[0][edit_os_select_{{$idSelectNo_os}}[0][skillName]]" class="basic_skil_name_select basic_search_os" disabled>
                                            <option></option>
                                            @foreach ($skill_all_items as $skill_os_item)
                                                @if($skill_os_item -> class_id == 3)
                                                    <option  class="mai-{{ $skill_os_item -> skill_name }}"  value="{{ $skill_os_item -> skill_name }}">{{ $skill_os_item -> skill_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <select id="edit_os_select_ev_{{$idSelectNo_os}}" name="edit_os[0][edit_os_select_{{$idSelectNo_os}}[0][evaluation]]" class="basic_evaluation_name_select"  disabled >
                                            <option></option>
                                            <option value=1>△1年未満</option>
                                            <option value=2>〇1年以上</option>
                                            <option value=3>◎3年以上</option>
                                        </select>
                                    </div>
                                    </div>
                                @endif
                            @endif
                        @endfor

                        @if($basicSkillCounter_os == 0)             
                            @for($i = 1; $i <= 2; $i++)
                                <div class="basic_skill_area">
                                    @for($k = 1; $k <= 2; $k++)
                                        @php
                                            $idSelectNo_os++;
                                        @endphp
                                        <div class="basic_skill_item_area">
                                            <select id="edit_os_select_{{$idSelectNo_os}}" name="edit_os[0][edit_os_select_{{$idSelectNo_os}}[0][skillName]]" class="basic_skil_name_select basic_search_os" disabled>
                                                <option></option>
                                                @foreach ($skill_all_items as $skill_os_item)
                                                    @if($skill_os_item -> class_id == 3)
                                                        <option  class="mai-{{ $skill_os_item -> skill_name }}"  value="{{ $skill_os_item -> skill_name }}">{{ $skill_os_item -> skill_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <select id="edit_os_select_ev_{{$idSelectNo_os}}" name="edit_os[0][edit_os_select_{{$idSelectNo_os}}[0][evaluation]]" class="basic_evaluation_name_select" disabled>
                                                    <option></option>
                                                    <option value=1>△1年未満</option>
                                                    <option value=2>〇1年以上</option>
                                                    <option value=3>◎3年以上</option>
                                            </select>
                                        </div>
                                    @endfor
                                </div>
                            @endfor
                        @endif                  
                            <div id="base_edit_os" class="w-100 mt-1 mb-1 p-1 border border-dark btn btn--orange basic_skil_bt" onclick="formAdd(this,'base_edit_os','base','os','')">
                                 <p class="m-1">＋</p>
                            </div>                                                    
                        </td>      
                    </tr>                                                                                       
                    <tr>
                       <th class="basic_info_th">プラットフォーム</th>
                       <td id="base_edit_platform_td" class="px-2 skill-tb-w">
                            @php
                               $basicSkillCounter = 0;
                               $counter = 0;
                               $idSelectNo = 0;
                               $temp_skill_name = "";
                            @endphp
                            @foreach ($basic_info_skill_list as $basic_info_skil_platform)
                                @if($basic_info_skil_platform->class_id == 5)
                                            
                                    @php
                                        $counter ++;
                                        $idSelectNo ++;
                                        $sub_class_name_flg = 0;
                                        $sub_class_name_array = [];
                                    @endphp
                                            
                                    @if($counter <= 2 )
                                        @if($counter == 1)
                                            <div class="basic_skill_area">
                                        @endif
                                        <div class="basic_skill_item_area">
                                            <select id="edit_platform_select_{{$idSelectNo}}" name="edit_platform[0][edit_platform_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_platform" disabled>
                                            <option></option>  
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
                                                        <optgroup id="platform_{{ $skill_platform_list_item ->  sub_class_name }}_{{$idSelectNo}}" class="mai-{{ $skill_platform_list_item -> sub_class_name }}"label="{{ $skill_platform_list_item -> sub_class_name }}">
                                                            @foreach ($skill_all_items as $skill_platform_item)
                                                                @if($skill_platform_item -> class_id == 5)
                                                                    @if( $skill_platform_list_item -> sub_class_name == $skill_platform_item -> sub_class_name)
                                                                        @if( $skill_platform_list_item -> sub_class_name !== $skill_platform_item -> skill_name)
                                                                            <option class="sub-option sub_option_select_{{ $skill_platform_item -> sub_class_name }}_{{$idSelectNo}} {{ $skill_platform_item -> sub_class_name }}"value="{{ $skill_platform_item -> skill_name }}" {{$basic_info_skil_platform -> skill_name ==  $skill_platform_item -> skill_name ? 'selected' : ''}}>{{ $skill_platform_item -> skill_name }}</option>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </optgroup>
                                                    @endif
                                                @endforeach
                                            </select>                    
                                            <select id="edit_platform_select_ev_{{$idSelectNo}}" name="edit_platform[0][edit_platform_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled>
                                                <option></option>
                                                @if($basic_info_skil_platform -> evaluation == 1 )
                                                    <option value=1 selected>△1年未満</option>
                                                    <option value=2>〇1年以上</option>
                                                    <option value=3>◎3年以上</option>
                                                @elseif($basic_info_skil_platform -> evaluation == 2)
                                                    <option value=1>△1年未満</option>
                                                    <option value=2 selected>〇1年以上</option>
                                                    <option value=3>◎3年以上</option>
                                                @elseif($basic_info_skil_platform -> evaluation == 3)
                                                    <option value=1>△1年未満</option>
                                                    <option value=2>〇1年以上</option>
                                                    <option value=3 selected>◎3年以上</option>
                                                @endif
                                            </select>
                                        </div>
                                        @php
                                            $basicSkillCounter ++;
                                        @endphp  
                                        @if($counter == 2 )
                                            @php
                                                $counter = 0;
                                            @endphp 
                                            </div>
                                        @endif 
                                    @endif
                                @endif
                            @endforeach

                            @for($i = 1; $i <= 3; $i++)
                    
                                @if($basicSkillCounter < 4)
                                    @if($basicSkillCounter % 4 == $i)
                                        @if($i == 2)
                                            <div class="basic_skill_area">
                                        @endif
                                            @for($k = 1; $k <= (4-$i); $k++)
                                                @php
                                                    $endDiv = 4-$i;
                                                    $idSelectNo++;
                                                    $sub_class_name_flg = 0;
                                                    $sub_class_name_array = [];
                                                @endphp
                                                <div class="basic_skill_item_area">
                                                    <select id="edit_platform_select_{{$idSelectNo}}" name="edit_platform[0][edit_platform_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_platform" disabled>
                                                        <option></option>
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
                                                                <optgroup id="platform_{{ $skill_platform_list_item ->  sub_class_name }}_{{$idSelectNo}}" class="mai-{{ $skill_platform_list_item -> sub_class_name }}" label="{{ $skill_platform_list_item ->  sub_class_name }}">
                                                                @foreach ($skill_all_items as $skill_platform_item)
                                                                    @if($skill_platform_item -> class_id == 5)
                                                                        @if( $skill_platform_list_item -> sub_class_name == $skill_platform_item -> sub_class_name)
                                                                            @if( $skill_platform_list_item -> sub_class_name !== $skill_platform_item -> skill_name)
                                                                                <option class="sub-option sub_option_select_{{ $skill_platform_item -> sub_class_name }}_{{$idSelectNo}} {{ $skill_platform_item -> sub_class_name }}"value="{{ $skill_platform_item -> skill_name }}">{{ $skill_platform_item -> skill_name }}</option>
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                                </optgroup>
                                                            @endif
                                                        @endforeach
                                                    </select>                     
                                                    <select id="edit_platform_select_ev_{{$idSelectNo}}" name="edit_platform[0][edit_platform_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled >
                                                        <option></option>
                                                        <option value=1>△1年未満</option>
                                                        <option value=2>〇1年以上</option>
                                                        <option value=3>◎3年以上</option>
                                                    </select>
                                                </div>
                                                @if($endDiv == 3 && $k == 1)
                                                    </div>
                                                    <div class="basic_skill_area">
                                                @endif      
                                            @endfor    
                                            </div>
                                        @endif
                                @endif
                                @if($basicSkillCounter > 4)
                                    @if($basicSkillCounter % 2 == $i)
                                        @php
                                            $idSelectNo++;
                                            $sub_class_name_flg = 0;
                                            $sub_class_name_array = [];
                                        @endphp
                                        <div class="basic_skill_item_area">
                                            <select id="edit_platform_select_{{$idSelectNo}}" name="edit_platform[0][edit_platform_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_platform" disabled>
                                                <option></option>
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
                                                        <optgroup id="platform_{{ $skill_platform_list_item ->  sub_class_name }}_{{$idSelectNo}}" class="mai-{{ $skill_platform_list_item -> sub_class_name }}" label="{{ $skill_platform_list_item ->  sub_class_name }}">
                                                        @foreach ($skill_all_items as $skill_platform_item)
                                                            @if($skill_platform_item -> class_id == 5)
                                                                @if( $skill_platform_list_item -> sub_class_name == $skill_platform_item -> sub_class_name)
                                                                    @if( $skill_platform_list_item -> sub_class_name !== $skill_platform_item -> skill_name)
                                                                        <option class="sub-option sub_option_select_{{ $skill_platform_item -> sub_class_name }}_{{$idSelectNo}} {{ $skill_platform_item -> sub_class_name }}"value="{{ $skill_platform_item -> skill_name }}">{{ $skill_platform_item -> skill_name }}</option>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        </optgroup>
                                                    @endif
                                                @endforeach
                                            </select>                     
                                            <select id="edit_platform_select_ev_{{$idSelectNo}}" name="edit_platform[0][edit_platform_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select"  disabled >
                                                <option></option>
                                                <option value=1>△1年未満</option>
                                                <option value=2>〇1年以上</option>
                                                <option value=3>◎3年以上</option>
                                            </select>
                                        </div>
                                        </div>
                                    @endif
                                @endif
                            @endfor

                            @if($basicSkillCounter == 0)             
                                @for($i = 1; $i <= 2; $i++)
                                    <div class="basic_skill_area">
                                        @for($k = 1; $k <= 2; $k++)
                                            @php
                                                $idSelectNo++;
                                                $sub_class_name_flg = 0;
                                                $sub_class_name_array = [];
                                            @endphp
                                            <div class="basic_skill_item_area">
                                                <select id="edit_platform_select_{{$idSelectNo}}" name="edit_platform[0][edit_platform_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_platform" disabled>
                                                    <option></option>
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
                                                            <optgroup id="platform_{{ $skill_platform_list_item ->  sub_class_name }}_{{$idSelectNo}}" class="mai-{{ $skill_platform_list_item -> sub_class_name }}" label="{{ $skill_platform_list_item ->  sub_class_name }}">
                                                            @foreach ($skill_all_items as $skill_platform_item)
                                                                @if($skill_platform_item -> class_id == 5)
                                                                    @if( $skill_platform_list_item -> sub_class_name == $skill_platform_item -> sub_class_name)
                                                                        @if( $skill_platform_list_item -> sub_class_name !== $skill_platform_item -> skill_name)
                                                                            <option class="sub-option sub_option_select_{{ $skill_platform_item -> sub_class_name }}_{{$idSelectNo}} {{ $skill_platform_item -> sub_class_name }}"value="{{ $skill_platform_item -> skill_name }}">{{ $skill_platform_item -> skill_name }}</option>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            </optgroup>
                                                        @endif
                                                    @endforeach
                                                </select>                     
                                                <select id="edit_platform_select_ev_{{$idSelectNo}}" name="edit_platform[0][edit_platform_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled>
                                                        <option></option>
                                                        <option value=1>△1年未満</option>
                                                        <option value=2>〇1年以上</option>
                                                        <option value=3>◎3年以上</option>
                                                </select>
                                            </div>
                                        @endfor
                                    </div>
                                @endfor
                            @endif                  
                            <div id="base_edit_platform" class="w-100 mt-1 mb-1 p-1 border border-dark btn btn--orange basic_skil_bt"  onclick="formAdd(this,'base_edit_platform','base','platform','')">
                                 <p class="m-1">＋</p>
                           </div>                                                    
                        </td>
                    </tr>
                    <tr>
                        <th class="basic_info_th">ミドルウェア</th>
                        <td id="base_edit_middleware_td" class="px-2 skill-tb-w">
                            @php
                               $basicSkillCounter = 0;
                               $counter = 0;
                               $idSelectNo = 0;
                            @endphp
                            @foreach ($basic_info_skill_list as $basic_info_skil_middleware)
                                @if($basic_info_skil_middleware->class_id == 4)
                                        
                                    @php
                                        $counter ++;
                                        $idSelectNo ++;
                                    @endphp
                                        
                                    @if($counter <= 2 )
                                        @if($counter == 1)
                                            <div class="basic_skill_area">
                                        @endif
                                        <div class="basic_skill_item_area">
                                            <select id="edit_middleware_select_{{$idSelectNo}}" name="edit_middleware[0][edit_middleware_select_{{$idSelectNo}}[0][skillName]]"  class="basic_skil_name_select basic_search_middleware"  disabled>
                                                <option></option>
                                                @foreach ($skill_all_items as $skill_middleware_item)
                                                    @if($skill_middleware_item -> class_id == 4)
                                                        <option class="mai-{{ $skill_middleware_item -> skill_name }}" value="{{ $skill_middleware_item -> skill_name }}" {{$basic_info_skil_middleware -> skill_name ==  $skill_middleware_item -> skill_name ? 'selected' : ''}}>{{ $skill_middleware_item -> skill_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <select id="edit_middleware_select_ev_{{$idSelectNo}}" name="edit_middleware[0][edit_middleware_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled>
                                                <option></option>
                                                @if($basic_info_skil_middleware -> evaluation == 1 )
                                                    <option value=1 selected>△1年未満</option>
                                                    <option value=2>〇1年以上</option>
                                                    <option value=3>◎3年以上</option>
                                                @elseif($basic_info_skil_middleware -> evaluation == 2)
                                                    <option value=1>△1年未満</option>
                                                    <option value=2 selected>〇1年以上</option>
                                                    <option value=3>◎3年以上</option>
                                                @elseif($basic_info_skil_middleware -> evaluation == 3)
                                                    <option value=1>△1年未満</option>
                                                    <option value=2>〇1年以上</option>
                                                    <option value=3 selected>◎3年以上</option>
                                                @endif
                                            </select>
                                        </div>
                                        @php
                                            $basicSkillCounter ++;
                                        @endphp  
                                        @if($counter == 2 )
                                            @php
                                                $counter = 0;
                                            @endphp 
                                            </div>
                                        @endif 
                                    @endif
                                @endif
                            @endforeach

                            @for($i = 1; $i <= 3; $i++)
                    
                                @if($basicSkillCounter < 4)
                                    @if($basicSkillCounter % 4 == $i)
                                        @if($i == 2)
                                            <div class="basic_skill_area">
                                        @endif
                                            @for($k = 1; $k <= (4-$i); $k++)
                                                @php
                                                    $endDiv = 4-$i;
                                                    $idSelectNo++;
                                                @endphp
                                                <div class="basic_skill_item_area">
                                                    <select id="edit_middleware_select_{{$idSelectNo}}" name="edit_middleware[0][edit_middleware_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_middleware" disabled>
                                                        <option ></option>
                                                        @foreach ($skill_all_items as $skill_middleware_item)
                                                            @if($skill_middleware_item -> class_id == 4)
                                                                <option  class="mai-{{ $skill_middleware_item -> skill_name }}"  value="{{ $skill_middleware_item -> skill_name }}">{{ $skill_middleware_item -> skill_name }}</option>
                                                            @endif
                                                        @endforeach
                                                   </select>    
                                                    <select id="edit_middleware_select_ev_{{$idSelectNo}}" name="edit_middleware[0][edit_middleware_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled >
                                                        <option></option>
                                                        <option value=1>△1年未満</option>
                                                        <option value=2>〇1年以上</option>
                                                        <option value=3>◎3年以上</option>
                                                    </select>
                                                </div>
                                                @if($endDiv == 3 && $k == 1)
                                                    </div>
                                                    <div class="basic_skill_area">
                                                @endif      
                                            @endfor    
                                            </div>
                                        @endif
                                @endif
                                @if($basicSkillCounter > 4)
                                    @if($basicSkillCounter % 2 == $i)
                                        @php
                                            $idSelectNo++;
                                        @endphp
                                        <div class="basic_skill_item_area">
                                            <select id="edit_middleware_select_{{$idSelectNo}}" name="edit_middleware[0][edit_middleware_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_middleware" disabled>
                                                <option ></option>
                                                @foreach ($skill_all_items as $skill_middleware_item)
                                                    @if($skill_middleware_item -> class_id == 4)
                                                        <option  class="mai-{{ $skill_middleware_item -> skill_name }}"  value="{{ $skill_middleware_item -> skill_name }}">{{ $skill_middleware_item -> skill_name }}</option>
                                                    @endif
                                                @endforeach
                                           </select>
                                            <select id="edit_middleware_select_ev_{{$idSelectNo}}" name="edit_middleware[0][edit_middleware_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select"  disabled >
                                                <option></option>
                                                <option value=1>△1年未満</option>
                                                <option value=2>〇1年以上</option>
                                                <option value=3>◎3年以上</option>
                                            </select>
                                        </div>
                                        </div>
                                    @endif
                                @endif
                            @endfor

                            @if($basicSkillCounter == 0)             
                                @for($i = 1; $i <= 2; $i++)
                                    <div class="basic_skill_area">
                                        @for($k = 1; $k <= 2; $k++)
                                            @php
                                                $idSelectNo++;
                                            @endphp
                                            <div class="basic_skill_item_area">
                                                <select id="edit_middleware_select_{{$idSelectNo}}" name="edit_middleware[0][edit_middleware_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_middleware" disabled>
                                                    <option ></option>
                                                    @foreach ($skill_all_items as $skill_middleware_item)
                                                        @if($skill_middleware_item -> class_id == 4)
                                                            <option  class="mai-{{ $skill_middleware_item -> skill_name }}"  value="{{ $skill_middleware_item -> skill_name }}">{{ $skill_middleware_item -> skill_name }}</option>
                                                        @endif
                                                    @endforeach
                                               </select>
                                                <select id="edit_middleware_select_ev_{{$idSelectNo}}" name="edit_middleware[0][edit_middleware_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled>
                                                        <option></option>
                                                        <option value=1>△1年未満</option>
                                                        <option value=2>〇1年以上</option>
                                                        <option value=3>◎3年以上</option>
                                                </select>
                                            </div>
                                        @endfor
                                    </div>
                                @endfor
                            @endif                  
                            <div id="base_edit_middleware" class="w-100 mt-1 mb-1 p-1 border border-dark btn btn--orange basic_skil_bt" onclick="formAdd(this,'base_edit_middleware','base','middleware','')">
                                 <p class="m-1">＋</p>
                            </div>
                        </td>
                    </tr>            
                    <tr>
                       <th class="basic_info_th">FrameWork</th>
                       <td id="base_edit_framework_td" class="px-2 skill-tb-w">
                            @php
                               $basicSkillCounter = 0;
                               $counter = 0;
                               $idSelectNo = 0;
                               $temp_skill_name = "";
                            @endphp
                            @foreach ($basic_info_skill_list as $basic_info_skil_frameWork)
                                @if($basic_info_skil_frameWork->class_id == 6)
                                        
                                    @php
                                        $counter ++;
                                        $idSelectNo ++;
                                        $sub_class_name_flg = 0;
                                        $sub_class_name_array = [];
                                    @endphp
                                        
                                    @if($counter <= 2 )
                                        @if($counter == 1)
                                                <div class="basic_skill_area">
                                        @endif
                                        <div class="basic_skill_item_area">
                                            <select id="edit_framework_select_{{$idSelectNo}}" name="edit_framework[0][edit_framework_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_framework" disabled>
                                            <option></option>
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

                                                        <optgroup  id="framework_{{ $skill_framework_list_item -> sub_class_name }}_{{$idSelectNo}}" class="mai-{{ $skill_framework_list_item -> sub_class_name }}" label="{{ $skill_framework_list_item -> sub_class_name }}">
                                                            @foreach ($skill_all_items as $skill_framework_item)
                                                                @if($skill_framework_item -> class_id == 6)
                                                                    @if( $skill_framework_list_item -> sub_class_name == $skill_framework_item -> sub_class_name)
                                                                        @if( $skill_framework_list_item -> sub_class_name !== $skill_framework_item -> skill_name)
                                                                            <option class="sub-option sub_option_select_{{ $skill_framework_item -> sub_class_name }}_{{$idSelectNo}} {{ $skill_framework_item -> sub_class_name }}" value="{{ $skill_framework_item -> skill_name }}" {{$basic_info_skil_frameWork -> skill_name ==  $skill_framework_item -> skill_name ? 'selected' : ''}}>{{ $skill_framework_item -> skill_name }}</option>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </optgroup >
                                                    @endif
                                                @endforeach
                                            </select>                    
                                            <select id="edit_framework_select_ev_{{$idSelectNo}}" name="edit_framework[0][edit_framework_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled>
                                                    <option></option>
                                                @if($basic_info_skil_frameWork -> evaluation == 1 )
                                                    <option value=1 selected>△1年未満</option>
                                                    <option value=2>〇1年以上</option>
                                                    <option value=3>◎3年以上</option>
                                                @elseif($basic_info_skil_frameWork -> evaluation == 2)
                                                    <option value=1>△1年未満</option>
                                                    <option value=2 selected>〇1年以上</option>
                                                    <option value=3>◎3年以上</option>
                                                @elseif($basic_info_skil_frameWork -> evaluation == 3)
                                                    <option value=1>△1年未満</option>
                                                    <option value=2>〇1年以上</option>
                                                    <option value=3 selected>◎3年以上</option>
                                                @endif
                                            </select>
                                        </div>
                                        @php
                                            $basicSkillCounter ++;
                                        @endphp  
                                        @if($counter == 2 )
                                            @php
                                                $counter = 0;
                                            @endphp 
                                            </div>
                                        @endif 
                                    @endif
                                @endif
                            @endforeach

                            @for($i = 1; $i <= 3; $i++)
                    
                                @if($basicSkillCounter < 4)
                                    @if($basicSkillCounter % 4 == $i)
                                        @if($i == 2)
                                            <div class="basic_skill_area">
                                        @endif
                                            @for($k = 1; $k <= (4-$i); $k++)
                                                @php
                                                    $endDiv = 4-$i;
                                                    $idSelectNo++;
                                                    $sub_class_name_flg = 0;
                                                    $sub_class_name_array = [];
                                                @endphp
                                                <div class="basic_skill_item_area">
                                                    <select id="edit_framework_select_{{$idSelectNo}}" name="edit_framework[0][edit_framework_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_framework" disabled>
                                                        <option></option>
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
                                                                <optgroup id="framework_{{ $skill_framework_list_item -> sub_class_name }}_{{$idSelectNo}}" class="mai-{{ $skill_framework_list_item -> sub_class_name }}" label="{{ $skill_framework_list_item -> sub_class_name }}">
                                                                @foreach ($skill_all_items as $skill_framework_item)
                                                                    @if($skill_framework_item -> class_id == 6)
                                                                        @if( $skill_framework_list_item -> sub_class_name == $skill_framework_item -> sub_class_name)
                                                                            @if( $skill_framework_list_item -> sub_class_name !== $skill_framework_item -> skill_name)
                                                                                <option class="sub-option sub_option_select_{{ $skill_framework_item -> sub_class_name }}_{{$idSelectNo}} {{ $skill_framework_item -> sub_class_name }}"value="{{ $skill_framework_item -> skill_name }}">{{ $skill_framework_item -> skill_name }}</option>
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                                </optgroup>
                                                            @endif
                                                        @endforeach
                                                    </select>  
                                                    <select id="edit_framework_select_ev_{{$idSelectNo}}" name="edit_framework[0][edit_framework_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled >
                                                        <option></option>
                                                        <option value=1>△1年未満</option>
                                                        <option value=2>〇1年以上</option>
                                                        <option value=3>◎3年以上</option>
                                                    </select>
                                                </div>
                                                @if($endDiv == 3 && $k == 1)
                                                    </div>
                                                    <div class="basic_skill_area">
                                                @endif      
                                            @endfor    
                                            </div>
                                        @endif
                                @endif
                                @if($basicSkillCounter > 4)
                                    @if($basicSkillCounter % 2 == $i)
                                        @php
                                            $idSelectNo++;
                                            $sub_class_name_flg = 0;
                                            $sub_class_name_array = [];
                                        @endphp
                                        <div class="basic_skill_item_area">
                                            <select id="edit_framework_select_{{$idSelectNo}}" name="edit_framework[0][edit_framework_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_framework" disabled>
                                                <option></option>
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
                                                        <optgroup id="framework_{{ $skill_framework_list_item -> sub_class_name }}_{{$idSelectNo}}" class="mai-{{ $skill_framework_list_item -> sub_class_name }}" label="{{ $skill_framework_list_item -> sub_class_name }}">
                                                        @foreach ($skill_all_items as $skill_framework_item)
                                                            @if($skill_framework_item -> class_id == 6)
                                                                @if( $skill_framework_list_item -> sub_class_name == $skill_framework_item -> sub_class_name)
                                                                    @if( $skill_framework_list_item -> sub_class_name !== $skill_framework_item -> skill_name)
                                                                        <option class="sub-option sub_option_select_{{ $skill_framework_item -> sub_class_name }}_{{$idSelectNo}} {{ $skill_framework_item -> sub_class_name }}"value="{{ $skill_framework_item -> skill_name }}">{{ $skill_framework_item -> skill_name }}</option>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        </optgroup>
                                                    @endif
                                                @endforeach
                                            </select>  
                                            <select id="edit_framework_select_ev_{{$idSelectNo}}" name="edit_framework[0][edit_framework_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select"  disabled >
                                                <option></option>
                                                <option value=1>△1年未満</option>
                                                <option value=2>〇1年以上</option>
                                                <option value=3>◎3年以上</option>
                                            </select>
                                        </div>
                                        </div>
                                    @endif
                                @endif
                            @endfor

                            @if($basicSkillCounter == 0)             
                                @for($i = 1; $i <= 2; $i++)
                                    <div class="basic_skill_area">
                                        @for($k = 1; $k <= 2; $k++)
                                            @php
                                                $idSelectNo++;
                                                $sub_class_name_flg = 0;
                                                $sub_class_name_array = [];
                                            @endphp
                                            <div class="basic_skill_item_area">
                                                <select id="edit_framework_select_{{$idSelectNo}}" name="edit_framework[0][edit_framework_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_framework" disabled>
                                                    <option></option>
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
                                                            <optgroup id="framework_{{ $skill_framework_list_item -> sub_class_name }}_{{$idSelectNo}}" class="mai-{{ $skill_framework_list_item -> sub_class_name }}" label="{{ $skill_framework_list_item -> sub_class_name }}">
                                                            @foreach ($skill_all_items as $skill_framework_item)
                                                                @if($skill_framework_item -> class_id == 6)
                                                                    @if( $skill_framework_list_item -> sub_class_name == $skill_framework_item -> sub_class_name)
                                                                        @if( $skill_framework_list_item -> sub_class_name !== $skill_framework_item -> skill_name)
                                                                            <option class="sub-option sub_option_select_{{ $skill_framework_item -> sub_class_name }}_{{$idSelectNo}} {{ $skill_framework_item -> sub_class_name }}"value="{{ $skill_framework_item -> skill_name }}">{{ $skill_framework_item -> skill_name }}</option>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            </optgroup>
                                                        @endif
                                                    @endforeach
                                                </select>  
                                                <select id="edit_framework_select_ev_{{$idSelectNo}}" name="edit_framework[0][edit_framework_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled>
                                                        <option></option>
                                                        <option value=1>△1年未満</option>
                                                        <option value=2>〇1年以上</option>
                                                        <option value=3>◎3年以上</option>
                                                </select>
                                            </div>
                                        @endfor
                                    </div>
                                @endfor
                            @endif                  
                            <div id="base_edit_framework" class="w-100 mt-1 mb-1 p-1 border border-dark btn btn--orange basic_skil_bt" onclick="formAdd(this,'base_edit_framework','base','framework','')">
                                 <p class="m-1">＋</p>
                            </div>                                                 
                        </td>
                    </tr>
                    <tr>
                       <th class="basic_info_th">その他</th>
                       <td id="base_edit_others_td" class="px-2 skill-tb-w">
                            @php
                               $basicSkillCounter = 0;
                               $counter = 0;
                               $idSelectNo = 0;
                               $temp_skill_name = "";
                            @endphp
                            @foreach ($basic_info_skill_list as $basic_info_skil_others)
                                @if($basic_info_skil_others->class_id == 7)
                                        
                                    @php
                                        $counter ++;
                                        $idSelectNo ++;
                                        $sub_class_name_flg = 0;
                                        $sub_class_name_array = [];
                                    @endphp
                                        
                                    @if($counter <= 2 )
                                        @if($counter == 1)
                                            <div class="basic_skill_area">
                                        @endif
                                        <div class="basic_skill_item_area">
                                            <select id="edit_others_select_{{$idSelectNo}}" name="edit_others[0][edit_others_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_others" disabled>
                                                <option></option>
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
                                                        <optgroup id="others_{{ $skill_others_list_item -> sub_class_name }}_{{$idSelectNo}}" class="mai-{{ $skill_others_list_item -> sub_class_name }}" label="{{ $skill_others_list_item -> sub_class_name }}">
                                                        @foreach ($skill_all_items as $skill_others_item)
                                                            @if($skill_others_item -> class_id == 7)
                                                                @if( $skill_others_list_item -> sub_class_name == $skill_others_item -> sub_class_name)
                                                                    @if( $skill_others_list_item -> sub_class_name !== $skill_others_item -> skill_name)
                                                                        <option class="sub-option sub_option_select_{{ $skill_others_item -> sub_class_name }}_{{$idSelectNo}} {{ $skill_others_item -> sub_class_name }}"value="{{ $skill_others_item -> skill_name }}" {{$basic_info_skil_others -> skill_name ==  $skill_others_item -> skill_name ? 'selected' : ''}}>{{ $skill_others_item -> skill_name }}</option>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        </optgroup>    
                                                    @endif
                                                @endforeach
                                            </select>                    
                                            <select id="edit_others_select_ev_{{$idSelectNo}}" name="edit_others[0][edit_others_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled>
                                                <option></option>
                                                @if($basic_info_skil_others -> evaluation == 1 )
                                                    <option value=1 selected>△1年未満</option>
                                                    <option value=2>〇1年以上</option>
                                                    <option value=3>◎3年以上</option>
                                                @elseif($basic_info_skil_others -> evaluation == 2)
                                                    <option value=1>△1年未満</option>
                                                    <option value=2 selected>〇1年以上</option>
                                                    <option value=3>◎3年以上</option>
                                                @elseif($basic_info_skil_others -> evaluation == 3)
                                                    <option value=1>△1年未満</option>
                                                    <option value=2>〇1年以上</option>
                                                    <option value=3 selected>◎3年以上</option>
                                                @endif
                                            </select>
                                        </div>
                                        @php
                                            $basicSkillCounter ++;
                                        @endphp  
                                        @if($counter == 2 )
                                            @php
                                                $counter = 0;
                                            @endphp 
                                            </div>
                                        @endif 
                                    @endif
                                @endif
                            @endforeach

                            @for($i = 1; $i <= 3; $i++)
                    
                                @if($basicSkillCounter < 4)
                                    @if($basicSkillCounter % 4 == $i)
                                        @if($i == 2)
                                            <div class="basic_skill_area">
                                        @endif
                                            @for($k = 1; $k <= (4-$i); $k++)
                                                @php
                                                    $endDiv = 4-$i;
                                                    $idSelectNo++;
                                                    $sub_class_name_flg = 0;
                                                    $sub_class_name_array = [];
                                                @endphp
                                                <div class="basic_skill_item_area">
                                                    <select id="edit_others_select_{{$idSelectNo}}" name="edit_others[0][edit_others_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_others" disabled>
                                                        <option></option>
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
                                                                    <optgroup id="others_{{ $skill_others_list_item -> sub_class_name }}_{{$idSelectNo}}" class="mai-{{ $skill_others_list_item -> sub_class_name }}" label="{{ $skill_others_list_item -> sub_class_name }}">
                                                                    @foreach ($skill_all_items as $skill_others_item)
                                                                        @if($skill_others_item -> class_id == 7)
                                                                            @if( $skill_others_list_item -> sub_class_name == $skill_others_item -> sub_class_name)
                                                                                @if( $skill_others_list_item -> sub_class_name !== $skill_others_item -> skill_name)
                                                                                    <option class="sub-option sub_option_select_{{ $skill_others_item -> sub_class_name }}_{{$idSelectNo}} {{ $skill_others_item -> sub_class_name }}"value="{{ $skill_others_item -> skill_name }}">{{ $skill_others_item -> skill_name }}</option>
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                    </optgroup>  
                                                                @endif
                                                            @endforeach
                                                    </select>     
                                                    <select id="edit_others_select_ev_{{$idSelectNo}}" name="edit_others[0][edit_others_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled >
                                                        <option></option>
                                                        <option value=1>△1年未満</option>
                                                        <option value=2>〇1年以上</option>
                                                        <option value=3>◎3年以上</option>
                                                    </select>
                                                </div>
                                                @if($endDiv == 3 && $k == 1)
                                                    </div>
                                                    <div class="basic_skill_area">
                                                @endif      
                                            @endfor    
                                            </div>
                                        @endif
                                @endif
                                @if($basicSkillCounter > 4)
                                    @if($basicSkillCounter % 2 == $i)
                                        @php
                                            $idSelectNo++;
                                            $sub_class_name_flg = 0;
                                            $sub_class_name_array = [];
                                        @endphp
                                        <div class="basic_skill_item_area">
                                            <select id="edit_others_select_{{$idSelectNo}}" name="edit_others[0][edit_others_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_others" disabled>
                                                <option></option>
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
                                                        <optgroup id="others_{{ $skill_others_list_item -> sub_class_name }}_{{$idSelectNo}}" class="mai-{{ $skill_others_list_item -> sub_class_name }}" label="{{ $skill_others_list_item -> sub_class_name }}">
                                                        @foreach ($skill_all_items as $skill_others_item)
                                                            @if($skill_others_item -> class_id == 7)
                                                                @if( $skill_others_list_item -> sub_class_name == $skill_others_item -> sub_class_name)
                                                                    @if( $skill_others_list_item -> sub_class_name !== $skill_others_item -> skill_name)
                                                                        <option class="sub-option sub_option_select_{{ $skill_others_item -> sub_class_name }}_{{$idSelectNo}} {{ $skill_others_item -> sub_class_name }}"value="{{ $skill_others_item -> skill_name }}">{{ $skill_others_item -> skill_name }}</option>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        </optgroup>  
                                                    @endif
                                                @endforeach
                                            </select> 
                                            <select id="edit_others_select_ev_{{$idSelectNo}}" name="edit_others[0][edit_others_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select"  disabled >
                                                <option></option>
                                                <option value=1>△1年未満</option>
                                                <option value=2>〇1年以上</option>
                                                <option value=3>◎3年以上</option>
                                            </select>
                                        </div>
                                        </div>
                                    @endif
                                @endif
                            @endfor

                            @if($basicSkillCounter == 0)             
                                @for($i = 1; $i <= 2; $i++)
                                    <div class="basic_skill_area">
                                        @for($k = 1; $k <= 2; $k++)
                                            @php
                                                $idSelectNo++;
                                                $sub_class_name_flg = 0;
                                                $sub_class_name_array = [];
                                            @endphp
                                            <div class="basic_skill_item_area">
                                                <select id="edit_others_select_{{$idSelectNo}}" name="edit_others[0][edit_others_select_{{$idSelectNo}}[0][skillName]]" class="basic_skil_name_select basic_search_others" disabled>
                                                    <option></option>
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
                                                            <optgroup id="others_{{ $skill_others_list_item -> sub_class_name }}_{{$idSelectNo}}" class="mai-{{ $skill_others_list_item -> sub_class_name }}" label="{{ $skill_others_list_item -> sub_class_name }}">
                                                            @foreach ($skill_all_items as $skill_others_item)
                                                                @if($skill_others_item -> class_id == 7)
                                                                    @if( $skill_others_list_item -> sub_class_name == $skill_others_item -> sub_class_name)
                                                                        @if( $skill_others_list_item -> sub_class_name !== $skill_others_item -> skill_name)
                                                                            <option class="sub-option sub_option_select_{{ $skill_others_item -> sub_class_name }}_{{$idSelectNo}} {{ $skill_others_item -> sub_class_name }}"value="{{ $skill_others_item -> skill_name }}">{{ $skill_others_item -> skill_name }}</option>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            </optgroup>  
                                                        @endif
                                                    @endforeach
                                                </select> 
                                                <select id="edit_others_select_ev_{{$idSelectNo}}" name="edit_others[0][edit_others_select_{{$idSelectNo}}[0][evaluation]]" class="basic_evaluation_name_select" disabled>
                                                        <option></option>
                                                        <option value=1>△1年未満</option>
                                                        <option value=2>〇1年以上</option>
                                                        <option value=3>◎3年以上</option>
                                                </select>
                                            </div>
                                        @endfor
                                    </div>
                                @endfor
                            @endif                  
                            <div id="base_edit_others" class="w-100 mt-1 mb-1 p-1 border border-dark btn btn--orange basic_skil_bt" onclick="formAdd(this,'base_edit_others','base','others','')">
                                 <p class="m-1">＋</p>
                            </div>                                                  
                        </td>
                    </tr>
                </table>
             </div>
        </form>
    </div>
