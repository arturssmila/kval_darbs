<?php /* Smarty version Smarty-3.0.7, created on 2018-04-16 15:27:08
         compiled from ".\templates\./block/vacancy_form.html" */ ?>
<?php /*%%SmartyHeaderCode:128565ad4969c607ab7-72294457%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e2019c4a2abe22f4d00b9dc395e46e9e8a160208' => 
    array (
      0 => '.\\templates\\./block/vacancy_form.html',
      1 => 1523369210,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '128565ad4969c607ab7-72294457',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<form id="apply_vacancy" class="centered_form">
	<div class="segment names">
		<div class="input_container">
			<input class="required" name="first_name" type="text" placeholder="<?php echo $_smarty_tpl->getVariable('lg')->value['first_name'];?>
*">
		</div>
		<div class="input_container">
			<input class="required" name="last_name" type="text" placeholder="<?php echo $_smarty_tpl->getVariable('lg')->value['last_name'];?>
*">
		</div>
	</div>
	<div class="segment email">
		<input class="required" name="email" type="email" placeholder="<?php echo $_smarty_tpl->getVariable('lg')->value['email'];?>
*">
	</div>
	<div class="segment prof">
		<span class="title">
			<?php echo $_smarty_tpl->getVariable('lg')->value['choose_vacancy'];?>
:
		</span>
		<div class="dropdown">
			<div class="select">
				<span class="text">
					<?php echo $_smarty_tpl->getVariable('vacancies')->value[0]['name'];?>

				</span>
				<input class="required" name="position_id" id="position_id_input" type="hidden" value="<?php echo $_smarty_tpl->getVariable('vacancies')->value[0]['id'];?>
">
				<input class="required" name="position_name" id="position_input" type="hidden" value="<?php echo $_smarty_tpl->getVariable('vacancies')->value[0]['name'];?>
">
				<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
			</div>
			<div class="items">
			<script type="text/javascript">
				<?php if (!empty($_smarty_tpl->getVariable('vacancies',null,true,false)->value[0]['editor_type_lang_select'])){?>
					var editor_start = true;
					var editor = true;
				<?php }else{ ?>
					var editor_start = false;
					var editor = false;
				<?php }?>
				var starting_vacancy = "<?php echo $_smarty_tpl->getVariable('vacancies')->value[0]['name'];?>
";
				var starting_vacancy_id = "<?php echo $_smarty_tpl->getVariable('vacancies')->value[0]['id'];?>
";

			</script>
				<div class="contents scrollable">
					<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('vacancies')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
						<span class="item" onclick="resetInputWithId(this,<?php if (!empty($_smarty_tpl->tpl_vars['i']->value['editor_type_lang_select'])){?>true<?php }else{ ?>false<?php }?>)" id="<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</span>
					<?php }} ?>
				</div>
			</div>
		</div>
	</div>
	<div class="segment langs">
		<span class="title">
			<?php echo $_smarty_tpl->getVariable('lg')->value['languages'];?>
*:
		</span>
		<div class="language_dropdown_group" rel="0">
			<div class="dropdowns">
				<div class="dropdown lang">
					<div class="select language_from" onclick="language_select($(this),'vacancies_modal', form_cv_data);">
						<span class="text">
							<?php echo $_smarty_tpl->getVariable('lg')->value['source_language'];?>

						</span>
						<input type="hidden" name="language_from">
						<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
					</div>
				</div>						

				<div class="dropdown lang">
					<div class="select language_to" onclick="language_select($(this),'vacancies_modal', form_cv_data);">
						<span class="text language_to_select">
							<?php echo $_smarty_tpl->getVariable('lg')->value['source_languages'];?>

						</span>
						<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
						<input type="hidden" name="language_to_1">
					</div>
				</div>
			</div>
			<span class="title">
				<?php echo $_smarty_tpl->getVariable('lg')->value['vacancy_rate'];?>
:
				<span class="regular"><?php echo $_smarty_tpl->getVariable('lg')->value['vacancy_rate_numbers'];?>
</span>
			</span>
			<div class="rate_block">
				<input class="required price" name="vacancy_rate" type="text" placeholder="<?php echo $_smarty_tpl->getVariable('lg')->value['vacancy_rate'];?>
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
			</div>
			<span class="close" onClick="closeRow(this, form_data);">✖</span>
		</div>
		<span class="more">
			+ <?php echo $_smarty_tpl->getVariable('lg')->value['more_vacancy_langs'];?>

		</span>
	</div>
	<div class="segment questions">
		<script type="text/javascript">
			var min_character_count = <?php echo $_smarty_tpl->getVariable('settings')->value['vacancy_min_characters'];?>
;
			var max_character_count = <?php echo $_smarty_tpl->getVariable('settings')->value['vacancy_max_characters'];?>
;
		</script>
		<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('vacancy_questions')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
			<div class="question <?php if ($_smarty_tpl->tpl_vars['i']->value['parent_id']!=$_smarty_tpl->getVariable('vacancies')->value[0]['id']){?>hide<?php }?>">
				<span class="title"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
*</span>
				<textarea class="required" v_id="<?php echo $_smarty_tpl->tpl_vars['i']->value['parent_id'];?>
" q_id="<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"></textarea>
				<span class="notifier">
					<?php echo $_smarty_tpl->getVariable('lg')->value['min_symbols'];?>
: <?php echo $_smarty_tpl->getVariable('settings')->value['vacancy_min_characters'];?>
</span>; <span class="notifier"> 
					<?php echo $_smarty_tpl->getVariable('lg')->value['max_symbols'];?>
: <?php echo $_smarty_tpl->getVariable('settings')->value['vacancy_max_characters'];?>

				</span>
			</div>
		<?php }} ?>
	</div>
	<div class="segment upload">
		<span class="title">
			<?php echo $_smarty_tpl->getVariable('lg')->value['upload_cv'];?>
*
		</span>
		<div class="bloated simple primary button" id="vacancy_cv" rel="0" onClick="callFileUploadModal(this, 'vacancies_modal')"><?php echo $_smarty_tpl->getVariable('lg')->value['upload'];?>
</div>
	</div>
	<div class="controls center">
		<span class="bloated primary submit button" id="send_application">
			<?php echo $_smarty_tpl->getVariable('lg')->value['send_application'];?>

		</span>
	</div>
</form>