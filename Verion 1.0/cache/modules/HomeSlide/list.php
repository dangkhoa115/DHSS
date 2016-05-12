<script type="text/javascript" src="skins/ssnh/scripts/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="skins/ssnh/scripts/jcarousel.skeleton.js"></script>
<link rel="stylesheet" href="skins/ssnh/styles/tabs/tabpane.css" type="text/css" />
<script type="text/javascript" src="skins/default/css/tabs/tabpane.js"></script>
<div class="row">
	<div class="col-md-6">
    <div id="slide_services">
        <script src="skins/ssnh/scripts/slides.min.jquery.js"></script>
        <script>
          $(function(){
            $('#slides').slides({
              preload: true,
              preloadImage: 'skins/ssnh/images/loading.gif',
              play: 4000,
              pause: 2500,
              hoverPause: true,
              animationStart: function(current){
                $('.caption').animate({
                  bottom:-70
                },100);
                if (window.console && console.log) {
                  // example return of current slide number
                  console.log('animationStart on slide: ', current);
                };
              },
              animationComplete: function(current){
                $('.caption').animate({
                  bottom:0
                },200);
                if (window.console && console.log) {
                  // example return of current slide number
                  console.log('animationComplete on slide: ', current);
                };
              },
              slidesLoaded: function() {
                $('.caption').animate({
                  bottom:0
                },200);
              }
            });
          });
        </script>
          <div id="example">
    <div id="slides">
    	<div class="poll-question">Chào mừng các bạn đến với Game Show Siêu Sao Ngải Ngoại Hạng - VTV3</div>
      <div class="slides_container">
        <div class="slide">
          <a href=""><img src="skins/ssnh/images/home_banner.jpg" alt="Siêu sao giải Ngoại Hạng - VTV3" title="Siêu sao giải Ngoại Hạng - VTV3"/></a>
          <div class="caption">
              <h1>Siêu sao giải Ngoại Hạng - VTV3</h1>
              <p>"Siêu sao giải Ngoại Hạng Anh" - Trực tiếp quay thưởng. Mỗi vòng đấu chương trình sẽ tổ chức bầu chọn cầu thủ đạt điểm số cao nhất dựa trên kết quả thực tế... </p>
              <h6><a href="game-show.html">Xem chi tiết</a></h6>
          </div>
        </div>
      </div>
      <a href="javascript:void(0)" class="prev"></a>
      <a href="javascript:void(0)" class="next"></a>
    </div>
    </div>
    </div><!--End .slide_services-->
  </div>  
  <div class="col-md-6">
    <div class="poll">
      <div class="poll-header row">
      	<div class="col-md-8 col-xs-6">
          <div class="title">
            <h3><img src="skins/ssnh/images/sb_lt_logo.png" alt="Barclays Premier League" title="Barclays Premier League" class="barclay-icon">Bảng vàng</h3>
          </div> 
        </div>
        <div class="col-md-4 col-xs-6">
        	<div class="fp-profiles"><a href="bang-xep-hang-nguoi-choi.html">Xem tất cả</a></div>
        </div>
      </div>
      <div class="tab-pane-1" id="tab-pane-category">
        <div class="tab-page" id="tab-page-category-1" style="overflow: auto;height: 230px;">
        <h2 class="tab">Nhất vòng</h2>
        <table cellspacing="0" cellpadding="0" class="leagueTable" width="100%">
            <tbody>
                <tr>
                     <th>Tên người chơi</th><th>Số điện thoại</th><th>Vòng</th><th>Bình chọn CLB</th>
                </tr>
                <?php $i=1;?>
                <?php
					if(isset($this->map['nguoi_chien_thangs']) and is_array($this->map['nguoi_chien_thangs']))
					{
						foreach($this->map['nguoi_chien_thangs'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['nguoi_chien_thangs']['current'] = &$item1;?>
                <tr <?php echo ($i==1)?'bgcolor="#ffcfa5" style="color: red;"':'';$i++;?>  <?php echo (isset($_SESSION['user_data']['nguoi_choi_id']) and $_SESSION['user_data']['nguoi_choi_id'] == $this->map['nguoi_chien_thangs']['current']['id'])?' class="itsme"':'';?>>
                  <td><a style="color:#000;" href="tong-hop/nguoichoi<?php echo $this->map['nguoi_chien_thangs']['current']['nguoi_choi_id'];?>.html"><?php echo $this->map['nguoi_chien_thangs']['current']['nguoi_choi'];?></a></td>
                  <td align="left"><?php echo $this->map['nguoi_chien_thangs']['current']['dien_thoai'];?></td>
                  <td align="center"><?php echo $this->map['nguoi_chien_thangs']['current']['vong_dau'];?></td>
                  <td align="center"><?php echo $this->map['nguoi_chien_thangs']['current']['clb'];?></td>
                </tr>          
                
							
						<?php
							}
						}
					unset($this->map['nguoi_chien_thangs']['current']);
					} ?>
                <?php for($j=1;$j<=(8-sizeof($this->map['nguoi_chien_thangs']));$j++){?>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        </div>
        <div class="tab-page" id="tab-page-category-2" style="overflow: auto;height: 230px;">
          <h2 class="tab">Nhất tháng</h2>
          <table cellspacing="0" cellpadding="0" class="leagueTable" width="100%">
            <tbody>
                <tr>
                     <th>Tên người chơi</th><th>Số điện thoại</th><th>Tháng</th>
                </tr>
                <?php $i=1;?>
                <?php
					if(isset($this->map['nguoi_chien_thang_thangs']) and is_array($this->map['nguoi_chien_thang_thangs']))
					{
						foreach($this->map['nguoi_chien_thang_thangs'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['nguoi_chien_thang_thangs']['current'] = &$item2;?>
                <tr <?php echo ($i==1)?'bgcolor="#ffcfa5" style="color: red;"':'';$i++;?>  <?php echo (isset($_SESSION['user_data']['nguoi_choi_id']) and $_SESSION['user_data']['nguoi_choi_id'] == $this->map['nguoi_chien_thang_thangs']['current']['id'])?' class="itsme"':'';?>>
                  <td><a style="color:#000;" href="tong-hop/nguoichoi<?php echo $this->map['nguoi_chien_thang_thangs']['current']['id'];?>.html"><?php echo $this->map['nguoi_chien_thang_thangs']['current']['nguoi_choi'];?></a></td>
                  <td align="left"><?php echo $this->map['nguoi_chien_thang_thangs']['current']['dien_thoai'];?></td>
                  <td align="center"><?php echo $this->map['nguoi_chien_thang_thangs']['current']['thang'];?></td>
                </tr>          
                
							
						<?php
							}
						}
					unset($this->map['nguoi_chien_thang_thangs']['current']);
					} ?>
                <?php for($j=1;$j<=(8-sizeof($this->map['nguoi_chien_thang_thangs']));$j++){?>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        </div>
     </div>
    </div>
   </div>
</div><br>