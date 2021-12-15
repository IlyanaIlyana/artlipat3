// Модуль lib


import * as calculate from './artlip_calculate.js';

export function ChangeRegistrationLanguage()
{
	console.log("добрались до ChangeRegistrationLanguage"); 
	
	jQuery('#ru').change(function(){
		var query = 'lang=' + $(this).val();
		localStorage.lang = this.getAttribute('lang');		
		window.location.search = query;
	});	

	jQuery('#en').change(function(){
		var query = 'lang=' + $(this).val();
		localStorage.lang = this.getAttribute('lang');		
		window.location.search = query;
	});	

	$(window).load(function(){ 
		var lang = localStorage.lang || 'en';
		//console.log("lang:", lang);
		$('input[lang="'+lang+'"]').parent().siblings().removeClass("active");
		$('input[lang="'+lang+'"]').parent().addClass('active');
	});		
}

export function RegistrationOpened()
{
	var sumBl = 0;  
	
	$("#buttonSubmit").prop( "disabled", true ); 

	console.log("добрались до RegistrationOpened"); 
	$("#control_data2").keyup(function() {
	 
	    sumBl +=1;	  
	    console.log(sumBl);
	 	  
	    if (sumBl == 4){
			$("#buttonSubmit" ).prop( "disabled", false );			
		}								
	});
}

export function SearchRefNumber()
{ 		
	$("#searchtag").keyup(function()
		{
			let searchtag = $("#searchtag").val();
				console.log("searchtag словили из html по клику=", searchtag);
			$.ajax({
				type: 'POST',
				/* url:'search_case_name.php', */
				url:'../art_ajax/search_case_name.php',
				data: {mPsearchtag:searchtag},
				dataType: "json",
				success:function(data){
						console.log(data);
					$('#searchresult').empty();	
					data.forEach(function(item) {
							console.log("item=", item);
							console.log("item.id_case=", item.id_case);
						if (item.not_closed_case==1){
							console.log("not_closed_case==1");	
						$('#searchresult').append("<tr><td><a href='page_for_case_card.php?sent_case_id=" + item.id_case + "'>"
						+ item.our_case_ref+"</a></td><td><a href='page_for_case_card.php?sent_case_id="
						+ item.id_case+"'>" + item.client_case_ref + "</a></td><td><a href='page_for_case_card.php?sent_case_id="
						+ item.id_case+"'>" + item.pto_case_ref + "</a></td></tr>");}
						else{	
							$('#searchresult').append("<tr class='danger'><td><a href='page_for_case_card.php?sent_case_id=" + item.id_case + "'>"
							+ item.our_case_ref+"</a></td><td><a href='page_for_case_card.php?sent_case_id="
							+ item.id_case+"'>" + item.client_case_ref + "</a></td><td><a href='page_for_case_card.php?sent_case_id="
							+ item.id_case+"'>" + item.pto_case_ref + "</a></td></tr>");}
					});		 				 
				 
				},
				error: function (e) {
					console.log(e);
				}
			});			
		})	
}


export function ShowWhats()
{
	$("#taskid").change(function(){	
		let taskid = $("#taskid").val();
			console.log("taskid словили=", taskid);
			if (taskid == 21 || taskid == 26 || taskid == 41 || taskid == 45
			){ $("#whats" ).attr("style", "display:" );}
			else { $("#whats" ).attr("style", "display:none" );}
	});	
}

export function TheSameDate()
{
	$("#date1").change(function(){		
		let date1 = $("#date1").val();
			console.log("date1 словили=", date1);
		$("input[name='end_term']").val(date1);
	});	
}


