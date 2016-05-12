<script type="text/javascript" src="skins/ssnh/scripts/datetimepicker.js"></script>
<link type="text/css" href="skins/ssnh/styles/datetimepicker.css" rel="stylesheet" />
<script src="packages/core/includes/js/multi_items.js"></script>
<span style="display:none">
	<span id="mi_items_sample">
		<div id="input_group_#xxxx#" class="multi-item-group">
      <span class="multi-edit-input" style="width:20px;"><input  type="checkbox" id="_checked_#xxxx#" tabindex="-1"></span>
      <span class="multi-edit-input" style="width:40px;"><input  name="mi_items[#xxxx#][id]" type="text" id="id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1"></span>
      <span class="multi-edit-input no-border" style="width:65px;"><span><img id="img_icon_#xxxx#" style="width:64px;" class="img"></span></span>
      <span class="multi-edit-input no-border"><input  name="icon_#xxxx#" type="file" id="icon_#xxxx#" class="multi-edit-text-input" style="width:58px;text-align:right;"></span>
      <span class="multi-edit-input"><input  name="mi_items[#xxxx#][name]" style="width:200px;" class="multi-edit-text-input" type="text" id="name_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_items[#xxxx#][description]" style="width:200px;" class="multi-edit-text-input" type="text" id="description_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_items[#xxxx#][price]" style="width:100px;text-align:right" class="multi-edit-text-input" type="text" id="price_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_items[#xxxx#][cond]" style="width:200px;" class="multi-edit-text-input" type="text" id="cond_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_items[#xxxx#][open_date]" style="width:70px;" class="multi-edit-text-input" type="text" id="open_date_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_items[#xxxx#][expired_date]" style="width:70px;" class="multi-edit-text-input" type="text" id="expired_date_#xxxx#"></span>
      <span class="multi-edit-input"><select  name="mi_items[#xxxx#][type]" id="type_#xxxx#"><?php echo $this->map['type_options'];?></select></span>
      <span class="multi-edit-input no-border" style="width:20px;"><img src="skins/default/images/buttons/delete.gif" onClick="mi_delete_row(getId('input_group_#xxxx#'),'mi_items','#xxxx#','');event.returnValue=false;" style="cursor:pointer;"/></span>
		</div>
    <br clear="all">
	</span>
</span>
<?php 
$title = (URL::get('cmd')=='delete')?'Xóa item':'Danh sách items';?>
<div align="center">
<form name="EditFmgItemAdminForm" method="post" enctype="multipart/form-data">
<table cellspacing="0" width="100%" class="multi-item-table">
	<tr valign="top" bgcolor="#FFFFFF">
		<td align="left">
        <table cellpadding="15" cellspacing="0" width="100%" border="0" bordercolor="#CCCCCC" class="table-bound">
            <tr>
                <td class="form-title" width="100%"><?php echo $title;?></td>
                <?php if(User::can_add(false,ANY_CATEGORY)){?><td width="1%"><a href="javascript:void(0)" onclick="EditFmgItemAdminForm.submit();" class="button-medium-save">Ghi</a></td><?php }?>
                <td><input class="button-medium-delete" type="button" value="  Xóa  " onclick="mi_delete_selected_row('mi_items');" /></td>
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
  	<td><input  name="keyword" id="keyword" placeholder="Nhập từ khóa" / type ="text" value="<?php echo String::html_normalize(URL::get('keyword'));?>"> <input  name="search" value="Tìm kiếm" / type ="submit" value="<?php echo String::html_normalize(URL::get('search'));?>"></td>
  </tr>
  <tr valign="top">
		<td>
		<div class="multi-item-wrapper">
      <span id="mi_items_all_elems">
        <span style="white-space:nowrap;">
          <span class="multi-edit-input header" style="width:20px;"><input type="checkbox" value="1" onclick="mi_select_all_row('mi_items',this.checked);"></span>
          <span class="multi-edit-input header" style="width:40px;">ID</span>
          <span class="multi-edit-input header" style="width:65px;">Ảnh</span>
          <span class="multi-edit-input header" style="width:58px;">Chọn ảnh</span>
          <span class="multi-edit-input header" style="width:200px;">Tên item</span>
          <span class="multi-edit-input header" style="width:200px;">Diễn giải</span>
          <span class="multi-edit-input header" style="width:100px;">Giá</span>
          <span class="multi-edit-input header" style="width:200px;">Điều kiện</span>
          <span class="multi-edit-input header" style="width:70px;">Từ ngày</span>
          <span class="multi-edit-input header" style="width:70px;">Đến ngày</span>
          <span class="multi-edit-input header" style="width:100px;">Loại</span>
          <span class="multi-edit-input header no-border no-bg" style="width:20px;">&nbsp;</span>
          <br clear="all">
        </span>
      </span>
		</div>
    <br clear="all">
		<div style="padding:5px;"><input type="button" value="   Thêm mới   " onclick="mi_add_new_row('mi_items');jQuery('#open_date_'+input_count).datepicker({dateFormat:'yy-mm-dd'});jQuery('#expired_date_'+input_count).datepicker({dateFormat:'yy-mm-dd'});"></div>
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
mi_init_rows('mi_items',<?php if(isset($_REQUEST['mi_items'])){echo String::array2js($_REQUEST['mi_items']);}else{echo '[]';}?>);
jQuery(document).ready(function(){
	for(var i=101;i<=input_count;i++){
		if(getId('id_'+i)){
			jQuery('#open_date_'+i).datepicker({dateFormat:'yy-mm-dd'});
			jQuery('#expired_date_'+i).datepicker({dateFormat:'yy-mm-dd'});
		}
	}
});
</script>
