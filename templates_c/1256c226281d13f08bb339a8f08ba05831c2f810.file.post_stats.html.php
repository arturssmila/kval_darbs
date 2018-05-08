<?php /* Smarty version Smarty-3.0.7, created on 2018-05-07 09:41:47
         compiled from ".\templates\post_stats.html" */ ?>
<?php /*%%SmartyHeaderCode:210865aeff52bba7cc5-96737933%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1256c226281d13f08bb339a8f08ba05831c2f810' => 
    array (
      0 => '.\\templates\\post_stats.html',
      1 => 1523356674,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '210865aeff52bba7cc5-96737933',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<div class="attributes statlikecoms" rel="<?php echo $_smarty_tpl->getVariable('post_data')->value['id'];?>
">
	<div class="item"><?php $_template = new Smarty_Internal_Template("./css/svg/news/date.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?><?php echo intval((substr($_smarty_tpl->getVariable('post_data')->value['date'],8,2)));?>
.<?php echo (substr($_smarty_tpl->getVariable('post_data')->value['date'],5,2));?>
.<?php echo (substr($_smarty_tpl->getVariable('post_data')->value['date'],0,4));?>
</div>
	<div class="item views stat"><?php $_template = new Smarty_Internal_Template("./css/svg/news/views.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?> <span>0</span></div>
	<div class="item social">
		<?php $_template = new Smarty_Internal_Template("./css/svg/news/share.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
		<div class="share_block">			
			<a
				class="share_button facebook"
				target="_blank"
				href="https://www.facebook.com/sharer/sharer.php?u=http://<?php echo $_SERVER['HTTP_HOST'];?>
<?php echo $_smarty_tpl->getVariable('slang')->value;?>
<?php echo $_smarty_tpl->getVariable('post_data')->value['long_link'];?>
<?php if ((!empty($_smarty_tpl->getVariable('post_data',null,true,false)->value['images'][0]['image_big'])||!empty($_smarty_tpl->getVariable('post_data',null,true,false)->value['images'][0]['image_small']))){?>&picture=http://<?php echo $_SERVER['HTTP_HOST'];?>
/images/galleries/<?php if (!empty($_smarty_tpl->getVariable('post_data',null,true,false)->value['images'][0]['image_big'])){?><?php echo $_smarty_tpl->getVariable('post_data')->value['images'][0]['image_big'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('post_data')->value['images'][0]['image_small'];?>
<?php }?><?php }?>">
				<?php $_template = new Smarty_Internal_Template("../css/svg/social/fb.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
			</a>		
			<a
				class="share_button twitter"
				target="_blank"
				href="https://twitter.com/intent/tweet?url=http://<?php echo $_SERVER['HTTP_HOST'];?>
<?php echo $_smarty_tpl->getVariable('slang')->value;?>
/<?php echo $_smarty_tpl->getVariable('post_data')->value['long_link'];?>
">
				<?php $_template = new Smarty_Internal_Template("../css/svg/social/tw.svg", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
			</a>
		</div>
	</div>
</div>