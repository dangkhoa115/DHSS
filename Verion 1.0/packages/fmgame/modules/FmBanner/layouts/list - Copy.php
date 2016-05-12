<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '507319962772216',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div class="row">
	<div class="col-xs-12">
    <div class="row">
   	 <div class="col-xs-12">
			<div class="top-line top-bg navbar-fixed-top">
          <div class="col-xs-4">
            <div class="left">
            <a href="/"><img src="skins/fmgame/images/logo.png" class="top-logo" height="30" alt="Starteam"> FANTASY PHONG CÁCH VIỆT / Bản thử ngiệm</a>
            <!--<div
              class="fb-like"
              data-share="true"
              data-width="80"
              data-show-faces="false">
            </div>-->	
            </div>
          </div>
          <div class="col-xs-8">
            <div class="right">
              <div class="row">
                <!--IF:login_cond(User::is_login())-->
                <div class="user-name col-xs-12">
                	<a href="trang-ca-nhan-dhss.html" class="username">HLV: <strong>[[|full_name|]]</strong></a> <a href="trang-ca-nhan-dhss.html">ID: <?php echo Session::get('user_id');?></a>
                  <a href="tin-nhan.html" class="message <?php echo [[=number_message=]]?'unread':'';?>" title="[[|new_message|]]">Tin nhắn <span id="message" class="badge">[[|number_message|]]</span></a>
                 <a href="nap_igold_dhss.html" class="igold"><span id="igold1"><?php echo iGold::get_igold(Session::get('user_id'));?></span> <img src="skins/ssnh/images/igold_16_text.png" alt=""></a>
                 <a href="nap_igold_dhss.html" class="shop">Nạp iGold</a>
                 <a href="?page=fmg_shop" class="shop">SHOP</a>
                <!-- <a href="ssnh_shop/your_item.html" class="shop your-item">item của bạn</a>-->
                 <a href="thoat.html?href=dhss-dang-nhap.html" class="log-out">Thoát</a>
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
                    <a rel="nofollow" class="button round small warning" href="dang-ky-dhss.html">Đăng ký</a>
                  </div>
                  <a rel="nofollow" href="quen-mat-khau-html">Quên mật khẩu?</a>
                  </form> 
                </div>
                <!--/IF:login_cond--> 
              </div>
           </div>
          </div>
      	</div>
        <div class="main-menu" id="mainMenu">
         <a class="close" title="Thu nhỏ Menu" href="#" onClick="CloseMainMenu();return false;">X</a>
         <a class="open" title="Mở rộng Menu" href="#" onClick="OpenMainMenu();return false;"><img src="skins/ssnh/images/fm_game/menu/menuicon.png" width="30" height="30" alt=""/></a>
        	<ul class="icon-set">
          	<li <?php echo (Url::get('page')=='fmg_team' and Url::get('act')!='transfer')?'class="active"':'';?>>
            	<a class="hvr-bob" href="dhss">
              	<img src="skins/fmgame/images/football/doi_cua_toi.png">
              	<label>Đội của tôi</label>
              </a>
            </li>
           	<li <?php echo (Url::get('act')=='transfer')?'class="active"':'';?>>
            	<a class="hvr-bob" href="?page=fmg_team&do=edit_team&act=transfer">
              	<img src="skins/fmgame/images/football/chuyen_nhuong.png">
              	<label>Chuyển nhượng</label>
              </a>
            </li>
            <li <?php echo (Url::get('page')=='fmg_schedule' and !Url::get('lien-dau'))?'class="active"':'';?>>
            	<a class="hvr-bob" href="?page=fmg_schedule">
              	<img src="skins/fmgame/images/football/lich_thi_dau.png">
                <img class="hot-icon" src="skins/ssnh/images/fm_game/icon_hot.gif" alt="Lịch thi đấu">
                
              	<label>Giải đấu</label>
              </a>
            </li>
            <li <?php echo (Url::get('page')=='bang-xep-hang' and !Url::get('lien-dau'))?'class="active"':'';?>>
            	<a class="hvr-bob" href="bang-xep-hang.html">
              	<img src="skins/fmgame/images/football/old/football84.png">
              	<label>Bảng xếp hạng</label>
              </a>
            </li>
            <li <?php echo (Url::get('page')=='fmg_schedule' and  Url::get('lien-dau'))?'class="active"':'';?>>
            	<a class="hvr-bob" href="?page=fmg_schedule&lien-dau=1">
              	<img src="skins/fmgame/images/football/lien_dau.png">
              	<label>Liên đấu</label>
              </a>
            </li>
            <li <?php echo (Url::get('page')=='fmg_champions')?'class="active"':'';?>>
            	<a class="hvr-bob" href="?page=fmg_champions">
              	<img src="skins/fmgame/images/football/nha_vo_dich.png">
              	<label>Đội chiến thắng</label>
              </a>
            </li>
            <li <?php echo (Url::get('page')=='fmg_thach_dau')?'class="active"':'';?>>
            	<a class="hvr-bob" href="?page=fmg_thach_dau">
              	<img src="skins/fmgame/images/football/thi_dau.png">
              	<label>Thách đấu</label>
              </a>
            </li>
            <li>
            	<a class="hvr-bob" href="?page=fmg_giai_phu">
              	<img src="skins/ssnh/images/fm_game/win.png" alt="Giải phụ">
              	<label>Giải phụ</label>
              </a>
            </li>
            <li>
            	<a class="hvr-bob" href="?page=fmg_top_hlv" title="TOP HLV xuất sắc nhất">
              	<img src="skins/fmgame/images/football/old/football95.png" alt="FB">
              	<label>Top HLV</label>
              </a>
            </li>
            <li>
            	<a class="hvr-bob" href="?page=game-list" title="Chơi mini games">
              	<img src="skins/ssnh/images/fm_game/menu/game.png" alt="Mini Games">
              	<label>Mini Games</label>
              </a>
            </li>
          </ul>
        </div>
        <!--IF:cond(Url::get('page')!='nap_igold_dhss')-->
        <div style="position:fixed;left:0px;bottom:0px;z-index:1;border-top:2px solid #000;border-radius:0px 15px 0px 0px;overflow:hidden;"><a href="nap_igold_dhss.html" title="Nap iGold"><img src="skins/ssnh/images/fm_game/km_napthe.png" alt="Nạp thẻ lần đầu"></a></div>
        <!--/IF:cond-->
      </div>
    </div>
   </div>
   <div class="cssload-container"><div class="cssload-whirlpool"></div></div>
