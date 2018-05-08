<?php 

if(!empty($_POST))
{
	//out($_POST);
	
	$name = !empty($_POST["name"]) ? $_POST["name"] : '';
	$new = !empty($_POST["new"]) ? $_POST["new"] : array();
	$save = !empty($_POST["save"]) ? $_POST["save"] : '';
	$order = !empty($_POST["order"]) ? explode("#",$_POST["order"]) : '';
	$delete = !empty($_POST["delete"]) ? $_POST["delete"] : '';
	
	
	if($order)
	{
		if(!empty($order[1]))
		{
			$id = intval($order[0]);
			$order = $order[1];
			//out($id);
			//out($order);
			if($id > 0)
			{
				$fields = array();
				$res = mysql_query("SELECT * FROM `".PREFIX."fields`
					WHERE `field_id` > 0
					ORDER BY
						`ordered` ASC
					;");
				$ord = 0;
				while($row = mysql_fetch_assoc($res))
				{					
					$row["ordered"] = $ord;
					if($row["field_id"] == $id)
					{
						if($order == "up")
						{
							$row["ordered"] = $ord - 1;
							if(!empty($fields[$ord-1]["field_id"]))
							{
								$fields[$ord-1]["ordered"] = $ord;
							}
						}
						if($order == "down")
						{
							$row["ordered"] = $ord + 1;
						}
					}
					if(!empty($fields[$ord-1]["field_id"]) && ($fields[$ord-1]["field_id"] == $id) && ($order == "down"))
					{
						$row["ordered"] = $ord - 1;
					}
					$fields[] = $row;
					$ord++;
				}
				foreach($fields as $key => $val)
				{                
					mysql_query("UPDATE `".PREFIX."fields` SET `ordered` = '".$val["ordered"]."' WHERE `field_id` = ".$val["field_id"].";");
				}
				//out($fields);
			}
		}
		//die();
	}
	elseif($delete)
	{
		mysql_query("DELETE FROM ".PREFIX."fields 
				WHERE field_id = '$delete' ;") or die(mysql_error());
	}
	elseif($save)
	{//update
		foreach($name as $key => $val)
		{
			foreach($val as $vk => $vv)
			{
				mysql_query("UPDATE ".PREFIX."fields SET ". 
					"$vk = '".mysql_real_escape_string($vv)."'
					WHERE field_id = '$key' ;");
			}
		}
		foreach($new as $key => $val)
		{
			if(!empty($val["field_name"]))
			{
				mysql_query("INSERT INTO ".PREFIX."fields SET ". 
					"field_name = '".mysql_real_escape_string($val["field_name"])."', ".
					"field_type = '".$val["field_type"]."', ".
					"default_value = '".mysql_real_escape_string($val["default_value"])."', ".
					"placeholder = '".mysql_real_escape_string($val["placeholder"])."', ".
					"in_langs = '".$val["in_langs"]."'
						");
			}
		}
	}
	header("location: /admin/$mode");
	exit();
}

$templates = dig_templates();
$fields = array();


$result = mysql_query("SELECT * FROM `".PREFIX."fields`
			ORDER BY
				`ordered` ASC,
				`field_id` ASC
			;");
while($row = mysql_fetch_assoc($result))
{
	$fields[] = $row;
}
//out($templates);						
//print_r($language); 	

function template_select($tpml,$lvl)
{
	$echo = '';
	foreach($tpml as $key => $val)
	{
		$echo .= '<option value="'.$val["t_id"].'">&nbsp;'.str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $lvl).$val["template_name"].' ('.$val["template"].' ['.$val["t_id"].'])&nbsp;</option>';
		if(!empty($val["sub"]))
			$echo .= template_select($val["sub"],$lvl+1);
	}
	return $echo;
}
?>
<style>
	button[type="up"],
	button[type="down"] {
		padding:2px 9px;
		background-position:center;
	}
</style>
<script>
var new_id = 0;
function new_template_field()
{
	html = 	'<tr>'+
		'	<td align="right"></td>'+
		'	<td align="right"></td>'+
		'	<td><input type="text" name="new['+new_id+'][field_name]" value="" /></td>'+
		'	<td>'+
		'		<select 		name="new['+new_id+'][field_type]" style="width:100%;">'+
					<?php foreach($adm_set["field_types"] as $ftkey => $ftval) { ?>
		'				<option value="<?php echo $ftval; ?>"><?php echo $ftval; ?></option>'+
					<?php } ?>
		'		</select>'+
		'	</td>'+
		'	<td>'+
		'		<label style="vertical-align:middle;"><input style="vertical-align:middle;" type="radio" name="new['+new_id+'][in_langs]" value="1" checked /> <?php echo al("in_each"); ?></label><br />'+
		'		<label style="vertical-align:middle;"><input style="vertical-align:middle;" type="radio" name="new['+new_id+'][in_langs]" value="0" /> <?php echo al("in_all"); ?></label>'+
		'	</td>'+
		'	<td><input type="text" name="new['+new_id+'][default_value]" value="" /></td>'+
		'	<td><input type="text" name="new['+new_id+'][placeholder]" value="" /></td>'+
		'	<td colspan="2"></td>'+
		'</tr>';
	$("#lang_table").append(html);
	new_id++;
}
</script>
<form action="" method="post">
<table class="none" id="lang_table" border="0">
		<tr>
			<th colspan="5" align="left"><?php echo al($mode); ?></th>
		</tr>
		<tr>
			<th>ID</th>
			<th>O</th>
			<th></th>
			<th style="min-width:150px;"><?php echo al("field_name"); ?></th>
			<th style="min-width:60px;"><?php echo al("field_type"); ?></th>
			<th><?php echo al("in_languages"); ?></th>
			<th><?php echo al("default_value"); ?></th>
			<th><?php echo al("placeholder"); ?></th>
			<th><?php echo al("statuss"); ?></th>
			<th><?php echo al("dzest"); ?></th>
		</tr>
		<?php
		$field_ind = 0;
		foreach($fields as $key => $val)
		{
			$title = '';
			$disabled = '';
			if($val["field_id"] < 0)
			{
				$disabled = 'disabled';
				$title = al("noklusejuma_laucins");
			}
			$res = mysql_query("SELECT * FROM ".PREFIX."templates_fields WHERE field_id = '".$val["field_id"]."' ") or die(mysql_error().$query);
			if(mysql_num_rows($res) > 0) 
			{
				$disabled = 'disabled';
				while($row = mysql_fetch_assoc($res))
				{
					$title .= (!empty($title) ? ', ':'').$templates[$row["t_id"]]["template_name"].' ['.$templates[$row["t_id"]]["template"].']';
				}
			}
			?>
			<tr>
				<td align="right" style="vertical-align:middle;"><?php echo $val["field_id"]; ?></td>
				<td class="right"><?php echo $val["ordered"]; ?></td>
				<td nowrap <?php if(empty($field_ind)) { echo 'class="right"'; } ?>>
					<?php
						if($val["field_id"] > 0)
						{
							$field_ind++;
							if($field_ind > 1)
							{
								echo '<button name="order" value="'.$val["field_id"].'#up" type="up"></button>';
							}
							if(!empty($fields[$key+1]))
							{
								echo '<button name="order" value="'.$val["field_id"].'#down" type="down"></button>';
							}
						}
					?>
				</td>
				<td>
					<input name="name[<?php echo $val["field_id"]; ?>][field_name]" <?php echo $disabled; ?> type="text" value="<?php echo $val["field_name"]; ?>" />
				</td>
				<td>
					<select name="name[<?php echo $val["field_id"]; ?>][field_type]" <?php echo $disabled; ?> style="width:100%;">
						<?php foreach($adm_set["field_types"] as $ftkey => $ftval) { ?>
							<option value="<?php echo $ftval; ?>" <?php echo ($ftval==$val["field_type"]) ? 'selected' : ''; ?>><?php echo $ftval; ?></option>
						<?php } ?>
					</select>
				</td>
				<td align="center">
					<?php if(empty($disabled)) { ?>
						<label style="vertical-align:middle;"><input style="vertical-align:middle;" type="radio" name="name[<?php echo $val["field_id"]; ?>][in_langs]" value="1" <?php echo !empty($val["in_langs"])?'checked':''; ?> /> <?php echo al("in_each"); ?></label><br />
						<label style="vertical-align:middle;"><input style="vertical-align:middle;" type="radio" name="name[<?php echo $val["field_id"]; ?>][in_langs]" value="0" <?php echo empty($val["in_langs"])?'checked':''; ?> /> <?php echo al("in_all"); ?></label>
					<?php } else echo empty($val["in_langs"]) ? al("in_all") : al("in_each"); ?>
				</td>
				<td>
					<input name="name[<?php echo $val["field_id"]; ?>][default_value]" type="text" value="<?php echo $val["default_value"]; ?>" />
				</td>
				<td>
					<input name="name[<?php echo $val["field_id"]; ?>][placeholder]" type="text" value="<?php echo $val["placeholder"]; ?>" />
				</td>
				<td>
					<?php echo $title; ?>
				</td>
				<td>
					<button type="save" name="save" value="save" style="display:block;width:0px;height:0px;margin:0px;padding:0px;border:none;"></button>
					<?php if(empty($disabled)) { ?>
					<button name="delete" onclick="if (!confirm('<?php echo al("tiesam_dzest_laucinu"); ?>')) { return false; }" value="<?php echo $val["field_id"]; ?>" style="padding:0px;"><img src="/cms/css/images/del.png"></button>
					<?php } ?>
				</td>
			</tr>
			<?php
		}
		?>
	</table>
	<button type="save" name="save" value="save"><?php echo al("saglabat"); ?></button>
	
</form>
<button type="restore" name="add" onclick="new_template_field();"><?php echo al("pievienot_jaunu"); ?></button>
