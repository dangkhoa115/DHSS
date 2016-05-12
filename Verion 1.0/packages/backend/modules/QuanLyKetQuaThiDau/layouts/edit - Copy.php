<link href="skins/admin/scripts/jquery.cleditor.css" rel="stylesheet"/>
<script src="skins/admin/scripts/jquery.cleditor.min.js"></script>
<script src="packages/core/includes/js/multi_items.js"></script>
<span style="display:none">
	<span id="mi_ket_qua_sample">
		<div id="input_group_#xxxx#" class="multi-item-group">
      <span class="multi-edit-input" style="width:20px;"><input  type="checkbox" id="_checked_#xxxx#" tabindex="-1"></span>
      <span class="multi-edit-input" style="width:40px;"><input  name="mi_ket_qua[#xxxx#][id]" type="text" id="id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1"></span>
      <span class="multi-edit-input"><input  name="mi_ket_qua[#xxxx#][so_thu_tu]" style="width:40px;" class="multi-edit-text-input" type="text" id="so_thu_tu_#xxxx#"></span>
      <span class="multi-edit-input"><select  name="mi_ket_qua[#xxxx#][vong_dau_id]" style="width:80px;" class="multi-edit-text-input" id="vong_dau_id_#xxxx#">[[|vong_dau_options|]]</select></span>
      <span class="multi-edit-input"><select  name="mi_ket_qua[#xxxx#][doi_chu_nha_id]" style="width:120px;" class="multi-edit-text-input" id="doi_chu_nha_id_#xxxx#">[[|doi_chu_nha_options|]]</select></span>
      <span class="multi-edit-input"><input  name="mi_ket_qua[#xxxx#][diem_doi_chu_nha]" style="width:50px;text-align:center" class="multi-edit-text-input" type="text" id="diem_doi_chu_nha_#xxxx#" readonly="readonly" tabindex="-1"></span>
      <span class="multi-edit-input"><select  name="mi_ket_qua[#xxxx#][doi_khach_id]" style="width:120px;" class="multi-edit-text-input" id="doi_khach_id_#xxxx#">[[|doi_khach_options|]]</select></span>
      <span class="multi-edit-input"><input  name="mi_ket_qua[#xxxx#][diem_doi_khach]" style="width:50px;text-align:center" class="multi-edit-text-input" type="text" id="diem_doi_khach_#xxxx#" readonly="readonly" tabindex="-1"></span>
      <span class="multi-edit-input"><input  name="mi_ket_qua[#xxxx#][ket_qua]" style="width:60px;text-align:center" class="multi-edit-text-input" type="text" id="ket_qua_#xxxx#" onchange="update_diem();"></span>
      <span class="multi-edit-input"><input  name="mi_ket_qua[#xxxx#][kenh_chieu]" style="width:100px;" class="multi-edit-text-input" type="text" id="kenh_chieu_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_ket_qua[#xxxx#][thoi_gian]" style="width:120px;text-align:center" class="multi-edit-text-input" type="text" id="thoi_gian_#xxxx#"></span>
			<span class="multi-edit-input"><pre><textarea  name="mi_ket_qua[#xxxx#][thong_tin_tran_dau]" style="width:300px;" class="multi-edit-text-input" id="thong_tin_tran_dau_#xxxx#" onclick="jQuery(this).css({'width':'500px','height':300});" onblur="jQuery(this).css({'width':'300px','height':'30px'})"></textarea></pre></span>      
      <span class="multi-edit-input no-border" style="width:20px;"><img src="skins/default/images/buttons/delete.gif" onClick="mi_delete_row(getId('input_group_#xxxx#'),'mi_ket_qua','#xxxx#','');event.returnValue=false;" style="cursor:pointer;"/></span>
		</div>
    <br clear="all">
	</span>
