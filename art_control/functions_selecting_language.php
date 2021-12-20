<?php

function SelectTranslationForRegistration($lang)
{
    global $db;
    global $rowartlipat;
    global $rowemail_prompt;
    global $rowpassword_prompt1;
    global $rowpassword_prompt2;
    global $rowconfirm_text;
    global $rowdeblock_text;
    global $rowyear_text;
    global $rowregister;
    global $rowto_login;

	global $rowspam_text;
	global $rowlogin;
	global $rownot_email_text;
	global $rowmismatch_text;
	global $rowto_login_page;
	global $rowlink_text;
	global $rowregister_text;
	global $rowto_login_go;
	global $rowlink;
	global $rowlogin_text;
	global $rowregistration_title;

	global $rowno_login;
	global $rowno_password;
	global $rowlogin_exists;
	
/* 
function SelectTranslationPagesFrame($lang){}
global $db;

объявление переменной в функции:
global $rowxxx;

текст-заместитель:
внутри php: ".$rowxxx['phrase_'.$lang]."
'.$rowxxx["phrase_".$lang].'
внутри html: <?php echo $rowxxx['phrase_'.$lang]?>

запрос:
$SQLxxx = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'xxx'";
$rowxxx = mysqli_fetch_assoc(mysqli_query($db, $SQLxxx)); 
}
*/
    $SQLartlipat = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'artlipat'";
	
	if (!$resultartlipat = mysqli_query($db, $SQLartlipat)) 
	{
		printf("Ошибка запроса к базе: %s\n", mysqli_error($db));
	} 

	if(mysqli_num_rows($resultartlipat) == 0) 
	{
		print "<br><p>Не получаю перевод</p>";		
	}
	$rowartlipat = mysqli_fetch_assoc($resultartlipat);

	$SQLemail_prompt = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'email_prompt'";
	$rowemail_prompt = mysqli_fetch_assoc(mysqli_query($db, $SQLemail_prompt));

	$SQLpassword_prompt1 = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'password_prompt1'";
	$rowpassword_prompt1 = mysqli_fetch_assoc(mysqli_query($db, $SQLpassword_prompt1));

	$SQLpassword_prompt2 = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'password_prompt2'";
	$rowpassword_prompt2 = mysqli_fetch_assoc(mysqli_query($db, $SQLpassword_prompt2));
    
    $SQLconfirm_text = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'confirm_text'";
	$rowconfirm_text = mysqli_fetch_assoc(mysqli_query($db, $SQLconfirm_text));
    
    $SQLdeblock_text = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'deblock_text'";
	$rowdeblock_text = mysqli_fetch_assoc(mysqli_query($db, $SQLdeblock_text));

    $SQLyear_text = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'year_text'";
	$rowyear_text = mysqli_fetch_assoc(mysqli_query($db, $SQLyear_text));

    $SQLregister = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'register'";
	$rowregister = mysqli_fetch_assoc(mysqli_query($db, $SQLregister));

    $SQLto_login = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'to_login'";
	$rowto_login = mysqli_fetch_assoc(mysqli_query($db, $SQLto_login));


	$SQLspam_text = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'spam_text'";
	$rowspam_text = mysqli_fetch_assoc(mysqli_query($db, $SQLspam_text));

	$SQLlogin = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'login'";
	$rowlogin = mysqli_fetch_assoc(mysqli_query($db, $SQLlogin));

    $SQLnot_email_text = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'not_email_text'";
	$rownot_email_text = mysqli_fetch_assoc(mysqli_query($db, $SQLnot_email_text));

    $SQLmismatch_text = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'mismatch_text'";
	$rowmismatch_text = mysqli_fetch_assoc(mysqli_query($db, $SQLmismatch_text));

	$SQLto_login_page = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'to_login_page'";
	$rowto_login_page = mysqli_fetch_assoc(mysqli_query($db, $SQLto_login_page));

	$SQLlink_text = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'link_text'";
	$rowlink_text = mysqli_fetch_assoc(mysqli_query($db, $SQLlink_text));

	$SQLregister_text = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'register_text'";
	$rowregister_text = mysqli_fetch_assoc(mysqli_query($db, $SQLregister_text));

	$SQLto_login_go = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'to_login_go'";
	$rowto_login_go = mysqli_fetch_assoc(mysqli_query($db, $SQLto_login_go));

	$SQLlink = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'link'";
	$rowlink = mysqli_fetch_assoc(mysqli_query($db, $SQLlink));

	$SQLlogin_text = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'login_text'";
	$rowlogin_text = mysqli_fetch_assoc(mysqli_query($db, $SQLlogin_text));

	$SQLregistration_title = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'registration_title'";
	$rowregistration_title = mysqli_fetch_assoc(mysqli_query($db, $SQLregistration_title));

	
	$SQLno_login = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'no_login'";
	$rowno_login = mysqli_fetch_assoc(mysqli_query($db, $SQLno_login));

	$SQLno_password = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'no_password'";
	$rowno_password = mysqli_fetch_assoc(mysqli_query($db, $SQLno_password));

	$SQLlogin_exists = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'login_exists'";
	$rowlogin_exists = mysqli_fetch_assoc(mysqli_query($db, $SQLlogin_exists));	

}

