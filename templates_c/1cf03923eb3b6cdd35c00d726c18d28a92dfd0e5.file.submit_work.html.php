<?php /* Smarty version Smarty-3.0.7, created on 2018-05-08 13:54:47
         compiled from ".\templates\./logged_in/submit_work.html" */ ?>
<?php /*%%SmartyHeaderCode:215135af181f71a1d58-10862069%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1cf03923eb3b6cdd35c00d726c18d28a92dfd0e5' => 
    array (
      0 => '.\\templates\\./logged_in/submit_work.html',
      1 => 1525776883,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '215135af181f71a1d58-10862069',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'D:\WWW\lingverto\cms\smarty\plugins\modifier.date_format.php';
?><h1><?php echo $_smarty_tpl->getVariable('lg')->value['submit_work'];?>
</h1>
<div class="contents">
	<div class="centered_text">
		<div id="submit_work" class="noselect quote_block">
			<div id="close_quote">✖</div>

			<div class="contents">
				<div class="segments">
					<div class="segment page_one">
						<span class="title">
							<?php echo $_smarty_tpl->getVariable('lg')->value['quote_one'];?>

						</span>

						<div class="language_dropdown_group" rel="0">
							<div class="dropdowns">
								<div class="dropdown">
									<div class="select language_from" onclick="language_select($(this),'file_upload_modal', form_data, 'submit_work');">
										<span class="text">
											<?php echo $_smarty_tpl->getVariable('lg')->value['source_language'];?>

										</span>
										<input type="hidden" name="language_from">
										<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
									</div>
								</div>

								<span class="divider">&rarr;</span>

								

								<div class="dropdown">
									<div class="select language_to" onclick="language_select($(this),'file_upload_modal', form_data, 'submit_work');">
										<span class="text language_to_select">
											<?php echo $_smarty_tpl->getVariable('lg')->value['source_languages'];?>

										</span>
										<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
									</div>
										<input type="hidden" name="language_to_1">
								</div>
								<span class="close" onClick="closeRow(this, form_data);">✖</span>
							</div>
							<div class="file_sector">
							
								<label class="bloated simple primary button file_upload_call"  rel="0" onClick="callFileUploadModal(this, 'file_upload_modal');">
									<?php echo $_smarty_tpl->getVariable('lg')->value['upload'];?>

								</label>
							</div>
						</div>
						<span class="more">
							<?php echo $_smarty_tpl->getVariable('lg')->value['more_files'];?>

						</span>
						<div class="more_files_warning"><?php echo $_smarty_tpl->getVariable('lg')->value['more_files_warning'];?>
</div>

						

					</div> <!-- / .segment -->

					 <!-- / .segment -->




					<div class="segment page_one">
						<span class="title">
							<?php echo $_smarty_tpl->getVariable('lg')->value['quote_three'];?>

						</span>

						<?php $_smarty_tpl->tpl_vars["daysLeftThisYear"] = new Smarty_variable((365-smarty_modifier_date_format(time(),"%j")), null, null);?>

						<div class="dropdown small date">
							<input type="text" id="date" name="date">
							<div class="select">
								<span class="text">
									<?php echo $_smarty_tpl->getVariable('lg')->value['date'];?>

								</span>
								<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
							</div>
						</div>

						<div class="dropdown small">
							<div class="select">
								<span class="text">
									<?php echo $_smarty_tpl->getVariable('lg')->value['time'];?>

								</span>
								<input name="time" id="time_input" type="hidden">
								<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
							</div>
							<div class="items">
								<div class="contents scrollable">
									<?php $_smarty_tpl->tpl_vars['n'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['n']->step = 1;$_smarty_tpl->tpl_vars['n']->total = (int)ceil(($_smarty_tpl->tpl_vars['n']->step > 0 ? 23+1 - (0) : 0-(23)+1)/abs($_smarty_tpl->tpl_vars['n']->step));
if ($_smarty_tpl->tpl_vars['n']->total > 0){
for ($_smarty_tpl->tpl_vars['n']->value = 0, $_smarty_tpl->tpl_vars['n']->iteration = 1;$_smarty_tpl->tpl_vars['n']->iteration <= $_smarty_tpl->tpl_vars['n']->total;$_smarty_tpl->tpl_vars['n']->value += $_smarty_tpl->tpl_vars['n']->step, $_smarty_tpl->tpl_vars['n']->iteration++){
$_smarty_tpl->tpl_vars['n']->first = $_smarty_tpl->tpl_vars['n']->iteration == 1;$_smarty_tpl->tpl_vars['n']->last = $_smarty_tpl->tpl_vars['n']->iteration == $_smarty_tpl->tpl_vars['n']->total;?>
										<span class="item" onclick="resetInputNoRel(this, 'time', form_data)"><?php echo $_smarty_tpl->tpl_vars['n']->value;?>
:00</span>
									<?php }} ?>
								</div>
							</div>
						</div>
						<div class="dropdown wide">
							<div class="select">
								<span class="text">
									(GMT+02:00) Riga, Helsinki, Kyiv, Sofia, Tallinn, Vilnius
								</span>
								<input name="time_zone" type="hidden" value="(GMT+02:00) Riga, Helsinki, Kyiv, Sofia, Tallinn, Vilnius">
								<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
							</div>
							<div class="items time_zone">
								<div class="contents time_zone_select  scrollable">
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Europe/Helsinki">(GMT+02:00) Riga, Helsinki, Kyiv, Sofia, Tallinn, Vilnius</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Etc/GMT+12">(GMT-12:00) International Date Line West</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Pacific/Honolulu">(GMT-10:00) Hawaii</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="US/Alaska">(GMT-09:00) Alaska</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="America/Los_Angeles">(GMT-08:00) Pacific Time (US & Canada)</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="America/Tijuana">(GMT-08:00) Tijuana, Baja California</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="US/Arizona">(GMT-07:00) Arizona</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="US/Mountain">(GMT-07:00) Mountain Time (US & Canada)</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="America/Managua">(GMT-06:00) Central America</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="US/Central">(GMT-06:00) Central Time (US & Canada)</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="America/Mexico_City">(GMT-06:00) Guadalajara, Mexico City, Monterrey</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Canada/Saskatchewan">(GMT-06:00) Saskatchewan</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="US/Eastern">(GMT-05:00) Eastern Time (US & Canada)</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="US/East-Indiana">(GMT-05:00) Indiana (East)</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Canada/Atlantic">(GMT-04:00) Atlantic Time (Canada)</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="America/Caracas">(GMT-04:00) Caracas, La Paz</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="America/Manaus">(GMT-04:00) Manaus</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="America/Santiago">(GMT-04:00) Santiago</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Canada/Newfoundland">(GMT-03:30) Newfoundland</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="America/Sao_Paulo">(GMT-03:00) Brasilia</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires, Georgetown</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="America/Godthab">(GMT-03:00) Greenland</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="America/Montevideo">(GMT-03:00) Montevideo</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="America/Noronha">(GMT-02:00) Mid-Atlantic</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Atlantic/Azores">(GMT-01:00) Azores</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Africa/Casablanca">(GMT+00:00) Casablanca, Monrovia, Reykjavik</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Etc/Greenwich">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Europe/Sarajevo">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Africa/Lagos">(GMT+01:00) West Central Africa</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Amman">(GMT+02:00) Amman</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Europe/Athens">(GMT+02:00) Athens, Bucharest, Istanbul</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Beirut">(GMT+02:00) Beirut</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Africa/Cairo">(GMT+02:00) Cairo</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Africa/Harare">(GMT+02:00) Harare, Pretoria</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Jerusalem">(GMT+02:00) Jerusalem</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Europe/Minsk">(GMT+02:00) Minsk</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Africa/Windhoek">(GMT+02:00) Windhoek</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Kuwait">(GMT+03:00) Kuwait, Riyadh, Baghdad</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg, Volgograd</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Africa/Nairobi">(GMT+03:00) Nairobi</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Tbilisi">(GMT+03:00) Tbilisi</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Tehran">(GMT+03:30) Tehran</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Muscat">(GMT+04:00) Abu Dhabi, Muscat</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Baku">(GMT+04:00) Baku</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Yerevan">(GMT+04:00) Yerevan</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Kabul">(GMT+04:30) Kabul</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Yekaterinburg">(GMT+05:00) Yekaterinburg</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Karachi">(GMT+05:00) Islamabad, Karachi, Tashkent</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Calcutta">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Calcutta">(GMT+05:30) Sri Jayawardenapura</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Katmandu">(GMT+05:45) Kathmandu</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Almaty">(GMT+06:00) Almaty, Novosibirsk</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi, Jakarta</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Kuala_Lumpur">(GMT+08:00) Kuala Lumpur, Singapore</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Australia/Perth">(GMT+08:00) Perth</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Taipei">(GMT+08:00) Taipei</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Seoul">(GMT+09:00) Seoul</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Yakutsk">(GMT+09:00) Yakutsk</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Australia/Adelaide">(GMT+09:30) Adelaide</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Australia/Darwin">(GMT+09:30) Darwin</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Australia/Brisbane">(GMT+10:00) Brisbane</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Australia/Canberra">(GMT+10:00) Canberra, Melbourne, Sydney</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Australia/Hobart">(GMT+10:00) Hobart</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Pacific/Guam">(GMT+10:00) Guam, Port Moresby</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Vladivostok">(GMT+10:00) Vladivostok</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Asia/Magadan">(GMT+11:00) Magadan, Solomon Is., New Caledonia</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Pacific/Fiji">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</span>
								   <span onclick="resetInputNoRel(this, 'time_zone', form_data)" class="item" value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</span>
								</div>
							</div>
						</div>
					</div>  <!-- / .segment -->
					<div class="segment page_one">
						<span class="title">
							<?php echo $_smarty_tpl->getVariable('lg')->value['quote_four'];?>

						</span>
						<textarea></textarea>
					</div>
				</div>

				<div class="controls center page_one">
					<span class="bloated primary submit button" id="toggle_details">
						<?php echo $_smarty_tpl->getVariable('lg')->value['continue'];?>

					</span>
				</div>

				<div class="segments page_two">
					<div class="segment">
						<span class="title">
							<?php echo $_smarty_tpl->getVariable('lg')->value['quote_five'];?>

						</span>

						<div id="personal_data">
							<div class="segment">
								<span class="title">
									<?php echo $_smarty_tpl->getVariable('lg')->value['first_name'];?>
<span class="primary"> *</span>
								</span>
								<input class="required" name="first_name" type="text">
							</div>
							<div class="segment">
								<span class="title">
									<?php echo $_smarty_tpl->getVariable('lg')->value['last_name'];?>
<span class="primary"> *</span>
								</span>
								<input class="required" name="last_name" type="text">
							</div>
							<div class="segment">
								<span class="title">
									<?php echo $_smarty_tpl->getVariable('lg')->value['email'];?>
<span class="primary"> *</span>
								</span>
								<input class="required" name="email" type="email">
							</div>
							<div class="segment phone">
								<span class="title">
									<?php echo $_smarty_tpl->getVariable('lg')->value['phone'];?>

								</span>
								<div class="controls">
									<input type="text" name="phone_country_code" placeholder="+371" class="phone">
									<input type="text" name="phone" class="phone">
								</div>
							</div>
						</div>
					</div> <!-- / .segment -->
				</div>

				<div class="controls center page_two">
					<span class="simple bloated primary submit button" id="go_back">
						<?php echo $_smarty_tpl->getVariable('lg')->value['go_back'];?>

					</span>

					<span class="bloated primary submit button" id="submit_work_button">
						<?php echo $_smarty_tpl->getVariable('lg')->value['submit'];?>

					</span>
				</div>
			</div> <!-- / .contents -->
		</div> <!-- / .quote_block -->


</div>
</div>