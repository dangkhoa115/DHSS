<div style="min-height:300px;">
  <div class="row">
  	<div class="col-md-12">
    	<div class="row">
      	<div class="col-md-8 title"><h1>TOP bình chọn vòng đấu</h1></div>
        <div class="col-md-4 search-options">
          <form name="EditQuanLyLichSuCauThuForm" method="post" action="<?php echo Url::get('page');?>.html">
          <select  name="vong_dau_id" id="vong_dau_id" onchange="EditQuanLyLichSuCauThuForm.submit()" class="form-control"><?php
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
    </div>
    <div class="col-md-12">
      <table cellpadding="0" cellspacing="0" width="100%" align="center" class="table leagueTable">
      	<tr>
      	  <th align="center" width="1%">STT</th>
        	<th align="left">Vòng đấu</th>
        	<th align="left" width="1%">&nbsp;</th>
          <th align="1%">&nbsp;</th>
          <th align="left" width="30%">Người chơi</th>
          <th align="center">Điểm</th>
          <th align="center">CMTND</th>
          <th align="left">CLB</th>
          <th align="center" width="200">Thời gian bình chọn</th>
        </tr>
        <?php
					if(isset($this->map['binhchons']) and is_array($this->map['binhchons']))
					{
						foreach($this->map['binhchons'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['binhchons']['current'] = &$item1;?>
        <tr <?php echo $this->map['binhchons']['current']['hop_le']?'style="color:#000;font-weight:bold;"':'style="color:#666"'?>>
          <td align="center"><?php echo $this->map['binhchons']['current']['i'];?></td>
          <td><?php echo $this->map['binhchons']['current']['vong_dau'];?></td>
          <td><?php 
				if((User::can_admin(MODULE_QUANLYCAUTHU,ANY_CATEGORY) or 1==1))
				{?> <?php echo $this->map['binhchons']['current']['from_web']?'<img src="skins/ssnh/images/from_web.png">':'<img src="skins/ssnh/images/from_mobile.png">';?>
				<?php
				}
				?></td>
          <td><img src="<?php echo $this->map['binhchons']['current']['anh_dai_dien'];?>" width="80" onerror="this.src='skins/ssnh/images/unknown_player.png'" alt=""></td>
          <td><a href="tong-hop/nguoichoi<?php echo $this->map['binhchons']['current']['nguoi_choi_id'];?>.html" target="_blank" title="Xem thông tin người chơi"><?php echo $this->map['binhchons']['current']['nguoi_choi'];?></a></td>
          <td align="center" style="color:#FF5700;"><?php echo $this->map['binhchons']['current']['diem'];?> <?php echo $this->map['binhchons']['current']['x2']?' <span class="x2-item">X2</span>':'';?></td>
          <td align="center"><?php echo $this->map['binhchons']['current']['cmtnd'];?></td>
          <td align="left">
          <?php 
				if((xem_clb_trong_binh_chon($this->map['binhchons']['current']['nguoi_choi_id'],$this->map['binhchons']['current']['vong_dau_id'])))
				{?>
          <?php echo $this->map['binhchons']['current']['clb'];?>
           <?php }else{ ?>
          <span style="color:#F00">Ẩn</span>
          
				<?php
				}
				?>
          </td>
          <td align="center"><?php echo $this->map['binhchons']['current']['thoi_gian_binh_chon'];?> <?php if(User::can_admin(MODULE_QUANLYCAUTHU,ANY_CATEGORY)){?><a href="<?php echo Url::build_current(array('do'=>'delete','id'=>$this->map['binhchons']['current']['id']));?>" onClick="if(!confirm('Bạn có chắc không?')){return false;}" style="color:#FF0004;">Xóa</a><?php }?></td>
        </tr>
        
							
						<?php
							}
						}
					unset($this->map['binhchons']['current']);
					} ?>
      </table>
    </div> 
    <!-- End .tab-page-category-1 -->
  </div>
</div>