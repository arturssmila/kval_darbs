<?php /* Smarty version Smarty-3.0.7, created on 2018-04-16 14:08:52
         compiled from ".\templates\./block/bubbles.html" */ ?>
<?php /*%%SmartyHeaderCode:8685ad48444b88500-99909378%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c1e7cce8e8e475872a67d28349e3a2d8232466f5' => 
    array (
      0 => '.\\templates\\./block/bubbles.html',
      1 => 1521727171,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8685ad48444b88500-99909378',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="bubble_block">
	<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('serv_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
		<?php if ($_smarty_tpl->tpl_vars['i']->value['alias_id']=="expertise"){?>
			<?php $_smarty_tpl->tpl_vars["real_deal"] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value, null, null);?>
			<?php break 1?>
		<?php }?>
	<?php }} ?>
	<div class="container">
		<h4 class="title">
			<?php echo $_smarty_tpl->getVariable('real_deal')->value['name'];?>

		</h4>
		<span class="subtitle">
			<?php echo $_smarty_tpl->getVariable('real_deal')->value['teaser'];?>

		</span>
	</div>

	<div class="contents container">
		<div class="section">
			<?php $_smarty_tpl->tpl_vars["items"] = new Smarty_variable($_smarty_tpl->getVariable('expertises')->value, null, null);?>

			<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['n'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['n']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
				<a class="item" href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
">
					<?php if (!empty($_smarty_tpl->tpl_vars['i']->value['image_thumb'])){?>
						<div class="icon"><?php $_template = new Smarty_Internal_Template("./images/meta/".($_smarty_tpl->tpl_vars['i']->value['image_thumb']), $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
					<?php }?>
					<span class="title">
						<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>

					</span>
				</a>
			<?php }} ?>
		</div> <!-- / .section -->
	</div> <!-- / .contents -->
</div> <!-- / #bubble_block -->