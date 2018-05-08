<?php
$host = $_SERVER['HTTP_HOST'];

$quote_data = $quote_data[0];

$names_values = "";

$date = "";
if(!empty($quote_data["date_due"])){
	$date .= $quote_data["date_due"];
	if(!empty($quote_data["time_due"])){
		$date .= " " . $quote_data["time_due"];
	}
}
//var_dump($quote_data);
//var_dump($quote_langs);
//var_dump($quote_files);
$time_zone = "<p><strong>Time zone: </strong>" . $quote_data["time_zone"] . "</p>";
$langs_text = "";
$lang_from = "";
$langs_to = "";
if(!empty($quote_langs)){
	foreach($quote_langs as $key=>$value){
		$langs_text .= "<tr><td class=\"vertical_padding\" colspan=\"2\"><table style=\"width: 100%;\"><tr>";
		$langs_text .= "<td width=\"49%\" colspan=\"1\"><p>Language from: "; 
		if(!empty($value["lang_from"])){
			meta("S", array("template"=>"language", "id"=>$value["lang_from"]), $lang_from);
			$langs_text .= $lang_from[0]["name"];
		}
		$langs_text .= "</p><p>Language(s) to: ";
		if(!empty($value["lang_to"])){
			$exploded_langs = explode(",", $value["lang_to"]);
			foreach ($exploded_langs as $keyy => $valuee) {
				meta("S", array("template"=>"language", "id"=>$valuee), $langs_to);
				$langs_text .= $langs_to[0]["name"];
				if($keyy != (count($exploded_langs) - 1)){
					$langs_text .= ", ";
				}
			}
		}
		$langs_text .= "</p></td><td width=\"50%\" colspan=\"1\">";
		if(!empty($quote_files)){
			$langs_text .= "<p>Files:</p>";
			foreach($quote_files as $keyy=>$valuee){
				if($valuee["languages_id"] == $value["id"]){
					$exploded = explode("/", $valuee["file_path"]);
					unset($exploded[0]); // remove item at index 0 D:
					unset($exploded[1]); // remove item at index 1 WWW
					unset($exploded[2]); // remove item at index 2 lingverto
					$imploded = array_values($exploded);
					$label = implode("/", $imploded);
					$label = 'http://'.$_SERVER['HTTP_HOST'] . "/" . $label;
					$langs_text .= "<p><a target=\"_blank\" style=\"display: block\" href=\"" . $label . "\">" . $valuee["file_name"] . "</a></p>";
					unset($quote_files[$keyy]);
				}
			}
		}
		$langs_text .= "</td></tr></table></td></tr>";
	}
}

$rogue_files = "";

if(!empty($quote_files)){
	$rogue_files .= '<tr><td class=\"vertical_padding\"><table style=\"width: 100%;\"><tr><td><p>Files without language pairs:</p>';
	foreach($quote_files as $keyy=>$valuee){
		if(empty($valuee["languages_id"])){
			$exploded = explode("/", $valuee["file_path"]);
			unset($exploded[0]); // remove item at index 0 D:
			unset($exploded[1]); // remove item at index 1 WWW
			unset($exploded[2]); // remove item at index 2 lingverto
			$imploded = array_values($exploded);
			$label = implode("/", $imploded);
			$label = 'http://'.$_SERVER['HTTP_HOST'] . "/" . $label;
			$rogue_files .= "<p><a target=\"_blank\" style=\"display: block\" href=\"" . $label . "\">" . $valuee["file_name"] . "</a></p>";

		}
	}
	$rogue_files .= "</td></tr></table></td></tr>";
}

$echo = '
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>' . $data["lg"]["new_quote"] . '</title>
	<style>
		* { font-family: "Arial", "Verdana", serif; }
		h1 { color:#373435; font-size:14px; }
		a, p, th, td { color:#666666 !important; font-size:12px !important; line-height:18px !important; }
		.data { border-collapse:collapse; border-spacing:0px; }
		.data th, .data td { padding:4px 6px; }
		th { font-weight: bold; text-align:right; }
		.bottom { color:#1155cc !important; font-size:12px !important; }
		.vertical_padding{
			padding: 20px 0px;
		}
	</style>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
	<center>
		<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" border="0">
			<tr>
			<td valign="top" align="center">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td align="center">
								<table cellpadding="0" cellspacing="0" width="100%" border="0">
									<tr>
										<td colspan="1" width="594" height="26"><p><strong>First name:</strong> ' . $quote_data["first_name"] . '</p><p><strong>Last name:</strong> ' . $quote_data["last_name"] . '</p></td>
										<td colspan="1" width="594" height="26"><p><strong>Email:</strong> ' . $quote_data["email"] . '</p><p><strong>Phone:</strong> ' . $quote_data["phone"] . '</p></td>
									</tr>
									<tr>
										<td colspan="1" style="padding-top: 15px;" width="594" height="26"><p><strong>Date due: </strong> ' . $date . '</p>' . $time_zone . '</td>
										<td colspan="1" width="594" height="26"><p><strong>Date submitted: </strong> ' . $quote_data["created"] . '</p></td>
									</tr>
									<tr>
										<td class="vertical_padding" width="594" height="26"  colspan="6"><p><strong>Comment:</strong> ' . $quote_data["comment_text"] . '</p></td>
									</tr style="padding-bottom: 20px;">
									' . $langs_text . $rogue_files . '
								</table>
							</td>
						</tr>
						<tr>
							<td height="30">&nbsp;</td>
						</tr>
						<tr>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</center>
</body>
</html>
';

//echo $echo;

return $echo;

?>
