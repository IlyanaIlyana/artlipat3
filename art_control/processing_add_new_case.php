<?php 
session_start(); $title = "Добавление нового дела"; 
require_once "start_mysql.php"; 	
	
    /* $id_account = $_SESSION['useraccountid']; */
    $id_empl = $_SESSION['userid'];        
    $casenick = htmlspecialchars($_POST['nick']);	
    $clients_ref_number = htmlspecialchars($_POST['clients_ref_number']);    
    $pto_ref_number = htmlspecialchars($_POST['pto_ref_number']);    

    if (!empty($_POST['ip_id'])){$ipsubj_id = $_POST['ip_id'];}
    else {$ipsubj_id = 6;}

    if (!empty($_POST['jurisdict_id'])){$jurisdict_id = $_POST['jurisdict_id'];}
    else {$jurisdict_id = 8;} 
	
	StartDB();

    // здесь в БД есть поле timestamp по умолчанию CURRENT_TIMESTAMP
    $SQL = "INSERT INTO cases
					(ipsubject_id,  jurisdiction_id,  registration_date, registrant_id, 
                    our_case_ref, client_case_ref, pto_case_ref) 
			VALUES 	('$ipsubj_id',  '$jurisdict_id', NOW(), '$id_empl',   
                      '$casenick', '$clients_ref_number', '$pto_ref_number'
                      )";		                  
	//print $SQL."<br>";	

	if (!mysqli_query($db, $SQL)) 
	{
		printf("Ошибка добавления записи в дела: %s\n", mysqli_error($db));
    }      

    // здесь получаем номер последней записи запросом, хотя можно $last_case_id = mysqli_insert_id($db);
    // последняя запись нужна для перехода на нужную карточку дела
    $SQL4 = "SELECT id_case 
            FROM cases 
            ORDER BY id_case DESC 
            LIMIT 1";
     //print $SQL4."<br>";

    if (!$result = mysqli_query($db, $SQL4)) 
    {
        printf("Ошибка в запросе4: %s\n", mysqli_error($db));
    }
    $row4 = mysqli_fetch_assoc($result);
    $last_case_id = $row4['id_case'];  //received id of the last added case
    //print $last_case_id."last_case_id<br>";
    mysqli_free_result($result);
    
    header("Refresh: 1; URL = ../page_for_case_card.php?sent_case_id=$last_case_id");
   /*  header("Location: URL = page_for_case_card.php?sent_case_id=$last_case_id"); */
	
	EndDB();
?>

