<?php /* Smarty version Smarty-3.0.7, created on 2018-04-25 17:20:22
         compiled from ".\templates\footer.html" */ ?>
<?php /*%%SmartyHeaderCode:197215ae08ea654e167-39294056%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36fdcddaa6f76169305dbd364d2a7382286637a6' => 
    array (
      0 => '.\\templates\\footer.html',
      1 => 1524666014,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197215ae08ea654e167-39294056',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
	<footer id="footer">
		<div class="container">
			<div class="row attributes">
				<div class="item logo">
					<?php $_template = new Smarty_Internal_Template("./css/svg/logo_footer.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
				</div>
				<div class="item description">
					<div class="contents">
						<?php echo $_smarty_tpl->getVariable('lg')->value['footer_text'];?>

					</div>
				</div>
				<div class="item info">
					<div class="contents">
						<div class="item">
							<strong><?php echo $_smarty_tpl->getVariable('lg')->value['email'];?>
:</strong>
							<?php echo $_smarty_tpl->getVariable('settings')->value['email'];?>

						</div>
						<div class="item">
							<strong><?php echo $_smarty_tpl->getVariable('lg')->value['phone_short'];?>
:</strong>
							<?php echo $_smarty_tpl->getVariable('settings')->value['phone'];?>

						</div>
						<?php if (!empty($_smarty_tpl->getVariable('settings',null,true,false)->value['facebook_link'])||!empty($_smarty_tpl->getVariable('settings',null,true,false)->value['twitter_link'])){?>
							<div class="item">
								<strong><?php echo $_smarty_tpl->getVariable('lg')->value['social_media'];?>
:</strong>

								<div class="social">
									<?php if (!empty($_smarty_tpl->getVariable('settings',null,true,false)->value['facebook_link'])){?>
										<a href="<?php echo $_smarty_tpl->getVariable('settings')->value['facebook_link'];?>
" class="item fb">
											<?php $_template = new Smarty_Internal_Template("./css/svg/social/fb.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
										</a>
									<?php }?>
									<?php if (!empty($_smarty_tpl->getVariable('settings',null,true,false)->value['twitter_link'])){?>
										<a href="<?php echo $_smarty_tpl->getVariable('settings')->value['twitter_link'];?>
" class="item tw">
											<?php $_template = new Smarty_Internal_Template("./css/svg/social/tw.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
										</a>
									<?php }?>
								</div>
							</div>
						<?php }?>
					</div>
				</div>
				<div class="item pay">
					<span class="title">
						<?php echo $_smarty_tpl->getVariable('lg')->value['how_to_pay'];?>

					</span>
					<div class="contents">
						<div class="item"><?php $_template = new Smarty_Internal_Template("./css/svg/pay/visa.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
						<div class="item"><?php $_template = new Smarty_Internal_Template("./css/svg/pay/master.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
						<div class="item"><?php $_template = new Smarty_Internal_Template("./css/svg/pay/paypal.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
					</div>
				</div>
			</div>

			<div class="row contents middle">
			<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('langs_all')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
				<?php if (!empty($_smarty_tpl->tpl_vars['i']->value['shown_in_footer'])){?>
					<div class="section languages">
						<h4 class="title">
							<a style="cursor: default;"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</a>
				 			<div class="down show"><?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
				 			<div class="up"><?php $_template = new Smarty_Internal_Template("./css/svg/up.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
						</h4>

						<div class="contents footer_dropdown">
							<?php  $_smarty_tpl->tpl_vars['g'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lang_gr')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['g']->key => $_smarty_tpl->tpl_vars['g']->value){
?>
								<div class="section">
									<span class="title">
										<?php echo $_smarty_tpl->tpl_vars['g']->value['name'];?>

							 			<div class="down show"><?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
							 			<div class="up"><?php $_template = new Smarty_Internal_Template("./css/svg/up.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
									</span>
									<div class="contents footer_dropdown">
										<?php  $_smarty_tpl->tpl_vars['ii'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lang_items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['ii']->key => $_smarty_tpl->tpl_vars['ii']->value){
?>
											<?php if ($_smarty_tpl->tpl_vars['g']->value['id']==$_smarty_tpl->tpl_vars['ii']->value['parent_id']){?>
												<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['ii']->value['long_link'];?>
" class="item">
													<i class="icon" style="background-image:url('/cms/css/flags/<?php echo $_smarty_tpl->tpl_vars['ii']->value['lang_iso_code'];?>
.svg')"></i>
													<?php echo $_smarty_tpl->tpl_vars['ii']->value['name'];?>

												</a>	
											<?php }?>
										<?php }} ?>	
									</div>
								</div>
							<?php }} ?>	
						</div>
					</div>
				<?php }?>
			<?php }} ?>
			<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('serv_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
				<?php if (!empty($_smarty_tpl->tpl_vars['i']->value['shown_in_footer'])){?>
					<div class="section">
						<h4 class="title">
							<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</a>
				 			<div class="down show"><?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
				 			<div class="up"><?php $_template = new Smarty_Internal_Template("./css/svg/up.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
						</h4>

						<?php if ($_smarty_tpl->tpl_vars['i']->value['alias_id']=="langs"){?>
						<?php }else{ ?>
							<ul class="footer_dropdown">
								<?php  $_smarty_tpl->tpl_vars['ii'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('services')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['ii']->key => $_smarty_tpl->tpl_vars['ii']->value){
?>
									<?php if ($_smarty_tpl->tpl_vars['ii']->value['parent_id']==$_smarty_tpl->tpl_vars['i']->value['id']){?>
										<li>
											<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['ii']->value['long_link'];?>
" class="item">
												<?php echo $_smarty_tpl->tpl_vars['ii']->value['name'];?>

											</a>
										</li>
									<?php }?>
								<?php }} ?>
							</ul>
						<?php }?>
					</div>
				<?php }?>
			<?php }} ?>
			</div>

			<div class="row sub">
				<?php echo $_smarty_tpl->getVariable('lg')->value['copyright'];?>

				<?php if (!empty($_smarty_tpl->getVariable('menu_x',null,true,false)->value)){?>
					<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menu_x')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
						<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
" class="item">
							| <?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>

						</a>
					<?php }} ?>
				<?php }?>
			</div>
		</div>
	</footer>
	<?php if (!empty($_smarty_tpl->getVariable('reset_user',null,true,false)->value)){?>
		<?php $_template = new Smarty_Internal_Template("reset_password.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
	<?php }?>

	<?php echo $_smarty_tpl->getVariable('settings')->value['anal_code'];?>

	<script type="text/javascript" src="/cms/js/jquery.js"></script>	
	<script type="text/javascript" src="/cms/js/jquery_transform.js"></script>	
	<script type="text/javascript" src="/cms/js/scripts.js?<?php echo $_smarty_tpl->getVariable('cms_js_date')->value;?>
"></script>	
	<script type="text/javascript" src="/js/libs/modal.js"></script>
	<script type="text/javascript" src="/js/libs/lunr.min.js"></script>
	<script type="text/javascript" src="/js/libs/moment.js"></script>
	<script type="text/javascript" src="/js/libs/pikaday/pikaday.js"></script>
	<script>
	    var picker = new Pikaday({ 
	    	field: document.getElementById('date'), 
	    	format: 'YYYY.MM.DD', 
	    	showDaysInNextAndPreviousMonths: true,
	    	minDate: new Date(),
			i18n: {
			    previousMonth: 'Previous Month',
			    nextMonth: 'Next Month',
			    months: [<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 12+1 - (1) : 1-(12)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?> '<?php echo get_arh_name($_smarty_tpl->tpl_vars['i']->value);?>
', <?php }} ?>],
			    weekdays: [<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 7+1 - (1) : 1-(7)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?> '<?php echo get_week_days($_smarty_tpl->tpl_vars['i']->value,"L");?>
', <?php }} ?>],
			    weekdaysShort: [<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 7+1 - (1) : 1-(7)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?> '<?php echo get_week_days($_smarty_tpl->tpl_vars['i']->value,"S");?>
', <?php }} ?>]
			}
	    });
	</script>
	<script type="text/javascript" src="/js/common.js?<?php echo $_smarty_tpl->getVariable('js_date')->value;?>
"></script>
	<script type="text/javascript" src="/js/scripts.js?<?php echo $_smarty_tpl->getVariable('js_date')->value;?>
"></script>
	<?php if ((($_smarty_tpl->getVariable('cat')->value[0]['template']=="vacancies")||(!empty($_smarty_tpl->getVariable('vacancies',null,true,false)->value)))){?>
		<script type="text/javascript" src="/js/vacancy.js?<?php echo $_smarty_tpl->getVariable('js_date')->value;?>
"></script>
	<?php }?>
	<?php if ($_smarty_tpl->getVariable('cat')->value[0]['template']=="register"){?>
		<script type="text/javascript" src="/js/register.js?<?php echo $_smarty_tpl->getVariable('js_date')->value;?>
"></script>
	<?php }?>
	<?php if ($_smarty_tpl->getVariable('cat')->value[0]['template']=="forgot_password"){?>
		<script type="text/javascript" src="/js/forgot_password.js?<?php echo $_smarty_tpl->getVariable('js_date')->value;?>
"></script>
	<?php }?>
	<?php if ($_smarty_tpl->getVariable('cat')->value[0]['template']=="logged_in"){?>
		<script type="text/javascript" src="/js/translation_manager.js?<?php echo $_smarty_tpl->getVariable('js_date')->value;?>
"></script>
	<?php }?>
	<?php if (!empty($_smarty_tpl->getVariable('manager',null,true,false)->value['user']['admin'])){?>
		<?php if (($_smarty_tpl->getVariable('cat')->value[0]['template']=="logged_in")&&($_smarty_tpl->getVariable('manager')->value['user']['admin']=="1")){?>
			<script type="text/javascript" src="/js/manager_admin.js?<?php echo $_smarty_tpl->getVariable('js_date')->value;?>
"></script>
		<?php }?>
	<?php }?>
	<?php if (!empty($_smarty_tpl->getVariable('reset_user',null,true,false)->value)){?>
		<script type="text/javascript" src="/js/reset_password.js?<?php echo $_smarty_tpl->getVariable('js_date')->value;?>
"></script>
	<?php }?>
</body>
</html>

					
