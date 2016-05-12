<div class="row">
	<div class="col-xs-12 clb">
	<div class="title"><h1>Danh sách đội bóng</h1></div>
  <table border="0" cellspacing="0" cellpadding="0" class="table">
    <tbody>
      <tr>
      <th width="5%">#</th>
      <th width="80%" colspan="2">Club</th>
      <th width="5%" align="center"><a href="<?php echo Url::build_current(array('page_no','power','order'=>(Url::get('order')=='power_desc')?'power_asc':'power_desc'));?>">Power</a></th>
      <th width="5%" align="center">On/off</th>          
      <th width="10%" align="center">&nbsp;</th>
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
     <tr>
      <td><?php echo $this->map['clbs']['current']['stt'];?></td>
      <td width="1%" align="center"><a href="dhss?team_id=<?php echo $this->map['clbs']['current']['id'];?>"><img src="<?php echo $this->map['clbs']['current']['logo'];?>" alt="<?php echo $this->map['clbs']['current']['name'];?>" width="50" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></a></td>     
      <td>
      	<a href="dhss?team_id=<?php echo $this->map['clbs']['current']['id'];?>"><?php echo $this->map['clbs']['current']['name'];?></a><br>
        <div class="small">HLV: <?php echo $this->map['clbs']['current']['hlv'];?></div>
        <div class="small">Phong độ: <?php echo $this->map['clbs']['current']['phong_do'];?></div>
			</td>
      <td align="center"><?php echo $this->map['clbs']['current']['power'];?></td>
      <td align="center" valign="middle"><?php echo $this->map['clbs']['current']['online_status'];?></td>
      <td align="center"><a href="<?php echo Url::build_current(array('do'=>'thach_dau','dcn_id'=>FMGAME::my_team_id(),'dkh_id'=>$this->map['clbs']['current']['id']))?>" class="btn btn-default">Thách đấu</a></td>
     </tr>
     
							
						<?php
							}
						}
					unset($this->map['clbs']['current']);
					} ?>
    </tbody>
   </table>
   <div class="pt"><?php echo $this->map['paging'];?></div>
	</div>
</div>