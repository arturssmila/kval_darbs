<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/res_functions.php");

	meta("S", array("template"=>"language_group"), $data["lang_gr"]);
	$data["lang_gr_count"] = count($data["lang_gr"]);
	meta("S", array("template"=>"languages"), $data["langs_all"]);
	meta("S", array("template"=>"language"), $data["lang_items"]);
	meta("S", array("template"=>"service_list"), $data["serv_list"]);
	meta("S", array("template"=>"service"), $data["services"]);
	meta("S", array("template"=>"blog_post"), $data["blogs"]);
	meta("S", array("template"=>"blog_cat"), $data["blog_cat"]);
	meta("S", array("template"=>"location"), $data["location"]);
	meta("S", array("template"=>"testimonials"), $data["testimonials_page"]);
	meta("S", array("template"=>"testimonial"), $data["testimonials"]);
	meta("S", array("template"=>"expertise_item"), $data["expertise_items"]);
	meta("S", array("template"=>"vacancies", "alias_id"=>"vacancies"), $data["vacancy_holder"]);
	meta("S", array("template"=>"vacancy"), $data["vacancies"]);
	meta("S", array("template"=>"vacancy_question"), $data["vacancy_questions"]);
	$data["lang_count"] = 0;
	foreach ($languages as $key => $value) {
		if(!empty($value["active"])){
			$data["lang_count"] += 1;
		}
	}

	if ( !empty($_SESSION["user"])) {

		if (empty($_SESSION["redirected_to_manager"])) {
			$_SESSION["redirected_to_manager"] = true;
			meta("S", array("template" => "logged_in"), $data["profile"]);

			header("Location: http://$_SERVER[HTTP_HOST]{$slang}{$data["profile"][0]["long_link"]}");
		}else{
			meta("S", array("template" => "logged_in"), $data["profile"]);
		}

		meta("S", array("template" => "logged_in"), $data["profile"]);
		
	} else {
		meta("S", array("template"=>"register"), $data["registration"]);
		meta("S", array("template"=>"forgot_password"), $data["forgot_password"]);
		unset($_SESSION["redirected_to_manager"]);
	}
	
	/***Code to get location from ip*/
	/*
	$ip = $_SERVER['REMOTE_ADDR'];
	$details = json_decode(@file_get_contents("http".(!empty($_SERVER["HTTPS"]) ? 's' : '')."://ipinfo.io/$ip"));
	//out($details);
	if(empty($details))
	{
		$details = json_decode(@file_get_contents("http".(!empty($_SERVER["HTTPS"]) ? 's' : '')."://freegeoip.net/json/$ip"));
	}
	
	//$details->city = "Moscow";
	//$details->region = "Moscow";
	//$details->country = "ru";
	//$details->loc = "55.7005663,37.618636";
	//out($details);
	
	
	
	$data["geo_data"] = '';
	$my_country = '';
	$_SESSION["i_am_in_europe"] = '';
	$my_lat = 0;
	$my_lon = 0;
	if(!empty($details))
	{
		$data["geo_data"] = implode(", ",(array)$details);
		$my_country = strtolower(!empty($details->country) ? $details->country : (!empty($details->country_code) ? $details->country_code : ''));	
		if(!empty($details->loc))
		{
			$my_coordinates = explode(",",$details->loc);
			$my_lat = reset($my_coordinates);
			$my_lon = end($my_coordinates);
		}
		else
		{
			$my_lat = !empty($details->latitude) ? $details->latitude : 0;
			$my_lon = !empty($details->longitude) ? $details->longitude : 0;
		}
		//out(array($my_lat,$my_lon));
	}*/
	/***/

	switch ($data["cat"][0]["template"])
	{
		case "home":	
			meta("S", array("template"=>"sponsor"), $data["sponsors"]);
			break;
		case "blog":	
			include("blog_post.php");
			break;
		case "blog_cat":	
			include("blog_post.php");
			break;
		case "":	
			break;
		case "service":	
			$data["currencies"] = getCurrencies($settings["vacancy_form_currencies"]);
			meta("S", array("template"=>"services_cat"), $data["services_cats"]);
			getExpertises();
			break;
		case "service_list":	
			$data["currencies"] = getCurrencies($settings["vacancy_form_currencies"]);
			meta("S", array("template"=>"services_cat"), $data["services_cats"]);
			getExpertises();
		case "expertise_item":	
			$data["currencies"] = getCurrencies($settings["vacancy_form_currencies"]);
			meta("S", array("template"=>"services_cat"), $data["services_cats"]);
			getExpertises();
			break;
		case "specialist":	
			meta("S", array("template"=>"services_cat"), $data["services_cats"]);
			getExpertises();
			//meta("S",array("id"=>$data["cat"][0]["parent_id"]),$parent_page);
			//header("Location: $slang".(!empty($parent_page[0]["long_link"]) ? $parent_page[0]["long_link"] : '/'));
			//exit();
			break;
		case "vacancies":	
			$data["currencies"] = getCurrencies($settings["vacancy_form_currencies"]);
			break;
		case "register":	
			$query = "SELECT * FROM countries ORDER BY name ASC";
			$request_info = mysql_query($query);
			if(!$request_info){
				exit();
			}
			$data["country_list"] = getSqlRows($request_info);
			break;
		case "forgot_password":	
			break;
		case "language":	
			getExpertises();
			meta("S", array("template"=>"language_pair"), $data["language_pairs"]);
			meta("S", array("template"=>"language_pair", "parent_id"=>$data["cat"]["0"]["id"]), $data["language_pairs_this"]);
			meta("S", array("template"=>"language_block", "parent_id"=>$data["cat"]["0"]["id"]), $data["language_blocks"]);
			$count = 0;
			foreach ($data["language_pairs"] as $key => $value) {
				if($value["language_to_id"] == $data["cat"][0]["id"]){
					$data["pair_array"][$count] = $value;
					$count++;
				}
			}
			break;
	}

	function getExpertises(){
		global $data;
		$data["cat"][0]["expertise_item"] = explode("#",$data["cat"][0]["expertise_item"]);
		$data["cat"][0]["expertise_item"] = "(`id` = '".implode("' OR `id` = '",$data["cat"][0]["expertise_item"])."')";
     	meta("S",array("where"=>$data["cat"][0]["expertise_item"]),$data["available_expertise"]);
	}

	

	
?>