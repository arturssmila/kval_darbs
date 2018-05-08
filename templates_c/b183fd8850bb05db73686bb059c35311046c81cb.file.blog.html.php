<?php /* Smarty version Smarty-3.0.7, created on 2018-05-07 09:41:46
         compiled from ".\templates\blog.html" */ ?>
<?php /*%%SmartyHeaderCode:84165aeff52a6ae5a2-54568415%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b183fd8850bb05db73686bb059c35311046c81cb' => 
    array (
      0 => '.\\templates\\blog.html',
      1 => 1521709813,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '84165aeff52a6ae5a2-54568415',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="container">
	<div id="header_block">
		<h1 class="title">
			<?php echo $_smarty_tpl->getVariable('cat')->value[0]['name'];?>

		</h1>	
	</div>
</div>

<div class="gray_section separated">
	<div class="container">	
		<?php $_template = new Smarty_Internal_Template("blog_right_side.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
		<div class="left posts">
			<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('blogs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
				<div class="box post">
					<div class="contents">
						<h3 class="title">
							<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
">
								<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>

							</a>
						</h3>
						<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
" class="image" style="background-image:url('/images/meta/<?php echo $_smarty_tpl->tpl_vars['i']->value['image'];?>
')"></a>
						<div class="description">
							<?php echo $_smarty_tpl->tpl_vars['i']->value['teaser'];?>

							<a class="more" href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
"><?php echo $_smarty_tpl->getVariable('lg')->value['read_more'];?>
...</a>
						</div>
						<?php $_template = new Smarty_Internal_Template("post_stats.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('post_data',$_smarty_tpl->tpl_vars['i']->value); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
					</div>
				</div>
			<?php }} ?>
		</div>
	</div>
</div>