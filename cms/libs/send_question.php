<?php
if(!empty($_POST) && (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) === $_SERVER['HTTP_HOST']) )
{
	require('../../config.php');
	//print_r($_POST);
	$name = !empty($_POST["name"]) ? $_POST["name"] : '';
	$mail = $_POST["mail"];
	$question = $_POST["question"];
	$lang = $_POST["lang"];
	
	if(empty($mail))
	{
		echo "mail";
	}
	elseif(empty($question))
	{
		echo "question";
	}
	else
	{
		$subject = "Jautājums par ".$_SERVER['HTTP_HOST'];
		$message = '
				<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>'.$_SERVER['HTTP_HOST'].'</title>
				</head>
				<body>
				<h3>Sūtītājs: '.$name.' &lt;'.$mail.'&gt;</h3>
				<p>Jautājums:</p>
				<p>'.$question.'</p>
				</body>
				</html>
			';
		lang("S",array(),$lg);	
		
		$mail_to_tail = explode(".",$_SERVER['HTTP_HOST']);
		$mail_to_tail = array_reverse($mail_to_tail);
		$mail_to_tail = array_slice($mail_to_tail, 0, 2);
		$mail_to_tail = array_reverse($mail_to_tail);
		$mail_to_tail = implode(".",$mail_to_tail);
		
		$question_mail = !empty($lg["question_mail"]) ? $lg["question_mail"] : ('info@'.$mail_to_tail);
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-Type: Text/Html; charset="utf-8"' . "\r\n";
		$headers .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n";
		
		// Additional headers
		$headers .= 'To: <info@'.$mail_to_tail.'>' . "\r\n";
		$name = $name ? $name : $mail;
		$headers .= 'From: '.'=?UTF-8?B?'.base64_encode($name).'?='.' <'.$mail.'>' . "\r\n";
		
		//out($mail_to_tail);
		// Mail it
		$mail_sent = @mail($question_mail, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $headers, '-f info@'.$mail_to_tail);
		echo $mail_sent ? "ok" : "Mail failed from ". 'info@'.$mail_to_tail;
	}
}
?>
