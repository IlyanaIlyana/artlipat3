<?php 
session_start(); 
require_once "start_mysql.php"; 	
	
    /* $id_account = $_SESSION['useraccountid']; */
    $id_empl = $_SESSION['userid'];
    $ipsubj_id = $_POST['ip_id'];	
    $jurisdict_id = $_POST['jurisdict_id'];        
    $casenick = htmlspecialchars($_POST['nick']);	
    $clients_ref_number = htmlspecialchars($_POST['clients_ref_number']);    
    $pto_ref_number = htmlspecialchars($_POST['pto_ref_number']);  
    $case_id = $_POST['case_id'];

    //print "case_id = ".$case_id."<br>";
    //print_r($_POST);
	
	StartDB();
    
    $SQL = "UPDATE  cases 
            SET ipsubject_id='$ipsubj_id',  jurisdiction_id='$jurisdict_id',  amendler_id='$id_empl', amendment_date=Now(),
                    our_case_ref='$casenick', client_case_ref='$clients_ref_number', pto_case_ref='$pto_ref_number' 			 
            WHERE id_case = $case_id";		                  
	//print "<br>".$SQL."<br>";	

	if (!mysqli_query($db, $SQL)) 
	{
		printf("Ошибка обновления записи: %s\n", mysqli_error($db));
    }      
   
    
    header("Refresh: 1; URL = ../page_for_case_card.php?sent_case_id=$case_id");
   /*  header("Location: URL = page_for_case_card.php?sent_case_id=$case_id"); */
	
	EndDB();
?>