export function DateCalculation()
{ 

// ------ловим дату  и рассчитываем сроки  для вывода в input нацподача domestic_filing_date
	$("#domestic_filing_date").change(function(){		
		let filing_date = $("#domestic_filing_date").val();
			console.log("domestic_filing_date словили=", filing_date);

		let date = new Date(filing_date); //организовали формат даты
			console.log("domestic_filing_date в формате даты=", date);

		calculate.addMonths (date,4);	//вызываем функцию с датой и числом				
			console.log("добавили месяцы =", date);		
			console.log("в нужном формате =", date.toISOString().slice(0,10));
		$("input[name='translation_term']").val(date.toISOString().slice(0,10));

		date = new Date(filing_date); //организовали формат даты
		calculate.addMonths (date, 12);	//вызываем функцию с датой и числом							
		$("input[name='convention_term']").val(date.toISOString().slice(0,10));

		date = new Date(filing_date); //организовали формат даты
		calculate.addMonths (date, 36);	//вызываем функцию с датой и числом							
		$("input[name='examination_term']").val(date.toISOString().slice(0,10));

		date = new Date(filing_date); //организовали формат даты
		calculate.addMonths (date, 24);	//вызываем функцию с датой и числом							
		$("input[name='first_annuity_term']").val(date.toISOString().slice(0,10));
	});	

// ------ловим дату  и рассчитываем сроки  для вывода в input конвенц подача convention
	$("#priority_date_for_convention").change(function(){		
		let filing_date = $("#priority_date_for_convention").val();
			console.log("priority_date_for_convention словили=", filing_date);

		let date = new Date(filing_date); //организовали формат даты
			console.log("priority_date_for_convention в формате даты=", date);

		calculate.addMonths (date, 12);	//вызываем функцию с датой и числом							
		$("input[name='convention_term_calculated']").val(date.toISOString().slice(0,10));
	});	

	// ------ловим дату  и рассчитываем сроки  для вывода в input международная
	$("#priority_date_pct").change(function(){		
		let priority_date_pct = $("#priority_date_pct").val();
			console.log("priority_date_pct словили=", priority_date_pct);

		let date = new Date(priority_date_pct); //организовали формат даты
		calculate.addMonths (date,31);	//вызываем функцию с датой и числом	
		$("input[name='national_phase_date_calculated']").val(date.toISOString().slice(0,10));

		date = new Date(priority_date_pct); //организовали формат даты
		calculate.addMonths (date,32);	//вызываем функцию с датой и числом	
		$("input[name='pct_amendements_term']").val(date.toISOString().slice(0,10));

		date = new Date(priority_date_pct); //организовали формат даты
		calculate.addMonths (date,35);	//вызываем функцию с датой и числом	
		$("input[name='pct_translation_term']").val(date.toISOString().slice(0,10));
	});	

	$("#pct_filing_date").change(function(){		
		let pct_filing_date = $("#pct_filing_date").val();
			console.log("pct_filing_date словили=", pct_filing_date);

		let date = new Date(pct_filing_date); //организовали формат даты
		calculate.addMonths (date,36);	//вызываем функцию с датой и числом	
		$("input[name='pct_examination_term']").val(date.toISOString().slice(0,10));

		date = new Date(pct_filing_date); //организовали формат даты
		calculate.addMonths (date,24);	//вызываем функцию с датой и числом	
		$("input[name='pct_annuity_term']").val(date.toISOString().slice(0,10));
	});	
	
// ------ловим дату  и рассчитываем сроки  для вывода в input экспертиза
	$("#oa_date").change(function(){		
		let oa_date = $("#oa_date").val();
			console.log("oa_date словили=", oa_date);
			
		let date = new Date(oa_date); //организовали формат даты
		calculate.addMonths (date, 2);	//вызываем функцию с датой и числом	
		$("input[name='due_date_response2']").val(date.toISOString().slice(0,10));

		date = new Date(oa_date); //организовали формат даты
		calculate.addMonths (date, 3);	//вызываем функцию с датой и числом	
		$("input[name='due_date_response3']").val(date.toISOString().slice(0,10));

		date = new Date(oa_date); //организовали формат даты
		calculate.addMonths (date, 4);	//вызываем функцию с датой и числом	
		$("input[name='due_date_response4']").val(date.toISOString().slice(0,10));
		

		date = new Date(oa_date); //организовали формат даты
		calculate.addMonths (date, 6);	//вызываем функцию с датой и числом	
		$("input[name='due_date_response6']").val(date.toISOString().slice(0,10));

		
		date = new Date(oa_date); //организовали формат даты
		calculate.addMonths (date, 13);	//вызываем функцию с датой и числом	
		$("input[name='final_due_date_response']").val(date.toISOString().slice(0,10));
		
	});	

// ------ловим дату  и рассчитываем сроки  для вывода в input решение
	$("#decision_date").change(function(){		
		let decision_date = $("#decision_date").val();
			console.log("decision_date словили=", decision_date);
			
		let date = new Date(decision_date); //организовали формат даты
		calculate.addMonths (date, 4);	//вызываем функцию с датой и числом	
		$("input[name='appeal_date']").val(date.toISOString().slice(0,10));

		date = new Date(decision_date); //организовали формат даты
		calculate.addMonths (date, 7);	//вызываем функцию с датой и числом	
		$("input[name='complain_date']").val(date.toISOString().slice(0,10));

		$("input[name='empty_date']").val(decision_date);
		
	});	

	// ------ловим дату  и рассчитываем сроки  для вывода в input пошлины
	$("#fee_duty_desision_date").change(function(){		
		let fee_duty_desision_date = $("#fee_duty_desision_date").val();
			console.log("fee_duty_desision_date словили=", fee_duty_desision_date);

		let date = new Date(fee_duty_desision_date); //организовали формат даты

		calculate.addMonths (date,2);	//вызываем функцию с датой и числом	
		$("input[name='fee_duty_date_2']").val(date.toISOString().slice(0,10));

		date = new Date(fee_duty_desision_date); //организовали формат даты
		calculate.addMonths (date,4);	//вызываем функцию с датой и числом	
		$("input[name='fee_duty_date_4']").val(date.toISOString().slice(0,10));

		date = new Date(fee_duty_desision_date); //организовали формат даты
		calculate.addMonths (date, 6);	//вызываем функцию с датой и числом	
		$("input[name='fee_duty_date_6']").val(date.toISOString().slice(0,10));

		date = new Date(fee_duty_desision_date); //организовали формат даты
		calculate.addMonths (date, 12);	//вызываем функцию с датой и числом	
		$("input[name='fee_duty_date_12']").val(date.toISOString().slice(0,10));
				
	});	

	// ------ это возможно излишние манипуляции с выбором срока уплаты пошлины и радиокнопками	
	$('#fee_duty_date_2').click(function(){
		if ($(this).is(':checked')){
			$('#RU input:radio').prop('checked', true);
		} else {
			$('#RU input:radio').prop('checked', false);
		}
	});

	$('#group input:radio').click(function(){
		if ($(this).is(':checked')) {
			 $('#RU input:radio').prop('checked', false);
		}
	});

	// ------ловим дату  и рассчитываем сроки  для вывода в input годовые
	$("#start_patent_term").change(function(){		
		let start_patent_term = $("#start_patent_term").val();
			console.log("start_patent_term словили=", start_patent_term);
		let date = new Date(start_patent_term); //организовали формат даты

		calculate.addMonths (date,12);	//вызываем функцию с датой и числом	
		$("input[name='annuity_date']").val(date.toISOString().slice(0,10));
		
	});	
}

