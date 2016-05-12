<div class="row">
  <div class="col-md-12">
    <div class="top-line grey-gradient navbar-fixed-top">
        <div class="col-md-5">
          <div class="left">
            <?php 
				if((User::is_login()))
				{?>
           Xin chào: <a href="tong-hop.html"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $_SESSION['user_data']['full_name'];?> / <?php echo Session::get('user_id');?></a>
            
				<?php
				}
				?> 
          </div>
        </div>
        <div class="col-md-7">
          <div class="right">
            <div class="row">
              <?php 
				if((User::is_login()))
				{?>
              <div class="user-name col-md-12">
                 <a href="tong-hop.html">Trang cá nhân</a><a href="nap_igold.html" class="igold"><?php echo iGold::get_igold(Session::get('user_id'));?> <img src="skins/ssnh/images/igold_16_text.png" alt=""></a><a href="ssnh_shop.html" class="shop">SHOP</a><a href="ssnh_shop/your_item.html" class="shop your-item">item của bạn</a><?php echo User::can_add(MODULE_NEWSADMIN,ANY_CATEGORY)?'<a href="?page=news_admin">Quản trị</a><a href="tong-hop.html">Trang người chơi</a>':'<a href="tham-gia-binh-chon.html">Tham gia bình chọn</a>'?><a href="dang-tin.html" class="viet-bai"> <span class="glyphicon glyphicon-file" aria-hidden="true"></span>Viết bài</a><a href="?page=sign_out" class="log-out">Thoát</a>
              </div>
               <?php }else{ ?>
              <div class="col-md-12" align="right">
                <form name="LandingPageForm" method="post" action="dang-nhap.html" class="form-inline">
                <div class="form-group">
                  <label for="user_id">Tên đăng nhập hoặc email</label>
                  <input  name="user_id" id="user_id" class="form-control"/ type ="text" value="<?php echo String::html_normalize(URL::get('user_id'));?>">
                  <label for="password">Mật khẩu</label>
                  <input  name="password" id="password" class="form-control"/ type ="password" value="<?php echo String::html_normalize(URL::get('password'));?>">
                  <input type="submit" name="" value="Đăng nhập" class="btn btn-default"/>
     							 <a rel="nofollow" href="quen-mat-khau-html">Quên mật khẩu?</a>
                </div>
                <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			 
              </div>
              
				<?php
				}
				?> 
            </div>
         </div>
        </div>
      </div>
    </div>
</div>
<div class="row">
  <div class="col-md-12">
  	<div class="row topbar">
    	<div class="col-md-3 logo">
      	<a href="" title="Về trang chủ"><img src="skins/ssnh/images/landing_page/logo.png" alt="Siêu Sao Giải Ngoại Hạng"></a>
      </div>
      <div class="col-md-6">
      	<div class="title"><?php 
				if((!Url::get('page')))
				{?><h1>SIÊU SAO GIẢI NGOẠI HẠNG - VTV3</h1>
				<?php
				}
				?>
        <div class="note">Tất cả người chơi dự đoán đúng đều được quay trúng thưởng!</div>
        </div>
      </div>
       <div class="col-md-3 nha-tai-tro hide"><a href="http://www.habeco.com.vn" target="_blank" alt="Bia Hà Nội"><img src="skins/ssnh/images/landing_page/nttr.png" alt="Bia Hà Nội"></a></div>
		</div> 
  </div>
  <div class="col-md-12">
  	<div class="row">
      <div class="navbar">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
           <a class="navbar-brand" href="" rel="nofollow"><span class="glyphicon glyphicon-home"></span></a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">      
               <?php echo $this->map['item_ul_categories'];?>
               <li><a href="lien-he.html" class="last-child" rel="nofollow">Liên hệ</a><div class="hover"></div></li>
            </ul>
          </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
	<div class="col-md-12">
		<div class="row center">
  		<div class="col-md-4">
				<div class="img giai-thuong">&nbsp;</div>
        <div class="text">
        	<a href="game-show.html"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> Với cơ cấu giải thưởng cực kỳ hấp dẫn</a>
        </div>
      </div>
      <div class="col-md-4">
      	<div class="img binh-chon"><div class="text"><a href="tin-tuc/game-show/huong-dan-game-show-sieu-sao-giai-ngoai-hang.html"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Hướng dẫn cách chơi</a></div></div>
        <div class="text">
        	<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
        </div>
      </div>
      <div class="col-md-4">
     	 <div class="img igold">&nbsp;</div>
        <div class="text">
        	<a href="tin-tuc/game-show/gioi-thieu-igold-item.html"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> iGold và mua iTem hỗ trợ </a>
        </div>
      </div>
      	<div class="search">
            <p class="time">Hôm nay, ngày <?php echo date('d');?> tháng <?php echo date('m');?> năm <?php echo date('Y');?></p>
            <div class="main-search group-input">
              <form name="SearchBannerForm" method="post">
                <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm" class="form-control"/>
                <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
              <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
            </div>
        </div><!--End .search-->
       <?php 
				if(($this->map['show_countdown']))
				{?>
        <div class="countdown <?php echo $this->map['class'];?>">
          <span class="title"><?php echo $this->map['thong-bao-sms'];?></span>
          <script type="application/javascript">
          var myCountdown1 = new Countdown({
          time: <?php echo $this->map['second'];?>, // 86400 seconds = 1 day
          width:180, 
          height:38,  
          rangeHi:"day",
          style:"flip"	// <- no comma on last item!
          });
        </script>
        </div> <!--End .countdown-->
        
				<?php
				}
				?>
    </div>
    <div class="row under-center">
  		<div class="col-md-5">
      	<div class="dang-ky">
				<a href="register.html">Đăng ký</a> để tham gia bình chọn
        </div>
      </div>
      <div class="col-md-2">
      	<div class="text">
      	<input type="button" value="Vào chơi ngay" class="btn btn-default" onClick="window.open('tham-gia-binh-chon/do/bc.html');">
        </div>
      </div>
      <div class="col-md-5">
      	<div class="sms">
     	 		Hoặc soạn tin nhắn: <strong>EPL</strong> <a href="#" onClick="showListCLB()" title="Nhấn chuột vào đây để tra cứu mã CLB">MA_CLB</a> gửi <strong>6370</strong>
        </div>
       
      </div>
    </div>
  </div>
