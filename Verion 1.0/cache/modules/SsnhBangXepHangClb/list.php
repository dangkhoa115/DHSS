<div class="include bxh">
	<div class="title"><h3>Bảng xếp hạng Ngoại Hạng Anh 2015/2016</h3></div>
  <div class="leaguetablesidebar">
    <table cellspacing="0" cellpadding="0" class="leagueTable">
      <tbody>
        <tr>
        <th class="col-hang">Hạng</th>
        <th class="col-club">Club</th>    
        <th class="col-hs">HS</th>            
				<th class="col-pts">Điểm</th>            
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
       	<td class="col-hang"><?php echo $this->map['clbs']['current']['hang'];?></td>
        <td class="col-club"><a href="clb/<?php echo $this->map['clbs']['current']['name_id'];?>.html" class="external"><?php echo $this->map['clbs']['current']['ten'];?></a></td>
        
        <td class="col-hs"><?php echo $this->map['clbs']['current']['ban_thang'];?>-<?php echo $this->map['clbs']['current']['ban_thua'];?></td>
        <td class="col-pld"><?php echo $this->map['clbs']['current']['diem'];?></td>       
       </tr>
       
							
						<?php
							}
						}
					unset($this->map['clbs']['current']);
					} ?>
      </tbody>
     </table>
     <div class="bottom"><a class="btn btn-default" href="tin-tuc/tin-bong-da/bang-xep-hang-bong-da-anh-2014-2015.html">>>BXH bóng đá Anh mùa giải 2014 - 2015</a></div>
   </div>
</div><!--End .include-->