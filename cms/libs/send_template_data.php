<?php
if(!empty($_POST) && (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) === $_SERVER['HTTP_HOST']) )
{
	require('../../config.php');
	//print_r($_POST);
	$reciever_name = !empty($_POST["reciever_name"]) ? $_POST["reciever_name"] : '';
	$reciever_email = !empty($_POST["reciever_email"]) ? $_POST["reciever_email"] : '';
	$data = !empty($_POST["data"]) ? $_POST["data"] : array();
	$template = !empty($_POST["template"]) ? $_POST["template"] : '';
	$d_template = !empty($_POST["template"]) ? ($_POST["template"]."_") : '';
	$lang = !empty($_POST["lang"]) ? $_POST["lang"] : $languages[0]["iso"];
	
	lang("S",array("lang"=>$lang),$lg);
	$lang_id = langid_from_iso($lang);

	require_once("phpmailer/class.phpmailer.php");
	$mail = new phpmailer();
	
	$subject =	(!empty($lg[$d_template."mail_subject"]) ? $lg[$d_template."mail_subject"] : ( "[language:".$d_template."mail_subject"."]" ) ).
			" ".$_SERVER['HTTP_HOST'].
			(empty($settings[$d_template."sender_email"]) ? (' [settings:'.$d_template.'sender_email]') : '').
			(empty($lg[$d_template."sender_name"]) ? (' [language:'.$d_template.'sender_name]') : '');
		
	$tmpl = ROOT."/templates";
	if(file_exists("$tmpl/$template.php"))
	{
		$message = include("$tmpl/$template.php");
	}
	else
	{
		$message = '
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>'.$_SERVER['HTTP_HOST'].'</title>
			</head>
			<body>
			<table>';
		
		foreach($data as $key => $val)
		{
			if($val["key"] != "file")
			{
				$message.= '	<tr>
							<th style="text-align:right; padding-right:20px;">'.(!empty($lg[$val["key"]])?$lg[$val["key"]]:$val["key"]).':</th>
							<td>'.$val["value"].'</td>
						</tr>';
			}
		}
		
		$message.= '		<tr>
						<th style="text-align:right; padding-right:20px;">IP:</th>
						<td>'.$_SERVER['REMOTE_ADDR'].'</td>
					</tr>
				</table>
				</body>
				</html>
			';
	}
	//die("OK");

	/************************************************/
	$sender_email = !empty($settings[$d_template."sender_email"]) ? $settings[$d_template."sender_email"] : 'leo@lauvas.lv';
	$sender_email = str_replace(' ', '', $sender_email);
	$sender_email = explode(';',$sender_email);
	$sender_email = implode(',',$sender_email);
	$sender_email = explode(',',$sender_email);
	$sender_email = $sender_email[0];
	
	$mail->Sender	= $sender_email;
	$mail->From     = !empty($sender_email) ? $sender_email : 'info@'.$_SERVER['HTTP_HOST'];
	$mail->FromName = html_entity_decode(!empty($lg[$d_template."sender_name"]) ? $lg[$d_template."sender_name"] : $_SERVER['HTTP_HOST']);
	$mail->Subject = html_entity_decode($subject);
	$mail->Body    = $message;
	$mail->AltBody = $message;
	
	
	$reciever_email = !empty($reciever_email) ? $reciever_email : ('info@'.$_SERVER['HTTP_HOST']);
	$mail->AddAddress($reciever_email, $reciever_name);
		
	//out($mail);die();
	$max_attachments_size = (!empty($settings["max_attachments_size"]) ? $settings["max_attachments_size"] : 6.7) * 1024 * 1024; // 6.7 MB
	$added_attachments_size = 0;
	
	foreach($data as $key => $val)
	{
		if(!empty($val["key"]) && ($val["key"] == "file"))
		{
			$attachments = explode("#",$val["value"]);
			foreach($attachments as $as_key => $as_val)
			{
				if(!empty($as_val) && file_exists(ROOT. $as_val))
				{
					$added_attachments_size = $added_attachments_size + filesize(ROOT. $as_val);
					if($added_attachments_size <= $max_attachments_size)
					{
						$mail->AddAttachment(ROOT. $as_val);						
					}
				}
			}
		}
	}
	
	if($mail->Send())
		echo "ok";
	else
		echo "There has been a mail error sending mail";//.'Not sent: <pre>'.print_r(error_get_last(), true).'</pre>';
	
	// Clear all addresses and attachments for next loop
	$mail->ClearAddresses();
	$mail->ClearAttachments();
}
?>