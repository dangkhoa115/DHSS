<link rel="stylesheet" href="skins/fmgame/css/hlv.css" type="text/css" />
<div class="row">
	<div class="col-xs-8 tin-nhan">
	<div class="title"><h1>BẢNG XẾP HẠNG HUẤN LUYỆN VIÊN</h1></div>
  <nav class="tab hide">
  	<ul>
    	<li><a href="<?php echo Url::build_current();?>" <?php echo (!Url::get('act') and !Url::get('do'))?' class="active"':''?>>Tất cả các đội</a></li>
    </ul>
  </nav>
  <br clear="all">
  <form name="AvailableTeamForm" id="AvailableTeamForm" method="post">
  <table border="0" cellspacing="0" cellpadding="0" class="table">
    <tbody>
      <tr>
      <th>Stt</th>
      <th width="50%" colspan="2">
      	<div class="row">
  			<div class="col-lg-3">
        Club 
        </div>
        <div class="col-lg-9">
        	<div class="input-group">
          <input  name="keyword" id="keyword" placeholder="Nhập tên tìm kiếm" class="form-control" type ="text" value="<?php echo String::html_normalize(URL::get('keyword'));?>">
          <span class="input-group-addon"><input type="submit" value="OK"></span>
          </div>
        </div>
      	</div>  
      </th>
      <th width="20%" align="center"><a href="<?php echo Url::build_current(array('page_no','power','keyword','order'=>(Url::get('order')=='power_desc')?'power_asc':'power_desc'));?>">Power</a></th>
      <th width="30%" align="center">Level</th>
      <th width="30%" align="center">Điểm kinh nghiệm</th>
     </tr>
     <?php $i=1;?>
     <?php
					if(isset($this->map['bxh_hlv']) and is_array($this->map['bxh_hlv']))
					{
						foreach($this->map['bxh_hlv'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['bxh_hlv']['current'] = &$item1;?>
     <tr>
      <td><?php echo $this->map['bxh_hlv']['current']['stt'];?></td>
      <td width="1%" align="center"><a href="dhss?team_id=<?php echo $this->map['bxh_hlv']['current']['id'];?>"><img src="<?php echo $this->map['bxh_hlv']['current']['image_url'];?>" alt="<?php echo $this->map['bxh_hlv']['current']['name_clb'];?>" width="50" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></a></td>     
      <td>
      	<a href="dhss?team_id=<?php echo $this->map['bxh_hlv']['current']['id'];?>"><?php echo $this->map['bxh_hlv']['current']['name_clb'];?></a><br>
        <div class="small">HLV: <?php echo $this->map['bxh_hlv']['current']['name_hlv'];?></div>
        <?php 
				if((User::is_admin()))
				{?>
        <div class="small">ID: <?php echo $this->map['bxh_hlv']['current']['acc'];?></div>
        
				<?php
				}
				?>
			</td>
      <td align="center"><?php echo $this->map['bxh_hlv']['current']['cache_power'];?></td>
      <td align="center" valign="middle"><?php echo $this->map['bxh_hlv']['current']['level'];?></td>
      <td align="center" valign="middle"><?php echo $this->map['bxh_hlv']['current']['diem_kn'];?></td>
     </tr>
     
							
						<?php
							}
						}
					unset($this->map['bxh_hlv']['current']);
					} ?>
    </tbody>
   </table>
   <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
   <div class="pt"><?php echo $this->map['paging'];?></div>
   
	</div>
  <div class="col-md-4">
    <div class="note_bxh_hlv">
      <!-- <div class="col-md-4"></div> -->
      <div class="col-md-12 alert note-bxh-hlv">
      <ul>
          <li><strong>Điểm kinh nghiệm của HLV được tính theo:</strong> </li>
          <li>Nhất bảng đấu <strong>giải chính</strong> được <span class="highlight">20 Điểm</span></li>
          <li>Vô địch <strong>giải Liên Đấu</strong> được <span class="highlight">30 Điểm</span></li>
          <li>Vô địch <strong>giải phụ</strong> được <span class="highlight">10 Điểm</span></li>
          <li>1 trận thắng <strong>giải chính</strong> được: <span class="highlight">5 Điểm</span></li>
          <li>1 trận thắng <strong>giải phụ</strong> được <span class="highlight">2 Điểm</span></li>
          <li>1 trận thắng <strong>liên đấu</strong> được <span class="highlight">10 Điểm</span></li>
          <li class="hide">1 trận thắng <strong>thách đấu</strong> được <span class="highlight">1 Điểm</span></li>
          
        </ul>
      </p>
      </div>
      <!-- <div class="col-md-4"></div> -->
      
   </div>
   <div class="alert note_bxh_hlv">
   		<h3>Biểu tượng HLV</h3><br>
   		<table width="100%">
      	<tr>
        	<td width="30%"><img src="skins/ssnh/images/fm_game/tap_su.png" alt="Tập sự" width="80"></td>
          <td width="70%" align="left">Level 1 - level <?php echo floor(0.4*sqrt(500)) - 1;?></td>
        </tr>
        <tr>
        	<td><img src="skins/ssnh/images/fm_game/ban_chuyen.png" alt="Bán chuyên" width="80"></td>
          <td>Level <?php echo floor(0.4*sqrt(500))?> - level <?php echo floor(0.4*sqrt(1000)) - 1?></td>
        </tr>
        <tr>
        	<td><img src="skins/ssnh/images/fm_game/chuyen_nghiep.png" alt="Chuyên nghiệp" width="80"></td>
          <td>Level <?php echo floor(0.4*sqrt(1000))?> - level <?php echo floor(0.4*sqrt(2500)) -1?><br>
					+ Tặng 2 igold khi điểm danh
				</td>
        </tr>
        <tr>
        	<td><img src="skins/ssnh/images/fm_game/ngoai_hang.png" alt="Ngoại hạng" width="80"></td>
          <td>Level <?php echo floor(0.4*sqrt(2500))?> trở lên<br>
          	+ Tặng 2 igold khi điểm danh<br>
            + Thêm 1 lượt chuyển nhượng<br>
            </td>
        </tr>
      </table>
   </div>
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