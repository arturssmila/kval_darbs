<?php

require('../config.php');
//passwordcheck
include("../cms/libs/passwordcheck.inc");
if (!$admin) 
{
	header("Location: /admin/login.php");
	exit();
}

$mode = "profile";

$id = !empty($_POST["id"]) ? $_POST["id"] : '';
$mail = !empty($_POST["mail"]) ? $_POST["mail"] : "";
$name = !empty($_POST["name"]) ? $_POST["name"] : "";
$surname = !empty($_POST["surname"]) ? $_POST["surname"] : "";
$isadmin = !empty($_POST["admin"]) ? $_POST["admin"] : "";
$new_admin_language = !empty($_POST["admin_language"]) ? $_POST["admin_language"] : $admin_language;
$pasword_old = !empty($_POST["pasword_old"]) ? $_POST["pasword_old"] : "";
$pasword = !empty($_POST["pasword"]) ? $_POST["pasword"] : "";
$password_new = !empty($_POST["password_new"]) ? $_POST["password_new"] : "";

if ($_FILES["uploadedfile"]["error"] == 0) 
{
//START
	$extension = strtolower(end(explode(".", $_FILES["uploadedfile"]["name"])));
	$uploadedfile = $_FILES['uploadedfile']['tmp_name'];		
	$image = uniqid();
	$image = "$image.$extension";	
	$img = "../images/users/$image";		
	if (!@move_uploaded_file($uploadedfile, $img))
	{
		die("nevar uzladet bildi!");
		$image = "";
	}
	else 
	{
		chmod($img, 0777);
	}
//END
}

if($pasword_old && $pasword && $password_new)
{
	$mail = $_COOKIE["mail"];
	if(get_user("S", array("mail"=>$mail,"password"=>$pasword_old),$user))
	{
		if($pasword == $password_new)
		{
			get_user("U",array("id"=>$user[0]["id"],"password"=>$pasword),$x);
			setcookie("password", "", time()-3600, "/");
			setcookie("password", $password, time()+$settings["log_time"], "/");
		}
	}
}
if ($id)
{//update
	$args = array(
				"id"		=>$id,
				"mail"		=>$mail,
				"name"		=>$name,
				"surname"	=>$surname,
				"admin"		=>$isadmin,
				"admin_language"=>$new_admin_language
			);
	if(!empty($image))
		$args["image"] = '/images/users/'.$image;
	get_user("U",$args,$x);
}
header("location: /admin/$mode/");
exit();
?>