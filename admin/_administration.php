<?php
if(!empty($_POST))
{
	$action = !empty($_POST["action"]) ? $_POST["action"] : die();	
	$mode = !empty($_POST["mode"]) ? $_POST["mode"] : die();
	require('../config.php');
	
	switch($action)
	{
		case "attr":
			$attr = !empty($_POST["attr"]) ? $_POST["attr"] : die();
			$query = " SELECT `value` FROM `".PREFIX."modes_attributes` WHERE `mode` = '$mode' AND `attr` = '$attr' ";
			$res = mysql_query($query);
			if(mysql_num_rows($res) > 0)
			{
				$row = mysql_fetch_assoc($res);
				$value = !empty($row["value"]) ? 0 : 1;
			}
			else
			{
				$value = 1;
			}
			mysql_query(" DELETE FROM `".PREFIX."modes_attributes` WHERE `mode` = '$mode' AND `attr` = '$attr' ");
			mysql_query(" INSERT INTO `".PREFIX."modes_attributes` SET `mode` = '$mode', `attr` = '$attr', `value` = '$value' ");
			echo (empty($value) ? 'OFF' : 'ON');
			break;
		case "user_type":
			$type_id = !empty($_POST["type_id"]) ? $_POST["type_id"] : die();
			$query = " SELECT `permissions` FROM `".PREFIX."user_types` WHERE `id` = '$type_id' ";
			$res = mysql_query($query);
			if(mysql_num_rows($res) > 0)
			{
				$row = mysql_fetch_assoc($res);
				$permissions = !empty($row["permissions"]) ? explode("#",$row["permissions"]) : array();
				if(in_array($mode,$permissions))
				{
					//izņemt mode
					foreach($permissions as $key => $val)
					{
						if($val==$mode)
						{
							unset($permissions[$key]);
						}
					}
					echo 'OFF';
				}
				else
				{
					//pieliek mode
					$permissions[] = $mode;
					echo 'ON';
				}
				$permissions = implode("#",$permissions);
				$query = " UPDATE `".PREFIX."user_types` SET `permissions` = '$permissions' WHERE `id` = '$type_id' ";
				mysql_query($query);
			}
			break;
	}			
	exit();
}
$user_types = array();

$query = " SELECT * FROM `".PREFIX."user_types` ORDER BY `id` ASC ";
$res = mysql_query($query);
if(mysql_num_rows($res) > 0)
{
	while($row = mysql_fetch_assoc($res))
	{
		//if($row["type"]!="super_admin")
		$row["permissions"] = !empty($row["permissions"]) ? explode("#",$row["permissions"]) : array();
		$user_types[] = $row;
	}
}
//out($user);	

?>
<style>
	.user_types_table {
		
	}
	.user_types_table .checkbox_td,
	.user_types_table .deletion {
		text-align:center;
	}
	.user_types_table .checkbox_td input[type="checkbox"] {
		display:block;
		height:20px;
		width:100%;
		
	}
	.user_types_table .checkbox_td.loading input[type="checkbox"] {
		display:none;
	}
	.user_types_table .checkbox_td .loading_image,
	.user_types_table .deletion .loading_image {
		display:none;
		max-height:20px;
		vertical-align:middle;
	}
	.user_types_table .checkbox_td.loading .loading_image,
	.user_types_table .deletion.loading .loading_image {
		display:inline-block;
	}
</style>
<table>
	<tr>
		<th align="left"><?php echo al("administration"); ?></th>
	</tr>
</table>
<table class="user_types_table">
<?php
//out($modes);
if(!empty($user_types) && !empty($modes))
{
	?>
		<tr >
			<th nowrap align="right"><?php /*echo al("user_type");*/ ?></th>
			<th align="center"><?php echo al("tree"); ?></th>
			<th align="center">&nbsp;</th>
			<?php
			foreach($user_types as $key => $val)
			{
				?>
				<th align="center"><?php echo al($val["type"]); ?></th>
				<?php
			}
			?>
		</tr>
		<?php
		foreach($modes as $m_key => $m_val)
		{
			?>
			<tr class="sec_tr">
				<th align="right"><?php echo al($m_key); ?></th>
				<td
					class="checkbox_td attr"
					attr="tree"
					mode="<?php echo $m_key; ?>"
					>						
					<input type="checkbox" value="1"
					<?php
						if(!empty($m_val["tree"]))
						{
							echo 'checked';
						}
					?>
					/>
					<img class="loading_image" src="/cms/css/images/loading.gif" />
				</td>
				<td></td>
				<?php
				foreach($user_types as $key => $val)
				{
					?>
					<td
						class="checkbox_td user_type"
						type_id="<?php echo $val["id"]; ?>"
						mode="<?php echo $m_key; ?>"
						>						
						<input type="checkbox" value="1"
						<?php
							if(($val["type"]=="super_admin") || (in_array("all",$m_val["user_types"])))
							{
								echo 'checked disabled';
							}
							elseif(in_array($m_key,$val["permissions"]))
							{
								echo 'checked';
							}
						?>
						/>
						<img class="loading_image" src="/cms/css/images/loading.gif" />
					</td>
					<?php
				}
				?>
			</tr>
			<?php
		}
		?>
	<?php
}
?>	
</table>
<script type="text/javascript">
	$(document).ready(function()
	{
		$('.checkbox_td.attr input[type="checkbox"]').click(function(){
			var checkbox_td = $(this).parents('.checkbox_td');
			var attr = checkbox_td.attr('attr');
			var mode = checkbox_td.attr('mode');
			checkbox_td.addClass('loading');
			
			$.ajax({
				type: "POST",
				url: "/admin/_administration.php",
				data:
				{
					action:"attr",
					attr:	attr,
					mode:	mode
				},
				async: true,
				success: function(data)
					{
						switch(data)
						{
							case "ON":
								$('input[type="checkbox"]',checkbox_td).prop('checked',true);
								break;
							case "OFF":
								$('input[type="checkbox"]',checkbox_td).prop('checked',false);
								break;
							default:
								alert(data);
						}
						checkbox_td.removeClass('loading');
					}
				});
		});
		
		$('.checkbox_td.user_type input[type="checkbox"]').click(function(){
			var checkbox_td = $(this).parents('.checkbox_td');
			var type_id = checkbox_td.attr('type_id');
			var mode = checkbox_td.attr('mode');
			checkbox_td.addClass('loading');
			
			$.ajax({
				type: "POST",
				url: "/admin/_administration.php",
				data:
				{
					action:"user_type",
					type_id:type_id,
					mode:	mode
				},
				async: true,
				success: function(data)
					{
						switch(data)
						{
							case "ON":
								$('input[type="checkbox"]',checkbox_td).prop('checked',true);
								break;
							case "OFF":
								$('input[type="checkbox"]',checkbox_td).prop('checked',false);
								break;
							default:
								alert(data);
						}
						checkbox_td.removeClass('loading');
					}
				});
		});
	});
</script>