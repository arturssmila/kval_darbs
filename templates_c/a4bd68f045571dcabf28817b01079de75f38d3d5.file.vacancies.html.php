<?php /* Smarty version Smarty-3.0.7, created on 2018-04-19 16:02:33
         compiled from ".\templates\./block/vacancies.html" */ ?>
<?php /*%%SmartyHeaderCode:126025ad8936962f9b1-66541546%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a4bd68f045571dcabf28817b01079de75f38d3d5' => 
    array (
      0 => '.\\templates\\./block/vacancies.html',
      1 => 1523341516,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '126025ad8936962f9b1-66541546',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="block big" id="vacancies_content">
	<h4 class="title">
		<?php echo $_smarty_tpl->getVariable('vacancy_holder')->value[0]['name'];?>

	</h4>
	<?php if (!empty($_smarty_tpl->getVariable('vacancy_holder',null,true,false)->value[0]['content'])){?>
	<div class="contents">
		<?php echo $_smarty_tpl->getVariable('vacancy_holder')->value[0]['content'];?>

	</div>
	<?php }?>
</div>