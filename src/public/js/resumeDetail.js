function labelDisplay(ele,idnumber){
	//閉じでいる(経歴一覧の状態)詳細を表示非表示
	var id = ele.id; // eleのプロパティとしてidを取得
	var element = document.getElementById('label-id-'+idnumber);

	if(element.checked){
		element.checked	= false
	}else{
		element.checked	= true
	}
}

function DisplaBty(ele,idnumber){
	//閉じでいる(経歴一覧の状態)詳細を表示非表示
	var id = ele.id; // eleのプロパティとしてidを取得
	var element = document.getElementById('example-id-'+idnumber);

	if(element.checked){
		element.checked	= false
	}else{
		element.checked	= true
	}
	
	labelDisplay(ele,idnumber);
}


function myFnc(ele,idnumber){
	//開いている詳細表示閉じる
	var id = ele.id; // eleのプロパティとしてidを取得
	var element = document.getElementById('example-id-'+idnumber);
	var elementChecked =element.checked;

	if(elementChecked){
	element.checked	= false
	labelDisplay(element,idnumber)
	}
  }

//現在の年月取得
function current(ele,eleNo){
	
	if(ele.id == 'add_month'){
		//モーダルの現在日チェック時に現在表示する
		if(ele.checked){
			document.getElementById('add_select_year_to').style.display ="none";
			document.getElementById('add_text_year').style.display ="none";
			document.getElementById('add_select_month_to').style.display ="none";
			document.getElementById('add_text_month').style.display ="none";
			document.getElementById('add_text_current').style.display ="block";

		}else{
			//モーダルの現在日チェックを外した時に現在表示非表示
			document.getElementById('add_select_year_to').style.display ="block";
			document.getElementById('add_text_year').style.display ="block";
			document.getElementById('add_select_month_to').style.display ="block";
			document.getElementById('add_text_month').style.display ="block";
			document.getElementById('add_text_current').style.display ="none";
		}
	}else{

		if(ele.checked){
			//経歴一覧の現在日チェック時に現在表示する
			document.getElementById('to-pj-year-'+ eleNo).style.display ="none";
			document.getElementById('edit_text_year_'+ eleNo).style.display ="none";
			document.getElementById('to-pj-month-'+ eleNo).style.display ="none";
			document.getElementById('edit_text_month_'+ eleNo).style.display ="none";
			document.getElementById('edit_text_current_'+ eleNo).style.display ="block";

		}else{
			//経歴一覧の現在日チェックを外した時に現在表示非表示
			document.getElementById('to-pj-year-'+ eleNo).style.display ="block";
			document.getElementById('edit_text_year_'+ eleNo).style.display ="block";
			document.getElementById('to-pj-month-'+ eleNo).style.display ="block";
			document.getElementById('edit_text_month_'+ eleNo).style.display ="block";
			document.getElementById('edit_text_current_'+ eleNo).style.display ="none";
		}
	}
  }

  //期間のプルダウンメニュー処理
