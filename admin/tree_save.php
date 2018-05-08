<?php
$ajax = !empty($_POST["ajax"]) ? $_POST["ajax"] : "";

require('../config.php');

//passwordcheck
include("../cms/libs/passwordcheck.inc");
if (!$admin) 
{
	if(empty($ajax))//ja nav Ajax
	{
		header("Location: /admin/login.php");
	}
	exit();
}

$admin_lang = $user[0]["admin_language"];

$mode = isset($_GET["mode"]) ? $_GET["mode"] : "";

//out($_POST); die();

$id = isset($_POST["id"]) ? $_POST["id"] : '';
$alias_id = isset($_POST["alias_id"]) ? $_POST["alias_id"] : '';
$parent_id = !empty($_POST["parent_id"]) ? (($_POST["parent_id"]==$id)?-2:$_POST["parent_id"]) : 0;
$template_id = !empty($_POST["template_id"]) ? $_POST["template_id"] : "0";
$template = (template("S",array("id"=>$template_id),$a_tpl)) ? $a_tpl[0]["template"] : '';
$priority = !empty($_POST["priority"]) ? $_POST["priority"] : "0.5";
if(!empty($_POST["hide_link"])) $hide_link = 1;
if(!empty($_POST["deny_page"])) $deny_page = 1;
$date = !empty($_POST["date"]) ? $_POST["date"] : "";
$all_meta_data = !empty($_POST["meta_data"]) ? $_POST["meta_data"] : array();

