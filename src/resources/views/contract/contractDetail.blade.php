@extends('layouts.template')

@section('title', '契約管理・延長情報管理詳細')
@include('layouts.head')

@section('content')
<div class="list">
    <h4 class="text-color-light-blue font-weight-bold">
        契約管理・延長情報管理詳細
    </h4>

    <div class="d-flex justify-content-between my-4" id="contract">
        <div class="text-left">
            <button class="btn btn--orange d-flex menu_keep_button list_url_get">
                <div class="arrow arrow-left"></div>
                <span class="mb-0 pl-1">戻る</span>
            </button>
        </div>
        <div class="contract text-right">
            <div class="tooltip2">
                <div class="description2">「ステータス」または「継続確定/終了確定年月日」を更新した際は通知をしてください</div>
                <img src="{{ asset('img/Question.png') }}" class="posQ">
            </div>
            <button id="contractList" type="button" class="btn btn--orange mt-1">編集</button>
            <button id="contract-slack" type="submit" class="btn btn--orange menu_keep_button mt-1" form="contractSlack">通知</button>
        </div>
        <div class="edit-contract" id="edit-contract">
            <input id="contractCancel" type="reset" value="キャンセル" class="btn btn-hover mt-1" form="update">
            <button type="input" class="btn btn-danger menu_keep_button mt-1" id="mailbutton" form="update">保存</button>
        </div>
    </div>
    @if (session('flash_message'))
        <div class="flash_message alert-danger">
            {{ session('flash_message') }}
        </div>
    @endif
    @if (session('success_message'))
        <div class="flash_message alert-success">
            {{ session('success_message') }}
        </div>
    @endif


    @foreach($user as $user)
    
    <form action="{{ route('slack.send', ['last_name'=>$user->last_name,'first_name'=>$user->first_name]) }}" method="post" id="contractSlack">
        @csrf
    </form>
    <form action="{{ route('update.contract_flg', ['user_id'=>$user->user_id]) }}" method="POST" id="flgChange">
        @csrf
    </form>
    <div class="contract">
        <table class="basic_info_skill datail_title_style w-100 my-2">
            <tr>
                <th class="basic_info_th">名前</th>
                <td >{{$user->last_name}} {{$user->first_name}}</td>
            </tr>
        </table>

        <table class="basic_info_skill datail_title_style w-100 my-2 mb-5">
            <tr>
                <th class="basic_info_th">延長確認</th>
                <td class="continuation">
                    @if($user->continuation_flg === 0)
                        延長する
                    @elseif($user->continuation_flg === 1)
                        延長しない
                    @elseif($user->continuation_flg === 2)
                        保留
                    @elseif($user->continuation_flg === null)
                        
                    @endif
                </td>
                <th >更新日</th>
                <td >{{substr($user->modify_date, 0, 10)}}</td>
            </tr>
            @if($user->continuation_flg === 1 || $user->continuation_flg === 2)
                <tr>
                    <th class="basic_info_th">延長確認備考</th>
                    <td class="w-100" colspan="7">{{$user->continuation_text}}</td>
                </tr>
            @endif
        </table>
    </div>
    <div class="edit-contract">
        <table class="basic_info_skill datail_title_style w-100 my-2">
            <tr>
                <th class="basic_info_th">名前</th>
                <td>{{$user->last_name}} {{$user->first_name}}</td>
            </tr>
        </table>

        <table class="basic_info_skill datail_title_style w-100 my-2 mb-5">
            <tr>
                <th class="basic_info_th">延長確認</th>
                <td class="continuation">
                    @if((session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')
                    <select class="continuation_flg" name="continuation_flg" form="update">
                        <option></option>
                        <option value="0" {{ $user->continuation_flg === 0 ? 'selected' : ''}}>延長する</option>
                        <option value="1" {{ $user->continuation_flg === 1 ? 'selected' : ''}}>延長しない</option>
                        <option value="2" {{ $user->continuation_flg === 2 ? 'selected' : ''}}>保留</option>
                    </select>
                    @else
                        @if($user->continuation_flg === 0)
                            延長する
                        @elseif($user->continuation_flg === 1)
                            延長しない
                        @elseif($user->continuation_flg === 2)
                            保留
                        @else
                            
                        @endif
                    @endif
                </td>
                <th>更新日</th>
                <td>{{substr($user->modify_date, 0, 10)}}</td>
            </tr>
            @if((session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')
            <tr class="continuation_text">
                <th class="basic_info_th">延長確認備考</th>
                <td colspan="7">
                    <textarea class="w-100" name="continuation_text" value="{{$user->continuation_text}}" form="update" placeholder="「延長しない」、「保留」を選択した場合は記入してください">{{$user->continuation_text}}</textarea>
                </td>
            </tr>
            @endif
        </table>
    </div>
    @endforeach

    
    <div class="contract contract-list">
        @foreach($contract_detail as $detail)
        @if($detail->matter_flg == 0)
        <div class="contract-title">現在の案件</div>
            <table class="basic_info_skill datail_title_style w-100 mb-4">
                <tr class="contract-tr">
                    <th class="basic_info_th contract-th">お客様先</th>
                    <td colspan="7" class="conract-name">{{$detail->contract_name}}</td>
                </tr>
                <tr class="contract-tr">
                    <th>勤務形態</th>
                    <td class="working_form">
                        {{$detail->working_form === 0 ? 'SES' : ''}}
                        {{$detail->working_form === 1 ? 'ラボ' : ''}}
                        {{$detail->working_form === 2 ? '請負' : ''}}
                        {{$detail->working_form === 3 ? '自社' : ''}}
                    </td>
                    <th>契約サイクル</th>
                    <td>{{$detail->contract_cycle}}ヶ月</td>
                    <th>ステータス</th>
                    <td>
                        {{$detail->contract_status === 0 ? '継続' : ''}}
                        {{$detail->contract_status === 1 ? '終了' : ''}}
                    </td>
                </tr>
                @if($detail->contract_status === 0)
                <tr class="contract-tr">
                    <th class="basic_info_th">継続確定年月日</th>
                    <td colspan="7" class="conract-name">{{substr($detail->continuation_month, 0, 4)}}年{{substr($detail->continuation_month, 4, 2)}}月まで延長確定</td>
                </tr>
                @endif
                @if($detail->contract_status === 1)
                <tr class="contract-tr">
                    <th class="basic_info_th">終了確定年月日</th>
                    <td colspan="7" class="conract-name">{{substr($detail->end_month, 0, 4)}}年{{substr($detail->end_month, 4, 2)}}月で終了確定</td>
                </tr>
                @endif
                <tr>
                    <th class="basic_info_th">担当営業</th>
                    <td colspan="7" class="conract-name">{{$detail->last_name}} {{$detail->first_name}}</td>
                </tr>
            </table>

        @endif
        @endforeach

        @foreach($contract_detail as $detail)
        @if($detail->matter_flg === 1)
        <div>
            <div class=" text-right">
                <button type="submit" class="btn btn-hover mt-1 text-right" form="flgChange">今の案件に変更</button>
            </div>
            <div class="contract-title mt-1">次の案件</div>
        </div>
            <table class="basic_info_skill datail_title_style w-100 mb-4">
                <tr class="contract-tr">
                    <th class="basic_info_th contract-th">お客様先</th>
                    <td  colspan="7"  class="conract-name">{{$detail->contract_name}}</td>
                </tr>
                <tr class="contract-tr">
                    <th>勤務形態</th>
                    <td class="working_form">
                        {{$detail->working_form === 0 ? 'SES' : ''}}
                        {{$detail->working_form === 1 ? 'ラボ' : ''}}
                        {{$detail->working_form === 2 ? '請負' : ''}}
                        {{$detail->working_form === 3 ? '自社' : ''}}
                    </td>
                    <th>契約サイクル</th>
                    <td>{{$detail->contract_cycle}}ヶ月</td>
                    <th>ステータス</th>
                    <td>
                        {{$detail->contract_status === 0 ? '継続' : ''}}
                        {{$detail->contract_status === 1 ? '終了' : ''}}
                    </td>
                </tr>
                @if($detail->contract_status === 0)
                <tr class="contract-tr">
                    <th class="basic_info_th">継続確定年月日</th>
                    <td  colspan="7"  class="conract-name">{{substr($detail->continuation_month, 0, 4)}}年{{substr($detail->continuation_month, 4, 2)}}月まで継続確定</td>
                </tr>
                @endif
                @if($detail->contract_status === 1)
                <tr class="contract-tr">
                    <th class="basic_info_th">終了確定年月日</th>
                    <td  colspan="7"  class="conract-name">{{substr($detail->end_month, 0, 4)}}年{{substr($detail->end_month, 4, 2)}}月で終了確定</td>
                </tr>
                @endif
                <tr>
                    <th class="basic_info_th">担当営業</th>
                    <td  colspan="7"  class="conract-name">{{$detail->last_name}} {{$detail->first_name}}</td>
                </tr>
            </table>
        @endif
        @endforeach
    </div>

    <!-- 編集画面 -->
    <div class="edit-contract contract-list">
        @foreach($contract_detail as $detail)
        <form action="{{ route('update.contract', ['user_id'=>$detail->user_id]) }}" method="post" id="update">
            @csrf
                @if($detail->matter_flg == 0)
                    <div>
                        <div class="contract-title">現在の案件</div>
                    </div>
                    <table class="basic_info_skill datail_title_style w-100 mb-5">
                        <tr class="contract-tr">
                            <th class="basic_info_th">お客様先</th>
                            <td  colspan="7"  class="conract-name">
                                @if((session()->get('auth_name'))==='sales' || (session()->get('auth_name'))==='admin')
                                    <input name="contract_name" value="{{$detail->contract_name}}"></input>
                                @else
                                    {{$detail->contract_name}}
                                @endif
                            </td>
                        </tr>
                        <tr class="contract-tr">
                            <th>勤務形態</th>
                            <td class="working_form">
                            @if((session()->get('auth_name'))==='sales' || (session()->get('auth_name'))==='admin')
                                <select name="working_form">
                                    <option></option>
                                    <option id="working_form" value="0" {{$detail->working_form === 0 ? 'selected' : ''}}>SES</option>
                                    <option id="working_form" value="1" {{$detail->working_form === 1 ? 'selected' : ''}}>ラボ</option>
                                    <option id="working_form" value="2" {{$detail->working_form === 2 ? 'selected' : ''}}>請負</option>
                                    <option id="working_form" value="3" {{$detail->working_form === 3 ? 'selected' : ''}}>自社</option>
                                </select>
                            @else
                                {{$detail->working_form === 0 ? 'SES' : ''}}
                                {{$detail->working_form === 1 ? 'ラボ' : ''}}
                                {{$detail->working_form === 2 ? '請負' : ''}}
                                {{$detail->working_form === 3 ? '自社' : ''}}
                            @endif
                            </td>
                            <th>契約サイクル</th>
                            <td class="d-flex contract-cycle">
                            @if((session()->get('auth_name'))==='sales' || (session()->get('auth_name'))==='admin')
                                <input name="contract_cycle" value="{{$detail->contract_cycle}}"></input>ヵ月
                            @else
                                {{$detail->contract_cycle}}ヵ月
                            @endif
                            </td>
                            <th>ステータス</th>
                            <td name="contract_status">
                            @if((session()->get('auth_name'))==='sales' || (session()->get('auth_name'))==='admin')
                                <select class="contract_status" name="contract_status">
                                    <option value="0" {{ $detail->contract_status === 0 ? 'selected' : ''}}>継続</option>
                                    <option value="1" {{ $detail->contract_status === 1 ? 'selected' : ''}}>終了</option>
                                </select>
                            @else
                                {{$detail->contract_status === 0 ? '継続' : ''}}
                                {{$detail->contract_status === 1 ? '終了' : ''}}
                            @endif
                            </td>
                        </tr>
                        @if((session()->get('auth_name'))==='sales' || (session()->get('auth_name'))==='admin')
                        <tr class="contract-tr continuation-date">
                            <th class="basic_info_th">継続確定年月日</th>
                            <td  colspan="7" >
                                <div class="d-flex">
                                <select name="continuation_year" class="operable_years mr-1">
                                    <option id="continuation_year" value="{{$detail->continuation_month}}" class="d-none">{{substr($detail->continuation_month, 0, 4)}}</option>
                                </select>年                                                
                                <select name="continuation_month" class="operable_month mx-1">
                                    <option id="continuation_month" value="{{$detail->continuation_month}}" class="d-none">{{substr($detail->continuation_month, 4, 2)}}</option>
                                </select>月
                                </div>
                            </td>
                        </tr>
                        @else
                            @if($detail->contract_status === 0)
                            <tr class="contract-tr">
                                <th class="basic_info_th">継続確定年月日</th>
                                <td colspan="7" class="conract-name">{{substr($detail->continuation_month, 0, 4)}}年{{substr($detail->continuation_month, 4, 2)}}月まで延長確定</td>
                            </tr>
                            @endif
                        @endif
                        @if((session()->get('auth_name'))==='sales' || (session()->get('auth_name'))==='admin')
                        <tr class="contract-tr end-date">
                            <th class="basic_info_th">終了確定年月日</th>
                            <td  colspan="7"  class="conract-name">
                                <div class="d-flex">
                                    <select name="end_year" class="operable_years mr-1">
                                        <option id="end_year" value="{{$detail->end_month}}" class="d-none">{{substr($detail->end_month, 0, 4)}}</option>
                                    </select>年                                                
                                    <select name="end_month" class="operable_month mx-1">
                                        <option id="end_month" value="{{$detail->end_month}}" class="d-none">{{substr($detail->end_month, 4, 2)}}</option>
                                    </select>月
                                </div>
                            </td>
                        </tr>
                        @else
                            @if($detail->contract_status === 1)
                            <tr class="contract-tr">
                                <th class="basic_info_th">終了確定年月日</th>
                                <td colspan="7" class="conract-name">{{substr($detail->end_month, 0, 4)}}年{{substr($detail->end_month, 4, 2)}}月で終了確定</td>
                            </tr>
                            @endif
                        @endif
                        <tr>
                            <th class="basic_info_th">担当営業</th>
                            <td  colspan="7"  class="conract-name">
                                @if((session()->get('auth_name'))==='sales' || (session()->get('auth_name'))==='admin')
                                <select name="sales_person_id">
                                    <option></option>
                                    @foreach($sales as $sale)
                                        <option value="{{$sale->user_id}}" {{$detail->sales_person_id == $sale->user_id ? 'selected' : ''}}>{{$sale->last_name}} {{$sale->first_name}}</option>
                                    @endforeach
                                </select>
                                @else
                                    {{$detail->last_name}} {{$detail->first_name}}
                                @endif
                            </td>
                        </tr>
                    </table>
                @endif
        @endforeach


        @foreach($contract_detail as $detail)
                @if($detail->matter_flg == 1)
                <div>
                    <div class="contract-title">次の案件</div>
                </div>
                <table class="basic_info_skill datail_title_style w-100 mb-4">
                        <tr class="contract-tr">
                            <th class="basic_info_th">お客様先</th>
                            <td  colspan="7"  class="conract-name">
                                @if((session()->get('auth_name'))==='sales' || (session()->get('auth_name'))==='admin')
                                    <input name="next_contract_name" value="{{$detail->contract_name}}" form="update"></input>
                                @else
                                    {{$detail->contract_name}}
                                @endif
                            </td>
                        </tr>
                        <tr class="contract-tr">
                            <th>勤務形態</th>
                            <td class="working_form">
                                @if((session()->get('auth_name'))==='sales' || (session()->get('auth_name'))==='admin')
                                <select name="next_working_form" form="update">
                                    <option></option>
                                    <option id="working_form" value="0" {{$detail->working_form === 0 ? 'selected' : ''}}>SES</option>
                                    <option id="working_form" value="1" {{$detail->working_form === 1 ? 'selected' : ''}}>ラボ</option>
                                    <option id="working_form" value="2" {{$detail->working_form === 2 ? 'selected' : ''}}>請負</option>
                                    <option id="working_form" value="3" {{$detail->working_form === 3 ? 'selected' : ''}}>自社</option>
                                </select>
                                @else
                                    {{$detail->working_form === 0 ? 'SES' : ''}}
                                    {{$detail->working_form === 1 ? 'ラボ' : ''}}
                                    {{$detail->working_form === 2 ? '請負' : ''}}
                                    {{$detail->working_form === 3 ? '自社' : ''}}
                                @endif
                            </td>
                            <th>契約サイクル</th>
                            <td class="contract-cycle">
                                @if((session()->get('auth_name'))==='sales' || (session()->get('auth_name'))==='admin')
                                <input name="next_contract_cycle" value="{{$detail->contract_cycle}}" form="update"></input>ヵ月
                                @else
                                {{$detail->contract_cycle}}ヵ月
                                @endif
                            </td>
                            <th>ステータス</th>
                            <td name="contract_status">
                                @if((session()->get('auth_name'))==='sales' || (session()->get('auth_name'))==='admin')
                                <select class="next_contract_status" name="next_contract_status" form="update">
                                    <option value="0" {{ $detail->contract_status === 0 ? 'selected' : ''}}>継続</option>
                                    <option value="1" {{ $detail->contract_status === 1 ? 'selected' : ''}}>終了</option>
                                </select>
                                @else
                                {{$detail->contract_status === 0 ? '継続' : ''}}
                                {{$detail->contract_status === 1 ? '終了' : ''}}
                                @endif
                            </td>
                        </tr>
                        @if((session()->get('auth_name'))==='sales' || (session()->get('auth_name'))==='admin')
                        <tr class="next-continuation-date contract-tr">
                            <th class="basic_info_th">継続確定年月日</th>
                            <td  colspan="7"  class="conract-name">
                                <div class="d-flex">
                                    <select name="next_continuation_year" class="mr-1" form="update">
                                        <option id="next_continuation_year" value="{{$detail->continuation_month}}" class="d-none">{{substr($detail->continuation_month, 0, 4)}}</option>
                                    </select>年                                                
                                    <select name="next_continuation_month" class="mx-1" form="update">
                                        <option id="next_continuation_month" value="{{$detail->continuation_month}}" class="d-none">{{substr($detail->continuation_month, 4, 2)}}</option>
                                    </select>月
                                </div>
                            </td>
                        </tr>

                        @else
                            @if($detail->contract_status === 0)
                            <tr class="contract-tr">
                                <th class="basic_info_th">継続確定年月日</th>
                                <td colspan="7" class="conract-name">{{substr($detail->continuation_month, 0, 4)}}年{{substr($detail->continuation_month, 4, 2)}}月</td>
                            </tr>
                            @endif
                        @endif
                        @if((session()->get('auth_name'))==='sales' || (session()->get('auth_name'))==='admin')
                        <tr class="next-end-date contract-tr">
                            <th class="basic_info_th">終了確定年月日</th>
                            <td  colspan="7"  class="conract-name">
                                <div class="d-flex">
                                    <select name="next_end_year" class="operable_years mr-1" form="update">
                                        <option id="next_end_year" value="{{$detail->end_month}}" class="d-none">{{substr($detail->end_month, 0, 4)}}</option>
                                    </select>年                                                
                                    <select name="next_end_month" class="operable_month mx-1" form="update">
                                        <option id="next_end_month" value="{{$detail->end_month}}" class="d-none">{{substr($detail->end_month, 4, 2)}}</option>
                                    </select>月
                                </div>
                            </td>
                        </tr>
                        @else
                            @if($detail->contract_status === 1)
                            <tr class="contract-tr">
                                <th class="basic_info_th">終了確定年月日</th>
                                <td colspan="7" class="conract-name">{{substr($detail->end_month, 0, 4)}}年{{substr($detail->end_month, 4, 2)}}月で終了確定</td>
                            </tr>
                            @endif
                        @endif
                        <tr>
                            <th class="basic_info_th">担当営業</th>
                            <td  colspan="7"  class="conract-name">
                                @if((session()->get('auth_name'))==='sales' || (session()->get('auth_name'))==='admin')
                                <select name="next_sales_person_id" form="update">
                                    <option></option>
                                    @foreach($sales as $sale)
                                        <option value="{{$sale->user_id}}" {{$detail->sales_person_id == $sale->user_id ? 'selected' : ''}}>{{$sale->last_name}} {{$sale->first_name}}</option>
                                    @endforeach
                                </select>
                                @else
                                    {{$detail->last_name}} {{$detail->first_name}}
                                @endif
                            </td>
                        </tr>
                    </table>
                @endif
        </form>
        @endforeach
    </div>
        <div>
            <div class="text-right">
                <span>※最大半年分の履歴が表示されます</span>
            </div>
            <div class="contract-title">過去の案件</div>
        </div>
            <table class="basic_info_skill datail_title_style w-100 contract-right mb-4">
    @foreach($contract_detail as $detail)
        @if($detail->matter_flg == 2)
                <tr class="contract-tr">
                    <th class="basic_info_th">お客様先</th>
                    <td  colspan="7"  class="conract-name">{{$detail->contract_name}}</td>
                </tr>
                <tr class="contract-tr">
                    <th>勤務形態</th>
                    <td class="working_form">
                        {{$detail->working_form == 0 ? 'SES' : ''}}
                        {{$detail->working_form == 1 ? 'ラボ' : ''}}
                        {{$detail->working_form == 2 ? '請負' : ''}}
                        {{$detail->working_form == 3 ? '自社' : ''}}
                    </td>
                    <th>契約サイクル</th>
                    <td>{{$detail->contract_cycle}}ヶ月</td>
                    <th>ステータス</th>
                    <td>{{$detail->contract_status == 0 ? '継続' : '終了'}}</td>
                </tr>
                @if($detail->contract_status == 0)
                <tr class="contract-tr">
                    <th class="basic_info_th">継続確定年月日</th>
                    <td  colspan="7"  class="conract-name">{{substr($detail->continuation_month, 0, 4)}}年{{substr($detail->continuation_month, 4, 2)}}月</td>
                </tr>
                @endif
                @if($detail->contract_status == 1)
                <tr class="contract-tr">
                    <th class="basic_info_th">終了確定年月日</th>
                    <td  colspan="7"  class="conract-name">{{substr($detail->end_month, 0, 4)}}年{{substr($detail->end_month, 4, 2)}}月で終了確定</td>
                </tr>
                @endif
                <tr class="contract-tr1">
                    <th class="basic_info_th">担当営業</th>
                    <td  colspan="7"  class="conract-name">{{$detail->last_name}} {{$detail->first_name}}</td>
                </tr>
        @endif
    @endforeach
            </table>
</div>

@endsection