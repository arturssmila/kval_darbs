<?php
function meta($cAction, $aParams, &$aResult)
{
	$aResult = Array();
	global $lang;
	global $languages;
	$langX = !empty($lang) ? $lang : $languages[0]["iso"];
	$lang_id = langid_from_iso($langX);
	
	/************* LAUCIŅI *****************/
	get_fields($fields, $field_names, $fields_ids);
	/*****************************/
	
	switch($cAction) {
		case "S":
			$where = " WHERE 1 = 1 ";
			$orderby = "ordered, id ASC";
			$groupby = " ";
			$limit = " ";
			$stats = '';
			if(!empty($aParams["lang"]))		{ $langX = $aParams["lang"]; $lang_id = langid_from_iso($langX); }
			
			$is_work_table = false;
			$query = "SHOW TABLES LIKE '".PREFIX."work_table_".$lang_id."'";
			$res = mysql_query($query);
			if(mysql_num_rows($res) > 0)
			{
				$is_work_table = true;
			}
			
			if($is_work_table)
			{
				if(!empty($aParams["url"]))	$where .= "AND url		= '".$aParams["url"]."' ";
			}
			else
			{
				if(isset($aParams["url"]))		$where  = "	JOIN ".PREFIX."meta_data ON id = meta_id 
											WHERE `field_id` = '".$fields_ids["url"]."' AND language_id = '$lang_id' AND field_content = '".$aParams["url"]."' ";
			}
			if(!empty($aParams["id"]))		$where .= "AND `id`		= '".$aParams["id"]."' ";
			if(!empty($aParams["alias_id"]))	$where .= "AND `alias_id`	= '".$aParams["alias_id"]."' ";
			if(!empty($aParams["creator_id"]))	$where .= "AND `creator_id`	= '".$aParams["creator_id"]."' ";
			if(isset($aParams["hide_link"]))	$where .= "AND `hide_link`	= '".$aParams["hide_link"]."' ";
			
			if(empty($aParams["deny_page"]) && 
				empty($aParams["id"]))		$where .= "AND (`deny_page` = '' OR `deny_page` = '0' OR `deny_page` IS NULL) ";
			
			if(isset($aParams["parent_id"]))	$where .= "AND (`parent_id`	= '".$aParams["parent_id"]."') ";
			else					$where .= "AND `parent_id`	<> '-2' ";
						
			if(!empty($aParams["template"]))	$where .= "AND ( `template` = '".$aParams["template"]."' ) ";
			if(!empty($aParams["stats"]))
			{
				$stats  = "(SELECT COUNT(meta_id) FROM `".PREFIX."stats` WHERE `".PREFIX."stats`.`meta_id` = `".
						PREFIX.($is_work_table ? ("work_table_".$lang_id) : "meta")."`.`id`) AS stats, ".
						($is_work_table ? (PREFIX."work_table_".$lang_id.".") : '');
				           
			}
			
			if(!empty($aParams["where"]))		$where .= "AND ".$aParams["where"]." ";
			if(!empty($aParams["groupby"]))		$groupby = " GROUP BY ".$aParams["groupby"]." ";
			if(!empty($aParams["orderby"]))		$orderby = $aParams["orderby"];
			if(!empty($aParams["limit"]))		$limit .= "LIMIT ".$aParams["limit"]." ";
			if(!empty($aParams["date"]))		$where .= "AND DATE_ADD(date, INTERVAL ".$aParams["date"].") > NOW() ";
			
			if($is_work_table)
			{
				$query = "SELECT ".
									$stats.
									"* ". 
								"FROM `".PREFIX."work_table_".$lang_id."` ".
								$where." ".
								$groupby." ".
								"ORDER BY $orderby ".
								$limit;
			}
			else
			{
				$query = "SELECT ".
									$stats.
									"`id`, ".
									"`alias_id`, ".
									"`parent_id`, ".
									"`priority`, ".
									"`ordered`, ".
									"`opened`, ".
									"`template_id`, ".
									"`template`, ".
									"`hide_link`, ".
									"`image_thumb`, ".
									"`image_small`, ".
									"`image`, ".
									"`image_big`, ".
									"`image_big_size`, ".
									"`image_size`, ".
									"`image_small_size`, ".
									"`image_thumb_size`, ".
									"`creator_id`, ".
									"`date` ". 
								"FROM `".PREFIX."meta` ".
								"LEFT JOIN `".PREFIX."templates` ON `template_id` = `t_id` ".
								$where." ".
								$groupby." ".
								"ORDER BY $orderby ".
								$limit;
			}
			
if(!empty($aParams["alert"])) 
	echo "<br /><br />".$query."<br /><br />";
			
			$rRes = mysql_query($query);
			
			if(mysql_num_rows($rRes) > 0)
			{
				while($row = mysql_fetch_assoc($rRes))
				{
					if (empty($row["id"])) break;
					if(empty($is_work_table))
					{
						/*************** LAUCIŅU DATI *******************/
						$query = "SELECT * FROM ".PREFIX."meta_data
								WHERE meta_id = '".$row["id"]."' AND (language_id = '$lang_id' OR language_id = '0') ORDER BY language_id DESC, field_id ASC;";
						if(!empty($aParams["alert"]))
							echo "<br /><br />".$query."<br /><br />";
						$res = mysql_query($query);
						if(mysql_num_rows($res) > 0)
						{
							while($row2 = mysql_fetch_assoc($res))
							{
								if (empty($row2["meta_id"])) break;
								if(!empty($field_names[$row2["field_id"]]))
								{
									$row[$field_names[$row2["field_id"]]] = $row2["field_content"];
									if($field_names[$row2["field_id"]]=="url")
									{
										$row["link"] = empty($row["hide_link"]) ? ('/'.$row2["field_content"]) : '';
										if(empty($aParams["no_link"]))
										{
											$row["long_link"] = get_long_link($row2["field_content"],$langX);
										}
									}
								}
							}
						}
					}
					if(empty($aParams["no_link"]) && !empty($row["url"]))
					{
						$row["long_link"] = get_long_link($row["url"],$langX);
					}
					/*************** BILDES *******************/
					images("S", array("meta_id"=>$row["id"]), $row["images"]);
					/***************************************/

					$aResult[] = $row;
				}
				return true;			
			}
		break;
	}
	return false;
}
?>
