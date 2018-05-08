<?php
$say_lang["lv"] = array	(
		'nulle','viens','divi','trīs','četri','pieci','seši','septiņi','astoņi','deviņi','desmit',
		'vienpadsmit','divpadsmit','trīspadsmit','četrpadsmit','piecpadsmit','sešpadsmit',
		'septiņpadsmit','astoņpadsmit','deviņpadsmit',
		'divdesmit',30=>'trīsdemit',40=>'četrdesmit',50=>'piecdesmit',60=>'sešdesmit',
		70=>'septiņdesmit',80=>'astoņdesmit',90=>'deviņdesmit',
		'100'=>'simts','100x'=>'simti','1000'=>'tūkstotis','1000x'=>'tūkstoši',
		'1000000'=>'miljons','1000000x'=>'miljoni','1000000000'=>'miljards','1000000000x'=>'miljardi',
		//EUR
		'eur'=>'eiro',
		'eurx'=>'eiro',
		'eurs'=>'cents',
		'eursx'=>'centi',
		'eurs0'=>'centu',
		//USD
		'usd'=>'dolārs',
		'usdx'=>'dolāri',
		'usds'=>'cents',
		'usdsx'=>'centi',
		'usds0'=>'centu',
		//GBP
		'gbp'=>'mārciņa',
		'gbpx'=>'mārciņas',
		'gbps'=>'penijs',
		'gbpsx'=>'peniji',
		'gbps0'=>'peniju',
	);
$say_lang["en"] = array	(
		'zero','one','two','three','four','five','six','seven','eight','nine','ten',
		'eleven','twelve','thirteen','fourteen','fifteen','sixteen',
		'seventeen','eighteen','nineteen',
		'twenty',30=>'thirty',40=>'forty',50=>'fifty',60=>'sixty',
		70=>'seventy',80=>'eighty',90=>'ninety',
		'100'=>'hundred','100x'=>'hundreds','1000'=>'thousand','1000x'=>'thousands',
		'1000000'=>'million','1000000x'=>'millions','1000000000'=>'billion','1000000000x'=>'billions',
		//EUR
		'eur'=>'euro',
		'eurx'=>'euro',
		'eurs'=>'cent',
		'eursx'=>'cents',
		'eurs0'=>'cents',
		//USD
		'usd'=>'dollar',
		'usdx'=>'dollars',
		'usds'=>'cent',
		'usdsx'=>'cents',
		'usds0'=>'cents',
		//GBP
		'gbp'=>'pound',
		'gbpx'=>'pounds',
		'gbps'=>'penny',
		'gbpsx'=>'pennies',
		'gbps0'=>'pennies',
	);
