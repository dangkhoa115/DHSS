<div class="content-r binh-chon ban_thang">
  <div class="title"><h1>Sử dụng item Dự đoán tổng số bàn thắng của <?php echo $this->map['vong_dau'];?></h1></div>
  <div class="detail">
  	<?php 
				if(($this->map['du_doan']))
				{?>
  	<div class="da-du-doan">
    	<h3>Bạn đã dự đoán: </h3>
        <div>
            <span><?php echo $this->map['du_doan'];?></span> bàn thắng / vòng đấu
        </div>
        <?php 
				if(($this->map['dang_dien_ra']))
				{?>
        <div class="note">Bạn vui lòng chờ kết quả của tất cả các trận đấu của vòng đấu để biết tổng số bàn thắng.</div>
         <?php }else{ ?>
        <div class="note">Tổng số bàn thắng của vòng đấu là <strong><?php echo $this->map['ban_thang'];?></strong></div>
        <?php if($this->map['du_doan']==$this->map['ban_thang']){?>
        <?php if($this->map['received']){?>
       	<div class="du-doan-dung">Chúc mừng bạn đã dự đoán đúng. Bạn đã nhận phần thưởng của BTC. Vui lòng tiếp tục đợi vòng sau để dự doán tiếp số bàn thắng của vòng đấu.</div>
        <?php }else{?>
        <div class="du-doan-dung">Chúc mừng bạn đã dự đoán đúng. Vui lòng nhấn vào <a class="btn btn-default" href="tham-gia-binh-chon/do/nhan_thuong_ban_thang/v<?php echo Url::iget('vong_dau_id');?>.html">ĐÂY</a> để nhận phần thưởng</div>
        <?php }?>
        <?php }else{?>
         <div class="du-doan-sai">Bạn đã không may mắn vòng này. Bạn vui lòng đợi vòng tiếp theo để dự đoán.</div>
        <?php }?>
        
				<?php
				}
				?>
    </div>
     <?php }else{ ?>
  	<form name="BanThangForm" method="post" id="BanThangForm">
    <div class="item-icon form-group">
    	<?php 
				if(($this->map['dang_dien_ra']))
				{?>
    	<?php 
				if(($this->map['checked']))
				{?>
      <img src="<?php echo $this->map['item_icon'];?>" width="100" alt="">
      <div class="desc note"><?php echo $this->map['item_desc'];?></div>
      <div><label for="value">Nhập số bàn thắng bạn dự đoán</label><input  name="value" id="value" class="form-control" required/ type ="text" value="<?php echo String::html_normalize(URL::get('value'));?>"></div>
      <div class="button-wrapper">
        <a href="tham-gia-binh-chon.html" class="btn btn-default btn-lg">Quay lại</a>
        <input  name="update" value="Áp dụng" class="btn btn-primary btn-lg" / type ="submit" value="<?php echo String::html_normalize(URL::get('update'));?>">
    	</div>
       <?php }else{ ?>
       <div class="alert alert-success">Bạn vui lòng vào <a href="ssnh_shop.html"><strong>SHOP</strong></a> để mua item Dự đoán tổng số bàn thắng của vòng đấu.</div>
       <center><a href="ssnh_shop.html"><img src="skins/ssnh/images/du_doan.png" alt=""></a></center>
      
				<?php
				}
				?>
       <?php }else{ ?>
      
				<?php
				}
				?>
   	</div>
  	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
   
				<?php
				}
				?>
  </div>   
</div>
<script type="text/javascript" src="packages/core/includes/js/jquery/jquery.validate.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#value').focus();
	jQuery('#BanThangForm').validate({
		rules: {
			value: {
				required: true,
				minlength: 1,
				number:true
			}
		},
		messages: {
			value:{
				required: 'Bạn vui lòng nhập số bàn thắng dự đoán',
				minlength: 'Phải nhập tối thiểu 1 số',
				number: 'Bạn vui lòng nhập số'
			}
		}
	});
});
</script>