<?php /* Smarty version Smarty-3.0.7, created on 2018-04-19 16:02:32
         compiled from ".\templates\service_list.html" */ ?>
<?php /*%%SmartyHeaderCode:164305ad89368f417b5-02542272%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99b8e0bba426a9a9a190d4e79feee168e1a8e92c' => 
    array (
      0 => '.\\templates\\service_list.html',
      1 => 1523430879,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '164305ad89368f417b5-02542272',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("./block/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div class="gray_section separated">
	<div class="container">
		<?php $_template = new Smarty_Internal_Template("./block/right_side.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
		<div class="left">
			<div class="box">
				<div class="contents">
					<h2 class="title"><?php echo $_smarty_tpl->getVariable('cat')->value[0]['name'];?>
</h2>
					<?php echo $_smarty_tpl->getVariable('cat')->value[0]['content'];?>


				</div>
			</div>
			<div class="card_block">
				<?php if ($_smarty_tpl->getVariable('cat')->value[0]['alias_id']=="expertise"){?>
					<?php $_smarty_tpl->tpl_vars['services'] = new Smarty_variable($_smarty_tpl->getVariable('expertise_items')->value, null, null);?>
				<?php }?>
				<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('services')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
					<?php if ($_smarty_tpl->tpl_vars['i']->value['parent_id']==$_smarty_tpl->getVariable('cat')->value[0]['id']){?>
						<a class="card" href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
">
							<?php if (!empty($_smarty_tpl->tpl_vars['i']->value['image_thumb'])){?>
								<?php if (((strtolower((substr($_smarty_tpl->tpl_vars['i']->value['image_thumb'],-4,4))))==".svg")){?>
									<div class="icon">
										<?php $_template = new Smarty_Internal_Template("../images/meta/".($_smarty_tpl->tpl_vars['i']->value['image_thumb']), $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
									</div>
								<?php }?>
							<?php }else{ ?>
								<div class="icon"><?php $_template = new Smarty_Internal_Template("./css/svg/service.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
							<?php }?>
							<span class="title">
								<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>

							</span>

							<p class="description">
								<?php echo $_smarty_tpl->tpl_vars['i']->value['teaser'];?>
				
							</p>
						</a>
					<?php }?>
				<?php }} ?>
			</div>
			<?php if (!empty($_smarty_tpl->getVariable('vacancy_holder',null,true,false)->value)){?>
				<div class="box">
					<div class="contents">
						<?php $_template = new Smarty_Internal_Template("./block/vacancies.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
						<?php if (!empty($_smarty_tpl->getVariable('vacancies',null,true,false)->value)){?>
							<div class="centered_text">
								<span class="button primary bloated" onClick="toggleVacancyForm($(this));">
									<?php echo $_smarty_tpl->getVariable('lg')->value['vaccancy_apply'];?>

								</span>
							</div>
						<?php }?>
					</div>
				</div>
				<?php if (!empty($_smarty_tpl->getVariable('vacancies',null,true,false)->value)){?>
					<div class="box" id="toggle_vacancy_form">
						<div class="contents">
							<h2 class="title"><?php echo $_smarty_tpl->getVariable('lg')->value['vaccancy_apply'];?>
</h2>
							<?php $_template = new Smarty_Internal_Template("./block/vacancy_form.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
						</div>
					</div>
				<?php }?>
			<?php }?>
		</div>
	</div>
</div>