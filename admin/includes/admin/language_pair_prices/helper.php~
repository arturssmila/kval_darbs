<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/database.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/meta.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/functions.inc");
	
	meta("S", array("template"=>"language"), $lang_items);
	meta("S", array("template"=>"language_pair"), $language_pairs);
	$results = "";
	$fields = "";
	$template_id[0]["id"] = 21;
	template("S", array("template"=>"language_pair"), $template_id);
	get_fields($fields, $field_names, $fields_ids, $template_id[0]["id"]);
 
	if (!empty($lang_items)) {	
		$lang_count = count($lang_items);
	}
	if(!empty($_POST)){
		if(!empty($_POST["action"])){
			if($_POST["action"] == "checked"){
				$creator_id = $_POST["creator"];
				foreach($_POST as $key => $item){
					if($key != "action" && $key != "creator"){
						$not_exist = true;
						meta("S", array("template"=>"language_pair", "parent_id"=>$item[0]), $current_pair);
						foreach($current_pair as $keyy => $i){//check if the pair already exists
							if($i["language_to_id"] == $item[1]){
								$not_exist = false;
								break;
							}
						}
						meta("S", array("template"=>"language_pair", "parent_id"=>$item[0], "deny_page"=>"1"), $current_pair);
						foreach($current_pair as $keyy => $i){//check if the pair already exists and is a denied page
							if($i["language_to_id"] == $item[1]){
								$not_exist = false;
								$curr_id = $i["id"];
								$query = " UPDATE ".PREFIX."meta SET 
									deny_page = '0'
									WHERE
									id = '$curr_id'
								";
								//out($query);
								mysql_query($query);//if it is a denied page then it is unblocked
								set_meta_row($curr_id);//updates work table
								break;
							}
						}

						if($not_exist == true){
							
							$parent_id = $item[0];
							$templ_id = $template_id[0]["id"];
							$query = " INSERT INTO ".PREFIX."meta SET 
									parent_id = '$parent_id',
									template_id = '$templ_id',
									creator_id = '$creator_id'
								";
							mysql_query($query);
							$id = mysql_insert_id();	
							
							//atjaunojam work_table
							set_meta_row($id);
							$from_id = $item[0];
							$to_id = $item[1];
							foreach($languages as $l_key => $lang_item){
								$from_name = "";
								$to_name = "";
								$lang_id = $lang_item["id"];
								$query = " SELECT field_content FROM ".PREFIX."meta_data WHERE meta_id = '$from_id' AND field_id = '-8' AND language_id = '$lang_id'
								";
								$rs = mysql_query($query);
							    if(mysql_num_rows($rs) > 0){
								    while($row = mysql_fetch_assoc($rs))
									{
										$from_name = $row["field_content"];
									}
								}
								$query = " SELECT field_content FROM ".PREFIX."meta_data WHERE meta_id = '$to_id' AND	field_id = '-8' AND language_id = '$lang_id'
								";
								$rs = mysql_query($query);
							    if(mysql_num_rows($rs) > 0){
								    while($row = mysql_fetch_assoc($rs))
									{
										$to_name = $row["field_content"];
									}
								}
								$meta_data[$lang_id]["-8"] = $from_name . " - " . $to_name;
								$meta_data[$lang_id]["-7"] = "";
								$meta_data[$lang_id]["-6"] = "";
							}
							$meta_data[0][$fields_ids["language_to_id"]] = $item[1];
							$meta_data["id"] = $id;
							$meta_data["templ"] = $template_id[0]["id"];
							echo (json_encode($meta_data));
							exit();
						}else{
							echo (json_encode("ok"));
							exit();
						}
					}
				}
				//reload();
			}
			if($_POST["action"] == "unchecked"){//if pair exists but is unchecked
				//header("Content-Type: application/json; charset=utf-8");
				foreach($_POST as $key => $item){
					if($key != "action" && $key != "creator"){
						$current_pair = "";
						meta("S", array("template"=>"language_pair", "parent_id"=>$item[0]), $current_pair);
						foreach($current_pair as $keyy => $i){
							if($i["language_to_id"] == $item[1]){
								if($i["deny_page"] == 0){
									$curr_id = $i["id"];
									$query = " UPDATE ".PREFIX."meta SET 
										deny_page = '1'
										WHERE
										id = '$curr_id'
									";
									mysql_query($query);
									set_meta_row($curr_id);//updates work table
								}
								echo (json_encode("ok"));
								exit();
							}
						}
						echo (json_encode("ok"));
						exit();
					}
				}
			}
		}
	}
?>