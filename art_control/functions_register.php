
<?php

// Функция регистрации аккаунта и пользователя
function RegMember() 
{
	global $db;

	// превращаем статический контент в динамический
	global $rowno_login;
	global $rowno_password;
	global $rowlogin_exists;

	$lang = $_GET['lang'];
	if (!$lang)
	{
		$lang= 'en';	
	}
	// <?php echo $rowartlipat['phrase_'.$lang]для вставки фразы вставляем ее ключевое значение после row
	
	SelectTranslationForRegistration($lang); //kept in art_control/functions_selecting_language.php
	

	// Проверка данных, введенных в регистрационную форму	
	// проверка наличия логина кажется излишней, так как уже проверили с filter_var
	if(!$_POST['enteredemail']) 
	{
		print "<br><p>".$rowno_login['phrase_'.$lang]."</p>";
		return FALSE;
	} 

	// а вот проверка введения пароля нужна, ее еще не было
	if(!$_POST['enteredpassword']) 
	{
		print "<br><p>".$rowno_password['phrase_'.$lang]."</p>";
		return FALSE;
	} 
	
	$enteredemail = $_POST['enteredemail'];
//	print "enteredemail=".$enteredemail."<br>";

	// Проверяем не зарегистрирован ли уже аккаунт на такой email
	$SQL1 = "SELECT `inception_email` FROM `accounts` WHERE `inception_email` LIKE '".$enteredemail. "'";

	// Делаем запрос к базе
	if ($result = mysqli_query($db, $SQL1)) 
	{
		// Если есть аккаунт с таким email, то завершаем функцию
		if(mysqli_num_rows($result) > 0) 
		{
			print "<br><p>".$rowlogin_exists['phrase_'.$lang]."</p>";
			return FALSE;
		}
	}
	else
	{
		printf("Ошибка: %s\n", mysqli_error($db));
	} 
	// Если такого аккаунта нет, регистрируем его
	
	$prefix = substr($enteredemail, 0, strrpos($enteredemail, '@'));
//	print "prefix=".$prefix."<br>"; 

	$SQL2 = "INSERT INTO `accounts` 
			(`registration_date`,`inception_email`, `company_name1`) VALUES 
			(NOW(),'".$enteredemail."', '".$prefix."')";

	if (mysqli_query($db, $SQL2) === FALSE) 
	{
		printf("Ошибка в запросе на создание аккаунта: %s\n", mysqli_error($db));
	}		

	// И одновременно регистрируем пользователя
	$last_id = mysqli_insert_id($db); // получили номер аккаунта
//	print "last_id=".$last_id."<br>"; 	

	$hash_pass = password_hash($_POST['enteredpassword'], PASSWORD_DEFAULT);
	
	$imageurl = "photo/default.jpg";
	
	$SQL3 = "INSERT INTO `employees`  
			(`account_id`, `employee_nickname`, 
			`employee_level`, `employee_login`,`employee_password`, 
			`employee_picture_source`, `reg_date`) VALUES 
			($last_id, '".$prefix."', 10, '".$enteredemail."','".$hash_pass. "', '".$imageurl."', NOW())";

//	print "SQL3=".$SQL3."<br>"; 		

	if (mysqli_query($db, $SQL3) === TRUE)
	{
		//print "<br>Пользователь зарегистрирован";
	}
	else
	{
		printf("Ошибка: %s\n", mysqli_error($db));
		return FALSE;
	}
	
	return TRUE;
}


// Функция восстановления пароля для владельца аккаунта
function NewPassword($hash_boss_email) 
{
	global $db;
	global $bossemail;
	
	$SQL =  "SELECT e.id_employee, a.inception_email
	FROM employees e 
	JOIN accounts a ON a.id_account = e.account_id
	WHERE e.hashemail LIKE '".$hash_boss_email. "' AND e.employee_level = 10";
//	print "SQL  =".$SQL."<br>"; 	

	if ($result = mysqli_query($db, $SQL)) 
	{
		if(mysqli_num_rows($result) == 1) 
		{
			$row = mysqli_fetch_assoc($result);
			$bossemail = $row['inception_email'];
//			print "bossemail =".$bossemail."<br>"; 

			$hash_pass = password_hash($_POST['enteredpassword'], PASSWORD_DEFAULT);

			$SQL3 = "UPDATE employees  
			SET employee_password = '$hash_pass'
			WHERE id_employee = $row[id_employee]";
//			print "SQL3  =".$SQL3."<br>"; 

			if (mysqli_query($db, $SQL3) === TRUE)
			{
//				print "<br>Пароль успешно заменен";
				return TRUE;
			}
			else
			{
				printf("Ошибка обновления пароля: %s\n", mysqli_error($db));
				print '<p>Что бы восстановить пароль снова перейдите по ссылке в электронной почте</a></p>';
				return FALSE;
			}
		}
		else
		{
			print "<br>Пароль не может быть изменен в силу неоднозначности данных";
			print '<p>Что бы восстановить пароль снова перейдите по ссылке в электронной почте</a></p>';
			return FALSE;
		} 
	}
	else
	{
		printf("Ошибка: %s\n", mysqli_error($db));
		print '<p>Что бы восстановить пароль снова перейдите по ссылке в электронной почте</a></p>';
		return FALSE;
	} 

}

