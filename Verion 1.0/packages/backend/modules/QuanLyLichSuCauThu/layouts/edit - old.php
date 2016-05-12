<script src="packages/core/includes/js/multi_items.js"></script>
<span style="display:none">
	<span id="mi_lich_su_sample">
		<div id="input_group_#xxxx#" class="multi-item-group">
      <span class="multi-edit-input" style="width:20px;"><input  type="checkbox" id="_checked_#xxxx#" tabindex="-1"></span>
      <span class="multi-edit-input" style="width:40px;"><input  name="mi_lich_su[#xxxx#][id]" type="text" id="id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][ten]" style="width:120px;" class="multi-edit-text-input" type="text" id="ten_#xxxx#" tabindex="-1"><input  name="mi_lich_su[#xxxx#][cau_thu_id]" style="width:30px;" class="multi-edit-text-input" type="hidden" id="cau_thu_id_#xxxx#" tabindex="-1"><input  name="mi_lich_su[#xxxx#][ma_vi_tri]" style="width:30px;" class="multi-edit-text-input" type="hidden" id="ma_vi_tri_#xxxx#" tabindex="-1"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_phut_thi_dau]" style="width:50px;" class="multi-edit-text-input count-total" type="text" id="so_phut_thi_dau_#xxxx#" onchange="updateDiem('#xxxx#');"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_the_vang]" style="width:50px;" class="multi-edit-text-input count-total" type="text" id="so_the_vang_#xxxx#" onchange="updateDiem('#xxxx#');"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_the_do]" style="width:50px;" class="multi-edit-text-input count-total" type="text" id="so_the_do_#xxxx#" onchange="updateDiem('#xxxx#');"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_kien_tao]" style="width:50px;" class="multi-edit-text-input count-total" type="text" id="so_kien_tao_#xxxx#" onchange="updateDiem('#xxxx#');"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_ghi_ban]" style="width:50px;" class="multi-edit-text-input count-total" type="text" id="so_ghi_ban_#xxxx#" onchange="updateDiem('#xxxx#');"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_giu_sach_luoi]" style="width:50px;" class="multi-edit-text-input count-total" type="text" id="so_giu_sach_luoi_#xxxx#" onchange="updateDiem('#xxxx#');"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_thung_luoi]" style="width:60px;" class="multi-edit-text-input count-total" type="text" id="so_thung_luoi_#xxxx#" onchange="updateDiem('#xxxx#');"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_ban_thua]" style="width:50px;" class="multi-edit-text-input count-total" type="text" id="so_ban_thua_#xxxx#" onchange="updateDiem('#xxxx#');"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_can_pha]" style="width:50px;" class="multi-edit-text-input count-total" type="text" id="so_can_pha_#xxxx#" onchange="updateDiem('#xxxx#');"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_can_penalty]" style="width:50px;" class="multi-edit-text-input count-total" type="text" id="so_can_penalty_#xxxx#" onchange="updateDiem('#xxxx#');"></span>
			<span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_truot_penalty]" style="width:60px;" class="multi-edit-text-input count-total" type="text" id="so_truot_penalty_#xxxx#" onchange="updateDiem('#xxxx#');"></span>      
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_phan_luoi_nha]" style="width:50px;" class="multi-edit-text-input count-total" type="text" id="so_phan_luoi_nha_#xxxx#" onchange="updateDiem('#xxxx#');"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][diem]" style="width:40px;font-weight:bold;color:#F00;" class="multi-edit-text-input" type="text" id="diem_#xxxx#" tabindex="-1"></span>
			<span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][cao_nhat]" type="checkbox" id="cao_nhat_#xxxx#" value="1" style="width:40px;"></span>
      <span class="multi-edit-input no-border" style="width:30px;"><span><img id="img_anh_dai_dien_#xxxx#" style="width:30px;" class="img" onclick="window.open(this.src)"></span></span>
      <span class="multi-edit-input no-border"><input  name="anh_dai_dien_#xxxx#" type="file" id="anh_dai_dien_#xxxx#" class="multi-edit-text-input" style="width:55px;text-align:right;"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][video]" style="width:45px;" class="multi-edit-text-input" type="text" id="video_#xxxx#"></span>
		</div>
    <br clear="all">
	</span>
