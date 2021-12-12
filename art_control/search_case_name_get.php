<?php session_start(); require_once "start_mysql.php";
    
    $accountid =$_SESSION['useraccountid'];    
	StartDB();  

	/* $term = trim(strip_tags($_GET['term'])); *///retrieve the search term that autocomplete sends
	$term = htmlspecialchars($_GET['term']);
	$qstring = "SELECT c.id_case, c.our_case_ref, c.not_closed_case 
				FROM cases c 
				JOIN employees e2 ON e2.id_employee = c.registrant_id
				WHERE e2.account_id = $accountid AND 
				(c.our_case_ref LIKE '%$term%')";
	$result = mysqli_query($db, $qstring);//query the database for entries containing the term		
	while ($row = mysqli_fetch_assoc($result))//loop through the retrieved values
	{		
		$row_set[] = $row['our_case_ref'];//build an array		
	}
	echo json_encode($row_set);//format the array into json data	
	
	EndDB();
