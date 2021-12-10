<?php session_start(); require_once "start_mysql.php";
    
    $accountid =$_SESSION['useraccountid'];    
	StartDB();  

	$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends
	$qstring = "SELECT c.id_case, c.our_case_ref, c.not_closed_case 
				FROM cases c 
				JOIN employees e2 ON e2.id_employee = c.registrant_id
				WHERE e2.account_id = $accountid AND 
				(c.our_case_ref LIKE '%$searchtag%')";
	$result = mysql_query($qstring);//query the database for entries containing the term		
	while ($row = mysql_fetch_array($result))//loop through the retrieved values
	{		
		$row_set[] = $row['city'];//build an array		
	}
	echo json_encode($row_set);//format the array into json data	
	
	EndDB();