window.onload = function period(){

	//生年月日
	let birthdayYear = document.getElementById('birthday_yea_op');
	let birthdayYears = document.getElementById('birthday_year');
	let birthdayMonth = document.getElementById('birthday_month_op');
	let birthdayMonths = document.getElementById('birthday_month');
	let birthdayDay = document.getElementById('birthday_day_op');
	let birthdayDays = document.getElementById('birthday_day');

	//実年数
	let realYear = document.getElementById('real_year_op');
	let realMonth = document.getElementById('real_month_op');

	//稼働可能年
	let operableYear = document.getElementById('operable_years_op');
	let operableMonth = document.getElementById('operable_month_op');

	//追加モーダル案件期間　from
	let addFromPjYear = document.getElementById('add_from_pj_year_op');
	let addFromPjMonth = document.getElementById('add_from_pj_month_op');

	//追加モーダル案件期間　to
	let addToPjYear = document.getElementById('add_to_pj_year_op');
	let addToPjMonth = document.getElementById('add_to_pj_month_op');
	
	//経歴編集案件期間　from
	let fromCareerPjYear = document.getElementsByClassName("from-pj-year");

	//月の配列
	let Month = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']
		
	//現在の年を取得
	var currentTime = new Date();
	var year = currentTime.getFullYear()


	if(birthdayYear && birthdayMonth && birthdayDay){
		//生年月日のがNULLでないとき以下の処理(営業権限の時以下の処理しない)

		var today = new Date();
		var isLeapYear = year => (year % 4 === 0) && (year % 100 !== 0) || (year % 400 === 0);
		var datesOfFebruary = isLeapYear(year) ? 29 : 28;
		var datesOfYear= [31, datesOfFebruary, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		var thisMonth = today.getMonth() 
	

		//生年月日変更時のうるう年再判定
		var leapYear= function(datesOfYear) {
			var updatedYear = birthdayYear.value;
			var datesOfFebruary = isLeapYear(updatedYear) ? 29 : 28;
			var datesOfYear = [31, datesOfFebruary, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

			return datesOfYear
		}

		//生年月日の年を変更した時に日付を再設定
		birthdayYears.addEventListener('change', e => {
			const newDatesOfYear =leapYear()
			const newDay = newDatesOfYear[e.target.value - 1];
			if(birthdayDay.value > newDay)
			{
				birthdayDay.innerHTML = '';
			}
			createOptionDayElements(birthdayDay, newDay);
		});

    	//生年月日の月を変更した時に日付を再設定
		birthdayMonths.addEventListener('change', e => {
			const newDatesOfYear =leapYear()
			const newDay = newDatesOfYear[e.target.value - 1];
			if(birthdayDay.value > newDay)
			{
				birthdayDay.innerHTML = '';
			}
		
			createOptionDayElements(birthdayDay, newDay);
		});

		//生年月日の日付生成
		var createOptionDayElements = function(dayElem, val) {

			for (let i = 1; i <= val; i++) {
				if(String(i).length == 1){
    	          i = "0" + i;
				}
				let option = document.createElement('option');
				option.text = i;
				option.value = i;
				if(dayElem != null){
					var qq = dayElem.parentNode;

					qq.appendChild(option);
				}
			}
		}

		//生年月日の日付生成
		createOptionDayElements( birthdayDay, datesOfYear[thisMonth]);
	}

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

	//toのoption追加
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

	//年数を取得
	for(let i = 0; i <= 50; i++) {
		createOptionFormElements(realYear, i);
	}	

	//生年月日-年の生成
	for(let i = 1970; i <= year; i++) {
		createOptionToElements(birthdayYear, i);
	}

	//案件登録-年の生成
	for(let i = year; i >= 1970; i--) {
		createOptionFormElements(addFromPjYear, i);
		createOptionToElements(addToPjYear, i);
	}

	//稼働開始年数
	for(let i = 0; i <= 5; i++) {
		var futureYear = year +i
		createOptionToElements(operableYear, futureYear);
	}

	//月の生成
	for(let i = 0; i <= 12; i++) {
		createOptionFormElements(realMonth, i);
		if(i < 12) {
			createOptionFormElements(birthdayMonth, Month[i]);
			createOptionFormElements(addFromPjMonth, Month[i]);
			createOptionToElements(addToPjMonth,  Month[i]);
			createOptionFormElements(operableMonth, Month[i]);
		}
	}	

	//経歴の案件期間
	for(let j = 1; j <= fromCareerPjYear.length; j++){
		//経歴の案件期間　取得
		var fromYearElement = document.getElementById('from-pj-year-op-'+j);
		var fromtMonthElemen = document.getElementById('from-pj-month-op-'+j);
		var toYearElement = document.getElementById('to-pj-year-op-'+j);
		var toMonthElemen = document.getElementById('to-pj-month-op-'+j);

		//年数セット
		for(let y = year; y >= 1970; y--) {
			createOptionToElements(fromYearElement, y);
			createOptionToElements(toYearElement, y);
		}

		//月セット
		for(let m = 0; m < 12; m++) {
			createOptionFormElements(fromtMonthElemen,  Month[m]);
			createOptionFormElements(toMonthElemen, Month[m]);
		}
	}

}


  //レジュメ詳細_スキルフォーム追加
function formAdd(ele,btName,areaName,skilName,carrerListNo){
	
	if(areaName == 'career'){
		//経歴一覧　親要素 
		var career_list_itms_element = document.getElementById(btName+ "_td_"+carrerListNo);
	}else{
		//経歴一覧以外　親要素 
		var career_list_itms_element = document.getElementById(btName+ "_td");
	}

	//追加する場所
	var list_element = document.getElementById(ele.id);
	
	///SELECTフォームのナンバー取得
	if(areaName == "modal"){
		var selectClass = document.getElementsByClassName("modal_search_"+skilName);
		var SelectIdNo = selectClass.length;	
	}else if(areaName == "base") {
		var selectClass = document.getElementsByClassName("basic_search_"+skilName);
		var SelectIdNo = selectClass.length;
	}else if(areaName == "license"){
		var selectClass = document.getElementsByClassName("license_input"+skilName);
		var SelectIdNo = selectClass.length;
	}else if(areaName == "career") {
		var carrerNoElem = document.getElementById(btName + "_td_" +carrerListNo);
		var selectClass = carrerNoElem.getElementsByClassName("career_skil_name_select");
		var SelectIdNo = selectClass.length;
	}

	
	//追加する要素 DIV
	var new_div = document.createElement('div');

	if(areaName == "modal"){

		new_div.className = 'skill_foam_area';

		for(i=1; i<=3; i++){

			//これから生成される要素のNo
			var  newSelectNo = Number(SelectIdNo) + i;
			//SELECT　作成
			var selectElem = document.createElement('select');
			selectElem.id = btName+"_select_"+newSelectNo ;
			selectElem.name = btName +'[0]['+btName+'_select_'+ newSelectNo + ']';
			if(i == 2) {
				selectElem.className = 'skill_foam_input_middle modal_search_'+skilName;
			}else {
				selectElem.className = 'skill_foam_input modal_search_'+skilName;;
			}

			//SELECT　追加
			var new_div_in_select = new_div.appendChild(selectElem);

			//SELECTコピー元取得　SELECT内のoptionを使用するため
			var copyNodeBase = document.getElementById( btName+"_select_1" );

			//option 作成
			optionSet(copyNodeBase,new_div_in_select,newSelectNo,skilName,areaName);	

		}
	
		//追加する場所指定
		career_list_itms_element.insertBefore(new_div, list_element);

		//追加したSELECTに検索ボックス追加
		$('.modal_search_'+skilName).select2({
			width: '100%',
		});

	}else if(areaName == "base"){

		new_div.className = 'basic_skill_area';

		for(i=1; i<=2; i++){

			//これから生成される要素のNo
			newSelectNo =  Number(SelectIdNo) + i

			//SELECT　DIV作成
			new_div_sub = document.createElement('div');
			new_div_sub.className = 'basic_skill_item_area';
			new_div.appendChild(new_div_sub);

			//SELECT　作成
			var selectElem = document.createElement('select');
			selectElem.id =  'edit_'+skilName+'_select_'+newSelectNo;
			selectElem.name = "edit_"+skilName+"[0][edit_"+skilName+"_select_"+newSelectNo+"[0][skillName]]"
			selectElem.className = 'basic_skil_name_select basic_search_'+skilName;
			//SELECT　追加
			new_div_in_select = new_div_sub.appendChild(selectElem);

			//SELECTコピー元取得　SELECT内のoptionを使用するため
			var copyNodeBase = document.getElementById("edit_"+skilName+"_select_1");

			//option 作成
			optionSet(copyNodeBase,new_div_in_select,newSelectNo,skilName,areaName);	

			//select　評価
			var evaluationArr = [
				{val:"", txt:""},
				{val:"1", txt:"△1年未満"},
				{val:"2", txt:"〇1年以上"},
				{val:"3", txt:"◎3年以上"}
			  ];
			new_select_skill   = document.createElement('select');
			new_select_skill.id ='edit_'+skilName+'_select_ev_'+newSelectNo;
			new_select_skill.name = "edit_"+skilName+"[0][edit_"+skilName+"_select_"+newSelectNo+"[0][evaluation]]"
			new_select_skill.className = 'basic_evaluation_name_select';

			new_div_in_select_skill = new_div_sub.appendChild(new_select_skill);


			for(var j=0; j < evaluationArr.length; j++){
				let op = document.createElement("option");
				op.value = evaluationArr[j].val;  //value値
				op.text = evaluationArr[j].txt;   //テキスト値
				new_div_in_select_skill.appendChild(op);
				
			  }
			  new_div_in_select_skill.options[0].selected = true
			
		}

		//追加する場所指定
		career_list_itms_element.insertBefore(new_div, list_element);

		//追加したSELECTに検索ボックス追加
		$('.basic_search_'+skilName).select2({
			width: '100%',
		});

	}else if(areaName == "license"){	

		for(i=1; i<=3; i++){

			//これから生成される要素のNo
			newSelectNo =  Number(SelectIdNo) + i
			
			new_div.className = 'edit_license_flex';

			new_div_sub = document.createElement('div');
			new_div_sub.className = 'license_foam_area';
            
			//保有資格名入力フォーム生成
			new_input = document.createElement('input');
			new_input.id = btName +'_input_'+newSelectNo;
			new_input.name= 'license['+ newSelectNo +'][edit_license_input]';
			new_input.className = 'license_input';

			//チェックボックス生成
			new_input_check = document.createElement('input');
			new_input_check.id = "check_" +btName+'_input_'+ newSelectNo;
			new_input_check.name= 'license['+newSelectNo +'][check_license_input]'
			new_input_check.type ="checkbox"
			new_input_check.className = 'license_check';
			
			
			//INPUT　追加する位置指定
			new_div.appendChild(new_div_sub);
			new_div_sub.appendChild(new_input);
			new_div_sub.appendChild(new_input_check);

		}

	//追加する場所指定
	career_list_itms_element.insertBefore(new_div, list_element);

	}else if(areaName == "career") {

			new_div.className = 'career_skill_area_'+carrerListNo + ' career_skill_area_display';
	
			for(i=1; i<=3; i++){
	
				//これから生成される要素のNo
				newSelectNo =  Number(SelectIdNo) + i

				//SELECT　作成
				var selectElem = document.createElement('select');
				selectElem.id = 'career_edit_'+skilName+'_'+carrerListNo+'_select_'+newSelectNo;
				selectElem.name = "edit_"+skilName+"[0][skillName"+newSelectNo+"]"
				if(i == 2) {
					selectElem.className = 'career_skil_name_select career_skil_name_select_middle career_search_'+skilName+'_'+carrerListNo;
				}else {
					selectElem.className = 'career_skil_name_select career_search_'+skilName+'_'+carrerListNo;
				}

				//SELECT　追加
				new_div_in_select = new_div.appendChild(selectElem);

				//SELECTコピー元取得　SELECT内のoptionを使用するため
				var copyNodeBase = document.getElementById("career_edit_"+skilName+"_"+carrerListNo+"_select_1");

				//option セット
				optionSet(copyNodeBase,new_div_in_select,newSelectNo,skilName,areaName);
			}

		//追加する場所指定
		career_list_itms_element.insertBefore(new_div, list_element);

		//追加したSELECTに検索ボックス追加
		$('#'+btName+'_td_'+carrerListNo).find(".career_skil_name_select").select2({
			width: '100%',
		});
	}
}
function optionSet(copyNodeBase,new_div_in_select,newSelectNo,skillName,areaName){

	//SELECTコピー
	var children = copyNodeBase.cloneNode(true);

	if(skillName=='platform' || skillName=='framework'|| skillName=='others'){
		//optgroupタグ出力
		optgroupElem =copyNodeBase.children
		Array.from(optgroupElem).forEach(function(optgroupElemChild) {	

			new_optgroup = document.createElement('optgroup');

			new_optgroup.id = skillName+'_'+optgroupElemChild.label+'_'+newSelectNo;
			new_optgroup.className = optgroupElemChild.className;
			new_optgroup.label = optgroupElemChild.label;
			new_div_in_select1 = new_div_in_select.appendChild(new_optgroup);

			optionCreat(optgroupElemChild.children,new_div_in_select1,areaName);
		});
	}else{
		//optionを作成
		optionCreat(children,new_div_in_select,areaName);
	}
}

function optionCreat(children,new_div_in_select,areaName){

	//for　SELCT内の子要素分
	Array.from(children).forEach(function(child) {

		//option 作成
		new_option = document.createElement('option');

		new_option.classList = child.className;
		new_option.value= child.value;
		new_option.text = child.text;
		if(areaName=="careerEdit"){
			if(param[i] === undefined){
				
			}else{
				if(param[i]['skill_name']==new_option.text){
					new_option.selected = true;
				}
			}
		}
		
		//作成したoption追加
		new_div_in_select.appendChild(new_option);
	});

	
	if(children.length == 0 ){
		new_option = document.createElement('option');

		new_option.seleted  = true;

		new_div_in_select.appendChild(new_option);
	}
}

//editMode 内で使用 - 編集ボタン押下時の情報を一時的に格納
var temp_skillName = [];
var temp_skillEva = [];
//各スキルの編集ボタン、キャンセルボタン押下時の個数取得
var temp_language = 0;
var current_language = 0;
var temp_db = 0;
var current_db = 0;
var temp_os = 0;
var current_os = 0;
var temp_platform = 0;
var current_platform = 0;
var temp_middleware = 0;
var current_middleware = 0;
var temp_framework = 0;
var current_framework = 0;
var temp_others = 0;
var current_others = 0;

//編集モード　押下
click = 0;
clickCount = [];
function editMode(ele,idnumber){

	var id = ele.id; // eleのプロパティとしてidを取得
	var basic_area_bt= id.slice( 0,5 ) ;

	if(basic_area_bt == 'basic'){
		var basicSkillName = document.getElementsByClassName('basic_skil_name_select');
		var basicEvaName = document.getElementsByClassName('basic_evaluation_name_select');
		var basicSkillBt = document.getElementsByClassName('basic_skil_bt');

		//select2 の表示部分のspanタグ取得
		var spanBasicSkillName = document.getElementsByClassName("select2-selection__rendered");
		var basicSkillArea = document.getElementsByClassName("basic_skill_area");

		var infobtn = document.getElementById('basic_info_bt_e');
		var skillbtn = document.getElementById('basic_info_skill_bt_e');
		var summarybtn = document.getElementById('basic_info_summary_bt_e');

		switch (id){
			case 'basic_info_bt_e':
			case 'basic_info_bt_c':
				var edit_flag= id.slice(-1);
				var editbt = document.getElementById('basic_info_edit_bt_area');
				var cancelbt = document.getElementById('basic_info_cancel_bt_area');
				var infoEditarea = document.getElementById('basic_info_edit');
				var showEditarea = document.getElementById('basic_info_show');
				

				if(edit_flag == 'e'){	
					editbt.style.display ="none";
					cancelbt.style.display ="block";

					infoEditarea.style.display ="block";
					showEditarea.style.display ="none";

					skillbtn.setAttribute("disabled", true);
					summarybtn.setAttribute("disabled", true);
		
				}else{		
					editbt.style.display ="block";
					cancelbt.style.display ="none";

					infoEditarea.style.display ="none";
					showEditarea.style.display ="block";

					skillbtn.removeAttribute("disabled");
					summarybtn.removeAttribute("disabled");

				}

			  break;
			case 'basic_info_skill_bt_e':
			case 'basic_info_skill_bt_c':
				var edit_flag= id.slice(-1);
				var editbt = document.getElementById('basic_skill_edit_bt_area');
				var cancelbt = document.getElementById('basic_skill_cancel_bt_area');
				//各スキルセレクト
				var selectLanguage = document.getElementsByClassName('basic_search_language');
				var selectDB = document.getElementsByClassName('basic_search_db');
				var selectOS = document.getElementsByClassName('basic_search_os');
				var selectPlatform = document.getElementsByClassName('basic_search_platform');
				var selectMiddleware = document.getElementsByClassName('basic_search_middleware');
				var selectFramework = document.getElementsByClassName('basic_search_framework');
				var selectOthers = document.getElementsByClassName('basic_search_others');
			 
				if(edit_flag == 'e'){	
					editbt.style.display ="none";
					cancelbt.style.display ="block";
		
					//編集ボタン押下時の各スキルの個数取得
					temp_language = selectLanguage.length;
					temp_db = selectDB.length;
					temp_os = selectOS.length;
					temp_platform = selectPlatform.length;
					temp_middleware = selectMiddleware.length;
					temp_framework = selectFramework.length;
					temp_others = selectOthers.length;

					for(var j=0 ; j < basicSkillName.length ; j++){
						basicSkillName[j].disabled = false;
						basicEvaName[j].disabled = false;
						temp_skillName[j] = spanBasicSkillName[j].textContent;
						temp_skillEva[j] = basicEvaName[j].value;
					}
					
					for(var b = 0; b < basicSkillBt.length; b++){
						basicSkillBt[b].style.display ="block";
					}
					
					infobtn.setAttribute("disabled", true);
					summarybtn.setAttribute("disabled", true);
		
				}else{
		
					editbt.style.display ="block";
					cancelbt.style.display ="none"

					//キャンセルボタン押下時の各スキルの個数取得
					current_language = selectLanguage.length;
					current_db = selectDB.length;
					current_os = selectOS.length;
					current_platform = selectPlatform.length;
					current_middleware = selectMiddleware.length;
					current_framework = selectFramework.length;
					current_others = selectOthers.length;

					//新規セル追加分を含むdivを削除
					//divTotalIndex は言語スキルから数えての、div要素のindexを示している
					divTotalIndex = 0;
					basicCancelSkill(temp_language, current_language, basicSkillArea, divTotalIndex, "language");

					divTotalIndex += temp_language / 2;
					basicCancelSkill(temp_db, current_db, basicSkillArea, divTotalIndex, "db");

					divTotalIndex += temp_db / 2;
					basicCancelSkill(temp_os, current_os, basicSkillArea, divTotalIndex, "os");

					divTotalIndex += temp_os / 2;
					basicCancelSkill(temp_platform, current_platform, basicSkillArea, divTotalIndex, "platform");

					divTotalIndex += temp_platform / 2;
					basicCancelSkill(temp_middleware, current_middleware, basicSkillArea, divTotalIndex, "middleware");

					divTotalIndex += temp_middleware / 2;
					basicCancelSkill(temp_framework, current_framework, basicSkillArea, divTotalIndex, "framework");

					divTotalIndex += temp_framework / 2;
					basicCancelSkill(temp_others, current_others, basicSkillArea, divTotalIndex, "others");

		
					for(var j=0 ; j < basicSkillName.length ; j++){

						if(temp_skillName[j] == "" || temp_skillEva[j] == ""){
							basicSkillName[j].value = "";
							basicEvaName[j].value = "";
							spanBasicSkillName[j].textContent = "";
							spanBasicSkillName[j].removeAttribute("title");
						}else if(spanBasicSkillName[j].textContent != temp_skillName[j] || basicEvaName[j].value != temp_skillEva[j]){
							basicEvaName[j].value = temp_skillEva[j];
							spanBasicSkillName[j].textContent = temp_skillName[j];
							spanBasicSkillName[j].setAttribute("title", temp_skillName[j]);
						}
						
						basicSkillName[j].disabled = true;
						basicEvaName[j].disabled = true;
					}
					
					for(var b = 0; b < basicSkillBt.length; b++){
						basicSkillBt[b].style.display ="none";
					}

					
					infobtn.removeAttribute("disabled");
					summarybtn.removeAttribute("disabled");
				}
				
			break;
			default:
		}

	}else{

		var cancel_bt= id.slice( 0,6 ) ;

		labelDisplay(ele,idnumber)//編集モード時に対象の経歴一覧を非表示
		myFnc(ele,idnumber)//編集モード時に詳細表示されていれば閉じる
		
		if(cancel_bt !== 'cancel'){
			document.getElementById("career_datail-"+idnumber).style.display ="none";
			document.getElementById("careert_datail_edit-"+idnumber).style.display ="block";
		}else{
			document.getElementById("career_datail-"+idnumber).style.display ="block";
			document.getElementById("careert_datail_edit-"+idnumber).style.display ="none";
		}

		if(clickCount[idnumber] === undefined){
			click = 1;
		}else{
			click = clickCount[idnumber] + 1;
		}
		clickCount[idnumber] = click;
	
		skillnames = ['language','db','os','middleware','platform','framework','others'];
		if(clickCount[idnumber]==1){
			for(categoryCount=0;categoryCount<7;categoryCount++){
				skillFormList(idnumber,"career_edit_"+skillnames[categoryCount],skillnames[categoryCount],categoryCount);
			}
		}
	}
}	

//管理人数 一時保存
temp_mgt = [];
function editSummaryMode(ele){
	var id = ele.id; // eleのプロパティとしてidを取得
	var edit_flag= id.slice(-1) ;
	var editbt = document.getElementById('basic_summary_edit_bt_area');
	var cancelbt = document.getElementById('basic_summary_cancel_bt_area');
	var mgt_input = document.getElementsByClassName('mgmt_input');
	
	var infobtn = document.getElementById('basic_info_bt_e');
	var skillbtn = document.getElementById('basic_info_skill_bt_e');

	if(edit_flag == 'e'){
		editbt.style.display ="none";
		cancelbt.style.display ="block";
		for(var i=0 ; i < mgt_input.length; i++){
			mgt_input[i].disabled = false;
			temp_mgt[i] = mgt_input[i].checked;
		}
		
		infobtn.setAttribute("disabled", true);
		skillbtn.setAttribute("disabled", true);

	}else{
		editbt.style.display ="block";
		cancelbt.style.display ="none";
		for(var i=0 ; i < mgt_input.length; i++){
			mgt_input[i].disabled = true;
			if(temp_mgt[i] == false){
				mgt_input[i].checked = false;
			}else{
				mgt_input[i].checked = true;
			}
			
		}
		
		infobtn.removeAttribute("disabled");
		skillbtn.removeAttribute("disabled");
	}
}

//基本情報の送信前チェック
function basicInfoCheck(ele){
	
	var disabledCunt = 0;
	var errMsgCount = 0;
	var licensecheckCount = 0;
	var checkFoam = document.getElementsByClassName("basic_info_edit_check");
	var licensecheck = document.getElementsByClassName("license_check");

	//権限が営業時に必須チェックしない　をするため基本情報のdisabledをcountする
	for(var d =0 ; d < ele.length ; d++){
		if(ele[d].disabled){
			disabledCunt ++;
		}
	}

	if(disabledCunt < 5){

		for (var i = 0; i < checkFoam.length ; i++) {
				var birthday = checkFoam[i].id.slice(0,8) ;
				if(birthday =="birthday"){
					var errMsgName = document.getElementsByClassName("err_msg_birthday");
				}else{
					var errMsgName = document.getElementsByClassName("err_msg_"+checkFoam[i].name);
				}
			if(!checkFoam[i].value){
				errMsgName[0].textContent = '必須項目です';
				errMsgName[0].style.color= "red";
				errMsgCount ++;

			}else{
				errMsgName[0].textContent = '';
			}
		}

		for(var c = 0; c < licensecheck.length ; c++){	
			if(licensecheck[c].checked){
				licensecheckCount ++;
			}
			if(licensecheckCount > 2){
				var errMsgLicense = document.getElementsByClassName("err_msg_license");
				errMsgLicense[0].textContent = '保有資格のチェックは2つ以上は選択できません。';
				errMsgLicense[0].style.color= "red";
				errMsgCount ++;
				break;
			}
		}
	}

	if(errMsgCount == 0){
		alert("登録完了しました。");
		resumeLoadingFunc();
		return true;
	}else{
		alert( errMsgCount + "個のエラーがあります。");
		return false;
	}
}

//基本情報のスキルの経験年数チェック
function basicInfoSkillCheck(){

	var errMsgCount = 0;
	var errMsgDuplicateFlg = false;
	var skillFoam = document.getElementsByClassName("basic_skil_name_select");
	var evaluationFoam = document.getElementsByClassName("basic_evaluation_name_select");
	var errMsgSkill = document.getElementById("err_msg_skill");
	var errMsgEvaluation = document.getElementById("err_msg_evaluation");
	var errMsgDuplicate = document.getElementById("err_msg_duplicate");

	if(errMsgSkill.className == "errMsgFlg" || errMsgEvaluation.className == "errMsgFlg" || errMsgDuplicate == "errMsgFlg"){
		//styleリセット
		errMsgSkill.textContent = '';
		errMsgSkill.style.color= "";
		errMsgSkill.classList.remove("errMsgFlg");
		errMsgEvaluation.textContent = '';
		errMsgEvaluation.style.color= "";
		errMsgEvaluation.classList.remove("errMsgFlg");
		errMsgDuplicate.textContent = '';
		errMsgDuplicate.style.color= "";
		errMsgDuplicate.classList.remove("errMsgFlg");

		for (var k = 0; k < skillFoam.length ; k++) {
			evaluationFoam[k].style.border = "1px solid black";
			skillFoam[k].style.border = "1px solid black";
		}
	}

	for (var i = 0; i < skillFoam.length ; i++) {

		//スキルと配列どちらかが空でないかチェック
		if(skillFoam[i].value && evaluationFoam[i].value == ""){
			evaluationFoam[i].style.border = "1px solid red";
			if(errMsgSkill.className==""){
				errMsgSkill.textContent = 'スキルに対して経験年数が選択されていません。';
				errMsgSkill.style.color= "red";
				errMsgSkill.className="errMsgFlg"
			}
			errMsgCount ++;
		}else if(evaluationFoam[i].value && skillFoam[i].value == ""){
			skillFoam[i].style.border = "1px solid red";
				errMsgEvaluation.textContent = '経験年数に対してスキルが選択されていません。';
				errMsgEvaluation.style.color= "red";
				errMsgEvaluation.className="errMsgFlg"
			errMsgCount ++;
		}else{
			//重複チェック
			//現在の位置(i)から最高までチェック
			for (var l = i + 1; l < skillFoam.length ; l++) {
				if(skillFoam[i].value == skillFoam[l].value && skillFoam[i].value != "" && skillFoam[l].value != "" ){
					skillFoam[l].style.border = "1px solid red"
					if(!errMsgDuplicateFlg){
						errMsgDuplicate.textContent = 'スキル名が重複しています。';
						errMsgDuplicate.style.color= "red";
						errMsgDuplicate.className="errMsgFlg"
						errMsgCount ++;
						errMsgDuplicateFlg = true;
					}
				}
			}
			errMsgDuplicateFlg = false;
		}
	}

	if(errMsgCount == 0){
		alert("登録完了しました。");
		resumeLoadingFunc();
		return true;
	}else{

		alert( errMsgCount + "個のエラーがあります。");
		return false;
	}
}

//経歴モーダルの送信前チェック
function careerModalCheck(elem){

	var errMsgCount = 0;
	var periodcflg = true;
	var checkFoam = elem.getElementsByClassName("career_modal_check");
	var periodcCeckFoam = elem.getElementsByClassName("period_check")
	var periodcErrMsgName = document.getElementById("add_err_msg_period");
	var currentCheck = elem.querySelector("#add_month");
	var stYear = elem.querySelector("#add_text_year_from");
	var stMonth = elem.querySelector("#add_text_month_from");
	var finYear = elem.querySelector("#add_select_year_to");
	var finMonth = elem.querySelector("#add_select_month_to");
	//モーダル　各スキルセレクト取得
	var languageFoam = document.getElementsByClassName("modal_search_language");
	var dbFoam = document.getElementsByClassName("modal_search_db");
	var osFoam = document.getElementsByClassName("modal_search_os");
	var platformFoam = document.getElementsByClassName("modal_search_platform");
	var middlewareFoam = document.getElementsByClassName("modal_search_middleware");
	var frameworkFoam = document.getElementsByClassName("modal_search_framework");
	var othersFoam = document.getElementsByClassName("modal_search_others");
	//モーダル　各スキル名配列
	var skillNameArray =[languageFoam,dbFoam,osFoam,platformFoam,middlewareFoam,frameworkFoam,othersFoam];
	//モーダル　各スキルエラーメッセージ
	var languageMsgName = document.getElementById("add_err_msg_skill_language");
	var dbErrMsgName = document.getElementById("add_err_msg_skill_db");
	var osErrMsgName = document.getElementById("add_err_msg_skill_os");
	var platformErrMsgName = document.getElementById("add_err_msg_skill_platform");
	var middlewareErrMsgName = document.getElementById("add_err_msg_skill_middleware");
	var frameworkErrMsgName = document.getElementById("add_err_msg_skill_framework");
	var othersErrMsgName = document.getElementById("add_err_msg_skill_others");
	var msFlgName = document.getElementsByClassName("errMsgFlg");
	
	//モーダル　各スキルエラーメッセージ名配列
	var skillErrMsgNameArray =[languageMsgName,dbErrMsgName,osErrMsgName,platformErrMsgName,middlewareErrMsgName,frameworkErrMsgName,othersErrMsgName];

	//期間エラーメッセージクリア
	periodcErrMsgName.textContent ="";

	//スキルエラーメッセージクリア
		for (var m = 0; m < 7; m++) {
			if(msFlgName.length >= 1){
				msFlgName[0].textContent =""
				msFlgName[0].classList.remove("errMsgFlg");
			}
		}

	//プロジェクト概要と人数と業務内容をチェック
	for (var i = 0; i < checkFoam.length ; i++) {

		var errMsgName = document.getElementById("add_err_msg_"+checkFoam[i].name);

		errMsgCount  = required(checkFoam,i,errMsgName,errMsgCount);
	}

	//期間の必須チェック
	for(var j = 0; j < periodcCeckFoam.length ; j++){
				
		if (currentCheck.checked && j < 2) {
			//現在にチェックがあればfromの年と月をチェックする
			errMsgCount  =required(periodcCeckFoam,j,periodcErrMsgName,errMsgCount,periodcflg);

		}else if (!currentCheck.checked){
			//現在チェックなしの時toの月をチェックする
			errMsgCount  =required(periodcCeckFoam,j,periodcErrMsgName,errMsgCount,periodcflg);
		}

	}

	//日付チェック
	if(!currentCheck.checked && periodcErrMsgName.textContent == ""){
		errMsgCount  = PeriodCheck(stYear.value, stMonth.value, finYear.value, finMonth.value, periodcErrMsgName, errMsgCount,currentCheck);
	}

	for(var s = 0; s < skillNameArray.length ; s++){
		//スキル重複チェック
		errMsgCount  = modalSkillCheck(skillNameArray[s],skillErrMsgNameArray[s],errMsgCount);
	}

	if(errMsgCount == 0){
		alert("登録完了しました。");

		resumeLoadingFunc();
		setCareerTabCookie();
		return true;
	}else{
		alert( errMsgCount + "個のエラーがあります。");
		return false;
	}
}

function modalSkillCheck(skillFoam,errMsgName,errMsgCount){

	for (var i = 0; i < skillFoam.length ; i++) {

		//スキルと配列どちらかが空でないかチェック
		if(skillFoam[i].value != ""){
			//重複チェック
			//現在の位置(i)から最高までチェック
			for (var l = i + 1; l < skillFoam.length ; l++) {
				if(skillFoam[i].value == skillFoam[l].value && skillFoam[i].value != "" && skillFoam[l].value != "" ){
					//skillFoam[l].style.border = "1px solid red"
						errMsgName.textContent = 'スキル名が重複しています。';
						errMsgName.style ="text-align:left";
						errMsgName.style.color= "red";
						errMsgName.className="errMsgFlg"
						errMsgCount ++;
				}
			}
		}
	}
	return errMsgCount;
}

//経歴編集の送信前チェック
function careerEditCheck(elem,no){

	var errMsgCount = 0;
	var periodcflg = true;
	var checkFoam = elem.getElementsByClassName("career_edit_check");
	var periodcCeckFoam = elem.getElementsByClassName("edit_period_check");
	var currentCheck = elem.querySelector(".edit_text_current");
	var periodcErrMsgName = document.getElementById("edit_err_msg_period_"+no);
	var stYear = document.getElementById("from-pj-year-"+no);
	var stMonth = document.getElementById("from-pj-month-"+no);
	var finYear = document.getElementById("to-pj-year-"+no);
	var finMonth = document.getElementById("to-pj-month-"+no);
	//モーダル　各スキルセレクト取得
	var languageFoam = document.getElementsByClassName("career_search_language_"+no);
	var dbFoam = document.getElementsByClassName("career_search_db_"+no);
	var osFoam = document.getElementsByClassName("career_search_os_"+no);
	var platformFoam = document.getElementsByClassName("career_search_platform_"+no);
	var middlewareFoam = document.getElementsByClassName("career_search_middleware_"+no);
	var frameworkFoam = document.getElementsByClassName("career_search_framework_"+no);
	var othersFoam = document.getElementsByClassName("career_search_others_"+no);
	//モーダル　各スキル名配列
	var skillNameArray =[languageFoam,dbFoam,osFoam,platformFoam,middlewareFoam,frameworkFoam,othersFoam];
	//モーダル　各スキルエラーメッセージ
	var languageMsgName = document.getElementById("career_err_msg_skill_language_"+no);
	var dbErrMsgName = document.getElementById("career_err_msg_skill_db_"+no);
	var osErrMsgName = document.getElementById("career_err_msg_skill_os_"+no);
	var platformErrMsgName = document.getElementById("career_err_msg_skill_platform_"+no);
	var middlewareErrMsgName = document.getElementById("career_err_msg_skill_middleware_"+no);
	var frameworkErrMsgName = document.getElementById("career_err_msg_skill_framework_"+no);
	var othersErrMsgName = document.getElementById("career_err_msg_skill_others_"+no);
	var msFlgName = document.getElementsByClassName("errMsgFlg");

	//モーダル　各スキルエラーメッセージ名配列
	var skillErrMsgNameArray =[languageMsgName,dbErrMsgName,osErrMsgName,platformErrMsgName,middlewareErrMsgName,frameworkErrMsgName,othersErrMsgName];

	//期間エラーメッセージクリア
	periodcErrMsgName.textContent =""

	//スキルエラーメッセージクリア
	for (var m = 0; m < 7; m++) {
		if(msFlgName.length >= 1){
			msFlgName[0].textContent =""
			msFlgName[0].classList.remove("errMsgFlg");
		}
	}

	for (var i = 0; i < checkFoam.length ; i++) {

		var errMsgName = document.getElementById("edit_err_msg_"+checkFoam[i].name+"_"+no);
		
		errMsgCount  =required(checkFoam,i,errMsgName,errMsgCount);

	}

	//期間の必須チェック
	for(var j = 0; j < periodcCeckFoam.length ; j++){
		
		if (currentCheck.checked && j < 2) {

			errMsgCount  =required(periodcCeckFoam,j,periodcErrMsgName,errMsgCount,periodcflg);
				
		}else if (!currentCheck.checked){

			errMsgCount  =required(periodcCeckFoam,j,periodcErrMsgName,errMsgCount,periodcflg);
		}

	}

	//日付チェック
	if(!currentCheck.checked && periodcErrMsgName.textContent == ""){
		errMsgCount  = PeriodCheck(stYear.value, stMonth.value, finYear.value, finMonth.value, periodcErrMsgName, errMsgCount,currentCheck);
	}

	for(var s = 0; s < skillNameArray.length ; s++){
	
		//スキル重複チェック
		errMsgCount  = modalSkillCheck(skillNameArray[s],skillErrMsgNameArray[s],errMsgCount);
		
	}

	if(errMsgCount == 0){
		alert("登録完了しました。");
		
		resumeLoadingFunc()
		setCareerTabCookie();
		return true;
	}else{
		alert( errMsgCount + "個のエラーがあります。");
		return false;
	}

}
function required(checkFoam,No,errMsgName,errMsgCount,periodcflg){

	if(!checkFoam[No].value){
		errMsgName.textContent = '必須項目です';
		errMsgName.style.color= "red";
		errMsgCount ++;
	}else if(checkFoam[No].name == 'project_num'){
		if(!checkFoam[No].value.match(/^\d+$/)){
			errMsgName.textContent = '半角数字のみで入力してください';
			errMsgName.style.color= "red";
			errMsgCount ++;
		}else{
			errMsgName.textContent = '';
		}
	}else if(!periodcflg){ 
		errMsgName.textContent = '';
	}

	return errMsgCount;

}

function PeriodCheck(stYear, stMonth, finYear, finMonth, errMsgName, errMsgCount ){

	
	if(stYear > finYear){
		errMsgName.textContent = '年が不正です。';
		errMsgName.style.color= "red";
		errMsgCount ++;
	}

	if(stYear == finYear && stMonth > finMonth ){
		errMsgName.textContent = '月付が不正です。';
		errMsgName.style.color= "red";
		errMsgCount ++;
	}
	

	return errMsgCount;

}

/* 削除モーダル */
function delete_alert_detaill(e){
	if(!window.confirm('本当に削除しますか？削除すると復元できません。')){
	   return false;
	}
	resumeLoadingFunc();
	setCareerTabCookie();

	document.getElementById("del-career").submit();
  };

  //更新依頼、レビュー依頼通知処理（Slack）
  $('#request-button').on('click', function () {
	$(function () {
		let editors = $('#request-button').val();
		let editor = editors.split(',');
		let $message = "";

		//ログイン者の engineer_flg により営業か開発なのか判定
		if(editor[4] == 0){
			$message = '更新完了通知を送りますか？';
		}else {
			$message = '更新依頼通知を送りますか？';
		}

		if(!window.confirm($message)){
			return false;
		 }

		  resumeLoadingFunc();

		  $.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: '/request_slack',
			method: 'POST',
			data: {
				'lastname': editor[0],
				'firstname': editor[1],
				'user_id': editor[2],
				'login_id': editor[3],
				'engineer_flg': editor[4],
				'guest_flg': editor[5]
			},
		  })
		  .done(function (data) {
			alert("通知が完了しました");
			$('#loader-bg').delay(500).fadeOut(350);
			$('#loader').delay(200).fadeOut(150);
		  })
		  .fail(function () {
			alert("通知が失敗しました");
			$('#loader-bg').delay(500).fadeOut(350);
			$('#loader').delay(200).fadeOut(150);
		  });
	})
});

