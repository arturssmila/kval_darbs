<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/res_functions.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/database.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/functions.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/set_user.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/users.inc");
	if(!empty($_POST["action"])){
		switch($_POST["action"]){
			case "changePairSpecialities":
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
				break;
			case "changeDateLearned":
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
				break;
			case "changePairRate":
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
				break;
			case "add_employee_pair":
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
				break;
			case "get_employee_pairs":
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
				break;
			case "create_request":
				$form_data = json_decode($_POST["form_data"]);
				//var_dump($form_data);
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
							echo json_encode("big");
							exit();
						}
					}
					if (!filter_var($form_data->email, FILTER_VALIDATE_EMAIL)) {
						echo json_encode("empty");
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
					}
					$phone = "";
					$phone_names = "";
					if(!empty($form_data->phone)){
						if(!empty($form_data->phone_country_code)){
							$phone = ", '" . $form_data->phone_country_code . " " . $form_data->phone . "'";
						}else{
							$phone = ", '" . $form_data->phone . "'";
						}
						$phone_names = ", phone";
					}
					$comment_name = "";
					$comment = "";
					if(!empty($form_data->comment)){
						$comment_name = ", comment_text";
						$comment = ", '" . htmlspecialchars($form_data->comment, ENT_QUOTES, "UTF-8", true) . "'";
					}
					$query = "INSERT INTO translation_requests (first_name, last_name, email" . $time_names . $phone_names . $comment_name . ")
						VALUES ('" . htmlspecialchars($form_data->first_name, ENT_QUOTES, "UTF-8", true) . "', '" . htmlspecialchars($form_data->last_name, ENT_QUOTES, "UTF-8", true) . "', '" . $form_data->email . "'" . $time_string . $phone . $comment . ")";
					$request_info = mysql_query($query);
					$request_id = mysql_insert_id();

					$from_cou = count($form_data->from_langs);
					$to_cou = count($form_data->to_langs);
					$file_cou = count($form_data->faili);

					if(!empty($form_data->from_langs)){
						if(($from_cou >= $to_cou) && ($from_cou >= $file_cou)){//from languages leading    from:2 to:0/1/2 files: 0/1/2
							foreach ($form_data->from_langs as $key=>$value){
								if(!empty($form_data->faili[$key]) && !empty($form_data->to_langs[$key])){
									$to_langs = getToLangs($form_data, $key);
									if(!empty($form_data->from_langs[$key])){
										$query = "INSERT INTO request_languages (lang_from, lang_to, request_id)
							VALUES ('" . $value . "', '" . $to_langs . "', '" . $request_id . "')";
									}else{
										$query = "INSERT INTO request_languages (lang_to, request_id)
							VALUES ('" . $to_langs . "', '" . $request_id . "')";
									}
									mysql_query($query);
									$index = $key;
									$langs_id = mysql_insert_id();
									if(!empty($form_data->faili[$key]) && isset($form_data->faili[$key])){
										prepareFiles($form_data, $key, $langs_id, $request_id);
									}
								}else if(!empty($form_data->faili[$key])){
									$langs_id = "";
									$to_langs = getToLangs($form_data, $key);
									if(!empty($form_data->from_langs[$key])){
										$query = "INSERT INTO request_languages (lang_from, lang_to, request_id)
							VALUES ('" . $value . "', '" . $to_langs . "', '" . $request_id . "')";
										mysql_query($query);
										$index = $key;
										$langs_id = mysql_insert_id();
									}
									prepareFiles($form_data, $key, $langs_id, $request_id);
								}else if(!empty($form_data->to_langs[$key])){
									if(!empty($form_data->from_langs[$key])){
									$to_langs = getToLangs($form_data, $key);
										$query = "INSERT INTO request_languages (lang_from, lang_to, request_id)
							VALUES ('" . $value . "', '" . $to_langs . "', '" . $request_id . "')";
										mysql_query($query);
										$index = $key;
										$langs_id = mysql_insert_id();
									}else{
										$to_langs = getToLangs($form_data, $key);
										$query = "INSERT INTO request_languages (lang_to, request_id)
								VALUES ('" . $to_langs . "', '" . $request_id . "')";
										mysql_query($query);
										$index = $key;
									}
								}
							}
							//echo "first!";
						}else if(($from_cou < $to_cou) && ($from_cou >= $file_cou)){//to languages leading    from:0/1 to:2 files: 0/1/2
							foreach ($form_data->to_langs as $key=>$value){
								if((!empty($form_data->to_langs[$key])) && (!empty($form_data->from_langs[$key]))){
									$to_langs = getToLangs($form_data, $key);
									$from_langs = "";
									if(!empty($form_data->from_langs[$key])){
										$from_langs = $form_data->from_langs[$key];
									}
									$query = "INSERT INTO request_languages (lang_from, lang_to, request_id)
							VALUES ('" . $from_langs . "', '" . $to_langs . "', '" . $request_id . "')";
									mysql_query($query);
									$langs_id = mysql_insert_id();
									if(!empty($form_data->faili[$key])){
										prepareFiles($form_data, $key, $langs_id, $request_id);
									}
								}else if(!empty($form_data->to_langs[$key])){
									$to_langs = getToLangs($form_data, $key);
									$query = "INSERT INTO request_languages (lang_to, request_id)
							VALUES ('" . $to_langs . "', '" . $request_id . "')";
									mysql_query($query);
									$langs_id = mysql_insert_id();
									if(!empty($form_data->faili[$key])){
										prepareFiles($form_data, $key, $langs_id, $request_id);
									}
								}else if(!empty($form_data->from_langs[$key])){
									$query = "INSERT INTO request_languages (lang_from, request_id)
							VALUES ('" . $value . "', '" . $request_id . "')";
									mysql_query($query);
									$langs_id = mysql_insert_id();
									if(!empty($form_data->faili[$key])){
										prepareFiles($form_data, $key, $langs_id, $request_id);
									}
								}else if(!empty($form_data->faili[$key])){
									$langs_id = "";
									prepareFiles($form_data, $key, $langs_id, $request_id);
								}
							}
							//echo "second!";
						}else if(($from_cou >= $to_cou) && ($from_cou < $file_cou)){//vajag from pa priekšu un tad vēl failus atsevišķi no indeksa     from:2 to:0/1/2 files: 3/4/...
							$index = 0;
							foreach ($form_data->from_langs as $key=>$value){
								if((!empty($form_data->to_langs[$key])) && (!empty($form_data->from_langs[$key]))){
									$to_langs = getToLangs($form_data, $key);
									$query = "INSERT INTO request_languages (lang_from, lang_to, request_id)
							VALUES ('" . $value . "', '" . $to_langs . "', '" . $request_id . "')";
									mysql_query($query);
									$index = $key;
									$langs_id = mysql_insert_id();
									if(!empty($form_data->faili[$key])){
										prepareFiles($form_data, $key, $langs_id, $request_id);
									}
								}else if(!empty($form_data->to_langs[$key])){
									$to_langs = getToLangs($form_data, $key);
									$query = "INSERT INTO request_languages (lang_to, request_id)
							VALUES ('" . $to_langs . "', '" . $request_id . "')";
									mysql_query($query);
									$index = $key;
									$langs_id = mysql_insert_id();
									if(!empty($form_data->faili[$key])){
										prepareFiles($form_data, $key, $langs_id, $request_id);
									}
								}else if(!empty($form_data->from_langs[$key])){
									$query = "INSERT INTO request_languages (lang_from, request_id)
							VALUES ('" . $value . "', '" . $request_id . "')";
									mysql_query($query);
									$index = $key;
									$langs_id = mysql_insert_id();
									if(!empty($form_data->faili[$key])){
										prepareFiles($form_data, $key, $langs_id, $request_id);
									}
								}else if(!empty($form_data->faili[$key])){
									$langs_id = "";
									prepareFiles($form_data, $key, $langs_id, $request_id);
									$index = $key;
								}
							}
							$langs_id = "";
							$index++;
							if($file_cou > $from_cou){
								for( $index; $index < (count($form_data->faili)); $index++ ){
									prepareFiles($form_data, $index, $langs_id, $request_id);
								}
							}
							//echo "third!";
						}else if(($from_cou < $to_cou) && ($from_cou < $file_cou)){//vajag to pa priekšu un tad vēl failus atsevišķi no indeksa    from:0/1 to:2 files: 3/4/... vai from:0/1 to:3 files:2
							$index = 0;
							foreach ($form_data->to_langs as $key=>$value){
								if((!empty($form_data->to_langs[$key])) && (!empty($form_data->from_langs[$key]))){
									$to_langs = getToLangs($form_data, $key);
									$query = "INSERT INTO request_languages (lang_from, lang_to, request_id)
							VALUES ('" . $form_data->from_langs[$key] . "', '" . $to_langs . "', '" . $request_id . "')";
									mysql_query($query);
									$index = $key;
									$langs_id = mysql_insert_id();
									if(!empty($form_data->faili[$key])){
										prepareFiles($form_data, $key, $langs_id, $request_id);
									}
								}else if(!empty($form_data->to_langs[$key])){
									$to_langs = getToLangs($form_data, $key);
									$query = "INSERT INTO request_languages (lang_to, request_id)
							VALUES ('" . $to_langs . "', '" . $request_id . "')";
									mysql_query($query);
									$index = $key;
									$langs_id = mysql_insert_id();
									if(!empty($form_data->faili[$key])){
										prepareFiles($form_data, $key, $langs_id, $request_id);
									}
								}else if(!empty($form_data->from_langs[$key])){
									$query = "INSERT INTO request_languages (lang_from, request_id)
							VALUES ('" . $value . "', '" . $request_id . "')";
									mysql_query($query);
									$index = $key;
									$langs_id = mysql_insert_id();
									if(!empty($form_data->faili[$key])){
										prepareFiles($form_data, $key, $langs_id, $request_id);
									}
								}else if(!empty($form_data->faili[$key])){
									$langs_id = "";
									prepareFiles($form_data, $key, $langs_id, $request_id);
									$index = $key;
								}
							}
							$langs_id = "";
							$index++;
							//var_dump($index);
							if($file_cou > $to_cou){
								for( $index; $index < (count($form_data->faili)); $index++ ){
									prepareFiles($form_data, $index, $langs_id, $request_id);
								}	
							}
							//echo "fourth!";						
						}
					}else if(!empty($form_data->to_langs)){//if to langs not empty
						deleteOldFiles($_SERVER['DOCUMENT_ROOT'] . "/images/tmp");
						if($to_cou >= $file_cou){
							$index = prepareTo($form_data, $request_id);
						}else if($to_cou < $file_cou){
							$index = prepareTo($form_data, $request_id);
							$langs_id = "";
							for( $index; $index < (count($form_data->faili)); $index++ ){
								prepareFiles($form_data, $index, $langs_id, $request_id);
							}
						}
					}else if(!empty($form_data->faili)){
						deleteOldFiles($_SERVER['DOCUMENT_ROOT'] . "/images/tmp");
						foreach ($form_data->faili as $key=>$value){
							$langs_id = "";
							prepareFiles($form_data, $key, $langs_id, $request_id);
						}
					}

					//var_dump($request_id);
					//var_dump($query);
					//var_dump($form_data);

					$query = "SELECT * FROM translation_requests WHERE id=\"" . $request_id . "\"";
				    $rs= mysql_query($query);
					$quote_data = getSqlRows($rs);
					//var_dump($quote_data);

					$query = "SELECT * FROM request_languages WHERE request_id=\"" . $request_id . "\"";
				    $rs= mysql_query($query);
					$quote_langs = getSqlRows($rs);

					$query = "SELECT * FROM request_files WHERE request_id=\"" . $request_id . "\"";
				    $rs= mysql_query($query);
					$quote_files = getSqlRows($rs);

					echo json_encode("ok");
					exit();
				break;
		}			
	}else{
		echo(json_encode("empty"));
		exit();
	}
?>