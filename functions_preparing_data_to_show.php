<?php

function ShowAllCasesToWorkOn($x) //вызывается из function ShowFirstPage(), расположенной в function_for_page_view_on_index.php
{
	global $db;
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

	if ($result = mysqli_query($db, $SQL)) 
	{
        //printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result));        
        // Выборка результатов запроса 
        while( $row = mysqli_fetch_assoc($result) )
        { 
           /*  print "<tr>"; 
            printf("<td>%s</td><td>%s</td><td>%s</td><td>%s</td>", 
            $row['task_name'], 
            "<a href='page_for_case_card.php?sent_case_id=".$row['id_case']."'>".
                $row['our_case_ref']."</a>", 
            $row['task_end_term'], 
            $row['employee_nickname']); 
            print "</tr>";  */
            ?>
                <tr>             
                    <td> <?php echo $row['task_name']." ".$row['what']." ".$row['where']?></td>
                    <td><a href='page_for_case_card.php?sent_case_id=<?php echo$row['id_case']?>'>
                        <?php echo $row['our_case_ref']?></a></td>
                    <td><?php echo $row['task_end_term']?></td>
                    <td><?php echo $row['employee_nickname']?></td>
                </tr> 
            <?php
        }          
		mysqli_free_result($result);
	}
	else
	{
		printf("Ошибка в запросе на выборку текущих задач: %s\n", mysqli_error($db));
	}
}	

