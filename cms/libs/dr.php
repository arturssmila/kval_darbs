<?php
require('../../config.php');

include 'api/DraugiemApi.php';

$app_key = $settings["draugiem_api"];
$app_id = $settings["draugiem_application_id"];
$draugiem = new DraugiemApi($app_id, $app_key);//Create Passport object

//session_start(); //Start PHP session
$draugiem->cookieFix(); //Iframe cookie workaround for IE and Safari
$dr_session = $draugiem->getSession();//Authenticate user

if($dr_session)
{//Authentication successful

	$user = $draugiem->getUserData();//Get user info
	set_user($user,"DR");
	unset($_SESSION["draugiem_auth_code"]);
	unset($_SESSION["draugiem_userkey"]);
	unset($_SESSION["draugiem_language"]);
	unset($_SESSION["draugiem_user"]);
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

