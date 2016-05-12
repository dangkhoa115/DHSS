<?php

Module::invoke_event('ONLOAD',System::$false,System::$false);
global $blocks;
global $plugins;
$plugins = array (
);
$blocks = array (
  72776 => 
  array (
    'id' => '72776',
    'module_id' => '6002',
    'page_id' => '10382',
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
  72777 => 
  array (
    'id' => '72777',
    'module_id' => '6005',
    'page_id' => '10382',
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
  72779 => 
  array (
    'id' => '72779',
    'module_id' => '6087',
    'page_id' => '10382',
    'container_id' => '0',
    'region' => 'left',
    'position' => '1',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => '6087',
      'name' => 'NewsDetail',
      'path' => 'packages/frontend/modules/NewsDetail/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'package_id' => '331',
    ),
  ),
  72940 => 
  array (
    'id' => '72940',
    'module_id' => '6086',
    'page_id' => '10382',
    'container_id' => '0',
    'region' => 'right',
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
      'package_id' => '331',
    ),
  ),
  72979 => 
  array (
    'id' => '72979',
    'module_id' => '6137',
    'page_id' => '10382',
    'container_id' => '0',
    'region' => 'right',
    'position' => '2',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => '6137',
      'name' => 'LastestNews',
      'path' => 'packages/frontend/modules/LastestNews/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'package_id' => '331',
    ),
  ),
  72897 => 
  array (
    'id' => '72897',
    'module_id' => '6122',
    'page_id' => '10382',
    'container_id' => '0',
    'region' => 'right',
    'position' => '3',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => '6122',
      'name' => 'SsnhBangXepHangClb',
      'path' => 'packages/frontend/modules/SsnhBangXepHangClb/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'package_id' => '331',
    ),
  ),
  72955 => 
  array (
    'id' => '72955',
    'module_id' => '5911',
    'page_id' => '10382',
    'container_id' => '72776',
    'region' => 'float_adv_right',
    'position' => '1',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => 'float-adv-right',
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
		echo \'<a target="_blank" href="\'.$this->map[\'items\'][\'current\'][\'url\'].\'"><img src="\'.$this->map[\'items\'][\'current\'][\'image_url\'].\'" title="\'.$this->map[\'items\'][\'current\'][\'name\'].\'" alt="\'.$this->map[\'items\'][\'current\'][\'name\'].\'" \'.$width.\' \'.$height.\' style="\'.Module::get_setting(\'internal_css\').\'"></a>\';
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
);
		Portal::$page = array (
  'id' => '10382',
  'package_id' => '331',
  'layout_id' => '0',
  'layout' => 'packages/frontend/layouts/default.php',
  'skin' => 'default',
  'help_id' => '0',
  'name' => 'xem-tin',
  'title_1' => 'xem-tin',
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
<link rel="image_src" href="<?php echo Portal::$image_url?Portal::$image_url:'http://'.$_SERVER['HTTP_HOST'].'/'.Portal::get_setting('thumb');?>" />
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
<body><div id="wrapper" <?php echo Portal::get_setting('background')?'style="background:URL('.Portal::get_setting('background').') center 50% fixed no-repeat !important"':'';?>>
	<div class="container">
    <div class="row">
      	<header><?php $blocks[72776]['object']->on_draw();?></header>
        <section class="col-md-12">
        
        <?php if(Url::get('page')=='clb' or Url::get('page')=='cau-thu'){?>
        <div class="player">
        <?php }?>
        <div class="row">
        <div class="col-left col-md-9"><?php $blocks[72779]['object']->on_draw();?></div> <!-- End .col-left -->
        <div class="col-right col-md-3"><?php $blocks[72940]['object']->on_draw();?><?php $blocks[72979]['object']->on_draw();?><?php $blocks[72897]['object']->on_draw();?></div> <!-- End .col-right -->
        </div>
        <?php if(Url::get('page')=='clb' or Url::get('page')=='cau-thu'){?>
        </div> <!-- End .container -->
        <?php }?>
      </section>
        <div class="col-md-12 footer">
        <?php $blocks[72777]['object']->on_draw();?>
      </div>
    </div>
	</div>
</div><?php echo Portal::get_setting('google_analytics');
if(User::is_admin() and Url::get('debug')==1)
{
	System::debug(DB::db_queries());
}
?>
</body>
</html><?php Module::invoke_event('ONUNLOAD',System::$false,System::$false);?>