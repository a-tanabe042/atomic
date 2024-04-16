/* ハンバーガーメニュー */
$(function() {
  $('.hamburger').click(function() {
    hamburgerFunc(this);
  });
});

//ハンバーガーメニュー起動
function hamburgerFunc(element){
  $(element).toggleClass('active');

  if ($(element).hasClass('active')) {
      $('.globalMenuSp').addClass('active');
  } else {
      $('.globalMenuSp').removeClass('active');
  }
}

/* ユーザー追加モーダル */
//パスワード欄表示・非表示切り替え
function myfunc(value) {
var check1 = document.getElementById("Checkbox1").checked;
  var hidden1 = document.getElementById("hidden1");
  if(check1 == true){
     hidden1.style.display ="flex";
     }
  else{
    hidden1.style.display ="none";
  }
}

//ゲスト登録時のパスワード自動生成
gencount = 0;
function gen() {
  var password = document.getElementById('password');
  password.value = "";
  gencount = ++gencount;

  var password_len = 16
  var letters = 'abcdefghijklmnopqrstuvwxyz';

  for (var i = 0; i < password_len; i++) {
    if (i == 3 || i == 6 || i == 8 || i == 13) {
      password.value += Math.floor( Math.random() * 10 );
    } else {
      password.value += letters.charAt(Math.floor(Math.random() * letters.length));
    }
  }
}

//フォームリセット
function formReset(form) {

    //ユーザー追加モーダル
    if(form == "userAdd"){
      var formElement = document.getElementById('userAdd')
      formElement.reset();
      $(".alertarea").each(function(){
        $(".alertarea").empty();
      })
      $("input").each(function(){
        $("input").css("border", "1px solid #c3c3c3");
      })
    //カレンダーのメンバー選択モーダル
    }else if(form == "memberReset"){
      var formElement = document.getElementById('memberSelect')
      formElement.reset();
    }else if(form == "resumeReset"){
      var formElement = document.getElementById('new-resume')
      formElement.reset();
    }
};

/* ユーザー削除モーダル */
 function deletemessage(){
  alert("このユーザーを削除しますか？");
}

//ログイン情報のバリデーションチェック
  //必須
  var require = document.getElementsByClassName('require');
  for (var i=0 ; i<require.length ; i++) {
    // ▼文字が入力されたタイミングでチェックする：
    require[i].oninput = function () {
      var alertelement = this.parentNode.getElementsByClassName('alertarea');
      if( this.value != ''){
        if( alertelement[0] ) { alertelement[0].innerHTML = ""; }
          this.style.border = "1px solid black";
      } else {
        if( alertelement[0] ) {
           alertelement[0].innerHTML = '必須項目です'; }
          this.style.border = "2px solid red";
      }
    }
  }

  //カタカナ
  var kana = document.getElementsByClassName('kana');
  for (var i=0 ; i<kana.length ; i++) {
    // ▼文字が入力されたタイミングでチェックする：
    kana[i].oninput = function () {
      var alertelement = this.parentNode.getElementsByClassName('alertarea');
      if(this.value != ''){
        if ( this.value.match( /[^ァ-ヶー\s]/ )) {
        // ▼何か入力があって、指定以外の文字があれば
          if( alertelement[0] ) {alertelement[0].innerHTML = 'カタカナのみで入力して下さい。';}
          this.style.border = "2px solid red";
        }else{
          if( alertelement[0] ) {alertelement[0].innerHTML = "";}
          this.style.border = "1px solid black";
        }
      }
      else {
        // ▼何も入力がないなら
        if( alertelement[0] ) {
          alertelement[0].innerHTML = '必須項目です。';
        }
        this.style.border = "2px solid red";
      }
    }
  }

  //メールアドレス
  var mail = document.getElementsByClassName('mail');
  for (var i=0 ; i<mail.length ; i++) {
    // ▼文字が入力されたタイミングでチェックする：
    mail[i].oninput = function () {
      var alertelement = this.parentNode.getElementsByClassName('alertarea');
      if( this.value != ''){
        if( this.value.match( /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/ )){
          if( alertelement[0] ) { alertelement[0].innerHTML = ""; }
          this.style.border = "1px solid black";
        }else{
          if( alertelement[0] ) { alertelement[0].innerHTML = '有効なメールアドレスを指定してください。'; }
          this.style.border = "2px solid red";
        }
      } else {
        if( alertelement[0] ) { alertelement[0].innerHTML = '必須項目です。'; }
        this.style.border = "2px solid red";
      }
    }
  }

  //イニシャル
  var initial = document.getElementsByClassName('initial');
  for (var i=0 ; i<initial.length ; i++) {
    // ▼文字が入力されたタイミングでチェックする：
    initial[i].oninput = function () {
      var alertelement = this.parentNode.getElementsByClassName('alertarea');
      if( this.value != ''){
        if( this.value.match( /[A-Z]{1}\.[A-Z]{1}/ )){
          if( alertelement[0] ) { alertelement[0].innerHTML = ""; }
          this.style.border = "1px solid black";
        }else{
          if( alertelement[0] ) { alertelement[0].innerHTML = '正しい形式で入力してください。'; }
          this.style.border = "2px solid red";
        }
      } else {
        if( alertelement[0] ) { alertelement[0].innerHTML = '必須項目です。'; }
        this.style.border = "2px solid red";
      }
    }
  }

