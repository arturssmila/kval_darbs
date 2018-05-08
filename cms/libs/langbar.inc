<?php
	$result = mysql_query("SELECT * FROM ".PREFIX."languages ORDER BY ordering") or die(mysql_error());
	while($row = mysql_fetch_assoc($result))
	{
		$languages[] = $row;
		$languages_keys[$row["id"]] = $row;
		$languages_isoes[$row["iso"]] = $row;
	}
	
	$result = mysql_query("SELECT * FROM ".PREFIX."languages_settings");
	while($row = mysql_fetch_assoc($result))
	{
		$languages_settings[$row["name"]] = $row["value"];
	}
	//print_r($languages_settings);

function data_starter()
{
	global $data;
	global $_GET;
	global $lang;
	global $slang;
	global $languages;
	global $languages_keys;
	global $languages_isoes;
	global $languages_settings;
	
	//out($languages);
	//out($languages_keys);
	//out($languages_isoes);
	//out($languages_settings);
	
	if(!empty($_COOKIE["language"]))
	{
		$cookie_language = $_COOKIE["language"];
	}
	
	//nolasa visu linku
	$get = !empty($_GET["variables"]) ? $_GET["variables"] : '';
	$get = explode('/',$get);
	
	$lang_type = !empty($languages_settings["lang_type"]) ? $languages_settings["lang_type"] : 'suffix';
	$lang_position = !empty($languages_settings["lang_position"]) ? $languages_settings["lang_position"] : 'link';
	
	switch($lang_type.'_'.$lang_position)
	{
		/*******************************************************************************************/
		case 'suffix_link'://www.domain.com/en/link
			if(array_key_exists($get[0],$languages_isoes))//ir norādīta eksistējoša valoda
			{
				$lang = $get[0];
				$_COOKIE["language"] = $lang;
				unset($get[0]);
				if($lang == $languages[0]["iso"])
				{
					//redirektējam bez pirmās valodas
					header("location: ".'/'.implode('/',$get));
					exit();
				}
			}
			else//Ja nav padota valoda (vai neeksistējoša), izvēlas pirmo
			{
				$lang = (!empty($cookie_language) && array_key_exists($cookie_language,$languages_isoes)) ? $cookie_language : $languages[0]["iso"];
				$new_get = array();
				foreach($get as $key => $val)
				{
					if(!empty($val))
						$new_get[$key+1] = $val;
				}
				$get = $new_get;
			}
			if($lang != $languages[0]["iso"])
				$slang = '/'.$lang;
			break;
		/*******************************************************************************************/
		case 'suffix_subdomain'://en.domain.com/link
			$subdomains = explode('.',$_SERVER['HTTP_HOST']); 
			$suffix = array_shift($subdomains);//dabū valodas suffix
			if(array_key_exists($suffix,$languages_isoes))//ir norādīta eksistējoša valoda
			{
				$lang = $suffix;
				if($lang == $languages[0]["iso"])
				{
					//redirektējam bez pirmās valodas
					header("location: http://".implode('.',$subdomains).'/'.implode('/',$get));
					exit();
				}
			}
			else
			{
				$lang = $languages[0]["iso"];
			}
			break;
		/*******************************************************************************************/
		case 'unique_link'://www.domain.com/link-en
			get_fields($fields, $field_names, $fields_ids);
			$links = $get;
			//meklējam valodu pēc linka
			while(!empty($links))
			{
				$lang_link = array_pop($links);//pārbauda linku no beigām pa vienam
				$query = "
					SELECT
						smd.*
					FROM
						".PREFIX."meta
					#LEFT JOIN
						#".PREFIX."templates ON template_id = t_id
					JOIN
						".PREFIX."meta_data AS smd ON id = meta_id
					WHERE
						field_id = '".$fields_ids["url"]."'
						AND field_content = '".mysql_real_escape_string($lang_link)."'
						AND parent_id <> '-2'
					#ORDER BY ordered, id ASC 
					";
				$res = mysql_query($query);
				//ja atrod linku
				if(mysql_num_rows($res) > 0) {
					$row = mysql_fetch_assoc($res);	
					$lang = $languages_keys[$row["language_id"]]["iso"];
					break;
				}				
			}
			//out('|'.$lang.'|');

			//ja nav valoda noteikta
			if(empty($lang))
			{
				//ja tiek mainīta valoda ar suffixu
				if(array_key_exists($get[0],$languages_isoes))//ir norādīta eksistējoša valoda
				{
					$lang = $get[0];
					unset($get[0]);
				}
				//ja valoda ir saglabājusies cepumā un tāda eksistē
				elseif(!empty($cookie_language) && array_key_exists($cookie_language,$languages_isoes) )
				{
					$lang = $cookie_language;
				}
				else
				{
					$lang = $languages[0]["iso"];
					$ip = $_SERVER['REMOTE_ADDR'];
					$details = json_decode(@file_get_contents("http://ipinfo.io/$ip"));
					if(empty($details))
					{
						$details = json_decode(@file_get_contents("http://freegeoip.net/json/$ip"));
					}
					//$details->city = "Moscow";
					//$details->region = "Moscow";
					//$details->country = "ru";
					//$details->loc = "55.7005663,37.618636";
					if(!empty($details))
					{
						if(!empty($details->country))
						{
							$iso = strtolower($details->country);
						}
						elseif(!empty($details->country_code))
						{
							$iso = strtolower($details->country_code);
						}
					}
					if(array_key_exists($iso,$languages_isoes))
					{
						$lang = $iso;
					}
					//out($lang);
				}
			}
			//out($lang);			
			setcookie("language", "", time()-3600, "/");
			setcookie("language", $lang, time()+(60*60*24*365), "/");
			$_COOKIE["language"] = $lang;
			
			out_time(microtime(true), __FILE__, __LINE__);
			break;
		/*******************************************************************************************/
		case 'unique_subdomain'://subdomain-en.domain.com/link
			get_fields($fields, $field_names, $fields_ids);
			$subdomains = explode('.',$_SERVER['HTTP_HOST']); 
			$suffix = array_shift($subdomains);//dabū pirmo subdomēnu
			$query = "
				SELECT
					smd.*
				FROM
					storage_meta
				LEFT JOIN
					storage_templates ON template_id = t_id
				JOIN
					storage_meta_data AS smd ON id = meta_id
				WHERE
					field_id = '".$fields_ids["url"]."' AND
					field_content = '".mysql_real_escape_string($suffix)."' AND
					parent_id <> '-2'
				ORDER BY
					ordered, id ASC 
				";
			$res = mysql_query($query);
			if(mysql_num_rows($res) > 0) {
				$row = mysql_fetch_assoc($res);	
				$lang = $languages_keys[$row["language_id"]]["iso"];
			}	
			$lang = !empty($lang) ? $lang : $languages[0]["iso"];
			break;
		/*******************************************************************************************/
	}	
	$data["cat"] = $get;	
}
	
