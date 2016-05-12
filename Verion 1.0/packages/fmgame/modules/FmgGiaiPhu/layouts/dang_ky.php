<div class="row">
  <div class="col-xs-12 clb">
    <form name="FmgGiaiPhuForm" method="post">
      <div class="row">
        <div class="col-xs-12">
        	<div class="row">
            <div class="col-xs-12">
              <div class="title"><h2>ĐĂNG KÝ GIẢI ĐẤU PHỤ ĐỂ CÓ CƠ HỘI NHẬN SỐ IGOLD KHỦNG</h2></div>
              <div class="alert big">Diễn ra vào 15h HÀNG NGÀY.</div>
              <div class="alert">
              	<ul>
              		<li>Tùy vào Power của bạn, hệ thống máy tính sẽ tự động chọn bạn vào bảng đấu phù hợp.</li>
                  <li>Bạn sẽ góp <strong class="highlight">5 iGold</strong> vào bảng đấu. Đội <strong class="highlight">vô địch</strong> sẽ nhận phần thưởng bằng <strong class="highlight">tổng số iGold</strong> của các câu lạc bộ tham gia bảng đấu công lại (BTC thu 15% phí tổ chức).</li>
                </ul>
              </div>
            </div>
          </div>
          <!--IF:cond_(![[=server_id=]])-->
					<div>
            <center><a href="?page=fmg_giai_phu&do=xn_dang_ky" class="btn btn-danger btn-lg">XÁC NHẬN ĐĂNG KÝ</a></center><br>
            
          </div>
          <!--ELSE-->
          <div>
            <center> <a href="?page=fmg_giai_phu&do=dang_ky#server[[|server_id|]]" class="btn btn-success"> ĐÃ ĐĂNG KÝ !</a></center><br>
          </div>
          <!--/IF:cond_-->
          <div>
          	<h3>Danh sách server</h3>
            <h5>(Power hiện tại của bạn: [[|power|]])</h5>
          	<table width="100%" border="0" cellspacing="0" cellpadding="5" class="table">
              <tbody>
                <tr bgcolor="#6F6F6F">
                  <th>Server</th>
                  <th>Power</th>
                  <th>Tổng số đội đã đăng ký</th>
                </tr>
                <?php $total = 0;?>
                <!--LIST:servers-->
                <?php $total += [[=servers.tong_clb=]];?>
                <tr>
                  <td <?php echo ([[=servers.id=]]==[[=server_id=]])?'style="color:#FF6E00;"':'';?>>
                  	<a name="server[[|servers.id|]]"></a>#[[|servers.id|]]/[[|servers.name|]]<?php echo ([[=servers.id=]]==[[=server_id=]])?' (Đã đăng ký)':'';?>
                  </td>
                  <td>[[|servers.power_from|]] - [[|servers.power_to|]]</td>
                  <td>[[|servers.tong_clb|]]</td>
                </tr>
                <!--/LIST:servers-->
                <tr>
                  <td>&nbsp;</td>
                  <td><strong>Tổng cộng</strong></td>
                  <td><strong><?php echo $total;?></strong></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>    
      </div>
    </form>  
	</div>
</div>
<script>
jQuery(document).ready(function() {
	
});
</script>