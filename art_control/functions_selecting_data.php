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
    global $rowto_login_page;


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

    $SQLto_login_page = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'to_login_page'";
	$rowto_login_page = mysqli_fetch_assoc(mysqli_query($db, $SQLto_login_page));
}

function SelectTranslationForLogin($lang)
{
    global $db;
    global $rowartlipat;
    global $rowlogin;
    global $rowpassword;
    global $rowenter;
    global $rowto_new_registration;

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
 
}


$result_cases_to_work;
function SelectAllCasesToWorkOn($x) //вызывается из function ShowFirstPage(), расположенной в function_for_page_view_on_index.php
{
	global $db;
    global $result_cases_to_work;
    //print "SESSION['useraccountid']=".$_SESSION['useraccountid'];
    $account_id = $_SESSION['useraccountid'];

    if ($x==1){
    $SQL = "SELECT * FROM task_cases tc 
        JOIN cases c2 ON c2.id_case = tc.case_id 
        JOIN employees e2 ON e2.id_employee = tc.task_responsible_id 
        JOIN tasks t2 ON t2.id_task = tc.task_id 
        LEFT JOIN whats w2 ON w2.id_what = tc.what_id 
        WHERE tc.task_status = 1 AND c2.not_closed_case =1 AND tc.not_deleted_task = 1 AND e2.account_id = ".$account_id." AND tc.task_start_term <= CURRENT_DATE()
        ORDER BY tc.task_end_term";
    //print "<br>".$SQL."<br>";
    }
    if ($x==2){
    $SQL = "SELECT * FROM task_cases tc 
        JOIN cases c2 ON c2.id_case = tc.case_id 
        JOIN employees e2 ON e2.id_employee = tc.task_responsible_id 
        JOIN tasks t2 ON t2.id_task = tc.task_id 
        LEFT JOIN whats w2 ON w2.id_what = tc.what_id    
        WHERE tc.task_status = 1 AND c2.not_closed_case =1 AND tc.not_deleted_task = 1 AND e2.account_id = ".$account_id." AND tc.task_start_term > CURRENT_DATE()
        ORDER BY tc.task_end_term";
    //print "<br>".$SQL."<br>";
    }

    if (!$result_cases_to_work = mysqli_query($db, $SQL)) 
    {        
        printf("Ошибка в запросе на дела к работе: %s\n", mysqli_error($db));
    }	
}	

function SelectCasesToWorkOnForPerson($person_id, $x) //вызывается из function ShowTabsContent(), расположенной здесь же
{
	global $db;
    global $result_cases_to_work_person;
    $account_id = $_SESSION['useraccountid'];
    
    if ($x==1){
        $SQL = "SELECT * FROM task_cases tc 
            JOIN cases c2 ON c2.id_case = tc.case_id 
            JOIN employees e2 ON e2.id_employee = tc.task_responsible_id 
            JOIN tasks t2 ON t2.id_task = tc.task_id 
            LEFT JOIN whats w2 ON w2.id_what = tc.what_id 
            WHERE tc.task_status = 1 AND c2.not_closed_case =1 AND tc.not_deleted_task = 1 AND e2.account_id = ".$account_id." AND 
                e2.id_employee =".$person_id." AND 
                tc.task_start_term <= CURRENT_DATE()
            ORDER BY tc.task_end_term";
        //print "<br>".$SQL."<br>";
        }
    else if ($x==2){
        $SQL = "SELECT * FROM task_cases tc 
            JOIN cases c2 ON c2.id_case = tc.case_id 
            JOIN employees e2 ON e2.id_employee = tc.task_responsible_id 
            JOIN tasks t2 ON t2.id_task = tc.task_id 
            LEFT JOIN whats w2 ON w2.id_what = tc.what_id
            WHERE tc.task_status = 1 AND c2.not_closed_case =1 AND tc.not_deleted_task = 1 AND e2.account_id = ".$account_id." AND 
                e2.id_employee =".$person_id." AND 
                tc.task_start_term > CURRENT_DATE()
            ORDER BY tc.task_end_term";
        //print "<br>".$SQL."<br>";
        }

	if (!$result_cases_to_work_person = mysqli_query($db, $SQL)) 
    {        
        printf("Ошибка в запросе на персональные дела к работе: %s\n", mysqli_error($db));
    }	
}	

function SelectAllCompanyCases()
{
    global $db;
    global $result_cases;

    $account_id = $_SESSION['useraccountid'];
    $SQL = 
        "SELECT c.id_case, c.our_case_ref, c.client_case_ref, c.pto_case_ref, c.not_closed_case   
        FROM cases c 
        JOIN employees e2 ON e2.id_employee = c.registrant_id
        WHERE e2.account_id=$account_id";
    //print $SQL;

    if (!$result_cases = mysqli_query($db, $SQL)) 
    {        
        printf("Ошибка в запросе на дела: %s\n", mysqli_error($db));
    }    

}

    function PrepareIndependentListsForChoice() // вызывается в файле page_for_new_case.php  и page_for_case_card и page_for_case_task
{
    global $db;
    global $result_ipsubjects; 
    global $result_jurisdictions; 
    global $result_tasks;
    global $result_whats;
    
    $SQL = "SELECT * FROM  ipsubjects";
    if (!$result_ipsubjects = mysqli_query($db, $SQL)) 
    {
        printf("Ошибка в запросе: %s\n", mysqli_error($db));
    }

    $SQL = "SELECT * FROM  jurisdictions";
    if (!$result_jurisdictions = mysqli_query($db, $SQL)) 
    {
        printf("Ошибка в запросе: %s\n", mysqli_error($db));
    }  
    
    $SQL = "SELECT * FROM  tasks";
    if (!$result_tasks = mysqli_query($db, $SQL)) 
    {
        printf("Ошибка в запросе: %s\n", mysqli_error($db));
    }

    $SQL = "SELECT * FROM  whats WHERE id_what !=1";
    if (!$result_whats = mysqli_query($db, $SQL)) 
    {
        printf("Ошибка в запросе: %s\n", mysqli_error($db));
    }
}

