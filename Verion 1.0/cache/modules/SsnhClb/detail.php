<!--[if lt IE 9]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
<![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="skins/ssnh/scripts/readmore.js"></script>
<script>
jQuery(document).ready(function(){
	jQuery('.mo-ta').readmore({
		moreLink: '<a href="#" class="expand">Xem thêm</a>',
		lessLink: '<a href="#" class="collapse">Thu gọn</a>',
		maxHeight: 250,
		afterToggle: function(trigger, element, expanded) {
			if(! expanded) { // The "Close" link was clicked
				jQuery('html, body').animate( { scrollTop: element.offset().top }, {duration: 100 } );
			}
		}
	});
	//jQuery('p').readmore({maxHeight: 140});
});
</script>
<div class="title-all col-md-12 clb">
  <h1><?php echo $this->map['ten'];?></h1>
  <div class="row detail-clb">
    <div id="tab_2" class="tab_content active">
      <div class="col-md-3 clb-logo"><img src="<?php echo $this->map['logo'];?>" alt="<?php echo $this->map['ten'];?>" /><a class="clb-player-list" href="cau-thu?clb_id=<?php echo $this->map['id'];?>" target="_blank">Đội hình</a></div>
      <div class="col-md-9">
        <div class="like-button">
          <div id="fb-root"></div>
          <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));</script>
          <div class="fb-like" data-href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].''. $_SERVER['REQUEST_URI'];?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
        </div>
        <div class="mo-ta"><?php echo $this->map['mo_ta'];?></div>
      </div>
      <div class="col-md-12 table">
        <div class="title title2">Thông tin vòng đấu</div>
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
						foreach($this->map['tran_daus'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['tran_daus']['current'] = &$item1;?>
              <tr>
                  <td><?php echo $this->map['tran_daus']['current']['thoi_gian_ngay'];?> <?php echo $this->map['tran_daus']['current']['thoi_gian_gio'];?>'</td>
                  <td><?php echo $this->map['tran_daus']['current']['doi_chu_nha'];?></td>
                  <td><?php echo $this->map['tran_daus']['current']['doi_khach'];?></td>
                  <td><?php echo $this->map['tran_daus']['current']['ket_qua'];?></td>
              </tr>
              
							
						<?php
							}
						}
					unset($this->map['tran_daus']['current']);
					} ?>
          </tbody></table>
      </div>
		</div>
  </div><!--End .detail-clb-->
  <div class="title">
  		<h2><img src="skins/ssnh/images/sb_lt_logo.png" alt="Barclays Premier League" class="barclay-icon">Đội hình CLB <?php echo $this->map['ten'];?></h2>
  		<div class="group-input select">
     	<form name="SsnhCauThuXuatSacNhatForm" method="post">
      <select  name="vong_dau_id" id="vong_dau_id" onchange="SsnhCauThuXuatSacNhatForm.submit()" class="form-control"><?php
					if(isset($this->map['vong_dau_id_list']))
					{
						foreach($this->map['vong_dau_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('vong_dau_id').value = "<?php echo addslashes(URL::get('vong_dau_id',isset($this->map['vong_dau_id'])?$this->map['vong_dau_id']:''));?>";</script>
	</select>
      <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
      </div>
  </div>
  <br clear="all">
  <div class="dh-mockup">
  		<ul class="row">
      	<?php
					if(isset($this->map['thu_mons']) and is_array($this->map['thu_mons']))
					{
						foreach($this->map['thu_mons'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['thu_mons']['current'] = &$item2;?>
          <li>
              <div class="m-player-o">
                  <div class="img"><a href="cau-thu/<?php echo $this->map['thu_mons']['current']['name_id'];?>-id<?php echo $this->map['thu_mons']['current']['id'];?>.html"><img src="<?php echo $this->map['thu_mons']['current']['anh_dai_dien'];?>"/></a></div>
                  <span class="nub"><?php echo $this->map['thu_mons']['current']['so_ao'];?></span>
                  <?php 
				if(($this->map['thu_mons']['current']['cao_nhat_doi']))
				{?>
                  <span class="star"></span>
                  
				<?php
				}
				?>
                  <p class="text">
                      <span class="name"><?php echo $this->map['thu_mons']['current']['ten'];?></span>
                      <span class="total"><?php echo $this->map['thu_mons']['current']['diem'];?></span>
                  </p>
              </div><!--End .m-player-->
          </li>
         
							
						<?php
							}
						}
					unset($this->map['thu_mons']['current']);
					} ?>
      </ul>
      <ul class="row">
          <?php
					if(isset($this->map['hau_ves']) and is_array($this->map['hau_ves']))
					{
						foreach($this->map['hau_ves'] as $key3=>&$item3)
						{
							if($key3!='current')
							{
								$this->map['hau_ves']['current'] = &$item3;?>
          <li>
              <div class="m-player-o">
                  <div class="img"><a href="cau-thu/<?php echo $this->map['hau_ves']['current']['name_id'];?>-id<?php echo $this->map['hau_ves']['current']['id'];?>.html"><img src="<?php echo $this->map['hau_ves']['current']['anh_dai_dien'];?>"/></a></div>
                  <span class="nub"><?php echo $this->map['hau_ves']['current']['so_ao'];?></span>
                  <?php 
				if(($this->map['hau_ves']['current']['cao_nhat_doi']))
				{?>
                  <span class="star"></span>
                  
				<?php
				}
				?>
                  <p class="text">
                      <span class="name"><?php echo $this->map['hau_ves']['current']['ten'];?></span>
                      <span class="total"><?php echo $this->map['hau_ves']['current']['diem'];?></span>
                  </p>
              </div><!--End .m-player-->
          </li>
         
							
						<?php
							}
						}
					unset($this->map['hau_ves']['current']);
					} ?>
      </ul>
       <ul class="row">
         <?php
					if(isset($this->map['tien_ves']) and is_array($this->map['tien_ves']))
					{
						foreach($this->map['tien_ves'] as $key4=>&$item4)
						{
							if($key4!='current')
							{
								$this->map['tien_ves']['current'] = &$item4;?>
          <li>
              <div class="m-player-o">
                  <div class="img"><a href="cau-thu/<?php echo $this->map['tien_ves']['current']['name_id'];?>-id<?php echo $this->map['tien_ves']['current']['id'];?>.html"><img src="<?php echo $this->map['tien_ves']['current']['anh_dai_dien'];?>"/></a></div>
                  <span class="nub"><?php echo $this->map['tien_ves']['current']['so_ao'];?></span>
                  <?php 
				if(($this->map['tien_ves']['current']['cao_nhat_doi']))
				{?>
                  <span class="star"></span>
                  
				<?php
				}
				?>
                  <p class="text">
                      <span class="name"><?php echo $this->map['tien_ves']['current']['ten'];?></span>
                      <span class="total"><?php echo $this->map['tien_ves']['current']['diem'];?></span>
                  </p>
              </div><!--End .m-player-->
          </li>
         
							
						<?php
							}
						}
					unset($this->map['tien_ves']['current']);
					} ?>
      </ul>
      <ul class="row">
          <?php
					if(isset($this->map['tien_daos']) and is_array($this->map['tien_daos']))
					{
						foreach($this->map['tien_daos'] as $key5=>&$item5)
						{
							if($key5!='current')
							{
								$this->map['tien_daos']['current'] = &$item5;?>
          <li>
              <div class="m-player-o">
                  <div class="img"><a href="cau-thu/<?php echo $this->map['tien_daos']['current']['name_id'];?>-id<?php echo $this->map['tien_daos']['current']['id'];?>.html"><img src="<?php echo $this->map['tien_daos']['current']['anh_dai_dien'];?>"/></a></div>
                  <span class="nub"><?php echo $this->map['tien_daos']['current']['so_ao'];?></span>
                  <?php 
				if(($this->map['tien_daos']['current']['cao_nhat_doi']))
				{?>
                  <span class="star"></span>
                  
				<?php
				}
				?>
                  <p class="text">
                      <span class="name"><?php echo $this->map['tien_daos']['current']['ten'];?></span>
                      <span class="total"><?php echo $this->map['tien_daos']['current']['diem'];?></span>
                  </p>
              </div><!--End .m-player-->
          </li>
         
							
						<?php
							}
						}
					unset($this->map['tien_daos']['current']);
					} ?>
      </ul>
  </div><!--End .dh-mockup-->
</div>