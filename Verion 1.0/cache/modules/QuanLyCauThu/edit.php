<script src="packages/core/includes/js/multi_items.js"></script>
<span style="display:none">
	<span id="mi_cau_thu_sample">
		<div id="input_group_#xxxx#" class="multi-item-group">
      <span class="multi-edit-input" style="width:20px;"><input  type="checkbox" id="_checked_#xxxx#" tabindex="-1"></span>
      <span class="multi-edit-input"><input  name="mi_cau_thu[#xxxx#][id]" type="text" id="id_#xxxx#" class="multi-edit-text-input" style="width:30px;text-align:right;" value="(auto)" tabindex="-1"></span>
      <span class="multi-edit-input"><input  name="mi_cau_thu[#xxxx#][so_thu_tu]" style="width:30px;" class="multi-edit-text-input" type="text" id="so_thu_tu_#xxxx#"></span>
      <span class="multi-edit-input no-border" style="width:60px;"><span><img id="img_anh_dai_dien_#xxxx#" style="width:60px;" class="img"></span></span>
      <span class="multi-edit-input no-border"><input  name="anh_dai_dien_#xxxx#" type="file" id="anh_dai_dien_#xxxx#" class="multi-edit-text-input" style="width:55px;text-align:right;"></span>
      <span class="multi-edit-input"><input  name="mi_cau_thu[#xxxx#][ten]" style="width:120px;" class="multi-edit-text-input" type="text" id="ten_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_cau_thu[#xxxx#][ngay_sinh]" style="width:70px;text-align:center" class="multi-edit-text-input" type="text" id="ngay_sinh_#xxxx#"></span>
      <span class="multi-edit-input"><select   name="mi_cau_thu[#xxxx#][clb_id]" style="width:100px;" class="multi-edit-text-input" id="clb_id_#xxxx#"><?php echo $this->map['clb_options'];?></select></span>
      <span class="multi-edit-input"><select   name="mi_cau_thu[#xxxx#][mua_giai_id]" style="width:100px;font-size:11px;" class="multi-edit-text-input mua-giai" id="mua_giai_id_#xxxx#"><?php echo $this->map['mua_giai_options'];?></select></span>
      <span class="multi-edit-input"><select   name="mi_cau_thu[#xxxx#][vi_tri_id]" style="width:80px;font-size:11px;" class="multi-edit-text-input" id="vi_tri_id_#xxxx#"><?php echo $this->map['vi_tri_options'];?></select></span>
      <span class="multi-edit-input"><input  name="mi_cau_thu[#xxxx#][so_ao]" style="width:40px;" class="multi-edit-text-input" type="text" id="so_ao_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_cau_thu[#xxxx#][chieu_cao]" style="width:40px;" class="multi-edit-text-input" type="text" id="chieu_cao_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_cau_thu[#xxxx#][can_nang]" style="width:40px;" class="multi-edit-text-input" type="text" id="can_nang_#xxxx#"></span>
			<span class="multi-edit-input"><select   name="mi_cau_thu[#xxxx#][quoc_tich_id]" style="width:80px;" class="multi-edit-text-input" id="quoc_tich_id_#xxxx#"><?php echo $this->map['quoc_tich_options'];?></select></span>
      <span class="multi-edit-input"><input  name="mi_cau_thu[#xxxx#][muc_luong]" style="width:60px;text-align:right;" class="multi-edit-text-input" type="text" id="muc_luong_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_cau_thu[#xxxx#][cost]" style="width:40px;text-align:right;color:#FF5F00;" class="multi-edit-text-input" type="text" id="cost_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_cau_thu[#xxxx#][off]" type="checkbox" style="width:40px;" id="off_#xxxx#" value="1"></span>
      <span class="multi-edit-input no-border" style="width:20px;"><img src="skins/default/images/buttons/delete.gif" onClick="mi_delete_row(getId('input_group_#xxxx#'),'mi_cau_thu','#xxxx#','');event.returnValue=false;" style="cursor:pointer;"/></span>
		</div>
    <br clear="all">
	</span>
</span>
<?php 
$title = (URL::get('cmd')=='delete')?'Xóa cầu thủ':'Danh sách cầu thủ';?>
<div align="center">
<form name="EditQuanLyCauThuForm" method="post" enctype="multipart/form-data"><br>
<nav class="tab">
  <ul>
    <li<?php echo (Session::get('mua_giai_id')==1)?' class="active"':''?>><a href="<?php echo Url::build_current(array('clb_id','mua_giai_id'=>1));?>">2014-2015</a></li>
    <li<?php echo (Session::get('mua_giai_id')==2)?' class="active"':''?>><a href="<?php echo Url::build_current(array('clb_id','mua_giai_id'=>2));?>">2015-2016</a></li>
  </ul>
