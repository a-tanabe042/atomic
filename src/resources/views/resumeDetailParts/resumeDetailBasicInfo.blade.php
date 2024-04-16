<div class="basic_info_area my-2">
    @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='sales' || (session()->get('auth_name'))==='admin')
        <div Id="basic_info_edit_bt_area" class="basic_info_edit_bt_area text-right my-2">
            <button Id="basic_info_bt_e" type="button" class="btn btn--orange" value="{{$basic_info_items[0]->first_name}},{{$basic_info_items[0]->last_name}}" onclick=editMode(this)>編集</button>
        </div>
    @endif
    <div id="basic_info_show" class="basic_info_show">
        <table class="basic_info_skill datail_title_style w-100 my-2" border="1">
            <tr>
                <th class="basic_info_th">名前</th>
                <td colspan="7" class="px-2">{{$basic_info_items[0]->last_name}} {{$basic_info_items[0]->first_name}}</td>
             </tr>
             <tr>
                <th class="basic_info_th">フリガナ</th>
                <td colspan="7" class="px-2">{{$basic_info_items[0]->last_name_kana}} {{$basic_info_items[0]->first_name_kana}}</td>
            </tr>
            <tr>
                <th class="basic_info_th">イニシャル</th>
                <td class="text-center pr-0 px-2">{{$basic_info_items[0]->initial}}</td>
                <th>生年月日</th>
                <td  class="text-center px-2">{{$basic_info_items[0]->year}}年 {{$basic_info_items[0]->month}}月 {{$basic_info_items[0]->day}}日</td>
                <th>年齢</th>
                <td  class="text-center px-2">{{$basic_info_items[0]->age}}</td>
                <th>性別</th>
                <td class="text-center px-2">
                     @if($basic_info_items[0]->gender == 0)
                        男
                     @else
                        女
                     @endif
                </td>
            </tr>
            <tr>
                <th class="basic_info_th">実務年数</th>
                <td colspan="7" class="px-2">{{$basic_info_items[0]->real_years}}年 {{$basic_info_items[0]->real_month}}ヵ月</td>
            </tr>
            <tr>
                 <th class="basic_info_th">稼働開始可能</th>
                 <td colspan="7" class="px-2">{{$basic_info_items[0]->start_year}}年 {{$basic_info_items[0]->start_month}}月</td>
            </tr>            
            <tr>
                <th class="basic_info_th">最寄り駅</th>
                <td colspan="7" class="px-2">{{$basic_info_items[0]->station}}</td>
            </tr>
            <tr>
                <th class="basic_info_th">保有資格</th>
                <td colspan="7" class="px-2">
                    @foreach ($basic_info_license_items as $basic_info_items_license)
                        {{$basic_info_items_license -> license_name}}
                    @endforeach
                </td>
            </tr>
            <tr>
                <th class="basic_info_th">自己PR</th>
                <td colspan="7" class="px-2">{!! nl2br($basic_info_items[0] -> my_pr) !!}</td>
            </tr>
             @if ($basic_info_items[0] -> condition_flg == 1)
                <tr>
                    <th class="basic_info_th">希望の条件</th>
                    <td colspan="6" class="px-2">{{$basic_info_items[0] -> condition_text}}</td>
                </tr>
            @endif
        </table>
    </div>
    <form id="basic_info_form_edit"action="{{ route('createDetail.update', ['PressedEdit' => 'myInf','user_id'=>$basic_info_items[0]->user_id]) }}" method="post" onsubmit="return basicInfoCheck(this)" >
        @csrf
         @method('PATCH')
        <div Id="basic_info_cancel_bt_area" class="basic_info_cancel_bt_area text-right my-2">
            <button Id="basic_info_bt_add" type="submit button" class="btn btn--orange menu_keep_button">保存</button>
            <input Id="basic_info_bt_c" type="reset" class="btn btn--orange"  onclick=editMode(this) value="キャンセル">
        </div>
        <div id="basic_info_edit" class="basic_info_edit">
            <table class="basic_info datail_title_style w-100 my-2" border="1">
                <tr>
                    <th class="basic_info_th">名前</th>
                    <td colspan="7"  class="px-2">{{$basic_info_items[0]->last_name}} {{$basic_info_items[0]->first_name}}</td>
                 </tr>
                 <tr>
                    <th class="basic_info_th">フリガナ</th>
                    <td colspan="7"  class="px-2">{{$basic_info_items[0]->last_name_kana}} {{$basic_info_items[0]->first_name_kana}}</td>
                </tr>
                <tr>
                    <th class="basic_info_th">イニシャル</th>
                    <td  class="px-2 initial-W">{{$basic_info_items[0]->initial}}</td>
                    <th class="required">生年月日</th>
                    <td  class="px-2 w-25">
                        <div class="err_msg_birthday basic_info_err_msg"></div>
                        @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')
                        <div class="d-flex">
                            <select id="birthday_year" name="birthday_year"  class="birthday_year mr-1 basic_info_edit_check">
                                <option id="birthday_yea_op" value="{{$basic_info_items[0]->year}}"  class="d-none">{{$basic_info_items[0]->year}}</option>
                            </select>
                            年                                                
                            <select id="birthday_month" name="birthday_month" value="{{$basic_info_items[0]->month}}" class="birthday_month mx-1 basic_info_edit_check">
                                <option id="birthday_month_op" value="{{$basic_info_items[0]->month}}" class="d-none">{{$basic_info_items[0]->month}}</option>
                            </select>
                            月
                            <select  id="birthday_day"  name="birthday_day" value="{{$basic_info_items[0]->day}}" class="birthday_day mx-1 basic_info_edit_check">
                                <option  id="birthday_day_op"  value="{{$basic_info_items[0]->day}}" class="d-none"> {{$basic_info_items[0]->day}}</option>
                            </select>
                            日
                        </div>
                        @else
                        <div class="d-flex">
                            <select name="birthday_year" class="birthday_year mr-1 basic_info_edit_check" disabled>
                                <option value="{{$basic_info_items[0]->year}}"> {{$basic_info_items[0]->year}}</option>
                            </select>年                                                
                            <select name="birthday_month" class="birthday_month mx-1 basic_info_edit_check" disabled>
                                <option value="{{$basic_info_items[0]->month}}"> {{$basic_info_items[0]->month}}</option>
                            </select>月
                            <select name="birthday_day" class="birthday_day mx-1 basic_info_edit_check" disabled>
                                <option value="{{$basic_info_items[0]->day}}"> {{$basic_info_items[0]->day}}</option>
                            </select>日
                        </div>                                                    
                        @endif
                    </td>
                    <th>性別</th>
                    <td class="text-center">
                        <div class="err_msg_gender"></div>
                        @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')
                             @if($basic_info_items[0]->gender == 0)
                                <input type="radio" name="gender" value="0"  class="mx-1 disabled" checked>男性
                                <input type="radio" name="gender" value="1"  class="mx-1 disabled">女性
                             @else
                                <input type="radio" name="gender" value="0"  class="mx-1 disabled">男性
                                <input type="radio" name="gender" value="1"  class="mx-1 disabled" checked>女性
                            @endif
                        @else
                            @if($basic_info_items[0]->gender == 0)
                                <input type="radio" name="gender" value="0"  class="mx-1 disabled" checked disabled>男性
                                <input type="radio" name="gender" value="1"  class="mx-1 disabled" disabled>女性
                             @else
                                <input type="radio" name="gender" value="0"  class="mx-1 disabled" disabled>男性
                                <input type="radio" name="gender" value="1"  class="mx-1 disabled" checked disabled>女性
                            @endif
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="basic_info_th">実務年数</th>
                    <td colspan="7" class="px-2">
                    <div class="form-select-wrap">
                    @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')
                        <div class="d-flex">
                            <select name="real_year" class="real_year mr-1">
                                <option id="real_year_op" value="{{$basic_info_items[0]->real_years}}" class="d-none"> {{$basic_info_items[0]->real_years}}</option>
                            </select>年                                                
                            <select name="real_month" class="real_month mx-1">
                                <option id="real_month_op" value="{{$basic_info_items[0]->real_month}}" class="d-none"> {{$basic_info_items[0]->real_month}}</option>
                            </select>ヵ月
                        </div>
                    @else
                        <div class="d-flex">
                            <select name="real_year" class="real_year mr-1" disabled>
                                <option name="real_year_op" value="{{$basic_info_items[0]->real_years}}" > {{$basic_info_items[0]->real_years}}</option>
                            </select>年                                                
                            <select name="real_month" class="real_month mx-1" disabled>
                                <option name="real_month_op" value="{{$basic_info_items[0]->real_month}}"> {{$basic_info_items[0]->real_month}}</option>
                            </select>ヵ月
                        </div>
                    @endif
                    </div>
                    </td>
                </tr>
                <tr>
                     <th class="basic_info_th">稼働開始可能</th>
                     <td colspan="7" class="px-2">
                        <select name="operable_years" class="operable_years mr-1">
                            <option id="operable_years_op" value="{{$basic_info_items[0]->start_year}}" class="d-none">{{$basic_info_items[0]->start_year}}</option>
                        </select>年                                                
                        <select name="operable_month" class="operable_month mx-1">
                            <option id="operable_month_op" value="{{$basic_info_items[0]->start_month}}" class="d-none"> {{$basic_info_items[0]->start_month}}</option>
                        </select>月
                    </td>
                </tr>            
                <tr>
                    <th class="basic_info_th required">最寄り駅</th>
                    <td colspan="7" class="px-2">
                         <div class="err_msg_station basic_info_err_msg"></div>
                        @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')
                            <input name="station"class="w-30 mr-1 basic_info_edit_check"  value="{{$basic_info_items[0]->station}}">駅
                        @else
                            <input name="station"class="w-30 mr-1 basic_info_edit_check"  value="{{$basic_info_items[0]->station}}" disabled>駅
                        @endif
                     </td>
                </tr>
                <tr>
                <th class="basic_info_th position-relative">保有資格
                    <div class="tooltip1">
                        <img src="{{ asset('img/Question.png') }}" class="posQ">
                        <div class="description1">チェックされた資格名が出力されたレジュメに表示されます。<br>また、2個までチェック可能です。
                        </div>
                    </div>
                </th>
                    <td id="edit_license_td" colspan="7" class="px-2">
                    <div class="err_msg_license"></div>
                        @php
                            $counter= 0;
                            $licenseCounter =0;
                            $idInputCounter = 0;
                            $sumCounter  = 0;
                        @endphp
                        @foreach ($basic_info_license_items as $basic_info_items_license)
                            @php
                                $counter++;
                                $sumCounter++;
                                $idInputCounter++;
                            @endphp
                            @if($counter <= 3 )
                                @if($counter == 1)
                                    <div class="edit_license_flex">
                                @endif
                                    <div class="license_foam_area">
                                    @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')
                                        <input  id="edit_license_input_{{$idInputCounter}}" name="license[{{$idInputCounter}}][edit_license_input]"  class="license_input"  value="{{$basic_info_items_license -> license_name}}">
                                        @if($basic_info_items_license -> output > 0)
                                            <input id="check_edit_license_input_{{$idInputCounter}}" type="checkbox" name="license[{{$idInputCounter}}][check_license_input]"  class="license_check" value= 1 checked>
                                        @else
                                            <input id="check_edit_license_input_{{$idInputCounter}}" type="checkbox" name="license[{{$idInputCounter}}][check_license_input]"   class="license_check" value= 1>
                                        @endif
                                    @else
                                        <input  id="edit_license_input_{{$idInputCounter}}" name="license[{{$idInputCounter}}][edit_license_input]"  class="license_input"  value="{{$basic_info_items_license -> license_name}}" disabled>
                                        @if($basic_info_items_license -> output > 0)
                                            <input id="check_edit_license_input_{{$idInputCounter}}" type="checkbox" name="license[{{$idInputCounter}}][check_license_input]"  class="license_check" value= 1 checked disabled>
                                        @else
                                            <input id="check_edit_license_input_{{$idInputCounter}}" type="checkbox" name="license[{{$idInputCounter}}][check_license_input]"   class="license_check" value= 1 disabled>
                                        @endif
                                    @endif
                                    </div>
                                    @php
                                        $licenseCounter++;
                                    @endphp   
                                    @if($counter == 3 )
                                        @php
                                            $counter = 0;
                                        @endphp 
                                        </div>
                                    @endif                                                               
                           
                            @endif
                            @if($loop->last)                                                 
                               
                                    @php
                                        if($counter !== 0){
                                            $mod = 3 - $counter;
                                        }else{
                                            $mod = 0;
                                        }
                                    @endphp
                                    @for($i = 0; $i < $mod; $i++)
                                        @php
                                            $idInputCounter++;
                                        @endphp
                                        <div class="license_foam_area">
                                        @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')
                                            <input id="edit_license_input_{{$idInputCounter}}"  name="license[{{$idInputCounter}}][edit_license_input]" class="license_input"  value="" >
                                            <input id="check_edit_license_input_{{$idInputCounter}}" type="checkbox"  name="license[{{$idInputCounter}}][check_license_input]" class="license_check" value= 1 >
                                        @else
                                            <input id="edit_license_input_{{$idInputCounter}}"  name="license[{{$idInputCounter}}][edit_license_input]" class="license_input"  value="" disabled>
                                            <input id="check_edit_license_input_{{$idInputCounter}}" type="checkbox"  name="license[{{$idInputCounter}}][check_license_input]" class="license_check" value= 1 disabled>
                                        @endif
                                        </div>
                                    @endfor
                                    @if( $i !== 0 ||$i == $mod)
                                            </div>
                                        @endif
                                @if($sumCounter <= 3)
                                    <div class="edit_license_flex">
                                            @for($k = 1; $k <= 3; $k++)
                                                @php
                                                 $idInputCounter++;
                                                @endphp
                                                <div class="license_foam_area">
                                                @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')
                                                    <input id="edit_license_input_{{$idInputCounter}}" name="license[{{$idInputCounter}}][edit_license_input]" class="license_input" value="">
                                                    <input id="check_edit_license_input_{{$idInputCounter}}" type="checkbox"  name="license[{{$idInputCounter}}][check_license_input]" class="license_check" value= 1>
                                                @else
                                                    <input id="edit_license_input_{{$idInputCounter}}" name="license[{{$idInputCounter}}][edit_license_input]" class="license_input" value="" disabled>
                                                    <input id="check_edit_license_input_{{$idInputCounter}}" type="checkbox"  name="license[{{$idInputCounter}}][check_license_input]" class="license_check" value= 1 disabled>
                                                @endif
                                                </div>
                                            @endfor
                                    </div> 
                                @endif
                            @endif
                    @endforeach
                    @if($licenseCounter == 0)
                                    @for($i = 1; $i <= 2; $i++)
                                    <div class="edit_license_flex">
                                        @for($k = 1; $k <= 3; $k++)
                                             @php
                                                  $idInputCounter++;
                                             @endphp
                                            <div class="license_foam_area">
                                            @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')
                                                <input id="edit_license_input_{{$idInputCounter}}" name="license[{{$idInputCounter}}][edit_license_input]" class="license_input" value="">
                                                <input id="check_edit_license_input_{{$idInputCounter}}" type="checkbox"  name="license[{{$idInputCounter}}][check_license_input]"  class="license_check" value= 1>
                                            @else
                                                <input id="edit_license_input_{{$idInputCounter}}" name="license[{{$idInputCounter}}][edit_license_input]" class="license_input" value="" disabled>
                                                <input id="check_edit_license_input_{{$idInputCounter}}" type="checkbox"  name="license[{{$idInputCounter}}][check_license_input]"  class="license_check" value= 1 disabled>
                                            @endif
                                            </div>
                                        @endfor
                                    </div>
                                     @endfor
                    @endif
                    @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')
                        <div id="edit_license" class="w-100 mt-2 mb-1 p-1 border border-dark btn btn--orange" onclick="formAdd(this,'edit_license','license','','')">
                            <p class="m-1">＋</p>
                        </div>
                    @endif
                </tr>
                <tr>
                    <th class="basic_info_th required">自己PR</th>
                    <td colspan="7" class="px-2">
                        <div class="err_msg_my_pr basic_info_err_msg"></div>
                        @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')
                        <textarea name="my_pr" class="my_pr_height w-100 basic_info_edit_check" value="{{$basic_info_items[0] -> my_pr}}">{{$basic_info_items[0] -> my_pr}}</textarea >
                        @else
                        <textarea name="my_pr" class="my_pr_height w-100 basic_info_edit_check" value="{{$basic_info_items[0] -> my_pr}}" disabled>{{$basic_info_items[0] -> my_pr}}</textarea >
                        @endif
                    </td>
                </tr>
                 @if ($basic_info_items[0] -> condition_flg == 1)
                    <tr>
                        <th class="basic_info_th">希望の条件</th>
                        <td colspan="6" class="px-2">
                        @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')
                            <textarea name="condition_text" class="w-100" value="{{$basic_info_items[0] -> condition_text}}">{{$basic_info_items[0] -> condition_text}}</textarea >
                        @else
                            <textarea name="condition_text" class="w-100" value="{{$basic_info_items[0] -> condition_text}}" disabled>{{$basic_info_items[0] -> condition_text}}</textarea >
                        @endif
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </form>
</div>

