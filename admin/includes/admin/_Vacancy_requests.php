<?php
	if(!empty($_POST["notify"]))
	{
		exit();
	}
	require_once(__DIR__ . "/assets/bootstrap.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/database.inc");

	
	// routing

	if (empty($_GET["cat1"])) {
		include_once(__DIR__ . "/vacancy_requests/index.php");
	} else {
		if (is_numeric($_GET["cat1"]) && empty($_GET["cat2"])) {
			include_once(__DIR__ . "/vacancy_requests/index.php");
		}else if((is_numeric($_GET["cat1"]) && !empty($_GET["cat1"])) && (!empty($_GET["cat2"]) && isset($_GET["cat2"]))){
			include_once(__DIR__ . "/vacancy_requests/index.php");
		}
	}
?>