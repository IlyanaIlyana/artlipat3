<?php
/* 
function SelectTranslationPagesFrame($lang){}
global $db;

объявление переменной в функции:
global $rowxxx;

текст-заместитель:
внутри php: ".$rowxxx['phrase_'.$lang]."
внутри html: <?php echo $rowxxx['phrase_'.$lang]?>

запрос:
$SQLxxx = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'xxx'";
$rowxxx = mysqli_fetch_assoc(mysqli_query($db, $SQLxxx)); 
}
*/

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

}

