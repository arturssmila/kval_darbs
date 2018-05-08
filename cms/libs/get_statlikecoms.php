<?php
//print_r($_POST);
require('../../config.php');
$id = !empty($_POST["id"]) ? $_POST["id"] : die();
$lang = !empty($_POST["lang"]) ? $_POST["lang"] : $languages[0]["iso"];
$like = !empty($_POST["like"]) ? $_POST["like"] : 0;
//out($_POST);
lang("S",array(),$lg);

$small_split = '--##--';
$big_split = '##@@##';
$ip = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];

$user_svg_path = ROOT.'/images/users/';

if(!empty($like))
{	
	$query = "SELECT * FROM ".PREFIX."likes WHERE 
			meta_id = ".$id." AND 
			ip = '".$ip."' AND 
			agent = '".$agent."'
		";
	$rRes = mysql_query($query);
	if(mysql_num_rows($rRes)>0)
	{
		mysql_query("DELETE FROM ".PREFIX."likes WHERE 
				meta_id = ".$id." AND  
				ip = '".$ip."' AND 
				agent = '".$agent."'
			");
	}
	else
	{
		mysql_query("INSERT INTO ".PREFIX."likes SET 
				meta_id = ".$id.", 
				ip = '".$ip."', 
				agent = '".$agent."'
			");
	}
}

$comments = '';
$comments_count = 0;
if(meta("S",array("parent_id"=>$id,"template"=>"comment","orderby"=>"`date` DESC","alert"=>0),$tmp_comm))
{
	$comments_count = count($tmp_comm);
	foreach($tmp_comm as $key => $val)
	{
		if( ( !empty($settings["comment_approoving"]) && empty($val["hide_link"]) ) || empty($settings["comment_approoving"]) )
		{
			get_user("S",array("id"=>$val["creator_id"]),$tmp_comm[$key]["user"]);
			$comments .= '
			<div class="comments">
				<div class="photo">
					<div style="background-image:url('."'";
						if(!empty($tmp_comm[$key]["user"][0]["image"]) && !empty($tmp_comm[$key]["user"][0]["active"]))
						{
							if($tmp_comm[$key]["user"][0]["soc"]=="00")
							{
								//$comments .= '/images/users/';
							}
							$comments .= $tmp_comm[$key]["user"][0]["image"];
						}
						else
						{
							if(!(file_exists($user_svg_path.'noimage.svg')))
							{
								$comments .= '/images/users/noimage.jpg';
							}
						}					
					$comments .= "'".
					');">';
					if(empty($tmp_comm[$key]["user"][0]["image"]) || empty($tmp_comm[$key]["user"][0]["active"]))
					{
						if(file_exists($user_svg_path.'noimage.svg'))
						{										
							$comments .= file_get_contents($user_svg_path.'noimage.svg');
						}
					}
					$comments .= '</div>
				</div>
				<div class="split"><div><span></span></div></div>
				<div class="right">
					<h3>'.(
						($tmp_comm[$key]["user"][0]["active"]) ? 
						( ($tmp_comm[$key]["user"][0]["name"] || $tmp_comm[$key]["user"][0]["surname"]) ? ($tmp_comm[$key]["user"][0]["name"].' '.$tmp_comm[$key]["user"][0]["surname"]) : $tmp_comm[$key]["user"][0]["mail"]) : 
						('<span class="deleted_h3">'.$lg["dzests_lietotajs"].'</span>')
						).
					'</h3>
					<div class="date">'.comment_date_format($val["date"]).'</div>
					<div class="text">'.$val["content"].'</div>';
						if(meta("S",array("parent_id"=>$val["id"],"template"=>"comment","orderby"=>"`date` DESC"),$tmp_answ[$key]))
						{
							$comments_count = $comments_count + count($tmp_answ[$key]);
							foreach($tmp_answ[$key] as $key1 => $val1)
							{
								get_user("S",array("id"=>$val1["creator_id"]),$tmp_answ[$key][$key1]["user"]);
								
								/******************************************************************************/
								$comments .= '
									<div class="comments answer">
										<div class="photo">
											<div style="background-image:url('."'";
											if(!empty($tmp_answ[$key][$key1]["user"][0]["image"]) && !empty($tmp_answ[$key][$key1]["user"][0]["active"]))
											{
												if($tmp_answ[$key][$key1]["user"][0]["soc"]=="00")
												{
													//$comments .= '/images/users/';
												}
												$comments .= $tmp_answ[$key][$key1]["user"][0]["image"];
											}
											else
											{
												if(!(file_exists($user_svg_path.'noimage.svg')))
												{
													$comments .= '/images/users/noimage.jpg';
												}
											}
											$comments .= "'".
											');">';
											if(empty($tmp_answ[$key][$key1]["user"][0]["image"]))
											{
												if(file_exists($user_svg_path.'noimage.svg'))
												{										
													$comments .= file_get_contents($user_svg_path.'noimage.svg');
												}
											}
											$comments .= '</div>
										</div>
										<div class="split"><div><span></span></div></div>
										<div class="right">
											<h3>'.(
												($tmp_answ[$key][$key1]["user"][0]["active"]) ? 
												( ($tmp_answ[$key][$key1]["user"][0]["name"] || $tmp_answ[$key][$key1]["user"][0]["surname"]) ? ($tmp_answ[$key][$key1]["user"][0]["name"].' '.$tmp_answ[$key][$key1]["user"][0]["surname"]) : $tmp_answ[$key][$key1]["user"][0]["mail"]) : 
												('<span class="deleted_h3">'.$lg["dzests_lietotajs"].'</span>')
												).
											'</h3>
											<div class="date">'.comment_date_format($val1["date"]).'</div>
											<div class="text">'.$val1["content"].'</div>
										</div>
									</div>
									';
								/*******************************************************************************/
							}
						}
					$comments .= '
				</div>
			</div>
			';
		}
	}
}
$query = "SELECT * FROM ".PREFIX."stats WHERE meta_id = ".$id;
$rRes = mysql_query($query);
$views = mysql_num_rows($rRes);

$query = "SELECT * FROM ".PREFIX."likes WHERE meta_id = ".$id;
$rRes = mysql_query($query);
$likes = mysql_num_rows($rRes);

$query = "SELECT * FROM ".PREFIX."likes WHERE 
		meta_id = ".$id." AND 
		ip = '".$ip."' AND 
		agent = '".$agent."'
	";
$rRes = mysql_query($query);
$liked = mysql_num_rows($rRes);

echo 
	'stat'.			$small_split.	$views.
	$big_split.	
	'liked'.		$small_split.	(empty($liked) ? '' : $liked).
	$big_split.
	'like'.			$small_split.	$likes.
	$big_split.
	'coms'.			$small_split.	$comments_count.
	$big_split.
	'comments_'.$id.	$small_split.	$comments;
	//out($tmp_comm);
