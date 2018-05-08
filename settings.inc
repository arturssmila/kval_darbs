<?php
switch($_SERVER['HTTP_HOST'])
{
	case "lingverto.introskip.lauvas.lv":
	case "lingverto.introskip.lauvas.lv:81":
		$development = true;
		define('DB_HOST'	, 'localhost');
		define('DB_USER'	, 'root');
		define('DB_PASSWORD'	, 'kkk');
		define('DB_DATABASE'	, 'lingverto');
		define('PREFIX'		, '');	
		break;
	default:
		define('DB_HOST'	, 'localhost');
		define('DB_USER'	, 'lingverto');
		define('DB_PASSWORD'	, 'lingverto@123');
		define('DB_DATABASE'	, 'lingverto');
		define('PREFIX'		, '');
}
		
	
	define('IMG_WIDTH', 960);
	define('IMG_HEIGHT', 540);
	
	define('IMG_SMALL_WIDTH', 320);
	define('IMG_SMALL_HEIGHT', 180);
	
	define('IMG_THUMB_WIDTH', 80);
	define('IMG_THUMB_HEIGHT', 45);
?>