function SelectTranslationForLogin($lang)
{
    global $db;
    global $rowartlipat;
    global $rowlogin;
    global $rowpassword;
    global $rowenter;
    global $rowto_new_registration;

	global $rowaccess_denied;
	global $rowrepeat_login;
	global $rowpassword_recover;
	global $rowavailability;

	global $rowlogin_password;
	global $rownot_match;

    $SQLartlipat = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'artlipat'";
	
	if (!$resultartlipat = mysqli_query($db, $SQLartlipat)) 
	{
		printf("Ошибка запроса к базе: %s\n", mysqli_error($db));
	} 

	if(mysqli_num_rows($resultartlipat) == 0) 
	{
		print "<br><p>Не получаю перевод</p>";		
	}
	$rowartlipat = mysqli_fetch_assoc($resultartlipat);

	$SQLlogin = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'login'";
	$rowlogin = mysqli_fetch_assoc(mysqli_query($db, $SQLlogin));

	$SQLpassword = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'password'";
	$rowpassword = mysqli_fetch_assoc(mysqli_query($db, $SQLpassword));

	$SQLenter = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'enter'";
	$rowenter = mysqli_fetch_assoc(mysqli_query($db, $SQLenter));
    
    $SQLto_new_registration = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'to_new_registration'";
	$rowto_new_registration = mysqli_fetch_assoc(mysqli_query($db, $SQLto_new_registration));
 
	$SQLaccess_denied = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'access_denied'";
	$rowaccess_denied = mysqli_fetch_assoc(mysqli_query($db, $SQLaccess_denied)); 

	$SQLrepeat_login = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'repeat_login'";
	$rowrepeat_login = mysqli_fetch_assoc(mysqli_query($db, $SQLrepeat_login)); 

	$SQLpassword_recover = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'password_recover'";
    $rowpassword_recover = mysqli_fetch_assoc(mysqli_query($db, $SQLpassword_recover)); 

	$SQLavailability = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'availability'";
	$rowavailability = mysqli_fetch_assoc(mysqli_query($db, $SQLavailability)); 

	$SQLlogin_password = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'login_password'";
	$rowlogin_password = mysqli_fetch_assoc(mysqli_query($db, $SQLlogin_password));

	$SQLnot_match = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'not_match'";
	$rownot_match = mysqli_fetch_assoc(mysqli_query($db, $SQLnot_match)); 
}

