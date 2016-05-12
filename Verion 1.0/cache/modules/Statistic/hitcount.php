<fieldset id="toolbar">
	<div id="toolbar-info">Thống kê lượt xem</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		 	<td>
      <form name="HitcountForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
        Từ ngày <input  name="date_from" id="date_from" style="width:80px;" type ="text" value="<?php echo String::html_normalize(URL::get('date_from'));?>">
        Đến ngày <input  name="date_to" id="date_to" style="width:80px;" type ="text" value="<?php echo String::html_normalize(URL::get('date_to'));?>">
        <select  name="search_user_id" id="search_user_id" class="inputbox" size="1" onchange="document.HitcountForm.submit();"><?php
					if(isset($this->map['search_user_id_list']))
					{
						foreach($this->map['search_user_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('search_user_id').value = "<?php echo addslashes(URL::get('search_user_id',isset($this->map['search_user_id'])?$this->map['search_user_id']:''));?>";</script>
	</select>
        (<?php echo System::display_number($this->map['total_hitcount']);?> lượt xem / <?php echo System::display_number($this->map['total']);?> tin bài - TB <?php echo $this->map['total']?System::display_number($this->map['total_hitcount']/$this->map['total']):'';?> lượt xem/bài)
        <input type="submit" value="">
      <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
      </td>
	  </tbody>
	</table>
	</div>
</fieldset>
<div style="height:8px;"></div>
<fieldset id="toolbar">
<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
  <tr style="background-color:#F0F0F0">
	<th width="3%" align="left"><a>#</a></th>
	<th width="50%" align="left"><a>Tin bài</a></th>
	<th width="20%" align="left"><a>Danh mục</a></th>
	<th width="10%" align="left">Ngày đăng</th>
	<th width="5%" align="center"><a>By</a></th>
	<th width="10%" align="left">Lượt xem</th>
	</tr>
  <?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
  <tr <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if($this->map['items']['current']['indexs']%2){echo 'background-color:#F9F9F9';}?>">
	<td><?php echo $this->map['items']['current']['indexs'];?></td>
	<td><?php echo $this->map['items']['current']['name'];?></td>
	<td><?php echo $this->map['items']['current']['category_name'];?></td>
	<td><?php echo date('H:i\' d/m/Y',$this->map['items']['current']['time'])?></td>
	<td align="center"><?php echo $this->map['items']['current']['user_id'];?></td>
	<td align="right"><?php echo $this->map['items']['current']['hitcount'];?></td>
	</tr>
  
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
 </table> 	
 <table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
<tr>
	<td align="right" width="1%">&nbsp;</td>
	<td align="right"><?php echo $this->map['paging'];?></td>
</tr>
</table>
</fieldset>
<script>
jQuery(document).ready(function(){
	jQuery('#date_from').datepicker();
	jQuery('#date_to').datepicker();
});

</script>