<?php
	
	meta("S", array("template"=>"language"), $lang_items);
	meta("S", array("template"=>"language_pair"), $language_pairs);
	$results = "";
 
	if (!empty($lang_items)) {	
		$lang_count = count($lang_items);
	}
?>
<script>
function toggleCheckbox(this_name)
{
	var index = 0;
	var ids = [];
	var check = $('#lang_pairs table tbody tr td.center_t input[name="' + this_name + '"][type=checkbox]').attr("checked");
	$('#lang_pairs table tbody tr td.center_t input[name="' + this_name + '"][type=hidden]').each(function(){
		ids[index] = $(this).val();
		index++;
	});
	console.log(ids);
	if((typeof(check) != "undefined") && check){
		$('#lang_pairs table tbody tr td.center_t input[name="' + this_name + '"][type=checkbox]').removeAttr("checked");
		console.log("bija checked, tagad nav");
		$.ajax({
			type: "POST",
			url: "/admin/includes/admin/language_pairs/helper.php",
			data:
				{
					action:		'unchecked',
					ids: ids
				},
			async: true,
			success: function(data)
				{
					if (data=="ok" || data=="\"ok\"")
					{
						console.log(data);
						trees();
					}
					else 
					{
						console.log(data);
						return false;
					}
				},
			error: function(data) { 
		        console.log(data); 
		    }
		});
	}else{
		console.log("nebija checked, tagad ir");
		$('#lang_pairs table tbody tr td.center_t input[name="' + this_name + '"][type=checkbox]').attr('checked','');
		$.ajax({
			type: "POST",
			url: "/admin/includes/admin/language_pairs/helper.php",
			data:
				{
					action:		'checked',
					ids: ids,
					creator: <?php echo($creator_id); ?>
				},
			async: true,
			success: function(data)
				{
					if (data=="ok" || data=="\"ok\"")
					{
						console.log(data);
						trees();
					}
					else 
					{
						data = JSON.parse(data);
						console.log(data);
						var meta_data = {};
						var id = "";
						var template = "";
						for (var key in data) {
						    //console.log(data[key]);
						    if(key != "id" && key != "templ"){
						    	meta_data[key] = data[key];
						    }else if(key != "id"){
						    	template = data[key];
						    }else if(key != "templ"){
						    	id = data[key];
						    }
						}
						if(Number.isInteger(id)){
							$.ajax({
								type: "POST",
								url: "/admin/tree_save.php?mode=tree",
								data:
									{
										ajax:'ajax',
										id: id,
										parent_id: ids[0],
										template_id: template,
										save:'save',
										meta_data: meta_data
									},
								async: true,
								success: function(data)
									{
										if(data=="SAVED")
										{
											console.log("SAVED");
											trees();
										}
										else
										{
											console.log(data);
										}
									},
								error: function(data) { 
							        console.log(data); 
							    }
							});
						}
						return false;
					}
				},
			error: function(data) { 
		        console.log(data); 
		    }
		});
		//console.log($(this).val());
	}
	console.log(mode);
}
</script>
<?php if(!empty($results)){
	echo(
		"<div id=\"results\">" . $results . "</div>"
	);
} ?>
<div class="ui title flexy force">
	<?= al("Language_pairs") ?>
</div>
<?php //out($language_pairs) ?>
<form method="post" id="lang_pairs" onsubmit="event.preventDefault();">
	<table class="ui">
		<thead>
			<tr>
				<th colspan="1" rowspan="2" class="right_black_border top_bottom_black_border"><?= al("language_from") ?></th>
				<th colspan="<?= ($lang_count) ?>" style="text-align: center;"><?= al("language_to") ?></th>
			</tr>
			<tr>
				<?php if(!empty($lang_items)):?>
					<?php foreach ($lang_items as $i): ?>
						<th colspan="1"><?= $i["name"] ?></th>
					<?php endforeach; ?>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php if(!empty($lang_items)):?>
				<?php foreach ($lang_items as $i): ?>
					<tr class="ui hover">
						<td class="head_td right_black_border top_bottom_black_border">
							<?= $i["name"] ?>
						</td>
					<?php foreach ($lang_items as $ii): ?>
						<td class="center_t">
						<?php $checked = false; ?>	
						<?php if(!empty($language_pairs)):?>
							<?php foreach ($language_pairs as $iii): ?>
								<?php if(($iii["parent_id"] == $i["id"]) && ($iii["language_to_id"] == $ii["id"]) && ($iii["deny_page"] == 0)){
									$checked = true; break;} ?>
							<?php endforeach; ?>
						<?php endif;?>
							<input name="pair_<?= $i["id"] ?>_<?= $ii["id"] ?>[]" type="checkbox" <?php if($i["id"] == $ii["id"]){echo "disabled";}else{ echo("value=\"on\"");} ?> <?php if($checked == true){echo("checked");}else{echo("");} ?> onchange="toggleCheckbox('pair_<?= $i["id"] ?>_<?= $ii["id"] ?>[]')" >
							<input tips="no" name="pair_<?= $i["id"] ?>_<?= $ii["id"] ?>[]" type="hidden" <?php echo("value=\"".$i["id"]."\""); ?>>
							<input tips="uz" name="pair_<?= $i["id"] ?>_<?= $ii["id"] ?>[]" type="hidden" <?php echo("value=\"".$ii["id"]."\""); ?>>
						</td>
					<?php endforeach; ?>
					</tr>
				<?php endforeach;?>
			<?php endif;?>
		</tbody>	
	</table>

	<input type="hidden" name="action" value="" id="action">

	<div class="ui segment top">
		<?php /*<button type="submit" class="ui button primary"document.getElementById('action').value = 'update';">
			<?= al("saglabat") ?>
		</button>*/ ?>
	</div>
</form>