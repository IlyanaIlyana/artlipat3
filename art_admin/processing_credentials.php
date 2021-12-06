<?php 
session_start(); //вызывается из формы в функции ShowUsers() в main.php
require_once "start_mysql.php"; 
require_once "main.php"; 	
	
    $id_account = $_SESSION['useraccountid'];
  /*   $id_empl = $_SESSION['userid'];  */       
      
    $id_employee  = htmlspecialchars($_POST['id_employee']);
    $employeelogin  = htmlspecialchars($_POST['employeelogin']);
    $employeelevel = htmlspecialchars($_POST['employeelevel']);
    $enteredlogin  = htmlspecialchars($_POST['enteredlogin']);
	$enteredpassword = htmlspecialchars($_POST['enteredpassword']);
	    
    //print "<br><p>POST</p>";
    //print_r($_POST);
    //print "<br><p>FILES</p>";
    //print_r($_FILES);

   /*  if (empty($_POST['enteredlevel'])){$enteredlevel=1;} */
	
    // Проверка данных
	if(!$_POST['enteredlogin']) 
	{
		print "<br><p>Не указан логин</p>";
		return FALSE;
	} 

	if(!$_POST['enteredpassword']) 
	{
		print "<br><p>Не указан пароль</p>";
		return FALSE;
	}
		
	$SQL1 = "SELECT `employee_login` FROM employees WHERE `account_id` LIKE ".$id_account." AND `employee_login` LIKE '".$employeelogin."'";
    //print "<br>SQL1=".$SQL1."<br>";

	// Делаем запрос к базе
    StartDB();
	if ($result = mysqli_query($db, $SQL1)) 
	{
		// Если есть аккаунт с таким логином
		if(mysqli_num_rows($result) > 0 AND $enteredlogin!==$employeelogin) 
		{
			print "<br><p>Аккаунт с указанным логином уже зарегистрирован</p>";			
		}
	}
	else
	{
		printf("Ошибка: %s\n", mysqli_error($db));
	} 
	// Если такого аккаунта нет, регистрируем его
 	
	 $hash_pass = password_hash($_POST['enteredpassword'], PASSWORD_DEFAULT);
     	
    $SQL = "UPDATE employees 
	SET `employee_login`='$enteredlogin', 
	`employee_password`='$hash_pass', 
	`employee_level`='$employeelevel' 
	WHERE `id_employee`='$id_employee'";		
    //print "SQL=".$SQL."<br>";
    
	if (mysqli_query($db, $SQL) === FALSE) 
	{
		printf("Ошибка в запросе на обновление данных: %s\n", mysqli_error($db));
	}		

    EndDB();

	header("Location: index.php");	