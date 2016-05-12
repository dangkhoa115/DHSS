<script type="text/javascript" src="skins/ssnh/scripts/datetimepicker.js"></script>
<link type="text/css" href="skins/ssnh/styles/datetimepicker.css" rel="stylesheet" />
<script src="packages/core/includes/js/multi_items.js"></script>
<span style="display:none">
	<span id="mi_vong_dau_sample">
		<div id="input_group_#xxxx#" class="multi-item-group">
      <span class="multi-edit-input" style="width:20px;"><input  type="checkbox" id="_checked_#xxxx#" tabindex="-1"></span>
      <span class="multi-edit-input" style="width:40px;"><input  name="mi_vong_dau[#xxxx#][id]" type="text" id="id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1"></span>
      <span class="multi-edit-input"><input  name="mi_vong_dau[#xxxx#][so_thu_tu]" style="width:40px;" class="multi-edit-text-input" type="text" id="so_thu_tu_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_vong_dau[#xxxx#][ten]" style="width:100px;" class="multi-edit-text-input" type="text" id="ten_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_vong_dau[#xxxx#][tu_ngay]" style="width:70px;" class="multi-edit-text-input" type="text" id="tu_ngay_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_vong_dau[#xxxx#][den_ngay]" style="width:70px;" class="multi-edit-text-input" type="text" id="den_ngay_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_vong_dau[#xxxx#][tu_ngay_sms]" style="width:125px;" class="multi-edit-text-input" type="text" id="tu_ngay_sms_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_vong_dau[#xxxx#][den_ngay_sms]" style="width:125px;" class="multi-edit-text-input" type="text" id="den_ngay_sms_#xxxx#"></span>
			<span class="multi-edit-input"><select  name="mi_vong_dau[#xxxx#][mua_giai_id]" style="width:100px;" class="multi-edit-text-input" id="mua_giai_id_#xxxx#"><?php echo $this->map['mua_giai_options'];?></select></span>
      <span class="multi-edit-input"><input  name="mi_vong_dau[#xxxx#][tin_lien_quan_ids]" style="width:200px;" class="multi-edit-text-input" type="text" id="tin_lien_quan_ids_#xxxx#" placeholder="VD: id1,id2,id3"></span>
      <span class="multi-edit-input" style="width:50px;"><input  name="mi_vong_dau[#xxxx#][disabled]" type="checkbox" id="disabled_#xxxx#" value="1"></span>
      <?php 
				if((Url::get('do')=='ct'))
				{?>
      <span class="multi-edit-input"><input  name="mi_vong_dau[#xxxx#][nguoi_chien_thang]" style="width:300px;" class="multi-edit-text-input" type="text" id="nguoi_chien_thang_#xxxx#" placeholder="VD: acc1,acc2,acc3"></span>
       <?php }else{ ?>
     
      
				<?php
				}
				?>
      <span class="multi-edit-input no-border" style="width:20px;"><img src="skins/default/images/buttons/delete.gif" onClick="mi_delete_row(getId('input_group_#xxxx#'),'mi_vong_dau','#xxxx#','');event.returnValue=false;" style="cursor:pointer;"/></span>
		</div>
    <br clear="all">
	</span>
</span>
<?php 
$title = (URL::get('cmd')=='delete')?'Xóa vòng đấu':'Vòng đấu';?>
<div align="center"><br>
<form name="EditQuanLyVongDauForm" method="post" enctype="multipart/form-data">
<nav class="tab">
  <ul>
    <li<?php echo (Session::get('mua_giai_id')==1)?' class="active"':''?>><a href="<?php echo Url::build_current(array('keyword','mua_giai_id'=>1));?>">2014-2015</a></li>
    <li<?php echo (Session::get('mua_giai_id')==2)?' class="active"':''?>><a href="<?php echo Url::build_current(array('keyword','mua_giai_id'=>2));?>">2015-2016</a></li>
  </ul>
