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
      <span class="multi-edit-input"><input  name="mi_ket_qua[#xxxx#][kenh_chieu]" style="width:100px;" class="multi-edit-text-input" type="text" id="kenh_chieu_#xxxx#"></span>
      <span class="multi-edit-input"><input  name="mi_ket_qua[#xxxx#][thoi_gian]" style="width:120px;text-align:center" class="multi-edit-text-input" type="text" id="thoi_gian_#xxxx#"></span>
			<span class="multi-edit-input"><textarea  name="mi_ket_qua[#xxxx#][thong_tin_tran_dau]" style="width:300px;font-size:14px;" class="multi-edit-text-input" id="thong_tin_tran_dau_#xxxx#" ondrop="drop(event)" ondragover="allowDrop(event)"></textarea></span>      
      <span class="multi-edit-input" style="width:30px;"><a href="#" onClick="showAssistant(#xxxx#);editAreaLoader.init({id : 'thong_tin_tran_dau_#xxxx#',start_highlight: false,allow_resize: 'both',allow_toggle: true,word_wrap: true,syntax: 'php'});return false;" style="border-radius:5px;border:1px solid #B90002;background:#EFEFEF;">Assis</a></span>
      <span class="multi-edit-input" style="width:30px;"><input  name="mi_ket_qua[#xxxx#][hide]" type="checkbox" id="hide_#xxxx#" value="1"></span>
      <span class="multi-edit-input no-border" style="width:20px;"><img src="skins/default/images/buttons/delete.gif" onClick="mi_delete_row(getId('input_group_#xxxx#'),'mi_ket_qua','#xxxx#','');event.returnValue=false;" style="cursor:pointer;"/></span>
		</div>
    <br clear="all">
	</span>
</span>
<?php 
$title = (URL::get('cmd')=='delete')?'Xóa kết quả thi đấu':'Kết quả thi đấu';?>
<div align="center"><br>
<form name="EditQuanLyKetQuaThiDauForm" method="post" enctype="multipart/form-data">
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
                <?php 
				if((Url::get('do')!='add'))
				{?>
								<?php if(User::can_add(false,ANY_CATEGORY)){?><td width="1%"><a href="<?php echo Url::build_current(array('do'=>'add','vong_dau_id'));?>" class="button-medium-add">Thêm mới</a></td><?php }?>
                
				<?php
				}
				?>
                <?php 
				if((Url::get('ids') or Url::get('do')=='add'))
				{?>
                <?php if(User::can_add(false,ANY_CATEGORY)){?><td width="1%"><a href="javascript:void(0)" onclick="updateAllEditor();EditQuanLyKetQuaThiDauForm.submit();"  class="button-medium-save">Ghi</a></td><?php }?>
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
						foreach($this->map['vongdaus'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['vongdaus']['current'] = &$item1;?>
        <li <?php echo (Url::iget('vong_dau_id')==$this->map['vongdaus']['current']['id'])?'class="active"':'';?>><a href="<?php echo Url::build_current(array('clb_id','vong_dau_id'=>$this->map['vongdaus']['current']['id'],'clb_id'));?>"><?php echo $this->map['vongdaus']['current']['ten'];?></a></li>
        
							
						<?php
							}
						}
					unset($this->map['vongdaus']['current']);
					} ?>
      </ul>
    </td>
  </tr>
  <tr>
  	<td>
    	<div class="search" style="float:left;"><input  name="keyword" id="keyword" placeholder="Nhập tên đội" / type ="text" value="<?php echo String::html_normalize(URL::get('keyword'));?>"> <input  name="search" value="Tìm kiếm" / type ="submit" value="<?php echo String::html_normalize(URL::get('search'));?>"> /  Tổng số bàn thắng vòng đấu: <?php echo $this->map['ban_thang'];?></div>
      <div class="ids-listt" style="float:right;">
      <a href="#" onclick="showBangMa">+ Bảng mã kết quả</a>
      <input  name="ids" id="ids" placeholder="Nhập id để sửa hoặc xóa: 1,2,3" style="width:300px;" / type ="text" value="<?php echo String::html_normalize(URL::get('ids'));?>"> <input  name="search" value=" OK " / type ="submit" value="<?php echo String::html_normalize(URL::get('search'));?>"></div>
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
          <span class="multi-edit-input header" style="width:100px;">Chiếu trên kênh</span>
          <span class="multi-edit-input header" style="width:120px;">Thời gian</span>
          <span class="multi-edit-input header" style="width:300px;">Chi tiết kết quả</span>
          <span class="multi-edit-input header" style="width:36px;">&nbsp;</span>
          <span class="multi-edit-input header" style="width:30px;">Ẩn</span>
          <span class="multi-edit-input header no-border no-bg" style="width:20px;">&nbsp;</span>
          <br clear="all">
        </span>
      </span>
		</div>
    <br clear="all">
    <?php 
				if((Url::get('do')=='add'))
				{?>
		<div style="padding:5px;"><input type="button" value="   Thêm mới   " onclick="mi_add_new_row('mi_ket_qua');jQuery('#ngay_sinh_'+input_count).datepicker({dateFormat:'yy-mm-dd'});"></div>
    
				<?php
				}
				?>
		<div><?php echo $this->map['paging'];?></div>
		</td>
	</tr>
	</table>
    <input  name="confirm_edit" value="1" / type ="hidden" value="<?php echo String::html_normalize(URL::get('confirm_edit'));?>">
    <input  name="vong_dau_id" type="hidden" id="vong_dau_id" value="<?php echo Url::iget('vong_dau_id');?>" />
	</td>
