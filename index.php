<?php session_start(); $title = "Artlipat"; 
/* require_once "functions_for_page_view_login_on_index.php";  */
require_once "functions_control_view_login_on_index.php"; //= functions_for_page_view_login_on_index.php
/* require_once "function_for_page_view_on_index.php"; */ 
require_once "function_view_on_index.php"; // = function_for_page_view_on_index.php
require_once "header.php"; 	
require_once "art_view/function_page_header.php"; 
/* require_once "functions_preparing_data_to_show.php";  */
require_once "art_control/functions_selecting_data.php"; 
require_once "art_view/functions_showing_data.php"; 
require_once "art_control/functions_selecting_language.php";
	
	StartDB();						
	CheckLogin(); //in functions_for_page_view_login_on_index.php - function_view_on_index.php
	EndDB(); 



require_once "footer.php"; ?>