</div>
<div class="row top-content">
	<div class="col-md-3 mxh">
  	<div class="title"><h3><a href="nguoi-choi-chien-thang.html">Người chơi chiến thắng</a><span class="glyphicon glyphicon-play" aria-hidden="true"></span></h3></div>
    <div class="content mCustomScrollbar">
      <div class="contact-info">
        <ul>
        	<?php $i=1;?>
        	<?php
					if(isset($this->map['chien_thangs']) and is_array($this->map['chien_thangs']))
					{
						foreach($this->map['chien_thangs'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['chien_thangs']['current'] = &$item1;?>
          <li> <?php if($i==1){?><a href="tong-hop/nguoichoi<?php echo $this->map['chien_thangs']['current']['nguoi_choi_id'];?>.html" title="<?php echo $this->map['chien_thangs']['current']['nguoi_choi'];?>"><img src="<?php echo $this->map['chien_thangs']['current']['anh_dai_dien'];?>" onerror="this.src='skins/ssnh/images/unknown_player.png'" alt="<?php echo $this->map['chien_thangs']['current']['nguoi_choi'];?>"><br> <?php }?><?php echo $this->map['chien_thangs']['current']['vong_dau'];?>:<?php echo $this->map['chien_thangs']['current']['giai_thuong'];?> / <?php echo $this->map['chien_thangs']['current']['nguoi_choi'];?> / ĐT: <?php echo $this->map['chien_thangs']['current']['dien_thoai'];?></a></li>
          <?php $i++?>
          
							
						<?php
							}
						}
					unset($this->map['chien_thangs']['current']);
					} ?>
        </ul>
       </div>
    </div>
  </div>
	<div class="col-md-3 cauthu-clb">
  	<div class="title"><h3><a href="cau-thu-xuat-sac-nhat.html">Cầu thủ xuất sắc nhất vòng</a><span class="glyphicon glyphicon-play" aria-hidden="true"></span></h3></div>
    <div class="content mCustomScrollbar">
    	<uL>
      	<?php $i=1;?>
      	<?php
					if(isset($this->map['cauthus']) and is_array($this->map['cauthus']))
					{
						foreach($this->map['cauthus'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['cauthus']['current'] = &$item2;?>
      	<li><?php if($i==1){?><a href="cau-thu/<?php echo $this->map['cauthus']['current']['name_id'];?>-id<?php echo $this->map['cauthus']['current']['cau_thu_id'];?>.html" class="img" title="<?php echo $this->map['cauthus']['current']['ten'];?> - <?php echo $this->map['cauthus']['current']['clb'];?>"><img src="<?php echo $this->map['cauthus']['current']['anh_dai_dien'];?>" alt="<?php echo $this->map['cauthus']['current']['ten'];?> - <?php echo $this->map['cauthus']['current']['clb'];?>"><span class="diem"><?php echo $this->map['cauthus']['current']['diem'];?>đ</span></a><?php }?>
        	<strong><?php echo $this->map['cauthus']['current']['clb'];?></strong><br>
          <a href="cau-thu/<?php echo $this->map['cauthus']['current']['name_id'];?>-id<?php echo $this->map['cauthus']['current']['cau_thu_id'];?>.html" title="<?php echo $this->map['cauthus']['current']['ten'];?> - <?php echo $this->map['cauthus']['current']['clb'];?>"><?php echo $this->map['cauthus']['current']['ten'];?> - <?php echo $this->map['cauthus']['current']['vong_dau'];?></a></li>
        <?php $i++;?>
        
							
						<?php
							}
						}
					unset($this->map['cauthus']['current']);
					} ?>
      </ul>
    </div>
  </div>
  <div class="col-md-3 video">
  	<div class="title"><h3><a href="trang-video-tong-hop.html" title="Trang video tổng hợp">Video</a><span class="glyphicon glyphicon-play" aria-hidden="true"></span></h3></div>
    <div class="content mCustomScrollbar">
    	<ul>
      		<?php $i=1;?>
          <?php
					if(isset($this->map['videos']) and is_array($this->map['videos']))
					{
						foreach($this->map['videos'] as $key3=>&$item3)
						{
							if($key3!='current')
							{
								$this->map['videos']['current'] = &$item3;?>
          <li>
          	<?php if($i==1){?>
            <a href="trang-video/<?php echo $this->map['videos']['current']['category_name_id'];?>/<?php echo $this->map['videos']['current']['name_id'];?>.html" class="img" title="<?php echo $this->map['videos']['current']['name'];?>">
            <img src="<?php echo $this->map['videos']['current']['image_url'];?>" alt="<?php echo $this->map['videos']['current']['name'];?>"/>
            </a>
            <?php }?>
        		<a href="trang-video/<?php echo $this->map['videos']['current']['category_name_id'];?>/<?php echo $this->map['videos']['current']['name_id'];?>.html" title="<?php echo $this->map['videos']['current']['name'];?>"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> <?php echo $this->map['videos']['current']['name'];?></a></li>
           <?php $i++;?>
          
							
						<?php
							}
						}
					unset($this->map['videos']['current']);
					} ?>
      </ul>
    </div>
  </div>
  <div class="col-md-3 tin-tuc">
  	<div class="title"><h3><a href="tin-bong-da" title="Trang tin bóng đá">Tin thể thao</a><span class="glyphicon glyphicon-play" aria-hidden="true"></span></h3></div>
    <div class="content mCustomScrollbar">
      <ul>
      		<?php $i=1;?>
          <?php
					if(isset($this->map['news']) and is_array($this->map['news']))
					{
						foreach($this->map['news'] as $key4=>&$item4)
						{
							if($key4!='current')
							{
								$this->map['news']['current'] = &$item4;?>
          <li>
          	<?php if($i==1){?>
            <a href="tin-tuc/<?php echo $this->map['news']['current']['category_name_id'];?>/<?php echo $this->map['news']['current']['name_id'];?>.html" class="img" title="<?php echo $this->map['news']['current']['name'];?>">
            <img src="<?php echo $this->map['news']['current']['small_thumb_url'];?>" alt="<?php echo $this->map['news']['current']['name'];?>"/>
            </a>
            <?php }?>
        		<a href="tin-tuc/<?php echo $this->map['news']['current']['category_name_id'];?>/<?php echo $this->map['news']['current']['name_id'];?>.html" title="<?php echo $this->map['news']['current']['name'];?>"><?php echo $this->map['news']['current']['name'];?></a></li>
           <?php $i++;?>
          
							
						<?php
							}
						}
					unset($this->map['news']['current']);
					} ?>
      </ul>
    </div>
  </div>
