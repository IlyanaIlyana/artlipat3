<?php 
// вызывается из page_for_case_card.php
session_start();  
require_once "start_mysql.php"; 	
	
	$accountid =$_SESSION['useraccountid'];

	//print_r($_POST);     
	$id_empl = $_SESSION['userid'];
	$casenick = $_POST['casenick'];
    $task_id = $_POST['taskid'];   
    $responsible_id = $_POST['responsible_id']; 
    $start_term = $_POST['start_term']; 
	$end_term = $_POST['end_term'];   

	if (empty($_POST['responsible_id'])){$responsible_id = $id_empl;}

	if (empty($_POST['start_term'])){$start_term = date("y-m-d");}
	if (empty($_POST['end_term'])){$end_term = date("y-m-d");}

	if (!empty($_POST['what_id'])){$what_id = $_POST['what_id'];}
    else {$what_id = 1;}

	StartDB();

	$SQL0 = "SELECT c.id_case, c.our_case_ref, c.not_closed_case 
				FROM cases c 
				JOIN employees e2 ON e2.id_employee = c.registrant_id
				WHERE e2.account_id = $accountid AND 
				(c.our_case_ref = '".$casenick."')";
	//print "SQL0=".$SQL0."<br>";
	if (!mysqli_query($db, $SQL0)) 
	{
		printf("Ошибка нахождения ника: %s\n", mysqli_error($db));
	}	
	$result = mysqli_query($db, $SQL0);
	
	if(mysqli_num_rows($result) == 0)
	{
		$SQL01 = "INSERT INTO cases
		(ipsubject_id,  jurisdiction_id,  registration_date, registrant_id, 
		our_case_ref, client_case_ref, pto_case_ref) 
		VALUES 	('6',  '8', NOW(), '$id_empl',   
		  '$casenick', '', '')";		                  
		//print "нет такого имени, <br>SQL01".$SQL01."<br>";

		if (!mysqli_query($db, $SQL01)) 
		{
			printf("Ошибка добавления ника: %s\n", mysqli_error($db));
		}

		$case_id = mysqli_insert_id($db);
		//print "добавили дело<br>last case_id = ".$case_id."<br>";
	}

	else {
		$row = mysqli_fetch_assoc($result);
		$case_id = $row['id_case'];
		//print "нашли такое имя<br>case_id = ".$case_id."<br>";
	}	
	
	$SQL = "INSERT INTO task_cases
					(case_id, task_id, what_id, task_responsible_id, task_start_term, 
                    date_of_record, recorder_id, task_end_term) 
			VALUES 	('$case_id', '$task_id', '$what_id', '$responsible_id',  '$start_term', Now(), '$id_empl', '$end_term')";	
	//print "вставим в дело-задача SQL=".$SQL."<br>";
		
		if (!mysqli_query($db, $SQL)) 
		{
			printf("Ошибка добавления задачи: %s\n", mysqli_error($db));
		}
		EndDB();
/* 	header("Refresh: 1; URL = ../page_for_case_card.php?sent_case_id=$case_id"); */
	header("Refresh: 1; URL = ../index.php");	
	
?>

