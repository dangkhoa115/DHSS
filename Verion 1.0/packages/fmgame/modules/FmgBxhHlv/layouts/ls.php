<div class="row">
	<div class="col-xs-12 tin-nhan">
	<div class="title"><h1>THÁCH ĐẤU</h1></div>
  <nav class="tab">
  	<ul>
    	<li><a href="<?php echo Url::build_current();?>" <?php echo (!Url::get('act') and !Url::get('do'))?' class="active"':''?>>Tất cả các đội</a></li>
      <li><a href="<?php echo Url::build_current(array('act'=>'duoc_moi'));?>" <?php echo (Url::get('act')=='duoc_moi')?' class="active"':''?>>Được mời</a></li>
      <li><a href="<?php echo Url::build_current(array('act'=>'moi'));?>" <?php echo (Url::get('act')=='moi')?' class="active"':''?>>Đã mời</a></li>
      <li><a href="<?php echo Url::build_current(array('do'=>'ls'));?>" <?php echo (Url::get('do')=='ls')?' class="active"':''?>>Lịch sử thách đấu</a></li>
    </ul>
  </nav>
  <br clear="all">
  <form name="AvailableTeamForm" id="AvailableTeamForm" method="post">
  <table border="0" cellspacing="0" cellpadding="0" class="table">
    <tbody>
      <tr>
      <th width="5%">#</th>
      <th width="20%" colspan="2">Đội thách đấu
      <th width="10%" align="center">Kết quả</th>
      <th width="20%" colspan="2">Nhận thách đấu
      <th width="10%" align="center">Đặt</th>
      <th width="10%" align="center">Mời lúc</th>
      </tr>
     <?php $i=1;?>
     <!--LIST:clbs-->
     <tr>
      <td>[[|clbs.stt|]]</td>
      <td width="1%" align="center"><a href="dhss?team_id=[[|clbs.clb_id1|]]"><img src="[[|clbs.clb1_logo|]]" alt="[[|clbs.clb1_name|]]" width="50" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></a></td>     
      <td>
      	<a href="dhss?team_id=[[|clbs.clb_id1|]]">[[|clbs.clb1_name|]]</a><br>
        <div class="small">HLV: [[|clbs.hlv1_name|]]</div>
			</td>
      <td>[[|clbs.ket_qua|]]</td>
      <td width="1%" align="center"><a href="dhss?team_id=[[|clbs.clb_id2|]]"><img src="[[|clbs.clb2_logo|]]" alt="[[|clbs.clb2_name|]]" width="50" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></a></td>     
      <td>
        <a href="dhss?team_id=[[|clbs.clb_id2|]]">[[|clbs.clb2_name|]]</a><br>
        <div class="small">HLV: [[|clbs.hlv2_name|]]</div>
      </td>
      <td><strong>[[|clbs.igold|]] iGold</strong></td>
      <td>[[|clbs.time|]]</td>
      </tr>
     <!--/LIST:clbs-->
    </tbody>
   </table>
   </form>
   <div class="pt">[[|paging|]]</div>
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