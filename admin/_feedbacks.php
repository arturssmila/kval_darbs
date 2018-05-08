<?php
if(!empty($_POST))
{
	$id = !empty($_POST["id"]) ? $_POST["id"] : die();
	$action = !empty($_POST["action"]) ? $_POST["action"] : die();
	require('../config.php');
	switch($action)
	{
		case "activate":
			mysql_query("UPDATE ".PREFIX."meta SET hide_link = '' WHERE id = '$id'");
			echo $action;
			break;
		case "deactivate":
			mysql_query("UPDATE ".PREFIX."meta SET hide_link = '1' WHERE id = '$id'");
			echo $action;
			break;
		case "delete":
			mysql_query("UPDATE ".PREFIX."meta SET parent_id = '-2' WHERE id = '$id'");
			echo $action;
			break;
		default:
			die();
	}
	set_meta_row($id);
	exit();
}
if(meta("S",array("template"=>"feedback","orderby"=>"date DESC"),$all_feedbacks))
{
	foreach($all_feedbacks as $key => $val)
	{
		get_user("S",array("id"=>$val["creator_id"]),$all_feedbacks[$key]["user"]);
	}
}
?>
<style>
	.feedbacks tr.activated,
	.feedbacks tr.activated a {
		color:green;
	}
	.feedbacks tr.deactivated,
	.feedbacks tr.deactivated a {
		color:red;
	}
	.feedbacks tr .activate,
	.feedbacks tr .deactivate {
		display:none;
	}
	.feedbacks button.delete {
		display:none;
	}
	.feedbacks .deletion button.delete {
		display:inline-block;
	}
	
	.feedbacks .loading_image {
		display:inline-block;
	}
	.feedbacks .deletion .loading_image {
		display:none;
	}
	.feedbacks tr.deleted .deletion .loading_image {
		display:none;
	}
	.feedbacks tr.deleted .loading_image {
		display:none;
	}
	
	.feedbacks tr.activated .deactivate {
		display:inline-block;
	}
	.feedbacks tr.deactivated .activate {
		display:inline-block;
	}
	.feedbacks tr.deleted {
		text-decoration:line-through;
	}
	.feedbacks .actions button,
	.feedbacks button.delete,
	.feedbacks .loading_image {
		vertical-align:top;
	}
	.feedbacks .actions button,
	.feedbacks button.delete,
	.feedbacks .loading_image {
		margin:-2px auto;
	}
	.feedbacks .loading_image {
		display:inline-block;
		height:20px;
	}
	.feedbacks .activated .actions .loading_image,
	.feedbacks .deactivated .actions .loading_image {
		display:none;
	}
</style>
<table class="feedbacks">
	<tr>
		<th align="left"><?php echo al("feedbacks"); ?></th>
	</tr>
</table>
<table class="feedbacks">
	<tr>
		<th>ID</th>
		<th><?php echo al("datums"); ?></th>
		<th><?php echo al("user"); ?></th>
		<th><?php echo al("feedback"); ?></th>
		<?php if(!empty($settings["feedback_approoving"])) { ?>
			<th><?php echo al("feedback_approve_decline"); ?></th>
		<?php } ?>
		<th><?php echo al("dzest"); ?></th>
	</tr>	
<?php
if(!empty($all_feedbacks))
{
	foreach($all_feedbacks as $key => $val)
	{
		?>
		<tr class="<?php
				if($key % 2 == 0) echo " sec_tr";
				if(!empty($settings["feedback_approoving"]))
				{
					if(!empty($val["hide_link"]))
						echo ' deactivated ';
					else
						echo ' activated ';
				}
			?>">
			<td align="right"><a href="/admin/tree/<?php echo $val["id"]; ?>"><?php echo $val["id"]; ?></a></td>
			<td align="right" nowrap><a href="/admin/tree/<?php echo $val["id"]; ?>"><?php echo $val["date"]; ?></a></td>
			<td align="left" nowrap>
				<?php 
					$soc = ' <a href="';
					switch($val["user"][0]["soc"])
					{
					case "00":$soc.= '/admin/user/'.$val["user"][0]["id"].'" target="_blank"';break;
					case "FB":$soc.= 'http://www.facebook.com/profile.php?id='.$val["user"][0]["soc_id"].'" target="_blank"';break;
					case "DR":$soc.= 'http://www.draugiem.lv/user/'.$val["user"][0]["soc_id"].'" target="_blank"';break;
					case "GO":$soc.= 'https://plus.google.com/u/0/'.$val["user"][0]["soc_id"].'" target="_blank"';break;
					case "TW":$soc.= 'https://twitter.com/account/redirect_by_id?id='.$val["user"][0]["soc_id"].'" target="_blank"';break;
					}
					$soc.= '><img style="margin:-2px 0px;" src="/cms/css/images/';
					switch($val["user"][0]["soc"])
					{
					case "00":$soc.= '00.png" title="';break;
					case "FB":$soc.= 'fbi.png" title="Facebook';break;
					case "DR":$soc.= 'dri.png" title="Draugiem';break;
					case "GO":$soc.= 'goi.png" title="Google';break;
					case "TW":$soc.= 'twi.png" title="Twitter';break;
					}
					$soc.= '" /></a>';
					echo $soc;
				?>
				<a href="/admin/user/<?php echo $val["user"][0]["id"]; ?>"><?php echo $val["user"][0]["name"].' '.$val["user"][0]["surname"]; ?></a>
			</td>
			<td><?php echo strip_tags($val["content"]); ?></td>
			<?php if(!empty($settings["feedback_approoving"])) { ?>
			<td align="center" class="top actions">
				<button rel="<?php echo $val["id"]; ?>" type="save" class="activate"><?php echo al("feedback_approve"); ?></button>
				<button rel="<?php echo $val["id"]; ?>" type="delete" class="deactivate"><?php echo al("feedback_deactivate"); ?></button>
				<img class="loading_image" src="/cms/css/images/loading.gif" />
			</td>
			<?php } ?>
			<td align="center" class="top deletion">
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
		$('.feedbacks .actions .activate, .feedbacks .actions .deactivate').click(function(){
			var id = Number($(this).attr('rel'));
			var action = $(this).hasClass('activate') ? 'activate' : 'deactivate';
			var tr = $(this).parents('tr');
			tr.removeClass('deactivated').removeClass('activated');
			$.ajax({
				type: "POST",
				url: "/admin/_feedbacks.php",
				data:
				{
					id:	id,
					action:	action
				},
				async: true,
				success: function(data)
					{
						//alert(data);
						if (data == "activate")
						{
							tr.addClass('activated');
						}
						else if (data == "deactivate")
						{
							tr.addClass('deactivated');
						}
						else
							tr.addClass((action=="activate")?'deactivated':'activated');
					}
				});
		});
		$('.feedbacks .deletion .delete').click(function(){
			var id = Number($(this).attr('rel'));
			var action = 'delete';
			var tr = $(this).parents('tr');
			var td = $(this).parents('td');
			td.removeClass('deletion');
			$.ajax({
				type: "POST",
				url: "/admin/_feedbacks.php",
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
							tr.addClass('deleted').removeClass('deactivated').removeClass('activated');
						}
						else
							td.addClass('deletion');
					}
				});
		});
	});
</script>