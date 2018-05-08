<?php
$ftp_user = 'introskip_admin';
$ftp_pasw = 'introskip_admin';

$remove_dirs = array(
			"/cms/libs/tcpdf/examples/",
			"/cms/libs/PHPWord",
		);
$remove_files = array(
			"/leo_clear.php",
		);
$update_dirs = array(
			"admin",
			"cms",
		);
$update_files = array(
			".htaccess",
			"config.php",
			"index.php",
			"logout.php",
			"leo_clear.php",
			"adm_lang.xml",
			"help.xml",
		);
//Deleting unnecessary folders and files
function deleteFolderFiles($dir)
{
	$ffs = scandir($dir);	
	foreach($ffs as $ff)
	{
		if($ff != '.' && $ff != '..')
		{
			if(is_dir($dir.'/'.$ff))
			{
				deleteFolderFiles($dir.'/'.$ff);
			}
			else
			{
				unlink($dir.'/'.$ff);
			}
		}
	}
	if(is_dir($dir))
	{
		rmdir($dir);
	}
}

function check_if_has_updates($php=0)
{
	global $response;
	global $updates_count;
	$av_updates = false;
	$new_version = '';
	$xml = @simplexml_load_file("../update.xml");
	if($xml!==FALSE)
	{
		foreach($xml->version as $n_version)
		{
			$new_version = $n_version->__toString();
		}
		foreach($xml->file as $file)
		{
			$new_date = intval($file->date);
			$old_date = intval(file_date(dirname(dirname(__FILE__)).'/'.$file->url));
			
			$new_size = intval(!empty($file->size) ? $file->size : 0);
			$old_size = function_exists("file_size") ? intval(file_size(dirname(dirname(__FILE__)).'/'.$file->url)) : 0;
			if(
				($new_date > $old_date)
				||
				(
					($file->url != "/.htaccess") && ($new_size != $old_size)
				)
				||
				(
					($file->url == "/.htaccess") && ($new_size > ($old_size+11))
				)
			)
			{
				$updates_count++;
				$av_updates = true;
				if($php==1)
				{
					echo 	'<tr class="update_file_tr">'.
							'<td>'.$file->url.'</td>'. 
							'<td>
								<a class="red file_url" rel="'.$file->url.'" onclick="update_file('."'".$file->url."',$(this).parent('td')".');">'.al("atjaunot").'</a>
								<div class="updating"></div>
								<div class="success" style="margin:0px;padding-top:0px;padding-bottom:0px;">'.al('atjaunots').'</div>
								<div class="error"></div>
							</td>'. 
							/*
							'<td>old_date: '.$old_date.'</td>'.
							'<td>new_date: '.$new_date.'</td>'.
							'<td>old_size: '.$old_size.'</td>'.
							'<td>new_size: '.$new_size.'</td>'.
							*/
						'</tr>';
				}
			}
		}
	}
	if($php)
	{
		if($php==2)
		{
			return $updates_count;
		}
		else
		{
			echo $av_updates ? "<script>has_updates = true;</script>" : ('<tr><td class="green">'.al("tev_ir_jaunaka_versija").'</td></tr>');
		}
	}
	else
	{
		if(empty($av_updates) && !empty($new_version))
		{
			mysql_query("DELETE FROM `".PREFIX."modes_attributes` WHERE `mode` = 'version'");
			mysql_query("INSERT INTO `".PREFIX."modes_attributes` SET `mode` = 'version', `attr` = '$new_version'");
			$response["new_version"] = $new_version;
			register_domain();
		}
	}
}
/********************************************************************************************/
if(!empty($_POST))
{
	require('../config.php');
	include("../cms/libs/passwordcheck.inc");
	if (!$admin) 
	{
		echo '
			<script type="text/javascript">
				location.reload(true);
			</script>
		';
		exit();
	}
	
	$action = !empty($_POST["action"]) ? $_POST["action"] : '';
	$url = !empty($_POST["url"]) ? $_POST["url"] : '';
	
	$response = array();
	switch($action)
	{
		case "check_if_need_to_change_version":
			check_if_has_updates();
			break;
		case "getting_virus_database":
			//CHECKING FOR VIRUSES
			if($update_host != $_SERVER['HTTP_HOST'])
			{
				if($conn_id = @ftp_connect($update_host))
				{
					
					if(@ftp_login($conn_id, $ftp_user, $ftp_pasw))
					{
						@ftp_pasv($conn_id, true);
						@ftp_get($conn_id, "../admin/virus_database.inc", "/admin/virus_database.inc", FTP_BINARY);
					}
					else
					{
						$response["error"] = "Couldn't login to FTP";
					}
					ftp_close($conn_id);
				}
				else
				{
					$response["error"] = "Couldn't connect to $update_host";
				}
			}
			break;
		case "getting_files_to_check":
			function listFolderFilesForViruses($dir)
			{
				global $response;
				$ffs = scandir($dir);
				foreach($ffs as $ff)
				{
					if($ff != '.' && $ff != '..')
					{
						if(is_dir($dir.'/'.$ff))
						{
							listFolderFilesForViruses($dir.'/'.$ff);
						}
						else
						{
							if(
								(strpos($ff,'~') !== false)
								||
								(strpos($ff,'#') !== false)
								||
								(strpos($ff,'.bak') !== false)
								||
								(strpos($ff,'Thumbs.db') !== false)
							)
							{
								if(file_exists($dir.'/'.$ff)) 
								{
									unlink($dir.'/'.$ff);
								}
							}
							elseif(
								(
									//(strpos($ff,'.inc') !== false) ||
									(strpos($ff,'.php') !== false)
								)
								&&
								($ff != 'virus_database.inc')
							)
							{
								$response["files_to_check"][] = $dir.'/'.$ff;
							}
						}
					}
				}
			}
			listFolderFilesForViruses(dirname(dirname(__FILE__)));
			break;
		case "checking_for_viruses":
			$file = !empty($_POST["file"]) ? $_POST["file"] : '';
			if(!empty($file) && file_exists($file))
			{
				if(file_exists("virus_database.inc"))
				{
					$elements = require_once("virus_database.inc");
					
					$virus_found = array();
					
					$fh = fopen($file,'r');
					while($line = fgets($fh))
					{
						foreach($elements as $key => $val)
						{
							if((strpos(strtolower($line),strtolower($key)) !== false))
							{
								$virus = true;
								foreach($val as $posit)
								{
									if(
										(strpos(strtolower($line),strtolower($key)) !== false)
										&&
										(strpos(strtolower($line),strtolower($posit)) !== false)
									)
									{
										$virus = false;
									}
								}
								if($virus)
								{
									$response["virus_found"][] = array(
												"key" => $key,
												"file" => $file,
												"line" => htmlspecialchars($line),
												);
								}
							}
						}						
					}
					fclose($fh);
				}
				
			}
			break;
		case "update_file":
			if(!empty($url))
			{
				if($url == "xml") //XML update on server
				{
					
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
					$version = get_version();
					//Version updating
					$version = explode(".",$version);
					if(isset($version[3]))
					{
						$version[3] = $version[3] + 1;
						if(isset($version[2]) && ($version[3] > 9))
						{
							$version[2] = $version[2] + 1;
							$version[3] = 0;
							if(isset($version[1]) && ($version[2] > 9))
							{
								$version[1] = $version[1] + 1;
								$version[2] = 0;
								if(isset($version[0]) && ($version[1] > 9))
								{
									$version[0] = $version[0] + 1;
									$version[1] = 0;
								}
							}
						}
					}
					$version = implode(".",$version);
					
					$xml = new SimpleXMLElement('<update/>');
					$xml->addChild('version', $version);
					
					function listFolderFiles($dir)
					{
						global $xml;
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
									if(
										(strpos($ff,'~') !== false)
										||
										(strpos($ff,'#') !== false)
										||
										(strpos($ff,'.bak') !== false)
										||
										(strpos($ff,'Thumbs.db') !== false)
									)
									{
										if(file_exists($dir.'/'.$ff)) 
										{
											unlink($dir.'/'.$ff);
										}
									}
									elseif(
										(strpos($ff,'register_domain.php') === false)
										&&
										(strpos($ff,'_admin_domains.php') === false)
									)
									{
										$file = $xml->addChild('file');
										$file->addChild('url', str_replace(ROOT, '', $dir.'/'.$ff));
										$file->addChild('date', file_date($dir.'/'.$ff));
										$file->addChild('size', file_size($dir.'/'.$ff));
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
								$file->addChild('url', str_replace(ROOT, '', dirname(dirname(__FILE__)).'/'.$val));
								$file->addChild('date', file_date(dirname(dirname(__FILE__)).'/'.$val));
								$file->addChild('size', file_size(dirname(dirname(__FILE__)).'/'.$val));
							}
						}
					}
					file_put_contents("../update.xml",$xml->asXML());
					mysql_query("DELETE FROM `".PREFIX."modes_attributes` WHERE `mode` = 'version'");
					mysql_query("INSERT INTO `".PREFIX."modes_attributes` SET `mode` = 'version', `attr` = '$version'");
					$response["ok"] = 1;
				}
				else //UPDATING ONE FILE
				{
					$conn_id = ftp_connect($update_host) or die(al("nesanaca_pieslegties_ftp_serverim")); 
					if(@ftp_login($conn_id, $ftp_user, $ftp_pasw))
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
						
						$save_url = "..$url";
						
						if($url == "/.htaccess")
						{
							$save_url = "../htaccess.inc";
						}		
						
						//FTP faila lejuplāde
						$ftp_file_moved = false;
						@ftp_pasv($conn_id, true);
						if(@ftp_get($conn_id, $save_url, $url, FTP_BINARY))
						{
							$ftp_file_moved = true;			
						}
						else
						{
							$response["error"] = error_get_last();
							//FTP faila lejuplāde neizdevās, mēģinam vēlreiz pēc 1 sek.
							sleep(3);
							if(@ftp_get($conn_id, $save_url, $url, FTP_BINARY))
							{
								$ftp_file_moved = true;			
							}
							else
							{
								$response["error"] = error_get_last();
							}
						}
						if($ftp_file_moved)
						{
							if($url == "/.htaccess")
							{
								if(file_exists("..$url"))
								{
									$old_htaccess = file_get_contents("..$url");
									$old_htaccess = explode('#NEW',$old_htaccess);
									$old_htaccess = implode('#--DONT EDIT UNDER THIS LINE--',$old_htaccess);
									$old_htaccess = explode('#--DONT EDIT UNDER THIS LINE--',$old_htaccess);
									$old_htaccess = $old_htaccess[0];
									$old_htaccess = str_replace("RewriteRule ^admin$ admin/ [L]", "", $old_htaccess);
									$old_htaccess = str_replace("RewriteRule ^admin/?([^/\.]+)?/?([^/\.]+)?/?([^/\.]+)?/?([^/\.]+)?/?([^\.])?$ admin/index.php?mode=$1&cat1=$2&cat2=$3&cat3=$4&cat4=$5 [L]", "", $old_htaccess);
									unlink("..$url");
								}
								
								if(file_exists($save_url))
								{
									$new_htaccess = file_get_contents($save_url);
									$new_htaccess = explode('#NEW',$new_htaccess);
									$new_htaccess = implode('#--DONT EDIT UNDER THIS LINE--',$new_htaccess);
									$new_htaccess = explode('#--DONT EDIT UNDER THIS LINE--',$new_htaccess);
									
									
									$htaccess[] = !empty($old_htaccess) ? $old_htaccess : (!empty($new_htaccess[0]) ? $new_htaccess[0] : '');
									$htaccess[] = !empty($new_htaccess[1]) ? $new_htaccess[1] : '';
									$htaccess = implode('#--DONT EDIT UNDER THIS LINE--',$htaccess);
									
									unlink($save_url);
									
									$f = fopen(dirname(dirname(__FILE__)).$url, "w");
									fwrite($f, $htaccess);
									fclose($f);
								}
							}
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
							$response["error"] = al("nevareja_atvert_vai_saglabat_failu");
						}
					} else {
					    $response["error"] = al("nesanaca_pieslegties_ftp_serverim");
					}
					ftp_close($conn_id);
					/**********************/
					$response["ok"] = 1;
				}
			}
			break;
	}
	echo json_encode($response);
	exit();
	
}
/********************************************************************************************/
if(empty($updates_notify))
{
	?>
	<style>
		#viruses_found,
		.update_table {
			display:none;
		}
		.loading_image {
			display:inline-block;
			max-height:20px;
			vertical-align:middle;
		}
	</style>
	<script>
		$(document).ready(function()
		{
			checking_virus_database();
		});
		
		function checking_virus_database()
		{
			$('#checking_for_viruses_div').html(
					'<img class="loading_image" src="/cms/css/images/loading.gif" />'+
					' <?php echo al("getting_virus_database"); ?>'
					);
			$.ajax({
				type: "POST",
				url: "/admin/_updates.php",
				data: {
					action:"getting_virus_database"
				},
				dataType: 'json',
				cache: false,
				async: true,
				success: function(response)
					{
						//console.log(response);
						if("error" in response)
						{
							$('#checking_for_viruses_div').html(
									response["error"]+
									'<br />will use old virus database if exists'
									);
							$('#checking_for_viruses_div').animate({opacity:1},5000,function(){
								getting_files_to_check();
							});
						}
						else
						{
							getting_files_to_check();
						}
					}
				});
		}
		
		var files_to_check = {};
		function getting_files_to_check()
		{
			$('#checking_for_viruses_div').html(
					'<img class="loading_image" src="/cms/css/images/loading.gif" />'+
					' <?php echo al("getting_files_to_check"); ?>'
					);
			files_to_check = {};
			$.ajax({
				type: "POST",
				url: "/admin/_updates.php",
				data: {
					action:"getting_files_to_check"
				},
				dataType: 'json',
				cache: false,
				async: true,
				success: function(response)
					{
						//console.log(response);
						if("files_to_check" in response)
						{
							files_to_check = response["files_to_check"];
							checking_for_viruses(0);
						}
						else
						{
							$('#checking_for_viruses_div').html(
									'There are problem to get information about files on server! Please, inform administrator about it!'
									);
							if(has_updates)
							{
								$('#super_admin_link').show();
								$('#simple_admin_link').show();
							}
						}
					}
				});
		}
		
		var virus_found = {};
		function checking_for_viruses(ind)
		{
			if(ind in files_to_check)
			{
				$('#checking_for_viruses_div').html(
						'<img class="loading_image" src="/cms/css/images/loading.gif" />'+
						' <?php echo al("checking_for_viruses"); ?>'+
						'<div class="virus_check_progres"><div style="width:'+(((ind+1) / files_to_check.length) * 100)+'%;"></div><span>'+files_to_check[ind]+'</span></div>'
						);
				$.ajax({
					type: "POST",
					url: "/admin/_updates.php",
					data: {
						action:	"checking_for_viruses",
						file:	files_to_check[ind]
					},
					dataType: 'json',
					cache: false,
					async: true,
					success: function(response)
						{
							//console.log(response);
							if("virus_found" in response)
							{
								$('#viruses_found').show();
								var html = '';
								for(var x in response["virus_found"])
								{
									html += '<tr>';
									html += '<td>'+(("file" in response["virus_found"][x]) ? response["virus_found"][x]["file"] : '')+'</td>';
									html += '<th>'+(("key" in response["virus_found"][x]) ? response["virus_found"][x]["key"] : '')+'</th>';
									html += '<td>'+(("line" in response["virus_found"][x]) ? response["virus_found"][x]["line"] : '')+'</td>';
									html += '</tr>';									
								}
								$('#viruses_found table').append(html);
							}
							checking_for_viruses(++ind);
						}
					});
			}
			else
			{
				$('#checking_for_viruses_div').html('');
				if(has_updates)
				{
					$('#super_admin_link').show();
					$('#simple_admin_link').show();
					
				}
				$('.update_table').show();
			}
		}
		
		var has_updates = false;
		
		var update_file_int = {};
		var update_url_array = {};
		var update_url_array_ind = 0;
		function update_files()
		{
			var i = 0;
			$('.update_table .file_url').each(function(){
				update_url_array[i] = $(this).attr('rel');
				i++;
			});
			update_file(update_url_array[0],$('.update_table .file_url[rel="'+update_url_array[0]+'"]').parent('td'));
		}
		
		function update_file(url,el)//OLD UPDATE
		{
			//console.log(url);
			$('#super_admin_div .updating, #simple_admin_div .updating').css('display','inline-block');
			$('.updating',el).css('display','inline-block');
			$('.file_url',el).hide();
			$.ajax({
				type: "POST",
				url: "/admin/_updates.php",
				data: {
					action:"update_file",
					url:url
				},
				dataType: 'json',
				cache: false,
				async: true,
				success: function(response)
					{
						//console.log(response);
						if(url=="xml")
						{
							if("error" in response)
							{
								//console.log(response);
								$('.error',el).html(response["error"]);
								$('.error',el).slideDown(500);
								window.clearTimeout(update_file_int);
							}
							else
							{
								$('.error',el).hide();
								$('.success',el).slideDown(500);
								window.clearTimeout(update_file_int);
								update_file_int = setTimeout(function() {
									$('.success',el).slideUp(500);
								}, 2000);
							}
						}
						else
						{
							if("error" in response)
							{
								$('.file_url',el).show();
								$('.error',el).html(response["error"]);
								$('.error',el).slideDown(500);
								window.clearTimeout(update_file_int);
							}
							else
							{
								$('.error',el).hide();
								$('.updating',el).hide();
								$('.success',el).slideDown(500,function(){
									el.parents('.update_file_tr').slideUp(500);
								});
								window.clearTimeout(update_file_int);
							}
						}
						if(Object.keys(update_url_array).length > 0)//go thru url array
						{
							update_url_array_ind++;//1
							if(update_url_array_ind < Object.keys(update_url_array).length)
							{
								update_file(update_url_array[update_url_array_ind],$('.update_table .file_url[rel="'+update_url_array[update_url_array_ind]+'"]').parent('td'))
							}
							else
							{
								update_url_array = {};
								update_url_array_ind = 0;
								$('#simple_admin_div .success').slideDown(500);
								window.clearTimeout(update_file_int);
								update_file_int = setTimeout(function() {
									$('#simple_admin_div .success').slideUp(500);
								}, 2000);
								$('.updating').hide();
								check_if_need_to_change_version();
							}
						}
						else
						{
							$('.updating').hide();
							check_if_need_to_change_version();
						}
					}
				});
		}
		
		function check_if_need_to_change_version()
		{
			$.ajax({
				type: "POST",
				url: "/admin/_updates.php",
				data: {
					action:"check_if_need_to_change_version"
				},
				dataType: 'json',
				cache: false,
				async: true,
				success: function(response)
					{
						//console.log(response);
						if("new_version" in response)
						{
							$('.version_number').html(response["new_version"]);
						}
					}
				});
		}
	</script>
	
	<table>
		<tr>
			<th><?php echo al("updates"); ?></th>
		</tr>
	</table>
	<?php
}

