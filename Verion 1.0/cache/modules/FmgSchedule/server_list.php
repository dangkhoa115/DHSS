<div class="row">
  <div class="col-xs-12 lich-thi-dau">
    <form name="FmgScheduleForm" method="post">
      <div class="row">
        <div class="col-xs-8">
        	<div class="row">
            <div class="col-xs-12">
              <div class="title"><h2>Kết quả thi đấu <?php echo $this->map['server_name'];?></h2></div>
            </div>
            <div class="col-xs-12 text-right">
            	<?php 
				if((Url::iget('server_id')))
				{?>
              <select  name="vong_dau_id" id="vong_dau_id" onchange="FmgScheduleForm.submit()" class="form-control" style="width:20%;float:left;"><?php
					if(isset($this->map['vong_dau_id_list']))
					{
						foreach($this->map['vong_dau_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('vong_dau_id').value = "<?php echo addslashes(URL::get('vong_dau_id',isset($this->map['vong_dau_id'])?$this->map['vong_dau_id']:''));?>";</script>
	</select>&nbsp;
              
				<?php
				}
				?>
              <button id="serverListButton" type="button" class="btn btn-info dropdown-toggle">
                Xem server khác <span class="caret"></span>
              </button>
              <div id="serverList" class="alert">
              	<ul class="choise-item">
                	<?php
					if(isset($this->map['servers']) and is_array($this->map['servers']))
					{
						foreach($this->map['servers'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['servers']['current'] = &$item1;?>
                  <li <?php echo ($this->map['owner_server_id'] == $this->map['servers']['current']['id'])?'style="border:2px solid #F00;" title="Server của bạn"':'';?>><a href="?page=fmg_schedule&server_id=<?php echo $this->map['servers']['current']['id'];?>"><?php echo $this->map['servers']['current']['name'];?></a></li>
                  
							
						<?php
							}
						}
					unset($this->map['servers']['current']);
					} ?>
                </ul>
              </div>
              <input  name="status" id="status" type ="hidden" value="<?php echo String::html_normalize(URL::get('status'));?>">
            </div>
          </div>
          <br>
          <?php 
				if((!empty($this->map['items'])))
				{?>
          <table class="table">      
            <tbody>
              <?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['items']['current'] = &$item2;?>
              <tr>
                <td width="5%"><img class="clb-img" alt="<?php echo $this->map['items']['current']['doi_chu_nha'];?>" src="<?php echo $this->map['items']['current']['logo_cn'];?>" title="<?php echo $this->map['items']['current']['doi_chu_nha'];?>" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'" <?php echo (FMGAME::my_team_id()==$this->map['items']['current']['dcn_id'])?'style="border:5px solid #3F0"':'';?>></td>
                <td width="30%"><a href="dhss?team_id=<?php echo $this->map['items']['current']['dcn_id'];?>" title="Xem đội hình"><span class="ten-clb left"><?php echo $this->map['items']['current']['doi_chu_nha'];?></span></a><div class="phong-do small">Phong độ: <?php echo $this->map['items']['current']['phong_do_cn'];?></div></td>
                <td align="center">
                	<div class="vong-dau"><?php echo $this->map['items']['current']['vong_dau'];?></div>
                  <a href="<?php echo Url::build('fmg_play',array('do'=>'thidau','dcn_id'=>$this->map['items']['current']['dcn_id'],'dkh_id'=>$this->map['items']['current']['dkh_id'],'vong_dau_id'=>$this->map['items']['current']['vong_dau_id']))?>" class="vs">
                  <div>Ngày <?php echo $this->map['items']['current']['thoi_gian_ngay'];?> <?php echo $this->map['items']['current']['thoi_gian_gio'];?>'</div>
                  <?php 
				if(($this->map['items']['current']['ket_qua']))
				{?>
                  <div class="btn btn-default">
                  	<?php echo $this->map['items']['current']['ty_so'];?>
                  </div>
                   <?php }else{ ?>
                 	vs
                  
				<?php
				}
				?>
                  </a>
                </td>
                <td width="30%" align="right"><a href="dhss?team_id=<?php echo $this->map['items']['current']['dkh_id'];?>" title="Xem đội hình"><span class="ten-clb right"><?php echo $this->map['items']['current']['doi_khach'];?></span></a><div class="phong-do small">Phong độ: <?php echo $this->map['items']['current']['phong_do_kh'];?></div></td>
                <td width="5%"><img class="clb-img" alt="<?php echo $this->map['items']['current']['doi_khach'];?>" title="<?php echo $this->map['items']['current']['doi_khach'];?>" src="<?php echo $this->map['items']['current']['logo_kh'];?>" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"  <?php echo (FMGAME::my_team_id()==$this->map['items']['current']['dkh_id'])?'style="border:5px solid #3F0"':'';?>></td>
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
          <div class="highlight hide">TUẦN NÀY ĐANG DIỄN RA CÁC GIẢI ĐẤU PHỤ. <a href="?page=fmg_giai_phu&do=dang_ky">&raquo; ĐĂNG KÝ THAM GIA</a></div><br>
          <div class="highlight">Server sẽ có lịch thi đấu từ 22h5' Ngày thứ 7.<br>Thời gian bắt đầu thi đấu là 9h sáng thứ 3</div><br>
          <a href="<?php echo Url::build_current(array('status'=>'CLOSED'))?>" class="btn btn-default">&raquo; Xem lịch sử các bảng đấu</a></center></div>
          
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
						foreach($this->map['bxh_clbs'] as $key3=>&$item3)
						{
							if($key3!='current')
							{
								$this->map['bxh_clbs']['current'] = &$item3;?>
             <tr <?php echo ($i==1)?'class="top-bxh"':'';$i++;?>>
              <td class="col-hang" align="center"><?php echo $this->map['bxh_clbs']['current']['win']?'<img class="top-1-icon" src="skins/ssnh/images/fm_game/rank_1.png" alt="TOP 1" />':(($this->map['bxh_clbs']['current']['hang']==1)?'<span class="glyphicon glyphicon-king" aria-hidden="true"></span> ':$this->map['bxh_clbs']['current']['hang']);?></td>
              <td class="col-club"><a <?php echo (FMGAME::my_team_id()==$this->map['bxh_clbs']['current']['id'])?' style="color:#ffbb19;"':'';?> href="dhss/?team_id=<?php echo $this->map['bxh_clbs']['current']['id'];?>" class="external"><?php echo $this->map['bxh_clbs']['current']['name'];?></a></td>
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
	jQuery('#serverListButton').click(function(){
		jQuery('#serverList').toggle(500,false,function(){});	
	});
});
</script>