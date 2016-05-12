<div class="row">
	<div class="col-xs-12 clb">
	<div class="title"><h1>Danh sách đội bóng</h1></div>
  <table border="0" cellspacing="0" cellpadding="0" class="table">
    <tbody>
      <tr>
      <th width="5%">#</th>
      <th width="80%" colspan="2">Club</th>
      <th width="5%" align="center">Power</th>
      <th width="5%" align="center">On/off</th>          
      <th width="10%" align="center">&nbsp;</th>
     </tr>
     <?php $i=1;?>
     <!--LIST:clbs-->
     <tr>
      <td>[[|clbs.stt|]]</td>
      <td width="1%" align="center"><a href="dhss?team_id=[[|clbs.id|]]"><img src="[[|clbs.logo|]]" alt="[[|clbs.name|]]" width="50" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></a></td>     
      <td>
      	<a href="dhss?team_id=[[|clbs.id|]]">[[|clbs.name|]]</a><br>
        <div class="small">HLV: [[|clbs.hlv|]]</div>
        <div class="small">Phong độ: [[|clbs.phong_do|]]</div>
			</td>
      <td align="center">[[|clbs.power|]]</td>
      <td align="center" valign="middle">[[|clbs.online_status|]]</td>
      <td align="center"><a href="<?php echo Url::build_current(array('do'=>'thach_dau','dcn_id'=>FMGAME::my_team_id(),'dkh_id'=>[[=clbs.id=]]))?>" class="btn btn-default">Thách đấu</a></td>
     </tr>
     <!--/LIST:clbs-->
    </tbody>
   </table>
   <div class="pt">[[|paging|]]</div>
	</div>
</div>