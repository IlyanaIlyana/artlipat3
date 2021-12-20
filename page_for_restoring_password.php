<?php session_start(); $title = "Artlipat"; 

require_once "header.php";
require_once "art_control/functions_selecting_language.php";

$lang = $_GET['lang'];
if (!$lang)
{
	$lang= 'en';	
}
StartDB();	
SelectTranslationRestoringPassword($lang); //kept in art_control/functions_selecting_language.php
EndDB(); 	

?>
<div class="page-404">
<?php
	
if (isset($_POST['doGo'])) {
    // Проверка что email введён
    if ($_POST['email']) {
        $email = $_POST['email'];

        $SQL = "SELECT `id_account` FROM `accounts` WHERE `inception_email` LIKE '".$email. "'";

        StartDB();

        if ($result = mysqli_query($db, $SQL)) 
        {
            if(mysqli_num_rows($result) > 0) // Если есть аккаунт с таким email, то 
            {
//                print "<br><p>Аккаунт с указанным логином существует</p>";

                $SQL1 =  "SELECT e.id_employee 
                FROM employees e 
                JOIN accounts a ON a.id_account = e.account_id
                WHERE a.inception_email LIKE '$email'";
//                print "SQL1  =".$SQL1."<br>"; 	

                if ($result1 = mysqli_query($db, $SQL1)) 
                 {
                    $row1 = mysqli_fetch_assoc($result1);
                    $employee_id = $row1['id_employee'];
                 }
                 else{printf("Ошибка выбора сотрудника: %s\n", mysqli_error($db));}

                // хешируем хеш, который состоит из email и времени
                $hash = md5($email . time());

                $SQL2 = "UPDATE `employees` SET hashemail='$hash', emailhash_date=Now() WHERE id_employee='$employee_id'";
//                print "SQL2  =".$SQL2."<br>"; 

                if (!mysqli_query($db, $SQL2)) 
                {
                    printf("Ошибка обновления записи hash  в employees: %s\n", mysqli_error($db));
                } 

                $headers  = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=utf-8\r\n";
                $headers .= "To: <$email>\r\n";
                $headers .= "From: <noreply@artlipat.ru>\r\n";
                $message = '
                        <html>
                        <head>
                        <title>'.$rowconfirm_email["phrase_".$lang].'</title>
                        </head>
                        <body>
                        <p>'.$rowpassword_ref["phrase_".$lang].' <a href="http://artlipat.online/new_password.php?hash=' . $hash . '">'.$rowpass_link["phrase_".$lang].'</a></p>
                        </body>
                        </html>
                        ';
        
                if (mail($email, "Восстановление пароля Артлипат через email/".$rowpassword_recover['phrase_'.$lang], $message, $headers)) {
                    ?>
                        <p><?php echo $rowpassword_ref_sent['phrase_'.$lang]?> </p>
                    </div>
                    <?php  
                    
                } else {
                    ?>
                        <p><?php echo $rowpassword_error_message['phrase_'.$lang]?></p>
                    </div>
                    <?php  
                }
                exit();  
            }
            else {
                ?>
                    <p><?php echo $rowno_login_for_pass['phrase_'.$lang]?></p>
                <?php  
            }
        }
        else
        {
            printf("Ошибка: %s\n", mysqli_error($db));
        } 
                
        EndDB();
        
    } else {
        ?>
            <p><?php echo $rowno_email_for_pass['phrase_'.$lang]?></p>
        <?php 
    }
}

?>   
<form class="login-form" action="page_for_restoring_password.php" method="post">
    <p><?php echo $rowenter_email['phrase_'.$lang]?>: <input class="form-control" type="email" name="email" placeholder="<?php echo $rowreg_email['phrase_'.$lang]?>"></p>
    <p><input class="btn btn-primary btn-lg btn-block" type="submit" value="<?php echo $rowsend_to_email['phrase_'.$lang]?>" name="doGo"></p>
</form>

<a href="index.php"><?php echo $rowto_login['phrase_'.$lang]?></a>
</div>
<?php   

require_once "footer.php"; ?>
