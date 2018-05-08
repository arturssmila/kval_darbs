<?php

//jauni lietotāji
$new_notifications["users"] = '';
if(get_user("S",array("registered"=>"1 DAY","orderby"=>"`registered` DESC"),$users))
{
	$op = (86400-(strtotime(date('Y-m-d H:i:s')) - strtotime($users[0]["registered"])))/86400; //izdalam pret 24h
	$new_notifications["users"] = '<span><i style="opacity:'.$op.';" title="'.al("new_users").'">'.count($users).'</i></span>';
}

//jauni komentāri
$new_notifications["comments"] = '<span>';
if(meta("S",array("template"=>"comment","date"=>"1 DAY","orderby"=>"`date` DESC"),$comments))
{
	$op = (86400-(strtotime(date('Y-m-d H:i:s')) - strtotime($comments[0]["date"]) ) ) / 86400; //izdalam pret 24h
	$new_notifications["comments"] .= '<i style="opacity:'.$op.';" title="'.al("new_comments").'">'.count($comments).'</i>';
}
if(!empty($settings["comment_approoving"]) && meta("S",array("template"=>"comment","hide_link"=>1),$h_coms))
{
	$new_notifications["comments"] .= '<b title="'.al("h_coms").'">'.count($h_coms).'</b>';
}
$new_notifications["comments"] .= '</span>';


//jaunas atsauksmes
$new_notifications["feedbacks"] = '<span>';
if(meta("S",array("template"=>"feedback","date"=>"1 DAY","orderby"=>"`date` DESC"),$feedbacks))
{
	$op = (86400-(strtotime(date('Y-m-d H:i:s')) - strtotime($feedbacks[0]["date"]) ) ) / 86400; //izdalam pret 24h
	$new_notifications["feedbacks"] .= '<i style="opacity:'.$op.';" title="'.al("new_comments").'">'.count($feedbacks).'</i>';
}
if(!empty($settings["feedback_approoving"]) && meta("S",array("template"=>"feedback","hide_link"=>1),$h_feeds))
{
	$new_notifications["feedbacks"] .= '<b title="'.al("h_feeds").'">'.count($h_feeds).'</b>';
}
$new_notifications["feedbacks"] .= '</span>';


//jauni formas dati
$new_notifications["form_data"] = '<span>';
$form_data = array();
$queryx = "SHOW TABLES LIKE '".PREFIX."form_data' ";
$resx = mysql_query($queryx);
if(mysql_num_rows($resx) > 0)
{
	$query = " SELECT * FROM `".PREFIX."form_data` WHERE (`type` IS NULL OR `type` <> 'hidden') ORDER BY `id` DESC ";
	$res = mysql_query($query);
	if(mysql_num_rows($res) > 0)
	{
		while($row = mysql_fetch_assoc($res))
		{
			$form_data[] = $row;
		}
		
		$op = (86400-(strtotime(date('Y-m-d H:i:s')) - strtotime($form_data[0]["date"]) ) ) / 86400; //izdalam pret 24h
		$new_notifications["form_data"] .= '<i style="opacity:'.$op.';" title="'.al("new_form_data").'">'.count($form_data).'</i>';		
	}
}
$new_notifications["form_data"] .= '</span>';

//jauni abonenti
$new_notifications["subscribers"] = '<span>';
$subscribers = array();
$queryx = "SHOW TABLES LIKE '".PREFIX."subscribers' ";
$resx = mysql_query($queryx);
if(mysql_num_rows($resx) > 0)
{
	$query = " SELECT * FROM `".PREFIX."subscribers` ORDER BY `id` DESC ";
	$res = mysql_query($query);
	if(mysql_num_rows($res) > 0)
	{
		while($row = mysql_fetch_assoc($res))
		{
			$subscribers[] = $row;
		}
		
		$op = (86400-(strtotime(date('Y-m-d H:i:s')) - strtotime($subscribers[0]["date"]) ) ) / 86400; //izdalam pret 24h
		$new_notifications["subscribers"] .= '<i style="opacity:'.$op.';">'.count($subscribers).'</i>';		
	}
}
$new_notifications["subscribers"] .= '</span>';
//out($modes);


