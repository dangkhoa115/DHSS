<script>
	function check_selected()
	{
		var status = false;
		jQuery('form :checkbox').each(function(e){
			if(this.checked && this.id=='ListiGoldReportForm_checkbox')
			{
				status = true;
			}
		});	
		return status;
	}
</script>
<script>	
	jQuery(document).ready(function(){
		var timeout = setTimeout(startRefresh,120000);
		jQuery('#from_date').datepicker({ yearRange: '2015:2020' });
		jQuery('#to_date').datepicker({ yearRange: '2015:2020' });
		jQuery('#top_igold_date').datepicker({ yearRange: '2015:2020' });
	});
function startRefresh() {
    jQuery.get('', function(data) {
			jQuery(document.body).html(data);     
    });
}	
</script>
<fieldset id="toolbar">
	<div id="toolbar-title">Log Giao dịch iGold</div>
</fieldset>
<br>
<fieldset id="toolbar">
<form name="ListiGoldReportForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">	
<table cellpadding="2" cellspacing="0" width="100%">
		<tr>
			<td width="100%">
      	<div style="float:left;">
				  <input  name="search_account_id" id="search_account_id"  class="form-control" placeholder="Tài khoản" type ="text" value="<?php echo String::html_normalize(URL::get('search_account_id'));?>"></div>
				<div style="float:left;">
				  <input  name="from_date" id="from_date"  class="form-control" placeholder="Từ ngày" style="width:80px;" type ="text" value="<?php echo String::html_normalize(URL::get('from_date'));?>"></div>
				<div style="float:left;">
				  <input  name="to_date" id="to_date"  class="form-control" placeholder="Đến ngày" style="width:80px;" type ="text" value="<?php echo String::html_normalize(URL::get('to_date'));?>"></div>
        <div style="float:left;"><input  name="keyword" id="keyword" class="form-control" placeholder="Từ khóa" type ="text" value="<?php echo String::html_normalize(URL::get('keyword'));?>"></div>
        <div style="float:left;">
				  <input  name="from_value" id="from_value"  class="form-control" placeholder="Số iGold từ" style="width:80px;" type ="text" value="<?php echo String::html_normalize(URL::get('from_value'));?>"><input  name="to_value" id="to_value"  class="form-control" placeholder="đến iGold" style="width:80px;" type ="text" value="<?php echo String::html_normalize(URL::get('to_value'));?>"></div>
				<div><input  name="search"  value="Tìm kiếm" id="search" class="btn btn-default" type ="submit" value="<?php echo String::html_normalize(URL::get('search'));?>"> <a href="?page=igold_report">Reset</a></div>
			</td>
		</tr>
	</table>
    <table width="100%" border="1" bordercolor="#CCC" cellspacing="0" cellpadding="5">
    <tbody>
      <tr valign="top">
        <td width="70%">
        	<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;" border="1" bordercolor="#E7E7E7" align="center">
            <tr style="background-color:#F0F0F0">
            <th width="14%" align="left"><a>Tài khoản</a></th>
            <th width="7%" align="center">iGold</th>
            <th width="30%" align="left">Diễn giải</th>
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
            <td nowrap="nowrap"><?php echo $this->map['items']['current']['account_id'];?></td>
            <td align="right" style="color:<?php echo $this->map['items']['current']['color'];?>"><?php echo $this->map['items']['current']['value'];?></td>
            <td title="<?php echo $this->map['items']['current']['description'];?>"><?php echo String::display_sort_title($this->map['items']['current']['description'],5);?></td>
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
        </td>
        <td>
        	<div style="overflow:auto;height:300px;margin-bottom:10px;">
        	<h3>TOP giao dịch iGold trong ngày <input  name="top_igold_date" id="top_igold_date"  class="form-control" placeholder="Chọn ngày" style="width:80px;" onChange="ListiGoldReportForm.submit();" type ="text" value="<?php echo String::html_normalize(URL::get('top_igold_date'));?>"></h3>
        	<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;" border="1" bordercolor="#E7E7E7" bgcolor="#FFF" align="center">
            <tr style="background-color:#95DCFF">
            <th width="14%" align="left"><a>Tài khoản</a></th>
            <th width="7%" align="center">iGold</th>
            <th width="30%" align="left">Diễn giải</th>
            <th width="5%" align="left"><a><?php echo Portal::language('time');?></a></th>
            </tr>
          <?php $i=0;?>
          <?php
					if(isset($this->map['top_igolds']) and is_array($this->map['top_igolds']))
					{
						foreach($this->map['top_igolds'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['top_igolds']['current'] = &$item2;?>
            <tr valign="middle" style="font-size:11px;">
            <td nowrap="nowrap"><?php echo $this->map['top_igolds']['current']['account_id'];?></td>
            <td align="right" style="color:<?php echo $this->map['top_igolds']['current']['color'];?>"><?php echo $this->map['top_igolds']['current']['value'];?></td>
            <td title="<?php echo $this->map['top_igolds']['current']['description'];?>"><?php echo String::display_sort_title($this->map['top_igolds']['current']['description'],3);?></td>
            <td nowrap="nowrap"><?php echo date('d/m/Y H:i\'',$this->map['top_igolds']['current']['time']);?></td>
            </tr>
          
							
						<?php
							}
						}
					unset($this->map['top_igolds']['current']);
					} ?>
          </table>
          </div>
          <div style="overflow:auto;height:300px;margin-bottom:10px;">
          <h3>TOP tài khoản</h3>
        	<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;" border="1" bordercolor="#E7E7E7" bgcolor="#FFF" align="center">
            <tr style="background-color:#A0DC70">
            <th width="14%" align="left"><a>Tài khoản</a></th>
            <th width="7%" align="center">iGold</th>
            </tr>
          <?php $i=0;?>
          <?php
					if(isset($this->map['top_accounts']) and is_array($this->map['top_accounts']))
					{
						foreach($this->map['top_accounts'] as $key3=>&$item3)
						{
							if($key3!='current')
							{
								$this->map['top_accounts']['current'] = &$item3;?>
            <tr valign="middle" style="font-size:11px;">
            <td nowrap="nowrap"><?php echo $this->map['top_accounts']['current']['id'];?></td>
            <td align="right"><?php echo number_format($this->map['top_accounts']['current']['igold'],0);?></td>
            </tr>
          
							
						<?php
							}
						}
					unset($this->map['top_accounts']['current']);
					} ?>
          </table>
          </div>
          <div style="overflow:auto;height:300px;">
          <h3>TOP tài khoản tiêu nhiều nhất</h3>
        	<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;" border="1" bordercolor="#E7E7E7" bgcolor="#FFF" align="center">
            <tr style="background-color:#FFCE89">
            <th width="14%" align="left"><a>Tài khoản</a></th>
            <th width="7%" align="center">iGold</th>
            </tr>
          <?php $i=0;?>
          <?php
					if(isset($this->map['top_paid_accounts']) and is_array($this->map['top_paid_accounts']))
					{
						foreach($this->map['top_paid_accounts'] as $key4=>&$item4)
						{
							if($key4!='current')
							{
								$this->map['top_paid_accounts']['current'] = &$item4;?>
            <tr valign="middle" style="font-size:11px;">
            <td nowrap="nowrap"><?php echo $this->map['top_paid_accounts']['current']['id'];?></td>
            <td align="right"><?php echo $this->map['top_paid_accounts']['current']['igold'];?></td>
            </tr>
          
							
						<?php
							}
						}
					unset($this->map['top_paid_accounts']['current']);
					} ?>
          </table>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
	<input type="hidden" name="cmd" value="" id="cmd"/>
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
<div style="height:8px"></div>
</fieldset>
