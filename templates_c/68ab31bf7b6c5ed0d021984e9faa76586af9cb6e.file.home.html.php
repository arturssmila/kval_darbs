<?php /* Smarty version Smarty-3.0.7, created on 2018-04-16 14:08:51
         compiled from ".\templates\home.html" */ ?>
<?php /*%%SmartyHeaderCode:143665ad484437bf8e2-69617532%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '68ab31bf7b6c5ed0d021984e9faa76586af9cb6e' => 
    array (
      0 => '.\\templates\\home.html',
      1 => 1523436698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '143665ad484437bf8e2-69617532',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("./block/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('inner',false); echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="guarantees_block">
	<div class="guarantees_cell noselect">
		<div class="container">
			<div class="title">
				<?php echo $_smarty_tpl->getVariable('lg')->value['secure_collaboration'];?>

			</div>
			<div class="contents">
				<div class="contents_line">
					<div class="item">
						<?php $_template = new Smarty_Internal_Template("./css/svg/badges/1.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
					</div>
					<div class="item">
						<?php $_template = new Smarty_Internal_Template("./css/svg/badges/2.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
					</div>
					<div class="item">
						<?php $_template = new Smarty_Internal_Template("./css/svg/badges/3.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="gray_section">
	<div class="container">
		<?php $_template = new Smarty_Internal_Template("./block/quote.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

		<div class="service_block">
			<h4 class="title">
				<?php echo $_smarty_tpl->getVariable('lg')->value['services'];?>

			</h4>	
			<span class="subtitle">
				<?php echo $_smarty_tpl->getVariable('lg')->value['services_teaser'];?>

			</span>

			<div class="card_block of_3">
			<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('serv_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
				<?php if ($_smarty_tpl->tpl_vars['i']->value['alias_id']!="expertise"){?>
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

		</div>

	</div> <!-- / .container -->
</div> <!-- / .gray_section -->

<?php $_template = new Smarty_Internal_Template("./block/bubbles.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('expertises',$_smarty_tpl->getVariable('expertise_items')->value); echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div class="gray_section">
	<div class="container">
		<h4 class="title">
			<?php echo $_smarty_tpl->getVariable('testimonials_page')->value[0]['name'];?>

		</h4>
		<span class="subtitle">
			<?php echo $_smarty_tpl->getVariable('testimonials_page')->value[0]['teaser'];?>

		</span>
		<div id="testimonials_block">
			<div class="contents">
				<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('testimonials')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
					<div class="item">
						<div class="description">
							<?php echo $_smarty_tpl->tpl_vars['i']->value['content'];?>

						</div>

						<div class="attributes">
							<span class="title">
								<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>

							</span>
							<span class="subtitle">
								<?php echo $_smarty_tpl->tpl_vars['i']->value['teaser'];?>

							</span>
						</div>
					</div>
				<?php }} ?>
				<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable(0, null, null);?>
				<?php  $_smarty_tpl->tpl_vars['ii'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('testimonials')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['ii']->key => $_smarty_tpl->tpl_vars['ii']->value){
?>
					<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable(($_smarty_tpl->getVariable('count')->value+1), null, null);?>
				<?php }} ?>
				<?php if ($_smarty_tpl->getVariable('count')->value>1){?>
					<div class="controls">
						<div class="item left"><?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
						<div class="item right"><?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
					</div>
				<?php }?>
			</div>
			<?php if (!empty($_smarty_tpl->getVariable('sponsors',null,true,false)->value)){?>
				<div id="sponsors_block">
					<div class="contents container">
						<div class="sponsors">
							<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable(0, null, null);?>
							<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('sponsors')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['i']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['i']->iteration=0;
if ($_smarty_tpl->tpl_vars['i']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['i']->iteration++;
 $_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['last'] = $_smarty_tpl->tpl_vars['i']->last;
?>
								<div class="item" style="background-image:url('/images/meta/<?php echo $_smarty_tpl->tpl_vars['i']->value['image'];?>
')"></div>
								<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable(($_smarty_tpl->getVariable('count')->value+1), null, null);?>
							<?php }} ?>
						</div>
					</div>

						<div class="title">
							<span id="more_sponsors" style="display: none;">
								<?php echo ((mb_detect_encoding($_smarty_tpl->getVariable('lg')->value['see_more'], 'UTF-8, ISO-8859-1') === 'UTF-8') ? mb_strtoupper($_smarty_tpl->getVariable('lg')->value['see_more'],SMARTY_RESOURCE_CHAR_SET) : strtoupper($_smarty_tpl->getVariable('lg')->value['see_more']));?>

							</span>
						</div>

				</div>
			<?php }?>
		</div>
	</div> <!-- / .container -->
</div> <!-- / .gray_section -->

