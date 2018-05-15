<?php
$port = (!empty($_SERVER['SERVER_PORT']) && !(in_array($_SERVER['SERVER_PORT'],array(80,443)))) ? (':'.$_SERVER['SERVER_PORT']) : '';
if( (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST).$port === $_SERVER['HTTP_HOST']))
{
	require('../config.php');
	//passwordcheck
	include(ROOT."/cms/libs/passwordcheck.inc");
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
	
	$id = $_POST["id"];
	$admin_lang = $user[0]["admin_language"];
	require_once(ROOT.'/admin/admin_language.php');
	$cat = !empty($_POST["cat"]) ? $_POST["cat"] : '';
	$order_buttons = true;
	
	$res = mysql_query("SELECT * FROM `".PREFIX."meta` WHERE `id` = '$id' ;");
	if(mysql_num_rows($res) > 0)
	{
		$data = mysql_fetch_assoc($res);
		if(!empty($data["creator_id"]))
		{
			get_user("S",array("id"=>$data["creator_id"]),$data["creator"]);
		}
	}
	else die(al("sada_sadala_neeksiste"));
	
	$parent_id = $data["parent_id"];
	$template_id = $data["template_id"];
	$template = (template("S",array("id"=>$template_id),$a_tpl)) ? $a_tpl[0]["template"] : '';
	
	/***********************************************************************************************************/
	get_fields($fields, $field_names, $fields_ids, $template_id);
	/****************************************************************************************************************/
	//out($fields);
	
	function clear_data()
	{
		global $data;
		foreach($data as $key=>$val)
		{
			$data[$key] = ''; 
		}
	}
	
	$do_revisions = true;
	//out("|".$cat."|");
	switch ($cat)//apakškategorijai un blakuskategorijai
	{
		case 'under':
			$order_buttons = false;
			clear_data();
			$do_revisions = false;
			$data["parent_id"] = $id;
			break;
		case 'next':
			$order_buttons = false;
			clear_data();
			$do_revisions = false;
			$data["parent_id"] = $parent_id;
			break;
		case 'copy':
			$order_buttons = false;
			$do_revisions = false;
			$data["id"] = 0;
			$data["parent_id"] = $parent_id;
			$data["opened"] = '';
			$data["creator_id"] = '';
			$data["date"] = '';
			$data["creator"] = '';
			$data["image_big"] = '';
			$data["image"] = '';
			$data["image_small"] = '';
			$data["image_thumb"] = '';
			//out($data);
			break;
	}
	
	//out($data);
	
	$this_page_opened = $data["opened"];
	if(!empty($this_page_opened))
	{
		get_user("S",array("id"=>$this_page_opened),$opener);
		echo
			'<div class="red">'.al("sadalu_atvera").
				' <a class="red bold" href="/admin/user/'.$opener[0]["id"].'">'.
					(
						(!empty($opener[0]["name"]) || !empty($opener[0]["surname"]))
						?
						($opener[0]["name"].' '.$opener[0]["surname"])
						:
						$opener[0]["mail"]
					).
				'</a> '.
				get_short_date($opener[0]["last_seen"]).
			'</div>';
	}
	else
	{
		mysql_query("UPDATE `".PREFIX."meta` SET `opened` = '".$user[0]["id"]."' where `id` = '$id' ;");
	}
	
	//open parents
	$tmp_p_id = $data["parent_id"];
	while($tmp_p_id > 0)
	{
		if ($tmp_p_id)
		{
			$_SESSION["opened"][$tmp_p_id] = 1;
		}
		$tmp_p_id = meta("S", array("lang"=>$admin_lang,"id"=>$tmp_p_id),$googa) ? $googa[0]["parent_id"] : 0;
		unset($googa);
	}
	
	$templates = dig_templates(0);
	get_user("S",array("orderby"=>"name ASC, surname ASC, mail ASC","stock"=>1),$authors);
	
	function buttons()
	{
		global $id;
		global $data;
		global $user;
		global $cat;
		global $this_page_opened;
		global $template;
		global $parent_id;
		global $order_buttons;
		echo empty($this_page_opened)?('<button type="save" name="save" value="save" title="'.al("saglabat_sadalu").'">'.al("saglabat").'</button>'):'';
		if (($cat != 'under') && ($cat != 'next') && ($cat != 'copy')) 
		{
			echo 
				(
					empty($this_page_opened)
					?
					('<button type="button" value="" onclick="javascript:edit('."'under'".','.$id.');" title="'.al("pievienot_jaunu_sadalu_zem_esosas").'"><span style="color:blue;font-weight:bold;">'.al("pievienot_apakssadalu").'</span></button>')
					:
					''
				);
			echo 	'<button type="button" value="" onclick="javascript:edit('."'next'".','.$id.');" title="Pievienot jaunu līdzvērtīgu sadaļu">
					<span style="color:HotPink;font-weight:bold;">'.al("pievienot_blakussadalu").'</span>
				</button>';
			
			if(empty($this_page_opened))
			{
				if($parent_id != -2)
				{
					echo '<button type="delete" name="delete" value="delete" title="'.al("parvietot_sadalu_pie_dzestajam").'">'.al("dzest").'</button>';
				}
			}
		}
		if($order_buttons)
		{
			echo '<div>';
				if(($template != "comment") && ($template != "feedback") && empty($this_page_opened))
				{
					echo	'<button name="order" value="up" type="up" title="'.al("mainit_sadalu_secibu_uz_augsu").'">'.al("uz_augsu").'</button>'.
						'<button name="order" value="down" type="down" title="'.al("mainit_sadalu_secibu_uz_leju").'">'.al("uz_leju").'</button>';
				}
				echo ' ';
				
				echo '<button name="copy" value="copy" type="copy" onclick="javascript:edit('."'copy'".','.$id.');" title="'.al("kopet_sadalu").'">'.al("copy").'</button>';
				//echo '<button name="copy" value="copy_all" type="copy_all" title="'.al("kopet_sadalu_ar_apakssadalam").'">'.al("kopet_grupu").'</button>';
			echo '</div>';
		}
		
	}
	$lang = $languages;
	if(!empty($data["id"]))
		$lang[] = array("iso"=>"gal","name"=> al("galerija"),"active"=>1);
	?>
	<?php if(empty($this_page_opened)) { ?>
	<form action="/admin/tree_save.php?mode=tree" method="post" enctype="multipart/form-data">
	<?php 
	}
	elseif(is_admin())
	{
	?>
	<form action="/admin/tree_save.php?mode=tree" method="post" enctype="multipart/form-data">
	<button name="unblock" value="<?php echo $id; ?>"><?php echo al("atbloket"); ?></button>
	</form>
	<?php
	}
	buttons(); 
	?>
		<script>
		//trees();
		</script>
		<table class="none">
			<tr>
				<td valign="top">
					<table class="sh">
						<tr>
							<th colspan="2" align="left"><?php echo al("detalas"); ?></th>
						</tr>
						<tr>
							<td>ID</td>
							<td>
								<?php echo $data["id"]; ?>
								<input type="hidden" name="id" value="<?php echo $data["id"]; ?>" />
							</td>
						</tr>
						<tr>
							<td><?php echo al("sadalas_veids"); ?></td>
							<td>
								<select name="template_id" <?php if(!empty($this_page_opened)) echo 'disabled'; ?>>
								<?php 
									function template_tree($tpml,$lvl)
									{
										global $template_id;
										$echo = '';
										foreach($tpml as $key => $val)
										{
											$echo .= '<option value="'.$val["t_id"].'" '.(($val["t_id"]==$template_id)?'selected':'').'>&nbsp;'.str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $lvl).$val["template_name"].' ('.$val["template"].')&nbsp;</option>';
											if(!empty($val["sub"]))
												$echo .= template_tree($val["sub"],$lvl+1);
										}
										return $echo;
									}
									echo template_tree($templates,0);
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td><?php echo al("vecaks"); ?></td>
							<td>
								<input type="text" name="parent_id" <?php if(!empty($this_page_opened)) echo 'disabled'; ?> value="<?php echo $data["parent_id"]; ?>" />
								<!-- Uzlikts, lai jebkurš var mainīt vecāku -->
								<?php /*if(is_admin()) { ?>
									<input type="text" name="parent_id" <?php if(!empty($this_page_opened)) echo 'disabled'; ?> value="<?php echo $data["parent_id"]; ?>" />
								<?php } else { ?>
									<?php echo $data["parent_id"]; ?>
									<input type="hidden" name="parent_id" value="<?php echo $data["parent_id"]; ?>" />
								<?php }*/ ?>
							</td>
						</tr>
						<tr>
							<td><?php echo al("alias_id"); ?></td>
							<td>
								<input type="text" name="alias_id" <?php if(!empty($this_page_opened)) echo 'disabled'; ?> value="<?php echo $data["alias_id"]; ?>" />							
							</td>
						</tr>
						<?php if($parent_id > -2) { ?>
						<tr>
							<td><?php echo al("prioritate"); ?></td>
							<td>
								<input style="width:40px;text-align:center;" <?php if(!empty($this_page_opened)) echo 'disabled'; ?> type="text" name="priority" value="<?php echo $data["priority"]; ?>" />
								<a href="/admin/priority/"><?php echo al("apskatit_visas_prioritates"); ?></a>
							</td>
						</tr>
						<?php } ?>
						<!--
						<tr>
							<td><?php echo al("sadalas_links"); ?></td>
							<td>
								<?php
									
								
									foreach($languages as $key => $val)
									{
										$query = "SELECT * FROM `".PREFIX."meta_data` WHERE `meta_id` = '".$data["id"]."' AND `field_id` = '".$fields_ids["url"]."' AND `language_id` = '".$val["id"]."'";
										//echo $query;
										$result = mysql_query($query) or die(mysql_error());
										$row = mysql_fetch_assoc($result);
										$field_data = $row["field_content"];
										
										echo "<div>".$val["iso"].': '.$field_data.'</div>';
									}
								?>
							</td>
						</tr>
						-->
						<tr>
							<td><?php echo al("url"); ?></td>
							<td>
								<div class="edit_border">
									<label><input <?php if(!empty($this_page_opened)) echo 'disabled'; ?> style="width:13px;" type="checkbox" name="hide_link" value="1" <?php if(!empty($data["hide_link"])) echo 'checked'; ?> /> <?php echo al("atzimet_lai_sleptu"); ?></label>
								</div>
							</td>
						</tr>
						<tr>
							<td><?php echo al("deny_page"); ?></td>
							<td>
								<div class="edit_border">
									<label><input <?php if(!empty($this_page_opened)) echo 'disabled'; ?> style="width:13px;" type="checkbox" name="deny_page" value="1" <?php if(!empty($data["deny_page"])) echo 'checked'; ?> /> <?php echo al("check_for_deny_page"); ?></label>
								</div>
							</td>
						</tr>
						<tr>
							<td><?php echo al("author"); ?></td>
							<td>
								<select <?php if(!empty($this_page_opened)) echo 'disabled'; ?> name="author">
									<option value=""> -- <?php echo al("me"); ?> -- </option>
									<?php
									foreach($authors as $key => $val)
									{
										echo '<option value="'.$val["id"].'" '.(($val["id"]==$data["creator_id"])?'selected':'').'>[ '.$val["id"].' ] '.$val["name"].' '.$val["surname"].' ('.$val["mail"].')</option>';
									}
									?>
								</select>
							</td>
						</tr>
						<?php if(!empty($data["date"])) { ?>
						<tr>
							<td><?php echo al("date"); ?></td>
							<td>
								<input type="text" name="date" <?php if(!empty($this_page_opened)) echo 'disabled'; ?> value="<?php echo $data["date"]; ?>" />		
							</td>
						</tr>
						<?php } ?>
						<?php
						
						if($cat == 'copy')
						{
							$data["id"] = $id;
						}
						foreach($fields as $fkey => $fval)
						{
							if(empty($fval["in_langs"]))
							{
								?>
								<tr>
									<td><?php echo al($fval["field_name"]); ?></td>
									<td>
										<?php
										$field_id = '';
										$field_class = '';
										$placeholder = $fval["placeholder"];
										$field_keyup = '';
										$field_data = !empty($cat) ? $fval["default_value"] : '';
										if(!empty($data["id"]))
										{
											$query = "SELECT * FROM `".PREFIX."meta_data` WHERE `meta_id` = '".$data["id"]."' AND `field_id` = '".$fval["field_id"]."' AND `language_id` = '0'";
											//echo $query;
											$result = mysql_query($query) or die(mysql_error());
											$row = mysql_fetch_assoc($result);
											$field_data = $row["field_content"];
											
										}
										switch($fval["field_type"])
										{
											case "input":
												$input_type="text";												
												?>
												<input 
													id="<?php echo $field_id; ?>"
													<?php if(!empty($this_page_opened)) echo 'disabled'; ?> 
													type="<?php echo $input_type; ?>" 
													name="meta_data[0][<?php echo $fval["field_id"]; ?>]" 
													placeholder="<?php echo $placeholder; ?>"
													onkeyup="<?php echo $field_keyup; ?>"
													value="<?php echo $field_data; ?>" />
												<?php
												break;
											case "text":
												?>
												<textarea
													id="<?php echo $field_id; ?>"
													<?php if(!empty($this_page_opened)) echo 'disabled'; ?> 
													name="meta_data[0][<?php echo $fval["field_id"]; ?>]"
													placeholder="<?php echo $placeholder; ?>"
													class="<?php echo $field_class; ?><?php if(!empty($this_page_opened)) echo 'disabled'; ?>"
													onkeyup="<?php echo $field_keyup; ?>"
													><?php echo $field_data; ?></textarea>
												<?php
												break;
											case "checkbox":
												$input_type="checkbox";
												$field_id = 'checkbox_'.$val["id"].'_'.$fval["field_id"];
												?>
												<input 
													style="width:auto;"
													<?php if(!empty($this_page_opened)) echo 'disabled'; ?> 
													type="<?php echo $input_type; ?>" 
													onchange="$('#<?php echo $field_id; ?>').val(($(this).is(':checked') ? 1 : 0));"
													<?php echo !empty($field_data) ? 'checked' : ''; ?> />
												<input
													id="<?php echo $field_id; ?>"
													type="hidden"
													name="meta_data[0][<?php echo $fval["field_id"]; ?>]" 
													value="<?php echo $field_data; ?>"
													/>
												<?php
												break;
											case "multicheckbox":
												$field_id = 'multicheckbox_'.$fval["in_langs"].'_'.$fval["field_id"];
												?>
												<script>
													function func_<?php echo $field_id; ?>()
													{
														var <?php echo $field_id; ?> = '';
														$('input.<?php echo $field_id; ?>').each(function(){
															<?php echo $field_id; ?> = <?php echo $field_id; ?> + ($(this).is(':checked') ? (((<?php echo $field_id; ?> !='') ? '#' : '')+$(this).val()) : '');
														});
														//alert(<?php echo $field_id; ?>);
														$('#<?php echo $field_id; ?>').val(<?php echo $field_id; ?>);
													}
												</script>
												<?php
												$multicheckbox_array[$field_id] = explode("#",$field_data);
												if(meta("S",array( "template"=>$fval["field_name"],"lang"=>$admin_lang,"no_link"=>1,"alert"=>0),$multicheckbox[$field_id]))
												{
													foreach($multicheckbox[$field_id] as $mckey => $mcval)
													{
														echo (($mckey>0) ? '<br />' : '') . '<label>'; ?>
														<input type="checkbox"
															<?php if(in_array($mcval["id"],$multicheckbox_array[$field_id])) echo 'checked="checked"'; ?>
															class="<?php echo $field_id; ?>"
															onchange="func_<?php echo $field_id; ?>();"
															value="<?php echo $mcval["id"]; ?>"
														/> 
														[<?php echo $mcval["id"].'] '.$mcval["menu_name"].'</label>';
													}
												}
												?>
												<input
													id="<?php echo $field_id; ?>"
													type="hidden"
													name="meta_data[0][<?php echo $fval["field_id"]; ?>]" 
													value="<?php echo $field_data; ?>"
													/>
												<?php
												break;
											case "selectbox":
												$field_id = 'selectbox_'.$fval["in_langs"].'_'.$fval["field_id"];
												//echo $field_id;
												//out($fval);
												?>
												<select
													<?php if(!empty($this_page_opened)) echo 'disabled'; ?>
													name="meta_data[0][<?php echo $fval["field_id"]; ?>]"
													>
													<option value=""> --- </option>
													<?php
														if(meta("S",array( "template"=>$fval["field_name"],"lang"=>$admin_lang,"no_link"=>1,"alert"=>0),$selectbox[$field_id]))
														{
															foreach($selectbox[$field_id] as $sbkey => $sbval)
															{
																echo '<option value="'.$sbval["id"].'" '.
																(($sbval["id"]==$field_data) ? 'selected' : '')
																.'>['.$sbval["id"].'] '.$sbval["menu_name"].'</option>';
															}
														}												
													?>
												</select>
												<?php
												break;
										}
										?>
										
									</td>
								</tr>
							<?php 
							}	
						}
						?>
					</table>
				</td>
				<td valign="top">
					<table class="sh">
						<tr>
							<td><?php echo al("upload_max_filesize"); ?>:</td><td><?php echo ini_get('upload_max_filesize'); ?></td>
						</tr>
					</table>
					<?php											
						if(!empty($id) && !empty($do_revisions))
						{
							$query3 = "SELECT
									`id`,
									`user_id`,
									`meta_id`,
									`backup_date`,
									LEFT(`backup_date`,10) AS short_date
								FROM `".PREFIX."backup` 
								WHERE `meta_id` = '$id' 
								ORDER BY `backup_date` DESC";
							//out($query3);
							$res3 = mysql_query($query3) or die(mysql_error().$query3);
							if(mysql_num_rows($res3) > 0)
							{
								while($row3 = mysql_fetch_assoc($res3))
								{
									$revisions[] = $row3;
								}
							}
							if(!empty($revisions))
							{
								?>
									<style>
										#revisions tr.more {
											display:none;
										}
										#revisions a[type="edit"] span {
											display:none;
										}
										#revisions a[type="edit"] span:first-child {
											display:inline;
										}
										#revisions.more tr.more {
											display:table-row;
										}
										#revisions.more a[type="edit"] span {
											display:inline;
										}
										#revisions.more a[type="edit"] span:first-child {
											display:none;
										}
									</style>
									<table id="revisions" class="sh">
										<tr>
											<th class="left"><?php echo al("revisions"); ?></th>
											<th class="left"><?php echo al("author"); ?></th>
										</tr>										
										<?php
											foreach($revisions as $key => $val)
											{
												echo '<tr '.(($key>4) ? 'class="more"' : '').'>';
												echo '<td><a
														onclick="set_activity_data_date('."'".$val["short_date"]."','".$val["short_date"]."','$id'".','.$val["id"].');"
														>'.$val["backup_date"].'</a></td>';
												echo '<td>';
												if(!empty($val["user_id"]) && get_user("S",array("id"=>$val["user_id"]),$rev_auth[$key]))
												{
													echo '<a
														href="/admin/user/'.$val["user_id"].'"
														target="_blank"
														>'.$rev_auth[$key][0]["name"].' '.$rev_auth[$key][0]["surname"].' ('.$rev_auth[$key][0]["mail"].')</a>';
												}
												echo '</td>';
												echo '</tr>';
											}
										if(count($revisions) > 5) {
										?>		
										<tr>
											<td colspan="2" class="left"><a
															type="edit"
															onclick="$('#revisions').toggleClass('more');"
															><span><?php echo al("more"); ?></span><span><?php echo al("less"); ?></span></a></td>
										</tr>	
										<?php } ?>
									</table>
									
								<?php
							}
							//out($revisions);
							//set_activity_data_date(from,to,meta_id)
						}					
					?>
				</td>
			</tr>
		</table>
		
		<table class="none">
			<tr>
				<td valign="top">
					<div class="edit_tabs">
					<?php 
					foreach($lang as $key => $val) { ?>
						<a 
							<?php if($val["iso"]==$admin_lang) echo 'class="active"'; ?> 
							onclick="
								$('.edit_tabs a').removeClass('active');
								$('.edit_block').removeClass('active');
								$(this).addClass('active');
								$('.edit_block.<?php echo $val["iso"]; ?>').addClass('active');
								"
							<?php if(empty($val["active"])) { ?>style="color:#cccccc;font-style:italic;background:#eeeeee;" <?php } ?>
							><?php echo $val["name"]; ?></a>
					<?php } ?>
					</div>
					<div class="none" style="position:relative;">
						<script>
						function set_SEO(span_id, box_id, simb)
						{
							skaits = simb - $(box_id).val().length;
							if(skaits < 0 )
							{
								$(span_id).css('color','red');
								$(span_id).text('(<?php echo al("parsniegti"); ?> ' + (skaits*-1) + ' <?php echo al("simboli"); ?>)');
							}
							else 
							{
								$(span_id).css('color','');
								$(span_id).text('(<?php echo al("atlikusi"); ?> ' + skaits + ' <?php echo al("simboli"); ?>)');
							}
							
						}
						</script>
						<?php foreach($lang as $key => $val) { ?>
						<div class="edit_block <?php echo $val["iso"]; ?> <?php if($val["iso"]==$admin_lang) echo 'active'; ?> <?php if(empty($val["active"])) echo 'hidden_lang'; ?>">
							<table class="edit sh">
								<tr>
									<th align="left"><?php echo $val["name"]; ?></th>
									<th align="right"><button class="red bold" title="<?php echo al("iztuksot_laucinus"); ?>" onclick="$('#text_<?php echo $val["iso"]; ?>_ifr').contents().find('body').text('');$('.edit_block.<?php echo $val["iso"]; ?> input, .edit_block.<?php echo $val["iso"]; ?> textarea').val('');return false;">X</button></th>
								</tr>
								<?php 
									if($val["iso"] == 'gal') 
									{
									?>
										<tr>
											<td colspan="2">
												<?php
													if(empty($this_page_opened))
													{
														?>
														<iframe style="width:800px;height:500px;" <?php
															if(file_exists("gallery_plus.php"))
															{
																?>
																	src="/admin/gallery_plus.php?id=<?php echo $id; ?>"
																<?php	
															}
															else
															{
																?>
																	src="/admin/gallery.php?id=<?php echo $id; ?>"
																<?php
															}
														?>></iframe>
														<?php 
													}
												?>
											</td>
										</tr>
									</table>
										
									<?php
									break; }
									?>
								<?php
									foreach($fields as $fkey => $fval)
									{
										if(!empty($fval["in_langs"]))
										{
										?>
										<tr>
											<td>
											<?php 
												
												switch($fval["field_name"])
												{
													case "name":
														if(!empty($data["id"]) && (($template=="comment")||($template=="feedback")))
														{
															?>
															<img
																src="<?php
																	echo
																		((!empty($data["creator"][0]["soc"]) && ($data["creator"][0]["soc"]=="00")) || empty($data["creator"][0]["image"]))
																		?
																		"/images/users/"
																		:
																		''
																		;
																	echo
																		!empty($data["creator"][0]["image"])
																		?
																		$data["creator"][0]["image"]
																		:
																		"noimage.jpg";
																	?>" style="height:30px;" />
															<?php
														}
														else
														{
															echo al($fval["field_name"]);
														}
																
														break;
													case "content":
															echo al($fval["field_name"]);
															?><br /><span style="font-size:0.8em;">(<?php echo $val["name"]; ?><br /><?php echo al("sadalas_apraskts"); ?>)</span><?php	
														break;
													case "meta_title":
															echo al($fval["field_name"]);
															?><br /><span style="font-size:0.8em;"><span id="seo_title_<?php echo $val["iso"]; ?>"></span></span><?php	
														break;
													case "meta_description":
															echo al($fval["field_name"]);
															?><br /><span style="font-size:0.8em;"><span id="seo_desc_<?php echo $val["iso"]; ?>"></span></span><?php	
														break;
													default:
														echo al($fval["field_name"]);
												}
											?>
											</td>
											<td>
												<?php
												$field_id = '';
												$field_class = '';
												$placeholder = !empty($fval["placeholder"]) ? $fval["placeholder"] : '';
												$field_keyup = '';
												$field_data = !empty($cat) ? $fval["default_value"] : '';
												if(!empty($data["id"]))
												{
													$query = "SELECT * FROM ".PREFIX."meta_data WHERE meta_id = '".$data["id"]."' AND field_id = '".$fval["field_id"]."' AND language_id = '".$val["id"]."'";
													//echo $query;
													$result = mysql_query($query) or die(mysql_error());
													$row = mysql_fetch_assoc($result);
													$field_data = $row["field_content"];
												}
												switch($fval["field_type"])
												{
													case "input":
														$input_type="text";
														if(!empty($data["id"]) && ($fval["field_name"]=="name") && ( ($template=="comment") || ($template=="feedback") ))
														{
															?>
															<a href="/admin/user/<?php echo $data["creator_id"]; ?>">
																<?php
																	echo
																		(
																			(!empty($data["creator"][0]["name"]) || !empty($data["creator"][0]["surname"]))
																			?
																			(
																				(!empty($data["creator"][0]["name"]) ? $data["creator"][0]["name"] : '').
																				" ".
																				(!empty($data["creator"][0]["surname"]) ? $data["creator"][0]["surname"] : '')
																			)
																			:
																			(!empty($data["creator"][0]["mail"]) ? $data["creator"][0]["mail"] : '')
																		);
																?>
															</a>
															<?php
															$input_type="hidden";
														}
														if($fval["field_name"]=="meta_title") { $field_id = 'seo_title_ar_'.$val["iso"]; $field_keyup = "set_SEO('#seo_title_".$val["iso"]."',this,69);"; }
														?>
														<input 
															id="<?php echo $field_id; ?>"
															<?php if(!empty($this_page_opened)) echo 'disabled'; ?> 
															type="<?php echo $input_type; ?>" 
															name="meta_data[<?php echo $val["id"]; ?>][<?php echo $fval["field_id"]; ?>]"
															placeholder="<?php echo $placeholder; ?>"
															onkeyup="<?php echo $field_keyup; ?>"
															value="<?php echo $field_data; ?>" />
														<?php
														if($fval["field_name"]=="meta_title") { ?><script>set_SEO('#seo_title_<?php echo $val["iso"]; ?>',$('#seo_title_ar_<?php echo $val["iso"]; ?>'),69);</script><?php }
														break;
													case "text":
														if($fval["field_name"]=="meta_description") { $field_id = 'seo_text_ar_'.$val["iso"]; $field_keyup = "set_SEO('#seo_desc_".$val["iso"]."',this,156);"; }
														if($fval["field_name"]=="content") { $field_id = 'text_'.$val["iso"]; $field_class = 'tiny'; }
														?>
														<textarea
															id="<?php echo $field_id; ?>"
															<?php if(!empty($this_page_opened)) echo 'disabled'; ?> 
															name="meta_data[<?php echo $val["id"]; ?>][<?php echo $fval["field_id"]; ?>]"
															placeholder="<?php echo $placeholder; ?>"
															class="<?php echo $field_class; ?><?php if(!empty($this_page_opened)) echo 'disabled'; ?>"
															onkeyup="<?php echo $field_keyup; ?>"
															><?php echo $field_data; ?></textarea>
														<?php
														if($fval["field_name"]=="meta_description") { ?><script>set_SEO('#seo_desc_<?php echo $val["iso"]; ?>',$('#seo_text_ar_<?php echo $val["iso"]; ?>'),156);</script><?php }
														break;
													case "text_tiny":													
														$field_class = 'tiny';
														?>
														<textarea
															id="<?php echo $field_id; ?>"
															<?php if(!empty($this_page_opened)) echo 'disabled'; ?>
															name="meta_data[<?php echo $val["id"]; ?>][<?php echo $fval["field_id"]; ?>]"
															placeholder="<?php echo $placeholder; ?>"
															class="<?php echo $field_class; ?><?php if(!empty($this_page_opened)) echo 'disabled'; ?>"
															onkeyup="<?php echo $field_keyup; ?>"
															><?php echo $field_data; ?></textarea>
														<?php
														if($fval["field_name"]=="meta_description") { ?><script>set_SEO('#seo_desc_<?php echo $val["iso"]; ?>',$('#seo_text_ar_<?php echo $val["iso"]; ?>'),156);</script><?php }
														break;
													case "checkbox":
														$input_type="checkbox";
														$field_id = 'checkbox_'.$val["id"].'_'.$fval["field_id"];
														?>
														<input 
															style="width:auto;"
															<?php if(!empty($this_page_opened)) echo 'disabled'; ?> 
															type="<?php echo $input_type; ?>" 
															onchange="$('#<?php echo $field_id; ?>').val(($(this).is(':checked')?1:0));"
															<?php echo !empty($field_data) ? 'checked' : ''; ?> />
														<input
															id="<?php echo $field_id; ?>"
															type="hidden"
															name="meta_data[<?php echo $val["id"]; ?>][<?php echo $fval["field_id"]; ?>]" 
															value="<?php echo $field_data; ?>"
															/>
														<?php
														break;
													case "selectbox":
														$field_id = 'selectbox_'.$fval["in_langs"].'_'.$fval["field_id"];
														?>
														<select
															<?php if(!empty($this_page_opened)) echo 'disabled'; ?>
															name="meta_data[<?php echo $val["id"]; ?>][<?php echo $fval["field_id"]; ?>]"
															>
															<option value=""> --- </option>
															<?php
																if(meta("S",array( "template"=>$fval["field_name"],"lang"=>$admin_lang,"no_link"=>1,"alert"=>0),$selectbox[$field_id]))
																{
																	foreach($selectbox[$field_id] as $sbkey => $sbval)
																	{
																		echo '<option value="'.$sbval["id"].'" '.
																		(($sbval["id"]==$field_data) ? 'selected' : '')
																		.'>['.$sbval["id"].'] '.$sbval["menu_name"].'</option>';
																	}
																}												
															?>
														</select>
														<?php
														break;
												}
												?>
												
											</td>
										</tr>
									<?php } } ?>
							</table>
						</div>
					<?php } 
					?>
					</div>
				</td>
				<td style="vertical-align:top;">
					<!------------------------------------------------------------------------------------------------------------------------------------------->
					<div class="upload_hider">
						<button type="add" style="background:lightblue;">+</button> <span></span> <?php echo $data["image_big_size"]; ?>
						<?php if(!empty($data["image_big"])) { ?><button type="delete" name="delete_image">x</button><?php } ?>
						<input name="image_big" <?php if(!empty($this_page_opened)) echo 'disabled'; ?> 
							type="file" accept="image/png, image/x-png, image/gif, image/jpeg" />
					</div>
					<img class="sh" src="/images/meta/<?php echo ($data["image_big"] ? $data["image_big"] : 'noimage.png'); ?>" style="max-width:300px;background: #EAEAEA;" /><br />
					<!------------------------------------------------------------------------------------------------------------------------------------------->
					<div class="upload_hider">
						<button type="add">+</button> <span><small class="red bold">(<?php echo IMG_WIDTH; ?>px) <?php echo $data["image_size"]; ?></small></span>
						<?php if(!empty($data["image"])) { ?><button type="delete" name="delete_image">x</button><?php } ?>
						<input name="image" <?php if(!empty($this_page_opened)) echo 'disabled'; ?> 
							type="file" accept="image/png, image/x-png, image/gif, image/jpeg" />
					</div>
					<img class="sh" src="/images/meta/<?php echo ($data["image"] ? $data["image"] : 'noimage_thumb.png'); ?>" style="max-width:200px;background: #EAEAEA;" /><br />
					<!------------------------------------------------------------------------------------------------------------------------------------------->
					<div class="upload_hider">
						<button type="add">+</button> <span><small class="red bold">(<?php echo IMG_SMALL_WIDTH; ?>px) <?php echo $data["image_small_size"]; ?></small></span>
						<?php if(!empty($data["image_small"])) { ?><button type="delete" name="delete_image">x</button><?php } ?>
						<input name="image_small" <?php if(!empty($this_page_opened)) echo 'disabled'; ?> 
							type="file" accept="image/png, image/x-png, image/gif, image/jpeg, application/pdf" />
					</div>
					<?php
						$ext_sm = explode(".",$data["image_small"]);
						$ext_sm = end($ext_sm);
						if(strtolower($ext_sm) == "pdf")
						{
							?>
							<a 
								class="uploaded_file thumb"
								target="_blank"
								href="/images/meta/<?php echo $data["image_small"]; ?>"
								><?php include("../cms/css/images/pdf.svg"); ?></a>
							<?php
						}
						else
						{
							?>
							<img class="sh" src="/images/meta/<?php echo ($data["image_small"] ? $data["image_small"] : 'noimage_thumb.png'); ?>" style="max-width:100px;background: #EAEAEA;" />
							<?php
						}
					?>
					<!------------------------------------------------------------------------------------------------------------------------------------------->
					<div class="upload_hider">
						<button type="add">+</button> <span><small class="red bold">(<?php echo IMG_THUMB_WIDTH; ?>px) <?php echo $data["image_thumb_size"]; ?></small></span>
						<?php if(!empty($data["image_thumb"])) { ?><button type="delete" name="delete_image">x</button><?php } ?>
						<input name="image_thumb" <?php if(!empty($this_page_opened)) echo 'disabled'; ?> 
							type="file" accept="image/png, image/x-png, image/gif, image/jpeg, application/pdf" />
					</div>
					<?php
						$ext_th = explode(".",$data["image_thumb"]);
						$ext_th = end($ext_th);
						if(strtolower($ext_th) == "pdf")
						{
							?>
							<a 
								class="uploaded_file thumb"
								target="_blank"
								href="/images/meta/<?php echo $data["image_thumb"]; ?>"
								><?php include("../cms/css/images/pdf.svg"); ?></a>
							<?php
						}
						else
						{
							?>
							<img class="sh" src="/images/meta/<?php echo ($data["image_thumb"] ? $data["image_thumb"] : 'noimage_thumb.png'); ?>" style="max-width:100px;background: #EAEAEA;" />
							<?php
						}
					?>
					<!------------------------------------------------------------------------------------------------------------------------------------------->
				</td>
			</tr>
		</table>
		<?php
		buttons();
		?>
	<?php if(empty($this_page_opened)) { ?>
	</form>
	<?php } ?>
	<script type="text/javascript" src="/cms/js/tiny_mce/tiny_mce_compact.js"></script>
	<script type="text/javascript">
		$(document).ready(function()
		{		
			check_tree_lock();
			$('.upload_hider button[type=add]').click(function(){
				$(this).parent('.upload_hider').children('input').click();
				return false;
			});
			$('.upload_hider button[type=delete]').click(function(){
				if (!confirm('<?php echo al("dzest_attelu"); ?>'))
				{
					return false;
				}
				$(this).val($(this).parent('.upload_hider').children('input').attr('name'));
				//return false;
			});
			$('.upload_hider input').on('change',function(){
				$(this).parent('.upload_hider').children('span').text($(this).val().split('\\').pop());
			});
		});
		
	</script>
<?php
}
?>