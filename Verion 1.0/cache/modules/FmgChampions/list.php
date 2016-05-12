<div class="row">
  <div class="col-xs-12 lich-thi-dau">
    <form name="FmgChampionsForm" method="post">
      <div class="row">
      	<div class="col-xs-8">
        	<div class="title"><h1>Đội bóng chiến thắng</h1></div>
        	<table cellspacing="0" cellpadding="0" class="table bxh">
            <tbody>
              <tr>
              <th>Hạng</th>
              <th colspan="2">Club</th>
              <th align="center">Server</th>
              <th align="center">Power</th>
              <th align="center">Điểm</th>            
             </tr>
             <?php $i=1;?>
             <?php
					if(isset($this->map['clbs']) and is_array($this->map['clbs']))
					{
						foreach($this->map['clbs'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['clbs']['current'] = &$item1;?>
             <tr class="accent<?php echo ($i==1)?$i:(($i<=4)?2:(($i==5)?3:''));$i++;?>">
              <td align="center"><?php echo $this->map['clbs']['current']['win']?'<img class="top-1-icon" src="skins/ssnh/images/fm_game/rank_1.png" alt="TOP 1" />':$this->map['clbs']['current']['hang'];?></td>
              <td width="1%"><a href="/dhss?team_id=<?php echo $this->map['clbs']['current']['clb_id'];?>" class="external"><img src="<?php echo $this->map['clbs']['current']['logo'];?>" alt="Top 1" width="50" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></a></td>
              <td><a href="/dhss?team_id=<?php echo $this->map['clbs']['current']['clb_id'];?>" class="external"><?php echo $this->map['clbs']['current']['name'];?></a></td>
              <td align="left"><?php echo $this->map['clbs']['current']['server'];?></td>
              <td align="center"><?php echo $this->map['clbs']['current']['power'];?></td>
              <td align="center"><?php echo $this->map['clbs']['current']['diem'];?></td>       
             </tr>
             
							
						<?php
							}
						}
					unset($this->map['clbs']['current']);
					} ?>
            </tbody>
           </table>
        </div>
        <div class="col-xs-4">
        	<div class="title"><h2>Lịch liên đấu Server</h2></div>
          <div class="alert big">Bắt đầu vào lúc 9h ngày thứ 7 hàng tuần</div>
          <center><a class="btn btn-warning" href="<?php echo Url::build('fmg_schedule',array('lien-dau'=>1));?>">Xem lịch và kết quả liên đấu</a></center>
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