</nav>
<table cellspacing="0" width="100%" class="multi-item-table">
	<tr valign="top" bgcolor="#FFFFFF">
		<td align="left">
        <table cellpadding="15" cellspacing="0" width="100%" border="0" bordercolor="#CCCCCC" class="table-bound">
            <tr>
                <td class="form-title" width="100%"><?php echo $title;?></td>
                <?php if(User::can_add(false,ANY_CATEGORY)){?><td width="1%"><a href="javascript:void(0)" onclick="EditQuanLyVongDauForm.submit();"  class="button-medium-save">Ghi</a></td><?php }?>
                <td><input type="button" value="Cập nhật người thắng" onclick="location='<?php echo URL::build_current(array('do'=>'ct'));?>';"/></td>
                <td><input type="button" value="  Xóa  " onclick="mi_delete_selected_row('mi_vong_dau');" /></td>
            </tr>
        </table>
		</td>
	</tr>
	<tr valign="top">	
	<td>
	<input  name="selected_ids" type="hidden" value="<?php echo URL::get('selected_ids');?>">
	<input  name="deleted_ids" id="deleted_ids" type="hidden" value="<?php echo URL::get('deleted_ids');?>">
	<table width="100%" cellpadding="5" cellspacing="0">
	<?php if(Form::$current->is_error())
	{
	?><tr valign="top">
	<td><?php echo Form::$current->error_messages();?></td>
	</tr>
	<?php
	}
	?>
  <tr>
  	<td><input  name="keyword" id="keyword" placeholder="Nhập vòng đấu" / type ="text" value="<?php echo String::html_normalize(URL::get('keyword'));?>"> <input  name="search" value="Tìm kiếm" / type ="submit" value="<?php echo String::html_normalize(URL::get('search'));?>"></td>
  </tr>
  <tr valign="top">
		<td>
		<div class="multi-item-wrapper">
      <span id="mi_vong_dau_all_elems">
        <span style="white-space:nowrap;">
          <span class="multi-edit-input header" style="width:20px;"><input type="checkbox" value="1" onclick="mi_select_all_row('mi_vong_dau',this.checked);"></span>
          <span class="multi-edit-input header" style="width:40px;">ID</span>
          <span class="multi-edit-input header" style="width:40px;">STT</span>
          <span class="multi-edit-input header" style="width:100px;">Tên vòng đấu</a></span>
          <span class="multi-edit-input header" style="width:70px;">Từ ngày</a></span>
          <span class="multi-edit-input header" style="width:70px;">Đến ngày</a></span>
          <span class="multi-edit-input header" style="width:125px;">Ngày mở SMS</a></span>
          <span class="multi-edit-input header" style="width:125px;">Ngày đóng SMS</a></span>
          <span class="multi-edit-input header" style="width:100px;">Mùa giải</a></span>
          <span class="multi-edit-input header" style="width:200px;">Tin liên quan</a></span>
          <span class="multi-edit-input header" style="width:50px;">Disable</a></span>
          <?php 
				if((Url::get('do')=='ct'))
				{?>
          <span class="multi-edit-input header" style="width:150px;">Người chiến thắng</a></span> 
          
				<?php
				}
				?>         
          <span class="multi-edit-input header no-border no-bg" style="width:20px;">&nbsp;</span>
          <br clear="all">
        </span>
      </span>
		</div>
    <br clear="all">
		<div style="padding:5px;"><input type="button" value="   Thêm mới   " onclick="mi_add_new_row('mi_vong_dau');jQuery('#tu_ngay_'+input_count).datepicker({dateFormat:'yy-mm-dd'});jQuery('#den_ngay_'+input_count).datepicker({dateFormat:'yy-mm-dd'});jQuery('#tu_ngay_sms_'+input_count).appendDtpicker();jQuery('#den_ngay_sms_'+input_count).appendDtpicker();"></div>
		<div><?php echo $this->map['paging'];?></div>
		</td>
	</tr>
	</table>
    <input  name="confirm_edit" value="1" / type ="hidden" value="<?php echo String::html_normalize(URL::get('confirm_edit'));?>">
    <input  name="do" type="hidden" value="<?php echo Url::get('do');?>" />
	</td>
</tr>
</table>
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
<script>
mi_init_rows('mi_vong_dau',<?php if(isset($_REQUEST['mi_vong_dau'])){echo String::array2js($_REQUEST['mi_vong_dau']);}else{echo '[]';}?>);
jQuery(document).ready(function(){
	for(var i=101;i<=input_count;i++){
		if(getId('id_'+i)){
			jQuery('#tu_ngay_'+i).datepicker({dateFormat:'yy-mm-dd'});
			jQuery('#den_ngay_'+i).datepicker({dateFormat:'yy-mm-dd'});
			jQuery('#tu_ngay_sms_'+i).appendDtpicker();
			jQuery('#den_ngay_sms_'+i).appendDtpicker();
		}
	}
});
function update_diem(){
	for(var i=101;i<=input_count;i++){
		if(getId('id_'+i)){
			kq = getId('ket_qua_'+i).value;
			kq1 = kq.split(':');
			if(kq1[0] == kq1[1]){
				getId('diem_doi_chu_nha_'+i).value = getId('diem_doi_khach_'+i).value = 1;
			}else if(to_numeric(kq1[0]) > to_numeric(kq1[1])){
				getId('diem_doi_chu_nha_'+i).value = 3;
				getId('diem_doi_khach_'+i).value = 0;
			}else if(to_numeric(kq1[0]) < to_numeric(kq1[1])){
				getId('diem_doi_chu_nha_'+i).value = 0;
				getId('diem_doi_khach_'+i).value = 3;
			}else {
				getId('diem_doi_chu_nha_'+i).value = '';
				getId('diem_doi_khach_'+i).value = '';
			}
		}
	}
}
</script>
