<link href="skins/admin/scripts/jquery.cleditor.css" rel="stylesheet"/>
<script src="skins/admin/scripts/jquery.cleditor.min.js"></script>
<span style="display:none">
	<span id="mi_clb_sample">
		<div id="input_group_#xxxx#" class="multi-item-group">
      <span class="multi-edit-input" style="width:20px;"><input  type="checkbox" id="_checked_#xxxx#" tabindex="-1"></span>
      <span class="multi-edit-input" style="width:40px;"><input  name="mi_clb[#xxxx#][id]" type="text" id="id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1"></span>
      <span class="multi-edit-input"><input  name="mi_clb[#xxxx#][so_thu_tu]" style="width:40px;" class="multi-edit-text-input" type="text" id="so_thu_tu_#xxxx#"></span>
      <span class="multi-edit-input no-border" style="width:30px;cursor:pointer;position:relative;" onclick="window.open('?page=quan_ly_cau_thu&clb_id='+getId('id_#xxxx#').value)"><span><img id="img_logo_#xxxx#" style="width:30px;position:absolute;top:0px;background:#EFEFEF;z-index:1" class="img" onMouseOver="jQuery(this).css({width:150,'z-index':2})" onMouseOut="jQuery(this).css({width:30,'z-index':1})"></span></span>
      <span class="multi-edit-input no-border"><input  name="logo_#xxxx#" type="file" id="logo_#xxxx#" class="multi-edit-text-input" style="width:85px;text-align:right;"></span>
      <span class="multi-edit-input"><input  name="mi_clb[#xxxx#][ten_viet_tat]" style="width:80px;" class="multi-edit-text-input" type="text" id="ten_viet_tat_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_clb[#xxxx#][ten]" style="width:150px;" class="multi-edit-text-input" type="text" id="ten_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_clb[#xxxx#][ngay_thanh_lap]" style="width:100px;text-align:center" class="multi-edit-text-input" type="text" id="ngay_thanh_lap_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_clb[#xxxx#][san_van_dong]" style="width:150px;" class="multi-edit-text-input" type="text" id="san_van_dong_#xxxx#"></span>
      <span class="multi-edit-input"><textarea  name="mi_clb[#xxxx#][mo_ta]" style="width:300px;" class="multi-edit-text-input" id="mo_ta_#xxxx#" onclick="jQuery('#mo_ta_#xxxx#').cleditor();" onblur="jQuery('#mo_ta_#xxxx#').cleditor().disable(true);"></textarea></span>
      <span class="multi-edit-input"><select  name="mi_clb[#xxxx#][mua_giai_id]" style="width:100px;" class="multi-edit-text-input" id="mua_giai_id_#xxxx#">[[|mua_giai_options|]]</select></span>
      <span class="multi-edit-input no-border" style="width:20px;"><img src="skins/default/images/buttons/delete.gif" onClick="mi_delete_row(getId('input_group_#xxxx#'),'mi_clb','#xxxx#','');event.returnValue=false;" style="cursor:pointer;"/></span>
      <br clear="all">
		</div>
	</span>
</span>
<?php 
$title = (URL::get('cmd')=='delete')?'Xóa câu lạc bộ':'Danh sách câu lạc bộ';?>
<div align="center">
<form name="EditQuanLyClbForm" method="post" enctype="multipart/form-data"><br>
<nav class="tab">
  <ul>
    <li<?php echo (Session::get('mua_giai_id')==1)?' class="active"':''?>><a href="?page=quan_ly_clb&mua_giai_id=1">2014-2015</a></li>
    <li<?php echo (Session::get('mua_giai_id')==2)?' class="active"':''?>><a href="?page=quan_ly_clb&mua_giai_id=2">2015-2016</a></li>
  </ul>
</nav>
<table cellspacing="0" width="100%" class="multi-item-table">
	<tr valign="top" bgcolor="#FFFFFF">
		<td align="left">
        <table cellpadding="15" cellspacing="0" width="100%" border="0" bordercolor="#CCCCCC" class="table-bound">
            <tr>
                <td class="form-title" width="100%"><?php echo $title;?></td>
                <?php if(User::can_add(false,ANY_CATEGORY)){?><td width="1%"><a href="javascript:void(0)" onclick="EditQuanLyClbForm.submit();"  class="button-medium-save">Ghi</a></td><?php }?>
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
          <span class="multi-edit-input header" style="width:30px;">LOGO</span>
          <span class="multi-edit-input header" style="width:85px;">Chọn LOGO</span>
          <span class="multi-edit-input header" style="width:80px;">Tên Viết tắt</a></span>
          <span class="multi-edit-input header" style="width:150px;">Tên CLB</a></span>
					<span class="multi-edit-input header" style="width:100px;">Ngày thành lập</a></span>
          <span class="multi-edit-input header" style="width:150px;">Sân vận động</a></span>
          <span class="multi-edit-input header" style="width:300px;">Mô tả</span>
          <span class="multi-edit-input header" style="width:100px;">Mùa giải</span>
          <span class="multi-edit-input header no-border no-bg" style="width:20px;">&nbsp;</span>
          <br clear="all">
        </span>
      </span>
		</div>
    <br clear="all">
		<div style="padding:5px;"><input type="button" value="   Thêm mới   " onclick="mi_add_new_row('mi_clb');"></div>
		<div>[[|paging|]]</div>
		</td>
	</tr>
	</table>
    <input name="confirm_edit" type="hidden" value="1" />
	</td>
</tr>
</table>
</form>
<script src="packages/core/includes/js/multi_items.js"></script>
<script>
mi_init_rows('mi_clb',<?php if(isset($_REQUEST['mi_clb'])){echo String::array2js($_REQUEST['mi_clb']);}else{echo '[]';}?>);
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

