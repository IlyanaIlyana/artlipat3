<?php session_start(); $title = "Artlipat"; 

require_once "header.php"; 	

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
                        <title>Подтвердите Email</title>
                        </head>
                        <body>
                        <p>Чтобы восстановить пароль перейдите по <a href="http://artlipat.online/new_password.php?hash=' . $hash . '">ссылке</a></p>
                        </body>
                        </html>
                        ';
        
                if (mail($email, "Восстановление пароля Артлипат через email", $message, $headers)) {
                    ?>
                        <p>Ссылка для восстановления пароля отправлена на вашу почту </p>
                    </div>
                    <?php  
                    
                } else {
                    ?>
                        <p>Произошла какая-то ошибка, письмо не отправилось</p>
                    </div>
                    <?php  
                }
                exit();  
            }
            else {
                ?>
                    <p>Не существует такого аккаунта</p>
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
            <p>Вы не ввели Email</p>
        <?php 
    }
}

?>   
<form class="login-form" action="page_for_restoring_password.php" method="post">
    <p>Введите ваш email: <input class="form-control" type="email" name="email" placeholder="указанный при регистрации"></p>
    <p><input class="btn btn-primary btn-lg btn-block" type="submit" value="Отправить" name="doGo"></p>
</form>

<a href="index.php">к сервису</a>
</div>
<?php   

require_once "footer.php"; ?>
