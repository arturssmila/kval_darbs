<?php

require('../config.php');
//passwordcheck
include("../cms/libs/passwordcheck.inc");
if (!$admin) 
{
	header("Location: /admin/login.php");
	exit();
}
//print_r($_POST); die();
$mode = isset($_GET["mode"]) ? $_GET["mode"] : "";
$delete = !empty($_POST["delete"]) ? $_POST["delete"] : "";
$img_id = "";

if ($delete)
{
	if(file_exists("../images/others/".$delete))
	{
		unlink("../images/others/".$delete);
	}
}

if ($_FILES["uploadedfile"]["error"] == 0) 
{
//START
	$filename_array = explode(".", $_FILES["uploadedfile"]["name"]);
	$extension = strtolower(end($filename_array));
	$file_name = strtolower(replace_spec_chars(reset($filename_array)));
	
	$uploadedfile = $_FILES['uploadedfile']['tmp_name'];

	

//END

	if (empty($id))
	{
		while (file_exists("../images/others/".$file_name.$img_id.".".$extension))
		{
			$img_id++;
		}
		
	}
		
	$img = "../images/others/".$file_name.$img_id.".".$extension;
	
	if (!@move_uploaded_file($uploadedfile, $img))
	{
		die("Failu neizdevās saglabāt: ". $img);
	}
	else chmod($img, 0777);
}
	header("location: /admin/$mode".((!empty($file_name) && !empty($extension)) ? ('#'.$file_name.$img_id.".".$extension) : ''));
	exit();
?>
