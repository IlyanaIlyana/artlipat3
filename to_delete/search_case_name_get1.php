<?php session_start(); require_once "start_mysql.php";


	$searchtag = '';
	if(!empty($_GET['term'])) 
	{	
		$searchtag = htmlspecialchars($_GET['term']);	
		print "searchtag=".$searchtag."<br>";
	}	
    print "searchtag=".$searchtag."<br>";



/*     $filter = $_GET['filter'];
 
    $results = array('Java', 'JavaScript', 'VisualBasic', 'Pascal');
    $output='[';
    foreach ($results as $key => $value) {
        if(substr_count($value, $filter)>0){
            $output .= '{ "label" : "' . $value . '", "value" : "' . $value . '"},';
        }
    }
    // обрезаем последнюю запятую и закрываем кавычки
    $output = substr($output,0,-1) . ']';
    echo $output; */

    
    
    $accountid =$_SESSION['useraccountid'];
    
		StartDB();
                       
			$SQL = "SELECT c.id_case, c.our_case_ref, c.not_closed_case 
                    FROM cases c 
                    JOIN employees e2 ON e2.id_employee = c.registrant_id
                    WHERE e2.account_id = $accountid AND 
                    (c.our_case_ref LIKE '%$searchtag%')";
			print $SQL2."<br>";				

			if ($result = mysqli_query($db, $SQL)) 
			{
				if (mysqli_num_rows($result) !=0)
				{				
					/* while( $row = mysqli_fetch_assoc($result) )
					{ 
						$myjsons[] = $row; */
						/* $myjsons[] = json_encode(array($row2)); */
						/* echo json_encode($row2); */	//функция превращает массив в формат json		
					/* } 
					echo json_encode($myjsons); */
                    while ($row = mysql_fetch_array($result))//loop through the retrieved values
                    {
                            $row['our_case_ref']=htmlentities(stripslashes($row['our_case_ref']));
                            $row['id_case']=(int)$row['id_case'];
                            $row_set[] = $row;//build an array
                    }
                    echo json_encode($row_set);//format the array into json data
				}
				
				else {
					echo json_encode(null);
				}
			}
			else
			{
				printf("Ошибка в запросе: %s\n", mysqli_error($db));
			}

			mysqli_free_result($result);

            /* $result2 = mysqli_query($db, $SQL2); */        
			/* printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result2)); */
			/* echo json_encode($row2); */ //функция превращает массив в формат json
			//echo json_encode("конец select-tabs json сработал"); 

			EndDB();
