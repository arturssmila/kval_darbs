<?php /* Smarty version Smarty-3.0.7, created on 2018-04-20 17:30:43
         compiled from ".\templates\./logged_in/clients.html" */ ?>
<?php /*%%SmartyHeaderCode:37345ad9f993913b95-40670019%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '838ac2516a65159e48c433c96e5c3cbddb6c23a0' => 
    array (
      0 => '.\\templates\\./logged_in/clients.html',
      1 => 1524234641,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '37345ad9f993913b95-40670019',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('lg')->value['clients'];?>
</h1>
<div class="contents">
	<div class="table_header">
		<div class="cell small_cell"><?php echo $_smarty_tpl->getVariable('lg')->value['client_type'];?>
</div>
		<div class="cell"><?php echo $_smarty_tpl->getVariable('lg')->value['first_name'];?>
</div>
		<div class="cell"><?php echo $_smarty_tpl->getVariable('lg')->value['last_name'];?>
</div>
		<div class="cell"><?php echo $_smarty_tpl->getVariable('lg')->value['email'];?>
</div>
		<div class="cell"><?php echo $_smarty_tpl->getVariable('lg')->value['company'];?>
</div>
		<div class="cell"><?php echo $_smarty_tpl->getVariable('lg')->value['phone'];?>
</div>
		<div class="cell small_cell"><?php echo $_smarty_tpl->getVariable('lg')->value['confirmation'];?>
</div>
	</div>
	<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable(0, null, null);?>
	<?php if (!empty($_smarty_tpl->getVariable('manager',null,true,false)->value['clients'])){?>
		<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('manager')->value['clients']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
			<div class="row_table" person_id="<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
">
				<div class="visible_row">
					<div class="cell small_cell"><?php if ($_smarty_tpl->tpl_vars['i']->value['user_type']=="J"){?><?php echo $_smarty_tpl->getVariable('lg')->value['legal_person'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('lg')->value['individual'];?>
<?php }?></div>
					<div class="cell"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</div>
					<div class="cell"><?php echo $_smarty_tpl->tpl_vars['i']->value['surname'];?>
</div>
					<div class="cell"><?php echo $_smarty_tpl->tpl_vars['i']->value['mail'];?>
</div>
					<div class="cell"><?php if (!empty($_smarty_tpl->tpl_vars['i']->value['company'])){?><?php echo $_smarty_tpl->tpl_vars['i']->value['company'];?>
<?php }else{ ?>-<?php }?></div>
					<div class="cell"><?php echo $_smarty_tpl->tpl_vars['i']->value['phone'];?>
</div>
					<div class="cell small_cell controls">
						<button class="confirm" onClick=""><?php $_template = new Smarty_Internal_Template("./css/svg/check.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></button>
						<button class="confirm decline" onClick="">X</button>
					</div>
				</div>
				<div class="row show_more noselect" rel="<?php echo $_smarty_tpl->getVariable('count')->value;?>
"><span class="more show"><span class="inline_svg"><?php echo $_smarty_tpl->getVariable('lg')->value['see_more_info'];?>
</span><?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></span><span class="less"><span class="inline_svg"><?php echo $_smarty_tpl->getVariable('lg')->value['hide_info'];?>
</span><?php $_template = new Smarty_Internal_Template("./css/svg/up.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></span></div>
				<div class="hidden_row" rel="<?php echo $_smarty_tpl->getVariable('count')->value;?>
">
					<?php if ($_smarty_tpl->tpl_vars['i']->value['user_type']=="J"){?>
						<div class="cell"><?php echo $_smarty_tpl->getVariable('lg')->value['pvn_reg_nr'];?>
: <?php echo $_smarty_tpl->tpl_vars['i']->value['pvn_reg_nr'];?>
</div>
						<div class="cell"><?php echo $_smarty_tpl->getVariable('lg')->value['registration_nr'];?>
: <?php echo $_smarty_tpl->tpl_vars['i']->value['registration_nr'];?>
</div>
					<?php }else{ ?>
						<div class="item"><?php echo $_smarty_tpl->getVariable('lg')->value['personal_code'];?>
: <?php echo $_smarty_tpl->tpl_vars['i']->value['personal_code'];?>
</div>
					<?php }?>
				</div>
			</div>
			<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable($_smarty_tpl->getVariable('count')->value+1, null, null);?>
		<?php }} ?>
	<?php }?>
	<div class="empty centered_text<?php if ($_smarty_tpl->getVariable('count')->value==0){?> show<?php }?>"><h1><?php echo $_smarty_tpl->getVariable('lg')->value['no_info'];?>
</h1></div>
</div>