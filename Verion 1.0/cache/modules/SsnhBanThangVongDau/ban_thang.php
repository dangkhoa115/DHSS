<div style="min-height:300px;">
  <div class="row">
  	<div class="col-md-12">
    	<div class="row">
      	<div class="col-md-9 title"><h1>Người chơi dự đoán tổng số bàn thắng của <?php echo $this->map['vong_dau'];?></h1></div>
        <div class="col-md-3 search-options">
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
        	<th align="left" width="30%">Người chơi</th>
          <th align="center">Dự đoán</th>
          <th align="center" width="200">Thời gian bình chọn</th>
        </tr>
        <?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
        <tr>
          <td align="center"><?php echo $this->map['items']['current']['i'];?></td>
          <td><?php echo $this->map['items']['current']['vong_dau'];?></td>
          <td><?php echo $this->map['items']['current']['nguoi_choi'];?></td>
          <td align="center"><?php echo $this->map['items']['current']['value'];?></td>
          <td align="center"><?php echo $this->map['items']['current']['time'];?></td>
        </tr>
        
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
        <tr>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right"><strong>Tổng số bàn thắng</strong>:</td>
          <td align="center"><strong><?php echo $this->map['ban_thang'];?></strong></td>
          <td align="center">&nbsp;</td>
        </tr>
      </table>
      <div align="right"><a href="/tham-gia-binh-chon/do/ban_thang.html" class="btn btn-primary">Tham gia dự đoán</a></div>
    </div> 
    <!-- End .tab-page-category-1 -->
  </div>
</div>