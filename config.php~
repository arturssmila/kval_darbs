<?php
if(!(function_exists('out_time')))
{
	function out_time($end_time = 0, $file = __FILE__, $line = __LINE__)
	{
		global $start_time;
		global $out_time_line;
		//echo 'Time: '.number_format(($end_time-$start_time), 3, '.', '').' sec File: '.$file.' Line: '.$out_time_line.' - '.$line.'<br />';
		$start_time = !empty($end_time) ? $end_time : $start_time;
		$out_time_line = !empty($line) ? $line : $out_time_line;
	}
	//example:
	//out_time(microtime(true), __FILE__, __LINE__);
}
$is_magic_quotes = get_magic_quotes_gpc();
$update_host = "storage.introskip.lauvas.lv";   
//temp_close();
//error_reporting(1);
error_reporting(E_ALL ^ E_DEPRECATED);	//Remove in next projects

session_start();
$development = false;
define('ROOT', dirname(__FILE__));

require(ROOT.'/settings.inc');

/***** MODES *******************************************************/

$modes = array();

$modes["tree"]			= array("line"=>"first","tree"=>1,"user_types"=>array("super_admin"));
$modes["user"]			= array("line"=>"first","tree"=>1,"user_types"=>array("super_admin"));
$modes["users"]			= array("line"=>"first","tree"=>1,"user_types"=>array("super_admin"));
$modes["comments"]		= array("line"=>"first","tree"=>1,"user_types"=>array("super_admin"));
$modes["feedbacks"]		= array("line"=>"first","tree"=>1,"user_types"=>array("super_admin"));
$modes["form_data"]		= array("line"=>"first","tree"=>1,"user_types"=>array("super_admin"));
$modes["subscribers"]		= array("line"=>"first","tree"=>1,"user_types"=>array("super_admin"));
$modes["search_stats"]		= array("line"=>"first","tree"=>1,"user_types"=>array("super_admin"));
$modes["search"]		= array("line"=>"first","tree"=>1,"user_types"=>array("super_admin"));
$modes["profile"]		= array("line"=>"first","tree"=>1,"user_types"=>array("all"));
$modes["help"]			= array("line"=>"first","tree"=>1,"user_types"=>array("super_admin"));

$modes["languages"]		= array("line"=>"second","tree"=>1,"user_types"=>array("super_admin"));
$modes["language_file"]		= array("line"=>"second","tree"=>1,"user_types"=>array("super_admin"));
$modes["adm_language_file"]	= array("line"=>"second","tree"=>1,"user_types"=>array("super_admin"));
$modes["templates"]		= array("line"=>"second","tree"=>1,"user_types"=>array("super_admin"));
$modes["template_fields"]	= array("line"=>"second","tree"=>1,"user_types"=>array("super_admin"));
$modes["activities"]		= array("line"=>"second","tree"=>1,"user_types"=>array("super_admin"));
$modes["activity_data"]		= array("line"=>"second","tree"=>1,"user_types"=>array("super_admin"));
$modes["images"]		= array("line"=>"second","tree"=>1,"user_types"=>array("super_admin"));
$modes["settings"]		= array("line"=>"second","tree"=>1,"user_types"=>array("super_admin"));
$modes["updates"]		= array("line"=>"second","tree"=>1,"user_types"=>array("super_admin"));
$modes["work_table"]		= array("line"=>"second","tree"=>1,"user_types"=>array("super_admin"));
$modes["users_table"]		= array("line"=>"second","tree"=>1,"user_types"=>array("super_admin"));
$modes["administration"]	= array("line"=>"second","tree"=>1,"user_types"=>array("super_admin"));

/************************************************************/

$adm_set = array(
		"field_types"	=>	array(
							0=>"input",
							1=>"text",
							2=>"text_tiny",
							3=>"checkbox",
							4=>"multicheckbox",
							5=>"selectbox",
						),
	);

function notika_errors()
{
	include("templates/error.html");
	exit();
}
function temp_close()
{
	if(!(in_array($_SERVER['REMOTE_ADDR'], array("62.63.156.90"))))
	{
		notika_errors();
	}
}


$link = "";
function connect_db()
{
	global $db_link;
	$db_link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$db_link) {
		die(notika_errors());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die(notika_errors());
	}
	mysql_query("SET NAMES utf8", $db_link);
	//mysql_query("SET SESSION time_zone = '+2:00'", $link);	
}
if(!(function_exists('mysql_connect')))
{
	function mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD)
	{
		return mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
	}
}
if(!(function_exists('mysql_select_db')))
{
	function mysql_select_db($DB_DATABASE)
	{
		global $db_link;
		return mysqli_select_db($db_link,$DB_DATABASE);
	}
}
if(!(function_exists('mysql_query')))
{
	function mysql_query($query)
	{
		global $db_link;
		return mysqli_query($db_link,$query);
	}
}
if(!(function_exists('mysql_num_rows')))
{
	function mysql_num_rows($res)
	{
		return mysqli_num_rows($res);
	}
}
if(!(function_exists('mysql_fetch_assoc')))
{
	function mysql_fetch_assoc($res)
	{
		return mysqli_fetch_assoc($res);
	}
}
if(!(function_exists('mysql_real_escape_string')))
{
	function mysql_real_escape_string($string)
	{
		global $db_link;
		return mysqli_real_escape_string($db_link, $string);
	}
}

function close_db()
{
	global $db_link;
	mysql_close($db_link);
}

connect_db();

//*****************************************************************
//db
require(ROOT."/cms/libs/settings.inc");
require(ROOT."/cms/libs/langbar.inc");
require(ROOT."/cms/libs/meta.inc");
require(ROOT."/cms/libs/template.inc");
require(ROOT."/cms/libs/images.inc");
require(ROOT."/cms/libs/lang.inc");
require(ROOT."/cms/libs/set_user.inc");

//last
require(ROOT."/cms/libs/functions.inc");

//for admin
require(ROOT."/cms/libs/users.inc");
require(ROOT."/cms/libs/events.inc");
require(ROOT."/cms/libs/backup.inc");

//BOOST PASSWORD CHANGE
//get_user("U",array( "id"=>1, "password"=>'XXX' ),$ee);
?>