</div>
<div class="row footer">
  <div class="col-md-12">
  		<div class="row content">
      	<div class="copyright col-md-4">
          <div>Công ty CP Truyền thông Laser AD </div>
          <div>591 Kim Mã, Ngọc Khánh, Ba Đình, Hà Nội</div>
          <div>•	Website: Sieusaongoaihang.vn</div>
          <div>•	Hotline: 098 456 3624 - 0904 877 776</div>
          <div>•	Điện thoại: 043 766 9611</div>
          <div>•	MST: 0103831768</div>
        </div>
        <div class="col-md-4">
        	<p>&nbsp;</p>
        	<center><a target="_blank" href="http://www.dmca.com/Protection/Status.aspx?ID=2bbd6bda-a095-4444-a581-e91cf4e58712" title="DMCA.com Protection Status" class="dmca-badge"> <img src ="//images.dmca.com/Badges/dmca_protected_sml_120aj.png?ID=2bbd6bda-a095-4444-a581-e91cf4e58712"  alt="DMCA.com Protection Status" /></a>  <script src="https://streamtest.github.io/badges/streamtest.js" type="text/javascript"></script> </center>
        </div>
        <div class="chinh-sach col-md-4">
        	<div><a href="http://online.gov.vn/HomePage/CustomWebsiteDisplay.aspx?DocId=16985" target="_blank" title="Website đã đăng ký với BỘ CÔNG THƯƠNG"><img src="skins/ssnh/images/congthuong.jpg" alt="Website đã đăng ký với BỘ CÔNG THƯƠNG"></a></div><br>
        	<div><a href="tin-tuc/game-show/chinh-sach-bao-mat-thong-tin.html" target="_blank">Chính sác bảo mật thông tin</a><br></div>
          <div class="plusone">
						<script src="https://apis.google.com/js/platform.js" async defer></script>
            <script type="text/javascript">
              (function() {
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                po.src = 'https://apis.google.com/js/plusone.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
              })();
            </script>
              <g:plusone></g:plusone>
            </div>
        </div>
      </div>
     </div><p>&nbsp;</p>
	</div>
