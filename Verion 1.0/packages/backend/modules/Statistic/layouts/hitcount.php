<fieldset id="toolbar">
	<div id="toolbar-info">Thống kê lượt xem</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		 	<td>
      <form name="HitcountForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
        Từ ngày <input name="date_from" type="text" id="date_from" style="width:80px;">
        Đến ngày <input name="date_to" type="text" id="date_to" style="width:80px;">
        <select name="search_user_id" id="search_user_id" class="inputbox" size="1" onchange="document.HitcountForm.submit();"></select>
        (<?php echo System::display_number([[=total_hitcount=]]);?> lượt xem / <?php echo System::display_number([[=total=]]);?> tin bài - TB <?php echo [[=total=]]?System::display_number([[=total_hitcount=]]/[[=total=]]):'';?> lượt xem/bài)
        <input type="submit" value="">
      </form>
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
  <!--LIST:items-->
  <tr <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if([[=items.indexs=]]%2){echo 'background-color:#F9F9F9';}?>">
	<td>[[|items.indexs|]]</td>
	<td>[[|items.name|]]</td>
	<td>[[|items.category_name|]]</td>
	<td><?php echo date('H:i\' d/m/Y',[[=items.time=]])?></td>
	<td align="center">[[|items.user_id|]]</td>
	<td align="right">[[|items.hitcount|]]</td>
	</tr>
  <!--/LIST:items-->
 </table> 	
 <table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
<tr>
	<td align="right" width="1%">&nbsp;</td>
	<td align="right">[[|paging|]]</td>
</tr>
</table>
</fieldset>
<script>
jQuery(document).ready(function(){
	jQuery('#date_from').datepicker();
	jQuery('#date_to').datepicker();
});

</script>