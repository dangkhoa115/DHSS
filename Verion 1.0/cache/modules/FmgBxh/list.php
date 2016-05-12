<div class="row">
  <div class="col-xs-12 lich-thi-dau">
    <form name="FmgBxhForm" method="post">
      <div class="row">
        <div class="col-md-8">
        	<div class="row">
            <div class="col-xs-12">
              <div class="title"><h2>Bảng xếp hạng <strong style="color:#FCFF9C;"><?php echo $this->map['server_name'];?></strong></h2></div>
            </div>
          </div>
        	<table class="table table-bordered">
            <tbody>
              <tr bgcolor="#333">
                <th width="5%">Hạng</th>
                <th width="40%">Club</th>
              <th align="center">Power</th>
              <th width="15%">Phong độ</th>
              <th>Bàn thắng</th>
              <th>Bàn thua</th>
              <th>Hiệu số</th>
              <th>Điểm</th>      
              </tr>
             <?php $i=1;?>
             <?php
					if(isset($this->map['bxh_clbs']) and is_array($this->map['bxh_clbs']))
					{
						foreach($this->map['bxh_clbs'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['bxh_clbs']['current'] = &$item1;?>
             <tr <?php echo ($i==1)?'class="top-bxh"':'';$i++;?>>
               <td><?php echo $this->map['bxh_clbs']['current']['win']?'<img class="top-1-icon" src="skins/ssnh/images/fm_game/rank_1.png" alt="TOP 1" />':(($this->map['bxh_clbs']['current']['hang']==1)?'<span class="glyphicon glyphicon-king" aria-hidden="true"></span> ':$this->map['bxh_clbs']['current']['hang']);?></td>
               <td <?php echo (FMGAME::my_team_id()==$this->map['bxh_clbs']['current']['id'])?' style="color:#ffbb19;"':'';?>><a href="dhss/?team_id=<?php echo $this->map['bxh_clbs']['current']['id'];?>" target="_blank" title="Tham khảo đội hình" class="name"><?php echo $this->map['bxh_clbs']['current']['name'];?></a></td>
              <td align="center"><?php echo $this->map['bxh_clbs']['current']['power'];?></td>
              <td align="center" nowrap><?php echo $this->map['bxh_clbs']['current']['phong_do'];?></td>
              <td align="center"><?php echo $this->map['bxh_clbs']['current']['ban_thang'];?></td>
              <td align="center"><?php echo $this->map['bxh_clbs']['current']['ban_thua'];?></td>
              <td align="center"><?php echo $this->map['bxh_clbs']['current']['hieu_so'];?></td>
              <td><?php echo $this->map['bxh_clbs']['current']['diem'];?></td>       
              </tr>
             
							
						<?php
							}
						}
					unset($this->map['bxh_clbs']['current']);
					} ?>
            </tbody>
           </table>
        </div>
        <div class="col-md-4">
        	<div class="title"><h3>Xem theo server</h3></div>
					<div class="alert list-item">
            <ul>
              <?php
					if(isset($this->map['servers']) and is_array($this->map['servers']))
					{
						foreach($this->map['servers'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['servers']['current'] = &$item2;?>
              <li <?php echo (Url::iget('server_id') == $this->map['servers']['current']['id'])?' class="selected"':'';?>><a href="?page=bang-xep-hang&server_id=<?php echo $this->map['servers']['current']['id'];?>"> <span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span> <?php echo $this->map['servers']['current']['name'];?></a></li>
              
							
						<?php
							}
						}
					unset($this->map['servers']['current']);
					} ?>
            </ul>
          </div>
					<input  name="status" id="status" type ="hidden" value="<?php echo String::html_normalize(URL::get('status'));?>">
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