<nav class="tab">
  <ul>
     <?php
					if(isset($this->map['mua_giais']) and is_array($this->map['mua_giais']))
					{
						foreach($this->map['mua_giais'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['mua_giais']['current'] = &$item1;?>
    <li><a<?php echo (Session::get('mua_giai_id')==$this->map['mua_giais']['current']['id'])?' class="active"':''?> href="cau-thu/<?php echo $this->map['name_id'];?>-id<?php echo $this->map['id'];?>.html?mua_giai_id=<?php echo $this->map['mua_giais']['current']['id'];?>"><?php echo $this->map['mua_giais']['current']['ten'];?></a></li>
    
							
						<?php
							}
						}
					unset($this->map['mua_giais']['current']);
					} ?>
  </ul>
</nav>
<div class="title-all"><h1>Thông tin cầu thủ <?php echo $this->map['ten'];?></h1></div>
<div class="row detail-player">
    <script>
        $(document).ready(function() {
					<?php if(Url::get('quick_view')==1){?>
					jQuery('.footer').hide();
					jQuery('.col-right').hide();
					jQuery('.navbar').hide();
					jQuery('.banner').hide();
					<?php }?>
					
               tab();
            });
            function tab() {
               // jQuery('.tab_content.clearfix').hide();
                //jQuery('.tab_content.clearfix:first').show();
                //jQuery('.tab_nav li a:first').addClass('active');
                jQuery('.tab_nav li a').click(function(){
                   var  id_content = jQuery(this).attr("href"); 
                   jQuery('.tab_content').hide();
                   jQuery(id_content).fadeIn();
                   jQuery('.tab_nav.clearfix li a').removeClass('active');
                   jQuery(this).addClass('active');
                   return false;
                });
            
            }
    </script>
    <div class="col-md-12">
    	<ul class="tab_nav clearfix">
        <li><a href ="#tab_1" class="active">Thông tin tổng hợp</a></li>
        <li><a href ="#tab_2">Lịch sử thi đấu</a></li>
        <li><a href ="#tab_3">Lịch thi đấu</a></li>
      </ul>
      <div class="clear"></div>
      <div id="tab_1" class="tab_content active">
				<div class="col-md-4 cau-thu">
          <div class="name-player"><?php echo $this->map['ten'];?></div>
          <div class="img"><img src="https://sieusaongoaihang.vn/<?php echo $this->map['anh_dai_dien'];?>" width="200"/></div>
          <div class="logo-clb2">
              <a href="clb/<?php echo $this->map['clb_name_id'];?>.html" target="_blank"><img src="https://sieusaongoaihang.vn/<?php echo $this->map['logo'];?>"/>
              <?php echo $this->map['clb'];?></a>	
          </div>
          <div class="table">
              <table cellspacing="0" cellpadding="0">
                  <tr class="accent2">
                      <td>Vị trí</td><td><?php echo $this->map['vi_tri'];?></td>
                  </tr>
                  <tr>
                      <td>Tổng điểm</td><td><?php echo $this->map['diem'];?></td>
                  </tr>
              </table>
          </div>
      </div>
      <div class="col-md-4">
       <div class="table">
          <p><?php echo $this->map['vong_dau_gan_nhat'];?></p>
          <table cellspacing="0" cellpadding="0">
              <tr class="accent2">
                  <th width="70%">Thông số</th><th>Kết quả</th>
              </tr>
              <?php
					if(isset($this->map['lich_su_cau_thus']) and is_array($this->map['lich_su_cau_thus']))
					{
						foreach($this->map['lich_su_cau_thus'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['lich_su_cau_thus']['current'] = &$item2;?>
              <?php 
				if(($this->map['lich_su_cau_thus']['current']['so_phut_thi_dau']))
				{?>
              <tr>
                  <td>Phút thi đấu</td>
                  <td><?php echo $this->map['lich_su_cau_thus']['current']['so_phut_thi_dau'];?>'</td>
              </tr>
              
				<?php
				}
				?>
              <?php 
				if(($this->map['lich_su_cau_thus']['current']['so_the_vang']))
				{?>
              <tr>
                  <td>Thẻ vàng</td><td><?php echo $this->map['lich_su_cau_thus']['current']['so_the_vang'];?></td>
              </tr>
              
				<?php
				}
				?>
              <?php 
				if(($this->map['lich_su_cau_thus']['current']['so_the_do']))
				{?>
              <tr>
                  <td>Thẻ đỏ</td><td><?php echo $this->map['lich_su_cau_thus']['current']['so_the_do'];?></td>
              </tr>
              
				<?php
				}
				?>
              <?php 
				if(($this->map['lich_su_cau_thus']['current']['so_kien_tao']))
				{?>
              <tr>
                  <td>Kiến tạo</td><td><?php echo $this->map['lich_su_cau_thus']['current']['so_kien_tao'];?></td>
              </tr>
              
				<?php
				}
				?>
              <?php 
				if(($this->map['lich_su_cau_thus']['current']['so_ghi_ban']))
				{?>
              <tr>
                  <td>Ghi bàn</td><td><?php echo $this->map['lich_su_cau_thus']['current']['so_ghi_ban'];?></td>
              </tr>
              
				<?php
				}
				?>
              <?php 
				if(($this->map['lich_su_cau_thus']['current']['so_giu_sach_luoi']))
				{?>                            
				<?php
				}
				?>
              <?php 
				if(($this->map['lich_su_cau_thus']['current']['so_thung_luoi']))
				{?>
              <tr>
                  <td>Số thủng lưới</td><td><?php echo $this->map['lich_su_cau_thus']['current']['so_thung_luoi'];?></td>
              </tr>
              
				<?php
				}
				?>
              <?php 
				if(($this->map['lich_su_cau_thus']['current']['so_ban_thua']))
				{?>
              <tr>
                  <td>Bàn thua</td><td><?php echo $this->map['lich_su_cau_thus']['current']['so_ban_thua'];?></td>
              </tr>
              
				<?php
				}
				?>
              <?php 
				if(($this->map['lich_su_cau_thus']['current']['so_can_pha']))
				{?>
              <tr>
                  <td>Cản phá</td><td><?php echo $this->map['lich_su_cau_thus']['current']['so_can_pha'];?></td>
              </tr>
              
				<?php
				}
				?>
              <?php 
				if(($this->map['lich_su_cau_thus']['current']['so_can_penalty']))
				{?>
              <tr>
                  <td>Cản penalty</td><td><?php echo $this->map['lich_su_cau_thus']['current']['so_can_penalty'];?></td>
              </tr>
              
				<?php
				}
				?>
              <?php 
				if(($this->map['lich_su_cau_thus']['current']['so_truot_penalty']))
				{?>
              <tr>
                  <td>Trượt penalty</td><td><?php echo $this->map['lich_su_cau_thus']['current']['so_truot_penalty'];?></td>
              </tr>
              
				<?php
				}
				?>
              <?php 
				if(($this->map['lich_su_cau_thus']['current']['so_phan_luoi_nha']))
				{?>
              <tr>
                  <td>Phản lưới nhà</td><td><?php echo $this->map['lich_su_cau_thus']['current']['so_phan_luoi_nha'];?></td>
              </tr>
              
				<?php
				}
				?>
              <tr>
                  <td>Tổng điểm</td><td><strong><?php echo $this->map['lich_su_cau_thus']['current']['diem'];?></strong></td>
              </tr>
              
							
						<?php
							}
						}
					unset($this->map['lich_su_cau_thus']['current']);
					} ?>
          </table>
        </div>
      </div> 
       <div class="col-md-4">
            <div class="table">
                <p>Trận trong tuần</p>
                <table cellspacing="0" cellpadding="0">
                    <tr class="accent2">
                        <th>Stt</th><th>Trận</th><th>Thời gian</th>
                    </tr>
                    <?php
					if(isset($this->map['tran_dau_da_quas']) and is_array($this->map['tran_dau_da_quas']))
					{
						foreach($this->map['tran_dau_da_quas'] as $key3=>&$item3)
						{
							if($key3!='current')
							{
								$this->map['tran_dau_da_quas']['current'] = &$item3;?>
                    <tr>
                        <td>1</td><td><?php echo $this->map['tran_dau_da_quas']['current']['ten'];?></td><td><?php echo $this->map['tran_dau_da_quas']['current']['thoi_gian_ngay'];?> <?php echo $this->map['tran_dau_da_quas']['current']['thoi_gian_gio'];?></td>
                    </tr>
                    
							
						<?php
							}
						}
					unset($this->map['tran_dau_da_quas']['current']);
					} ?>
                </table>
            </div>
            <div class="table">
                <p>Trận sắp tới</p>
                <table cellspacing="0" cellpadding="0">
                    <tr class="accent2">
                        <th>Stt</th><th>Trận</th><th>Thời gian</th>
                    </tr>
      <?php $i=1;?>
                    <?php
					if(isset($this->map['tran_dau_sap_tois']) and is_array($this->map['tran_dau_sap_tois']))
					{
						foreach($this->map['tran_dau_sap_tois'] as $key4=>&$item4)
						{
							if($key4!='current')
							{
								$this->map['tran_dau_sap_tois']['current'] = &$item4;?>
                    <tr>
                        <td><?php echo $i++;?></td><td><?php echo $this->map['tran_dau_sap_tois']['current']['ten'];?></td><td><?php echo $this->map['tran_dau_sap_tois']['current']['thoi_gian_ngay'];?> <?php echo $this->map['tran_dau_sap_tois']['current']['thoi_gian_gio'];?></td>
                    </tr>
                    
							
						<?php
							}
						}
					unset($this->map['tran_dau_sap_tois']['current']);
					} ?>
                </table>
            </div>
        </div> 
        
      </div><!--End #tab_1-->
      <div id="tab_2" class="tab_content">
          <div class="title">Bảng điểm</div>
          <div class="table">
              <table cellspacing="0" cellpadding="0">
                  <tr class="accent2">
                      <th title="Ngày">NTN</th>
                      <th title="Đối thủ">ĐT</th>
                      <th title="Số phút thi đấu">SP</th>
                      <th title="Thẻ vàng">TV</th>
                      <th title="Thẻ đỏ">TĐ</th>
                      <th title="Kiến tạo">KT</th>
                      <th title="Ghi bàn">GB</th>
                      <th title="Bàn thua">BTH</th>
                      <th title="Cản phá">CP</th>
                      <th title="Cản Penalty">CPL</th>
                      <th title="Trượt Penalty">TPL</th>
                      <th title="Phản lưới nhà">PLN</th>
                      <th title="Tổng điểm">Đ</th>
                  </tr>
                  <?php 
                    $tong_diem = 0;
                  ?>
                  <?php
					if(isset($this->map['lich_su_thi_daus']) and is_array($this->map['lich_su_thi_daus']))
					{
						foreach($this->map['lich_su_thi_daus'] as $key5=>&$item5)
						{
							if($key5!='current')
							{
								$this->map['lich_su_thi_daus']['current'] = &$item5;?>
                  <tr class="accent2">
                      <td><?php echo $this->map['lich_su_thi_daus']['current']['thoi_gian_ngay'];?></td>
                      <td title="<?php echo $this->map['lich_su_thi_daus']['current']['doi_thu'];?>"><?php echo $this->map['lich_su_thi_daus']['current']['doi_thu_vt'];?></td>
                      <td><?php echo $this->map['lich_su_thi_daus']['current']['so_phut_thi_dau'];?></td>
                      <td><?php echo $this->map['lich_su_thi_daus']['current']['so_the_vang'];?></td>
                      <td><?php echo $this->map['lich_su_thi_daus']['current']['so_the_do'];?></td>
                      <td><?php echo $this->map['lich_su_thi_daus']['current']['so_kien_tao'];?></td>
                      <td><?php echo $this->map['lich_su_thi_daus']['current']['so_ghi_ban'];?></td>
                      <td><?php echo $this->map['lich_su_thi_daus']['current']['so_ban_thua'];?></td>
                      <td><?php echo $this->map['lich_su_thi_daus']['current']['so_can_pha'];?></td>
                      <td><?php echo $this->map['lich_su_thi_daus']['current']['so_can_penalty'];?></td>
                      <td><?php echo $this->map['lich_su_thi_daus']['current']['so_truot_penalty'];?></td>
                      <td><?php echo $this->map['lich_su_thi_daus']['current']['so_phan_luoi_nha'];?></td>
                      <td><span style="color: red;"><?php $tong_diem += $this->map['lich_su_thi_daus']['current']['diem'];?><?php echo $this->map['lich_su_thi_daus']['current']['diem'];?></span></td>
                  </tr>
                  
							
						<?php
							}
						}
					unset($this->map['lich_su_thi_daus']['current']);
					} ?>
                  <tr class="accent2">
                      <td colspan="12" style="text-align:right !important">Tổng điểm: </td>
                      <td><span style="color: red;font-weight:bold;"><?php echo $tong_diem;?></span></td>
                  </tr>
              </table>
          </div>
      </div><!--End #tab_2-->
      <div id="tab_3" class="tab_content">
          <!--<div class="title">Bảng kết quả</div> -->
          <div class="table">
              <table width="100%" cellspacing="0" cellpadding="0">
                <tbody><tr class="accent2">
                    <th>Ngày giờ</th>
                    <th>Đội chủ nhà</th>                  
                    <th>Đội khách</th>
                    <th>Kết quả</th>
                </tr>
                <?php
					if(isset($this->map['tran_daus']) and is_array($this->map['tran_daus']))
					{
						foreach($this->map['tran_daus'] as $key6=>&$item6)
						{
							if($key6!='current')
							{
								$this->map['tran_daus']['current'] = &$item6;?>
                <tr>
                    <td align="center"><?php echo $this->map['tran_daus']['current']['thoi_gian_ngay'];?> <?php echo $this->map['tran_daus']['current']['thoi_gian_gio'];?>'</td>
                    <td align="center" <?php echo ($this->map['clb']==$this->map['tran_daus']['current']['doi_chu_nha'])?'style="font-weight:bold;color:#F00;"':'';?>><?php echo $this->map['tran_daus']['current']['doi_chu_nha'];?></td>
                    <td align="center" <?php echo ($this->map['clb']==$this->map['tran_daus']['current']['doi_khach'])?'style="font-weight:bold;color:#F00;"':'';?>><?php echo $this->map['tran_daus']['current']['doi_khach'];?></td>
                    <td align="center"><?php echo $this->map['tran_daus']['current']['ket_qua'];?></td>
                </tr>
                
							
						<?php
							}
						}
					unset($this->map['tran_daus']['current']);
					} ?>
            </tbody></table>
          </div>
      </div>
    </div>
</div><br clear="all">