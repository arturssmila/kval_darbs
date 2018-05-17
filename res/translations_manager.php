<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/res_functions.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/database.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/functions.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/set_user.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/users.inc");
	if(!empty($_POST["action"])){
		switch($_POST["action"]){
			case "changeFileWordCount":
				if($_SESSION["user"]["soc"] != "00"){
					echo(json_encode("error"));
					exit();
				}else if(!isset($_SESSION["user"]["admin"])){
					echo(json_encode("error"));
					exit();
				}else if(!checkPermission(2, 0)){
					//echo __LINE__;
					echo(json_encode("error"));
					exit();
				}
				if((!empty($_POST["main_id"])) && (!empty($_POST["second_id"])) && (!empty($_POST["field"])) && (!empty($_POST["value"]))){
					$value = $_POST["value"];
					$value = str_replace(",", ".", $value);
					$field = htmlspecialchars($_POST["field"], ENT_QUOTES, "UTF-8", true);
					if((!empty($value)) && ((is_numeric($value)) || (is_int($value)))){
						$result = mysql_query("SHOW COLUMNS FROM `submitted_files` LIKE '".$field."'");
						$check_field = getSqlRows($result);
						if(!empty($check_field)) {
							$result = mysql_query("SELECT * FROM `submitted_files` WHERE  (id='".$_POST["main_id"]."') AND (pair_id='".$_POST["second_id"]."')");
							$check_row = getSqlRows($result);
							if(!empty($check_row)){
								if($check_field[0][$field] == $value){
									echo(json_encode("ok"));
									exit();
								}
								$query = "UPDATE submitted_files
										SET $field='$value', price='0'
										WHERE (id='".$_POST["main_id"]."') AND (pair_id='".$_POST["second_id"]."')";
								$result = mysql_query($query);
								$numRows = mysql_affected_rows();
								if(!empty($numRows)){
									$work_id = $check_row[0]["work_id"];
									$query = "UPDATE submitted_work
											SET price='0'
											WHERE id='".$work_id."'";
									$result = mysql_query($query);
									updateWorkWordCount($work_id);
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
					}else{
						//echo __LINE__;
						echo(json_encode("error"));
						exit();
					}
				}
				echo "empty";
				exit();
				break;
			case "getFilePrices":
				if($_SESSION["user"]["soc"] != "00"){
					echo(json_encode("error"));
					exit();
				}else if(!isset($_SESSION["user"]["admin"])){
					echo(json_encode("error"));
					exit();
				}else if(!checkPermission(2, 0)){
					//echo __LINE__;
					echo(json_encode("error"));
					exit();
				}
				if((!empty($_POST["main_id"])) && (!empty($_POST["second_id"])) && (!empty($_POST["field"]))){
						$result = mysql_query("SHOW COLUMNS FROM `submitted_files` LIKE '".$_POST["field"]."'");
						$check_field = getSqlRows($result);
						if(!empty($check_field)) {
							$result = mysql_query("SELECT * FROM `submitted_files` WHERE  (id='".$_POST["main_id"]."') AND (pair_id='".$_POST["second_id"]."')");
							$check_row = getSqlRows($result);
							if(!empty($check_row)){
								//$work_id = $check_row[0]["work_id"];
								if(!empty($check_row[0]["word_count"])){
									if(!empty($_POST["speciality_price_id"])){
										$result = mysql_query("SELECT * FROM `language_pair_prices` WHERE id='".$_POST["speciality_price_id"]."'");
										$get_rates = getSqlRows($result);
										if(!empty($get_rates)){
											$page_percent = $check_row[0]["word_count"] / $settings["standard_page_word_count"];
											$price = $page_percent * $get_rates[0]["rate"];
											$price = round( $price, 2, PHP_ROUND_HALF_UP);
											$price = to_number($price);
											//var_dump($price);
											//exit();
											if($check_row[0]["price"] == $price){
												$out_data["price"] = $price." €";
												$out_data["status"] = "OK";
												echo(json_encode($out_data));
												exit();
											}
											//var_dump($price);
											if(!empty($price)){
												$query = "UPDATE submitted_files
														SET price='$price', speciality_id='".$_POST["speciality_price_id"]."'
														WHERE (id='".$_POST["main_id"]."') AND (pair_id='".$_POST["second_id"]."')";
												$result = mysql_query($query);
												$numRows = mysql_affected_rows();
												if(!empty($numRows)){
													$out_data["price"] = $price." €";
													$out_data["status"] = "OK";
													echo(json_encode($out_data));
													exit();
												}else{
													//echo __LINE__;
													$out_data["status"] = "error";
													echo(json_encode($out_data));
													exit();
												}
											}else{
													//echo __LINE__;
													$out_data["status"] = "error";
													echo(json_encode($out_data));
													exit();
											}
											exit();
										}
									}else{
													//echo __LINE__;
										$out_data["status"] = "error";
										echo(json_encode($out_data));
										exit();
									}
								}else{
									$out_data["status"] = "error";
									echo(json_encode($out_data));
									exit();
								}
							}else{
						//echo __LINE__;
								$out_data["status"] = "error";
								echo(json_encode($out_data));
								exit();
							}
						}else{
						//echo __LINE__;
							$out_data["status"] = "error";
							echo(json_encode($out_data));
							exit();
						}
				}
				$out_data["status"] = "empty";
				echo(json_encode($out_data));
				exit();
				break;
			case "getJobPrice":
				if($_SESSION["user"]["soc"] != "00"){
					echo(json_encode("error"));
					exit();
				}else if(!isset($_SESSION["user"]["admin"])){
					echo(json_encode("error"));
					exit();
				}else if(!checkPermission(2, 0)){
					//echo __LINE__;
					echo(json_encode("error"));
					exit();
				}
				if(!empty($_POST["main_id"])){
					$result = mysql_query("SELECT * FROM `submitted_work` WHERE  id='".$_POST["main_id"]."'");
					$selected_job = getSqlRows($result);
					if(!empty($selected_job)){
						
						if($selected_job[0]["accepted"] == "-1"){
							echo("error");
							exit();
						}
						//updateWorkWordCount($selected_job[0]["id"]);//recount words
						$result = mysql_query("SELECT * FROM `submitted_files` WHERE  work_id='".$_POST["main_id"]."'");
						$selected_files = getSqlRows($result);
						$end_price = 0;
						if(!empty($selected_files)){
							foreach($selected_files as $file_key=>$file_val){
								if(!empty($file_val["price"]) && $file_val["price"] != 0){
									$end_price += $file_val["price"];
								}else{
									$out_data["status"] = "error";
									echo(json_encode($out_data));
									exit();
								}
							}
							
							if($end_price != 0){
								$end_price = round( $end_price, 2, PHP_ROUND_HALF_UP);
								$end_price = to_number($end_price);
								$query = "UPDATE submitted_work
										SET price='$end_price'
										WHERE id='".$_POST["main_id"]."'";
								$result = mysql_query($query);
								$numRows = mysql_affected_rows();
								if($numRows){
									$out_data["status"] = "OK";
									$out_data["price"] = $end_price." €";
									echo(json_encode($out_data));
									exit();
								}else{
									$out_data["status"] = "error";
									echo(json_encode($out_data));
									exit();
								}
							}else{
								$out_data["status"] = "error";
								echo(json_encode($out_data));
								exit();
							}
						}else{
							$out_data["status"] = "error";
							echo(json_encode($out_data));
							exit();
						}
					}else{
				//echo __LINE__;
						$out_data["status"] = "error";
						echo(json_encode($out_data));
						exit();
					}
				}
				$out_data["status"] = "empty";
				echo(json_encode($out_data));
				exit();
				break;
			case "moveJobToTrash":
				if($_SESSION["user"]["soc"] != "00"){
					//echo __LINE__;
							echo("error");
							exit();
				}else if(!isset($_SESSION["user"]["admin"])){
					//echo __LINE__;
							echo("error");
							exit();
				}else if(!checkPermission(2, 0)){
					echo __LINE__;
							echo("error");
							exit();
				}
				//var_dump($_POST);
				//exit();
				if(!empty($_POST["main_id"])){
					$result = mysql_query("SELECT * FROM `submitted_work` WHERE  id='".$_POST["main_id"]."'");
					$selected_job = getSqlRows($result);
					if(!empty($selected_job)){
						//updateWorkWordCount($selected_job[0]["id"]);//recount words
						//$result = mysql_query("SELECT * FROM `submitted_files` WHERE  work_id='".$_POST["main_id"]."'");
						//$selected_files = getSqlRows($result);
						$previous_state = $selected_job[0]["accepted"];
						
						$query = "UPDATE submitted_work
								SET accepted='-2', previous_state='$previous_state'
								WHERE id='".$_POST["main_id"]."'";
						$result = mysql_query($query);
						$numRows = mysql_affected_rows();
						if($numRows){
							echo("ok");
							exit();
						}else{
				//echo __LINE__;
							echo("error");
							exit();
						}
					}else{
				//echo __LINE__;
							echo("error");
							exit();
					}
				}
				//echo __LINE__;
				echo("error");
				exit();
				break;
			case "clientMoveJobToTrash":
				if($_SESSION["user"]["soc"] != "00"){
							echo("error");
							exit();
				}else if(!isset($_SESSION["user"]["admin"])){
							echo("error");
							exit();
				}
				//var_dump($_POST);
				//exit();
				if(!empty($_POST["main_id"])){
					$result = mysql_query("SELECT * FROM `submitted_work` WHERE  id='".$_POST["main_id"]."'");
					$selected_job = getSqlRows($result);
					if(!empty($selected_job)){
						if(!checkPermission(3, $selected_job[0]["user_id"])){
							//echo __LINE__;
							echo("error");
							exit();
						}
						//updateWorkWordCount($selected_job[0]["id"]);//recount words
						//$result = mysql_query("SELECT * FROM `submitted_files` WHERE  work_id='".$_POST["main_id"]."'");
						//$selected_files = getSqlRows($result);
						$previous_state = $selected_job[0]["accepted"];
						
						$query = "UPDATE submitted_work
								SET accepted='-1', previous_state='$previous_state'
								WHERE id='".$_POST["main_id"]."'";
						$result = mysql_query($query);
						$numRows = mysql_affected_rows();
						if($numRows){
							echo("ok");
							exit();
						}else{
							echo("error");
							exit();
						}
					}else{
				//echo __LINE__;
							echo("error");
							exit();
					}
				}
					echo("empty");
					exit();
				break;
			case "changeDateDue":
				if($_SESSION["user"]["soc"] != "00"){
					//echo __LINE__;
							echo("error");
							exit();
				}else if(!isset($_SESSION["user"]["admin"])){
					//echo __LINE__;
							echo("error");
							exit();
				}
				if(!empty($_POST["main_id"]) && !empty($_POST["date_due"])){
					$result = mysql_query("SELECT * FROM `submitted_work` WHERE  id='".$_POST["main_id"]."'");
					$selected_job = getSqlRows($result);
					if(!empty($selected_job)){
						//updateWorkWordCount($selected_job[0]["id"]);//recount words
						//$result = mysql_query("SELECT * FROM `submitted_files` WHERE  work_id='".$_POST["main_id"]."'");
						//$selected_files = getSqlRows($result);
						if(!checkPermission(3, $selected_job[0]["user_id"])){
							echo __LINE__;
									echo("error");
									exit();
						}
						if(!validateDate($_POST["date_due"], "Y-m-d")){
							echo("error");
							exit();
						}						
						if($selected_job[0]["date_due"] == $_POST["date_due"]){
							echo("ok");
							exit();
						}
						$query = "UPDATE submitted_work
								SET date_due='".$_POST["date_due"]."'
								WHERE id='".$_POST["main_id"]."'";
						$result = mysql_query($query);
						$numRows = mysql_affected_rows();
						if($numRows){
							echo("ok");
							exit();
						}else{
				//echo __LINE__;
							echo("error");
							exit();
						}
					}else{
				//echo __LINE__;
							echo("error");
							exit();
					}
				}
				//echo __LINE__;
				echo("error");
				exit();
				break;
			case "moveFromTrash":
				var_dump($_POST);
				exit();
				echo("error");
				exit();
				break;
			case "offerToClient":
				if($_SESSION["user"]["soc"] != "00"){
					echo(json_encode("error"));
					exit();
				}else if(!isset($_SESSION["user"]["admin"])){
					echo(json_encode("error"));
					exit();
				}else if(!checkPermission(2, 0)){
					//echo __LINE__;
					echo(json_encode("error"));
					exit();
				}
				//var_dump($_POST);
				//exit();
				if(!empty($_POST["main_id"])){
					$result = mysql_query("SELECT * FROM `submitted_work` WHERE  id='".$_POST["main_id"]."'");
					$selected_job = getSqlRows($result);
					if(!empty($selected_job)){
						
						if($selected_job[0]["accepted"] == "-1"){
							echo("error");
							exit();
						}
						$previous_state = $selected_job[0]["accepted"];
						
						$query = "UPDATE submitted_work
								SET accepted='1', previous_state='$previous_state'
								WHERE id='".$_POST["main_id"]."'";
						$result = mysql_query($query);
						$numRows = mysql_affected_rows();
						if($numRows){
							echo("ok");
							exit();
						}else{
							echo("error");
							exit();
						}
					}else{
				//echo __LINE__;
						$out_data["status"] = "error";
						echo(json_encode($out_data));
						exit();
					}
				}
				$out_data["status"] = "empty";
				echo(json_encode($out_data));
				exit();
				break;
			case "approvePrice":
				if($_SESSION["user"]["soc"] != "00"){
					echo(json_encode("error"));
					exit();
				}else if(!isset($_SESSION["user"]["admin"])){
					echo(json_encode("error"));
					exit();
				}
				var_dump($_POST);
				exit();
				if(!empty($_POST["main_id"])){
					$result = mysql_query("SELECT * FROM `submitted_work` WHERE  id='".$_POST["main_id"]."'");
					$selected_job = getSqlRows($result);
					if(!empty($selected_job)){
						if(!checkPermission(3, $selected_job[0]["user_id"])){
							//echo __LINE__;
							echo("error");
							exit();
						}
						$previous_state = $selected_job[0]["accepted"];
						
						$query = "UPDATE submitted_work
								SET accepted='2', previous_state='$previous_state'
								WHERE id='".$_POST["main_id"]."'";
						$result = mysql_query($query);
						$numRows = mysql_affected_rows();
						if($numRows){
							echo("ok");
							exit();
						}else{
							echo("error");
							exit();
						}
					}else{
				//echo __LINE__;
						$out_data["status"] = "error";
						echo(json_encode($out_data));
						exit();
					}
				}
				$out_data["status"] = "empty";
				echo(json_encode($out_data));
				exit();
				break;
			case "changePairSpecialities":
				if((!empty($_POST["data"])) && (!empty($_POST["pair_id"]))){
					$query = "SELECT * FROM employee_language_pairs WHERE id=\"" . $_POST["pair_id"] . "\"";//get all language pairs of employee
					$rs= mysql_query($query);
					$employee_pear = getSqlRows($rs);//yes, pears
					if(!empty($employee_pear)){
						if($_SESSION["user"]["soc"] != "00"){
							echo(json_encode("error"));
							exit();
						}else if(!isset($_SESSION["user"]["admin"])){
							echo(json_encode("error"));
							exit();
						}else if(!checkPermission(3, $employee_pear[0]["employee_id"])){
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
				break;
			case "changePairSpecialityRate":
				if($_SESSION["user"]["soc"] != "00"){
					echo(json_encode("error"));
					exit();
				}else if(!isset($_SESSION["user"]["admin"])){
					echo(json_encode("error"));
					exit();
				}else if(!checkPermission(1, 0)){
					//echo __LINE__;
					echo(json_encode("error"));
					exit();
				}
				if((!empty($_POST["main_id"])) && (!empty($_POST["second_id"])) && (!empty($_POST["field"])) && (!empty($_POST["value"]))){
					$value = $_POST["value"];
					$value = str_replace(",", ".", $value);
					$field = htmlspecialchars($_POST["field"], ENT_QUOTES, "UTF-8", true);
					if((!empty($value)) && ((is_numeric($value)) || (is_float($value)))){
						$result = mysql_query("SHOW COLUMNS FROM `language_pair_specialities` LIKE '".$field."'");
						$check_field = getSqlRows($result);
						if(!empty($check_field)) {
							$result = mysql_query("SELECT * FROM `language_pair_specialities` WHERE  (pair_id='".$_POST["main_id"]."') AND (speciality_id='".$_POST["second_id"]."')");
							$check_row = getSqlRows($result);
							if(!empty($check_row)){					
								if($check_row[0][$field] == $_POST["value"]){
									echo(json_encode("ok"));
									exit();
								}
								$query = "UPDATE language_pair_specialities
										SET $field='$value'
										WHERE (pair_id='".$_POST["main_id"]."') AND (speciality_id='".$_POST["second_id"]."')";
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
					}else{
						//echo __LINE__;
						echo(json_encode("error"));
						exit();
					}
				}
				break;
			case "changeDateLearned":
				if((!empty($_POST["main_id"])) && (!empty($_POST["field"])) && (!empty($_POST["value"]))){
					$query = "SELECT * FROM employee_language_pairs WHERE id=\"" . $_POST["main_id"] . "\"";//get all language pairs of employee
					$rs= mysql_query($query);
					$some_result = getSqlRows($rs);
					if($_SESSION["user"]["soc"] != "00"){
						echo(json_encode("error"));
						exit();
					}else if(!isset($_SESSION["user"]["admin"])){
						echo(json_encode("error"));
						exit();
					}else if(!checkPermission(3, $some_result[0]["employee_id"])){
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
								if($check_field[0]["when_learned"] == $value){
									echo(json_encode("ok"));
									exit();
								}
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
				break;
			case "changePairRate":
				if($_SESSION["user"]["soc"] != "00"){
					echo(json_encode("error"));
					exit();
				}else if(!isset($_SESSION["user"]["admin"])){
					echo(json_encode("error"));
					exit();
				}else if(!checkPermission(1, 0)){
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
							if($check_field[0]["rate"] == $value){
								echo(json_encode("ok"));
								exit();
							}
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
				break;
			case "upload":
				if (!empty($_FILES)) {
					$file_size = 0;
					foreach ($_FILES as $key => $value) {
						$file_size += $value["size"];
					}
					if($file_size <= 31457280){
						$i = 0;
						foreach ($_FILES as $key => $value) {
							$paths[$i]["path"] = upload($value);
							$paths[$i]["name"] = $value["name"];
							$paths[$i]["size"] = $value["size"];
							$i++;
						}
					}else{
						echo "big";
					}
					echo(json_encode($paths));
					exit();
				}
				//var_dump($_POST);
				//var_dump($_FILES);
				//deleteOldFiles($_SERVER['DOCUMENT_ROOT'] . "/images/tmp");
				header("Content-Type: application/json; charset=utf-8");
				//var_dump($paths);
				echo(json_encode("no_files"));
				exit();
				break;
			case "removeEmployeePairs":
				if(!empty($_POST["data"])){
					if($_SESSION["user"]["soc"] != "00"){
						echo(json_encode("error"));
						exit();
					}else if(!isset($_SESSION["user"]["admin"])){
						echo(json_encode("error"));
						exit();
					}else if(!checkPermission(3, $_POST["data"][0])){
						echo(json_encode("error"));
						exit();
					}
					foreach ($_POST["data"] as $key => $value) {
						$query = "SELECT employee_id FROM employee_language_pairs WHERE id=\"" . $value . "\"";//get all language pairs of employee
						$rs= mysql_query($query);
						$some_result = getSqlRows($rs);
						if($_SESSION["user"]["soc"] != "00"){
							echo(json_encode("error"));
							exit();
						}else if(!isset($_SESSION["user"]["admin"])){
							echo(json_encode("error"));
							exit();
						}else if(checkPermission(2, $some_result[0]["employee_id"])){
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
				break;
			case "add_employee_pair":
				if(!empty($_POST["data"]) && !empty($_POST["employee_id"])){
					if($_SESSION["user"]["soc"] != "00"){
						echo(json_encode("error"));
						exit();
					}else if(!isset($_SESSION["user"]["admin"])){
						echo(json_encode("error"));
						exit();
					}else if(!checkPermission(3, $_POST["employee_id"])){
						echo(json_encode("error"));
						exit();
					}
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
				break;
			case "get_employee_pairs":
				if(!empty($_POST["employee_id"])){
					if($_SESSION["user"]["soc"] != "00"){
						echo(json_encode("error"));
						exit();
					}else if(!isset($_SESSION["user"]["admin"])){
						echo(json_encode("error"));
						exit();
					}else if(!checkPermission(3, $_POST["employee_id"])){
						echo(json_encode("error"));
						exit();
					}
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
				break;
			case "create_request":
				$form_data = json_decode($_POST["form_data"]);
				//var_dump($form_data);
					//out($form_data);

					$from_cou = 0;
					foreach($form_data->from_langs as $key=>$value){
						if(!empty($value)){
							$from_cou++;
						}
					}
					$to_cou = 0;
					foreach($form_data->to_langs as $key=>$value){
						if(!empty($value)){
							$to_cou++;
						}
					}
					$file_cou = 0;
					foreach($form_data->faili as $key=>$value){
						if(!empty($value)){
							$file_cou++;
						}
					}
					if((($from_cou > 0) && ($to_cou > 0)) && ($from_cou == $to_cou) && ($from_cou == $file_cou)){
						if(!empty($form_data->faili)){
							$complete_size = 0;
							foreach ($form_data->faili as $key=>$value){
								if(!empty($form_data->faili[$key])){
									foreach ($form_data->faili[$key] as $keyy=>$valuee){
										if(!empty($form_data->faili[$key][$keyy])){
											$complete_size += filesize($valuee);
											//var_dump($valuee);
										}
									}
								}
							}
							if($complete_size > 31457280){
								echo "big";
								exit();
							}
						}else{
							echo __LINE__;
							echo "empty";
							exit();
						}
						
						$time_string = "";
						$time_names = "";
						if(!empty($form_data->date)){
							$time_string = ", '" . $form_data->date . "'";
							$time_names = ", date_due";
							if(!empty($form_data->time)){
								$time_string .= ", '" . $form_data->time . "'";
								$time_names .= ", time_due";
								if(!empty($form_data->time_zone)){
									$time_string .= ", '" . $form_data->time_zone . "'";
									$time_names .= ", time_zone";
								}
							}
						}else{
							echo __LINE__;
							echo "empty";
							exit();
						}
						$comment_name = "";
						$comment = "";
						if(!empty($form_data->comment)){
							$comment_name = ", comment_text";
							$comment = ", '" . htmlspecialchars($form_data->comment, ENT_QUOTES, "UTF-8", true) . "'";
						}
						$query = "INSERT INTO submitted_work (user_id" . $time_names . $comment_name . ")
							VALUES ('".$_SESSION["user"]["id"]."'" . $time_string . $comment . ")";
						$submitted_work_info = mysql_query($query);
						$submitted_id = mysql_insert_id();
						//var_dump("from: $from_cou, to: $to_cou, files: $file_cou.");
						for($i = 0; $i < $from_cou; $i++){
							if((!empty($form_data->to_langs[$i])) && (!empty($form_data->from_langs[$i]))){
								$to_langs = getToLangs($form_data, $i);
								$from_langs = "";
								if(!empty($form_data->from_langs[$i])){
									$from_langs = $form_data->from_langs[$i];
								}
								if(empty($to_langs) && empty($from_langs)){
									continue;//if the user added a language pair but then deleted it, the array index might still be there
								}
								$to_langs = explode(",", $to_langs);
								foreach($to_langs as $key=>$value){
									if(!empty($form_data->faili[$i])){
										$query = "INSERT INTO submitted_pairs (work_id, lang_from, lang_to)
										VALUES ('" . $submitted_id . "', '" . $from_langs . "', '" . $value . "')";
										mysql_query($query);
										$langs_id = mysql_insert_id();
										prepareFilesForSubmit($form_data, $i, $langs_id, $submitted_id);
									}else{
										//echo __LINE__;
										echo "empty";
										exit();
									}
								}
							}
						}
					}else{
										//echo __LINE__;
						echo "empty";
						exit();
					}

					//var_dump($request_id);
					//var_dump($query);
					//var_dump($form_data);

					/*$query = "SELECT * FROM translation_requests WHERE id=\"" . $request_id . "\"";
				    $rs= mysql_query($query);
					$quote_data = getSqlRows($rs);
					//var_dump($quote_data);

					$query = "SELECT * FROM request_languages WHERE request_id=\"" . $request_id . "\"";
				    $rs= mysql_query($query);
					$quote_langs = getSqlRows($rs);

					$query = "SELECT * FROM request_files WHERE request_id=\"" . $request_id . "\"";
				    $rs= mysql_query($query);
					$quote_files = getSqlRows($rs);*/

					echo "ok";
					exit();
				break;
		}			
	}else{
		echo(json_encode("empty"));
		exit();
	}
	
	function prepareFilesForSubmit($form_data, $key, $langs_id, $work_id){//puts files to upload folder and creates sql entries with languages id if has one
		if(!empty($langs_id)){
			$langs_ids = " pair_id,";
			$langs_id = "', '" . $langs_id;
		}else{
										//echo __LINE__;
			echo(json_encode("empty"));
			exit();
		}
		if(!empty($form_data->faili[$key]) && isset($form_data->faili[$key])){
			foreach ($form_data->faili[$key] as $keyy=>$valuee){
				if(!empty($form_data->file_names[$key][$keyy])){
					$file_name = $form_data->file_names[$key][$keyy];
					$file_name_name = ", file_name";
				}else{
					$file_name = "";
					$file_name_name = "";
				}
				$path = $valuee;
				if($path != "big" && $path != "error" && $path != "format"){
					$res = moveUploaded($path, "submitted_jobs");
					//var_dump($res);
					if($res != false){
						$query = "INSERT INTO submitted_files (file_path," . $langs_ids . " work_id" . $file_name_name . ")
						VALUES ('" . $res . $langs_id . "', '" . $work_id . "', '" . $file_name . "')";
						$query_result = mysql_query($query);
						if(!$query_result){
										//echo __LINE__;
							echo(json_encode("empty"));
							exit();
						}
					}else{
						echo __LINE__;
						echo(json_encode("empty"));
						exit();
					}
				}else{
										//echo __LINE__;
					echo(json_encode("empty"));
					exit();
				}
			}
		}
	}
	
	function updateWorkWordCount($work_id){
		$query = "SELECT * FROM submitted_files WHERE work_id='".$work_id."'";
		$rs = mysql_query($query);
		$files = getSqlRows($rs);
		if(!empty($files)){
			$new_word_count = 0;
			foreach($files as $file_key=>$file_val){
				if(!empty($file_val["word_count"])){
					$new_word_count+=$file_val["word_count"];
				}
			}
			if(!empty($new_word_count)){
				$query = "UPDATE submitted_work
						SET word_count='$new_word_count'
						WHERE id='".$work_id."'";
				$result = mysql_query($query);
				$numRows = mysql_affected_rows();
			}
		}
	}
?>