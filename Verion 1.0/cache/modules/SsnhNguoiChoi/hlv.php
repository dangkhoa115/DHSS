<script type="text/javascript" src="packages/core/includes/js/jquery/jquery.validate.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#SsnhNguoiChoiInformationForm').validate({
		success: function(label) {
			label.text("").addClass("success");
		},
		rules: {
			full_name:{
				required: true
			},
			zone_id: {
				required: true
			},
			cmtnd: {
				required: true,
				remote : 'form.php?block_id=<?php echo Module::block_id(); ?>&do=check_cmtnd'
			},
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			full_name:{
				required: 'Yêu cầu phải nhập'
			},
			zone_id: {
				required: 'Yêu cầu phải nhập'
			},
			cmtnd: {
				required: 'Yêu cầu phải nhập',
				remote:'CMTND này đã tồn tại'
			},
			email: {
				required: 'Yêu cầu phải nhập',
				email: 'Bạn phải nhập email đúng định dạng'
			}
		}
	});
});
</script>
<div class="row nguoi-choi">
  <div class="col-md-12">
  	<ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#thong_tin_ca_nhan" aria-controls="home" role="tab" data-toggle="tab">Thông tin cá nhân</a></li>
      <li role="presentation"><a href="trang-ca-nhan-dhss.html?do=cpwd">Đổi mật khẩu</a></li>
    </ul>
    <div class="tab-content">
     	<div role="tabpanel" class="tab-pane active" id="thong_tin_ca_nhan">
        <ul class="info">
            <li>
                ID tài khoản: <strong><?php echo Session::get('user_id');?> <a href="thoat.html" class="log-out">[Thoát]</a></strong>
            </li>
            <li>
                Số dư: <span class="igold"><?php echo $this->map['igold'];?> <img src="skins/ssnh/images/igold_16_text.png" width="53" height="16" alt=""/></span> <input type="button" value="Nạp iGold" onClick="window.location='nap_igold_dhss.html'" class="btn btn-warning btn-sm">

                <!--<a target="_blank" href="nap-igold.html" class="nap-igold" title="Nạp iGold">Nạp</a>--><br><br>
            </li>
         </ul>
        <fieldset id="NguoiChoiForm">
          <div class="row">
            <div class="col-md-3">
                <div class="img">
                    <span>Ảnh đại diện:</span>
                    <img src="<?php echo $this->map['image_url'];?>" width="150" alt="Ảnh đại diện" onerror="this.src='skins/ssnh/images/unknown_player.png'" />
                </div>
            </div>
            <div class="col-md-9">
                <table cellpadding="0" cellspacing="0" width="100%" align="center" class="leagueTable">			
                    <tr>
                      <td width="30%" align="right"><?php echo Portal::language('full_name');?>:</td>
                      <td width="70%"><?php echo $this->map['full_name'];?></td>
                    </tr>	
                    <tr>
                      <td align="right">Khu vực:</td>
                      <td><?php echo $this->map['zone'];?></td>
                    </tr>
                    <tr>
                      <td align="right"><?php echo Portal::language('gender');?>:</td>
                      <td><?php echo $this->map['gender'];?></td>
                    </tr>
                    <tr>
                      <td align="right"><?php echo Portal::language('birth_date');?>:</td>
                      <td><?php echo $this->map['birth_date'];?></td>
                    </tr>
                    <?php 
				if((User::can_edit(MODULE_QUANLYCAUTHU,ANY_CATEGORY) or $this->map['nguoi_choi_id'] == $_SESSION['user_data']['nguoi_choi_id']))
				{?>
                    <tr>
                      <td align="right">CMTND:</td>
                      <td><?php echo $this->map['cmtnd'];?></td>
                    </tr>
                    <tr>
                      <td align="right">Điện thoại:</td>
                      <td><?php echo $this->map['dien_thoai'];?></td>
                    </tr>
                    
				<?php
				}
				?>
                    <tr>
                      <td align="right"><?php echo Portal::language('email');?>:</td>
                      <td><div style="width:99%;overflow:hidden;font-size:11px;"><?php echo $this->map['email'];?></div></td>
                    </tr>
                    <tr>
                      <td align="right">CLB yêu thích:</td>
                      <td><a href="clb/<?php echo $this->map['clb_name_id'];?>.html" target="_blank"><?php echo $this->map['clb'];?></a></td>
                    </tr>
                </table>
           </div>
          </div>
        <div class="edit"><a href="#" onclick="jQuery('#NguoiChoiForm').hide();jQuery('#editNguoiChoiForm').fadeIn();return false;">Thay đổi thông tin</a></div>
        </fieldset>
        <fieldset id="editNguoiChoiForm" style="display:none;">
          <?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>	
          <form name="SsnhNguoiChoiInformationForm" id="SsnhNguoiChoiInformationForm" method="post" enctype="multipart/form-data">
            <table cellpadding="0" cellspacing="0" width="100%" align="center" class="leagueTable">			
                <tr>
                  <td align="right"><?php echo Portal::language('full_name');?> (*)</td>
                  <td><input  name="full_name" id="full_name" class="form-control" type ="text" value="<?php echo String::html_normalize(URL::get('full_name'));?>"></td>
                </tr>	
                <tr>
                  <td align="right">Khu vực (*)</td>
                  <td><select  name="zone_id" id="zone_id" class="form-control"><?php
					if(isset($this->map['zone_id_list']))
					{
						foreach($this->map['zone_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('zone_id').value = "<?php echo addslashes(URL::get('zone_id',isset($this->map['zone_id'])?$this->map['zone_id']:''));?>";</script>
	</select>
                  <script>document.getElementById('zone_id').value ='<?php echo Url::get('zone_id',1);?>';</script>					</td>
                </tr>
                <tr>
                  <td align="right"><?php echo Portal::language('gender');?></td>
                  <td><select  name="gender" id="gender" class="form-control"><?php
					if(isset($this->map['gender_list']))
					{
						foreach($this->map['gender_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('gender').value = "<?php echo addslashes(URL::get('gender',isset($this->map['gender'])?$this->map['gender']:''));?>";</script>
	</select></td>
                </tr>
                <tr>
                  <td align="right"><?php echo Portal::language('birth_date');?></td>
                  <td><input  name="birth_date" id="birth_date" placeholder="dd/mm/yyyy" class="form-control" type ="text" value="<?php echo String::html_normalize(URL::get('birth_date'));?>"></td>
                </tr>
                <tr>
                  <td align="right">Số CMTND/Hộ chiếu (*)</td>
                  <td>
                  	<?php 
				if(($this->map['cmtnd'] and !User::is_admin()))
				{?>
                    	<strong><?php echo $this->map['cmtnd'];?></strong>
                      <?php }else{ ?>
                    <input  name="cmtnd" id="cmtnd" class="form-control" / type ="text" value="<?php echo String::html_normalize(URL::get('cmtnd'));?>"> 
                    <div class="alert alert-warning">Chú ý: Nhập chính xác số CMT vì bạn không được thay đổi sau khi cập nhật</div>
                    
				<?php
				}
				?>
                  </td>
                </tr>
                <tr>
                  <td align="right">Điện thoại (*)</td>
                  <td><input  name="dien_thoai" id="dien_thoai" class="form-control" type ="text" value="<?php echo String::html_normalize(URL::get('dien_thoai'));?>"></td>
                </tr>
                <tr>
                  <td align="right"><?php echo Portal::language('email');?> (*)</td>
                  <td><input  name="email" id="email" class="form-control" type ="text" value="<?php echo String::html_normalize(URL::get('email'));?>"></td>
                </tr>
                <tr>
                  <td align="right">CLB yêu thích</td>
                  <td><select  name="clb_id" id="clb_id" class="form-control"><?php
					if(isset($this->map['clb_id_list']))
					{
						foreach($this->map['clb_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('clb_id').value = "<?php echo addslashes(URL::get('clb_id',isset($this->map['clb_id'])?$this->map['clb_id']:''));?>";</script>
	</select></td>
                </tr>
                <tr>
                  <td align="right" valign="top">Ảnh đại diện</td>
                  <td><input  name="image_url" id="image_url" type ="file" value="<?php echo String::html_normalize(URL::get('image_url'));?>">
                  &nbsp;<span class="require">Kích thước: <strong>200x200</strong> pixel, dung lượng < 2Mb. (*.jpg, *.jpeg, *.gif)</span> </td>
                </tr>
            </table>
          <div class="edit"><input  name="save" value="Cập nhật" class="btn btn-primary" type ="submit" value="<?php echo String::html_normalize(URL::get('save'));?>"><a href="#" onclick="jQuery('#NguoiChoiForm').fadeIn();jQuery('#editNguoiChoiForm').hide();return false;" style="background: #676767;">Hủy</a></div>
          <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
				
          <input name="nguoi_choi_id" type="hidden" id="nguoi_choi_id" value="<?php echo $this->map['nguoi_choi_id'];?>" />
        </fieldset>
</div>
  </div>
  </div>
</div>
<script>
function CheckinInput(){
	if(getId('cmtnd').value == ''){
		alert('Bạn phải nhập số CMTND để được tính điểm');
		return false;
	}else{
		SsnhNguoiChoiInformationForm.submit();
		return false;
	}
}
jQuery(document).ready(function(e) {
	jQuery("body").on("contextmenu",function(){
		//return false;
	});
});
</script>