<?php
//echo $cat1;
//session_start();
$cat1 = empty($cat1) ? 1 : intval($cat1);

switch($cat2)
{
case "id":
case "user_ip":
case "user_id":
	$users_order = $cat2;break;
default:
	$users_order = "id";
}
?>
<table class="none" id="users_like" style="position:relative;border-spacing:0px;">
	<tr>
		<th colspan="13" align="left">
			<a <?php if($mode == "users") echo 'style="color:lightblue;"'; ?> href="/admin/users/1/registered"><?php echo al("lietotaji"); ?></a>
			/ 
			<a <?php if($mode == "usersip") echo 'style="color:lightblue;"'; ?> href="/admin/usersip"><?php echo al("ip_adreses"); ?></a>
		</th>
	</tr>
	<tr>
		<th><a href="/admin/usersip/<?php echo $cat1; ?>/id">ID</a></th>
		<th><a href="/admin/usersip/<?php echo $cat1; ?>/user_ip">IP</a></th>
		<th><a href="/admin/usersip/<?php echo $cat1; ?>/user_id"><?php echo al("vards"); ?> <?php echo al("uzvards"); ?></a></th>
	</tr>		
</table>
<script type="text/javascript">
usersip_like($("#user_like").val(),<?php echo !empty($cat1) ? $cat1 : 1; ?>,'<?php echo $users_order; ?>');
</script>