</nav>
<table cellspacing="0" width="100%" class="multi-item-table">
	<tr valign="top" bgcolor="#FFFFFF">
		<td align="left">
        <table cellpadding="15" cellspacing="0" width="100%" border="0" bordercolor="#CCCCCC" class="table-bound">
            <tr>
                <td class="form-title" width="100%"><?php echo $title;?></td>
                <?php if(User::can_add(false,ANY_CATEGORY)){?><td width="1%"><a href="javascript:void(0)" onclick="EditQuanLyCauThuForm.submit();"  class="button-medium-save">Ghi</a></td><?php }?>
                <td><input type="button" value="  Bỏ thao tác  " onclick="location='<?php echo URL::build_current(array());?>';"/></td>
                <td><input type="button" value="  Xóa  " onclick="mi_delete_selected_row('mi_cau_thu');" /></td>
            </tr>
        </table>
		</td>
	</tr>
	<tr valign="top">	
	<td>
  <div class="navi-list" style="float:left;width:160px;">
  	<h2><a href="?page=quan_ly_clb">CLB</a></h2>
    <ul>
    	<li <?php echo !Url::get('clb_id')?'class="active"':'';?>><a href="<?php echo Url::build_current(array())?>">Tất cả<span>(<?php echo $this->map['total'];?>)</span></a></li>
    	<?php
					if(isset($this->map['clbs']) and is_array($this->map['clbs']))
					{
						foreach($this->map['clbs'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['clbs']['current'] = &$item1;?>
    	<li <?php echo (Url::iget('clb_id')==$this->map['clbs']['current']['id'])?'class="active"':'';?>><a href="<?php echo Url::build_current(array('clb_id'=>$this->map['clbs']['current']['id']))?>"><?php echo $this->map['clbs']['current']['ten'];?> <span>(<?php echo $this->map['clbs']['current']['sl_cau_thu'];?>)</span></a></li>
      
							
						<?php
							}
						}
					unset($this->map['clbs']['current']);
					} ?>
    </ul>
  </div>
	<input  name="selected_ids" type="hidden" value="<?php echo URL::get('selected_ids');?>">
	<input  name="deleted_ids" id="deleted_ids" type="hidden" value="<?php echo URL::get('deleted_ids');?>">
	<table width="85%" cellpadding="5" cellspacing="0">
	<?php if(Form::$current->is_error())
	{
	?><tr valign="top">
	<td><?php echo Form::$current->error_messages();?></td>
	</tr>
	<?php
	}
	?>
  <tr>
  	<td><input  name="keyword" id="keyword" placeholder="Nhập tên cầu thủ" / type ="text" value="<?php echo String::html_normalize(URL::get('keyword'));?>"> <input  name="search" value="Tìm kiếm" / type ="submit" value="<?php echo String::html_normalize(URL::get('search'));?>"></td>
  </tr>
  <tr valign="top">
		<td>
		<div class="multi-item-wrapper">
      <span id="mi_cau_thu_all_elems">
        <span style="white-space:nowrap;">
          <span class="multi-edit-input header" style="width:20px;"><input type="checkbox" value="1" onclick="mi_select_all_row('mi_cau_thu',this.checked);"></span>
          <span class="multi-edit-input header" style="width:30px;">ID</span>
          <span class="multi-edit-input header" style="width:30px;">STT</span>
          <span class="multi-edit-input header" style="width:60px;">Ảnh</span>
          <span class="multi-edit-input header" style="width:55px;">Chọn ảnh</span>
          <span class="multi-edit-input header" style="width:120px;">Tên cầu thủ</span>
					<span class="multi-edit-input header" style="width:70px;">Ngày sinh</span>          
          <span class="multi-edit-input header" style="width:100px;">Thuộc CLB</span>
          <span class="multi-edit-input header" style="width:100px;">Mùa giải<br><select  name="move_mua_giai_id" id="move_mua_giai_id" onChange="jQuery('.mua-giai').val(this.value)"><?php
					if(isset($this->map['move_mua_giai_id_list']))
					{
						foreach($this->map['move_mua_giai_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('move_mua_giai_id').value = "<?php echo addslashes(URL::get('move_mua_giai_id',isset($this->map['move_mua_giai_id'])?$this->map['move_mua_giai_id']:''));?>";</script>
	</select></span>          
          <span class="multi-edit-input header" style="width:80px;">Vị trí</span>
          <span class="multi-edit-input header" style="width:40px;">Số áo</span>
          <span class="multi-edit-input header" style="width:40px;">Ch.cao</span>
          <span class="multi-edit-input header" style="width:40px;">C.nặng</span>
          <span class="multi-edit-input header" style="width:80px;">Quốc tịch</span>
          <span class="multi-edit-input header" style="width:60px;">Mức lương</span>
          <span class="multi-edit-input header" style="width:40px;">iGold</span>
          <span class="multi-edit-input header" style="width:40px;">Nghỉ</span>          
          <span class="multi-edit-input header no-border no-bg" style="width:20px;">&nbsp;</span>
          <br clear="all">
        </span>
      </span>
		</div>
    <br clear="all">
		<div style="padding:5px;"><input type="button" value="   Thêm mới   " onclick="mi_add_new_row('mi_cau_thu');jQuery('#ngay_sinh_'+input_count).datepicker({dateFormat:'yy-mm-dd'});"></div>
		<div><?php echo $this->map['paging'];?></div>
		</td>
	</tr>
	</table>
    <input  name="confirm_edit" value="1" / type ="hidden" value="<?php echo String::html_normalize(URL::get('confirm_edit'));?>">
	</td>
</tr>
</table>
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
<script>
mi_init_rows('mi_cau_thu',<?php if(isset($_REQUEST['mi_cau_thu'])){echo String::array2js($_REQUEST['mi_cau_thu']);}else{echo '[]';}?>);
for(var i=101;i<=input_count;i++){
	if(getId('id_'+i)){
		jQuery('#ngay_sinh_'+i).datepicker({dateFormat:'yy-mm-dd'});
	}
}
</script>
