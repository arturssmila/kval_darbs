<?php

	function after_actions() {
		alerts();
	}
	
	function includes_admin_path($append) {
		return "$_SERVER[DOCUMENT_ROOT]/admin/includes/admin/" . $append;
	}

	function is_action($action) {
		if (! isset($_POST["action"])) {
			return false;
		}

		return $action == $_POST["action"];
	}

	function is_error($check) {
		if (! isset($check[2])) {
			return false;
		}

		return !empty($check[2]);
	}

	function alerts($type = "danger") {
		if (! empty($_POST)) {
			reload(); exit;
		}//resets page to get post results

		if (empty($_SESSION["alerts"][$type])) {
			return;
		}

		foreach ($_SESSION["alerts"][$type] as $value) {
			echo $value;
		}

		unset($_SESSION["alerts"][$type]);
	}

	function alert($message, $type = "danger") {
		$_SESSION["alerts"][$type][] = "<div class=\"ui alert {$type}\">{$message}</div>";
	}

	function reload() {
		echo "<script>window.location = window.location.href;</script>";
	}

	function url($append = "") {
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		if (@end(str_split($url)) != "/") {
			$url .= "/";
		}

		return $url . $append;
	}

	function url_back($steps = 1) {
		$url = explode("/", rtrim(url(), "/"));

		for ($i = 0; $i < $steps; $i++) {
			$n = sizeof($url) - 1;
			unset($url[$n]);
		}

		return implode("/", $url);
	}

	function ui_check($id, $html = "", $checked = false) {
		$name = is_numeric($id) ? "id_$id" : $id;

		$checked = $checked ? "checked" : "";

		return "
		<div class=\"ui pull_right\">
			<label class=\"ui checkbox\" {$html}>
				<input type=\"checkbox\" name=\"$name\" value=\"$id\" $checked>
				<span></span> 
			</label>
		</div>
		";
	}

	function ui_crumbs() {
		$args = func_get_args();

		$expl = explode("/", "$_SERVER[REQUEST_URI]");

		$passed_admin = false;

		$n = 0;

		$html = "";

		foreach ($expl as $key => $value) {
			if ($passed_admin) {
				if(($n != 1) && ($n != 2)){
					if (is_numeric($value)) {
							$value = $args[$n];
							$n++;
					} else {
						$value = al($value);
					}

					$place = sizeof($expl) - $key - 1;

					$html .= "<a href=\"" . url_back($place) . "\" class=\"ui crumb " . ($place == 0 ? "last" : "") ."\">$value</a>";
				}else{
					$n++;						
				}
			}

			if ($value == "admin") {
				$passed_admin = true;
			}
		}

		return  "<div class=\"ui crumbs\">$html</div>";
	}

	function shorten($string, $to) {
		if (strlen($string) > $to) {
			return substr($string, 0, $to) . "...";
		}

		return $string;
	}

	$out = 0;

	function get_per_page() {
		global $database, $database_prefix;

		$per_page = 0;

		if ($database->has($database_prefix . "settings", array(
			"name" => "per_page"
		))) {
			$per_page = $database->get($database_prefix . "settings", "value", array(
				"name" => "per_page"
			));
		}

		return $per_page > 0 ? $per_page : 18;
	}

	function get_page() {
		global $out;

		$page = floor($out / get_per_page()) + 1;

		$out++;

		return "page_item page_" . ((string) $page);
	}

	function get_pages() {
		global $out;

		return floor($out / get_per_page()) + 1;
	}

?>