<?php
require('../config.php');
out_time(microtime(true), __FILE__, __LINE__);
//login
$login_page = true;
$login = false;
$admin = false;
$admin_lang = $languages[0]["iso"];
require_once('../admin/admin_language.php');
$mail = '';
out_time(microtime(true), __FILE__, __LINE__);
if (isset($_POST["username"]) && isset($_POST["password"]))
{
	$mail = $_POST["username"];
	$password = $_POST["password"];
	if (($mail) && ($password))
	{
		if(get_user("S", array("mail"=>$mail,"password"=>$password),$user))
		{
			setcookie("mail", "", time()-3600, "/");
			setcookie("mail", $mail, time()+$settings["log_time"], "/");
			setcookie("password", "", time()-3600, "/");
			setcookie("password", $password, time()+$settings["log_time"], "/");
			setcookie("admin", "", time()-3600, "/");
			setcookie("admin", $user[0]["admin"], time()+$settings["log_time"], "/");
			
			$login = true;
			event("I",array("user_id"=>$user[0]["id"],"action"=>'Ienāca administrātora panelī.'),$x);
			
			//ja neeksistē lietotāja izvēlētā valoda
			if(empty($languages_isoes[$user[0]["admin_language"]]))
			{
				$user[0]["admin_language"] = $languages[0]["iso"];
				//samainam uz defaulto valodu!
				mysql_query("UPDATE `".PREFIX."users` SET `admin_language` = '".$languages[0]["iso"]."' WHERE `id` = '".$user[0]["id"]."'");
				set_users_row($user[0]["id"]);
			}
			header("Location: ".$_SERVER['REQUEST_URI']);
			exit();
		}
	}
}
out_time(microtime(true), __FILE__, __LINE__);
//passwordcheck
include ("../cms/libs/passwordcheck.inc");

if($admin)
{
	header("Location: /admin/");
	exit();
}
out_time(microtime(true), __FILE__, __LINE__);
register_domain();
out_time(microtime(true), __FILE__, __LINE__);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="lv" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/cms/css/admin.css?<?php echo file_date("../cms/css/admin.css"); ?>" rel="stylesheet" type="text/css" />

<title></title>
</head>

<body onload="document.getElementById('username').focus();">
	
	<div id="login_bg"
		<?php
			$images_path = ROOT."/cms/css/bg_images/";
			if ($handle = opendir($images_path)) 
			{
				/* This is the correct way to loop over the directory. */
				while (false !== ($file = readdir($handle))) 
				{
					$end = explode(".",$file);
					$extension = strtolower(end($end));
					switch ($extension)
					{
					case "jpg":
					case "jpeg":
					case ".png":
					case ".gif":
						$images[] = $file;
						break;
					}
				}	
				closedir($handle);
			}
			
			echo 'style="background-image:url('."'/cms/css/bg_images/".$images[rand(0, (count($images)-1))]."'".');"';
			?>
		>
		<form action="" method="post" name="login_form">
			<table id="login_div" class="sh" cellspacing="10" border="0">
				<tr>
					<td><?php echo al("e_pasts"); ?> / <?php echo al("lietotajvards"); ?>:</td><td><input name="username" id="username" type="text" size="10" /></td>
				</tr>
				<tr>
					<td><?php echo al("parole"); ?>:</td><td><input name="password" type="password" size="10" /></td>
				</tr>
				<tr>
					<td class="center" colspan="2"><button type='submit'><?php echo al("pieslegties"); ?></button></td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>
<?php
out_time(microtime(true), __FILE__, __LINE__);
?>