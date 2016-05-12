<style>
.floating-header.floating {
    position: fixed !important;
    top: 0px;
}
</style>
<script>
jQuery(document).ready( function() {
	jQuery(window).scroll( function() {
			if (jQuery(window).scrollTop() - 10 > jQuery('.floating-header-wrapper').offset().top)
					jQuery('.floating-header').addClass('floating');
			else
					jQuery('.floating-header').removeClass('floating');
	});
});
</script>
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
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_ban_thua]" style="width:50px;" class="multi-edit-text-input count-total" type="text" id="so_ban_thua_#xxxx#" onchange="updateDiem('#xxxx#');"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_can_pha]" style="width:50px;" class="multi-edit-text-input count-total" type="text" id="so_can_pha_#xxxx#" onchange="updateDiem('#xxxx#');"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_can_penalty]" style="width:50px;" class="multi-edit-text-input count-total" type="text" id="so_can_penalty_#xxxx#" onchange="updateDiem('#xxxx#');"></span>
			<span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_truot_penalty]" style="width:60px;" class="multi-edit-text-input count-total" type="text" id="so_truot_penalty_#xxxx#" onchange="updateDiem('#xxxx#');"></span>      
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][so_phan_luoi_nha]" style="width:50px;" class="multi-edit-text-input count-total" type="text" id="so_phan_luoi_nha_#xxxx#" onchange="updateDiem('#xxxx#');"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][bonus]" style="width:40px;border:1px solid #009E4C;color:#FF6700;background:#D4FFE9;text-align:center;" class="multi-edit-text-input count-total" type="text" id="bonus_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][diem]" style="width:40px;font-weight:bold;color:#30F;" class="multi-edit-text-input" type="text" id="diem_#xxxx#" tabindex="-1"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][cao_nhat_doi]" type="checkbox" id="cao_nhat_doi_#xxxx#" value="1" style="width:40px;"></span>
			<span class="multi-edit-input">
      	<?php 
				if((!$this->map['cau_thu'] or Url::get('doi_cao_nhat')==1))
				{?>
      	<input  name="mi_lich_su[#xxxx#][cao_nhat]" type="checkbox" id="cao_nhat_#xxxx#" value="1" style="width:40px;">
         <?php }else{ ?>
        <span style="background:#C4AFB0">xxxxxx</span>
        
				<?php
				}
				?>
       </span>
      <span class="multi-edit-input no-border" style="width:30px;"><span><img id="img_anh_dai_dien_#xxxx#" style="width:30px;" class="img" onclick="window.open(this.src)"></span></span>
      <span class="multi-edit-input no-border"><input  name="anh_dai_dien_#xxxx#" type="file" id="anh_dai_dien_#xxxx#" class="multi-edit-text-input" style="width:55px;text-align:right;"></span>
      <span class="multi-edit-input"><input  name="mi_lich_su[#xxxx#][video]" style="width:100px;" class="multi-edit-text-input" type="text" id="video_#xxxx#"></span>
		</div>
    <br clear="all">
	</span>
</span>
<?php 
$title = (URL::get('cmd')=='delete')?'Xóa lịch sử cầu thủ':'Lịch sử cầu thủ';?>
<div align="center">
<form name="EditQuanLyLichSuCauThuForm" method="post" enctype="multipart/form-data"><br>
<nav class="tab">
  <ul>
    <li<?php echo (Session::get('mua_giai_id')==1)?' class="active"':''?>><a href="<?php echo Url::build_current(array('clb_id','mua_giai_id'=>1));?>">2014-2015</a></li>
    <li<?php echo (Session::get('mua_giai_id')==2)?' class="active"':''?>><a href="<?php echo Url::build_current(array('clb_id','mua_giai_id'=>2));?>">2015-2016</a></li>
  </ul>
