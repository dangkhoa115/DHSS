<script>
	function check_selected()
	{
		var status = false;
		jQuery('form :checkbox').each(function(e){
			if(this.checked)
			{
				status = true;
			}
		});
		return status;
	}
	function make_cmd(cmd)
	{
		jQuery('#cmd').val(cmd);
		document.ManagePromotionCode.submit();
	}
</script>
<fieldset id="toolbar">
	<div id="toolbar-title">
		Quản lý mã khuyến mãi <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_delete(false,ANY_CATEGORY)){?><td id="toolbar-trash"  align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> Xóa </a> </td><?php }?>
		  <?php if(User::can_add(false,ANY_CATEGORY)){?><td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'add'));?>#"> <span title="New"> </span> [[.New.]] </a> </td><?php }?>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
    </div>
</fieldset>
<br>
<fieldset id="toolbar">
	<form name="ManagePromotionCode" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<a name="top_anchor"></a>
			<table cellpadding="0" cellspacing="6" width="100%">
				<tr>
					<td width="100%">
						Tìm kiếm:
						  <input name="search" type="text" id="search" size="30" style="font-weight:bold;">
                        <input type="submit" value="" />
                        <img src="skins/default/images/icon-search.png" width="20" onclick="document.ManagePromotionCode.submit();" align="top" style="cursor:pointer;" alt="Search">
					</td>
				</tr>
		</table>
		<table cellpadding="6" cellspacing="0" width="100%" border="0" class="manage-promotion-main">
		<thead>
					<tr class="table-header">
					  <th width="1%" title="[[.check_all.]]"> <input type="checkbox" value="1" id="ManagePromotionCode_all_checkbox" onclick="select_all_checkbox(this.form,'ManagePromotionCode',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?> /></th>
					  <th width="1%" align="left" nowrap><a>#</a></th>
					<th width="36%" align="left"><a>Mã</a></th>
					<th width="2%" align="left" nowrap>Giá trị KM</th>
                    <!--IF:cond(User::can_admin(false,ANY_CATEGORY))-->
					<!--/IF:cond-->
					<th width="2%" align="left" nowrap>Trạng thái</th>
					<th width="4%" align="left" nowrap><a>Ngày bắt đầu</a></th>
					<th width="4%" align="left" nowrap="nowrap"><a>Ngày hết hạn</a></th>
					<th width="2%" align="left" nowrap="nowrap"><a>[[.edit.]]</a></th>
					<!--IF:cond(User::can_admin(false,ANY_CATEGORY))-->
					<!--/IF:cond-->
					<?php if(User::can_edit(false,ANY_CATEGORY))
					{?>
					<?php }?>
				</tr>
		  </thead>
				<tbody>
				<!--LIST:items-->
				<tr bgcolor="<?php if((URL::get('just_edited_id',0)==[[=items.id=]]) or (is_numeric(array_search(MAP['items']['current']['id'],[[=just_edited_ids=]])))){ echo Portal::get_setting('crud_just_edited_item_bgcolor','#FFFFDD');} else {echo Portal::get_setting('crud_item_bgcolor','white');}?>" valign="middle" style=" <?php if([[=items.index=]]%2){echo 'background-color:#E8F1FF';}?>" id="ManagePromotionCode_tr_[[|items.id|]]">
				  <td width="1%"><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'ManagePromotionCode',this,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');" id="ManagePromotionCode_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?> /></td >
				  <th width="1%" align="left" nowrap><a>[[|items.index|]]</a></th>
					<td  align="left">[[|items.rand_code|]]</td>
					<td align="left" nowrap="nowrap" [[|items.passed_label_color|]]><?php echo System::display_number([[=items.value=]]);?> VND</td>
					<!--IF:cond(User::can_admin(false,ANY_CATEGORY))-->
					<!--/IF:cond-->
					<td align="left" nowrap [[|items.passed_label_color|]]>[[|items.passed_label|]]</td>
					<td align="left" nowrap>[[|items.start_date|]]</td>
					<td align="left" nowrap>[[|items.end_date|]]</td>
					<td width="2%" align="left" nowrap="nowrap"><a href="<?php echo Url::build_current(array('id'=>[[=items.id=]],'cmd'=>'edit'));?>"><img src="skins/default/images/buttons/edit.jpg" /></a></td>
					<!--IF:cond(User::can_admin(false,ANY_CATEGORY))-->
					<!--/IF:cond-->
					<?php if(User::can_edit(false,ANY_CATEGORY))
					{?>
					<?php }?>
				</tr>
				<!--/LIST:items-->
				</tbody>
	  </table>
		<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
			<tr>
			<td width="48%" align="left">&nbsp;</td>
			<td width="18%">Hiển thị <a></a>
			  <select name="item_per_page" class="select" style="width:50px" size="1" onchange="document.ManagePromotionCode.submit( );" id="item_per_page" ></select>
			  của&nbsp;[[|total|]]</td>
			<td width="31%">[[|paging|]]</td>
			<td width="3%">
				<a name="bottom_anchor" href="#top_anchor"><img src="skins/default/images/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a>		</td>
</tr></table>
			<table width="100%" class="table_page_setting">
	</table>
		<input type="hidden" name="cmd" value="" id="cmd">
  </form>
  <div style="#height:8px"></div>
</fieldset>