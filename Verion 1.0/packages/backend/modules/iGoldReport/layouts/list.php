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
				  <input name="search_account_id" type="text" id="search_account_id"  class="form-control" placeholder="Tài khoản"></div>
				<div style="float:left;">
				  <input name="from_date" type="text" id="from_date"  class="form-control" placeholder="Từ ngày" style="width:80px;"></div>
				<div style="float:left;">
				  <input name="to_date" type="text" id="to_date"  class="form-control" placeholder="Đến ngày" style="width:80px;"></div>
        <div style="float:left;"><input name="keyword" type="text" id="keyword" class="form-control" placeholder="Từ khóa"></div>
        <div style="float:left;">
				  <input name="from_value" type="text" id="from_value"  class="form-control" placeholder="Số iGold từ" style="width:80px;"><input name="to_value" type="text" id="to_value"  class="form-control" placeholder="đến iGold" style="width:80px;"></div>
				<div><input name="search" type="submit"  value="Tìm kiếm" id="search" class="btn btn-default"> <a href="?page=igold_report">Reset</a></div>
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
            <th width="7%" align="left"><a>[[.time.]]</a></th>
            </tr>
          <?php $i=0;?>
          <!--LIST:items-->
            <tr valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if($i%2){echo 'background-color:#F9F9F9';}?>" id="Category_tr_[[|items.id|]]">
            <td nowrap="nowrap">[[|items.account_id|]]</td>
            <td align="right" style="color:[[|items.color|]]"><?php echo [[=items.value=]];?></td>
            <td title="[[|items.description|]]"><?php echo String::display_sort_title([[=items.description=]],5);?></td>
            <td nowrap="nowrap"><?php echo date('d/m/Y H:i\'',[[=items.time=]]);?></td>
            </tr>
          <!--/LIST:items-->
          </table>
          <table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%;" align="center">
            <tr>
            <td width="30%">				
              <b>Tổng cộng</b>: [[|total|]] bản ghi</td>
            <td width="70%" colspan="1" align="right">&nbsp;[[|paging|]]</td>
            </tr>
          </table>
        </td>
        <td>
        	<div style="overflow:auto;height:300px;margin-bottom:10px;">
        	<h3>TOP giao dịch iGold trong ngày <input name="top_igold_date" type="text" id="top_igold_date"  class="form-control" placeholder="Chọn ngày" style="width:80px;" onChange="ListiGoldReportForm.submit();"></h3>
        	<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;" border="1" bordercolor="#E7E7E7" bgcolor="#FFF" align="center">
            <tr style="background-color:#95DCFF">
            <th width="14%" align="left"><a>Tài khoản</a></th>
            <th width="7%" align="center">iGold</th>
            <th width="30%" align="left">Diễn giải</th>
            <th width="5%" align="left"><a>[[.time.]]</a></th>
            </tr>
          <?php $i=0;?>
          <!--LIST:top_igolds-->
            <tr valign="middle" style="font-size:11px;">
            <td nowrap="nowrap">[[|top_igolds.account_id|]]</td>
            <td align="right" style="color:[[|top_igolds.color|]]"><?php echo [[=top_igolds.value=]];?></td>
            <td title="[[|top_igolds.description|]]"><?php echo String::display_sort_title([[=top_igolds.description=]],3);?></td>
            <td nowrap="nowrap"><?php echo date('d/m/Y H:i\'',[[=top_igolds.time=]]);?></td>
            </tr>
          <!--/LIST:top_igolds-->
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
          <!--LIST:top_accounts-->
            <tr valign="middle" style="font-size:11px;">
            <td nowrap="nowrap">[[|top_accounts.id|]]</td>
            <td align="right"><?php echo number_format([[=top_accounts.igold=]],0);?></td>
            </tr>
          <!--/LIST:top_accounts-->
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
          <!--LIST:top_paid_accounts-->
            <tr valign="middle" style="font-size:11px;">
            <td nowrap="nowrap">[[|top_paid_accounts.id|]]</td>
            <td align="right"><?php echo [[=top_paid_accounts.igold=]];?></td>
            </tr>
          <!--/LIST:top_paid_accounts-->
          </table>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
	<input type="hidden" name="cmd" value="" id="cmd"/>
</form>
<div style="height:8px"></div>
</fieldset>
