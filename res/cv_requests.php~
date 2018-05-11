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
				$secret = $settings["recaptcha_secret_key"];
 
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
							if($file_size <= ($settings["max_cv_upload_mb"]*1048576)){
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
			case "create_request":
				$form_data = json_decode($_POST["form_data"]);
				if(!empty($form_data->first_name) && !empty($form_data->last_name) && !empty($form_data->email) && !empty($form_data->faili[0]) && !empty($form_data->position_id) && !empty($form_data->position_name) && (!empty($form_data->editor) || isset($form_data->editor))){
					$questions_count = sizeof($form_data->questions);//how many questions received

					$query = "SELECT id FROM meta WHERE parent_id='". mysql_real_escape_string($form_data->position_id)."'";
					$request_info = mysql_query($query);
					if(!$request_info){
						echo json_encode("error");
						exit();
					}
					$quote_data = getSqlRows($request_info);
					$questions_needed = sizeof($quote_data);//how many questions needed

					foreach ($form_data->questions as $key => $value) {
						if(empty($value[0]) || empty($value[1]) || empty($value[2])){
							echo __LINE__;
							echo json_encode("empty");
							exit();
						}
						if(!is_numeric($value[0])){
							echo __LINE__;
							echo json_encode("empty");
							exit();
						}
						if(strlen($value[2]) < $settings["vacancy_min_characters"] || strlen($value[2]) > $settings["vacancy_max_characters"]){
							out(strlen($value[2]));
							echo json_encode("wrong_count");
							exit();
						}
						$form_data->questions[$key][2] = mysql_real_escape_string(htmlspecialchars($form_data->questions[$key][2], ENT_QUOTES, "UTF-8", true));
					}

					if (!filter_var($form_data->email, FILTER_VALIDATE_EMAIL)) {
						echo __LINE__;
						echo json_encode("empty");
						exit();
					}
					
					if($questions_count == $questions_needed){
						$from_langs_count = sizeof($form_data->from_langs);
						$to_langs_count = sizeof($form_data->to_langs);

						if($form_data->editor == false){//check if  language pairs are filled
							if($from_langs_count == $to_langs_count){
								for($i = 0; $i < $to_langs_count; $i++){
									if(empty($form_data->from_langs[$i]) || empty($form_data->to_langs[$i])){
										echo $form_data->from_langs[$i];
										echo $form_data->to_langs[$i];
										echo __LINE__;
										echo json_encode("empty");
										exit();
									}
									if(!empty($form_data->money[$i]) && empty($form_data->currency[$i])){
										echo __LINE__;
										echo json_encode("empty");
										exit();
									}
								}
							}else{
								echo __LINE__;
								echo json_encode("empty");
								exit();
							}
						}else{//check if language to is filled
							if($from_langs_count <= $to_langs_count){
								for($i = 0; $i < $to_langs_count; $i++){
									if(empty($form_data->to_langs)){
										echo __LINE__;
										echo json_encode("empty");
										exit();
									}
								}
							}else{
								echo __LINE__;
								echo json_encode("empty");
								exit();
							}
						}

						if(!empty($form_data->faili[0][0])){
							$new_cv_path = moveUploaded($form_data->faili[0][0], "cv_uploads");
						}else{
							echo __LINE__;
							echo json_encode("empty");
							exit();
						}

						$form_data->first_name = htmlspecialchars($form_data->first_name, ENT_QUOTES, "UTF-8", true);
						$form_data->last_name = htmlspecialchars($form_data->last_name, ENT_QUOTES, "UTF-8", true);

						$query = "INSERT INTO vacancy_requests (first_name, last_name, email, cv_file_path, vacancy_name_id, recorded_vacancy_name)
							VALUES ('" . mysql_real_escape_string($form_data->first_name) . "', '" . mysql_real_escape_string($form_data->last_name) . "', '" . mysql_real_escape_string($form_data->email) . "', '" . mysql_real_escape_string($form_data->faili[0][0]) . "', '" . mysql_real_escape_string($form_data->position_id) . "', '" . mysql_real_escape_string($form_data->position_name) . "')";
						//out($query);
						$request_info = mysql_query($query);
						if(!$request_info){
							echo json_encode("error");
							exit();
						}
						$vacancy_id = mysql_insert_id();

						foreach ($form_data->questions as $key => $value) {

							$value[1] = htmlspecialchars($value[1], ENT_QUOTES, "UTF-8", true);
							$value[2] = htmlspecialchars($value[2], ENT_QUOTES, "UTF-8", true);
							$query = "INSERT INTO vacancy_questions (vacancy_id, question_id, recorded_question_text, question_answer)
							VALUES ('" . $vacancy_id . "', '" . mysql_real_escape_string($value[0]) . "', '" . mysql_real_escape_string($value[1]) . "', '" . mysql_real_escape_string($value[2]) . "')";
						//out($query);
							$request_info = mysql_query($query);
							if(!$request_info){
								echo json_encode("error");
								exit();
							}

						}

						for ($i=0; $i < $to_langs_count; $i++) { 
							$form_data->money[$i] = str_replace(',', '.', $form_data->money[$i]);
							if(!empty($form_data->money[$i]) && (is_numeric($form_data->money[$i]) || is_float($form_data->money[$i]))){
								$money_amount = ", '" . mysql_real_escape_string($form_data->money[$i]) . "'";
								$rate = ", rate";
								$currency = ", '" . mysql_real_escape_string($form_data->currency[$i]) . "'";
								$currency_name = ", currency";
							}else{
								$money_amount = "";
								$rate = "";
								$currency = "";
								$currency_name = "";
							}
							if($form_data->editor == true){
								if(empty($form_data->from_langs[$i])){
									$language_from = "";
									$language_from_value = "";
								}else{
									$language_from = ", language_from";
									$language_from_value = ", '" . mysql_real_escape_string($form_data->from_langs[$i]) . "'";
								}
							}else{
								$language_from = ", language_from";
								$language_from_value = ", '" . mysql_real_escape_string($form_data->from_langs[$i]) . "'";
							}
							$query = "INSERT INTO vacancy_languages (vacancy_id" . $language_from . ", language_to" . $rate . $currency_name . ")
							VALUES ('" . $vacancy_id . "'" . $language_from_value . ", '" . mysql_real_escape_string($form_data->to_langs[$i]) . "'" . $money_amount . $currency . ")";
							//out($query);
							$request_info = mysql_query($query);
							if(!$request_info){
								echo json_encode("error");
								exit();
							}
						}
						echo json_encode("ok");
						exit();
					}else{
						echo __LINE__;
						echo json_encode("empty");
						exit();
					}
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


	function upload($file) {
		global $settings;
		if (empty($file["tmp_name"])) {
			$file["tmp_name"] = $file["name"];
		}

		$tmp_expl = explode(".", $file["name"]);
		$ext = end($tmp_expl);

		$formats = explode(",", $settings["accepted_formats"]);
		$formats = implode("", $formats);
		$formats = explode(" ", $formats);

		if (!in_array(strtolower($ext), $formats)) {
			//header('HTTP/1.0 400 Bad Request', true, 400);
			return "format";
			//exit();
		}
			//var_dump($formats);

		//echo $ext;

		//out($file["tmp_name"]);
		$name = str_replace(" ", "", $file["name"]);
		$rand = uniqid(rand(10000,99999), true);
		//var_dump($rand);
		$id1 = md5($rand);

		$file_size = filesize ( $file["tmp_name"] );
		if(!($file_size > 31457280)){
			/*out($_SERVER['DOCUMENT_ROOT']);*/
			//out(file_exists( dirname( dirname(__FILE__) ) ));
			if( file_exists( dirname( dirname(__FILE__) ) ) ){
				$path = dirname(dirname(__FILE__)) . "/images/tmp/" . $id1 . "." . $ext/* . "__$name"*/;
				$path = str_replace('\\', '/', $path);
				move_uploaded_file($file["tmp_name"], $path);
			}else{
				$path = "error";
			}

			return $path;
		}else{
			return "big";
		}
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
?>