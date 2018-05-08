<?php /* Smarty version Smarty-3.0.7, created on 2018-04-19 16:02:33
         compiled from ".\templates\./block/language_pairs.html" */ ?>
<?php /*%%SmartyHeaderCode:54685ad893693914b2-44259618%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08973311e5695d4c0c89509fdc96c01c86fb1652' => 
    array (
      0 => '.\\templates\\./block/language_pairs.html',
      1 => 1521026910,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '54685ad893693914b2-44259618',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!empty($_smarty_tpl->getVariable('language_pairs_this',null,true,false)->value)||!empty($_smarty_tpl->getVariable('pair_array',null,true,false)->value)){?>
	<div id="language_pairs" class="noselect">
		<h4 class="title">
			<?php echo $_smarty_tpl->getVariable('lg')->value['lang_pairs'];?>

		</h4>

		<div class="contents">
			<?php if (!empty($_smarty_tpl->getVariable('language_pairs_this',null,true,false)->value)){?>
				<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('language_pairs_this')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
					<?php if (!empty($_smarty_tpl->tpl_vars['i']->value['long_link'])&&!empty($_smarty_tpl->tpl_vars['i']->value['name'])){?>
						<div class="lang_pair_div">
							<span class="pair_before">
								<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
							</span>
							<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</a>
						</div>
					<?php }?>
				<?php }} ?>
			<?php }?>
			<?php if (!empty($_smarty_tpl->getVariable('pair_array',null,true,false)->value)){?>
				<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pair_array')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
						<div class="lang_pair_div">
							<span class="pair_before">
								<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
							</span>
							<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</a>
						</div>
				<?php }} ?>
			<?php }?>
		</div> <!-- / .contents -->
	</div> <!-- / .quote_block -->
<?php }?>


