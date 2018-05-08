<?php
/*
$zip = new ZipArchive();
$filename = "../_STORAGE/test112.zip";

if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
    exit("cannot open <$filename>\n");
}

$zip->addFromString("testfilephp_".time().".txt" , "#1 This is a test string added as testfilephp.txt.\n");
//$zip->addFile("/too.php","/testfromfile.php");
echo "numfiles: " . $zip->numFiles . "\n";
echo "status:" . $zip->status . "\n";
$zip->close();


die();
*/
/**************************************************************************************************************************/
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
			"css/style.css",
		);

$action = !empty($_POST["action"]) ? $_POST["action"] : '';
$version = !empty($_POST["version"]) ? $_POST["version"] : 0;

if(!empty($_POST))
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
	$admin_lang_id = langid_from_iso($admin_lang);
	require_once('../admin/admin_language.php');
	
	switch($action)
	{
		/********************************************************************************************************************************************************************/
		case "create_version_zip":
			if(!empty($version))
			{
				$zip = new ZipArchive;
				
				if ($zip->open(dirname(dirname(__FILE__)).'/_STORAGE/update_'.$version.'.zip', ZipArchive::CREATE)===TRUE)
				{
					function listFolderFiles($dir)
					{
						global $root;
						global $zip;
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
									if (!(strpos($ff,'~') !== false) && !(strpos($ff,'#') !== false))
									{
										$zip->addFile($dir.'/'.$ff,  str_replace($root.'/', '', $dir.'/'.$ff));
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
							if (!(strpos($val,'~') !== false))
							{
								$zip->addFile(dirname(dirname(__FILE__)).'/'.$val, $val);
							}
						}
					}
					/********************/
					$zip->close();
					echo "OK";
				}
			}
			break;
		/********************************************************************************************************************************************************************/
		case "get_update_files";
			echo '<h3>'.al("esosas_atjaunosanas_versijas").'</h3>';
			$storage_path = dirname(dirname(__FILE__))."/_STORAGE/";
			$update_files = array();
			if ($handle = opendir($storage_path)) 
			{
				/* This is the correct way to loop over the directory. */
				while (false !== ($file = readdir($handle))) 
				{
					switch (substr($file, -4))
					{
					case ".zip":
					case ".ZIP":
						if(substr($file, 0, 7)=="update_")
							$update_files[substr($file, 7, -4)] = $file;
						break;
					}
				}	
				closedir($handle);
			}
			krsort($update_files);
			foreach($update_files as $key => $val)
			{
				echo '<div rel="'.$val.'">CMS vers. '.$key.'</div>';
			}
			break;
		/********************************************************************************************************************************************************************/
		default:
			die("Unatended action!");
	}
	exit();
}

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
	<script>
		al["ievadiet_versiju"] = '<?php echo al('ievadiet_versiju'); ?>';
		al["veido_jauno_versiju"] = '<?php echo al('veido_jauno_versiju'); ?>';
		al["versijas_fails_izveidots"] = '<?php echo al('versijas_fails_izveidots'); ?>';
		al["mekle_atjaunosanas_failus"] = '<?php echo al('mekle_atjaunosanas_failus'); ?>';
	</script>
	<div id="create_version_zip">
		<div class="work">
			<input type="text" id="version" />
			<button onclick="create_version_zip($('#version').val());"><?php echo al("izveidot_atjauninajumu"); ?></button>
		</div>
		<div class="info"></div>
	</div>
	<div id="get_update_files">
		<div class="info"></div>
		<div class="work"></div>
	</div>
	<script>get_update_files();</script>

<?php
}
else	//CLIENT
{
	
}






?>
