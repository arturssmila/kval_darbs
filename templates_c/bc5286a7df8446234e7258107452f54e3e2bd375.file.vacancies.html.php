<?php /* Smarty version Smarty-3.0.7, created on 2018-04-16 15:27:08
         compiled from ".\templates\vacancies.html" */ ?>
<?php /*%%SmartyHeaderCode:242195ad4969c4d6fb7-45989503%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc5286a7df8446234e7258107452f54e3e2bd375' => 
    array (
      0 => '.\\templates\\vacancies.html',
      1 => 1523272630,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '242195ad4969c4d6fb7-45989503',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<div class="gray_section separated">
	<div class="container">	
		<div class="box">
			<h4 class="title">
				<?php echo $_smarty_tpl->getVariable('vacancy_holder')->value[0]['name'];?>

			</h4>
	<?php if (!empty($_smarty_tpl->getVariable('vacancy_holder',null,true,false)->value[0]['content'])){?>
			<div class="contents">
				<?php echo $_smarty_tpl->getVariable('vacancy_holder')->value[0]['content'];?>

			</div>
	<?php }?>
			<h4 class="title">
				<?php echo $_smarty_tpl->getVariable('lg')->value['vaccancy_apply'];?>

			</h4>
			<?php $_template = new Smarty_Internal_Template("./block/vacancy_form.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
		</div>
	</div>
</div>