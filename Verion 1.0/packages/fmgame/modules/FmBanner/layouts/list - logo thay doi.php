<script>
  /*window.fbAsyncInit = function() {
    FB.init({
      appId      : '1612685782280827',
      xfbml      : true,
      version    : 'v2.3'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));*/
</script>
<!--IF:cond(isset([[=image_url=]]) and [[=image_url=]])-->
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
          <a href="tin-tuc/[[|category_name_id|]]/[[|name_id|]].html">  <img src="[[|image_url|]]" style="display: block;" alt=""/></a>
			<!--<a href="tin-tuc/[[|category_name_id|]]/[[|name_id|]].html"></a> -->
           <!-- <div><a href="tin-tuc/[[|category_name_id|]]/[[|name_id|]].html">[[|name|]]</a></div> -->
        </center>
    </div>
</div>
<!--/IF:cond-->
<div class="row">
	<div class="col-xs-12">
    <div class="row">
    <div class="col-xs-12">
			<div class="top-line grey-gradient navbar-fixed-top">
          <div class="col-xs-5">
            <div class="left">
            	<!--IF:login_cond(User::is_login())-->
             Xin chào: <a href="tong-hop.html"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $_SESSION['user_data']['full_name'];?> / <?php echo Session::get('user_id');?></a>
              <!--/IF:login_cond--> 
            </div>
          </div>
          <div class="col-xs-7">
            <div class="right">
              <div class="row">
                <!--IF:login_cond(User::is_login())-->
                <div class="user-name col-xs-12">
                   <a href="tong-hop.html">Trang cá nhân</a><a href="nap_igold.html" class="igold"><span id="igold1"><?php echo iGold::get_igold(Session::get('user_id'));?></span> <img src="skins/ssnh/images/igold_16_text.png" alt=""></a><a href="ssnh_shop.html" class="shop">SHOP</a><a href="ssnh_shop/your_item.html" class="shop your-item">item của bạn</a><?php echo User::can_add(MODULE_NEWSADMIN,ANY_CATEGORY)?'<a href="?page=news_admin">Quản trị</a><a href="tong-hop.html">Trang người chơi</a>':'<a href="tham-gia-binh-chon.html">Tham gia bình chọn</a>'?><a href="dang-tin.html" class="viet-bai"> <span class="glyphicon glyphicon-file" aria-hidden="true"></span>Viết bài</a><a href="?page=sign_out" class="log-out">Thoát</a>
                </div>
                <!--ELSE-->
                <div class="col-xs-12" align="right">
                	<form name="FmBannerForm" method="post" action="dang-nhap.html" class="form-inline">
                  <div class="form-group">
                    <label for="user_id">Tên đăng nhập hoặc email</label>
                    <input name="user_id" type="text" id="user_id" class="form-control"/>
                    <label for="password">Mật khẩu</label>
                    <input name="password" type="password" id="password" class="form-control"/>
                    <input type="submit" name="" value="Đăng nhập" class="button small round" style="height:23px"/>
                    <a rel="nofollow" class="button round small warning" href="register.html">Đăng ký</a>
                  </div>
                  <a rel="nofollow" href="quen-mat-khau-html">Quên mật khẩu?</a>
                  </form> 
                </div>
                <!--/IF:login_cond--> 
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
            [[|item_ul_categories|]]
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
                	<form name="SearchFmBannerForm" method="post">
                    <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm" class="form-control"/>
                    <input type="submit" name="" value="OK" class="btn btn-primary"/>
                  </form>
                </div>
            </div><!--End .search-->
            <!--IF:countdown_cond([[=show_countdown=]])-->
            <div class="countdown [[|class|]]">
              <span class="title">[[|thong-bao-sms|]]</span>
              <script type="application/javascript">
              var myCountdown1 = new Countdown({
              time: [[|second|]], // 86400 seconds = 1 day
              width:180, 
              height:38,  
              rangeHi:"day",
              style:"flip"	// <- no comma on last item!
              });
            </script>
            </div> <!--End .countdown-->
            <!--/IF:countdown_cond-->
        </div>
    </div><!--End .banner-->
    <div class="logo-clb center">
        <div class="foollbar"></div>
        <ul class="logo-list center">
          <!--LIST:clbs-->
          <li><a href="clb/[[|clbs.name_id|]].html" title="[[|clbs.ten|]]"><img src="[[|clbs.logo|]]" alt="[[|clbs.ten|]]" /></a></li>
          <!--/LIST:clbs-->
        </ul>
    </div><!--End .logo-clb-->
    <div class="table-competition">
      <ul>
          <!--LIST:trandaus-->
            <li>
                <div class="date">[[|trandaus.thoi_gian_ngay|]] - [[|trandaus.thoi_gian_gio|]]'</div>
                <div class="matchName" title="[[|trandaus.doi_chu_nha|]] vs [[|trandaus.doi_khach|]]">
                    <span>[[|trandaus.ma_doi_chu_nha|]]</span> 
                      <!--IF:cond([[=trandaus.ket_qua=]])-->
                    <span class="ket-qua">[[|trandaus.ket_qua|]]</span>
                    <!--ELSE-->
                    <span class="separator">v</span>
                    <!--/IF:cond-->
                     <span>[[|trandaus.ma_doi_khach|]]</span>
                </div>
            </li>
            <!--/LIST:trandaus-->
      </ul>
    </div>
   </div>
</div>
<div class="row navinformation">
    <div class="col-xs-6">
    	[[--top_banner_adv--]]
    </div>
    <div class="col-xs-6">
    	[[--top_banner_adv_02--]]
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
<div class="float-adv left">[[--float_adv_left--]]</div>
<div class="float-adv right">[[--float_adv_right--]]</div>
<script type="text/javascript">
var images = new Array ('skins/ssnh/images/logo_1.png', 'skins/ssnh/images/logo_2.png');
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
