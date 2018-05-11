<?php 
	$hom = "http://$_SERVER[HTTP_HOST]";
	if (empty($_SESSION["user"])){//redirect to home if not logged in
		header("Location: $hom");
	}
	$data["manager"] = array();

	get_user("S", array("id"=>$_SESSION["user"]["id"]), $curr_user);
	$original_link = str_replace("/", "", $data["cat"][0]["long_link"]);
	if(($curr_user[0]["admin"] == 1) || ($curr_user[0]["admin"] == 2)){
		if($curr_user[0]["admin"] == 2){
			if(empty($curr_user[0]["manager"])){
				header("Location: $hom");
			}
		}
		$data["routes"] = array(//array of manager page menu items
			"0" => array(
				"name" => "new_projects",
				"lg" => $data["lg"]["new_projects"],
				"url" => url($original_link, "0")
			),
			"1" => array(
				"name" => "work_not_accepted",
				"lg" => $data["lg"]["work_not_accepted"],
				"url" => url($original_link, "1")
			),
			"2" => array(
				"name" => "accepted_jobs",
				"lg" => $data["lg"]["accepted_jobs"],
				"url" => url($original_link, "2")
			),
			"3" => array(
				"name" => "paid_jobs",
				"lg" => $data["lg"]["paid_jobs"],
				"url" => url($original_link, "3")
			),
			"4" => array(
				"name" => "unpaid_jobs",
				"lg" => $data["lg"]["unpaid_jobs"],
				"url" => url($original_link, "4")
			),
			"5" => array(
				"name" => "translated",
				"lg" => $data["lg"]["translated"],
				"url" => url($original_link, "5"),
				"hidden" => true
			),
			"6" => array(
				"name" => "transfer_ready",
				"lg" => $data["lg"]["transfer_ready"],
				"url" => url($original_link, "6")
			),
			"7" => array(
				"name" => "clients",
				"lg" => $data["lg"]["clients"],
				"pending" => "0",
				"url" => url($original_link, "7")
			),
			"8" => array(
				"name" => "registration_requests",
				"lg" => $data["lg"]["registration_requests"],
				"pending" => "0",
				"url" => url($original_link, "8")
			),
			"9" => array(
				"name" => "translators",
				"lg" => $data["lg"]["translators"],
				"url" => url($original_link, "9") ,
				"hidden" => true
			),
			"10" => array(
				"name" => "project_manager",
				"lg" => $data["lg"]["project_manager"],
				"url" => url($original_link, "10") ,
				"hidden" => true
			),/*"http://$_SERVER[HTTP_HOST]" . $data['cat'][0]['long_link'] . "/6"*/
		);
		$data["routes"][8]["pending"] = resetRegistrationNotifications();
	}else{
		$data["routes"] = array(//array of manager page menu items
			"0" => array(
				"name" => "submit_work",
				"lg" => $data["lg"]["submit_work"],
				"url" => url($original_link, "0")
			),
			"1" => array(
				"name" => "submitted_projects",
				"lg" => $data["lg"]["submitted_projects"],
				"url" => url($original_link, "1")
			),
			"2" => array(
				"name" => "work_not_accepted",
				"lg" => $data["lg"]["work_not_accepted"],
				"url" => url($original_link, "2")
			),
			"3" => array(
				"name" => "accepted_jobs",
				"lg" => $data["lg"]["accepted_jobs"],
				"url" => url($original_link, "3")
			)
		);
	}
	$lin1 = get_arg(1);//last part of link
	$lin2 = get_arg(2);//2nd part from the end of link
	$lin3 = get_arg(3);//3rd part from the end of link
	$curr_arr = array_keys($data["routes"]);
	if($lin1 == $original_link){//if no route given, then we redirect to fyrstr route
		$page = $curr_arr[0];
	}else if((is_numeric($lin1)) && (!is_numeric($lin2))){
		$page = $lin1;
	}else if(((is_numeric($lin1))) && (is_numeric($lin2)) && (!is_numeric($lin3))){
		$page = $lin2;
	}else if(((is_numeric($lin1))) && (is_numeric($lin2)) && (is_numeric($lin3))){
		$page = $lin3;
	}

	$data["manager"]["route"] = $data["routes"][$page];
	$data["manager"]["route"]["file"] = "./logged_in/" . $data["routes"][$page]["name"] . ".html";
	$data["manager"]["curr_page"] = $page;

	/* ==================================================== */

	$data["manager"]["user"] = $curr_user[0];
	//out($data["manager"]);


	/* ==================================================== */

	if (!empty($data["manager"]["route"]["name"]) && ($data["manager"]["route"]["name"] != "profile")) {
		unset($_SESSION["profile_errors"]);
	}
    $endpg = url_last_part();//get last link piece

	if (!empty($data["manager"]["route"]["name"])){
		switch ($data["manager"]["route"]["name"]) {
			case "submit_work":
				/*meta("S", array("template"=>"language_pair", "parent_id"=>$data["cat"]["0"]["id"]), $data["language_pairs"]);
				$count = 0;
				foreach ($data["language_pairs"] as $key => $value) {
					foreach($data["lang_items"] as $keyy=>$valuee){
					}
					if($value["language_to_id"] == $data["cat"][0]["id"]){
						$data["pair_array"][$count] = $value;
						$count++;
					}
				}*/
				break;

			case "contact_manager": 
			case "contact_accounting": 
				break;

			case "new_projects":
				/*require_once '/Paginator.class.php';
				$limit      = ( (isset( $_GET['cat2'] )) && (!empty($_GET['cat2'])) ) ? ((!is_numeric($_GET['cat2'])) ? "all" : $_GET['cat2']) : 20;
				$page       = ( isset( $_GET['cat1'] ) ) ? ((is_numeric($_GET['cat1'])) ? $_GET['cat1'] : 1) : 1;
				$links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;*/
				//$Paginator  = new Paginator( "SELECT * FROM submitted_work WHERE accepted='0' ORDER BY created DESC" );		 
				//$data["manager"]["jobs"] = $Paginator->getData( $limit, $page );
				if(!is_numeric($lin1)){
 					header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."/0");
				}else if((is_numeric($lin1)) && (!is_numeric($lin2))){
					$query = "SELECT * FROM submitted_work WHERE accepted='0' ORDER BY created DESC";//get all specialities of employee language pair
					$rez= mysql_query($query);
					$jobs = getSqlRows($rez);
					if(!empty($jobs)){
						foreach($jobs as $key=>$value){
							if(!empty($value["user_id"])){
								$customer = array();
								get_user("S", array("admin"=>"0", "id"=>$value["user_id"]), $customer);
								if(!empty($customer)){
									$jobs[$key]["customer"] = $customer;
									$query = "SELECT * FROM submitted_pairs WHERE work_id = '" . $value["id"] . "'";
									$res = mysql_query($query);
									$pairs = getSqlRows($res);
		
									if(!empty($pairs)){
										$total_file_count = 0;
										foreach($pairs as $pair_key=>$pair_value){
											if(is_numeric($pair_value["lang_from"]) && is_numeric($pair_value["lang_to"])){
												/********************getting original language pair id**************************/
												meta("S", array("template"=>"language_pair", "parent_id"=>$pair_value["lang_from"]), $language_pairs_with_this_source);
												if(!empty($language_pairs_with_this_source)){
													foreach ($language_pairs_with_this_source as $keyy => $valuee) {
														if($valuee["language_to_id"] == $pair_value["lang_to"]){
															$pairs[$pair_key]["language_pair_original"] = $valuee;
															break;
														}
													}
												}
												/***************************************************************************************/
												
												/***********************getting language pair names*****************************/
												meta("S", array("template"=>"language", "id"=>$pair_value["lang_from"]), $language_from);
												if(!empty($language_from)){
													$pairs[$pair_key]["lang_from_name"] = $language_from[0]["name"];
												}
												meta("S", array("template"=>"language", "id"=>$pair_value["lang_to"]), $language_to);
												if(!empty($language_to)){
													$pairs[$pair_key]["lang_to_name"] = $language_to[0]["name"];
												}
												/**************************************************************************************/
												
												/***********************getting language pair files*****************************/
												$query = "SELECT * FROM submitted_files WHERE (pair_id = '" . $pair_value["id"] . "') AND (work_id = '" . $value["id"] . "')";
												$res = mysql_query($query);
												$pair_files = getSqlRows($res);
												if(!empty($pair_files)){
													foreach($pair_files as $file_key=>$file_value){
														$pair_files[$file_key]["file_path"] = getFileLink("images", $pair_files[$file_key]["file_path"]);
													}
													$pairs[$pair_key]["files"] = $pair_files;
													$pairs[$pair_key]["file_count"] = count($pair_files);
													$total_file_count += count($pair_files);
												}
												/******************************************************************************************/
												
												/****getting language pair speciality prices if such a pair even exists****/
												if(!empty($pairs[$pair_key]["language_pair_original"])){
													$query = "SELECT * FROM language_pair_prices WHERE pair_id='".$pairs[$pair_key]["language_pair_original"]["id"]."'";//get all specialities of employee language pair
													$rez= mysql_query($query);
													$specialities = getSqlRows($rez);
													if(!empty($specialities)){
														 meta("S", array("template"=>"expertise_item"), $all_specialities);//get all specialities
														 if(!empty($all_specialities)){
															 foreach($specialities as $spec_key=>$spec_val){
																 foreach($all_specialities as $all_spec_key=>$all_spec_val){
																	if($spec_val["speciality"] == "regular"){
																		$specialities[$spec_key]["name"] = $data["lg"]["regular"];
																	}else if($spec_val["speciality"] == $all_spec_val["id"]){
																		$specialities[$spec_key]["name"] = $all_spec_val["name"];
																	}
																 }
															 }
															 $pairs[$pair_key]["specialities"] = $specialities;
														 }
													}
												}
												/******************************************************************************************/
											}
										}
										$jobs[$key]["pairs"] = $pairs;
										$jobs[$key]["file_count"] = $total_file_count;
									}
								}else{
									one_back();
								}
							}
						}
						$data["manager"]["jobs"] = array();
						$data["manager"]["jobs"] = $jobs;
					}
				}else if(((is_numeric($lin1))) && (is_numeric($lin2)) && (!is_numeric($lin3))){
					$query = "SELECT * FROM submitted_work WHERE (accepted='0') AND (id='$lin1') ORDER BY created DESC";//get all specialities of employee language pair
					$rez= mysql_query($query);
					$jobs = getSqlRows($rez);
					if(!empty($jobs)){
						$data["manager"]["jobs"] = array();
						$data["manager"]["jobs"] = $jobs;
					}
					get_user("S", array("active"=>"1", "admin"=>"0", "id"=>$jobs[0]["user_id"]), $customer);
					if(!empty($customer)){
						$data["manager"]["jobs"]["customer"] = $customer;
					}else{
						one_back();
					}
				}else if(((is_numeric($lin1))) && (is_numeric($lin2)) && (is_numeric($lin3))){
					if($lin2 == 0){
						get_user("S", array("active"=>"1", "admin"=>"0", "id"=>$lin1), $employee);
						if(!empty($employee)){
							
						}else{
							one_back();
						}						
					}else if($lin2 == 1){
						$data["manager"]["translators"] = "NEW";
						$data["manager"]["curr_page"] = 1;
					}
				}
				
				break;

			case "profile": 

				break;

			case "estates": 

				break;

			case "registration_requests":
				get_user("S", array("active"=>"0", "admin"=>"0"), $pending_users);
				if(!empty($pending_users)){
					foreach ($pending_users as $key => $value) {
						if(empty($value["denied"]) || $value["denied"] == 0){
							$data["manager"]["pending_users"][] = $value;
						}
					}
				}
				break;

			case "clients":
				get_user("S", array("active"=>"1", "admin"=>"0"), $new_clients);
				foreach ($new_clients as $key => $value) {
					if(isset($value["client"])){
						if($value["client"] == 1){
							$data["manager"]["clients"][] = $value;
						}
					}
				}
				break;

			case "translators":
				if((is_numeric($lin1)) && (!is_numeric($lin2))){
 					header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."/0");
				}else if(((is_numeric($lin1))) && (is_numeric($lin2)) && (!is_numeric($lin3))){
					if($lin1 == 0){
						$data["manager"]["translators"] = get_translators_editors();
						$data["manager"]["curr_page"] = 0;
					}else if($lin1 == 1){
						$data["manager"]["translators"] = "NEW";
						$data["manager"]["curr_page"] = 1;
					}
				}else if(((is_numeric($lin1))) && (is_numeric($lin2)) && (is_numeric($lin3))){
					if($lin2 == 0){
						get_user("S", array("active"=>"1", "admin"=>"0", "id"=>$lin1), $employee);
						if(!empty($employee)){
							if((!empty($employee[0]["translator"])) || (!empty($employee[0]["editor"])) || (!empty($employee[0]["project_manager"]))){

								$data["manager"]["employee"] = $employee[0];//get employee data
								$query = "SELECT * FROM employee_language_pairs WHERE employee_id=\"" . $data["manager"]["employee"]["id"] . "\"";//get all language pairs of employee
							    $rs= mysql_query($query);
							    $employee_pears = getSqlRows($rs);//yes, pears


							    meta("S", array("template"=>"expertise_item"), $data["manager"]["expertise_items"]);//get all specialities
							    foreach ($employee_pears as $key => $value) {
							    	$query = "SELECT * FROM language_pair_specialities WHERE pair_id=\"" . $value["id"] . "\"";//get all specialities of employee language pair
								    $rez= mysql_query($query);
								    $specialities = getSqlRows($rez);//yes, pears
								    if(!empty($specialities)){
								    	$employee_pears[$key]["specialities"] = array();
								    	$employee_pears[$key]["specialities"] = $specialities;
								    }
							    }

								meta("S", array("template"=>"language_pair"), $data["manager"]["language_pairs"]);//get all language pairs
								if(!empty($employee_pears) && !empty($data["manager"]["language_pairs"])){
									foreach ($employee_pears as $key => $value) {
										foreach ($data["manager"]["language_pairs"] as $keyy => $valuee) {
											if($valuee["id"] == $value["pair_id"]){
												unset($data["manager"]["language_pairs"][$keyy]);//remove language pairs from complete list if the employee possesses them
												$valuee["when_learned"] = $value["when_learned"];
												$valuee["rate"] = $value["rate"];
												$valuee["currency"] = $value["currency"];
												$valuee["employee_pair_id"] = $value["id"];
												if(!empty($value["specialities"])){
													$valuee["pair_specialities"] = $value["specialities"];
												}
												$data["manager"]["employee"]["language_pairs"][] = $valuee;//add language pair to employee laguage pair array which he possesses
												break;
											}
										}
									}
								}
								$data["manager"]["translators"] = "PROFILE";
								$data["manager"]["curr_page"] = 2;
							}else{
								one_back();//if we should not reach this user through this page then we are set back one page
							}
							$data["currencies"] = getCurrencies($settings["vacancy_form_currencies"]);
						}else{
							one_back();
						}						
					}else if($lin2 == 1){
						$data["manager"]["translators"] = "NEW";
						$data["manager"]["curr_page"] = 1;
					}
				}
				break;

			case "exit": 

				header("Location: /logout.php");

				exit();

				break;
			
			default:
				# code...
				break;
		}
	}
	/* ==================================================== */

	/*function upload($file) {
		global $id, $database, $database_prefix;

		if (empty($file["tmp_name"])) {
			$file["tmp_name"] = $file["name"];
		}

		$ext = end(explode(".", $file["name"]));

		$hash = sha1(uniqid());
		$path = $_SERVER['DOCUMENT_ROOT'] . "/images/users/$hash.$ext";

		if ($file["size"] > 4000000) {
			$_SESSION["profile_errors"]["image"] = true;
			return;
		}

		$database->update($database_prefix . "users", array(
			"image" => $hash . ".$ext"
		), array(
			"id" => $_SESSION["user"]["id"]
		));
		//stop

		move_uploaded_file($file["tmp_name"], $path);
	}*/

	function refresh() {
		header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		exit();
	}

	function is_action($try) {
		if (! isset($_POST)) {
			return false;
		}

		return isset($_POST["action"]) ?
			$_POST["action"] == $try : false;
	}

	function get_user_id() {
		return $_SESSION["user"]["id"];
	}

	function get_est_id() {
		return get_arg(3);
	}

	function get_apt_id() {
		return get_arg(2);
	}
	function get_page() {
		return get_arg(1);//get id for the notices page 
	}
	function get_arg($i) {
		if(!empty($_GET["variables"])){
			$expl = explode("/", $_GET["variables"]);//gets all user information
			//out($expl);
			//out(sizeof($expl));
			if((!empty($expl[sizeof($expl) - $i])) || (isset($expl[sizeof($expl) - $i]))){
				return $expl[sizeof($expl) - $i];//takes needed info from user infromation
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function one_back(){
		$new_link = explode("/", "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		array_pop ( $new_link );
		$new_link = implode("/", $new_link);
		header("Location: $new_link");
	}
	function get_translators_editors(){
		get_user("S", array("active"=>"1", "admin"=>"0"), $translators);
		$translators_arr = array();
		foreach ($translators as $key => $value) {
			if(isset($value["translator"])){
				if($value["translator"] == "1"){
					$translators_arr[] = $value;
				}else if(isset($value["editor"])){
					if($value["editor"] == "1"){
						$translators_arr[] = $value;
					}
				}
			}else if(isset($value["editor"])){
				if($value["editor"] == "1"){
					$translators_arr[] = $value;
				}
			}
		}
		return $translators_arr;
	}
	function url($original_link, $pag_substr) {//gets url for the menu items
		$url = rtrim("http://$_SERVER[HTTP_HOST]/$original_link", "/");

		$pieces = explode("/", $url);

		if($pieces[sizeof($pieces) - 1] == $original_link){
			array_push($pieces, $pag_substr);
		}else{
			for($i = 0; $i < sizeof($pieces); $i++){
				if(is_numeric($pieces[sizeof($pieces) - i])){
					unset($pieces[sizeof($pieces) - i]);
				}
			}
			array_push($pieces, $pag_substr);
		}

		return implode("/", $pieces);
	}
	function url_last_part(){//get last part of url and add "/"
	global $data;
		$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		$link_array = explode('/',$link);
		$url_end = end($link_array);
		$url_end = "/$url_end";
		return $url_end;
	}

?>