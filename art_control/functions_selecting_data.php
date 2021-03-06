<?php

$result_cases_to_work;
function SelectAllCasesToWorkOn($x) //вызывается из function ShowFirstPage(), расположенной в function_for_page_view_on_index.php
{
	$lang= 'en';
    global $db;
    global $result_cases_to_work;
    //print "SESSION['useraccountid']=".$_SESSION['useraccountid'];
    $account_id = $_SESSION['useraccountid'];

    if ($x==1){
    $SQL = "SELECT * FROM task_cases tc 
        JOIN cases c2 ON c2.id_case = tc.case_id 
        JOIN employees e2 ON e2.id_employee = tc.task_responsible_id 
        JOIN tasks_$lang t2 ON t2.id_task = tc.task_id 
        LEFT JOIN whats_$lang w2 ON w2.id_what = tc.what_id 
        WHERE tc.still_show_on_index = 1 AND c2.not_closed_case =1 AND tc.not_deleted_task = 1 AND e2.account_id = ".$account_id." AND tc.task_start_term <= CURRENT_DATE()
        ORDER BY tc.task_end_term";
    //print "<br>".$SQL."<br>";
    }
    if ($x==2){
    $SQL = "SELECT * FROM task_cases tc 
        JOIN cases c2 ON c2.id_case = tc.case_id 
        JOIN employees e2 ON e2.id_employee = tc.task_responsible_id 
        JOIN tasks_$lang t2 ON t2.id_task = tc.task_id 
        LEFT JOIN whats_$lang w2 ON w2.id_what = tc.what_id    
        WHERE tc.still_show_on_index = 1 AND c2.not_closed_case =1 AND tc.not_deleted_task = 1 AND e2.account_id = ".$account_id." AND tc.task_start_term > CURRENT_DATE()
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
	$lang= 'en';

    global $db;
    global $result_cases_to_work_person;
    $account_id = $_SESSION['useraccountid'];
    
    if ($x==1){
        $SQL = "SELECT * FROM task_cases tc 
            JOIN cases c2 ON c2.id_case = tc.case_id 
            JOIN employees e2 ON e2.id_employee = tc.task_responsible_id 
            JOIN tasks_$lang t2 ON t2.id_task = tc.task_id 
            LEFT JOIN whats_$lang w2 ON w2.id_what = tc.what_id 
            WHERE tc.still_show_on_index = 1 AND c2.not_closed_case =1 AND tc.not_deleted_task = 1 AND e2.account_id = ".$account_id." AND 
                e2.id_employee =".$person_id." AND 
                tc.task_start_term <= CURRENT_DATE()
            ORDER BY tc.task_end_term";
        //print "<br>".$SQL."<br>";
        }
    else if ($x==2){
        $SQL = "SELECT * FROM task_cases tc 
            JOIN cases c2 ON c2.id_case = tc.case_id 
            JOIN employees e2 ON e2.id_employee = tc.task_responsible_id 
            JOIN tasks_$lang t2 ON t2.id_task = tc.task_id 
            LEFT JOIN whats_$lang w2 ON w2.id_what = tc.what_id
            WHERE tc.still_show_on_index = 1 AND c2.not_closed_case =1 AND tc.not_deleted_task = 1 AND e2.account_id = ".$account_id." AND 
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


$result_ipsubjects; 
$result_jurisdictions; 
$result_tasks;
$result_whats;  
function PrepareIndependentListsForChoice() // вызывается в файле page_for_new_case.php  и page_for_case_card и page_for_case_task
{
    $lang= 'en';
    global $db;
    global $result_ipsubjects; 
    global $result_jurisdictions; 
    global $result_tasks;
    global $result_whats;
    
    $SQL = "SELECT * FROM  ipsubjects_$lang";
    if (!$result_ipsubjects = mysqli_query($db, $SQL)) 
    {
        printf("Ошибка в запросе: %s\n", mysqli_error($db));
    }

    $SQL = "SELECT * FROM  jurisdictions_$lang";
    if (!$result_jurisdictions = mysqli_query($db, $SQL)) 
    {
        printf("Ошибка в запросе: %s\n", mysqli_error($db));
    }  
    
    $SQL = "SELECT * FROM  tasks_$lang WHERE valid = 1";
    if (!$result_tasks = mysqli_query($db, $SQL)) 
    {
        printf("Ошибка в запросе: %s\n", mysqli_error($db));
    }

    $SQL = "SELECT * FROM  whats_$lang WHERE id_what !=1";
    if (!$result_whats = mysqli_query($db, $SQL)) 
    {
        printf("Ошибка в запросе: %s\n", mysqli_error($db));
    }
}

function SelectDataOnCaseId($case_id) // вызывается в файле  page_for_case_card
{
    $lang= 'en';
    global $db;    
    global $row_casedata;   
    
    $SQL = 
        "SELECT *
        FROM cases c2 
        LEFT JOIN ipsubjects_$lang is2 
        ON c2.ipsubject_id = is2.id_ipsubject 
        LEFT JOIN jurisdictions_$lang j2 
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

$result_nicks;
function SelectCasenicksOnAccountId() // вызывается в файле page_for_case_card
{
    global $db;    
    global $result_nicks; 

    // получаем список ников в данном аккаунте в $result_nicks 
    $account_id = $_SESSION['useraccountid'];
    $SQL = "SELECT id_case, our_case_ref
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
    $lang= 'en';
    global $db;    
    global $result_casetask; 

    $SQL = 
        "SELECT * , DATE_FORMAT(task_start_term, '%d.%m.%Y') as task_start_term_formatted
        FROM task_cases atc 
        JOIN tasks_$lang t2 ON t2.id_task = atc.task_id 
        JOIN employees e2 ON e2.id_employee = atc.task_responsible_id 
        LEFT JOIN whats_$lang w2 ON w2.id_what = atc.what_id
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
    $lang= 'en';
    global $db;    
    global $row_casetask; 

    $SQL = 
        "SELECT *
        FROM task_cases atc 
        JOIN tasks_$lang t2 ON t2.id_task = atc.task_id 
        LEFT JOIN whats_$lang w2 ON w2.id_what = atc.what_id
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

function NoTasksDoneNotHidden() //вызывается из 
{
	$lang= 'en';
    global $db;
/*     global $show_hide_button; */
    $account_id = $_SESSION['useraccountid'];

    $SQL = 
        "SELECT * FROM task_cases tc 
            JOIN cases c2 ON c2.id_case = tc.case_id 
            JOIN employees e2 ON e2.id_employee = tc.task_responsible_id 
            JOIN tasks_$lang t2 ON t2.id_task = tc.task_id 
            LEFT JOIN whats_$lang w2 ON w2.id_what = tc.what_id 
            WHERE tc.still_show_on_index = 1 AND tc.task_status = 0 
                AND c2.not_closed_case =1 AND tc.not_deleted_task = 1 
                AND e2.account_id = $account_id"; 
    //print $SQL;

    if (!$result = mysqli_query($db, $SQL)) 
    {
        printf("Ошибка в запросе на выбоку незакрытых задач: %s\n", mysqli_error($db));
    }        
    //printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result));          
    if  (mysqli_num_rows($result) == 0){
        $not_show_hide_button = true;
        //echo 'true';
    }  
    else{
        $not_show_hide_button = false;
        //echo 'false';
    }

    //print("not_show_hide_button:".$not_show_hide_button);  
    return $not_show_hide_button;
}

$result_all_cases;
function SelectAllCases()
{
    global $db;
    global $result_all_cases;
    $account_id = $_SESSION['useraccountid'];
    $SQL = 
        "SELECT c.id_case, c.our_case_ref, c.client_case_ref, c.pto_case_ref, c.not_closed_case   
        FROM cases c 
        JOIN employees e2 ON e2.id_employee = c.registrant_id
        WHERE e2.account_id=$account_id
        LIMIT 10";
    //print $SQL;
    if (!$result_all_cases = mysqli_query($db, $SQL)) 
    {
		printf("Ошибка в запросе на выбор всех дел: %s\n", mysqli_error($db));
	}
}