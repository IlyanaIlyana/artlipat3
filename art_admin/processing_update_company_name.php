<?php 
session_start(); //вызывается из формы в функции ShowCompanyName() в main.php
require_once "start_mysql.php"; 
require_once "main.php"; 	
	
    $id_account = $_SESSION['useraccountid'];
  /*   $id_empl = $_SESSION['userid'];  */       
      
    $company_name1  = htmlspecialchars($_POST['company_name1']);
    $company_name2  = htmlspecialchars($_POST['company_name2']);
    
    //print "<br><p>POST</p>";
    //print_r($_POST);

	StartDB();
     	
    $SQL = "UPDATE accounts 
	SET `company_name1`='$company_name1', 
	`company_name2`='$company_name2' 
	WHERE `id_account`='$id_account'";
	
    //print "SQL=".$SQL."<br>";
    
	if (mysqli_query($db, $SQL) === FALSE) 
	{
		printf("Ошибка в запросе на обновление данных: %s\n", mysqli_error($db));
	}		

    EndDB();

	header("Location: index.php");	