function SelectDataOnCaseId($case_id) // вызывается в файле  page_for_case_card
{
    global $db;    
    global $row_casedata;   
    
    $SQL = 
        "SELECT *
        FROM cases c2 
        LEFT JOIN ipsubjects is2 
        ON c2.ipsubject_id = is2.id_ipsubject 
        LEFT JOIN jurisdictions j2 
        ON c2.jurisdiction_id = j2.id_jurisdiction 
        JOIN employees e2 
        ON e2.id_employee = c2.registrant_id 
        WHERE c2.id_case =$case_id";

       // print $SQL;

        if (!$result_casedata = mysqli_query($db, $SQL)) 
        {
            printf("Ошибка в запросе: %s\n", mysqli_error($db));
        }
        $row_casedata = mysqli_fetch_assoc($result_casedata);

        //printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result8));
        //print_r ($row_casedata);      
        
}

function SelectDataOnAccountId() // вызывается в файле page_for_case_card
{

    global $db;    
    global $result_nicks;  
    global $result_emplosold; 

    // получаем список ников в данном аккаунте в $result_nicks 
    $account_id = $_SESSION['useraccountid'];
    $SQL = "SELECT our_case_ref
            FROM cases ca 
            LEFT JOIN employees em 
            ON ca.registrant_id = em.id_employee 
            LEFT JOIN accounts ac 
            ON em.account_id = ac.id_account
            WHERE account_id = $account_id
            "; 
    //print "<br>SQL=".$SQL."<br>";
    if (!$result_nicks = mysqli_query($db, $SQL)) //6
    {
        printf("Ошибка в запросе на ники: %s\n", mysqli_error($db));
    }


    // получаем список сотрудников в данном аккаунте
    $SQL9 = "SELECT * FROM  employees 
    WHERE account_id = $account_id AND not_deleted_item = 1"; 
    //print "<br>SQL9=".$SQL9."<br>";
    if (!$result_emplosold = mysqli_query($db, $SQL9)) 
    {
        printf("Ошибка в запросе на сотрудников: %s\n", mysqli_error($db));
    }
}

function SelectCasenicksOnAccountId() // вызывается в файле page_for_case_card
{
    global $db;    
    global $result_nicks; 

    // получаем список ников в данном аккаунте в $result_nicks 
    $account_id = $_SESSION['useraccountid'];
    $SQL = "SELECT our_case_ref
            FROM cases ca 
            LEFT JOIN employees em 
            ON ca.registrant_id = em.id_employee 
            LEFT JOIN accounts ac 
            ON em.account_id = ac.id_account
            WHERE account_id = $account_id
            "; 
    //print "<br>SQL=".$SQL."<br>";
    if (!$result_nicks = mysqli_query($db, $SQL)) //6
    {
        printf("Ошибка в запросе на ники: %s\n", mysqli_error($db));
    }
}

$result_emplos; 
function SelectEmployeesOnAccountId() // вызывается в файле page_for_case_card
{
    global $db;   
    global $result_emplos;     

    // получаем список сотрудников в данном аккаунте
    $account_id = $_SESSION['useraccountid'];
    $SQL = "SELECT * FROM  employees 
    WHERE account_id = $account_id AND not_deleted_item = 1"; 
    //print "<br>SQL=".$SQL."<br>";
    if (!$result_emplos = mysqli_query($db, $SQL)) 
    {
        printf("Ошибка в запросе на сотрудников: %s\n", mysqli_error($db));
    }    
}


function SelectAllTaskOnCaseId($case_id) // вызывается в файле  page_for_case_card
{
    global $db;    
    global $result_casetask; 

    $SQL = 
        "SELECT * , DATE_FORMAT(task_start_term, '%d.%m.%Y') as task_start_term_formatted
        FROM task_cases atc 
        JOIN tasks t2 ON t2.id_task = atc.task_id 
        JOIN employees e2 ON e2.id_employee = atc.task_responsible_id 
        LEFT JOIN whats w2 ON w2.id_what = atc.what_id
        WHERE atc.case_id = $case_id AND atc.not_deleted_task=1";

        //print $SQL;

        if (!$result_casetask = mysqli_query($db, $SQL)) 
        {
            printf("Ошибка в запросе: %s\n", mysqli_error($db));
        }
        
        //printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result_casetask));            
        
}

function SelectThisTaskOnCase($task_case_id) // вызывается в файле  page_for_case_task
{
    global $db;    
    global $row_casetask; 

    $SQL = 
        "SELECT *
        FROM task_cases atc 
        JOIN tasks t2 ON t2.id_task = atc.task_id 
        LEFT JOIN whats w2 ON w2.id_what = atc.what_id
        JOIN employees e2 ON e2.id_employee = atc.task_responsible_id 
        JOIN employees e3 ON e3.id_employee = atc.recorder_id 
        WHERE atc.id_task_case =$task_case_id";

        //print $SQL;

    if (!$result_task = mysqli_query($db, $SQL)) 
    {
        printf("Ошибка в запросе: %s\n", mysqli_error($db));
    }        
    //printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result_task));          
    $row_casetask = mysqli_fetch_assoc($result_task);        
    //print_r ($row_casetask);  
}
