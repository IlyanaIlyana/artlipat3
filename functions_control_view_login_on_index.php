<?php

// Проверка авторизации
function CheckLogin() 	// вызывает здесь функции ShowLogin, потом CheckPassword; а потом ShowFirstPage из другого файла php
						//сама вызывается из index.php
{
	// Если авторизация есть
	if(isset($_SESSION['userid']))
	{		
		ShowFirstPage(); //  из  файла function_view_on_index.php
		return;
	}
	// Проверка логина
	if(isset($_POST['enteredlogin']))
	{
		$_SESSION['userlogin'] = $_POST['enteredlogin']; // теперь в сессии у нас есть логин
		$_SESSION['userpassword'] = $_POST['enteredpassword']; // теперь в сессии у нас есть пароль
		//print "<br>Логин ".$_SESSION['login'];
		//print "<br>Пароль ".$_SESSION['password'];

		// Проверка пароля
		if(CheckPassword()) // вызов из этого файла php
		{		
			ShowFirstPage();	 //  из файла function_view_on_index.php		
		}
		else
		{
			?>			
			<p>Доступ запрещен</p>																						
			<a type="button" class="btn btn-info"href="index.php">Введите логин и пароль повторно</a>
			<p></p>	
			<a type="button" class="btn btn-warning" href="page_for_restoring_password.php">Восстановление пароля <br> (доступно только для босса) </a>	
			</div>
			<?php
		}
    }
	else
	{
		//print "нужно логиниться";
		ShowLogin(); // вызов из этого файла php
	}
}

function CheckPassword() // это конечная функция, вызывалась здесь из CheckLogin
{
	global $db;
    // Составляем строку запроса
    $SQL = "SELECT * FROM employees WHERE employee_login LIKE '".$_SESSION['userlogin']."'";

	if ($result = mysqli_query($db, $SQL)) 
	{
		// Если нет пользователя с таким логином, то завершаем функцию
		if(mysqli_num_rows($result)== 0) 
		{
			?>						
				<div class="page-404">
				<p class="text-404"><i class="icon_lock_alt"></i></p>
				<h2>Пара логин-пароль <br> не совпадает</h2><br>									
			<?php								
			return FALSE;
		}

		// Если логин есть, то проверяем пароль
		$row = mysqli_fetch_assoc($result); 
		if (password_verify($_SESSION['userpassword'], $row['employee_password'])) // проверка хэшированного пароля		
		{
			//print "<br>Пароль совпадает<br>";
			$_SESSION['userid'] = $row['id_employee']; // теперь в сессии у нас есть id сотрудника
			$_SESSION['userlevel'] = $row['employee_level']; // теперь в сессии у нас есть уровень доступа сотрудника
			$_SESSION['useraccountid'] = $row['account_id']; // теперь в сессии у нас есть id аккаунта!!!
			$_SESSION['userphotourl'] = $row['employee_picture_source']; // теперь в сессии у нас есть ссылка на фото сотрудника
			$_SESSION['username'] = $row['employee_nickname']; // теперь в сессии у нас есть имя сотрудника
			// получаем название компании в сессию
			$SQL1 = "SELECT * FROM accounts WHERE id_account LIKE '".$_SESSION['useraccountid']."'";
			//print "SQL1=".$SQL1;
			if ($result1 = mysqli_query($db, $SQL1)) 
			{
				$row1 = mysqli_fetch_assoc($result1); 
				$_SESSION['accountname1'] = $row1['company_name1']; // теперь в сессии у нас есть имя1 аккаунта
				$_SESSION['accountname2'] = $row1['company_name2']; // теперь в сессии у нас есть имя2 аккаунта				
			}
			else
			{
				printf("Ошибка: %s\n", mysqli_error($db));
			}
			//print_r($_SESSION);	
			return TRUE;
		}
	}
	else
	{
		printf("Ошибка: %s\n", mysqli_error($db));
	}
    unset($_SESSION['userid']); // наличие $_SESSION['userid'] дает возоможность увидеть ShowFirstPage() из CheckLogin() с index.php
	// нужно ли сюда result free? 
	?>								
		<div class="page-404">
		<p class="text-404"><i class="icon_lock_alt"></i></p>
		<h2>Пара логин-пароль <br> не совпадает<br></h2>									
	<?php	
    return FALSE;
}

function ShowLogin() //вызывается здесь из CheckLogin
{
	?>	
	<div class="login-img3-body">
		<div class="container">
			<form class="login-form" action="index.php" method="post">
				<div class="login-wrap">
					<p class="login-img"><i class="icon_lock_alt"></i>Артлипат</p>
					<div class="input-group">
						<span class="input-group-addon"><i class="icon_profile"></i></span>
						<input name="enteredlogin" type="text" class="form-control" placeholder="Логин" autofocus>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="icon_key_alt"></i></span>
						<input name="enteredpassword" type="password" class="form-control" placeholder="Пароль">
					</div>        
					<button class="btn btn-primary btn-lg btn-block" type="submit">Войти</button>
				</div>
			</form>  
			<div class="page-404">
			<a href="register.php">Переход к регистрации новой компании</a>
			</div>
		</div>
	</div>
	<?php
}


