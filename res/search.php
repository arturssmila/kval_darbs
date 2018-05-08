<?php
if( parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) === $_SERVER['HTTP_HOST'] )
{
	require_once('../config.php');
	header('Content-Type: application/json');
	
	$action = !empty($_POST["action"]) ? $_POST["action"] : die();
	$search_value = !empty($_POST["search_value"]) ? $_POST["search_value"] : '';
	$lang = !empty($_POST["lang"]) ? $_POST["lang"] : $languages[0]["iso"];
	$lang_id = langid_from_iso($lang);
	

	if(($action=='stats') && !empty($search_value))
	{//collect statistics
		$url = !empty($_POST["url"]) ? $_POST["url"] : '';
		mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."search_stats` (
				`id` INT NOT NULL AUTO_INCREMENT ,
				`search_value` VARCHAR(255) NULL DEFAULT NULL ,
				`url` VARCHAR(255) NULL DEFAULT NULL ,
				`date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
				PRIMARY KEY (`id`)
				) ENGINE = InnoDB DEFAULT CHARSET=utf8;");
		mysql_query("ALTER TABLE `".PREFIX."search_stats` ADD `ip` varchar(50) NULL DEFAULT NULL AFTER `url`;");
		mysql_query("INSERT INTO ".PREFIX."search_stats 
				SET
					`search_value` = '".mysql_real_escape_string($search_value)."',
					`url` = '$url' ,
					`ip` = '".$_SERVER['REMOTE_ADDR']."' 
			");
		echo json_encode($url);
	}
	if(($action=='search') && !empty($search_value))
	{
		$is_work_table = false;
		$query = "SHOW TABLES LIKE '".PREFIX."work_table_".$lang_id."'";
		$res = mysql_query($query);
		if(mysql_num_rows($res) > 0)
		{
			$is_work_table = true;
			
			$search_fields = !empty($settings["search_fields"]) ? $settings["search_fields"] : '';
			$search_fields = explode(' ',$search_fields);
			$search_fields = implode(',',$search_fields);
			$search_fields = explode('#',$search_fields);
			$search_fields = implode(',',$search_fields);
			$search_fields = explode(';',$search_fields);
			$search_fields = implode(',',$search_fields);
			$search_fields = explode(',',$search_fields);
			$search_fields = implode("` LIKE '%".mysql_real_escape_string($search_value)."%' OR `",$search_fields);
			
			$search_templates = !empty($settings["search_templates"]) ? $settings["search_templates"] : '';
			$search_templates = explode(' ',$search_templates);
			$search_templates = implode(',',$search_templates);
			$search_templates = explode('#',$search_templates);
			$search_templates = implode(',',$search_templates);
			$search_templates = explode(';',$search_templates);
			$search_templates = implode(',',$search_templates);
			$search_templates = explode(',',$search_templates);
			$search_templates = implode("' OR template = '",$search_templates);
			
			if(!empty($search_fields) && !empty($search_templates))
			{
				$echo = ''; 
				$query = "
					SELECT * FROM ".PREFIX."work_table_".$lang_id."
					WHERE
						(`$search_fields` LIKE '%".mysql_real_escape_string($search_value)."%')
						AND
						(template = '$search_templates')
						AND
						parent_id > -1
					";
				//var_dump($query);
				$res = mysql_query($query);
				if(mysql_num_rows($res) > 0)
				{
					/*$echo .= '<div class="search_results_box">';*/
					$count = 0;
					while($row = mysql_fetch_assoc($res))
					{
						$row["name"] = strip_tags($row["name"]);
						/*$row["name"] = preg_replace("/$search_value/i", "<strong>\$0</strong>", $row["name"]);*/
						$echo[$count]["name"] = $row["name"];
						$echo[$count]["lang"] = $lang;
						$echo[$count]["url"] = $row["url"];
						$count++;
					}
					echo json_encode($echo);
					/*$echo .= '</div>';*/
				}else{
					echo json_encode("empty");
				}
			}
		}
				
	}
}
	/*require_once($_SERVER['DOCUMENT_ROOT'] . "/res/database.inc");

	header("Content-Type: application/json; charset=utf-8");

	$table = "work_table_";

	$lang = 1;

	if (isset($_GET["lang"])) {
		if (is_numeric($_GET["lang"])) {
			$lang = $_GET["lang"];
		} else {
			$lang = $database->get($database_prefix . "languages", "id", array("iso" => $_GET["lang"]));
		}
	}

	$fields = array(
		"id", "alias_id", "name", "parent_id", "template", "date", "name", "teaser", "content", "meta_title", "meta_keywords", "meta_description", "url"
	);

	echo json_encode($database->select($database_prefix . $table . $lang, $fields));*/
?>