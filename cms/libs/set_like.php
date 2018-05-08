<?php
//print_r($_POST);
$id = !empty($_POST["id"]) ? $_POST["id"] : die();
//$lang = !empty($_POST["lang"]) ? $_POST["lang"] : "lv";

require('../config.php');
//lang("S",array(),$lg);

$query = "SELECT * FROM ".PREFIX."likes WHERE 
		meta_id = ".$id." AND 
		ip = '".$_SERVER['REMOTE_ADDR']."' AND 
		agent = '".$_SERVER['HTTP_USER_AGENT']."'
	";
$rRes = mysql_query($query);
if(mysql_num_rows($rRes)>0)
{
	mysql_query("DELETE FROM ".PREFIX."likes WHERE 
			meta_id = ".$id." AND  
			ip = '".$_SERVER['REMOTE_ADDR']."' AND 
			agent = '".$_SERVER['HTTP_USER_AGENT']."'
		");
}
else
{
	mysql_query("INSERT INTO ".PREFIX."likes SET 
			meta_id = ".$id.", 
			ip = '".$_SERVER['REMOTE_ADDR']."', 
			agent = '".$_SERVER['HTTP_USER_AGENT']."'
		");
}
echo "ok";
