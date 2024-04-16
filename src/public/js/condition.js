/* 案件希望入力タブ */

// .priority_condition_row span,
// .plus_condition_row span,
// .remarks_row span,
// .condition_addition_row span,
// .transmission_row span {
//     display: block;
//     width: 100%;
//     height: 55px;
// }
// .condition_reason_row span,
// .career_path_row span {
//     display: block;
//     width: 100%;
//     height: 125px;
// }
// .career_path_goal_span,
// .career_path_goal_text {
//     height: 55px !important;
// }

// $(".priority_condition_row span")
// $(".plus_condition_row span")
// $(".career_path_goal_span")
// $(".remarks_span")
// $(".condition_addition_row span")
// $(".transmission_row span")

// $(".condition_reason_span")
// $(".career_path_reason_span")
// console.log($(".priority_condition_row span").height());
// console.log($(".plus_condition_row span").height());
// console.log($(".condition_reason_span").height());
// console.log($(".career_path_goal_span").height());
// console.log($(".career_path_reason_span").height());
// console.log($(".remarks_span").height());
// console.log($(".condition_addition_row span").height());
// console.log($(".transmission_row span").height());

/* 編集ボタン制御 */
//radio 一時保存
let temp_radio = [];
// let temp_self = [];
let temp_manager = [];
let temp_self_textarea = [];
let temp_self_span = [];