</span>
<?php 
$title = (URL::get('cmd')=='delete')?'Xóa lịch sử cầu thủ':'Lịch sử cầu thủ';?>
<div align="center">
<form name="EditQuanLyLichSuCauThuForm" method="post" enctype="multipart/form-data">
<table cellspacing="0" width="100%" class="multi-item-table">
	<tr valign="top" bgcolor="#FFFFFF">
		<td align="left">
        <table cellpadding="15" cellspacing="0" width="100%" border="0" bordercolor="#CCCCCC" class="table-bound">
            <tr>
                <td class="form-title" width="100%"><?php echo $title;?></td>
                <?php if(User::can_add(false,ANY_CATEGORY) and Url::get('clb_id') and Url::get('vong_dau_id')){?><td width="1%"><a href="javascript:void(0)" onclick="EditQuanLyLichSuCauThuForm.submit();"  class="button-medium-save">Ghi</a></td><?php }?>
            </tr>
        </table>
		</td>
	</tr>
	<tr valign="top">	
	<td>
  <div class="navi-list" style="float:left;width:160px;">
    <h2><a href="?page=quan_ly_clb">CLB</a></h2>
    <ul>
    	<!--LIST:clbs-->
    	<li <?php echo (Url::iget('clb_id')==[[=clbs.id=]])?'class="active"':'';?>><a href="<?php echo Url::build_current(array('vong_dau_id','clb_id'=>[[=clbs.id=]]))?>">[[|clbs.ten|]] <span>([[|clbs.sl_cau_thu|]])</span></a></li>
      <!--/LIST:clbs-->
    </ul>
  </div>
	<input  name="selected_ids" type="hidden" value="<?php echo URL::get('selected_ids');?>">
	<input  name="deleted_ids" id="deleted_ids" type="hidden" value="<?php echo URL::get('deleted_ids');?>">
	<table cellpadding="5" cellspacing="0" class="main-table">
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
  <tr valign="top">
		<td>
		<div class="multi-item-wrapper">
      <span id="mi_lich_su_all_elems">
        <span style="white-space:nowrap;">
          <span class="multi-edit-input header" style="width:20px;"><input type="checkbox" value="1" onclick="mi_select_all_row('mi_lich_su',this.checked);"></span>
          <span class="multi-edit-input header" style="width:40px;">ID</span>
          <span class="multi-edit-input header" style="width:120px;">Tên cầu thủ</span>
          <span class="multi-edit-input header" style="width:50px;">Số phút</span>
          <span class="multi-edit-input header" style="width:50px;">Thẻ vàng</span>
          <span class="multi-edit-input header" style="width:50px;">Thẻ đỏ</span>
          <span class="multi-edit-input header" style="width:50px;">Kiến tạo</span>
          <span class="multi-edit-input header" style="width:50px;">Ghi bàn</span>
          <span class="multi-edit-input header" style="width:50px;">Giữ SL</span>
          <span class="multi-edit-input header" style="width:60px;">Thủng lưới</span>
          <span class="multi-edit-input header" style="width:50px;">Bàn thua</span>
          <span class="multi-edit-input header" style="width:50px;">Cản phá</span>
          <span class="multi-edit-input header" style="width:50px;">Cản Pen</span>
          <span class="multi-edit-input header" style="width:60px;">Trượt Pen</span>
          <span class="multi-edit-input header" style="width:50px;">Phản LN</span>
          <span class="multi-edit-input header" style="width:40px;">Điểm</span>
          <span class="multi-edit-input header" style="width:40px;">TOP</span>
          <span class="multi-edit-input header" style="width:30px;">Ảnh</span>
          <span class="multi-edit-input header" style="width:55px;">Chọn ảnh</span>
          <span class="multi-edit-input header" style="width:45px;">Video</span>
          <br clear="all">
        </span>
      </span>
      [[|notification|]]
		</div>
    <br clear="all">
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
mi_init_rows('mi_lich_su',<?php if(isset($_REQUEST['mi_lich_su'])){echo String::array2js($_REQUEST['mi_lich_su']);}else{echo '[]';}?>);
jQuery(document).ready(function(){
	 updateAllDiem();
});
function updateDiem(i){
	if(getId('id_'+i)){
		$mvt = getId('ma_vi_tri_'+i).value;
		
		$ghiban = to_numeric(getId('so_ghi_ban_'+i).value?getId('so_ghi_ban_'+i).value:0);
		diemGhiBan = (($mvt=='TM' || $mvt=='HV')?($ghiban*6):(($mvt=='TV')?($ghiban*5):($ghiban*4)));
		
		diemPhutThiDau = (to_numeric(getId('so_phut_thi_dau_'+i).value)>0)?((to_numeric(getId('so_phut_thi_dau_'+i).value)<60)?1:3):0;
		diemTheVang = to_numeric(getId('so_the_vang_'+i).value)*(-1);
		diemTheDo = to_numeric(getId('so_the_do_'+i).value)*(-3);
		diemKienTao = to_numeric(getId('so_kien_tao_'+i).value)*3;
		
		$giusachluoi = to_numeric(getId('so_giu_sach_luoi_'+i).value)?1:0;
		if($giusachluoi){
			getId('so_ban_thua_'+i).value = 0;
		}
		diemSachLuoi = ((($mvt=='TM' || $mvt=='HV') && $giusachluoi)?(6):0);
		
		$thungluoi = to_numeric(getId('so_thung_luoi_'+i).value);
		if($mvt=='TM' || $mvt=='HV'){
			if($thungluoi>=2){
				diemThungLuoi = Math.floor($thungluoi/2);
			}else{
				diemThungLuoi = 0;
			}
		}else{
			diemThungLuoi = 0;
		}
		if($mvt=='TM'){
			$canpha = to_numeric(getId('so_can_pha_'+i).value);
			if($canpha>=3){
				diemCanPha = Math.floor($canpha/3);
			}else{
				diemCanPha = 0;
			}
		}else{
			diemCanPha = 0;
		}
		diemCanPenalty = ($mvt=='TM')?to_numeric(getId('so_can_penalty_'+i).value)*5:0;
		diemPhanLuoiNha = to_numeric(getId('so_phan_luoi_nha_'+i).value)*(-2);
		diemTruotPenalty = to_numeric(getId('so_truot_penalty_'+i).value)*(-2);
		getId('diem_'+i).value = diemPhutThiDau
														+ diemTheVang
														+ diemTheDo
														+ diemKienTao
														+ diemGhiBan
														+ diemSachLuoi
														+ diemThungLuoi*(-1)
														+ diemCanPha
														+ diemCanPenalty
														+ diemPhanLuoiNha
														+ diemTruotPenalty														
		//jQuery('#ngay_sinh_'+i).datepicker({dateFormat:'yy-mm-dd'});
	}
}
function updateAllDiem(){
	for(var i=101;i<=input_count;i++){
			updateDiem(i);
	}
}
</script>