$say = array();
function say($num)
{	
	global $say;
	if (($tmp=floor($num/1000000000))>=1)
	return say($tmp).' '.$say['1000000000'.($tmp>1?'x':'')].' '.say($num-$tmp*1000000000);
	if (($tmp=floor($num/1000000))>=1)
	return say($tmp).' '.$say['1000000'.($tmp>1?'x':'')].' '.say($num-$tmp*1000000);
	if (($tmp=floor($num/1000))>=1)
	return say($tmp).' '.$say['1000'.($tmp>1?'x':'')].' '.say($num-$tmp*1000);
	if (($tmp=floor($num/100))>=1)
	return say($tmp).' '.$say['100'.($tmp>1?'x':'')].' '.say($num-$tmp*100);
	if (($tmp=floor($num/10))>=2)
	return $say[$tmp*10].' '.say($num-$tmp*10);
	if ($num>0)
	return $say[$num];
}
function spell($num,$lang = '',$s_cur = 'eur')
{
	global $say;
	global $say_lang;
	$say = !empty($say_lang[$lang]) ? $say_lang[$lang] : $say_lang["lv"];
	return say($tmp=floor($num)). //[(n)]n
	' '.$say[$s_cur.(floor($num-floor($num/10)*10)>1?'x':((floor($num)%10==0)?'x':(floor($num)%100==11?'x':'')))].', './/eur
	str_pad($tmp=round($num-$tmp,2)*100,2,0,STR_PAD_LEFT).' './/nn
	$say[$s_cur.'s'.(($tmp2=($tmp%10))>1?'x':($tmp2==0?'0':($tmp==11?'x':'')))];//cnt
}
function set_currencies($currencies,$online = true)
{
	if(!empty($currencies) && array_filter($currencies))
	{
		if($online)
		{
			$lb_courses = @simplexml_load_file("https://www.bank.lv/vk/ecb.xml");
			foreach($lb_courses->Currencies->children() as $cur)
			{
				if(!empty($cur->ID) && !empty($cur->Rate) && ($cur->ID != "eur") && !empty($currencies[strtolower((string)($cur->ID))]))   
				{
					$currencies[strtolower((string)($cur->ID))]["rate"] = (string)($cur->Rate);
				}
			}
		}
		$_SESSION["currencies"] = $currencies;
	}
}
function get_currency($default_currency)
{
	if(isset($_COOKIE["currency"]) && !empty($_SESSION["currencies"][$_COOKIE["currency"]]))
	{
		return $_COOKIE["currency"];
	}
	else
	{
		return $default_currency;
	}
}
function set_currency($currency)
{
	if(!empty($currency) && !empty($_SESSION["currencies"][$currency]))
	{
		$_SESSION["currency"] = $_SESSION["currencies"][$currency];
	}
}
function get_arh_name($date)
{
	$month = array(
			"lv"	=>	array(
						1	=>	"Janvāris",
						2	=>	"Februāris",
						3	=>	"Marts",
						4	=>	"Aprīlis",
						5	=>	"Maijs",
						6	=>	"Jūnijs",
						7	=>	"Jūlijs",
						8	=>	"Augusts",
						9	=>	"Septembris",
						10	=>	"Oktobris",
						11	=>	"Novembris",
						12	=>	"Decembris",
						),
			"en"	=>	array(
						1	=>	"January",
						2	=>	"February",
						3	=>	"March",
						4	=>	"April",
						5	=>	"May",
						6	=>	"June",
						7	=>	"July",
						8	=>	"August",
						9	=>	"September",
						10	=>	"October",
						11	=>	"November",
						12	=>	"December",
						),
			"ru"	=>	array(
						1	=>	"Январь",
						2	=>	"Февраль",
						3	=>	"Март",
						4	=>	"Апрель",
						5	=>	"Май",
						6	=>	"Июнь",
						7	=>	"Июль",
						8	=>	"Август",
						9	=>	"Сентябрь",
						10	=>	"Октябрь",
						11	=>	"Ноябрь",
						12	=>	"Декабрь",
						),
			);
	global $lang;
	$lang = empty($lang) ? 'lv' : $lang;
	$name = $date;
	$name = $month[$lang][(int)$date];
	return $name;
}
function get_week_days($days,$type="L")
{
	$dienas["L"] = array(
			"lv"	=>	array(
						1	=>	"Pirmdiena",
						2	=>	"Otrdiena",
						3	=>	"Trešdiena",
						4	=>	"Ceturtdiena",
						5	=>	"Piektdiena",
						6	=>	"Sestdiena",
						7	=>	"Svētdiena",
						),
			"en"	=>	array(
						1	=>	"Monday",
						2	=>	"Tuesday",
						3	=>	"Wednesday",
						4	=>	"Thursday",
						5	=>	"Friday",
						6	=>	"Saturday",
						7	=>	"Sunday",
						),
			"ru"	=>	array(
						1	=>	"Понедельник",
						2	=>	"Вторник",
						3	=>	"Среда",
						4	=>	"Четверг",
						5	=>	"Пятница",
						6	=>	"Суббота",
						7	=>	"Воскресенье",
						),
			);
	$dienas["S"] = array(
			"lv"	=>	array(
						1	=>	"Pr",
						2	=>	"Ot",
						3	=>	"Tr",
						4	=>	"Ce",
						5	=>	"Pk",
						6	=>	"Se",
						7	=>	"Sv",
						),
			"en"	=>	array(
						1	=>	"Mo",
						2	=>	"Tu",
						3	=>	"We",
						4	=>	"Th",
						5	=>	"Fr",
						6	=>	"Sa",
						7	=>	"Su",
						),
			"ru"	=>	array(
						1	=>	"Пн",
						2	=>	"Вт",
						3	=>	"Ср",
						4	=>	"Чт",
						5	=>	"Пт",
						6	=>	"Сб",
						7	=>	"Вс",
						),
			);
	global $lang;
	global $languages;
	$dlang = !empty($lang) ? $lang : $languages[0]["iso"];
	
	$day = array();
	$days = explode(",",$days);
	foreach($days as $key => $val)
	{
		if(!empty($val))
		{
			$day[$key] = explode("/",$val);
			foreach($day[$key] as $k => $v)
			{
				$day[$key][$k] = $dienas[$type][$dlang][$v];
			}
			$day[$key] = split_data($day[$key],$type);
		}
	}
	$days = implode(", ",$day);
	return $days;
}
function split_data($data,$type)
{
	$split = ($type=="L") ? ('<hr style="margin:0px;height:1px;">') : (" / ");
	if(!is_array($data))
	{
		$data = explode(" / ",$data);
	}
	$data = implode($split,$data);
	return $data;
}
function unlock_pages($user_id)
{
	$resO = mysql_query("SELECT * FROM ".PREFIX."meta WHERE opened = '".$user_id."'");
	if(mysql_num_rows($resO) > 0)
	{
		while($rowO = mysql_fetch_assoc($resO))
		{
			if(!empty($rowO["id"]))
			{
				mysql_query("UPDATE ".PREFIX."meta SET opened = '0' where id = '".$rowO["id"]."' ;");
				set_meta_row($rowO["id"]);
			}
		}
	}
}
function secure_upload_dirs()
{
	$upload_dirs = array(
				'/images/',
				'/images/galleries/',
				'/images/meta/',
				'/images/others/',
				'/images/temp/',
				'/images/users/',
				'/images/fade/',
				'/images/fade/lv/',
				'/images/fade/en/',
				'/images/fade/ru/',
			);
	foreach($upload_dirs as $key => $val)
	{
		$file[$key] = '..'.$val.'.htaccess';
		if(is_writable($file[$key]))
		{
			if(!$fp = fopen($file[$key], 'w'))
			{
				
			}
			else
			{
				if(fwrite($fp,
'<IfModule mod_php5.c>
php_flag engine off
</IfModule>
<IfModule mod_php4.c>
php_flag engine off
</IfModule>'
						) === FALSE)
				{
					//echo "Cannot write to file";
				}
			}
			fclose($fp);
		}
		//secure_dir_subdirs('..'.$val);
	}
}
function secure_dir_subdirs($dir)
{
	if($handle = opendir($images_path)) 
	{
		while (false !== ($file = readdir($handle))) 
		{
			switch (substr($file, -4))
			{
			case ".jpg":
			case ".JPG":
			case "jpeg":
			case "JPEG":
			case ".png":
			case ".PNG":
			case ".gif":
			case ".GIF":
				$images[$i] = $file;
				$like[$i] = "/images/others/".$images[$i];
				$img_query[$i] = "SELECT * ".
						"FROM ".PREFIX."meta_data ".
						"WHERE 
							field_content LIKE '%".$like[$i]."%'  ".
						"ORDER BY meta_id ASC ";
				$img_res[$i] = mysql_query($img_query[$i]) or die(mysql_error().$img_query[$i]);
							
				if(mysql_num_rows($img_res[$i]) > 0)
				{
					while($row[$i] = mysql_fetch_assoc($img_res[$i]))
					{
						//out($languages_keys);
						if (empty($row[$i]["meta_id"])) break;
						meta("S",array("id"=>$row[$i]["meta_id"],"lang"=>$languages_keys[$row[$i]["language_id"]]["iso"]),$data[$i]);
						$locked[$i][$languages_keys[$row[$i]["language_id"]]["iso"]] = $data[$i][0];
					}
				}
				$i++;
				break;
			}
		}	
		closedir($handle);
	}
}
function get_product_url($url,$xlang = 0)//OLD
{
	return get_long_link($url,$xlang);
}
function get_long_link($url,$xlang = 0)//NEW
{
	if(!empty($url))
	{
		global $get_long_link_array;
		global $lang;
		$xlang = !empty($xlang) ? $xlang : $lang;
		$lang_id = langid_from_iso($xlang);
		
		$is_work_table = false;
		$query = "SHOW TABLES LIKE '".PREFIX."work_table_".$lang_id."'";
		$res = mysql_query($query);
		if(mysql_num_rows($res) > 0)
		{
			$is_work_table = true;
		}
		
		if($is_work_table)
		{
			$query = "SELECT 
					id,
					parent_id,
					hide_link,
					template_id,
					template,
					url
				FROM ".PREFIX."work_table_".$lang_id."
				WHERE 
					url = '".$url."'
				LIMIT 1";
		}
		else
		{
			$query = "SELECT 
					meta_id AS id,
					(SELECT parent_id FROM ".PREFIX."meta WHERE id = meta_id LIMIT 1) AS parent_id,
					(SELECT hide_link FROM ".PREFIX."meta WHERE id = meta_id LIMIT 1) AS hide_link,
					(SELECT template_id FROM ".PREFIX."meta WHERE id = meta_id LIMIT 1) AS template_id,
					(SELECT template FROM ".PREFIX."templates WHERE t_id = template_id LIMIT 1) AS template,
					field_content AS url
				FROM ".PREFIX."meta_data
				WHERE 
					field_id = '-6'
					AND field_content = '".$url."'
					AND language_id = '$lang_id'
				LIMIT 1";
		}
		$res = mysql_query($query);
		if(mysql_num_rows($res) > 0)
		{
			$row = mysql_fetch_assoc($res);
			if(!empty($row["id"]))
			{
				if(!empty($get_long_link_array[$lang_id][$row["id"]]))
				{
					//taking from array
					$url = $get_long_link_array[$lang_id][$row["id"]];
				}
				else
				{
					//nmaking long link
					$parent_id = $row["parent_id"];
					if(($row["template"]=="home") && !empty($row["hide_link"])) $url = '';
					while($parent_id > 0)
					{
						$query_wh[$parent_id] = "SELECT 
								id,
								parent_id,
								hide_link,
								(SELECT field_content FROM ".PREFIX."meta_data WHERE meta_id = id AND field_id = '-6' AND language_id = '$lang_id') AS url
							FROM ".PREFIX."meta
							WHERE 
								id = '$parent_id'
							LIMIT 1";
						$res_wh[$parent_id] = mysql_query($query_wh[$parent_id]);
						if(mysql_num_rows($res) > 0)
						{
							$row_wh[$parent_id] = mysql_fetch_assoc($res_wh[$parent_id]);
							$url = (empty($row_wh[$parent_id]["hide_link"])
								?
									(!empty($row_wh[$parent_id]["url"]) ? ($row_wh[$parent_id]["url"].'/'):'')
								:
									''
								).$url;
							$parent_id = $row_wh[$parent_id]["parent_id"];												
						}
						else
						{
							$parent_id = 0;
						}
					}
					$get_long_link_array[$lang_id][$row["id"]] = $url;
				}				
			}
		}
	}
	
	return '/'.$url;
}
function replace_spec_chars($a) 
{
	$_cm = array (
			"A" => "a",
			"B" => "b",
			"C" => "c",
			"D" => "d",
			"E" => "e",
			"F" => "f",
			"G" => "g",
			"H" => "h",
			"I" => "i",
			"J" => "j",
			"K" => "k",
			"L" => "l",
			"M" => "m",
			"N" => "n",
			"O" => "o",
			"P" => "p",
			"R" => "r",
			"S" => "s",
			"T" => "t",
			"U" => "u",
			"V" => "v",
			"Z" => "z",
			"Q" => "q",
			"W" => "w",
			"Y" => "y",
			"X" => "x",
			"ē" => "e",
			"Ē" => "e",
			"ŗ" => "r",
			"Ŗ" => "r",
			"ū" => "u",
			"Ū" => "u",
			"ī" => "i",
			"Ī" => "i",
			"ō" => "o",
			"Ō" => "o",
			"ā" => "a",
			"Ā" => "a",
			"š" => "s",
			"Š" => "s",
			"ģ" => "g",
			"Ģ" => "g",
			"ķ" => "k",
			"Ķ" => "k",
			"ļ" => "l",
			"Ļ" => "l",
			"ž" => "z",
			"Ž" => "z",
			"č" => "c",
			"Č" => "c",
			"ņ" => "n",
			"Ņ" => "n",
//krievy burti
						
			"А" => "a",
			"а" => "a",
			"Б" => "b",
			"б" => "b",
			"В" => "v",
			"в" => "v",
			"Г" => "g",
			"г" => "g",
			"Д" => "d",
			"д" => "d",
			"Е" => "e",
			"е" => "e",
			"Ё" => "e",
			"ё" => "e",
			"Ж" => "z",
			"ж" => "z",
			"З" => "z",
			"з" => "z",
			"И" => "i",
			"и" => "i",
			"Й" => "j",
			"й" => "j",
			"К" => "k",
			"к" => "k",
			"Л" => "l",
			"л" => "l",
			"М" => "m",
			"м" => "m",
			"Н" => "n",
			"н" => "n",
			"О" => "o",
			"о" => "o",
			"П" => "p",
			"п" => "p",
			"Р" => "r",
			"р" => "r",
			"С" => "s",
			"с" => "s",
			"Т" => "t",
			"т" => "t",
			"У" => "u",
			"у" => "u",
			"Ф" => "f",
			"ф" => "f",
			"Х" => "h",
			"х" => "h",
			"Ц" => "c",
			"ц" => "c",
			"Ч" => "c",
			"ч" => "c",
			"Ш" => "s",
			"ш" => "s",
			"Щ" => "sc",
			"щ" => "sc",
			"Ъ" => "",
			"ъ" => "",
			"Ы" => "i",
			"ы" => "i",
			"Ь" => "j",
			"ь" => "j",
			"Э" => "e",
			"э" => "e",
			"Ю" => "ju",
			"ю" => "ju",
			"Я" => "ja",
			"я" => "ja",
//other languages
			"É" => "e",
			"é" => "e",
			"ó" => "o",
//special characters
			"–" => "-",//special long sign
			" " => "-",
			"." => "-",
			"," => "",
			":" => "",
			";" => "",	
			'"' => "",
			'“' => "",//different quotes
			'”' => "",//different quotes
			"'" => "",
			"`" => "",
			"‘" => "",
			"’" => "",
			"/" => "",
			"?" => "",
			"!" => "",
			"*" => "x",
			"\\" => "",
			"%" => "",
			"&" => "",
			"+" => "",
			" & " => "-",
			" + " => "-",
			"-&-" => "-",
			"-+-" => "-",
			"---" => "-",
			"--" => "-",
			" - " => "-",
	);
	return strtr(strip_tags($a), $_cm);
}
function get_short_date($date)
{
	/*$diff = $now = date_timestamp_get(date_create()) - date_timestamp_get(date_create($date));
	if($diff < (60*60*24))// 1 dn
	{
		$h = round(($diff/60)/60);
		$h = "".$h;
		$stundas = "stundām";
		if(substr($h, -1)=="1")
		{
			if($h!="11") $stundas = "stundas";
		}
		$date = "pirms ".$h." $stundas.";
	}
	if($diff < (60*60))// 1 h
		$date = "pirms ".round($diff/60)." min.";
	if($diff < 60)// 1 min
		$date = "pirms ".$diff." sek.";*/
	return ($date);
}
function file_date($file="")
{
	$date = '';
	if (file_exists($file))
	{
		$date = filemtime($file);
	}
	return $date;
}
function file_size($file="")
{
	$size = '';
	if (file_exists($file))
	{
		$size = filesize($file);
	}
	return $size;
}
function optimize_cats(&$cat)
{
	global $lang;
	global $languages;
	global $languages_keys;
	global $page;
	global $dont_make_submenu;
	global $sub_domain;
	$tmp_cat = array();
	$aut = false;
	$arh = false;
	$tag = false;
	$order = false;
	$foreach_brake = false;
	krsort($cat);//sāk no beigām
	//out($lang);
	//out($cat);die();
	foreach($cat as $key => $val)
	{
		//out('|'.$val.'|');
		if(!empty($val) && is_numeric($val))
		{
			$page = ($page==1) ? $val : $page;
		}
		switch(substr($val, 0, 4))
		{
		case "aut:":     
			$aut = empty($aut) ? substr($val, 4) : $aut;
			break;
		case "arh:":     
			$arh = empty($arh) ? substr($val, 4) : $arh;
			break;
		/*case "tag:":
			$tag = empty($tag) ? substr($val, 4) : $tag;
			break;*/
		case "asco":
		case "dsco":
			$order = empty($order) ? $val : $order;
			break;
		default:
			if(!empty($val) && meta("S",array("alert"=>0,"url"=>$val,"lang"=>$lang),$m_data))
			{
				if(!empty($m_data[0]["tag"]))
				{
					$tag = (empty($tag) ? '' : ($tag.'/')) . $m_data[0]["parent_id"].'#'.$m_data[0]["id"];
				}
				else
				{
					//get meta_cat sub_menu
					if(empty($dont_make_submenu))
					meta("S",array("alert"=>0,"parent_id"=>$m_data[0]["id"],"lang"=>$lang),$m_data[0]["sub_menu"]);
					
					$parent_id = $m_data[0]["parent_id"];
					
					$meta_cat = $m_data[0];
					
					$meta_cat["aut"] = $aut;
					$meta_cat["arh"] = $arh;
					$meta_cat["tag"] = $tag;
					$meta_cat["order"] = $order;
					$meta_cat["page"] = $page;
										
					$tmp_cats = array();
					while($parent_id && meta("S",array("alert"=>0,"id"=>$parent_id,"lang"=>$lang,"limit"=>1),$m_data[$parent_id]))
					{
						//meta("S",array("alert"=>0,"parent_id"=>$m_data[$parent_id][0]["id"],"lang"=>$lang),$m_data[$parent_id][0]["sub_menu"]);
						$tmp_cats[] = $m_data[$parent_id][0];
						$parent_id = $m_data[$parent_id][0]["parent_id"];
					}
					krsort($tmp_cats);
					$tmp_cat[0] = $meta_cat;
					foreach($tmp_cats as $tc_key => $tc_val)
					{
						$tmp_cat[] = $tc_val;
					}
					$tmp_cat[] = $meta_cat;
					$foreach_brake = true;
				}
			}
			break;
		}
		if($foreach_brake) break;
	}
	$cat = !empty($tmp_cat) ?
			$tmp_cat : 
			(
				(meta("S",array("alert"=>0,"lang"=>$lang,"limit"=>1,"orderby"=>"id ASC","where"=>"id>0"),$def_meta)) ? 
					array(0=>$def_meta[0],1=>$def_meta[0]) : 
					array()
			);	
}
function clear_links($cat_data)
{
	global $slang;
	
	$get = !empty($_GET["variables"]) ? $_GET["variables"] : '';
	$get = explode('/',$get);
	
	foreach($get as $key => $val)
	{
		if( !empty($val) && !(is_numeric($val)) )
		{
			$new_get[] = $val; 
		}
	}
	$get = !empty($new_get) ? $new_get : $get;
	
	$cat_get = array();
	foreach($cat_data as $key => $val)
	{
		if($key>0)
		{
			if(
				//RĀDAM, ja nav jāslēpj
				empty($val["hide_link"])
				||
				//RĀDAM, ja jāslēpj, bet nav apakšlīmenis
				( !empty($val["hide_link"]) && empty($cat_data[$key+1]["id"]) && ($val["template"]!="home") )
			)
			{
				$cat_get[] = $val["url"];
			}
		}
	}
	if(!empty($cat_data[0]["arh"]))
	{
		$cat_get[] = 'arh:'.$cat_data[0]["arh"];
	}
	
	$old_location = '/'.implode('/',$get);
	$new_location = $slang . (!empty($cat_get) ? ('/'.implode('/',$cat_get) ) : (empty($slang) ? '/' :'') );
	
	//out($old_location);
	//out($new_location);
	
	if($new_location!=$old_location)
	{
		header("Location: ".$new_location);
		exit();
	}
}
function dig_templates($t_lev=NULL)
{
	$where = ($t_lev!==NULL) ? "WHERE t_p_id = $t_lev" : '';
	$rest = mysql_query("SELECT * FROM ".PREFIX."templates $where ORDER BY t_id") or die(mysql_error());
	if(mysql_num_rows($rest) > 0)
	{
		while($rowt = mysql_fetch_assoc($rest))
		{
			if($rowt["t_id"] > 0)
				$rowt["sub"] = dig_templates($rowt["t_id"]);
			$templates[$rowt["t_id"]] = $rowt;
		}		
	}
	return !empty($templates) ? $templates : array();
}
function langid_from_iso($lang = '')
{
	global $languages;
	$lang_id = 0;
	foreach($languages as $key => $val)
	{
		if($val["iso"]==$lang)
		{
			$lang_id = $val["id"];
			break;
		}
	}
	return $lang_id;
}
function get_fields(&$fields = array(), &$field_names = array(), &$fields_ids = array(), $template_id = NULL)
{
	$field_query = "SELECT * FROM `".PREFIX."fields` ORDER BY `ordered` ASC, `field_id` ASC;";
	if($template_id > -1)
	{
		$added_fields_ids = array();
		$res = mysql_query("SELECT * FROM `".PREFIX."templates_fields` WHERE `t_id` = 0 OR `t_id` = '$template_id';");
		if(mysql_num_rows($res) > 0)
		{
			while($row = mysql_fetch_assoc($res))
			{
				if (empty($row["field_id"])) break;
				$added_fields_ids[] = $row["field_id"];
			}
		}
		$field_query = "SELECT * FROM `".PREFIX."fields`
				WHERE `field_id` < 0 OR `field_id` = '".implode("' OR `field_id` = '",$added_fields_ids)."'
				ORDER BY `ordered` ASC, `field_id` ASC ;";
	}
	
	$fields_tmp = array();
	$res = mysql_query($field_query);
	if(mysql_num_rows($res) > 0)
	{
		while($row2 = mysql_fetch_assoc($res))
		{
			if (empty($row2["field_id"])) break;
			$fields_tmp[] = $row2;
		}
	}
	foreach($fields_tmp as $key => $val)
	{
		$fields[$val["field_id"]] = $val;
		$field_names[$val["field_id"]] = $val["field_name"];
		$fields_ids[$val["field_name"]] = $val["field_id"];
	}
}
function is_super_admin() {
	global $user;
	if(!empty($user[0]["admin"]) && ($user[0]["admin"] < 2))
		return true;
	else
		return false;
}
function is_admin() {
	global $user;
	if(!empty($user[0]["admin"]) && ($user[0]["admin"] < 3))
		return true;
	else
		return false;
}
function is_user() {
	global $user;
	if(!empty($user[0]["admin"]) && ($user[0]["admin"] < 4))
		return true;
	else
		return false;
}
function check_adult()
{
	//setcookie("adult", "", time()-3600, "/");
	
	$agent = $_SERVER['HTTP_USER_AGENT'];
	//mysql_query("INSERT INTO ".PREFIX."events SET action = '$agent'");
	if(strpos($agent,'Google') !== false) return true;//Google
	if(strpos($agent,'facebookexternalhit') !== false) return true;//Facebook
	if(!empty($_COOKIE["adult"])) return true;
	return false;
}
function to_number($number, $decimal_places = 2, $thousand_separator = '')
{
	return number_format($number, $decimal_places, '.', $thousand_separator);
}
function out($data=array())
{
	echo '<pre style="text-align:left;font-size:14px;">';
	if(!empty($data))
	{
		foreach($GLOBALS as $var_name => $value) {
			if ($value === $data) {
				echo $var_name.' = ';
			}
		}
	}
	$pr = print_r($data, true);
	echo htmlentities($pr, ENT_QUOTES, "UTF-8");
	echo '</pre>';
}
function bill_nr($id)
{
	return str_pad($id, 10, "0", STR_PAD_LEFT);
}
function product_code($id)
{
	return str_pad($id, 5, "0", STR_PAD_LEFT);
}
function comment_date_format($date)
{
	global $settings;
	if(!empty($settings["comment_date_format"]))
	{
		$format_arr = explode('M',$settings["comment_date_format"]);
		foreach($format_arr as $key => $val)	
		{
			$date_arr[$key] = date($val, strtotime($date));
		}
		$date = implode(mb_substr(get_arh_name(date("n", strtotime($date))),0,3,'utf-8'),$date_arr);
	}
	return $date;
}
function get_video_frames($links,$client,$rel=0,$controls=1,$jsapi=1)
{
	switch($client)
	{
		case "yt":
			
			$links = preg_replace('/\s+/', '', $links);
			$links = explode(";",$links);
			
			foreach($links as $key => $val)
			{
				parse_str( parse_url( $val, PHP_URL_QUERY ), $video_vars[$key] );
				$video_id[$key] = $video_vars[$key]['v'];   
		
				$links[$key] = '<div class="video_frame">';
				$links[$key] .= '<iframe src="https://www.youtube.com/embed/'.$video_id[$key].
							'?rel='.$rel.
							'&amp;controls='.$controls.
							'&amp;showinfo=0'.(!empty($jsapi) ? '&amp;enablejsapi=1' : '').
							'" frameborder="0" allowfullscreen></iframe>';
				$links[$key] .= '</div>';
			}
			break;			
	}
	return $links;
}
function set_meta_row($id)
{
	global $languages;
	if(!empty($id))
	{
		//defaultās vērtības
		$query_values = array("id"=>$id);
		
		//Dabūjam meta ierakstu
		$query = "SELECT 
				*,
				(SELECT `template` FROM `".PREFIX."templates` WHERE `t_id` = `template_id` LIMIT 1) AS template
			FROM `".PREFIX."meta` WHERE `id` = '$id'";
		$res = mysql_query($query);			
		if(mysql_num_rows($res) > 0)
		{
			$query_values = mysql_fetch_assoc($res);
		}
		$query_values_set = '';
		foreach($query_values as $vkey => $vval)
		{
			$query_values_set .= " `$vkey` = '".(!empty($vval) ? mysql_real_escape_string($vval) : "0")."',";
		}
		$query_values_set = rtrim($query_values_set, ",");
		
		foreach($languages as $key => $val)
		{
			//pārbauda, vai ir tāda tabula
			$query = "SHOW TABLES LIKE '".PREFIX."work_table_".$val["id"]."'";
			$res = mysql_query($query);
			if(mysql_num_rows($res) > 0)
			{
				//pārbaudam vai ir tāds ieraksts
				$query = "SELECT `id` FROM `".PREFIX."work_table_".$val["id"]."` WHERE `id` = '$id'";
				$res = mysql_query($query);
				if(mysql_num_rows($res) > 0)
				{
					//UPDATE
					$query_start = "UPDATE ";
					$query_end = " WHERE `id` = '$id' ";
				}
				else
				{
					//INSERT
					$query_start = "INSERT INTO ";
					$query_end = "";
				}	
				
				//sagatavojam meta ierakstu
				$set_query = $query_start.PREFIX."work_table_".$val["id"]." SET $query_values_set";
				
				//ievietojam meta ierakstu
				mysql_query($set_query . $query_end);
				
				//dabūjam meta_data ierakstus
				$query = "SELECT 
						md.*,
						(SELECT f.field_name FROM ".PREFIX."fields AS f WHERE f.field_id = md.field_id) AS field_name
					FROM ".PREFIX."meta_data AS md WHERE md.meta_id = '$id' AND (md.language_id = '0' OR md.language_id = '".$val["id"]."')";
				$res = mysql_query($query);
				if(mysql_num_rows($res) > 0)
				{
					while($row = mysql_fetch_assoc($res))
					{
						if(!empty($row["field_name"]))
						{
							mysql_query("ALTER TABLE `".PREFIX."work_table_".$val["id"]."` ADD `".$row["field_name"]."` text ");
							mysql_query("UPDATE `".PREFIX."work_table_".$val["id"]."` SET `".$row["field_name"]."` = '".mysql_real_escape_string($row["field_content"])."' WHERE id = '$id' ");
						}
					}
				}
			}
		}
		if(function_exists("set_meta_row_plus"))
		{
			set_meta_row_plus($id);
		}
	}
}
function set_users_row($id)
{
	global $languages;
	if(!empty($id))
	{
		//defaultās vērtības
		$query_values = array("id"=>$id);
		
		//Dabūjam users ierakstu
		$query = "SELECT 
				*
			FROM `".PREFIX."users` WHERE `id` = '$id'";
		$res = mysql_query($query);
		if(mysql_num_rows($res) > 0)
		{
			$query_values = mysql_fetch_assoc($res);
		}
		$query_values_set = '';
		foreach($query_values as $vkey => $vval)
		{
			switch ($vkey)
			{
				case "last_seen":
					$query_values_set .= " `$vkey` = ".(!empty($vval) ? ("'".mysql_real_escape_string($vval)."'") : 'NULL').",";
					break;
				default:
					$query_values_set .= " `$vkey` = '".mysql_real_escape_string($vval)."',";
			}			
		}
		$query_values_set = rtrim($query_values_set, ",");
		foreach($languages as $key => $val)
		{
			//pārbauda, vai ir tāda tabula
			$query = "SHOW TABLES LIKE '".PREFIX."users_table_".$val["id"]."'";
			$res = mysql_query($query);
			if(mysql_num_rows($res) > 0)
			{
				//pārbaudam vai ir tāds ieraksts
				$query = "SELECT `id` FROM `".PREFIX."users_table_".$val["id"]."` WHERE `id` = '$id'";
				$res = mysql_query($query);
				if(mysql_num_rows($res) > 0)
				{
					//UPDATE
					$query_start = "UPDATE ";
					$query_end = " WHERE `id` = '$id' ";
				}
				else
				{
					//INSERT
					$query_start = "INSERT INTO ";
					$query_end = "";
				}
				
				//sagatavojam users ierakstu
				$set_query = $query_start."`".PREFIX."users_table_".$val["id"]."` SET $query_values_set";
						
				//ievietojam users ierakstu
				mysql_query($set_query . $query_end) or die( mysql_error());				
				
				//dabūjam user_types ierakstus
				$query = "SELECT 
						`type`,
						`permissions`
					FROM `".PREFIX."user_types` WHERE `id` = '".$query_values["admin"]."'";
				$res = mysql_query($query);
				if(mysql_num_rows($res) > 0)
				{
					$row = mysql_fetch_assoc($res);
					if(!empty($row["type"]))
					{
						mysql_query("UPDATE `".PREFIX."users_table_".$val["id"]."` SET `admin_type` = '".($row["type"])."' WHERE `id` = '$id' ");
					}
					if(!empty($row["permissions"]))
					{
						mysql_query("UPDATE `".PREFIX."users_table_".$val["id"]."` SET `user_modes` = '".mysql_real_escape_string($row["permissions"])."' WHERE `id` = '$id' ");
					}
				}
				
				//dabūjam linked_users ierakstus
				$query = "SELECT `linked_user` FROM `".PREFIX."linked_users` WHERE `user_id` = '$id' ";
				$res = mysql_query($query);
				if(mysql_num_rows($res) > 0)
				{
					while($row = mysql_fetch_assoc($res3))
					{
						$linked_users_array[] = $row["linked_user"];
					}
					$linked_users = implode("#",$linked_users_array);
					mysql_query("UPDATE `".PREFIX."users_table_".$val["id"]."` SET `linked_users` = '$linked_users' WHERE `id` = '$id' ");
				}
				
				//dabūjam users_data ierakstus
				$query = "SELECT 
						*
					FROM `".PREFIX."users_data` WHERE `user_id` = '$id' AND (`lang_id` = '0' OR `lang_id` = '".$val["id"]."')";
				$res = mysql_query($query);
				if(mysql_num_rows($res) > 0)
				{
					while($row = mysql_fetch_assoc($res))
					{
						if(!empty($row["name"]))
						{
							mysql_query("ALTER TABLE `".PREFIX."users_table_".$val["id"]."` ADD `".$row["name"]."` text ");
							mysql_query("UPDATE `".PREFIX."users_table_".$val["id"]."` SET `".$row["name"]."` = '".mysql_real_escape_string($row["value"])."' WHERE `id` = '$id' ");
						}
					}
				}
			}
		}
		if(function_exists("set_users_row_plus"))
		{
			set_users_row_plus($id);
		}
	}
}

