<?php
require('../config.php');
include("../cms/libs/passwordcheck.inc");
$admin_lang = $user[0]["admin_language"];
require_once('../admin/admin_language.php');
if (!$admin) 
{
	echo al("session_ended");
	exit();
}
$template_id	= isset($_POST["template_id"])	? $_POST["template_id"]	: die(al("nav_sadalas_tipa_id"));
$field_id	= !empty($_POST["field_id"])	? $_POST["field_id"]	: die(al("nav_laucina_id"));
$checked	= !empty($_POST["checked"])	? $_POST["checked"]	: 0;

//delete
mysql_query("DELETE FROM ".PREFIX."templates_fields WHERE t_id = '$template_id' AND field_id = '$field_id' ;") or die(mysql_error());

if($checked)
{
	mysql_query("INSERT INTO ".PREFIX."templates_fields SET t_id = '$template_id', field_id = '$field_id' ;") or die(mysql_error());
}
echo 'success#'.al("saglabats");

?>
