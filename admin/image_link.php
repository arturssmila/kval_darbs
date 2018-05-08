<?php
require('../config.php');
include("../cms/libs/passwordcheck.inc");
if (!$admin) 
{
	echo "Jūsu sesija ir beigusies, lūdzu, autorizējieties sistēmā!";
	exit();
}
if (isset($_FILES["uploadedfile"]) && ($_FILES["uploadedfile"]["error"] == 0)) 
{
	$extension = strtolower(end(explode(".", $_FILES["uploadedfile"]["name"])));
	$uploadedfile = $_FILES['uploadedfile']['tmp_name'];
	
	
	$imgbinary = fread(fopen($uploadedfile, "r"), filesize($uploadedfile));
       
        $image_link =  'data:image/' . $extension . ';base64,' . base64_encode($imgbinary);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Language" content="lv" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style>
		body,
		input,
		button { 
			margin:0px;
			font-size:13px;
		}
		table {
			border-collapse:collapse;
			width:100%;
		}
		table td {
			padding:0px;
		}
		input,
		textarea {
			width:97%;
		}
	</style>
	<script type="text/javascript" src="/js/jquery.js"></script>
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>
					<input name="uploadedfile" type="file" />
					<br />
					<button type="save" name="save" value="save">Ģenerēt bildes linku</button>
				</td>
				<td>
					<textarea onclick="$(this).select();"><?php if(!empty($image_link)) echo $image_link; ?></textarea>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>