$save = !empty($_POST["save"]) ? $_POST["save"] : "";
$delete = !empty($_POST["delete"]) ? $_POST["delete"] : "";
$delete_image = !empty($_POST["delete_image"]) ? $_POST["delete_image"] : "";
$order = !empty($_POST["order"]) ? $_POST["order"] : "";
$unblock = !empty($_POST["unblock"]) ? $_POST["unblock"] : "";
$copy = !empty($_POST["copy"]) ? $_POST["copy"] : "";

	$backup_data = array();

	$image_nominal = "";
	$image_small = "";
	$image_thumb = "";
	$image_big = "";
	
	$image_size = ""; 
	$image_size_small = ""; 
	$image_size_thumb = "";
	$image_size_big = "";
						
	$old = array('"',	"'");
	$new = array('&quot;',	'&#39;');
	$old_mce = array('"');
	$new_mce = array('"');
	$old_mce_img = array('../../');
	$new_mce_img = array('/');
	
	get_fields($fields, $field_names, $fields_ids, NULL);
	/*out($fields);
	out($field_names);
	out($fields_ids);*/
	//out($meta_data);
	//die();
	
	$lang_type = !empty($languages_settings["lang_type"]) ? $languages_settings["lang_type"] : 'suffix';
	$lang_position = !empty($languages_settings["lang_position"]) ? $languages_settings["lang_position"] : 'link';
	
	//out($all_meta_data);
	
	foreach($all_meta_data as $lkey => $lval)
	{
		if(!empty($lval))
		{
			foreach($lval as $mdkey => $meta_data)
			{
				
				if(!empty($fields[$mdkey]["field_type"]) && ($fields[$mdkey]["field_type"] == "text_tiny"))
				{
					$insert_data[$lkey][$field_names[$mdkey]] = str_replace($old_mce_img, $new_mce_img, $meta_data);
				}
				else
				{
					$insert_data[$lkey][$field_names[$mdkey]] = str_replace($old, $new, $meta_data);
				}
				//$insert_data[$lkey][$field_names[$mdkey]] = empty($is_magic_quotes) ? addslashes($insert_data[$lkey][$field_names[$mdkey]]) : $insert_data[$lkey][$field_names[$mdkey]];
				switch($field_names[$mdkey])
				{
					case "deny_page":
						if(!empty($insert_data[$lkey][$field_names[$mdkey]]))
						{
							$deny_page = 1;
						}
						break;
					case "name":
						$insert_data[$lkey][$field_names[$mdkey]] = !empty($insert_data[$lkey][$field_names[$mdkey]]) ? $insert_data[$lkey][$field_names[$mdkey]] : str_replace($old, $new, $insert_data[$languages[0]["id"]][$field_names[$mdkey]]);
						//$insert_data[$lkey][$field_names[$mdkey]] = empty($is_magic_quotes) ? addslashes($insert_data[$lkey][$field_names[$mdkey]]) : $insert_data[$lkey][$field_names[$mdkey]];
						break;
					case "url":
						//out($field_names[$mdkey].'['.$lkey.'] = '.$meta_data);
						//ja links ir tukšs, izmanto lauciņu name (apstrādājot)
						$insert_data[$lkey][$field_names[$mdkey]] = replace_spec_chars(str_replace(array('&quot;','&#39;'), array("",""), (!empty($meta_data) ? $meta_data : $insert_data[$lkey]["name"])));
						//ja ir tiešām tukšs, tad linku veido iso kods
						$insert_data[$lkey][$field_names[$mdkey]] = !empty($insert_data[$lkey][$field_names[$mdkey]]) ? $insert_data[$lkey][$field_names[$mdkey]] : $languages_keys[$lkey]["iso"];
						
						/*******************************************/
						if(empty($img_url_done))
						{
							$img_url = substr(replace_spec_chars(str_replace(array('&quot;','&#39;'), array("",""), (!empty($insert_data[$languages[0]["id"]]["name"])?$insert_data[$languages[0]["id"]]["name"]:$languages[0]["iso"]))), 0, 90);
							$img_url_done = true;
						}
						
						$url_id[$lkey] = "";
						if(($template != "comment") && ($template != "feedback"))
						{
							if($lang_type.'_'.$lang_position == 'unique_link')
							{
								$plus_lang = '';
								//out($insert_data);
								//Atdala -lang no linka, ja tāds ir
								if(substr($insert_data[$lkey][$field_names[$mdkey]], (-1 - strlen($languages_keys[$lkey]["iso"])))==("-".$languages_keys[$lkey]["iso"]))
								{
									$insert_data[$lkey][$field_names[$mdkey]] = substr($insert_data[$lkey][$field_names[$mdkey]], 0, (-1 - strlen($languages_keys[$lkey]["iso"])));
								}
								//Atlasa eksistējošu linku no citas sadaļas vai no tās pašas sadaļas, bet citas valodas
								$query = "SELECT field_content FROM ".PREFIX."meta_data
										WHERE
											field_content = '".$insert_data[$lkey][$field_names[$mdkey]].$url_id[$lkey]."'
											AND field_id = '-6'
											AND
											(
												( meta_id <> '$id' ) 
												OR
												(meta_id = '$id' AND language_id <> '$lkey') 
											)
										";
								//die($query);
								$res = mysql_query($query);
								$id_links = array();								
								//gatavi padotie linki no formas
								foreach($insert_data as $id_key => $id_val)
								{
									if($id_key != $lkey)
									{
										$id_links[] = !empty($id_val["url"]) ? $id_val["url"] : '';
									}
								}
								//out($id_links);
								
								//ja jau ir datubāzē tāds links VAI izveidotais links jau eksistē padotajos no formas
								
								while((mysql_num_rows($res) > 0) || (in_array($insert_data[$lkey][$field_names[$mdkey]].$url_id[$lkey].$plus_lang, $id_links, true)))
								{//pieliek galā -lang
									if(!empty($plus_lang))
									{
										$url_id[$lkey]++;
									}
									$plus_lang = '-'.$languages_keys[$lkey]["iso"];
									$query = "SELECT field_content FROM ".PREFIX."meta_data
											WHERE
												field_content = '".$insert_data[$lkey][$field_names[$mdkey]].$url_id[$lkey].$plus_lang."'
												AND field_id = '-6'
												AND
												(
													( meta_id <> '$id' ) 
													OR
													(meta_id = '$id' AND language_id <> '$lkey') 
												)
											";
									$res = mysql_query($query);
									
								}
								$insert_data[$lkey][$field_names[$mdkey]] = $insert_data[$lkey][$field_names[$mdkey]].$url_id[$lkey].$plus_lang;
								//die();
							}
							else
							{
								$meta[$lkey] = array(
											"lang"=>$languages_keys[$lkey]["iso"],
											"url"=>$insert_data[$lkey][$field_names[$mdkey]].$url_id[$lkey],
											"where"=>"id <> ".($id ? $id : "0"));
								
								while (meta("S", $meta[$lkey],$cat_url[$lkey]))
								{
									$url_id[$lkey]++;
									$meta[$lkey]["url"] = $insert_data[$lkey][$field_names[$mdkey]].$url_id[$lkey];
								}
								$insert_data[$lkey][$field_names[$mdkey]] = $insert_data[$lkey][$field_names[$mdkey]].$url_id[$lkey];
							}
						}
						/****************************************/
		
						break;
					case "menu_name":
					case "meta_title":
						$insert_data[$lkey][$field_names[$mdkey]] = !empty($insert_data[$lkey][$field_names[$mdkey]]) ? $insert_data[$lkey][$field_names[$mdkey]] : $insert_data[$lkey]["name"];
						break;
					case "content":
						$insert_data[$lkey][$field_names[$mdkey]] = str_replace($old_mce_img, $new_mce_img, $meta_data);
						$insert_data[$lkey][$field_names[$mdkey]] = !empty($insert_data[$lkey][$field_names[$mdkey]]) ? $insert_data[$lkey][$field_names[$mdkey]] : str_replace($old_mce_img, $new_mce_img, $insert_data[$languages[0]["id"]][$field_names[$mdkey]]);
						//$insert_data[$lkey][$field_names[$mdkey]] = empty($is_magic_quotes) ? addslashes($insert_data[$lkey][$field_names[$mdkey]]) : $insert_data[$lkey][$field_names[$mdkey]];
						break;
					case "meta_keywords":
						$insert_data[$lkey][$field_names[$mdkey]] = !empty($insert_data[$lkey][$field_names[$mdkey]]) ? $insert_data[$lkey][$field_names[$mdkey]] : $insert_data[$lkey]["name"];
						$insert_data[$lkey][$field_names[$mdkey]] = !empty($insert_data[$lkey][$field_names[$mdkey]]) ? $insert_data[$lkey][$field_names[$mdkey]] : str_replace('&quot;', "", $insert_data[$lkey]["name"]);
						$insert_data[$lkey][$field_names[$mdkey]] = str_replace(', ', ',', $insert_data[$lkey][$field_names[$mdkey]]);
						break;
					case "meta_description":
						$insert_data[$lkey][$field_names[$mdkey]] = !empty($insert_data[$lkey][$field_names[$mdkey]]) ? $insert_data[$lkey][$field_names[$mdkey]] : (!empty($insert_data[$lkey]["content"]) ? strip_tags($insert_data[$lkey]["content"]) : $insert_data[$lkey]["name"]);
						break;
					default:
					//teaser:
						//echo '<div>|'.$field_names[$mdkey].' => '.$insert_data[$lkey][$field_names[$mdkey]].' |</div>';
				}
					//echo '<div>|'.$field_names[$mdkey].' => '.$insert_data[$lkey][$field_names[$mdkey]].' |</div>';
			}
		}
		
		
	}
	
	if(is_array($alias_id))
	{
		$alias_id = implode(",",$alias_id);
	}
		
	$author = !empty($_POST["author"]) ? $_POST["author"] : $creator_id;
		
