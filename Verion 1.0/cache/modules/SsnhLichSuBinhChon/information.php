<?php if(Url::get('page') == 'binh-chon' or Url::get('page') == 'binh-chon-beta'){?>
<div style="float:left;width:100%;min-height:300px;">
<?php }elseif(Url::get('page') == 'top-binh-chon'){?>
<div style="float:left;width:100%;min-height:300px;">
<? }else{?>
<div style="float:left;width:100%;min-height:300px;">
<?php }?>
  <div class="row">
    <div class="col-md-12">
    	<div class="row">
      	<div class="col-md-6">
        	<div class="title"><h2>Bình chọn của người chơi</h2></div>
        </div>
        <div class="col-md-6 search-options">
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
        <?php 
				if(($this->map['show_clb']))
				{?>
        <select  name="search_clb_id" id="search_clb_id" onchange="EditQuanLyLichSuCauThuForm.submit()" class="form-control"><?php
					if(isset($this->map['search_clb_id_list']))
					{
						foreach($this->map['search_clb_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('search_clb_id').value = "<?php echo addslashes(URL::get('search_clb_id',isset($this->map['search_clb_id'])?$this->map['search_clb_id']:''));?>";</script>
	</select>
        
				<?php
				}
				?>
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
       </div>
      </div>
      <br clear="all">
      <table cellpadding="0" cellspacing="0" width="100%" align="center" class="table leagueTable">
      	<tr>
      	  <th align="center" width="1%">STT</th>
        	<th align="left">Vòng đấu</th>
        	<th align="left" width="1%">&nbsp;</th>
          <th align="left" width="120">Người chơi</th>
          <th align="center">CMTND</th>
          <th align="left">CLB</th>
          <th align="center">Thời gian bình chọn</th>
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
          <td><?php echo $this->map['binhchons']['current']['nguoi_choi'];?></td>
          <td align="center"><?php echo $this->map['binhchons']['current']['cmtnd'];?></td>
          <td align="left">
          <?php echo $this->map['binhchons']['current']['x2']?' <span class="x2-item">X2</span>':'';?>
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
          <td align="center"><?php echo $this->map['binhchons']['current']['thoi_gian_binh_chon'];?> <?php if(User::can_admin(MODULE_QUANLYCAUTHU,ANY_CATEGORY)){?><a href="<?php echo Url::build_current(array('do'=>'delete','vong_dau_id','id'=>$this->map['binhchons']['current']['id']));?>" onClick="if(!confirm('Bạn có chắc không?')){return false;}" style="color:#FF0004;">Xóa</a><?php }?></td>
        </tr>
        
							
						<?php
							}
						}
					unset($this->map['binhchons']['current']);
					} ?>
      </table>
      <div class="bottom">
        <div class="total-vote">Tổng lượt bình chọn trong vòng đấu <strong><?php echo $this->map['total'];?></strong></div>
        <div class="paging"><?php echo $this->map['paging'];?></div>
      </div>
    </div>
  </div>
</div>