<!--<div class="beta"></div>-->
<div class="content-r binh-chon">
  <div class="title"><h1>Tham gia bình chọn <?php echo $this->map['vong_dau'];?></h1></div>
  <div class="note">&ldquo;Bạn có 3 lượt bình chọn cho các đội khách nhau. Khi đã bình chọn đủ 3 đội, bạn được quyền thay đổi đội khác.&rdquo;</div>
  <div class="detail">
  	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>	
    <form name="BinhChonForm" id="BinhChonForm" method="post">
    <div class="list-player">
      <table class="table">      
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
            <td><?php echo $this->map['items']['current']['thoi_gian_ngay'];?> <?php echo $this->map['items']['current']['thoi_gian_gio'];?>'</td>
            <td id="item_<?php echo $this->map['items']['current']['dcn_id'];?>" width="150" align="left" class="left"><label for="clb_id_<?php echo $this->map['items']['current']['dcn_id'];?>"><input  name="clb_id_<?php echo $this->map['items']['current']['dcn_id'];?>" type="checkbox" id="clb_id_<?php echo $this->map['items']['current']['dcn_id'];?>" value="<?php echo $this->map['items']['current']['dcn_id'];?>" onChange="checkClb(this)" class="selected-clb" old=0><?php echo $this->map['items']['current']['doi_chu_nha'];?></label></td>
            <td><img alt="<?php echo $this->map['items']['current']['doi_chu_nha'];?>" src="<?php echo $this->map['items']['current']['logo_cn'];?>"></td>
            <td>
              <div>VS</div>
            </td>
            <td><img alt="<?php echo $this->map['items']['current']['doi_khach'];?>" src="<?php echo $this->map['items']['current']['logo_kh'];?>"></td>
            <td id="item_<?php echo $this->map['items']['current']['dkh_id'];?>" width="150" align="left" class="left"><label for="clb_id_<?php echo $this->map['items']['current']['dkh_id'];?>"><input  name="clb_id_<?php echo $this->map['items']['current']['dkh_id'];?>" type="checkbox" id="clb_id_<?php echo $this->map['items']['current']['dkh_id'];?>" value="<?php echo $this->map['items']['current']['dkh_id'];?>" onChange="checkClb(this)" class="selected-clb" old=0><?php echo $this->map['items']['current']['doi_khach'];?></label></td>
          </tr>
          
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
        </tbody>
      </table>
  </div><!--End .list-player-->
    <br clear="all">
    <div class="total-igold-wrapper">
    	<div><strong>Tổng số iGold cần dùng: </strong><span id="total" class="igold-amount">0</span></div>
    </div>
    <br clear="all">
    <div class="binh-chon-button">
    	<a href="tham-gia-binh-chon.html" class="cancel">Về danh sách bình chọn</a> |
    	<input id="binh_chon" type="button" value="Cập nhât bình chọn" class="button">
    </div>
    <input  name="total_amount" id="total_amount" type ="hidden" value="<?php echo String::html_normalize(URL::get('total_amount'));?>">
    <input  name="delete_ids" type="hidden" id="delete_ids" value="">
    <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
    <br clear="all">
  </div>
</div>
<script>
var DA_BC = to_numeric(<?php echo $this->map['total_binh_chon'];?>);
jQuery(document).ready(function(e) {
	jQuery("body").on("contextmenu",function(){
		return false;
	});
	<?php
					if(isset($this->map['binhchons']) and is_array($this->map['binhchons']))
					{
						foreach($this->map['binhchons'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['binhchons']['current'] = &$item2;?>
	jQuery('#clb_id_<?php echo $this->map['binhchons']['current']['clb_id'];?>').attr('checked',true);
	jQuery('#clb_id_<?php echo $this->map['binhchons']['current']['clb_id'];?>').attr('old',1);
	jQuery('#item_<?php echo $this->map['binhchons']['current']['clb_id'];?>').css({'background':'#daf784'});
	
							
						<?php
							}
						}
					unset($this->map['binhchons']['current']);
					} ?>
	jQuery('#binh_chon').click(function(){
		if(DANG_BC==0){
			alert('Bạn chưa có sự thay đổi nào.');
			return false;
		}else{
			if(DANG_BC > 0 && DANG_BC < DA_BC){
				alert('Bạn đã chọn '+DA_BC+' đội. Bạn phải bổ sung '+(DA_BC - DANG_BC)+' đội bạn đã bỏ chọn');
			}else{
				jQuery(this).val('Đang xử lý ...');	
				BinhChonForm.submit();
				return false;
			}
		}
	});
});
</script>