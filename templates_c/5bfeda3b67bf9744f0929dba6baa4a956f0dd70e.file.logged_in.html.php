<?php /* Smarty version Smarty-3.0.7, created on 2018-04-23 10:49:28
         compiled from ".\templates\logged_in.html" */ ?>
<?php /*%%SmartyHeaderCode:144975add9008d57c40-81867472%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5bfeda3b67bf9744f0929dba6baa4a956f0dd70e' => 
    array (
      0 => '.\\templates\\logged_in.html',
      1 => 1524468547,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '144975add9008d57c40-81867472',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="gray_section separated" id="manager">
	<div class="container">
		<div class="box">
			<div class="contents">
				<header class="header">
					<div class="contents">
						<span class="title">
							<?php echo $_smarty_tpl->getVariable('cat')->value[0]['name'];?>

						</span>
						<span class="subtitle">
							<?php echo $_smarty_tpl->getVariable('cat')->value[0]['teaser'];?>

						</span>
					</div>
				</header>
				<ul class="menu">
				<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['page'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('routes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['page']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
					<li <?php if ($_smarty_tpl->getVariable('manager')->value['route']['name']==$_smarty_tpl->tpl_vars['i']->value['name']){?>class="active"<?php }?>>
						<a class="item <?php if (!empty($_smarty_tpl->tpl_vars['i']->value['hidden'])){?>mobile tablet_vertical<?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['i']->value['url'];?>
">
							<?php echo $_smarty_tpl->tpl_vars['i']->value['lg'];?>

						</a>
						<?php if (!empty($_smarty_tpl->tpl_vars['i']->value['pending'])){?><span class="notification"><?php echo $_smarty_tpl->tpl_vars['i']->value['pending'];?>
</span><?php }?>
					</li>
				<?php }} ?>
				</ul>

				<div class="contents">
					<div class="container template" id="">
						<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('manager')->value['route']['file'], $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>