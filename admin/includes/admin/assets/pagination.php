<?php

	header("Content-Type: application/json; charset=utf-8");

	if (!empty($_POST)) {
		$_SESSION["pagination"][$_POST["page_name"]] = $_POST["page"];

		echo json_encode($_POST);		
	} else {
		echo json_encode(array());
	}

?>