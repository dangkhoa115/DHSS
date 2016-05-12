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
          <input name="keyword" type="text" id="keyword" placeholder="Nhập tên tìm kiếm" class="form-control">
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
     <!--LIST:bxh_hlv-->
     <tr>
      <td>[[|bxh_hlv.stt|]]</td>
      <td width="1%" align="center"><a href="dhss?team_id=[[|bxh_hlv.id|]]"><img src="[[|bxh_hlv.image_url|]]" alt="[[|bxh_hlv.name_clb|]]" width="50" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></a></td>     
      <td>
      	<a href="dhss?team_id=[[|bxh_hlv.id|]]">[[|bxh_hlv.name_clb|]]</a><br>
        <div class="small">HLV: [[|bxh_hlv.name_hlv|]]</div>
        <!--IF:cond(User::is_admin())-->
        <div class="small">ID: [[|bxh_hlv.acc|]]</div>
        <!--/IF:cond-->
			</td>
      <td align="center">[[|bxh_hlv.cache_power|]]</td>
      <td align="center" valign="middle">[[|bxh_hlv.level|]]</td>
      <td align="center" valign="middle">[[|bxh_hlv.diem_kn|]]</td>
     </tr>
     <!--/LIST:bxh_hlv-->
    </tbody>
   </table>
   </form>
   <div class="pt">[[|paging|]]</div>
   
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