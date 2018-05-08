<?php

require('../config.php');
//passwordcheck
include("../cms/libs/passwordcheck.inc");
if (!$admin) 
{
	header("Location: /admin/login.php");
	exit();
}

$mode = "adm_language_file";
$order = !empty($_GET["order"]) ? $_GET["order"] : '';

$name = !empty($_POST["name"]) ? $_POST["name"] : '';
$save = !empty($_POST["save"]) ? $_POST["save"] : '';

if ($save)
{
	$old = array('"');
	$new = array('&quot;');
	foreach($name as $name_key => $name_val)
	{
		unset($field);
		foreach($languages as $key => $val)
		{
			$field[$val["id"]] = mysql_real_escape_string(str_replace($old, $new, $name_val[$val["id"]]));
		}
		if ($name_key < 0)
		{//jauns
			if(mysql_real_escape_string($name_val["name"]))
			{
				mysql_query("INSERT INTO `".PREFIX."adm_lang` SET `name` = '".mysql_real_escape_string($name_val["name"])."'");
				$last_id = mysql_insert_id();
					
				foreach($languages as $key => $val)
				{
					$field[$val["id"]] = mysql_real_escape_string(str_replace($old, $new, $name_val[$val["id"]]));
					mysql_query("
							INSERT INTO `".PREFIX."adm_lang_data`
							SET
								`val_id` = '$last_id',
								`lang_id` = '".$val["id"]."',
								`value` = '".$field[$val["id"]]."'
								");
				}
			}
		}
		else
		{//update
			foreach($languages as $key => $val)
			{
				mysql_query("DELETE FROM `".PREFIX."adm_lang_data`
						WHERE `val_id` = '$name_key' AND `lang_id` = '".$val["id"]."';");
						
				mysql_query("
						INSERT INTO `".PREFIX."adm_lang_data`
						SET 
							`val_id` = '$name_key',
							`lang_id` = '".$val["id"]."',
							`value` = '".$field[$val["id"]]."';
							");
			}
		}
	}
}
	header("location: /admin/$mode/$order");
	exit();
?>