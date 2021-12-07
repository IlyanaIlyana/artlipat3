<?php 
// вызывается из page_for_case_card.php
session_start();  
require_once "start_mysql.php"; 
	    
	$id_empl = $_SESSION['userid'];
	$date_case_id = $_POST['date_case_id'];
    $case_id = $_POST['case_id'];
    //print_r($_POST);
	
    $SQL = "UPDATE  dates_cases 
            SET term_observed= 1,  closer_id='$id_empl',  date_of_closing=Now()                    			 
            WHERE id_date_case = $date_case_id";		                  
	//print "<br>".$SQL."<br>";	

		StartDB();
		if (!mysqli_query($db, $SQL)) 
		{
			printf("Ошибка добавления задачи: %s\n", mysqli_error($db));
		}
		EndDB();
	header("Refresh: 1; URL = page_for_case_card.php?sent_case_id=$case_id");
	
	
?>

