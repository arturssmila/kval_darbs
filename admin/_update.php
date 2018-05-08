<?php
$ftp_user = 'introskip_admin';
$ftp_pasw = 'introskip_admin';
$root = dirname(dirname(__FILE__));
$update_dirs = array(
			"admin",
			"cms",
		);
$update_files = array(
			"index.php",
			"logout.php",
			"config.php",
			"adm_lang.xml",
			"help.xml",
		);

$url = !empty($_POST["url"]) ? $_POST["url"] : '';
/********************************************************************************************/
if(!empty($url) && ($url == "xml")) //XML update
{
	require('../config.php');
	//passwordcheck
	include("../cms/libs/passwordcheck.inc");
	if (!$admin) 
	{
		//header("Location: /admin/login.php");
		echo '
			<script type="text/javascript">
				location.reload(true);
			</script>
		';
		exit();
	}
	/***********************************************/
	//updating adm_lang.xml file
	$query = "SELECT ".
			"* ".
		"FROM ".PREFIX."adm_lang ";
	$rRes = mysql_query($query) or die(mysql_error().$query);
	
	if(mysql_num_rows($rRes) > 0)
	{
		$xml = new SimpleXMLElement('<adm_lang/>');
		while($row = mysql_fetch_assoc($rRes))
		{
			if (empty($row["id"])) break;
			
			$item = $xml->addChild('item');
			$item->addChild('name', $row["name"]);
			foreach($languages as $key => $val)
			{
				$query2 = "SELECT "."* "."FROM ".PREFIX."adm_lang_data WHERE val_id = '".$row["id"]."' AND lang_id = '".$val["id"]."' ";
				$res2 = mysql_query($query2) or die(mysql_error().$query2);
				if(mysql_num_rows($res2) > 0)
				{
					$trans = $item->addChild('translation');
					$row2 = mysql_fetch_assoc($res2);
					$trans->addChild('iso', $val["iso"]);
					$trans->addChild('name', $row2["value"]);
				}
			}
		}
		file_put_contents("../adm_lang.xml",$xml->asXML());
	}
	//END OF adm_lang.xml
	/***********************************************/
	$admin_lang = $user[0]["admin_language"];
	require_once('../admin/admin_language.php');
	/**********************************************/
	$xml = new SimpleXMLElement('<update/>');
	function listFolderFiles($dir)
	{
		global $xml;
		global $root;
		$ffs = scandir($dir);
		foreach($ffs as $ff)
		{
			if($ff != '.' && $ff != '..')
			{
				if(is_dir($dir.'/'.$ff))
				{
					listFolderFiles($dir.'/'.$ff);
				}
				else
				{
					if (!(strpos($ff,'~') !== false) && !(strpos($ff,'#') !== false)) {
						$file = $xml->addChild('file');
						$file->addChild('url', str_replace($root, '', $dir.'/'.$ff));
						$file->addChild('date', file_date($dir.'/'.$ff));
					}
					
				}
			}
		}
	}
	foreach($update_dirs as $val)
	{
		listFolderFiles(dirname(dirname(__FILE__)).'/'.$val);
	}
	foreach($update_files as $val)
	{
		if (file_exists(dirname(dirname(__FILE__)).'/'.$val))
		{
			if (!(strpos($val,'~') !== false)) {
				$file = $xml->addChild('file');
				$file->addChild('url', str_replace($root, '', dirname(dirname(__FILE__)).'/'.$val));
				$file->addChild('date', file_date(dirname(dirname(__FILE__)).'/'.$val));
			}
		}
	}
	file_put_contents("../update.xml",$xml->asXML());
	echo "OK";
	exit();
}
/********************************************************************************************/
if(!empty($url)) //UPDATING ONE FILE
{
	require('../config.php');
	//passwordcheck
	include("../cms/libs/passwordcheck.inc");
	if (!$admin) 
	{
		//header("Location: /admin/login.php");
		echo '
			<script type="text/javascript">
				location.reload(true);
			</script>
		';
		exit();
	}
	
	$admin_lang = $user[0]["admin_language"];
	require_once('../admin/admin_language.php');
	
	/********************/
	$conn_id = ftp_connect($update_host) or die(al("nesanaca_pieslegties_ftp_serverim")); 
	if (@ftp_login($conn_id, $ftp_user, $ftp_pasw))
	{
		$dirs = explode("/", $url);
		array_pop($dirs);
		$path = implode("/", $dirs);
		array_shift($dirs);
		$path = "../";
		foreach($dirs as $val)
		{
			if(!file_exists($path.$val))
			{
				mkdir($path.$val, 0755);
			}
			$path .= $val.'/';
		}
		if (@ftp_get($conn_id, "..$url", $url, FTP_BINARY))
		{
			if($url == "/adm_lang.xml")
			{
				$adm_lang = @simplexml_load_file("..$url");
				if($adm_lang!==FALSE)
				{
					foreach ($adm_lang->item as $item)
					{
						$lang_name = $item->name;
						$query = "SELECT "."* "."FROM ".PREFIX."adm_lang WHERE name = '$lang_name'";
						$res = mysql_query($query) or die(mysql_error().$query);
						if(mysql_num_rows($res) > 0)
						{
							//echo $lang_name.'EXISTS<br />';
							$row = mysql_fetch_assoc($res);
							$last_id = $row["id"];
							mysql_query("DELETE from ".PREFIX."adm_lang_data WHERE val_id = '$last_id'");
						}
						else {
							$query = "INSERT INTO ".PREFIX."adm_lang SET name = '$lang_name'";
							mysql_query($query);
							$last_id = mysql_insert_id();
							
						}
						foreach($item->translation as $translation)
						{
							if(array_key_exists("{$translation->iso}", $languages_isoes))
							{
								$query = "INSERT INTO ".PREFIX."adm_lang_data SET 
										val_id = '$last_id',
										lang_id = '".langid_from_iso("{$translation->iso}")."',
										value = '".$translation->name."'";
								mysql_query($query);
							}
						}
					}
				}
			}
		}
		else
		{
			//print_r(error_get_last());
			echo al("nevareja_atvert_vai_saglabat_failu");
			exit();
		}
	} else {
	    echo al("nesanaca_pieslegties_ftp_serverim");
	    exit();
	}
	ftp_close($conn_id);
	/**********************/
	echo "OK";
	exit;
}
/********************************************************************************************/
?>
<table>
	<tr>
		<th><?php echo al("atjaunosana"); ?></th>
	</tr>
