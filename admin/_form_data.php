<?php
if(!empty($_POST))
{
	$id = !empty($_POST["id"]) ? $_POST["id"] : die();
	$action = !empty($_POST["action"]) ? $_POST["action"] : die();
	require('../config.php');
	switch($action)
	{
		case "delete":
			mysql_query("DELETE FROM `".PREFIX."form_data` WHERE id = '$id'");
			echo $action;
			break;
		default:
			die();
	}
	exit();
}
$all_form_data = array();
$queryx = "SHOW TABLES LIKE '".PREFIX."form_data' ";
$resx = mysql_query($queryx);
if(mysql_num_rows($resx) > 0)
{
	$query = " SELECT * FROM `".PREFIX."form_data` WHERE (`type` IS NULL OR `type` <> 'hidden') ORDER BY id DESC ";
	$res = mysql_query($query);
	if(mysql_num_rows($res) > 0)
	{
		while($row = mysql_fetch_assoc($res))
		{
			$all_form_data[] = $row;
		}
	}
}
		
	
?>
<style>
	.form_data_table {
		
	}
	.form_data_table button.delete {
		display:none;
	}
	.form_data_table .deletion button.delete {
		display:inline-block;
	}
	.form_data_table .loading_image {
		display:inline-block;
		max-height:20px;
		vertical-align:middle;
	}
	.form_data_table .deletion .loading_image {
		display:none;
	}
	.form_data_table .show_form_data_content {
		display:none;
	}
</style>
<table>
	<tr>
		<th align="left"><?php echo al("form_data"); ?></th>
	</tr>
</table>
<table class="form_data_table">
	<tr>
		<th>ID</th>
		<th><?php echo al("datums"); ?></th>
		<th><?php echo al("e_pasts"); ?></th>
		<th><?php echo al("subject"); ?></th>
		<th><?php echo al("type"); ?></th>
		<th><?php echo al("dzest"); ?></th>
	</tr>	
<?php
if(!empty($all_form_data))
{
	foreach($all_form_data as $key => $val)
	{
		?>
		<tr class="sec_tr" rel="<?php echo $val["id"]; ?>">
			<td align="right"><?php echo $val["id"]; ?></td>
			<td align="right" nowrap><?php echo $val["date"]; ?></td>
			<td align="left" nowrap><?php echo $val["sender_email"]; ?></td>
			<td align="left"><a class="show_form_data_link" rel="<?php echo $val["id"]; ?>"><?php echo (!empty($val["subject"])?$val["subject"]:'[..]'); ?></a></td>
			<td align="left" nowrap><?php echo $val["type"]; ?></td>
			<td align="center" class="deletion" rowspan="2">
				<button rel="<?php echo $val["id"]; ?>" type="delete" class="delete"><?php echo al("dzest"); ?></button>
				<img class="loading_image" src="/cms/css/images/loading.gif" />
			</td>
		</tr>	
		<tr class="sec_tr" rel="<?php echo $val["id"]; ?>">
			<td colspan="5">
				<div class="show_form_data_content" rel="<?php echo $val["id"]; ?>">
					<?php echo ($val["content"]); ?>
				</div>
			</td>
		</tr>
		<tr rel="<?php echo $val["id"]; ?>"><td colspan="6"></td></tr>
		<?php
	}
}
?>	
</table>
<script type="text/javascript">
	$(document).ready(function()
	{
		$('.show_form_data_link[rel]').click(function(){
			$('.show_form_data_content[rel="'+$(this).attr('rel')+'"]').slideToggle();
		});
		
		$('.form_data_table .deletion .delete').click(function(){
			var id = Number($(this).attr('rel'));
			var action = 'delete';
			var tr = $('.form_data_table tr[rel="'+id+'"]');
			var td = $(this).parents('.form_data_table tr td');
			td.removeClass('deletion');
			$.ajax({
				type: "POST",
				url: "/admin/_form_data.php",
				data:
				{
					id:	id,
					action:	action
				},
				async: true,
				success: function(data)
					{
						//alert(data);
						if (data == "delete")
						{
							tr.remove();
						}
						else
							td.addClass('deletion');
					}
				});
		});
	});
</script>