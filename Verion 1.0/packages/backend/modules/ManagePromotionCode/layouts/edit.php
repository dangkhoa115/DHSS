<fieldset id="toolbar">
	<legend>[[.content_manage_system.]]</legend>
 	<div id="toolbar-title">
		[[.manage_promotion.]] <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <td id="toolbar-save"  align="center"><a onclick="EditManagePromotionCode.submit();"> <span title="Edit"> </span> [[.Save.]] </a> </td>
		  <td id="toolbar-cancel"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'list'));?>#"> <span title="New"> </span> [[.Cancel.]] </a> </td>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td>
		</tr>
	  </tbody>
	</table>
</fieldset>
<br clear="all">
<fieldset id="toolbar">
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
	<form name="EditManagePromotionCode" id="EditManagePromotionCode" method="post" enctype="multipart/form-data">
  <table border="0" cellspacing="0" cellpadding="5">
  	<!--IF:cond(Url::get('cmd')=='add')-->
    <tr>
      <td>Số lượng mã sinh</td>
      <td><input name="quantity" type="text" id="quantity" /></td>
    </tr>
    <!--/IF:cond-->
    <tr>
      <td>Khách hàng được nhận KM</td>
      <td><input name="value" type="text" id="value" /> VND</td>
    </tr>
    <tr>
      <td>Ngày bắt đầu</td>
      <td><input name="start_date" type="text" id="start_date" /> </td>
    </tr>
    <tr>
      <td>Ngày hết hạn</td>
      <td><input name="end_date" type="text" id="end_date" /> </td>
    </tr>
  </table>
	</form>
</fieldset>
<script>
	jQuery("#start_date").datepicker({minDate: new Date(),maxDate: '12m'});
	jQuery("#end_date").datepicker({minDate: new Date(),maxDate: '12m'});
</script>