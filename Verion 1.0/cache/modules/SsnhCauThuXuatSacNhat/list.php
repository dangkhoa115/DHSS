<a name="ctxsn"></a>
<div class="row">
	<div id="app" class="col-md-12">
    <div class="player-header">
      <div class="row">
      	<div class="col-md-8">
          <div class="title"> 
            <h3><img src="skins/ssnh/images/sb_lt_logo.png" alt="Barclays Premier League" class="barclay-icon" title="Barclays Premier League">Cầu thủ xuất sắc nhất</h3>
          </div>
        </div>
        <div class="col-md-4">
        	<form name="SsnhCauThuXuatSacNhatForm" method="post">
          	<select  name="vong_dau_ids" id="vong_dau_ids" onchange="SsnhCauThuXuatSacNhatForm.submit()"><?php
					if(isset($this->map['vong_dau_ids_list']))
					{
						foreach($this->map['vong_dau_ids_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('vong_dau_ids').value = "<?php echo addslashes(URL::get('vong_dau_ids',isset($this->map['vong_dau_ids'])?$this->map['vong_dau_ids']:''));?>";</script>
	</select>
          <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
        	<div class="fp-profiles"><a href="cau-thu">Xem tất cả</a></div>
        </div>
       </div>
    </div>
    <script type="text/javascript" src="skins/ssnh/scripts/jquery.jcarousel.min.js"></script>
    <script type="text/javascript" src="skins/ssnh/scripts/jcarousel.skeleton.js"></script>
    <script type="text/javascript" src="skins/ssnh/scripts/jquery_show.js"></script>
    <script type="text/javascript" src="skins/ssnh/scripts/js_slideshow.js"></script>
    <script type="text/javascript" src="skins/ssnh/scripts/jquery.popup.min.js"></script>
    <script type="text/javascript">
        var top_video_url = '';
        function playVideo(url){
          jwplayer("top-video-play").setup({
              flashplayer: "jwplayer.flash.swf",
              file: url,
              width: 730
              ,height: 460
          });
        }
        $(document).ready(function() {
              $('.slideShow').slideShow({
                interval: false,
              });
          /* khởi tạo popup */
            $('a[rel*=Popup]').showPopup({ 
              top : 65, //khoảng cách popup cách so với phía trên
              closeButton: ".close_popup" , //khai báo nút close cho popup
              scroll : false, //cho phép scroll khi mở popup, mặc định là không cho phép
              onClose:function(){            	
                //sự kiện cho phép gọi sau khi đóng popup, cho phép chúng ta gọi 1 số sự kiện khi đóng popup, bạn có thể để null ở đây
              }
            });	
        });
    </script>
    <div class="slideShow">
        <ul class="slides">
          <?php $k=0;?>
            <?php
					if(isset($this->map['cauthus']) and is_array($this->map['cauthus']))
					{
						foreach($this->map['cauthus'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['cauthus']['current'] = &$item1;?>
            <?php 
				if(($this->map['vong_dau_id'] == $this->map['cauthus']['current']['vong_dau_id']))
				{?>
            <script>
              $(document).ready(function(){
                var slide = $('.slideShow').slideShow({
                interval: false,
              });
                slide.gotoSlide(<?php echo $k;?>);
              });
            </script>
            
				<?php
				}
				?>
            <li class="slide">
                <div class="info">
                    <div class="main">
                        <div class="title">
                            <span class="number"><?php echo $this->map['cauthus']['current']['so_ao'];?></span>
                            <span class="name"><?php echo $this->map['cauthus']['current']['ten'];?></span>
                        </div>
                        <div class="detail-info">
                            <div class="left">
                                <ul>
                                    <li>Năm Sinh:</li>
                                    <li>Chiều cao:</li>
                                    <li>Cân nặng:</li>
                                    <li>Quốc tịch:</li>                                  
                                    <li>Điểm:</li>
                                    <li>Đội hiện tại:</li>
                                </ul>
                            </div>
                            <div class="right">
                                <ul>
                                    <li><?php echo Date_Time::to_common_date($this->map['cauthus']['current']['ngay_sinh']);?>&nbsp;</li>
                                    <li><?php echo $this->map['cauthus']['current']['chieu_cao'];?></li>
                                    <li><?php echo $this->map['cauthus']['current']['can_nang'];?></li>
                                    <li><?php echo $this->map['cauthus']['current']['quoc_tich'];?></li>
                                    <li><?php echo $this->map['cauthus']['current']['diem'];?></li>
                                    <li><?php echo $this->map['cauthus']['current']['clb'];?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="view-all">
                          <?php 
				if(($this->map['cauthus']['current']['name_id']))
				{?>
                          <?php 
				if(($this->map['cauthus']['current']['video']))
				{?>
                          <a id="open_popup" rel="Popup" href="#popup_content" class="view-video" name="open_popup" onclick="top_video_url = '<?php echo $this->map['cauthus']['current']['video'];?>';playVideo(top_video_url);">Xem video</a>
                          
				<?php
				}
				?>
                          <a href="cau-thu/<?php echo $this->map['cauthus']['current']['name_id'];?>-id<?php echo $this->map['cauthus']['current']['cau_thu_id'];?>.html" class="view-more">Xem thêm thông tin</a>
                          
				<?php
				}
				?>
                        </div>
                    </div>
                </div>
                <img src="<?php echo $this->map['cauthus']['current']['anh_vong_dau'];?>" border="0" alt="<?php echo $this->map['cauthus']['current']['ten'];?>" title="<?php echo $this->map['cauthus']['current']['ten'];?>" />
            </li>
            <div id="popup_content" class="popup">
              <div class="popup-header">
                <div class="player-title"> <img src="skins/ssnh/images/sb_lt_logo.png" alt="Barclays Premier League"><span id="popup_video_ten_cau_thu"></span>
                    <div class="fp-profiles close_popup close_popup_link"><a href="javascript:void(0)" onclick="jQuery('#popup_video_url').attr('src','');">Đóng lại</a></div>
                </div>
              </div>
              <div class="info_popup">                        		
               <div id="popup_video_url">
                  <div class="video-play" id="top-video-play">LOADING VIDEO ...
                  </div><!--End .video-play-->
               </div>
               <!--<object width="739" height="460"><param name="movie" value="//www.youtube.com/v/ewkPkL1J02o?version=3&amp;hl=vi_VN&amp;rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/ewkPkL1J02o?version=3&amp;hl=vi_VN&amp;rel=0" type="application/x-shockwave-flash" width="739" height="460" allowscriptaccess="always" allowfullscreen="true"></embed></object> -->
              </div>
            </div>
          <?php $k++;?>  
          
							
						<?php
							}
						}
					unset($this->map['cauthus']['current']);
					} ?>
        </ul>
        <ul class="navigation">
            <?php
					if(isset($this->map['cauthus']) and is_array($this->map['cauthus']))
					{
						foreach($this->map['cauthus'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['cauthus']['current'] = &$item2;?>
            <li><a href="javascript:void(0);" class="page"><span class="arrow"></span><div class="v"><?php echo $this->map['cauthus']['current']['vong_dau'];?></div><div class="bg-img"><img src="<?php echo $this->map['cauthus']['current']['anh_dai_dien'];?>"  alt="<?php echo $this->map['cauthus']['current']['ten'];?>" title="<?php echo $this->map['cauthus']['current']['ten'];?>"/></div></a></li>
            
							
						<?php
							}
						}
					unset($this->map['cauthus']['current']);
					} ?>
        </ul>
    </div>
   </div>
</div><!--End #app-->