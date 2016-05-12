<script src="packages/core/includes/js/multi_items.js"></script>
<span style="display:none">
	<span id="mi_clb_sample">
		<div id="input_group_#xxxx#" class="multi-item-group">
      <span class="multi-edit-input" style="width:20px;"><input  type="checkbox" id="_checked_#xxxx#" tabindex="-1"></span>
      <span class="multi-edit-input" style="width:40px;"><input  name="mi_clb[#xxxx#][id]" type="text" id="id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1"></span>
      <span class="multi-edit-input"><input  name="mi_clb[#xxxx#][so_thu_tu]" style="width:40px;" class="multi-edit-text-input" type="text" id="so_thu_tu_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_clb[#xxxx#][ten]" style="width:200px;" class="multi-edit-text-input" type="text" id="ten_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_clb[#xxxx#][ma_vi_tri]" style="width:100px;" class="multi-edit-text-input" type="text" id="ma_vi_tri_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_clb[#xxxx#][phong_ngu]" style="width:100px;" class="multi-edit-text-input" type="text" id="phong_ngu_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_clb[#xxxx#][tao_co_hoi]" style="width:100px;" class="multi-edit-text-input" type="text" id="tao_co_hoi_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_clb[#xxxx#][tan_cong]" style="width:100px;" class="multi-edit-text-input" type="text" id="tan_cong_#xxxx#"></span>
      <span class="multi-edit-input no-border" style="width:20px;"><img src="skins/default/images/buttons/delete.gif" onClick="mi_delete_row(getId('input_group_#xxxx#'),'mi_clb','#xxxx#','');event.returnValue=false;" style="cursor:pointer;"/></span>
		</div>
    <br clear="all">
	</span>
</span>
<?php 
$title = (URL::get('cmd')=='delete')?'Xóa vị trí':'Danh sách các vị trí trên sân';?>
<div align="center">
<form name="EditQuanLyViTriForm" method="post" enctype="multipart/form-data">
<table cellspacing="0" width="100%" class="multi-item-table">
	<tr valign="top" bgcolor="#FFFFFF">
		<td align="left">
        <table cellpadding="15" cellspacing="0" width="100%" border="0" bordercolor="#CCCCCC" class="table-bound">
            <tr>
                <td class="form-title" width="100%"><?php echo $title;?></td>
                <?php if(User::can_add(false,ANY_CATEGORY)){?><td width="1%"><a href="javascript:void(0)" onclick="EditQuanLyViTriForm.submit();"  class="button-medium-save">Ghi</a></td><?php }?>
                <td><input type="button" value="  Bỏ thao tác  " onclick="location='<?php echo URL::build_current(array());?>';"/></td>
                <td><input type="button" value="  Xóa  " onclick="mi_delete_selected_row('mi_clb');" /></td>
            </tr>
        </table>
		</td>
	</tr>
	<tr valign="top">	
	<td>
	<input  name="selected_ids" type="hidden" value="<?php echo URL::get('selected_ids');?>">
	<input  name="deleted_ids" id="deleted_ids" type="hidden" value="<?php echo URL::get('deleted_ids');?>">
	<table width="100%" cellspacing="3">
	<?php if(Form::$current->is_error())
	{
	?><tr valign="top">
	<td><?php echo Form::$current->error_messages();?></td>
	</tr>
	<?php
	}
	?><tr valign="top">
		<td>
		<div class="multi-item-wrapper">
      <span id="mi_clb_all_elems">
        <span style="white-space:nowrap;">
          <span class="multi-edit-input header" style="width:20px;"><input type="checkbox" value="1" onclick="mi_select_all_row('mi_clb',this.checked);"></span>
          <span class="multi-edit-input header" style="width:40px;">ID</span>
          <span class="multi-edit-input header" style="width:40px;">STT</span>
          <span class="multi-edit-input header" style="width:200px;">Vị trí</span>
          <span class="multi-edit-input header" style="width:100px;">Mã vị trí</span>
          <span class="multi-edit-input header" style="width:100px;">Phòng ngự</span>
          <span class="multi-edit-input header" style="width:100px;">Tạo cơ hội</span>
          <span class="multi-edit-input header" style="width:100px;">Tấn công</span>
          <span class="multi-edit-input header no-border no-bg" style="width:20px;">&nbsp;</span>
          <br clear="all">
        </span>
      </span>
		</div>
    <br clear="all">
		<div style="padding:5px;"><input type="button" value="   Thêm mới   " onclick="mi_add_new_row('mi_clb');jQuery('#ngay_thanh_lap_'+input_count).datepicker({dateFormat:'yy-mm-dd'});"></div>
		<div>[[|paging|]]</div>
		</td>
	</tr>
	</table>
    <input name="confirm_edit" type="hidden" value="1" />
	</td>
</tr>
</table>
</form>
<script>
mi_init_rows('mi_clb',<?php if(isset($_REQUEST['mi_clb'])){echo String::array2js($_REQUEST['mi_clb']);}else{echo '[]';}?>);
for(var i=101;i<=input_count;i++){
	if(getId('id_'+i)){
		jQuery('#ngay_thanh_lap_'+i).datepicker({dateFormat:'yy-mm-dd'});
	}
}
</script>
