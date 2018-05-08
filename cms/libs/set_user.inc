<?php
function set_user($tmp_user, $soc)
{
	//out($tmp_user);
	//die();
	
	switch($soc)
	{
		case "00"://Iekšējais lietotājs
			$user["id"] = $tmp_user["id"];
			$user["soc"] = $soc;
			$user["mail"] = $tmp_user["mail"];
			$user["name"] = $tmp_user["name"];
			$user["surname"] = $tmp_user["surname"];
			$user["image"] = !empty($tmp_user["image"]) ? $tmp_user["image"] : '';
			break;
		case "DR"://draugiem.lv lietotājs
			if(!empty($tmp_user["uid"]))
			{
				$user_data_0 = array();
				if(!empty($tmp_user["sex"]))
				{
					$user_data_0["gender"] = (strtoupper($tmp_user["sex"])=="M") ? "M" : "F";
				}
				if(!empty($tmp_user["age"]))
				{
					$user_data_0["age"] = $tmp_user["age"];
				}
				if(get_user("S", array("soc"=>$soc,"soc_id"=>$tmp_user["uid"]),$x))
				{
					mysql_query("UPDATE ".PREFIX."users SET 
									soc = '$soc',
									soc_id = '".$tmp_user["uid"]."', 
									name = '".$tmp_user["name"]."', 
									surname = '".$tmp_user["surname"]."', 
									image = '".$tmp_user["imgm"]."'					
								where soc = '$soc' AND soc_id = '".$tmp_user["uid"]."' ;");
					
					get_user("U",array(
								"id"=>$x[0]["id"],
								"user_data_0"=>$user_data_0
								),$z);
				}
				else
				{
					get_user("I",array(
								"soc"=>$soc,
								"soc_id"=>$tmp_user["uid"],
								"name"=>$tmp_user["name"],
								"surname"=>$tmp_user["surname"],
								"image"=>$tmp_user["imgm"],
								"user_data_0"=>$user_data_0
							),$x);
					
				}
				get_user("S", array("soc"=>$soc,"soc_id"=>$tmp_user["uid"]),$y);
				$user["id"] = $y[0]["id"];
				$user["soc"] = $soc;
				$user["soc_id"] = $tmp_user["uid"];
				$user["mail"] = '';
				$user["name"] = $tmp_user["name"];
				$user["surname"] = $tmp_user["surname"];
				$user["image"] = $tmp_user["imgm"];
			}
			break;
		case "TW"://twitter.com lietotājs
			if(!empty($tmp_user["id"]))
			{
				$tw_names = explode(" ",$tmp_user["name"]);
				$tw_surname = (count($tw_names)>1) ? array_pop($tw_names) : '';
				$tw_name = implode(" ",$tw_names);
				
				if(get_user("S", array("soc"=>$soc,"soc_id"=>$tmp_user["id"]),$x))
				{
					mysql_query("UPDATE ".PREFIX."users SET 
									soc = '$soc',
									soc_id = '".$tmp_user["id"]."', 
									name = '".$tw_name."', 
									surname = '".$tw_surname."', 
									image = '".$tmp_user["image"]."'					
								where soc = '$soc' AND soc_id = '".$tmp_user["id"]."' ;");
					set_users_row($x[0]["id"]);
				}
				else
				{
					get_user("I",array("soc"=>$soc,"soc_id"=>$tmp_user["id"],"name"=>$tw_name,"surname"=>$tw_surname,"image"=>$tmp_user["image"]),$x);
				}
				get_user("S", array("soc"=>$soc,"soc_id"=>$tmp_user["id"]),$y);
				$user["id"] = $y[0]["id"];
				$user["soc"] = $soc;
				$user["soc_id"] = $tmp_user["id"];
				$user["name"] = $tw_name;
				$user["surname"] = $tw_surname;
				$user["image"] = $tmp_user["image"];
			}
			break;
		case "GO"://google.com lietotājs
			if(!empty($tmp_user["id"]))
			{
				$user_data_0 = array();
				if(!empty($tmp_user["gender"]))
				{
					$user_data_0["gender"] = $tmp_user["gender"];
				}
				if(get_user("S", array("soc"=>$soc,"soc_id"=>$tmp_user["id"]),$x))
				{
					mysql_query("UPDATE ".PREFIX."users SET 
									soc = '$soc',
									soc_id = '".$tmp_user["id"]."', 
									name = '".$tmp_user["name"]."', 
									surname = '".$tmp_user["surname"]."', 
									mail = '".$tmp_user["mail"]."', 
									image = '".$tmp_user["image"]."'				
								where soc = '$soc' AND soc_id = '".$tmp_user["id"]."' ;");
					get_user("U",array(
								"id"=>$x[0]["id"],
								"user_data_0"=>$user_data_0
								),$z);
				}
				else
				{			
					get_user("I",array(
								"soc"=>$soc,
								"soc_id"=>$tmp_user["id"],
								"name"=>$tmp_user["name"],
								"surname"=>$tmp_user["surname"],
								"mail"=>$tmp_user["mail"],
								"image"=>$tmp_user["image"],
								"user_data_0"=>$user_data_0
								),$x);
				}
				get_user("S", array("soc"=>$soc,"soc_id"=>$tmp_user["id"]),$y);
				$user["id"] = $y[0]["id"];
				$user["soc"] = $soc;
				$user["soc_id"] = $tmp_user["id"];
				$user["mail"] = $tmp_user["mail"];
				$user["name"] = $tmp_user["name"];
				$user["surname"] = $tmp_user["surname"];
				$user["image"] = $y[0]["image"];
			}
			break;
		case "FB"://facebook lietotājs
			if(!empty($tmp_user["id"]))
			{
				if(empty($tmp_user["first_name"]) && empty($tmp_user["last_name"]))
				{
					$fb_names = explode(" ",$tmp_user["name"]);
					$fb_surname = (count($fb_names)>1) ? array_pop($fb_names) : '';
					$fb_name = implode(" ",$fb_names);
				}
				else
				{
					$fb_name = !empty($tmp_user["first_name"]) ? $tmp_user["first_name"] : '';
					$fb_surname = !empty($tmp_user["last_name"]) ? $tmp_user["last_name"] : '';
				}
				
				if(get_user("S", array("soc"=>$soc,"soc_id"=>$tmp_user["id"]),$x))
				{
					mysql_query("UPDATE ".PREFIX."users SET 
									soc = '$soc',
									soc_id = '".$tmp_user["id"]."', 
									name = '".$fb_name."', 
									surname = '".$fb_surname."', 
									image = 'https://graph.facebook.com/".$tmp_user["id"]."/picture?type=large'					
								where soc = '$soc' AND soc_id = '".$tmp_user["id"]."' ;");
					set_users_row($x[0]["id"]);
				}
				else
				{
					get_user("I",array("soc"=>$soc,"soc_id"=>$tmp_user["id"],"name"=>$fb_name,"surname"=>$fb_surname,"image"=>"https://graph.facebook.com/".$tmp_user["id"]."/picture?type=large"),$x);
				}
				get_user("S", array("soc"=>$soc,"soc_id"=>$tmp_user["id"]),$y);
				$user["id"] = $y[0]["id"];
				$user["soc"] = $soc;
				$user["soc_id"] = $tmp_user["id"];
				$user["mail"] = $y[0]["mail"];
				$user["name"] = $fb_name;
				$user["surname"] = $fb_surname;
				$user["image"] = $y[0]["image"];
			}
			break;
	}
	
	if(!empty($user) && array_filter($user))
	{
		//ja ir ielogojies ar 00 profilu un pieslēdz sociālo
		if(!empty($_SESSION["user"]["id"]) && !empty($_SESSION["user"]["soc"]) && ($_SESSION["user"]["soc"]=="00"))
		{
			//linking profiles
			if(!empty($user["id"]))
			{
				mysql_query("DELETE FROM ".PREFIX."linked_users
						WHERE 
							`user_id` = '".$_SESSION["user"]["id"]."'
							AND
							`linked_user` = '".$user["id"]."' ");
				set_users_row($_SESSION["user"]["id"]);
				if($user["id"] != $_SESSION["user"]["id"])
				{
					mysql_query("INSERT INTO ".PREFIX."linked_users
							SET 
								`user_id` = '".$_SESSION["user"]["id"]."',
								`linked_user` = '".$user["id"]."' ");
					set_users_row($_SESSION["user"]["id"]);
					if(get_user("S", array("id"=>$_SESSION["user"]["id"],"soc"=>"00"),$q))
					{
						if(!empty($user["image"]))
						{
							get_user("U",array(
									"id"=>$_SESSION["user"]["id"],
									"image"=>$user["image"]
									),$ee);
						}
						$user = $q[0];
					}
				}
			}
		}
		else
		{
			//ja ir sociālais profils
			if(!empty($user["id"]) && !empty($user["soc"]) && ($user["soc"]!="00"))
			{
				$query = "SELECT
						*
					FROM ".PREFIX."linked_users
					WHERE `linked_user` = '".$user["id"]."' ";
				$res = mysql_query($query);
				//ja ir salinkots, tad ejam īstajā profilā
				if(mysql_num_rows($res) > 0)
				{
					$row = mysql_fetch_assoc($res);
					$real_user_id = $row["user_id"];
					if(get_user("S", array("id"=>$real_user_id,"soc"=>"00"),$q))
					{
						if(!empty($user["image"]))
						{
							get_user("U",array(
									"id"=>$real_user_id,
									"image"=>$user["image"]
									),$ee);
						}
						$user = $q[0];
					}
				}
			}
			$user["logged_in"] = date("Y-m-d H:i:s");
			$_SESSION["user"] = $user;
		}
	}
}
?>