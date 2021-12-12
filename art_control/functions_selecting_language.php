<?php

function SelectTranslationForRegistration($lang)
{
    global $db;
    global $rowartlipat;
    global $rowemail_prompt;
    global $rowpassword_prompt1;
    global $rowpassword_prompt2;
    global $rowconfirm_text;
    global $rowdeblock_text;
    global $rowyear_text;
    global $rowregister;
    global $rowto_login_page;


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
    
    $SQLconfirm_text = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'confirm_text'";
	$rowconfirm_text = mysqli_fetch_assoc(mysqli_query($db, $SQLconfirm_text));
    
    $SQLdeblock_text = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'deblock_text'";
	$rowdeblock_text = mysqli_fetch_assoc(mysqli_query($db, $SQLdeblock_text));

    $SQLyear_text = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'year_text'";
	$rowyear_text = mysqli_fetch_assoc(mysqli_query($db, $SQLyear_text));

    $SQLregister = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'register'";
	$rowregister = mysqli_fetch_assoc(mysqli_query($db, $SQLregister));

    $SQLto_login_page = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'to_login_page'";
	$rowto_login_page = mysqli_fetch_assoc(mysqli_query($db, $SQLto_login_page));
}

function SelectTranslationForLogin($lang)
{
    global $db;
    global $rowartlipat;
    global $rowlogin;
    global $rowpassword;
    global $rowenter;
    global $rowto_new_registration;

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

	$SQLlogin = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'login'";
	$rowlogin = mysqli_fetch_assoc(mysqli_query($db, $SQLlogin));

	$SQLpassword = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'password'";
	$rowpassword = mysqli_fetch_assoc(mysqli_query($db, $SQLpassword));

	$SQLenter = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'enter'";
	$rowenter = mysqli_fetch_assoc(mysqli_query($db, $SQLenter));
    
    $SQLto_new_registration = "SELECT phrase_$lang FROM `translation_static_content` WHERE phrase_key = 'to_new_registration'";
	$rowto_new_registration = mysqli_fetch_assoc(mysqli_query($db, $SQLto_new_registration));
 
}
