<fieldset id="toolbar">
	<div id="toolbar-info">Báo cáo định mức hàng tháng <?php echo Url::get('month')?></div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		 	<td>
      <form name="ReportForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
       Tháng <select name="month" id="month"></select>
       Năm <select name="year" id="year"></select>
        <input type="submit" value="OK">
      </form>
      </td>
	  </tbody>
	</table>
	</div>
</fieldset>
<fieldset id="toolbar">
	<table width="100%" border="1" cellspacing="0" cellpadding="5">
  <tbody>
  	<!--LIST:reports-->
    <tr <?php echo ([[=reports.id=]]=='label')?'style="font-weight:bold;background:#DDD;"':'';?>>
      <td>[[|reports.name|]]</td>
      <!--LIST:dates-->
      <td><?php echo $this->map['reports']['current'][[[=dates.id=]]];?></td>
      <!--/LIST:dates-->
    </tr>
    <!--/LIST:reports-->
  </tbody>
</table>

</fieldset>
<script>
jQuery(document).ready(function(){
	jQuery('#date_from').datepicker();
	jQuery('#date_to').datepicker();
});

</script>