function ShowCasesToWorkOnForPerson($person_id, $x) //вызывается из function ShowTabsContent(), расположенной здесь же
{
	global $db;
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
        if ($x==2){
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


    /* $SQL2 = 
        "SELECT * 
        FROM task_cases tc 
        JOIN cases c2 ON c2.id_case = tc.case_id 
        JOIN employees e2 ON e2.id_employee = tc.task_responsible_id 
        JOIN tasks t2 ON t2.id_task = tc.task_id 
        WHERE tc.task_status = 1 AND e2.account_id = ".$account_id." AND e2.id_employee =".$person_id;
    print $SQL; */

	if ($result2 = mysqli_query($db, $SQL)) 
	{
        //printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result2));        
        // Выборка результатов запроса 
        while($row2 = mysqli_fetch_assoc($result2) )
        { 
            print "<tr>"; 
            printf("<td>%s</td><td>%s</td><td>%s</td>", 
            $row2['task_name']." ".$row2['what']." ".$row2['where'], 
            "<a href='page_for_case_card.php?sent_case_id=".$row2['id_case']."'>".
                $row2['our_case_ref']."</a>", 
            $row2['task_end_term']); 
            print "</tr>"; 
        }          
		mysqli_free_result($result2);
	}
	else
	{
		printf("Ошибка в запросе на выборку текущих задач сотрудника: %s\n", mysqli_error($db));
	}
}	

function ShowAllCases()
{
    global $db;
    $account_id = $_SESSION['useraccountid'];
    $SQL = 
        "SELECT c.id_case, c.our_case_ref, c.client_case_ref, c.pto_case_ref, c.not_closed_case   
        FROM cases c 
        JOIN employees e2 ON e2.id_employee = c.registrant_id
        WHERE e2.account_id=$account_id";
    //print $SQL;
    if ($result = mysqli_query($db, $SQL)) 
    {
    //printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result));

                       // Выборка результатов запроса 
                    while( $row = mysqli_fetch_assoc($result) )
                    { 
                        if ($row['not_closed_case']==1){
                        print "<tr>"; 
                        printf("<td>%s</td><td>%s</td><td>%s</td>", 
                        "<a href='page_for_case_card.php?sent_case_id=".$row['id_case']."'>".$row['our_case_ref']."</a>", 
                        "<a href='page_for_case_card.php?sent_case_id=".$row['id_case']."'>".$row['client_case_ref']."</a>", 
                        "<a href='page_for_case_card.php?sent_case_id=".$row['id_case']."'>".$row['pto_case_ref']."</a>"); 
                        print "</tr>"; 
                        }
                        else {
                            print "<tr class='danger'>"; 
                            printf("<td>%s</td><td>%s</td><td>%s</td>", 
                            "<a href='page_for_case_card.php?sent_case_id=".$row['id_case']."'>".$row['our_case_ref']."</a>", 
                            "<a href='page_for_case_card.php?sent_case_id=".$row['id_case']."'>".$row['client_case_ref']."</a>", 
                            "<a href='page_for_case_card.php?sent_case_id=".$row['id_case']."'>".$row['pto_case_ref']."</a>"); 
                            print "</tr>"; 
                            }
                    }                    
                    
                    ?>
                
        </div>
        <?php
		mysqli_free_result($result);
	}
	else
	{
		printf("Ошибка в запросе: %s\n", mysqli_error($db));
	}
}

function ShowTabs() //вызывается из function ShowFirstPage(), расположенной в function_for_page_view_on_index.php
{
    global $db;
    $account_id = $_SESSION['useraccountid'];
    $SQL="SELECT * FROM employees e WHERE e.account_id =".$account_id;
    //print $SQL;
    if ($result = mysqli_query($db, $SQL)) 
    {
        //printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result))
        // Выборка результатов запроса 
        while( $row = mysqli_fetch_assoc($result))
        { 
            ?>            
            <li class=""><a data-toggle="tab" 
            href="#<?php echo $row['id_employee']?>">
            <?php echo $row['employee_nickname']?></a></li>         
            <?php
        }
        mysqli_free_result($result);
    }
    else
    {
        printf("Ошибка в запросе: %s\n", mysqli_error($db));
    }
}

function ShowTabsContent() //вызывается из function ShowFirstPage(), расположенной в function_for_page_view_on_index.php
{
    global $db;
    $account_id = $_SESSION['useraccountid'];
    $SQL="SELECT * FROM employees e WHERE e.account_id =".$account_id;
    //print $SQL;
    if ($result = mysqli_query($db, $SQL)) 
    {
        //printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result))
        // Выборка результатов запроса 
        while( $row = mysqli_fetch_assoc($result))
        { 
            ?>            
            <div id="<?php echo $row['id_employee']?>" class="tab-pane">
            <h3>Актуальные задачи</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Задача</th>
                        <th>Дело</th>
                        <th>Срок</th>                              
                    </tr>
                    </thead>
                    <tbody>
                    <?php ShowCasesToWorkOnForPerson($row['id_employee'], 1)?> 
                    </tbody>
                </table> 
                <h3>Запланированные задачи</h3> 
                <table class="table">
                    <thead>
                    <tr>
                        <th>Задача</th>
                        <th>Дело</th>
                        <th>Срок</th>                              
                    </tr>
                    </thead>
                    <tbody>
                    <?php ShowCasesToWorkOnForPerson($row['id_employee'], 2)?>
                    </tbody>
                </table>               
            </div>

            <?php
        }
        mysqli_free_result($result);
    }
    else
    {
        printf("Ошибка в запросе: %s\n", mysqli_error($db));
    }
}

function ShowAllTerms() // вызывается в файле  function_for_page_view_on_index
{
    global $db;    
    global $result_dates; 
    $account_id = $_SESSION['useraccountid'];          

    $SQL = 
        "SELECT * , DATE_FORMAT(date_on_case, '%d.%m.%Y') as date_on_case_formatted
        FROM dates_cases dc 
        JOIN dates d2 ON d2.id_date = dc.date_id 
        JOIN cases c2 ON c2.id_case = dc.case_id 
        JOIN employees e2 ON e2.id_employee = dc.recorder_id
        WHERE dc.not_deleted=1 AND c2.not_closed_case =1 AND dc.term_observed = 0 AND d2.isdeadline = 1 AND e2.account_id = $account_id 
        ORDER BY dc.date_on_case ASC";

        //print $SQL;
        ?>
        <table class="table">
        </tbody>
            <?php
            if ($result_dates = mysqli_query($db, $SQL)) 
            {
            //printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result));   
                while( $row = mysqli_fetch_assoc($result_dates) )
                { 
                ?>
                <tr>
                    <td ><?php echo $row['date_name']?></td>
                    <td >
                    <a href='page_for_case_card.php?sent_case_id=<?php echo$row['id_case']?>'>
                        <?php echo $row['our_case_ref']?></a></td>
                    <td ><?php echo $row['date_on_case_formatted']?></td>
                </tr>
                <?php
                
                }                                          
            
            mysqli_free_result($result_dates);
            }
            else
            {
                printf("Ошибка в запросе: %s\n", mysqli_error($db));
            }
            ?>
        </tbody>
        </table>
        <?php
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
    global $row_casedata;   //8 
    
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

        if (!$result_casedata = mysqli_query($db, $SQL)) //8
        {
            printf("Ошибка в запросе: %s\n", mysqli_error($db));
        }
        $row_casedata = mysqli_fetch_assoc($result_casedata);

        //printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result8));
        //print_r ($row8);      
        
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

function SelectAllDatesOnCaseId($case_id) // вызывается в файле  page_for_case_card
{
    global $db;    
    global $result_casedates;

    $SQL = 
        "SELECT * , DATE_FORMAT(date_on_case, '%d.%m.%Y') as date_on_case_formatted
        FROM dates_cases dc 
        JOIN dates d2 ON d2.id_date = dc.date_id  
        WHERE dc.case_id = $case_id AND dc.not_deleted=1 
        ORDER BY dc.recording_date ASC";

        //print $SQL;

        if (!$result_casedates = mysqli_query($db, $SQL)) 
        {
            printf("Ошибка в запросе: %s\n", mysqli_error($db));
        }
        
        //printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result_casetask));            
        
}

function SelectAllActualTermsOnCaseId($case_id) // вызывается в файле  page_for_case_card
{
    global $db;    
    global $result_casedates;

    $SQL = 
        "SELECT * , DATE_FORMAT(date_on_case, '%d.%m.%Y') as date_on_case_formatted
        FROM dates_cases dc 
        JOIN dates d2 ON d2.id_date = dc.date_id
        WHERE dc.case_id = $case_id AND dc.not_deleted=1 AND dc.term_observed = 0 AND d2.isdeadline = 1 
        ORDER BY dc.date_on_case ASC";

        //print $SQL;

        if (!$result_casedates = mysqli_query($db, $SQL)) 
        {
            printf("Ошибка в запросе: %s\n", mysqli_error($db));
        }
        
        //printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result_casetask));            
        
}

function SelectThisDateOnCase($date_case_id) // вызывается в файле  page_for_case_term
{
    global $db;    
    global $row_casedate;

    $SQL = 
        "SELECT *
        FROM dates_cases dc 
        JOIN dates d2 ON d2.id_date = dc.date_id 
        JOIN employees e3 ON e3.id_employee = dc.recorder_id 
        WHERE dc.id_date_case =$date_case_id";

        //print $SQL;

        if (!$result_date = mysqli_query($db, $SQL)) 
        {
            printf("Ошибка в запросе: %s\n", mysqli_error($db));
        }
        
        //printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result_date));  
        
        $row_casedate = mysqli_fetch_assoc($result_date);
        
        //print_r ($row_casedate);      
        
}