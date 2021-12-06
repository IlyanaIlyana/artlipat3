<?php 
session_start(); //вызывается из формы в функции ShowUsers() в main.php
require_once "start_mysql.php"; 
require_once "main.php"; 

    $id_acc = $_GET['id_acc'];
	StartDB();

    $SQL = "UPDATE accounts 
	SET `not_deleted_item`= 1
	WHERE `id_account`= $id_acc";
//    print "SQL=".$SQL."<br>";
    
	if (mysqli_query($db, $SQL) === FALSE) 
	{
		printf("Ошибка в запросе на обновление данных: %s\n", mysqli_error($db));
	}	

	$SQL = "UPDATE employees 
	SET `not_deleted_item`= 0
	WHERE `account_id`= $id_acc";
	
 //   print "SQL=".$SQL."<br>";
    
	if (mysqli_query($db, $SQL) === FALSE) 
	{
		printf("Ошибка в запросе на обновление данных: %s\n", mysqli_error($db));
	}		

    EndDB();

	header("Location: panel.php");	