//パスワード
var count = 0;
$(function(){
  /** 追加されるボタンにイベントを追加 */
  $(document).on('change', '#Checkbox1', function(){
    var userpassword = document.getElementsByClassName('userpassword');
    count = count + 1;
  for (var i=0 ; i<userpassword.length ; i++) {
    var check1 = document.getElementById("Checkbox1").checked;
    if(check1 == true){

    // ▼文字が入力されたタイミングでチェックする：
    userpassword[i].oninput = function () {
      var alertelement = this.parentNode.getElementsByClassName('alertarea');
      //空じゃない時
      if( this.value != ''){
        //マッチしているとき
        if( this.value.match( /^(?=.*[0-9])[a-zA-Z0-9\d]{8,16}$/i )){
          if( alertelement[0] ) { alertelement[0].innerHTML = ""; }
          this.style.border = "1px solid black";
        //マッチしてない時
        }else{
          if( alertelement[0] ) { alertelement[0].innerHTML = "8～16文字・半角英数字で入力してください。"; }
          this.style.border = "1px solid black";
        }
        //空の時
      } else {
        if( alertelement[0] ) { alertelement[0].innerHTML = '必須項目です。'; }
        this.style.border = "2px solid red";
      }
    }
  }else{
    var alertelement = document.getElementById('password-alert');
    alertelement.innerHTML = "";
   }
  }
  });
});


//ログイン情報登録(送信)時のチェック
document.addEventListener('DOMContentLoaded', function() {
  var targets = document.getElementsByClassName('checkform');
  for (var i=0 ; i<targets.length ; i++) {

    // ▼送信直前で全項目を再度チェックしてエラーを数える：
    targets[i].onsubmit = function () {
      var inputelements = this.querySelectorAll('input,textarea');  // フォームの中にあるinput要素とtextarea要素をすべて得る
      var alerts = this.getElementsByClassName('alertarea');
      var ret = 0;
      for (var j=0 ; j<inputelements.length ; j++) {
        if( inputelements[j].oninput ) {
          // oninputイベントが定義されている場合にだけ実行する
          inputelements[j].oninput();
        }
      }

      for (var j=0 ; j<alerts.length ; j++) {
        if( alerts[j].innerHTML.length > 0 ) {
          // アラートが表示されていればカウント
          ret++;
        }
      }
      if( ret == 0 ) {
        // エラーメッセージが1つもなければ送信を許可
        loadingFunc();
        return true;
      }
      else {
        if((count%2 == 0)&&(count > 0)&&(ret == 1)){
          loadingFunc();
          return true;
        }else if((count%2 == 0)&&(count > 0)&&(ret > 1)&&(gencount > 0)){
          alert( ret + "個のエラーがあります。");
          return false;
        }else if((count%2 == 0)&&(count > 0)&&(ret > 1)){
          ret--;
          alert( ret + "個のエラーがあります。");
          return false;
        }else{
          // エラーメッセージが1つ以上あれば、アラートを表示して送信をブロック。
          alert( ret + "個のエラーがあります。");
          return false;
        }

      }

    }
  }
});


