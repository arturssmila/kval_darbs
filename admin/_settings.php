<?php 
if(!empty($_POST))
{
	$order = !empty($_POST["order"]) ? $_POST["order"] : '';
	$name = !empty($_POST["name"]) ? $_POST["name"] : '';
	$save = !empty($_POST["save"]) ? $_POST["save"] : '';
	if ($save)
	{
		$old = array('"');
		$new = array('&quot;');
		foreach($name as $name_key => $name_val)
		{
			if($name_key < 0)
			{//jauns
				if(mysql_real_escape_string($name_val["name"]))
				{
					mysql_query("INSERT INTO ".PREFIX."settings (name,value) VALUES (
						'".mysql_real_escape_string($name_val["name"])."',
						'".mysql_real_escape_string($name_val["value"])."')") or die(mysql_error());
				}
			}
			else
			{//update
				mysql_query("UPDATE ".PREFIX."settings SET 
					value = '".mysql_real_escape_string($name_val["value"])."' 
				WHERE name = '".$name_val["name"]."';") or die(mysql_error());
			}
		}
	}
	header("location: /admin/$mode/$order");
	exit();
}

/********************************************************************************************/



$set = array();
switch($cat1)
{
case "name":
case "value":
	$order = $cat1;break;
default:
	$order = "name";
}

$query = "SELECT ".
		"* ".
	"FROM ".PREFIX."settings ".
	"ORDER BY $order ASC ";
$rRes = mysql_query($query) or die(mysql_error().$query);
if(mysql_num_rows($rRes) > 0)
{
	while($row = mysql_fetch_assoc($rRes))
	{
		if (empty($row["name"])) break;
		$set[] = $row;
	}
}		
?>
<script>
name_id = 0;
function new_settings_val()
{
	name_id = name_id - 1;
	html = 	'<tr>'+
		'	<td><input type="text" name="name['+name_id+'][name]" value="" /></td>'+
		'	<td><input type="text" name="name['+name_id+'][value]" value="" /></td>'+
		'</tr>';
	$("#lang_table").append(html);
}
</script>
<form action="" method="post">
	<input type="hidden" name="order" value="<?php echo $order; ?>" />
	<table class="none" id="lang_table" style="width:100%;position:relative;">
		<tr>
			<th colspan="2" align="left"><?php echo al("settings"); ?></th>
		</tr>
		<tr>
			<th><a href="name"><?php echo al("name"); ?></a></th>
			<th><a href="value"><?php echo al("value"); ?></a></th>
		</tr>
		<?php
		foreach($set as $key => $val)
		{
			?>
		<tr>
			<td style="padding-right:10px;width:1%;"><?php echo $val["name"]?></td>
			<td>
				<input type="hidden" name="name[<?php echo $key; ?>][name]" value="<?php echo $val["name"]?>" />
				<input type="text" name="name[<?php echo $key; ?>][value]" value="<?php echo $val["value"]?>" />
			</td>
		</tr>
			<?php
		}
		?>
	</table>
	<button type="save" name="save" value="save"><?php echo al("saglabat"); ?></button>
	
</form>
<button type="restore" name="add" onclick="new_settings_val();"><?php echo al("pievienot_jaunu"); ?></button>
