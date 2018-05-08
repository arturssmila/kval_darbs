<?php

$_SESSION["activity_data_date_from"]	= !empty($_SESSION["activity_data_date_from"])	? $_SESSION["activity_data_date_from"]	: date('Y-m-d');
$_SESSION["activity_data_date_to"]	= !empty($_SESSION["activity_data_date_to"])	? $_SESSION["activity_data_date_to"]	: date('Y-m-d');
$_SESSION["activity_data_meta_id"]	= !empty($_SESSION["activity_data_meta_id"])	? $_SESSION["activity_data_meta_id"]	: 0;


	get_fields($fields, $field_names, $fields_ids);
	$backup = array();
	$query = "SELECT ".
			"* ".
		"FROM ".PREFIX."backup ".
		"WHERE  ".
			"YEAR(backup_date) >= YEAR('".$_SESSION["activity_data_date_from"]."') ". 
			"AND ". 
			"YEAR(backup_date) <= YEAR('".$_SESSION["activity_data_date_to"]."') ". 
			"AND ". 
			"MONTH(backup_date) >= MONTH('".$_SESSION["activity_data_date_from"]."') ". 
			"AND ". 
			"MONTH(backup_date) <= MONTH('".$_SESSION["activity_data_date_to"]."') ". 
			"AND ". 
			"DAY(backup_date) >= DAY('".$_SESSION["activity_data_date_from"]."') ". 
			"AND ". 
			"DAY(backup_date) <= DAY('".$_SESSION["activity_data_date_to"]."') ". 
			(!empty($_SESSION["activity_data_meta_id"]) ? (" AND `meta_id` = '".$_SESSION["activity_data_meta_id"]."' ") : "").
		"ORDER BY backup_date DESC";
	//die($query);
	$rRes = mysql_query($query) or die(mysql_error().$query);
	if(mysql_num_rows($rRes) > 0)
	{
		while($row = mysql_fetch_assoc($rRes))
		{
			if (empty($row["id"])) break;
			$row["user"] = get_user("S",array("id"=>$row["user_id"]),$tmp_user[$row["id"]]) ? $tmp_user[$row["id"]][0] : array();
			$data[$row["id"]] = @unserialize(base64_decode($row["data"]));
			if(empty($data[$row["id"]]))
			{
				$data[$row["id"]] = @unserialize($row["data"]);
				if(empty($data[$row["id"]]))
				{
					$data[$row["id"]] = array();
				}
			}
			$row["data"] = $data[$row["id"]];
			$row["meta"] = array_shift($row["data"]);
			$backup[] = $row;
		}
	}
	
	$options = array();
	$query2 = "SELECT 
			#YEAR(`backup_date`) AS year, 
			#MONTH(`backup_date`) AS month, 
			#DAY(`backup_date`) AS day,
			LEFT(`backup_date`, 10) AS ymd
		FROM `".PREFIX."backup` 
		GROUP BY ymd 
		ORDER BY `backup_date` DESC";
	//out($query2);
	$res2 = mysql_query($query2) or die(mysql_error().$query2);
	if(mysql_num_rows($res2) > 0)
	{
		while($row2 = mysql_fetch_assoc($res2))
		{
			$options[] = $row2["ymd"];
		}
	}
	
	$meta_ids = array();
	$query3 = "SELECT 
			`meta_id`
		FROM `".PREFIX."backup` 
		GROUP BY `meta_id` 
		ORDER BY `meta_id` ASC";
	//out($query3);
	$res3 = mysql_query($query3) or die(mysql_error().$query3);
	if(mysql_num_rows($res3) > 0)
	{
		while($row3 = mysql_fetch_assoc($res3))
		{
			$meta_ids[] = $row3["meta_id"];
		}
	}
	//out($meta_ids);
?>
<table class="none" id="lang_table" style="position:relative;border-spacing:0px;" border="0">
	<tr>
		<th colspan="4" align="left">
			<a <?php if($mode == "activity") echo 'style="color:lightblue;"'; ?> href="/admin/activity"><?php echo al("aktivitates"); ?></a>
			/ 
			<a <?php if($mode == "activity_data") echo 'style="color:lightblue;"'; ?> href="/admin/activity_data"><?php echo al("aktivitasu_dati"); ?></a>
		</th>
	</tr>
	<tr>
		<th colspan="4" align="left">
			<?php echo al("no"); ?>
			<select id="set_activity_data_date_from">
				<?php
				foreach($options as $key => $val)
				{
					echo '<option value="'.$val.'" '.(($val==$_SESSION["activity_data_date_from"])?'selected':'').'>'.$val.'</option>';
				}
				?>
				
			</select>
			<?php echo al("lidz"); ?>
			<select id="set_activity_data_date_to">
				<?php
				foreach($options as $key => $val)
				{
					echo '<option value="'.$val.'" '.(($val==$_SESSION["activity_data_date_to"])?'selected':'').'>'.$val.'</option>';
				}
				?>
				
			</select>
			<?php echo al("ID"); ?>
			<select id="set_activity_data_meta_id">
				<?php
				echo '<option value="0">'.al("all").'</option>';
				foreach($meta_ids as $key => $val)
				{
					echo '<option value="'.$val.'" '.(($val==$_SESSION["activity_data_meta_id"])?'selected':'').'>'.$val.'</option>';
				}
				?>
				
			</select>
			<button onclick="
					set_activity_data_date(
								$('#set_activity_data_date_from').val(),
								$('#set_activity_data_date_to').val(),
								$('#set_activity_data_meta_id').val()
								);
					"><?php echo al("atlasit"); ?></button>
		</th>
	</tr>
	<tr>
		<th>ID</th>
		<th><?php echo al("lietotajs"); ?></th>
		<th><?php echo al("aktivitasu_dati"); ?></th>
		<th><?php echo al("datums"); ?></th>
	</tr>		
<?php
	foreach($backup as $key => $val)
	{
?>
	<tr id="rev_<?php echo $val["id"]; ?>">
		<td style="vertical-align:top;"><?php echo $val["id"]; ?></td>
		<td style="vertical-align:top;" nowrap><a href="/admin/user/<?php echo $val["user_id"]; ?>"><?php echo $val["user"]["name"].' '.$val["user"]["surname"]; ?></a></td>
		<td style="vertical-align:top;">
			<?php
			if(!empty($val["meta"]))
			{
				echo '<table>';
				foreach($val["meta"] as $key2 => $val2)
				{
					echo '<tr><th align="right">'.al($key2).'</th><td>'.$val2.'</td></tr>';
				}
				echo '</table>';
			}
			?>
			<table>
			<?php
				foreach($val["data"] as $key2 => $val2)
				{
					echo '<tr>
						<td style="text-align:right;vertical-align:top;">'.(!empty($languages_keys[$val2["language_id"]]["name"])?$languages_keys[$val2["language_id"]]["name"]:$val2["language_id"]).'</td>
						<td style="text-align:right;vertical-align:top;" nowrap>'.(!empty($field_names[$val2["field_id"]])?al($field_names[$val2["field_id"]]):$val2["field_id"]).'</td>
						<td style="text-align:left;vertical-align:top;"><div>'.htmlspecialchars($val2["field_content"]).'</div></td></tr>';
				}
			?>
			</table>
		</td>
		<td style="vertical-align:top;" nowrap><?php echo $val["backup_date"]; ?></td>
	</tr>
<?php
	}
?>
</table>
