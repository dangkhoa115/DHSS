<?php

Module::invoke_event('ONLOAD',System::$false,System::$false);
global $blocks;
global $plugins;
$plugins = array (
);
$blocks = array (
  72127 => 
  array (
    'id' => '72127',
    'module_id' => '5953',
    'page_id' => '10278',
    'container_id' => '0',
    'region' => 'center',
    'position' => '11',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => '',
    'settings' => 
    array (
      '5953_cache' => '<div class="frontend-sign-in-default"><?php if(User::is_login()){?><div class="sign-in-bound">
	<div class="sign-in-content-bound">
		<div class="sign-in-error"><?php echo Form::error_messages();?></div>	
		<div class="sign-in-content">
			<table cellpadding="5" cellspacing="0" width="100%">
				<tr>
					<td class="sign-in-welcome"><?php echo Portal::language(\'welcome\');?> : <a target="_blank" href="<?php echo URL::build(\'personal\',\'\',REWRITE);?>"><b style="color:#009EE7;"><?php echo Session::get(\'user_id\')?></b></a></td>
				</tr>
				<?php if(Session::is_set(\'hotel_id\') or Session::is_set(\'agent_id\')){?>
				<tr>
					<td class="sign-in-welcome"><a target="_blank" href="<?php echo URL::build(\'panel\');?>"><?php echo Portal::language(\'control_panel\');?></a><td width="5%"/>
				</tr>
				<?php } elseif(User::is_login()){?>
				<tr>
					<td class="sign-in-welcome"><a target="_blank" href="<?php echo URL::build(\'user_booking_report\');?>"><?php echo Portal::language(\'booking_report\');?></a><td width="5%"/>
				</tr>
				<?php }?>
				<?php 
				if((User::can_view(MODULE_SETTING,ANY_CATEGORY)))
				{?>
				<tr>
					<td class="sign-in-welcome"><a target="_blank" href="<?php echo URL::build(\'user_admin\',\'\',REWRITE);?>"><?php echo Portal::language(\'manage_user\');?></a><td width="5%"/>
				</tr>
				<tr>
					<td class="sign-in-welcome"><a target="_blank" href="<?php echo URL::build(\'setting\',\'\',REWRITE);?>"><?php echo Portal::language(\'config_your_site\');?></a><td/>
				</tr>
				
				<?php
				}
				?>    
				<tr>
					<td class="sign-in-welcome"><a class="sign-in-link" href="<?php echo URL::build(\'sign_out\');?>&href=?<?php echo urlencode($_SERVER[\'QUERY_STRING\'])?>"><?php echo Portal::language(\'logout\');?></a></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<?php }else{ ?><form name="SignInForm" id="SignInForm" method="post">
<div class="sign-in-bound">
	<div class="sign-in-content-bound">
		<div class="sign-in-error"><?php echo Form::error_messages();?></div>	
		<div class="sign-in-content">		
			<table width="100%" border="0" cellspacing="0" cellpadding="5">
				<tr>
					<td class="sign-in-field" width="1%" nowrap="nowrap"><label for="user_id">Username or Email:</label></td>
				</tr>
				<tr>
					<td width="1%"><input name="user_id" type="text" id="user_id" style="width:150px;" tabindex="1" value="<?php if(isset($_COOKIE[\'forgot_user\'])){echo substr($_COOKIE[\'forgot_user\'],0,strpos($_COOKIE[\'forgot_user\'],\'_\'));}?>"/></td>
				</tr>
				<tr>
					<td class="sign-in-field" width="1%" nowrap="nowrap"><label for="password">Password : </label></td>
				</tr>
				<tr>
					<td  width="1%"><input name="password" type="password" id="password" tabindex="2" style="width:150px;" value="<?php if(isset($_COOKIE[\'forgot_user\'])){echo substr($_COOKIE[\'forgot_user\'],strpos($_COOKIE[\'forgot_user\'],\'_\')+1);}?>"/></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:left;"><input  name="save_password" id="save_password" value="1" / type ="checkbox" value="<?php echo String::html_normalize(URL::get(\'save_password\'));?>">
					<label for="save_password" style="margin-left:5px;">Remember me</label>
				</td>
				</tr>
				<tr>
					<td colspan="2" class="sign-in-button"><input type="submit" value=" Sign in " tabindex="3" /><a href="<?php echo Url::build(\'forgot_password\');?>" style="margin-left:21px;color:#FFFFFF;text-indent:130px;">Forgot password ?</a></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data[\'id\']:\'\';?>" />
			</form >
			
			
<script type="text/javascript">
jQuery(function(){
	jQuery(\'#user_id\').focus();
});
</script><?php }?></div>',
      '5953_layout_template' => 'packages/frontend/templates/SignIn/layouts/default',
      '5953_skin_template' => 'packages/frontend/templates/SignIn/skins/default',
      '5953_frame_template' => '',
      '5953_frame_skin_template' => '',
    ),
    'module' => 
    array (
      'id' => '5953',
      'name' => 'SignIn',
      'path' => 'packages/backend/modules/SignIn/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'package_id' => '332',
    ),
  ),
);
		Portal::$page = array (
  'id' => '10278',
  'package_id' => '331',
  'layout_id' => '0',
  'layout' => 'packages/frontend/layouts/sign_in.php',
  'skin' => 'default',
  'help_id' => '0',
  'name' => 'dang-nhap',
  'title_1' => 'Đăng nhập',
  'title_2' => NULL,
  'description_1' => '',
  'description_2' => '',
  'customer_id' => '0',
  'read_only' => '0',
  'show' => '1',
  'cachable' => '0',
  'cache_param' => '',
  'params' => '',
  'site_map_show' => '1',
  'type' => 'SYSTEM',
  'condition' => '',
  'is_use_sapi' => '0',
);
		foreach($blocks as $id=>$block)
		{
			if($block['module']['type'] == 'WRAPPER')
			{
				require_once $block['wrapper']['path'].'class.php';
				$blocks[$id]['object'] = new $block['wrapper']['name']($block);
				if(URL::get('form_block_id')==$id)
				{
					$blocks[$id]['object']->submit();
				}
			}
			else
			if($block['module']['type'] != 'HTML' and $block['module']['type'] != 'CONTENT' and $block['module']['name'] != 'HTML')
			{
				require_once $block['module']['path'].'class.php';
				$blocks[$id]['object'] = new $block['module']['name']($block);
				if(URL::get('form_block_id')==$id)
				{
					$blocks[$id]['object']->submit();
				}
			}
		}
		require_once 'packages/core/includes/utils/draw.php';
		?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.facebook.com/2008/fbml"><!--https://www.w3.org/1999/xhtml -->
<html prefix="og: https://ogp.me/ns#">
<head>
<meta http-equiv="content-Type" content="text/css; charset=UTF-8" />
<meta http-equiv="content-language" content="vi" />
<title><?php echo (Portal::$document_title?(Portal::$document_title):Portal::get_setting('site_title'));?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="description" content="<?php echo (Portal::$meta_description?Portal::$meta_description:Portal::get_setting('website_description'));?>" />
<meta name="keywords" content="<?php echo (Portal::$meta_keywords?Portal::$meta_keywords:Portal::get_setting('website_keywords'));?>" />
<meta property="og:title" content="<?php echo (Portal::$document_title?(Portal::$document_title):Portal::get_setting('site_title'));?>" />
<meta property="og:description" content="<?php echo (Portal::$meta_description?Portal::$meta_description:Portal::get_setting('website_description'));?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo 'http://'.$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI'];?>" />
<meta property="og:image" content="<?php echo Portal::$image_url?Portal::$image_url:'http://'.$_SERVER['HTTP_HOST'].'/'.Portal::get_setting('thumb');?>" />
<meta name="robots" content="index,follow" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="cache-control" content="no-cache"/>
<meta name="resource-type" content="document" />
<meta property="fb:admins" content="NguyenDangKhoaVD"/>
<meta property="fb:app_id" content="1612685782280827" />
<!--<meta name="google-site-verification" content="p6ZNPv6TGamMbq4IHlsj-cB9TuNrrlqH_QP2LbiDmmI" />-->
<meta name="google-site-verification" content="ZwBudKlzYBklsKCn61tBHBDBbZQon9ahOiu3h0M132A" />
<meta name="msvalidate.01" content="36773E892E659BD5CEA162E06242D7EB" />
<base href="<?php echo 'http://',$_SERVER['HTTP_HOST'],'/';?>" />
<link rel="image_src" href="<?php echo Portal::$image_url?Portal::$image_url:'http://'.$_SERVER['HTTP_HOST'].'/starteam/images/Giai%20Thuong_A%20(500x400).png';?>" />
<link rel="shortcut icon" href="<?php echo Portal::get_setting('site_icon');?>"/>
<script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/packages/core/includes/js/common.js" type="text/javascript"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/packages/core/includes/js/cookie.js" type="text/javascript"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/packages/core/includes/js/jquery/jquery-1.7.1.js" type="text/javascript"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/packages/core/includes/js/jquery/ui.core.js" type="text/javascript"></script>
<script type="text/javascript">
	query_string = "?<?php echo urlencode($_SERVER['QUERY_STRING']);?>";
	PORTAL_ID = "<?php echo substr(PORTAL_ID,1);?>";
	jQuery.noConflict();
</script>
<script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/packages/core/includes/js/jq_common.js" type="text/javascript"></script>
<?php if(User::can_admin()){?>
<script>
	var use_double_click = <?php echo Portal::get_setting('use_double_click',1);?>;
</script>
<script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/packages/core/includes/js/admin.js" type="text/javascript"></script>
<?php }?>
<?php echo Portal::$extra_header;?>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"1VOal1ao9rD06C", domain:"sieusaongoaihang.vn",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=1VOal1ao9rD06C" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->  
</head>
<body><?php $blocks[72127]['object']->on_draw();?><?php echo Portal::get_setting('google_analytics');
if(User::is_admin() and Url::get('debug')==1)
{
	System::debug(DB::db_queries());
}
?>
</body>
</html><?php Module::invoke_event('ONUNLOAD',System::$false,System::$false);?>