<?php /* Smarty version Smarty-3.0.7, created on 2018-05-03 17:17:04
         compiled from ".\templates\./logged_in/translators.html" */ ?>
<?php /*%%SmartyHeaderCode:252705aeb19e0c17b21-93177374%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4dd04cf345dc3a20cdd39ee74ca79ad0a6d5fd75' => 
    array (
      0 => '.\\templates\\./logged_in/translators.html',
      1 => 1525357022,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '252705aeb19e0c17b21-93177374',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('lg')->value['translators'];?>
</h1>
<div class="contents">
	<div class="controls top">
		<div class="item<?php if ($_smarty_tpl->getVariable('manager')->value['curr_page']==0){?> active<?php }?>">
			<a <?php if ($_smarty_tpl->getVariable('manager')->value['curr_page']!=0){?>href="<?php echo $_smarty_tpl->getVariable('manager')->value['route']['url'];?>
/0"<?php }?>>
				LIST
			</a>
		</div>
		<div class="item<?php if ($_smarty_tpl->getVariable('manager')->value['curr_page']==1){?> active<?php }?>">
			<a <?php if ($_smarty_tpl->getVariable('manager')->value['curr_page']!=1){?>href="<?php echo $_smarty_tpl->getVariable('manager')->value['route']['url'];?>
/1"<?php }?>>
				CREATE NEW
			</a>
		</div>
	</div>
	<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable(0, null, null);?>
	<?php if (!empty($_smarty_tpl->getVariable('manager',null,true,false)->value['translators'])){?>
		<?php if ($_smarty_tpl->getVariable('manager')->value['translators']=="PROFILE"){?>
			<div><?php echo $_smarty_tpl->getVariable('lg')->value['first_name'];?>
: <?php echo $_smarty_tpl->getVariable('manager')->value['employee']['name'];?>
</div>
			<div><?php echo $_smarty_tpl->getVariable('lg')->value['last_name'];?>
: <?php echo $_smarty_tpl->getVariable('manager')->value['employee']['surname'];?>
</div>
			<div><?php echo $_smarty_tpl->getVariable('lg')->value['email'];?>
: <?php echo $_smarty_tpl->getVariable('manager')->value['employee']['mail'];?>
</div>
			<div><?php echo $_smarty_tpl->getVariable('lg')->value['phone'];?>
: <?php if (!empty($_smarty_tpl->getVariable('manager',null,true,false)->value['employee']['phone'])){?><?php echo $_smarty_tpl->getVariable('manager')->value['employee']['phone'];?>
<?php }else{ ?>-<?php }?></div>
			
			<div>
				<?php if (((!empty($_smarty_tpl->getVariable('manager',null,true,false)->value['employee']['translator']))&&(!empty($_smarty_tpl->getVariable('manager',null,true,false)->value['employee']['editor'])))){?>
					<?php echo $_smarty_tpl->getVariable('lg')->value['translator_editor'];?>

				<?php }elseif((!empty($_smarty_tpl->getVariable('manager',null,true,false)->value['employee']['translator']))){?>
					<?php echo $_smarty_tpl->getVariable('lg')->value['translator'];?>

				<?php }elseif((!empty($_smarty_tpl->getVariable('manager',null,true,false)->value['employee']['editor']))){?>
					<?php echo $_smarty_tpl->getVariable('lg')->value['editor'];?>

				<?php }?>
			</div>
				<?php if (!empty($_smarty_tpl->getVariable('manager',null,true,false)->value['employee']['language_pairs'])){?>
			<h3><?php echo $_smarty_tpl->getVariable('lg')->value['employee_pair'];?>
</h3>
			<table id="translator_pairs" class="hidden_rows">
				<thead>
					<tr>
						<th>
							<?php echo $_smarty_tpl->getVariable('lg')->value['select_for_action'];?>

						</th>
						<th>
							<?php echo $_smarty_tpl->getVariable('lg')->value['language_pair'];?>

						</th>
						<th>
							<?php echo $_smarty_tpl->getVariable('lg')->value['known_since'];?>

						</th>
						<th>
							<?php echo $_smarty_tpl->getVariable('lg')->value['vacancy_rate'];?>

						</th>
						<th><?php echo $_smarty_tpl->getVariable('lg')->value['show_specialities'];?>
</th>
					</tr>
				</thead>
				<tbody>
				<?php if (!empty($_smarty_tpl->getVariable('manager',null,true,false)->value['employee']['language_pairs'])){?>
						<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('manager')->value['employee']['language_pairs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
							<tr>		
								<td>
									<input class="main_select" value="<?php echo $_smarty_tpl->tpl_vars['i']->value['employee_pair_id'];?>
" type="checkbox">
								</td>
								<td>
									<div class="original">
										<span class="cell_content">
											<?php echo $_smarty_tpl->tpl_vars['i']->value['menu_name'];?>

										</span>
									</div>
								</td>
								<td>
									<div class="original">
										<span class="cell_content"><?php echo $_smarty_tpl->tpl_vars['i']->value['when_learned'];?>
</span>
										<span class="in_text_element">
											<button class="button" onClick="openChangeInput(this)">...</button>
										</span>
									</div>
									<div class="changable hide"><input type="text" class="short" value="<?php echo $_smarty_tpl->tpl_vars['i']->value['when_learned'];?>
"><span class="in_text_element"><button class="button primary" onClick="changeCellValue(this, '<?php echo $_smarty_tpl->tpl_vars['i']->value['employee_pair_id'];?>
', 'when_learned', '/res/translations_manager.php', 'changeDateLearned')"><?php echo $_smarty_tpl->getVariable('lg')->value['done'];?>
</button>
											<button class="button primary" onClick="cancelUpdate(this)">
												✖
											</button></span></div>
								</td>
								<td>
									<?php if (!empty($_smarty_tpl->tpl_vars['i']->value['rate'])&&!empty($_smarty_tpl->tpl_vars['i']->value['currency'])){?>
										<div class="original"><span class="cell_content"><?php echo $_smarty_tpl->tpl_vars['i']->value['rate'];?>
</span><span> <?php echo $_smarty_tpl->tpl_vars['i']->value['currency'];?>
</span>
										<span class="in_text_element">
											<button class="button" onClick="openChangeInput(this)">...</button>
										</span>
										</div>
									<?php }else{ ?>
										<div class="original"><span class="cell_content">-</span>
										<span class="in_text_element">
											<button class="button" onClick="openChangeInput(this)">...</button>
										</span></div>
									<?php }?>
									<div class="changable hide">
										<input type="text" class="short" value="<?php echo $_smarty_tpl->tpl_vars['i']->value['rate'];?>
">
										<span class="in_text_element">
											<button class="button primary" onClick="changeCellValue(this, '<?php echo $_smarty_tpl->tpl_vars['i']->value['employee_pair_id'];?>
', 'rate', '/res/translations_manager.php', 'changePairRate')"><?php echo $_smarty_tpl->getVariable('lg')->value['done'];?>

											</button>
											<button class="button primary" onClick="cancelUpdate(this)">
												✖
											</button>
										</span>
									</div>
								</td>
								<td class="toggle_specialities noselect" onClick="hiddenRow(<?php echo $_smarty_tpl->tpl_vars['i']->value['employee_pair_id'];?>
, 'translator_pairs')"><?php echo $_smarty_tpl->getVariable('lg')->value['show_specialities'];?>
</td>
							</tr>
							<?php if (!empty($_smarty_tpl->getVariable('manager',null,true,false)->value['expertise_items'])){?>
								<tr class="hide to_toggle" toggle_id="<?php echo $_smarty_tpl->tpl_vars['i']->value['employee_pair_id'];?>
">
									<td class="employee_specialities" colspan="5">
										<table class="employee_specialities_table">
											<thead><tr><th><?php echo $_smarty_tpl->getVariable('lg')->value['speciality'];?>
</th><th><?php echo $_smarty_tpl->getVariable('lg')->value['add_remove'];?>
</th></tr></thead>
											<?php  $_smarty_tpl->tpl_vars['ii'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['keyy'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('manager')->value['expertise_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['ii']->key => $_smarty_tpl->tpl_vars['ii']->value){
 $_smarty_tpl->tpl_vars['keyy']->value = $_smarty_tpl->tpl_vars['ii']->key;
?>
												<tr class="employee_specialities_row">
													<td class="employee_specialities_cell">
														<?php echo $_smarty_tpl->tpl_vars['ii']->value['name'];?>

													</td>
													<td class="employee_specialities_cell">
														<input class="speciality" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['ii']->value['id'];?>
"
														<?php if (!empty($_smarty_tpl->tpl_vars['i']->value['pair_specialities'])){?><?php  $_smarty_tpl->tpl_vars['iii'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['keyyy'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['i']->value['pair_specialities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['iii']->key => $_smarty_tpl->tpl_vars['iii']->value){
 $_smarty_tpl->tpl_vars['keyyy']->value = $_smarty_tpl->tpl_vars['iii']->key;
?><?php if ($_smarty_tpl->tpl_vars['ii']->value['id']==$_smarty_tpl->tpl_vars['iii']->value['speciality_id']){?> checked<?php }?><?php }} ?><?php }?>>
													</td>
												</tr>
											<?php }} ?>
											<tr><td toggling="<?php echo $_smarty_tpl->tpl_vars['i']->value['employee_pair_id'];?>
" colspan="3" class="center"><span class="bloated primary submit button" onClick="changeSpecialities(<?php echo $_smarty_tpl->tpl_vars['i']->value['employee_pair_id'];?>
, 'translator_pairs')">SAVE</span><span class="hide done_text bloated"><?php echo $_smarty_tpl->getVariable('lg')->value['done'];?>
</span></td></tr>
										</table>
									</td>
								</tr>
							<?php }?>
						<?php }} ?>
					<?php }?>
					<tr>		
						<td colspan="5" class="center"><span class="bloated primary submit button" onClick="tableAction('translator_pairs', '/res/translations_manager.php', 'removeEmployeePairs');"><?php echo $_smarty_tpl->getVariable('lg')->value['remove'];?>
</span></td>
					</tr>
				</tbody>
			</table>
			<?php }?>
			<?php if (!empty($_smarty_tpl->getVariable('manager',null,true,false)->value['language_pairs'])){?>
				<h3 class="title" id="add_pairs_title"><?php echo $_smarty_tpl->getVariable('lg')->value['add_language_pairs'];?>
</h3>
				<div class="centered_form" id="add_pairs_form">
					<table id="add_pairs_table">
						<thead>
							<tr>
								<th>
									<?php echo $_smarty_tpl->getVariable('lg')->value['add'];?>

								</th>
								<th>
									<?php echo $_smarty_tpl->getVariable('lg')->value['language_pair'];?>

								</th>
								<th>
									<?php echo $_smarty_tpl->getVariable('lg')->value['known_since'];?>

								</th>
								<th>
									<?php echo $_smarty_tpl->getVariable('lg')->value['vacancy_rate'];?>

								</th>
							</tr>
						</thead>
						<tbody>
							<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('manager')->value['language_pairs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
								<tr>
									<td>
										<input type="checkbox" class="checkbox">
									</td>
									<td>
										<span value="<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
" class="name">
											<?php echo $_smarty_tpl->tpl_vars['i']->value['menu_name'];?>

										</span>
									</td>
									<td>
										<input class="date_input" type="text" name="date" placeholder="<?php echo $_smarty_tpl->getVariable('lg')->value['pikaday_date_format'];?>
">
									</td>
									<td>
										<input class="required price rate" name="vacancy_rate" type="text" placeholder="<?php echo $_smarty_tpl->getVariable('lg')->value['vacancy_rate'];?>
">
										<div class="currency_container">
											<div class="dropdown currency">
												<div class="select currency">
													<span class="text">
														<?php echo $_smarty_tpl->getVariable('currencies')->value[0];?>

													</span>
												<?php if (count($_smarty_tpl->getVariable('currencies')->value)>1){?>
													<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
												<?php }?>
												</div>
													<input type="hidden" name="currency" value="<?php echo $_smarty_tpl->getVariable('currencies')->value[0];?>
">
												<?php if (count($_smarty_tpl->getVariable('currencies')->value)>1){?>
													<div class="items">
														<div class="contents">
															<?php  $_smarty_tpl->tpl_vars['g'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('currencies')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['g']->key => $_smarty_tpl->tpl_vars['g']->value){
?>
																<span class="item" onclick="resetInputNoRel(this, 'currency', form_cv_data);"><?php echo $_smarty_tpl->tpl_vars['g']->value;?>
</span>
															<?php }} ?>
														</div>
													</div>
												<?php }?>
											</div>
										</div>
									</td>
								</tr>
							<?php }} ?>
						</tbody>
					</table>
					<input type="hidden" id="employee_id_input" value="<?php echo $_smarty_tpl->getVariable('manager')->value['employee']['id'];?>
">
					<div class="controls center">
						<span class="bloated primary submit button" id="add_pairs">
							<?php echo $_smarty_tpl->getVariable('lg')->value['done'];?>

						</span>
					</div>
				</div>
			<?php }?>
		<?php }elseif($_smarty_tpl->getVariable('manager')->value['translators']=="NEW"){?>
		<div id="create_employee_form" class="centered_form">
			<h3 class="title"><?php echo $_smarty_tpl->getVariable('lg')->value['add_employee'];?>
</h3>
			<div class="segment names">
				<div class="input_container">
					<input class="required" info_type="user" name="name" type="text" placeholder="<?php echo $_smarty_tpl->getVariable('lg')->value['first_name'];?>
*">
				</div>
				<div class="input_container">
					<input class="required" info_type="user" name="surname" type="text" placeholder="<?php echo $_smarty_tpl->getVariable('lg')->value['last_name'];?>
*">
				</div>
			</div>
			<div class="segment email">
				<input class="required" info_type="user" name="mail" type="email" placeholder="<?php echo $_smarty_tpl->getVariable('lg')->value['email'];?>
*">
			</div>
			<div class="segment phone">
				<span class="title">
					<?php echo $_smarty_tpl->getVariable('lg')->value['phone'];?>
*:
				</span>
				<input class="required" name="phone" type="phone" info_type="user_data">
			</div>
			<div class="segment prof">
				<span class="title">
					<?php echo $_smarty_tpl->getVariable('lg')->value['choose_vacancy'];?>
:
				</span>
				<div class="dropdown">
					<div class="select">
						<span class="text">
							<?php echo $_smarty_tpl->getVariable('lg')->value['translator_editor'];?>

						</span>
						<input class="required" name="position_id" id="position_id" type="hidden" info_type="user_data" value="0">
						<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
					</div>
					<div class="items">
						<div class="contents scrollable">
							<span class="item" onclick="set_position(this);" position="0"><?php echo $_smarty_tpl->getVariable('lg')->value['translator_editor'];?>
</span>
							<span class="item" onclick="set_position(this);" position="1"><?php echo $_smarty_tpl->getVariable('lg')->value['translator'];?>
</span>
							<span class="item" onclick="set_position(this);" position="2"><?php echo $_smarty_tpl->getVariable('lg')->value['editor'];?>
</span>
							<span class="item" onclick="set_position(this);" position="3"><?php echo $_smarty_tpl->getVariable('lg')->value['project_manager'];?>
</span>
						</div>
					</div>
				</div>
			</div>
			<div class="segment passwords" mode="b">
				<span class="title">
					<?php echo $_smarty_tpl->getVariable('lg')->value['password'];?>
*:
				</span>
				<input class="required" name="password" type="password" info_type="user">
				<span class="title">
					<?php echo $_smarty_tpl->getVariable('lg')->value['password_again'];?>
*:
				</span>
				<input class="required" name="password2" type="password" info_type="user">
			</div>
			<div class="controls center">
				<span class="bloated primary submit button" id="create_employee">
					<?php echo $_smarty_tpl->getVariable('lg')->value['send_application'];?>

				</span>
				<img class="loading hide" src="/css/images/loading.gif" >
				<span class="text hide" id="registration_done"><?php echo $_smarty_tpl->getVariable('lg')->value['registration_done'];?>
</span>
			</div>
		</div>
		<?php }elseif(is_array($_smarty_tpl->getVariable('manager')->value['translators'])){?>
			<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('manager')->value['translators']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
				<div><a href="<?php echo $_SERVER['REQUEST_URI'];?>
/<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['i']->value['surname'];?>
</a></div>
				<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable($_smarty_tpl->getVariable('count')->value+1, null, null);?>
			<?php }} ?>
		<?php }else{ ?>
			<div class="empty centered_text show"><h1><?php echo $_smarty_tpl->getVariable('lg')->value['no_info'];?>
</h1></div>
		<?php }?>
	<?php }else{ ?>
		<div class="empty centered_text show"><h1><?php echo $_smarty_tpl->getVariable('lg')->value['no_info'];?>
</h1></div>
	<?php }?>
</div>