<?php

Module::invoke_event('ONLOAD',System::$false,System::$false);
global $blocks;
global $plugins;
$plugins = array (
);
$blocks = array (
);
		Portal::$page = array (
  'id' => '10456',
  'package_id' => '339',
  'layout_id' => '0',
  'layout' => 'packages/fmgame/layouts/landing_page.php',
  'skin' => 'default',
  'help_id' => '0',
  'name' => 'doi-hinh-sieu-sao',
  'title_1' => 'doi-hinh-sieu-sao',
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
<body><script type="text/javascript" src="../../../skins/fmgame/js/jquery.js"></script>
<script type="text/javascript" src="../../../skins/fmgame/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../../skins/fmgame/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../../../skins/fmgame/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="../../../skins/fmgame/css/style.css">
<div id="box-dhss">
  <div class="container">
      <div class="row">
          <div class="col-xs-2 col-sm-2 col-md-2">
              <div class="dhss-doihinh">
                  <img src="skins/fmgame/images/Doihinh.png" alt="" data-toggle="modal" data-target="#dhss-doihinh" title="Đội hình">

                  <div class="modal fade" id="dhss-doihinh" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">tieu de doi hinh</h4>
                        </div>
                        <div class="modal-body">
                            <p>noi dung doi hinh</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-2">
      <div class="dhss-lichthidau">
          <img src="skins/fmgame/images/Lichthidau.png" alt="" data-toggle="modal" data-target="#dhss-lichthidau" title="Lịch thi đấu">
          <!-- Modal -->
          <div class="modal fade" id="dhss-lichthidau" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">tieu de lich thi dau</h4>
            </div>
            <div class="modal-body">
                <p>noi dung lich thi dau</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Đóng</button>
            </div>
          </div>

           </div>
        </div>
    </div>
  </div>
<div class="col-xs-2 col-sm-2 col-md-2">
    <div class="dhss-sieusao">
        <img src="skins/fmgame/images/logo.png" alt="" data-toggle="modal" data-target="#dhss-logo" title="Siêu sao ngoại hạng">
    </div>
</div>
<div class="col-xs-2 col-sm-2 col-md-2">
    <div class="dhss-giaithuong">
            <img src="skins/fmgame/images/Giaithuong.png" alt="" data-toggle="modal" data-target="#dhss-Giaithuong" title="Giải thưởng">
                <!-- Modal -->
                <div class="modal fade" id="dhss-Giaithuong" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">tieu de giai thuong</h4>
                  </div>
                  <div class="modal-body">
                      <p>noi dung giai thuong</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-dismiss="modal">Đóng</button>
                  </div>
                </div>

                 </div>
              </div>
    </div>
</div>
<div class="col-xs-2 col-sm-2 col-md-2">
    <div class="dhss-play">
        <img src="skins/fmgame/images/Play.png" alt="" data-toggle="modal" data-target="#dhss-Play"  title="Bắt đầu chơi">
                <!-- Modal -->
    </div>
</div>
<div class="col-xs-2 col-sm-2 col-md-2"> 
    <div class="dhss-shop">
        <img src="skins/fmgame/images/Shopping.png" alt="" data-toggle="modal" data-target="#dhss-Shopping" title="Mua Cầu thủ">
                <!-- Modal -->
                <div class="modal fade" id="dhss-Shopping" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">tieu cua hang</h4>
                  </div>
                  <div class="modal-body">
                      <p>noi dung cua hang</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-dismiss="modal">Đóng</button>
                  </div>
                </div>

                 </div>
              </div>
    </div>
</div>
</div>
</div>
</div>
<script>
    jQuery(document).ready(function(){
        jQuery('[data-toggle="popover"]').popover();   
    });
</script><?php echo Portal::get_setting('google_analytics');
if(User::is_admin() and Url::get('debug')==1)
{
	System::debug(DB::db_queries());
}
?>
</body>
</html><?php Module::invoke_event('ONUNLOAD',System::$false,System::$false);?>