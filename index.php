<?php
$start_time = microtime(true);
function out_time($end_time = 0, $file = __FILE__, $line = __LINE__)
{
	global $start_time;
	global $out_time_line;
	//echo 'Time: '.number_format(($end_time-$start_time), 3, '.', '').' sec File: '.$file.' Line: '.$out_time_line.' - '.$line.'<br />';
	$start_time = !empty($end_time) ? $end_time : $start_time;
	$out_time_line = !empty($line) ? $line : $out_time_line;
}

//out_time(microtime(true), __FILE__, __LINE__);

require('config.php');
out_time(microtime(true), __FILE__, __LINE__);
$data = array();

data_starter();//TE

//reset password
if(!empty($_GET["reset_code"]))
{
	$query = "SELECT
			pr.*,
			u.`active`,
			u.`soc`,
			u.`mail`,
			u.`admin_language`
		FROM `".PREFIX."password_resets` AS pr
		JOIN `".PREFIX."users` AS u ON u.`id` = pr.`user_id` 
		WHERE
			pr.`reset_code` = '".$_GET["reset_code"]."'
			AND
			u.`soc` = '00'
			";
	$res = mysql_query($query);
	if(mysql_num_rows($res) > 0)
	{
		$data["reset_user"] = mysql_fetch_assoc($res);
		$lang = $data["reset_user"]["admin_language"];
		//out($data["reset_user"]);
	}
}
	
out_time(microtime(true), __FILE__, __LINE__);

lang("S",array(),$data["lg"]);
out_time(microtime(true), __FILE__, __LINE__);
require('cms/smarty/Smarty.class.php');
out_time(microtime(true), __FILE__, __LINE__);
$smarty_header = new Smarty;
$smarty = new Smarty;
$smarty_footer = new Smarty;

$page = 1;//don`t delete

//**********************************************************************************************************************
optimize_cats($data["cat"]);//TE
out_time(microtime(true), __FILE__, __LINE__);
clear_links($data["cat"]);
out_time(microtime(true), __FILE__, __LINE__);
//out($data["cat"]);
//die();

//Denied page
if(!empty($data["cat"][0]["deny_page"]))
{
	meta("S",array("id"=>$data["cat"][0]["parent_id"]),$parent_page);
	header("Location: $slang".(!empty($parent_page[0]["long_link"]) ? $parent_page[0]["long_link"] : '/'));
	exit();
}

//**********************************************************************************************************************
out_time(microtime(true), __FILE__, __LINE__);
//menu
meta("S",array("parent_id"=>0),$data["menu"]);
meta("S",array("parent_id"=>$data["cat"][0]["id"]),$data["cat"][0]["sub_menu"]);
meta("S",array("parent_id"=>-1),$data["menu_x"]);
out_time(microtime(true), __FILE__, __LINE__);//TE
$data["meta_x"] = $data["menu_x"];

$fails = $data["cat"][0]["template"];

//langbar
langbar($data["cat"][0], $langbar);
out_time(microtime(true), __FILE__, __LINE__);
//fields
get_fields($data["fields"], $data["field_names"], $data["fields_ids"], $data["cat"][0]["template_id"]);
out_time(microtime(true), __FILE__, __LINE__);
//user
$user_id = !empty($_SESSION["user"]["id"]) ? $_SESSION["user"]["id"] : '';
if($user_id)
{
	if(get_user("S",array("id"=>$user_id,"active"=>1),$x_user))
	{
		get_user("L", array("id"=>$user_id),$x);
		get_user("IP", array("id"=>$user_id),$x);
		unset($x_user[0]["password"]);
	}
	$_SESSION["user"] = $x_user[0];
}

out_time(microtime(true), __FILE__, __LINE__);
//index plus
if(file_exists("res/index_plus.php"))
	include("res/index_plus.php");//TE 3 sec
out_time(microtime(true), __FILE__, __LINE__);
//resources
if(file_exists("res/$fails.php"))
	include("res/$fails.php");//TE 11 sec
out_time(microtime(true), __FILE__, __LINE__);

//data to send
		$data["lang"]			= $lang;
		$data["page"]			= $page;
		$data["slang"]			= $slang;
		$data["langbar"]		= $langbar;
		$data["languages"]		= $languages;
		$data["session"]		= $_SESSION;
		$data["origin_domain"]		= $_SERVER['HTTP_HOST'];
		$data["cms_js_date"]		= file_date("cms/js/scripts.js");
		$data["js_date"]		= file_date("js/scripts.js");
		$data["css_date"]		= file_date("css/style.css");
		
		$data["css_mobile_date"]	= file_date("css/style_mobile.css");
		$data["css_tablet_date"]	= file_date("css/style_tablet.css");
		$data["css_desktop_date"]	= file_date("css/style_desktop.css");
		$data["css_big_date"]		= file_date("css/style_big.css");
		
		$data["settings"]		= $settings;
out_time(microtime(true), __FILE__, __LINE__);
//send all data
$smarty_header	->assign($data);
$smarty		->assign($data);
$smarty_footer	->assign($data);
out_time(microtime(true), __FILE__, __LINE__);
								
//show page
$smarty_header->display('header.html');
if(file_exists("templates/$fails.html"))
	$smarty->display($fails.'.html');
else
	$smarty->display('text.html');
$smarty_footer->display('footer.html');
?>
