<?php
	function getSqlRows($res){
		$result = array();
		if(mysql_num_rows($res) > 0){
		    while($row = mysql_fetch_assoc($res))
			{
				$result[] = $row;
			}
		}
		return $result;
	}
	function resetRegistrationNotifications(){
		get_user("S", array("active"=>"0", "admin"=>"0"), $user_count);
		$pending_users_count = 0;
		if(!empty($user_count)){
			foreach ($user_count as $key => $value) {
				if(!(isset($value["denied"]))){
					$pending_users_count++;
				}else if((isset($value["denied"])) && ($value["denied"] == 0)){
					$pending_users_count++;
				}
			}
		}
		return $pending_users_count;
	}
	function getCurrencies($settings_currencies){
		$currencies = explode(" ", $settings_currencies);
		$currencies = implode(",", $currencies);
		$currencies = explode(" ", $currencies);
		$currencies = implode(",", $currencies);
		$currencies = explode("/", $currencies);
		$currencies = implode(",", $currencies);
		$currencies = explode("-", $currencies);
		$currencies = implode(",", $currencies);
		$currencies = explode(",", $currencies);
		$currencies = implode(" ", $currencies);
		$currencies = explode(";", $currencies);
		$currencies = implode(" ", $currencies);
		$currencies = explode(" ", $currencies);
		return $currencies;
	}

	function checkPermission($level, $affected_id){
		switch ($level) {
			case 1:
				if(($_SESSION["user"]["admin"] == 1) || ($_SESSION["user"]["admin"] == 2)){
					return true;
				}else if($_SESSION["user"]["admin"] == 2){
					if(!empty($_SESSION["user"]["manager"])){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
				break;
			
			case 2:
				if(($_SESSION["user"]["admin"] == 1) || ($_SESSION["user"]["admin"] == 2)){
					return true;
				}else if($_SESSION["user"]["id"] == $affected_id){
					return true;
				}else{
					return false;
				}
				break;

			default:
				# code...
				break;
		}
	}
?>