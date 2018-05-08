<?php /* Smarty version Smarty-3.0.7, created on 2018-05-07 09:41:47
         compiled from ".\templates\blog_right_side.html" */ ?>
<?php /*%%SmartyHeaderCode:285695aeff52b16b7b9-78309868%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c8744ff53ba77f8a58ec1d78bb8c427dd18a83c' => 
    array (
      0 => '.\\templates\\blog_right_side.html',
      1 => 1521724372,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '285695aeff52b16b7b9-78309868',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="right">
	<div class="box">
		<div class="contents">
			<h3 class="title first">Categories <div class="down show"><?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
			 			<div class="up"><?php $_template = new Smarty_Internal_Template("./css/svg/up.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div></h3>

			<ul>
				<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('blog_cat')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
					<li><a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</a></li>
				<?php }} ?>
			</ul>

			<h3 class="title second">Popular articles <div class="down show"><?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
			 			<div class="up"><?php $_template = new Smarty_Internal_Template("./css/svg/up.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div></h3>
			<div class="posts">
				<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('popular_posts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
					<div class="item post">
						<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
" class="image" style="background-image:url('/images/meta/<?php echo $_smarty_tpl->tpl_vars['i']->value['image'];?>
')"></a>
						<h4 class="title">
							<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
">
								<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>

							</a>
						</h4>
					</div>
				<?php }} ?>
			</div>
		</div>
	</div>
</div>