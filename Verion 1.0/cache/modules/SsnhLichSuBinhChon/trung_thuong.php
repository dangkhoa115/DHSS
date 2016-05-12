<?php 
				if((Url::get('page') == 'binh-chon' or Url::get('page') == 'binh-chon-beta' or Url::get('page') == 'top-50-binh-chon'))
				{?>
<link rel="stylesheet" href="skins/ssnh/styles/tabs/tabpane.css" type="text/css" />
<script type="text/javascript" src="skins/default/css/tabs/tabpane.js"></script>
<div style="float:left;width:666px;min-height:300px;">
 <?php }else{ ?>
<div style="float:left;width:490px;min-height:300px;">

				<?php
				}
				?>
  <div class="tab-pane-1">
    <div class="tab-page">
      <h2 class="tab">50 bình chọn tham gia quay trúng thưởng</h2>
      <div class="search-options">
      <form name="EditQuanLyLichSuCauThuForm" method="post">
      <select  name="vong_dau_id" id="vong_dau_id" onchange="EditQuanLyLichSuCauThuForm.submit()"><?php
					if(isset($this->map['vong_dau_id_list']))
					{
						foreach($this->map['vong_dau_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('vong_dau_id').value = "<?php echo addslashes(URL::get('vong_dau_id',isset($this->map['vong_dau_id'])?$this->map['vong_dau_id']:''));?>";</script>
	</select>
      <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
      </div>
      <table cellpadding="0" cellspacing="0" width="100%" align="center" class="table leagueTable">
      	<tr>
      	  <th align="center" width="1%">STT</th>
        	<th align="left">Vòng đấu</th>
        	<th align="left" width="1%">&nbsp;</th>
          <th align="left" width="120">Người chơi</th>
          <th align="center">CMTND</th>
          <th align="left">CLB</th>
          <th align="center">Thời gian bình chọn</th>
        </tr>
        <?php
					if(isset($this->map['binhchons']) and is_array($this->map['binhchons']))
					{
						foreach($this->map['binhchons'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['binhchons']['current'] = &$item1;?>
        <tr <?php echo $this->map['binhchons']['current']['hop_le']?'style="color:#000;font-weight:bold;"':'style="color:#666"'?>>
          <td align="center"><?php echo $this->map['binhchons']['current']['i'];?></td>
          <td><?php echo $this->map['binhchons']['current']['vong_dau'];?></td>
          <td><?php 
				if((User::can_admin(MODULE_QUANLYCAUTHU,ANY_CATEGORY) or 1==1))
				{?> <?php echo $this->map['binhchons']['current']['from_web']?'<img src="skins/ssnh/images/from_web.png">':'<img src="skins/ssnh/images/from_mobile.png">';?>
				<?php
				}
				?></td>
          <td><?php echo $this->map['binhchons']['current']['nguoi_choi'];?></td>
          <td align="center"><?php echo $this->map['binhchons']['current']['cmtnd'];?></td>
          <td align="left">
          <?php 
				if((xem_clb_trong_binh_chon($this->map['binhchons']['current']['nguoi_choi_id'],$this->map['binhchons']['current']['vong_dau_id'])))
				{?>
          <?php echo $this->map['binhchons']['current']['clb'];?>
           <?php }else{ ?>
          <span style="color:#F00">Ẩn</span>
          
				<?php
				}
				?>
          </td>
          <td align="center"><?php echo $this->map['binhchons']['current']['thoi_gian_binh_chon'];?> <?php if(User::can_admin(MODULE_QUANLYCAUTHU,ANY_CATEGORY)){?><a href="<?php echo Url::build_current(array('do'=>'delete','id'=>$this->map['binhchons']['current']['id']));?>" onClick="if(!confirm('Bạn có chắc không?')){return false;}" style="color:#FF0004;">Xóa</a><?php }?></td>
        </tr>
        
							
						<?php
							}
						}
					unset($this->map['binhchons']['current']);
					} ?>
      </table>
    </div> <!-- End .tab-page-category-1 -->
  </div>
  <div style="padding:10px;text-align:center;">
  	<input id="get_ket_qa_button" type="button" value="Quay" class="button round big">
  </div>
</div>
<div id="spin_wrapper">
Xử lý kết quả ... 
</div>
<script>
	jQuery(document).ready(function(e) {
			jQuery('#get_ket_qa_button').click(function(){
				if(jQuery('#vong_dau_id').val()){
					getKetQua(jQuery('#vong_dau_id').val());
				}else{
					alert('Vui lòng chọn vòng đấu...!');
				}
			});
  });
	function getKetQua(vong_dau_id){
		jQuery.ajax({
			method: "POST",
			url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
			data : {
				'do':'get_ket_qua',
				vong_dau_id:vong_dau_id
			},
			beforeSend: function(){
				jQuery('#spin_wrapper').show();
			},
			success: function(content){
				alert(content);
			},
			error: function(){
				alert('Update lỗi');
			}
		});
	}
</script>