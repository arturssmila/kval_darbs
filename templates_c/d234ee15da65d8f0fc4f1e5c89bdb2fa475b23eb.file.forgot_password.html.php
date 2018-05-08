<?php /* Smarty version Smarty-3.0.7, created on 2018-04-20 11:16:47
         compiled from ".\templates\forgot_password.html" */ ?>
<?php /*%%SmartyHeaderCode:303285ad9a1efd088a3-93630737%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd234ee15da65d8f0fc4f1e5c89bdb2fa475b23eb' => 
    array (
      0 => '.\\templates\\forgot_password.html',
      1 => 1523609271,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '303285ad9a1efd088a3-93630737',
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
				<div id="forgot_password_form" class="centered_form">
					<div class="segment email">
						<span class="title">
							<?php echo $_smarty_tpl->getVariable('lg')->value['email'];?>
*:
						</span>
						<input class="required" name="email" type="email">
					</div>
					<div class="controls center">
						<span class="bloated primary submit button" id="forgot_password_button">
							<?php echo $_smarty_tpl->getVariable('lg')->value['done'];?>

						</span>
						<img class="loading hide" src="/css/images/loading.gif" >
						<span class="text hide" id="reset_code_sent"><?php echo $_smarty_tpl->getVariable('lg')->value['reset_code_sent'];?>
</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>