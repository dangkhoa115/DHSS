<div class="row">
	<div class="col-xs-12 tin-nhan">
	<div class="title"><h1>THÁCH ĐẤU</h1></div>
  <nav class="tab">
  	<ul>
        	<li><a href="<?php echo Url::build_current();?>" <?php echo (!Url::get('act') and !Url::get('do'))?' class="active"':''?>>Lịch sử thách đấu</a></li>
      <li><a href="<?php echo Url::build_current(array('do'=>'moi','act'=>'duoc_moi'));?>" <?php echo (Url::get('act')=='duoc_moi')?' class="active"':''?>>Được mời</a></li>
      <li><a href="<?php echo Url::build_current(array('do'=>'moi','act'=>'moi'));?>" <?php echo (Url::get('act')=='moi')?' class="active"':''?>>Đã mời</a></li>
      <li><a href="<?php echo Url::build_current(array('do'=>'moi'));?>" <?php echo (Url::get('do')=='moi' and !Url::get('act'))?' class="active"':''?>>Mời đội bóng</a></li>
	
    </ul>
  </nav>
  <br clear="all">
  <form name="AvailableTeamForm" id="AvailableTeamForm" method="post">
  <table border="0" cellspacing="0" cellpadding="0" class="table">
    <tbody>
      <tr>
      <th width="5%">#</th>
      <th width="60%" colspan="2">
      	<div class="row">
  			<div class="col-lg-3">
        Club 
        </div>
        <div class="col-lg-9">
        	<div class="input-group">
          <?php 
				if((User::can_admin(false,ANY_CATEGORY)))
				{?>
          <span class="input-group-addon"><input  name="is_agent" type ="checkbox" id="t" value="<?php echo String::html_normalize(URL::get('is_agent','1'));?>"> Nội bộ</span>
          
				<?php
				}
				?>
          <span class="input-group-addon"><input  name="online" type ="checkbox" id="e" value="<?php echo String::html_normalize(URL::get('online','1'));?>"> Lọc đội đang online</span>
          <input  name="keyword" id="keyword" placeholder="Nhập tên tìm kiếm" class="form-control" type ="text" value="<?php echo String::html_normalize(URL::get('keyword'));?>">
          <span class="input-group-addon"><input type="submit" value="OK"></span>
          </div>
        </div>
      	</div>  
      </th>
      <th width="5%" align="center"><a href="<?php echo Url::build_current(array('page_no','power','keyword','order'=>(Url::get('order')=='power_desc')?'power_asc':'power_desc'));?>">Power</a></th>
      <th width="5%" align="center">On/off</th>          
      <th width="30%" align="center">&nbsp;</th>
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
        <div class="small">HLV: <?php echo ($this->map['clbs']['current']['id']==1046)?'Hải Nam':$this->map['clbs']['current']['hlv']?></div>
        <?php 
				if((User::can_admin(false,ANY_CATEGORY)))
				{?>
        <div class="small" style="color:#F0FF00;"><a href="#" onClick="doiVaiTro(this,'<?php echo $this->map['clbs']['current']['account_id'];?>','<?php echo ($this->map['clbs']['current']['is_agent'])?0:1;?>');return false;" style="color:<?php echo ($this->map['clbs']['current']['is_agent'])?'#69F3FF':'#CCC'?>" title="Đổi trạng thái">><?php echo ($this->map['clbs']['current']['is_agent'])?'Nội bộ':'Người chơi'?></a> | ID: <?php echo $this->map['clbs']['current']['account_id'];?></div>
        
				<?php
				}
				?>
        <div class="small">Phong độ: <?php echo $this->map['clbs']['current']['phong_do'];?></div>
        <?php 
				if((User::can_admin(false,ANY_CATEGORY)))
				{?>
        <div class="small">Ngày tạo: <?php echo $this->map['clbs']['current']['time'];?></div>
        
				<?php
				}
				?>
			</td>
      <td align="center"><?php echo $this->map['clbs']['current']['power'];?></td>
      <td align="center" valign="middle"><?php echo $this->map['clbs']['current']['online_status'];?></td>
      <td align="center">
      	<?php 
				if(($this->map['clbs']['current']['moi']))
				{?>
        <div class="btn-group btn-group-sm" role="group" aria-label="Default button group">
        <?php echo $this->map['clbs']['current']['moi'];?>
        </div>
        <div class="small">Lúc: <?php echo $this->map['clbs']['current']['time'];?><br>
					<span><a href="#" onClick="return false;" title="Thách đấu mức <?php echo $this->map['clbs']['current']['igold'];?> iGold"><?php echo $this->map['clbs']['current']['igold'];?> iGold</a></span>
          <?php echo $this->map['clbs']['current']['huy'];?></div>
         <?php }else{ ?>
        <?php if($this->map['clbs']['current']['power']>0){?>
      	<a href="#" data-toggle="modal" data-target="#myModal" onClick="url = '<?php echo Url::build_current(array('do'=>'invite','dcn_id'=>FMGAME::my_team_id(),'dkh_id'=>$this->map['clbs']['current']['id']))?>';" class="btn btn-default" title="Nếu thắng, BTC sẽ thu lại 10% phí thi đấu!">Thách đấu</a>
        <?php }else{?>
        ...
        <?php }?>
        
				<?php
				}
				?>
     	</td>
     </tr>
     
							
						<?php
							}
						}
					unset($this->map['clbs']['current']);
					} ?>
    </tbody>
   </table>
   <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
   <div class="pt"><?php echo $this->map['paging'];?></div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">MỜI THÁCH ĐẤU</h4>
      </div>
      <div class="modal-body">
        <label for="igold">Chọn mức igold</label>
        <select  name="igold" id="igold" class="form-control">
        	<option value="5"> 5 iGold</option>
          <option value="10"> 10 iGold</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
        <button type="button" onClick="sendInvite();" class="btn btn-primary">Gửi lời mời</button>
      </div>
    </div>
  </div>
</div>
<script>
var url = '';
function sendInvite(){
	//custom_alert(url+'&igold='+getId('igold').value);
	window.location = url+'&igold='+getId('igold').value;
}
<?php 
				if((User::can_admin(false,ANY_CATEGORY)))
				{?>
function doiVaiTro(obj,account_id,is_agent){
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			'do':'doi_vai_tro',
			'account_id':account_id,
			'is_agent':is_agent
		},
		beforeSend: function(){
			obj.innerHTML = 'Update ... ';
		},
		success: function(content){
			obj.innerHTML = '>' + content;
		},
		error: function(){
			custom_alert('Update lỗi');
		}
	});
}

				<?php
				}
				?>
</script>