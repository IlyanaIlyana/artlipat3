<?php session_start(); $title = "Управление делами"; 
require_once "functions_for_page_view_login_on_index.php"; 
//require_once "function_for_page_view_on_index.php"; 
require_once "header.php"; 	
//require_once "functions_preparing_data_to_show.php"; 


	
	StartDB();						
	CheckLogin();
	EndDB(); 



require_once "footer.php"; ?>
