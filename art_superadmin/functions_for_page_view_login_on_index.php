<?php

// Проверка авторизации
function CheckLogin() 	// вызывает здесь функции ShowLogin, потом CheckPassword; 
						//сама вызывается из index.php
{
	// Если авторизация есть
	if(isset($_SESSION['adminid']))
	{		
		?>																					
			<a href="panel.php">переход в панель администрирования</a>	 
			</div>
			<?php 	 print_r ($_SESSION);
		return;
	}
	// Проверка логина
	if(isset($_POST['enteredlogin']))
	{
		$_SESSION['adminlogin'] = $_POST['enteredlogin']; // теперь в сессии у нас есть логин
		$_SESSION['adminpassword'] = $_POST['enteredpassword']; // теперь в сессии у нас есть пароль

		// Проверка пароля
		if(CheckPassword()) // вызов из этого файла php
		{		
			?>																					
			<a href="panel.php">в панель администрирования</a>	
			</div>
			<?php	 	//print_r ($_SESSION);	
		}
		else
		{
			?>			
			<p>Доступ запрещен</p>																						
			<a href="index.php">Введите логин и пароль повторно</a>	
			</div>
			<?php
		}
    }
	else
	{
		//print "нужно логиниться";
		ShowLogin(); // вызов из этого файла php
		//print_r ($_SESSION);
	}
}

function CheckPassword() // это конечная функция, вызывалась здесь из CheckLogin
{
	global $db;
    // Составляем строку запроса
    $SQL = "SELECT * FROM admins WHERE admin_login LIKE '".$_SESSION['adminlogin']."'";

	if ($result = mysqli_query($db, $SQL)) 
	{
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
		if (password_verify($_SESSION['adminpassword'], $row['admin_password'])) // проверка хэшированного пароля		
		{
			$_SESSION['adminid'] = $row['id_admin']; // теперь в сессии у нас есть id 
            //print "<br>Пароль совпадает<br>";
			//print_r($_SESSION);	
			return TRUE;
		}
	}
	else
	{
		printf("Ошибка: %s\n", mysqli_error($db));
	}
    unset($_SESSION['adminid']); // наличие $_SESSION['userid'] дает возоможность увидеть ShowFirstPage() из CheckLogin() с index.php
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
					<p class="login-img"><i class="icon_lock_alt"></i>Артлипат Админ</p>
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
		</div>
	</div>
	<?php
}


