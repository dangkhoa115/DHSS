<?php

Module::invoke_event('ONLOAD',System::$false,System::$false);
global $blocks;
global $plugins;
$plugins = array (
);
$blocks = array (
  72804 => 
  array (
    'id' => '72804',
    'module_id' => '6002',
    'page_id' => '10380',
    'container_id' => '0',
    'region' => 'banner',
    'position' => '1',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => '6002',
      'name' => 'Banner',
      'path' => 'packages/frontend/modules/Banner/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'package_id' => '331',
    ),
  ),
  72805 => 
  array (
    'id' => '72805',
    'module_id' => '6005',
    'page_id' => '10380',
    'container_id' => '0',
    'region' => 'footer',
    'position' => '1',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => '6005',
      'name' => 'Footer',
      'path' => 'packages/frontend/modules/Footer/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'package_id' => '331',
    ),
  ),
  72851 => 
  array (
    'id' => '72851',
    'module_id' => '6097',
    'page_id' => '10380',
    'container_id' => '0',
    'region' => 'banner',
    'position' => '2',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => '6097',
      'name' => 'HotItem',
      'path' => 'packages/frontend/modules/HotItem/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'package_id' => '331',
    ),
  ),
  72762 => 
  array (
    'id' => '72762',
    'module_id' => '6080',
    'page_id' => '10380',
    'container_id' => '0',
    'region' => 'center',
    'position' => '3',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => '6080',
      'name' => 'ItemDetail',
      'path' => 'packages/frontend/modules/ItemDetail/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'package_id' => '331',
    ),
  ),
  72786 => 
  array (
    'id' => '72786',
    'module_id' => '6086',
    'page_id' => '10380',
    'container_id' => '72762',
    'region' => 'right_adv_region',
    'position' => '1',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => '6086',
      'name' => 'NewsHot',
      'path' => 'packages/frontend/modules/NewsHot/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'layout' => '',
      'code' => '',
      'package_id' => '331',
    ),
  ),
  72839 => 
  array (
    'id' => '72839',
    'module_id' => '6094',
    'page_id' => '10380',
    'container_id' => '72762',
    'region' => 'top_right_region',
    'position' => '1',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => '6094',
      'name' => 'SupportOnline',
      'path' => 'packages/frontend/modules/SupportOnline/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'layout' => '',
      'code' => '',
      'package_id' => '331',
    ),
  ),
  72787 => 
  array (
    'id' => '72787',
    'module_id' => '5911',
    'page_id' => '10380',
    'container_id' => '72762',
    'region' => 'right_adv_region',
    'position' => '2',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => 'right-adv',
    'settings' => 
    array (
      '5911_cache' => '<div class="frontend-advertisment-default"><div class="advertisment-bound" style=" <?php if(Module::get_setting(\'extend_css\')){ echo Module::get_setting(\'extend_css\'); }?>">
<?php
					if(isset($this->map[\'items\']) and is_array($this->map[\'items\']))
					{
						foreach($this->map[\'items\'] as $key1=>&$item1)
						{
							if($key1!=\'current\')
							{
								$this->map[\'items\'][\'current\'] = &$item1;?>
<?php
$height = \'\'; $width = \'\';
if(isset($this->map[\'items\'][\'current\'][\'height\']) and $this->map[\'items\'][\'current\'][\'height\']) $height = \'height="\'.$this->map[\'items\'][\'current\'][\'height\'].\'px"\';
if(isset($this->map[\'items\'][\'current\'][\'width\']) and $this->map[\'items\'][\'current\'][\'width\']) $width = \'width="\'.$this->map[\'items\'][\'current\'][\'width\'].\'px"\';
?>

<?php
if(strpos($this->map[\'items\'][\'current\'][\'image_url\'],\'.swf\'))
{
	?>
<object id="FlashID_<?php echo $this->map[\'items\'][\'current\'][\'id\'];?>" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="<?php echo $this->map[\'items\'][\'current\'][\'width\'];?>" height="<?php echo $this->map[\'items\'][\'current\'][\'height\'];?>">
              <param name="movie" value="<?php echo $this->map[\'items\'][\'current\'][\'image_url\'];?>" />
              <param name="quality" value="high" />
              <param name="wmode" value="opaque" />
              <param name="swfversion" value="8.0.35.0" />
              <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don\'t want users to see the prompt. -->
              <param name="expressinstall" value="Scripts/expressInstall.swf" />
              <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
              <!--[if !IE]>-->
              <object type="application/x-shockwave-flash" data="<?php echo $this->map[\'items\'][\'current\'][\'image_url\'];?>" width="<?php echo $this->map[\'items\'][\'current\'][\'width\'];?>" height="<?php echo $this->map[\'items\'][\'current\'][\'height\'];?>">
                <!--<![endif]-->
                <param name="quality" value="high" />
                <param name="wmode" value="transparent" />
                <param name="swfversion" value="8.0.35.0" />
                <param name="expressinstall" value="Scripts/expressInstall.swf" />
                <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
                <div>
                  <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
                  <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
                </div>
                <!--[if !IE]>-->
              </object>
              <!--<![endif]-->
      </object>
	<?php
}
else
{
	if($this->map[\'items\'][\'current\'][\'url\']!="")
	{
		echo \'<a target="_blank" href="\'.Url::build_current(array(\'cmd\'=>\'click\',\'id\'=>$this->map[\'items\'][\'current\'][\'id\'])).\'"><img src="\'.$this->map[\'items\'][\'current\'][\'image_url\'].\'" title="\'.$this->map[\'items\'][\'current\'][\'name\'].\'" alt="\'.$this->map[\'items\'][\'current\'][\'name\'].\'" \'.$width.\' \'.$height.\' style="\'.Module::get_setting(\'internal_css\').\'"></a>\';
	}
	else
	{
		echo \'<img src="\'.$this->map[\'items\'][\'current\'][\'image_url\'].\'" title="\'.$this->map[\'items\'][\'current\'][\'name\'].\'" alt="\'.$this->map[\'items\'][\'current\'][\'name\'].\'" \'.$width.\' \'.$height.\' style="\'.Module::get_setting(\'internal_css\').\'">\';
	}
}
?>

							
						<?php
							}
						}
					unset($this->map[\'items\'][\'current\']);
					} ?>
<?php if(User::can_admin(MODULE_MEDIAADMIN,ANY_CATEGORY)){?>
<div align="center">[<a target="_blank" href="<?php echo Url::build(\'manage_advertisment\',array(\'page_id\'=>Module::$current->data[\'page_id\'],\'region\'=>Module::$current->data[\'name\']))?>"><?php echo Portal::language(\'adv_list\');?></a>]&nbsp;[<a target="_blank" href="<?php echo Url::build(\'manage_advertisment\',array(\'cmd\'=>\'advertisment\',\'page_id\'=>Module::$current->data[\'page_id\'],\'region\'=>Module::$current->data[\'name\']))?>"><?php echo Portal::language(\'add_adv\');?></a>]</div>
<?php }?>
</div>

</div><?php $title = Module::get_setting(\'title\')?Portal::language(Module::get_setting(\'title\')):\'\';?>',
      '5911_layout_template' => 'packages/frontend/templates/Advertisment/layouts/default',
      '5911_limit' => '5',
      '5911_skin_template' => 'packages/frontend/templates/Advertisment/skins/default',
      '5911_extend_css' => '',
      '5911_frame_skin_template' => '',
      '5911_frame_template' => '',
      '5911_internal_css' => '',
      '5911_title' => '',
    ),
    'module' => 
    array (
      'id' => '5911',
      'name' => 'Advertisment',
      'path' => 'packages/backend/modules/Advertisment/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'layout' => '',
      'code' => '',
      'package_id' => '332',
    ),
  ),
  72830 => 
  array (
    'id' => '72830',
    'module_id' => '6101',
    'page_id' => '10380',
    'container_id' => '72762',
    'region' => 'right_region',
    'position' => '2',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => '6101',
      'name' => 'ListMaker',
      'path' => 'packages/frontend/modules/ListMaker/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'layout' => '',
      'code' => '',
      'package_id' => '331',
    ),
  ),
  72840 => 
  array (
    'id' => '72840',
    'module_id' => '6083',
    'page_id' => '10380',
    'container_id' => '72762',
    'region' => 'right_region',
    'position' => '3',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => 'filter-by-price',
    'settings' => 
    array (
      '6083_html_code' => '<div class="facebook">
</div>',
      '6083_use_php' => 'on',
      '6083_template' => '',
    ),
    'module' => 
    array (
      'id' => '6083',
      'name' => 'Html',
      'path' => 'packages/frontend/modules/Html/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'layout' => '',
      'code' => '',
      'package_id' => '331',
    ),
  ),
  72841 => 
  array (
    'id' => '72841',
    'module_id' => '6105',
    'page_id' => '10380',
    'container_id' => '72762',
    'region' => 'right_region',
    'position' => '4',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => '6105',
      'name' => 'PriceList',
      'path' => 'packages/frontend/modules/PriceList/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'layout' => '',
      'code' => '',
      'package_id' => '331',
    ),
  ),
  72838 => 
  array (
    'id' => '72838',
    'module_id' => '6104',
    'page_id' => '10380',
    'container_id' => '72762',
    'region' => 'right_region',
    'position' => '5',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => '6104',
      'name' => 'ListOs',
      'path' => 'packages/frontend/modules/ListOs/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'layout' => '',
      'code' => '',
      'package_id' => '331',
    ),
  ),
  72842 => 
  array (
    'id' => '72842',
    'module_id' => '6106',
    'page_id' => '10380',
    'container_id' => '72762',
    'region' => 'right_region',
    'position' => '6',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => '6106',
      'name' => 'ItemsSamePrice',
      'path' => 'packages/frontend/modules/ItemsSamePrice/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'layout' => '',
      'code' => '',
      'package_id' => '331',
    ),
  ),
  72861 => 
  array (
    'id' => '72861',
    'module_id' => '6113',
    'page_id' => '10380',
    'container_id' => '72762',
    'region' => 'right_region',
    'position' => '7',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => '6113',
      'name' => 'ItemsSameModel',
      'path' => 'packages/frontend/modules/ItemsSameModel/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'layout' => '',
      'code' => '',
      'package_id' => '331',
    ),
  ),
  72862 => 
  array (
    'id' => '72862',
    'module_id' => '6114',
    'page_id' => '10380',
    'container_id' => '72762',
    'region' => 'right_region',
    'position' => '8',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => '6114',
      'name' => 'Tags',
      'path' => 'packages/frontend/modules/Tags/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'layout' => '',
      'code' => '',
      'package_id' => '331',
    ),
  ),
);
		Portal::$page = array (
  'id' => '10380',
  'package_id' => '331',
  'layout_id' => '0',
  'layout' => 'packages/frontend/layouts/default.php',
  'skin' => 'default',
  'help_id' => '0',
  'name' => 'chi-tiet',
  'title_1' => 'chi-tiet',
  'description_1' => '',
  'description' => '',
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
		?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.facebook.com/2008/fbml"><!--http://www.w3.org/1999/xhtml -->
<html prefix="og: http://ogp.me/ns#">
<head>
<meta http-equiv="content-Type" content="text/css; charset=UTF-8" />
<meta http-equiv="content-language" content="vi" />
<title><?php echo (Portal::$document_title?(Portal::$document_title):Portal::get_setting('site_title'));?></title>
<meta name="description" content="<?php echo (Portal::$meta_description?Portal::$meta_description:Portal::get_setting('website_description'));?>" />
<meta name="keywords" content="<?php echo (Portal::$meta_keywords?Portal::$meta_keywords:Portal::get_setting('website_keywords'));?>" />
<meta property="og:title" content="<?php echo (Portal::$document_title?(Portal::$document_title):Portal::get_setting('site_title'));?> - Click để xem !!!" />
<meta property="og:description" content="<?php echo (Portal::$meta_description?Portal::$meta_description:Portal::get_setting('website_description'));?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo 'http://'.$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI'];?>" />
<meta property="og:image" content="<?php echo Portal::$image_url?Portal::$image_url:'http://'.$_SERVER['HTTP_HOST'].'/skins/modern/images/thumb.png';?>" />
<meta name="robots" content="index,follow" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="cache-control" content="no-cache"/>
<meta name="resource-type" content="document" />
<meta property="fb:app_id" content="168444016657748" />
<meta name="google-site-verification" content="p6ZNPv6TGamMbq4IHlsj-cB9TuNrrlqH_QP2LbiDmmI" />
<?php if(System::check_user_agent()){?>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<?php }?>
<base href="<?php echo 'http://',$_SERVER['HTTP_HOST'],'/';?>" />
<link rel="image_src" href="<?php echo Portal::$image_url?Portal::$image_url:'http://'.$_SERVER['HTTP_HOST'].'/skins/modern/images/thumb.png';?>" />
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
<?php echo Portal::$extra_header;?></head>
<body><div id="wrapper">
  <div>
<?php $blocks[72804]['object']->on_draw();?>
<?php $blocks[72851]['object']->on_draw();?></div>
  <div>
<?php $blocks[72762]['object']->on_draw();?></div>
</div>
<div id="footer">
<?php $blocks[72805]['object']->on_draw();?></div><?php echo Portal::get_setting('google_analytics');
if(User::is_admin() and Url::get('debug')==1)
{
	System::debug(DB::db_queries());
}
?>
</body>
</html>
<?php Module::invoke_event('ONUNLOAD',System::$false,System::$false);?>