/***** IMAGES START *****/
if(!empty($id))//paņem attēlus no DB
{
	$images_db = mysql_query("SELECT image_big, image, image_small, image_thumb FROM ".PREFIX."meta WHERE id = $id ;") or die(mysql_error());
	$row_img_db = mysql_fetch_assoc($images_db);
	
	$big_db = $row_img_db["image_big"];
	$nominal_db = $row_img_db["image"];
	$small_db = $row_img_db["image_small"];
	$thumb_db = $row_img_db["image_thumb"];
}
$images_path = "../images/meta/";
function get_image_name($url,$tail,$extension)//for image path from link
{
	global $images_path;
	$img_id = "";
	while (file_exists($images_path.$url.$img_id.$tail.".".$extension))
		$img_id++;
	return $url.$img_id.$tail.".".$extension;
}
function optimize_image($image_path)
{
	$img = imagecreatefromstring(file_get_contents($image_path));
	$ext = explode(".",$image_path);
	$ext = end($ext);
	$ext = strtolower($ext);
	if(($ext == "jpeg") || ($ext == "jpg"))
	{
		imagejpeg($img, $image_path, 80);
	}
	if($ext == "png")
	{
		imagealphablending( $img, false );
		imagesavealpha( $img, true );
		imagepng($img, $image_path, 9);
	}
}
function get_image_size($image_path)
{
	list($width, $height) = getimagesize($image_path);
	return $width.'x'.$height;
}
if(!empty($_FILES["image_thumb"]) && ($_FILES["image_thumb"]["error"] == 0)) 
{
	$temp_image_thumb_name = explode(".", $_FILES["image_thumb"]["name"]);
	$temp_image_thumb_name = end($temp_image_thumb_name);
	$temp_image_thumb_name = strtolower($temp_image_thumb_name);	
	$image_thumb = get_image_name($img_url,'_thumb',$temp_image_thumb_name);
	if (!@move_uploaded_file($_FILES['image_thumb']['tmp_name'], $images_path.$image_thumb))
	{
		die("nevar uzladet thumb");
		$image_thumb = "";
	}
	else 
	{
		optimize_image($images_path.$image_thumb);
		$image_size_thumb = get_image_size($images_path.$image_thumb);
		//chmod($images_path.$image_thumb, 0777);
	}
}
//Ja uzlādē mazo bildi:
if(!empty($_FILES["image_small"]) && ($_FILES["image_small"]["error"] == 0)) 
{
	$temp_image_small_name = explode(".", $_FILES["image_small"]["name"]);
	$temp_image_small_name = end($temp_image_small_name);
	$temp_image_small_name = strtolower($temp_image_small_name);
	$image_small = get_image_name($img_url,'_small',$temp_image_small_name);
	if (!@move_uploaded_file($_FILES['image_small']['tmp_name'], $images_path.$image_small))
	{
		die("nevar uzladet small");
		$image_small = "";
	}
	else 
	{
		optimize_image($images_path.$image_small);
		$image_size_small = get_image_size($images_path.$image_small);
		//chmod($images_path.$image_small, 0777);
	}
}
if(!empty($_FILES["image"]) && ($_FILES["image"]["error"] == 0) )
{
	$temp_image_nominal_name = explode(".", $_FILES["image"]["name"]);
	$temp_image_nominal_name = end($temp_image_nominal_name);
	$temp_image_nominal_name = strtolower($temp_image_nominal_name);	
	$image_nominal = get_image_name($img_url,'_nominal',$temp_image_nominal_name);
	if (!@move_uploaded_file($_FILES['image']['tmp_name'], $images_path.$image_nominal))
	{
		die("nevar uzladet image");
		$image_nominal = "";
	}
	else 
	{
		optimize_image($images_path.$image_nominal);
		$image_size = get_image_size($images_path.$image_nominal);
		//chmod($images_path.$image_nominal, 0777);
	}
}
if(!empty($_FILES["image_big"]) && ($_FILES["image_big"]["error"] == 0)) 
{
	$extension = explode(".", $_FILES["image_big"]["name"]);
	$extension = end($extension);
	$extension = strtolower($extension);
	$uploadedfile = $_FILES['image_big']['tmp_name'];
	if($extension == "jpg" || $extension == "jpeg" )
	{
		$src = imagecreatefromjpeg($uploadedfile);
	}
	elseif ($extension == "png")
	{
		$src = imagecreatefrompng($uploadedfile);
	}
	elseif ($extension == "gif")
	{
		$src = imagecreatefromgif($uploadedfile);
	}
	list($width,$height) = getimagesize($uploadedfile);
	$image_size_big = $width.'x'.$height;
	
	if ($width > IMG_WIDTH)
	{
		$newwidth_nominal = IMG_WIDTH;
		$newheight_nominal = IMG_WIDTH / ($width/$height);
	}
	else
	{
		$newwidth_nominal = $width;
		$newheight_nominal = $height;
	}
	if(empty($nominal_db))
	{
		$image_size = number_format($newwidth_nominal, 0, '.', '').'x'.number_format($newheight_nominal, 0, '.', '');
	}
	
	$newwidth_small = IMG_SMALL_WIDTH;
	$newheight_small = IMG_SMALL_WIDTH / ($width/$height);
	if(empty($small_db))
	{
		$image_size_small = number_format($newwidth_small, 0, '.', '').'x'.number_format($newheight_small, 0, '.', '');
	}
	
	$newwidth_thumb = IMG_THUMB_WIDTH;
	$newheight_thumb = IMG_THUMB_WIDTH / ($width/$height);
	if(empty($thumb_db))
	{
		$image_size_thumb = number_format($newwidth_thumb, 0, '.', '').'x'.number_format($newheight_thumb, 0, '.', '');
	}
	
	if(empty($image_thumb) && empty($thumb_db))//THUMB
	{
		$tmp_thumb = imagecreatetruecolor($newwidth_thumb,$newheight_thumb);
		imagecopyresized($tmp_thumb,$src,0,0,0,0,$newwidth_thumb,$newheight_thumb,$width,$height);
		$image_thumb = get_image_name($img_url,'_thumb','jpg');
		//$image_size_big = get_image_size($images_path.$image_small);
		if (!imagejpeg($tmp_thumb,$images_path.$image_thumb,100))
		{
			$image_thumb = "";
			$image_size_thumb = "";
		}
		imagedestroy($tmp_thumb);
	}
	if(empty($image_small)&&empty($small_db))//SMALL
	{
		$tmp_small = imagecreatetruecolor($newwidth_small,$newheight_small);
		imagecopyresized($tmp_small,$src,0,0,0,0,$newwidth_small,$newheight_small,$width,$height);
		$image_small = get_image_name($img_url,'_small','jpg');
		if (!imagejpeg($tmp_small,$images_path.$image_small,100))
		{
			$image_small = "";
			$image_size_small= "";
		}
		imagedestroy($tmp_small);
	}
	if(empty($image_nominal)&&empty($nominal_db))//NOMINAL
	{
		$tmp_nominal = imagecreatetruecolor($newwidth_nominal,$newheight_nominal);
		imagecopyresized($tmp_nominal,$src,0,0,0,0,$newwidth_nominal,$newheight_nominal,$width,$height);
		$image_nominal = get_image_name($img_url,'','jpg');	
		if (!imagejpeg($tmp_nominal,$images_path.$image_nominal,100))
		{
			$image_nominal = "";
			$image_size = "";
		}
		imagedestroy($tmp_nominal);
	}
	//BIG
	$temp_image_big_name = explode(".", $_FILES["image_big"]["name"]);
	$temp_image_big_name = end($temp_image_big_name);
	$temp_image_big_name = strtolower($temp_image_big_name);
	$image_big = get_image_name($img_url,'_big',$temp_image_big_name);
	if (!@move_uploaded_file($_FILES['image_big']['tmp_name'], $images_path.$image_big))
	{
		die("nevar uzladet big");
		$image_big = "";
		$image_size_big = "";
	}
	else 
	{
		optimize_image($images_path.$image_big);
		//chmod($images_path.$image_big, 0777);
	}
	//END OTH
	imagedestroy($src);
}

