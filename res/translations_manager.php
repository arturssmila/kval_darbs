<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/res_functions.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/database.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/functions.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/set_user.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/users.inc");
	if(!empty($_POST["action"])){
		if($_POST["action"] == "changePairSpecialities"){
			if((!empty($_POST["data"])) && (!empty($_POST["pair_id"]))){
				$query = "SELECT * FROM employee_language_pairs WHERE id=\"" . $_POST["pair_id"] . "\"";//get all language pairs of employee
			    $rs= mysql_query($query);
			    $employee_pear = getSqlRows($rs);//yes, pears
			    if(!empty($employee_pear)){
			    	if(!checkPermission(2, $employee_pear[0]["employee_id"])){
			    		//echo __LINE__;
				    	echo(json_encode("error"));
				    	exit();
				    }
			    }else{
			    	//echo __LINE__;
			    	echo(json_encode("error"));
			    	exit();
			    }
				
				$query = "SELECT * FROM language_pair_specialities WHERE pair_id=\"" . $_POST["pair_id"] . "\"";//get all language pairs of employee
			    $rs= mysql_query($query);
			    $employee_pears = getSqlRows($rs);//yes, pears
			    if(!empty($employee_pears)){
	    			$delete = $employee_pears;
			    	foreach ($_POST["data"] as $key => $value) {
			    		foreach ($employee_pears as $keyy => $valuee) {
			    			if($value == $valuee["speciality_id"]){
			    				foreach ($delete as $keyyy => $valueee) {
			    					if($valueee["speciality_id"] == $valuee["speciality_id"]){
			    						unset($delete[$keyyy]);
			    					}
			    				}
			    			}
			    		}
			    	}
			    	foreach ($delete as $key => $value) {
			    		$query = "DELETE FROM language_pair_specialities WHERE (pair_id=\"" . $value["pair_id"] . "\") AND (speciality_id=\"".$value["speciality_id"]."\")";//get all language pairs of employee
					    $rs= mysql_query($query);
			    	}
			    }
		    	foreach ($_POST["data"] as $key => $value) {
		    		$query = "SELECT * FROM language_pair_specialities WHERE (pair_id=\"" . $_POST["pair_id"] . "\") AND (speciality_id=\"".$value."\")";//get all language pairs of employee
				    $rs= mysql_query($query);
				    $some_result = getSqlRows($rs);
				    if(empty($some_result)){
			    		$query = "INSERT INTO language_pair_specialities (pair_id, speciality_id)
						VALUES ('" . htmlspecialchars($_POST["pair_id"], ENT_QUOTES, "UTF-8", true) . "', '" . htmlspecialchars($value, ENT_QUOTES, "UTF-8", true) . "')";
						$insert = mysql_query($query);
						if(!$insert){
							//echo __LINE__;
							echo "empty";
							exit();
						}
				    }
		    	}
			    $query = "SELECT * FROM language_pair_specialities WHERE pair_id=\"" . $_POST["pair_id"] . "\"";//get all language pairs of employee
			    $rs= mysql_query($query);
			    $employee_specialities = getSqlRows($rs);//yes, pears
			    if(!empty($employee_specialities)){
					echo(json_encode("ok"));
			    }else{
					//echo __LINE__;
			    	echo "empty";
			    }
			    exit();
			}else{
				//echo __LINE__;
				echo("empty");
				exit();
			}
		}else if($_POST["action"] == "changeDateLearned"){
			if((!empty($_POST["main_id"])) && (!empty($_POST["field"])) && (!empty($_POST["value"]))){
	    		$query = "SELECT * FROM employee_language_pairs WHERE id=\"" . $_POST["main_id"] . "\"";//get all language pairs of employee
			    $rs= mysql_query($query);
			    $some_result = getSqlRows($rs);
			    if(!checkPermission(2, $some_result[0]["employee_id"])){
					echo(json_encode("error"));
					exit();
			    }
				$value = $_POST["value"];
				$field = htmlspecialchars($_POST["field"], ENT_QUOTES, "UTF-8", true);
				if(preg_match('^(19|20)\d{2}$^',$value)){
					if(($value <= date("Y")) && ($value > 1920)){
						$result = mysql_query("SHOW COLUMNS FROM `employee_language_pairs` LIKE '".$field."'");
						$check_field = getSqlRows($result);
						if(!empty($check_field)) {
							$query = "UPDATE employee_language_pairs
									SET when_learned=$value
									WHERE id=".$_POST["main_id"];
							$result = mysql_query($query);
							$numRows = mysql_affected_rows();
							if(!empty($numRows)){
								echo(json_encode("ok"));
								exit();
							}else{
								echo(json_encode("error"));
								exit();
							}
						}else{
							echo(json_encode("error"));
							exit();
						}
					}else{
						echo(json_encode("error"));
						exit();
					}
				}else{
					echo(json_encode("error"));
					exit();
				}
			}
			echo(json_encode("ok"));
			exit();
		}else if($_POST["action"] == "changePairRate"){
		    if(!checkPermission(1, 0)){
					//echo __LINE__;
				echo(json_encode("error"));
				exit();
		    }
			if((!empty($_POST["main_id"])) && (!empty($_POST["field"])) && (!empty($_POST["value"]))){
				$value = $_POST["value"];
				$value = str_replace(",", ".", $value);
				$field = htmlspecialchars($_POST["field"], ENT_QUOTES, "UTF-8", true);
				if((!empty($value)) && ((is_numeric($value)) || (is_float($value)))){
					$result = mysql_query("SHOW COLUMNS FROM `employee_language_pairs` LIKE '".$field."'");
					$check_field = getSqlRows($result);
					if(!empty($check_field)) {
						$query = "UPDATE employee_language_pairs
								SET rate=$value
								WHERE id=".$_POST["main_id"];
						$result = mysql_query($query);
						$numRows = mysql_affected_rows();
						if(!empty($numRows)){
							echo(json_encode("ok"));
							exit();
						}else{
					//echo __LINE__;
							echo(json_encode("error"));
							exit();
						}
					}else{
					//echo __LINE__;
						echo(json_encode("error"));
						exit();
					}
				}else{
					//echo __LINE__;
					echo(json_encode("error"));
					exit();
				}
			}
			echo(json_encode("ok"));
			exit();
		}else if($_POST["action"] == "removeEmployeePairs"){
			if(!empty($_POST["data"])){
				foreach ($_POST["data"] as $key => $value) {
		    		$query = "SELECT employee_id FROM employee_language_pairs WHERE id=\"" . $value . "\"";//get all language pairs of employee
				    $rs= mysql_query($query);
				    $some_result = getSqlRows($rs);
				    if(checkPermission(2, $some_result[0]["employee_id"])){
			    		$query = "DELETE FROM language_pair_specialities WHERE pair_id=\"" . $value . "\"";//delete all employee pair specialities
					    $rs= mysql_query($query);
			    		$query = "DELETE FROM employee_language_pairs WHERE id=\"" . $value . "\"";//delete all employee pair specialities
					    $rs= mysql_query($query);
				    }else{
						echo(json_encode("error"));
						exit();
				    }
				}
				echo(json_encode("ok"));
				exit();
			}else{
				echo(json_encode("error"));
				exit();
			}
		}else if($_POST["action"] == "add_employee_pair"){
			if(!empty($_POST["data"]) && !empty($_POST["employee_id"])){
				$return_ids = array();
				foreach ($_POST["data"] as $key => $value) {
					if(!empty($value["amount"])){
						$amount = str_replace(",", ".", $value["amount"]);
					}
					if((!empty($amount)) && ((is_numeric($amount)) || (is_float($amount)))){
						$current = 0;
						$current_employee = array();
						meta("S", array("template"=>"language_pair", "id"=>$value["id"]), $current);
						get_user("S", array("id"=>$_POST["employee_id"]), $current_employee);
						if($current && $current_employee){
							$query = "SELECT * FROM employee_language_pairs WHERE (employee_id=\"" . $_POST["employee_id"] . "\") AND (pair_id=\"".$value["id"]."\")";
						    $rs= mysql_query($query);
							$new_rows = getSqlRows($rs);
							if(!$new_rows){
								$query = "INSERT INTO employee_language_pairs (employee_id, pair_id, when_learned, rate, currency)
							VALUES ('" . mysql_real_escape_string($_POST["employee_id"]) . "', '" . mysql_real_escape_string($value["id"]) . "', '" . mysql_real_escape_string($value["date"]) . "', '". $amount ."', '".$value["currency"]."')";
								$new_pair = mysql_query($query) or die('Error: ' . mysql_error());
								//$new_pair_id = mysql_insert_id();
								if($new_pair){
									$return_ids[] = $value["id"];
								}
							}
						}
					}
				}
				if(empty($return_ids)){
					//echo __LINE__;
					echo("empty");
					exit();
				}
				echo(json_encode($return_ids));
				exit();
			}else{
				//echo __LINE__;
				echo("empty");
				exit();
			}
		}else if($_POST["action"] == "get_employee_pairs"){
			if(!empty($_POST["employee_id"])){
				$query = "SELECT * FROM employee_language_pairs WHERE employee_id=\"" . $_POST["employee_id"] . "\"";//get all language pairs of employee
			    $rs= mysql_query($query);
			    $employee_pears = getSqlRows($rs);//yes, pears
			    meta("S", array("template"=>"language_pair"), $all_pears);//get all language pairs
			    $returnable_pairs = array();
				if(!empty($employee_pears) && !empty($all_pears)){
					foreach ($employee_pears as $key => $value) {
						foreach ($all_pears as $keyy => $valuee) {
							if($valuee["id"] == $value["pair_id"]){
								$valuee["when_learned"] = $value["when_learned"];
								$valuee["rate"] = $value["rate"];
								$valuee["currency"] = $value["currency"];
								$returnable_pairs[] = $valuee;//add language pair to employee laguage pair array which he possesses
								break;
							}
						}
					}
				}
				echo(json_encode($returnable_pairs));
				exit();
			}
			//echo __LINE__;
			echo "empty";
			exit();
		}
		echo("error");
		exit();
	}
?>