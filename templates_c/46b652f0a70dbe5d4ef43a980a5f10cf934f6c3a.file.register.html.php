<?php /* Smarty version Smarty-3.0.7, created on 2018-04-20 10:11:47
         compiled from ".\templates\register.html" */ ?>
<?php /*%%SmartyHeaderCode:7035ad992b36fa8a7-13563846%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46b652f0a70dbe5d4ef43a980a5f10cf934f6c3a' => 
    array (
      0 => '.\\templates\\register.html',
      1 => 1523605890,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7035ad992b36fa8a7-13563846',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="gray_section separated">
	<div class="container">
		<div class="box">
			<div class="contents">
				<h1 class="title">
					<?php echo $_smarty_tpl->getVariable('cat')->value[0]['name'];?>

				</h1>
				<div class="contents">
					<?php echo $_smarty_tpl->getVariable('cat')->value[0]['content'];?>

				</div>
				<div id="registration_form" class="centered_form">
					<div class="segment" mode="b">
						<span class="title">
							<?php echo $_smarty_tpl->getVariable('lg')->value['client_type'];?>
*:
						</span>
						<div class="dropdown">
							<div class="select">
								<span class="text">
									<?php echo $_smarty_tpl->getVariable('lg')->value['legal_person'];?>

								</span>
								<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
							</div>
							<input class="required" name="user_type" type="hidden" info_type="user" value="j">
							<div class="items">
								<div class="contents scrollable">
										<span class="item" onClick="changeUserType(this, 'j', 'j');"><?php echo $_smarty_tpl->getVariable('lg')->value['legal_person'];?>
</span>
										<span class="item" onClick="changeUserType(this, 'f', 'f');"><?php echo $_smarty_tpl->getVariable('lg')->value['individual'];?>
</span>
								</div>
							</div>
						</div>
					</div>
					<div class="segment company" mode="j">
						<span class="title">
							<?php echo $_smarty_tpl->getVariable('lg')->value['company'];?>
*:
						</span>
						<input class="required" name="company" type="company" info_type="user_data">
					</div>
					<div class="segment countries" mode="j">
						<span class="title">
							<?php echo $_smarty_tpl->getVariable('lg')->value['country'];?>
*:
						</span>
						<div class="dropdown">
							<div class="select">
								<span class="text">
									<?php echo $_smarty_tpl->getVariable('lg')->value['country'];?>
*:
								</span>
								<?php $_template = new Smarty_Internal_Template("./css/svg/down.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
							</div>
							<input class="required" name="country" type="hidden" info_type="user_data">
							<div class="items">
								<div class="contents scrollable">
									<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('country_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
										<span class="item" onClick="resetInputDropdown(this, <?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
);"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</span>
									<?php }} ?>
								</div>
							</div>
						</div>
					</div>
					<div class="segment names" mode="b">
						<div class="input_container">
							<span class="title">
								<?php echo $_smarty_tpl->getVariable('lg')->value['first_name'];?>
*:
							</span>
							<input class="required" name="name" type="text" info_type="user">
						</div>
						<div class="input_container">
							<span class="title">
								<?php echo $_smarty_tpl->getVariable('lg')->value['last_name'];?>
*:
							</span>
							<input class="required" name="surname" type="text" info_type="user">
						</div>
					</div>
					<div class="segment email" mode="b">
						<span class="title">
							<?php echo $_smarty_tpl->getVariable('lg')->value['email'];?>
*:
						</span>
						<input class="required" name="mail" type="email" info_type="user">
					</div>
					<div class="segment personal_code hide" mode="f">
						<span class="title">
							<?php echo $_smarty_tpl->getVariable('lg')->value['personal_code'];?>
*:
						</span>
						<input class="" name="personal_code" type="personal_code" info_type="user_data">
					</div>
					<div class="segment registration_nr" mode="j">
						<span class="title">
							<?php echo $_smarty_tpl->getVariable('lg')->value['registration_nr'];?>
*:
						</span>
						<input class="required" name="registration_nr" type="registration_nr" info_type="user_data">
					</div>
					<div class="segment pvn_reg_nr" mode="j">
						<span class="title">
							<?php echo $_smarty_tpl->getVariable('lg')->value['pvn_reg_nr'];?>
*:
						</span>
						<input class="required" name="pvn_reg_nr" type="pvn_reg_nr" info_type="user_data">
					</div>
					<div class="segment phone" mode="b">
						<span class="title">
							<?php echo $_smarty_tpl->getVariable('lg')->value['phone'];?>
*:
						</span>
						<input class="required" name="phone" type="phone" info_type="user_data">
					</div>
					<div class="segment passwords" mode="b">
						<span class="title">
							<?php echo $_smarty_tpl->getVariable('lg')->value['password'];?>
*:
						</span>
						<input class="required" name="password" type="password" info_type="user">
						<span class="title">
							<?php echo $_smarty_tpl->getVariable('lg')->value['password_again'];?>
*:
						</span>
						<input class="required" name="password2" type="password" info_type="user">
						<input name="active" type="hidden" info_type="user">
						<input class="required" name="link" type="hidden" value="http://<?php echo $_SERVER['SERVER_NAME'];?>
/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php echo $_smarty_tpl->getVariable('cat')->value[0]['long_link'];?>
">
					</div>
					<div class="controls center">
						<span class="bloated primary submit button" id="signup_button">
							<?php echo $_smarty_tpl->getVariable('lg')->value['signup'];?>

						</span>
						<img class="loading hide" src="/css/images/loading.gif" >
						<span class="text hide" id="registration_done"><?php echo $_smarty_tpl->getVariable('lg')->value['registration_done'];?>
</span>
					</div>
					<script type="text/javascript">
						var sender_email = "<?php echo $_smarty_tpl->getVariable('settings')->value['form_mail'];?>
";
					</script>
				</div>
			</div>
		</div>
	</div>
</div>