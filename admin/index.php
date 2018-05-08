<?php
ob_start();
require_once(dirname(dirname(__FILE__)).'/config.php');

include(ROOT."/admin/db_update.inc");
//passwordcheck
include(ROOT."/cms/libs/passwordcheck.inc");

$admin_lang = $user[0]["admin_language"];
$admin_lang_id = langid_from_iso($admin_lang);

if($admin>1)
{
	//die('updating work table..');
}

require_once(ROOT.'/admin/admin_language.php');
$mode = !empty($_GET["mode"]) ? $_GET["mode"] : 'tree';
$cat1 = !empty($_GET["cat1"]) ? $_GET["cat1"] : '';
$cat2 = isset($_GET["cat2"]) ? $_GET["cat2"] : '';
$cat3 = isset($_GET["cat3"]) ? $_GET["cat3"] : '';
$cat4 = isset($_GET["cat4"]) ? $_GET["cat4"] : '';

unlock_pages($user[0]["id"]);
secure_upload_dirs();

$http_user_agent = !empty($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : '';
if(
	(strpos(strtolower($http_user_agent),strtolower('Edge')) !== false)
	||
	(strpos(strtolower($http_user_agent),strtolower('MSIE')) !== false)
	||
	(strpos(strtolower($http_user_agent),strtolower('Trident')) !== false)
)
{
	die('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'.al("dont_use_this_browser"));
}

$version = get_version();

if(empty($_POST))
{
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Language" content="lv" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php if(	file_exists("../css/images/favicon_admin.png")	) { ?>
		<link rel="icon" type="image/png" href="/css/images/favicon_admin.png" />
	<?php } else { ?>
		<link rel="icon" type="image/ico" href="/cms/css/images/favicon.ico" />
	<?php } ?>
	<link href="/cms/css/admin.css?<?php echo file_date("../cms/css/admin.css"); ?>" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/cms/js/jquery.js"></script>
	<script type="text/javascript" src="/cms/js/image_preview.js"></script>
	
	<script type="text/javascript" src="/cms/js/tiny_mce/tiny_mce.js"></script>
	
	<script>
		var al = {};
		var edit_ind = 0;
		var mode = '';
		var home = 'http://<?php echo $_SERVER['HTTP_HOST']; ?>';
	</script>
	
	<script type="text/javascript" src="/admin/scripts.js?<?php echo file_date("../admin/scripts.js"); ?>"></script>
	<title></title>
</head>

<body>
	<div id="content_back" class="none"></div>
	<?php
	//print_r($_POST);
	include("header.php");
	?>
	
	<table class="none" width="100%">
		<tr>
			<?php
			if(
				!empty($user[0]["admin_type"])
				&&
				(
					in_array($user[0]["admin_type"],$modes["tree"]["user_types"])
					||
					in_array("all",$modes["tree"]["user_types"])
				)
				&&
				!empty($modes[$mode]["tree"])
			)
			{
			?>
			<td width="500" valign="top">
				<div id="tree" class="sh">				
					<label style="position:absolute;display:block;right:30px;cursor:pointer;" for="tree_lock"><?php echo al("lock"); ?> <input type="checkbox" <?php echo empty($_SESSION["tree_lock"])?'':'checked'; ?> id="tree_lock" style="vertical-align:middle;" /></label>
					<img id="img_0" src="/cms/css/images/page.png" style="cursor:pointer;"><a style="font-weight:bold;font-size:16px;" href="javascript:"><?php echo $_SERVER['HTTP_HOST']; ?> menu</a>
					<div>
						<div id="child_0" style="margin:0px;display:none;"></div>
					</div>
									
					<hr />
					<img id="img_-1" src="/cms/css/images/page.png" style="cursor:pointer;"><a href="javascript:">Citas sadaļas</a>
					<div>
						<div id="child_-1" style="margin:0px;display:none;"></div>
					</div>
					
					<hr />
					<img id="img_-100" src="/cms/css/images/page.png" style="cursor:pointer;"><a href="javascript:"><?php echo al("atributi"); ?></a>
					<div>
						<div id="child_-100" style="margin:0px;display:none;"></div>
					</div>
					
					<hr />
					<img id="img_-2" src="/cms/css/images/plus.png" style="cursor:pointer;" onclick="javascript:tree(-2);"><a href="javascript:tree(-2);"><?php echo al("dzestas_sadalas"); ?></a>
					<div>
						<div id="child_-2" style="margin:0px;display:none;"></div>
					</div>
				
					<div class="right">
						<i>&copy; Zīle v.<i class="version_number"><?php echo $version; ?></i></i>
					</div>
				</div>
				
			</td>
			<?php } ?>
			<td valign="top" height="1">
				
				<div id="content" class="sh">
					<?php
}
						if(file_exists(ROOT."/admin/includes/admin/_$mode.php"))
							include(ROOT."/admin/includes/admin/_$mode.php");
						elseif(file_exists(ROOT."/admin/includes/super_admin/_$mode.php"))
							include(ROOT."/admin/includes/super_admin/_$mode.php");
						elseif(file_exists(ROOT."/admin/_$mode.php"))
							include(ROOT."/admin/_$mode.php");
if(empty($_POST))
{
					?>
				</div>
			</td>
		</tr>
	</table>
	<?php include("footer.php"); 
	if(($mode=="tree") && !empty($cat1))
	{		
		?>
		<script type="text/javascript">
			edit_ind = <?php echo $cat1; ?>;
			$(document).ready(function()
			{
				//edit('',<?php echo $cat1; ?>);
			});
		</script>
		<?php
	}	
	?>
</body>
</html>
<?php
}
ob_end_flush();
?>