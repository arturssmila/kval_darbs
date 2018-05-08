<?php
if(!empty($_POST["notify"]))
{
	exit();
}

if(!empty($_POST))
{
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
	$like = !empty($_POST["like"]) ? $_POST["like"] : "";
	$users_order = !empty($_POST["order"]) ? $_POST["order"] : "id";
	switch($users_order)
	{
	case "last_seen":
	case "registered":
		$ordered = $users_order." DESC";break;
		
	default:
		$ordered = "$users_order ASC";
	}
	$_SESSION["users_like"] = $like;
	$lim = "LIMIT $limit1, $limit";
	$query = "SELECT ".
				"* ".
				
			"FROM ".PREFIX."users ".
			"WHERE 
				mail LIKE '%".$like."%' 
				OR name LIKE '%".$like."%' 
				OR surname LIKE '%".$like."%' ".
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
			if($val["id"] != 1)
			{
				$ind++;
				?>
				<tr class="users_like<?php if($ind % 2 == 0) echo " sec_tr"; ?><?php if(empty($val["active"])) echo " inactive"; ?>"
				>
					<td align="right"><?php echo $val["id"]; ?></td>
					<td align="center"><?php 
					$soc[$key] = '<img style="margin:-2px 0px;" src="/cms/css/images/';
					switch($val["soc"])
					{
					case "00":$soc[$key].= '00.png';break;
					case "FB":$soc[$key].= 'fbi.png';break;
					case "DR":$soc[$key].= 'dri.png';break;
					case "GO":$soc[$key].= 'goi.png';break;
					case "TW":$soc[$key].= 'twi.png';break;
					}
					$soc[$key].= '" />';
					echo $soc[$key]; ?></td>
					<td><a href="/admin/user/<?php echo $val["id"]?>"><?php echo $val["mail"]; ?></a></td>
					<td><a href="/admin/user/<?php echo $val["id"]?>"><?php echo $val["name"]; ?></a></td>
					<td><a href="/admin/user/<?php echo $val["id"]?>"><?php echo $val["surname"]; ?></a></td>
					<td align="center">
						<?php
						switch($val["admin"])
						{
							case 1:
								echo '<strong title="'.al("super_admin").'">S</strong>';
								break;
							case 2:
								echo '<strong title="'.al("admin").'">A</strong>';
								break;
							case 3:
								echo '<strong title="'.al("user").'">U</strong>';
								break;
							case 4:
								echo '<strong title="'.al("viewer").'">V</strong>';
								break;
							default:
						}
						?>
					</td>
					<td align="left"><?php echo (!empty($val["last_seen"])?$val["last_seen"]:''); ?></td>
					<td align="left"><?php echo (($val["registered"]!='0000-00-00 00:00:00')?$val["registered"]:''); ?></td>
				</tr>
				<?php
			}
		}
		?>
		<tr class="users_like_pages">
			<td colspan="8">
				<?php 
				if($pages>1)
				{
					echo '<div class="pages none">';
					for ($i = 1; $i <= $pages; $i++) 
					{
						echo '<a'.(($i==($page+1))?' class="active" ':' href="/admin/users/').$i.'/'.$users_order.'">'.$i.'</a> ';
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
			<td colspan="8"><?php echo al("nekas_netika_atrasts"); ?></td>
		</tr>
		<?php
	}
	if($user[0]["admin"] < 3) {
	?>
		<tr class="users_like">
			<td colspan="8"><a href="/admin/user/new"><?php echo al("pievienot_jaunu_lietotaju"); ?></a></td>
		</tr>
	<?php }
	exit();
}

/**********************************************************************************************************************************************/

//echo $cat1;
//session_start();
$cat1 = empty($cat1) ? 1 : intval($cat1);
$users_like = !empty($_SESSION["users_like"]) ? $_SESSION["users_like"] : "";

switch($cat2)
{
case "id":
case "soc":
case "mail":
case "name":
case "surname":
case "admin":
case "last_seen":
case "registered":
	$users_order = $cat2;break;
default:
	$users_order = "id";
}
?>
<table class="none" id="users_like" style="position:relative;border-spacing:0px;">
	<tr>
		<th colspan="3" align="left">
			<a <?php if($mode == "users") echo 'style="color:lightblue;"'; ?> href="/admin/users/1/registered"><?php echo al("lietotaji"); ?></a>
			/ 
			<a <?php if($mode == "usersip") echo 'style="color:lightblue;"'; ?> href="/admin/usersip"><?php echo al("ip_adreses"); ?></a>
		</th>
		<td colspan="8" align="right"><?php echo al("meklet"); ?>: <input id="user_like" type="text" style="width:200px;" onkeyup="users_like($(this).val(),1,'<?php echo $users_order; ?>');" value="<?php echo $users_like; ?>" /></td>
	</tr>
	<tr>
		<th><a href="/admin/users/<?php echo $cat1; ?>/id">ID</a></th>
		<th><a href="/admin/users/<?php echo $cat1; ?>/soc">SOC</a></th>
		<th><a href="/admin/users/<?php echo $cat1; ?>/mail"><?php echo al("e_pasts"); ?></a></th>
		<th><a href="/admin/users/<?php echo $cat1; ?>/name"><?php echo al("vards"); ?></a></th>
		<th><a href="/admin/users/<?php echo $cat1; ?>/surname"><?php echo al("uzvards"); ?></a></th>
		<th><a href="/admin/users/<?php echo $cat1; ?>/admin"><?php echo al("user_type"); ?></a></th>
		<th><a href="/admin/users/<?php echo $cat1; ?>/last_seen"><?php echo al("redzets"); ?></a></th>
		<th><a href="/admin/users/<?php echo $cat1; ?>/registered"><?php echo al("registrejies"); ?></a></th>
	</tr>		
</table>
<script type="text/javascript">
	function users_like(like,page,order)
	{
		//alert();
		$.ajax({
			type: "POST",
			url: "/admin/_<?php echo $mode; ?>.php",
			data: "like="+like+"&page="+page+"&order="+order,
			async: true,
			success: function(rr)
				{
					$("tr .users_like").remove();
					$("tr .users_like_pages").remove();
					$('#users_like > tbody').append(rr);
				}
			});
	}
	
	$(document).ready(function()
	{
		users_like($("#user_like").val(),<?php echo !empty($cat1) ? $cat1 : 1; ?>,'<?php echo $users_order; ?>');
	});
</script>
