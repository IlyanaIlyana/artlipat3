<?php session_start(); require_once "art_control/start_mysql.php";


	$searchtag = '';
	if(isset($_POST['mPsearchtag'])) 
	{	
		$searchtag = htmlspecialchars($_POST['mPsearchtag']);	
		//print "searchtag=".$searchtag."<br>";
	}	
    
    $accountid =$_SESSION['useraccountid'];

// выбираем закладки, соответствующие заданному поисковому слову
    
			StartDB();
                       
			$SQL2 = "SELECT c.id_case, c.our_case_ref, c.client_case_ref, c.pto_case_ref, c.not_closed_case 
                    FROM cases c 
                    JOIN employees e2 ON e2.id_employee = c.registrant_id
                    WHERE e2.account_id = $accountid AND 
                    (c.our_case_ref LIKE '%$searchtag%' OR c.client_case_ref LIKE '%$searchtag%' OR c.pto_case_ref LIKE '%$searchtag%')";
			//print $SQL2."<br>";				

			if ($result2 = mysqli_query($db, $SQL2)) 
			{
				if (mysqli_num_rows($result2) !=0)
				{				
					while( $row2 = mysqli_fetch_assoc($result2) )
					{ 
						$myjsons[] = $row2;
						/* $myjsons[] = json_encode(array($row2)); */
						/* echo json_encode($row2); */	//функция превращает массив в формат json		
					} 
					echo json_encode($myjsons);
				}
				
				else {
					echo json_encode(null);
				}
			}
			else
			{
				printf("Ошибка в запросе: %s\n", mysqli_error($db));
			}

			mysqli_free_result($result2);

            /* $result2 = mysqli_query($db, $SQL2); */        
			/* printf ("Число строк в запросе: %d<br>", mysqli_num_rows($result2)); */
			/* echo json_encode($row2); */ //функция превращает массив в формат json
			//echo json_encode("конец select-tabs json сработал"); 

			EndDB();
