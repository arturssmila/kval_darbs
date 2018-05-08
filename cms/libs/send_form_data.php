<?php

	$allowing_post = false;
	
	require_once('../../config.php');
	if(!empty($_SERVER['HTTP_ORIGIN']) && !empty($allowed_cros_domains) && in_array($_SERVER['HTTP_ORIGIN'],$allowed_cros_domains))
	{
		$allowing_post = true;
		header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Max-Age: 1000');
		header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
	}
	else
	{
		if(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) === $_SERVER['HTTP_HOST'])
		{
			$allowing_post = true;
		}
	}

if(!empty($_POST) && $allowing_post)
{
	lang("S",array("lang"=>$languages[0]["iso"]),$lg);
	//print_r($_POST);
	$sender_name = !empty($_POST["sender_name"]) ? $_POST["sender_name"] : '';
	$sender_email = !empty($_POST["sender_email"]) ? $_POST["sender_email"] : '';
	$subject = !empty($_POST["subject"]) ? $_POST["subject"] : '';
	$type = !empty($_POST["type"]) ? $_POST["type"] : '';
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
	
	if(!empty($data["reciever"]))
	{
		$form_mail = $data["reciever"];
		unset($data["reciever"]);
	}
	else
	{
		$form_mail = !empty($settings["form_mail"]) ? $settings["form_mail"] : 'leo@lauvas.lv';
	}
	$form_mail = str_replace(' ', '', $form_mail);
	$form_mail = explode(';',$form_mail);
	$form_mail = implode(',',$form_mail);
	$form_mail = explode(',',$form_mail);
	
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
		//$ins_mess = str_replace('\\"', "", $message);
	mysql_query("
			CREATE TABLE IF NOT EXISTS `".PREFIX."form_data` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`sender_email` varchar(255) DEFAULT NULL,
					`content` longtext,
					`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
					PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
		");

	mysql_query(" ALTER TABLE  `".PREFIX."form_data` ADD  `subject` TEXT NULL DEFAULT NULL AFTER  `sender_email` ");
	mysql_query(" ALTER TABLE  `".PREFIX."form_data` ADD  `type` VARCHAR( 50 ) NULL DEFAULT NULL AFTER  `content` ");
	$query = "
			INSERT INTO
				".PREFIX."form_data
			SET 
				sender_email = '$sender_email',
				subject = '$subject',
				`type` = '$type',
				content = '".
						mysql_real_escape_string(
							strip_tags(
								str_replace(
										array('<title>'.$_SERVER['HTTP_HOST'].'</title>'),
										array(""),
										stripslashes($message)
									),
								'<h3><table><tr><th><td><a>'
								)
							).
					"'";	
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