/***** IMAGES END *****/

	if($unblock)
	{
		mysql_query("UPDATE ".PREFIX."meta SET opened = '0' WHERE id = $unblock ;") or die(mysql_error());
		set_meta_row($unblock);
		header("location: /admin/$mode/$unblock");
		exit();
	}
	if($delete)
	{
		mysql_query("UPDATE ".PREFIX."meta SET parent_id = '-2' WHERE id = $id ;") or die(mysql_error());
		mysql_query("DELETE FROM ".PREFIX."meta_data WHERE meta_id = $id AND field_id = '".$fields_ids["url"]."';") or die(mysql_error());
		event("I",array("user_id"=>$creator_id,"action"=>'Izdzēš sadaļu "'.$insert_data[$languages[0]["id"]]["name"].'" ('.$id.')'),$x);
		if(!empty($id)) set_meta_row($id);
		header("location: /admin/$mode/$parent_id");
		exit();
	}
	if($delete_image)
	{
		$delete_image_size = $delete_image.'_size';
		mysql_query("UPDATE ".PREFIX."meta SET $delete_image = NULL, $delete_image_size = NULL WHERE id = $id ;") or die(mysql_error());
		
		
		$delete_image = $row_img_db[$delete_image];
		if (file_exists("../images/meta/".$delete_image)) 
			unlink("../images/meta/".$delete_image);
			
		event("I",array("user_id"=>$creator_id,"action"=>'Izdzēš attēlu sadaļai <a href="/admin/tree/'.$id.'">"'.$insert_data[$languages[0]["id"]]["name"].'" ('.$id.')</a>'),$x);
		if(!empty($id)) set_meta_row($id);
		header("location: /admin/$mode/$id");
		exit();
	}
	if($order) 
	{
		meta("S",array("parent_id"=>$parent_id,"orderby"=>"ordered, id","lang"=>$languages[0]["iso"]),$order_select);
		$i = 0;
		$actual_ord = 0;
		$upd_ord = false;
		foreach($order_select as $key => $row)
		{
			if ($row["id"]==$id)
			{
				$actual_ord=$i;
			}
			$ord_meta[$i] = $row;
			$i++;
		}
		if ($actual_ord > 0 && $order == "up")
		{
			$temp = $ord_meta[$actual_ord];
			$ord_meta[$actual_ord] = $ord_meta[$actual_ord-1];
			$ord_meta[$actual_ord-1] = $temp;
			$upd_ord = true;
		}
		elseif ($actual_ord < ($i-1) && $order == "down")
		{
			$temp = $ord_meta[$actual_ord];
			$ord_meta[$actual_ord] = $ord_meta[$actual_ord+1];
			$ord_meta[$actual_ord+1] = $temp;
			$upd_ord = true;
		}
		if($upd_ord)
		{
			foreach ($ord_meta as $key => $value)
			{                
				mysql_query("UPDATE ".PREFIX."meta SET ordered = $key where id = ".$value["id"].";") or die(mysql_error());
				if(!empty($value["id"])) set_meta_row($value["id"]);
			}
			event("I",array("user_id"=>$creator_id,"action"=>'Samaina sadaļas secību <a href="/admin/tree/'.$temp["id"].'">"'.$temp["menu_name"].'" ('.$temp["id"].')</a> vietām ar <a href="<a href="/admin/tree/'.$ord_meta[$actual_ord]["id"].'">"'.$ord_meta[$actual_ord]["menu_name"].'" ('.$ord_meta[$actual_ord]["id"].')</a>'),$x);
		}
	}
	if($save)
	{
		//Neļauj saglabāt HOME kā deny_page!!!
		if($template=="home")
		{
			$deny_page = 0;
		}
		
		if ($id)
		{//update
			$where = "id = $id";
			if(!empty($image))
			{
				$result_img = mysql_query("SELECT image, image_small, image_thumb, image_big FROM ".PREFIX."meta WHERE $where ;") or die(mysql_error());
				$row_img = mysql_fetch_assoc($result_img);
				$del_image = $row_img["image"];
				$del_image_small = $row_img["image_small"];
				$del_image_thumb = $row_img["image_thumb"];
				$del_image_big = $row_img["image_big"];
			}
			$result = mysql_query("SELECT * FROM ".PREFIX."meta 
					WHERE id = '$id'") or die(mysql_error());
			$backup_data[] = mysql_fetch_assoc($result);
			$update = "UPDATE `".PREFIX."meta` SET 
					`parent_id` = '$parent_id',
					`priority` = '$priority',
					`template_id` = '$template_id',
					`alias_id` = ".($alias_id ? "'$alias_id'" : "NULL").", 
					`hide_link` = '".(empty($hide_link) ? "0" : "1")."', 
					`deny_page` = '".(empty($deny_page) ? "0" : "1")."', 
					".($image_nominal ? "`image` = '$image_nominal'," : "")." 
					".($image_small ? "`image_small` = '$image_small'," : "")." 
					".($image_thumb ? "`image_thumb` = '$image_thumb'," : "")." 
					".($image_big ? "`image_big` = '$image_big'," : "")." 
					".($image_size_big ? "`image_big_size` = '$image_size_big'," : "")." 
					".($image_size ? "`image_size` = '$image_size'," : "")." 
					".($image_size_small ? "`image_small_size` = '$image_size_small'," : "")." 
					".($image_size_thumb ? "`image_thumb_size` = '$image_size_thumb'," : "")." 
					".($date ? "`date` = '$date'," : "")." 
					`creator_id` = '$author'
		
				where $where ;";
			event("I",array("user_id"=>$creator_id,"action"=>'Izmaina sadaļu <a href="/admin/tree/'.$id.'">"'.$insert_data[$languages[0]["id"]]["name"].'" ('.$id.')</a>'),$x);	
									
			mysql_query($update) or die(mysql_error());
	
			if ((!empty($nominal_db)) && !empty($image_nominal))
			{
				if (file_exists("../images/meta/".$nominal_db)) 
					unlink("../images/meta/".$nominal_db);
			}
			if ((!empty($small_db)) && !empty($image_small))
			{
				if (file_exists("../images/meta/".$small_db)) 
					unlink("../images/meta/".$small_db);
			}
			if ((!empty($thumb_db)) && !empty($image_thumb))
			{
				if (file_exists("../images/meta/".$thumb_db)) 
					unlink("../images/meta/".$thumb_db);
			}
			if ((!empty($big_db)) && !empty($image_big))
			{
				if (file_exists("../images/meta/".$big_db)) 
					unlink("../images/meta/".$big_db);
			}
			
			//open parents
			$tmp_p_id = $parent_id;
			while($tmp_p_id > 0)
			{
				if ($tmp_p_id) $_SESSION["opened"][$tmp_p_id] = 1;
				meta("S", array("lang"=>$admin_lang,"id"=>$tmp_p_id),$googa);
				//if(!empty($tmp_p_id)) set_meta_row($tmp_p_id);
				$tmp_p_id = $googa[0]["parent_id"];
				unset($googa);
			}
		}
		else
		{//jauns ieraksts
			$insert_query = "INSERT INTO ".PREFIX."meta 
							(parent_id,
							priority,
							template_id,
							".($alias_id ? "alias_id," : "")." 
							ordered, 
							hide_link, 
							deny_page, 
								".($image_nominal ? "image," : "")." 
								".($image_small ? "image_small," : "")." 
								".($image_thumb ? "image_thumb," : "")." 
								".($image_big ? "image_big," : "")."  
								".($image_size_big ? "image_big_size," : "")." 
								".($image_size ? "image_size," : "")." 
								".($image_size_small ? "image_small_size," : "")." 
								".($image_size_thumb ? "image_thumb_size," : "")." 
							creator_id) 
					VALUES  
							( 
							'$parent_id',
							'$priority',
							'$template_id',
							".($alias_id ? "'$alias_id'," : "")." 
							(SELECT COUNT(m.parent_id) FROM ".PREFIX."meta m WHERE m.parent_id = '".$parent_id."'),
							'".(empty($hide_link) ? "0" : "1")."', 
							'".(empty($deny_page) ? "0" : "1")."', 
								".($image_nominal ? "'$image_nominal'," : "")." 
								".($image_small ? "'$image_small'," : "")." 
								".($image_thumb ? "'$image_thumb'," : "")." 
								".($image_big ? "'$image_big'," : "")." 
								".($image_size_big ? "'$image_size_big'," : "")." 
								".($image_size ? "'$image_size'," : "")." 
								".($image_size_small ? "'$image_size_small'," : "")." 
								".($image_size_thumb ? "'$image_size_thumb'," : "")." 
							'$author');";
					//echo $insert_query."<br /><br />";
					mysql_query($insert_query) or die(mysql_error());
			//mysql_query("UPDATE meta SET collapsed = '0' where id = ".(!empty($parent_id) ? $parent_id : "NULL")." ;") or die(mysql_error());
		
			//last id
				$result = mysql_query("SELECT id FROM ".PREFIX."meta ORDER BY id DESC LIMIT 1") or die(mysql_error());
				$row = mysql_fetch_assoc($result);
				$id = $row["id"];
				if(!empty($id)) set_meta_row($id);
				event("I",array("user_id"=>$creator_id,"action"=>'Pievieno jaunu sadaļu <a href="/admin/tree/'.$id.'">"'.$insert_data[$languages[0]["id"]]["name"].'" ('.$id.')</a>'),$x);
			//open parent
				if ($parent_id) $_SESSION["opened"][$parent_id] = 1;
		}
		foreach($insert_data as $lkey => $val)
		{
			foreach($val as $mdkey => $mdval)
			{
				$result = mysql_query("SELECT * FROM ".PREFIX."meta_data 
					WHERE meta_id = '$id' 
					AND field_id = '".$fields_ids[$mdkey]."' 
					AND language_id = '$lkey'") or die(mysql_error());
				$backup_data[] = mysql_fetch_assoc($result);
				mysql_query("DELETE FROM ".PREFIX."meta_data WHERE 
					meta_id = '$id' AND 
					field_id = '".$fields_ids[$mdkey]."' AND 
					language_id = '$lkey'
					;") or die(mysql_error());
				mysql_query("INSERT INTO ".PREFIX."meta_data SET 
					meta_id = '$id', 
					field_id = '".$fields_ids[$mdkey]."',
					language_id = '$lkey',
					field_content = '".(empty($is_magic_quotes) ? addslashes($mdval) : $mdval)."'
					;") or die(mysql_error());
			}
		}
		set_meta_row($id);
		backup($backup_data);
	}

	//include("../sitemap.php");
	//include("../rss/index.php");
	if(empty($ajax))
	{
	header("location: /admin/$mode/$id");
	exit();
	}
	else
		echo "SAVED";
?>