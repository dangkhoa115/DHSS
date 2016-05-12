<div class="column right">
  <div class="thong-tin-nguoi-choi">
  	<div class="title"><h2>Thông tin tài khoản</h2></div>
    <ul>
          <li>
              <a href="tong-hop.html"><strong><?php echo Session::get('user_id');?></strong></a>
          </li>
          <li>
              Tài khoản có: <span class="igold"><span id="igold"><?php echo $this->map['igold'];?></span> <img src="skins/ssnh/images/igold_16_text.png" width="53" height="16" alt=""/></span>
              <div class="note"><a target="_blank" href="nap_igold.html" class="nap-igold" title="Nạp iGold">Nạp iGold</a></div>
          </li>
          <li>
              Tổng số điểm: <strong><?php echo $this->map['diem'];?></strong>
          </li>
          <li>
             Xếp hạng: <strong><?php echo $this->map['vi_tri_hien_tai'];?></strong>
          </li>
          <li>
             <ul>
             	 <li><a href="ssnh_shop.html" class="link-to-shop">SHOP</a></li>
               <li><a href="?page=igold_log">Lịch sử giao dịch iGold</a></li>
               <li><a href="tham-gia-binh-chon/do/bc.html">Bình chọn</a></li>
               <li><a href="tham-gia-binh-chon.html">Bình chọn của bạn</a></li>
               <li><a href="binh-chon.html">Danh sách bình chọn</a></li>
               <li><a href="top-binh-chon.html">TOP của vòng đấu</a></li>
                <li><a href="tham-gia-binh-chon/do/ban_thang.html">Tổng bàn thắng VĐ</a></li>
               <li><a href="dang-tin.html">Viết tin bài</a></li>
               <li><a href="danh-sach-bai-viet.html">Bài viết đã đăng</a></li>
             </ul>
          </li>
    </ul>
    <div class="ssnh-guide">
    	<div class="title"><h3><a href="tin-tuc/game-show/huong-dan-game-show-sieu-sao-giai-ngoai-hang.html" target="_blank">Hướng dẫn tham bình chọn</a></h3></div>
    	<iframe width="100%" height="215" src="https://www.youtube.com/embed/wFWM0aibSzU" frameborder="0" allowfullscreen></iframe>
    </div>
  </div>
</div>