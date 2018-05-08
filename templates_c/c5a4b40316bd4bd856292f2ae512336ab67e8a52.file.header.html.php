<?php /* Smarty version Smarty-3.0.7, created on 2018-04-16 14:08:51
         compiled from ".\templates\./block/header.html" */ ?>
<?php /*%%SmartyHeaderCode:145915ad48443c824e3-04053137%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c5a4b40316bd4bd856292f2ae512336ab67e8a52' => 
    array (
      0 => '.\\templates\\./block/header.html',
      1 => 1523003773,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145915ad48443c824e3-04053137',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="container noselect">
	<div id="header_block">
		<h1 class="title">
			<?php echo $_smarty_tpl->getVariable('cat')->value[0]['name'];?>

		</h1>	

		<?php if (!empty($_smarty_tpl->getVariable('cat',null,true,false)->value[0]['teaser'])){?>
		<h2 class="subtitle">
			<?php echo $_smarty_tpl->getVariable('cat')->value[0]['teaser'];?>

		</h2>
		<?php }?>

		<?php if (!isset($_smarty_tpl->getVariable('inner',null,true,false)->value)){?>
			<?php $_smarty_tpl->tpl_vars['inner'] = new Smarty_variable(true, null, null);?>
		<?php }?>

		<?php if ($_smarty_tpl->getVariable('inner')->value==false){?>
		<div class="contents">
			<?php echo $_smarty_tpl->getVariable('cat')->value[0]['content'];?>

		</div>
		<?php }?>

		<div class="controls">
			<span class="button primary bloated get_quote">
				<?php echo $_smarty_tpl->getVariable('lg')->value['get_quote'];?>

			</span>
			<span class="button bloated" id="ask_button">
				<?php echo $_smarty_tpl->getVariable('lg')->value['ask_question'];?>

			</span>
		</div>

		<div class="icon"><?php $_template = new Smarty_Internal_Template("./css/svg/scroll.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
	</div>
</div>
