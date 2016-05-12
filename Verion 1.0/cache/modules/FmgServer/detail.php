<div id="FmgServer">
<div class="title-all col-md-12">
  <div class="row">
  	<div class="col-md-8">	
      <div class="title"><h1>Đội hình <?php echo $this->map['vong_dau'];?></h1></div>
    </div>
    <div class="col-md-4">
    	<div class="transfer-status dong-cua">Thị trường chuyển nhượng đã đóng cửa</div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 clb">
    	<div class="row">
        <div class="col-md-8">
          <div class="title">
            <h2><img id="logo" src="<?php echo $this->map['my_team_logo'];?>" height="50" alt="<?php echo $this->map['my_team'];?>"> Đội hình CLB <?php echo $this->map['my_team'];?></h2>
          </div>
        </div>
        <div class="col-md-4">
        	<div class="setting"><a href="<?php echo Url::build_current(array('do'=>'edit','id'=>$this->map['my_team_id']));?>" title="Chỉnh sửa"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></div>
          <div class="igold">Giá trị đội hình: <?php echo $this->map['gia_tri_doi_hinh'];?> igold </div>
        </div>
      </div>
      <br clear="all">
      <div class="dh-mockup">
      		<div class="tong-diem"><?php echo $this->map['tong_diem'];?><br><span>Điểm</span></div>
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
						foreach($this->map['thu_mons'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['thu_mons']['current'] = &$item1;?>
            <li>
                <div class="m-player-o">
                    <div class="img"><a href="cau-thu/<?php echo $this->map['thu_mons']['current']['name_id'];?>-id<?php echo $this->map['thu_mons']['current']['cau_thu_id'];?>.html" target="_blank"><img src="<?php echo $this->map['thu_mons']['current']['anh_dai_dien'];?>" id="anh_<?php echo $this->map['thu_mons']['current']['id'];?>" alt=""/></a></div>
                    <span class="nub"><?php echo $this->map['thu_mons']['current']['so_ao'];?></span>
                    <p class="text">
                        <span class="name"><?php echo $this->map['thu_mons']['current']['ten'];?></span>
                        <span class="total"><?php echo $this->map['thu_mons']['current']['diem'];?></span>
                        <span class="cost" title="Giá <?php echo $this->map['thu_mons']['current']['cost'];?> iGold"><?php echo $this->map['thu_mons']['current']['cost'];?><img src="skins/ssnh/images/igold_16.png" alt=""></span>
                        <span class="del"><a href="#" onClick="delPlayer(<?php echo $this->map['thu_mons']['current']['id'];?>);return false;" title="Bán cầu thủ này"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></span>
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
						foreach($this->map['hau_ves'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['hau_ves']['current'] = &$item2;?>
              <li>
                  <div class="m-player-o">
                      <div class="img"><a href="cau-thu/<?php echo $this->map['hau_ves']['current']['name_id'];?>-id<?php echo $this->map['hau_ves']['current']['cau_thu_id'];?>.html" target="_blank"><img src="<?php echo $this->map['hau_ves']['current']['anh_dai_dien'];?>" id="anh_<?php echo $this->map['hau_ves']['current']['id'];?>" alt=""/></a></div>
                      <span class="nub"><?php echo $this->map['hau_ves']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['hau_ves']['current']['ten'];?></span>
                          <span class="total"><?php echo $this->map['hau_ves']['current']['diem'];?></span>
                          <span class="cost" title="Giá <?php echo $this->map['hau_ves']['current']['cost'];?> iGold"><?php echo $this->map['hau_ves']['current']['cost'];?><img src="skins/ssnh/images/igold_16.png" alt=""></span>
                          <span class="del"><a href="#" onClick="delPlayer(<?php echo $this->map['hau_ves']['current']['id'];?>);return false;" title="Bán cầu thủ này"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></span>
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
						foreach($this->map['tien_ves'] as $key3=>&$item3)
						{
							if($key3!='current')
							{
								$this->map['tien_ves']['current'] = &$item3;?>
              <li>
                  <div class="m-player-o">
                      <div class="img"><a href="cau-thu/<?php echo $this->map['tien_ves']['current']['name_id'];?>-id<?php echo $this->map['tien_ves']['current']['cau_thu_id'];?>.html" target="_blank"><img src="<?php echo $this->map['tien_ves']['current']['anh_dai_dien'];?>" id="anh_<?php echo $this->map['tien_ves']['current']['id'];?>" alt=""/></a></div>
                      <span class="nub"><?php echo $this->map['tien_ves']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['tien_ves']['current']['ten'];?></span>
                          <span class="total"><?php echo $this->map['tien_ves']['current']['diem'];?></span>
                          <span class="cost" title="Giá <?php echo $this->map['tien_ves']['current']['cost'];?> iGold"><?php echo $this->map['tien_ves']['current']['cost'];?><img src="skins/ssnh/images/igold_16.png" alt=""></span>
                          <span class="del"><a href="#" onClick="delPlayer(<?php echo $this->map['tien_ves']['current']['id'];?>);return false;" title="Bán cầu thủ này"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></span>
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
						foreach($this->map['tien_daos'] as $key4=>&$item4)
						{
							if($key4!='current')
							{
								$this->map['tien_daos']['current'] = &$item4;?>
              <li>
                  <div class="m-player-o">
                      <div class="img"><a href="cau-thu/<?php echo $this->map['tien_daos']['current']['name_id'];?>-id<?php echo $this->map['tien_daos']['current']['cau_thu_id'];?>.html" target="_blank"><img src="<?php echo $this->map['tien_daos']['current']['anh_dai_dien'];?>" id="anh_<?php echo $this->map['tien_daos']['current']['id'];?>" alt=""/></a></div>
                      <span class="nub"><?php echo $this->map['tien_daos']['current']['so_ao'];?></span>
                      <p class="text">
                          <span class="name"><?php echo $this->map['tien_daos']['current']['ten'];?></span>
                          <span class="total"><?php echo $this->map['tien_daos']['current']['diem'];?></span>
                          <span class="cost" title="Giá <?php echo $this->map['tien_daos']['current']['cost'];?> iGold"><?php echo $this->map['tien_daos']['current']['cost'];?><img src="skins/ssnh/images/igold_16.png" alt=""></span>
                          <span class="del"><a href="#" onClick="delPlayer(<?php echo $this->map['tien_daos']['current']['id'];?>);return false;" title="Bán cầu thủ này"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></span>
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
    <div class="col-md-4 bo-loc-cau-thu">
    	<div class="title title-bar">
  			<h3>Bộ lọc</h3>
      </div>
      <div class="tieu-chi-loc">
      	<form name="SsnhDetailClbForm" id="SsnhDetailClbForm" method="post">
        	<div class="input-group">
            <span class="input-group-addon">Vị trí thi đấu</span>
            <select  name="vi_tri_id" id="vi_tri_id" class="form-control" onChange="loadFmgServer(false);"><?php
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
            <span class="input-group-addon">Câu lạc bộ</span>
            <select  name="clb_id" id="clb_id" class="form-control" onChange="loadFmgServer(false);"><?php
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
            <span class="input-group-addon">Sắp xếp theo</span>
            <select  name="sort_by" id="sort_by" class="form-control" onChange="loadFmgServer(false);"><?php
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
              <th colspan="3" width="60%" title="Tên cầu thủ">Cầu thủ</th>
              <th align="center" title="Câu lạc bộ">CLB</th>
              <th>iGold</th>
              <th>Điểm</th>
              </tr>
          <?php
					if(isset($this->map['cau_thus']) and is_array($this->map['cau_thus']))
					{
						foreach($this->map['cau_thus'] as $key5=>&$item5)
						{
							if($key5!='current')
							{
								$this->map['cau_thus']['current'] = &$item5;?>
          <tr onMouseOver="this.bgColor='#A4F2FF'" onMouseOut="this.bgColor='#FFFFFF'">
              <td width="8%" align="center"><a href="cau-thu/<?php echo $this->map['cau_thus']['current']['name_id'];?>-id<?php echo $this->map['cau_thus']['current']['id'];?>.html" target="_blank" title="Thông tin câu thủ <?php echo $this->map['cau_thus']['current']['ten'];?>" class="img"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span></a></td>
              <td width="8%" align="center"><a title="Chọn cầu thủ vào đội hình" href="#" onClick="addPlayer(<?php echo $this->map['cau_thus']['current']['id'];?>);return false;" class="chon-cau-thu"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></td>
              <td><a title="Chọn cầu thủ vào đội hình" href="#" onClick="addPlayer(<?php echo $this->map['cau_thus']['current']['id'];?>);return false;" id="cau_thu_<?php echo $this->map['cau_thus']['current']['id'];?>"> <?php echo $this->map['cau_thus']['current']['vi_tri'];?> <?php echo $this->map['cau_thus']['current']['ten'];?></a></td>
              <td align="center"><?php echo $this->map['cau_thus']['current']['ma_clb'];?></td>
               <td align="center"><?php echo $this->map['cau_thus']['current']['cost'];?></td>
              <td align="center"><span><?php echo $this->map['cau_thus']['current']['tong_diem'];?></span></td>
            </tr>
          
							
						<?php
							}
						}
					unset($this->map['cau_thus']['current']);
					} ?>
      	</tbody></table>
        <div class="pt small"><?php echo $this->map['paging'];?></div>
     </div>
    </div>
  </div>
</div>
<script src="skins/ssnh/scripts/jquery-1.11.0.min.js" type="text/javascript"></script>
<script>
var vong_dau_id=<?php echo $this->map['vong_dau_id'];?>;
function addPlayer(cauThuId){
	if(1==1){
		jQuery.ajax({
			method: "POST",
			url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
			data : {
				'do':'add_player',
				'cau_thu_id':cauThuId
			},
			beforeSend: function(){
				jQuery('.cssload-container').show();
			},
			success: function(content){
				jQuery('.cssload-container').hide();
				switch(content){
					case 'true':
						loadFmgServer(cauThuId);
						break;
					case 'closed_transfer':
						alert('Thị trường chuyển nhượng đã đóng cửa. Vui lòng đợi vòng đấu tiếp theo');
						break;
					case 'igold':
						alert('Bạn không có đủ iGold để mua cầu thủ. Bạn vui lòng nạp thêm');
						break;
					case 'limited':
						alert(' ---Bạn chỉ được sở hữu đội hình <=100 igold --- ');
						break;
					case 'max_cau_thu':
						alert(' --- Số lượng cầu thủ không được quá 11 --- ');
						break;
					case 'max_tm':
						alert(' --- Vị trí thủ môn chỉ được tối đa 1 cầu thủ --- ');
						break;
					case 'max_hv':
						alert(' --- Vị trí hậu vệ chỉ được tối đa 5 cầu thủ --- ');
						break;
					case 'max_tv':
						alert(' --- Vị trí tiền vệ chỉ được tối đa 5 cầu thủ --- ');
						break;
					case 'max_td':
						alert(' --- Vị trí tiền đạo chỉ được tối đa 5 cầu thủ --- ');
						break;	
					case 'existed':
						alert(' --- Cầu thủ này đã có trong đội hình --- ');
						break;
					default:
						alert(' --- Lỗi trong khi thêm cầu thủ --- ');
						break;
				}
			},
			error: function(){
				alert('Lỗi trong khi xóa cầu thủ. Bạn vui lòng kiểm tra lại kết nối!');
			}
		});
	}
}
function delPlayer(id){
	if(1==1){
		jQuery.ajax({
			method: "POST",
			url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
			data : {
				'do':'delete_player',
				'id':id,
				'vong_dau_id':vong_dau_id
			},
			beforeSend: function(){
				jQuery('.cssload-container').show();
			},
			success: function(content){
				//alert(content);
				jQuery('.cssload-container').hide();
				switch(content){
					case 'closed_transfer':
						alert('Thị trường chuyển nhượng đã đóng cửa. Vui lòng đợi vòng đấu tiếp theo');
						break;
					case 'true':
						loadFmgServer(false);
						break;
					default:
						alert('Lỗi trong khi xóa cầu thủ.');
						break;
				}
				
			},
			error: function(){
				alert('Lỗi trong khi xóa cầu thủ. Bạn vui lòng kiểm tra lại kết nối!');
			}
		});
	}
}
function loadFmgServer(cauThuId){
	jQuery.ajax({
			method: "POST",
			url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
			data : {
				'vi_tri_id':jQuery('#vi_tri_id').val(),
				'clb_id':jQuery('#clb_id').val(),
				'sort_by':jQuery('#sort_by').val()
			},
			beforeSend: function(){
				jQuery('.cssload-container').show();
			},
			success: function(content){
				jQuery('.cssload-container').hide();
				jQuery('#FmgServer').html(content);
				reloadIgold();
			},
			error: function(){
				alert('Lỗi...Bạn vui lòng kiểm tra lại kết nối!');
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
				alert('Lỗi...Bạn vui lòng kiểm tra lại kết nối!');
			}
		});
}
</script>
</div>