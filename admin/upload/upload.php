<?php
require("../../config.php");

// Code for Session Cookie workaround
	if (isset($_POST["PHPSESSID"])) {
		session_id($_POST["PHPSESSID"]);
	} else if (isset($_GET["PHPSESSID"])) {
		session_id($_GET["PHPSESSID"]);
	}

$id= !empty($_GET["id"]) ? $_GET["id"] : '-999';

// Check post_max_size (http://us3.php.net/manual/en/features.file-upload.php#73762)
	$POST_MAX_SIZE = ini_get('post_max_size');
	$unit = strtoupper(substr($POST_MAX_SIZE, -1));
	$multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));

	if ((int)$_SERVER['CONTENT_LENGTH'] > $multiplier*(int)$POST_MAX_SIZE && $POST_MAX_SIZE) 
	{
		header("HTTP/1.1 500 Internal Server Error");
		echo "POST exceeded maximum allowed size.";
		exit(0);
	}

// Settings
	$save_path = dirname(dirname(getcwd())) . "/images/galleries/";
	// The path were we will save the file (getcwd() may not be reliable and should be tested in your environment)
	$upload_name = "Filedata";
	$max_file_size_in_bytes = 2147483647;				// 2GB in bytes
	$extension_whitelist = array("jpg", "jpeg", "png", "gif"/*, "bmp"*/);	// Allowed file extensions
	$valid_chars_regex = '.A-Z0-9_ !@#$%^&()+={}\[\]\',~`-';				// Characters allowed in the file name (in a Regular Expression format)

// Other variables
	$MAX_FILENAME_LENGTH = 260;
	$file_name = "";
	$extension = "";
	$uploadErrors = array(
        0=>"There is no error, the file uploaded with success",
        1=>"The uploaded file exceeds the upload_max_filesize directive in php.ini",
        2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
        3=>"The uploaded file was only partially uploaded",
        4=>"No file was uploaded",
        6=>"Missing a temporary folder"
	);


// Validate the upload
	if (!isset($_FILES[$upload_name])) {
		HandleError("No upload found in \$_FILES for " . $upload_name);
		exit(0);
	} else if (isset($_FILES[$upload_name]["error"]) && $_FILES[$upload_name]["error"] != 0) {
		HandleError($uploadErrors[$_FILES[$upload_name]["error"]]);
		exit(0);
	} else if (!isset($_FILES[$upload_name]["tmp_name"]) || !@is_uploaded_file($_FILES[$upload_name]["tmp_name"])) {
		HandleError("Upload failed is_uploaded_file test.");
		exit(0);
	} else if (!isset($_FILES[$upload_name]['name'])) {
		HandleError("File has no name.");
		exit(0);
	}

// Validate the file size (Warning the largest files supported by this code is 2GB)
	$file_size = @filesize($_FILES[$upload_name]["tmp_name"]);
	if (!$file_size || $file_size > $max_file_size_in_bytes) {
		HandleError("File exceeds the maximum allowed size");
		exit(0);
	}


// Validate file name (for our purposes we'll just remove invalid characters)
	$file_name = $_FILES[$upload_name]['name'];
//	$file_name = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', "", basename($_FILES[$upload_name]['name']));
	if (strlen($file_name) == 0 || strlen($file_name) > $MAX_FILENAME_LENGTH) {
		HandleError("Invalid file name");
		exit(0);
	}
	$extension = strtolower(end(explode(".", $file_name)));
	$file_name = explode(".", $file_name);
	array_pop($file_name);
	$file_name = replace_spec_chars(strtolower(implode(".", $file_name)));
	
	$img_id = "";
	$img_id_small = "";
	$img_id_thumb = "";
	$img_id_big = "";

	while (file_exists($save_path.$file_name.$img_id.".".$extension))
	{
		$img_id++;
	}
	while (file_exists($save_path.$file_name.$img_id_small."_small.".$extension))
	{
		$img_id_small++;
	}
	while (file_exists($save_path.$file_name.$img_id_thumb."_thumb.".$extension))
	{
		$img_id_thumb++;
	}
	while (file_exists($save_path.$file_name.$img_id_big."_big.".$extension))
	{
		$img_id_big++;
	}
