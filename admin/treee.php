<?php
	require('../config.php');
	include(ROOT."/cms/libs/passwordcheck.inc");
	
	$id = isset($_POST["id"]) ? $_POST["id"] : die();
	$edit_id = !empty($_POST["edit_id"]) ? $_POST["edit_id"] : 0;
	$mode = !empty($_POST["mode"]) ? $_POST["mode"] : 'tree';
	
	$lang = $user[0]["admin_language"];
	
	$admin_lang = $user[0]["admin_language"];
	$admin_lang_id = langid_from_iso($admin_lang);
	
	$echo = '';
	function get_childs($id)
	{
		global $user;
		global $echo;
		global $mode;
		global $edit_id;
		global $admin_lang_id;
		//meta("S",array("parent_id"=>$id),$tree[$id]);
		$query[$id] = "SELECT 
					id,
					alias_id,
					deny_page,
					(SELECT field_content FROM ".PREFIX."meta_data WHERE meta_id = id AND field_id = '-7' AND language_id = '$admin_lang_id' LIMIT 1) AS menu_name,
					image_big,
					image,
					image_small,
					image_thumb
				FROM ".PREFIX."meta
				WHERE parent_id = '$id'	
				ORDER BY ordered			
				";
		$res[$id] = mysql_query($query[$id]);
		if(mysql_num_rows($res[$id]) > 0)
		{
			while($val = mysql_fetch_assoc($res[$id]))
			{			
				$sub_tree[$id] = false;
				$sub_query[$id] = "SELECT id FROM ".PREFIX."meta WHERE parent_id = '".$val["id"]."'";
				$sub_res[$id] = mysql_query($sub_query[$id]);
				if(mysql_num_rows($sub_res[$id]) > 0)
				{
					$sub_tree[$id] = true;
				}
				$echo.= empty($sub_tree[$id]) ?
				('<img style="float:left;margin-top:3px;" src="/cms/css/images/page.png" />')
					:
					( !empty($_SESSION["opened"][$val["id"]]) ?
							  ("<img id=\"img_".$val["id"]."\" src=\"/cms/css/images/minus.png\" onclick=\"javascript:
								  collapse(".$val["id"].");\" style=\"float:left;margin-top:3px;cursor:pointer;\" />")
							: ("<img id=\"img_".$val["id"]."\" src=\"/cms/css/images/plus.png\" onclick=\"javascript:
								  tree(".$val["id"].");\" style=\"float:left;margin-top:3px;cursor:pointer;\" />"));
				$echo.= '<div>';
					if ($user[0]["id"]==1) 
						$echo.= 
							//$val["domain"]." ".
							//$val["parent_id"].
							" ";
					//link
					$echo.= '<a';
						$echo.= ' style="';
							$echo.= !empty($sub_tree[$id]) ? ('font-weight:bold;') : '';
							$echo.= !empty($val["deny_page"]) ? ('text-decoration:line-through;') : '';
						$echo.= '"';//style
						
						$echo.= ' class="';
							$echo.= ' tree_link';
							$echo.= ($val["id"]==$edit_id) ? ' red' : '';
						$echo.= '"';//class
						
						$echo.= ' id="link_'.$val["id"].'"';
						$echo.= ' href="/admin/'.$mode.'/'.$val["id"];
					$echo.= '">';
						$echo.= (!empty($val["menu_name"]) ? $val["menu_name"] : '[--]');
					$echo.= '</a>';
					
					$echo.= '<span class="tree_span" id="span_'.$val["id"].'"> ('.$val["id"].')</span>';
						
					$echo.= (!empty($val["alias_id"]))
							?
							('<span class="red"> : ('.$val["alias_id"].')</span>')
							:
							"";
					//image
					if($val["image_thumb"] || $val["image_small"] || $val["image"] || $val["image_big"])
					{
						$echo.= '<a class="preview_image" href="/images/meta/'.(!empty($val["image_thumb"])?$val["image_thumb"]:(!empty($val["image_small"])?$val["image_small"]:(!empty($val["image"])?$val["image"]:$val["image_big"]))).'" onclick="return false;">
								<img src="/images/meta/noimage.png" valign="middle" style="margin:-5px 5px;height:20px;" alt="gallery thumbnail" />
							</a>';
					}
					//childs
				$echo.=	'</div>';
				$echo.=	'<div>';
					$echo.=	'<div id="child_'.$val["id"].'" style="margin:0px;'.(!empty($_SESSION["opened"][$val["id"]]) ? "" : "display:none;").'">';
					if(!empty($_SESSION["opened"][$val["id"]])) 
					{ 
						get_childs($val["id"]);
					}
					$echo.=	'</div>';
				$echo.=	'</div>'; 
				unset($sub_tree[$id]);
			}
		}
	}
	
	$_SESSION["opened"][$id] = 1;
	get_childs($id);
	
	echo $echo;
?>