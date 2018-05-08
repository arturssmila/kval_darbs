<?php

$host = $_SERVER['HTTP_HOST'];

//var_dump($quote_data);
//var_dump($quote_langs);
//var_dump($quote_files);

foreach ($data as $key => $value) {
	if(($value["key"] == "password") || ($value["key"] == "password2") || ($value["key"] == "active")){
		unset($data[$key]);
	}else if($value["key"] == "country"){
		$query = "SELECT name FROM countries WHERE id=\"" . $data["country"] . "\"";
		$rs= mysql_query($query);
		$query_data = getSqlRows($rs);
		$data[$key]["value"] = $query_data[0]["name"];
	}
}


/*$query = "SELECT * FROM translation_requests WHERE id=\"" . $data["country"] . "\"";
$rs= mysql_query($query);
$query_data = getSqlRows($rs);
$data["country"] = $query_data[0]["name"];*/

$email_table = '<tr>
	<td width="586" align="center" style="text-align:center;">
		<div class="content">';
			$email_table .= '<table>';
			foreach($data as $key => $value)
			{		
				$email_table .= '<tr>';
					$email_table .= '<th>'.(!empty($lg[$value["key"]]) ? $lg[$value["key"]] : $value["key"]).': </th>';
					$email_table .= '<td> '.$value["value"].'</td>';
				$email_table .= '</tr>';		
			}
			$email_table .= '</table>';
$email_table .= '</div>
	</td>
</tr>
<tr>
	<td width="586" height="20"> </td>
</tr>';

$template_greeting = "";
$template_logo = "";
$email_signature = "";
$template_footer = "";

$echo = <<< End_of_String_delimiter
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>$template_greeting</title>
	<style>
		td { padding:0px; }
		h1 { margin:0px; padding:0px; line-height:24px; color:#373978; font-family:"Arial"; font-weight:bold; font-size:18px; }
		.content, .content table { line-height:20px; color:#373978; font-family:"Arial"; font-size:14px; }
		.content table th { text-align:left; font-weight:bold; }
		.footer { line-height:20px; color:#373978; font-family:"Arial"; font-size:14px; }
		.footer a { color:#373978; text-decoration:none; }
		.footer a:hover { text-decoration:underline; }
		.footer a.site_link { color:#e6b300; font-weight:bold; }
	</style>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="padding:0px;margin:0px;">
	<center>
		<table>
			<tr>
				<td width="586" align="center" style="text-align:center;">
					$template_logo
				</td>
			</tr>
			<tr>
				<td width="586" height="20"> </td>
			</tr>
			<tr>
				<td width="586" align="left" style="text-align:left;">
					<h1>$template_greeting</h1>
				</td>
			</tr>
			<tr>
				<td width="586" height="20"> </td>
			</tr>
			<tr>
				<td width="586" align="left" style="text-align:left;">
					<div class="content">$template_body</div>
				</td>
			</tr>
			<tr>
				<td width="586" height="20"> </td>
			</tr>
				$email_table
			<tr>
				<td width="586" align="left" style="text-align:left;">
					<div class="content">$email_signature</div>
				</td>
			</tr>
			<tr>
				<td width="586" height="20"> </td>
			</tr>
			<tr>
				<td width="586" height="20"> </td>
			</tr>
			<tr>
				<td width="586" align="center" style="text-align:center;">
					<div class="footer">$template_footer</div>					
				</td>
			</tr>
		</table>
	</center>
</body>
</html>

End_of_String_delimiter;

//echo $echo;

return $echo;

function getSqlRows($res){
	$result = array();
	if(mysql_num_rows($res) > 0){
	    while($row = mysql_fetch_assoc($res))
		{
			$result[] = $row;
		}
	}
	return $result;
}
?>