function langbar($cat, &$langbar)
{
	global $lang;
	global $languages_keys;
	global $sub_domain;
	global $domain;
	
	if(!empty($sub_domain) && ($sub_domain != 'www'))
	{
		if(meta("S",array("template"=>"sub_domain","lang"=>$lang),$tmp_sub_domains))
		{
			foreach($tmp_sub_domains as $skey => $sval)
			{
				if($sval["name"] == $sub_domain)
				{
					$top_id = $sval["id"];					
				}
			}
		}
	}
	if(!empty($cat))
	{
		foreach($languages_keys as $key => $val)
		{
			meta("S",array("id"=>$cat["id"],"lang"=>$val["iso"]),$lang_meta[$key]);
			if(!empty($sub_domain) && ($sub_domain != 'www') && !empty($top_id))
			{
				$pre_domain = meta("S",array("id"=>$top_id,"lang"=>$val["iso"]),$tmp_pre_dom) ? $tmp_pre_dom[0]["name"] : '';
				//out($pre_domain);
			}
			$langbar[$key] = (!empty($pre_domain) ? ('http://'.$pre_domain.'.'.$domain.'/') : '').get_product_url((!empty($lang_meta[$key][0]["url"])?$lang_meta[$key][0]["url"]:''),$val["iso"]);
			//out($langbar[$key]);
		}
		//out($langbar);
		return true;
	}
	return false;
}
?>
