<?php
if(!empty($_POST))
{
	$id = !empty($_POST["id"]) ? $_POST["id"] : die();
	$action = !empty($_POST["action"]) ? $_POST["action"] : die();
	require('../config.php');
	switch($action)
	{
		case "delete":
			mysql_query("DELETE FROM `".PREFIX."subscribers` WHERE id = '$id'");
			echo $action;
			break;
		default:
			die();
	}
	exit();
}
$subscribers = array();
$queryx = "SHOW TABLES LIKE '".PREFIX."subscribers' ";
$resx = mysql_query($queryx);
if(mysql_num_rows($resx) > 0)
{
	$query = " SELECT * FROM `".PREFIX."subscribers` ORDER BY id DESC ";
	$res = mysql_query($query);
	if(mysql_num_rows($res) > 0)
	{
		while($row = mysql_fetch_assoc($res))
		{
			$subscribers[] = $row;
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
		<th align="left"><?php echo al($mode); ?></th>
	</tr>
</table>
<table class="form_data_table">
	<tr>
		<th>ID</th>
		<th><?php echo al("datums"); ?></th>
		<th><?php echo al("e_pasts"); ?></th>
		<th><?php echo al("dzest"); ?></th>
	</tr>	
<?php
if(!empty($subscribers))
{
	foreach($subscribers as $key => $val)
	{
		?>
		<tr class="sec_tr" rel="<?php echo $val["id"]; ?>">
			<td align="right"><?php echo $val["id"]; ?></td>
			<td align="right" nowrap><?php echo $val["date"]; ?></td>
			<td align="left" nowrap><?php echo $val["sender_email"]; ?></td>
			<td align="center" class="deletion">
				<button rel="<?php echo $val["id"]; ?>" type="delete" class="delete"><?php echo al("dzest"); ?></button>
				<img class="loading_image" src="/cms/css/images/loading.gif" />
			</td>
		</tr>
		<?php
	}
}
?>	
</table>
<script type="text/javascript">
	$(document).ready(function()
	{
		$('.form_data_table .deletion .delete').click(function(){
			var id = Number($(this).attr('rel'));
			var action = 'delete';
			var tr = $('.form_data_table tr[rel="'+id+'"]');
			var td = $(this).parents('.form_data_table tr td');
			td.removeClass('deletion');
			$.ajax({
				type: "POST",
				url: "/admin/_subscribers.php",
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