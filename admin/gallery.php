<?php
require('../config.php');
//passwordcheck
include("../cms/libs/passwordcheck.inc");
if (!$admin) 
{
	header("Location: /admin/login.php");
	exit();
}
$admin_lang = $user[0]["admin_language"];
$admin_lang_id = langid_from_iso($admin_lang);
require_once('../admin/admin_language.php');

//print_r($_POST); die();
$delete_images = !empty($_POST["delete_images"]) ? $_POST["delete_images"] : '';
if(!empty($delete_images))
{
	$delete_images = explode("###",$delete_images);
	foreach($delete_images as $key => $val)
	{
		$res = mysql_query("SELECT * FROM ".PREFIX."meta_images WHERE id = $val ;");
                if(mysql_num_rows($res) > 0)
		{
			$image = mysql_fetch_assoc($res);
			mysql_query("DELETE FROM ".PREFIX."meta_images WHERE id = $val ;") or die(mysql_error());
			if (!empty($image["image"]))
			{
				if (file_exists("../images/galleries/".$image["image"])) 
					unlink("../images/galleries/".$image["image"]);
			}
			if (!empty($image["image_thumb"]))
			{
				if (file_exists("../images/galleries/".$image["image_thumb"])) 
					unlink("../images/galleries/".$image["image_thumb"]);
			}
			if (!empty($image["image_small"]))
			{
				if (file_exists("../images/galleries/".$image["image_small"])) 
					unlink("../images/galleries/".$image["image_small"]);
			}
			if (!empty($image["image_big"]))
			{
				if (file_exists("../images/galleries/".$image["image_big"])) 
					unlink("../images/galleries/".$image["image_big"]);
			}
		}
	}
	echo "OK";
	exit();
}


