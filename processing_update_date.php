<?php 
session_start(); 
require_once "start_mysql.php"; 	
	
    /* $id_account = $_SESSION['useraccountid']; */
    $id_empl = $_SESSION['userid'];
    $case_id = $_POST['case_id'];
    $date_id = $_POST['date_id'];
    $date_case_id = $_POST['date_case_id'];
    $date_on_case = $_POST['date_on_case'];

    //print "case_id = ".$case_id."<br>";
    //print_r($_POST);
	
	StartDB();
    
    $SQL1 = "UPDATE  dates_cases 
            SET closer_id='$id_empl', date_of_closing=Now(), not_deleted=0 			 
            WHERE id_date_case = $date_case_id";
    //print "<br>SQL1=".$SQL1."<br>"; 

    $SQL2 = "INSERT INTO dates_cases
            (case_id, date_id, date_on_case, recording_date, recorder_id) 
            VALUES 	('$case_id', '$date_id', '$date_on_case',   Now(), '$id_empl')";	            
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
    header("Refresh: 1; URL = page_for_case_card.php?sent_case_id=$case_id");
   /*  header("Location: URL = page_for_case_card.php?sent_case_id=$case_id"); */
?>

