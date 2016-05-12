	<div id="FmMyTeam">
<div class="title-all col-xs-12">
  <div class="row">
    <div class="col-xs-8 clb">
    	<div class="row">
        <div class="col-xs-8">
          <div class="title">
          	<div class="logo-clb"><img src="<?php echo $this->map['my_team_logo'];?>" alt="<?php echo $this->map['my_team'];?>" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></div>
            <h2 class="ten-clb"><?php echo $this->map['my_team'];?></h2>
            <div class="server-name">
            	<?php if($this->map['server']){?>
              Thi đấu <strong><?php echo $this->map['server'];?></strong>
              <?php }else{ if(!Url::get('team_id')){?>
              <?php }else{echo '&nbsp;';}}?>
              <?php 
				if((!$this->map['owner']))
				{?>
              <div><a href="tin-nhan.html?account_id=<?php echo User::encode_password($this->map['account_id']);?>#smf" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Nhắn tin</a></div>
              
				<?php
				}
				?>
            </div>
            <div>
            	Đăng nhập gần nhất: <?php echo $this->map['last_online_time'];?> <br>(Thưởng <strong>2</strong> iGold / ngày khi đăng nhập)
            </div>
          </div>
        </div>
        <div class="col-xs-4">
        	<?php 
				if(($this->map['owner']))
				{?>
        	<div class="setting"><input  name="editBtn" id="editBtn" type="text" style="border:0px;width:1px;background:none;"><a href="<?php echo Url::build_current(array('do'=>'edit','id'=>$this->map['my_team_id']));?>" title="Chỉnh sửa"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></div>
          
				<?php
				}
				?>
        </div>
      </div>
      <br clear="all">
      <div class="tip hide">Mẹo: muốn có <strong>power</strong> cao, hãy tham khảo <a href="#" onClick="window.open('https://sieusaongoaihang.vn/lich-thi-dau.html','','width=650,height=600,menubar=0');return false;">lịch thi đấu giải NHA</a> và phong độ cầu thủ của vóng đấu gần nhất sắp diễn ra.</div>
      <div class="tab">
        <ul>
          <li><a href="dhss<?php echo Url::get('team_id')?'?team_id='.Url::get('team_id'):'';?>" <?php echo (!Url::get('act'))?' class="active"':''?>>Đội hình <?php echo $this->map['vong_dau'];?></a></li>
          <li><a href="dhss?act=lscn&team_id=<?php echo $this->map['clb_id'];?>" <?php echo (Url::get('act')=='lscn')?' class="active"':''?>>Lịch sử chuyển nhượng</a></li>
          <li><a href="bang-xep-hang.html<?php echo (isset($this->map['server_id']) and $this->map['server_id'])?'?server_id='.$this->map['server_id']:'';?>">Bảng xếp hạng</a></li>
        </ul>
      </div>
      <br clear="all">
      <?php if(Url::get('act')=='lscn'){?>
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
						foreach($this->map['transfer_cau_thus'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['transfer_cau_thus']['current'] = &$item1;?>
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
      <div class="dh-mockup">
      		<div class="igold">Trị giá:<br><?php echo $this->map['gia_tri_doi_hinh'];?> igold</div>
      		<div class="tong-diem"><?php echo $this->map['tong_diem'];?><br><span>Power</span></div>
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
						foreach($this->map['thu_mons'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['thu_mons']['current'] = &$item2;?>
            <li>
                <div class="m-player-o">
                    <div class="img"><a class="zoom_img" href="#" onClick="window.open('cau-thu-dhss/<?php echo $this->map['thu_mons']['current']['name_id'];?>-id<?php echo $this->map['thu_mons']['current']['cau_thu_id'];?>.html?quick_view=1','','width=530px,height=700px');return false;"><img src="<?php echo $this->map['thu_mons']['current']['anh_dai_dien'];?>" id="anh_<?php echo $this->map['thu_mons']['current']['id'];?>" alt=""/></a></div>
                    <span class="nub"><?php echo $this->map['thu_mons']['current']['so_ao'];?></span>
                    <p class="text">
                      <span class="name"><?php echo $this->map['thu_mons']['current']['ten'];?></span>
                      <span class="total"><?php echo $this->map['thu_mons']['current']['diem'];?></span>
                      <?php 
				if(($this->map['owner']))
				{?>
                      <span class="cost" title="Giá <?php echo $this->map['thu_mons']['current']['cost'];?> iGold"><?php echo $this->map['thu_mons']['current']['cost'];?><img src="skins/ssnh/images/igold_16.png" alt=""></span>
                      
				<?php
				}
				?>
                      <?php 
				if(($this->map['thu_mons']['current']['bought']))
				{?>
                          <span class="del"><a href="#" onClick="return false;" style="width: 55px;font-size:11px;color:#000;left:-29px;" title="Đã bán ở vòng đấu tiếp theo">Đã bán</a></span>
                          
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
				if(($this->map['thu_mons']['current']['captain']))
				{?>
                      <a class="captain" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                      
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
						foreach($this->map['hau_ves'] as $key3=>&$item3)
						{
							if($key3!='current')
							{
								$this->map['hau_ves']['current'] = &$item3;?>
              <li>
                  <div class="m-player-o">
                      <div class="img"><a class="zoom_img" href="#" onClick="window.open('cau-thu-dhss/<?php echo $this->map['hau_ves']['current']['name_id'];?>-id<?php echo $this->map['hau_ves']['current']['cau_thu_id'];?>.html?quick_view=1','','width=530px,height=700px');return false;"><img src="<?php echo $this->map['hau_ves']['current']['anh_dai_dien'];?>" id="anh_<?php echo $this->map['hau_ves']['current']['id'];?>" alt=""/></a></div>
                      <span class="nub"><?php echo $this->map['hau_ves']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['hau_ves']['current']['ten'];?></span>
                          <?php 
				if(($this->map['hau_ves']['current']['off']))
				{?>
                          <span class="glyphicon glyphicon-alert" aria-hidden="true" title="Cầu thủ nghỉ thi đấu vòng sau"></span>
                          
				<?php
				}
				?>
                          <?php 
				if(($this->map['hau_ves']['current']['bought']))
				{?>
                          <span class="del"><a href="#" onClick="return false;" style="width: 55px;font-size:11px;color:#000;left:-29px;" title="Đã bán ở vòng đấu tiếp theo">Đã bán</a></span>
                          
				<?php
				}
				?>
                          <span class="total"><?php echo $this->map['hau_ves']['current']['diem'];?></span>
                          <?php 
				if(($this->map['owner']))
				{?>
                          <span class="cost" title="Giá <?php echo $this->map['hau_ves']['current']['cost'];?> iGold"><?php echo $this->map['hau_ves']['current']['cost'];?><img src="skins/ssnh/images/igold_16.png" alt=""></span>
                          
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
				if(($this->map['hau_ves']['current']['captain']))
				{?>
                          <a class="captain" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                          
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
						foreach($this->map['tien_ves'] as $key4=>&$item4)
						{
							if($key4!='current')
							{
								$this->map['tien_ves']['current'] = &$item4;?>
              <li>
                  <div class="m-player-o">
                      <div class="img"><a class="zoom_img" href="#" onClick="showCauThu('cau-thu-dhss/<?php echo $this->map['tien_ves']['current']['name_id'];?>-id<?php echo $this->map['tien_ves']['current']['cau_thu_id'];?>.html?quick_view=1');return false;"><img src="<?php echo $this->map['tien_ves']['current']['anh_dai_dien'];?>" id="anh_<?php echo $this->map['tien_ves']['current']['id'];?>" alt=""/></a></div>
                      <span class="nub"><?php echo $this->map['tien_ves']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['tien_ves']['current']['ten'];?></span>
                          <span class="total"><?php echo $this->map['tien_ves']['current']['diem'];?></span>
                          <?php 
				if(($this->map['owner']))
				{?>
                          <span class="cost" title="Giá <?php echo $this->map['tien_ves']['current']['cost'];?> iGold"><?php echo $this->map['tien_ves']['current']['cost'];?><img src="skins/ssnh/images/igold_16.png" alt=""></span>
                          
				<?php
				}
				?>
                          <?php 
				if(($this->map['tien_ves']['current']['bought']))
				{?>
                          <span class="del"><a href="#" onClick="return false;" style="width: 55px;font-size:11px;color:#000;left:-29px;" title="Đã bán ở vòng đấu tiếp theo">Đã bán</a></span>
                          
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
				if(($this->map['tien_ves']['current']['captain']))
				{?>
                          <a class="captain" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                          
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
						foreach($this->map['tien_daos'] as $key5=>&$item5)
						{
							if($key5!='current')
							{
								$this->map['tien_daos']['current'] = &$item5;?>
              <li>
                  <div class="m-player-o">
                      <div class="img"><a class="zoom_img" href="#" onClick="window.open('cau-thu-dhss/<?php echo $this->map['tien_daos']['current']['name_id'];?>-id<?php echo $this->map['tien_daos']['current']['cau_thu_id'];?>.html?quick_view=1','','width=530px,height=700px');return false;"><img src="<?php echo $this->map['tien_daos']['current']['anh_dai_dien'];?>" id="anh_<?php echo $this->map['tien_daos']['current']['id'];?>" alt=""/></a></div>
                      <span class="nub"><?php echo $this->map['tien_daos']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['tien_daos']['current']['ten'];?></span>
                          <span class="total"><?php echo $this->map['tien_daos']['current']['diem'];?></span>
                          <?php 
				if(($this->map['owner']))
				{?>
                          <span class="cost" title="Giá <?php echo $this->map['tien_daos']['current']['cost'];?> iGold"><?php echo $this->map['tien_daos']['current']['cost'];?><img src="skins/ssnh/images/igold_16.png" alt=""></span>	
                          
				<?php
				}
				?>
                          <?php 
				if(($this->map['tien_daos']['current']['bought']))
				{?>
                          <span class="del"><a href="#" onClick="return false;" style="width: 55px;font-size:11px;color:#000;left:-29px;" title="Đã bán ở vòng đấu tiếp theo">Đã bán</a></span>
                          
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
				if(($this->map['tien_daos']['current']['captain']))
				{?>
                          <a class="captain" href="#" onClick="return false" title="Đội trưởng (Điểm nhân đôi)">&nbsp;</a>
                          
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
      </div><!--End .dh-mockup-->  
      <div class="list-da-mua du-bi col-md-12">
      	<h3>Cầu thủ dự bị</h3>
      	<ul>
      	<?php
					if(isset($this->map['du_bis']) and is_array($this->map['du_bis']))
					{
						foreach($this->map['du_bis'] as $key6=>&$item6)
						{
							if($key6!='current')
							{
								$this->map['du_bis']['current'] = &$item6;?>
        <li>
        	<a class="zoom_img" href="#" style="position:relative;" onclick="showChangePlayerBox(<?php echo $this->map['du_bis']['current']['id'];?>,this);return false;"><img src="<?php echo $this->map['du_bis']['current']['anh_dai_dien'];?>" id="anh_<?php echo $this->map['du_bis']['current']['id'];?>" alt=""/></a>
          <span><?php echo $this->map['du_bis']['current']['vi_tri'];?> <?php echo $this->map['du_bis']['current']['ten'];?> <?php echo $this->map['du_bis']['current']['du_bi']?'<div class="du-bi">Dự bị</div>':'';?></span>
        </li>
      	
							
						<?php
							}
						}
					unset($this->map['du_bis']['current']);
					} ?>
        </ul>
         <div class="alert thay-nguoi-form">
          <div class="alert sub-alert">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Thay cầu thủ</span>
              <select  name="cau_thu_id" id="cau_thu_id" class="form-control" aria-describedby="basic-addon1" onChange="updateChangePlayer(this.value)"><?php
					if(isset($this->map['cau_thu_id_list']))
					{
						foreach($this->map['cau_thu_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('cau_thu_id').value = "<?php echo addslashes(URL::get('cau_thu_id',isset($this->map['cau_thu_id'])?$this->map['cau_thu_id']:''));?>";</script>
	</select>
              <input  name="cau_thu_du_bi_id" type="hidden" id="cau_thu_du_bi_id" value="1">
            </div>
            <div class="col-xs-12 small"><hr><center>-- Chọn cầu thủ để thay ra phải tuân theo quy tắc xếp đội hình --</center></div>
          </div>
        </div>
      </div>
      <br>
      <?php }?>
      <div class="row">
      	<div class="col-xs-12 lich-thi-dau mini">
          <div class="title title-bar">
            <h3>Lịch sử thi đấu</h3>
            <a class="view-more" href="?page=fmg_schedule">Xem thêm</a>
          </div>
           <table width="100%" class="table">      
            <tbody>
              <?php
					if(isset($this->map['lichs']) and is_array($this->map['lichs']))
					{
						foreach($this->map['lichs'] as $key7=>&$item7)
						{
							if($key7!='current')
							{
								$this->map['lichs']['current'] = &$item7;?>
              <tr>
                <td width="5%"><img class="clb-img" alt="<?php echo $this->map['lichs']['current']['doi_chu_nha'];?>" src="<?php echo $this->map['lichs']['current']['logo_cn'];?>" title="<?php echo $this->map['lichs']['current']['doi_chu_nha'];?>" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></td>
                <td width="30%"><strong><?php echo $this->map['lichs']['current']['doi_chu_nha'];?></strong></td>
                <td align="center">
                  <div><?php echo $this->map['lichs']['current']['thoi_gian_ngay'];?> <?php echo $this->map['lichs']['current']['thoi_gian_gio'];?>'</div>
                  <?php 
				if(($this->map['lichs']['current']['ket_qua']))
				{?>
                  <a href="<?php echo Url::build('fmg_play',array('do'=>'thidau','dcn_id'=>$this->map['lichs']['current']['dcn_id'],'dkh_id'=>$this->map['lichs']['current']['dkh_id'],'vong_dau_id'=>$this->map['lichs']['current']['vong_dau_id']))?>" class="btn btn-default">
                  	<?php echo $this->map['lichs']['current']['ty_so'];?>
                  </a>
                   <?php }else{ ?>
                  <a href="<?php echo Url::build('fmg_play',array('do'=>'thidau','dcn_id'=>$this->map['lichs']['current']['dcn_id'],'dkh_id'=>$this->map['lichs']['current']['dkh_id']))?>" class="btn btn-default">VS</a>
                  
				<?php
				}
				?><br>
                  <strong><?php echo $this->map['lichs']['current']['vong_dau'];?></strong>
                </td>
                <td width="30%" align="right"><strong><?php echo $this->map['lichs']['current']['doi_khach'];?></strong></td>
                <td width="5%"><img class="clb-img" alt="<?php echo $this->map['lichs']['current']['doi_khach'];?>" title="<?php echo $this->map['lichs']['current']['doi_khach'];?>" src="<?php echo $this->map['lichs']['current']['logo_kh'];?>" onerror="this.src='skins/ssnh/images/fm_game/logo_clb.png'"></td>
              </tr>
              
							
						<?php
							}
						}
					unset($this->map['lichs']['current']);
					} ?>
            </tbody>
          </table>
         </div>
      </div>   
    </div>
    <div class="col-xs-4">
    	<div class="alert phong-thay-do">
      	<div class="row">
          <div class="col-md-12">
          	<h3><a href="trang-ca-nhan-dhss.html">HLV: <?php echo $this->map['hlv'];?></a></h3>
            <div class="body">
            	<div class="uniform">
              	<h3>TRANG PHỤC ĐỘI</h3>
                <div class="hide">Comming soon...!</div>	
              	<ul>
                	<li class="ao <?php echo $this->map['ao_class'];?>" title="Mua ngay với giá ưu đãi (20 igold)" onClick="buyUniform(this,7);return false;"></li>
                  <li class="quan <?php echo $this->map['quan_class'];?>" title="Mua ngay với giá ưu đãi (10 igold)" onClick="buyUniform(this,8);return false;"></li>
                  <li class="tat <?php echo $this->map['tat_class'];?>" title="Mua ngay với giá ưu đãi (10 igold)" onClick="buyUniform(this,9);return false;"></li>
                  <li class="giay <?php echo $this->map['giay_class'];?>" title="Mua ngay với giá ưu đãi (25 igold)" onClick="buyUniform(this,10);return false;"></li>
                </ul>
              </div>
            	<div id="nhan_qua_hlv">
              <a href="#" onClick="nhanQua();return false;" class="stitched" title="Nhập quà kinh nghiệm">NHẬN QUÀ</a>
              </div>
              <img class="avatar" src="<?php echo $this->map['hlv_avatar'];?>" onerror="this.src='skins/ssnh/images/fm_game/hidden_player.png'" alt="">
            	<div class="hang-hlv" title="<?php echo $this->map['hang_hlv'];?>"><img src="<?php echo $this->map['anh_hang_hlv'];?>" alt="<?php echo $this->map['hang_hlv'];?>" class="img-responsive"></div>
            </div>
            <?php $diem_kn_next_level = (($this->map['hang_hlv']+1)*($this->map['hang_hlv']+1))/0.16;?>
            <div class="diem-kn">Level <?php echo $this->map['hang_hlv'];?> (Điểm KN: <?php echo $this->map['diem_kn'];?>)<a href="?page=fmg_top_hlv"> &raquo; TOP HLV</a>
            	<div class="process-bar"><span style="width:<?php echo ($this->map['diem_kn']/($diem_kn_next_level))*100;?>%;">&nbsp;</span>&nbsp;</div>
            </div>
          </div>
        </div>
      </div>
    	<div class="alert">
      	<div class="row">
          <div class="col-xs-12">
            <div class="alert sub-alert">
              <div class="row">
                <div class="col-xs-5">Power:</div>
                <div class="col-xs-7"><div class="power"><span style="width:<?php echo ($this->map['tong_diem']/150)*100;?>%;"><?php echo $this->map['tong_diem'];?></span>&nbsp;</div></div>
            	</div>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="alert sub-alert">
              <div class="row phong-ngu">
                <div class="col-xs-5">Phòng ngự:</div>
                <div class="col-xs-7"><div class="power"><span style="width:<?php echo ($this->map['phong_ngu']/150)*100;?>%;"><?php echo $this->map['phong_ngu'];?></span>&nbsp;</div></div>
            	</div>
            </div>
            <div class="alert sub-alert">
              <div class="row tan-cong">
                <div class="col-xs-5">Tấn công:</div>
                <div class="col-xs-7"><div class="power"><span style="width:<?php echo ($this->map['tan_cong']/150)*100;?>%;"><?php echo $this->map['tan_cong'];?></span>&nbsp;</div></div>
            	</div>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="alert sub-alert">
            	<div class="row">
                <div class="col-xs-5"><?php 
				if(($this->map['owner']))
				{?>
                <a class="btn btn-danger" href="#" onClick="bomSucBen();return false;" title="Bơm thêm thể lực"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a> Thể lực
                
				<?php
				}
				?></div>
                <div class="col-xs-7">
                <div class="processbar">
                <div id="progressBar1" class="default"><div></div></div>
                </div>
                </div>
                <div class="col-xs-12 small"><hr><center>*Mẹo: Tăng thể lực với mỗi nấc là tăng tỷ lệ chiến thắng tưng ứng!!!</center></div>
                <script>
									var suc_ben_index = to_numeric(<?php echo $this->map['stamina'];?>);
										jQuery(document).ready(function(e) {
									  progressBar(suc_ben_index*10, $('#progressBar1'));
									});
                </script>
              </div>
            </div>
            <div class="alert sub-alert">
            	<div class="row">
                <div class="col-xs-5"><?php 
				if(($this->map['owner']))
				{?>
                <a class="btn btn-sm btn-primary" href="#" onClick="TapLuyen();return false;" title="Tăng điểm tập luyện"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a> Tập luyện
                
				<?php
				}
				?></div>
                <div class="col-xs-7">
                <div class="processbar">
                <div id="progressBar" class="default"><div></div></div>
                </div>
                </div>
                <div class="col-xs-12 small"><hr><center>
                *Chú ý: Điểm tập luyện sẽ tự động trừ đi 10 mỗi ngày nếu về 0 tức là đội bạn lười tập khỏi thi đấu luôn!!!
                </center></div>
                <script>
									var tl_index = to_numeric(<?php echo $this->map['train'];?>);
										jQuery(document).ready(function(e) {
									  progressBar(tl_index*10, $('#progressBar'));
									});
                </script>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="alert sub-alert">
            	<div class="row">
                <div class="col-xs-5">Phong độ trận:</div>
                <div class="col-xs-7">
                <?php echo $this->map['phong_do'];?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php 
				if(($this->map['owner']))
				{?>
      <div class="alert captain">
      	<div class="alert sub-alert">
        	<div class="input-group">
          	<span class="input-group-addon" id="basic-addon1">Đội trưởng</span>
      			<select  name="captain" id="captain" class="form-control" aria-describedby="basic-addon1" onChange="updateCaptain(this.value)"><?php
					if(isset($this->map['captain_list']))
					{
						foreach($this->map['captain_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('captain').value = "<?php echo addslashes(URL::get('captain',isset($this->map['captain'])?$this->map['captain']:''));?>";</script>
	</select>
          </div>
        	<div class="col-xs-12 small"><hr><center>-- Điểm số nhân đôi --</center></div>
      	</div>
      </div>
      
				<?php
				}
				?>
      <div class="tooltip-content" id="chuyen-nhuong" style="display:none;">
        <h3>Thị trường chuyển nhượng</h3>
        <p>
          Thị trường chuyển nhượng mở cửa từ thứ 4 đến 20h thứ 7 hàng tuần
        </p>
      </div>
      <a name="bang_xep_hang"></a>
    	<div class="alert">
  			<ul>
        	<li>Server sẽ có lịch thi đấu từ 22h5 ngày thứ 7. Thời gian bắt đầu thi đấu là 9h sáng thứ 3 hàng tuần</li>
          <li>8h ngày thứ 7 hàng tuần sẽ có lịch Liên đấu Server và 9h sáng thứ 7 sẽ bắt đầu thi đấu loại trực tiếp để chọn ra cặp đấu trung kết và nhà vô địch Liên Server.</li>
        </ul>
      </div>
      <div class="title title-bar">
  			<h3>Bảng xếp hạng</h3>
      </div>
      <div class="bxh-mini">
      <table cellspacing="0" cellpadding="0" class="table bxh">
        <tbody>
          <tr>
          <th class="col-hang">Hạng</th>
          <th class="col-club">Club</th>
          <th align="center" class="col-pts">Power</th>            
          <th class="col-pts">Điểm</th>            
         </tr>
         <?php $i=1;?>
         <?php
					if(isset($this->map['bxh_clbs']) and is_array($this->map['bxh_clbs']))
					{
						foreach($this->map['bxh_clbs'] as $key8=>&$item8)
						{
							if($key8!='current')
							{
								$this->map['bxh_clbs']['current'] = &$item8;?>
         <tr class="accent<?php echo ($i==1)?$i:(($i<=4)?2:(($i==5)?3:''));$i++;?>">
          <td class="col-hang" align="center"><?php echo ($this->map['bxh_clbs']['current']['hang']==1)?'<span class="glyphicon glyphicon-king" aria-hidden="true"></span> ':$this->map['bxh_clbs']['current']['hang'];?></td>
          <td class="col-club"><a <?php echo (FMGAME::my_team_id()==$this->map['bxh_clbs']['current']['id'])?' style="color:#ffbb19;"':'';?> href="dhss/?team_id=<?php echo $this->map['bxh_clbs']['current']['id'];?>" class="external"><?php echo $this->map['bxh_clbs']['current']['name'];?></a></td>
          <td align="center" class="col-pld"><?php echo $this->map['bxh_clbs']['current']['power'];?></td>
          <td class="col-pld"><?php echo $this->map['bxh_clbs']['current']['diem'];?></td>       
         </tr>
         
							
						<?php
							}
						}
					unset($this->map['bxh_clbs']['current']);
					} ?>
        </tbody>
       </table>
       </div>
    </div>
  </div>
</div>
</div>
<script src="skins/ssnh/scripts/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="skins/ssnh/scripts/jBeep/jBeep.min.js" type="text/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="skins/ssnh/scripts/darktooltip/css/darktooltip.css">
<script src="skins/ssnh/scripts/darktooltip/js/jquery.darktooltip.js"></script>
<script>
jQuery(document).ready(function(){
	<?php 
				if(($this->map['first_time'] or !$this->map['my_team_logo']))
				{?>
	jQuery('#editBtn').popover({title: "Sửa tên đội - Thay logo", content: "<div>HLV vào đây để thay tên đội hoặc logo</div>", html: true,placement:'left'}); 
	window.setTimeout("jQuery('#editBtn').popover('show')",1000);
	jQuery('body').click(function(e) {
			jQuery('#editBtn').popover('hide');
	});
	
				<?php
				}
				?>
	<?php 
				if((1==1))
				{?>
	if(!jQuery('#captain').val()){
		jQuery('#captain').popover({title: "CHỌN ĐỘI TRƯỞNG", content: "<div>Hãy đặt niềm tin vào đội trưởng của bạn. Đội trưởng sẽ được x2 điểm số.</div>", html: true,placement:'top'}); 
		window.setTimeout("jQuery('#captain').popover('show')",1000);
	}
	
				<?php
				}
				?>
	jQuery('#transfer-status-icon').darkTooltip({
		opacity:0.8,
		animation:'flipIn',
		gravity:'north'
	});
	jQuery('.zoom_img').hover(function(e) {
		jBeep('skins/fmgame/media/annabloom_click.wav');
	});
	jQuery( ".power span" ).animate({
		width: "toggle"
	}, 1000, function() {
		//jQuery( this ).effect( "fadeIn", 500 );
	});
});
/**
 * ProgressBar for jQuery
 *
 * @version 1 (29. Dec 2012)
 * @author Ivan Lazarevic
 * @requires jQuery
 * @see http://workshop.rs
 *
 * @param  {Number} percent
 * @param  {Number} $element progressBar DOM element
 */
function progressBar(percent, $element) {
	var progressBarWidth = percent * $element.width() / 100;
	$element.find('div').animate({ width: progressBarWidth }, 500).html(percent + "%&nbsp;");
}
function bomSucBen(){
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			'do':'bom_suc_ben'
		},
		beforeSend: function(){
			jQuery('.cssload-container').show();
		},
		success: function(content){
			jQuery('.cssload-container').hide();
			switch(content){
				case 'true':
					suc_ben_index++;
					progressBar(suc_ben_index*10, $('#progressBar1'));
					iGoldObj = jQuery('#igold1');
					iGoldObj.html(to_numeric(iGoldObj.html())-1);
					iGoldObj.addClass( "igold big", 1000, "easeOutBounce",function(){iGoldObj.removeClass('big',1000,"easeOutBounce")});
					break;
				case 'igold':
					custom_alert('Bạn không có đủ iGold để bơm thể lực. Bạn vui lòng nạp thêm');
					break;
				case 'limited':
					custom_alert('Đội của bạn đã khỏe như trâu!!!');
					break;
				default:
					custom_alert('Lỗi trong khi bơm thể lực');
					break;
			}
		},
		error: function(){
			custom_alert('Lỗi...Bạn vui lòng kiểm tra lại kết nối!');
			jQuery('.cssload-container').hide();
		}
	});
}
function TapLuyen(){
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			'do':'tap_luyen'
		},
		beforeSend: function(){
			jQuery('.cssload-container').show();
		},
		success: function(content){
			jQuery('.cssload-container').hide();
			switch(content){
				case 'true':
					tl_index++;
					progressBar(tl_index*10, $('#progressBar'));
					break;
				case 'trained':
					custom_alert('Bạn đã tập luyện trong ngày. Mỗi ngày chỉ có một lần tập luyện!');
					break;	
				case 'limited':
					custom_alert('Bạn đã sẵn sàng ở mức cao nhất, không cần phải tập gì thêm!!!');
					break;
				default:
					custom_alert('Lỗi trong khi bơm thể lực');
					break;
			}
		},
		error: function(){
			custom_alert('Lỗi...Bạn vui lòng kiểm tra lại kết nối!');
			jQuery('.cssload-container').hide();
		}
	});
}
function showCauThu(url){
	window.open(url,'','width=530px,height=700px');
}
function loadFmMyTeam(){
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
function updateCaptain(id){
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			'do':'update_captain',
			'id':id
		},
		beforeSend: function(){
			jQuery('.cssload-container').show();
		},
		success: function(content){
			jQuery('.cssload-container').hide();
			if(content == 'true'){
				//loadFmMyTeam(false);
				custom_alert('Update đội trưởng thành công!');
				window.location='dhss';
			}else if (content == 'giai_phu'){
				custom_alert('Bạn đã tham gia vào giải phụ nên không thay đổi được đội trưởng!');
			}else{
				
				custom_alert('Có lỗi trong quá trình update. Vui lòng thao tác lại');
			}
		},
		error: function(){
			custom_alert('Lỗi...Bạn vui lòng kiểm tra lại kết nối!');
		}
	});
}
function updateChangePlayer(value){
	var from_cau_thu_id = jQuery('#cau_thu_du_bi_id').val();
	var to_cau_thu_id = value;
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			'do':'change_player',
			'from_cau_thu_id':from_cau_thu_id,
			'to_cau_thu_id':to_cau_thu_id,
			'vong_dau_id':<?php echo $this->map['vong_dau_id'];?>
		},
		beforeSend: function(){
			jQuery('.cssload-container').show();
		},
		success: function(content){
			jQuery('.cssload-container').hide();
			if(content == 'true'){
				//loadFmMyTeam(false);
				custom_alert('Thay người thành công!');
				window.location='dhss';
			}else{
				custom_alert(content);
			}
		},
		error: function(){
			custom_alert('Lỗi...Bạn vui lòng kiểm tra lại kết nối!');
		}
	});
}
function nhanQua(){
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			'do':'nhan_qua_hlv'
		},
		beforeSend: function(){
			jQuery('.cssload-container').show();
		},
		success: function(content){
			jQuery('.cssload-container').hide();
			if(content == 'true'){
				custom_alert('Bạn đã nhận phần thưởng kinh nghiệm thành công!');
			}else if (content == '500'){
				custom_alert('Bạn đã nhận phần thưởng kinh nghiệm mức bán chuyên (10 igold). Vui lòng đợi mức sau');
			}else if (content == '1000'){
				custom_alert('Bạn đã nhận phần thưởng kinh nghiệm mức chuyên nghiệp (30 igold). Vui lòng đợi mức sau');
			}else if (content == '3000'){
				custom_alert('Bạn đã nhận phần thưởng kinh nghiệm mức ngoại hạng (50 igold). Vui lòng đợi mức sau');
			}else{
				custom_alert('Bạn chưa đủ điểm kinh nghiệm để nhận quà. (Tối thiểu 500 điểm)');
			}
			//jQuery('.cssload-container').hide();
		},
		error: function(){
			custom_alert('Lỗi...Bạn vui lòng kiểm tra lại kết nối!');
		}
	});
}
function buyUniform(obj,id){
	<?php 
				if((!$this->map['owner']))
				{?>
	return false;
	
				<?php
				}
				?>
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			'do':'mua_dong_phuc',
			'item_id':id
		},
		beforeSend: function(){
			jQuery('.cssload-container').show();
		},
		success: function(content){
			jQuery('.cssload-container').hide();
			if(content == 'true'){
				//custom_alert('');
				alert('Bạn đã mua thành công!');
				window.document.location = '/dhss';
			}else if (content == 'existed'){
				custom_alert('Bạn đã sở hữu rồi!');
			}else if (content == 'igold'){
				custom_alert('Bạn không đủ igold để giao dịch. Vui lòng nạp thêm');
			}else{
				custom_alert('Có lỗi trong quá trình giao dịch. Vui lòng nhấn F5 và thực hiện lại');
			}
			//jQuery('.cssload-container').hide();
		},
		error: function(){
			custom_alert('Lỗi...Bạn vui lòng kiểm tra lại kết nối!');
		}
	});
}
function showChangePlayerBox(id,obj){
	//selected
	jQuery('#cau_thu_du_bi_id').val(id);
	//alert(jQuery('#cau_thu_du_bi_id').val());
	jQuery( 'li' ).removeClass( "selected" );
	jQuery( obj ).closest( 'li' ).toggleClass( "selected" );
	pos = jQuery(obj).position();
	jQuery('.thay-nguoi-form').css({display:'block',left:pos.left+'px',top:pos.top - 100+'px'});
}
</script>