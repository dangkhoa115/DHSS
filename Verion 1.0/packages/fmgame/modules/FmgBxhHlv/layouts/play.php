<div class="row">
  <div class="col-xs-12 ket-qua-tran-dau">
  	<div class="row">
    	<div class="col-xs-6 center">
      <center><div class="ten-doi">[[|cn_ten|]]</div></center>
        <!-- Thong so cua doi -->
        <div class="alert">
          <div class="row">
            <div class="col-xs-6">
              <div class="alert sub-alert">
                <div class="row">
                  <div class="col-xs-4">Power:</div>
                  <div class="col-xs-8"><div class="power"><span style="width:<?php echo ([[=cn_tong_diem=]]/150)*100;?>%;">[[|cn_tong_diem|]]</span>&nbsp;</div></div>
                </div>
              </div>
              <div class="alert sub-alert">
                <div class="row">
                  <div class="col-xs-4">PĐ:</div>
                  <div class="col-xs-8">
                  [[|phong_do_cn|]]
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="alert sub-alert">
                <div class="row phong-ngu">
                  <div class="col-xs-4">P.Ngự:</div>
                  <div class="col-xs-8"><div class="power"><span style="width:<?php echo ([[=phong_ngu_cn=]]/150)*100;?>%;">[[|phong_ngu_cn|]]</span>&nbsp;</div></div>
                </div>
              </div>
              <div class="alert sub-alert">
                <div class="row tan-cong">
                  <div class="col-xs-4">T.Công:</div>
                  <div class="col-xs-8"><div class="power"><span style="width:<?php echo ([[=tan_cong_cn=]]/150)*100;?>%;">[[|tan_cong_cn|]]</span>&nbsp;</div></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end thong so cua doi -->
    	</div>
      <div class="col-xs-6 center">
      	<center><div class="ten-doi">[[|kh_ten|]]</div></center>
        <!-- Thong so cua doi -->
        <div class="alert">
          <div class="row">
            <div class="col-xs-6">
              <div class="alert sub-alert">
                <div class="row">
                  <div class="col-xs-4">Power:</div>
                  <div class="col-xs-8"><div class="power"><span style="width:<?php echo ([[=kh_tong_diem=]]/150)*100;?>%;">[[|kh_tong_diem|]]</span>&nbsp;</div></div>
                </div>
              </div>
              <div class="alert sub-alert">
                <div class="row">
                  <div class="col-xs-4">PĐ:</div>
                  <div class="col-xs-8">
                  [[|phong_do_kh|]]
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="alert sub-alert">
                <div class="row phong-ngu">
                  <div class="col-xs-4">P.Ngự:</div>
                  <div class="col-xs-8"><div class="power"><span style="width:<?php echo ([[=phong_ngu_kh=]]/150)*100;?>%;">[[|phong_ngu_kh|]]</span>&nbsp;</div></div>
                </div>
              </div>
              <div class="alert sub-alert">
                <div class="row tan-cong">
                  <div class="col-xs-4">T.Công:</div>
                  <div class="col-xs-8"><div class="power"><span style="width:<?php echo ([[=tan_cong_kh=]]/150)*100;?>%;">[[|tan_cong_kh|]]</span>&nbsp;</div></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end thong so cua doi -->
     	</div>
    </div>
  </div>
	<div class="col-xs-12">
  	<!--IF:cond([[=trang_thai=]]=='PENDDING')-->
  	<div class="thoi-gian-thi-dau">
    	Thi đấu vào lúc: [[|thoi_gian|]]
      <div id="timer">
      	<div class="countdown">
          <center>
						<script type="application/javascript">
            var myCountdown1 = new Countdown({
							time: [[|time|]], // 86400 seconds = 1 day
							width:180, 
							height:38,  
							rangeHi:"day",
							onComplete: function(){window.document.location = '<?php echo Url::build_current(array('do','dcn_id','dkh_id','vong_dau_id'));?>'},
							style:"flip"	// <- no comma on last item!
            });
            </script>
        	</center>
        </div> <!--End .countdown-->
      </div>
    </div>
    <!--/IF:cond-->
    <!--IF:cond([[=trang_thai=]]=='PLAYING')-->
  	<div id="processing-bar">
      <div id="progress_bar" class="ui-progress-bar ui-container">
        <div class="ui-progress" style="width: 100%;position:absolute;">
          <span class="ui-label" style="display:none;"><!--<b class="value">100%</b>--><img src="skins/ssnh/images/fm_game/soccer_player_animated.gif" height="30" alt=""/></span>
        </div>
      </div>
    </div>
    <!--/IF:cond-->
    <div class="svd">
        <div class="col-xs-6" id="doi_chu_nha">
        	<div class="du-bao cn">
          	Tỷ lệ chiến thắng:<br><span>[[|ty_le_thang_cn|]]%</span>
          </div>
        	<?php echo ([[=kq=]]=='Hòa')?'<div class="hoa">Hòa</div>':(([[=kq=]]=='Thắng')?'<div class="win"><img src="skins/ssnh/images/fm_game/win.png" alt="Winner"></div>':'');?>
        	<div class="logo"><img src="[[|cn_logo|]]" alt="[[|cn_ten|]]" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></div>
        	<table class="col">
            <!--LIST:cn_thu_mon-->
            	<tr>
              <td>
                  <div class="m-player-o">
                      <div class="img"><img src="[[|cn_thu_mon.anh_dai_dien|]]"/></div>
                      <span class="nub">[[|cn_thu_mon.so_ao|]]</span>
                      <p class="text">
                          <span class="name">[[|cn_thu_mon.ten|]]</span>
                      </p>
                      <span class="total">[[|cn_thu_mon.diem|]]</span>
                      <!--IF:cond_captain([[=cn_thu_mon.captain=]])-->
                      <a class="captain" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      <!--/IF:cond_captain-->
                  </div>
              </td>
              </tr>
             <!--/LIST:cn_thu_mon-->
          </table>
          <table class="col">
              <!--LIST:cn_hau_ve-->
              <tr valign="middle"><td>
                  <div class="m-player-o">
                      <div class="img"><img src="[[|cn_hau_ve.anh_dai_dien|]]"/></div>
                      <span class="nub">[[|cn_hau_ve.so_ao|]]</span>
                      <p class="text">
                          <span class="name">[[|cn_hau_ve.ten|]]</span>
                      </p>
                      <span class="total">[[|cn_hau_ve.diem|]]</span>
                      <!--IF:cond_captain([[=cn_hau_ve.captain=]])-->
                      <a class="captain vs" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      <!--/IF:cond_captain-->
                  </div><!--End .m-player-->
              </td></tr>
             <!--/LIST:cn_hau_ve-->
          </table>
           <table class="col">
             <!--LIST:cn_tien_ve-->
              <tr><td>
                  <div class="m-player-o">
                      <div class="img"><img src="[[|cn_tien_ve.anh_dai_dien|]]"/></div>
                      <span class="nub">[[|cn_tien_ve.so_ao|]]</span>
                      <p class="text">
                          <span class="name">[[|cn_tien_ve.ten|]]</span>
                      </p>
                      <span class="total">[[|cn_tien_ve.diem|]]</span>
                      <!--IF:cond_captain([[=cn_tien_ve.captain=]])-->
                      <a class="captain vs" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      <!--/IF:cond_captain-->
                  </div><!--End .m-player-->
              </td></tr>
             <!--/LIST:cn_tien_ve-->
         </table>
         <table class="col">
              <!--LIST:cn_tien_dao-->
              <tr><td>
                  <div class="m-player-o">
                      <div class="img"><img src="[[|cn_tien_dao.anh_dai_dien|]]"/></div>
                      <span class="nub">[[|cn_tien_dao.so_ao|]]</span>
                      <p class="text">
                          <span class="name">[[|cn_tien_dao.ten|]]</span>
                      </p>
                      <span class="total">[[|cn_tien_dao.diem|]]</span>
                      <!--IF:cond_captain([[=cn_tien_dao.captain=]])-->
                      <a class="captain vs" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      <!--/IF:cond_captain-->
                  </div><!--End .m-player-->
              </td></tr>
             <!--/LIST:cn_tien_dao-->
          </table>
        </div>
        <div class="col-xs-6" id="doi_khach">
        	<div class="du-bao kh">
          	Tỷ lệ chiến thắng:<br><span>[[|ty_le_thang_kh|]]%</span>
          </div>
        	<?php echo ([[=kq=]]=='Hòa')?'':(([[=kq=]]=='Thua')?'<div class="win"><img src="skins/ssnh/images/fm_game/win.png" alt="Winner"></div>':'');?>
       	 <div class="logo"><img src="[[|kh_logo|]]" alt="[[|kh_ten|]]" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></div>
        	<table class="col">
              <!--LIST:kh_tien_dao-->
              <tr><td>
                  <div class="m-player-o">
                      <div class="img"><img src="[[|kh_tien_dao.anh_dai_dien|]]"/></div>
                      <span class="nub">[[|kh_tien_dao.so_ao|]]</span>
                      <p class="text">
                          <span class="name">[[|kh_tien_dao.ten|]]</span>
                      </p>
                      <span class="total">[[|kh_tien_dao.diem|]]</span>
                      <!--IF:cond_captain([[=kh_tien_dao.captain=]])-->
                      <a class="captain vs" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      <!--/IF:cond_captain-->
                  </div><!--End .m-player-->
              </td></tr>
             <!--/LIST:kh_tien_dao-->
          </table>
          <table class="col">
             <!--LIST:kh_tien_ve-->
              <tr><td>
                  <div class="m-player-o">
                      <div class="img"><img src="[[|kh_tien_ve.anh_dai_dien|]]"/></div>
                      <span class="nub">[[|kh_tien_ve.so_ao|]]</span>
                      <p class="text">
                          <span class="name">[[|kh_tien_ve.ten|]]</span>
                      </p>
                      <span class="total">[[|kh_tien_ve.diem|]]</span>
                      <!--IF:cond_captain([[=kh_tien_ve.captain=]])-->
                      <a class="captain vs" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      <!--/IF:cond_captain-->
                  </div><!--End .m-player-->
              </td></tr>
             <!--/LIST:kh_tien_ve-->
         </table>
          <table class="col">
              <!--LIST:kh_hau_ve-->
              <tr valign="middle"><td>
                  <div class="m-player-o">
                      <div class="img"><img src="[[|kh_hau_ve.anh_dai_dien|]]"/></div>
                      <span class="nub">[[|kh_hau_ve.so_ao|]]</span>
                      <p class="text">
                          <span class="name">[[|kh_hau_ve.ten|]]</span>
                      </p>
                      <span class="total">[[|kh_hau_ve.diem|]]</span>
                      <!--IF:cond_captain([[=kh_hau_ve.captain=]])-->
                      <a class="captain vs" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      <!--/IF:cond_captain-->
                  </div><!--End .m-player-->
              </td></tr>
             <!--/LIST:kh_hau_ve-->
          </table>
         <table class="col">
            <!--LIST:kh_thu_mon-->
            	<tr>
              <td>
                  <div class="m-player-o">
                      <div class="img"><img src="[[|kh_thu_mon.anh_dai_dien|]]"/></div>
                      <span class="nub">[[|kh_thu_mon.so_ao|]]</span>
                      <p class="text">
                          <span class="name">[[|kh_thu_mon.ten|]]</span>
                      </p>
                      <span class="total">[[|kh_thu_mon.diem|]]</span>
                      <!--IF:cond_captain([[=kh_thu_mon.captain=]])-->
                      <a class="captain vs" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      <!--/IF:cond_captain-->
                  </div>
              </td>
              </tr>
             <!--/LIST:kh_thu_mon-->
          </table>
        </div>
    </div>
  </div>