function loadingSum(){
	resumeLoadingFunc();
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

function inputChange(elem,no,res,name,mode){

	if(mode == "modal"){	
		if(res == "pc"){
			var element = document.getElementById(mode+'_sp_'+name);
		}else{
			var element = document.getElementById(mode+'_pc_'+name);
		}
	}else{	
		if(res == "pc"){
			var element = document.getElementById('sp_'+name+'_'+no);
		}else{
			var element = document.getElementById('pc_'+name+'_'+no);
		}
	}
	if(elem.checked){
		element.checked	= true
	}else{
		element.checked	= false
	}

}

//セレクトの検索機能追加
$(document).ready(function() {

	var skillArr = [ "language", "db", "os","platform" ,"middleware","framework","others"];

	//基本情報　
	for (var b=0; b<skillArr.length; b++) {
		$('.basic_search_'+skillArr[b]).select2({
			width: '100%',
		});
	}

	//経歴一覧編集
	var careerSum = $('input[name="no_num[]"]');

	for (var i=1; i<=careerSum.length; i++) {
		for (var j=0; j<skillArr.length; j++) {
			$('.career_search_'+skillArr[j]+'_'+i).select2({
				width: '100%',
		});
		}
    }
});

function addSelect2(){

	var skillArr = [ "language", "db", "os","platform" ,"middleware","framework","others"];

	for (var m=0; m<skillArr.length; m++) {
		for (var s=1; s<=6; s++) {
			$('#modal_'+skillArr[m]+'_select_'+s).select2({
    			width: '100%',
			  });
		}
	}

}

function setCareerTabCookie(){
	let m = 3;
	document.cookie = "tab_flg=career" + ";max-age=" + m;
}

//基本情報スキルキャンセル
function basicCancelSkill(temp_num, current_num, basicSkillArea, divTotalIndex, skill_name){
	for(k = temp_num; k < current_num; k++){
		if(k % 2 == 0) continue;
		//新規セルを追加しているかどうか
		if(temp_num < current_num){
			let divIndex = 0;

			switch(skill_name){
				case 'language':
					divIndex += divTotalIndex + temp_num / 2;
					basicSkillArea[divIndex].remove();
					break;

				case 'db':
					divIndex += divTotalIndex + temp_num / 2;
					basicSkillArea[divIndex].remove();
					break;

				case 'os':
					divIndex += divTotalIndex + temp_num / 2;
					basicSkillArea[divIndex].remove();
					break;

				case 'platform':
					divIndex += divTotalIndex + temp_num / 2;
					basicSkillArea[divIndex].remove();
					break;

				case 'middleware':
					divIndex += divTotalIndex + temp_num / 2;
					basicSkillArea[divIndex].remove();
					break;

				case 'framework':
					divIndex += divTotalIndex + temp_num / 2;
					basicSkillArea[divIndex].remove();
					break;

				case 'others':
					divIndex += divTotalIndex + temp_num / 2;
					basicSkillArea[divIndex].remove();
					break;
			}
		}
	}
}


//並び替えボタン押下
$(function(){
	$("#changeBtn").click(function() {
		$(".num-change").each(function(){
			$(".num-change").css("display", "block");
		})
		$(".num-changes").css("display", "flex");
		$(".change-btn1").css("display", "none");
		document.querySelectorAll("div.career-action button").forEach( e => e.disabled = true );
	})

});
//並び替えキャンセルボタン押下
$(function(){
	$("#changeCancelBtn").click(function() {
		$(".num-change").each(function(){
			$(".num-change").css("display", "none");
		})
		$(".num-changes").css("display", "none");
		$(".change-btn1").css("display", "block");
		document.querySelectorAll("div.career-action button").forEach( e => e.disabled = false );
	})

});


//並び替え機能
//1番上
function moveTop(obj1) {
	//ボタンの親ノードをたどる
	var line1 = obj1.parentNode.parentNode.parentNode.parentNode.parentNode;

	//　親ノードのIDを取得し、1つ前に移動
	b = document.getElementById('career_list_title');
	a = line1.id;
	$("#" + a).insertAfter(b);

}
//1つ上
function moveUp(obj1) {
	var line1 = obj1.parentNode.parentNode.parentNode.parentNode.parentNode;
	// 一番上の行のときは終了する
	before = line1.previousElementSibling
	if(before.classList.contains('career_list_itms_area') == false) {
	  alert("１番上の行です");
	  return;
	}
	//　行のIDを取得し移動
	a = line1.id;
	$("#" + a).insertBefore(line1.previousElementSibling);

}

//1番下
function moveBottom(obj1) {
	//移動したい要素
	var line1 = obj1.parentNode.parentNode.parentNode.parentNode.parentNode;

	//次の要素
	var next = line1.nextElementSibling
	while(next != null){
		last = next
		next = last.nextElementSibling
			
	}
	//　移動したい要素のIDを取得し、1番下に移動
	a = line1.id;
	$("#" + a).insertAfter(last);

}
//1つ下
function moveDown(obj1) {
	var line1 = obj1.parentNode.parentNode.parentNode.parentNode.parentNode;
	// 一番下の行のときは終了する
	if(line1.nextElementSibling === null) {
	  alert("１番下の行です");
	  return;
	}
	//　行のIDを取得し移動
	a = line1.id;
	$("#" + a).insertAfter(line1.nextElementSibling);
}




//編集押下時のスキルリスト追加
function skillFormList(idnumber,btName,skilName,categoryNum){
	
	skillcount = param.length;
	areaName = "careerEdit"
	
	//追加する要素 DIV
	var new_div = document.createElement('div');

	new_div.className = 'career_skill_area_'+idnumber + ' career_skill_area_display';

		j=0;
		for(i=0;i<skillcount;i++){
			if(param[i]['career_id']==idnumber){
				if(param[i]['class_id']==categoryNum+1){


					j=j+1;
					//これから生成される要素のNo
					newSelectNo = j

					//SELECT　作成
					var selectElem = document.createElement('select');
					selectElem.id = 'career_edit_'+skilName+'_'+idnumber+'_select_'+newSelectNo;
					selectElem.name = "edit_"+skilName+"[0][skillName"+newSelectNo+"]"
					if(i == 2) {
						selectElem.className = 'career_skil_name_select career_skil_name_select_middle career_search_'+skilName+'_'+idnumber;
					}else {
						selectElem.className = 'career_skil_name_select career_search_'+skilName+'_'+idnumber;
					}

					//SELECT　追加
					new_div_in_select = new_div.appendChild(selectElem);

					//SELECTコピー元取得　SELECT内のoptionを使用するため
					var copyNodeBase = document.getElementById("edit_"+skilName+"_select_1");
					//option セット
					optionSet(copyNodeBase,new_div_in_select,newSelectNo,skilName,areaName);

					if(j%3==0){
						//追加する場所指定
						career_list_itms_element = document.getElementById("career_edit_"+skilName+"_"+idnumber);
						career_list_itms_element.before(new_div)

						//追加したSELECTに検索ボックス追加
						$('#'+btName+'_td_'+idnumber).find(".career_skil_name_select").select2({
							width: '100%',
						});
						var new_div = '';
						var new_div = document.createElement('div');
						new_div.className = '';
						new_div.className = 'career_skill_area_'+idnumber + ' career_skill_area_display';
					}
					
				}
			}
		}


		if(j==0){
			for(k=0;k<2;k++){
				var new_div = document.createElement('div');
				new_div.className = 'career_skill_area_'+idnumber + ' career_skill_area_display';
				for(l=1;l<=3;l++){
					//これから生成される要素のNo
					j =  j + 1

					//SELECT　作成
					var selectElem = document.createElement('select');
					selectElem.id = 'career_edit_'+skilName+'_'+idnumber+'_select_'+j;
					selectElem.name = "edit_"+skilName+"[0][skillName"+j+"]"
					if(i == 2) {
						selectElem.className = 'career_skil_name_select career_skil_name_select_middle career_search_'+skilName+'_'+idnumber;
					}else {
						selectElem.className = 'career_skil_name_select career_search_'+skilName+'_'+idnumber;
					}

					//SELECT　追加
					new_div_in_select = new_div.appendChild(selectElem);

					//SELECTコピー元取得　SELECT内のoptionを使用するため
					var copyNodeBase = document.getElementById("edit_"+skilName+"_select_1");
					//option セット
					optionSet(copyNodeBase,new_div_in_select,j,skilName,areaName);
				}
				career_list_itms_element = document.getElementById("career_edit_"+skilName+"_"+idnumber);
				career_list_itms_element.before(new_div)

				//追加したSELECTに検索ボックス追加
				$('#'+btName+'_td_'+idnumber).find(".career_skil_name_select").select2({
					width: '100%',
				});

			}
		}else if(j<6){
			j=j+1;
			for(l=j;l<=6;l++){
				//これから生成される要素のNo
				newSelectNo =  newSelectNo + 1

				//SELECT　作成
				var selectElem = document.createElement('select');
				selectElem.id = 'career_edit_'+skilName+'_'+idnumber+'_select_'+newSelectNo;
				selectElem.name = "edit_"+skilName+"[0][skillName"+newSelectNo+"]"
				if(i == 2) {
					selectElem.className = 'career_skil_name_select career_skil_name_select_middle career_search_'+skilName+'_'+idnumber;
				}else {
					selectElem.className = 'career_skil_name_select career_search_'+skilName+'_'+idnumber;
				}

				//SELECT　追加
				new_div_in_select = new_div.appendChild(selectElem);

				//SELECTコピー元取得　SELECT内のoptionを使用するため
				var copyNodeBase = document.getElementById("edit_"+skilName+"_select_1");
				//option セット
				optionSet(copyNodeBase,new_div_in_select,newSelectNo,skilName,areaName);

				if(l%3==0){
					//追加する場所指定
					career_list_itms_element = document.getElementById("career_edit_"+skilName+"_"+idnumber);
					career_list_itms_element.before(new_div)

					//追加したSELECTに検索ボックス追加
					$('#'+btName+'_td_'+idnumber).find(".career_skil_name_select").select2({
						width: '100%',
					});
					var new_div = '';
					var new_div = document.createElement('div');
					new_div.className = '';
					new_div.className = 'career_skill_area_'+idnumber + ' career_skill_area_display';
				}
			}
		}else if(j>6){
			
			if(j%3!=0){
				k = 3-(j % 3);
				for(l=1;l<=k;l++){
					//これから生成される要素のNo
					newSelectNo =  j + l

					//SELECT　作成
					var selectElem = document.createElement('select');
					selectElem.id = 'career_edit_'+skilName+'_'+idnumber+'_select_'+newSelectNo;
					selectElem.name = "edit_"+skilName+"[0][skillName"+newSelectNo+"]"
					if(i == 2) {
						selectElem.className = 'career_skil_name_select career_skil_name_select_middle career_search_'+skilName+'_'+idnumber;
					}else {
						selectElem.className = 'career_skil_name_select career_search_'+skilName+'_'+idnumber;
					}

					//SELECT　追加
					new_div_in_select = new_div.appendChild(selectElem);

					//SELECTコピー元取得　SELECT内のoptionを使用するため
					var copyNodeBase = document.getElementById("edit_"+skilName+"_select_1");
					//option セット
					optionSet(copyNodeBase,new_div_in_select,newSelectNo,skilName,areaName);
				}
				career_list_itms_element = document.getElementById("career_edit_"+skilName+"_"+idnumber);
				career_list_itms_element.before(new_div)

				//追加したSELECTに検索ボックス追加
				$('#'+btName+'_td_'+idnumber).find(".career_skil_name_select").select2({
					width: '100%',
				});

			}
		}
}

//レビューエリア
$('#review-button').on('click', function (){

	let label = $('#review-label').text();
	let container = $('#review-container');
	let radio = $('input[name="judge"]');
	let textarea = $('.review-message-area');

	//レビューエリアの表示・非表示
	if(label == "レビュー"){
		$('#review-label').text("閉じる");
		container.css('display', 'block');
	}else {
		$('#review-label').text("レビュー");
		container.css('display', 'none');
	}

	//テキストボックスの表示・非表示
	radio.click(function () {
		if(radio.prop('checked')){
			textarea.css('display', 'none');
		}else {
			textarea.css('display', 'block');
		}
	});
});

//レビュー送信
$('#judge-button').on('click', function (){
	let editors = $('#judge-button').val();
	let editor = editors.split(',');
	let judge = $('input[name="judge"]:checked').val();
	let review_message = $('textarea[name="review-message"]').val();

	//チェック
	if(judge === undefined) {
		alert('"承認" か "差し戻し" を選択してください');
		return false;
	}else if(review_message == "" && judge == "send-back") {
		alert('修正文を記入してください');
		return false;
	}

	//チェックが通った時
	if(judge == "approved"){
		message = '承認通知を Slack で送りますか？';
		//url = "/slack_review";
		review_message = "";
	}else {
		message = '差し戻し通知を送りますか？';
		//url = "/mail_review";
	}

	if(!window.confirm(message)){
		return false;
	}

	resumeLoadingFunc();

	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: '/review',
		method: 'POST',
		data: {
			'lastname': editor[0],
			'firstname': editor[1],
			'user_id': editor[2],
			'login_id': editor[3],
			'judge': judge,
			'message': review_message,
			'guest_flg': editor[4],
			'user_guest_flg': editor[5]
		},
	})
	.done(function () {
		alert("通知が完了しました");
		$('#loader-bg').delay(500).fadeOut(350);
		$('#loader').delay(200).fadeOut(150);
		location.href = "/unapproved-resume-list";
	})
	.fail(function () {
		alert("通知が失敗しました");
		$('#loader-bg').delay(500).fadeOut(350);
		$('#loader').delay(200).fadeOut(150);
	});
});

