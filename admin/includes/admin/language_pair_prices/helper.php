<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/database.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/meta.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/functions.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/res_functions.php");
	
	meta("S", array("template"=>"language"), $lang_items);
	meta("S", array("template"=>"language_pair"), $language_pairs);

 
	if (!empty($lang_items)) {	
		$lang_count = count($lang_items);
	}
	if(!empty($_POST)){
		if(!empty($_POST["action"])){
			if($_POST["action"] == "changePairRate"){
				if((!empty($_POST["main_id"])) && (!empty($_POST["second_id"])) && (!empty($_POST["field"])) && (!empty($_POST["value"]))){
					$value = $_POST["value"];
					$value = str_replace(",", ".", $value);
					$field = htmlspecialchars($_POST["field"], ENT_QUOTES, "UTF-8", true);
					if((!empty($value)) && ((is_numeric($value)) || (is_float($value)))){
						$result = mysql_query("SHOW COLUMNS FROM `language_pair_prices` LIKE '".$field."'");
						$check_field = getSqlRows($result);
						if(!empty($check_field)) {
							$result = mysql_query("SELECT * FROM `language_pair_prices` WHERE  (pair_id='".$_POST["main_id"]."') AND (speciality='".$_POST["second_id"]."')");
							$check_row = getSqlRows($result);
							if(!empty($check_row)){
								$query = "UPDATE language_pair_prices
										SET $field=$value
										WHERE (id=".$_POST["main_id"].") AND (speciality=".$_POST["second_id"].")";
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
								$query = "INSERT INTO language_pair_prices (pair_id, speciality, $field) VALUES ('".$_POST["main_id"]."','".$_POST["second_id"]."','".$value."')";
								$result = mysql_query($query);
								if($result){
									echo(json_encode("ok"));
									exit();
								}else{
							//echo __LINE__;
									echo(json_encode("error"));
									exit();
								}
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
			}
		}
	}
?>