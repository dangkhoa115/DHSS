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
      <tr class="head">
      <th width="5%">#</th>
      <th width="20%" colspan="2">Đội thách đấu
      <th width="10%" align="center">Kết quả</th>
      <th width="20%" colspan="2">Nhận thách đấu
      <th width="10%" align="center">Đặt</th>
      <th width="10%" align="center">Mời lúc</th>
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
      <td width="1%" align="center"><a href="dhss?team_id=<?php echo $this->map['clbs']['current']['clb_id1'];?>"><img src="<?php echo $this->map['clbs']['current']['clb1_logo'];?>" alt="<?php echo $this->map['clbs']['current']['clb1_name'];?>" width="50" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></a></td>     
      <td>
      	<a href="dhss?team_id=<?php echo $this->map['clbs']['current']['clb_id1'];?>"><?php echo $this->map['clbs']['current']['clb1_name'];?></a><br>
        <div class="small">HLV: <?php echo $this->map['clbs']['current']['hlv1_name'];?></div>
			</td>
      <td align="center">
      	<?php echo $this->map['clbs']['current']['ket_qua'];?><br>
        <a href="?page=fmg_thach_dau&do=accepted&act=duoc_moi&id=<?php echo $this->map['clbs']['current']['id'];?>" class="btn btn-default btn-sm"><?php echo $this->map['clbs']['current']['ty_so'];?></a>
       </td>
      <td width="1%" align="center"><a href="dhss?team_id=<?php echo $this->map['clbs']['current']['clb_id2'];?>"><img src="<?php echo $this->map['clbs']['current']['clb2_logo'];?>" alt="<?php echo $this->map['clbs']['current']['clb2_name'];?>" width="50" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></a></td>     
      <td>
        <a href="dhss?team_id=<?php echo $this->map['clbs']['current']['clb_id2'];?>"><?php echo $this->map['clbs']['current']['clb2_name'];?></a><br>
        <div class="small">HLV: <?php echo $this->map['clbs']['current']['hlv2_name'];?></div>
      </td>
      <td><strong><?php echo $this->map['clbs']['current']['igold'];?> iGold</strong></td>
      <td><?php echo $this->map['clbs']['current']['time'];?></td>
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
</script>