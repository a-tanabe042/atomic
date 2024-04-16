<div class="tab_content mb-0 label-style" id="career_request_content">
    <div class="tab_content_detail">
        <form id="condition_self_form" method="post" action="{{ route('createDetail.update',  ['PressedEdit' => 'condition_self','user_id'=> $basic_info_items[0]->user_id]) }}">
            @csrf
            @method("PATCH")
            <div class="condition_self_container mb-3">
                <div class="condition_select_area">
                    <div id="condition_self_bt_edit_area" class="text-right my-2">
                        @if( session()->get('auth_name') != 'sales')
                        <button type="button" class="btn btn--orange edit_change" value="edit_self">編集</button>
                        @endif
                    </div>
                    <div id="condition_self_bt_save_area" class="text-right my-2">
                        <button type="button submit" class="btn btn--orange save_condition menu_keep_button">保存</button>
                        <button type="button" class="btn btn--orange edit_change" value="cancel_self">キャンセル</button>
                    </div>
                    <table class="condition_radio_table w-100" >
                        <tr>
                            <th>優先条件・尚可条件<br>選択</th>
                            <td class="cs">
                                <div class="condition_radio_area d-flex justify-content-center">
                                    <div class="d-flex align-items-center mr-3">
                                        優先条件:
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div>
                                            <input type="radio" name="priority_condition_radio" value="yes" {{ $condition_radio->priority != "yes" ?: "checked" }} disabled><label class="mb-0">あり</label>
                                        </div>
                                        <div>
                                            <input type="radio" name="priority_condition_radio" value="no" {{ $condition_radio->priority != "no" ?: "checked" }} disabled><label class="mb-0">なし</label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="condition_raido_area d-flex justify-content-center">
                                    <div class="d-flex align-items-center mr-3">
                                        尚可条件:
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div>
                                            <input type="radio" name="plus_condition_radio" value="yes" {{ $condition_radio->plus != "yes" ?: "checked" }} disabled><label class="mb-0">あり</label>
                                        </div>
                                        <div>
                                            <input type="radio" name="plus_condition_radio" value="no" {{ $condition_radio->plus != "no" ?: "checked" }} disabled><label class="mb-0">なし</label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="condition_self_area">
                    <table class="condition_self_table w-100 mt-4" >
                        <tr class="priority_condition_row">
                            <th>優先条件</th>
                            <td>
                                <span class="priority_condition_span_1">{!! empty($condition) ? null : nl2br(e($condition->priority_condition_1)) !!}</span>
                                <textarea name="priority_condition_text_1" placeholder="優先条件の1つ目を記入してください&#13;例）開発案件を希望">{{ empty($condition) ? null : $condition->priority_condition_1 }}</textarea>
                            </td>
                            <td>
                                <span class="priority_condition_span_2">{!! empty($condition) ? null : nl2br(e($condition->priority_condition_2)) !!}</span>
                                <textarea name="priority_condition_text_2" placeholder="優先条件の2つ目を記入してください&#13;例）上流工程から関わりたい">{{ empty($condition) ? null : $condition->priority_condition_2 }}</textarea>
                            </td>
                        </tr>
                        <tr class="plus_condition_row">
                            <th>尚可条件</th>
                            <td>
                                <span class="plus_condition_span_1">{!! empty($condition) ? null : nl2br(e($condition->plus_condition_1)) !!}</span>
                                <textarea name="plus_condition_text_1" placeholder="尚可条件の1つ目を記入してください&#13;例）出社時間遅めを希望">{{ empty($condition) ? null : $condition->plus_condition_1 }}</textarea>
                            </td>
                            <td>
                                <span class="plus_condition_span_2">{!! empty($condition) ? null : nl2br(e($condition->plus_condition_2)) !!}</span>
                                <textarea name="plus_condition_text_2" placeholder="尚可条件の2つ目を記入してください&#13;例）チーム開発をしたい、SALTO社員と同じ現場を希望">{{ empty($condition) ? null : $condition->plus_condition_2 }}</textarea>
                            </td>
                        </tr>
                        <tr class="condition_reason_row">
                            <th>条件理由</th>
                            <td colspan="2">
                                <span class="condition_reason_span">{!! empty($condition) ? null : nl2br(e($condition->condition_reason)) !!}</span>
                                <textarea name="condition_reason_text" placeholder="優先条件または尚可条件で希望する理由を記入してください">{{ empty($condition) ? null : $condition->condition_reason }}</textarea>
                            </td>
                        </tr>
                        <tr class="career_path_row">
                            <th rowspan="2">キャリアパス</th>
                            <td colspan="2" class="goal_data">
                                <span class="career_path_goal_span">{!! empty($condition) ? null : nl2br(e($condition->career_path_goal)) !!}</span>
                                <textarea name="career_path_goal_text" class="career_path_goal_text" placeholder="目指すポジションを記入してください">{{ empty($condition) ? null : $condition->career_path_goal }}</textarea>
                            </td>
                        </tr>
                        <tr class="career_path_row">
                            <td colspan="2" class="reason_data">
                                <span class="career_path_reason_span">{!! empty($condition) ? null : nl2br(e($condition->career_path_reason)) !!}</span>
                                <textarea name="career_path_reason_text" class="career_path_reason_text" placeholder="理由を記入してください">{{ empty($condition) ? null : $condition->career_path_reason }}</textarea>
                            </td>
                        </tr>
                        <tr class="remarks_row">
                            <th>特記事項</th>
                            <td colspan="2">
                                <span class="remarks_span">{!! empty($condition) ? null : nl2br(e($condition->remarks)) !!}</span>
                                <textarea name="remarks_text" placeholder="特記事項を記入してください&#13;例）通院のため、毎月第二月曜日は午前休みをいただきます">{{ empty($condition) ? null : $condition->remarks }}</textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
        @if( session()->get('auth_name') == 'sales' || session()->get('auth_name') == 'manager' || session()->get('auth_name') == 'admin' )
            <form id="condition_manager_form" method="post" action="{{ route('createDetail.update',  ['PressedEdit' => 'condition_manager','user_id'=> $basic_info_items[0]->user_id]) }}">
                @csrf
                @method("PATCH")
                <div class="condition_manager_area">
                    <div id="condition_manager_bt_edit_area" class="text-right my-2">
                        @if( session()->get('auth_name') != 'sales')
                            <button type="button" class="btn btn--orange edit_change" value="edit_manager">編集</button>
                        @endif
                    </div>
                    <div id="condition_manager_bt_save_area" class="text-right my-2">
                        <button type="button submit" class="btn btn--orange save_condition menu_keep_button">保存</button>
                        <button type="button" class="btn btn--orange edit_change" value="cancel_manager">キャンセル</button>
                    </div>
                    <table class="condition_manager_table w-100 mb-2" >
                        <tr class="condition_addition_row">
                            <th rowspan="2">条件補足</th>
                            <td>
                                <span class="condition_addition_span_1">{!! empty($condition) ? null : nl2br(e($condition->condition_addition_1)) !!}</span>
                                <textarea name="condition_addition_text_1" placeholder="キャリアパスの補足、会社・部署としての方針などその他の補足事項を記入してください">{{ empty($condition) ? null : $condition->condition_addition_1 }}</textarea>
                                @if(isset($condition) && isset($condition->condition_addition_1))
                                    <label class="login_name_1 justify-content-end mt-2 mb-0" style="display: flex">{{ $condition->condition_editor_1 }}</label>
                                @endif
                            </td>
                        </tr>
                        <tr class="condition_addition_row">
                            <td>
                                <span class="condition_addition_span_2">{!! empty($condition) ? null : nl2br(e($condition->condition_addition_2)) !!}</span>
                                <textarea name="condition_addition_text_2">{{ empty($condition) ? null : $condition->condition_addition_2 }}</textarea>
                                @if(isset($condition) && isset($condition->condition_addition_2))
                                    <label class="login_name_2 justify-content-end mt-2 mb-0" style="display: flex">{{ $condition->condition_editor_2 }}</label>
                                @endif
                            </td>
                        </tr>
                        <tr class="transmission_row">
                            <th>申し送り事項</th>
                            <td>
                                <span class="transmission_span">{!! empty($condition) ? null : nl2br(e($condition->transmission)) !!}</span>
                                <textarea name="transmission_text" placeholder="本人の特徴、PJ予定などその他連携しておかなければならないことがあれば記入してください">{{ empty($condition) ? null : $condition->transmission }}</textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        @endif
    </div>
</div>