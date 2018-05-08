<?php
function backup($backup_data)
{
	global $user;
	if(!empty($backup_data) && array_filter($backup_data))
	{
		$meta_id = !empty($backup_data[0]["id"]) ? $backup_data[0]["id"] : 0;
		$backup_data = base64_encode(serialize($backup_data));
		mysql_query("
			INSERT INTO `".PREFIX."backup` SET
				`user_id` = '".$user[0]["id"]."',
				`meta_id` = '$meta_id',
				`data` = '".$backup_data."' 
			");
	}
}
?>
