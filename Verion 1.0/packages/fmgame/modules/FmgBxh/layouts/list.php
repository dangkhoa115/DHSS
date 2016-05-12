<div class="row">
  <div class="col-xs-12 lich-thi-dau">
    <form name="FmgBxhForm" method="post">
      <div class="row">
        <div class="col-md-8">
        	<div class="row">
            <div class="col-xs-12">
              <div class="title"><h2>Bảng xếp hạng <strong style="color:#FCFF9C;">[[|server_name|]]</strong></h2></div>
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
             <!--LIST:bxh_clbs-->
             <tr <?php echo ($i==1)?'class="top-bxh"':'';$i++;?>>
               <td><?php echo [[=bxh_clbs.win=]]?'<img class="top-1-icon" src="skins/ssnh/images/fm_game/rank_1.png" alt="TOP 1" />':(([[=bxh_clbs.hang=]]==1)?'<span class="glyphicon glyphicon-king" aria-hidden="true"></span> ':[[=bxh_clbs.hang=]]);?></td>
               <td <?php echo (FMGAME::my_team_id()==[[=bxh_clbs.id=]])?' style="color:#ffbb19;"':'';?>><a href="dhss/?team_id=[[|bxh_clbs.id|]]" target="_blank" title="Tham khảo đội hình" class="name">[[|bxh_clbs.name|]]</a></td>
              <td align="center">[[|bxh_clbs.power|]]</td>
              <td align="center" nowrap>[[|bxh_clbs.phong_do|]]</td>
              <td align="center">[[|bxh_clbs.ban_thang|]]</td>
              <td align="center">[[|bxh_clbs.ban_thua|]]</td>
              <td align="center">[[|bxh_clbs.hieu_so|]]</td>
              <td>[[|bxh_clbs.diem|]]</td>       
              </tr>
             <!--/LIST:bxh_clbs-->
            </tbody>
           </table>
        </div>
        <div class="col-md-4">
        	<div class="title"><h3>Xem theo server</h3></div>
					<div class="alert list-item">
            <ul>
              <!--LIST:servers-->
              <li <?php echo (Url::iget('server_id') == [[=servers.id=]])?' class="selected"':'';?>><a href="?page=bang-xep-hang&server_id=[[|servers.id|]]"> <span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span> [[|servers.name|]]</a></li>
              <!--/LIST:servers-->
            </ul>
          </div>
					<input name="status" type="hidden" id="status">
        </div>
      </div><!--End .list-player-->
    </form>  
	</div>
</div>
<script>
jQuery(document).ready(function() {
	
});
</script>