<div class="row">
<div class="col-md-12">
<form name="SsnhLichThiDauForm" method="post">
  <div class="title"><h1>LỊCH THI ĐẤU / KẾT QUẢ <?php echo $this->map['vong_dau'];?><span class="right"><select  name="vong_dau_id" id="vong_dau_id" onchange="SsnhLichThiDauForm.submit()" class="form-control"><?php
					if(isset($this->map['vong_dau_id_list']))
					{
						foreach($this->map['vong_dau_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('vong_dau_id').value = "<?php echo addslashes(URL::get('vong_dau_id',isset($this->map['vong_dau_id'])?$this->map['vong_dau_id']:''));?>";</script>
	</select></span></h1></div>
  <hr>
  <div class="list-player lich-thi-dau">
      <table id="ismFixtureTable">      
        <tbody>
        	<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
          <tr>
            <td width="150"><strong><?php echo $this->map['items']['current']['doi_chu_nha'];?></strong><br>Mã: <?php echo $this->map['items']['current']['ma_doi_chu_nha'];?></td>
            <td><img alt="<?php echo $this->map['items']['current']['doi_chu_nha'];?>" src="<?php echo $this->map['items']['current']['logo_cn'];?>" title="<?php echo $this->map['items']['current']['doi_chu_nha'];?>"></td>
            <td>
            	<?php echo $this->map['items']['current']['thoi_gian_ngay'];?> <?php echo $this->map['items']['current']['thoi_gian_gio'];?>'<hr>
            	<?php 
				if(($this->map['items']['current']['ket_qua']))
				{?>
              <div><a id="thong_tin_<?php echo $this->map['items']['current']['id'];?>" rel="Popup" href="#popup_content" class="btn btn-default" name="open_popup"><?php echo $this->map['items']['current']['ket_qua'];?></a></div>
              <?php if($this->map['items']['current']['have_video']){?><br>
              <a id="video_<?php echo $this->map['items']['current']['id'];?>" rel="Popup" href="#popup_content" class="button round small warning">Video</a>
              <?php }?>
               <?php }else{ ?>
              <div>VS</div>
              
				<?php
				}
				?>
            </td>
            <td><img alt="<?php echo $this->map['items']['current']['doi_khach'];?>" title="<?php echo $this->map['items']['current']['doi_khach'];?>" src="<?php echo $this->map['items']['current']['logo_kh'];?>"></td>
            <td width="150"><strong><?php echo $this->map['items']['current']['doi_khach'];?></strong><br>Mã: <?php echo $this->map['items']['current']['ma_doi_khach'];?></td>
          </tr>
          
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
        </tbody>
      </table>
  </div><!--End .list-player-->
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			  
</div>
</div>
<div id="popup_content" class="popup thong-tin-trang-dau">
  <div class="popup-header">
    <div class="player-title"> <img src="skins/ssnh/images/sb_lt_logo.png" alt="Barclays Premier League"><span id="popup_title"></span>
            <div class="fp-profiles close_popup close_popup_link"><a href="javascript:void(0)">Đóng lại</a></div>
    </div>
  </div>
  <div class="info_popup" id="popup_info"></div>
</div>
<script type="text/javascript" src="skins/ssnh/scripts/jquery_show.js"></script>
<script type="text/javascript" src="skins/ssnh/scripts/js_slideshow.js"></script>
<script type="text/javascript" src="skins/ssnh/scripts/jquery.popup.min.js"></script>
<script>
jQuery(document).ready(function() {
	<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['items']['current'] = &$item2;?>
	<?php 
				if(($this->map['items']['current']['ket_qua']))
				{?>
	jQuery('#thong_tin_<?php echo $this->map['items']['current']['id'];?>').click(function(){
		jQuery('#popup_title').html('Thông tin trận đấu <?php echo $this->map['items']['current']['doi_chu_nha'];?> vs <?php echo $this->map['items']['current']['doi_khach'];?>');
		jQuery('#popup_info').html('<ul><?php echo String::string2js(($this->map['items']['current']['thong_tin_tran_dau']));?></ul>');
	});
	jQuery('#thong_tin_<?php echo $this->map['items']['current']['id'];?>').showPopup({ 
		top : 30, //khoảng cách popup cách so với phía trên
		closeButton: ".close_popup" , //khai báo nút close cho popup
		scroll : false, //cho phép scroll khi mở popup, mặc định là không cho phép
		onClose:function(){            	
			//sự kiện cho phép gọi sau khi đóng popup, cho phép chúng ta gọi 1 số sự kiện khi đóng popup, bạn có thể để null ở đây
		}
	});
	jQuery('#video_<?php echo $this->map['items']['current']['id'];?>').click(function(){
		window.open('video?cap_dau_id=<?php echo $this->map['items']['current']['id'];?>','','width=960,height=550,top=140,left=200');
		return false;
	});
	
				<?php
				}
				?>
	
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
});
</script>