export function SelectTaskChosen()
{
$("#taskid_on_index").chosen({
	width: '100%',	
	/* no_results_text: 'Совпадений не найдено:',
	placeholder_text_single: 'Выберите задачу' */
});	

$("#taskid_on_case").chosen({
	width: '100%',	
});	
}

export function SelectCaseAuto()
{
$("#autocomplete").autocomplete({
	/* source: "http://artlipat3/search.php", */	
	/* source: "http://artlipat3/art_control/search_case_name_get.php", */	
	source: "../art_ajax/search_case_name_get.php",
	});
}

export function CheckBoxAjax()
{
	/* $("input:checkbox").change(function() {
		if($(this).is(":checked")) {
			$.ajax({
				url: 'check_box_on.php',
				type: 'POST',
				data:{action:'call_this'},
			});
		} else {
			$.ajax({
				url: 'check_box_on.php',
				type: 'POST',
				data:{action:'call_this2'},
			});
		}
	});	 */

	$("input.active").click(function() {
		// store the values from the checkbox box, then send via ajax below
		var check_active = $(this).is(':checked') ? 0 : 1;
		var check_id = $(this).attr('value');
		
		$(this).closest('td').next('td').css(
			'text-decoration',
			this.checked ? 'line-through' : 'none'
		);

		console.log("check_active=", check_active);
		console.log("check_id=", check_id);
		
			$.ajax({
				type: "POST",
				/* url: "http://artlipat3/art_ajax/check_box_on.php", */
				url: "../art_ajax/check_box_on.php",
				data: {id: check_id, active: check_active},
				/* success: function(){
					$('form#submit').hide(function(){$('div.success').fadeIn();});
		
				} */
				success: function(){
					console.log("дошли до конца");
				}
			});

			if (this.checked){
				$("#hidden_button").removeAttr('hidden');
			}

		return true;
	});
}
	