function get_version()
{
	$version = '3.3.2.0';
	$query = "SELECT `attr` FROM `".PREFIX."modes_attributes` WHERE `mode` = 'version'";
	$res = mysql_query($query);
	if(mysql_num_rows($res) > 0)
	{
		$row = mysql_fetch_assoc($res);
		if(!empty($row["attr"]))
		{
			$version = $row["attr"];
		}
	}
	return $version;
}

function register_domain()
{
	global $update_host;
	$post_parameters["domain"] = $_SERVER['HTTP_HOST'];
	$post_parameters["last_update_time"] = file_date(ROOT.'/update.xml');
	$post_parameters["version"] = get_version();
	
	$http_array = array( 'http' => array(
				'method'  => 'POST',
				'timeout'=> 3,
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => http_build_query($post_parameters),
				)
			);
	$result = @file_get_contents('http://'.$update_host.'/admin/register_domain.php', false, stream_context_create($http_array));
}
/***************************************************************************************************************/
function send_email($sender_email = '',$reciever_email = '',$data)
{
	global $lang;
	global $settings;
	global $languages;
	$response = array("error"=>array());
	
	$domain = array_reverse(explode('.',$_SERVER['HTTP_HOST']));
	$domain = array(
			0 =>	(!empty($domain[1]) ? $domain[1] : 'lauvas'),
			1 =>	(!empty($domain[0]) ? $domain[0] : 'lv')
			);
	
	$reciever_email = !empty($reciever_email) ? $reciever_email : (array_filter($domain) ? ('info@'.implode('.',$domain)) : '');
	
	if(empty($reciever_email))
	{
		$response["error"][] = 'no_reciever_email';
	}
	
	if(!(array_filter($response["error"])))
	{
		$template = !empty($data["template"]) ? $data["template"] : 'email';
		$d_template = !empty($data["template"]) ? ($data["template"]."_") : '';
		$email_lang = !empty($data["lang"]) ? $data["lang"] : (!empty($lang) ? $lang : $languages[0]["iso"]);
		
		lang("S",array("lang"=>$email_lang),$email_lg);
	
		require_once(ROOT."/cms/libs/phpmailer/class.phpmailer.php");
		$mail = new phpmailer();
		
		$subject = !empty($data["subject"]) ? $data["subject"] : (
			(!empty($email_lg[$d_template."mail_subject"]) ? $email_lg[$d_template."mail_subject"] : ( "[language:".$d_template."mail_subject"."]" ) ).
			" ".$_SERVER['HTTP_HOST']);
			
		$reciever_email = str_replace(' ', '', $reciever_email);
		$reciever_email = explode(';',$reciever_email);
		$reciever_email = implode(',',$reciever_email);
		$reciever_email = explode(',',$reciever_email);
		
		$reciever_name = !empty($data["reciever_name"]) ? $data["reciever_name"] : $reciever_email[0];
		
		$cc_mails = !empty($data["cc_mails"]) ? $data["cc_mails"] : '';
		$cc_mails = str_replace(' ', '', $cc_mails);
		$cc_mails = explode(';',$cc_mails);
		$cc_mails = implode(',',$cc_mails);
		$cc_mails = explode(',',$cc_mails);
		
		$bcc_mails = !empty($data["bcc_mails"]) ? $data["bcc_mails"] : '';
		$bcc_mails = str_replace(' ', '', $bcc_mails);
		$bcc_mails = explode(';',$bcc_mails);
		$bcc_mails = implode(',',$bcc_mails);
		$bcc_mails = explode(',',$bcc_mails);
		
		$tmpl = ROOT."/templates";
		if(file_exists("$tmpl/$template.php"))
		{
			$message = include("$tmpl/$template.php");
		}
		else
		{
			$message = '
				<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>'.$_SERVER['HTTP_HOST'].'</title>
				</head>
				<body>
				'.(!empty($data["body"]) ? $data["body"] : '').'
				</body>
				</html>';
		}
	
		/************************************************/		
		
		$sender_email = !empty($sender_email) ? $sender_email : (array_filter($domain) ? ('info@'.implode('.',$domain)) : '');
		$sender_name = !empty($data["sender_name"]) ? $data["sender_name"] : $sender_email;
		
		$mail->Sender	= array_filter($domain) ? ('info@'.implode('.',$domain)) : '';
		$mail->From     = $sender_email;
		$mail->FromName = html_entity_decode($sender_name);
		$mail->Subject	= html_entity_decode($subject);
		$mail->Body	= $message;
		$mail->AltBody	= $message;
		
		ob_start();
		
		foreach($reciever_email as $key => $val)
		{
			$mail->AddAddress($val, $reciever_name);
		}	
		foreach($cc_mails as $cc_mail){
			$mail->AddCC($cc_mail,'');
		}	
		foreach($bcc_mails as $bcc_mail){
			$mail->AddBCC($bcc_mail,'');
		}
			
		//out($mail);die();
		$max_attachments_size = (!empty($settings["max_attachments_size"]) ? $settings["max_attachments_size"] : 6.7) * 1024 * 1024; // 6.7 MB
		$added_attachments_size = 0;
		
		if(!empty($data["attachments"]))
		{
			foreach($data["attachments"]as $key => $val)
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
		}
		
		if($mail->Send())
			$response["status"] = "ok";
		else
			$response["status"] = "There has been a mail error sending mail";
		ob_clean();
		// Clear all addresses and attachments for next loop
		$mail->ClearAddresses();
		$mail->ClearAttachments();
	}
	return $response;
}
?>