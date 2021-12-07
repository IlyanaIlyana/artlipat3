<?php

function ShowAllCasesToWorkOn($result_cases_to_work) //вызывается из function ShowFirstPage(), расположенной в function_for_page_view_on_index.php
{
	while($row = mysqli_fetch_assoc($result_cases_to_work))
    { 
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
	mysqli_free_result($result_cases_to_work);
}	

function ShowCasesToWorkOnForPerson($result_cases_to_work_person) //вызывается из function ShowTabsContent(), расположенной здесь же
{
	while($row2 = mysqli_fetch_assoc($result_cases_to_work_person))
    { 
        print "<tr>"; 
        printf("<td>%s</td><td>%s</td><td>%s</td>", 
        $row2['task_name']." ".$row2['what']." ".$row2['where'], 
        "<a href='page_for_case_card.php?sent_case_id=".$row2['id_case']."'>".
            $row2['our_case_ref']."</a>", 
        $row2['task_end_term']); 
        print "</tr>"; 
    }          
	mysqli_free_result($result_cases_to_work_person);
}	

function ShowAllCompanyCases($result_cases)
{    
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

function ShowTabs($result_emplos) //вызывается из function ShowFirstPage(), расположенной в function_for_page_view_on_index.php
{
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

function ShowTabsContent($result_emplos) //вызывается из function ShowFirstPage(), расположенной в function_for_page_view_on_index.php
{    
    while($row = mysqli_fetch_assoc($result_emplos))
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
    mysqli_free_result($result_emplos);    
}