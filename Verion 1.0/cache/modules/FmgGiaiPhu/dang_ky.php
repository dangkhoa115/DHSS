<div class="row">
  <div class="col-xs-12 clb">
    <form name="FmgGiaiPhuForm" method="post">
      <div class="row">
        <div class="col-xs-12">
        	<div class="row">
            <div class="col-xs-12">
              <div class="title"><h2>ĐĂNG KÝ GIẢI ĐẤU PHỤ ĐỂ CÓ CƠ HỘI NHẬN SỐ IGOLD KHỦNG</h2></div>
              <div class="alert big">Diễn ra vào 15h HÀNG NGÀY.</div>
              <div class="alert">
              	<ul>
              		<li>Tùy vào Power của bạn, hệ thống máy tính sẽ tự động chọn bạn vào bảng đấu phù hợp.</li>
                  <li>Bạn sẽ góp <strong class="highlight">5 iGold</strong> vào bảng đấu. Đội <strong class="highlight">vô địch</strong> sẽ nhận phần thưởng bằng <strong class="highlight">tổng số iGold</strong> của các câu lạc bộ tham gia bảng đấu công lại (BTC thu 15% phí tổ chức).</li>
                </ul>
              </div>
            </div>
          </div>
          <?php 
				if((!$this->map['server_id']))
				{?>
					<div>
            <center><a href="?page=fmg_giai_phu&do=xn_dang_ky" class="btn btn-danger btn-lg">XÁC NHẬN ĐĂNG KÝ</a></center><br>
            
          </div>
           <?php }else{ ?>
          <div>
            <center> <a href="?page=fmg_giai_phu&do=dang_ky#server<?php echo $this->map['server_id'];?>" class="btn btn-success"> ĐÃ ĐĂNG KÝ !</a></center><br>
          </div>
          
				<?php
				}
				?>
          <div>
          	<h3>Danh sách server</h3>
            <h5>(Power hiện tại của bạn: <?php echo $this->map['power'];?>)</h5>
          	<table width="100%" border="0" cellspacing="0" cellpadding="5" class="table">
              <tbody>
                <tr bgcolor="#6F6F6F">
                  <th>Server</th>
                  <th>Power</th>
                  <th>Tổng số đội đã đăng ký</th>
                </tr>
                <?php $total = 0;?>
                <?php
					if(isset($this->map['servers']) and is_array($this->map['servers']))
					{
						foreach($this->map['servers'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['servers']['current'] = &$item1;?>
                <?php $total += $this->map['servers']['current']['tong_clb'];?>
                <tr>
                  <td <?php echo ($this->map['servers']['current']['id']==$this->map['server_id'])?'style="color:#FF6E00;"':'';?>>
                  	<a name="server<?php echo $this->map['servers']['current']['id'];?>"></a>#<?php echo $this->map['servers']['current']['id'];?>/<?php echo $this->map['servers']['current']['name'];?><?php echo ($this->map['servers']['current']['id']==$this->map['server_id'])?' (Đã đăng ký)':'';?>
                  </td>
                  <td><?php echo $this->map['servers']['current']['power_from'];?> - <?php echo $this->map['servers']['current']['power_to'];?></td>
                  <td><?php echo $this->map['servers']['current']['tong_clb'];?></td>
                </tr>
                
							
						<?php
							}
						}
					unset($this->map['servers']['current']);
					} ?>
                <tr>
                  <td>&nbsp;</td>
                  <td><strong>Tổng cộng</strong></td>
                  <td><strong><?php echo $total;?></strong></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>    
      </div>
    <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			  
	</div>
</div>
<script>
jQuery(document).ready(function() {
	
});
</script>