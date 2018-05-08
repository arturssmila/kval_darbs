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
	
	//out($_POST);die();
	
	$mode = "languages";
	$order = !empty($_POST["order"]) ? $_POST["order"] : '';
	$delete = !empty($_POST["delete"]) ? $_POST["delete"] : '';
	
	$settings = !empty($_POST["settings"]) ? $_POST["settings"] : array();
    
	$name = !empty($_POST["name"]) ? $_POST["name"] : '';
	$save = !empty($_POST["save"]) ? $_POST["save"] : '';
	
	$copy_language_data = !empty($_POST["copy_language_data"]) ? explode("@",$_POST["copy_language_data"]) : array();
	$copy_language_from = reset($copy_language_data);
	$copy_language_to = end($copy_language_data);
	
	if(!empty($_POST["copy_language_by_one"]))
	{
		$copy_language_by_one = !empty($_POST["copy_language_by_one"]) ? explode("@",$_POST["copy_language_by_one"]) : array();
		$copy_language_from = reset($copy_language_by_one);
		$copy_language_to = end($copy_language_by_one);
		$id = !empty($_POST["id"]) ? $_POST["id"] : 0;
		if(!empty($id) && !empty($copy_language_from) && !empty($copy_language_to) && ($copy_language_from!=$copy_language_to))
		{
			if(!empty($languages_keys[$copy_language_from]) && !empty($languages_keys[$copy_language_to]))
			{
				$query = "SELECT * FROM `".PREFIX."meta_data` WHERE `meta_id` = '$id' AND `language_id` = '$copy_language_from' ";
				$res = mysql_query($query);
				if(mysql_num_rows($res) > 0)
				{
					while($row = mysql_fetch_assoc($res))
					{
						$query2 = "SELECT * FROM `".PREFIX."meta_data`
								WHERE
									`meta_id` = '$id'
									AND `language_id` = '$copy_language_to'
									AND `field_id` = '".$row["field_id"]."'
							";
						$res2 = mysql_query($query2);
						if(!(mysql_num_rows($res2) > 0))
						{
							if(!empty($row["field_content"]))
							{
								if($row["field_id"]=="-6")
								{
									$row["field_content"] .= '-'.$languages_keys[$copy_language_to]["iso"];
								}
								mysql_query("INSERT INTO `".PREFIX."meta_data`
									SET 
										`meta_id` = '$id',
										`language_id` = '$copy_language_to',
										`field_id` = '".$row["field_id"]."',
										`field_content` = '".mysql_real_escape_string($row["field_content"])."'
									");
							}
						}
					}
				}
			}
		}
		exit();
	}
	elseif(!empty($copy_language_from) && !empty($copy_language_to) && ($copy_language_from!=$copy_language_to))
	{//start copy language
		if(!empty($languages_keys[$copy_language_from]) && !empty($languages_keys[$copy_language_to]))
		{
			//sadab� meta ierakstu skaitu
			$query = "SELECT id FROM ".PREFIX."meta ORDER BY id ASC";
			$res = mysql_query($query);
			if(mysql_num_rows($res) > 0)
			{
				$ids = '';
				while($row = mysql_fetch_assoc($res))
				{
					$ids .= (!empty($ids) ? '#' : '').$row["id"];
				}
				echo $ids;
			}
		}
		exit();
	}
	elseif(!empty($delete))
	{
		mysql_query("DELETE FROM ".PREFIX."languages WHERE id = $delete ") or die(mysql_error());
	}
	elseif(!empty($order))
	{
		$id = end(explode("#",$order));
		$order = reset(explode("#",$order));
		
		$result = mysql_query("SELECT * FROM ".PREFIX."languages ORDER BY ordering") or die(mysql_error());
		
		while($row = mysql_fetch_assoc($result))
		{
			$fields[] = $row;
		}
		$ord = 0;
		foreach($fields as $key => $val)
		{
			if($val["id"]==$id)
			{
				if($order=="up")
				{
					if(!empty($fields[$key-1]))
					{
						$fields[$key]["ordering"] = $ord-1;
						$fields[$key-1]["ordering"] = $ord;
					}
				}
				else
				{
					if(!empty($fields[$key+1]))
					{
						$fields[$key]["ordering"] = $ord+1;
						$fields[$key+1]["ordering"] = $ord;
					}
				}
			}
			elseif($fields[$key-1]["id"]!=$id)
			{
				$fields[$key]["ordering"] = $ord;
			}
			$ord++;
		}
		foreach($fields as $key => $val)
		{
			mysql_query("UPDATE ".PREFIX."languages SET ordering = ".$val["ordering"]." WHERE id = ".$val["id"]."") or die(mysql_error());
		}
	}
	elseif(!empty($save))
	{
		
		$old = array('"');
		$new = array('&quot;');
		foreach($name as $name_key => $name_val)
		{
			unset($field);
			$field["active"] = !empty($name_val["active"]) ? 1 : 0;
			$field["iso"] = mysql_real_escape_string(str_replace($old, $new, $name_val["iso"]));
			$field["name"] = mysql_real_escape_string(str_replace($old, $new, $name_val["name"]));
			
			if ($name_key < 0)
			{//jauns
				
				if($field["iso"] && $field["name"])
				{
					$result = mysql_query("SELECT  COUNT(*) as ordering FROM ".PREFIX."languages") or die(mysql_error());
					$row = mysql_fetch_assoc($result);
					
					
					mysql_query("INSERT INTO ".PREFIX."languages (active,ordering,iso,name) VALUES (
						'".$field["active"]."',
						".$row["ordering"].",
						'".$field["iso"]."',
						'".$field["name"]."')") or die(mysql_error());
						
					event("I",array("user_id"=>$creator_id,"action"=>'Pievieno jaunu valodu "'.str_replace($old, $new, $name_val["name"]).' ('.str_replace($old, $new, $name_val["iso"]).')"'),$x);
				}
			}
			else
			{//update
				$result = mysql_query("SELECT * FROM ".PREFIX."languages WHERE id = $name_key ;");
				$row = mysql_fetch_assoc($result);
				
				mysql_query("UPDATE ".PREFIX."languages SET 
					active = '".$field["active"]."',
					iso = '".$field["iso"]."', 
					name = '".$field["name"]."' 
						WHERE id = $name_key;") or die(mysql_error());
				event("I",array("user_id"=>$creator_id,"action"=>'Izmaina valodu <strong>'.$row["name"].' ('.$row["iso"].')</strong> uz "'.str_replace($old, $new, $name_val["name"]).' ('.str_replace($old, $new, $name_val["iso"]).')"'),$x);
				
			}
		}
		
		foreach($settings as $key => $val)
		{
			mysql_query("UPDATE ".PREFIX."languages_settings SET 
						value = '".$val."'
					WHERE name = '".$key."';") or die(mysql_error());
		}
	}
	header("location: /admin/$mode/");
	exit();
}
/***********************************************************************************************************************************/
		
//out($languages); 	

$query2 = "SELECT * FROM ".PREFIX."languages_settings";
$res2 = mysql_query($query2) or die(mysql_error().$query2);
if(mysql_num_rows($res2) > 0)
{
	while($row2 = mysql_fetch_assoc($res2))
	{
		if (empty($row2["name"])) break;
		$languages_settings[$row2["name"]] = $row2["value"];
	}
}
//out($languages_settings); 	
?>
<script>
name_id = 0;
function new_lang_val()
{
	name_id = name_id - 1;
	html = 	'<tr>'+
		'	<td align="right"></td>'+
		'	<td><input type="text" name="name['+name_id+'][iso]" value="" style="width:50px;text-align:center;" /></td>'+
		'	<td><input type="text" name="name['+name_id+'][name]" value="" /></td>'+
		'	<td align="right"></td>'+
		'	<td align="right"></td>'+
		'	<td align="right"></td>'+		
		'</tr>';
	$("#lang_table").append(html);
}
</script>
<style>
	.copy_language_td .loading_image {
		display:none;
		max-height:20px;
		vertical-align:middle;
	}
	.copy_language_td.loading .loading_image {
		display:inline-block;
	}
	.copy_language_td.loading .copy_language_data,
	.copy_language_td.loading .copy_language_select {
		display:none;
	}
	.copy_language_div {
		display:inline-block;
	}
</style>
<form action="/admin/_languages.php" method="post">
	<table class="none" id="lang_table" style="position:relative;">
		<tr>
			<th colspan="7" align="left"><?php echo al("valodas"); ?></th>
		</tr>
		<tr>
			<th>ID</th>
			<th>ISO</th>
			<th><?php echo al("name"); ?></th>
			<th><?php echo al("radit"); ?></th>
			<th colspan="2"><?php echo al("change_order"); ?></th>
			<th><?php echo al("copy"); ?></th>
			<th><?php echo al("dzest"); ?></th>
		</tr>
		<?php
		foreach($languages as $lkey => $lval)
		{
			?>
		<tr>
			<td align="right"><?php echo $lval["id"]; ?></td>
			<td><input type="text" name="name[<?php echo $lval["id"]; ?>][iso]" value="<?php echo $lval["iso"]; ?>" style="width:50px;text-align:center;" /></td>
			<td><input type="text" name="name[<?php echo $lval["id"]; ?>][name]" value="<?php echo $lval["name"]; ?>" /></td>
			<td style="text-align:center;"><input type="checkbox" name="name[<?php echo $lval["id"]; ?>][active]" value="1" <?php echo !empty($lval["active"]) ? 'checked' : ''; ?> /></td>
			<td>
				<button type="save" name="save" value="save" style="display:block;width:0px;height:0px;margin:0px;padding:0px;border:none;"></button>
				<?php if($lkey > 0) {?>
				<button name="order" value="up#<?php echo $lval["id"]; ?>" type="up" style="background-position:center;">&nbsp;</button>
				<?php } ?>
			</td>
			<td>
				<?php if(!empty($languages[$lkey+1])) { ?>
				<button name="order" value="down#<?php echo $lval["id"]; ?>" type="down" style="background-position:center;">&nbsp;</button>
				<?php } ?>
			</td>
			<td class="copy_language_td">
				<?php
				if($lkey > 0)
				{
					?>
						<a type="edit" class="copy_language_data"><?php echo al("copy_data_from_language"); ?></a>
						<select class="copy_language_select">
							<?php
							foreach($languages as $skey => $sval)
							{
								if($skey!=$lkey)
								{
									echo '<option value="'.$sval["id"].'@'.$lval["id"].'">'.$sval["name"].'</option>';
								}
							}
							?>
						</select>
						<img class="loading_image" src="/cms/css/images/loading.gif" />
						<div class="copy_language_div" rel=""></div>
					<?php
				}
				?>
			</td>
			<td>
				<button name="delete" onclick="if (!confirm('<?php echo al("tiesam_dzest_valodu"); ?>')) { return false; }" value="<?php echo $lval["id"]; ?>" style="padding:0px;"><img src="/cms/css/images/del.png"></button>
			</td>
		</tr>
			<?php
		}
		?>
	</table>
	<br /><br />
	<?php if(is_super_admin()) { ?>
	<table class="lang_table" id="languages_settings">
		<tr>
			<th colspan="3" class="left"><?php echo al("name"); ?></th>
		</tr>
		<tr>
			<td class="right bold">Language Type:</td>
			<td><label><input type="radio" name="settings[lang_type]" value="suffix" <?php echo (($languages_settings["lang_type"]!="unique") ? 'checked' :''); ?> /> Suffix</label></td>
			<td><label><input type="radio" name="settings[lang_type]" value="unique" <?php echo (($languages_settings["lang_type"]=="unique") ? 'checked' :''); ?> /> Unique</label></td>
		</tr>
		<tr>
			<td class="right bold">Position:</td>
			<td><label><input type="radio" name="settings[lang_position]" value="link"	<?php echo (($languages_settings["lang_position"]!="subdomain") ? 'checked' :''); ?> /> Link</label></td>
			<td><label><input type="radio" name="settings[lang_position]" value="subdomain" <?php echo (($languages_settings["lang_position"]=="subdomain") ? 'checked' :''); ?> /> Subdomain</label></td>
		</tr>
	</table>
	<div id="languages_preview" class="sh" style="display:inline-block;">
	</div>
	<?php } ?>
	
	<script>
		var www = '';
		var domain = '<?php echo $_SERVER['HTTP_HOST']; ?>';
		var splited_domain = domain.split('.');
		if(splited_domain[0]=="www")
		{
			www = "www.";
			splited_domain.shift();
			domain = splited_domain.join(".");
		}
		var all_languages = {<?php
					foreach($languages as $lkey => $lval)
					{
						echo $lkey.':{';
						foreach($lval as $lv_key => $lv_val)
						{
							echo '"'.$lv_key.'":"'.$lv_val.'",';
						}
						echo '},';
					}
					?>
					};
		var ids = {};
		var id_ind = {};
		var cl_start_time = {};
		
		function copy_language_by_one(lang_id)
		{
			var update_id = Number(ids[lang_id][id_ind[lang_id]]);
			id_ind[lang_id]++;
			var cl_time_now = new Date().getTime()
			var cl_left_all_sec = (( ( (cl_time_now-cl_start_time[lang_id]) / id_ind[lang_id]) * ids[lang_id].length) - (cl_time_now-cl_start_time[lang_id]));
			
			var cl_left_secs = Math.floor( (cl_left_all_sec/1000) % 60 );
			var cl_left_mins = Math.floor( (cl_left_all_sec/1000/60) % 60 );
			var cl_left_hours = Math.floor( (cl_left_all_sec/(1000*60*60)) % 24 );
			var cl_left_days = Math.floor( cl_left_all_sec/(1000*60*60*24) );
	  
			$('.copy_language_div[rel="'+lang_id+'"]').html(
							((id_ind[lang_id]/ids[lang_id].length)*100).toFixed() + '%' +
							' Time remaining: ' +
								((cl_left_days>0) ? (cl_left_days + ' days ') : '') + 
								((cl_left_hours>0) ? (cl_left_hours + ' h ') : '') + 
								((cl_left_mins>0) ? (cl_left_mins + ' min ') : '') + 
								cl_left_secs + ' sec '
							);
			
			$.ajax({
				type: "POST",
				url: "/admin/_languages.php",
				data:
				{
					id:update_id,
					copy_language_by_one:	lang_id
				},
				async: true,
				success: function(resp)
					{
						if(resp!='')
							console.log(resp);
						if(id_ind[lang_id] < ids[lang_id].length)
						{
							copy_language_by_one(lang_id);
						}
						else
						{
							$('.copy_language_div[rel="'+lang_id+'"]').parents('.copy_language_td').removeClass('loading');
							$('.copy_language_div[rel="'+lang_id+'"]').html('');
						}
					}
				});
		}
		$(document).ready(function()
		{
			$('.copy_language_td .copy_language_data').click(function(){
					
				var loading_block = $(this).parents('.copy_language_td');
				loading_block.addClass('loading');
				var lang_id = $('.copy_language_select',$(this).parents('.copy_language_td')).val();
				$('.copy_language_div',loading_block).attr('rel',lang_id);
				$.ajax({
					type: "POST",
					url: "/admin/_languages.php",
					data:
					{
						copy_language_data:	lang_id
					},
					async: true,
					success: function(data)
						{
							if(data!="")
							{
								ids[lang_id] = data.split('#');
								id_ind[lang_id] = 0;
								cl_start_time[lang_id] = new Date().getTime();
								copy_language_by_one(lang_id);
							}
							//loading_block.removeClass('loading');
						}
					});
			});
			
			$("#languages_settings input").change(function(){
				var lang_type = $('#languages_settings input[name="settings[lang_type]"]:checked').val();
				var lang_position = $('#languages_settings input[name="settings[lang_position]"]:checked').val();
				var html_home = '<strong>Home</strong>';
				var html_other = '<br /><br /><strong>Other</strong>';
				
				for(x in all_languages)
				{
					html_home += '<br />';
					html_other += '<br />';
					
					//subdomain
					var subdomain = www;
					if(lang_position=="subdomain")
					{
						if(lang_type=="suffix")
						{
							if(x>0) subdomain = '<strong class="red">' + all_languages[x]["iso"] + '</strong>.';
						}
						if(lang_type=="unique")
						{
							subdomain = '<span class="blue">subdomain</span>' + '<strong class="red">-' + all_languages[x]["iso"] + '</strong>.';
						}
					}
					html_home += subdomain;
					html_other += subdomain;
					
					html_home += domain + '/';
					html_other += domain + '/';
					
					//suffix
					if( (lang_type=="suffix") && (lang_position=="link") )
					{
						if(x>0)
						{
							html_home += '<strong class="red">' + all_languages[x]["iso"] + '</strong>' + '/';
							html_other += '<strong class="red">' + all_languages[x]["iso"] + '</strong>' + '/';
						}
					}
					html_other += '<span class="blue">link</span>';
					if( (lang_type=="unique") && (lang_position=="link"))
					{
						if(x>0)
						{
							html_home += '<span class="blue">home</span>';
							html_home += '<strong class="red">-' + all_languages[x]["iso"] + '</strong>';
						}
						html_other += '<strong class="red">-' + all_languages[x]["iso"] + '</strong>';
					}
				}
				$('#languages_preview').html(html_home+html_other);
			});
			$("#languages_settings input").change();
		});
		
	</script>
	<br /><br />
	<button type="save" name="save" value="save"><?php echo al("saglabat"); ?></button>
	
</form>
<button type="restore" name="add" onclick="new_lang_val();"><?php echo al("pievienot_jaunu"); ?></button>
