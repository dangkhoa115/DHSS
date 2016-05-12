<!--<div class="beta"></div>-->
<div class="content-r binh-chon x2">
  <div class="title">
    <h1>Sử dụng item X2 để nhân đôi điểm số nếu bạn đoán trúng <?php echo $this->map['vong_dau'];?></h1></div>
  <div class="detail">
  <form name="x2Form">
  	<table border="0" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0" width="100%" align="center" class="table leagueTable">
      	<tr>
        	<th width="1%" align="left">STT</th>
          <th width="40%" align="left">CLB</th>
          <th width="40%" align="center">Thời gian bình chọn</th>
          <th width="20%" align="center"> Chọn<!--<input  name="check_all" id="check_all" title="Chọn tất cả" type ="checkbox" value="<?php echo String::html_normalize(URL::get('check_all'));?>">--></th>
      </tr>
        <?php
					if(isset($this->map['binhchons']) and is_array($this->map['binhchons']))
					{
						foreach($this->map['binhchons'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['binhchons']['current'] = &$item1;?>
        <tr>
        	<td align="center"><?php echo $this->map['binhchons']['current']['i'];?></td>
          <td><?php echo $this->map['binhchons']['current']['clb'];?></td>
          <td align="center"><?php echo $this->map['binhchons']['current']['thoi_gian_binh_chon'];?></td>
          <td align="center" bgcolor="#FBFF71">
          	<?php 
				if((!$this->map['binhchons']['current']['x2']))
				{?>
            <input  name="check_<?php echo $this->map['binhchons']['current']['id'];?>" type="checkbox" id="check_<?php echo $this->map['binhchons']['current']['id'];?>" value="<?php echo $this->map['binhchons']['current']['id'];?>" class="chon-clb" title="Chọn đội">
             <?php }else{ ?>
            Đã đặt X2
            
				<?php
				}
				?>
          </td>
      </tr>
        
							
						<?php
							}
						}
					unset($this->map['binhchons']['current']);
					} ?>
    </table>
    <p class="alert alert-warning">Chọn Đội bạn đã bình chọn để đặt X2</p>
    <div class="item-icon">
      <img src="<?php echo $this->map['x2_item_icon'];?>" alt="X2">
      <div class="desc note"><?php echo $this->map['x2_item_desc'];?> / bạn đang có <?php echo $this->map['sl_x2'];?> item x2</div>
      <div class="button-wrapper">
      <?php 
				if(($this->map['dang_dien_ra']))
				{?>
      <a href="tham-gia-binh-chon.html" class="btn btn-default">Quay lại</a>
      <?php 
				if(($this->map['x2_item']))
				{?>
      <a href="#" class="btn btn-primary" onClick="update_x2();	return false;">Áp dụng Nhân đôi điểm số</a>
       <?php }else{ ?>
      <p class="note">Vui lòng bình chọn để sử dụng item X2</p>
      
				<?php
				}
				?>
      
				<?php
				}
				?>
    </div>
   </div>
   <input  name="clb_ids" type="hidden" id="clb_ids" value="">
   <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
  </div>   
</div>
<script>
	jQuery(document).ready(function() {
		jQuery('#check_all').click(function(){
			$checked = jQuery(this).is(':checked');
			if($checked == true){
				jQuery('.chon-clb').attr('checked',$checked);
			}else{
				jQuery('.chon-clb').removeAttr('checked');	
			}
		//	updateCbl();
		});
		jQuery('.chon-clb').click(function(){
				updateCbl();
		});
  });
	function update_x2(){
		if(jQuery('#clb_ids').val()){
			window.location='tham-gia-binh-chon/do/apply_x2.html?clb_ids='+jQuery('#clb_ids').val();
		}else{
			alert('Bạn vui lòng chọn ít nhất một đội để áp dụng item x2 tham gia cơ hội nhân đôi điểm số');
			jQuery('.chon-clb').focus();
		}
	}
	function updateCbl(){
		clbs = '';
		jQuery('.chon-clb').each(function(index, element) {
			if(jQuery(this).is(':checked')){
      	clbs += (clbs?',':'')+jQuery(this).val();
			}
    });
		jQuery('#clb_ids').val(clbs);
	}
</script>