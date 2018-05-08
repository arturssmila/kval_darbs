<?php
if(!empty($_POST))
{
	require('../config.php');
	include("../cms/libs/passwordcheck.inc");
	if (!$admin) 
	{
		echo '
			<script type="text/javascript">
				location.reload(true);
			</script>
		';
		exit();
	}
	
	$action = !empty($_POST["action"]) ? $_POST["action"] : die();
	
	switch($action)
	{
		case "regenerate":
			foreach($languages as $key => $val)
			{
				//nomet veco tabulu
				mysql_query(" DROP TABLE IF EXISTS `".PREFIX."work_table_".$val["id"]."` ");
				//izveidojam tabulu
				mysql_query(" CREATE TABLE IF NOT EXISTS `".PREFIX."work_table_".$val["id"]."` LIKE `".PREFIX."meta` ");
				//pievienojam lauciņus
				mysql_query(" ALTER TABLE `".PREFIX."work_table_".$val["id"]."` ADD `template` varchar(30) DEFAULT NULL AFTER `template_id` ");
				if(function_exists("regenerate_meta_plus"))
				{
					regenerate_meta_plus($val["id"]);
				}
			}
			//sadabū meta ierakstu skaitu
			$query = "SELECT `id` FROM `".PREFIX."meta` ORDER BY `id` ASC";
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
			break;
		case "insert_by_one":
			//
			$id = !empty($_POST["id"]) ? $_POST["id"] : die();
			//echo $id;
			set_meta_row($id);
			break;
		default:
			die();
	}
	exit();
}
//END POST
/*******************************************************************************/

	$is_work_tables = false;
	$query = "SHOW TABLES LIKE '".PREFIX."work_table_%'";
	$res = mysql_query($query);
	if(mysql_num_rows($res) > 0)
	{
		$is_work_tables = true;
	}
?>
<table>
	<tr>
		<th><?php echo al("work_table"); ?></th>
	</tr>
</table>

	<div id="work_table_progresbar"></div>
	<button
		id="update_work_table"
		onclick="update_work_table();"
		type="<?php
			echo ($is_work_tables) ? 'update' : 'create';
		?>"
		><?php
			echo ($is_work_tables) ? al("update_work_table") : al("create_work_table");
		?></button>
<?php

?>
<script>
	var ids;
	var id_ind = 0;
	var wt_start_time = 0;
	function update_work_table()
	{
		$('#update_work_table').hide();
		$.ajax({
			type: "POST",
			url: "/admin/_work_table.php",
			data:
			{
				action:	"regenerate"
			},
			async: true,
			success: function(data)
				{
					//alert(data);
					if(data!="")
					{
						ids = data.split('#');
						id_ind = 0;
						wt_start_time = new Date().getTime();
						insert_by_one();
					}
				}
			});
	}
	function insert_by_one()
	{
		//alert(ids);
		var update_id = Number(ids[id_ind]);
		id_ind++;
		var wt_time_now = new Date().getTime()
		var wt_left_all_sec = (( ( (wt_time_now-wt_start_time) / id_ind) * ids.length) - (wt_time_now-wt_start_time));
		
		var wt_left_secs = Math.floor( (wt_left_all_sec/1000) % 60 );
		var wt_left_mins = Math.floor( (wt_left_all_sec/1000/60) % 60 );
		var wt_left_hours = Math.floor( (wt_left_all_sec/(1000*60*60)) % 24 );
		var wt_left_days = Math.floor( wt_left_all_sec/(1000*60*60*24) );
  
		$('#work_table_progresbar').html(
						((id_ind/ids.length)*100).toFixed() + '%' +
						' Time remaining: ' +
							((wt_left_days>0) ? (wt_left_days + ' days ') : '') + 
							((wt_left_hours>0) ? (wt_left_hours + ' h ') : '') + 
							((wt_left_mins>0) ? (wt_left_mins + ' min ') : '') + 
							wt_left_secs + ' sec '
						);
		
		$.ajax({
			type: "POST",
			url: "/admin/_work_table.php",
			data:
			{
				id:update_id,
				action:	"insert_by_one"
			},
			async: true,
			success: function(resp)
				{
					if(resp!='')
						console.log(resp);
					if(id_ind < ids.length)
					{
						insert_by_one();
					}
					else
					{
						$('#update_work_table').attr('type','update');
						$('#update_work_table').text('<?php echo al("update_work_table"); ?>');
						$('#update_work_table').show();
					}
				}
			});
	}
</script>