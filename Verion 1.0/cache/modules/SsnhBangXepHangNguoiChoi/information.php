<a name="bth_nguoichoi"></a>
<div class="row">
	<div class="title bxh">
      <div class="col-md-6">
        <h1>Bảng tổng hợp kết quả người chơi</h1>
      </div>
      <div class="col-md-6">
        <div class="group-input search-options">
          <form name="SsnhBangXepHangNguoiChoiInformationForm" method="post" action="<?php echo Url::get('page');?>.html">
          <select  name="nc_zone_id" id="nc_zone_id" onchange="SsnhBangXepHangNguoiChoiInformationForm.submit()"><?php
					if(isset($this->map['nc_zone_id_list']))
					{
						foreach($this->map['nc_zone_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('nc_zone_id').value = "<?php echo addslashes(URL::get('nc_zone_id',isset($this->map['nc_zone_id'])?$this->map['nc_zone_id']:''));?>";</script>
	</select>
          <select  name="year" id="year" onchange="SsnhBangXepHangNguoiChoiInformationForm.submit()"><?php
					if(isset($this->map['year_list']))
					{
						foreach($this->map['year_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('year').value = "<?php echo addslashes(URL::get('year',isset($this->map['year'])?$this->map['year']:''));?>";</script>
	</select>
          <select  name="quy" id="quy" onchange="SsnhBangXepHangNguoiChoiInformationForm.submit()"><?php
					if(isset($this->map['quy_list']))
					{
						foreach($this->map['quy_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('quy').value = "<?php echo addslashes(URL::get('quy',isset($this->map['quy'])?$this->map['quy']:''));?>";</script>
	</select>
          <select  name="month" id="month" onchange="SsnhBangXepHangNguoiChoiInformationForm.submit()"><?php
					if(isset($this->map['month_list']))
					{
						foreach($this->map['month_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('month').value = "<?php echo addslashes(URL::get('month',isset($this->map['month'])?$this->map['month']:''));?>";</script>
	</select>
          <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
        </div>
      </div>
    </div>
  <div class="col-md-12">
      <table cellpadding="0" cellspacing="0" width="100%" align="center" class="table table-bordered">
        <thead>
        <tr>
          <th width="60" align="center">Hạng</th>
          <th width="150" align="left">Người chơi</th>
          <th width="150" align="left">CMTND</th>
          <th width="90" align="left">Số điện thoại</th>
          <th width="150" align="center">Tỉnh thành</th>
          <th width="120" align="center">Số vòng tham gia</th>
          <th width="120" align="center">Số lần dự đoán đúng</th>
          <th width="120" align="center">Số lần chiến thắng</th>
          <?php 
				if((Url::iget('month')))
				{?>
          <th width="100" align="center">Điểm tháng</th>
          
				<?php
				}
				?>
          <?php 
				if((Url::iget('quy')))
				{?>
          <th width="100" align="center">Điểm quý</th>
          
				<?php
				}
				?>
          <th width="100" align="center">Tổng điểm</th>
        </tr>
        </thead>
        <?php
					if(isset($this->map['tongket_nguoichois']) and is_array($this->map['tongket_nguoichois']))
					{
						foreach($this->map['tongket_nguoichois'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['tongket_nguoichois']['current'] = &$item1;?>
        <tr <?php echo (isset($_SESSION['user_data']['nguoi_choi_id']) and $_SESSION['user_data']['nguoi_choi_id'] == $this->map['tongket_nguoichois']['current']['id'])?' class="itsme"':'';?>>
          <td align="center"><?php echo $this->map['tongket_nguoichois']['current']['thu_hang'];?></td>
          <td><a style="color:#000;" href="tong-hop/nguoichoi<?php echo $this->map['tongket_nguoichois']['current']['id'];?>.html"><?php echo $this->map['tongket_nguoichois']['current']['nguoi_choi'];?></a></td>
          <td align="center"><?php echo $this->map['tongket_nguoichois']['current']['cmtnd'];?></td>
          <td align="left"><?php echo $this->map['tongket_nguoichois']['current']['dien_thoai'];?></td>
          <td align="center"><?php echo $this->map['tongket_nguoichois']['current']['tinh_thanh'];?></td>
          <td align="center"><?php echo $this->map['tongket_nguoichois']['current']['so_vong_dau'];?></td>
          <td align="center"><?php echo $this->map['tongket_nguoichois']['current']['du_doan_dung'];?></td>
          <td align="center"><?php echo $this->map['tongket_nguoichois']['current']['so_lan_chien_thang'];?></td>
          <?php 
				if((Url::iget('month')))
				{?>
          <td align="center"><?php echo $this->map['tongket_nguoichois']['current']['diem_thang'];?></td>
          
				<?php
				}
				?>
          <?php 
				if((Url::iget('quy')))
				{?>
          <td align="center"><?php echo $this->map['tongket_nguoichois']['current']['diem_quy'];?></td>
          
				<?php
				}
				?>
          <td align="center"><?php echo $this->map['tongket_nguoichois']['current']['diem'];?></td>
        </tr>
        
							
						<?php
							}
						}
					unset($this->map['tongket_nguoichois']['current']);
					} ?>
      </table>
     <div class="bottom">
      <?php 
				if((isset($_SESSION['user_data']['nguoi_choi_id'])))
				{?>
      <div class="total-vote">Thứ hạng hiện tại của bạn: <strong><?php echo $this->map['vi_tri_hien_tai'];?>/<?php echo $this->map['total'];?></strong></div>
      
				<?php
				}
				?>
      <div class="paging"><?php echo $this->map['paging'];?></div>
    </div>
  </div>
</div>