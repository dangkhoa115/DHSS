<div id="FmMyTeam">
<div class="title-all col-xs-12">
  <div class="row">
    <div class="col-xs-8 clb">
    	<div class="row">
        <div class="col-md-12">
          <div class="title">
            <div class="logo-clb"><img src="<?php echo $this->map['my_team_logo'];?>" alt="<?php echo $this->map['my_team'];?>" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></div>
            <h2 class="ten-clb">Đội hình <?php echo $this->map['my_team'];?></h2>
            <div class="server-name"><?php echo $this->map['server'];?>&nbsp;</div>
            <?php 
				if(($this->map['vong_dau_tiep_theo_id'] and FMGAME::can_transfer()))
				{?>
            <div style="color:#24FF6D;">Vòng đấu NHA tiếp theo: <?php echo $this->map['vong_dau_tiep_theo'];?> / Bạn có thể chuyển nhượng ngay bây giờ cho <strong><?php echo $this->map['vong_dau_tiep_theo'];?></strong></div>
            
				<?php
				}
				?>
          </div>
        </div>
      </div><br>
      <div class="row">  
        <div class="col-md-12">
        	<div class="tab">
            <ul>
              <li><a href="dhss?do=edit_team&act=transfer" <?php echo (!Url::get('vong_dau_id'))?' class="active"':''?>>Thực hiện chuyển nhượng</a></li>
              <?php 
				if(($this->map['vong_dau_tiep_theo_id']))
				{?>
              <li><a href="dhss?do=edit_team&act=transfer&vong_dau_id=<?php echo $this->map['vong_dau_tiep_theo_id'];?>" <?php echo (Url::get('vong_dau_id'))?' class="active"':''?>>Lịch sử chuyển nhượng</a></li>
              
				<?php
				}
				?>
              <li><?php 
				if((Url::get('do')=='edit_team'))
				{?>
        <a href="?page=fmg_team&do=cancel_edit" type="button" class="btn btn-default btn-lg">Hủy chuyển nhượng <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a>
        
				<?php
				}
				?></li>
            </ul>
          </div>
          <div class="tooltip-content" id="igold-tt" style="display:none;">
            <h3>Đội hình không được nhiều hơn 100 iGold</h3>
            <p>
              Bạn hãy tính toán số iGold hợp lý để có được được hình mạnh nhất nhé.
            </p>
          </div>
        </div>
      </div>
      <br clear="all">
      <div><?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?></div>
      <div class="dh-mockup" <?php echo Url::iget('vong_dau_id')?'style="background:rgba(69,69,69,0.80);"':'';?>>   
      		<?php 
				if((!empty($this->map['deleteds'])))
				{?>
      		<div class="cau-thu-vua-ban">
          	<h3>Vừa bán</h3>
          	<ul>
            	<?php
					if(isset($this->map['deleteds']) and is_array($this->map['deleteds']))
					{
						foreach($this->map['deleteds'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['deleteds']['current'] = &$item1;?>
            	<li><a href="#" onClick="undoPlayer(<?php echo $this->map['deleteds']['current']['cau_thu_id'];?>);return false;" title="Lấy lại"><img src="<?php echo $this->map['deleteds']['current']['anh_dai_dien'];?>"><br><img src="skins/ssnh/images/fm_game/undo.png" alt="undo" style="width:16px;"> <?php echo $this->map['deleteds']['current']['ten'];?></a></li>
            	
							
						<?php
							}
						}
					unset($this->map['deleteds']['current']);
					} ?>             
            </ul>
          </div>
          
				<?php
				}
				?>
      		<?php 
				if((!Url::iget('vong_dau_id')))
				{?>	
      		<div class="igold" data-tooltip="#igold-tt">Trị giá:<br><?php echo $this->map['gia_tri_doi_hinh'];?> igold  <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></div>       
      		<div class="tong-diem" data-tooltip="#tong-diem"><?php echo $this->map['tong_diem'];?><br><span>Power</span></div>
          <div class="tooltip-content" id="tong-diem" style="display:none;">
            <h3>Power (Sức mạnh)</h3>
            <p>
              Là tổng số điểm của các cầu thủ đạt được trong mỗi vòng đấu của giải Ngoại Hạng Anh.
            </p>
          </div>
          
				<?php
				}
				?>	
          <?php if(Url::iget('vong_dau_id')){?>
          <table width="80%" border="1" bordercolor="#999" cellspacing="0" cellpadding="5" align="center" class="table table-bordeded small">
            <tbody>
              <tr>
                <th colspan="2" rowspan="2">Cầu thủ</th>
                <th colspan="2" style="text-align:center !important">Chuyển nhượng</th>
                <th rowspan="2">Giá</th>
                <th rowspan="2">Vòng</th>
              </tr>
              <tr>
                <th style="text-align:center !important">Mua</th>
                <th style="text-align:center !important">Bán</th>
              </tr>
              <?php
					if(isset($this->map['transfer_cau_thus']) and is_array($this->map['transfer_cau_thus']))
					{
						foreach($this->map['transfer_cau_thus'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['transfer_cau_thus']['current'] = &$item2;?>
              <tr>
                <td class="img"><a class="zoom_img"><img src="<?php echo $this->map['transfer_cau_thus']['current']['anh_dai_dien'];?>" id="anh_<?php echo $this->map['transfer_cau_thus']['current']['id'];?>" alt="" width="50"/></a></td>
                <td><?php echo $this->map['transfer_cau_thus']['current']['vi_tri'];?> <?php echo $this->map['transfer_cau_thus']['current']['ten'];?></td>
                <td align="center"><?php echo !$this->map['transfer_cau_thus']['current']['sell']?'Lúc '.$this->map['transfer_cau_thus']['current']['time']:''?></td>
                <td align="center"><?php echo $this->map['transfer_cau_thus']['current']['sell']?'Lúc '.$this->map['transfer_cau_thus']['current']['time']:''?></td>
                <td><?php echo $this->map['transfer_cau_thus']['current']['cost'];?> <img src="skins/ssnh/images/igold_16.png" alt=""></td>
                <td><?php echo $this->map['transfer_cau_thus']['current']['vong_dau'];?></td>
              </tr>
              
							
						<?php
							}
						}
					unset($this->map['transfer_cau_thus']['current']);
					} ?>
            </tbody>
          </table>
          <?php }else{?>
					<ul class="row">
          	<?php 
				if((empty($this->map['thu_mons'])))
				{?>
            <li>
              <div class="m-player-o">N/A</div>
            </li>
             <?php }else{ ?>
            <?php
					if(isset($this->map['thu_mons']) and is_array($this->map['thu_mons']))
					{
						foreach($this->map['thu_mons'] as $key3=>&$item3)
						{
							if($key3!='current')
							{
								$this->map['thu_mons']['current'] = &$item3;?>
            <li class="player-tm">
                <div class="m-player-o" style=" <?php echo $this->map['thu_mons']['current']['tmp']?'border:2px solid #f00;border-radius:5px;':'';?>">
                    <div class="img"><a class="zoom_img" href="#" onClick="window.open('cau-thu-dhss/<?php echo $this->map['thu_mons']['current']['name_id'];?>-id<?php echo $this->map['thu_mons']['current']['cau_thu_id'];?>.html?quick_view=1','','width=610px,height=700px');return false;"><img src="<?php echo $this->map['thu_mons']['current']['anh_dai_dien'];?>" id="anh_<?php echo $this->map['thu_mons']['current']['id'];?>" alt=""/></a></div>
                    <span class="nub"><?php echo $this->map['thu_mons']['current']['so_ao'];?></span>
                    <p class="text">
                        <span class="name"><?php echo $this->map['thu_mons']['current']['ten'];?></span>
                        <span class="total"><?php echo $this->map['thu_mons']['current']['diem'];?></span>
                        <?php 
				if(($this->map['owner']))
				{?>
                        <span class="cost" title="Giá <?php echo $this->map['thu_mons']['current']['cost'];?> iGold"><?php echo $this->map['thu_mons']['current']['cost'];?><img src="skins/ssnh/images/igold_16.png" alt=""></span>
                        <?php 
				if((!$this->map['thu_mons']['current']['bought']))
				{?>
                          <span class="del"><a href="#" onClick="delPlayer(<?php echo $this->map['thu_mons']['current']['cau_thu_id'];?>,<?php echo (isset($this->map['thu_mons']['current']['tmp']) and $this->map['thu_mons']['current']['tmp'])?1:0;?>);return false;" title="Bán cầu thủ này bạn sẽ thu về 75% giá trị iGold so với khi mua.">BÁN</a></span>
                           <?php }else{ ?>
                          <span class="del"><a href="#" onClick="return false;" style="width: 55px;font-size:11px;color:#000;left:-29px;">ĐÃ BÁN</a></span>
                          
				<?php
				}
				?>
                        
				<?php
				}
				?>
                        <?php 
				if(($this->map['thu_mons']['current']['off']))
				{?>
                        <a class="off" href="#" onClick="return false" title="Nghỉ trận sau"><img src="skins/ssnh/images/fm_game/off.png" alt="Nghỉ trận sau"></a>
                        
				<?php
				}
				?>
                        <?php 
				if((isset($this->map['thu_mons']['current']['du_bi']) and $this->map['thu_mons']['current']['du_bi']))
				{?>
                          <a class="du-bi" href="#" onClick="return false" title="Dự bị"><img src="skins/ssnh/images/fm_game/du_bi.png" alt="Dự bị"></a>
                          
				<?php
				}
				?>
                    </p>
                </div><!--End .m-player-->
            </li>
           
							
						<?php
							}
						}
					unset($this->map['thu_mons']['current']);
					} ?>
           
				<?php
				}
				?>
          </ul>
          <ul class="row">
              <?php
					if(isset($this->map['hau_ves']) and is_array($this->map['hau_ves']))
					{
						foreach($this->map['hau_ves'] as $key4=>&$item4)
						{
							if($key4!='current')
							{
								$this->map['hau_ves']['current'] = &$item4;?>
              <li class="player-hv">
                  <div class="m-player-o" style=" <?php echo $this->map['hau_ves']['current']['tmp']?'border:2px solid #f00;border-radius:5px;':'';?>">
                      <div class="img"><a class="zoom_img" href="#" onClick="window.open('cau-thu-dhss/<?php echo $this->map['hau_ves']['current']['name_id'];?>-id<?php echo $this->map['hau_ves']['current']['cau_thu_id'];?>.html?quick_view=1','','width=610px,height=700px');return false;"><img src="<?php echo $this->map['hau_ves']['current']['anh_dai_dien'];?>" id="anh_<?php echo $this->map['hau_ves']['current']['id'];?>" alt=""/></a></div>
                      <span class="nub"><?php echo $this->map['hau_ves']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['hau_ves']['current']['ten'];?></span>
                          <span class="total"><?php echo $this->map['hau_ves']['current']['diem'];?></span>
                          <?php 
				if(($this->map['owner']))
				{?>
                          <span class="cost" title="Giá <?php echo $this->map['hau_ves']['current']['cost'];?> iGold"><img src="skins/ssnh/images/igold_16.png" alt=""></span>
                          <?php 
				if((!$this->map['hau_ves']['current']['bought']))
				{?>
                          <span class="del"><a href="#" onClick="delPlayer(<?php echo $this->map['hau_ves']['current']['cau_thu_id'];?>,<?php echo (isset($this->map['hau_ves']['current']['tmp']) and $this->map['hau_ves']['current']['tmp'])?1:0;?>);return false;" title="Bán cầu thủ này bạn sẽ thu về 75% giá trị iGold so với khi mua.">BÁN</a></span>
                           <?php }else{ ?>
                          <span class="del"><a href="#" onClick="return false;" style="width: 55px;font-size:11px;color:#000;left:-29px;">ĐÃ BÁN</a></span>
                          
				<?php
				}
				?>
                          
				<?php
				}
				?>
                          <?php 
				if(($this->map['hau_ves']['current']['off']))
				{?>
                          <a class="off" href="#" onClick="return false" title="Nghỉ trận sau"><img src="skins/ssnh/images/fm_game/off.png" alt="Nghỉ trận sau"></a>
                          
				<?php
				}
				?>
                          <?php 
				if((isset($this->map['hau_ves']['current']['du_bi']) and $this->map['hau_ves']['current']['du_bi']))
				{?>
                          <a class="du-bi" href="#" onClick="return false" title="Dự bị"><img src="skins/ssnh/images/fm_game/du_bi.png" alt="Dự bị"></a>
                          
				<?php
				}
				?>
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
						foreach($this->map['tien_ves'] as $key5=>&$item5)
						{
							if($key5!='current')
							{
								$this->map['tien_ves']['current'] = &$item5;?>
              <li class="player-tv">
                  <div class="m-player-o" style=" <?php echo $this->map['tien_ves']['current']['tmp']?'border:2px solid #f00;border-radius:5px;':'';?>">
                      <div class="img"><a class="zoom_img" href="#" onClick="window.open('cau-thu-dhss/<?php echo $this->map['tien_ves']['current']['name_id'];?>-id<?php echo $this->map['tien_ves']['current']['cau_thu_id'];?>.html?quick_view=1','','width=610px,height=700px');return false;"><img src="<?php echo $this->map['tien_ves']['current']['anh_dai_dien'];?>" id="anh_<?php echo $this->map['tien_ves']['current']['id'];?>" alt=""/></a></div>
                      <span class="nub"><?php echo $this->map['tien_ves']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['tien_ves']['current']['ten'];?></span>
                          <span class="total"><?php echo $this->map['tien_ves']['current']['diem'];?></span>
                          <?php 
				if(($this->map['owner']))
				{?>
                          <span class="cost" title="Giá <?php echo $this->map['tien_ves']['current']['cost'];?> iGold"><?php echo $this->map['tien_ves']['current']['cost'];?><img src="skins/ssnh/images/igold_16.png" alt=""></span>
                          <?php 
				if((!$this->map['tien_ves']['current']['bought']))
				{?>
                          <span class="del"><a href="#" onClick="delPlayer(<?php echo $this->map['tien_ves']['current']['cau_thu_id'];?>,<?php echo (isset($this->map['tien_ves']['current']['tmp']) and $this->map['tien_ves']['current']['tmp'])?1:0;?>);return false;" title="Bán cầu thủ này bạn sẽ thu về 75% giá trị iGold so với khi mua.">BÁN</a></span>
                           <?php }else{ ?>
                          <span class="del"><a href="#" onClick="return false;" style="width: 55px;font-size:11px;color:#000;left:-29px;">ĐÃ BÁN</a></span>
                          
				<?php
				}
				?>
                          
				<?php
				}
				?>
                          <?php 
				if(($this->map['tien_ves']['current']['off']))
				{?>
                          <a class="off" href="#" onClick="return false" title="Nghỉ trận sau"><img src="skins/ssnh/images/fm_game/off.png" alt="Nghỉ trận sau"></a>
                          
				<?php
				}
				?>
                          <?php 
				if((isset($this->map['tien_ves']['current']['du_bi']) and $this->map['tien_ves']['current']['du_bi']))
				{?>
                          <a class="du-bi" href="#" onClick="return false" title="Dự bị"><img src="skins/ssnh/images/fm_game/du_bi.png" alt="Dự bị"></a>
                          
				<?php
				}
				?>
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
						foreach($this->map['tien_daos'] as $key6=>&$item6)
						{
							if($key6!='current')
							{
								$this->map['tien_daos']['current'] = &$item6;?>
              <li class="player-td">
                  <div class="m-player-o" style=" <?php echo $this->map['tien_daos']['current']['tmp']?'border:2px solid #f00;border-radius:5px;':'';?>">
                      <div class="img"><a class="zoom_img" href="#" onClick="window.open('cau-thu-dhss/<?php echo $this->map['tien_daos']['current']['name_id'];?>-id<?php echo $this->map['tien_daos']['current']['cau_thu_id'];?>.html?quick_view=1','','width=610px,height=700px');return false;"><img src="<?php echo $this->map['tien_daos']['current']['anh_dai_dien'];?>" id="anh_<?php echo $this->map['tien_daos']['current']['id'];?>" alt=""/></a></div>
                      <span class="nub"><?php echo $this->map['tien_daos']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['tien_daos']['current']['ten'];?></span>
                          <span class="total"><?php echo $this->map['tien_daos']['current']['diem'];?></span>
                          <?php 
				if(($this->map['owner']))
				{?>
                          <span class="cost" title="Giá <?php echo $this->map['tien_daos']['current']['cost'];?> iGold"><?php echo $this->map['tien_daos']['current']['cost'];?><img src="skins/ssnh/images/igold_16.png" alt=""></span>
                          <?php 
				if((!$this->map['tien_daos']['current']['bought']))
				{?>
                          <span class="del"><a href="#" onClick="delPlayer(<?php echo $this->map['tien_daos']['current']['cau_thu_id'];?>,<?php echo (isset($this->map['tien_daos']['current']['tmp']) and $this->map['tien_daos']['current']['tmp'])?1:0;?>);return false;" title="Bán cầu thủ này bạn sẽ thu về 75% giá trị iGold so với khi mua.">BÁN</a></span>
                           <?php }else{ ?>
                          <span class="del"><a href="#" onClick="return false;" style="width: 55px;font-size:11px;color:#000;left:-29px;">ĐÃ BÁN</a></span>
                          
				<?php
				}
				?>
                          
				<?php
				}
				?>
                          <?php 
				if(($this->map['tien_daos']['current']['off']))
				{?>
                          <a class="off" href="#" onClick="return false" title="Nghỉ trận sau"><img src="skins/ssnh/images/fm_game/off.png" alt="Nghỉ trận sau"></a>
                          
				<?php
				}
				?>
                          <?php 
				if((isset($this->map['tien_daos']['current']['du_bi']) and $this->map['tien_daos']['current']['du_bi']))
				{?>
                          <a class="du-bi" href="#" onClick="return false" title="Dự bị"><img src="skins/ssnh/images/fm_game/du_bi.png" alt="Dự bị"></a>
                          
				<?php
				}
				?>
                      </p>
                  </div><!--End .m-player-->
              </li>
             
							
						<?php
							}
						}
					unset($this->map['tien_daos']['current']);
					} ?>
          </ul>	
          <?php }?>
      </div><!--End .dh-mockup-->
      <center>
      	<form name="AddClbForm" id="AddClbForm" method="post">
      	<input  name="tong_cau_thu" type="hidden" id="tong_cau_thu" value="<?php echo $this->map['tong_cau_thu_doi_hinh'];?>">
        <?php 
				if((!Url::iget('vong_dau_id')))
				{?>
      	<input id="saveBtn" type="button" onClick="processSubmit();" data-loading-text="Loading..." class="btn btn-lg btn-primary" style="position:relative;" value=" Ghi lại "/>
        
				<?php
				}
				?>
        <?php 
				if((Url::get('do')=='edit_team'))
				{?>
        <a href="?page=fmg_team&do=cancel_edit" type="button" class="btn btn-default btn-lg">Hủy bỏ</a>
        
				<?php
				}
				?>        
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
      </center><br>
      <div class="list-da-mua col-md-12">
      	<h3>Cầu thủ đã mua <?php echo $this->map['vong_dau_tiep_theo'];?></h3>
      	<ul>
      	<?php
					if(isset($this->map['da_muas']) and is_array($this->map['da_muas']))
					{
						foreach($this->map['da_muas'] as $key7=>&$item7)
						{
							if($key7!='current')
							{
								$this->map['da_muas']['current'] = &$item7;?>
        <li>
        	<a class="zoom_img" href="#" onClick="window.open('cau-thu-dhss/<?php echo $this->map['da_muas']['current']['name_id'];?>-id<?php echo $this->map['da_muas']['current']['cau_thu_id'];?>.html?quick_view=1','','width=610px,height=700px');return false;"><img src="<?php echo $this->map['da_muas']['current']['anh_dai_dien'];?>" id="anh_<?php echo $this->map['da_muas']['current']['id'];?>" alt=""/></a>
          <span><?php echo $this->map['da_muas']['current']['vi_tri'];?> <?php echo $this->map['da_muas']['current']['ten'];?> <?php echo $this->map['da_muas']['current']['du_bi']?'<div class="du-bi">Dự bị</div>':'';?></span>
        </li>
      	
							
						<?php
							}
						}
					unset($this->map['da_muas']['current']);
					} ?>
        </ul>
      </div><br>
    </div>
    <div class="col-xs-4 bo-loc-cau-thu">
    	<?php 
				if(($this->map['can_transfer']==true))
				{?>
      <div class="alert transfer-status mo-cua">
        Thị trường chuyển nhượng mở cửa<br>
        <?php 
				if((FMGAME::my_team_id()==true))
				{?>
        Từ thứ 4 đến 20h thứ 7 hàng tuần
        
				<?php
				}
				?>
        <span id="transfer-status-icon" class="glyphicon glyphicon-question-sign" aria-hidden="true" data-tooltip="#chuyen-nhuong"></span>
      </div>
       <?php }else{ ?>
      <div class="alert transfer-status dong-cua">
      	Thị trường chuyển nhượng đã đóng!<br>
        (Bạn chuyển nhượng <?php echo $this->map['max_transfer_time'];?> cầu thủ hoặc thời gian chuyển nhượng đã hết!)
        <span id="transfer-status-icon" class="glyphicon glyphicon-question-sign" aria-hidden="true" data-tooltip="#chuyen-nhuong"></span>
      </div>
      
				<?php
				}
				?>
      <div class="alert">
        <div>Bạn được chuyển nhượng tối đa <?php echo $this->map['max_transfer_time'];?> cầu thủ / vòng đấu giải Ngoại Hạng Anh.</div>
        <div>&raquo; Có thể dùng <span class="highlight">Thẻ chuyển nhượng</span> để tăng lượt chuyển nhượng.</div>
        <div class="highlight">&raquo; Hiện có <?php echo $this->map['the_cn_total'];?> thẻ <img src="<?php echo $this->map['the_cn_img'];?>" alt="Thẻ chuyển nhượng" width="30"></div>
        <div> => Mua trong <a href="?page=fmg_shop">SHOP</a></div>
        <div>Bạn đã mua <?php echo $this->map['chuyen_nhuong_vong_dau'];?> cầu thủ <?php echo $this->map['vong_dau_tiep_theo'];?></strong></div>
        <div>Bạn còn <?php echo $this->map['max_transfer_time'] - $this->map['chuyen_nhuong_vong_dau'] + $this->map['the_cn_total']?> lượt</strong></div>
      </div>
      <div class="tooltip-content" id="chuyen-nhuong" style="display:none;">
        <h3>Thị trường chuyển nhượng</h3>
        <p>
          Thị trường chuyển nhượng mở cửa vào từ từ thứ 4 đến 20h ngày thứ 7 hàng tuần
        </p>
      </div>
      <div class="alert important">
      	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      	<h3>Điều kiện đội hình</h3>
      	<ul>
        	<li>Đội hình chuẩn 11 cầu thủ (Cộng thêm 3 cầu thủ dự bị)</li>
          <li>Cần có 1 thủ môn</li>
          <li>Cần có từ 3 - 5 hậu vệ</li>
          <li>Cần có từ 2 - 5 tiền vệ</li>
          <li>Cần có từ 1 - 3 tiền đạo</li>
        </ul> 
        <div>Bạn có thể mua 3 cầu thủ dự bị</div> 
      </div>
    	<div class="alert alert-warning">
        &raquo; Thị trường chuyển nhượng mở cửa từ <span class="highlight">thứ 4</span> đến <span class="highlight">20h ngày thứ 7</span> hàng tuần.<br>Mọi chuyển nhượng diễn ra ngoài thời gian trên đều sẽ bị rollback (trả lại lượt mua gần nhất) tự động mà không có thông báo trước.<br>
        &raquo; Mỗi cầu thủ bán đi bạn sẽ thu về 75% giá trị cầu thủ.<br>
        &raquo; Bạn được chuyển nhượng tối đa 3 lần / vòng đấu giải Ngoại Hạng Anh.
      </div>
      <?php 
				if((!Url::iget('vong_dau_id')))
				{?>
    	<div class="title title-bar">
  			<h3>Cầu thủ</h3>
      </div>
      <div class="alert">Chú ý: <span class="highlight">điểm cầu thủ</span> dựa trên cách tính điểm từ Fantasy Premier League và Sieusaongoaihang.vn.<br>
      <a href="#" onClick="window.open('https://sieusaongoaihang.vn/lich-thi-dau.html','','width=650,height=600,menubar=0');return false;">=>Tham khảo lịch thi đấu NHA</a></div>
      <div class="tieu-chi-loc">
      	<form name="SsnhDetailClbForm" id="SsnhDetailClbForm" method="post">
           <div class="input-group">
            <span class="input-group-addon">Câu lạc bộ</span>
            <select  name="clb_id" id="clb_id" class="form-control" onChange="loadFmMyTeam(false);"><?php
					if(isset($this->map['clb_id_list']))
					{
						foreach($this->map['clb_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('clb_id').value = "<?php echo addslashes(URL::get('clb_id',isset($this->map['clb_id'])?$this->map['clb_id']:''));?>";</script>
	</select>
          </div>
        	<div class="input-group">
            <span class="input-group-addon">Vị trí thi đấu</span>
            <select  name="vi_tri_id" id="vi_tri_id" class="form-control" onChange="loadFmMyTeam(false);"><?php
					if(isset($this->map['vi_tri_id_list']))
					{
						foreach($this->map['vi_tri_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('vi_tri_id').value = "<?php echo addslashes(URL::get('vi_tri_id',isset($this->map['vi_tri_id'])?$this->map['vi_tri_id']:''));?>";</script>
	</select>
          </div>
          <div class="input-group">
            <span class="input-group-addon">Sắp xếp theo</span>
            <select  name="sort_by" id="sort_by" class="form-control" onChange="loadFmMyTeam(false);"><?php
					if(isset($this->map['sort_by_list']))
					{
						foreach($this->map['sort_by_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('sort_by').value = "<?php echo addslashes(URL::get('sort_by',isset($this->map['sort_by'])?$this->map['sort_by']:''));?>";</script>
	</select>
          </div>
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
      </div>
      <div>
        <table cellspacing="0" cellpadding="0">
          <tbody><tr>
              <th colspan="3" width="60%" title="Tên cầu thủ"><input  name="cauThuTable" id="cauThuTable" type="text" style="border:0px;width:1px;background:none;">Cầu thủ</th>
              <th align="center" title="Câu lạc bộ">CLB</th>
              <th>iGold</th>
              <th>Điểm</th>
              </tr>
          <?php
					if(isset($this->map['cau_thus']) and is_array($this->map['cau_thus']))
					{
						foreach($this->map['cau_thus'] as $key8=>&$item8)
						{
							if($key8!='current')
							{
								$this->map['cau_thus']['current'] = &$item8;?>
          <tr>
              <td width="8%" align="center"><a onClick="showCauThu('cau-thu-dhss/<?php echo $this->map['cau_thus']['current']['name_id'];?>-id<?php echo $this->map['cau_thus']['current']['id'];?>.html');return false;" href="#" target="_blank" title="Thông tin câu thủ <?php echo $this->map['cau_thus']['current']['ten'];?>" class="img"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span></a></td>
              <td width="8%" align="center"><a title="Chọn cầu thủ vào đội hình" href="#" onClick="addPlayer(<?php echo $this->map['cau_thus']['current']['id'];?>,<?php echo $this->map['cau_thus']['current']['off']?1:0?>);return false;" class="chon-cau-thu"><?php echo ($this->map['cau_thus']['current']['off'])?'<img src="skins/ssnh/images/fm_game/off.png" alt="Nghỉ thi đấu">':'Mua'?></a></td>
              <td><a title="Chọn cầu thủ vào đội hình" href="#" onClick="addPlayer(<?php echo $this->map['cau_thus']['current']['id'];?>,<?php echo $this->map['cau_thus']['current']['off']?1:0?>);return false;" id="cau_thu_<?php echo $this->map['cau_thus']['current']['id'];?>"> <?php echo $this->map['cau_thus']['current']['vi_tri'];?> <?php echo $this->map['cau_thus']['current']['ten'];?></a></td>
              <td align="center"><?php echo $this->map['cau_thus']['current']['ma_clb'];?></td>
               <td align="center"><?php echo $this->map['cau_thus']['current']['cost'];?></td>
              <td align="center"><span title="Điểm vòng hiện tại: <?php echo $this->map['cau_thus']['current']['diem_vong_hien_tai']?$this->map['cau_thus']['current']['diem_vong_hien_tai']:0?>. Tổng điểm từ đầu mùa giải: <?php echo $this->map['cau_thus']['current']['tong_diem'];?>"><?php echo $this->map['cau_thus']['current']['diem_vong_hien_tai']?$this->map['cau_thus']['current']['diem_vong_hien_tai']:0?>/<?php echo $this->map['cau_thus']['current']['tong_diem'];?></span></td>
            </tr>
          
							
						<?php
							}
						}
					unset($this->map['cau_thus']['current']);
					} ?>
      	</tbody></table>
        <div class="pt small note">Vui lòng chọn CLB trước <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span><!--<?php echo $this->map['paging'];?>--></div><br>
     </div>
     
				<?php
				}
				?>
    </div>
  </div>
</div>
<script src="skins/ssnh/scripts/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="skins/ssnh/scripts/jBeep/jBeep.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="skins/ssnh/scripts/darktooltip/css/darktooltip.css">
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<script src="skins/ssnh/scripts/darktooltip/js/jquery.darktooltip.js"></script>
<script>
jQuery(document).ready(function(){
	jQuery('.tong-diem').darkTooltip({
		opacity:0.8,
		animation:'flipIn',
		gravity:'west'
	});
	jQuery('.igold').darkTooltip({
		opacity:0.8,
		animation:'flipIn',
		gravity:'west'
	});
	jQuery('#transfer-status-icon').darkTooltip({
		opacity:0.8,
		animation:'flipIn',
		gravity:'north'
	});
	<?php 
				if((isset($_SESSION['clb_tmp']['cau_thus']) and empty($_SESSION['clb_tmp']['cau_thus'])))
				{?>
	if(!jQuery('#vi_tri_id').val()){
		jQuery('#vi_tri_id').popover({title: "Mua cầu thủ: Chọn vị trí", content: "<div>Chọn vị trí thi đấu trên sân của các cầu thủ</div>", html: true,placement:'left'}); 
		window.setTimeout("jQuery('#vi_tri_id').popover('show');",1000);
	}
	if(jQuery('#vi_tri_id').val() && !jQuery('#clb_id').val()){
		jQuery('#clb_id').popover({title: "Mua cầu thủ: Theo câu lạc bộ", content: "<div>Các câu lạc bộ đang thi đấu tại giải Ngoại hạng Anh</div>", html: true,placement:'left'}); 
		window.setTimeout("jQuery('#clb_id').popover('show');",1000);
	}
	if(jQuery('#vi_tri_id').val() && jQuery('#clb_id').val()){
		jQuery('#cauThuTable').popover({title: "Mua cầu thủ: Chọn cầu thủ", content: "<div>Mua cầu thủ thích hợp vào đội hình <br>(Tối đa 11 cầu thủ + 3 cầu thủ dự bị)</div>", html: true,placement:'left'}); 
		window.setTimeout("jQuery('#cauThuTable').popover('show');",1000);
		jQuery('body').click(function(e) {
				jQuery('#cauThuTable').popover('hide');
		});
	}
	
				<?php
				}
				?>
	<?php 
				if((Url::get('do')!='edit_team' and isset($_SESSION['clb_tmp']['cau_thus']) and sizeof($_SESSION['clb_tmp']['cau_thus'])==11))
				{?>
	jQuery('#saveBtn').popover({title: "Mua cầu thủ: Hoàn thành", content: "<div>Sau khi chọn đủ <strong>11</strong> cầu thủ bạn vui lòng nhấn nút <strong>Ghi lại</strong> để hoàn thành việc tạo đội bóng.</div>", html: true,placement:'left'}); 
	window.setTimeout("jQuery('#saveBtn').popover('show')",1000);
	
				<?php
				}
				?>
	jQuery('.m-player-o').hover(function(e) {
		jBeep('skins/fmgame/media/annabloom_click.wav');
	});
});
var vong_dau_id=<?php echo $this->map['vong_dau_id'];?>;
function undoPlayer(cauThuId){
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			'do':'undo_player',
			'cau_thu_id':cauThuId,
			'act':'<?php echo (Url::get('do')=='edit_team')?'edit':'new';?>'
		},
		beforeSend: function(){
			jQuery('.cssload-container').show();
		},
		success: function(content){
			//alert(content);
			jQuery('.cssload-container').hide();
			switch(content){
				case 'true':
					loadFmMyTeam(cauThuId);
					break;
				case 'true_du_bi':
						alert('Bạn đã thực hiện thành công mua cầu thủ vào danh sách dự bị');
						loadFmMyTeam(cauThuId);
					break;
				case 'closed_transfer':
					custom_alert('Chuyển nhượng đã đóng. Vui lòng đợi lượt tiếp theo');
					break;
				case 'max_transfer':
					custom_alert('Bạn chỉ được chuyển nhượng tối đa <strong>3</strong> cầu thủ (Có thể mua<strong> Thẻ chuyển nhượng</strong> để tăng số lượt) trong một vòng đấu giải Ngoại Hạng Anh');
					break;	
				case 'igold':
					custom_alert('Bạn không có đủ iGold để mua cầu thủ. Bạn vui lòng nạp thêm');
					break;
				case 'limited':
					custom_alert('Bạn chỉ được sở hữu đội hình <=100 igold ');
					break;
				case 'max_cau_thu':
					custom_alert(' Số lượng cầu thủ không được quá 11 đá chính và 3 cầu thủ dự bị ');
					break;
				case 'max_tm':
					custom_alert(' Vị trí thủ môn chỉ được tối đa 1 cầu thủ ');
					break;
				case 'max_hv':
					custom_alert(' Vị trí hậu vệ chỉ được tối đa 5 cầu thủ ');
					break;
				case 'max_tv':
					custom_alert(' Vị trí tiền vệ chỉ được tối đa 5 cầu thủ ');
					break;
				case 'max_td':
					custom_alert(' Vị trí tiền đạo chỉ được tối đa 3 cầu thủ ');
					break;	
				case 'existed':
					custom_alert(' Cầu thủ này đã có trong đội hình ');
					break;
				case 'bought':
					custom_alert(' Cầu thủ này đã mua! ');
					break;
				default:
					custom_alert(' Lỗi trong khi thêm cầu thủ ');
					break;
			}
		},
		error: function(){
			custom_alert('Lỗi trong khi xóa cầu thủ. Bạn vui lòng kiểm tra lại kết nối!');
		}
	});
}
function addPlayer(cauThuId,off){
	if(off){
		custom_alert('Cầu thủ này nghỉ thi đấu vòng sau!');
		return false;
	}
	if('<?php echo $this->map['owner'];?>' == '1'){
		jQuery.ajax({
			method: "POST",
			url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
			data : {
				'do':'add_player',
				'cau_thu_id':cauThuId,
				'act':'<?php echo (Url::get('do')=='edit_team')?'edit':'new';?>'
			},
			beforeSend: function(){
				jQuery('.cssload-container').show();
			},
			success: function(content){
				//alert(content);
				jQuery('.cssload-container').hide();
				switch(content){
					case 'true':
						loadFmMyTeam(cauThuId);
						break;
					case 'true_du_bi':
						alert('Bạn đã thực hiện thành công mua cầu thủ vào danh sách dự bị');
						loadFmMyTeam(cauThuId);
						break;
					case 'closed_transfer':
						custom_alert('Chuyển nhượng đã đóng. Vui lòng đợi lượt tiếp theo');
						break;
					case 'max_transfer':
						custom_alert('Bạn chỉ được chuyển nhượng tối đa <strong>3</strong> cầu thủ (Có thể mua<strong> Thẻ chuyển nhượng</strong> để tăng số lượt) trong một vòng đấu giải Ngoại Hạng Anh');
						break;	
					case 'igold':
						custom_alert('Bạn không có đủ iGold để mua cầu thủ. Bạn vui lòng nạp thêm');
						break;
					case 'limited':
						custom_alert('Bạn chỉ được sở hữu đội hình <=100 igold ');
						break;
					case 'max_cau_thu':
						custom_alert(' Số lượng cầu thủ không được quá 11 đá chính và 3 cầu thủ dự bị ');
						break;
					case 'max_tm':
						custom_alert(' Vị trí thủ môn chỉ được tối đa 1 cầu thủ ');
						break;
					case 'max_hv':
						custom_alert(' Vị trí hậu vệ chỉ được tối đa 5 cầu thủ ');
						break;
					case 'max_tv':
						custom_alert(' Vị trí tiền vệ chỉ được tối đa 5 cầu thủ ');
						break;
					case 'max_td':
						custom_alert(' Vị trí tiền đạo chỉ được tối đa 3 cầu thủ ');
						break;	
					case 'existed':
						custom_alert(' Cầu thủ này đã có trong đội hình ');
						break;
					case 'bought':
						custom_alert(' Cầu thủ này đã mua! ');
						break;
					default:
						custom_alert(' Lỗi trong khi thêm cầu thủ ');
						break;
				}
			},
			error: function(){
				custom_alert('Lỗi trong khi xóa cầu thủ. Bạn vui lòng kiểm tra lại kết nối!');
			}
		});
	}
}
function delPlayer(id,temp){
	if('<?php echo $this->map['owner'];?>' == '1'){
		jQuery.ajax({
			method: "POST",
			url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
			data : {
				'do':'delete_player',
				'cau_thu_id':id,
				'act':temp?'temp':false
			},
			beforeSend: function(){
				jQuery('.cssload-container').show();
			},
			success: function(content){
				//custom_alert(content);
				jQuery('.cssload-container').hide();
				switch(content){
					case 'closed_transfer':
						custom_alert('Chuyển nhượng đã đóng. Vui lòng đợi lượt tiếp theo');
						break;
					case 'max_transfer':
						custom_alert('Bạn chỉ được mua tối đa 3 cầu thủ trong một vòng đấu giải Ngoại Hạng Anh');
						break;
					case 'true':
						loadFmMyTeam(false);
						break;
					default:
						custom_alert('Lỗi trong khi xóa cầu thủ.');
						break;
				}
				
			},
			error: function(){
				custom_alert('Lỗi trong khi xóa cầu thủ. Bạn vui lòng kiểm tra lại kết nối!');
			}
		});
	}
}
function loadFmMyTeam(cauThuId){
	jQuery.ajax({
			method: "POST",
			url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
			data : {
				'vi_tri_id':jQuery('#vi_tri_id').val(),
				'clb_id':jQuery('#clb_id').val(),
				'sort_by':jQuery('#sort_by').val(),
				'do':'<?php echo Url::get('do');?>'
				<?php echo Url::get('act')?',"act":"'.Url::get('act').'"':'';?>
			},
			beforeSend: function(){
				jQuery('.cssload-container').show();
			},
			success: function(content){
				jQuery('.cssload-container').hide();
				jQuery('#FmMyTeam').html(content);
				//reloadIgold();
			},
			error: function(){
				custom_alert('Lỗi...Bạn vui lòng kiểm tra lại kết nối!');
			}
		});
}
function reloadIgold(){
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			'do':'reload_igold'
		},
		beforeSend: function(){
			jQuery('.cssload-container').show();
		},
		success: function(content){
			jQuery('.cssload-container').hide();
			iGoldObj = jQuery('#igold1');
			iGoldObj.html(content);
			iGoldObj.addClass( "igold big", 1000, "easeOutBounce",function(){iGoldObj.removeClass('big',1000,"easeOutBounce")});
		},
		error: function(){
			custom_alert('Lỗi...Bạn vui lòng kiểm tra lại kết nối!');
		}
	});
}
function processSubmit(){
	if(to_numeric(jQuery('#tong_cau_thu').val())<11){
		custom_alert('Đội hình chưa đủ 11 cầu thủ...');
		return false;
	}else{
		var $tm=0;
		var $hv=0;
		var $tv=0;
		var $td=0;
		jQuery('.player-tm').each(function(){
			$tm++;
		});
		jQuery('.player-hv').each(function(){
			$hv++;
		});
		jQuery('.player-tv').each(function(){
			$tv++;
		});
		jQuery('.player-td').each(function(){
			$td++;
		});
		if($tm==0){
			custom_alert('Bạn chưa có thủ môn!');
			return false;
		}
		if($hv<3){
			custom_alert('Bạn phải có ít nhất 3 hậu vệ trong đội hình!');
			return false;
		}
		if($tv<2){
			custom_alert('Bạn phải có ít nhất 2 tiền vệ trong đội hình!');
			return false;			
		}
		if($hv<1){
			custom_alert('Bạn phải có ít nhất 1 tiền đạo trong đội hình!');
			return false;			
		}
		AddClbForm.submit();
	}
}
function showCauThu(url){
	window.open(url,'','width=610px,height=700px');
}
</script>
</div>