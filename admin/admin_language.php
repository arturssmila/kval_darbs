<?php
//echo "GO GOG GO";
$admin_lang = !empty($user[0]["admin_language"]) ? $user[0]["admin_language"] : $languages[0]["iso"];
$admin_lang_id = langid_from_iso($admin_lang);
$admin_lang_id = !empty($admin_lang_id) ? $admin_lang_id : $languages[0]["id"];

$query = "SELECT al.*, ald.value, ald_def.value as def_value ".
		"FROM ".PREFIX."adm_lang AS al ".
		"LEFT JOIN ".PREFIX."adm_lang_data AS ald ON id = ald.val_id AND ald.lang_id = '$admin_lang_id' ".
		"LEFT JOIN ".PREFIX."adm_lang_data AS ald_def ON id = ald_def.val_id AND ald_def.lang_id = '".$languages[0]["id"]."' ";

$rRes = mysql_query($query) or die(mysql_error().$query);
if(mysql_num_rows($rRes) > 0)
{
	while($row = mysql_fetch_assoc($rRes))
	{
		if (empty($row["id"])) break;
		$adm_lang[$row["name"]] = array("value" => $row["value"],"def_value" => $row["def_value"],);
	}
}

function al($name)
{
	global $adm_lang;
	
	return !empty($adm_lang[$name]["value"]) ? $adm_lang[$name]["value"] : (!empty($adm_lang[$name]["def_value"]) ? $adm_lang[$name]["def_value"] : $name);
}

?>
