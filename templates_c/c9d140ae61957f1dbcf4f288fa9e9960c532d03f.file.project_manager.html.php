<?php /* Smarty version Smarty-3.0.7, created on 2018-04-27 17:17:32
         compiled from ".\templates\./logged_in/project_manager.html" */ ?>
<?php /*%%SmartyHeaderCode:320935ae330fca439f9-33642436%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c9d140ae61957f1dbcf4f288fa9e9960c532d03f' => 
    array (
      0 => '.\\templates\\./logged_in/project_manager.html',
      1 => 1524838648,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '320935ae330fca439f9-33642436',
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
</div>