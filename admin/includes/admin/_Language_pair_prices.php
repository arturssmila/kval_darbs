<?php
	if(!empty($_POST["notify"]))
	{
		exit();
	}
	require_once(__DIR__ . "/assets/bootstrap.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/database.inc");
	
	if (empty($_GET["cat1"])) {
		include_once(__DIR__ . "/language_pair_prices/index.php");
	} else {
		include_once(__DIR__ . "/language_pair_prices/index.php");
	}
?>