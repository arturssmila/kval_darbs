<?php 
//print_r($_POST);
switch($cat1)
{
case "id":
case "name":
	$order = $cat1;break;
default:
	$order = "id";
}
$language = array();
$query = "SELECT ".
			"* ".
			
		"FROM ".PREFIX."adm_lang ".
		"ORDER BY $order ASC ";
//echo "<br />".$query;
			$rRes = mysql_query($query) or die(mysql_error().$query);
			
			if(mysql_num_rows($rRes) > 0)
			{
				while($row = mysql_fetch_assoc($rRes))
				{
					if (empty($row["id"])) break;
					$language[] = $row;
				}
			}
			
//print_r($language); 			
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
<form action="/admin/adm_language_save.php?order=<?php echo $order; ?>" method="post">
<table class="none" id="lang_table" style="width:100%;position:relative;">
		<tr>
			<th colspan="7" align="left"><?php echo al($mode); ?></th>
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
						"FROM ".PREFIX."adm_lang_data WHERE val_id = '".$lval["id"]."' AND lang_id = '".$val["id"]."' ";
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