function requireCheck(){
  //ユーザ情報編集時のカタカナチェック
  var require = document.getElementsByClassName('require');
  for (var i=0 ; i<require.length ; i++) {
    // ▼文字が入力されたタイミングでチェックする：
    require[i].oninput = function () {
      var alertelement = this.parentNode.getElementsByClassName('alertarea');
      if( this.value != ''){
        if( alertelement[0] ) { alertelement[0].innerHTML = ""; }
          this.style.border = "1px solid black";
          $(submitbtn).prop('disabled', false);
      } else {
        if( alertelement[0] ) {
           alertelement[0].innerHTML = '必須項目です'; }
          this.style.border = "2px solid red";
          $(submitbtn).prop('disabled', true);
      }
    }
  }
}

function kanaCheck(){
  //ユーザ情報編集時のカタカナチェック
  var kana = document.getElementsByClassName('kana');
  for (var i=0 ; i<kana.length ; i++) {
    // ▼文字が入力されたタイミングでチェックする：
    kana[i].oninput = function () {
      var alertelement = this.parentNode.getElementsByClassName('alertarea');
      if(this.value != ''){
        if ( this.value.match( /[^ァ-ヶー\s]/ )) {
        // ▼何か入力があって、指定以外の文字があれば
          if( alertelement[0] ) {alertelement[0].innerHTML = 'カタカナのみで入力して下さい。';}
          this.style.border = "2px solid red";
          $(submitbtn).prop('disabled', true);
        }else{
          if( alertelement[0] ) {alertelement[0].innerHTML = "";}
          this.style.border = "1px solid black";
          $(submitbtn).prop('disabled', false);
        }
      }
      else {
        // ▼何も入力がないなら
        if( alertelement[0] ) {
          alertelement[0].innerHTML = '必須項目です。';
        }
        this.style.border = "2px solid red";
        $(submitbtn).prop('disabled', true);
      }


    }
  }

}


function mailCheck(){
  //ユーザ情報編集時のカタカナチェック
  var mail = document.getElementsByClassName('mail');
  for (var i=0 ; i<mail.length ; i++) {
    // ▼文字が入力されたタイミングでチェックする：
    mail[i].oninput = function () {
      var alertelement = this.parentNode.getElementsByClassName('alertarea');
      if( this.value != ''){
        if( this.value.match( /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/ )){
          if( alertelement[0] ) { alertelement[0].innerHTML = ""; }
          this.style.border = "1px solid black";
          $(submitbtn).prop('disabled', false);
        }else{
          if( alertelement[0] ) { alertelement[0].innerHTML = '有効なメールアドレスを指定してください。'; }
          this.style.border = "2px solid red";
          $(submitbtn).prop('disabled', true);
        }
      } else {
        if( alertelement[0] ) { alertelement[0].innerHTML = '必須項目です。'; }
        this.style.border = "2px solid red";
        $(submitbtn).prop('disabled', true);
      }
    }
  }

}


function initialCheck(){
  //ユーザ情報編集時のカタカナチェック
  var initial = document.getElementsByClassName('initial');
  for (var i=0 ; i<initial.length ; i++) {
    // ▼文字が入力されたタイミングでチェックする：
    initial[i].oninput = function () {
      var alertelement = this.parentNode.getElementsByClassName('alertarea');
      if( this.value != ''){
        if( this.value.match( /[A-Z]{1}\.[A-Z]{1}/ )){
          if( alertelement[0] ) { alertelement[0].innerHTML = ""; }
          this.style.border = "1px solid black";
        }else{
          if( alertelement[0] ) { alertelement[0].innerHTML = '正しい形式で入力してください。'; }
          this.style.border = "2px solid red";
        }
      } else {
        if( alertelement[0] ) { alertelement[0].innerHTML = '必須項目です。'; }
        this.style.border = "2px solid red";
      }
    }
  }

}

