/* ユーザー追加モーダル */

document.getElementById("hidden1").style.display ="none";

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



/* ユーザー削除モーダル */
 function deletemessage(){
  alert("このユーザーを削除しますか？");
}


/* ハンバーガーメニュー */
$(function() {
  $('.hamburger').click(function() {
      $(this).toggleClass('active');

      if ($(this).hasClass('active')) {
          $('.globalMenuSp').addClass('active');
      } else {
          $('.globalMenuSp').removeClass('active');
      }
  });
});



//ログイン情報のバリデーションチェック
// document.addEventListener('DOMContentLoaded', function() {

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

  var kana = document.getElementsByClassName('kana');
  //カタカナ
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


// });

var count = 0;
$(function(){
  /** 追加されるボタンにイベントを追加 */
  $(document).on('change', '#Checkbox1', function(){
    var userpassword = document.getElementsByClassName('userpassword');
    count = count + 1;
    console.log(count);
  for (var i=0 ; i<userpassword.length ; i++) {
    var check1 = document.getElementById("Checkbox1").checked;
    if(check1 == true){

    // ▼文字が入力されたタイミングでチェックする：
    userpassword[i].oninput = function () {
      var alertelement = this.parentNode.getElementsByClassName('alertarea');
      console.log(alertelement);
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
        console.log(alertelement);
      }
    }
  }else{
    var alertelement = document.getElementById('password-alert');
    console.log("elseのとき");
    console.log(alertelement);
    alertelement.innerHTML = "";
    console.log(alertelement);
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
      console.log(inputelements);//10個
      var alerts = this.getElementsByClassName('alertarea');
      var ret = 0;
      console.log(alerts);//7
      for (var j=0 ; j<inputelements.length ; j++) {
        console.log(inputelements[j]);
        if( inputelements[j].oninput ) {
          // oninputイベントが定義されている場合にだけ実行する
          inputelements[j].oninput();
        }
      }

      for (var j=0 ; j<alerts.length ; j++) {
        if( alerts[j].innerHTML.length > 0 ) {
          // アラートが表示されていればカウント
          console.log(alerts[j]);
          ret++;
        }
      }
      if( ret == 0 ) {
        // エラーメッセージが1つもなければ送信を許可
        return true;
      }
      else {
        var check1 = document.getElementById("Checkbox1").checked;
        if((check1 == false)&&(count>1)){
          ret--;
        }
        // エラーメッセージが1つ以上あれば、アラートを表示して送信をブロック。
        alert( ret + "個のエラーがあります。");// ※警告用のダイアログボックスを表示したくないなら、この行は削除。
        return false;
      }

    }
  }
});




// function userModalCheck(elem){

// 	var errMsgCount = 0;
// 	var periodErrMsg = elem.getElementsByClassName("err_msg_period");
// 	var checkFoam = elem.getElementsByClassName("career_modal_check");
// 	var stYear = elem.getElementsByClassName("add-from-pj-year");
// 	var stMonth = elem.getElementsByClassName("add-from-pj-month");
// 	var finYear = elem.getElementsByClassName("add-to-pj-year");
// 	var finMonth = elem.getElementsByClassName("add-to-pj-month");

// 	for (var i = 0; i < checkFoam.length ; i++) {

// 		var period = checkFoam[i].name.slice(0,6) ;

// 		if(period =="period"){
// 			var errMsgName =periodErrMsg;
// 		}else{
// 			var errMsgName = document.getElementsByClassName("err_msg_"+checkFoam[i].name);
// 		}

// 		if(!checkFoam[i].value){
// 			errMsgName[0].textContent = '必須項目です';
// 			errMsgName[0].style.color= "red";
// 			errMsgCount ++;

// 		}else{
// 			errMsgName[0].textContent = '';
// 		}
// 	}

// 	errMsgCount  = PeriodCheck(stYear[0].value, stMonth[0].value, finYear[0].value, finMonth[0].value, periodErrMsg[0], errMsgCount);

// 	if(errMsgCount == 0){
// 		alert("登録完了しました。");
// 		return true;
// 	}else{
// 		alert( errMsgCount + "個のエラーがあります。");
// 		return false;
// 	}
// }



/* 削除モーダル */
function delete_alert(e){
  if(!window.confirm('本当に削除しますか？')){
     return false;
  }
  document.deleteform.submit();
};

/* スキルマスタ編集 */
function update(){
  var update = document.getElementById("skillAdd");
  var hidden = document.getElementById("skillList");
    hidden.style.display ="none";
    update.style.display ="table-row";
}
function updatecancel(){
  var update = document.getElementById("skillAdd");
  var hidden = document.getElementById("skillList");
    hidden.style.display ="table-row";
    update.style.display ="none";
}

function update_alert(e){
  if(!window.confirm('更新しますか？')){
     return false;
  }
  document.deleteform.submit();
};