</nav>
<table cellspacing="0" width="100%" class="multi-item-table">
	<tr valign="top" bgcolor="#FFFFFF">
		<td align="left">
        <table cellpadding="15" cellspacing="0" width="100%" border="0" bordercolor="#CCCCCC" class="table-bound">
            <tr>
                <td class="form-title" width="100%"><?php echo $title;?></td>
                <?php if(User::can_add(false,ANY_CATEGORY) and Url::get('clb_id') and Url::get('vong_dau_id')){?><td width="1%"><a href="javascript:void(0)" onclick="jQuery('#confirm_edit').val(1);EditQuanLyLichSuCauThuForm.submit();"  class="button-medium-save">Ghi</a></td><?php }?>
            </tr>
        </table>
		</td>
	</tr>
	<tr valign="top">	
	<td>
  <div class="navi-list" style="float:left;width:160px;">
    <h2><a href="?page=quan_ly_clb">CLB</a></h2>
    <ul>
    	<?php
					if(isset($this->map['clbs']) and is_array($this->map['clbs']))
					{
						foreach($this->map['clbs'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['clbs']['current'] = &$item1;?>
    	<li <?php echo (Url::iget('clb_id')==$this->map['clbs']['current']['id'])?'class="active"':'';?>><a href="<?php echo Url::build_current(array('vong_dau_id','clb_id'=>$this->map['clbs']['current']['id']))?>"><?php echo $this->map['clbs']['current']['ten'];?> <span>(<?php echo $this->map['clbs']['current']['sl_cau_thu'];?>)</span></a></li>
      
							
						<?php
							}
						}
					unset($this->map['clbs']['current']);
					} ?>
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
    	<select  name="vong_dau_id" id="vong_dau_id" class="form-control" onChange="EditQuanLyLichSuCauThuForm.submit();"><?php
					if(isset($this->map['vong_dau_id_list']))
					{
						foreach($this->map['vong_dau_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('vong_dau_id').value = "<?php echo addslashes(URL::get('vong_dau_id',isset($this->map['vong_dau_id'])?$this->map['vong_dau_id']:''));?>";</script>
	</select>
    </td>
  </tr>
  <tr valign="top">
		<td>
    <br clear="all">
    <div style="padding:5px;border:1px solid #999;border-radius:5px;background:#FFFBC9">
    	TOP vòng đấu: <?php 
				if(($this->map['cau_thu']))
				{?><strong><?php echo $this->map['cau_thu'];?></strong> (<?php echo $this->map['diem'];?> điểm) - <?php echo $this->map['clb'];?> (<a href="<?php echo Url::build_current(array('clb_id'=>$this->map['cao_nhat_clb_id'],'vong_dau_id','doi_cao_nhat'=>1));?>">Thay đổi</a>) <?php }else{ ?>Chưa có
				<?php
				}
				?>
    </div>
		<div class="multi-item-wrapper">
      <span id="mi_lich_su_all_elems" class="floating-header-wrapper">
        <span style="white-space:nowrap;" class="floating-header">
          <span class="multi-edit-input header" style="width:20px;"><input type="checkbox" value="1" onclick="mi_select_all_row('mi_lich_su',this.checked);"></span>
          <span class="multi-edit-input header" style="width:40px;">ID</span>
          <span class="multi-edit-input header" style="width:120px;">Tên cầu thủ</span>
          <span class="multi-edit-input header" style="width:50px;">Số phút</span>
          <span class="multi-edit-input header" style="width:50px;">Thẻ vàng</span>
          <span class="multi-edit-input header" style="width:50px;">Thẻ đỏ</span>
          <span class="multi-edit-input header" style="width:50px;">Kiến tạo</span>
          <span class="multi-edit-input header" style="width:50px;">Ghi bàn</span>
          <span class="multi-edit-input header" style="width:50px;">Bàn thua</span>
          <span class="multi-edit-input header" style="width:50px;">Cản phá</span>
          <span class="multi-edit-input header" style="width:50px;">Cản Pen</span>
          <span class="multi-edit-input header" style="width:60px;">Trượt Pen</span>
          <span class="multi-edit-input header" style="width:50px;">Phản LN</span>
          <span class="multi-edit-input header" style="width:40px;">Bonus</span>
          <span class="multi-edit-input header" style="width:40px;">Điểm</span>
          <span class="multi-edit-input header" style="width:40px;">TOP Đ</span>
          <span class="multi-edit-input header" style="width:40px;">TOP V</span>
          <span class="multi-edit-input header" style="width:30px;">Ảnh</span>
          <span class="multi-edit-input header" style="width:55px;">Chọn ảnh</span>
          <span class="multi-edit-input header" style="width:100px;">Video</span>
          <br clear="all">
        </span>
      </span>
      <?php echo $this->map['notification'];?>
		</div>
    <br clear="all">
		<div><?php echo $this->map['paging'];?></div>
		</td>
	</tr>
	</table>
    <input  name="confirm_edit" id="confirm_edit" value="0" / type ="hidden" value="<?php echo String::html_normalize(URL::get('confirm_edit'));?>">
    <input  name="doi_cao_nhat" type="hidden" value="<?php echo Url::get('doi_cao_nhat')?1:0;?>" />    
	</td>
</tr>
</table><br clear="all"><br clear="all"><br clear="all">
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
<script src="packages/core/includes/js/multi_items.js"></script>
<script>
mi_init_rows('mi_lich_su',<?php if(isset($_REQUEST['mi_lich_su'])){echo String::array2js($_REQUEST['mi_lich_su']);}else{echo '[]';}?>);
for(var i=101;i<=input_count;i++){
	if(getId('id_'+i)){
		$mvt = getId('ma_vi_tri_'+i).value;		
		$color = '#000000';
		if($mvt == 'TD'){
			$color = '#FF0000';
		}
		if($mvt == 'TV'){
			$color = '#60C';
		}
		if($mvt == 'HV'){
			$color = '#FC3';
		}
		getId('ten_'+i).style.color = $color;
	}
}
jQuery(document).ready(function(){
	 updateAllDiem();
});
function updateDiem(i){
	if(getId('id_'+i)){
		if(to_numeric(getId('so_phut_thi_dau_'+i).value) > 0){
			$mvt = getId('ma_vi_tri_'+i).value;
			
			$ghiban = to_numeric(getId('so_ghi_ban_'+i).value?getId('so_ghi_ban_'+i).value:0);
			diemGhiBan = (($mvt=='TM' || $mvt=='HV')?($ghiban*6):(($mvt=='TV')?($ghiban*5):($ghiban*4)));
			
			$sophutthidau = to_numeric(getId('so_phut_thi_dau_'+i).value);
			diemPhutThiDau = ($sophutthidau>0)?(($sophutthidau<60)?1:2):0;
			diemTheVang = to_numeric(getId('so_the_vang_'+i).value)*(-1);
			diemTheDo = to_numeric(getId('so_the_do_'+i).value)*(-2);
			diemKienTao = to_numeric(getId('so_kien_tao_'+i).value)*3;
			
			$sobanthua = to_numeric(getId('so_ban_thua_'+i).value)?to_numeric(getId('so_ban_thua_'+i).value):0;
			$giusachluoi = ($sobanthua>0)?0:1;
			diemSachLuoi = (($giusachluoi && $sophutthidau >= 60)?(($mvt=='TM' || $mvt=='HV')?4:(($mvt=='TV')?1:0)):0);
			$thungluoi = ($sobanthua>0)?$sobanthua:0;
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
			tongDiem = diemPhutThiDau
															+ diemTheVang
															+ diemTheDo
															+ diemKienTao
															+ diemGhiBan
															+ diemSachLuoi
															+ diemThungLuoi*(-1)
															+ diemCanPha
															+ diemCanPenalty
															+ diemPhanLuoiNha
															+ diemTruotPenalty;
			getId('diem_'+i).value = (tongDiem>0)?tongDiem:0;																										
			//jQuery('#ngay_sinh_'+i).datepicker({dateFormat:'yy-mm-dd'});
			getId('diem_'+i).style.background = '#FFF';
		}else{
			getId('diem_'+i).value = 0;
			getId('diem_'+i).style.background = '#CCC';
		}
	}
}
function updateAllDiem(){
	for(var i=101;i<=input_count;i++){
			updateDiem(i);
	}
}
</script>