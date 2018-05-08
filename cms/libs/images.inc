<?php
function images($cAction, $aParams, &$aResult)
{
	$aResult = Array();
	global $lang;
	global $languages;
	global $gg;
	$langX = !empty($lang) ? $lang : $languages[0]["iso"];
	$lang_id = langid_from_iso($langX);
	
	switch($cAction) {
		case "S":
			$where = " 1 = 1 ";
			$orderby = "ordered ASC";
			$limit = " ";
			if(!empty($aParams["lang"]))		{ $langX = $aParams["lang"]; $lang_id = langid_from_iso($langX); }
			
			if(!empty($aParams["id"]))		$where .= "AND id = '".$aParams["id"]."' ";
			if(!empty($aParams["meta_id"]))		$where .= "AND meta_id = '".$aParams["meta_id"]."' ";
			
			if(!empty($aParams["where"]))		$where .= "AND ".$aParams["where"]." ";
			if(!empty($aParams["orderby"]))		$orderby = $aParams["orderby"];
			if(!empty($aParams["limit"]))		$limit .= "LIMIT ".$aParams["limit"]." ";
			
			$query = "SELECT ".
								"* ".
							"FROM ".PREFIX."meta_images ".
							"LEFT JOIN ".PREFIX."meta_images_data ON img_id = id AND lang_id = '$lang_id' ".
							"WHERE ".$where." ".
							"ORDER BY $orderby ".
							$limit;
//echo ++$gg."<br />";
if(!empty($aParams["alert"]))
	out( "<br /><br />".$query."<br /><br />");
//print_r($aParams);
			$rRes = mysql_query($query) or die(mysql_error().$query);
			
			if(mysql_num_rows($rRes) > 0)
			{
				while($row = mysql_fetch_assoc($rRes))
				{
					if (empty($row["id"])) break;
					$aResult[] = $row;
				}
//print_r($aResult);
				return true;			
			}
		break;
	}
	return false;
}
?>
