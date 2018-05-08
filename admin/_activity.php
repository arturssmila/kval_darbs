<?php
//echo $cat1;
//session_start();
//out($languages_keys);
$actions_like = !empty($_SESSION["actions_like"]) ? $_SESSION["actions_like"] : "0";
?>
<table class="none" id="actions_like" style="position:relative;border-spacing:0px;">
	<tr>
		<th colspan="3" align="left">
			<a <?php if($mode == "activity") echo 'style="color:lightblue;"'; ?> href="/admin/activity"><?php echo al("aktivitates"); ?></a>
			/ 
			<a <?php if($mode == "activity_data") echo 'style="color:lightblue;"'; ?> href="/admin/activity_data"><?php echo al("aktivitasu_dati"); ?></a>
		</th>
		<td align="right"><?php echo al("manas_aktivitates"); ?>: 
				<input id="actions_like" type="checkbox" 
					<?php echo ($actions_like) ? "checked" : ""; ?>
					onchange="actions_like(($(this).is(':checked') ? 1 : 0),1);"
					value="1" />
		</td>
	</tr>
	<tr class="actions">
		<th>ID</th>
		<th><span style="float:left;"> <?php echo al("datums"); ?></span><span style="float:right;"><?php echo al("laiks"); ?> </span></th>
		<th><?php echo al("lietotajs"); ?></th>
		<th><?php echo al("darbiba"); ?></th>
	</tr>		
</table>
<script type="text/javascript">
actions_like(<?php echo $actions_like; ?>,<?php echo $cat1 ? $cat1 : 1; ?>);
</script>
