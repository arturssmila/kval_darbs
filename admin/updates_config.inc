<?php
	$ftp_user = 'introskip_admin';
	$ftp_pasw = 'introskip_admin';
	
	$remove_dirs = array(
				"/cms/libs/tcpdf/examples",
				"/cms/libs/PHPWord",
			);
	$remove_files = array(
				"/leo_clear.php",
				"/install.php",
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
				"adm_lang.xml",
				"help.xml",
			);
	
	function updateHtaccessFile($old_file,$new_file)
	{
		$htaccess = '';
		if(file_exists($old_file))
		{
			$old_htaccess = file_get_contents($old_file);
			$old_htaccess = explode('#NEW',$old_htaccess);
			$old_htaccess = implode('#--DONT EDIT UNDER THIS LINE--',$old_htaccess);
			$old_htaccess = explode('#--DONT EDIT UNDER THIS LINE--',$old_htaccess);
			$old_htaccess = $old_htaccess[0];
			$old_htaccess = str_replace("RewriteRule ^forum$ forum/ [L]", "", $old_htaccess);
			$old_htaccess = str_replace("RewriteRule ^rss$ rss/ [L]", "", $old_htaccess);
			$old_htaccess = str_replace("RewriteRule ^rss/?([^/\.]+)?/?$ rss/index.php?lang=$1 [L]", "", $old_htaccess);
			$old_htaccess = str_replace("RewriteRule ^admin$ admin/ [L]", "", $old_htaccess);
			$old_htaccess = str_replace("RewriteRule ^admin/?([^/\.]+)?/?([^/\.]+)?/?([^/\.]+)?/?([^/\.]+)?/?([^\.])?$ admin/index.php?mode=$1&cat1=$2&cat2=$3&cat3=$4&cat4=$5 [L]", "", $old_htaccess);
		}
		
		if(file_exists($new_file))
		{
			$new_htaccess = file_get_contents($new_file);
			$new_htaccess = explode('#NEW',$new_htaccess);
			$new_htaccess = implode('#--DONT EDIT UNDER THIS LINE--',$new_htaccess);
			$new_htaccess = explode('#--DONT EDIT UNDER THIS LINE--',$new_htaccess);			
			
			$htaccess[] = !empty($old_htaccess) ? $old_htaccess : (!empty($new_htaccess[0]) ? $new_htaccess[0] : '');
			$htaccess[] = !empty($new_htaccess[1]) ? $new_htaccess[1] : '';
			$htaccess = implode('#--DONT EDIT UNDER THIS LINE--',$htaccess);
		}
		return $htaccess;
	}
	
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
	
	//Deleting unnecessary folders and files on FTP
	function deleteFtpFolderFiles($conn_id,$dir)
	{
		global $response;
		$ffs = @ftp_nlist($conn_id, $dir);
		if(is_array($ffs))
		{
			foreach($ffs as $ff)
			{
				if($ff != '.' && $ff != '..')
				{
					$res = ftp_size($conn_id, $dir.'/'.$ff);
					if($res == -1)
					{
						deleteFtpFolderFiles($conn_id,$dir.'/'.$ff);
					}
					else
					{
						@ftp_delete($conn_id, '/'.$dir.'/'.$ff);
					}
				}
			}
		}
		@ftp_rmdir($conn_id,$dir);
	}
	
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
	
	function listForFtpFolderFiles($conn_id,$dir_path,$dir)
	{
		global $response;
		
		//make FTP folder
		$ftp_mkdir = @ftp_mkdir($conn_id, $dir_path);
		
		$ffs = scandir($dir);
		$files = array();
		$ftp_put = array();
		foreach($ffs as $ff)
		{
			if($ff != '.' && $ff != '..')
			{
				if(is_dir($dir.'/'.$ff))
				{
					listForFtpFolderFiles($conn_id,$dir_path.'/'.$ff,$dir.'/'.$ff);
				}
				else
				{
					$files[] = $ff;
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
						$ftp_put[] = @ftp_put($conn_id, $dir_path.'/'.$ff, $dir.'/'.$ff, FTP_BINARY);
					}
				}
			}
		}
		/*
		$response["func"][] = array(
						"dir" => $dir,
						"dir_path" => $dir_path,
						"ftp_mkdir" => $ftp_mkdir,
						"files" => $files,
						"ftp_put" => $ftp_put,
						);
		*/
	}
	
	function update_adm_lang($url)
	{
		global $languages_isoes;
		$adm_lang = @simplexml_load_file("..$url");
		if($adm_lang!==FALSE)
		{
			foreach($adm_lang->item as $item)
			{
				$lang_name = $item->name;
				$query = "SELECT * FROM `".PREFIX."adm_lang` WHERE `name` = '$lang_name'";
				$res = mysql_query($query);
				if(mysql_num_rows($res) > 0)
				{
					//echo $lang_name.'EXISTS<br />';
					$row = mysql_fetch_assoc($res);
					$last_id = $row["id"];
					mysql_query("DELETE from `".PREFIX."adm_lang_data` WHERE `val_id` = '$last_id'");
				}
				else {
					$query = "INSERT INTO `".PREFIX."adm_lang` SET `name` = '$lang_name'";
					mysql_query($query);
					$last_id = mysql_insert_id();
					
				}
				foreach($item->translation as $translation)
				{
					if(array_key_exists("{$translation->iso}", $languages_isoes))
					{
						$query = "INSERT INTO `".PREFIX."adm_lang_data` SET 
								`val_id` = '$last_id',
								`lang_id` = '".langid_from_iso("{$translation->iso}")."',
								`value` = '".$translation->name."'";
						mysql_query($query);
					}
				}
			}
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
								
								'<td>old_date: '.$old_date.'</td>'.
								'<td>new_date: '.$new_date.'</td>'.
								'<td>old_size: '.$old_size.'</td>'.
								'<td>new_size: '.$new_size.'</td>'.
								
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
?>