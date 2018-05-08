<?php

	require('../config.php');
	//passwordcheck
	include("../cms/libs/passwordcheck.inc");
	if (!$admin) 
	{
		header("Location: /admin/login.php");
		exit();
	}
	
	$mode = "users";
	
	$name = !empty($_POST["name"]) ? $_POST["name"] : '';
	//print_r($name);
	if ($name)
	{//update
		foreach($name as $key => $val)
		{
			mysql_query("UPDATE ".PREFIX."users SET 
				name = '".mysql_real_escape_string($val["name"])."',
				surname = '".mysql_real_escape_string($val["surname"])."', 
				admin = '".mysql_real_escape_string(empty($val["admin"])?0:$val["admin"])."'
			where id = $key ;") or die(mysql_error());
			set_users_row($key);
		}
	}
	header("location: /admin/$mode/");
	exit();
?>