</div>
<div class="ad-anouncement">
	<img src="skins/ssnh/images/fm_game/ad_anounce.png" alt="Thông báo từ Admin">
  Quy định mới: <a href="#" class="hvr-bob" data-toggle="modal" data-target="#quyen_loi_hlv"> >> Đọc ngay để biết quyền lợi của các HLV</a>
	<!--<marquee onMouseOver="this.stop();" onMouseOut="this.start();">
  	<div class="hide">&bull; Giải phụ đang diễn ra, các bạn hãy nhấn vào menu <strong>Giải phụ</strong> để theo dõi kết quả!</div>
  	<div class="hide">&bull; Mời bạn <a href="?page=fmg_giai_phu&do=dang_ky"><strong>ĐĂNG KÝ</strong></a> giải đấu phụ diễn ra vào lúc 15h ngày 14/01/2016 |</div>
    	&bull; Lịch thi đấu đã có chính thức với 44 bảng thi đấu. Mời các HLV vào lịch thi đấu để cập nhật. |
   <div class="hide"> &bull; Xin chúc mừng chức vô địch Liên đấu đã thuộc về đội bóng LIMO F.C!!! | </div>
    <div class="hide">***Vòng liên đấu đang diễn ra vô cùng hấp dẫn và làm một trong những vòng khó dự đoán nhất từ trước tới nay ***</div>
    &bull; Các HLV được giải của tuần trước vui lòng chụp màn hình gửi vào Facebook của Đội hình siêu sao theo tab "Đội của tôi" để BTC xác nhận và trao giải!
  </marquee>-->
