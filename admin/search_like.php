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

$search = '';
$search2 = '';
$limit = 30;
$page = !empty($_POST["page"]) ? ($_POST["page"]-1) : 0;
$limit1 = $page * $limit;
$like = !empty($_POST["like"]) ? $_POST["like"] : "";
$lang = !empty($_POST["lang"]) ? $_POST["lang"] : $user[0]["admin_language"];
$lang_id = langid_from_iso($lang);
$_SESSION["search_like"] = $like;
$_SESSION["search_like_lang"] = $lang;
$lim = "LIMIT $limit1, $limit";
if($like)
{
	$query = "SELECT ".
				"md.* , m.* ,md2.field_content AS name ".
				
			"FROM ".PREFIX."meta_data AS md ".
			"LEFT JOIN ".PREFIX."meta AS m ON meta_id = id ".
			"JOIN ".PREFIX."meta_data AS md2 ON md2.meta_id = id AND md2.field_id = -8 AND md2.language_id = '$lang_id' ".
			"WHERE 
				md.field_content LIKE '%".$like."%' AND md.language_id = '$lang_id' ".
			"GROUP BY id ORDER BY id ASC ";
	//die($query);
	$rRes = mysql_query($query.$lim) or die(mysql_error().$query);
	if(mysql_num_rows($rRes) > 0)
	{
		while($row = mysql_fetch_assoc($rRes))
		{
			if (empty($row["id"])) break;
			$search[] = $row;
		}
	}
	
	$rRes = mysql_query($query) or die(mysql_error().$query);
	if(mysql_num_rows($rRes) > 0)
	{
		while($row = mysql_fetch_assoc($rRes))
		{
			if (empty($row["id"])) break;
			$search2[] = $row;
		}
	}
	$pages = floor(count($search2)/$limit)+((count($search2)%$limit)? 1 : 0);
	if ($search)
	{
		$ind = 0;
		foreach($search as $key=>$val)
		{
			//if($val["id"] != 1)
			//{
				$ind++;
				?>
				<tr class="search_like<?php if($ind % 2 == 1) echo " sec_tr"; ?><?php if($val["parent_id"]==-2) echo ' inactive';?>">
					<td align="right"><?php echo $val["id"]; ?></td>
					<td><a href="/admin/tree/<?php echo $val["id"]?>"><?php echo substr($val["name"], 0, 50); ?></a></td>
					<td><?php echo substr(strip_tags($val["field_content"]), 0, 200); ?></td>
				</tr>
				<?php
			//}
		}
		?>
		<tr class="search_like_pages">
			<td colspan="3">
			<?php 
			if($pages>1)
			{
				echo '<div class="pages none">';
				for ($i = 1; $i <= $pages; $i++) 
				{
					echo '<a'.(($i==($page+1))?' class="active" ':' href="/admin/search/').$i.'">'.$i.'</a> ';
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
		<tr class="search_like">
			<td colspan="5">Nekas netika trasts!</td>
		</tr>
		<?php
	}
}
?>