function SelectTranslationRestoringPassword($lang)
{
    global $db;
    global $rowartlipat;


	global $rowenter_email;
	global $rowreg_email;
	global $rowsend_to_email;
	global $rowno_email_for_pass;
	global $rowno_login_for_pass;
	global $rowpassword_error_message;
	global $rowpassword_ref_sent;
	global $rowpassword_recover;
	global $rowpassword_ref;
	global $rowpass_link;
	global $rowconfirm_email;

	global $rowno_password_for_pass;
	global $rowpass_prompt_message;
	global $rowpass_change;
	global $rowpass_notice;
	global $rowlogin_notice;
	global $rowto_login_after_pass;
	global $rowhere;
	global $rowartlipat_2;
	global $rowpass_changed;
	global $rowpass_sent_to;
	global $rowto_login_after_pass_2;
	global $rowpasswords_mismatch_2;
	global $rownew_password;
	global $rowrepeat_new_password;
	global $rowremember_new_password;



    $SQLartlipat = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'artlipat'";
	
	if (!$resultartlipat = mysqli_query($db, $SQLartlipat)) 
	{
		printf("Ошибка запроса к базе: %s\n", mysqli_error($db));
	} 

	if(mysqli_num_rows($resultartlipat) == 0) 
	{
		print "<br><p>Не получаю перевод</p>";		
	}
	$rowartlipat = mysqli_fetch_assoc($resultartlipat);


$SQLenter_email = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'enter_email'";
$rowenter_email = mysqli_fetch_assoc(mysqli_query($db, $SQLenter_email)); 

$SQLreg_email = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'reg_email'";
$rowreg_email = mysqli_fetch_assoc(mysqli_query($db, $SQLreg_email));

$SQLsend_to_email = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'send_to_email'";
$rowsend_to_email = mysqli_fetch_assoc(mysqli_query($db, $SQLsend_to_email));

$SQLno_email_for_pass = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'no_email_for_pass'";
$rowno_email_for_pass = mysqli_fetch_assoc(mysqli_query($db, $SQLno_email_for_pass)); 

$SQLno_login_for_pass = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'no_login_for_pass'";
$rowno_login_for_pass = mysqli_fetch_assoc(mysqli_query($db, $SQLno_login_for_pass));

$SQLpassword_error_message = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'password_error_message'";
$rowpassword_error_message = mysqli_fetch_assoc(mysqli_query($db, $SQLpassword_error_message)); 

$SQLpassword_ref_sent = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'password_ref_sent'";
$rowpassword_ref_sent = mysqli_fetch_assoc(mysqli_query($db, $SQLpassword_ref_sent)); 

$SQLpassword_recover = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'password_recover'";
$rowpassword_recover = mysqli_fetch_assoc(mysqli_query($db, $SQLpassword_recover));

$SQLpassword_ref = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'password_ref'";
$rowpassword_ref = mysqli_fetch_assoc(mysqli_query($db, $SQLpassword_ref)); 

$SQLpass_link = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'pass_link'";
$rowpass_link = mysqli_fetch_assoc(mysqli_query($db, $SQLpass_link)); 

$SQLconfirm_email = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'confirm_email'";
$rowconfirm_email = mysqli_fetch_assoc(mysqli_query($db, $SQLconfirm_email)); 

$SQLno_password_for_pass = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'no_password_for_pass'";
$rowno_password_for_pass = mysqli_fetch_assoc(mysqli_query($db, $SQLno_password_for_pass)); 

$SQLpass_prompt_message = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'pass_prompt_message'";
$rowpass_prompt_message = mysqli_fetch_assoc(mysqli_query($db, $SQLpass_prompt_message)); 

$SQLpass_change = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'pass_change'";
$rowpass_change = mysqli_fetch_assoc(mysqli_query($db, $SQLpass_change));

$SQLpass_notice = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'pass_notice'";
$rowpass_notice = mysqli_fetch_assoc(mysqli_query($db, $SQLpass_notice)); 

$SQLlogin_notice = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'login_notice'";
$rowlogin_notice = mysqli_fetch_assoc(mysqli_query($db, $SQLlogin_notice)); 

$SQLto_login_after_pass = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'to_login_after_pass'";
$rowto_login_after_pass = mysqli_fetch_assoc(mysqli_query($db, $SQLto_login_after_pass));

$SQLhere = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'here'";
$rowhere = mysqli_fetch_assoc(mysqli_query($db, $SQLhere));

$SQLartlipat_2 = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'artlipat_2'";
$rowartlipat_2 = mysqli_fetch_assoc(mysqli_query($db, $SQLartlipat_2)); 

$SQLpass_changed = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'pass_changed'";
$rowpass_changed = mysqli_fetch_assoc(mysqli_query($db, $SQLpass_changed));

$SQLpass_sent_to = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'pass_sent_to'";
$rowpass_sent_to = mysqli_fetch_assoc(mysqli_query($db, $SQLpass_sent_to)); 

$SQLto_login_after_pass_2 = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'to_login_after_pass_2'";
$rowto_login_after_pass_2 = mysqli_fetch_assoc(mysqli_query($db, $SQLto_login_after_pass_2)); 

$SQLpasswords_mismatch_2 = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'passwords_mismatch_2'";
$rowpasswords_mismatch_2 = mysqli_fetch_assoc(mysqli_query($db, $SQLpasswords_mismatch_2));

$SQLnew_password = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'new_password'";
$rownew_password = mysqli_fetch_assoc(mysqli_query($db, $SQLnew_password));

$SQLrepeat_new_password = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'repeat_new_password'";
$rowrepeat_new_password = mysqli_fetch_assoc(mysqli_query($db, $SQLrepeat_new_password)); 

$SQLremember_new_password = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'remember_new_password'";
$rowremember_new_password = mysqli_fetch_assoc(mysqli_query($db, $SQLremember_new_password)); 
	
}

