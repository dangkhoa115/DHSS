<div class="row">
  <div class="col-xs-12 ket-qua-tran-dau">
  	<div class="row">
    	<div class="col-xs-6 center">
      <center><div class="ten-doi"><?php echo $this->map['cn_ten'];?></div></center>
        <!-- Thong so cua doi -->
        <div class="alert">
          <div class="row">
            <div class="col-xs-6">
              <div class="alert sub-alert">
                <div class="row">
                  <div class="col-xs-4">Power:</div>
                  <div class="col-xs-8"><div class="power"><span style="width:<?php echo ($this->map['cn_tong_diem']/150)*100;?>%;"><?php echo $this->map['cn_tong_diem'];?></span>&nbsp;</div></div>
                </div>
              </div>
              <div class="alert sub-alert">
                <div class="row">
                  <div class="col-xs-4">PĐ:</div>
                  <div class="col-xs-8">
                  <?php echo $this->map['phong_do_cn'];?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="alert sub-alert">
                <div class="row phong-ngu">
                  <div class="col-xs-4">P.Ngự:</div>
                  <div class="col-xs-8"><div class="power"><span style="width:<?php echo ($this->map['phong_ngu_cn']/150)*100;?>%;"><?php echo $this->map['phong_ngu_cn'];?></span>&nbsp;</div></div>
                </div>
              </div>
              <div class="alert sub-alert">
                <div class="row tan-cong">
                  <div class="col-xs-4">T.Công:</div>
                  <div class="col-xs-8"><div class="power"><span style="width:<?php echo ($this->map['tan_cong_cn']/150)*100;?>%;"><?php echo $this->map['tan_cong_cn'];?></span>&nbsp;</div></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end thong so cua doi -->
    	</div>
      <div class="col-xs-6 center">
      	<center><div class="ten-doi"><?php echo $this->map['kh_ten'];?></div></center>
        <!-- Thong so cua doi -->
        <div class="alert">
          <div class="row">
            <div class="col-xs-6">
              <div class="alert sub-alert">
                <div class="row">
                  <div class="col-xs-4">Power:</div>
                  <div class="col-xs-8"><div class="power"><span style="width:<?php echo ($this->map['kh_tong_diem']/150)*100;?>%;"><?php echo $this->map['kh_tong_diem'];?></span>&nbsp;</div></div>
                </div>
              </div>
              <div class="alert sub-alert">
                <div class="row">
                  <div class="col-xs-4">PĐ:</div>
                  <div class="col-xs-8">
                  <?php echo $this->map['phong_do_kh'];?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="alert sub-alert">
                <div class="row phong-ngu">
                  <div class="col-xs-4">P.Ngự:</div>
                  <div class="col-xs-8"><div class="power"><span style="width:<?php echo ($this->map['phong_ngu_kh']/150)*100;?>%;"><?php echo $this->map['phong_ngu_kh'];?></span>&nbsp;</div></div>
                </div>
              </div>
              <div class="alert sub-alert">
                <div class="row tan-cong">
                  <div class="col-xs-4">T.Công:</div>
                  <div class="col-xs-8"><div class="power"><span style="width:<?php echo ($this->map['tan_cong_kh']/150)*100;?>%;"><?php echo $this->map['tan_cong_kh'];?></span>&nbsp;</div></div>
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
  	<?php 
				if(($this->map['trang_thai']=='PENDDING'))
				{?>
  	<div class="thoi-gian-thi-dau">
    	Thi đấu vào lúc: <?php echo $this->map['thoi_gian'];?>
      <div id="timer">
      	<div class="countdown">
          <center>
						<script type="application/javascript">
            var myCountdown1 = new Countdown({
							time: <?php echo $this->map['time'];?>, // 86400 seconds = 1 day
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
    
				<?php
				}
				?>
    <?php 
				if(($this->map['trang_thai']=='PLAYING'))
				{?>
  	<div id="processing-bar">
      <div id="progress_bar" class="ui-progress-bar ui-container">
        <div class="ui-progress" style="width: 100%;position:absolute;">
          <span class="ui-label" style="display:none;"><!--<b class="value">100%</b>--><img src="skins/ssnh/images/fm_game/soccer_player_animated.gif" height="30" alt=""/></span>
        </div>
      </div>
    </div>
    
				<?php
				}
				?>
    <div class="svd">
        <div class="col-xs-6" id="doi_chu_nha">
        	<div class="du-bao cn">
          	Tỷ lệ chiến thắng:<br><span><?php echo $this->map['ty_le_thang_cn'];?>%</span>
          </div>
        	<div class="logo"><img src="<?php echo $this->map['cn_logo'];?>" alt="<?php echo $this->map['cn_ten'];?>" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></div>
        	<table class="col">
            <?php
					if(isset($this->map['cn_thu_mon']) and is_array($this->map['cn_thu_mon']))
					{
						foreach($this->map['cn_thu_mon'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['cn_thu_mon']['current'] = &$item1;?>
            	<tr>
              <td>
                  <div class="m-player-o">
                      <div class="img"><img src="<?php echo $this->map['cn_thu_mon']['current']['anh_dai_dien'];?>"/></div>
                      <span class="nub"><?php echo $this->map['cn_thu_mon']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['cn_thu_mon']['current']['ten'];?></span>
                      </p>
                      <span class="total"><?php echo $this->map['cn_thu_mon']['current']['diem'];?></span>
                      <?php 
				if(($this->map['cn_thu_mon']['current']['captain']))
				{?>
                      <a class="captain" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      
				<?php
				}
				?>
                  </div>
              </td>
              </tr>
             
							
						<?php
							}
						}
					unset($this->map['cn_thu_mon']['current']);
					} ?>
          </table>
          <table class="col">
              <?php
					if(isset($this->map['cn_hau_ve']) and is_array($this->map['cn_hau_ve']))
					{
						foreach($this->map['cn_hau_ve'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['cn_hau_ve']['current'] = &$item2;?>
              <tr valign="middle"><td>
                  <div class="m-player-o">
                      <div class="img"><img src="<?php echo $this->map['cn_hau_ve']['current']['anh_dai_dien'];?>"/></div>
                      <span class="nub"><?php echo $this->map['cn_hau_ve']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['cn_hau_ve']['current']['ten'];?></span>
                      </p>
                      <span class="total"><?php echo $this->map['cn_hau_ve']['current']['diem'];?></span>
                      <?php 
				if(($this->map['cn_hau_ve']['current']['captain']))
				{?>
                      <a class="captain vs" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      
				<?php
				}
				?>
                  </div><!--End .m-player-->
              </td></tr>
             
							
						<?php
							}
						}
					unset($this->map['cn_hau_ve']['current']);
					} ?>
          </table>
           <table class="col">
             <?php
					if(isset($this->map['cn_tien_ve']) and is_array($this->map['cn_tien_ve']))
					{
						foreach($this->map['cn_tien_ve'] as $key3=>&$item3)
						{
							if($key3!='current')
							{
								$this->map['cn_tien_ve']['current'] = &$item3;?>
              <tr><td>
                  <div class="m-player-o">
                      <div class="img"><img src="<?php echo $this->map['cn_tien_ve']['current']['anh_dai_dien'];?>"/></div>
                      <span class="nub"><?php echo $this->map['cn_tien_ve']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['cn_tien_ve']['current']['ten'];?></span>
                      </p>
                      <span class="total"><?php echo $this->map['cn_tien_ve']['current']['diem'];?></span>
                      <?php 
				if(($this->map['cn_tien_ve']['current']['captain']))
				{?>
                      <a class="captain vs" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      
				<?php
				}
				?>
                  </div><!--End .m-player-->
              </td></tr>
             
							
						<?php
							}
						}
					unset($this->map['cn_tien_ve']['current']);
					} ?>
         </table>
         <table class="col">
              <?php
					if(isset($this->map['cn_tien_dao']) and is_array($this->map['cn_tien_dao']))
					{
						foreach($this->map['cn_tien_dao'] as $key4=>&$item4)
						{
							if($key4!='current')
							{
								$this->map['cn_tien_dao']['current'] = &$item4;?>
              <tr><td>
                  <div class="m-player-o">
                      <div class="img"><img src="<?php echo $this->map['cn_tien_dao']['current']['anh_dai_dien'];?>"/></div>
                      <span class="nub"><?php echo $this->map['cn_tien_dao']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['cn_tien_dao']['current']['ten'];?></span>
                      </p>
                      <span class="total"><?php echo $this->map['cn_tien_dao']['current']['diem'];?></span>
                      <?php 
				if(($this->map['cn_tien_dao']['current']['captain']))
				{?>
                      <a class="captain vs" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      
				<?php
				}
				?>
                  </div><!--End .m-player-->
              </td></tr>
             
							
						<?php
							}
						}
					unset($this->map['cn_tien_dao']['current']);
					} ?>
          </table>
        </div>
        <div class="col-xs-6" id="doi_khach">
        	<div class="du-bao kh">
          	Tỷ lệ chiến thắng:<br><span><?php echo $this->map['ty_le_thang_kh'];?>%</span>
          </div>
       	 <div class="logo"><img src="<?php echo $this->map['kh_logo'];?>" alt="<?php echo $this->map['kh_ten'];?>" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></div>
        	<table class="col">
              <?php
					if(isset($this->map['kh_tien_dao']) and is_array($this->map['kh_tien_dao']))
					{
						foreach($this->map['kh_tien_dao'] as $key5=>&$item5)
						{
							if($key5!='current')
							{
								$this->map['kh_tien_dao']['current'] = &$item5;?>
              <tr><td>
                  <div class="m-player-o">
                      <div class="img"><img src="<?php echo $this->map['kh_tien_dao']['current']['anh_dai_dien'];?>"/></div>
                      <span class="nub"><?php echo $this->map['kh_tien_dao']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['kh_tien_dao']['current']['ten'];?></span>
                      </p>
                      <span class="total"><?php echo $this->map['kh_tien_dao']['current']['diem'];?></span>
                      <?php 
				if(($this->map['kh_tien_dao']['current']['captain']))
				{?>
                      <a class="captain vs" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      
				<?php
				}
				?>
                  </div><!--End .m-player-->
              </td></tr>
             
							
						<?php
							}
						}
					unset($this->map['kh_tien_dao']['current']);
					} ?>
          </table>
          <table class="col">
             <?php
					if(isset($this->map['kh_tien_ve']) and is_array($this->map['kh_tien_ve']))
					{
						foreach($this->map['kh_tien_ve'] as $key6=>&$item6)
						{
							if($key6!='current')
							{
								$this->map['kh_tien_ve']['current'] = &$item6;?>
              <tr><td>
                  <div class="m-player-o">
                      <div class="img"><img src="<?php echo $this->map['kh_tien_ve']['current']['anh_dai_dien'];?>"/></div>
                      <span class="nub"><?php echo $this->map['kh_tien_ve']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['kh_tien_ve']['current']['ten'];?></span>
                      </p>
                      <span class="total"><?php echo $this->map['kh_tien_ve']['current']['diem'];?></span>
                      <?php 
				if(($this->map['kh_tien_ve']['current']['captain']))
				{?>
                      <a class="captain vs" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      
				<?php
				}
				?>
                  </div><!--End .m-player-->
              </td></tr>
             
							
						<?php
							}
						}
					unset($this->map['kh_tien_ve']['current']);
					} ?>
         </table>
          <table class="col">
              <?php
					if(isset($this->map['kh_hau_ve']) and is_array($this->map['kh_hau_ve']))
					{
						foreach($this->map['kh_hau_ve'] as $key7=>&$item7)
						{
							if($key7!='current')
							{
								$this->map['kh_hau_ve']['current'] = &$item7;?>
              <tr valign="middle"><td>
                  <div class="m-player-o">
                      <div class="img"><img src="<?php echo $this->map['kh_hau_ve']['current']['anh_dai_dien'];?>"/></div>
                      <span class="nub"><?php echo $this->map['kh_hau_ve']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['kh_hau_ve']['current']['ten'];?></span>
                      </p>
                      <span class="total"><?php echo $this->map['kh_hau_ve']['current']['diem'];?></span>
                      <?php 
				if(($this->map['kh_hau_ve']['current']['captain']))
				{?>
                      <a class="captain vs" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      
				<?php
				}
				?>
                  </div><!--End .m-player-->
              </td></tr>
             
							
						<?php
							}
						}
					unset($this->map['kh_hau_ve']['current']);
					} ?>
          </table>
         <table class="col">
            <?php
					if(isset($this->map['kh_thu_mon']) and is_array($this->map['kh_thu_mon']))
					{
						foreach($this->map['kh_thu_mon'] as $key8=>&$item8)
						{
							if($key8!='current')
							{
								$this->map['kh_thu_mon']['current'] = &$item8;?>
            	<tr>
              <td>
                  <div class="m-player-o">
                      <div class="img"><img src="<?php echo $this->map['kh_thu_mon']['current']['anh_dai_dien'];?>"/></div>
                      <span class="nub"><?php echo $this->map['kh_thu_mon']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['kh_thu_mon']['current']['ten'];?></span>
                      </p>
                      <span class="total"><?php echo $this->map['kh_thu_mon']['current']['diem'];?></span>
                      <?php 
				if(($this->map['kh_thu_mon']['current']['captain']))
				{?>
                      <a class="captain vs" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      
				<?php
				}
				?>
                  </div>
              </td>
              </tr>
             
							
						<?php
							}
						}
					unset($this->map['kh_thu_mon']['current']);
					} ?>
          </table>
        </div>
        <div id="BangKetQua">
					<div class="row">
          	<div class="col-md-6 left">
            	<h3><span class="logo"><img src="<?php echo $this->map['cn_logo'];?>" width="50" height="50" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></span><?php echo $this->map['cn_ten'];?></h3>
            	<?php echo (($this->map['kq']=='Hòa')?'':(($this->map['kq']=='Thắng')?'<div class="win"><img src="skins/ssnh/images/fm_game/win.png" alt="Winner"></div>':''));?>
              <div class="ghi-ban"><?php echo $this->map['ghi_ban1'];?></div>
            </div>
            <div class="col-md-6 right">
            	<h3><span class="logo"><img src="<?php echo $this->map['kh_logo'];?>" width="50" height="50" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></span><?php echo $this->map['kh_ten'];?></h3>
            	<?php echo (($this->map['kq']=='Hòa')?'':(($this->map['kq']=='Thua')?'<div class="win"><img src="skins/ssnh/images/fm_game/win.png" alt="Winner"></div>':''));?>
            	<div class="ghi-ban"><?php echo $this->map['ghi_ban2'];?></div>
            </div>
          </div>
          <div class="text-center">
          	<div class="ty-so"><?php echo $this->map['ty_so'];?></div>
            <div class="back"><input type="button" value="OK" class="btn btn-danger btn-sm" onClick="jQuery('#BangKetQua').hide();"></div>
          </div>   	
        </div>
    </div>
  </div>
</div>
<script src="skins/ssnh/scripts/jquery-1.11.0.min.js" type="text/javascript"></script>
<!--<script src="skins/ssnh/scripts/CircularLoader/js/jquery.circle-diagram.js"></script>-->
<link rel="stylesheet" href="skins/ssnh/scripts/CircularLoader/stylesheets/ui.css">
<link rel="stylesheet" href="skins/ssnh/scripts/CircularLoader/stylesheets/ui.progress-bar.css">
<link media="only screen and (max-device-width: 480px)" href="skins/ssnh/scripts/CircularLoader/stylesheets/ios.css" type="text/css" rel="stylesheet" />
<script src="skins/ssnh/scripts/CircularLoader/js/progress.js" type="text/javascript" charset="utf-8"></script>
<script src="skins/ssnh/scripts/jBeep/jBeep.min.js" type="text/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<script>
var $duration = <?php echo $this->map['duration'];?>;
<?php 
				if(($this->map['trang_thai']=='END'))
				{?>
//jQuery('.ket-qua').fadeIn(2000);
setTimeout("jQuery('#BangKetQua').fadeIn(2000);jQuery('#processing-bar').hide();jQuery('.cssload-container').hide();obj = jQuery('.win');obj.addClass( \"win big\", 1000, \"easeOutBounce\",function(){obj.removeClass(\'big\',1000,\"easeOutBounce\")});",1000);

				<?php
				}
				?>
jQuery(document).ready(function(e) {	
	jQuery( ".power span" ).animate({
		width: "toggle"
	}, 2000, function() {
		//jQuery( this ).effect( "fadeIn", 500 );
	});
<?php 
				if(($this->map['trang_thai']=='PLAYING'))
				{?>
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
		jQuery('#BangKetQua').fadeIn(2000);
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
	
				<?php
				}
				?>
});
</script>