</div>
<script src="skins/ssnh/scripts/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="skins/ssnh/scripts/CircularLoader/js/jquery.circle-diagram.js"></script>
<link rel="stylesheet" href="skins/ssnh/scripts/CircularLoader/stylesheets/ui.css">
<link rel="stylesheet" href="skins/ssnh/scripts/CircularLoader/stylesheets/ui.progress-bar.css">
<link media="only screen and (max-device-width: 480px)" href="skins/ssnh/scripts/CircularLoader/stylesheets/ios.css" type="text/css" rel="stylesheet" />
<script src="skins/ssnh/scripts/CircularLoader/js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="skins/ssnh/scripts/CircularLoader/js/progress.js" type="text/javascript" charset="utf-8"></script>
<script src="skins/ssnh/scripts/jBeep/jBeep.min.js" type="text/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<script>
var $duration = [[|duration|]];
<!--IF:cond([[=trang_thai=]]=='END')-->
//jQuery('.ket-qua').fadeIn(2000);
setTimeout("jQuery('.hoa').fadeIn(2000);jQuery('.win').fadeIn(2000);jQuery('#processing-bar').hide();jQuery('.cssload-container').hide();obj = jQuery('.win');obj.addClass( \"win big\", 1000, \"easeOutBounce\",function(){obj.removeClass(\'big\',1000,\"easeOutBounce\")});",1000);
<!--/IF:cond-->
jQuery(document).ready(function(e) {	
	jQuery( ".power span" ).animate({
		width: "toggle"
	}, 2000, function() {
		//jQuery( this ).effect( "fadeIn", 500 );
	});
<!--IF:cond([[=trang_thai=]]=='PLAYING')-->
	jQuery('.cssload-container').show();
	jBeep('skins/ssnh/images/fm_game/sound/start_match.wav');
	jBeep('skins/ssnh/images/fm_game/sound/playing.wav');
	var jt = setInterval("jBeep('skins/ssnh/images/fm_game/sound/playing.wav')",9000);
	//setTimeout("jQuery('.ket-qua').fadeIn(2000);jQuery('.hoa').fadeIn(2000);jQuery('.win').fadeIn(2000);jQuery('#processing-bar').hide();jQuery('.cssload-container').hide();obj = jQuery('.win');obj.addClass( \"win big\", 1000, \"easeOutBounce\",function(){obj.removeClass(\'big\',1000,\"easeOutBounce\")});",$duration);
	// Hide the label at start
  jQuery('#progress_bar .ui-progress .ui-label').hide();
  // Set initial value
  jQuery('#progress_bar .ui-progress').css('width', '7%');
  // Simulate some progress
	$per = 100;
  jQuery('#progress_bar .ui-progress').animateProgress($per, function() {
		//jQuery('.ket-qua').fadeIn(2000);
		jQuery('.hoa').fadeIn(2000);
		jQuery('.win').fadeIn(2000);
		jQuery('#processing-bar').hide();
		jQuery('.cssload-container').hide();obj = jQuery('.win');
		obj.addClass( "win big", 1000, "easeOutBounce",function(){obj.removeClass('big',1000,"easeOutBounce")});
		jBeep('skins/ssnh/images/fm_game/sound/end_match.wav');
		clearInterval(jt);
		window.document.location = '<?php echo Url::build_current(array('do','act','id'));?>';
		jQuery(this).animateProgress(
			$per, 
			function() {
				setTimeout(function() {
					jQuery('#progress_bar .ui-progress').animateProgress(50, function() {
						//jQuery('#fork_me').fadeIn();
					});
				},$duration);
    });//end animateProgress
  });
	<!--/IF:cond-->
});
</script>