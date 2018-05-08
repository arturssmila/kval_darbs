<?php
if(!empty($_POST) && (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) === $_SERVER['HTTP_HOST']) )
{
	require('../../config.php');
	lang("S",array("lang"=>$languages[0]["iso"]),$lg);
	//print_r($_POST);
	$sender_name = !empty($_POST["sender_name"]) ? $_POST["sender_name"] : '';
	$sender_email = !empty($_POST["sender_email"]) ? $_POST["sender_email"] : '';
	$data = !empty($_POST["data"]) ? $_POST["data"] : array();
	
	require_once("phpmailer/class.phpmailer.php");
	$mail = new phpmailer();
	$subject =	(!empty($subject) ? $subject : 
			(
				!empty($lg["form_data"]) ? $lg["form_data"] : '[form_data]'
			)).
			" - ".
			$_SERVER['HTTP_HOST'].
			(
				empty($settings["form_mail"]) ? ' [form_mail]!' : ''
			);
	$message = '
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>'.$_SERVER['HTTP_HOST'].'</title>
			</head>
			<body>
			<h3>Sūtītājs: '.$sender_name.'</h3>
			<table>';
	
	$form_mail = !empty($settings["form_mail"]) ? $settings["form_mail"] : 'leo@lauvas.lv';
		
	$form_mail = str_replace(' ', '', $form_mail);
	$form_mail = explode(';',$form_mail);
	$form_mail = implode(',',$form_mail);
	$form_mail = explode(',',$form_mail);
	
	mysql_query("
			CREATE TABLE IF NOT EXISTS `".PREFIX."subscribers` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`sender_email` varchar(255) DEFAULT NULL,
					`ip` varchar(50) DEFAULT NULL,
					`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
					PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
		");
	$values = '';
	foreach($data as $key => $val)
	{
		if(($val["key"] != "file") && ($val["key"] != "sender_email"))
		{
			mysql_query(" ALTER TABLE  `".PREFIX."subscribers` ADD  `".$val["key"]."` TEXT NULL DEFAULT NULL AFTER  `ip` ");
			$values .= ", `".$val["key"]."` = '".mysql_real_escape_string(strip_tags(stripslashes($val["value"])))."' ";
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
		//$ins_mess = str_replace('\\"', "", $message);

	
	$query = "
			INSERT INTO
				".PREFIX."subscribers
			SET 
				`sender_email` = '$sender_email',
				`ip` = '".$_SERVER['REMOTE_ADDR']."' $values
			";	
	mysql_query($query);

	/************************************************/
	$mail->Sender	= 'info@'.$_SERVER['HTTP_HOST'];
	$mail->From     = !empty($sender_email) ? $sender_email : $mail->Sender;
	$mail->FromName = html_entity_decode($sender_name);
	$mail->Subject = html_entity_decode($subject);
	$mail->Body    = $message;
	$mail->AltBody = $message;
	
	foreach($form_mail as $key => $val)
	{
		$mail->AddAddress($val, '');
	}	
	
	$max_attachments_size = (!empty($settings["max_attachments_size"]) ? $settings["max_attachments_size"] : 6.7) * 1024 * 1024; // 6.7 MB
	$added_attachments_size = 0;
	
	foreach($data as $key => $val)
	{
		if($val["key"] == "file")
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
		echo "There has been a mail error sending mail<br>";//.'Not sent: <pre>'.print_r(error_get_last(), true).'</pre>';
	
	// Clear all addresses and attachments for next loop
	$mail->ClearAddresses();
	$mail->ClearAttachments();
}
?>