</table>
<?php
if($update_host == $_SERVER['HTTP_HOST']) //server
{
	?>
	<div id="super_admin_div">
		<button id="super_admin_link" class="red" onclick="update_file('xml',$('#super_admin_div'));"><?php echo al("atjaunot_versijas_failu"); ?></button>
		<div class="updating"></div>
		<div class="success"><?php echo al('versijas_fails_ir_atjaunots'); ?></div>
		<div class="error"></div>
	</div>
	
	<?php
	$av_updates = false;
	echo 	'<table id="lang_table" class="update_table">';
	$xml = @simplexml_load_file("../update.xml");
	if($xml!==FALSE)
	{
		foreach ($xml->file as $file)
		{
			$old_date = intval($file->date);
			$new_date = intval(file_date(dirname(dirname(__FILE__)).'/'.$file->url));
			if($new_date > $old_date)
			{
				$av_updates = true;
				echo 	'<tr>'.
						'<td>'.$file->url.'</td>'. 
					'</tr>';
			}
		}
	}
	echo $av_updates ? "<script>$('#super_admin_link').show();</script>" : ('<tr><td class="green">'.al("versijas_fails_ir_atjaunots").'</td></tr>');
	echo 	'</table>';
}
else //client
{
	?>
	<div id="simple_admin_div">
		<button id="simple_admin_link" class="red" onclick="update_files();"><?php echo al("atjaunot_visus_failus"); ?></button>
		<div class="updating"></div>
		<div class="success"><?php echo al('visi_faili_atjaunoti'); ?></div>
		<div class="error"></div>
	</div>
	<?php
	$av_updates = false;
		echo 	'<table id="lang_table" class="update_table">';
	/*******************************/
	$conn_id = ftp_connect($update_host) or die("Couldn't connect to $update_host"); 
	if (@ftp_login($conn_id, $ftp_user, $ftp_pasw))
	{
		if (@ftp_get($conn_id, "../update.xml", "/update.xml", FTP_BINARY))
		{
			//echo "Successfully written to ../update.xml\n";
		}
		else
		{
			//echo "There was a problem\n";
		}
	} else {
	    echo "Couldn't connect to FTP\n";
	}
	ftp_close($conn_id);
	/****************************/
	$xml = @simplexml_load_file("../update.xml");
	if($xml!==FALSE)
	{
		foreach ($xml->file as $file)
		{
			$new_date = intval($file->date);
			$old_date = intval(file_date(dirname(dirname(__FILE__)).'/'.$file->url));
			if($new_date > $old_date)
			{
				$av_updates = true;
				echo 	'<tr>'.
						'<td>'.$file->url.'</td>'. 
						'<td>
							<a class="red file_url" rel="'.$file->url.'" onclick="update_file('."'".$file->url."',$(this).parent('td')".');">'.al("atjaunot").'</a>
							<div class="updating"></div>
							<div class="success" style="margin:0px;padding-top:0px;padding-bottom:0px;">'.al('atjaunots').'</div>
							<div class="error"></div>
						</td>'. 
					'</tr>';
			}
		}
	}
	echo $av_updates ? "<script>$('#simple_admin_link').show();</script>" : ('<tr><td class="green">'.al("tev_ir_jaunaka_versija").'</td></tr>');
	echo 	'</table>';
}
?>
