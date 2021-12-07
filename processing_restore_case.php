<?php 
session_start(); 
require_once "start_mysql.php"; 	
	
    /* $id_account = $_SESSION['useraccountid']; */
    $id_empl = $_SESSION['userid'];
    $case_id = $_POST['case_id'];

    //print "case_id = ".$case_id."<br>";
    //print_r($_POST);
	
	StartDB();
    
    $SQL = "UPDATE  cases 
            SET not_closed_case=1, amendler_id='$id_empl', amendment_date=Now()
            WHERE id_case = $case_id";		                  
	//print "<br>".$SQL."<br>";	

	if (!mysqli_query($db, $SQL)) 
	{
		printf("Ошибка обновления записи: %s\n", mysqli_error($db));
    }      
   
    
    header("Refresh: 1; URL = page_for_case_card.php?sent_case_id=$case_id");
   /*  header("Location: URL = page_for_case_card.php?sent_case_id=$case_id"); */
	
	EndDB();
?>

