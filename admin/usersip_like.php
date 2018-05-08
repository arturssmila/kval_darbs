<?php
require('../config.php');
//passwordcheck
include("../cms/libs/passwordcheck.inc");
if (!$admin) 
{
	//header("Location: /admin/login.php");
	echo '
		<script type="text/javascript">
			location.reload(true);
		</script>
	';
	exit();
}

$admin_lang = $user[0]["admin_language"];
require_once('../admin/admin_language.php');

$users = '';
$users2 = '';
$limit = 30;
$page = !empty($_POST["page"]) ? ($_POST["page"]-1) : 0;
$limit1 = $page * $limit;
$users_order = !empty($_POST["order"]) ? $_POST["order"] : "id";
switch($users_order)
{/*
case "last_seen":
case "registered":
	$ordered = $users_order." DESC";break;
	*/
default:
	$ordered = "ui.$users_order ASC";
}
$lim = "LIMIT $limit1, $limit";
$query = "SELECT ".
			"ui.*, ".
			"u.soc, ".
			"u.name, ".
			"u.surname, ".
			"u.active ".
			
		"FROM ".PREFIX."users_ip AS ui ".
		"LEFT JOIN ".PREFIX."users AS u ON ui.user_id = u.id ".
		"ORDER BY $ordered ";
$rRes = mysql_query($query.$lim) or die(mysql_error().$query);
			
if(mysql_num_rows($rRes) > 0)
{
	while($row = mysql_fetch_assoc($rRes))
	{
		if (empty($row["id"])) break;
		$users[] = $row;
	}
}

$rRes = mysql_query($query) or die(mysql_error().$query);
if(mysql_num_rows($rRes) > 0)
{
	while($row = mysql_fetch_assoc($rRes))
	{
		if (empty($row["id"])) break;
		$users2[] = $row;
	}
}
$pages = floor(count($users2)/$limit)+((count($users2)%$limit)? 1 : 0);
if ($users)
{
	$ind = 0;
	foreach($users as $key=>$val)
	{
		$ind++;
		?>
		<tr class="users_like<?php if($ind % 2 == 0) echo " sec_tr"; ?><?php if(empty($val["active"])) echo " inactive"; ?>" onclick="javascript:window.location = '/admin/user/<?php echo $val["user_id"]?>';">
			<td align="right"><?php echo $val["id"]; ?></td>
			<td align="right"><?php echo (((isset($users[$key-1])&&($users[$key-1]["user_ip"]==$val["user_ip"]))||(isset($users[$key+1])&&($users[$key+1]["user_ip"]==$val["user_ip"]))) ? '<span class="red">':'').
							$val["user_ip"].
							(((isset($users[$key-1])&&($users[$key-1]["user_ip"]==$val["user_ip"]))||(isset($users[$key+1])&&($users[$key+1]["user_ip"]==$val["user_ip"]))) ? '</span>':''); ?></td>
			<td align="left" valign="middle"><?php 
			$soc[$key] = '<img style="margin:-2px 0px;" src="/cms/css/images/';
			switch($val["soc"])
			{
			case "00":$soc[$key].= '00.png" title="';break;
			case "FB":$soc[$key].= 'fbi.png" title="Facebook';break;
			case "DR":$soc[$key].= 'dri.png" title="Draugiem';break;
			case "GO":$soc[$key].= 'goi.png" title="Google';break;
			case "TW":$soc[$key].= 'twi.png" title="Twitter';break;
			}
			$soc[$key].= '" />';
			echo $soc[$key]; ?> <?php echo (((isset($users[$key-1])&&(($users[$key-1]["name"].' '.$users[$key-1]["surname"])==($val["name"].' '.$val["surname"])))||(isset($users[$key+1])&&(($users[$key+1]["name"].' '.$users[$key+1]["surname"])==($val["name"].' '.$val["surname"])))) ? '<span class="red">':'').
							$val["name"].' '.$val["surname"].
							(((isset($users[$key-1])&&(($users[$key-1]["name"].' '.$users[$key-1]["surname"])==($val["name"].' '.$val["surname"])))||(isset($users[$key+1])&&(($users[$key+1]["name"].' '.$users[$key+1]["surname"])==($val["name"].' '.$val["surname"])))) ? '</span">':''); ?></td>
		</tr>
		<?php
	}
	?>
	<tr class="users_like_pages">
		<td colspan="13">
		<?php 
		if($pages>1)
		{
			echo '<div class="pages none">';
			for ($i = 1; $i <= $pages; $i++) 
			{
				echo '<a'.(($i==($page+1))?' class="active" ':' href="/admin/usersip/').$i.'/'.$users_order.'">'.$i.'</a> ';
			}
			echo '</div>';
		}
		?>
		</td>
	</tr> 
	<?php
}
else
{
	?>
	<tr class="users_like">
		<td colspan="13"><?php echo al("nekas_netika_atrasts"); ?></td>
	</tr>
	<?php
}
?>
