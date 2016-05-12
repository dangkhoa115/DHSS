<script src="packages/core/includes/js/multi_items.js"></script>
<span style="display:none">
	<span id="mi_model_sample">
		<span id="input_group_#xxxx#" style="white-space:nowrap;">
			<span class="multi_edit_input">
				<span><input  type="checkbox" id="_checked_#xxxx#"></span>
			</span>
			<span class="multi_edit_input">
				<span style="width:40px;"><input  name="mi_model[#xxxx#][id]" type="text" id="id_#xxxx#" class="multi_edit_text_input" style="width:40px;text-align:right;" readonly="readonly" value="(auto)"></span>
			</span>
       <span class="multi_input">
				<select  name="mi_model[#xxxx#][maker_id]" id="maker_id_#xxxx#" style="width:150px;"><option value=""></option>
					[[|maker_id_options|]]</select>
			</span>
			<span class="multi_edit_input">
				<input  name="mi_model[#xxxx#][name]" style="width:150px;" class="multi_edit_text_input" type="text" id="name_#xxxx#"  tabindex="2">
			</span>
			<span class="multi_edit_input"><span style="width:20px;">
				<img src="skins/default/images/buttons/delete.gif" onClick="mi_delete_row(getId('input_group_#xxxx#'),'mi_model','#xxxx#','');event.returnValue=false;" style="cursor:pointer;"/>
			</span></span><br>
		</span>
	</span>
</span>
<?php 
$title = (URL::get('cmd')=='delete')?'Xóa':'Model';?>
<div align="center">
<form name="EditManageItemModelForm" method="post" >
<table cellspacing="0" width="980px" border="1" bordercolor="#CCCCCC" style="margin-top:3px;text-align:left;">
	<tr valign="top" bgcolor="#FFFFFF">
		<td align="left">
        <table cellpadding="15" cellspacing="0" width="100%" border="0" bordercolor="#CCCCCC" class="table-bound">
            <tr>
                <td class="form-title" width="100%"><?php echo $title;?></td>
                <?php if(User::can_add(false,ANY_CATEGORY)){?><td width="1%"><a href="javascript:void(0)" onclick="EditManageItemModelForm.submit();"  class="button-medium-save">Ghi lại</a></td><?php }?>
                <td><input type="button" value="  [[.delete.]]  " onclick="mi_delete_selected_row('mi_model');" class="button-medium-delete" /></td>
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
      <span id="mi_model_all_elems">
        <span style="white-space:nowrap;">
          <span class="multi_edit_input_header"><span style="width:20px;float:left;"><input type="checkbox" value="1" onclick="mi_select_all_row('mi_model',this.checked);"></span></span>
          <span class="multi_edit_input_header"><span style="width:45px;float:left;">[[.id.]]</span></span>
          <span class="multi_edit_input_header"><span style="width:155px;float:left;">Hãng sx</a></span></span>
          <span class="multi_edit_input_header"><span style="width:155px;float:left;">Tên Model</a></span></span>
          <span class="multi_edit_input_header"><span style="width:20px;"><img src="skins/default/images/spacer.gif"/></span></span>
          <br clear="all">
        </span>
      </span>
		</div>
		<div style="padding:5px;"><input type="button" value="   Thêm mới   " onclick="mi_add_new_row('mi_model');"></div>
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
mi_init_rows('mi_model',<?php if(isset($_REQUEST['mi_model'])){echo String::array2js($_REQUEST['mi_model']);}else{echo '[]';}?>);</script>
