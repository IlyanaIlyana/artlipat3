<?php 
session_start(); //вызывается из формы в функции ShowUsers() в main.php
require_once "start_mysql.php"; 
require_once "main.php"; 	
	
    $id_account = $_SESSION['useraccountid'];
    $id_empl = $_SESSION['userid'];        
      
    $username  = htmlspecialchars($_POST['username']);
	/* $enteredlogin  = htmlspecialchars($_POST['enteredlogin']);
	$enteredpassword = htmlspecialchars($_POST['enteredpassword']);
    $enteredlevel = htmlspecialchars($_POST['enteredlevel']); */
    $uploadfile = htmlspecialchars($_POST['uploadfile']);
    //print "<br><p>POST</p>";
    //print_r($_POST);
    //print "<br><p>FILES</p>";
    //print_r($_FILES);

   /*  if (empty($_POST['enteredlevel'])){$enteredlevel=1;} */

   	$imageurl = 'photo/default.jpg';

	$check = file_exists($_FILES["uploadfile"]["tmp_name"]);
	if ($check == true) {
	$imageurl = ImageUpload();
	}
	

	StartDB();
    
	$SQL2 = "INSERT INTO `employees` 
		(`account_id`, `employee_nickname`, 
		`employee_picture_source`, `reg_date`) VALUES 
		('".$id_account."', '".$username."', '".$imageurl."', NOW())";	
    //print "SQL2=".$SQL2."<br>";
    
	if (mysqli_query($db, $SQL2) === FALSE) 
	{
		printf("Ошибка в запросе на создание аккаунта: %s\n", mysqli_error($db));
	}		

    EndDB();

	/* $imageurl = "../img/avatars/default.jpg"; */
	
	/*  '".$imageurl."',  */
	
	header("Location: index.php");	