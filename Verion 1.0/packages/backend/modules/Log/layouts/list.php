<script>
	function check_selected()
	{
		var status = false;
		jQuery('form :checkbox').each(function(e){
			if(this.checked && this.id=='ListLogForm_checkbox')
			{
				status = true;
			}
		});	
		return status;
	}
	function make_cmd(cmd)
	{
		jQuery('#cmd').val(cmd);
		document.ListLogForm.submit();
	}
</script>
<script>	
	jQuery(document).ready(function(){
		jQuery('#from_date').datepicker({ yearRange: '2008:2020' });
		jQuery('#to_date').datepicker({ yearRange: '2008:2020' });
	});	
</script>
<fieldset id="toolbar">
	<legend>[[.utils.]]</legend>
	<div id="toolbar-title">[[.manage_log.]]</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_delete(false,ANY_CATEGORY)){?><td id="toolbar-cancel"  align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> [[.Delete.]] </a> </td><?php }?>

			<td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
<form name="ListLogForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">	
<table cellpadding="0" cellspacing="6" width="100%">
		<tr>
			<td width="100%">
				<div style="float:left;padding-top:1px;">[[.from_date.]] : <input name="from_date" type="text" id="from_date"  class="input" style="height:20px;">&nbsp;</div>
				<div style="float:left;padding-top:1px;">[[.to_date.]] : <input name="to_date" type="text" id="to_date"  class="input" style="height:20px;">&nbsp;</div>
        <div style="float:left;padding-top:1px;">Từ khóa: <input name="keyword" type="text" id="keyword"  class="input" style="height:20px;">&nbsp;</div>
				<div><input name="search" type="submit"  value="[[.search.]]" id="search" class="button"></div>
			</td>
		</tr>
	</table>
	<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
	  <tr style="background-color:#F0F0F0">
		<th width="2%" align="center"><input type="checkbox" value="1" id="ListLogForm_all_checkbox" onclick="select_all_checkbox(this.form,'ListLogForm',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
		<th width="14%" align="left"><a>[[.title.]]</a></th>
		<th width="40%" align="left"><a>[[.description.]]</a></th>
		<th width="11%" align="left"><a>[[.module_id.]]</a></th>
		<th width="10%" align="left"><a>[[.user_id.]]</a></th>
		<th width="8%"  align="left"><a>[[.type.]]</a></th>
		<th width="7%" align="left"><a>[[.param.]]</a></th>
	    <th width="7%" align="left"><a>[[.time.]]</a></th>
	  </tr>
	<?php $i=0;?>
	<!--LIST:items-->
	  <tr valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if($i%2){echo 'background-color:#F9F9F9';}?>" id="Category_tr_[[|items.id|]]">
		<td><?php $i++;?>
		<input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'ListLog',this,'#FFFFEC','white');" id="ListLogForm_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td>
		<td nowrap="nowrap">[[|items.title|]]</td>
		<td>[[|items.description|]]</td>
		<td>[[|items.module_id|]]</td>		
		<td>[[|items.user_id|]]</td>
		<td>[[|items.type|]]</td>
		<td>[[|items.parameter|]]</td>
	    <td nowrap="nowrap"><?php echo date('d/m/Y H:i',[[=items.time=]]);?></td>
	  </tr>
	<!--/LIST:items-->
	</table>
	<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%;" align="center">
	  <tr>
		<td width="70%">				
			<b>[[.select.]]</b>:&nbsp;
			<a onclick="select_all_checkbox(document.ListLogForm,'ListLogForm',true,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_all.]]</a> |&nbsp;
			<a onclick="select_all_checkbox(document.ListLogForm,'ListLogForm',false,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_none.]]</a>
			| <a onclick="select_all_checkbox(document.ListLogForm,'ListLogForm',-1,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_invert.]]</a>
			&nbsp;&nbsp;<b>[[.total.]]</b>:[[|total|]]  [[.items.]]			</td>
		<td width="30%" colspan="1" align="right">&nbsp;[[|paging|]]</td>
	  </tr>
	</table>
	<input type="hidden" name="cmd" value="" id="cmd"/>
</form>
<div style="height:8px"></div>
</fieldset>
