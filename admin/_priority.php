<?php
//echo $cat1;
//session_start();

?>
<table class="none" id="users_like" style="position:relative;border-spacing:0px;">
	<tr>
		<th colspan="3" align="left">Sadaļu prioritātes</th>
	</tr>
	<tr>
		<th>ID</th>
		<th>Prioritāte</th>
		<th>Nosaukums</th>
	</tr>	
<?php
if(meta("S",array("where"=>"parent_id>-2","orderby"=>"priority DESC"),$priority))
{
	foreach($priority as $key => $val)
	{
		?>
		<tr class="<?php if($key % 2 == 0) echo " sec_tr"; ?>">
			<td align="right"><?php echo $val["id"]; ?></td>
			<td align="center"><?php echo $val["priority"]; ?></td>
			<td><a href="/admin/tree/<?php echo $val["id"]; ?>"><?php echo $val["name"]; ?></a></td>
		</tr>	
		<?php
	}
}
?>	
</table>
