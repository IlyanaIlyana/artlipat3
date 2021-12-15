<?php 
session_start(); 
require_once "start_mysql.php"; 	
	
    /* $id_account = $_SESSION['useraccountid']; */
    $id_empl = $_SESSION['userid'];
    $task_case_id = $_GET['task_case_id'];
    $case_id = $_GET['case_id'];

 //   print "_GET = <br>";
 //   print_r($_GET);
	
    StartDB();
   
       
    $SQL = "UPDATE  task_cases 
            SET closer_id='$id_empl', date_of_close=Now(), not_deleted_task=0 			 
            WHERE id_task_case = $task_case_id";
//      print "<br>SQL=".$SQL."<br>"; 

	if (!mysqli_query($db, $SQL)) 
	{
		printf("Ошибка обновления записи на удаление: %s\n", mysqli_error($db));
         }      
    
    EndDB(); 
    header("Refresh: 1; URL = ../page_for_case_card.php?sent_case_id=$case_id");
        /*  header("Location: URL = page_for_case_card.php?sent_case_id=$case_id"); */
       // header("Location: ".$_SERVER['HTTP_REFERER']);
?>

