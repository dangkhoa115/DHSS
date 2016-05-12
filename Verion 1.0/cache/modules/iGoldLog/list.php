<script>
	function check_selected()
	{
		var status = false;
		jQuery('form :checkbox').each(function(e){
			if(this.checked && this.id=='ListiGoldLogForm_checkbox')
			{
				status = true;
			}
		});	
		return status;
	}
</script>
<script>	
	jQuery(document).ready(function(){
		jQuery('#from_date').datepicker({ yearRange: '2008:2020' });
		jQuery('#to_date').datepicker({ yearRange: '2008:2020' });
	});	
</script>
<fieldset id="toolbar">
	<div id="toolbar-title">Log Giao dịch iGold</div>
</fieldset>
<br>
<fieldset id="toolbar">
<form name="ListiGoldLogForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">	
<table cellpadding="2" cellspacing="0" width="100%">
		<tr>
			<td width="100%">
				<div style="float:left;">
				  <input  name="from_date" id="from_date"  class="form-control" placeholder="Từ ngày" type ="text" value="<?php echo String::html_normalize(URL::get('from_date'));?>"></div>
				<div style="float:left;">
				  <input  name="to_date" id="to_date"  class="form-control" placeholder="Đến ngày" type ="text" value="<?php echo String::html_normalize(URL::get('to_date'));?>"></div>
        <div style="float:left;"><input  name="keyword" id="keyword" class="form-control" placeholder="Từ khóa" type ="text" value="<?php echo String::html_normalize(URL::get('keyword'));?>"></div>
				<div><input  name="search"  value="Tìm kiếm" id="search" class="btn btn-default" type ="submit" value="<?php echo String::html_normalize(URL::get('search'));?>"></div>
			</td>
		</tr>
	</table>
	<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
	  <tr style="background-color:#F0F0F0">
		<th width="2%" align="center"><input type="checkbox" value="1" id="ListiGoldLogForm_all_checkbox" onclick="select_all_checkbox(this.form,'ListiGoldLogForm',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
		<th width="14%" align="left"><a>Tài khoản</a></th>
		<th width="30%" align="left">Diễn giải</th>
		<th width="7%" align="center">iGold</th>
		<th width="7%" align="left"><a><?php echo Portal::language('time');?></a></th>
	  </tr>
	<?php $i=0;?>
	<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
	  <tr valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if($i%2){echo 'background-color:#F9F9F9';}?>" id="Category_tr_<?php echo $this->map['items']['current']['id'];?>">
		<td><?php $i++;?>
		<input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'ListiGoldLog',this,'#FFFFEC','white');" id="ListiGoldLogForm_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td>
		<td nowrap="nowrap"><?php echo $this->map['items']['current']['account_id'];?></td>
		<td><?php echo $this->map['items']['current']['description'];?></td>
		<td align="right"><?php echo $this->map['items']['current']['value'];?></td>		
		<td nowrap="nowrap"><?php echo date('d/m/Y H:i\'',$this->map['items']['current']['time']);?></td>
	  </tr>
	
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
	</table>
	<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%;" align="center">
	  <tr>
		<td width="30%">				
			<b>Tổng cộng</b>: <?php echo $this->map['total'];?> bản ghi</td>
		<td width="70%" colspan="1" align="right">&nbsp;<?php echo $this->map['paging'];?></td>
	  </tr>
	</table>
	<input type="hidden" name="cmd" value="" id="cmd"/>
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
<div style="height:8px"></div>
</fieldset>
