<div class="row">
  <div class="col-xs-12 lien-dau giai-phu" style="background:rgba(96, 96, 96, 0.52);">
    <form name="FmgGiaiPhuForm" method="post">
      <div class="row">
        <div class="col-xs-12">
        	<div class="row">
            <div class="col-xs-8">
              <div class="title"><h2>LỊCH VÀ KẾT QUẢ GIẢI ĐẤU PHỤ</h2></div>
            </div>
            <div class="col-xs-4">
              <div class="chon-vong-dau">
              <label for="server_id">Xem theo</label><select  name="server_id" id="server_id" onchange="FmgGiaiPhuForm.submit()" class="form-control"><?php
					if(isset($this->map['server_id_list']))
					{
						foreach($this->map['server_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('server_id').value = "<?php echo addslashes(URL::get('server_id',isset($this->map['server_id'])?$this->map['server_id']:''));?>";</script>
	</select></div>
            </div>
          </div>
          <?php 
				if((!$this->map['server_id']))
				{?>
            <div>
              <center><a href="?page=fmg_giai_phu&do=xn_dang_ky" class="btn btn-danger btn-lg">ĐĂNG KÝ NGAY</a></center><br>
              
            </div>
             <?php }else{ ?>
            <div>
              <center> <a href="?page=fmg_giai_phu&do=dang_ky#server<?php echo $this->map['server_id'];?>" class="btn btn-success"> XEM SERVER ĐÃ ĐĂNG KÝ !</a></center><br>
            </div>
            
				<?php
				}
				?>
					<div>
          	<?php 
				if(($this->map['lich']))
				{?>
          	<?php echo $this->map['lich'];?>
             <?php }else{ ?>
            <div class="alert big">Lịch thi đấu sẽ có từ 14h trong ngày.</div>
            <?php 
				if((!$this->map['server_id']))
				{?>
            <div>
              <center><a href="?page=fmg_giai_phu&do=xn_dang_ky" class="btn btn-danger btn-lg">ĐĂNG KÝ NGAY</a></center><br>
              
            </div>
             <?php }else{ ?>
            
            
				<?php
				}
				?>
            
				<?php
				}
				?>
          </div>  <br> 
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