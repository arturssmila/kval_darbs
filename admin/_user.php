<?php
if(!empty($_POST["notify"]))
{
	exit();
}

if(!empty($_POST))
{
	//require('../config.php');
	//passwordcheck
	include("../cms/libs/passwordcheck.inc");
	if (!$admin) 
	{
		header("Location: /admin/login.php");
		exit();
	}
	
	$mode = !empty($_POST["back"]) ? $_POST["back"] : "user";
	
	$delete = !empty($_POST["delete"]) ? $_POST["delete"] : '';
	$restore = !empty($_POST["restore"]) ? $_POST["restore"] : '';
	$name = !empty($_POST["name"]) ? $_POST["name"] : '';
	$data = !empty($_POST["data"]) ? $_POST["data"] : array();
	$save = !empty($_POST["save"]) ? $_POST["save"] : '';
	$id = !empty($delete) ? $delete : (!empty($restore) ? $restore : (!empty($save) ? $save : ''));
	
	//print_r($name);
	//out($_POST);
	//die();
	
	if ($restore)
	{
		mysql_query("UPDATE ".PREFIX."users SET 
				active = '1' 
			where id = $restore ;") or die(mysql_error());
		set_users_row($restore);
	}
	elseif ($delete)
	{
		mysql_query("UPDATE ".PREFIX."users SET 
				active = '0' 
			where id = $delete ;") or die(mysql_error());
		set_users_row($delete);
	}
	elseif ($save)
	{
		foreach($name as $key => $val)
		{
			$name[$key] = htmlentities($val, ENT_QUOTES);
		}
				
		if($save=="new")
		{//jauns ieraksts
			get_user("I",array(
					"mail"=>$name["mail"],
					"name"=>$name["name"],
					"surname"=>$name["surname"],
					"admin"=>(empty($name["admin"])?0:$name["admin"]),
					"password"=>$name["password"],
					"dr"=>$name["dr"],
					"fb"=>$name["fb"],
					"go"=>$name["go"],
					"tw"=>$name["tw"],
					"ln"=>$name["ln"]
					),$id);
		}
		else
		{//update
			mysql_query("UPDATE ".PREFIX."users SET 
				name = '".mysql_real_escape_string($name["name"])."',
				surname = '".mysql_real_escape_string($name["surname"])."', 
				admin = '".mysql_real_escape_string(empty($name["admin"]) ? 0 : $name["admin"])."',
				dr = '".mysql_real_escape_string($name["dr"])."',
				fb = '".mysql_real_escape_string($name["fb"])."',
				go = '".mysql_real_escape_string($name["go"])."',
				tw = '".mysql_real_escape_string($name["tw"])."',
				ln = '".mysql_real_escape_string($name["ln"])."'
			where id = $save ;") or die(mysql_error());
			
			if(!empty($name["password"]))
			{
				get_user("U",array(
					"id"=>$save,
					"password"=>$name["password"]
					),$x);
			}
			
			foreach($data as $key => $val)
			{
				foreach($val as $lkey => $lval)
				{
					mysql_query("DELETE FROM ".PREFIX."users_data WHERE  
						user_id = '".$save."' AND 
						name = '".$key."' AND  
						lang_id = '".$lkey."';") or die(mysql_error());
					mysql_query("INSERT INTO ".PREFIX."users_data SET 
						user_id = '".$save."',
						name = '".$key."', 
						lang_id = '".$lkey."',
						value = '".mysql_real_escape_string(htmlentities($lval, ENT_QUOTES))."';") or die(mysql_error());
				}
			}
			set_users_row($save);
		}
	}
	
	header("location: /admin/$mode/$id");
	exit();
}
/******************************************************************************************************************************/
if($cat1 == "new") 
{
	$new = $cat1;
	$selected_user = array();
}
else
{
	$query = "SELECT * ".
		"FROM ".PREFIX."users ".
		"WHERE id = $cat1 ";
	$res = mysql_query($query) or die(mysql_error().$query);
	
	if(mysql_num_rows($res) > 0)
	{
		$selected_user = mysql_fetch_assoc($res);
	}
	$query = "CREATE TABLE IF NOT EXISTS `".PREFIX."users_data` (
		`user_id` int(11) DEFAULT NULL,
		`name` varchar(255) DEFAULT NULL,
		`lang_id` int(11) NOT NULL,
		`value` text,
		KEY `name` (`name`),
		KEY `lang_id` (`lang_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	$res = mysql_query($query) or die(mysql_error().$query);
	
	$query = "
		SELECT
			`name`,
			`lang_id`,
			CONCAT(name,'_',lang_id) AS name_param
		FROM
			`".PREFIX."users_data`
		GROUP BY
			name_param
		";
	$res = mysql_query($query) or die(mysql_error().$query);
	if(mysql_num_rows($res) > 0)
	{
		while($row = mysql_fetch_assoc($res))
		{
			$selected_user["data"][$row["name"]][$row["lang_id"]] = '';
		}
	}
	
	$query = "SELECT 
			* 
		FROM `".PREFIX."users_data` 
		WHERE `user_id` = '$cat1' ";
		
	//out($query );
	$res = mysql_query($query) or die(mysql_error().$query);
	
	if(mysql_num_rows($res) > 0)
	{
		while($row = mysql_fetch_assoc($res))
		{
			$selected_user["data"] [$row["name"]][$row["lang_id"]] = $row["value"];
		}
	}
	
	//out($selected_user);
}
if(empty($cat1)) die(al("nav_sada_lietotaja"));
?>
<form action="" autocomplete="false" method="post">
	<h1><?php echo al("lietotajs"); ?></h1>
	<table class="user_table" style="float:left;">
		<?php if(!empty($selected_user["id"])) { ?>
		<tr>
			<th align="right">ID</th>
			<td>
				<?php echo $selected_user["id"]; ?>
				<?php 
					$soc = ' ';
					switch($selected_user["soc"])
					{
						case "00":
							$soc_open = '';
							$soc_link = '';
							$soc_img = '<img style="margin:-2px 0px;" src="/cms/css/images/00.png" />';
							$soc_close = '';
							break;
						case "FB":
							$soc_link = 'http://www.facebook.com/profile.php?id='.$selected_user["soc_id"];
							$soc_open = '<a href="'.$soc_link.'" target="_blank">';
							$soc_img = '<img style="margin:-2px 0px;" src="/cms/css/images/fbi.png" />';
							$soc_close = '</a>';
							break;
						case "DR":
							$soc_link = 'http://www.draugiem.lv/user/'.$selected_user["soc_id"];
							$soc_open = '<a href="'.$soc_link.'" target="_blank">';
							$soc_img = '<img style="margin:-2px 0px;" src="/cms/css/images/dri.png" />';
							$soc_close = '</a>';
							break;
						case "GO":
							$soc_link = 'https://plus.google.com/u/0/'.$selected_user["soc_id"];
							$soc_open = '<a href="'.$soc_link.'" target="_blank">';
							$soc_img = '<img style="margin:-2px 0px;" src="/cms/css/images/goi.png" />';
							$soc_close = '</a>';
							break;
						case "TW":
							$soc_link = 'https://twitter.com/account/redirect_by_id?id='.$selected_user["soc_id"];
							$soc_open = '<a href="'.$soc_link.'" target="_blank">';
							$soc_img = '<img style="margin:-2px 0px;" src="/cms/css/images/twi.png" />';
							$soc_close = '</a>';
							break;
					}
				?>
					
				
			</td>
		</tr>
		<tr>
			<th align="right">SOC</th>
			<td>
				<?php echo $soc_open.$soc_img.$soc_close.' '.$soc_link; ?>
			</td>
		</tr>
		<tr>
			<th align="right"><?php echo al("attels"); ?></th>
			<td>
			<?php if(!empty($selected_user["image"])) { ?>
				<img
					src="<?php echo $selected_user["image"]; ?>"
					style="max-width:200px;" />
			<?php } else echo al("nav_attela"); ?>
			</td>
		</tr>
		<?php } ?>
		<tr>
			<th align="right"><?php echo al("e_pasts"); ?> / <?php echo al("lietotajvards"); ?></th>
			<td><input type="text" name="name[mail]" value="<?php echo !empty($selected_user["mail"]) ? $selected_user["mail"] : ''; ?>" /></td>
		</tr>
		<tr>
			<th align="right"><?php echo al("vards"); ?></th>
			<td><input type="text" name="name[name]" value="<?php echo !empty($selected_user["name"]) ? $selected_user["name"] : ''; ?>" /></td>
		</tr>
		<tr>
			<th align="right"><?php echo al("uzvards"); ?></th>
			<td><input type="text" name="name[surname]" autocomplete="false" value="<?php echo !empty($selected_user["surname"]) ? $selected_user["surname"] : ''; ?>" /></td>
		</tr>
		
		<tr>
			<th align="right"><?php echo al("user_type"); ?></th>
			<td>
				<select name="name[admin]">
						<option value="0"><?php echo al("netiek_paneli"); ?></option>
					<?php if(is_super_admin() || (!empty($selected_user["admin"]) && ($selected_user["admin"] == 1 ))) { ?>
						<option value="1" <?php echo ((!empty($selected_user["admin"]) && ($selected_user["admin"]==1)) ? "selected":""); ?>><?php echo al("super_admin"); ?></option>
					<?php } ?>
					<?php if(is_admin() || (!empty($selected_user["admin"]) && ($selected_user["admin"] == 2 ))) { ?>
						<option value="2" <?php echo ((!empty($selected_user["admin"]) && ($selected_user["admin"]==2)) ? "selected":""); ?>><?php echo al("admin"); ?></option>
					<?php } ?>
					<?php if(is_user() || (!empty($selected_user["admin"]) && ($selected_user["admin"] == 3 ))) { ?>
						<option value="3" <?php echo ((!empty($selected_user["admin"]) && ($selected_user["admin"]==3)) ? "selected":""); ?>><?php echo al("user"); ?></option>
					<?php } ?>
						<option value="4" <?php echo ((!empty($selected_user["admin"]) && ($selected_user["admin"]==4)) ? "selected":""); ?>><?php echo al("viewer"); ?></option>
				</select>
			</td>
		</tr>
		
		<?php if(
				!empty($new)
				||
				(
					!empty($user[0]["admin"])
					&&
					(
						($selected_user["admin"] > ($user[0]["admin"] - 1))
						||
						empty($selected_user["admin"])
					)
					&&
					(!empty($selected_user["soc"]) && ($selected_user["soc"] == "00"))
				)
			)
			{ ?>
		<tr>
			<th align="right">
				<?php echo al("parole") ; ?>
				<?php if(empty($new)) { echo al("reset"); } ?>
			</th>
			<td><input type="text" name="name[password]" value="" /></td>
		</tr>
		<?php } ?>
		<tr>
			<th align="left" colspan="2"><?php echo al("socialie_profili"); ?>:</th>
		</tr>	
		<tr>
			<th align="right"><?php echo !empty($selected_user["dr"])?('<a href="'.$selected_user["dr"].'" target="_blank">'):''; ?><img src="/cms/css/images/dri.png" /><?php echo !empty($selected_user["dr"])?('</a>'):''; ?></th>
			<td><input type="text" name="name[dr]" value="<?php echo !empty($selected_user["dr"]) ? $selected_user["dr"] : ''; ?>" /></td>
		</tr>	
		<tr>
			<th align="right"><?php echo !empty($selected_user["fb"])?('<a href="'.$selected_user["fb"].'" target="_blank">'):''; ?><img src="/cms/css/images/fbi.png" /><?php echo !empty($selected_user["fb"])?('</a>'):''; ?></th>
			<td><input type="text" name="name[fb]" value="<?php echo !empty($selected_user["fb"]) ? $selected_user["fb"] : ''; ?>" /></td>
		</tr>	
		<tr>
			<th align="right"><?php echo !empty($selected_user["go"])?('<a href="'.$selected_user["go"].'" target="_blank">'):''; ?><img src="/cms/css/images/goi.png" /><?php echo !empty($selected_user["go"])?('</a>'):''; ?></th>
			<td><input type="text" name="name[go]" value="<?php echo !empty($selected_user["go"]) ? $selected_user["go"] : ''; ?>" /></td>
		</tr>	
		<tr>
			<th align="right"><?php echo !empty($selected_user["tw"])?('<a href="'.$selected_user["tw"].'" target="_blank">'):''; ?><img src="/cms/css/images/twi.png" /><?php echo !empty($selected_user["tw"])?('</a>'):''; ?></th>
			<td><input type="text" name="name[tw]" value="<?php echo !empty($selected_user["tw"]) ? $selected_user["tw"] : ''; ?>" /></td>
		</tr>	
		<tr>
			<th align="right"><?php echo !empty($selected_user["ln"])?('<a href="'.$selected_user["ln"].'" target="_blank">'):''; ?><img src="/cms/css/images/lni.png" /><?php echo !empty($selected_user["ln"])?('</a>'):''; ?></th>
			<td><input type="text" name="name[ln]" value="<?php echo !empty($selected_user["ln"]) ? $selected_user["ln"] : ''; ?>" /></td>
		</tr>
	</table>
	
	<table class="user_table" style="float:left;margin-left:10px;">	
	<?php
		if(!empty($selected_user["data"]))
		{
			?>
				<tr>
					<th></th>
					<?php
					foreach($languages as $key => $val)
					{
						echo '<th>'.$val["name"].' ('.strtoupper($val["iso"]).')</th>';
					}
					?>
				</tr>
			<?php
			foreach($selected_user["data"] as $su_key => $su_val)
			{
				?>
				<tr>
					<th class="right"><?php echo al($su_key); ?></th>
					<?php 
					if(count($su_val) > 1)
					{
						foreach($languages as $key => $val)
						{
							?>
								<td>
									<textarea
										name="data[<?php echo $su_key; ?>][<?php echo $val["id"]; ?>]"
										><?php echo (!empty($su_val[$val["id"]]) ? $su_val[$val["id"]] : ''); ?></textarea>
								</td>
							<?php
						}
					}
					else
					{
						?>
						<td colspan="<?php echo count($languages); ?>">
							<textarea
								name="data[<?php echo $su_key; ?>][0]"
								><?php echo (!empty($su_val[0]) ? $su_val[0] : ''); ?></textarea>
						</td>
						<?php
					}
					?>
					
				</tr>
				<?php
			}
		}
	?>
	</table>
	<div class="clear"></div>
	
	<?php
	if(!empty($new) || (!empty($user[0]["admin"]) && ( ($selected_user["admin"] > ($user[0]["admin"] - 1)) || empty($selected_user["admin"]))    ) )
	{
	?>
		<button type="save" name="save" value="<?php echo !empty($selected_user["id"]) ? $selected_user["id"] : $new; ?>"><?php echo al("saglabat"); ?></button>
	<?php
	}
	?>
	<?php
	if(isset($selected_user["admin"]) && (($selected_user["admin"] > ($user[0]["admin"] - 1)) || ($selected_user["admin"]==0)) )
	{
		if(empty($new))
		{
			if($selected_user["active"])
			{
			?><button type="delete" name="delete" value="<?php echo $selected_user["id"]; ?>"><?php echo al("bloket_lietotaju"); ?></button><?php
			}
			else
			{
			?><button type="restore" name="restore" value="<?php echo $selected_user["id"]; ?>"><?php echo al("atjaunot_lietotaju"); ?></button><?php
			}
		}
	}
	?>
</form>
<?php if($user[0]["id"] < 15) { ?><a href="/admin/user/new"><?php echo al("pievienot_jaunu_lietotaju"); ?></a><?php } ?>