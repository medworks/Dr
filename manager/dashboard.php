<?php
	include_once("../classes/database.php");	
	include_once("../classes/login.php");	
	include_once("../config.php");
    include_once("../classes/database.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");
	if ($_GET['item']!="dashboard")	exit();
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}	
	$db = Database::GetDatabase();

 $html=<<<cd

cd;
 return $html;
?>