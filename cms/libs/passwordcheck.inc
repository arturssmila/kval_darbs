<?php
$login = false;
$admin = false;
if(isset($_COOKIE["mail"]) && isset($_COOKIE["password"]))
{
	$mail = $_COOKIE["mail"];
	$password = $_COOKIE["password"];
	if (($mail) && ($password))
	{
		if(get_user("S", array("mail"=>$mail,"password"=>$password,"active"=>1),$user))
		{
			setcookie("mail", "", time()-3600, "/");
			setcookie("mail", $mail, time()+$settings["log_time"], "/");
			setcookie("password", "", time()-3600, "/");
			setcookie("password", $password, time()+$settings["log_time"], "/");
			setcookie("admin", "", time()-3600, "/");
			setcookie("admin", $user[0]["admin"], time()+$settings["log_time"], "/");
			
			$login = true;
			get_user("L", array("id"=>$user[0]["id"]),$x);
			$admin = !empty($user[0]["admin"]) ? $user[0]["admin"] : false;
			$creator_id = $user[0]["id"];
			
			//out($modes);
			//include admin files
			$admin_path = "/admin/includes/admin/";
			$full_admin_path = ROOT.$admin_path;
			if(file_exists($full_admin_path))
			{
				if($handle = opendir($full_admin_path))
				{
					while(false !== ($file = readdir($handle)))
					{
						switch(strtolower(substr($file, -4)))
						{
							case ".php":
								if(empty($modes[substr(substr($file, 1),0,-4)]))
								{
									$tree_mode = $modes["tree"];
									unset($modes["tree"]);
									$modes = array_reverse($modes,true);									
									$modes[substr(substr($file, 1),0,-4)]["user_types"][] = "super_admin";									
									$modes["tree"] = $tree_mode;
									$modes = array_reverse($modes,true);									
								}
								break;
						}
					}
					closedir($handle);
				}
			}
			//include super_admin files
			$super_admin_path = "/admin/includes/super_admin/";
			$full_super_admin_path = ROOT.$super_admin_path;
			if(file_exists($full_super_admin_path))
			{
				if($handle = opendir($full_super_admin_path))
				{
					while(false !== ($file = readdir($handle)))
					{
						switch(strtolower(substr($file, -4)))
						{
							case ".php":
								if(empty($modes[substr(substr($file, 1),0,-4)]))
								{
									$modes[substr(substr($file, 1),0,-4)]["user_types"][] = "super_admin";					
								}
								break;
						}
					}
					closedir($handle);
				}
			}
			if(!empty($user[0]["user_modes"]))
			{
				$user_modes = explode("#",$user[0]["user_modes"]);
				foreach($user_modes as $key => $val)
				{
					if(!empty($modes[$val]))
					{
						if(!(in_array("all",$modes[$val]["user_types"])) && !empty($user[0]["admin_type"]) && !(in_array($user[0]["admin_type"],$modes[$val]["user_types"])))
						{
							$modes[$val]["user_types"][] = $user[0]["admin_type"];
						}
					}
					else
					{
						$tree_mode = $modes["tree"];
						unset($modes["tree"]);
						$modes = array_reverse($modes,true);
						
						$modes[$val]["user_types"][] = "super_admin";
						$modes[$val]["user_types"][] = $user[0]["admin_type"];
						
						$modes["tree"] = $tree_mode;
						$modes = array_reverse($modes,true);
					}
				}
				//out($user_modes);
			
			}
			
			mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."modes_attributes` (
				`mode` varchar(255) DEFAULT NULL,
				`attr` varchar(255) DEFAULT NULL,
				`value` int(11) DEFAULT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
			
			$query = "SELECT * FROM `".PREFIX."modes_attributes`
				WHERE
					`attr` = 'tree'
					".(!empty($user_modes) ? ( "AND (`mode` = '".implode("' OR `mode` = '",$user_modes)."') ") : '')."
					";
			$res = mysql_query($query);
			if(mysql_num_rows($res) > 0)
			{
				while($row = mysql_fetch_assoc($res))
				{
					//out($row);
					$modes[$row["mode"]][$row["attr"]] = $row["value"];
				}
			}
			//out($modes);
			
			if(!empty($_GET["mode"]))
			{
				//echo $_GET["mode"].' in '; out($modes[$_GET["mode"]]["user_types"]);
				if(
					!empty($user[0]["admin_type"])
					&&
					($user[0]["admin_type"]!="super_admin")
					&&
					!(
						in_array($user[0]["admin_type"],$modes[$_GET["mode"]]["user_types"])
						||
						in_array("all",$modes[$_GET["mode"]]["user_types"])
					)
				)
				{
					header("Location: /admin/");
					exit();
				}
			}
		}
	}
}

if(empty($login_page) && !$admin && !$login) 
{
	//out($_GET["mode"]);
	header("Location: /admin/login.php");
	exit();
}

?>
