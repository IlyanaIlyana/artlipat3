<?php 
session_start(); //вызывается из формы в функции ShowUsers() в main.php
require_once "start_mysql.php"; 
require_once "main.php"; 

    $id_empl = $_GET['id_empl'];
	StartDB();

	$SQL = "UPDATE employees 
	SET `not_deleted_item`= 0
	WHERE `id_employee`= $id_empl";
	
//    print "SQL=".$SQL."<br>";
    
	if (mysqli_query($db, $SQL) === FALSE) 
	{
		printf("Ошибка в запросе на обновление данных: %s\n", mysqli_error($db));
	}		

    EndDB();

	header("Location: panel.php");	