</tr>
</table>
<div id="input_assistant">
	<a class="close" href="#" onClick="jQuery('#input_assistant').fadeOut();return false;">Đóng</a>
	<h3>Thông tin nhập hỗ trợ</h3>
  <div>Anh em nhớ kéo thả ^^</div>
	<ul>
  	<li>
    	<span class="button" ondragstart="dragStart(event,'{ [giua] }')" ondrag="dragging(event)" draggable="true" id="dragtarget">Bắt đầu dòng mới</span>
    </li>
  </ul><br>
  <table width="100%" border="1" cellspacing="0" cellpadding="2" bordercolor="#CCC">
  <thead>
    <tr bgcolor="#EFEFEF" align="center">
      <td width="35%" id="doi_cn"></td>
      <td>vs</td>
      <td width="35%" id="doi_kh"></td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td valign="top"><div class="team" id="doi_cn_team"></div></td>
      <td valign="top" align="center">
      	<ul>
  			<li><span class="button" ondragstart="dragStart(event,'[trong]')" ondrag="dragging(event)" draggable="true" id="dragtarget">Trống</span></li>
        <li><span class="button" ondragstart="dragStart(event,' [giua] ')" ondrag="dragging(event)" draggable="true" id="dragtarget">Phân cách</span></li>
        <li><span class="button" ondragstart="dragStart(event,'[goal]')" ondrag="dragging(event)" draggable="true" id="dragtarget">goal</span></li>
        <li><span class="button" ondragstart="dragStart(event,'[red]')" ondrag="dragging(event)" draggable="true" id="dragtarget">red</span></li>
        <li><span class="button" ondragstart="dragStart(event,'[yellow]')" ondrag="dragging(event)" draggable="true" id="dragtarget">yellow</span></li>
        <li><span class="button" ondragstart="dragStart(event,'[ass]')" ondrag="dragging(event)" draggable="true" id="dragtarget">ass</span></li>
        <li><span class="button" ondragstart="dragStart(event,'[in]')" ondrag="dragging(event)" draggable="true" id="dragtarget">in</span></li>
        <li><span class="button" ondragstart="dragStart(event,'[out]')" ondrag="dragging(event)" draggable="true" id="dragtarget">out</span></li>
        <li><span class="button" ondragstart="dragStart(event,'[miss]')" ondrag="dragging(event)" draggable="true" id="dragtarget">miss</span></li>
       	<li><span class="button" ondragstart="dragStart(event,'[save]')" ondrag="dragging(event)" draggable="true" id="dragtarget">save</span></li></ul></td>
      <td valign="top"><div class="team" id="doi_kh_team"></div></td>
    </tr>
  </tbody>
</table>
</div>

<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
<script>
function dragStart(event,value) {
    event.dataTransfer.setData("Text", value);
}

function dragging(event) {

}

function allowDrop(event) {
    event.preventDefault();
}

function drop(event) {
    event.preventDefault();
    var data = event.dataTransfer.getData("Text");
    event.target.appendChild(document.getElementById(data));
}
mi_init_rows('mi_ket_qua',<?php if(isset($_REQUEST['mi_ket_qua'])){echo String::array2js($_REQUEST['mi_ket_qua']);}else{echo '[]';}?>);
 for(var i=101;i<=input_count;i++){
		if(getId('thong_tin_tran_dau_'+i)){
			//advance_mce('thong_tin_tran_dau_'+i);
				/*jQuery('#thong_tin_tran_dau_'+i).click(function(){
					editAreaLoader.init({
						id : "thong_tin_tran_dau_"+i		// textarea id
						,start_highlight: true	// if start with highlight
						,allow_resize: "both"
						,allow_toggle: true
						,word_wrap: true
						,language: "en"
						,syntax: "html"
					});
				});*/
		}
	}function update_diem(){
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
function showAssistant(index){
	jQuery('#input_assistant').fadeIn();
	jQuery('#doi_cn').html(jQuery('#doi_chu_nha_id_'+index+' option:selected').text());
	get_cau_thu_clb('doi_cn_team',jQuery('#doi_chu_nha_id_'+index).val());
	jQuery('#doi_kh').html(jQuery('#doi_khach_id_'+index+' option:selected').text());
	get_cau_thu_clb('doi_kh_team',jQuery('#doi_khach_id_'+index).val());
	jQuery('#thong_tin_tran_dau_'+index).css({'width':'450px','height':300});
}
function get_cau_thu_clb(obj,clb_id){
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			'do':'get_clb',
			clb_id:clb_id
		},
		beforeSend: function(){
			jQuery('#'+obj).html('Loading...');
		},
		success: function(content){
			jQuery('#'+obj).html(content);
		}
	});
}
function updateAllEditor(){
	for(var i=101;i<=input_count;i++){
		if(getId('thong_tin_tran_dau_'+i)){
			getId('thong_tin_tran_dau_'+i).value = editAreaLoader.getValue("thong_tin_tran_dau_"+i);
		}
	}
}
</script>
