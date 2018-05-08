<?php
if(!empty($_POST))
{
	require('../config.php');
	//Tikko uzģenerējas tukša users_table, nevar autorizēt pašu un izlogojas, tāpēc šeit aizkomentēts
	/*include("../cms/libs/passwordcheck.inc");
	if (!$admin) 
	{
		echo '
			<script type="text/javascript">
				location.reload(true);
			</script>
		';
		exit();
	}
	*/
	$action = !empty($_POST["action"]) ? $_POST["action"] : die();
	
	switch($action)
	{
		case "regenerate":
			foreach($languages as $key => $val)
			{
				//nomet veco tabulu
				mysql_query(" DROP TABLE IF EXISTS ".PREFIX."users_table_".$val["id"]." ");
				//izveidojam tabulu
				mysql_query(" CREATE TABLE IF NOT EXISTS ".PREFIX."users_table_".$val["id"]." LIKE ".PREFIX."users ");
				//pievienojam lauciņus
				mysql_query(" ALTER TABLE `".PREFIX."users_table_".$val["id"]."` ADD `admin_type` TEXT NULL ");
				mysql_query(" ALTER TABLE `".PREFIX."users_table_".$val["id"]."` ADD `user_modes` LONGTEXT NULL ");
				mysql_query(" ALTER TABLE `".PREFIX."users_table_".$val["id"]."` ADD `linked_users` TEXT NULL ");
				$query = " SELECT `name` FROM `".PREFIX."users_data` GROUP BY `name` ";
				$res = mysql_query($query);
				if(mysql_num_rows($res) > 0)
				{
					while($row = mysql_fetch_assoc($res))
					{
						mysql_query(" ALTER TABLE `".PREFIX."users_table_".$val["id"]."` ADD `".$row["name"]."` TEXT NULL ");
					}
				}
			}
			//sadabū meta ierakstu skaitu
			$query = "SELECT `id` FROM `".PREFIX."users` ORDER BY `id` ASC";
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
			set_users_row($id);
			//echo 'OK';
			break;
		default:
			die();
	}
	exit();
}
//END POST
/*******************************************************************************/

	$is_users_tables = false;
	$query = "SHOW TABLES LIKE '".PREFIX."users_table_%'";
	$res = mysql_query($query);
	if(mysql_num_rows($res) > 0)
	{
		$is_users_tables = true;
	}
?>
<table>
	<tr>
		<th><?php echo al("users_table"); ?></th>
	</tr>
</table>

	<div id="users_table_progresbar"></div>
	<button
		id="update_users_table"
		onclick="update_users_table();"
		type="<?php
			echo ($is_users_tables) ? 'update' : 'create';
		?>"
		><?php
			echo ($is_users_tables) ? al("update_users_table") : al("create_users_table");
		?></button>
<?php

?>
<script>
	var ids;
	var id_ind = 0;
	var wt_start_time = 0;
	function update_users_table()
	{
		$('#update_users_table').hide();
		$.ajax({
			type: "POST",
			url: "/admin/_users_table.php",
			data:
			{
				action:	"regenerate"
			},
			async: true,
			success: function(data)
				{
					//console.log(data);
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
  
		$('#users_table_progresbar').html(
						((id_ind/ids.length)*100).toFixed() + '%' +
						' Time remaining: ' +
							((wt_left_days>0) ? (wt_left_days + ' days ') : '') + 
							((wt_left_hours>0) ? (wt_left_hours + ' h ') : '') + 
							((wt_left_mins>0) ? (wt_left_mins + ' min ') : '') + 
							wt_left_secs + ' sec '
						);
		
		$.ajax({
			type: "POST",
			url: "/admin/_users_table.php",
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
						$('#update_users_table').attr('type','update');
						$('#update_users_table').text('<?php echo al("update_users_table"); ?>');
						$('#update_users_table').show();
					}
				}
			});
	}
</script>