<div class="row">
  <div class="col-xs-12 lien-dau giai-phu" style="background:rgba(96, 96, 96, 0.52);">
    <form name="FmgGiaiPhuForm" method="post">
      <div class="row">
        <div class="col-xs-12">
        	<div class="row">
            <div class="col-xs-8">
              <div class="title"><h2>LỊCH VÀ KẾT QUẢ GIẢI ĐẤU PHỤ</h2></div>
            </div>
            <div class="col-xs-4">
              <div class="chon-vong-dau">
              <label for="server_id">Xem theo</label><select name="server_id" id="server_id" onchange="FmgGiaiPhuForm.submit()" class="form-control"></select></div>
            </div>
          </div>
          <!--IF:cond_(![[=server_id=]])-->
            <div>
              <center><a href="?page=fmg_giai_phu&do=xn_dang_ky" class="btn btn-danger btn-lg">ĐĂNG KÝ NGAY</a></center><br>
              
            </div>
            <!--ELSE-->
            <div>
              <center> <a href="?page=fmg_giai_phu&do=dang_ky#server[[|server_id|]]" class="btn btn-success"> XEM SERVER ĐÃ ĐĂNG KÝ !</a></center><br>
            </div>
            <!--/IF:cond_-->
					<div>
          	<!--IF:cond([[=lich=]])-->
          	[[|lich|]]
            <!--ELSE-->
            <div class="alert big">Lịch thi đấu sẽ có từ 14h trong ngày.</div>
            <!--IF:cond_(![[=server_id=]])-->
            <div>
              <center><a href="?page=fmg_giai_phu&do=xn_dang_ky" class="btn btn-danger btn-lg">ĐĂNG KÝ NGAY</a></center><br>
              
            </div>
            <!--ELSE-->
            
            <!--/IF:cond_-->
            <!--/IF:cond-->
          </div>  <br> 
        </div>    
      </div>
    </form>  
	</div>
</div>
<script>
jQuery(document).ready(function() {
	
});
</script>