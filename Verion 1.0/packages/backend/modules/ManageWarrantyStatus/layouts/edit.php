<script src="packages/core/includes/js/multi_items.js"></script>
<span style="display:none">
	<span id="mi_warranty_status_sample">
		<span id="input_group_#xxxx#" style="float:left;border-bottom:1px solid #999;padding:0px 0px 5px 0px;margin-bottom:10px;background:#FFF;">
            <span class="multi-edit-input"><span style="width:20px;float:left;padding-top:8px;"><input  type="checkbox" id="_checked_#xxxx#"></span></span>
            <span class="multi-edit-input"><span style="width:40px;"><input  name="mi_warranty_status[#xxxx#][id]" type="text" id="id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1" readonly="readonly"></span></span> 
            <span class="multi-edit-input"><input  name="mi_warranty_status[#xxxx#][name]" style="width:250px;" class="multi-edit-text-input" type="text" id="name_#xxxx#"  tabindex="2"></span>
            <span class="multi-edit-input"><input  name="mi_warranty_status[#xxxx#][description]" style="width:400px;" class="multi-edit-text-input" type="text" id="description_#xxxx#"  tabindex="3"></span>
            <span class="multi-edit-input"><input  name="mi_warranty_status[#xxxx#][position]" style="width:90px;" class="multi-edit-text-input" type="text" id="position_#xxxx#"  tabindex="4"></span>
            <span class="multi-edit-input"><span style="width:20px;"><img src="skins/default/images/buttons/delete.gif" onClick="mi_delete_row(getId('input_group_#xxxx#'),'mi_warranty_status','#xxxx#','');event.returnValue=false;" style="cursor:pointer;"/></span></span>
        </span><br clear="all">
	</span>
</span>
<?php 
$title = (URL::get('cmd')=='delete')?'Xóa':'Tình trạng bảo hành';?>
<div align="center">
<form name="EditManageWarrantyStatusForm" method="post" enctype="multipart/form-data">
<table cellspacing="0" width="980px" border="1" bordercolor="#CCCCCC" style="margin-top:3px;text-align:left;">
	<tr valign="top" bgcolor="#FFFFFF">
		<td align="left">
        <table cellpadding="15" cellspacing="0" width="100%" border="0" bordercolor="#CCCCCC" class="table-bound">
            <tr>
                <td class="form-title" width="100%"><?php echo $title;?></td>
                <?php if(User::can_add(false,ANY_CATEGORY)){?><td width="1%"><a href="javascript:void(0)" onclick="EditManageWarrantyStatusForm.submit();"  class="button-medium-save">Ghi lại</a></td><?php }?>
                <td><input class="button-medium-delete" type="button" value="  Xóa  " onclick="mi_delete_selected_row('mi_warranty_status');" /></td>
            </tr>
        </table>
		</td>
	</tr>
	<tr bgcolor="#EFEFEF" valign="top">	
	<td>
	<input  name="selected_ids" type="hidden" value="<?php echo URL::get('selected_ids');?>">
	<input  name="deleted_ids" id="deleted_ids" type="hidden" value="<?php echo URL::get('deleted_ids');?>">
	<table width="100%" cellspacing="3">
	<?php if(Form::$current->is_error())
	{
	?><tr bgcolor="#EFEFEF" valign="top">
	<td bgcolor="#EFEFEF"><?php echo Form::$current->error_messages();?></td>
	</tr>
	<?php
	}
	?><tr bgcolor="#EFEFEF" valign="top">
		<td>
		<div style="background-color:#EFEFEF;">
      <span id="mi_warranty_status_all_elems">
        <span style="white-space:nowrap;">
          <span class="multi-edit-input-header"><span style="width:20px;float:left;"><input type="checkbox" value="1" onclick="mi_select_all_row('mi_warranty_status',this.checked);"></span></span>
          <span class="multi-edit-input-header"><span style="width:45px;float:left;">[[.id.]]</span></span>
          <span class="multi-edit-input-header"><span style="width:255px;float:left;">Thời gian BH</a></span></span>
          <span class="multi-edit-input-header"><span style="width:405px;float:left;">Mô tả</a></span></span>
          <span class="multi-edit-input-header"><span style="width:95px;float:left;">Vị trí</a></span></span>
          <span class="multi-edit-input-header"><span style="width:20px;"><img src="skins/default/images/spacer.gif"/></span></span>
          <br clear="all">
        </span>
      </span>
		</div>
    <br clear="all">
		<div style="padding:5px;"><input type="button" value="   Thêm mới   " onclick="mi_add_new_row('mi_warranty_status');"></div>
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
mi_init_rows('mi_warranty_status',<?php if(isset($_REQUEST['mi_warranty_status'])){echo String::array2js($_REQUEST['mi_warranty_status']);}else{echo '[]';}?>);</script>
