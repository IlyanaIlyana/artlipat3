<?php $title = "Artlipat"; 
require_once "header.php"; 	
require_once "art_control/functions_register.php";	
require_once "art_control/functions_selecting_language.php";

$lang = $_GET['lang'];
if (!$lang)
{
	$lang= 'en';	
}
StartDB();	
SelectTranslationRestoringPassword($lang); //kept in art_control/functions_selecting_language.php
EndDB();

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
                            print "<br><p>".$rowno_password_for_pass['phrase_'.$lang]."</p>";
                            print '<p>'.$rowpass_prompt_message["phrase_".$lang].'</a></p>';
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
								$subject = $rowpass_change['phrase_'.$lang];
								$headers  = "MIME-Version: 1.0\r\n";
                                $headers .= "Content-type: text/html; charset=utf-8\r\n";
                                $headers .= "To: <$bossemail>\r\n";
                                $headers .= "From: <noreply@artlipat.ru>\r\n";
                                $message = "
                                        <html>
                                        <head>
                                        <title>".$rowpass_change['phrase_'.$lang]."</title>
                                        </head>
                                        <body>
                                        <p>".$rowpass_notice['phrase_'.$lang]."</p>
										<p>".$rowlogin_notice['phrase_'.$lang].": $bossemail.</p>
                                        <p>".$rowto_login_after_pass['phrase_'.$lang]." <a href='https://artlipat.online/index.php'>".$rowhere['phrase_'.$lang]."</a>.</p>
                                        </body>
                                        </html>
                                        ";
								mail($to, $subject, $message, $headers);
									
								?>					
								<p class="login-img"><i class="icon_lock-open_alt"></i><?php echo $rowartlipat_2['phrase_'.$lang]?></p>
								<p><?php echo $rowpass_changed['phrase_'.$lang]?></p>
								<p><?php echo $rowpass_sent_to['phrase_'.$lang]?></p>
								<p><a href='index.php'><?php echo $rowto_login_after_pass_2['phrase_'.$lang]?></a></p>
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
							print "<br><p>".$rowpasswords_mismatch_2['phrase_'.$lang]."</p>";
                            print '<p>'.$rowpass_prompt_message["phrase_".$lang].'</a></p>';
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
				<p class="login-img"><i class="icon_lock_alt"></i><?php echo $rowartlipat_2['phrase_'.$lang]?></p>
				<div class="input-group">
					<span class="input-group-addon"><i class="icon_key_alt"></i></span>
					<input name="enteredpassword" type="password" class="form-control" placeholder="<?php echo $rownew_password['phrase_'.$lang]?>">
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="icon_key_alt"></i></span>
					<input name="password_again" type="password" class="form-control" placeholder="<?php echo $rowrepeat_new_password['phrase_'.$lang]?>">
				</div> 
                <input type= "hidden" name="hash_email_in_question" value = "<?php echo $sent_hash?>">
				<input name="register"  type="submit" class="btn btn-primary btn-lg btn-block" value="<?php echo $rowremember_new_password['phrase_'.$lang]?>">     					
			</div>
		</form>  
	</div>
</div>

<?php 
require_once "footer.php"; ?>