/*
// Validate that we won't over-write an existing file
	if (file_exists($save_path . $file_name)) {
		HandleError("File with this name already exists");
		exit(0);
	}
*/
// Validate file extention
	$is_valid_extension = false;
	foreach ($extension_whitelist as $ext) 
	{
		if ($extension == $ext) 
		{
			$is_valid_extension = true;
			break;
		}
	}
	if (!$is_valid_extension) 
	{
		HandleError("Invalid file extension");
		exit(0);
	}

	$file_name_small = $file_name.$img_id_small."_small.jpg";//.$extension;
	$file_name_thumb = $file_name.$img_id_thumb."_thumb.jpg";//.$extension;
	$file_name_big = $file_name.$img_id_big."_big.".$extension;
	$file_name = $file_name.$img_id.".jpg";//.$extension;
	
	if (!@move_uploaded_file($_FILES[$upload_name]["tmp_name"], $save_path.$file_name_big))
	{
		HandleError("File could not be saved: ". $save_path.$file_name.$img_id.".".$extension);
		exit(0);
	}
	else chmod($save_path.$file_name_big, 0777);
//****************************************************
//taisam thumbnailus
function createThumbs($pathToImages, $fname_s, $fname_t, $fname, $fname_b, $extension)
{
	//**********************************************************************************

	$uploadedfile = "{$pathToImages}{$fname_b}";
	if($extension == "jpg" || $extension == "jpeg" )
	{
		$src = imagecreatefromjpeg($uploadedfile);
	}
	elseif ($extension == "png")
	{
		$src = imagecreatefrompng($uploadedfile);
	}
	elseif ($extension == "gif")
	{
		$src = imagecreatefromgif($uploadedfile);
	}
	
	list($width,$height) = getimagesize($uploadedfile);

	if ($width > IMG_WIDTH)
	{
		$newwidth = IMG_WIDTH;
		$newheight = IMG_WIDTH / ($width/$height);
	}
	else
	{
		$newwidth = $width;
		$newheight = $height;
	}
	
	$newwidth_small = IMG_SMALL_WIDTH;
	$newheight_small = IMG_SMALL_WIDTH / ($width/$height);
	
	$newwidth_thumb = IMG_THUMB_WIDTH;
	$newheight_thumb = IMG_THUMB_WIDTH / ($width/$height);
	
	
	$tmp = imagecreatetruecolor($newwidth,$newheight);
	$tmp_small = imagecreatetruecolor($newwidth_small,$newheight_small);
	$tmp_thumb = imagecreatetruecolor($newwidth_thumb,$newheight_thumb);

	imagecopyresized($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
	imagecopyresized($tmp_small,$src,0,0,0,0,$newwidth_small,$newheight_small,$width,$height);
	imagecopyresized($tmp_thumb,$src,0,0,0,0,$newwidth_thumb,$newheight_thumb,$width,$height);
	
	imagejpeg($tmp,		"{$pathToImages}{$fname}",100);
	chmod(			"{$pathToImages}{$fname}", 0777);
	imagejpeg($tmp_small,	"{$pathToImages}{$fname_s}",100);
	chmod(			"{$pathToImages}{$fname_s}", 0777);
	imagejpeg($tmp_thumb,	"{$pathToImages}{$fname_t}",100);
	chmod(			"{$pathToImages}{$fname_t}", 0777);
	
	imagedestroy($src);
	imagedestroy($tmp);
	imagedestroy($tmp_small);
	imagedestroy($tmp_thumb);
}
// call createThumb function and pass to it as parameters the path
// to the directory that contains images, the path to the directory
// in which thumbnails will be placed and the thumbnail's width.
// We are assuming that the path will be a relative path working
// both in the filesystem, and through the web for links
createThumbs($save_path,$file_name_small,$file_name_thumb,$file_name,$file_name_big,$extension);
//****************************************************
//sql inserts
mysql_query("INSERT INTO ".PREFIX."meta_images 
					( 
					meta_id,
					image,
					image_small,
					image_big,
					image_thumb
					) 
			VALUES  
					( 
					'$id',
					'$file_name', 
					'$file_name_small', 
					'$file_name_big', 
					'$file_name_thumb'
					);") or HandleError(mysql_error());
// Return output to the browser (only supported by SWFUpload for Flash Player 9)

	echo "File Received ". $save_path.$file_name;
	exit(0);


/* Handles the error output.  This function was written for SWFUpload for Flash Player 8 which
cannot return data to the server, so it just returns a 500 error. For Flash Player 9 you will
want to change this to return the server data you want to indicate an error and then use SWFUpload's
uploadSuccess to check the server_data for your error indicator. */
function HandleError($message) {
	header("HTTP/1.1 500 Internal Server Error");
	echo "erroronjsh".$message;
}
?>