if(empty($updates_notify))
{
	//Deleting unnecessary folders
	foreach($remove_dirs as $dir)
	{
		if(file_exists(dirname(dirname(__FILE__)).$dir))
		{
			deleteFolderFiles(dirname(dirname(__FILE__)).$dir);
		}
	}
	//Deleting unnecessary files
	foreach($remove_files as $file)
	{
		if(file_exists(dirname(dirname(__FILE__)).$file))
		{
			unlink(dirname(dirname(__FILE__)).$file);
		}
	}
}

if(empty($updates_notify))
{
	?>
		<div id="checking_for_viruses_div">
			
		</div>
		<div id="viruses_found">
			<strong class="red"><?php echo al("viruses_found"); ?></strong>
			<table border="1" style="border-collapse:separate; border-spacing:0px; border:none;">
			</table>
		</div>
	<?php
}

$updates_count = 0;

if($update_host == $_SERVER['HTTP_HOST']) //server
{
	if(empty($updates_notify))
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
	}
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
				$updates_count++;
				if(empty($updates_notify))
				{
					echo 	'<tr>'.
							'<td>'.$file->url.'</td>'. 
						'</tr>';
				}
			}
		}
	}
	if(!empty($updates_notify))
	{
		return $updates_count;
	}
	else
	{
		echo $av_updates ? "<script>has_updates = true;</script>" : ('<tr><td class="green">'.al("versijas_fails_ir_atjaunots").'</td></tr>');
		echo 	'</table>';
	}
}
else //client
{	
	if(empty($updates_notify))
	{
		?>
		<div id="simple_admin_div">
			<button id="simple_admin_link" class="red" onclick="update_files();"><?php echo al("atjaunot_visus_failus"); ?></button>
			<div class="updating"></div>
			<div class="success"><?php echo al('visi_faili_atjaunoti'); ?></div>
			<div class="error"></div>
		</div>
		<?php
			echo 	'<table id="lang_table" class="update_table">';
	}
	
	if(!empty($updates_notify))
	{
		$conn_id = @ftp_connect($update_host);
		if(@ftp_login($conn_id, $ftp_user, $ftp_pasw))
		{
			@ftp_pasv($conn_id, true);
			@ftp_get($conn_id, "../update.xml", "/update.xml", FTP_BINARY);
		}
	}
	else
	{
		$conn_id = ftp_connect($update_host) or die("Couldn't connect to $update_host");
		if(@ftp_login($conn_id, $ftp_user, $ftp_pasw))
		{
			@ftp_pasv($conn_id, true);
			@ftp_get($conn_id, "../update.xml", "/update.xml", FTP_BINARY);
		} else {
		    echo "Couldn't connect to FTP\n";
		}
	}
		
	ftp_close($conn_id);
	
	if(!empty($updates_notify))
	{
		return check_if_has_updates(2);
	}
	else
	{
		check_if_has_updates(1);
		echo 	'</table>';
	}
		
}
?>