</span>
<?php 
$title = (URL::get('cmd')=='delete')?'Xóa kết quả thi đấu':'Kết quả thi đấu';?>
<div align="center">
<form name="EditQuanLyKetQuaThiDauForm" method="post" enctype="multipart/form-data">
<table cellspacing="0" width="100%" class="multi-item-table">
	<tr valign="top" bgcolor="#FFFFFF">
		<td align="left">
        <table cellpadding="15" cellspacing="0" width="100%" border="0" bordercolor="#CCCCCC" class="table-bound">
            <tr>
                <td class="form-title" width="100%"><?php echo $title;?></td>
                <!--IF:cond(Url::get('do')!='add')-->
								<?php if(User::can_add(false,ANY_CATEGORY)){?><td width="1%"><a href="<?php echo Url::build_current(array('do'=>'add','vong_dau_id'));?>" class="button-medium-add">Thêm mới</a></td><?php }?>
                <!--/IF:cond-->
                <!--IF:cond(Url::get('ids') or Url::get('do')=='add')-->
                <?php if(User::can_add(false,ANY_CATEGORY)){?><td width="1%"><a href="javascript:void(0)" onclick="EditQuanLyKetQuaThiDauForm.submit();"  class="button-medium-save">Ghi</a></td><?php }?>
                <td width="1%"><a href="<?php echo Url::build_current(array('vong_dau_id'));?>" class="button-medium-back">Hủy</a></td>
                <!--/IF:cond-->
                <!--IF:cond(Url::get('ids'))-->
                <td><input type="button" value="  Xóa  " onclick="mi_delete_selected_row('mi_ket_qua');"  class="button-medium-delete"/></td>
                <!--/IF:cond-->
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
  	<td>
    	<ul class="navi-menu">
        <!--LIST:vongdaus-->
        <li <?php echo (Url::iget('vong_dau_id')==[[=vongdaus.id=]])?'class="active"':'';?>><a href="<?php echo Url::build_current(array('clb_id','vong_dau_id'=>[[=vongdaus.id=]],'clb_id'));?>">[[|vongdaus.ten|]]</a></li>
        <!--/LIST:vongdaus-->
      </ul>
    </td>
  </tr>
  <tr>
  	<td>
    	<div class="search" style="float:left;"><input name="keyword" type="text" id="keyword" placeholder="Nhập tên đội" /> <input name="search" type="submit" value="Tìm kiếm" /></div>
      <div class="ids-listt" style="float:right;">
      <a href="#" onclick="showBangMa">+ Bảng mã kết quả</a>
      <input name="ids" type="text" id="ids" placeholder="Nhập id để sửa hoặc xóa: 1,2,3" style="width:300px;" /> <input name="search" type="submit" value=" OK " /></div>
    </td>
  </tr>
  <tr valign="top">
		<td>
		<div class="multi-item-wrapper">
      <span id="mi_ket_qua_all_elems">
        <span style="white-space:nowrap;">
          <span class="multi-edit-input header" style="width:20px;"><input type="checkbox" value="1" onclick="mi_select_all_row('mi_ket_qua',this.checked);"></span>
          <span class="multi-edit-input header" style="width:40px;">ID</span>
          <span class="multi-edit-input header" style="width:40px;">STT</span>
          <span class="multi-edit-input header" style="width:80px;">Vòng đấu</a></span>
					<span class="multi-edit-input header" style="width:120px;">Đội chủ nhà</a></span>
          <span class="multi-edit-input header" style="width:50px;">Điểm</a></span>
          <span class="multi-edit-input header" style="width:120px;">Đội khách</a></span>
          <span class="multi-edit-input header" style="width:50px;">Điểm</a></span>
          <span class="multi-edit-input header" style="width:60px;">Kết quả</a></span>
          <span class="multi-edit-input header" style="width:100px;">Chiếu trên kênh</a></span>
          <span class="multi-edit-input header" style="width:120px;">Thời gian</a></span>
          <span class="multi-edit-input header" style="width:300px;">Chi tiết kết quả</a></span>
          <span class="multi-edit-input header no-border no-bg" style="width:20px;">&nbsp;</span>
          <br clear="all">
        </span>
      </span>
		</div>
    <br clear="all">
    <!--IF:cond(Url::get('do')=='add')-->
		<div style="padding:5px;"><input type="button" value="   Thêm mới   " onclick="mi_add_new_row('mi_ket_qua');jQuery('#ngay_sinh_'+input_count).datepicker({dateFormat:'yy-mm-dd'});"></div>
    <!--/IF:cond-->
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
mi_init_rows('mi_ket_qua',<?php if(isset($_REQUEST['mi_ket_qua'])){echo String::array2js($_REQUEST['mi_ket_qua']);}else{echo '[]';}?>);
for(var i=101;i<=input_count;i++){
	if(getId('id_'+i)){
		//jQuery('#thoi_gian_'+i).datepicker();
	}
}
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
