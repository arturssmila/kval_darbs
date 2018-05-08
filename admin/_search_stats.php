<?php
if(!empty($_POST["notify"]))
{
	exit();
}

//phpinfo();
//out(error_get_last());

if(!empty($_POST))
{
	require('../../../config.php');
	//passwordcheck
	include("../../../cms/libs/passwordcheck.inc");
	if (!$admin) 
	{
		//header("Location: /admin/login.php");
		echo '
			<script type="text/javascript">
				location.reload(true);
			</script>
		';
		exit();
	}
	
	$admin_lang = $user[0]["admin_language"];
	$lang_id = langid_from_iso($admin_lang);
	
	$mode = !empty($_POST["mode"]) ? $_POST["mode"] : '';
		
	exit();
}
/**********************************************************************************************************************************************/
	$lang = $user[0]["admin_language"];
	
	$all_searches = array();	
	$query = "SHOW TABLES LIKE '".PREFIX."search_stats'";
	$res = mysql_query($query);
	if(mysql_num_rows($res) > 0)
	{
		$query = "			
				SELECT
					*				
				FROM `".PREFIX."search_stats`			
				ORDER BY
					id DESC
			";	
		$res = mysql_query($query);				
		if(mysql_num_rows($res) > 0)
		{
			while($row = mysql_fetch_assoc($res))
			{
				$all_searches[] = $row;
			}
		}
		//out($all_searches);
	}
	
?>
<style>
	
</style>
<table class="none">
	<tr>
		<th colspan="3" align="left">
			<?php echo al("search_stats"); ?>
		</th>
		
	</tr>		
</table>
<table id="search_stats_table" class="lang_table none">
		<tr>
			<th><?php echo al("ID"); ?></th>
			<th><?php echo al("search_value"); ?></th>
			<th><?php echo al("url"); ?></th>
			<th><?php echo al("ip"); ?></th>
			<th><?php echo al("date"); ?></th>
		</tr>
<?php

	foreach($all_searches as $key => $val)
	{
		//out($val);
		?>
		<tr>
			<td><?php echo $val["id"]; ?></td>
			<td><?php echo $val["search_value"]; ?></td>
			<td><a href="<?php echo $val["url"]; ?>" target="_blank"><?php echo $val["url"]; ?></a></td>
			<td><?php echo (!empty($val["ip"]) ? $val["ip"] : ''); ?></td>
			<td><?php echo $val["date"]; ?></td>
		</tr>
		<?php
	}
?>
</table>
<script type="text/javascript">
	var lang = '<?php echo $languages[0]["iso"]; ?>';//just for send_template_data function
</script>
