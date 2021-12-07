<?php session_start(); $title = "Управление делами"; 
/* require_once "functions_for_page_view_login_on_index.php";  */
require_once "functions_control_view_login_on_index.php"; //= functions_for_page_view_login_on_index.php
/* require_once "function_for_page_view_on_index.php"; */ 
require_once "function_view_on_index.php"; // = function_for_page_view_on_index.php
require_once "header.php"; 	
/* require_once "functions_preparing_data_to_show.php";  */
require_once "functions_selecting_data.php"; 
require_once "functions_showing_data.php"; 
	
	StartDB();						
	CheckLogin(); //in functions_for_page_view_login_on_index.php - function_view_on_index.php
	EndDB(); 



require_once "footer.php"; ?>
