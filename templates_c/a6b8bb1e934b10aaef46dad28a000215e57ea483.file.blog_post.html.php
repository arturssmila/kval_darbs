<?php /* Smarty version Smarty-3.0.7, created on 2018-05-07 09:41:54
         compiled from ".\templates\blog_post.html" */ ?>
<?php /*%%SmartyHeaderCode:5995aeff532c6fd95-47997810%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6b8bb1e934b10aaef46dad28a000215e57ea483' => 
    array (
      0 => '.\\templates\\blog_post.html',
      1 => 1521723172,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5995aeff532c6fd95-47997810',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="gray_section separated">
	<div class="container">	
		<?php $_template = new Smarty_Internal_Template("blog_right_side.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
		<div class="left">
			<div class="box post">
				<div class="contents">
					<h3 class="title">
						<?php echo $_smarty_tpl->getVariable('cat')->value[0]['name'];?>

					</h3>

					<div class="image" style="background-image:url('/images/meta/<?php echo $_smarty_tpl->getVariable('cat')->value[0]['image_big'];?>
')"></div>

					<div class="description">
						<?php echo $_smarty_tpl->getVariable('cat')->value[0]['content'];?>

					</div>
						<?php $_template = new Smarty_Internal_Template("post_stats.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('post_data',$_smarty_tpl->getVariable('cat')->value[0]); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
				</div>
			</div>

			<div class="box comments">
				<div class="contents">
					<h3 class="title">
						<?php echo $_smarty_tpl->getVariable('lg')->value['comments'];?>

					</h3>

					<div class="authorize">
						<?php if (!empty($_smarty_tpl->getVariable('session',null,true,false)->value['user'])){?>
						<?php }else{ ?>
							<span class="title">
								<?php echo $_smarty_tpl->getVariable('lg')->value['authorize_to_comment'];?>
:
							</span>
							<div class="item">
								<?php $_template = new Smarty_Internal_Template("./css/svg/social/fb.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
							</div>
							<div class="item">
								<?php $_template = new Smarty_Internal_Template("./css/svg/social/tw.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
							</div>
							<a class="item" onclick="if(handle=window.open('https://accounts.google.com/o/oauth2/auth?state=%2Fprofile&amp;'+'redirect_uri=http://<?php echo $_SERVER['HTTP_HOST'];?>
/cms/libs/go.php&amp;'+'response_type=code&amp;'+'client_id=<?php echo $_smarty_tpl->getVariable('settings')->value['google_client_id'];?>
&amp;'+'approval_prompt=force&amp;'+'scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile','PRE' ,'width=800, height=500, left='+(screen.width?(screen.width-800)/2:0)+', top='+(screen.height?(screen.height-400)/2:0)+',scrollbars=no')){ handle.focus();return false; }">
								<?php $_template = new Smarty_Internal_Template("./css/svg/social/gp.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

							</a>
						<?php }?>
					</div>

					<div class="controls">
						<textarea id="comment" class="input"></textarea>
						<?php if (!empty($_smarty_tpl->getVariable('session',null,true,false)->value['user'])){?>
							<div class="text_right controls">
						<a class="bloated primary button" href="javascript:void(0)" id="add_comment" onclick="add_comment(<?php echo $_smarty_tpl->getVariable('session')->value['user']['id'];?>
,$('#comment').val(),<?php echo $_smarty_tpl->getVariable('cat')->value[0]['id'];?>
,'<?php echo $_smarty_tpl->getVariable('lang')->value;?>
');"><?php echo $_smarty_tpl->getVariable('lg')->value['to_comment'];?>
</a>
							</div>
						<?php }?>
					</div>

					<div class="data statlikecoms" rel="<?php echo $_smarty_tpl->getVariable('cat')->value[0]['id'];?>
">
					</div>

					<div class="testimonials comments_<?php echo $_smarty_tpl->getVariable('cat')->value[0]['id'];?>
" id="post_comments">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>