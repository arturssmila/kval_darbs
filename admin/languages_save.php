<?php

require('../config.php');
//passwordcheck
include("../cms/libs/passwordcheck.inc");
if (!$admin) 
{
	header("Location: /admin/login.php");
	exit();
}

$mode = "languages";
$order = !empty($_POST["order"]) ? $_POST["order"] : '';
$delete = !empty($_POST["delete"]) ? $_POST["delete"] : '';

$name = !empty($_POST["name"]) ? $_POST["name"] : '';
$save = !empty($_POST["save"]) ? $_POST["save"] : '';
if ($delete)
{
	mysql_query("DELETE FROM ".PREFIX."languages WHERE id = $delete ") or die(mysql_error());
}
elseif ($order)
{
	$id = end(explode("#",$order));
	$order = reset(explode("#",$order));
	
	$result = mysql_query("SELECT * FROM ".PREFIX."languages ORDER BY ordering") or die(mysql_error());
	
	while($row = mysql_fetch_assoc($result))
	{
		$fields[] = $row;
	}
	$ord = 0;
	foreach($fields as $key => $val)
	{
		if($val["id"]==$id)
		{
			if($order=="up")
			{
				if(!empty($fields[$key-1]))
				{
					$fields[$key]["ordering"] = $ord-1;
					$fields[$key-1]["ordering"] = $ord;
				}
			}
			else
			{
				if(!empty($fields[$key+1]))
				{
					$fields[$key]["ordering"] = $ord+1;
					$fields[$key+1]["ordering"] = $ord;
				}
			}
		}
		elseif($fields[$key-1]["id"]!=$id)
		{
			$fields[$key]["ordering"] = $ord;
		}
		$ord++;
	}
	foreach($fields as $key => $val)
	{
		mysql_query("UPDATE ".PREFIX."languages SET ordering = ".$val["ordering"]." WHERE id = ".$val["id"]."") or die(mysql_error());
	}
}
elseif ($save)
{
	
	$old = array('"');
	$new = array('&quot;');
	foreach($name as $name_key => $name_val)
	{
		unset($field);
		$field["active"] = !empty($name_val["active"]) ? 1 : 0;
		$field["iso"] = mysql_real_escape_string(str_replace($old, $new, $name_val["iso"]));
		$field["name"] = mysql_real_escape_string(str_replace($old, $new, $name_val["name"]));
		
		if ($name_key < 0)
		{//jauns
			
			if($field["iso"] && $field["name"])
			{
				$result = mysql_query("SELECT  COUNT(*) as ordering FROM ".PREFIX."languages") or die(mysql_error());
				$row = mysql_fetch_assoc($result);
				
				
				mysql_query("INSERT INTO ".PREFIX."languages (active,ordering,iso,name) VALUES (
					'".$field["active"]."',
					".$row["ordering"].",
					'".$field["iso"]."',
					'".$field["name"]."')") or die(mysql_error());
					
				event("I",array("user_id"=>$creator_id,"action"=>'Pievieno jaunu valodu "'.str_replace($old, $new, $name_val["name"]).' ('.str_replace($old, $new, $name_val["iso"]).')"'),$x);
			}
		}
		else
		{//update
			$result = mysql_query("SELECT * FROM ".PREFIX."languages WHERE id = $name_key ;");
			$row = mysql_fetch_assoc($result);
			
			mysql_query("UPDATE ".PREFIX."languages SET 
				active = '".$field["active"]."',
				iso = '".$field["iso"]."', 
				name = '".$field["name"]."' 
					WHERE id = $name_key;") or die(mysql_error());
			event("I",array("user_id"=>$creator_id,"action"=>'Izmaina valodu <strong>'.$row["name"].' ('.$row["iso"].')</strong> uz "'.str_replace($old, $new, $name_val["name"]).' ('.str_replace($old, $new, $name_val["iso"]).')"'),$x);
			
		}
	}
}
	header("location: /admin/$mode/");
	exit();
?>