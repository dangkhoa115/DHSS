<script type="text/javascript" src="skins/ssnh/scripts/datetimepicker.js"></script>
<link type="text/css" href="skins/ssnh/styles/datetimepicker.css" rel="stylesheet" />
<script src="packages/core/includes/js/multi_items.js"></script>
<span style="display:none">
	<span id="mi_nc_ch_th_thang_sample">
		<div id="input_group_#xxxx#" class="multi-item-group">
      <span class="multi-edit-input" style="width:20px;"><input  type="checkbox" id="_checked_#xxxx#" tabindex="-1"></span>
      <span class="multi-edit-input" style="width:40px;"><input  name="mi_nc_ch_th_thang[#xxxx#][id]" type="text" id="id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1"></span>
      <span class="multi-edit-input"><input  name="mi_nc_ch_th_thang[#xxxx#][user_id]" style="width:100px;" class="multi-edit-text-input" type="text" id="user_id_#xxxx#" value="<?php echo Url::get('id')?>"></span>
      <span class="multi-edit-input"><input  name="mi_nc_ch_th_thang[#xxxx#][nam]" style="width:70px;" class="multi-edit-text-input" type="text" id="nam_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_nc_ch_th_thang[#xxxx#][thang]" style="width:70px;" class="multi-edit-text-input" type="text" id="thang_#xxxx#"></span>
      <span class="multi-edit-input no-border" style="width:20px;"><img src="skins/default/images/buttons/delete.gif" onClick="mi_delete_row(getId('input_group_#xxxx#'),'mi_nc_ch_th_thang','#xxxx#','');event.returnValue=false;" style="cursor:pointer;"/></span>
		</div>
    <br clear="all">
	</span>
</span>
<?php 
$title = (URL::get('cmd')=='delete')?'Xóa người chơi chiến thắng':'Người chơi chiến thắng theo tháng';?>
<div align="center">
<form name="EditQuanLyVongDauForm" method="post" enctype="multipart/form-data">
<table cellspacing="0" width="100%" class="multi-item-table">
	<tr valign="top" bgcolor="#FFFFFF">
		<td align="left">
        <table cellpadding="15" cellspacing="0" width="100%" border="0" bordercolor="#CCCCCC" class="table-bound">
            <tr>
                <td class="form-title" width="100%"><?php echo $title;?></td>
                <?php if(User::can_add(false,ANY_CATEGORY)){?><td width="1%"><a href="javascript:void(0)" onclick="EditQuanLyVongDauForm.submit();"  class="button-medium-save">Ghi</a></td><?php }?>
                <td><input type="button" value="  Danh sách gười chơi  " onclick="location='<?php echo URL::build_current(array('kind'=>2));?>';"/></td>
                <td><input type="button" value="  Xóa  " onclick="mi_delete_selected_row('mi_nc_ch_th_thang');" /></td>
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
  <tr valign="top">
		<td>
		<div class="multi-item-wrapper">
      <span id="mi_nc_ch_th_thang_all_elems">
        <span style="white-space:nowrap;">
          <span class="multi-edit-input header" style="width:20px;"><input type="checkbox" value="1" onclick="mi_select_all_row('mi_nc_ch_th_thang',this.checked);"></span>
          <span class="multi-edit-input header" style="width:40px;">ID</span>
          <span class="multi-edit-input header" style="width:100px;">Người chơi</span>
          <span class="multi-edit-input header" style="width:70px;">Năm</span>
          <span class="multi-edit-input header" style="width:70px;">Tháng</span>
          <span class="multi-edit-input header no-border no-bg" style="width:20px;">&nbsp;</span>
          <br clear="all">
        </span>
      </span>
		</div>
    <br clear="all">
		<div style="padding:5px;"><input type="button" value="   Thêm mới   " onclick="mi_add_new_row('mi_nc_ch_th_thang');"></div>
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
mi_init_rows('mi_nc_ch_th_thang',<?php if(isset($_REQUEST['mi_nc_ch_th_thang'])){echo String::array2js($_REQUEST['mi_nc_ch_th_thang']);}else{echo '[]';}?>);
jQuery(document).ready(function(){
	
});
</script>
