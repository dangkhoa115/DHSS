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
		document.ManagePromotion.submit();
	}
</script>
<fieldset id="toolbar">
	<div id="toolbar-title">
		Quản lý khuyến mãi <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_delete(false,ANY_CATEGORY)){?><td id="toolbar-trash"  align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> Xóa </a> </td><?php }?>
		  <?php if(User::can_add(false,ANY_CATEGORY)){?><td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'add'));?>#"> <span title="New"> </span> Thêm mới </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
    </div>
</fieldset>
<br>
<fieldset id="toolbar">
	<form name="ManagePromotion" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<a name="top_anchor"></a>
			<table cellpadding="0" cellspacing="6" width="100%">
				<tr>
					<td width="100%">
						Tìm kiếm:
						  <input name="search" type="text" id="search" size="30" style="font-weight:bold;">
                        <input type="submit" value="" />
                        <img src="skins/default/images/icon-search.png" width="20" onclick="document.ManagePromotion.submit();" align="top" style="cursor:pointer;" alt="Search">
					</td>
				</tr>
		</table>
		<table cellpadding="6" cellspacing="0" width="100%" border="0" class="manage-promotion-main">
		<thead>
					<tr class="table-header">
					  <th width="50" align="center" title="[[.check_all.]]"> <input type="checkbox" value="1" id="ManagePromotion_all_checkbox" onclick="select_all_checkbox(this.form,'ManagePromotion',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?> /></th>
					  <th width="1%" align="left" nowrap><a>#</a></th>
					  <th width="20%" align="left" nowrap>Sản phẩm</th>
					<th width="50%" align="left" nowrap>Nội dung KM</th>
					<th width="2%" align="left" nowrap="nowrap">Cộng thêm vào giá</th>
					<th width="2%" align="left" nowrap>Trạng thái</th>
					<th width="4%" align="left" nowrap><a>Ngày bắt đầu</a></th>
					<th width="4%" align="left" nowrap="nowrap"><a>Ngày hết hạn</a></th>
          <!--IF:cond(User::can_admin(false,ANY_CATEGORY))-->
					<th width="1%" align="left" nowrap="nowrap">Sửa</th>
					<!--/IF:cond-->
				</tr>
		  </thead>
				<tbody>
				<!--LIST:items-->
				<tr bgcolor="<?php if((URL::get('just_edited_id',0)==[[=items.id=]]) or (is_numeric(array_search(MAP['items']['current']['id'],[[=just_edited_ids=]])))){ echo Portal::get_setting('crud_just_edited_item_bgcolor','#FFFFDD');} else {echo Portal::get_setting('crud_item_bgcolor','white');}?>" valign="middle" style=" <?php if([[=items.index=]]%2){echo 'background-color:#E8F1FF';}?>" id="ManagePromotion_tr_[[|items.id|]]">
				  <td width="50" align="center"><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'ManagePromotion',this,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');" id="ManagePromotion_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?> /></td >
				  <th width="1%" align="left" nowrap><a>[[|items.index|]]</a></th>
				  <td align="left" nowrap="nowrap" [[|items.passed_label_color|]]>[[|items.item_name|]]</td>
				  <td align="left" [[|items.passed_label_color|]]>[[|items.description|]]</td>
				  <td align="right" nowrap="nowrap" [[|items.passed_label_color|]]><strong><?php echo System::display_number([[=items.price=]]);?></strong> đ</td>
				  <td align="left" nowrap [[|items.passed_label_color|]]>[[|items.passed_label|]]</td>
					<td align="left" nowrap>[[|items.start_date|]]</td>
					<td align="left" nowrap>[[|items.end_date|]]</td>
          <!--IF:cond(User::can_admin(false,ANY_CATEGORY))-->
					<td width="1%" align="left" nowrap="nowrap"><a href="<?php echo Url::build_current(array('id'=>[[=items.id=]],'cmd'=>'edit'));?>"><img src="skins/default/images/buttons/edit.gif" /></a></td>
					<!--/IF:cond-->
				</tr>
				<!--/LIST:items-->
				</tbody>
	  </table>
		<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
			<tr>
			<td width="48%" align="left">&nbsp;</td>
			<td width="18%">Hiển thị <a></a>
			  <select name="item_per_page" class="select" style="width:50px" size="1" onchange="document.ManagePromotion.submit( );" id="item_per_page" ></select>
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