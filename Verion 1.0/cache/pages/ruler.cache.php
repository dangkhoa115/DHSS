<?php

Module::invoke_event('ONLOAD',System::$false,System::$false);
global $blocks;
global $plugins;
$plugins = array (
);
$blocks = array (
  72893 => 
  array (
    'id' => '72893',
    'module_id' => '6002',
    'page_id' => '10410',
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
  72894 => 
  array (
    'id' => '72894',
    'module_id' => '6005',
    'page_id' => '10410',
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
  72895 => 
  array (
    'id' => '72895',
    'module_id' => '6083',
    'page_id' => '10410',
    'container_id' => '0',
    'region' => 'center',
    'position' => '1',
    'skin_name' => 'default',
    'layout' => 'default',
    'name' => 'Ruler',
    'settings' => 
    array (
      '6083_html_code' => '<div class="rules">
  <div class="title-all">
      <h1>
          <span>Thứ Ba ngày 22 tháng 7 2014</span>
          LUẬT CHƠI TRÒ CHƠI "SIÊU SAO GIẢI NGOẠI HẠNG"
      </h1>
  </div>
  <div class="detail">
      <p style="background: #000;color: #fff;padding: 15px;">Trò chơi "Siêu sao giải Ngoại hạng" là một trò chơi trên truyền hình. Đối tượng tham gia là tất cả những người yêu thích giải Ngoại hạng Anh trên lãnh thổ Việt Nam. Người chơi sẽ bình chọn cho những cầu thủ xuất sắc nhất mà mình yêu thích qua mỗi vòng đấu. Sau đây là cách tính điểm cho từng cầu thủ và cách thức khán giả tham gia trò chơi.</p>
          <br />
          <div class="title-cont">
              <div class="player-header">
                <div class="player-title">
                  <img src="skins/ssnh/images/sb_lt_logo.png" alt="Barclays Premier League"><span>Tính điểm cho cầu thủ</span>
                  </div> 
           </div>
             
          </div>
          <div class="tinh-diem">
              <div class="img"><img src="skins/ssnh/images/rs1.png"/></div>
              <div class="ismFixtureContainer blak">
                  <p style="color: #fff;text-align: center;">Mỗi vòng đấu, các cầu thủ sẽ được tính điểm dựa trên cơ sở sau:</p><br />
                  <table cellspacing="0" cellpadding="0" width="100%">
                      <tr>
                          <th>Hành động</th><th>Điểm cộng</th>
                      </tr>
                      <tbody>
                          <tr class="ismEven"><td>Thi đấu dưới 60 phút</td><td align="center">1</td></tr>
                          <tr><td>Thi đấu 60 phút trở lên</td><td align="center">3</td></tr>
                          <tr class="ismEven"><td>Mỗi bàn thắng của Thủ môn hoặc hậu vệ</td><td align="center">6</td></tr>
                          <tr><td>Mỗi bàn thắng của Tiền vệ</td><td align="center">5</td></tr>
                          <tr class="ismEven"><td>Mỗi bàn thắng của Tiền đạo</td><td align="center">4</td></tr>
                          <tr><td>Mỗi pha kiến tạo</td><td align="center">3</td></tr>
                          <tr class="ismEven"><td>Thủ môn hoặc hậu vệ giữ sạch lưới</td><td align="center">6</td></tr>
                          <tr><td>Tiền vệ giữ sạch lưới</td><td align="center">1</td></tr>
                          <tr class="ismEven"><td>Thủ môn có 3 pha cản phá</td><td align="center">1</td></tr>
                          <tr><td>Thủ môn đẩy được penalty</td><td align="center">5</td></tr>
                          <tr class="ismEven"><td>Cầu thủ đá trượt penalty</td><td align="center">-2</td></tr>
                          <tr><td>Thủ môn hoặc hậu vệ thủng lưới (đơn vị: 2 bàn)</td><td align="center">-1</td></tr>
                          <tr class="ismEven"><td>Mỗi thẻ vàng</td><td align="center">-1</td></tr>
                          <tr><td>Mỗi thẻ đỏ</td><td align="center">-3</td></tr>
                          <tr class="ismEven"><td>Mỗi pha phản lưới nhà</td><td align="center">-2</td></tr>
                      </tbody>
                  </table>
              </div>
              <div style="clear: both;"></div>
      </div><!--End .tinh-diem-->
      <div class="giu-sach-luoi">
          <div class="main">
              <h3>Giữ sạch lưới</h3>
              <p>Một cầu thủ được tính là giữ sạch lưới khi cầu thủ đó không bị thủng lưới trong thời gian cầu thủ đó thi đấu ở trên sân và thời gian thi đấu từ 60 phút trở lên.</p>
          </div>
      </div>
      <div class="the-do">
          <div class="main">
              <h3>Thẻ đỏ</h3>
                <p>Cầu thủ bị phạt thẻ đỏ vẫn tiếp tục bị trừ điểm bàn thua nếu như đội bóng của cầu thủ đó bị thủng lưới sau khi cầu thủ đó rời sân.</p>
                <p>Điểm trừ thẻ đỏ đã bao gồm điểm trừ cho thẻ vàng trước đó (trong trường hợp cầu thủ nhận 2 thẻ vàng).</p>
          </div>
      </div>
      <div class="kien-tao">
          <div class="main">
              <h3>Kiến tạo</h3>
              <p>Một cầu thủ được nhận điểm thưởng kiến tạo là khi cầu thủ đó có đường chuyền cuối cùng đến chân cầu thủ ghi bàn của đội mình. Trong trường hợp đường chuyền chạm vào đối phương trước khi đến người ghi bàn, nếu pha chạm bóng đó không thay đổi quỹ đạo bóng thì vẫn được tính là kiến tạo.</p>
              <p>Trường hợp cầu thủ kiếm được quả phạt đền và quả phạt đền thành công thì cũng tính vào pha kiến tạo. Nếu chính cầu thủ kiếm được quả phạt đền thực hiện thành công quả phạt đền đó thì chỉ được tính là ghi bàn. Người kiến tạo là cầu thủ có đường chuyền dẫn đến quả phạt đền.</p>
          </div>
      </div>
      <div class="can-pha">
          <div class="main">
              <h3>Thủ môn cản phá</h3>
                 <p>Thủ môn được tính là cản phá khi chặn được 1 cú sút có đường bóng đi vào khung thành.</p>
          <h3>Phản lưới nhà</h3>
                <p>Nếu cầu thủ sút bóng hoặc chạm vào bóng làm thay đổi quỹ đạo bóng dẫn tới bàn thắng của đội nhà thì sẽ tính là 1 pha phản lưới nhà. Cầu thủ đối phương cuối cùng chạm bóng sẽ được tính là kiến tạo.</p>
                <p>Trong quá trình thi đấu, điểm số cầu thủ được cập nhật theo thời gian thực. Tuy nhiên, trong nhiều trường hợp, các thống kê sẽ có nhiều cơ sở tính toán khác nhau dẫn tới số liệu chưa chính xác. Khi đó, dữ liệu sẽ được thông báo nếu có sự thay đổi. Sự thay đổi này được diễn ra muộn nhất 01 ngày sau khi công bố dữ liệu.</p>
          </div>
      </div>
      <div class="title-cont">
          <div class="player-header">
            <div class="player-title">
              <img src="skins/ssnh/images/sb_lt_logo.png" alt="Barclays Premier League"><span>Hình thức tham gia trò chơi</span>
              </div> 
       </div>
      </div>
      <div class="hinh-thuc">
              <div class="text">
                  <h3>Qua tin nhắn:</h3>
                  <p>Mỗi người chơi có thể nhắn tin bình chọn Câu lạc bộ có cầu thủ giành được điểm số cao nhất của vòng đấu đó. Nội dung tin nhắn là mã của 1 câu lạc bộ của giải Ngoại hạng Anh (ví dụ ARS, MUN, CHE,…). <strong>Phí mỗi tin nhắn là 10.000 VND</strong>.</p>
                  <p>Nếu người chơi nhắn tin sai cú pháp thì tổng đài sẽ phản hồi tin nhắn chưa hợp lệ và không trừ tiền tài khoản đó.</p>
                  <p>Nếu người chơi nhắn nhiều tin có nội dung khác nhau thì sẽ tổng đài ghi nhận tin nhắn tại thời điểm sau cùng.</p>
                  <p>Mỗi người chơi nhắn tin qua điện thoại sẽ được cung cấp 1 tài khoản trên website <a href="#">http://sieusaongoaihang.com</a> với username là số điện thoại, password sẽ được tổng đài nhắn tin vào thuê bao tại thời điểm người chơi nhắn tin nhắn đầu tiên.</p>
                  <div class="m-web">
                  <h3>Qua website</h3>
                  <p>Người chơi có thể đăng nhập bằng tài khoản trên website <a href="#">http://sieusaongoaihang.com</a> (tài khoản này có thể được người chơi đăng ký hoặc tự động tạo từ hệ thống).Trên website cũng có phần bình chọn tương ứng với cách bình chọn qua tin nhắn.</p>
              </div>
              </div>
              <div class="ismFixtureContainer">
                  <table cellspacing="0" cellpadding="0" width="100%">
                      <tbody><tr>
                          <th>Tên đội</th><th>Viết tắt</th><th>Tên đội</th><th>Viết tắt</th><th>Tên đội</th><th>Viết tắt</th>
                      </tr>
                      </tbody><tbody>
                          <tr class="ismEven">
                              <td align="center">Man United</td><td align="center"><strong>MUN</strong></td>
                              <td align="center">Aston Villa</td><td align="center"><strong>AVL</strong></td>
                              <td align="center">Crystal Palace</td><td align="center"><strong>CRY</strong></td>
                          </tr>
                          <tr>
                              <td align="center">Swansea</td><td align="center"><strong>SWA</strong></td>
                              <td align="center">West Brom</td><td align="center"><strong>WBA</strong></td>
                              <td align="center">Liverpool</td><td align="center"><strong>LIV</strong></td>
                          </tr>
                          <tr class="ismEven">
                              <td align="center">Everton</td><td align="center"><strong>EVE</strong></td>
                              <td align="center">West Ham</td><td align="center"><strong>WHU</strong></td>
                              <td align="center">Newcastle</td><td align="center"><strong>NEW</strong></td>
                          </tr>
                          <tr>
                              <td align="center">Q.P.R</td><td align="center"><strong>QPR</strong></td>
                              <td align="center">Tottenham</td><td align="center"><strong>TOT</strong></td>
                              <td align="center">Man City</td><td align="center"><strong>MCI</strong></td>
                          </tr>
                          <tr>
                              <td align="center">Hull City</td><td align="center"><strong>HUL</strong></td>
                              <td align="center">Arsenal</td><td align="center"><strong>ARS</strong></td>
                              <td align="center">Burnley</td><td align="center"><strong>BUR</strong></td>
                          </tr>
                          <tr>
                              <td align="center">Stoke</td><td align="center"><strong>STK</strong></td>
                              <td align="center">Chelsea</td><td align="center"><strong>CHE</strong></td>
                              <td align="center"></td><td align="center"></td>
                          </tr>
                      </tbody>
                  </table>
                  <img src="skins/ssnh/images/webc.png" style="display: block;margin: 10px auto;"/>
              </div>
              
              <div style="clear: both;"></div>
      </div>
      <div class="title-cont">
          <div class="player-header">
            <div class="player-title">
              <img src="skins/ssnh/images/sb_lt_logo.png" alt="Barclays Premier League"><span>Phần thưởng dành cho người chơi</span>
              </div> 
       </div>
      </div>
      <div class="phan-thuong">
          <div class="main">
              <p>Mỗi người chơi sẽ được cấp 1 tài khoản. Mỗi vòng đấu, hệ thống sẽ chọn ra những tài khoản có lựa chọn chính xác để trao thưởng. Nếu có nhiều hơn 01 người cùng dự đoán đúng thì sẽ tiến hành bốc thăm. Nếu có nhiều hơn 50 người dự đoán đúng thì sẽ chọn 50 người có thời gian dự đoán nhanh nhất. </p>
              <p>Ngoài ra, tại mỗi vòng đấu, nếu dự đoán chính xác, tài khoản được cộng thêm 10 điểm. Số điểm này sẽ dùng để tích lũy, giúp người chơi  tham gia tranh tài ở các cấp cao hơn như giải thưởng tháng, giải thưởng quý, giải thưởng cả mùa,… Người chơi có số điểm tích lũy cao nhất sẽ giành chiến thắng. Nếu có nhiều hơn 01 người bằng điểm nhau sẽ tiến hành bốc thăm.</p>
          </div>
      </div>
      <div class="title-cont">
          <div class="player-header">
            <div class="player-title">
              <img src="skins/ssnh/images/sb_lt_logo.png" alt="Barclays Premier League"><span>Cơ cấu giải thưởng dành cho người chơi</span>
              </div> 
       </div>
      </div>
      <div class="phan-thuong2">
          <div class="main">
              <h3>
                  <span>Giải nhất tuần:</span>
                  10.000.000 <small>vnd</small>
              </h3>
              <h3>
                  <span>Giải nhất tháng:</span>
                  15.000.000 <small>vnd</small>
              </h3>
          </div>
          <div class="main-one">
              <h3>
                  <span>Giải nhất năm</span>
                  20.000.000 <small>vnd</small>
                  <span class="img">
                      + cặp vé tham gia một trận đấu thuộc giải ngoại hạng Anh
                  </span>
              </h3>
          </div>
      </div>
  </div>
</div>',
      '6083_template' => '',
      '6083_use_php' => '',
    ),
    'module' => 
    array (
      'id' => '6083',
      'name' => 'Html',
      'path' => 'packages/frontend/modules/Html/',
      'type' => '',
      'action_module_id' => '0',
      'use_dblclick' => '0',
      'package_id' => '331',
    ),
  ),
);
		Portal::$page = array (
  'id' => '10410',
  'package_id' => '331',
  'layout_id' => '0',
  'layout' => 'packages/frontend/layouts/default.php',
  'skin' => 'default',
  'help_id' => '0',
  'name' => 'ruler',
  'title_1' => 'ruler',
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
  
<?php $blocks[72893]['object']->on_draw();?>
  <div class="container">
  	<?php if(Url::get('page')=='clb' or Url::get('page')=='cau-thu'){?>
    <div class="player">
    <?php }?>
  	<div class="col-left"></div> <!-- End .col-left -->
    <div class="col-right"></div> <!-- End .col-right -->
    <?php if(Url::get('page')=='clb' or Url::get('page')=='cau-thu'){?>
    </div> <!-- End .container -->
    <?php }?>
    
<?php $blocks[72895]['object']->on_draw();?>
	</div> <!-- End .container -->
<div class="footer">
<?php $blocks[72894]['object']->on_draw();?></div><?php echo Portal::get_setting('google_analytics');
if(User::is_admin() and Url::get('debug')==1)
{
	System::debug(DB::db_queries());
}
?>
</body>
</html>
<?php Module::invoke_event('ONUNLOAD',System::$false,System::$false);?>