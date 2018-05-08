<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/database.inc");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/libs/phpmailer/class.phpmailer.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/cms/libs/langbar.inc");
	foreach ($_POST["data"] as $key => $value) {
		if(!empty($value["value"]) && (($value["value"] != "password") || ($value["value"] != "password2"))){
			$data[$value["key"]] = $value["value"];
		}
	}
	out($data);
	/*$tmpl = dirname(dirname(__FILE__))."/templates/email_templates";
	$body = include("$tmpl/template_user_register.php");
	$mail1 = new phpmailer();

	$mail1->Sender = $settings["email"];
	$mail1->From = !empty($data["mail"]) : $data["mail"] ? "";
	$mail1->FromName = html_entity_decode($data["lg"]["new_registration"]);
	$mail1->Subject = html_entity_decode($data["lg"]["new_registration"]);

	$mail1->Body = $body;
	$mail1->AltBody = "";
	$mail1->AddAddress($settings["form_mail"], "");
	$mail1->IsHTML(true);

	if(!$mail1->Send()) {
		//exit(echo("error"));
	}
	$mail1->ClearAddresses();
	$mail1->ClearAttachments();*/
	echo "OK";
?>