<script type="text/javascript" src="packages/core/includes/js/jquery/jquery.validate.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#SsnhBinhChonInformationForm').validate({
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
<div style="float:left;width:410px;min-height:300px;">
  <div class="tab-pane-1" id="tab-pane-category">
    <div class="tab-page" id="tab-page-category-1">
      <h2 class="tab">Thông tin cá nhân</h2>
      <ul>
            <li>
                Thông tin tài khoản: <strong><?php echo Session::get('user_id');?></strong>
            </li>
            <li>
                Tài khoản có: <span class="igold"><?php echo $this->map['igold'];?> iGold</span> <a target="_blank" href="nap-igold.html" class="nap-igold" title="Nạp iGold">Nạp</a>
            </li>
            <li>
                Tổng số điểm: <strong><?php echo $this->map['diem'];?></strong>
            </li>
            <li>
            	 Xếp hạng: <strong><?php echo $this->map['vi_tri_hien_tai'];?></strong>
            </li>
      </ul>
      <fieldset id="NguoiChoiForm">
        <div class="col-left-fr">
            <div class="img">
                <span>Ảnh đại diện:</span>
                <?php 
				if(($this->map['image_url']))
				{?><img src="<?php echo $this->map['image_url'];?>" width="100" />
				<?php
				}
				?>
            </div>
        </div>
      	 <div class="col-right-fr">
                <table cellpadding="0" cellspacing="0" width="100%" align="center" class="leagueTable">			
                      <tr>
                        <td width="32%" align="right"><?php echo Portal::language('full_name');?>:</td>
                        <td width="68%"><?php echo $this->map['full_name'];?></td>
                      </tr>	
                      <tr>
                        <td width="32%" align="right">Khu vực:</td>
                        <td width="68%"><?php echo $this->map['zone'];?></td>
                      </tr>
                      <tr>
                        <td width="32%" align="right"><?php echo Portal::language('gender');?>:</td>
                        <td width="68%"><?php echo $this->map['gender'];?></td>
                      </tr>
                      <tr>
                        <td width="32%" align="right"><?php echo Portal::language('birth_date');?>:</td>
                        <td width="68%"><?php echo $this->map['birth_date'];?></td>
                      </tr>
                      <?php 
				if((User::can_edit(MODULE_QUANLYCAUTHU,ANY_CATEGORY) or $this->map['nguoi_choi_id'] == $_SESSION['user_data']['nguoi_choi_id']))
				{?>
                      <tr>
                        <td width="32%" align="right">CMTND:</td>
                        <td width="68%"><?php echo $this->map['cmtnd'];?></td>
                      </tr>
                      
				<?php
				}
				?>
                      <tr>
                        <td width="32%" align="right"><?php echo Portal::language('email');?>:</td>
                        <td width="68%"><div style="width:99%;overflow:hidden;font-size:11px;"><?php echo $this->map['email'];?></div></td>
                      </tr>
                  </table>
           </div><!--End .col-right-fr-->
		      <div class="edit"><a href="#" onclick="jQuery('#NguoiChoiForm').hide();jQuery('#editNguoiChoiForm').fadeIn();return false;">Thay đổi thông tin</a></div>
      </fieldset>
      <fieldset id="editNguoiChoiForm" style="display:none;">
      	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>	
        <form name="SsnhBinhChonInformationForm" id="SsnhBinhChonInformationForm" method="post" enctype="multipart/form-data">
          <table cellpadding="0" cellspacing="0" width="100%" align="center" class="leagueTable">			
              <tr>
                <td width="32%" align="right"><?php echo Portal::language('full_name');?> (*)</td>
                <td width="68%"><input  name="full_name" id="full_name" type ="text" value="<?php echo String::html_normalize(URL::get('full_name'));?>"></td>
              </tr>	
              <tr>
                <td width="32%" align="right">Khu vực (*)</td>
                <td width="68%"><select  name="zone_id" class="select-large" id="zone_id"><?php
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
                <td width="32%" align="right"><?php echo Portal::language('gender');?></td>
                <td width="68%"><select  name="gender" class="select" id="gender"><?php
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
                <td width="32%" align="right"><?php echo Portal::language('birth_date');?></td>
                <td width="68%"><input  name="birth_date" id="birth_date" placeholder="dd/mm/yyyy" type ="text" value="<?php echo String::html_normalize(URL::get('birth_date'));?>"></td>
              </tr>
               <tr>
                <td width="32%" align="right">Số CMTND (*)</td>
                <td width="68%"><input  name="cmtnd" id="cmtnd" type ="text" value="<?php echo String::html_normalize(URL::get('cmtnd'));?>"></td>
              </tr>
              <tr>
                <td width="32%" align="right"><?php echo Portal::language('email');?> (*)</td>
                <td width="68%"><input  name="email" id="email" type ="text" value="<?php echo String::html_normalize(URL::get('email'));?>"></td>
              </tr>
              <tr>
                <td width="32%" align="right" valign="top">Ảnh đại diện</td>
                <td width="68%"><input  name="image_url" id="image_url" type ="file" value="<?php echo String::html_normalize(URL::get('image_url'));?>">
                &nbsp;<span class="require">100x100 pixel (*.jpg, *.jpeg, *.gif)</span> </td>
              </tr>
          </table>
        <div class="edit"><input  name="save" value="Cập nhật" class="button" type ="submit" value="<?php echo String::html_normalize(URL::get('save'));?>"><a href="tong-hop.html?do=cpwd" style="background: #007bc3;">Đổi mật khẩu</a><a href="#" onclick="jQuery('#NguoiChoiForm').fadeIn();jQuery('#editNguoiChoiForm').hide();return false;" style="background: #676767;">Hủy</a></div>
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
				
        <input name="nguoi_choi_id" type="hidden" id="nguoi_choi_id" value="<?php echo $this->map['nguoi_choi_id'];?>" />
      </fieldset>
    </div> <!-- End .tab-page-category-1 -->
    <div class="tab-page" id="tab-page-category-2">
      <h2 class="tab">Bình chọn của bạn</h2>
      <table border="0" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0" width="100%" align="center" class="table leagueTable">
      	<tr>
        	<th align="left">Vòng đấu</th>
          <th align="left">CLB</th>
          <th align="center">Thời gian bình chọn</th>
        </tr>
        <?php
					if(isset($this->map['binhchons']) and is_array($this->map['binhchons']))
					{
						foreach($this->map['binhchons'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['binhchons']['current'] = &$item1;?>
        <tr>
        	<td><?php echo $this->map['binhchons']['current']['vong_dau'];?></td>
          <td>
          <?php 
				if((xem_clb_trong_binh_chon($this->map['binhchons']['current']['nguoi_choi_id'],$this->map['binhchons']['current']['vong_dau_id'])))
				{?>
          <?php echo $this->map['binhchons']['current']['clb'];?>
           <?php }else{ ?>
          <span style="color:#F00">Ẩn</span>
          
				<?php
				}
				?></td>
          <td align="center"><?php echo $this->map['binhchons']['current']['thoi_gian_binh_chon'];?></td>
        </tr>
        
							
						<?php
							}
						}
					unset($this->map['binhchons']['current']);
					} ?>
      </table>
      <div class="paging"><?php echo $this->map['paging'];?></div>
    </div> <!-- End .tab-page-category-2 -->
  </div>
</div>
<script>
function CheckinInput(){
	if(getId('cmtnd').value == ''){
		alert('Bạn phải nhập số CMTND để được tính điểm');
		return false;
	}else{
		SsnhBinhChonInformationForm.submit();
		return false;
	}
}
</script>