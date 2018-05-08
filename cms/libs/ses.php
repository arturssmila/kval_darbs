<?php
$variable = !empty($_POST["variable"]) ? $_POST["variable"] : '';
//print_r($_POST);
require('../../config.php');
switch($variable)
{
	
	case "tree_lock"://admin task_list_lang
		$_SESSION["tree_lock"] = $_POST["tree_lock"];
		echo "ok";
		break;
	case "image_rename"://ADMIN image_rename
		include("../../cms/libs/passwordcheck.inc");
		if(!empty($_POST["file"]) && !empty($_POST["new_file"]) && !empty($_POST["mode"]))
		{
			$file = $_POST["file"];
			$new_file = $_POST["new_file"];
			$mode = $_POST["mode"];
			$images_path = ROOT."/images/$mode/";
			if (file_exists("../../images/$mode/".$new_file))
			{
				if($file==$new_file) echo "OK";
				else echo "Tāds fails jau eksistē!";
			}
			else
			{
				rename($images_path.$file, $images_path.$new_file);
				echo "OK";
			}
		}
		else echo "Tukšs faila nosaukums!";
		break;
	case "set_task_list_lang"://admin task_list_lang
		$_SESSION["task_list_lang"] = $_POST["lang"];
		echo "ok";
		break;
	case "set_task_list_cat"://admin set_task_list_cat
		$_SESSION["task_list_cat"] = $_POST["cat"];
		echo "ok";
		break;
	case "admin_result_cat"://admin admin_result_cat
		$_SESSION["admin_result_cat"] = $_POST["id"];
		echo "ok";
		break;
	case "header_fade_lang"://admin header_fade_lang
		$_SESSION["header_fade_lang"] = $_POST["lang"];
		echo "ok";
		break;
	case "tt_order"://admin tt_order
		$_SESSION["za"] = $_POST["order"];
		echo "ok";
		break;
	case "sign_data_last"://admin sign_data_last
		$_SESSION["sign_data_last"] = $_POST["val"];
		echo "ok";
		break;
	case "sign_data_first"://admin sign_data_first
		$_SESSION["sign_data_first"] = $_POST["val"];
		echo "ok";
		break;
	case "sign_data_both"://admin sign_data_first
		$_SESSION["sign_data_last"] = $_POST["val"];
		$_SESSION["sign_data_first"] = $_POST["val"];
		echo "ok";
		break;
	case "feedback_category"://feedback_category
		$_SESSION["feedback_category"] = $_POST["feedback_category"];
		echo "ok";
		break;
	case "activity_data_date"://activity_data_date
		$_SESSION["activity_data_date_from"] = $_POST["from"];
		$_SESSION["activity_data_date_to"] = $_POST["to"];
		$_SESSION["activity_data_meta_id"] = $_POST["meta_id"];
		echo "ok";
		break;
	case "tags"://tags
		$tag_id = reset(explode("#",$_POST["value"]));
		$tag_value = end(explode("#",$_POST["value"]));
		if(!empty($tag_value))
			$_SESSION["tags"][$tag_id] = $tag_value;
		else
			unset($_SESSION["tags"][$tag_id]);
		echo "ok";
		break;
	default:
		if(!empty($_POST["value"]))
			$_SESSION[$variable] = $_POST["value"];
		else
			unset($_SESSION[$variable]);
		echo "ok";
}
exit();
?>