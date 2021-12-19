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

	// превращаем статический контент в динамический	
	global $db;
	global $rowartlipat;
	global $rowlogin;
	global $rowpassword;
	global $rowenter;
	global $rowto_new_registration;

	global $rowaccess_denied;
	global $rowrepeat_login;
	global $rowpassword_recover;
	global $rowavailability;
	
	$lang = $_GET['lang'];
	if (!$lang)
	{
		$lang= 'en';	
	}
	//StartDB();	
	SelectTranslationForLogin($lang); //kept in art_control/functions_selecting_language.php
	//EndDB();



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
			<p><?php echo $rowaccess_denied['phrase_'.$lang]?></p>																						
			<a type="button" class="btn btn-info"href="index.php"><?php echo $rowrepeat_login['phrase_'.$lang]?></a>
			<p></p>	
			<a type="button" class="btn btn-warning" href="page_for_restoring_password.php"><?php echo $rowpassword_recover['phrase_'.$lang]?><br><?php echo $rowavailability['phrase_'.$lang]?> </a>	
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

	// превращаем статический контент в динамический	
/* 	global $db;
	global $rowartlipat;
	global $rowlogin;
	global $rowpassword;
	global $rowenter;
	global $rowto_new_registration; */

	global $rowlogin_password;
	global $rownot_match;
	
	$lang = $_GET['lang'];
	if (!$lang)
	{
		$lang= 'en';	
	}
	//StartDB();	
	SelectTranslationForLogin($lang); //kept in art_control/functions_selecting_language.php
	//EndDB();



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
				<h2><?php echo $rowlogin_password['phrase_'.$lang]?><br><?php echo $rownot_match['phrase_'.$lang]?></h2><br>									
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
				$_SESSION['language'] = $row1['language']; // теперь в сессии у нас есть язык				
			}
			else
			{
				printf("Ошибка: %s\n", mysqli_error($db));
			}
			//print_r($_SESSION);	

			global $result_emplos;  
			SelectEmployeesOnAccountId();   
			$_SESSION['usersolo'] = mysqli_num_rows($result_emplos); // теперь в сессии знаем, сольный ли аккаунт
			
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
		<h2><?php echo $rowlogin_password['phrase_'.$lang]?><br><?php echo $rownot_match['phrase_'.$lang]?></h2><br>									
	<?php	
    return FALSE;
}

function ShowLogin() //вызывается здесь из CheckLogin
{
	// превращаем статический контент в динамический	
	global $db;
	global $rowartlipat;
	global $rowlogin;
	global $rowpassword;
	global $rowenter;
	global $rowto_new_registration;
	
	$lang = $_GET['lang'];
	if (!$lang)
	{
		$lang= 'en';	
	}
	//StartDB();	
	SelectTranslationForLogin($lang); //kept in art_control/functions_selecting_language.php
	//EndDB();
	?>	
	<div class="login-img3-body">
		<div class="container">
			<form class="login-form" action="index.php" method="post" style="margin-top: 50px">
				<div class="login-wrap">
					<div class="btn-group" data-toggle="buttons" style="left:200px">
                        <label class="btn btn-info"> <input type="radio" name="lang_registration" value="en" id="en" lang="en"> EN </label>
                        <label class="btn btn-info active"><input type="radio" name="lang_registration" value="ru" id="ru" lang="ru"> RU </label>                      
                    </div>	
					<p class="login-img"><i class="icon_lock_alt"></i><?php echo $rowartlipat['phrase_'.$lang]?></p>
					<div class="input-group">
						<span class="input-group-addon"><i class="icon_profile"></i></span>
						<input name="enteredlogin" type="text" class="form-control" placeholder="<?php echo $rowlogin['phrase_'.$lang]?>" autofocus>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="icon_key_alt"></i></span>
						<input name="enteredpassword" type="password" class="form-control" placeholder="<?php echo $rowpassword['phrase_'.$lang]?>">
					</div>        
					<button class="btn btn-primary btn-lg btn-block" type="submit"><?php echo $rowenter['phrase_'.$lang]?></button>
				</div>
			</form>  			
		</div>
	</div>
	<div class="login-img3-body">
		<div class="container">
			<div class="login-form " style="margin-top: 50px">
				<div class="login-wrap">						
					<p><a href="register.php"><?php echo $rowto_new_registration['phrase_'.$lang]?></a></p>
				</div>
			</div>
		</div>
	</div>
	<?php
}


