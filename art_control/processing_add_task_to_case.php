<?php 
// вызывается из page_for_case_card.php
session_start();  
require_once "start_mysql.php"; 	
	
	//print_r($_POST);     
	$id_empl = $_SESSION['userid'];
	$case_id = $_POST['caseid'];
    $task_id = $_POST['taskid'];   
    $responsible_id = $_POST['responsible_id']; 
    $start_term = $_POST['start_term']; 
	$end_term = $_POST['end_term'];   

	if (empty($_POST['responsible_id'])){$responsible_id = $id_empl;}

	if (empty($_POST['start_term'])){$start_term = date("y-m-d");}
	if (empty($_POST['end_term'])){$end_term = date("y-m-d");}

	if (!empty($_POST['what_id'])){$what_id = $_POST['what_id'];}
    else {$what_id = 1;}
	
	
	
	$SQL = "INSERT INTO task_cases
					(case_id, task_id, what_id, task_responsible_id, task_start_term, 
                    date_of_record, recorder_id, task_end_term) 
			VALUES 	('$case_id', '$task_id', '$what_id', '$responsible_id',  '$start_term', Now(), '$id_empl', '$end_term')";	
	//print "SQL=".$SQL."<br>";

		StartDB();
		if (!mysqli_query($db, $SQL)) 
		{
			printf("Ошибка добавления задачи: %s\n", mysqli_error($db));
		}
		EndDB();
/* 	header("Refresh: 1; URL = ../page_for_case_card.php?sent_case_id=$case_id"); */
	header("Refresh: 1; URL = ../index.php");	
	
?>