var count = 0;
function passCheck(){
  $(document).on('change', '#Checkbox1', function(){
    var userpassword = document.getElementsByClassName('userpassword');
    count = count + 1;
  for (var i=0 ; i<userpassword.length ; i++) {
    var check1 = document.getElementById("Checkbox1").checked;
    if(check1 == true){

    // ▼文字が入力されたタイミングでチェックする：
    userpassword[i].oninput = function () {
      var alertelement = this.parentNode.getElementsByClassName('alertarea');
      //空じゃない時
      if( this.value != ''){
        //マッチしているとき
        if( this.value.match( /^(?=.*[0-9])[a-zA-Z0-9\d]{8,16}$/i )){
          if( alertelement[0] ) { alertelement[0].innerHTML = ""; }
          this.style.border = "1px solid black";
        //マッチしてない時
        }else{
          if( alertelement[0] ) { alertelement[0].innerHTML = "8～16文字・半角英数字で入力してください。"; }
          this.style.border = "1px solid black";
        }
        //空の時
      } else {
        if( alertelement[0] ) { alertelement[0].innerHTML = '必須項目です。'; }
        this.style.border = "2px solid red";
      }
    }
  }else{
    var alertelement = document.getElementById('password-alert');
    alertelement.innerHTML = "";
   }
  }
  });
}




/* ユーザー編集キャンセルアラート */
function userupdate_cancel(e){
  if(!window.confirm('本当にキャンセルしますか？編集した内容は保存されません。')){
     return false;
  }
  onclick="location.href='<?php echo $URL; ?>'"
  document.deleteform.submit();
};

/* 削除アラート */
function delete_alert(e){
  if(!window.confirm('本当に削除しますか？')){
     return false;
  }

  if(document.getElementById("del-user") != null) {
    loadingFunc();
    document.getElementById("del-user").submit();
  } else if(document.getElementById("del-skill") != null) {
    loadingFunc();
    document.getElementById("del-skill").submit();
  } else if(document.getElementById("del-belong") != null) {
    loadingFunc();
    document.getElementById("del-belong").submit();
  }
};

/* スキルマスタ編集 */
function update(ele){

  //押下した編集ボタンのクラス名取得とクラス名の末尾を取得
  var num = ele.classList[1]
  var trNo = num.replace(/[^0-9]/g, '')
  var update = document.getElementsByClassName("tr-add-"+trNo);
  var hidden = document.getElementsByClassName("tr-list-"+trNo);
    hidden[0].style.display ="none";
    update[0].style.display ="table-row";
}
function updatecancel(ele){
  //押下した編集ボタンのクラス名取得とクラス名の末尾を取得
  var num = ele.classList[1]
  var trNo = num.replace(/[^0-9]/g, '')
  var update = document.getElementsByClassName("tr-add-"+trNo);
  var hidden = document.getElementsByClassName("tr-list-"+trNo);
    hidden[0].style.display ="table-row";
    update[0].style.display ="none";
}

function update_alert(e){
  if(!window.confirm('更新しますか？')){
     return false;
  }
  document.deleteform.submit();
};

//ログイン画面の window 縦幅取得
function screen_size_get() {
  var height = window.innerHeight;
  var login_screen = document.getElementById("login-screen");
  login_screen.style.height = height + 'px';
}

