<?php $title = "Управление делами"; 
require_once "header.php"; 	
require_once "functions.php";	

$sent_hash = $_GET['hash'];

// Если была нажата кнопка "зарегистрироваться"
if(isset($_POST['register'])) 
{
    //    print_r($_POST);
    $hash_email_in_question = $_POST['hash_email_in_question'];
    //  print "<br>hash_email_in_question=".$hash_email_in_question."<br>";

	?>

	<!--здесь появляется информация о регистрации-->
	<div class="login-img3-body">
		<div class="container">
			<div class="login-form">
				<div class="login-wrap">
					<?php				
						if(!$_POST['enteredpassword']) 
                        {
                            print "<br><p>Не указан пароль</p>";
                            print '<p>Чтобы восстановить пароль снова перейдите по ссылке в электронной почте</a></p>';
                            return FALSE;
                            exit();
                        }
                            
						if ($_POST['enteredpassword'] === $_POST['password_again']) 
						{
							StartDB();
							$res = NewPassword($hash_email_in_question);
							EndDB();	
							if($res)
							{
								ini_set( 'display_errors', 1 );
								error_reporting( E_ALL );
									
								$from = "noreply@artlipat.ru";

								$to1 = "anechke@list.ru";
								$subject1 = "Замена пароля в Артлипат";
								$message1 = "Заменен пароль для $bossemail, проверь!"; 

								$headers1 = "From:" . $from;

								mail($to1, $subject1, $message1, $headers1);

								$to = $bossemail;
								$subject = "Смена пароля в Артлипат";
								$headers  = "MIME-Version: 1.0\r\n";
                                $headers .= "Content-type: text/html; charset=utf-8\r\n";
                                $headers .= "To: <$bossemail>\r\n";
                                $headers .= "From: <noreply@artlipat.ru>\r\n";
                                $message = "
                                        <html>
                                        <head>
                                        <title>Смена пароля в Артлипат</title>
                                        </head>
                                        <body>
                                        <p>Ваш пароль был изменен. Если это сделали не вы, срочно свяжитесь с владельцем сервиса</p>
										<p>Ваш логин - адрес этой электронной почты: $bossemail.</p>
                                        <p>Для исползования сервиса перейдите по <a href='https://artlipat.ru/index.php'>ссылке</a>.</p>
                                        </body>
                                        </html>
                                        ";
								mail($to, $subject, $message, $headers);
									
								?>					
								<p class="login-img"><i class="icon_lock-open_alt"></i>Артлипат</p>
								<p>Ваш пароль был изменен.</p>
								<p>Уведомление отправлено на адрес электронной почты, указанный при регистрации (загляни в спам).</p>
								<p><a href='index.php'>Перейти сейчас к работе в системе</a></p>
								<?php 
									
								exit(); 					
							}
							else
								{
									/* print "<br><p>Во время регистрации произошли ошибки</p>";  */
									//эта фраза просто кажется лишней; тем более, что появляется не для всех ощибок
                                    exit(); 
								}
						}
						else
						{
							print "<br><p>Введенные пароли не совпадают</p>";
                            print '<p>Что бы восстановить пароль снова перейдите по ссылке в эелектронной почте</a></p>';
							exit();
                        }	
					?>
				</div>
			</div>  
		</div>
	</div>

	<?php 
}	
?>

<!--это начальное содержимое страницы-->
<div class="login-img3-body">
	<div class="container">
		<form class="login-form" action="new_password.php" method="post">
			<div class="login-wrap">
				<p class="login-img"><i class="icon_lock_alt"></i>Артлипат</p>
				<div class="input-group">
					<span class="input-group-addon"><i class="icon_key_alt"></i></span>
					<input name="enteredpassword" type="password" class="form-control" placeholder="Новый пароль">
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="icon_key_alt"></i></span>
					<input name="password_again" type="password" class="form-control" placeholder="Повторите пароль">
				</div> 
                <input type= "hidden" name="hash_email_in_question" value = "<?php echo $sent_hash?>">
				<input name="register"  type="submit" class="btn btn-primary btn-lg btn-block" value="Записать новый пароль для босса">     					
			</div>
		</form>  
	</div>
</div>

<?php 
require_once "footer.php"; ?>