<?php
require('../../config.php');

//Twitter login
define('TWITTER_CONSUMER_KEY', !empty($settings["twitter_consumer_key"])? $settings["twitter_consumer_key"] : '');
define('TWITTER_CONSUMER_SECRET', !empty($settings["twitter_consumer_secret"])? $settings["twitter_consumer_secret"] : '');
define('TWITTER_OAUTH_CALLBACK', "http".(!empty($_SERVER["HTTPS"]) ? 's' : '')."://".$_SERVER['HTTP_HOST']."/cms/libs/tw.php");

function __autoload($class)
{
	$parts = explode('_', $class);
	$path = 'api/twitter/'.implode(DIRECTORY_SEPARATOR,$parts);
	require_once $path . '.php';
}

require_once('api/twitter/twitteroauth/twitteroauth.php');

if (TWITTER_CONSUMER_KEY === '' || TWITTER_CONSUMER_SECRET === '') {
	echo 'You need a consumer key and secret to test the sample code. Get one from <a href="https://dev.twitter.com/apps">dev.twitter.com/apps</a>';
	exit;
}

if(empty( $_SESSION['twitter_oauth_token'] )){
	$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);
	$request_token = $connection->getRequestToken(TWITTER_OAUTH_CALLBACK);
	$_SESSION['twitter_oauth_token'] = $request_token['oauth_token'];
	$_SESSION['twitter_oauth_token_secret'] = $request_token['oauth_token_secret'];
	switch ($connection->http_code) {
		case 200:
			$url = $connection->getAuthorizeURL($_SESSION['twitter_oauth_token']);
			echo	'
				<script type="text/javascript">
					window.location = "'.$url.'";
				</script>
				';
			break;
		default:
			$error = 'Could not connect to Twitter. Refresh the page or try again later.';
	}
}
else
{
	$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $_SESSION['twitter_oauth_token'], $_SESSION['twitter_oauth_token_secret']);
	if(!empty($_REQUEST['oauth_verifier']))
	{
		$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	}
	else
	{
		$_SESSION['twitter_oauth_token'] = '';
		header("Location: /cms/libs/tw.php");
		exit();
	}	
	
	$content = $connection->get('account/verify_credentials');
	$data = array();
	if( !empty( $content->id )){
		//out($content);die();
		$user['id'] = $content->id;
		$user['name'] = $content->name;
		$user['screen_name'] = $content->screen_name;
		$user['image'] = str_replace("_normal","",$content->profile_image_url);
		set_user($user,"TW");
	}
	
	echo	'
		<script type="text/javascript">
			window.close();
			window.opener.location.reload();
		</script>';
}
?>