//jauni atjauninājumi tikai tiem, kam pieejami
if(
	($mode != "updates")
	&&
	(
		in_array($user[0]["admin_type"],$modes["updates"]["user_types"])
		||
		in_array("all",$modes["updates"]["user_types"])
	)
)
{
	$updates_notify = true;	
	$updates_count = require_once("_updates.php");
	if($updates_count > 0)
	{
		$new_notifications["updates"] = '<span>';
		$new_notifications["updates"] .= '<b title="'.al("updates").'">'.$updates_count.'</b>';
		$new_notifications["updates"] .= '</span>';
	}
	$updates_notify = false;
}
?>
<div id="header">
	<div id="header_menu">
		<div class="admin">
			<?php
				foreach($modes as $key => $val)
				{
					if(in_array($user[0]["admin_type"],$val["user_types"]) || in_array("all",$val["user_types"]) )
					{
						if(!empty($val["line"]) && ($val["line"]=="first") && ($key!="user"))
						{
						?>
							<a <?php if($mode == $key) echo 'class="active"'; ?> href="/admin/<?php echo $key; ?>/"><?php echo al($key); ?><?php
								if(!empty( $new_notifications[$key] ) )
								{
									echo $new_notifications[$key];
								}
							?></a>
						<?php
						}
						else
						{
							$admin_path = "/admin/includes/admin/";
							$full_admin_path = ROOT.$admin_path;
							if(file_exists($full_admin_path.'_'.$key.'.php'))
							{
								?>
									<a 
										<?php if($mode == $key) echo 'class="active"'; ?>
										href="/admin/<?php echo $key; ?>/"
										>
											<?php echo al($key); ?>										
											<?php
											$result = file_get_contents('http'.(!empty($_SERVER["HTTPS"]) ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$admin_path.'_'.$key.'.php', false, stream_context_create(array(
													'http' => array(
															'method'  => 'POST',
															'header'  => 'Content-type: application/x-www-form-urlencoded',
															'content' => http_build_query(array('notify' => '1'))
															)
													)));
											$result = explode("NOTIFY_SPLITTER",$result);
											if(!empty($result[1]))
												echo ($result[1]);
											?>										
										</a>
								<?php
							}
						}
					}
				}
			?>
		</div>
		<div class="super_admin">
			<?php
				/*
				foreach($modes as $key => $val)
				{
					if(!empty($val["line"]) && ($val["line"]=="second") && (in_array($user[0]["admin_type"],$val["user_types"]) || in_array("all",$val["user_types"])))
					{
					?>
					<a <?php if($mode == $key) echo 'class="active"'; ?> href="/admin/<?php echo $key; ?>/"><?php echo al($key); ?></a>
					<?php
					}
				}
				*/
				foreach($modes as $key => $val)
				{
					if(in_array($user[0]["admin_type"],$val["user_types"]) || in_array("all",$val["user_types"]) )
					{
						if(!empty($val["line"]) && ($val["line"]=="second"))
						{							
							?>
								<a <?php if($mode == $key) echo 'class="active"'; ?> href="/admin/<?php echo $key; ?>/"><?php echo al($key); ?><?php
									if(!empty( $new_notifications[$key] ) )
									{
										echo $new_notifications[$key];
									}
								?></a>
							<?php
						}
						else
						{
							$super_admin_path = "/admin/includes/super_admin/";
							$full_super_admin_path = ROOT.$super_admin_path;
							if(file_exists($full_super_admin_path.'_'.$key.'.php'))
							{
								?>
									<a 
										<?php if($mode == $key) echo 'class="active"'; ?>
										href="/admin/<?php echo $key; ?>/"
										>
											<?php echo al($key); ?>										
											<?php
											$result = file_get_contents('http'.(!empty($_SERVER["HTTPS"]) ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$super_admin_path.'_'.$key.'.php', false, stream_context_create(array(
													'http' => array(
															'method'  => 'POST',
															'header'  => 'Content-type: application/x-www-form-urlencoded',
															'content' => http_build_query(array('notify' => '1'))
															)
													)));
											$result = explode("NOTIFY_SPLITTER",$result);
											if(!empty($result[1]))
												echo ($result[1]);
											?>										
										</a>
								<?php
							}
						}
					}
				}
			/*	
			?>
			<br />
			<?php if(is_admin()) { ?>
				<a <?php if($mode == "languages") echo 'class="active"'; ?> href="/admin/languages/"><?php echo al("valodas"); ?></a>
			<?php } ?>
			<?php if(is_user()) { ?>
				<a <?php if($mode == "language") echo 'class="active"'; ?> href="/admin/language/"><?php echo al("valodas_fails"); ?></a>
			<?php } ?>
			<?php if(is_admin()) { ?>
				<a <?php if($mode == "adm_language") echo 'class="active"'; ?> href="/admin/adm_language/"><?php echo al("adm_valodas_fails"); ?></a>
				<a <?php if($mode == "templates") echo 'class="active"'; ?> href="/admin/templates/"><?php echo al("sadalu_tipi"); ?></a>
				<a <?php if($mode == "fields") echo 'class="active"'; ?> href="/admin/fields/"><?php echo al("sadalu_tipu_laucini"); ?></a>
			<?php } ?>
			<a <?php if(($mode == "activity")||($mode == "activity_data")) echo 'class="active"'; ?> href="/admin/activity/"><?php echo al("aktivitates"); ?></a>
			<?php if(is_user()) { ?>
				<a <?php if($mode == "images") echo 'class="active"'; ?> href="/admin/images/"><?php echo al("atteli"); ?></a>
				<a <?php if($mode == "settings") echo 'class="active"'; ?> href="/admin/settings/"><?php echo al("settings"); ?></a>
			<?php } ?>
			<?php if(is_admin()) { ?>
				<a <?php if($mode == "update") echo 'class="active"'; ?> href="/admin/update/"><?php echo al("atjaunosana"); ?></a>
			<?php } ?>
			<?php if(is_super_admin()) { ?>
				<a <?php if($mode == "work_table") echo 'class="active"'; ?> href="/admin/work_table/"><?php echo al("work_table"); ?></a>
				<a <?php if($mode == "sa") echo 'class="active"'; ?> href="/admin/sa/"><?php echo al("administration"); ?></a>
			<?php }
			*/
			?>
		</div>
	</div>
	<div id="header_profile">
		<a href="/admin/profile/"><?php echo ($user[0]["name"] || $user[0]["surname"]) ? ($user[0]["name"]." ".$user[0]["surname"]) : $user[0]["mail"]; ?></a>
		<a href="/logout.php"><?php echo al("iziet"); ?></a>
	</div>
</div>
	<?php
	//out($user);
	//out($modes);
	?>