</div>
<!-- FLOATING CHAT -->
<div class="livechat">
<a href="#" class="hvr-bob" data-toggle="modal" data-target="#livechat" title="Các HLV trao đổi chuyên môn"><img src="skins/ssnh/images/fm_game/chat_box.png" alt="Chat box"></a></div>
<div class="modal fade" id="livechat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#f00;">&times;</span></button>
        <a href="#" onClick="jQuery('#chatFrame').html(jQuery('#chatFrame').html());return false" class="btn btn-success btn-sm refesh"> Làm mới </a>
        <h4 class="modal-title" id="myModalLabel"> Các HLV trao đổi chuyên môn</h4>
      </div>
      <div class="modal-body">
        <div id="chatFrame">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=1612685782280827&version=v2.3";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-comments" data-href="http://doihinhsieusao.com" data-version="v2.3" data-numposts="5" data-colorscheme="light" data-width="100%"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="quyen_loi_hlv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#f00;">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> QUYỀN LỢI CÁC HUẤN LUYỆN VIÊN CẦN CHÚ Ý</h4>
      </div>
      <div class="modal-body" style="color:#000;">
      	<ul>
        	<li>Huấn luyện viên hạng Chuyên nghiệp trở lên mới được nhận 2 iGold khi điểm danh. </li>
          <li>Huấn luyện viên hạng Ngoại hạng sẽ có thêm 1 lượt chuyển nhượng. </li>
          <li>Huấn luyện viên phải chăm sóc đội bóng bằng cách tập luyện để tăng <strong>Điểm tập luyện</strong>. Mỗi ngày sẽ tăng 10% <strong>Điểm tập luyện</strong> (Tối đa 100%). Nếu <strong>Điểm tập luyện</strong> < 10% sẽ không được tham gia thi đấu khi mùa giải mới bắt đầu . </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<!--IF:cond(![[=da_dang_ky_giai_phu=]])-->
<div id="ac-wrapper" style='display:none'>
    <div id="popup">
    		<input class="close" type="submit" name="submit" value="Submit" onClick="PopUp('hide')" />
        <center> 
          <a href="?page=fmg_giai_phu&do=xn_dang_ky"><img src="skins/ssnh/images/fm_game/DANG_KY_Giai_phu.jpg" alt="Đăng ký giải phụ"></a>
        </center>
    </div>
</div>
<!--/IF:cond-->
<script src="skins/ssnh/scripts/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="skins/ssnh/scripts/jBeep/jBeep.min.js" type="text/javascript"></script>
<script type="text/javascript">
<?php if(1>1 and (FMGAME::my_team_id() == true and User::is_login() and ![[=da_dang_ky_giai_phu=]] and (!Url::get('page') or Url::get('page')=='fmg_team'))){?>
function PopUp(hideOrshow) {
	if (hideOrshow == 'hide'){
			document.getElementById('ac-wrapper').style.display = "none";
			Cookies.set('popup',true);
	} else {
			document.getElementById('ac-wrapper').removeAttribute('style');
	}
}
window.onload = function () {
	Cookies.clear('popup');
	setTimeout(function(){
		PopUp('show');
	},1000);
}
<?php }?>
jQuery(document).ready(function(e) {	
	CloseMainMenu();
	jQuery("body").on("contextmenu",function(){
		//return false;
	});
  update_message();
	if(Cookies.get('closeChatFrame')==1){
		jQuery('#closeChat').html('+');
		jQuery('#chatFrame').hide();
	}
});
var timer = setInterval("update_message()",30000);
function update_message(){
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			'do':'count_message'
		},
		beforeSend: function(){
			
		},
		success: function(content){
			obj = jQuery('#message');
			obj.html(content);
			if(to_numeric(content)>0){
								obj.addClass( "badge big", 1000, "easeOutBounce",function(){obj.removeClass('big',1000,"easeOutBounce")});
				jBeep('skins/ssnh/media/ding_ding.wav');
			}
		},
		error: function(){
			//alert('Lỗi...Bạn vui lòng kiểm tra lại kết nối!');
		}
	});
}
//alert(Cookies.get('closeChatFrame'));
function myToogle(){
	jQuery('#chatFrame').toggle(1000,false,function(){
		if(jQuery('.close').html() == '+'){
			jQuery('.close').html('-');
			Cookies.set('closeChatFrame',0);
		}else{
			jQuery('.close').html('+');
			Cookies.set('closeChatFrame',1);
		}
	}) ;
}
function CloseMainMenu(){
	jQuery( "#mainMenu" ).animate({
			opacity: 1,
			width: "40px",
			height: "40px",
			padding:"10px"
		}, 100, function() {
			jQuery('.icon-set').hide();
			jQuery('.close').hide();
			jQuery('.open').fadeIn();
		});
}
function OpenMainMenu(){
	jQuery( "#mainMenu" ).animate({
			opacity: 1,
			width: "100%",
			height: "100%",
			padding:"50px"
		},100, function() {
			jQuery('.icon-set').fadeIn();
			jQuery('.open').hide();
			jQuery('.close').show();			
		});
}
</script>