<?php
require('../../config.php');
//session_start(); //Start PHP session
//print_r($_GET);
//print_r($_SESSION);

$app_id = $settings["facebook_application_id"];
$app_secret = $settings["facebook_application_secret"];
$my_url = "http".(!empty($_SERVER["HTTPS"]) ? 's' : '')."://".$_SERVER['HTTP_HOST']."/cms/libs/fb.php";
//die($my_url);
$code = !empty($_REQUEST["code"]) ? $_REQUEST["code"] : '';
if("x1x1x1" == $_REQUEST['state']) 
{
	$token_url = "https://graph.facebook.com/oauth/access_token?"
	. "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
	. "&client_secret=" . $app_secret . "&code=" . $code;
	
	if(!($response = @file_get_contents($token_url)))
	{
		die("Report to web administrator to turn on php_openssl!");
	}
	$params = null;
	
	//old method
	//parse_str($response, $params);
	$params = json_decode($response);
	$graph_url = "https://graph.facebook.com/me?access_token=".$params->access_token;
	$user = json_decode(file_get_contents($graph_url));
	//out($user);die('DONE fb');
	set_user(get_object_vars($user),"FB");
	echo	'
		<script type="text/javascript">
			window.close();
			window.opener.location.reload();
		</script>
		';
}
else 
{
	echo	'
		<script type="text/javascript">
			window.close();
		</script>
		';
}



?>
