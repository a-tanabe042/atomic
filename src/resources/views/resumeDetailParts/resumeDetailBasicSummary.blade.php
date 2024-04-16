<div class="basic_info_summary_area my-2">
    <form action="{{ route('createDetail.update',  ['PressedEdit' => 'basicSummary','user_id'=>$basic_info_items[0]->user_id]) }}" method="post">
        @csrf
        @method('PATCH')
        @if((session()->get('auth_name'))==='member' || (session()->get('auth_name'))==='manager' || (session()->get('auth_name'))==='admin')
            <div id ="basic_summary_edit_bt_area" class="text-right">
                <button Id="basic_info_summary_bt_e" type="button" class="btn btn--orange"  onclick=editSummaryMode(this)>編集</button>
            </div>
        @endif
        <div id ="basic_summary_cancel_bt_area" class="basic_summary_cancel_bt_area text-right">
            <button Id="basic_info_skill_bt_c" type="submit button" class="btn btn--orange menu_keep_button" onclick="loadingSum()">保存</button>
            <input Id="basic_info_summary_bt_c" type="reset" value="キャンセル" class="btn btn--orange"  onclick=editSummaryMode(this)>
        </div>

        <div class="w-100 h-100 my-2">
            <div class="summary_flex_area">
                <div class="pj_sum">
                    <div class="info_summary_title">
                        プロジェクト数
                    </div>
                    <div class="text-center">
                            <p class="m-0">{{$summary_sum[0] -> pj_sum}}件</p>
                    </div>
                </div>
                <div class="info_summary_work">
                    <div class="info_summary_title w-100">
                        作業経歴
                    </div>
                    <div class="info_summary_work_ex">
                        <table class="w-100" border="1">
                            <thead class="vertical_title work_title sp-none">
                                <tr>
                                    <th>要件定義</th>
                                    <th>基本設計</th>
                                    <th>詳細設計</th>
                                    <th>開発</th>
                                    <th>単体試験</th>
                                    <th>結合試験</th>
                                    <th>総合試験</th>
                                    <th>運用試験</th>
                                    <th>環境構築</th>
                                    <th>運用保守</th>
                                    <th>調査</th>
                                    <th>教育</th>
                                </tr>
                            </thead>
                            <tbody class="sp-none">
                                <tr class="summary_round" > 
                                    <td>
                                        @if($summary_sum[0] -> requirement > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                    <td> 
                                        @if($summary_sum[0] -> basic_design > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>  
                                    <td>
                                        @if($summary_sum[0] -> detail_design > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                    <td> 
                                        @if($summary_sum[0] -> development > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                    <td> 
                                        @if($summary_sum[0] -> unit_test > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                    <td> 
                                        @if($summary_sum[0] -> integration_test > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($summary_sum[0] -> comprehensive_test > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                    <td> 
                                        @if($summary_sum[0] -> operation_test > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                    <td> 
                                        @if($summary_sum[0] -> environment > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                    <td> 
                                        @if($summary_sum[0] -> operation_maintenance > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                    <td> 
                                        @if($summary_sum[0] -> survey > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                    <td> 
                                        @if($summary_sum[0] -> education > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                            <tbody class="sp-block pc-none">
                                <tr class="vertical_title work_title summary_round">
                                    <th>要件定義</th>
                                    <td>
                                        @if($summary_sum[0] -> requirement > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                    <th>総合試験</th>
                                    <td>
                                        @if($summary_sum[0] -> comprehensive_test > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="vertical_title work_title summary_round">
                                    <th>基本設計</th>
                                    <td> 
                                        @if($summary_sum[0] -> basic_design > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                    <th>運用試験</th>
                                    <td> 
                                        @if($summary_sum[0] -> operation_test > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="vertical_title work_title summary_round">
                                    <th>詳細設計</th>
                                    <td>
                                        @if($summary_sum[0] -> detail_design > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                    <th>環境構築</th>
                                    <td> 
                                        @if($summary_sum[0] -> environment > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="vertical_title work_title summary_round">
                                    <th>開発</th>
                                    <td> 
                                        @if($summary_sum[0] -> development > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                    <th>運用保守</th>
                                    <td> 
                                        @if($summary_sum[0] -> operation_maintenance > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="vertical_title work_title summary_round">
                                    <th>単体試験</th>
                                    <td> 
                                        @if($summary_sum[0] -> unit_test > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                    <th>調査</th>
                                    <td> 
                                        @if($summary_sum[0] -> survey > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="vertical_title work_title summary_round">
                                    <th>結合試験</th>
                                    <td> 
                                        @if($summary_sum[0] -> integration_test > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                    <th>教育</th>
                                    <td> 
                                        @if($summary_sum[0] -> education > 0)
                                            <p>〇</p>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="info_summary_mgmt_role">
                    <div class="info_summary_title">管理人数</div>
                        <div class="mx-auto my-1 mgmt-container">
                            <div class="d-flex justify-content-center">
                                <div class="text-right mgmt-2">
                                    <label class="my-0 mx-2">
                                    なし<input type="radio" name="mgmt_input" value="4"  class="mgmt_input mx-2" {{ $basic_info_items[0] -> experience == 4 ? 'checked' : ''}} disabled>
                                    </label>
                                    <label class="my-0 mx-2">
                                        ~5人<input type="radio" name="mgmt_input" value="0" class="mgmt_input mx-2" {{$basic_info_items[0] -> experience === 0 ? 'checked' : '' }} disabled>
                                    </label>
                                    <label class="my-0 mx-2">
                                        5~10人<input type="radio" name="mgmt_input" value="1" class="mgmt_input mx-2" {{ $basic_info_items[0] -> experience == 1 ? 'checked' : ''}} disabled>
                                    </label>
                                </div>
                                <div class="text-right mgmt-3">
                                    <label></label>
                                    <label class="my-0 mx-2">
                                        10~15人<input type="radio" name="mgmt_input" value="2" class="mgmt_input mx-2" {{ $basic_info_items[0] -> experience == 2 ? 'checked' : ''}} disabled>
                                    </label>
                                    <label class="my-0 mx-2">
                                        15人以上<input type="radio" name="mgmt_input" value="3"  class="mgmt_input mx-2" {{ $basic_info_items[0] -> experience == 3 ? 'checked' : ''}} disabled>
                                    </label>
                                </div>
                            </div>
                        </div>
                    <div class="info_summary_title">役割</div>
                        <div class="info_summary_role">
                            <table border="1" class="w-100">
                                <thead class="sp-none">
                                    <tr class="vertical_title">
                                        <th>PM</th>
                                        <th>PMO</th>
                                        <th>PL</th>
                                        <th>SL</th>
                                        <th>SE</th>
                                        <th>PG</th>
                                        <th>TS</th>
                                        <th>PS</th>
                                        <th>OM</th>
                                        <th>HD</th>
                                        <th>その他</th>
                                    </tr>
                                </thead>
                                <tbody class="sp-none">
                                    <tr class="summary_round">
                                        <td>
                                            @if($summary_sum[0] -> pm > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($summary_sum[0] -> pmo > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($summary_sum[0] -> pl > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($summary_sum[0] -> sl > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($summary_sum[0] -> se > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($summary_sum[0] -> pg > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($summary_sum[0] -> ts > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($summary_sum[0] -> ps > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($summary_sum[0] -> om > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($summary_sum[0] -> hd > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($summary_sum[0] -> other > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody class="sp-block pc-none">
                                    <tr class="vertical_title summary_round">
                                        <th>PM</th>
                                        <td>
                                            @if($summary_sum[0] -> pm > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                        <th>TS</th>
                                        <td>
                                            @if($summary_sum[0] -> ts > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="vertical_title summary_round">
                                        <th>PMO</th>
                                        <td>
                                            @if($summary_sum[0] -> pmo > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                        <th>PS</th>
                                        <td>
                                            @if($summary_sum[0] -> ps > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="vertical_title summary_round">
                                        <th>PL</th>
                                        <td>
                                            @if($summary_sum[0] -> pl > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                        <th>OM</th>
                                        <td>
                                            @if($summary_sum[0] -> om > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="vertical_title summary_round">
                                        <th>SL</th>
                                        <td>
                                            @if($summary_sum[0] -> sl > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                        <th>HD</th>
                                        <td>
                                            @if($summary_sum[0] -> hd > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="vertical_title summary_round">
                                        <th>SE</th>
                                        <td>
                                            @if($summary_sum[0] -> se > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                        <th>その他</th>
                                        <td>
                                            @if($summary_sum[0] -> other > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="vertical_title summary_round">
                                        <th>PG</th>
                                        <td>
                                            @if($summary_sum[0] -> pg > 0)
                                                <p>〇</p>
                                            @endif
                                        </td>
                                        <th></th>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>  
</div>  
