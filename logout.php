<?php
	require('config.php');
	//include ("cms/libs/passwordcheck.inc");
	setcookie("mail", "", time()-3600, "/");
	setcookie("password", "", time()-3600, "/");
	setcookie("admin", "", time()-3600, "/");
	
	if(isset($_SESSION["user"]["id"]))
	{
		$_SESSION["user"] = array();
		unset($_SESSION["user"]);
	}
	
	$login = false;
	if(!empty($admin))
	{
		unlock_pages($user[0]["id"]);
		event("I",array("user_id"=>$user[0]["id"],"action"=>'Beidza darbu.'),$x);
	}
	header("Location: ".(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/'));
	exit();
?>