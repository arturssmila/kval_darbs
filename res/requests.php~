<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/res_functions.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/libs/phpmailer/class.phpmailer.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/database.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/langbar.inc");//needed to get language file with translations
	require_once "recaptchalib.php";

	$data = array();

	lang("S", array(), $data["lg"]);

	header("Content-Type: application/json; charset=utf-8");

	if (!empty($_POST)) {
		if (!isset($_POST["action"])) {
			header('HTTP/1.0 400 Bad Request', true, 400);
			exit();
		}

		switch ($_POST["action"]){
			case "upload":
				$paths = array();
				$secret = $settings["recaptcha_secret_key"];//"6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe"<= testing key | normal key => "6LdPXUwUAAAAAPbO3Y4diUkhyqvBBYQPqhTebF0f";
 
				// empty response
				$response = null;
				 
				// check secret key
				$reCaptcha = new ReCaptcha($secret);
				if(!empty($_POST["captcha"])) {
    				$response = $reCaptcha->verifyResponse(
        				$_SERVER["REMOTE_ADDR"],
        				$_POST["captcha"]
    				);
    				if($response->success == true){
						if (!empty($_FILES)) {
							//out($_FILES);
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
    				}else{
    					out($response->errorCodes);
    					echo "captcha";
    				}
    			}else{
    				echo "big";
    				exit();
    			}
			break;			
			case "tmp_file_remove":
				foreach ($_POST as $key => $value) {
					if ((strpos($value, 'uploads') === false) && ($key !== "action")) {
						//echo($value);
						unlink($value);
					}
				}
				echo "ok";
				exit();
			break;
			case "create_request":
				$form_data = json_decode($_POST["form_data"]);
				//var_dump($form_data);
				if(!empty($form_data->first_name) && !empty($form_data->last_name) && !empty($form_data->email)){
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

					//require("libs/phpmailer/class.phpmailer.php");
					$tmpl = dirname(dirname(__FILE__))."/templates/email_templates";
					$body = include("$tmpl/quote_submitted.php");
					$mail1 = new phpmailer();

					$mail1->Sender = $settings["email"];
					$mail1->From = $quote_data["email"];
					$mail1->FromName = html_entity_decode($data["lg"]["new_quote"]);
					$mail1->Subject = html_entity_decode($data["lg"]["new_quote"]);

					$mail1->Body = $body;
					$mail1->AltBody = "";
					$mail1->AddAddress($settings["form_mail"], "");
					$mail1->IsHTML(true);

					if(!$mail1->Send()) {
						//exit(json_encode(array("error" => true, "type" => 9)));
					}
					$mail1->ClearAddresses();
					$mail1->ClearAttachments();
					echo json_encode("ok");
					exit();
				}else{
					echo json_encode("empty");
					exit();
				}
			break;
			default:
		       echo "error";
		       exit();
	    }

	} else {
		header('HTTP/1.0 400 Bad Request', true, 400);
		exit();
	}


	

	function moveUploaded($path, $target){
		$new_path = str_replace("/tmp/", "/".$target."/", $path);
		$code = copy($path, $new_path);
		if(!$code){
			out($code);
		}
		return $new_path;
	}

	function deleteOldFiles($path){
		if ($handle = opendir($path)) {
		    while (false !== ($file = readdir($handle))) {
		    	if($file !== (".htaccess") && $file !== (".") && $file !== ("..")){
			    	$diff = time()-filemtime($path . "/" . $file);
			    	$hours = $diff / 3600;
			    	if($hours >= 72){
			    		unlink($path . "/" . $file);
			    	}
		    	}
		    }
		    closedir($handle);
		}
	}


	function prepareLangs($form_data, $request_id, $direction){//puts languages in database and uses database entry ids to upload files




	}


	function prepareTo($form_data, $request_id){//if from languages empty
		$index = null;
		foreach ($form_data->to_langs as $key=>$value){
			if(!empty($form_data->faili[$key])){
				$to_langs = getToLangs($form_data, $key);
				if($to_langs == ""){
					$langs_id = "";
					prepareFiles($form_data, $key, $langs_id, $request_id);
				}else{
					$query = "INSERT INTO request_languages (lang_to, request_id)
			VALUES ('" . $to_langs . "', '" . $request_id . "')";
					mysql_query($query);
					$index = $key;
					$langs_id = mysql_insert_id();
					if(!empty($form_data->faili[$key]) && isset($form_data->faili[$key])){
						prepareFiles($form_data, $key, $langs_id, $request_id);
					}
				}
			}else{
				if(!empty($form_data->to_langs[$key])){
					$to_langs = getToLangs($form_data, $key);
					$query = "INSERT INTO request_languages (lang_from, request_id)
			VALUES ('" . $to_langs . "', '" . $request_id . "')";
					mysql_query($query);
					$index = $key;
				}
			}
		}
		return $index;
	}

	function getToLangs($form_data, $key){
		$to_langs = "";
		if(count($form_data->to_langs[$key]) > 1){
			foreach ($form_data->to_langs[$key] as $keyy=>$valuee){
				if($keyy > 0){
					$to_langs .= "," . $valuee;
				}else{
					$to_langs .= $valuee;
				}
			}
			return $to_langs;
		}else{
			if(!empty($form_data->to_langs[$key][0])){
				$to_langs = $form_data->to_langs[$key][0];
				return $to_langs;
			}else{
				return "";
			}
		}
	}


	//below work in progress functions

	function getFromToLangs($greater, $lesser){//šajā piemērā to langs ir greater
		foreach ($greater as $key=>$value){
			if((!empty($form_data->to_langs[$key])) && (!empty($form_data->from_langs[$key]))){
				$to_langs = getToLangs($form_data, $key);
				$from_langs = "";
				if(!empty($form_data->from_langs[$key])){
					$from_langs = $form_data->from_langs[$key];
				}
				fromLangsFiles("INSERT INTO request_languages (lang_from, lang_to, request_id)
		VALUES ('" . $from_langs . "', '" . $to_langs . "', '" . $request_id . "')", $form_data, $key, $request_id);
			}else if(!empty($form_data->to_langs[$key])){
				$to_langs = getToLangs($form_data, $key);
				fromLangsFiles("INSERT INTO request_languages (lang_to, request_id)
		VALUES ('" . $to_langs . "', '" . $request_id . "')", $form_data, $key, $request_id);
			}else if(!empty($lesser[$key])){
				fromLangsFiles("INSERT INTO request_languages (lang_from, request_id)
		VALUES ('" . $value . "', '" . $request_id . "')", $form_data, $key, $request_id);
			}else if(!empty($form_data->faili[$key])){
				$langs_id = "";
				prepareFiles($form_data, $key, $langs_id, $request_id);
			}
		}
	}

	function fromLangsFiles($query, $form_data, $key, $request_id){
		mysql_query($query);
		$langs_id = mysql_insert_id();
		if(!empty($form_data->faili[$key])){
			prepareFiles($form_data, $key, $langs_id, $request_id);
		}
	}

?>