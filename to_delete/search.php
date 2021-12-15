<?php session_start(); require_once "art_control/start_mysql.php";
//connect to your database
StartDB();

$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

$qstring = "SELECT what as value,id_what FROM whats WHERE what LIKE '%".$term."%'";
$result = mysqli_query($db, $qstring);//query the database for entries containing the term

while ($row = mysqli_fetch_assoc($result))//loop through the retrieved values
{
		$row['value']=htmlentities(stripslashes($row['value']));        
		$row['id']=(int)$row['id'];
		$row_set[] = $row;//build an array
}
echo json_encode($row_set);//format the array into json data

EndDB();
?>