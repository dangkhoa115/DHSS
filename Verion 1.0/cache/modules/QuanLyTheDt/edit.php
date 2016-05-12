`<link href="skins/admin/scripts/jquery.cleditor.css" rel="stylesheet"/>
<script src="skins/admin/scripts/jquery.cleditor.min.js"></script>
<span style="display:none">
	<span id="mi_the_dt_sample">
		<div id="input_group_#xxxx#" class="multi-item-group">
      <span class="multi-edit-input" style="width:20px;"><input  type="checkbox" id="_checked_#xxxx#" tabindex="-1"></span>
      <span class="multi-edit-input" style="width:40px;"><input  name="mi_the_dt[#xxxx#][id]" type="text" id="id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1"></span>
      <span class="multi-edit-input"><select  name="mi_the_dt[#xxxx#][nha_mang]" style="width:100px;" class="multi-edit-text-input" id="nha_mang_#xxxx#"><?php echo $this->map['nha_mang_options'];?></select></span>
      <span class="multi-edit-input"><input  name="mi_the_dt[#xxxx#][so_seri]" style="width:200px;" class="multi-edit-text-input" type="text" id="so_seri_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_the_dt[#xxxx#][ma_the]" style="width:200px;" class="multi-edit-text-input" type="text" id="ma_the_#xxxx#"></span>
      <span class="multi-edit-input"><select  name="mi_the_dt[#xxxx#][trang_thai]" style="width:100px;" class="multi-edit-text-input" id="trang_thai_#xxxx#"><?php echo $this->map['trang_thai_options'];?></select></span>
      <span class="multi-edit-input no-border" style="width:20px;"><img src="skins/default/images/buttons/delete.gif" onClick="mi_delete_row(getId('input_group_#xxxx#'),'mi_the_dt','#xxxx#','');event.returnValue=false;" style="cursor:pointer;"/></span>
      <br clear="all">
		</div>
	</span>
</span>
<?php 
$title = (URL::get('cmd')=='delete')?'Xóa thẻ':'Danh sách thẻ điện thoại';?>
<div align="center">
<form name="EditQuanLyTheDtForm" method="post" enctype="multipart/form-data"><br>
<table cellspacing="0" width="100%" class="multi-item-table">
	<tr valign="top" bgcolor="#FFFFFF">
		<td align="left">
        <table cellpadding="15" cellspacing="0" width="100%" border="0" bordercolor="#CCCCCC" class="table-bound">
            <tr>
                <td class="form-title" width="100%"><?php echo $title;?></td>
                <?php if(User::can_add(false,ANY_CATEGORY)){?><td width="1%"><a href="javascript:void(0)" onclick="EditQuanLyTheDtForm.submit();"  class="button-medium-save">Ghi</a></td><?php }?>
                <td><input type="button" value="  Bỏ thao tác  " onclick="location='<?php echo URL::build_current(array());?>';"/></td>
                <td><input type="button" value="  Xóa  " onclick="mi_delete_selected_row('mi_the_dt');" /></td>
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
      <span id="mi_the_dt_all_elems">
        <span style="white-space:nowrap;">
          <span class="multi-edit-input header" style="width:20px;"><input type="checkbox" value="1" onclick="mi_select_all_row('mi_the_dt',this.checked);"></span>
          <span class="multi-edit-input header" style="width:40px;">ID</span>
          <span class="multi-edit-input header" style="width:100px;">Nhà mạng</span>
          <span class="multi-edit-input header" style="width:200px;">Số seri</span>
          <span class="multi-edit-input header" style="width:200px;">Mã thẻ</span>
          <span class="multi-edit-input header" style="width:100px;">Trạng thái</span>
          <span class="multi-edit-input header no-border no-bg" style="width:20px;">&nbsp;</span>
          <br clear="all">
        </span>
      </span>
		</div>
    <br clear="all">
		<div style="padding:5px;"><input type="button" value="   Thêm mới   " onclick="mi_add_new_row('mi_the_dt');"></div>
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
			
			
<script src="packages/core/includes/js/multi_items.js"></script>
<script>
mi_init_rows('mi_the_dt',<?php if(isset($_REQUEST['mi_the_dt'])){echo String::array2js($_REQUEST['mi_the_dt']);}else{echo '[]';}?>);
</script>
<script>
jQuery(document).ready(function(){
	for(var i=101;i<=input_count;i++){
		if(getId('id_'+i)){
			//jQuery("#mo_ta_"+i).cleditor();
		}
	}
});
</script>

