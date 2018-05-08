<?php
if(isset($_POST["like"]))
{
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
	require_once(ROOT.'/admin/admin_language.php');
	$_SESSION["search_like"] = $like;
	$_SESSION["search_like_lang"] = $lang;
	$lim = "LIMIT $limit1, $limit";
	$like = trim($like);
	$like = str_replace("'","",$like);
	if($like && (mb_strlen(trim($like),'UTF-8') > 2))
	{
		$query = "SHOW TABLES LIKE '".PREFIX."work_table_$lang_id'";
		$res = mysql_query($query);
		if(mysql_num_rows($res) > 0)
		{
			$query = "SELECT * FROM ".PREFIX."work_table_$lang_id LIMIT 1";
			$res = mysql_query($query);
			if(mysql_num_rows($res) > 0)
			{
				$fields = mysql_fetch_assoc($res);
				unset($fields["date"]);
				$query_of_fields = implode("` LIKE '%".mysql_real_escape_string($like)."%' OR `", array_keys($fields));
				$list_of_fields = implode("`, `", array_keys($fields));
				
				$query = "SELECT `$list_of_fields` FROM ".PREFIX."work_table_$lang_id WHERE
						(`$query_of_fields` LIKE '%".mysql_real_escape_string($like)."%')
				";
				
				$res = mysql_query($query);
				if(mysql_num_rows($res) > 0)
				{
					$ind = 0;
					while($row = mysql_fetch_assoc($res))
					{
						//out($row);
						//$row["search_array"] = $row;
						//$data["search_results"][] = $row;
						?>
							<tr class="search_like<?php if(($ind % 2) == 1) echo " sec_tr"; ?><?php if($row["parent_id"]==-2) echo ' inactive';?>">
								<td align="right"><?php echo $row["id"]; ?></td>
								<td><a href="/admin/tree/<?php echo $row["id"]?>"><?php echo mb_substr($row["name"], 0, 50,'UTF-8'); ?></a></td>
								<?php
								/******************************************************************************/
									foreach($row as $v_key => $v_val)//caur sadaļas laukiem
									{
										//ja vērtībā ir meklējamā frāze
										if (mb_strpos(mb_strtolower($v_val,'UTF-8'), mb_strtolower($like,'UTF-8')) !== false)
										{
											//echo '<hr />';
											$row["search_array"][$v_key] = strip_tags($v_val);
											$row["search_array"][$v_key] = mb_strtolower($row["search_array"][$v_key],'UTF-8');
											$row["search_array"][$v_key] = preg_replace( "/\r|\n/", "", $row["search_array"][$v_key] );
											//sadala vērtību ar meklējamo frāzi
											$row["search_array"][$v_key] = explode($like,$row["search_array"][$v_key]);
											
											//out($row["search_array"][$v_key]);
											
											foreach($row["search_array"][$v_key] as $sr_key => $sr_val)
											{
												$words_right = explode(' ',$sr_val);
												$words_right = array_slice($words_right, 0, 5);
												$words_right = implode(' ',$words_right);									
												
												$words_left = explode(' ',$sr_val);
												$words_left = array_reverse($words_left);
												$words_left = array_slice($words_left, 0, 5);
												$words_left = array_reverse($words_left);
												$words_left = implode(' ',$words_left);
													
												$row["search_array"][$v_key][$sr_key] =
													(!empty($row["search_array"][$v_key][$sr_key-1]) ? ($words_right.'... ') : '').
													(!empty($row["search_array"][$v_key][$sr_key+1]) ? (' ...'.$words_left) : '');
											}
											//out($row["search_array"][$v_key]);
											if(count($row["search_array"][$v_key])>1)
											{
												$row["search_array"][$v_key] =
													implode('<span class="searchable_phrase">'.$like.'</span>',$row["search_array"][$v_key]);
											}
											else
											{
												$row["search_array"][$v_key] = ' ...<span class="searchable_phrase">'.$like.'</span>... ';
											}
											
											//out($row["search_array"][$v_key]);
											//echo '<hr />';
										}
										else
										{
											unset($row["search_array"][$v_key]);
										}
											
									}	
									
								/******************************************************************************/
								?>
								<td>
								<?php
									if(!empty($row["search_array"]))
									{
										$f_v = false;
										foreach($row["search_array"] as $key => $val)
										{
											echo ($f_v ? ', ' : '').al($key);
											$f_v = true;
										}
									}
								?>
								</td>
								<td>
								<?php
									if(!empty($row["search_array"]))
									{
										foreach($row["search_array"] as $key => $val)
										{
											echo $val;
										}
									}
								?>
								</td>
							</tr>
						<?php
						$ind++;
					}
				}
			}
		}
		else
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
			if($search)
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
	}
	exit();
}
//echo $cat1;
//session_start();
$users_like = !empty($_SESSION["search_like"]) ? $_SESSION["search_like"] : "";
$users_like_lang = !empty($_SESSION["search_like_lang"]) ? $_SESSION["search_like_lang"] : $admin_lang;
?>
<style>
	.searchable_phrase {
		display:inline-block;
		color:white;
		background-color:#464646;
	}
</style>
<table class="none" style="position:relative;border-spacing:0px;">
	<tr>
		<th align="left"><?php echo al("meklejama_fraze"); ?></th>
		<th><?php echo al("valoda"); ?></th>
	</tr>
	<tr>
		<th>
			<input 
				id="search_like" 
				type="text" 
				style="width:200px;" 
				onkeyup="search_like($(this).val(),1,$('input[name=users_like_lang]:checked').val());" 
				value="<?php echo $users_like; ?>"
			/>
		</th>
		<td>
		<?php foreach($languages as $key => $val) { ?>
			<label for="lang_<?php echo $val["iso"]; ?>">
				<input 
					id="lang_<?php echo $val["iso"]; ?>"
					type="radio"
					name="users_like_lang"
					value="<?php echo $val["iso"]; ?>"
					<?php if($users_like_lang == $val["iso"]) echo "checked"; ?>
					onchange="search_like($('#search_like').val(),1,$('input[name=users_like_lang]:checked').val());" />
				<?php echo $val["name"]; ?>
			</label>
		<?php } ?>
		</td>
	</tr>
</table>
<hr />
<table class="none" id="search_like" style="position:relative;border-spacing:0px;">
	<tr>
		<th align="right">ID</th>
		<th align="left"><?php echo al("name"); ?></th>
		<th><?php echo al("fields"); ?></th>
		<th><?php echo al("content"); ?></th>
	</tr>		
</table>
<script type="text/javascript">
	function search_like(like,page,lang)
	{
		$('#search_like > tbody').append(
			'<tr class="search_like">'+
			'	<td colspan="5"><img style="display:block;margin:auto;height:20px;" src="/cms/css/images/loading.gif"></td>'+
			'</tr>'
			);
		//alert();
		$.ajax({
			type: "POST",
			url: "/admin/_search.php",
			data: "like="+like+"&page="+page+"&lang="+lang,
			async: true,
			success: function(rr)
				{
					//alert(rr);
					//console.log(rr);
					$("tr .search_like").remove();
					$("tr .search_like_pages").remove();
					$('#search_like > tbody').append(rr);
				}
			});
	}
	search_like($("#search_like").val(),<?php echo $cat1 ? $cat1 : 1; ?>,$('input[name=users_like_lang]:checked').val());
</script>
