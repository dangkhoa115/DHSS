<!--<div class="beta"></div>-->
<div class="content-r binh-chon">
	<form name="SsnhListForm" method="post" action="<?php echo Url::get('page');?>.html">
  <div class="title">
    <h1>Dánh sách đội bóng bạn đã tham gia bình chọn 
      <select  name="vong_dau_id" id="vong_dau_id" onchange="SsnhListForm.submit()"><?php
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
      </h1></div>    
  <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			    
  <div class="detail">
  	<table border="0" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0" width="100%" align="center" class="table leagueTable">
      	<tr>
        	<th width="1%" align="left">STT</th>
          <th width="40%" align="left">CLB</th>
          <th align="center">Thời gian bình chọn</th>
          <th width="100" align="center">&nbsp;</th>
      </tr>
        <?php
					if(isset($this->map['binhchons']) and is_array($this->map['binhchons']))
					{
						foreach($this->map['binhchons'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['binhchons']['current'] = &$item1;?>
        <tr>
        	<td align="center"><?php echo $this->map['binhchons']['current']['i'];?></td>
          <td><?php echo $this->map['binhchons']['current']['x2']?' <span class="x2-item">X2</span>':'';?> <?php echo $this->map['binhchons']['current']['clb'];?></td>
          <td align="center"><?php echo $this->map['binhchons']['current']['thoi_gian_binh_chon'];?></td>
          <td align="center"><?php echo $this->map['binhchons']['current']['action'];?></td>
      </tr>
        
							
						<?php
							}
						}
					unset($this->map['binhchons']['current']);
					} ?>
    </table>
    <div class="button-wrapper">
    	<?php 
				if(($this->map['dang_dien_ra']))
				{?>
    	<?php 
				if((sizeof($this->map['binhchons']) > 0))
				{?>
    	<a href="tham-gia-binh-chon/do/bc.html" class="btn btn-primary">Cập nhật lại</a>
       <?php }else{ ?>
      <a href="tham-gia-binh-chon/do/bc.html" class="btn btn-primary">Bình chọn vòng đấu</a>
      
				<?php
				}
				?>
      <?php 
				if(($this->map['x2_item']))
				{?>
      <a href="tham-gia-binh-chon/do/x2.html" class="btn btn-success">Nhân đôi điểm số</a>
       <?php }else{ ?>
      <a href="ssnh_shop.html" class="btn btn-default">Mua item X2</a>
      
				<?php
				}
				?>
      
				<?php
				}
				?>
    </div>
    <div class="note">(*) <strong>Tất cả</strong> người chơi dự doán đúng đều có cơ hội dự quay trúng thưởng.</div>
  </div>   
</div>