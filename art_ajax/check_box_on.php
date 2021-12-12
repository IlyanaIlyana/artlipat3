<?php session_start(); require_once "../art_control/start_mysql.php";

    print_r($_POST);
	$active = $_POST['active'];
    $task_case_id = $_POST['id'];        

    $id_empl = $_SESSION['userid'];	
    
    StartDB();  

    if ($active == 0){
        $SQL = "UPDATE task_cases 
        SET task_status= 0,  closer_id='$id_empl',  date_of_close=Now()                    			 
        WHERE id_task_case = $task_case_id";		                  
        print "пометим задачу сделанной<br>".$SQL."<br>";	

        if (!mysqli_query($db, $SQL)) 
        {
            printf("Ошибка обновления статуса задачи: %s\n", mysqli_error($db));
        }
    }

    else {        
        $SQL1 = "SELECT * FROM task_cases WHERE id_task_case = ".$task_case_id;  
        
        $result = mysqli_query($db, $SQL1);
        if (!$result) 
        {
            printf("Ошибка нахожденеия задачи: %s\n", mysqli_error($db));
        } 
        
        $row = mysqli_fetch_assoc($result);

        print_r($row);

        /* $SQL2 = "INSERT INTO task_cases
                        (case_id, task_id, what_id, task_responsible_id, task_start_term, 
                        date_of_record, recorder_id, task_end_term) 
                VALUES 	($row['case_id'], $row['task_id'], $row['what_id'], 
                        $row['task_responsible_id'],  $row['task_start_term'], Now(), 
                        $row['recorder_id'], $row['task_end_term'])";	
        //print "вставим в дело-задача SQL2=".$SQL2."<br>";
        
        if (!mysqli_query($db, $SQL2)) 
        {
            printf("Ошибка добавления задачи: %s\n", mysqli_error($db));
        }   */
    }

    EndDB();

	header("Refresh: 1; URL = ../index.php");

