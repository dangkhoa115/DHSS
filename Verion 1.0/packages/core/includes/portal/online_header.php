<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.facebook.com/2008/fbml"><!--https://www.w3.org/1999/xhtml -->
<html prefix="og: https://ogp.me/ns#">
<head>
<meta http-equiv="content-Type" content="text/css; charset=UTF-8" />
<meta http-equiv="content-language" content="vi" />
<title><?php echo (Portal::$document_title?(Portal::$document_title):'ĐỘI HÌNH SIÊU SAO - GAME QUẢN LÝ BÓNG ĐÁ');?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="description" content="<?php echo (Portal::$meta_description?Portal::$meta_description:'Game quản lý bóng đá thông minh và hấp dẫn hàng đầu Việt Nam.');?>" />
<meta name="keywords" content="<?php echo (Portal::$meta_keywords?Portal::$meta_keywords:'game, bóng đá, quản lý, football, manager');?>" />
<meta property="og:title" content="<?php echo (Portal::$document_title?(Portal::$document_title):'ĐỘI HÌNH SIÊU SAO - GAME QUẢN LÝ BÓNG ĐÁ');?>" />
<meta property="og:description" content="<?php echo (Portal::$meta_description?Portal::$meta_description:'Game quản lý bóng đá thông minh và hấp dẫn hàng đầu Việt Nam.');?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo 'http://'.$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI'];?>" />
<meta property="og:image" content="<?php echo 'http://',$_SERVER['HTTP_HOST'],'/';?>skins/ssnh/images/fm_game/qc_web2.jpg" />
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
<link rel="image_src" href="<?php echo 'http://',$_SERVER['HTTP_HOST'],'/';?>skins/ssnh/images/fm_game/qc_web2.jpg" />
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
</head>
<body>