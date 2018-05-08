<?php
function lang($cAction, $aParams, &$aResult)
{
	global $lang;
	global $languages;
	$langX = !empty($lang) ? $lang : $languages[0]["iso"];
	$lang_id = langid_from_iso($langX);
	switch($cAction) {
		case "S":
			$limit = " ";
			
			if(!empty($aParams["lang"]))		{ $langX = $aParams["lang"]; $lang_id = langid_from_iso($langX); }
			
			if(!empty($aParams["limit"]))		$limit .= "LIMIT ".$aParams["limit"]." ";
			
			$query = "SELECT * FROM ".PREFIX."lang
					JOIN ".PREFIX."lang_data ON id = val_id
					
					WHERE lang_id = '$lang_id' ".
					"ORDER BY id ASC ".
					$limit;
//echo "<br />".$query;
			$rRes = mysql_query($query) or die(mysql_error().$query);
			
			if(mysql_num_rows($rRes) > 0)
			{
				while($row = mysql_fetch_assoc($rRes))
				{
					if (empty($row["id"])) break;
					$aResult[$row["name"]] = $row["value"];
				}
				return true;			
			}
		break;
	}
	return false;
}
?>
