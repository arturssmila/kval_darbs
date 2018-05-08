<?php
$prew = !empty($_POST["prew"]) ? $_POST["prew"] : '';
$image_t = !empty($prew) ? '/css/images/template_logo_t.png' : 'cid:template_logo_t';
$image_b = !empty($prew) ? '/css/images/template_logo_b.png' : 'cid:template_logo_b';
$h1 = !empty($_POST["h1"]) ? $_POST["h1"] : 'Sveicināti!';
$text = !empty($_POST["text"]) ? $_POST["text"] : '<p>Šis ir automātiskais ziņojums no portāla '.$_SERVER['HTTP_HOST'].', lūdzam uz to neatbildēt!</p>';
$signature = !empty($_POST["signature"]) ? strip_tags($_POST["signature"],'<br>') : 'Ar cieņu,<br />Zigmārs Jansons<br />Autoskolas "Presto" direktors';
$addresses = !empty($_POST["addresses"]) ? strip_tags($_POST["addresses"],'<br>') : (!empty($adreses) ? $adreses : '<small class="red">Pievienosies automātiski!<br /></small>Merķeļa iela 1, Rīga, 4. stāvā LV-1050<br />Skolas ielā 10, Lielvārde 2. stāvā LV-5070<br />Tel:  +371 27742992');

$echo = <<< End_of_String_delimiter
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Language" content="lv" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" type="image/png" href="/css/images/favicon.png" />
	<style>
		body { 
			margin:0px;
			color:#666666;
			font-family: "Arial", "Verdana", serif;
			font-size:12px;
		}
		table {
			margin:auto;
		}
		h1 {
			margin:0px;
			color:#373435;
			font-size:14px;
		}
		a {
			color:#1155cc;
		}
	</style>	
</head>

<body>
	<table width="600" cellspacing="25">
		<tr>
			<td align="left">
				<img src="$image_t" alt="Presto" />
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" style="border-top:3px solid #e0e4e5;border-left:4px solid #e0e4e5;" cellspacing="0">
					<tr>
						<td style="padding:25px;">
							<h1>$h1</h1>
							$text
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="left">
				<table cellpadding="10" style="margin-left:15px;">
					<tr>
						<td colspan="2">$signature</td>
					</tr>
					<tr>
						<td style="border-right:1px solid #e0e4e5;color:#959595;font-size:11px;">$addresses</td>
						<td lign="center"><img src="$image_b" alt="Presto" /></td>
					</tr>
				</table>
				<table cellpadding="10" style="margin-left:15px;">
					<tr>
						<td><a href="http://www.autoskola-presto.com">www.autoskola-presto.com</a></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>

End_of_String_delimiter;
if(empty($prew))
return $echo;
else
echo $echo;
