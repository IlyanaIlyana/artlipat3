<?php 
// вызывается из page_for_case_card.php
session_start();  
require_once "start_mysql.php"; 	
	
	//print_r($_POST);     
	$id_empl = $_SESSION['userid'];
	$task_case_id = $_POST['task_case_id'];
    $case_id = $_POST['case_id'];
    //print_r($_POST);
	
    $SQL = "UPDATE  task_cases 
            SET task_status= 0,  closer_id='$id_empl',  date_of_close=Now()                    			 
            WHERE id_task_case = $task_case_id";		                  
	//print "<br>".$SQL."<br>";	

		StartDB();
		if (!mysqli_query($db, $SQL)) 
		{
			printf("Ошибка добавления задачи: %s\n", mysqli_error($db));
		}
		EndDB();
	header("Refresh: 1; URL = page_for_case_card.php?sent_case_id=$case_id");
	
	
?>

