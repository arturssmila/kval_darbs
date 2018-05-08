<?php
require('../../config.php');

require_once 'api/google/Google_Client.php';
require_once 'api/google/contrib/Google_Oauth2Service.php';

$client = new Google_Client();

$client->setClientId($settings["google_client_id"]);
$client->setClientSecret($settings["google_client_secret"]);
$client->setRedirectUri('http'.(!empty($_SERVER["HTTPS"]) ? 's' : '').'://'.$_SERVER['HTTP_HOST'].'/cms/libs/go.php');
$client->setDeveloperKey($settings["google_developer_key"]);

$oauth2 = new Google_Oauth2Service($client);

if (isset($_GET['code']))
{
	$client->authenticate();
	$_SESSION['google_token'] = $client->getAccessToken();
	header('Location: http'.(!empty($_SERVER["HTTPS"]) ? 's' : '').'://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}


if (isset($_SESSION['google_token'])) 
{
	$client->setAccessToken($_SESSION['google_token']);
}
if ($client->getAccessToken())
{
	$google_user = $oauth2->userinfo->get();
	$_SESSION['google_token'] = $client->getAccessToken();
	set_user(array(
			"id"=>$google_user["id"],
			"name"=>$google_user["given_name"],
			"surname"=>$google_user["family_name"],
			"mail"=>$google_user["email"],
			"gender"=>!empty($google_user["gender"]) ? (($google_user["gender"]=="male")?'M':'F') : '',
			"image"=>!empty($google_user["picture"]) ? ($google_user["picture"]."?sz=200"):''//image size!
			),"GO");
	
	echo	'
		<script type="text/javascript">
			window.close();
			window.opener.location.reload();
		</script>
		';
}
else echo	'
		<script type="text/javascript">
			window.close();
		</script>
		';
?>

