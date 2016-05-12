<div class="row">
  <div class="col-xs-12 lien-dau">
    <form name="FmgScheduleForm" method="post">
      <div class="row">
        <div class="col-xs-12">
        	<div class="row">
            <div class="col-xs-8">
              <div class="title"><h2>LỊCH VÀ KẾT QUẢ LIÊN ĐẤU CÁC SERVER</h2></div>
            </div>
            <div class="col-xs-4">
              <div class="chon-vong-dau"><select  name="lien_dau_server_id" id="lien_dau_server_id" onchange="FmgScheduleForm.submit()" class="form-control"><?php
					if(isset($this->map['lien_dau_server_id_list']))
					{
						foreach($this->map['lien_dau_server_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('lien_dau_server_id').value = "<?php echo addslashes(URL::get('lien_dau_server_id',isset($this->map['lien_dau_server_id'])?$this->map['lien_dau_server_id']:''));?>";</script>
	</select></div>
            </div>
          </div>
					<div>
          	<?php 
				if(($this->map['lich']))
				{?>
          	<?php echo $this->map['lich'];?>
             <?php }else{ ?>
            <div class="alert big">Diễn ra vào 9h sáng thứ 7 hàng tuần.</div>
            <center><a href="?page=fmg_schedule" class="btn btn-default"> &laquo; Quay lại lịch thi đấu</a></center>
            
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