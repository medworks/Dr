<?php
	error_reporting (E_ALL ^ E_NOTICE);
	if (!isset($_GET["lang"])) $_GET["lang"]="en";
	if ($_GET["lang"]=="fa")
		//include_once('themes/fa/index.php');
		header("Location:./themes/fa/index.php");
	else
	if ($_GET["lang"]=="en")
		//include_once('themes/en/index.php');
		header("Location:./themes/en/index.php");
?>