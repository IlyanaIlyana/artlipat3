<?php 
session_start(); //вызывается из формы в функции ShowUsers() в main.php
require_once "start_mysql.php"; 
require_once "main.php"; 	
	
    $id_account = $_SESSION['useraccountid'];
  /*   $id_empl = $_SESSION['userid'];  */       
      
    $id_employee  = htmlspecialchars($_POST['id_employee']);
    $employeename  = htmlspecialchars($_POST['employeename']);
    /* $employeelevel = htmlspecialchars($_POST['employeelevel']); */
	$employeestatus_id = htmlspecialchars($_POST['employeestatus_id']);
	$imageurl  = htmlspecialchars($_POST['imageurl']);
    $uploadfile = htmlspecialchars($_POST['uploadfile']);
    //print "<br><p>POST</p>";
    //print_r($_POST);
    //print "<br><p>FILES</p>";
    //print_r($_FILES);

   /*  if (empty($_POST['enteredlevel'])){$enteredlevel=1;} */
	
	$check = file_exists($_FILES["uploadfile"]["tmp_name"]);
	if ($check == true) {
	$imageurl = ImageUpload();
	}
	//$imageurl = 'img/avatars/default.jpg';

	StartDB();

   /*   	
    $SQL = "UPDATE employees 
	SET `employee_nickname`='$employeename', 
	`status_id`='$employeestatus_id', 
	`employee_picture_source`='$imageurl',
	`employee_level`='$employeelevel' 
	WHERE `id_employee`='$id_employee'"; */

	$SQL = "UPDATE employees 
	SET `employee_nickname`='$employeename', 
	`status_id`='$employeestatus_id', 
	`employee_picture_source`='$imageurl'
	WHERE `id_employee`='$id_employee'";
	
    //print "SQL=".$SQL."<br>";
    
	if (mysqli_query($db, $SQL) === FALSE) 
	{
		printf("Ошибка в запросе на обновление данных: %s\n", mysqli_error($db));
	}		

    EndDB();

	header("Location: index.php");	