//活性化させる関数
$(".edit_change").on("click", function(){
    let button_val = this.value;
    //最新の radio を参照
    let radio = $(".condition_radio_table").find("input");
    let self_span = $(".condition_self_table").find("span");
    let self_textarea = $(".condition_self_table").find("textarea");
    let manager_span = $(".condition_manager_table").find("span");
    let manager_textarea = $(".condition_manager_table").find("textarea");

    switch(button_val){
        //自分自身が見れる個所の編集
        case "edit_self":
            //キャンセル時のセル値削除のため、radio 一時保存
            $.each(radio, function(i, val){
                temp_radio[i] = val.checked;
            });

            //キャンセル時のセル値削除のため、textarea 一時保存
            $.each(self_textarea, function(i, val){
                temp_self_textarea[i] = val.value;
            });

            //キャンセル時のセル値削除のため、span 一時保存
            $.each(self_span, function(i, val){
                temp_self_span[i] = val.innerHTML;
            });

            //radioボタンvalue取得のため
            let form = document.forms.condition_self_form;
            let priority_radio =  form.priority_condition_radio.value;
            let plus_radio =  form.plus_condition_radio.value;

            //radioボタン選択値による活性化
            radio.prop("disabled", false);
            if(priority_radio == "yes"){
                $(".priority_condition_span_1").css("display", "none");
                $(".priority_condition_span_2").css("display", "none");
                $(".condition_reason_span").css("display", "none");
                $("textarea[name='priority_condition_text_1']").css("display", "block");
                $("textarea[name='priority_condition_text_2']").css("display", "block");
                $("textarea[name='condition_reason_text']").css("display", "block");
            }
            if(plus_radio == "yes"){
                $(".plus_condition_span_1").css("display", "none");
                $(".plus_condition_span_2").css("display", "none");
                $(".condition_reason_span").css("display", "none");
                $("textarea[name='plus_condition_text_1']").css("display", "block");
                $("textarea[name='plus_condition_text_2']").css("display", "block");
                $("textarea[name='condition_reason_text']").css("display", "block");
            }

            //キャリアパス以降活性化
            $(".career_path_goal_span").css("display", "none");
            $(".career_path_reason_span").css("display", "none");
            $(".remarks_span").css("display", "none");
            $("textarea[name='career_path_goal_text']").css("display", "block");
            $("textarea[name='career_path_reason_text']").css("display", "block");
            $("textarea[name='remarks_text']").css("display", "block");

            //優先条件＆理由の活性化
            $("input[name='priority_condition_radio']").click(function () {
                if($("input[name='priority_condition_radio']").prop('checked')){
                    $(".priority_condition_span_1").css("display", "none");
                    $(".priority_condition_span_2").css("display", "none");
                    $(".condition_reason_span").css("display", "none");

                    $("textarea[name='priority_condition_text_1']").css("display", "block");
                    $("textarea[name='priority_condition_text_2']").css("display", "block");
                    $("textarea[name='condition_reason_text']").css("display", "block");
                }else {
                    $(".priority_condition_span_1").css("display", "block");
                    $(".priority_condition_span_2").css("display", "block");
                    $("textarea[name='priority_condition_text_1']").css("display", "none");
                    $("textarea[name='priority_condition_text_2']").css("display", "none");

                    //”なし” 選択時、入力した内容を保持するため
                    $(".priority_condition_span_1").get(0).innerHTML = $("textarea[name='priority_condition_text_1']").val();
                    $(".priority_condition_span_2").get(0).innerHTML = $("textarea[name='priority_condition_text_2']").val();
                    $(".condition_reason_span").get(0).innerHTML = $("textarea[name='condition_reason_text']").val();

                    if(!$("input[name='plus_condition_radio']").prop('checked')){
                        $(".condition_reason_span").css("display", "block");
                        $("textarea[name='condition_reason_text']").css("display", "none");
                    }
                }
            });

            //尚可条件＆理由の活性化
            $("input[name='plus_condition_radio']").click(function () {
                if($("input[name='plus_condition_radio']").prop('checked')){
                    $(".plus_condition_span_1").css("display", "none");
                    $(".plus_condition_span_2").css("display", "none");
                    $(".condition_reason_span").css("display", "none");

                    $("textarea[name='plus_condition_text_1']").css("display", "block");
                    $("textarea[name='plus_condition_text_2']").css("display", "block");
                    $("textarea[name='condition_reason_text']").css("display", "block");
                }else {
                    $(".plus_condition_span_1").css("display", "block");
                    $(".plus_condition_span_2").css("display", "block");
                    $("textarea[name='plus_condition_text_1']").css("display", "none");
                    $("textarea[name='plus_condition_text_2']").css("display", "none");

                    //”なし” 選択時、入力した内容を保持するため
                    $(".plus_condition_span_1").get(0).innerHTML = $("textarea[name='plus_condition_text_1']").val();
                    $(".plus_condition_span_2").get(0).innerHTML = $("textarea[name='plus_condition_text_2']").val();
                    $(".condition_reason_span").get(0).innerHTML = $("textarea[name='condition_reason_text']").val();

                    if(!$("input[name='priority_condition_radio']").prop('checked')){
                        $(".condition_reason_span").css("display", "block");
                        $("textarea[name='condition_reason_text']").css("display", "none");
                    }
                }
            });

            //保存ボタン、キャンセルボタン可視化
            $("#condition_self_bt_edit_area").css("display", "none");
            $("#condition_self_bt_save_area").css("display", "block");
            break;

        case "cancel_self":
            //キャンセル時、radio 元に戻し
            $.each(radio, function(i, val){
                if(val.checked != temp_radio[i]){
                    val.checked = temp_radio[i];
                }
            });
            
            //キャンセル時、textarea 元に戻し
            $.each(self_textarea, function(i, val){
                if(val.value != temp_self_textarea[i]){
                    val.value = temp_self_textarea[i];
                }
            });

            //radio選択後、キャンセル元に戻し
            $.each(self_span, function(i, val){
                if(val.innerHTML != temp_self_span[i]){
                    val.innerHTML = temp_self_span[i];
                }
            });

            //活性化制御
            radio.prop("disabled", true);
            self_span.css("display", "block");
            self_textarea.css("display", "none");
            
            //保存ボタン、キャンセルボタン可視化
            $("#condition_self_bt_edit_area").css("display", "block");
            $("#condition_self_bt_save_area").css("display", "none");
            break;

        //役職者が見れる個所の編集
        case "edit_manager":
            //キャンセル時のセル値削除のため、textarea 一時保存
            $.each(manager_textarea, function(i, val){
                temp_manager[i] = val.value;
            });

            //活性化制御
            manager_span.css("display", "none");
            manager_textarea.css("display", "block");

            //条件補足の入力者非表示
            $(".login_name_1").css("display", "none");
            $(".login_name_2").css("display", "none");

            $("#condition_manager_bt_edit_area").css("display", "none");
            $("#condition_manager_bt_save_area").css("display", "block");
            break;

        case "cancel_manager":

            //キャンセル時、textarea 元に戻し
            $.each(manager_textarea, function(i, val){
                if(val.value != temp_manager[i]){
                    val.value = temp_manager[i];
                }
            });

            //活性化制御
            manager_span.css("display", "block");
            manager_textarea.css("display", "none");

            //条件補足の入力者表示
            $(".login_name_1").css("display", "flex");
            $(".login_name_2").css("display", "flex");

            $("#condition_manager_bt_edit_area").css("display", "block");
            $("#condition_manager_bt_save_area").css("display", "none");
            break;
    }
});

//保存ボタン押下時、ローディング
$(".save_condition").on("click", function(){
    resumeLoadingFunc();
    setConditionTabCookie();
});

//タブ保持
function setConditionTabCookie(){
	let m = 3;
	document.cookie = "tab_flg=condition" + ";max-age=" + m;
}

//ローディング関数
function resumeLoadingFunc(){
	$(function() {
		var h = $(window).height();	
		$('#loader-bg ,#loader').height(h).css('display','block');
		window.onpageshow = function(e) {
			if( e.persisted == true ) {
				$('#loader-bg ,#loader').height(h).css('display','none');
				location.reload();
			}
		}
	});
};