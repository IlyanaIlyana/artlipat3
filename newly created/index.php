<?php session_start(); $title = "Case management"; 
require_once "functions_control_view_login_on_index.php"; 
require_once "function_view_on_index.php"; 
require_once "header.php"; 	
/* require_once "art_view/functions_showing_data.php"; 
require_once "art_control/functions_selecting_data_to_show.php";  */
require_once "functions_showing_data.php"; 
require_once "functions_selecting_data_to_show.php"; 


	
	StartDB();						
	CheckLogin();
	EndDB(); 



require_once "footer.php"; ?>
