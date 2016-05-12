<div class="row">
  <div class="col-xs-12 lich-thi-dau">
    <form name="FmgBxhForm" method="post">
      <div class="row">
        <div class="col-xs-8">
        	<div class="row">
            <div class="col-xs-6">
              <div class="title"><h2>Kết quả thi đấu</h2></div>
            </div>
            <div class="col-xs-6"><br>
            	<?php 
				if((Url::iget('server_id')))
				{?>
              <select  name="vong_dau_id" id="vong_dau_id" onchange="FmgBxhForm.submit()" class="form-control" style="width:40%;float:right;"><?php
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
              
				<?php
				}
				?>
              <select  name="server_id" id="server_id" onchange="window.location='<?php echo Url::build_current(array('status'));?>&server_id='+this.value" class="form-control" style="width:40%;float:right;"><?php
					if(isset($this->map['server_id_list']))
					{
						foreach($this->map['server_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('server_id').value = "<?php echo addslashes(URL::get('server_id',isset($this->map['server_id'])?$this->map['server_id']:''));?>";</script>
	</select>	
              <input  name="status" id="status" type ="hidden" value="<?php echo String::html_normalize(URL::get('status'));?>">
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
                <td width="5%" <?php echo (FMGAME::my_team_id()==$this->map['items']['current']['dcn_id'])?'bgcolor="#ffe400"':'';?>><img class="clb-img" alt="<?php echo $this->map['items']['current']['doi_chu_nha'];?>" src="<?php echo $this->map['items']['current']['logo_cn'];?>" title="<?php echo $this->map['items']['current']['doi_chu_nha'];?>" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></td>
                <td width="30%"><a href="dhss?team_id=<?php echo $this->map['items']['current']['dcn_id'];?>" title="Xem đội hình"><img src="skins/ssnh/images/fm_game/info.png" alt="Xem đội hình" width="16"></a> <strong><?php echo $this->map['items']['current']['doi_chu_nha'];?></strong><div class="phong-do small">Phong độ: <?php echo $this->map['items']['current']['phong_do_cn'];?></div></td>
                <td align="center">
                  <div>Ngày <?php echo $this->map['items']['current']['thoi_gian_ngay'];?> <?php echo $this->map['items']['current']['thoi_gian_gio'];?>'</div>
                  <?php 
				if(($this->map['items']['current']['ket_qua']))
				{?>
                  <a href="<?php echo Url::build('fmg_play',array('do'=>'thidau','dcn_id'=>$this->map['items']['current']['dcn_id'],'dkh_id'=>$this->map['items']['current']['dkh_id'],'vong_dau_id'=>$this->map['items']['current']['vong_dau_id']))?>" class="btn btn-default">
                  	<?php echo ($this->map['items']['current']['ket_qua']=='Hòa')?'Hòa':(($this->map['items']['current']['ket_qua']=='Thắng')?'<strong>Thắng</strong> - Thua':'Thua - <strong>Thắng</strong>');?>
                  </a>
                   <?php }else{ ?>
                 	<a href="<?php echo Url::build('fmg_play',array('do'=>'thidau','dcn_id'=>$this->map['items']['current']['dcn_id'],'dkh_id'=>$this->map['items']['current']['dkh_id'],'vong_dau_id'=>$this->map['items']['current']['vong_dau_id']))?>" class="btn btn-default">VS</a>
                  
				<?php
				}
				?>
                </td>
                <td width="30%" align="right"><strong><?php echo $this->map['items']['current']['doi_khach'];?></strong> <a href="dhss?team_id=<?php echo $this->map['items']['current']['dkh_id'];?>" title="Xem đội hình"><img src="skins/ssnh/images/fm_game/info.png" alt="Xem đội hình" width="16"></a><div class="phong-do small">Phong độ: <?php echo $this->map['items']['current']['phong_do_kh'];?></div></td>
                <td width="5%" <?php echo (FMGAME::my_team_id()==$this->map['items']['current']['dkh_id'])?'bgcolor="#ffe400"':'';?>><img class="clb-img" alt="<?php echo $this->map['items']['current']['doi_khach'];?>" title="<?php echo $this->map['items']['current']['doi_khach'];?>" src="<?php echo $this->map['items']['current']['logo_kh'];?>" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></td>
              </tr>
              
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
            </tbody>
          </table>
           <?php }else{ ?>
          <div class="alert"><center>
          <div class="highlight">Server sẽ có lịch thi đấu từ 22h5' Ngày thứ 7.<br>Thời gian bắt đầu thi đấu là 9h sáng thứ 3</div><br>
          <a href="<?php echo Url::build_current(array('status'=>'CLOSED'))?>" class="btn btn-default">&raquo; Xem bảng đấu đã kết thúc</a></center></div>
          
				<?php
				}
				?>
        </div>
        <div class="col-xs-4">
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
             <tr <?php echo ($i==1)?'class="top-bxh"':'';$i++;?>>
              <td class="col-hang"><?php echo $this->map['bxh_clbs']['current']['win']?'<img class="top-1-icon" src="skins/ssnh/images/fm_game/rank_1.png" alt="TOP 1" />':$this->map['bxh_clbs']['current']['hang'];?></td>
              <td class="col-club" <?php echo (FMGAME::my_team_id()==$this->map['bxh_clbs']['current']['id'])?' style="color:#ffbb19;"':'';?>><?php echo $this->map['bxh_clbs']['current']['name'];?></td>
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