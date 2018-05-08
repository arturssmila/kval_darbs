<?php 

include("../cms/libs/passwordcheck.inc");

$templates = dig_templates(0);
get_fields($fields, $field_names, $fields_ids);
//out($fields_ids); 			
?>
<script>
name_id = 0;
function new_template()
{
	name_id = name_id - 1;
	html = 	'<tr>'+
		'	<td align="right"></td>'+
		'	<td><select name="name['+name_id+'][t_p_id]"><option value="0"></option><?php 
				function template_select($tpml,$lvl)
				{
					$echo = '';
					foreach($tpml as $key => $val)
					{
						$echo .= '<option value="'.$val["t_id"].'">&nbsp;'.str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $lvl).$val["template_name"].' ('.$val["template"].')&nbsp;</option>';
						if(!empty($val["sub"]))
							$echo .= template_select($val["sub"],$lvl+1);
					}
					return $echo;
				}
				echo template_select($templates,0);
			?></select></td>'+
		'	<td><input type="text" name="name['+name_id+'][template]" value="" /></td>'+
		'	<td><input type="text" name="name['+name_id+'][template_name]" value="" /></td>'+
		'</tr>';
	$("#lang_table").append(html);
}
</script>
<form action="/admin/templates_save.php" method="post">
<table class="none" id="lang_table">
		<tr>
			<th colspan="4" align="left"><?php echo al("sadalu_tipi"); ?></th>
		</tr>
		<tr>
			<th>ID</th>
			<th><?php echo al("vecaks"); ?></th>
			<th><?php echo al("name"); ?></th>
			<th><?php echo al("teaser"); ?></th>
			<th></th>
		</tr>
		<?php
		function template_tree($tpml,$lvl)
		{
			global $templates;
			global $fields;
			foreach($tpml as $key => $val)
			{
				?>
				<tr>
					<td class="top" align="right"><?php echo $val["t_id"]; ?></td>
					<td class="top" align="center"><?php echo $val["t_p_id"]; ?></td>
					<td class="top" style="padding-left:<?php echo ($lvl*20)+2; ?>px;"><?php echo $val["template"]; ?></td>
					<td class="top" style="padding-left:<?php echo ($lvl*20)+2; ?>px;">
						<input type="text" name="name[<?php echo $val["t_id"]; ?>][template_name]" value="<?php echo $val["template_name"]; ?>" style="min-width:300px;" />
						<button type="save" name="save" value="save" style="display:block;width:0px;height:0px;margin:0px;padding:0px;border:none;"></button>
					</td>
					<td class="top" style="padding-left:<?php echo ($lvl*20)+2; ?>px;">
						<button onclick="$('#fields_<?php echo $val["t_id"]; ?>').slideToggle();return false;" style="margin:0px;"><?php echo al("fields"); ?></button>
						<div id="fields_<?php echo $val["t_id"]; ?>" style="display:none;padding:10px 0px;">
							<?php
							get_fields($tfields[$key], $tfield_names[$key], $tfields_ids[$key], $val["t_id"]);
							echo '<table style="border-spacing:0px;">';
							foreach($fields as $fkey => $fval)
							{
								echo '	<tr>
										<td>'; ?>
											<input 
												type="checkbox"
												<?php echo (in_array($fval["field_id"],$tfields_ids[$key])?'checked':'').' '.(($fval["field_id"]<0)?'disabled':''); ?>
												onchange="add_remove_field(<?php echo $val["t_id"]; ?>, <?php echo $fval["field_id"]; ?>, $(this).is(':checked'));"
												/>
								<?php echo '	</td>
										<td>'.al($fval["field_name"]).' ('.$fval["field_name"].'['.$fval["field_type"].'])</td>
									</tr>';
							}
							echo '</table>';
							echo '<div class="error">xxx</div>';
							echo '<div class="success">xxx</div>';
							?>
						</div>
					</td>
				</tr>
				<?php
				if(!empty($val["sub"]))
					template_tree($val["sub"],$lvl+1);
			}
		}
		template_tree($templates,0);
		?>
	</table>
	<button type="save" name="save" value="save"><?php echo al("saglabat"); ?></button>
	
</form>
<button type="restore" name="add" onclick="new_template();"><?php echo al("pievienot_jaunu"); ?></button>
