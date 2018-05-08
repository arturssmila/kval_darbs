<?php
$user_id = !empty($_POST["user_id"]) ? $_POST["user_id"] : "";
$parent_id = !empty($_POST["post_id"]) ? $_POST["post_id"] : "";
$content = !empty($_POST["text"]) ? $_POST["text"] : "";

require('../../config.php');

$name = mysql_real_escape_string(strip_tags($content));
$content = "<p>".$name."</p>";

$name = trim(mb_substr($name,0,50));
$name .= (mb_strlen($name) > 49) ? '..' : '';

if(($user_id) && ($name) && ($parent_id))
{
	$template_id = template("S",array("template"=>"comment"),$tpl) ? $tpl[0]["id"] : 0;
	
	/************* LAUCIŅI *****************/
	get_fields($fields, $field_names, $fields_ids,NULL);
	/*****************************/
	
	$query = "INSERT INTO ".PREFIX."meta SET 
		creator_id = '".$user_id."', 
		parent_id = '".$parent_id."', 
		template_id = '".$template_id."',
		hide_link = '".(!empty($settings["comment_approoving"])?'1':'0')."'
		";
	mysql_query($query);
	$id = mysql_insert_id();
	
	foreach($languages as $key => $val)
	{
		$insert_data[$val["id"]]["name"] = $name;
		$insert_data[$val["id"]]["menu_name"] = $name;
		$insert_data[$val["id"]]["content"] = $content;
	}
	$insert_data[0]["ip_address"] = $_SERVER['REMOTE_ADDR'];
	
	foreach($insert_data as $lkey => $val)
	{
		foreach($val as $mdkey => $mdval)
		{
			if(!empty($fields_ids[$mdkey]))
			{
				mysql_query("DELETE FROM ".PREFIX."meta_data WHERE 
					meta_id = '$id' AND 
					field_id = '".$fields_ids[$mdkey]."' AND 
					language_id = '$lkey'
					;") or die(mysql_error());
				mysql_query("INSERT INTO ".PREFIX."meta_data SET 
					meta_id = '$id', 
					field_id = '".$fields_ids[$mdkey]."',
					language_id = '$lkey',
					field_content = '".$mdval."'
					;") or die(mysql_error());
			}
		}
	}
	set_meta_row($id);
	echo "OK";
}
