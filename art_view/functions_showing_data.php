<?php

function ShowAllCasesToWorkOn($x) //вызывается из function ShowFirstPage(), расположенной в function_for_page_view_on_index.php
{
	$today = date("Y-m-d");
    $nextpoint1 = date("Y-m-d", strtotime("+7 days"));
    $nextpoint2 = date("Y-m-d", strtotime("+14 days"));
    global $result_cases_to_work;
    SelectAllCasesToWorkOn($x);
    while($row = mysqli_fetch_assoc($result_cases_to_work))
    { 
        ?>
            <tr <?php if ($row['task_end_term'] < $today): ?> style="background: #f7ac96" <?php  
                elseif ($row['task_end_term'] < $nextpoint1): ?> style="background: #f1d0b4" <?php  
                elseif ($row['task_end_term'] < $nextpoint2): ?> style="background: #f1e5b4" <?php  
                else: ?> style="background: #cee7f3" <?php endif; ?>> 
                <td>
                    <div class="checkboxes">
                    <input class="active" <?php if ($row['task_status'] == 0): ?>
                            checked="checked"<?php endif; ?> 
                            name="checkbox_done[]"
                            value="<?php echo $row['id_task_case']?>" type="checkbox" /> 
                    </div>
                </td>            
                <td <?php if ($row['task_status'] == 0): ?>
                    style="text-decoration: line-through;" <?php endif; ?>>
                    <?php echo $row['task_name']." ".$row['what']." ".$row['where']?>   
                </td> 
                <td><a href='page_for_case_card.php?sent_case_id=<?php echo$row['id_case']?>'>
                    <?php echo $row['our_case_ref']?></a></td>
                <td><?php echo $row['task_end_term']?></td>
                <td><?php echo $row['employee_nickname']?></td>
            </tr> 
        <?php
    }          
	mysqli_free_result($result_cases_to_work);
}	

function ShowCasesToWorkOnForPerson($person_id,$x) //вызывается из function ShowTabsContent(), расположенной здесь же
{
	SelectCasesToWorkOnForPerson($person_id, $x);
    $today = date("Y-m-d");
    $nextpoint1 = date("Y-m-d", strtotime("+7 days"));
    $nextpoint2 = date("Y-m-d", strtotime("+14 days"));
    global $result_cases_to_work_person;
    while($row2 = mysqli_fetch_assoc($result_cases_to_work_person))
    {         
        ?>
        <tr <?php if ($row2['task_end_term'] < $today): ?> style="background: #f7ac96" <?php  
                elseif ($row2['task_end_term'] < $nextpoint1): ?> style="background: #f1d0b4" <?php 
                elseif ($row2['task_end_term'] < $nextpoint2): ?> style="background: #f1e5b4" <?php  
                else: ?> style="background: #cee7f3" <?php endif; ?>>
        <td>
            <div class="checkboxes">
                <input class="active" <?php if ($row2['task_status'] == 0): ?>
                        checked="checked"<?php endif; ?> 
                        name="checkbox_done[]"
                        value="<?php echo $row2['id_task_case']?>" type="checkbox" /> 
            </div>
        </td>
        <td <?php if ($row2['task_status'] == 0): ?>
            style="text-decoration: line-through;" <?php endif; ?>>
            <?php echo $row2['task_name']." ".$row2['what']." ".$row2['where']?>   
        </td>   
        <?php
        printf("<td>%s</td><td>%s</td>",         
        "<a href='page_for_case_card.php?sent_case_id=".$row2['id_case']."'>".
            $row2['our_case_ref']."</a>", 
        $row2['task_end_term']); 
        print "</tr>"; 
    }          
	mysqli_free_result($result_cases_to_work_person);
}	

function ShowAllCompanyCases()
{    
    global $result_cases;
    SelectAllCompanyCases();
    while( $row = mysqli_fetch_assoc($result_cases))
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
	mysqli_free_result($result_cases);	
}

function ShowTabs() //вызывается из function ShowFirstPage(), расположенной в function_for_page_view_on_index.php
{
    global $result_emplos;
    SelectEmployeesOnAccountId();
    while( $row = mysqli_fetch_assoc($result_emplos))
    { 
        ?>            
        <li class=""><a data-toggle="tab" 
        href="#<?php echo $row['id_employee']?>">
        <?php echo $row['employee_nickname']?></a></li>         
        <?php
    }
    mysqli_free_result($result_emplos);    
}

function ShowTabsContent() //вызывается из function ShowFirstPage(), расположенной в function_for_page_view_on_index.php
{    
    global $result_emplos;

    $lang= $_SESSION['language'];	
    $lang= 'en';
    global $rowactulal_tasks;    
    global $rowplanned;
    SelectTranslationPageMainContent($lang);

    SelectEmployeesOnAccountId();
    while($row = mysqli_fetch_assoc($result_emplos))
    { 
        ?>            
        <div id="<?php echo $row['id_employee']?>" class="tab-pane">
        <h3><?php echo $rowactulal_tasks['phrase_'.$lang]?></h3>
            <div class="table-responsive">    
            <table class="table">                
                <tbody>
                <?php ShowCasesToWorkOnForPerson($row['id_employee'], 1)?> 
                </tbody>
            </table>
            </div> 
        <h3><?php echo $rowplanned['phrase_'.$lang]?></h3>
            <div class="table-responsive"> 
            <table class="table">                
                <tbody>
                <?php ShowCasesToWorkOnForPerson($row['id_employee'], 2)?>
                </tbody>
            </table> 
            </div>              
        </div>
        <?php
    }
    mysqli_free_result($result_emplos);    
}

function ShowAllCases()
{
    global $db;
    global $result_all_cases;
    SelectAllCases();
        //printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result));

        while( $row = mysqli_fetch_assoc($result_all_cases) )
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
		mysqli_free_result($result_all_cases);
	
} 