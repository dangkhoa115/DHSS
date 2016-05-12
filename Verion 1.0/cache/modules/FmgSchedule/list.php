<div class="row">
  <div class="col-md-12 lich-thi-dau">
    <form name="FmgScheduleForm" method="post">
      <div class="row">
        <div class="col-md-8">
        	<div class="row">
            <div class="col-md-8">
              <div class="title"><h2>Lịch thi đấu <?php echo $this->map['vong_dau'];?></h2></div>
            </div>
            <div class="col-md-4">
              <div class="chon-vong-dau"><select  name="vong_dau_id" id="vong_dau_id" onchange="FmgScheduleForm.submit()" class="form-control"><?php
					if(isset($this->map['vong_dau_id_list']))
					{
						foreach($this->map['vong_dau_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('vong_dau_id').value = "<?php echo addslashes(URL::get('vong_dau_id',isset($this->map['vong_dau_id'])?$this->map['vong_dau_id']:''));?>";</script>
	</select></div>
            </div>
          </div>
          <?php 
				if((!empty($this->map['items'])))
				{?>
          <table class="table">      
            <tbody>
              <?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
              <tr>
                <td width="5%"><img alt="<?php echo $this->map['items']['current']['doi_chu_nha'];?>" src="<?php echo $this->map['items']['current']['logo_cn'];?>" title="<?php echo $this->map['items']['current']['doi_chu_nha'];?>" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></td>
                <td width="30%"><strong><?php echo $this->map['items']['current']['doi_chu_nha'];?></strong></td>
                <td align="center">
                  <div><?php echo $this->map['items']['current']['thoi_gian_ngay'];?> <?php echo $this->map['items']['current']['thoi_gian_gio'];?>'</div>
                  <?php 
				if(($this->map['items']['current']['ket_qua']))
				{?>
                  <a href="<?php echo Url::build('fmg_play',array('do'=>'thidau','dcn_id'=>$this->map['items']['current']['dcn_id'],'dkh_id'=>$this->map['items']['current']['dkh_id'],'vong_dau_id'=>$this->map['items']['current']['vong_dau_id']))?>" class="btn btn-default">Xem kết quả </a>
                   <?php }else{ ?>
                 	<a href="<?php echo Url::build('fmg_play',array('do'=>'thidau','dcn_id'=>$this->map['items']['current']['dcn_id'],'dkh_id'=>$this->map['items']['current']['dkh_id'],'vong_dau_id'=>$this->map['items']['current']['vong_dau_id']))?>" class="btn btn-default">VS</a>
                  
				<?php
				}
				?>
                </td>
                <td width="30%" align="right"><strong><?php echo $this->map['items']['current']['doi_khach'];?></strong></td>
                <td width="5%"><img alt="<?php echo $this->map['items']['current']['doi_khach'];?>" title="<?php echo $this->map['items']['current']['doi_khach'];?>" src="<?php echo $this->map['items']['current']['logo_kh'];?>" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></td>
              </tr>
              
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
            </tbody>
          </table>
           <?php }else{ ?>
          <div clb="btn btn-warning">Lịch thi đấu sẽ cập nhật sau khi Server đã đủ <?php echo MAX_TEAM;?> đội.<br>
          Các trận đấu sẽ diễn ra vào 9h sáng ngày thứ 3 hàng tuần.</div>
          
				<?php
				}
				?>
        </div>
        <div class="col-md-4">
        	<div class="title"><h3>Bảng xếp hạng</h3></div>
        	<table cellspacing="0" cellpadding="0" class="table bxh">
            <tbody>
              <tr>
              <th class="col-hang">Hạng</th>
              <th class="col-club">Club</th>
              <th align="center" class="col-pts">Power</th>
              <th class="col-pts">Điểm</th>            
             </tr>
             <?php $i=1;?>
             <?php
					if(isset($this->map['bxh_clbs']) and is_array($this->map['bxh_clbs']))
					{
						foreach($this->map['bxh_clbs'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['bxh_clbs']['current'] = &$item2;?>
             <tr class="accent<?php echo ($i==1)?$i:(($i<=4)?2:(($i==5)?3:''));$i++;?>">
              <td class="col-hang"><?php echo $this->map['bxh_clbs']['current']['win']?'<img class="top-1-icon" src="skins/ssnh/images/fm_game/rank_1.png" alt="TOP 1" />':$this->map['bxh_clbs']['current']['hang'];?></td>
              <td class="col-club"><a href="?page=fmg_team&team_id=<?php echo $this->map['bxh_clbs']['current']['id'];?>" class="external"><?php echo $this->map['bxh_clbs']['current']['name'];?></a></td>
              <td align="center" class="col-pld"><?php echo $this->map['bxh_clbs']['current']['power'];?></td>
              <td class="col-pld"><?php echo $this->map['bxh_clbs']['current']['diem'];?></td>       
             </tr>
             
							
						<?php
							}
						}
					unset($this->map['bxh_clbs']['current']);
					} ?>
            </tbody>
           </table>
        </div>
      </div><!--End .list-player-->
    <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			  
	</div>
</div>
<script>
jQuery(document).ready(function() {
	
});
</script>