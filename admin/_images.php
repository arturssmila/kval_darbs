<?php
$images_path = ROOT."/images/others/";

if ($handle = opendir($images_path)) 
{
	$i=0;
	/* This is the correct way to loop over the directory. */
	while (false !== ($file = readdir($handle))) 
	{
		switch (strtolower(substr($file, -4)))
		{
		case ".jpg":
		case "jpeg":
		case ".png":
		case ".gif":
		case ".svg":
			
		case ".pdf":
			$images[$i] = $file;
			$like[$i] = "/images/others/".$images[$i];
			$img_query[$i] = "SELECT * ".
					"FROM `".PREFIX."meta_data` ".
					"WHERE 
						`field_content` LIKE '%".$like[$i]."%'  ".
					"ORDER BY `meta_id` ASC ";
			//out($img_query[$i]);
			$img_res[$i] = mysql_query($img_query[$i]) or die(mysql_error().$img_query[$i]);
						
			if(mysql_num_rows($img_res[$i]) > 0)
			{
				while($row[$i] = mysql_fetch_assoc($img_res[$i]))
				{
					//out($row[$i]);
					//out($languages_keys);
					meta("S",array("id"=>$row[$i]["meta_id"],"lang"=>$languages_keys[$row[$i]["language_id"]]["iso"],"parent_id"=>"0' OR `parent_id` > '0' OR `parent_id` < '0","alert"=>0),$data[$i]);
					//out($like[$i].' | '.$data[$i][0]["id"]);
					$locked[$i][$languages_keys[$row[$i]["language_id"]]["iso"]] = $data[$i][0];
				}
			}
			$i++;
			break;
		}
	}	
	closedir($handle);
}
?>
<script type="text/javascript">var eenter=false;</script>
<form action="/admin/images_save.php?mode=images" method="post" enctype="multipart/form-data" onsubmit="if(eenter==true) return false;">
<table class="none" id="users_like" style="position:relative;border-spacing:0px;">
	<tr>
		<th colspan="5" align="left">
			<?php echo al("atteli_uz_servera"); ?>
		</th>
	</tr>
	<tr>
		<th align="left" colspan="5" style="border-bottom-width:2px;border-bottom-style:solid;">
			<?php echo al("pievienot_jaunu"); ?> 
			<input name="uploadedfile" type="file" /><button type="save" name="save" value="save"><?php echo al("pievienot"); ?> </button>
			<div><small><?php echo al("upload_max_filesize"); ?>: <?php echo ini_get('upload_max_filesize'); ?></small></div>
		</th>
	</tr>
