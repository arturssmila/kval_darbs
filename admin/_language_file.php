<?php 
if(!empty($_POST))
{
	require('../config.php');
	//passwordcheck
	include("../cms/libs/passwordcheck.inc");
	if (!$admin) 
	{
		header("Location: /admin/login.php");
		exit();
	}
	
	$mode = "language_file";
	$order = !empty($_GET["order"]) ? $_GET["order"] : '';
	
	$name = !empty($_POST["name"]) ? $_POST["name"] : '';
	$save = !empty($_POST["save"]) ? $_POST["save"] : '';
	
	if($save)
	{
		$old = array('"');
		$new = array('&quot;');
		foreach($name as $name_key => $name_val)
		{
			foreach($languages as $key => $val)
			{
				$field[$val["id"]] = mysql_real_escape_string(str_replace($old, $new, $name_val[$val["id"]]));
			}
			if ($name_key < 0)
			{//jauns
				if(mysql_real_escape_string($name_val["name"]))
				{
					mysql_query("INSERT INTO `".PREFIX."lang` SET `name` = '".mysql_real_escape_string($name_val["name"])."'");	
					$last_id = mysql_insert_id();
					foreach($languages as $key => $val)
					{
						$field[$val["id"]] = mysql_real_escape_string(str_replace($old, $new, $name_val[$val["id"]]));
						mysql_query("
								INSERT INTO `".PREFIX."lang_data`
								SET
									`val_id` = '$last_id',
									`lang_id` = '".$val["id"]."',
									`value` = '".$field[$val["id"]]."'
									");
					}
				}
			}
			else
			{//update
				foreach($languages as $key => $val)
				{
					mysql_query("DELETE FROM `".PREFIX."lang_data`
							WHERE `val_id` = '$name_key' AND `lang_id` = '".$val["id"]."';");
							
					mysql_query("
							INSERT INTO `".PREFIX."lang_data`
							SET 
								`val_id` = '$name_key',
								`lang_id` = '".$val["id"]."',
								`value` = '".$field[$val["id"]]."';
								");
				}
			}
		}
	}
	header("location: /admin/$mode/$order");
	exit();
}
/*******************************************************************************************************/
	switch($cat1)
	{
		case "id":
		case "name":
			$order = $cat1;break;
		default:
			$order = "id";
	}
	$language = array();
	$query = "
		SELECT 
			*
		FROM ".PREFIX."lang
		ORDER BY `$order` ASC
		";

	$rRes = mysql_query($query);
	if(mysql_num_rows($rRes) > 0)
	{
		while($row = mysql_fetch_assoc($rRes))
		{
			$language[] = $row;
		}
	}
?>
<script>
name_id = 0;
function new_lang_val()
{
	name_id = name_id - 1;
	html = 	'<tr>'+
		'	<td align="right"></td>'+
		'	<td><input type="text" name="name['+name_id+'][name]" value="" /></td>'+
		<?php foreach($languages as $key => $val) { ?>
		'	<td><input type="text" name="name['+name_id+'][<?php echo $val["id"]; ?>]" value="" /></td>'+
		<?php } ?>
		'</tr>';
	$("#lang_table").append(html);
}
</script>
<form action="/admin/_<?php echo $mode; ?>.php?order=<?php echo $order; ?>" method="post">
<table class="none" id="lang_table" style="width:100%;position:relative;">
		<tr>
			<th colspan="7" align="left"><?php echo al("valodas_fails"); ?></th>
		</tr>
		<tr>
			<th><a href="id">ID</a></th>
			<th><a href="name"><?php echo al("name"); ?></a></th>
			<?php foreach($languages as $key => $val) { ?>
			<th><?php echo $val["name"].' ('.$val["iso"].')'; ?></th>
			<?php } ?>
		</tr>
		<?php
		foreach($language as $lkey => $lval)
		{
			?>
		<tr>
			<td align="right"><?php echo $lval["id"]; ?></td>
			<td><?php echo $lval["name"]; ?></td>
			<?php 
				foreach($languages as $key => $val)
				{
					$lang_data = array();
					$query = "SELECT ".
							"* ".
						"FROM `".PREFIX."lang_data` WHERE `val_id` = '".$lval["id"]."' AND `lang_id` = '".$val["id"]."' ";
					$rRes = mysql_query($query) or die(mysql_error().$query);
					if(mysql_num_rows($rRes) > 0)
					{
						$lang_data = mysql_fetch_assoc($rRes);
					}
				?>
					<td>
						<input
							<?php echo empty($lang_data["value"])? 'class="redborder"' : ''; ?>
							type="text"
							name="name[<?php echo $lval["id"]; ?>][<?php echo $val["id"]; ?>]"
							value="<?php echo !empty($lang_data["value"]) ? $lang_data["value"] : ''; ?>" />
					</td>
				<?php
				}
			?>
		</tr>
			<?php
		}
		?>
	</table>
	<button type="save" name="save" value="save"><?php echo al("saglabat"); ?></button>
	
</form>
<button type="restore" name="add" onclick="new_lang_val();"><?php echo al("pievienot_jaunu"); ?></button>
