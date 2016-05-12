<?php

Module::invoke_event('ONLOAD',System::$false,System::$false);
global $blocks;
global $plugins;
$plugins = array (
);
$blocks = array (
  72898 => 
  array (
    'id' => '72898',
    'module_id' => '6002',
    'page_id' => '10411',
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
  72899 => 
  array (
    'id' => '72899',
    'module_id' => '6005',
    'page_id' => '10411',
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
  72900 => 
  array (
    'id' => '72900',
    'module_id' => '6083',
    'page_id' => '10411',
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
            <p style="background: #ffdddd;border: 1px solid #F93;padding: 15px;color: red;">
                Để đảm bảo công bằng cho các khán giả tham gia trò chơi “Siêu sao giải ngoại hạng”, chúng tôi những người làm chương trình xin được bổ sung thêm một phần rất quan trọng của luật chơi để tránh những khán giả đầu cơ giải thưởng. Đó là luật Chứng Minh Dân Nhân, mỗi người chơi tương ứng với một số CMND và một số điện thoại, những người chơi không điền thông tin CMND sẽ không được tham gia bốc thăm và xét thưởng. Nếu hồ sơ trao thưởng phát hiện số CMND không chính xác thì phần thưởng của vòng đó sẽ được bốc thăm lại. Mỗi CMND sẽ được đăng ký không quá 01 số điện thoại.
Ngay từ bây giờ các bạn tham gia vào “Siêu sao giải ngoại hạng” hãy truy cập vào website: https://sieusaongoaihang.vn để bổ sung CMND và chúc các bạn may mắn. 
            </p>
<br />
      <p style="background: #000;color: #fff;padding: 15px;">"Siêu sao giải Ngoại hạng" là một trò chơi trên truyền hình. Đối tượng tham gia là tất cả những người yêu thích giải Ngoại hạng Anh trên lãnh thổ Việt Nam. Người chơi sẽ bình chọn cho những cầu thủ xuất sắc nhất thuộc đội bóng mà mình yêu thích qua mỗi vòng đấu. Sau đây là cách tính điểm cho từng cầu thủ và cách thức khán giả tham gia trò chơi.</p>
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
                  <p style="color: #fff;text-align: left;">Mỗi vòng đấu dựa trên kết quả thi đấu thực tế của từng trận đấu, các cầu thủ sẽ được tính điểm theo các thông số và hệ số sau:</p><br />
                  <table cellspacing="0" cellpadding="0" width="100%">
                      <tr>
                          <th>Hành động</th><th>Điểm cộng</th>
                      </tr>
                      <tbody>
                          <tr class="ismEven"><td>Thi đấu dưới 60 phút</td><td align="center">1</td></tr>
                          <tr><td>Thi đấu 60 phút trở lên</td><td align="center">2</td></tr>
                          <tr class="ismEven"><td>Mỗi bàn thắng của Thủ môn hoặc hậu vệ</td><td align="center">6</td></tr>
                          <tr><td>Mỗi bàn thắng của Tiền vệ</td><td align="center">5</td></tr>
                          <tr class="ismEven"><td>Mỗi bàn thắng của Tiền đạo</td><td align="center">4</td></tr>
                          <tr><td>Mỗi pha kiến tạo</td><td align="center">3</td></tr>
                          <tr class="ismEven"><td>Thủ môn hoặc hậu vệ giữ sạch lưới</td><td align="center">4</td></tr>
                          <tr><td>Tiền vệ giữ sạch lưới</td><td align="center">1</td></tr>
                          <tr class="ismEven"><td>Thủ môn có 3 pha cản phá</td><td align="center">1</td></tr>
                          <tr><td>Thủ môn đẩy được penalty</td><td align="center">5</td></tr>
                          <tr class="ismEven"><td>Cầu thủ đá trượt penalty</td><td align="center">-2</td></tr>
                          <tr><td>Thủ môn hoặc hậu vệ thủng lưới (đơn vị: 2 bàn)</td><td align="center">-1</td></tr>
                          <tr class="ismEven"><td>Mỗi thẻ vàng</td><td align="center">-1</td></tr>
                          <tr><td>Mỗi thẻ đỏ</td><td align="center">-2</td></tr>
                          <tr class="ismEven"><td>Mỗi pha phản lưới nhà</td><td align="center">-2</td></tr>
                      </tbody>
                  </table>
              </div>
              <div style="clear: both;"></div>
      </div><!--End .tinh-diem-->
      <div class="giu-sach-luoi">
          <div class="main">
              <h3>Giữ sạch lưới</h3>
              <p>Một thủ môn, hậu vệ hoặc tiền vệ được tính là giữ sạch lưới khi đội bóng của họ không bị thủng lưới trong thời gian cầu thủ đó thi đấu ở trên sân và thời gian thi đấu từ 60 phút trở lên.</p>
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
<div class="doi-thu">
          <div class="main">
              <h3>Điểm số các cầu thủ bằng nhau</h3>
                 <p>Nếu bằng điểm nhau thì cầu thủ thuộc đội bóng xếp dưới trong bảng xếp hạng sẽ là cầu thủ xuất sắc nhất</p>
                <p>Nếu 2 đội bóng có cùng chỉ số thì tính theo tuyến: <br/>THỦ MÔN > HẬU VỆ > TIỀN VỆ > TIỀN ĐẠO</p>
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
                  <p>Nếu người chơi nhắn nhiều tin có nội dung khác nhau thì sẽ tổng đài ghi nhận 03 tin nhắn tại thời điểm sau cùng để làm kết quả dự thưởng.</p>
                  <p>Mỗi người chơi nhắn tin qua điện thoại sẽ được cung cấp 1 tài khoản trên website <a href="http://sieusaongoaihang.vn">http://sieusaongoaihang.vn</a> với username là số điện thoại, password sẽ được tổng đài nhắn tin vào thuê bao tại thời điểm người chơi nhắn tin nhắn đầu tiên.</p>
                  <div class="m-web">
                  <h3>Qua website</h3>
                  <p>Người chơi có thể đăng nhập bằng tài khoản trên website <a href="http://sieusaongoaihang.vn">http://sieusaongoaihang.vn</a> để biết thông tin chi tiết các vòng đấu, trận đấu của cầu thủ và các thông tin về điểm số cũng như bình chọn của những người chơi khác.</p>
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
              <img src="skins/ssnh/images/sb_lt_logo.png" alt="Barclays Premier League"><span>Người chơi và phần thưởng</span>
              </div> 
       </div>
      </div>
      <div class="phan-thuong">
          <div class="main">
<p><strong>NGÂN HÀNG ĐIỂM CHO NGƯỜI CHƠI:<strong></p>
              <p>Mỗi người chơi sẽ được cấp 1 tài khoản. Mỗi vòng đấu, hệ thống sẽ chọn ra những tài khoản có lựa chọn chính xác để trao thưởng. Nếu có nhiều hơn 01 người cùng dự đoán đúng thì sẽ tiến hành bốc thăm. Lấy <strong>50 người</strong> dự đoán đúng và sớm nhất để chọn ra 1 người chiến thắng và 4 người nhận được quà từ chương trình.</p>
              <p>Ngoài ra, tại mỗi vòng đấu, nếu dự đoán chính xác, tài khoản được cộng thêm 10 điểm. Số điểm này sẽ dùng để tích lũy, giúp người chơi  tham gia tranh tài ở các cấp cao hơn như giải thưởng tháng, giải thưởng quý, giải thưởng cả mùa,… .Người chơi có số điểm tích lũy cao nhất sẽ giành chiến thắng. Nếu có nhiều hơn 01 người bằng điểm nhau sẽ tiến hành bốc thăm.</p>
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
                  5.000.000 <small>vnd</small>
              </h3>
              <h3>
                  <span>Giải nhất tháng:</span>
                  15.000.000 <small>vnd</small>
              </h3>
          </div>
          <div class="main-one">
              <h3>
                  <span>Giải nhất năm</span>
                  50.000.000 <small>vnd</small>
                  <span class="img">
                      + 1 chuyến đi Anh </br>(Bao gồm vé máy bay và khách sạn dành cho 2 người)
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
  72957 => 
  array (
    'id' => '72957',
    'module_id' => '5911',
    'page_id' => '10411',
    'container_id' => '72898',
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
  'id' => '10411',
  'package_id' => '331',
  'layout_id' => '0',
  'layout' => 'packages/frontend/layouts/default.php',
  'skin' => 'default',
  'help_id' => '0',
  'name' => 'rules',
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
<?php echo Portal::$extra_header;?></head>
<body><div id="wrapper" <?php echo Portal::get_setting('background')?'style="background:URL('.Portal::get_setting('background').') center 50% fixed no-repeat !important"':'';?>>
	<div class="container">
    <div class="row">
      	<header><?php $blocks[72898]['object']->on_draw();?></header>
        <section class="col-md-12">
        <?php $blocks[72900]['object']->on_draw();?>
        <?php if(Url::get('page')=='clb' or Url::get('page')=='cau-thu'){?>
        <div class="player">
        <?php }?>
        <div class="row">
        <div class="col-left col-md-9"></div> <!-- End .col-left -->
        <div class="col-right col-md-3"></div> <!-- End .col-right -->
        </div>
        <?php if(Url::get('page')=='clb' or Url::get('page')=='cau-thu'){?>
        </div> <!-- End .container -->
        <?php }?>
      </section>
        <div class="col-md-12 footer">
        <?php $blocks[72899]['object']->on_draw();?>
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