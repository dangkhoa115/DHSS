<div class="row nguoi-choi">
  <div class="col-md-12">
  	<ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#thong_tin_ca_nhan" aria-controls="home" role="tab" data-toggle="tab">Thông tin cá nhân</a></li>
      <li role="presentation"><a href="#binh_chon_cua_nguoi_choi" aria-controls="profile" role="tab" data-toggle="tab">Bình chọn của người chơi</a></li>
    </ul>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="thong_tin_ca_nhan">
        <fieldset id="NguoiChoiForm">
          <div class="col-md-4">
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
           <div class="col-md-8">
                  <table cellpadding="0" cellspacing="0" width="100%" align="center" class="leagueTable">			
                        <tr>
                          <td width="32%" align="right">Người chơi:</td>
                          <td width="68%"><?php echo $this->map['ten'];?></td>
                        </tr>	
                        <tr>
                          <td width="32%" align="right">Khu vực:</td>
                          <td width="68%"><?php echo $this->map['zone'];?></td>
                        </tr>
                        <tr>
                          <td align="right">Điểm: </td>
                          <td><?php echo $this->map['diem'];?></td>
                        </tr>
                        <tr>
                          <td align="right">Thứ hạng: </td>
                          <td><?php echo $this->map['vi_tri_hien_tai'];?></td>
                        </tr>
                    </table>
           </div><!--End .col-right-fr-->
        </fieldset>
        <fieldset id="editNguoiChoiForm" style="display:none;">
          <?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>	
          <form name="SsnhNguoiChoiInformationForm" method="post" id="EditUser" enctype="multipart/form-data">
            <table cellpadding="0" cellspacing="0" width="100%" align="center" class="leagueTable">			
                <tr>
                  <td width="32%" align="right"><?php echo Portal::language('full_name');?> (*)</td>
                  <td width="68%"><input  name="full_name" id="full_name" type ="text" value="<?php echo String::html_normalize(URL::get('full_name'));?>"></td>
                </tr>	
                <tr>
                  <td width="32%" align="right">Khu vực</td>
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
                  <td width="68%"><input  name="birth_date" id="birth_date" type ="text" value="<?php echo String::html_normalize(URL::get('birth_date'));?>"></td>
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
          <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
				
          <div class="edit"><a href="#" onclick="SsnhNguoiChoiInformationForm.submit();return false;">Cập nhật</a><a href="tong-hop.html?do=cpwd" style="background: #007bc3;">Đổi mật khẩu</a><a href="#" onclick="jQuery('#NguoiChoiForm').fadeIn();jQuery('#editNguoiChoiForm').hide();return false;" style="background: #676767;">Hủy</a></div>
        </fieldset>
      </div>
      <div role="tabpanel" class="tab-pane" id="binh_chon_cua_nguoi_choi">
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
      </div>
    </div>
  </div>
</div><br clear="all">