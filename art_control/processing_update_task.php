<?php 
session_start(); 
require_once "start_mysql.php"; 	
	
    /* $id_account = $_SESSION['useraccountid']; */
    $id_empl = $_SESSION['userid'];
    $responsible_id = htmlspecialchars($_POST['responsible_id']);	
    $task_start_date = htmlspecialchars($_POST['start_term']);    
    $task_end_date = htmlspecialchars($_POST['end_term']);  
    $case_id = $_POST['case_id'];
    $task_id = $_POST['task_id'];
    $task_case_id = $_POST['task_case_id'];

    //print "case_id = ".$case_id."<br>";
    //print_r($_POST);

    if (!empty($_POST['what_id'])){$what_id = $_POST['what_id'];}
    else {$what_id = 1;}
	
	StartDB();
    
    $SQL1 = "UPDATE  task_cases 
            SET closer_id='$id_empl', date_of_close=Now(), not_deleted_task=0 			 
            WHERE id_task_case = $task_case_id";
    //print "<br>SQL1=".$SQL1."<br>"; 

    $SQL2 = "INSERT INTO task_cases
            (case_id, task_id, task_responsible_id, what_id, task_start_term, 
            date_of_record, recorder_id, task_end_term) 
            VALUES 	('$case_id', '$task_id', '$responsible_id', '$what_id', '$task_start_date', Now(), '$id_empl', '$task_end_date')";	            
    //print "<br>SQL2=".$SQL2."<br>";        

	if (!mysqli_query($db, $SQL1)) 
	{
		printf("Ошибка обновления записи: %s\n", mysqli_error($db));
    }      
    if (!mysqli_query($db, $SQL2)) 
	{
		printf("Ошибка обновления записи: %s\n", mysqli_error($db));
    } 

    EndDB();
    header("Refresh: 1; URL = ../page_for_case_card.php?sent_case_id=$case_id");
   /*  header("Location: URL = page_for_case_card.php?sent_case_id=$case_id"); */
?>