function SelectTranslationPagesFrame($lang)
{
    global $db;
    global $rowlog_out;
	global $rowsearch_case;
	global $rownew_case;
	global $rowteam;


    $SQLlog_out = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'log_out'";
	
	if (!$resultlog_out = mysqli_query($db, $SQLlog_out)) 
	{
		printf("Ошибка запроса к базе: %s\n", mysqli_error($db));
	} 

	if(mysqli_num_rows($resultlog_out) == 0) 
	{
		print "<br><p>Не получаю перевод</p>";		
	}
	$rowlog_out = mysqli_fetch_assoc($resultlog_out);

	$SQLsearch_case = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'search_case'";
	$rowsearch_case = mysqli_fetch_assoc(mysqli_query($db, $SQLsearch_case));

	$SQLnew_case = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'new_case'";
	$rownew_case = mysqli_fetch_assoc(mysqli_query($db, $SQLnew_case));

	$SQLteam = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'team'";
	$rowteam = mysqli_fetch_assoc(mysqli_query($db, $SQLteam)); 
	
}

function SelectTranslationPageMainContent($lang){

	global $db;
	global $rownew_task;
	global $rowcase_name;
	global $rowtask;
	global $rowwhat;
	global $rowchoose_what;
	global $rowresponsible;
	global $rowselect_responsible;
	global $rowrecord;
	global $rowmy_tasks;
	global $rowactulal_tasks;
	global $rowhide_completed;
	global $rowplanned;
	global $rowall_tasks;
	global $rownew;

	global $rowcase_card;
	global $rowcase_data;
	global $rowip_subject;
	global $rowwhere;
	global $rowour_ref;
	global $rowclient_ref;
	global $rowpatent_office_ref;
	global $rowcase_closed;
	global $rowstart;
	global $rowend;

	global $rowcase_det_card;
	global $rowhome;
	global $rowsave_amendment;
	global $rowcase_closing;
	global $rowclose_case;
	global $rowrevive_case;
	global $rowcheck_ref;
	global $rowtype_ref;

	global $rowedit_task_card;
	global $rowtask_data;
	global $rowcase;
	global $rowcreated_by;
	global $rowcreated_on;
	global $rowdelete_task;

	global $rowcases;
	global $rowsearch;
	global $rowsearched;

	global $rowselect;
	global $rownew_case;
	global $rownew_case_button;

	global $rowteam;
	global $rowlist_of_persons;
	global $rowadd_new_person;
	global $rowperson_name;
	global $rowphoto_in_profile;
	global $rowchange_company_name;
	global $rowname_first_part;
	global $rowname_second_part;
	global $rownew_name_text;

	global $rowperson_name;
	global $rowperson_login;
	global $rowperson_level;
    global $rowperson_photo;
    global $rowperson_status; 

	global $rowgeneral_person_info;
	global $rowreg_gate;
	global $rowassess_data;

	global $rowperson_password;
	global $rowassign_person_login;
	global $rowassign_person_password;
	global $rowyour;
	global $rowlevel_persistent;
	global $rowchange_assess_data;
	global $rowto_home;
	global $rowinfo_on_assess_data;
	global $rowlevel_10;
	global $rowlevel_9;
	global $rowlevel_1;
	global $rowlevel_0;

/* 
global $rowxxx;
текст-заместитель:
внутри php: ".$rowxxx['phrase_'.$lang]."
внутри html: <?php echo $rowxxx['phrase_'.$lang]?>

$SQLxxx = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'xxx'";
$rowxxx = mysqli_fetch_assoc(mysqli_query($db, $SQLxxx)); */


$SQLnew_task = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'new_task'";
$rownew_task = mysqli_fetch_assoc(mysqli_query($db, $SQLnew_task)); 

$SQLcase_name = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'case_name'";
$rowcase_name = mysqli_fetch_assoc(mysqli_query($db, $SQLcase_name));

$SQLtask = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'task'";
$rowtask = mysqli_fetch_assoc(mysqli_query($db, $SQLtask));

$SQLwhat = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'what'";
$rowwhat = mysqli_fetch_assoc(mysqli_query($db, $SQLwhat));

$SQLchoose_what = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'choose_what'";
$rowchoose_what = mysqli_fetch_assoc(mysqli_query($db, $SQLchoose_what));

$SQLresponsible = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'responsible'";
$rowresponsible = mysqli_fetch_assoc(mysqli_query($db, $SQLresponsible));

$SQLselect_responsible = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'select_responsible'";
$rowselect_responsible = mysqli_fetch_assoc(mysqli_query($db, $SQLselect_responsible));

$SQLrecord = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'record'";
$rowrecord = mysqli_fetch_assoc(mysqli_query($db, $SQLrecord));

$SQLmy_tasks = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'my_tasks'";
$rowmy_tasks = mysqli_fetch_assoc(mysqli_query($db, $SQLmy_tasks));

$SQLactulal_tasks = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'actulal_tasks'";
$rowactulal_tasks = mysqli_fetch_assoc(mysqli_query($db, $SQLactulal_tasks));

$SQLhide_completed = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'hide_completed'";
$rowhide_completed = mysqli_fetch_assoc(mysqli_query($db, $SQLhide_completed));

$SQLplanned = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'planned'";
$rowplanned = mysqli_fetch_assoc(mysqli_query($db, $SQLplanned));

$SQLall_tasks = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'all_tasks'";
$rowall_tasks = mysqli_fetch_assoc(mysqli_query($db, $SQLall_tasks));

$SQLnew = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'new'";
$rownew = mysqli_fetch_assoc(mysqli_query($db, $SQLnew));

$SQLcase_card = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'case_card'";
$rowcase_card = mysqli_fetch_assoc(mysqli_query($db, $SQLcase_card));

$SQLcase_data = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'case_data'";
$rowcase_data = mysqli_fetch_assoc(mysqli_query($db, $SQLcase_data));

$SQLip_subject = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'ip_subject'";
$rowip_subject = mysqli_fetch_assoc(mysqli_query($db, $SQLip_subject));

$SQLwhere = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'where'";
$rowwhere = mysqli_fetch_assoc(mysqli_query($db, $SQLwhere));

$SQLour_ref = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'our_ref'";
$rowour_ref = mysqli_fetch_assoc(mysqli_query($db, $SQLour_ref));

$SQLclient_ref = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'client_ref'";
$rowclient_ref = mysqli_fetch_assoc(mysqli_query($db, $SQLclient_ref));

$SQLpatent_office_ref = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'patent_office_ref'";
$rowpatent_office_ref = mysqli_fetch_assoc(mysqli_query($db, $SQLpatent_office_ref));

$SQLcase_closed = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'case_closed'";
$rowcase_closed = mysqli_fetch_assoc(mysqli_query($db, $SQLcase_closed));

$SQLstart = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'start'";
$rowstart = mysqli_fetch_assoc(mysqli_query($db, $SQLstart));

$SQLend = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'end'";
$rowend = mysqli_fetch_assoc(mysqli_query($db, $SQLend));

$SQLcase_det_card = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'case_det_card'";
$rowcase_det_card = mysqli_fetch_assoc(mysqli_query($db, $SQLcase_det_card));

$SQLhome = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'home'";
$rowhome = mysqli_fetch_assoc(mysqli_query($db, $SQLhome));

$SQLsave_amendment = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'save_amendment'";
$rowsave_amendment = mysqli_fetch_assoc(mysqli_query($db, $SQLsave_amendment));

$SQLcase_closing = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'case_closing'";
$rowcase_closing = mysqli_fetch_assoc(mysqli_query($db, $SQLcase_closing));

$SQLclose_case = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'close_case'";
$rowclose_case = mysqli_fetch_assoc(mysqli_query($db, $SQLclose_case));

$SQLrevive_case = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'revive_case'";
$rowrevive_case = mysqli_fetch_assoc(mysqli_query($db, $SQLrevive_case));

$SQLcheck_ref = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'check_ref'";
$rowcheck_ref = mysqli_fetch_assoc(mysqli_query($db, $SQLcheck_ref));

$SQLtype_ref = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'type_ref'";
$rowtype_ref = mysqli_fetch_assoc(mysqli_query($db, $SQLtype_ref));

$SQLedit_task_card = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'edit_task_card'";
$rowedit_task_card = mysqli_fetch_assoc(mysqli_query($db, $SQLedit_task_card));

$SQLtask_data = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'task_data'";
$rowtask_data = mysqli_fetch_assoc(mysqli_query($db, $SQLtask_data));

$SQLcase = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'case'";
$rowcase = mysqli_fetch_assoc(mysqli_query($db, $SQLcase));

$SQLcreated_by = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'created_by'";
$rowcreated_by = mysqli_fetch_assoc(mysqli_query($db, $SQLcreated_by));

$SQLcreated_on = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'created_on'";
$rowcreated_on = mysqli_fetch_assoc(mysqli_query($db, $SQLcreated_on));

$SQLdelete_task = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'delete_task'";
$rowdelete_task = mysqli_fetch_assoc(mysqli_query($db, $SQLdelete_task));

$SQLcases = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'cases'";
$rowcases = mysqli_fetch_assoc(mysqli_query($db, $SQLcases));

$SQLsearch = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'search'";
$rowsearch = mysqli_fetch_assoc(mysqli_query($db, $SQLsearch));

$SQLsearched = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'searched'";
$rowsearched = mysqli_fetch_assoc(mysqli_query($db, $SQLsearched));

$SQLselect = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'select'";
$rowselect = mysqli_fetch_assoc(mysqli_query($db, $SQLselect));

$SQLnew_case = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'new_case'";
$rownew_case = mysqli_fetch_assoc(mysqli_query($db, $SQLnew_case));

$SQLnew_case_button = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'new_case_button'";
$rownew_case_button = mysqli_fetch_assoc(mysqli_query($db, $SQLnew_case_button));

$SQLteam = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'team'";
$rowteam = mysqli_fetch_assoc(mysqli_query($db, $SQLteam)); 

$SQLlist_of_persons = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'list_of_persons'";
$rowlist_of_persons = mysqli_fetch_assoc(mysqli_query($db, $SQLlist_of_persons));

$SQLadd_new_person = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'add_new_person'";
$rowadd_new_person = mysqli_fetch_assoc(mysqli_query($db, $SQLadd_new_person));

$SQLperson_name = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'person_name'";
$rowperson_name = mysqli_fetch_assoc(mysqli_query($db, $SQLperson_name));

$SQLphoto_in_profile = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'photo_in_profile'";
$rowphoto_in_profile = mysqli_fetch_assoc(mysqli_query($db, $SQLphoto_in_profile));

$SQLchange_company_name = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'change_company_name'";
$rowchange_company_name = mysqli_fetch_assoc(mysqli_query($db, $SQLchange_company_name));

$SQLname_first_part = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'name_first_part'";
$rowname_first_part = mysqli_fetch_assoc(mysqli_query($db, $SQLname_first_part));

$SQLname_second_part = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'name_second_part'";
$rowname_second_part = mysqli_fetch_assoc(mysqli_query($db, $SQLname_second_part));

$SQLnew_name_text = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'new_name_text'";
$rownew_name_text = mysqli_fetch_assoc(mysqli_query($db, $SQLnew_name_text)); 

$SQLperson_login = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'person_login'";
$rowperson_login = mysqli_fetch_assoc(mysqli_query($db, $SQLperson_login)); 
$SQLperson_level = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'person_level'";
$rowperson_level = mysqli_fetch_assoc(mysqli_query($db, $SQLperson_level)); 
$SQLperson_photo = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'person_photo'";
$rowperson_photo = mysqli_fetch_assoc(mysqli_query($db, $SQLperson_photo)); 
$SQLperson_status = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'person_status'";
$rowperson_status = mysqli_fetch_assoc(mysqli_query($db, $SQLperson_status)); 

$SQLgeneral_person_info = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'general_person_info'";
$rowgeneral_person_info = mysqli_fetch_assoc(mysqli_query($db, $SQLgeneral_person_info));

$SQLreg_gate = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'reg_gate'";
$rowreg_gate = mysqli_fetch_assoc(mysqli_query($db, $SQLreg_gate));

$SQLassess_data = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'assess_data'";
$rowassess_data = mysqli_fetch_assoc(mysqli_query($db, $SQLassess_data));
 
$SQLperson_password = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'person_password'";
$rowperson_password = mysqli_fetch_assoc(mysqli_query($db, $SQLperson_password));

$SQLassign_person_login = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'assign_person_login'";
$rowassign_person_login = mysqli_fetch_assoc(mysqli_query($db, $SQLassign_person_login));

$SQLassign_person_password = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'assign_person_password'";
$rowassign_person_password = mysqli_fetch_assoc(mysqli_query($db, $SQLassign_person_password));

$SQLyour = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'your'";
$rowyour = mysqli_fetch_assoc(mysqli_query($db, $SQLyour));

$SQLlevel_persistent = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'level_persistent'";
$rowlevel_persistent = mysqli_fetch_assoc(mysqli_query($db, $SQLlevel_persistent));

$SQLchange_assess_data = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'change_assess_data'";
$rowchange_assess_data = mysqli_fetch_assoc(mysqli_query($db, $SQLchange_assess_data));

$SQLto_home = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'to_home'";
$rowto_home = mysqli_fetch_assoc(mysqli_query($db, $SQLto_home));

$SQLinfo_on_assess_data = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'info_on_assess_data'";
$rowinfo_on_assess_data = mysqli_fetch_assoc(mysqli_query($db, $SQLinfo_on_assess_data));

$SQLlevel_10 = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'level_10'";
$rowlevel_10 = mysqli_fetch_assoc(mysqli_query($db, $SQLlevel_10));

$SQLlevel_9 = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'level_9'";
$rowlevel_9 = mysqli_fetch_assoc(mysqli_query($db, $SQLlevel_9));

$SQLlevel_1 = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'level_1'";
$rowlevel_1 = mysqli_fetch_assoc(mysqli_query($db, $SQLlevel_1));

$SQLlevel_0 = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'level_0'";
$rowlevel_0 = mysqli_fetch_assoc(mysqli_query($db, $SQLlevel_0));

}

