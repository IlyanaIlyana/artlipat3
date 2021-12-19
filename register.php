<?php $title = "Registering"; 
require_once "header.php"; 	
/* require_once "art_control/functions_register.php";	
require_once "art_control/functions_selecting_data.php"; */
require_once "art_control/functions_register.php";	
require_once "art_control/functions_selecting_language.php";

$lang = $_GET['lang'];
if (!$lang)
{
	$lang= 'en';	
}
StartDB();	
SelectTranslationForRegistration($lang); //kept in art_control/functions_selecting_language.php
EndDB();
// <?php echo $rowartlipat['phrase_'.$lang] для вставки фразы вставляем ее ключевое значение после row

// Если была нажата кнопка "зарегистрироваться")
if(isset($_POST['register'])) 
{
/* 	$lang = $_GET['lang'];
	if (!$lang)
	{
		$lang= 'en';	
	}
	StartDB();	
	SelectTranslationForRegistration($lang); //kept in art_control/functions_selecting_language.php
	EndDB(); */
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
								$res = RegMember(); // in art_control/function_register.php
								EndDB();								
								if($res)
								{
									ini_set( 'display_errors', 1 );
									error_reporting( E_ALL );

									/* $serviceaddress="https://artlipat.ru/artlipat2/index.php"; */
									$from = "support@artlipat.ru";

									$to1 = "anechke@list.ru";
									$subject1 = "ARTLIPAT new client/Регистрация нового клиента в Артлипат";
									$message1 = "Кто-то зарегился на $email, проверь!"; 

									$headers1 = "From:" . $from;

									mail($to1, $subject1, $message1, $headers1);

									$to = $email;
									$subject = $rowregistration_title['phrase_'.$lang];
									$headers  = "MIME-Version: 1.0\r\n";
                                    $headers .= "Content-type: text/html; charset=utf-8\r\n";
                                    $headers .= "To: <$email>\r\n";
                                    $headers .= "From: <support@artlipat.ru>\r\n";
                                    $message = "
                                            <html>
                                            <head>
                                            <title>".$rowregistration_title['phrase_'.$lang]."</title>
                                            </head>
                                            <body>
                                            <p>".$rowregister_text['phrase_'.$lang]."</p>
											<p>".$rowlogin_text['phrase_'.$lang]." $email.</p>
                                            <p>".$rowto_login_go['phrase_'.$lang]." <a href='https://artlipat.online/index.php'>".$rowlink['phrase_'.$lang]."</a>.</p>
                                            </body>
                                            </html>
                                            ";
									mail($to, $subject, $message, $headers);
									
									?>					
									<p class="login-img"><i class="icon_lock-open_alt"></i><?php echo $rowartlipat['phrase_'.$lang]?></p>
									<p><?php echo $rowregister_text['phrase_'.$lang]?></p>
									<p><?php echo $rowlink_text['phrase_'.$lang]?></p>
									<p><a href='index.php'><?php echo $rowto_login_page['phrase_'.$lang]?></a></p>
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
								print "<br><p>".$rowmismatch_text['phrase_'.$lang]."</p>";
							}	
						}

						else
						{
							print("<p>".$rowlogin['phrase_'.$lang]." ". $email." ".$rownot_email_text['phrase_'.$lang]."</p>");
						}
					}
					else
					{
						print("<p>".$rowspam_text['phrase_'.$lang]."</p>");
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
	
/* 	$lang = $_GET['lang'];
	if (!$lang)
	{
		$lang= 'en';	
	}
	StartDB();	
	SelectTranslationForRegistration($lang); //kept in art_control/functions_selecting_language.php
	EndDB(); */
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
					<p style="color:#064d89"><?php echo $rowconfirm_text['phrase_'.$lang]?></p>
					<p><?php echo $rowdeblock_text['phrase_'.$lang]?></p>
					<div  hidden="true">
					<div class="input-group">
						<span class="input-group-addon"></span>
						<input name="control_data1" autocomplete="off" type="text" class="form-control" placeholder="<?php echo $rowyear_text['phrase_'.$lang]?>" >
					</div> 
					</div>
					<div class="input-group">
						<span class="input-group-addon"></span>
						<input name="control_data2" id="control_data2" type="text" class="form-control" placeholder="<?php echo $rowyear_text['phrase_'.$lang]?>">
					</div>
					<div>
						<input name="register" type="submit" class="btn btn-primary btn-lg btn-block" id="buttonSubmit" value="<?php echo $rowregister['phrase_'.$lang]?>"> 					
					</div>
				</div>
			</form>  
		</div>
	</div>

	<div class="login-img3-body">
		<div class="container">
			<div class="login-form " style="margin-top: 50px">
				<div class="login-wrap">						
					<p><a href="index.php"><?php echo $rowto_login['phrase_'.$lang]?></a></p>
				</div>
			</div>
		</div>
	</div>

	<?php   
}

require_once "footer.php"; ?>