//ローディング関数
function loadingFunc(){
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

$(function(){
	$("#contractList").click(function() {

    $(".edit-contract").each(function(){
      $(".edit-contract").css("display", "block");
    })
    $(".contract").each(function(){
      $(".contract").css("display", "none");
    })
  })
});

$(function(){
	$("#contractCancel").click(function() {

    $(".edit-contract").each(function(){
      $(".edit-contract").css("display", "none");
    })
    $(".contract").each(function(){
      $(".contract").css("display", "block");
    })
  })
});




/* 契約管理・延長情報管理詳細　延長・終了確定年月日取得 */
$(function(){

	let continuationYear = document.getElementById('continuation_year');
	let continuationMonth = document.getElementById('continuation_month');
	let endYear = document.getElementById('end_year');
	let endMonth = document.getElementById('end_month');
	let nextContinuationYear = document.getElementById('next_continuation_year');
	let nextContinuationMonth = document.getElementById('next_continuation_month');
	let nextEndYear = document.getElementById('next_end_year');
	let nextEndMonth = document.getElementById('next_end_month');

  //現在の年を取得
	var currentTime = new Date();
	var year = currentTime.getFullYear()

	//月の配列
	let Month = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']

  //年数
  for(let i = 0; i <= 2; i++) {
      var futureYear = year +i
        createOptionToElements(continuationYear, futureYear);
        createOptionToElements(endYear, futureYear);
        createOptionToElements(nextContinuationYear, futureYear);
        createOptionToElements(nextEndYear, futureYear);
  }

  //月の生成
	for(let i = 0; i < 12; i++) {
			createOptionFormElements(continuationMonth, Month[i]);
			createOptionFormElements(endMonth, Month[i]);
			createOptionFormElements(nextContinuationMonth, Month[i]);
			createOptionFormElements(nextEndMonth, Month[i]);
	}

});

//fromのoption追加
var createOptionFormElements = function(fromElem, val) {
	let option = document.createElement('option');
	option.text = val;
	option.value = val;
	if(fromElem != null){
		if(fromElem.value == option.value){
			option.selected = true
		}
		fromElem.parentNode.appendChild(option);
	}
}
var createOptionToElements = function(toElem, val) {
	let option = document.createElement('option');
	option.text = val;
	option.value = val;
	if(toElem != null){
		if(toElem.value == option.value){
			option.selected = true
		}
		toElem.parentNode.appendChild(option);
	}
}



/* 延長/終了確定年月日の表示切替 */
$(function() {

  let contractStatus = document.getElementsByClassName('contract_status');
  var val = $(contractStatus).val();
  if(val == 0){
    $(".continuation-date").css("display", "table-row");
    $(".end-date").css("display", "none");
  }else if(val == 1){
    $(".end-date").css("display", "table-row");
    $(".continuation-date").css("display", "none");
  }
  let nextContractStatus = document.getElementsByClassName('next_contract_status');
  var val = $(nextContractStatus).val();
  if(val == 0){
    $(".next-continuation-date").css("display", "table-row");
    $(".next-end-date").css("display", "none");
  }else if(val == 1){
    $(".next-end-date").css("display", "table-row");
    $(".next-continuation-date").css("display", "none");
  }

  //今の案件
  $('.contract_status').change(function() {

    let contractStatus = document.getElementsByClassName('contract_status');
    var val = $(contractStatus).val();
    if(val == 0){
      $(".continuation-date").css("display", "table-row");
      $(".end-date").css("display", "none");
    }else if(val == 1){
      $(".end-date").css("display", "table-row");
      $(".continuation-date").css("display", "none");
    }
  });

  //次の案件
  $('.next_contract_status').change(function() {

    let nextContractStatus = document.getElementsByClassName('next_contract_status');
    var val = $(nextContractStatus).val();
    if(val == 0){
      $(".next-continuation-date").css("display", "table-row");
      $(".next-end-date").css("display", "none");
    }else if(val == 1){
      $(".next-end-date").css("display", "table-row");
      $(".next-continuation-date").css("display", "none");
    }
  });
});

//更新通知処理（Slack）
$('#contract-slack').click(function () {
    alert("更新通知を送信しますか？");
});

/* 絞り込み機能 */

//ホバー処理
$(function (){
  $(".add_dev").hover(
    function(){
      if(!$("#dev_flg").prop("checked")){
        $(this).css("background-color", "#3e3838");
        $(this).css("color", "#fff");
      }
    },
    function(){
      if(!$("#dev_flg").prop("checked")){
        $(this).css("background-color", "#fff");
        $(this).css("color", "#3e3838");
      }
    }
  )
  $(".add_infra").hover(
    function(){
      if(!$("#infra_flg").prop("checked")){
        $(this).css("background-color", "#3e3838");
        $(this).css("color", "#fff");
      }
    },
    function(){
      if(!$("#infra_flg").prop("checked")){
        $(this).css("background-color", "#fff");
        $(this).css("color", "#3e3838");
      }
    }
  )
});

//画面訪問時、選択状態表示
if($("#dev_flg").prop("checked")){
  $(".add_dev").css("background-color", "#3e3838");
  $(".add_dev").css("color", "#fff");
  $(".add_dev .check_mark").css("display", "inline");
}else{
  $(".add_dev").css("background-color", "#fff");
  $(".add_dev").css("color", "#3e3838");
  $(".add_dev .check_mark").css("display", "none");
}

if($("#infra_flg").prop("checked")){
  $(".add_infra").css("background-color", "#3e3838");
  $(".add_infra").css("color", "#fff");
  $(".add_infra .check_mark").css("display", "inline");
}else{
  $(".add_infra").css("background-color", "#fff");
  $(".add_infra").css("color", "#3e3838");
  $(".add_infra .check_mark").css("display", "none");
}

//選択状態操作
$("#dev_flg").on("click", function(){
  if($("#dev_flg").prop("checked")){
    $(".add_dev").css("background-color", "#3e3838");
    $(".add_dev").css("color", "#fff");
    $(".add_dev .check_mark").css("display", "inline");
  }else{
    $(".add_dev").css("background-color", "#fff");
    $(".add_dev").css("color", "#3e3838");
    $(".add_dev .check_mark").css("display", "none");
  }
})

$("#infra_flg").on("click", function(){
  if($("#infra_flg").prop("checked")){
    $(".add_infra").css("background-color", "#3e3838");
    $(".add_infra").css("color", "#fff");
    $(".add_infra .check_mark").css("display", "inline");
  }else{
    $(".add_infra").css("background-color", "#fff");
    $(".add_infra").css("color", "#3e3838");
    $(".add_infra .check_mark").css("display", "none");
  }
})

//メニュー開閉
$('.hamburger_pc').on('click',function(){
  // hamburgerFunc(this);
  $(this).toggleClass('active');
  if($('#left_menu_area').hasClass('off')){
    $('#left_menu_area').removeClass('off');
    $('#left_menu_area').animate({'marginLeft':'0px'},200).addClass('on');
    $(".left-menu").css("display", "block");
    $(this).animate({'marginLeft':'0px'},200);
    $(".list-main").animate({'marginLeft':'450px'},200);
    $(".list-main").width("67%");
  }else {
    $('#left_menu_area').addClass('off');
    $('#left_menu_area').animate({'marginLeft':'-350px'},200);
    $(".left-menu").css("display", "none");
    $(this).animate({'marginLeft':'-350px'},200);
    $(".list-main").animate({'marginLeft':'150px'},200);
    $(".list-main").width("85%");
  }
});

//メニュー開閉　保持ver
$('.hamburger_keep_pc').on('click',function(){
  // hamburgerFunc(this);
  $(this).toggleClass('active');
  if($('#left_menu_keep_area').hasClass('off')){
    $('#left_menu_keep_area').removeClass('off');
    $('#left_menu_keep_area').animate({'marginLeft':'350px'},200).addClass('on');
    $(".left-menu_keep").css("display", "block");
    $(this).animate({'marginLeft':'350px'},200);
    $(".list-main_keep").animate({'marginLeft':'420px'},200);
    $(".list-main_keep").width("68%");
  }else {
    $('#left_menu_keep_area').addClass('off');
    $('#left_menu_keep_area').animate({'marginLeft':'0px'},200);
    $(".left-menu_keep").css("display", "none");
    $(this).animate({'marginLeft':'0px'},200);
    $(".list-main_keep").animate({'marginLeft':'150px'},200);
    $(".list-main_keep").width("85%");
  }
});

//メニュー開閉保持
$(".menu_keep_button").on("click", function(){
	if($('#left_menu_area').hasClass('off') || $('#left_menu_keep_area').hasClass('off')){
    let sec = 3;
    document.cookie = "menu_keep=off" + ";max-age=" + sec + ";path=/"
	}
})

//メニュー状態削除
$(".menu-delete").on("click", function(){
	if(!($('#left_menu_area').hasClass('off') || $('#left_menu_keep_area').hasClass('off'))){
    document.cookie = "menu_keep=" + ";max-age=0;path=/"
	}
})

//リストURL 保持
$(".list_url_set").on("click", function(){
  let sec = 60 * 60 * 2;
  document.cookie = "list_referer=" + location.href + ";max-age=" + sec;
})

//リストURL 取得
$(".list_url_get").on("click", function(){
  let cookies = document.cookie.split(";");
  for(let i = 0; i < cookies.length; i++){
    let cookie = cookies[i].split("?");
    let url = cookie[0].split("=");

    gen_url(url[1], cookie[1], "resume-list");
    gen_url(url[1], cookie[1], "contract-list");
  }
})

//リストURL 生成
function gen_url(url, param, match_str){
  if(url.indexOf(match_str) != -1 && param != undefined){
    location = url + "?" + param;
  }else if(url.indexOf(match_str) != -1 && param == undefined){
    location = url;
  }
}

function back_page(){
  location.href = document.referrer;
}

/* カレンダー招待 */
//メンバー選択非同期
$(function() {
    $('#invite-member').on('click', function() {

      $(".invited_member").each(function(e,v){
        $(".invited_member").remove();
      })

      // チェックがついているかどうかの判定
      var count = 0;
      //ついている人はidと名前を取得
      $(".invite_member").each(function(e,v){
        var checked = v.checked;

        if(checked == true ){
          count++;
          $('#invited-member').prepend('<div class="invited_member pt-2 pr-2"><input form="invite" class="d-none invited_member" id="invited_member['+v.name+']" name="invited_member[]" style="width:70%" value="'+v.name+'" readonly><label class="invited btn btn-hover" onclick="memDelete('+v.name+')">'+v.value+'<button id="invited_member['+v.name+']" class="invite_cross_button ml-2" type="button">×</button></label></div>')

        }
      })
        if(count!==0){
          $('.remove-input').remove();
          $('.member-alert').remove();
        }
    });
});


//招待メンバー　部署ごと表示
$(function() {

  $('#invite-sales-btn').click(function() {
      $("#invite-sales").css("display", "block");
      $("#invite-sales-btn").css("background", "#3e3838");
      $("#invite-develop").css("display", "none");
      $("#invite-develop-btn").css("background", "#626263");
      $("#invite-infra").css("display", "none");
      $("#invite-infra-btn").css("background", "#626263");
  });

  $('#invite-develop-btn').click(function() {
    $("#invite-sales").css("display", "none");
    $("#invite-sales-btn").css("background", "#626263");
    $("#invite-develop").css("display", "block");
    $("#invite-develop-btn").css("background", "#3e3838");
    $("#invite-infra").css("display", "none");
    $("#invite-infra-btn").css("background", "#626263");
  });

  $('#invite-infra-btn').click(function() {
    $("#invite-sales").css("display", "none");
    $("#invite-sales-btn").css("background", "#626263");
    $("#invite-develop").css("display", "none");
    $("#invite-develop-btn").css("background", "#626263");
    $("#invite-infra").css("display", "block");
    $("#invite-infra-btn").css("background", "#3e3838");
  });
});

function invite_alert(e){
  if(!window.confirm('招待を送信しますか？')){
     return false;
  }
}

//画面に表示されてる人のid取得して、一致する人にチェック入れる
$('#invite-btn').click(function() {
  var list = [];
  if($("div").hasClass("invited_member") == true){
    $(".invited").each(function(){
      var id = $(this).prev().attr('id');
      id = id.replace(/[^0-9]/g, '');
      list.push(id);

      var mem = document.getElementsByName(id);
      console.log(mem);
      $(mem).prop('checked', true);

    })
  }
});

//メンバー削除
function memDelete(id){
  var mem = document.getElementById("invited_member["+id+"]");
  var parent = mem.parentNode;
  parent.remove();

  var mem = document.getElementsByName(id);
  $(mem).prop('checked', false);
};