<?php
if(!empty($images))
{
?>
	<tr class="actions">
		<th>Nr.</th>
		<th><?php echo al("attels"); ?></th>
		<th><?php echo al("cels"); ?> / <?php echo al("nosaukums"); ?></th>
		<th><?php echo al("statuss"); ?></th>
		<th><?php echo al("dzest"); ?></th>
	</tr>		
<?php
	//sort($images);
	foreach($images as $key => $val)
	{
		$ext[$key] = explode(".",$val);
		$ext[$key] = end($ext[$key]);
		$ext[$key] = strtolower($ext[$key]);
	?>	
		<tr class="actions_like <?php if($key % 2 == 0) echo "sec_tr"; ?>">
			<td align="right"><?php echo $key+1; ?></td>
			<td align="center">
				<?php 
					switch($ext[$key])
					{
						case "pdf":
							?>
							<svg viewBox="0 0 32 32" height="30">
								<g fill="none" fill-rule="evenodd" id="Page-1" stroke="none" stroke-width="1">
									<g fill="#464646" id="icon-70-document-file-pdf">	
										<path d="M21,13 L21,10 L21,10 L15,3 L4.00276013,3 C2.89666625,3 2,3.89833832 2,5.00732994 L2,27.9926701 C2,29.1012878 2.89092539,30 3.99742191,30 L19.0025781,30 C20.1057238,30 21,29.1017876 21,28.0092049 L21,26 L28.9931517,26 C30.6537881,26 32,24.6577357 32,23.0012144 L32,15.9987856 C32,14.3426021 30.6640085,13 28.9931517,13 L21,13 L21,13 L21,13 Z M20,26 L20,28.0066023 C20,28.5550537 19.5523026,29 19.0000398,29 L3.9999602,29 C3.45470893,29 3,28.5543187 3,28.004543 L3,4.99545703 C3,4.45526288 3.44573523,4 3.9955775,4 L14,4 L14,8.99408095 C14,10.1134452 14.8944962,11 15.9979131,11 L20,11 L20,13 L12.0068483,13 C10.3462119,13 9,14.3422643 9,15.9987856 L9,23.0012144 C9,24.6573979 10.3359915,26 12.0068483,26 L20,26 L20,26 L20,26 Z M15,4.5 L15,8.99121523 C15,9.54835167 15.4506511,10 15.9967388,10 L19.6999512,10 L15,4.5 L15,4.5 Z M11.9945615,14 C10.8929956,14 10,14.9001762 10,15.992017 L10,23.007983 C10,24.1081436 10.9023438,25 11.9945615,25 L29.0054385,25 C30.1070044,25 31,24.0998238 31,23.007983 L31,15.992017 C31,14.8918564 30.0976562,14 29.0054385,14 L11.9945615,14 L11.9945615,14 Z M25,19 L25,17 L29,17 L29,16 L24,16 L24,23 L25,23 L25,20 L28,20 L28,19 L25,19 L25,19 Z M12,18 L12,23 L13,23 L13,20 L14.9951185,20 C16.102384,20 17,19.1122704 17,18 C17,16.8954305 16.1061002,16 14.9951185,16 L12,16 L12,18 L12,18 Z M13,17 L13,19 L15.0010434,19 C15.5527519,19 16,18.5561352 16,18 C16,17.4477153 15.5573397,17 15.0010434,17 L13,17 L13,17 Z M18,16 L18,23 L20.9951185,23 C22.102384,23 23,22.1134452 23,20.9940809 L23,18.0059191 C23,16.8980806 22.1061002,16 20.9951185,16 L18,16 L18,16 Z M19,17 L19,22 L21.0010434,22 C21.5527519,22 22,21.5562834 22,21.0001925 L22,17.9998075 C22,17.4476291 21.5573397,17 21.0010434,17 L19,17 L19,17 Z" id="document-file-pdf"/>
									</g>
								</g>
							</svg>
							<?php
							break;
						default:
							?>
							<img id="<?php echo $val; ?>" src="/images/others/<?php echo $val; ?>" style="max-width:300px;max-height:100px;" />
							<?php
					}
				?>
				
			</td>
			<td align="left">
				<img id="img_edit<?php echo $key; ?>" src="/cms/css/images/edit<?php echo (empty($locked[$key])) ? "_hover" : ""; ?>.png"
					style="<?php echo (empty($locked[$key])) ? 'cursor:pointer;' : ""; ?>"
					title="<?php echo (empty($locked[$key])) ? al("labot_faila_nosaukumu") : ""; ?>"
					<?php echo (empty($locked[$key])) ? 'onclick="img_edit('.$key.','."'".$val."'".','."'others'".');"' : ""; ?>
				/>
				/images/others/<span id="img_name<?php echo $key; ?>"><?php echo $val; ?></span>
			</td>
			<td align="left">
				<?php 
				
					if(!empty($locked[$key]))
					{
						$br = false;
						foreach($locked[$key] as $kl => $vl)
						{
							echo
								(!empty($br) ? "<br />" : "").
								'<a href="/admin/tree/'.$vl["id"].'">'.$vl["name"].' ('.$kl.') ['.$vl["id"].']</a>';
							$br = true;
						}
					}
				?>
			</td>
			<td align="center">
				<button 
					<?php if(!empty($locked[$key])) echo "disabled"; ?> 
					name="delete" onclick="if (!confirm('<?php echo al("tiesam_dzest_no_servera"); ?>')) { return false; }" 
					value="<?php echo $val; ?>" 
					style="padding:0px;<?php if(!empty($locked[$key])) echo "opacity:0.3;"; ?>"
					title="<?php echo (empty($locked[$key])) ? al("dzest_no_servera") : al("fails_tiek_lietots"); ?>"><img src="/cms/css/images/del.png" /></button>
			</td>
		</tr>
	<?php
	}
}
?>	
</table>
</form>
