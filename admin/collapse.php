<?php
	//no need for config, just change session variable
	session_start();
	$id = !empty($_POST["id"]) ? $_POST["id"] : 0;
	$_SESSION["opened"][$id] = 0;
?>
