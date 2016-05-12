<script language="Javascript" type="text/javascript" src="skins/admin/scripts/code_editor/edit_area_full.js"></script>
<script src="packages/core/includes/js/multi_items.js"></script>
<span style="display:none">
	<span id="mi_ket_qua_sample">
		<div id="input_group_#xxxx#" class="multi-item-group">
      <span class="multi-edit-input" style="width:20px;"><input  type="checkbox" id="_checked_#xxxx#" tabindex="-1"></span>
      <span class="multi-edit-input" style="width:40px;"><input  name="mi_ket_qua[#xxxx#][id]" type="text" id="id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1"></span>
      <span class="multi-edit-input"><input  name="mi_ket_qua[#xxxx#][so_thu_tu]" style="width:40px;" class="multi-edit-text-input" type="text" id="so_thu_tu_#xxxx#"></span>
      <span class="multi-edit-input"><select  name="mi_ket_qua[#xxxx#][doi_chu_nha_id]" style="width:120px;" class="multi-edit-text-input" id="doi_chu_nha_id_#xxxx#"><?php echo $this->map['doi_chu_nha_options'];?></select></span>
      <span class="multi-edit-input"><input  name="mi_ket_qua[#xxxx#][diem_doi_chu_nha]" style="width:50px;text-align:center" class="multi-edit-text-input" type="text" id="diem_doi_chu_nha_#xxxx#" readonly tabindex="-1"></span>
      <span class="multi-edit-input"><select  name="mi_ket_qua[#xxxx#][doi_khach_id]" style="width:120px;" class="multi-edit-text-input" id="doi_khach_id_#xxxx#"><?php echo $this->map['doi_khach_options'];?></select></span>
      <span class="multi-edit-input"><input  name="mi_ket_qua[#xxxx#][diem_doi_khach]" style="width:50px;text-align:center" class="multi-edit-text-input" type="text" id="diem_doi_khach_#xxxx#" readonly tabindex="-1"></span>
      <span class="multi-edit-input"><input  name="mi_ket_qua[#xxxx#][ket_qua]" style="width:60px;text-align:center" class="multi-edit-text-input" type="text" id="ket_qua_#xxxx#" onchange="update_diem();"></span>
      <span class="multi-edit-input"><input  name="mi_ket_qua[#xxxx#][thoi_gian]" style="width:120px;text-align:center" class="multi-edit-text-input" type="text" id="thoi_gian_#xxxx#"></span>
      <span class="multi-edit-input" style="width:30px;"><input  name="mi_ket_qua[#xxxx#][hide]" type="checkbox" id="hide_#xxxx#" value="1"></span>
      <span class="multi-edit-input no-border" style="width:20px;"><img src="skins/default/images/buttons/delete.gif" onClick="mi_delete_row(getId('input_group_#xxxx#'),'mi_ket_qua','#xxxx#','');event.returnValue=false;" style="cursor:pointer;"/></span>
		</div>
    <br clear="all">
	</span>
</span>
<?php 
$title = (URL::get('cmd')=='delete')?'Xóa lịch thi đấu ĐHSS':'Lịch thi đấu của các đội ĐHSS';?>
<div align="center"><br>
<form name="EditFmgScheduleAdminForm" method="post" enctype="multipart/form-data">
<nav class="tab">
  <ul>
  	<?php
					if(isset($this->map['servers']) and is_array($this->map['servers']))
					{
						foreach($this->map['servers'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['servers']['current'] = &$item1;?>
    <li<?php echo (Session::get('server_id')==$this->map['servers']['current']['id'])?' class="active"':''?>><a href="<?php echo Url::build_current(array('clb_id','server_id'=>$this->map['servers']['current']['id']));?>"><?php echo $this->map['servers']['current']['name'];?></a></li>
    
							
						<?php
							}
						}
					unset($this->map['servers']['current']);
					} ?>
  </ul>
</nav>
<table cellspacing="0" width="100%" class="multi-item-table">
	<tr valign="top" bgcolor="#FFFFFF">
		<td align="left">
        <table cellpadding="15" cellspacing="0" width="100%" border="0" bordercolor="#CCCCCC" class="table-bound">
            <tr>
                <td class="form-title" width="100%"><?php echo $title;?></td>
                <?php 
				if((1==1))
				{?>
                <?php if(User::can_add(false,ANY_CATEGORY)){?><td width="1%"><a href="javascript:void(0)" onclick="EditFmgScheduleAdminForm.submit();"  class="button-medium-save">Ghi</a></td><?php }?>
                <td width="1%"><a href="<?php echo Url::build_current(array('vong_dau_id'));?>" class="button-medium-back">Hủy</a></td>
                
				<?php
				}
				?>
                <?php 
				if((Url::get('ids')))
				{?>
                <td><input type="button" value="  Xóa  " onclick="mi_delete_selected_row('mi_ket_qua');"  class="button-medium-delete"/></td>
                
				<?php
				}
				?>
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
        <?php
					if(isset($this->map['vongdaus']) and is_array($this->map['vongdaus']))
					{
						foreach($this->map['vongdaus'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['vongdaus']['current'] = &$item2;?>
        <li <?php echo (Url::iget('vong_dau_id')==$this->map['vongdaus']['current']['id'])?'class="active"':'';?>><a href="<?php echo Url::build_current(array('clb_id','vong_dau_id'=>$this->map['vongdaus']['current']['id'],'clb_id'));?>"><?php echo $this->map['vongdaus']['current']['ten'];?></a></li>
        
							
						<?php
							}
						}
					unset($this->map['vongdaus']['current']);
					} ?>
      </ul>
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
					<span class="multi-edit-input header" style="width:120px;">Đội chủ nhà</span>
          <span class="multi-edit-input header" style="width:50px;">Điểm</span>
          <span class="multi-edit-input header" style="width:120px;">Đội khách</span>
          <span class="multi-edit-input header" style="width:50px;">Điểm</span>
          <span class="multi-edit-input header" style="width:60px;">Kết quả</span>
          <span class="multi-edit-input header" style="width:120px;">Thời gian</span>
          <span class="multi-edit-input header" style="width:30px;">Ẩn</span>
          <span class="multi-edit-input header no-border no-bg" style="width:20px;">&nbsp;</span>
          <br clear="all">
        </span>
      </span>
		</div>
    <br clear="all">
		<div style="padding:5px;"><input type="button" value="   Thêm mới   " onclick="mi_add_new_row('mi_ket_qua');jQuery('#thoi_gian_'+input_count).appendDtpicker();"></div>
		<div><?php echo $this->map['paging'];?></div>
		</td>
	</tr>
	</table>
    <input  name="confirm_edit" value="1" / type ="hidden" value="<?php echo String::html_normalize(URL::get('confirm_edit'));?>">
    <input  name="vong_dau_id" type="hidden" id="vong_dau_id" value="<?php echo Url::iget('vong_dau_id');?>" />
	</td>
</tr>
</table>
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
<script type="text/javascript" src="skins/ssnh/scripts/datetimepicker.js"></script>
<link type="text/css" href="skins/ssnh/styles/datetimepicker.css" rel="stylesheet" />
<script>
mi_init_rows('mi_ket_qua',<?php if(isset($_REQUEST['mi_ket_qua'])){echo String::array2js($_REQUEST['mi_ket_qua']);}else{echo '[]';}?>);
jQuery(document).ready(function(){
	for(var i=101;i<=input_count;i++){
		if(getId('thoi_gian_'+i)){d
			jQuery('#thoi_gian_'+i).appendDtpicker();
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
