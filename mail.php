<?php $title = "Управление делами"; 
require_once "header.php"; 	
require_once "functions.php";	


	ini_set( 'display_errors', 1 );
	error_reporting( E_ALL );

    $serviceaddress="https://artlipat.ru/artlipat2/index.php";

    $email="anechke@list.ru";

	$from = "noreply@artlipat.ru";

	$to1 = "anechke@list.ru";
	$subject1 = "registration a client at ARTLIPAT";
	$message1 = "Кто-то зарегился на $email, проверь!"; 

	$headers = "From:" . $from;

	mail($to1, $subject1, $message1, $headers);

	$to2 = $email;
	$subject2 = "registration at ARTLIPAT";
    //$message2 = "зарегился";//работает
	//$message2 = "зарегился Ваш логин: $email"; //работает
	//$message2 = "Регистрация в сервисе АРТЛИПАТ прошла успешно. \r\nВаш логин: $email"; //работает 
    //$message2 = "Регистрация в сервисе АРТЛИПАТ прошла успешно. \r\nВаш логин: $email \r\nВаш логин: "; //работает 
    //$message2 = "Регистрация в сервисе АРТЛИПАТ прошла успешно. \r\nВаш логин: $email \r\nВаш логин: $email"; //работает или нет
    //$message2 = "Вы зарегистрированы в сервисе АРТЛИПАТ. \r\nВаш логин: $email \r\nВаш логин: $email."; //не работает
    //$message2 = "зарегился $serviceaddress";//работает
    //$message2 = "зарегился $serviceaddress \r\nВаш логин: $email.";//работает
    $message2 = "Переход $serviceaddress \r\nВаш логин: $email.";//работает
    //$message2 = "Переход к сервису: $serviceaddress \r\nВаш логин: $email.";// неработает
    //$message2 = "Регистрация в сервисе АРТЛИПАТ прошла успешно. \r\nВы можете перейти к работе по ссылке: \r\nВы можете изменить свой логин и пароль в разделе Настройки. \r\nВы можете создавать профили для своих сотрудников в разделе Настройки.  \r\nДля начала работы вы можете завести в систему свое первое дело в разделе Новое дело.  \r\nВы можете записывать необходимые сроки по делам а так же выставлять задачи на себя и сотрудников со сроками выполнения на карточке дела.";
									

	mail($to2, $subject2, $message2, $headers);
									
	echo "test34";

require_once "footer.php"; ?>