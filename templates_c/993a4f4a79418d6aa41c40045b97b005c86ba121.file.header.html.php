<?php /* Smarty version Smarty-3.0.7, created on 2018-04-20 14:01:12
         compiled from ".\templates\header.html" */ ?>
<?php /*%%SmartyHeaderCode:39655ad9c8787a1ba4-58822913%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '993a4f4a79418d6aa41c40045b97b005c86ba121' => 
    array (
      0 => '.\\templates\\header.html',
      1 => 1524222070,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '39655ad9c8787a1ba4-58822913',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Language" content="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width" />
	<link rel="icon" type="image/ico" href="/css/images/favicon.ico" />
	<title><?php if (!empty($_smarty_tpl->getVariable('cat',null,true,false)->value[0]['meta_title'])){?><?php echo $_smarty_tpl->getVariable('cat')->value[0]['meta_title'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('lg')->value['site_name'];?>
<?php }?></title>
	<meta name="description" content="<?php echo $_smarty_tpl->getVariable('cat')->value[0]['meta_description'];?>
" /> 
	<meta name="keywords" content="<?php echo $_smarty_tpl->getVariable('cat')->value[0]['meta_keywords'];?>
" />

	<link href="/css/vendor/normalize.css" rel="stylesheet" type="text/css" />
	
	<link href="/css/style.css?<?php echo $_smarty_tpl->getVariable('css_date')->value;?>
" rel="stylesheet" type="text/css" />

	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
	<link rel="image_src" href="<?php if (!empty($_smarty_tpl->getVariable('cat',null,true,false)->value[0]['image_big'])){?>/images/meta/<?php echo $_smarty_tpl->getVariable('cat')->value[0]['image_big'];?>
<?php }else{ ?>/css/images/logo.png<?php }?>" /> 
		
	<script type="text/javascript">
		var search_hide = <?php echo json_encode((explode(",",$_smarty_tpl->getVariable('settings')->value['search_hide_templates'])));?>
;
		var lang = '<?php echo $_smarty_tpl->getVariable('lang')->value;?>
';
		var gallery = {};
	</script>
	<script type="text/javascript"> lg = new Array();<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lg')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['i']->key;
?>lg["<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"]= "<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
";<?php }} ?> </script>
	<script type="text/javascript"> var js_extensions = "<?php echo $_smarty_tpl->getVariable('settings')->value["accepted_formats_js"];?>
";
	var accepted_formats = "<?php echo $_smarty_tpl->getVariable('settings')->value["accepted_formats"];?>
"; </script>
	<script src='https://www.google.com/recaptcha/api.js?hl=<?php echo $_smarty_tpl->getVariable('lang')->value;?>
'></script>
</head>

<body id="<?php echo strtolower($_smarty_tpl->getVariable('cat')->value[0]['template']);?>
" class="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
 <?php if ($_smarty_tpl->getVariable('cat')->value[0]['template']=="home"){?>landing<?php }else{ ?>inner<?php }?> page">

	<header id="header">

		<div class="bar">
			<div class="container contents">
				<div class="attributes left">
					<span class="item">
						<?php $_template = new Smarty_Internal_Template("./css/svg/phone.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
						<?php echo $_smarty_tpl->getVariable('settings')->value['phone'];?>

					</span>
					<span class="item">
						<?php $_template = new Smarty_Internal_Template("./css/svg/mail.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
						<?php echo $_smarty_tpl->getVariable('settings')->value['email'];?>

					</span>
				</div>

				<div class="search">
					<input class="input" placeholder="<?php echo $_smarty_tpl->getVariable('lg')->value['search_for'];?>
 ...">
					<span class="button">
						<?php $_template = new Smarty_Internal_Template("./css/svg/search.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
					</span>
					<div class="search_dropdown">
						<span class="item">
							<strong>...</strong> ...
						</span>
					</div>
				</div>

				<div class="attributes right">
					<span class="item is_dropdown first">
							<a><?php echo $_smarty_tpl->getVariable('lg')->value['company'];?>

						 	<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?> </a>
						<div class="menu_dropdown simple">
							<div class="contents">
								<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menu')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
									<?php if (!empty($_smarty_tpl->tpl_vars['i']->value['shown_in_dropdown'])&&!empty($_smarty_tpl->tpl_vars['i']->value['in_company_dropdown'])){?>
										<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
" class="item"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</a>
									<?php }?>
								<?php }} ?>
							</div>
						</div>        
					</span>
					<?php if ($_smarty_tpl->getVariable('lang_count')->value>1){?>
					<span class="item languages_link is_dropdown">
						<a href="javascript:void(0)" class="languages choose">
							<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('languages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
								<?php if ((!empty($_smarty_tpl->tpl_vars['i']->value['active']))){?>
									<?php if (($_smarty_tpl->tpl_vars['i']->value['iso']==$_smarty_tpl->getVariable('lang')->value)){?>
										<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>

										<i class="icon" style="background-image:url('/cms/css/flags/<?php echo $_smarty_tpl->tpl_vars['i']->value['iso'];?>
.svg')"></i>
										<?php break 1?>
									<?php }?>
								<?php }?>
							<?php }} ?>
							<?php if ($_smarty_tpl->getVariable('lang_count')->value>1){?>
					 			<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>  
							<?php }?> 
						</a>      
						<div class="menu_dropdown languages choose simple">
							<div class="group">
								<div class="contents">
									<?php  $_smarty_tpl->tpl_vars['g'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('languages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['g']->key => $_smarty_tpl->tpl_vars['g']->value){
?>
										<?php if ((!empty($_smarty_tpl->tpl_vars['g']->value['active']))){?>
											<?php if (($_smarty_tpl->tpl_vars['g']->value['iso']!=$_smarty_tpl->getVariable('lang')->value)){?>
												<a href="/<?php echo $_smarty_tpl->tpl_vars['g']->value['iso'];?>
<?php echo $_smarty_tpl->getVariable('langbar')->value[$_smarty_tpl->tpl_vars['g']->value['id']];?>
" class="item">
													<?php echo $_smarty_tpl->tpl_vars['g']->value['name'];?>

													<i class="icon" style="background-image:url('/cms/css/flags/<?php echo $_smarty_tpl->tpl_vars['g']->value['iso'];?>
.svg')"></i>
												</a>
											<?php }?>
										<?php }?>
									<?php }} ?>
								</div>
							</div>
						</div>
					</span>
						<span class="item tablet_company">
						<a href="javascript:void(0)" class="languages choose">
							<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('languages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
								<?php if ((!empty($_smarty_tpl->tpl_vars['i']->value['active']))){?>
									<?php if (($_smarty_tpl->tpl_vars['i']->value['iso']==$_smarty_tpl->getVariable('lang')->value)){?>
										<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>

										<i class="icon" style="background-image:url('/cms/css/flags/<?php echo $_smarty_tpl->tpl_vars['i']->value['iso'];?>
.svg')"></i>
										<?php break 1?>
									<?php }?>
								<?php }?>
							<?php }} ?>
						</a>      
					</span>
						<div class="menu_dropdown choose simple">
							<div class="group">
								<div class="contents">
									<?php  $_smarty_tpl->tpl_vars['g'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('languages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['g']->key => $_smarty_tpl->tpl_vars['g']->value){
?>
										<?php if ((!empty($_smarty_tpl->tpl_vars['g']->value['active']))){?>
											<?php if (($_smarty_tpl->tpl_vars['g']->value['iso']!=$_smarty_tpl->getVariable('lang')->value)){?>
												<a href="/<?php echo $_smarty_tpl->tpl_vars['g']->value['iso'];?>
<?php echo $_smarty_tpl->getVariable('langbar')->value[$_smarty_tpl->tpl_vars['g']->value['id']];?>
" class="item">
													<?php echo $_smarty_tpl->tpl_vars['g']->value['name'];?>

													<i class="icon" style="background-image:url('/cms/css/flags/<?php echo $_smarty_tpl->tpl_vars['g']->value['iso'];?>
.svg')"></i>
												</a>
											<?php }?>
										<?php }?>
									<?php }} ?>
								</div>
							</div>
						</div>
					<?php }?>
					<span class="item tablet_company">
					 	<?php $_template = new Smarty_Internal_Template("./css/images/small_menu.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>        
					</span>
					<div class="menu_dropdown simple">
						<div class="contents">
							<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menu')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
								<?php if (!empty($_smarty_tpl->tpl_vars['i']->value['shown_in_dropdown'])&&!empty($_smarty_tpl->tpl_vars['i']->value['in_company_dropdown'])){?>
									<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
" class="item"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</a>
								<?php }?>
							<?php }} ?>
						</div>
					</div>
					<div class="item logging simple">
						<?php if (!empty($_smarty_tpl->getVariable('session',null,true,false)->value['user'])){?>
							<a href="/logout.php" class="item icon primary logout button">
								<?php $_template = new Smarty_Internal_Template("./css/svg/lock.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?><?php echo $_smarty_tpl->getVariable('lg')->value['logout'];?>

							</a>
						<?php }else{ ?>
							<?php echo $_smarty_tpl->getVariable('lg')->value['login'];?>

							<?php $_template = new Smarty_Internal_Template("./css/svg/lock.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
						<?php }?>
					</div>
					<?php if (empty($_smarty_tpl->getVariable('session',null,true,false)->value['user'])){?>
						<div id="log_in">
							<div class="form"  id="modal_login_form">
								<label>
									<?php echo $_smarty_tpl->getVariable('lg')->value['email'];?>

								</label>
								<div class="input">
									<div class="icon">
									</div>
									<input class="contents" type="text" name="mail" data-is-required="true">
								</div>

								<label>
									<?php echo $_smarty_tpl->getVariable('lg')->value['password'];?>

								</label>
								<div class="input">
									<div class="icon">
									</div>
									<input class="contents" type="password" name="password" data-is-required="true">
								</div>

								<div class="controls">
									<span class="button submit primary" id="login_button">
										<?php echo $_smarty_tpl->getVariable('lg')->value['log_in'];?>

									</span>
									<?php if (!empty($_smarty_tpl->getVariable('registration',null,true,false)->value)&&!empty($_smarty_tpl->getVariable('forgot_password',null,true,false)->value)){?>
										<div class="contents">
											<a class="item register" href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->getVariable('registration')->value[0]['long_link'];?>
">
												<?php echo $_smarty_tpl->getVariable('registration')->value[0]['name'];?>

											</a>

											<a class="item forgot" href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->getVariable('forgot_password')->value[0]['long_link'];?>
">
												<?php echo $_smarty_tpl->getVariable('forgot_password')->value[0]['name'];?>

											</a>						
										</div>
									<?php }?>
								</div>
							</div>
						</div>
					<?php }?>
				</div>
			</div>
		</div>

		<div class="container">
			<a id="logo" href="http://<?php echo $_SERVER['SERVER_NAME'];?>
/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
"><?php $_template = new Smarty_Internal_Template("./css/svg/logo.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></a>
			<div class="tablet_attributes">
				<div class="tablet_search">
					<div class="search">
						<input class="input" placeholder="<?php echo $_smarty_tpl->getVariable('lg')->value['search_for'];?>
 ...">
						<span>
							<?php $_template = new Smarty_Internal_Template("./css/svg/search.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
						</span>
						<div class="search_dropdown">
							<span class="item">
								<strong>...</strong> ...
							</span>
						</div>
					</div>
					<span class="tab_search_but show"><?php $_template = new Smarty_Internal_Template("./css/svg/search.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></sapn></div>
				<span class="burger"><?php $_template = new Smarty_Internal_Template("./css/images/burger.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></span>
			</div>

			<div class="menu">
				<span class="item is_dropdown">
					<span class="item_with_svg"><a style="cursor: default"><?php echo ((mb_detect_encoding($_smarty_tpl->getVariable('lg')->value['world_languages'], 'UTF-8, ISO-8859-1') === 'UTF-8') ? mb_strtoupper($_smarty_tpl->getVariable('lg')->value['world_languages'],SMARTY_RESOURCE_CHAR_SET) : strtoupper($_smarty_tpl->getVariable('lg')->value['world_languages']));?>
</a>
				 	<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></span>
				<div class="menu_dropdown languages">
					<div class="contents">
						<?php $_smarty_tpl->tpl_vars["lang_rel"] = new Smarty_variable(0, null, null);?>
						<?php $_smarty_tpl->tpl_vars["lang_gr_count"] = new Smarty_variable((count($_smarty_tpl->getVariable('lang_gr')->value)), null, null);?>
						<?php  $_smarty_tpl->tpl_vars['g'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lang_gr')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['g']->key => $_smarty_tpl->tpl_vars['g']->value){
?>
							<div class="group" lang_rel="<?php echo $_smarty_tpl->getVariable('lang_rel')->value;?>
">
								<strong class="title"><?php echo $_smarty_tpl->tpl_vars['g']->value['name'];?>
</strong>
								<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable(0, null, null);?>
								<?php $_smarty_tpl->tpl_vars["count_in_group"] = new Smarty_variable(0, null, null);?>
								<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lang_items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
									<?php if ($_smarty_tpl->tpl_vars['i']->value['parent_id']==$_smarty_tpl->tpl_vars['g']->value['id']){?>
										<?php $_smarty_tpl->tpl_vars["count_in_group"] = new Smarty_variable($_smarty_tpl->getVariable('count_in_group')->value+1, null, null);?>
									<?php }?>
								<?php }} ?>
								<div class="lang_group_dropdown <?php if ($_smarty_tpl->getVariable('count_in_group')->value<3){?>small<?php }?>" lang_rel="<?php echo $_smarty_tpl->getVariable('lang_rel')->value;?>
">
									<?php if ($_smarty_tpl->getVariable('count_in_group')->value<3){?>
										<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lang_items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
											<?php if ($_smarty_tpl->tpl_vars['i']->value['parent_id']==$_smarty_tpl->tpl_vars['g']->value['id']){?>
												<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
" class="item">
													<i class="icon" style="background-image:url('/cms/css/flags/<?php echo $_smarty_tpl->tpl_vars['i']->value['lang_iso_code'];?>
.svg')"></i>
													<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>

												</a>
												<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable($_smarty_tpl->getVariable('count')->value+1, null, null);?>
											<?php }?>
										<?php }} ?>
									<?php }else{ ?>
										<?php $_smarty_tpl->tpl_vars["in_column"] = new Smarty_variable((ceil(($_smarty_tpl->getVariable('count_in_group')->value/4))), null, null);?>
										<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable(0, null, null);?>
										<?php if ($_smarty_tpl->getVariable('in_column')->value==0){?>
											<?php $_smarty_tpl->tpl_vars['in_column'] = new Smarty_variable(1, null, null);?>
										<?php }?>
										<div class="lang_column normal">
										<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lang_items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
											<?php if ($_smarty_tpl->tpl_vars['i']->value['parent_id']==$_smarty_tpl->tpl_vars['g']->value['id']){?>
												<?php if ($_smarty_tpl->getVariable('count')->value!=0){?>
													<?php if (((($_smarty_tpl->getVariable('count')->value%$_smarty_tpl->getVariable('in_column')->value)==0)&&$_smarty_tpl->getVariable('count')->value!=0)){?>
														</div>
													<?php }?>
													<?php if ((($_smarty_tpl->getVariable('count')->value%$_smarty_tpl->getVariable('in_column')->value)==0)){?>
														<div class="lang_column normal">
													<?php }?>
												<?php }?>
												<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
" class="item">
													<i class="icon" style="background-image:url('/cms/css/flags/<?php echo $_smarty_tpl->tpl_vars['i']->value['lang_iso_code'];?>
.svg')"></i>
													<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>

												</a>
												<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable($_smarty_tpl->getVariable('count')->value+1, null, null);?>
											<?php }?>
										<?php }} ?>
										</div>
									<?php }?>
								</div>
							</div>
							<?php $_smarty_tpl->tpl_vars["lang_rel"] = new Smarty_variable($_smarty_tpl->getVariable('lang_rel')->value+1, null, null);?>
						<?php }} ?>
					</div>
				</div>
				</span>
				<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('serv_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
					<?php if (!empty($_smarty_tpl->tpl_vars['i']->value['shown_in_menu'])){?>
						<span class="item is_dropdown">
							 <span class="item_with_svg"><a <?php if ($_smarty_tpl->tpl_vars['i']->value['alias_id']!="expertise"){?> href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
" <?php }?>><?php echo ((mb_detect_encoding($_smarty_tpl->tpl_vars['i']->value['name'], 'UTF-8, ISO-8859-1') === 'UTF-8') ? mb_strtoupper($_smarty_tpl->tpl_vars['i']->value['name'],SMARTY_RESOURCE_CHAR_SET) : strtoupper($_smarty_tpl->tpl_vars['i']->value['name']));?>
</a>
							 <?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></span>

						<div class="menu_dropdown">
							<div class="contents">
								<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable(0, null, null);?>
								<?php if ($_smarty_tpl->tpl_vars['i']->value['alias_id']=="expertise"){?>
									<?php $_smarty_tpl->tpl_vars["cycle_data"] = new Smarty_variable($_smarty_tpl->getVariable('expertise_items')->value, null, null);?>
								<?php }else{ ?>
									<?php $_smarty_tpl->tpl_vars["cycle_data"] = new Smarty_variable($_smarty_tpl->getVariable('services')->value, null, null);?>
								<?php }?>
								<ul>
									<?php  $_smarty_tpl->tpl_vars['ii'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['n'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cycle_data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['ii']->key => $_smarty_tpl->tpl_vars['ii']->value){
 $_smarty_tpl->tpl_vars['n']->value = $_smarty_tpl->tpl_vars['ii']->key;
?>
										<?php if ($_smarty_tpl->tpl_vars['i']->value['id']==$_smarty_tpl->tpl_vars['ii']->value['parent_id']){?>
											<li class="group">
												<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['ii']->value['long_link'];?>
" class="title"><?php echo $_smarty_tpl->tpl_vars['ii']->value['name'];?>
</a>
											</li>
											<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable(($_smarty_tpl->getVariable('count')->value+1), null, null);?>
										<?php }?>
									<?php }} ?>
								</ul>
							</div>
						</div>
						</span>
					<?php }?>
				<?php }} ?>
			</div>
		</div>
		<div class="tablet_menu">
			<span class="tablet_dropdown">
				<a class="noselect"><?php echo ((mb_detect_encoding($_smarty_tpl->getVariable('lg')->value['world_languages'], 'UTF-8, ISO-8859-1') === 'UTF-8') ? mb_strtoupper($_smarty_tpl->getVariable('lg')->value['world_languages'],SMARTY_RESOURCE_CHAR_SET) : strtoupper($_smarty_tpl->getVariable('lg')->value['world_languages']));?>
</a>
			 	<div class="down show"><?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
			 	<div class="up"><?php $_template = new Smarty_Internal_Template("./css/svg/up.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
			</span>
			<div class="tablet_dropdown_contents languages">
				<div class="contents">
					<?php  $_smarty_tpl->tpl_vars['g'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lang_gr')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['g']->key => $_smarty_tpl->tpl_vars['g']->value){
?>
						<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable(0, null, null);?>
						<div class="group" lang_rel="<?php echo $_smarty_tpl->getVariable('lang_rel')->value;?>
">
							<span class="tablet_dropdown"><strong class="title"><?php echo $_smarty_tpl->tpl_vars['g']->value['name'];?>
</strong>
			 	<div class="down show"><?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
			 	<div class="up"><?php $_template = new Smarty_Internal_Template("./css/svg/up.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div></span>
			 		<div class="tablet_dropdown_contents">
							<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable(0, null, null);?>
									<?php $_smarty_tpl->tpl_vars["count_in_group"] = new Smarty_variable(0, null, null);?>
									<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lang_items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
										<?php if ($_smarty_tpl->tpl_vars['i']->value['parent_id']==$_smarty_tpl->tpl_vars['g']->value['id']){?>
											<?php $_smarty_tpl->tpl_vars["count_in_group"] = new Smarty_variable($_smarty_tpl->getVariable('count_in_group')->value+1, null, null);?>
										<?php }?>
									<?php }} ?>
									<?php if ($_smarty_tpl->getVariable('count_in_group')->value>5){?>
										<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lang_items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
											<?php if ($_smarty_tpl->tpl_vars['i']->value['parent_id']==$_smarty_tpl->tpl_vars['g']->value['id']&&!empty($_smarty_tpl->tpl_vars['i']->value['already_shown'])){?>
												<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
" class="item">
													<i class="icon" style="background-image:url('/cms/css/flags/<?php echo $_smarty_tpl->tpl_vars['i']->value['lang_iso_code'];?>
.svg')"></i>
													<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>

												</a>
												<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable($_smarty_tpl->getVariable('count')->value+1, null, null);?>
											<?php }?>
										<?php }} ?>
										<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable(0, null, null);?>
										<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lang_items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
											<?php if ($_smarty_tpl->tpl_vars['i']->value['parent_id']==$_smarty_tpl->tpl_vars['g']->value['id']&&empty($_smarty_tpl->tpl_vars['i']->value['already_shown'])){?>
												<?php if ($_smarty_tpl->getVariable('count')->value==0){?>
													<div class="item see_more noselect" lang_rel="<?php echo $_smarty_tpl->getVariable('lang_rel')->value;?>
">					<?php echo $_smarty_tpl->getVariable('lg')->value['see_more'];?>

													</div>
												<?php }?>
												<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
" class="item more">
													<i class="icon" style="background-image:url('/cms/css/flags/<?php echo $_smarty_tpl->tpl_vars['i']->value['lang_iso_code'];?>
.svg')"></i>
													<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>

												</a>
												<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable($_smarty_tpl->getVariable('count')->value+1, null, null);?>
											<?php }?>
										<?php }} ?>
									<?php }else{ ?>
										<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lang_items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
											<?php if ($_smarty_tpl->tpl_vars['i']->value['parent_id']==$_smarty_tpl->tpl_vars['g']->value['id']){?>
												<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
" class="item">
													<i class="icon" style="background-image:url('/cms/css/flags/<?php echo $_smarty_tpl->tpl_vars['i']->value['lang_iso_code'];?>
.svg')"></i>
													<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>

												</a>
											<?php }?>
										<?php }} ?>
									<?php }?>
						</div>
						</div>
						<?php $_smarty_tpl->tpl_vars["lang_rel"] = new Smarty_variable($_smarty_tpl->getVariable('lang_rel')->value+1, null, null);?>
					<?php }} ?>
				</div>
			</div>
			<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('serv_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
				<?php if (!empty($_smarty_tpl->tpl_vars['i']->value['shown_in_menu'])){?>
					<span class="tablet_dropdown">
						 <a <?php if ($_smarty_tpl->tpl_vars['i']->value['alias_id']!="expertise"){?> href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value['long_link'];?>
" <?php }?> class="noselect"><?php echo ((mb_detect_encoding($_smarty_tpl->tpl_vars['i']->value['name'], 'UTF-8, ISO-8859-1') === 'UTF-8') ? mb_strtoupper($_smarty_tpl->tpl_vars['i']->value['name'],SMARTY_RESOURCE_CHAR_SET) : strtoupper($_smarty_tpl->tpl_vars['i']->value['name']));?>
</a>
			 			<div class="down show"><?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
			 			<div class="up"><?php $_template = new Smarty_Internal_Template("./css/svg/up.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?></div>
					</span>

					<div class="tablet_dropdown_contents">
						<div class="contents">
							<?php if ($_smarty_tpl->tpl_vars['i']->value['alias_id']=="expertise"){?>
								<?php $_smarty_tpl->tpl_vars["cycle_data"] = new Smarty_variable($_smarty_tpl->getVariable('expertise_items')->value, null, null);?>
							<?php }else{ ?>
								<?php $_smarty_tpl->tpl_vars["cycle_data"] = new Smarty_variable($_smarty_tpl->getVariable('services')->value, null, null);?>
							<?php }?>
							<?php  $_smarty_tpl->tpl_vars['ii'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['n'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cycle_data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['ii']->key => $_smarty_tpl->tpl_vars['ii']->value){
 $_smarty_tpl->tpl_vars['n']->value = $_smarty_tpl->tpl_vars['ii']->key;
?>
								<?php if ($_smarty_tpl->tpl_vars['i']->value['id']==$_smarty_tpl->tpl_vars['ii']->value['parent_id']){?>
									<div class="group">
										<strong>
											<a href="<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->tpl_vars['ii']->value['long_link'];?>
" class="title"><?php echo ((mb_detect_encoding($_smarty_tpl->tpl_vars['ii']->value['name'], 'UTF-8, ISO-8859-1') === 'UTF-8') ? mb_strtoupper($_smarty_tpl->tpl_vars['ii']->value['name'],SMARTY_RESOURCE_CHAR_SET) : strtoupper($_smarty_tpl->tpl_vars['ii']->value['name']));?>
</a>
										</strong>
									</div>
								<?php }?>
							<?php }} ?>
						</div>
					</div>
				<?php }?>
			<?php }} ?>
		</div>
	</header>
	<div id="page_question_form_modal">
		<div id="page_question_form">
			<div class="title">
				<i class="icon">
					<?php $_template = new Smarty_Internal_Template("./css/svg/mail.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
				</i>
				<span class="text">
					<?php echo $_smarty_tpl->getVariable('lg')->value['ask_a_question'];?>

				</span>
			</div>

			<form class="contents">
				<div id="name" class="contact_form_line_div required">
					<label>
						<?php echo $_smarty_tpl->getVariable('lg')->value['name'];?>
:
					</label>
					<input type="text" name="name" data-is-required="true">
				</div>
				<div id="email" class="contact_form_line_div required">
					<label>
						<?php echo $_smarty_tpl->getVariable('lg')->value['email'];?>
:
					</label>
					<input type="email" name="email" data-is="email">
				</div>

				<div id="your_question" class="contact_form_line_div required">
					<label>
						<?php echo $_smarty_tpl->getVariable('lg')->value['question'];?>
:
					</label>
					<textarea></textarea>
				</div>

				<div class="controls">
					<span class="simple bloated primary submit button">
						<?php echo $_smarty_tpl->getVariable('lg')->value['send'];?>

					</span>
				</div>
			</form>
		</div>
	</div>
	<div class="modal" id="file_upload_modal">
		<div class="modal_cell">
			<div class="modal_center_block">
				<div class="modal_center">
					<div class="close">✖</div>
					<div id="file_upload_modal_center">
						<div class="title"><?php echo ((mb_detect_encoding($_smarty_tpl->getVariable('lg')->value['quote_two'], 'UTF-8, ISO-8859-1') === 'UTF-8') ? mb_strtoupper($_smarty_tpl->getVariable('lg')->value['quote_two'],SMARTY_RESOURCE_CHAR_SET) : strtoupper($_smarty_tpl->getVariable('lg')->value['quote_two']));?>
</div>
						<div class="contents">
							<span class="subtitle"><?php echo $_smarty_tpl->getVariable('lg')->value['add_files'];?>
</span>
							<div class="teaser"><?php echo $_smarty_tpl->getVariable('lg')->value['acceptable_formats'];?>
 <?php echo $_smarty_tpl->getVariable('settings')->value['accepted_formats'];?>
.</div>
							<div class="size_warning"><?php echo $_smarty_tpl->getVariable('lg')->value['file_size_limit'];?>
</div>
							<div class="box file_upload">
								<form class="box__input" enctype="multipart/form-data">
									<?php $_template = new Smarty_Internal_Template("./css/svg/inbox.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
									<div class="loading"></div>
								    <label class="file_label" for="file" style="display: none">
									    <input class="box__file" mode="" id="modal_file_input" type="file" name="file" id="file" multiple>
									    <div class="file_label_content"></div>
									</label>
								    <div class="captcha_warning"><?php echo $_smarty_tpl->getVariable('lg')->value['captcha_warning'];?>
</div>
									<div class="g-recaptcha" data-sitekey="6LdPXUwUAAAAALdakwEfry6veX7CzKiSIF78sAwz" data-callback="enableBtn"
									data-expired-callback="enableBtn"></div>
								</form>
								<div class="box__uploading">Uploading&hellip;</div>
								<div class="box__success">
								</div>
								<div class="box__error">Error! <span></span>.</div>
							</div>
							<div id="modal_files_list">
								
							</div>
							<div class="done_container">
								<div class="close bloated primary button"><?php echo $_smarty_tpl->getVariable('lg')->value['done'];?>
</div>
							</div>
						</div>
					</div>
					<div id="language_select_modal">
						<div class="title"><?php echo ((mb_detect_encoding($_smarty_tpl->getVariable('lg')->value['select_languages'], 'UTF-8, ISO-8859-1') === 'UTF-8') ? mb_strtoupper($_smarty_tpl->getVariable('lg')->value['select_languages'],SMARTY_RESOURCE_CHAR_SET) : strtoupper($_smarty_tpl->getVariable('lg')->value['select_languages']));?>
</div>
						<div class="selected_languages"></div>
						<div class="contents">
							<div class="columns">
								<ul>
									<li class="select_item other">
										<input value="other" class="multi_select_languages other" type="checkbox" onclick="multi_select_langs($(this), 'vacancies_modal');"><span><input id="other_language" class="" tips="other" placeholder="<?php echo $_smarty_tpl->getVariable('lg')->value['other_lang'];?>
"></span></li>
									<?php  $_smarty_tpl->tpl_vars['g'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lang_gr')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['g']->key => $_smarty_tpl->tpl_vars['g']->value){
?>
										<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lang_items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
											<?php if ($_smarty_tpl->tpl_vars['i']->value['parent_id']==$_smarty_tpl->tpl_vars['g']->value['id']){?>
												<li class="select_item">
												<input value="<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
" class="multi_select_languages" type="checkbox"><span><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</span></li>
											<?php }?>
										<?php }} ?>
									<?php }} ?>
								</ul>
							</div>
						</div>
						<div class="done_container">
							<div class="close bloated primary button"><?php echo $_smarty_tpl->getVariable('lg')->value['done'];?>
</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>