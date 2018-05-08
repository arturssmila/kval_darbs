<?php
//session_start();
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

$events = '';
$events2 = '';
$limit = 30;
$page = !empty($_POST["page"]) ? ($_POST["page"]-1) : 0;
$limit1 = $page * $limit;
$like = !empty($_POST["like"]) ? $_POST["like"] : "";
$_SESSION["actions_like"] = $like;
$lim = "LIMIT $limit1, $limit";


$query = "SELECT ".
		" e.*, u.name as name, u.surname as surname, u.mail as mail ".
		"FROM ".PREFIX."events as e ".
		"JOIN ".PREFIX."users as u ON e.user_id = u.id ".
		(($like) ? (" WHERE user_id = ".$user[0]["id"]) : '').
		" ORDER BY id DESC ";
//echo $query;
//die();
$rRes = mysql_query($query.$lim) or die(mysql_error().$query);
			
if(mysql_num_rows($rRes) > 0)
{
	while($row = mysql_fetch_assoc($rRes))
	{
		if (empty($row["id"])) break;
		$events[] = $row;
	}
}

$rRes = mysql_query($query) or die(mysql_error().$query);
if(mysql_num_rows($rRes) > 0)
{
	while($row = mysql_fetch_assoc($rRes))
	{
		if (empty($row["id"])) break;
		$events2[] = $row;
	}
}
$pages = floor(count($events2)/$limit)+((count($events2)%$limit)? 1 : 0);
if ($events)
{
	$ind = 0;
	foreach($events as $key=>$val)
	{
		$ind++;
		?>
	<tr class="actions_like<?php if($ind % 2 == 0) echo " sec_tr"; ?>" onclick="">
		<td align="right" class="date"><?php echo $val["id"]?></td>
		<td class="date"><?php echo get_short_date($val["date"]); ?></td>
		<td class="date"><?php echo '<a href="/admin/user/'.$val["user_id"].'">'.(($val["name"] || $val["surname"]) ? ($val["name"]." ".$val["surname"]) : $val["mail"])."</a>"; ?></td>
		<td><?php echo $val["action"]; ?></td>
	</tr>
		<?php
	}
	?>
	<tr class="actions_like_pages">
		<td colspan="4">
		<?php 
		if($pages>1)
		{
			echo '<div class="pages none">';
			for ($i = 1; $i <= $pages; $i++) 
			{
				echo '<a'.(($i==($page+1))?' class="active" ':' href="/admin/activities/').$i.'">'.$i.'</a> ';
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
	<tr class="actions_like">
		<td colspan="5">Nekas netika trasts!</td>
	</tr>
	<?php
}
?>