$gallery_order = !empty($_POST["gallery_order"]) ? $_POST["gallery_order"] : '';
$img_id = !empty($_POST["id"]) ? $_POST["id"] : '';
$meta_id = !empty($_POST["meta_id"]) ? $_POST["meta_id"] : '';
if(!empty($gallery_order) && !empty($meta_id) && !empty($img_id))
{
	if(images("S",array("meta_id"=>$meta_id,"orderby"=>"ordered"),$ordered_images))
	{
		$ordering = 0;
		foreach($ordered_images as $key => $val)
		{
			$old_order[$key] = $val["id"];
			if($val["id"]==$img_id)
				$act_ord = $ordering;
			$ordering++;
		}
	}
	//print_r($old_order);
	//echo $act_ord.' => '.$img_id.' need '.$gallery_order;
	$new_order = $old_order;
	$new_order[$act_ord] = $old_order[$act_ord+$gallery_order];
	$new_order[$act_ord+$gallery_order] = $old_order[$act_ord];
	//print_r($new_order);
	foreach($new_order as $key => $val)
	{
		mysql_query("UPDATE ".PREFIX."meta_images SET 
				ordered = '".$key."'
			WHERE id = '".$val."' ;") or die(mysql_error());
	}
	echo "OK";
	
	exit();
}
if(!empty($_POST))
{
	$action = !empty($_POST["action"]) ? $_POST["action"] : '';
	$old = array('"');
	$new = array('&quot;');
	switch($action)
	{
		case 'gallery_data':
			$img_id = !empty($_POST["img_id"]) ? $_POST["img_id"] : '';
			$lang_id = !empty($_POST["lang_id"]) ? $_POST["lang_id"] : '';
			$value_type = !empty($_POST["value_type"]) ? $_POST["value_type"] : '';
			$value = !empty($_POST["value"]) ? addslashes(str_replace($old, $new, $_POST["value"])) : '';
			if(!empty($img_id) && !empty($lang_id) && !empty($value_type))
			{
				$queryx = "SELECT * FROM ".PREFIX."meta_images_data WHERE img_id = '$img_id' AND lang_id = '$lang_id'";
				$resx = mysql_query($queryx) or die(mysql_error());
				if(mysql_num_rows($resx) > 0)
				{
					mysql_query("UPDATE ".PREFIX."meta_images_data SET 
								$value_type = '$value'
							WHERE img_id = '$img_id' AND lang_id = '$lang_id'") or die(mysql_error());
				}
				else
				{
					mysql_query("INSERT INTO ".PREFIX."meta_images_data SET 
								img_id = '$img_id',
								lang_id = '$lang_id',
								$value_type = '$value'") or die(mysql_error());
				}
				echo "OK";
					
			}
			break;
	}
	exit();
}
$id = isset($_GET["id"]) ? $_GET["id"] : die("No ID selected!");
$images = array();

$query = "SELECT * FROM ".PREFIX."meta_images WHERE meta_id = $id ORDER BY ordered";
//echo $query;
$res = mysql_query($query);
if(mysql_num_rows($res) > 0)
{
	while($row = mysql_fetch_assoc($res))
	{
		foreach($languages as $key => $val)
		{
			$query2 = "SELECT * FROM ".PREFIX."meta_images_data WHERE img_id = '".$row["id"]."' AND lang_id = '".$val["id"]."'";
			$res2 = mysql_query($query2) or die(mysql_error());
			if(mysql_num_rows($res2) > 0)
			{
				$row["lang"][$val["id"]] = mysql_fetch_assoc($res2);
			}
		}		
		$images[] = $row;
	}
}
//out($images);
?>
<link href="/cms/css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/cms/js/jquery.js"></script>
<script type="text/javascript" src="/admin/scripts.js?<?php echo file_date("../admin/scripts.js"); ?>"></script>
<style>
body {background:white;}
</style>
<button type="button" onclick="javascript: var w1 = window.open('/admin/upload/index.php?id=<?php echo $id; ?>','mywindow','width=700,height=500,menubar=no,location=no,resizable=yes,scrollbars=yes');w1.focus();"><?php echo al("add_images"); ?></button>
<button type="delete" onclick="gallery_delete_images();" title="<?php echo al("delete_selected_images"); ?>" style="float:right;"><?php echo al("delete_selected_images"); ?></button>
<span class="red"><?php echo al("values_saved_live"); ?></span>
<?php
if(!empty($images))
{
	?>
	<script type="text/javascript" src="/cms/js/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="/cms/js/fancybox/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="/cms/js/fancybox/jquery.fancybox.css" media="screen" />
	
	<table class="none gallery">
		<tr>
			<th><?php echo al("attels"); ?></th>
			<th></th>
			<th></th>
			<?php
			foreach($languages as $key => $val)
			{
				echo '<th>'.$val["name"].'</th>';
			}
			?>
			<th><input type="checkbox" onclick="$('.image_check').prop('checked',this.checked);" title="<?php echo al("check_all"); ?>" /></th>
		</tr>
	<?php
		foreach($images as $key_gal => $val_gal)
		{
			?>
			<tr <?php echo ($key_gal%2)?'class="sec_tr"':''; ?>>
				<td rowspan="6">
					<a rel="gallery" href="/images/galleries/<?php echo $val_gal["image_big"]; ?>">
						<img src="/images/galleries/<?php echo $val_gal["image_small"]; ?>"/>
					</a>
				</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="<?php echo count($languages); ?>"></td>
				<td>&nbsp;</td>
			</tr>			
			<tr <?php echo ($key_gal%2)?'class="sec_tr"':''; ?>>
				<td rowspan="4">
					<?php if($key_gal) { ?>
					<img onclick="order_images(<?php echo $val_gal["id"]; ?>,-1);" class="order_bullet" src="/cms/css/images/up.png" title="<?php echo al("mainit_attelu_secibu_uz_augsu"); ?>" />
					<?php } ?>
					<?php if(!empty($images[$key_gal+1])) { ?>
					<img onclick="order_images(<?php echo $val_gal["id"]; ?>,1);" class="order_bullet" src="/cms/css/images/down.png" title="<?php echo al("mainit_attelu_secibu_uz_leju"); ?>" />
					<?php } ?>
				</td>
				<th><?php echo al("name"); ?></th>
				<?php foreach($languages as $key => $val) { ?>
					<td>
						<input type="text"
							value="<?php echo !empty($val_gal["lang"][$val["id"]]["name"])?$val_gal["lang"][$val["id"]]["name"]:'' ?>"
							onkeyup="gallery_data(<?php echo $val_gal["id"]; ?>,<?php echo $val["id"]; ?>,'name',$(this).val());"
							/>
					</td>
				<?php } ?>
				<td rowspan="4">
					<input class="image_check" type="checkbox" value="<?php echo $val_gal["id"]; ?>" />
				</td>
			</tr>
			<tr <?php echo ($key_gal%2)?'class="sec_tr"':''; ?>>
				<th><?php echo al("teaser"); ?></th>
				<?php foreach($languages as $key => $val) { ?>
					<td>
						<input type="text"
							value="<?php echo !empty($val_gal["lang"][$val["id"]]["teaser"])?$val_gal["lang"][$val["id"]]["teaser"]:'' ?>"
							onkeyup="gallery_data(<?php echo $val_gal["id"]; ?>,<?php echo $val["id"]; ?>,'teaser',$(this).val());"
							/>
					</td>
				<?php } ?>
			</tr>
			<tr <?php echo ($key_gal%2)?'class="sec_tr"':''; ?>>
				<th><?php echo al("alt"); ?></th>
				<?php foreach($languages as $key => $val) { ?>
					<td>
						<input type="text"
							value="<?php echo !empty($val_gal["lang"][$val["id"]]["alt"])?$val_gal["lang"][$val["id"]]["alt"]:'' ?>"
							onkeyup="gallery_data(<?php echo $val_gal["id"]; ?>,<?php echo $val["id"]; ?>,'alt',$(this).val());"
							/>
					</td>
				<?php } ?>
			</tr>
			<tr <?php echo ($key_gal%2)?'class="sec_tr"':''; ?>>
				<th><?php echo al("title"); ?></th>
				<?php foreach($languages as $key => $val) { ?>
					<td>
						<input type="text"
							value="<?php echo !empty($val_gal["lang"][$val["id"]]["title"])?$val_gal["lang"][$val["id"]]["title"]:'' ?>"
							onkeyup="gallery_data(<?php echo $val_gal["id"]; ?>,<?php echo $val["id"]; ?>,'title',$(this).val());"
							/>
					</td>
				<?php } ?>
			</tr>
			<tr <?php echo ($key_gal%2)?'class="sec_tr"':''; ?>>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="<?php echo count($languages); ?>"></td>
				<td>&nbsp;</td>
			</tr>
			<?php
		}
	?>
	</table>
	<script type="text/javascript">
		$("a[rel=gallery]").fancybox({
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				nextEffect		: 'fade', 
				prevEffect		: 'fade', 
				'titlePosition'		: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) 
							{
								  return '<span id="fancybox-title-over">' + (title.length ? ' &nbsp; ' + title : '') + '</span>';
							}
						 });
		function gallery_delete_images()
		{
			deleted_images = '';
			$(".image_check").each(function(){
				if($(this).is(':checked'))
					deleted_images = deleted_images + $(this).val() + '###';
			})
			deleted_images = deleted_images.slice(0,deleted_images.length-3);
			if(deleted_images)
			{
				if (!confirm('Dzēst attēlus?')) return false;
				$.ajax({
					type: "POST",
					url: "/admin/gallery.php",
					data: "delete_images="+deleted_images,
					async: false,
					success: function(data)
						{
							if (data == "OK")
							{
								window.location.reload();
							}
							else alert(data);
						}
					});
			}
		}
		function gallery_data(img_id,lang_id,value_type,value)
		{
			$.ajax({
				type: "POST",
				url: "/admin/gallery.php",
				data: {
					action:'gallery_data',
					img_id:img_id,
					lang_id:lang_id,
					value_type:value_type,
					value:value
				},
				async: true,
				success: function(data)
					{
						if (data != "OK")
						{
							alert(data);
						}
					}
				});
		}
		function order_images(id,order)
		{
			$.ajax({
				type: "POST",
				url: "/admin/gallery.php",
				data: "gallery_order="+order+'&id='+id+'&meta_id=<?php echo $id; ?>',
				async: false,
				success: function(data)
					{
						if (data != "OK")
						{
							alert(data);
						}
						else location.reload();
					}
				});
		}
	</script>
	<?php	
}
?>