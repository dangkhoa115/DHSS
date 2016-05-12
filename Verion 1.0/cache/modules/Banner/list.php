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
	},1000);
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
<div class="row">
	<div class="col-md-12">
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
                   <a href="tong-hop.html">Trang cá nhân</a><a href="nap_igold.html" class="igold"><span id="igold1"><?php echo iGold::get_igold(Session::get('user_id'));?></span> <img src="skins/ssnh/images/igold_16_text.png" alt=""></a><a href="ssnh_shop.html" class="shop">SHOP</a><a href="ssnh_shop/your_item.html" class="shop your-item">item của bạn</a><?php echo User::can_add(MODULE_NEWSADMIN,ANY_CATEGORY)?'<a href="?page=news_admin">Quản trị</a><a href="tong-hop.html">Trang người chơi</a>':'<a href="tham-gia-binh-chon.html">Tham gia bình chọn</a>'?><a href="dang-tin.html" class="viet-bai"> <span class="glyphicon glyphicon-file" aria-hidden="true"></span>Viết bài</a><a href="?page=sign_out" class="log-out">Thoát</a>
                </div>
                 <?php }else{ ?>
                <div class="col-md-12" align="right">
                	<form name="BannerForm" method="post" action="dang-nhap.html" class="form-inline">
                  <div class="form-group">
                    <label for="user_id">Tên đăng nhập hoặc email</label>
                    <input  name="user_id" id="user_id" class="form-control"/ type ="text" value="<?php echo String::html_normalize(URL::get('user_id'));?>">
                    <label for="password">Mật khẩu</label>
                    <input  name="password" id="password" class="form-control"/ type ="password" value="<?php echo String::html_normalize(URL::get('password'));?>">
                    <input type="submit" name="" value="Đăng nhập" class="button small round" style="height:23px"/>
                    <a rel="nofollow" class="button round small warning" href="register.html">Đăng ký</a>
                  </div>
                  <a rel="nofollow" href="quen-mat-khau-html">Quên mật khẩu?</a>
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
    <div class="navbar navbar-default">
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
    <div class="banner">
        <div class="main">
            <div class="logo-ntt"><a href="" title="Trang chủ"><img id="logo" src="skins/ssnh/images/logo_1.png" alt=""/></a></div>
            <div class="logo" onclick="window.location=''" style="cursor:pointer;" title="Trang chủ"></div>
            <div class="search">
                <p class="time">Hôm nay, ngày <?php echo date('d');?> tháng <?php echo date('m');?> năm <?php echo date('Y');?></p>
                <div class="main-search group-input">
                	<form name="SearchBannerForm" method="post">
                    <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm" class="form-control"/>
                    <input type="submit" name="" value="OK" class="btn btn-primary"/>
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
    </div><!--End .banner-->
    <div class="logo-clb center">
        <div class="foollbar"></div>
        <ul class="logo-list center">
          <?php
					if(isset($this->map['clbs']) and is_array($this->map['clbs']))
					{
						foreach($this->map['clbs'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['clbs']['current'] = &$item1;?>
          <li><a href="clb/<?php echo $this->map['clbs']['current']['name_id'];?>.html" title="<?php echo $this->map['clbs']['current']['ten'];?>"><img src="<?php echo $this->map['clbs']['current']['logo'];?>" alt="<?php echo $this->map['clbs']['current']['ten'];?>" /></a></li>
          
							
						<?php
							}
						}
					unset($this->map['clbs']['current']);
					} ?>
        </ul>
    </div><!--End .logo-clb-->
    <div class="table-competition">
      <ul>
          <?php
					if(isset($this->map['trandaus']) and is_array($this->map['trandaus']))
					{
						foreach($this->map['trandaus'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['trandaus']['current'] = &$item2;?>
            <li>
                <div class="date"><?php echo $this->map['trandaus']['current']['thoi_gian_ngay'];?> - <?php echo $this->map['trandaus']['current']['thoi_gian_gio'];?>'</div>
                <div class="matchName" title="<?php echo $this->map['trandaus']['current']['doi_chu_nha'];?> vs <?php echo $this->map['trandaus']['current']['doi_khach'];?>">
                    <span><?php echo $this->map['trandaus']['current']['ma_doi_chu_nha'];?></span> 
                      <?php 
				if(($this->map['trandaus']['current']['ket_qua']))
				{?>
                    <span class="ket-qua"><?php echo $this->map['trandaus']['current']['ket_qua'];?></span>
                     <?php }else{ ?>
                    <span class="separator">v</span>
                    
				<?php
				}
				?>
                     <span><?php echo $this->map['trandaus']['current']['ma_doi_khach'];?></span>
                </div>
            </li>
            
							
						<?php
							}
						}
					unset($this->map['trandaus']['current']);
					} ?>
      </ul>
    </div>
   </div>
</div>
<div class="row navinformation">
    <div class="col-md-6">
    	<?php Module::get_sub_regions("top_banner_adv");?>
    </div>
    <div class="col-md-6">
    	<?php Module::get_sub_regions("top_banner_adv_02");?>
    </div>
</div><!--End .navinformation-->
<style>
.float-adv.left {
	display:none;
	width: 130px; /* Replace with your sidebar width */
	position: absolute;
	top:254px;
}
.float-adv.right{
	display:none;	
	width: 130px;
	position: fixed;
	right:0px;
	top:254px;	
}
</style>
<div class="float-adv left"><?php Module::get_sub_regions("float_adv_left");?></div>
<div class="float-adv right"><?php Module::get_sub_regions("float_adv_right");?></div>
<script type="text/javascript">
var images = new Array ('skins/ssnh/images/logo_1.png', 'skins/ssnh/images/logo_1.png');
var index = 1;
function rotateImage(){
  jQuery('#logo').fadeOut('fast', function(){
    jQuery(this).attr('src', images[index]);
    jQuery(this).slideDown('normal', function(){
      if (index == images.length-1){
        index = 0;
      }else{
        index++;
      }
    });
  });
}
jQuery(function() {
	// Set this variable with the desired height
	var offsetPixels = 0; 
	var offsetLeft = jQuery('.navbar').offset().left - 131;
	var offsetRight = jQuery('.navbar').offset().left + jQuery('.navbar').width()+1;
	jQuery( ".float-adv.left" ).css({
		"display":"block",
		"position": "fixed",
		"top": "254px",
		"left":offsetLeft
	});
	jQuery( ".float-adv.right" ).css({
		"display":"block",		
		"position": "fixed",
		"top": "254px",
		"left":offsetRight
	});
	jQuery(window).scroll(function() {
		if (jQuery(window).scrollTop() > offsetPixels) {
			jQuery( ".float-adv.left" ).css({
				"position": "fixed",
				"top": "35px",
				"left":offsetLeft
			});
			jQuery( ".float-adv.right" ).css({
				"position": "fixed",
				"top": "35px",
				"left":offsetRight
			});
		} else {
			jQuery( ".float-adv" ).css({
				"position": "absolute",
				"top": "255px"
			});
		}
	});
	setInterval (rotateImage, 10000);
});
</script>