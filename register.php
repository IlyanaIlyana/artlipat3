<?php $title = "Управление делами"; 
require_once "header.php"; 	
require_once "art_control/functions_register.php";	

// Если была нажата кнопка "зарегистрироваться")
if(isset($_POST['register'])) 
{
	?>
	<!--здесь появляется информация о регистрации-->
	<div class="login-img3-body">
		<div class="container">
			<div class="login-form " style="margin-top: 50px">
				<div class="login-wrap">
					<?php	
						
					$control_data1 = $_POST['control_data1'];
//					print "control_data1=".$control_data1."<br>";
					$control_data2 = $_POST['control_data2'];
//					print "control_data2=".$control_data2."<br>";
					$control_data3 = $_POST['control_data3'];
//					print "control_data3=".$control_data3."<br>";

					$today = getdate();	
					$year = $today['year'];					
//					print_r($year);
						
					if (!$control_data1 && $control_data2==$year)
					{
						//print_r("ok");

						$email = $_POST['enteredemail'];						
						if(filter_var($email, FILTER_VALIDATE_EMAIL))
						{			
							// Проверяем совпадение паролей
							if ($_POST['enteredpassword'] === $_POST['password_again']) 
							{
								// Регистрация пользователя
								StartDB();
								$res = RegMember();
								EndDB();								
								if($res)
								{
									ini_set( 'display_errors', 1 );
									error_reporting( E_ALL );

									$serviceaddress="https://artlipat.ru/artlipat2/index.php";
									$from = "support@artlipat.ru";

									$to1 = "anechke@list.ru";
									$subject1 = "ARTLIPAT new client/Регистрация нового клиента в Артлипат";
									$message1 = "Кто-то зарегился на $email, проверь!"; 

									$headers1 = "From:" . $from;

									mail($to1, $subject1, $message1, $headers1);

									$to = $email;
									$subject = "ARTLIPAT registration/Регистрация в Артлипат";
									//$message2 = "Переход $serviceaddress \r\nВаш логин: $email."; не работает
									// $message2 = "зарегился $serviceaddress \r\nВаш логин: $email.";
									$headers  = "MIME-Version: 1.0\r\n";
                                    $headers .= "Content-type: text/html; charset=utf-8\r\n";
                                    $headers .= "To: <$email>\r\n";
                                    $headers .= "From: <support@artlipat.ru>\r\n";
                                    $message = "
                                            <html>
                                            <head>
                                            <title>ARTLIPAT registration/Регистрация в Артлипат</title>
                                            </head>
                                            <body>
                                            <p>Вы успешно зарегистрировались в системе.</p>
											<p>Ваш логин - адрес этой электронной почты: $email.</p>
                                            <p>Для использования сервиса перейдите по <a href='https://artlipat.ru/artlipat2/index.php'>ссылке</a>.</p>
                                            </body>
                                            </html>
                                            ";
									mail($to, $subject, $message, $headers);
									
									?>					
									<p class="login-img"><i class="icon_lock-open_alt"></i>Артлипат</p>
									<p>Вы успешно зарегистрировались в системе.</p>
									<p>Ссылка для входа в сервис направлена на адрес электронной почты, указанный при регистрации (загляни в спам).</p>
									<p><a href='index.php'>Перейти сейчас к работе в системе</a></p>
									<?php 
									
									exit(); 					
								}
								else
								{
									/* print "<br><p>Во время регистрации произошли ошибки</p>";  */
									//эта фраза просто кажется лишней; тем более, что появляется не для всех ощибок
								}
							}
							else
							{
								print "<br><p>Введенные пароли не совпадают</p>";
							}	
						}

						else
						{
							print("<p>Логин $email не является email-адресом</p>");
						}
					}
					else
					{
						print("<p>Ваша регистрация отнесена к спаму. Обратитесь к владельцу сервиса или повторите вновь</p>");
					}	
					?>

				</div>
			</div>  
		</div>
	</div>

	<?php 
}	
				
if ($res !==TRUE)
{
	// превращаем статический контент в динамический
	
	$lang = $_GET['lang'];
	if (!$lang)
	{
		$lang= 'en';	
	}
	StartDB();	
	$SQLartlipat = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'artlipat'";
	
	if (!$resultartlipat = mysqli_query($db, $SQLartlipat)) 
	{
		printf("Ошибка запроса к базе: %s\n", mysqli_error($db));
	} 

	if(mysqli_num_rows($resultartlipat) == 0) 
	{
		print "<br><p>Не получаю перевод</p>";		
	}
	$rowartlipat = mysqli_fetch_assoc($resultartlipat);

	$SQLemail_prompt = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'email_prompt'";
	$rowemail_prompt = mysqli_fetch_assoc(mysqli_query($db, $SQLemail_prompt));

	$SQLpassword_prompt1 = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'password_prompt1'";
	$rowpassword_prompt1 = mysqli_fetch_assoc(mysqli_query($db, $SQLpassword_prompt1));

	$SQLpassword_prompt2 = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'password_prompt2'";
	$rowpassword_prompt2 = mysqli_fetch_assoc(mysqli_query($db, $SQLpassword_prompt2));

	EndDB()
	?>

	<!--это начальное содержимое страницы-->
	
	<div class="login-img3-body">
		<div class="container">
			<form class="login-form" action="register.php" method="post" style="margin-top: 50px">
				<div class="login-wrap">
					<div class="btn-group" data-toggle="buttons" style="left:200px">
                        <label class="btn btn-info"> <input type="radio" name="lang_registration" value="en" id="en" lang="en"> EN </label>
                        <label class="btn btn-info active"><input type="radio" name="lang_registration" value="ru" id="ru" lang="ru"> RU </label>                      
                    </div>
					<p class="login-img"><i class="icon_lock_alt"></i><?php echo $rowartlipat['phrase_'.$lang]?></p>
					<div class="input-group">
						<span class="input-group-addon"><i class="icon_profile"></i></span>
						<input name="enteredemail" type="email" class="form-control" placeholder="<?php echo $rowemail_prompt['phrase_'.$lang]?>" autofocus>						
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="icon_key_alt"></i></span>
						<input name="enteredpassword" type="password" class="form-control" placeholder="<?php echo $rowpassword_prompt1['phrase_'.$lang]?>">
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="icon_key_alt"></i></span>
						<input name="password_again" type="password" class="form-control" placeholder="<?php echo $rowpassword_prompt2['phrase_'.$lang]?>">
					</div> 
					<p style="color:#064d89">Подтверждение регистрации будет отправлено на указанный адрес</p>
					<p>Для разблокировки кнопки регистрации и защиты от спама укажите текущий год вручную</p>
					<div  hidden="true">
					<div class="input-group">
						<span class="input-group-addon"></span>
						<input name="control_data1" autocomplete="off" type="text" class="form-control" placeholder="Текущий год (четыре цифры)" >
					</div> 
					</div>
					<div class="input-group">
						<span class="input-group-addon"></span>
						<input name="control_data2" id="control_data2" type="text" class="form-control" placeholder="Текущий год (четыре цифры)">
					</div>
					<div>
						<input name="register" type="submit" class="btn btn-primary btn-lg btn-block" id="buttonSubmit" value="Зарегистрироваться"> 					
					</div>
				</div>
			</form>  

			
		</div>
	</div>

	<div class="login-img3-body">
		<div class="container">
			<div class="login-form " style="margin-top: 50px">
				<div class="login-wrap">						
					<p><a href="index.php">Переход к сервису</a></p>
				</div>
			</div>
		</div>
	</div>

	<?php   
}

require_once "footer.php"; ?>