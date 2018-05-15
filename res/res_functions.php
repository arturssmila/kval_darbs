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
				if($_SESSION["user"]["admin"] == 1){
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
				if(($_SESSION["user"]["admin"] == 0) && ($_SESSION["user"]["project_manager"] == 1)){
					return true;
				}else{
					return false;
				}
				break;
			
			case 3:
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

	function prepareFiles($form_data, $key, $langs_id, $request_id){//puts files to upload folder and creates sql entries with languages id if has one
		if(!empty($langs_id)){
			$langs_ids = " languages_id,";
			$langs_id = "', '" . $langs_id;
		}else{
			$langs_ids = "";
			$langs_id = "";
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
					$res = moveUploaded($path, "uploads");
					//var_dump($res);
					if($res != false){
						$query = "INSERT INTO request_files (file_path," . $langs_ids . " request_id" . $file_name_name . ")
						VALUES ('" . $res . $langs_id . "', '" . $request_id . "', '" . $file_name . "')";
						mysql_query($query);
					}
				}
			}
		}
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
				$path = dirname(dirname(__FILE__)) . "/images/tmp/" . $id1 . "." . $ext;/* . "__$name"*/
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
	
	function moveUploaded($path, $target){
		$new_path = str_replace("/tmp/", "/".$target."/", $path);
		$code = copy($path, $new_path);
		if(!$code){
			out($code);
		}
		return $new_path;
	}
	
	function getFileLink($looking_for,$file_path){//looking_for is the name of the directory from which starts the usable file_path
		$exploded = explode("/", $file_path);
		foreach ($exploded as $keyyy => $valueee) {
			if($valueee != $looking_for){
				unset($exploded[$keyyy]);
			}else{
				break;
			}
		}
		$imploded = array_values($exploded);
		$label = implode("/", $imploded);
		$label = 'http://'.$_SERVER['HTTP_HOST'] . "/" . $label;
		return $label;
	}
	
	
?>