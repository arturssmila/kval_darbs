<?php

	require('../config.php');
	//passwordcheck
	include("../cms/libs/passwordcheck.inc");
	if (!$admin) 
	{
		header("Location: /admin/login.php");
		exit();
	}
	
	$mode = "templates";
	
	$name = !empty($_POST["name"]) ? $_POST["name"] : '';
	$save = !empty($_POST["save"]) ? $_POST["save"] : '';
	//print_r($name);
	if ($save)
	{//update
		$old = array('"');
		$new = array('&quot;');
		foreach($name as $key => $val)
		{
			$t_p_id		= !empty($val["t_p_id"]) ? $val["t_p_id"] : 0;
			$template	= !empty($val["template"]) ? mysql_real_escape_string(str_replace($old, '', $val["template"])) : '';
			$template_name	= mysql_real_escape_string(str_replace($old, $new, $val["template_name"]));
			if ($key < 0)
			{
				if($template)
				{
					mysql_query("INSERT INTO ".PREFIX."templates (t_p_id,template,template_name) VALUES (
						'".$t_p_id."',
						'".$template."',
						'".$template_name."')") or die(mysql_error());
				}
			}
			else
			{
				mysql_query("UPDATE ".PREFIX."templates SET ". 
					/*"t_p_id = '".$t_p_id."', ".
					"template = '".$template."', ".*/
					"template_name = '".$template_name."'
				where t_id = $key ;") or die(mysql_error());			
			}
		}
	}
	header("location: /admin/$mode/$order");
	exit();
?>