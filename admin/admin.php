<?php

require('../config.php');
//passwordcheck
include("../cms/libs/passwordcheck.inc");
if (!$admin) 
{
	header("Location: /admin/login.php");
	exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="lv" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.js"></script>
<title>Admin</title>
</head>

<body>
<div id="content_back" class="none"></div>
<?php
//print_r($_POST);
include("headerx.php"); 
?>

<table width="98%" height="800">
	<tr>
		<td valign="top">
			<iframe id="set_link" width="100%" height="100%"></iframe>
		</td>
	</tr>
</table>
</body>
</html>