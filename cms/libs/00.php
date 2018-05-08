<?php
if(!empty($_POST["action"]) && ( parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) === $_SERVER['HTTP_HOST'] ) )
{
	require('../../config.php');
	
	$action = !empty($_POST["action"]) ? $_POST["action"] : die('no_action');
			
	//$lang = !empty($_POST["lang"]) ? $_POST["lang"] : $languages[0]["iso"];
	//$lang_id = langid_from_iso($lang);
	
	//lang("S",array(),$lg);
	
	$response = array();
	
	switch($action)
	{
		case "unlink_profile":
			if(!empty($_POST["user_id"]) && !empty($_POST["linked_user"]))
			{
				mysql_query("DELETE FROM `".PREFIX."linked_users`
						WHERE `user_id` = '".$_POST["user_id"]."'
						AND `linked_user` = '".$_POST["linked_user"]."' ");
				set_users_row($_POST["user_id"]);
			}
			break;
		case "forgot_password":
			if(!empty($_POST["data"]))
			{
				foreach($_POST["data"] as $key => $val)
				{
					if(!empty($val["key"]) && ($val["key"]=="email") && !empty($val["value"]))
					{
						$response["ok"] = 1;
						if(get_user("S", array("mail"=>$val["value"],"soc"=>"00"),$user))
						{
							$user_lang = $user[0]["admin_language"];
							$lang_id = langid_from_iso($user_lang);
							lang("S",array("lang"=>$user_lang),$lg);
							
							$reset_code = uniqid();
							mysql_query("INSERT INTO `".PREFIX."password_resets`
									SET
										`user_id` = '".$user[0]["id"]."',
										`reset_code` = '$reset_code'
								");
							$email_data = array(
										'sender_name'	=> (!empty($lg["email_sender_name"]) ? $lg["email_sender_name"] : '[email_sender_name]'),
										'reciever_name'	=> $val["value"],
										'body'		=> str_replace(
														"#link",
														('http'.(!empty($_SERVER["HTTPS"]) ? 's' : '').'://'.$_SERVER["HTTP_HOST"]."?reset_code=$reset_code"),
														(!empty($lg["forgot_password_body"]) ? $lg["forgot_password_body"] : '[forgot_password_body]')
														),
										'subject'	=> (!empty($lg["forgot_password_subject"]) ? $lg["forgot_password_subject"] : '[forgot_password_subject]')
									);
							$response["ok"] = @send_email('',$val["value"],$email_data);
						}
					}
				}
			}
			break;
		case "reset_password":
			if(!empty($_POST["data"]))
			{
				$response["data"] = $_POST["data"];
				foreach($_POST["data"] as $key => $val)
				{
					if(!empty($val["key"]) && !empty($val["value"]))
					{
						if($val["key"]=="password")
						{
							$password = $val["value"];
						}
						if($val["key"]=="password2")
						{
							$password2 = $val["value"];
						}
						if($val["key"]=="reset_code")
						{
							$reset_code = $val["value"];
						}
					}
				}
				if(!empty($password) && !empty($password2) && ($password==$password2) && !empty($reset_code))
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
							pr.`reset_code` = '".mysql_real_escape_string($reset_code)."'
							AND
							u.`soc` = '00'
							";
					$res = mysql_query($query);
					if(mysql_num_rows($res) > 0)
					{
						$row = mysql_fetch_assoc($res);
						if(!empty($row["user_id"]) && !empty($row["active"]) && !empty($row["mail"]))
						{
							get_user("U",array("id"=>$row["user_id"],"password"=>$password),$x);
							$response["password_changed"] = 1;
							mysql_query("DELETE FROM `".PREFIX."password_resets` WHERE `reset_code` = '".mysql_real_escape_string($reset_code)."'");
						}						
					}
				}
			}
			break;
	}
	echo json_encode($response);
	exit();
}
/*******************************************************************************/
	require_once('../../config.php');
	$lang = !empty($_POST["lang"]) ? $_POST["lang"] : $languages[0]["iso"];
	$admin_lang = $lang;
	require_once('../../admin/admin_language.php');
	if(!empty($_POST["data"]) && array_filter($_POST["data"]))
	{
		$data = $_POST["data"];
	}
	if(!empty($_GET["l"]))
	{
		luri($_GET["l"]);
	}
	/**************************************************************************/
	//REGISTERING
	if(!empty($data["register"]))
	{
		$full_address = array();
		foreach($data as $key => $val)
		{
			if(!empty($val["data"]) && !empty($val["key"]))
			{
				if($val["data"]=="user")
				{
					$user_table[$val["key"]] = $val["value"];
				}
				if($val["data"]=="user_data")
				{
					$user_data_table[$val["key"]] = $val["value"];
					switch($val["key"])
					{
						case "shop_address":
						case "shop_post_code":
							$full_address[] = $val["value"];
							break;
						case "shop_country":
							$query = "SELECT `name` FROM `".PREFIX."countries` WHERE `id` = '".$val["value"]."'";
							$res = mysql_query($query);
							if(mysql_num_rows($res) > 0)
							{
								$row = mysql_fetch_assoc($res);
								$full_address[] = $row["name"];
							}
							
					}
				}
			}
		}
		$full_address = implode(' ',$full_address);
		$full_address = urlencode(str_replace(' ','+',$full_address));
		if(!empty($full_address))
		{
			$coordinates = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=$full_address&sensor=true");//"&key=AIzaSyDdTRWIcrRrhlyiVv3M9Aw2dA77prsBA5Y");
			$coordinates = json_decode($coordinates);
			$status = $coordinates->status;
			if($status=="OK")
			{
				$user_data_table["lat"] = $coordinates->results[0]->geometry->location->lat;
				$user_data_table["lon"] = $coordinates->results[0]->geometry->location->lng;
			}
		}
		//out($user_table);
		if(!empty($user_table["mail"]))
		{
			if(!get_user("S", array("mail"=>$user_table["mail"]), $is_user))
			{
				 if(!empty($user_table["password"]) && !empty($user_table["password2"]))
				 {
				 	 if($user_table["password"] == $user_table["password2"])
				 	 {
				 	 	 get_user("I",array(
				 	 	 	 		"active"=>(isset($user_table["active"]) ? $user_table["active"] : '1'),
									"mail"=>$user_table["mail"],
									"name"=>(!empty($user_table["name"]) ? $user_table["name"] : ''),
									"surname"=>(!empty($user_table["surname"]) ? $user_table["surname"] : ''),
									"user_type"=>(!empty($user_table["user_type"]) ? $user_table["user_type"] : 'F'),
									"password"=>$user_table["password"]
									),$id);
						 if(!empty($id) && !empty($user_data_table) && array_filter($user_data_table))
						 {
						 	 set_user(array(
									"id" => $id,
									"mail" => $user_table["mail"],
									"name" => (!empty($user_table["name"])?$user_table["name"]:''),
									"surname" => (!empty($user_table["surname"])?$user_table["surname"]:''),
						 	 	 ),"00");
						 	 $_SESSION["just_now_registered"] = true;
						 	 foreach($user_data_table as $key => $val)
						 	 {
						 	 	 if(!empty($val))
						 	 	 {
						 	 	 	 mysql_query("INSERT INTO `".PREFIX."users_data` SET 
														`user_id` = '$id',
														`name` = '$key',
														`lang_id` = '0',
														`value` = '".mysql_real_escape_string(strip_tags($val))."'
														");
								 }
						 	 }
						 	 set_users_row($id);
						 }
				 	 }
				 	 else echo al('different_passwords');
				 }
				 else echo al('no_password');
			}
			else echo al('user_exist');
		}
		else echo al('no_mail');
		exit();		
	}
	/**************************************************************************/
	
	if (!empty($data["mail"]) && !empty($data["password"]))
	{
		if(get_user("S", array("mail"=>$data["mail"],"password"=>$data["password"]),$user))
		{
			set_user($user[0],"00");
		}
		else
		{
			echo al('wrong_user_or_password');
			exit();
		}
	}
	else
	{
		echo al('no_user_or_password');
		exit();
	}
	$user = array();
	echo 'OK';
?>
