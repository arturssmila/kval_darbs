<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/res_functions.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/database.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/functions.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/set_user.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/users.inc");
	if(checkPermission(1,0)){
		if(!empty($_POST["action"])){
			if($_POST["action"] == "confirm"){
				if(!empty($_POST["user_id"])){
					$user_data_0 = array();
					$user_data_0["client"] = "1";
					$user_data_0["client_status"] = "0";
					if(get_user("S", array("id"=>$_POST["user_id"]),$x))
					{
						get_user("U",array(
									"id"=>$x[0]["id"],
									"active"=>"1",
									"user_data_0"=>$user_data_0
									),$z) or die(mysql_error());
					}else{
						echo("error");
						exit();
					}
					echo("ok");
					exit();
				}else{
					echo("error");
					exit();
				}
			}else if($_POST["action"] == "decline"){
				if(!empty($_POST["user_id"])){
					$user_data_0 = array();
					$user_data_0["denied"] = "1";
					if(get_user("S", array("id"=>$_POST["user_id"]),$x))
					{
						if(($x[0]["admin"] != 1) && ($x[0]["admin"] != 2)){
							get_user("U",array(
									"id"=>$x[0]["id"],
									"user_data_0"=>$user_data_0
									),$z) or die(mysql_error());
						}else{
							echo("error");
							exit();
						}
					}else{
						echo("error");
						exit();
					}
					echo("ok");
					exit();
				}else{
					echo("error");
					exit();
				}
			}else if($_POST["action"] == "notification"){
				$return = resetRegistrationNotifications();
				echo $return;
				exit();
			}
			echo("error");
			exit();
		}
	}else{
			echo("error");
			exit();
	}
	
?>