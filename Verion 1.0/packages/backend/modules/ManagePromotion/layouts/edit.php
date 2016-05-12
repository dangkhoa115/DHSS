<fieldset id="toolbar">
 	<div id="toolbar-title">
		Khuyến mại <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <td id="toolbar-save"  align="center"><a onclick="EditManagePromotion.submit();"> <span title="Edit"> </span> [[.Save.]] </a> </td>
		  <td id="toolbar-cancel"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'list'));?>#"> <span title="New"> </span> [[.Cancel.]] </a> </td>
		</tr>
	  </tbody>
	</table>
  </div>
</fieldset>
<br clear="all">
<fieldset id="toolbar">
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
	<form name="EditManagePromotion" id="EditManagePromotion" method="post" enctype="multipart/form-data">
  <table border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td>Sản phẩm</td>
      <td><input name="item_id" type="hidden" id="item_id"><input name="item_name" type="text" id="item_name" style="width:400px;"> <input  type="button"  onclick="window.open('?page=manage_item&act=select_item');" value="Chọn sản phẩm" /></td>
    </tr>
    <tr valign="top">
      <td>Nội dung khuyến mại</td>
      <td><textarea name="description" id="description" rows="10" style="width:400px;"></textarea><script>advance_mce('description');</script></td>
    </tr>
    <tr>
      <td>Ngày bắt đầu</td>
      <td><input name="start_date" type="text" id="start_date" /> </td>
    </tr>
    <tr>
      <td>Ngày hết hạn</td>
      <td><input name="end_date" type="text" id="end_date" /> </td>
    </tr>
    <tr>
      <td>Cộng thêm vào giá</td>
      <td><input name="price" type="text" id="price" onchange="this.value = numberFormat(this.value);" /> 
        VND</td>
    </tr>
  </table>
	</form>
</fieldset>
<script>
	jQuery("#start_date").datepicker({minDate: new Date(),maxDate: '12m'});
	jQuery("#end_date").datepicker({minDate: new Date(),maxDate: '12m'});
</script>