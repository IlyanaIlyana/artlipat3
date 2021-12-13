<?php 
session_start();  
require_once "start_mysql.php"; 	
	
    //print "<br> _POST: <br>";
	//print_r($_POST);
    // Array ( [checkbox_done] => Array ( [0] => 61 [1] => 62 [2] => 63 [3] => 57 [4] => 58 [5] => 64 ) )
       
	$id_empl = $_SESSION['userid']; 

    StartDB();
    if(isset($_POST['checkbox_done'])) {
        foreach($_POST['checkbox_done'] as $check) {
            //echo $check; 
            $SQL = "UPDATE  task_cases 
                    SET still_show_on_index = 0,  closer_id='$id_empl',  date_of_close=Now()                    			 
                    WHERE id_task_case = $check";		                  
	        //print "<br>".$SQL."<br>";
            if (!mysqli_query($db, $SQL)) 
            {
                printf("Ошибка закрытия задачи: %s\n", mysqli_error($db));
            }
        }
    }
	EndDB(); 

	header("Refresh: 1; URL = ../index.php");
?>