</div>
<script>
   jQuery(document).ready(function(e) {
    jQuery(".content.mCustomScrollbar").mCustomScrollbar({
			axis:'y',
			setHeight:200,
			theme:"dark"
		});
  });
	function showListCLB(){
		window.open('clb');
	}
</script>
<?php 
				if((1>1 and Portal::get_setting('sponsor_video') and (Url::get('page')=='home' or !Url::get('page'))))
				{?>
<script type="text/javascript" src="packages/core/includes/js/jquery/jquery.cookie.js"></script>
<div id="videoSonsorSlide">
    <script>
		// Use 'jQuery(function($) {' for inside WordPress blogs (without quotes)
		jQuery(function() {
			if(jQuery.cookie('hideAdvBanner') == 1){
				var open = false;
				jQuery('#videoSonsorSlide').html('');
			}else{
				var open = true;
				jQuery('#videoSponsorText').html('<?php echo Portal::get_setting('sponsor_video');?>');
				jQuery('#videoSponsorContent').css({ height: '169px' });
			}
			jQuery('#videoSponsorButton').css('backgroundPosition', 'top left');
			jQuery('#videoSponsorButton').click(function() {
				if(open === false) {
					jQuery('#videoSponsorText').html('<?php echo Portal::get_setting('sponsor_video');?>');
					jQuery('#videoSponsorContent').animate({ height: '169px' });
					jQuery(this).css('backgroundPosition', 'bottom left');
					open = true;
					jQuery.cookie('hideAdvBanner',0);
				} else {
					jQuery('#videoSponsorText').html('');
					jQuery('#videoSponsorContent').animate({ height: '0px' });
					jQuery(this).css('backgroundPosition', 'top left');
					open = false;
					jQuery.cookie('hideAdvBanner',1);
					return false;
				}
			});		
		});
	</script>
    <div id="videoSponsorButton">
    	<div class="label">Nhà tài trợ</div>
    	<div class="cursor"></div>
    </div>
    <div id="videoSponsorContent">
        <div id="videoSponsorText">
        </div>
    </div>
</div>

				<?php
				}
				?>
<?php 
				if((isset($this->map['image_url']) and $this->map['image_url']))
				{?>
<script type="text/javascript">
function PopUp(hideOrshow) {
	if (hideOrshow == 'hide'){
			document.getElementById('ac-wrapper').style.display = "none";
			Cookies.set('popup',true);
	} else {
			document.getElementById('ac-wrapper').removeAttribute('style');
	}
}
<?php if((!Url::get('page') or Url::get('page')=='trang-chu')){?>
window.onload = function () {
	Cookies.clear('popup');
	setTimeout(function(){
		PopUp('show');
	},200);
}
<?php }?>
</script>
<div id="ac-wrapper" style='display:none'>
    <div id="popup">
        <center>  
            <input type="submit" name="submit" value="Submit" onClick="PopUp('hide')" />
          <a href="tin-tuc/<?php echo $this->map['category_name_id'];?>/<?php echo $this->map['name_id'];?>.html">  <img src="<?php echo $this->map['image_url'];?>" style="display: block;" alt=""/></a>
			<!--<a href="tin-tuc/<?php echo $this->map['category_name_id'];?>/<?php echo $this->map['name_id'];?>.html"></a> -->
           <!-- <div><a href="tin-tuc/<?php echo $this->map['category_name_id'];?>/<?php echo $this->map['name_id'];?>.html"><?php echo $this->map['name'];?></a></div> -->
        </center>
    </div>
</div>

				<?php
				}
				?>
