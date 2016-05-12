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
		document.NewsAdmin.submit();
	}
</script>
<fieldset id="toolbar">
	<div id="toolbar-title">
		Quản trị nội dung <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content">
	<table align="right">
	  <tbody>
		<tr>
		<td id="toolbar-move"  align="center"><a onclick="if(check_selected()){make_cmd('move')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}"> <span title="Move"> </span> [[.Move.]] </a> </td>
		 <?php if(User::can_edit(false,ANY_CATEGORY)){?> <td id="toolbar-copy"  align="center"><a onclick="if(check_selected()){make_cmd('copy')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}"> <span title="Copy"> </span> [[.Copy.]] </a> </td><?php }?>
		  <?php if(User::can_delete(false,ANY_CATEGORY)){?><td id="toolbar-trash"  align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> Xóa </a> </td><?php }?>
		  <?php if(User::can_add(false,ANY_CATEGORY)){?><td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'add'));?>#"> <span title="New"> </span> [[.New.]] </a> </td><?php }?>
		  
		</tr>
	  </tbody>
	</table>
  </div>
</fieldset>
<br>
<fieldset id="toolbar">
	<form name="NewsAdmin" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
  		<nav class="tab">
      	<ul>
        	<li<?php echo (!Session::get('doc_gia'))?' class="active"':''?>><a href="?page=news_admin&qtr=1">Quản trị viên</a></li>
          <li<?php echo (Session::get('doc_gia'))?' class="active"':''?>><a href="?page=news_admin&doc_gia=1">Độc giả</a></li>
        </ul>
      </nav>
			<table cellpadding="0" cellspacing="6" width="100%">
				<tr>
					<td width="100%">
						<input name="search" type="text" id="search" size="30" style="font-weight:bold;" placeholder="Nhập từ khóa"><input type="submit" value=" OK ">
					</td>
					<td nowrap="nowrap">
					<select name="category_id" class="inputbox"  id="category_id" size="1" onchange="document.NewsAdmin.submit();"></select>
					<select name="search_user_id" id="search_user_id" class="inputbox" size="1" onchange="document.NewsAdmin.submit();"></select>
					<select name="status" id="status" class="inputbox" size="1" onchange="document.NewsAdmin.submit();"></select>
				  </td>
				</tr>
		</table>
		<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
			<thead>
					<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
					<th width="1%" align="left" nowrap><a>#</a></th>
					<th width="1%" title="[[.check_all.]]">
					  <input type="checkbox" value="1" id="NewsAdmin_all_checkbox" onclick="select_all_checkbox(this.form,'NewsAdmin',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
					<th width="1%" title="[[.check_all.]]">&nbsp;</th>
					<th width="36%" align="left"><a>[[.name.]]</a></th>
					<th width="2%" align="center" nowrap>Duyệt</th>
					<th width="2%" align="left" nowrap><a>[[.status.]]</a></th>
					<th width="10%" align="left" nowrap><a>[[.positon.]]</a><img src="skins/default/images/cms/menu/filesave.png" onclick="jQuery('#cmd').val('update_position');document.NewsAdmin.submit();" style="cursor:pointer"></th>
					<th width="12%" align="left" nowrap><a>[[.category_name.]]</a></th>
					<th width="7%" align="left" nowrap><a>Acc</a></th>
					<th width="4%" align="left" nowrap><a>[[.date.]]</a></th>
					<th width="5%" align="left" nowrap><a href="<?php echo Url::build_current(array('category_id','page_no','status','search','order_by'=>'hitcount','dir'=>(Url::get('dir')=='DESC')?'ASC':'DESC'))?>">[[.hitcount.]]</a></th>
					<th width="4%" align="left" nowrap><a>[[.id.]]</a></th>
					<?php if(User::can_edit(false,ANY_CATEGORY))
					{?>
					<th width="2%" align="left" nowrap><a>[[.edit.]]</a></th>
					<?php }?>
				</tr>
		  </thead>
				<tbody>		
				<!--LIST:items-->	
				<tr bgcolor="<?php if((URL::get('just_edited_id',0)==[[=items.id=]]) or (is_numeric(array_search(MAP['items']['current']['id'],[[=just_edited_ids=]])))){ echo Portal::get_setting('crud_just_edited_item_bgcolor','#FFFFDD');} else {echo Portal::get_setting('crud_item_bgcolor','white');}?>" valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if([[=items.index=]]%2){echo 'background-color:#F9F9F9';}?>" id="NewsAdmin_tr_[[|items.id|]]">
					<th width="1%" align="left" nowrap><a>[[|items.index|]]</a></th>
					<td width="1%"><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'NewsAdmin',this,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');" id="NewsAdmin_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td >
					<td width="1%"><img src="[[|items.small_thumb_url|]]" width="50" /></td >
					<td  align="left"><a href="tin-tuc/[[|items.category_name_id|]]/[[|items.name_id|]].html" target="_blank"> [[|items.name|]]</a>&nbsp;&nbsp;<?php if([[=items.total_comment=]]>0){?><a  style="color:#FF0000" href="<?php echo Url::build('manage_comment',array('item_id'=>[[=items.id=]]));?>">[[[|items.total_comment|]]]</a><img src="skins/default/images/cms/comment.gif"><?php }?></td>
					<td align="center" nowrap>[[|items.publish|]] </td>
					<td align="left" nowrap>[[|items.status|]]			  </td>
					<td align="left" nowrap><input name="position_[[|items.id|]]" type="text" id="position_[[|items.id|]]" style="width:40px;height:14px;" value="[[|items.position|]]"></td>
					<td align="left" nowrap>[[|items.category_name|]]</td>
					<td align="left" nowrap>[[|items.user_id|]]</td>
					<td align="left" nowrap><?php echo date('H:i d/m/Y',[[=items.time=]]);?></td>
					<td align="left" nowrap>[[|items.hitcount|]]</td>
					<td align="left" nowrap>[[|items.id|]]</td>
					<?php if(User::can_edit(false,ANY_CATEGORY))
					{?>
					<td align="left" nowrap width="2%"><a href="<?php echo Url::build_current(array('id'=>[[=items.id=]],'cmd'=>'edit'));?>"><img src="skins/default/images/buttons/edit.jpg"></a></td>
					<?php }?>
				</tr>
				<!--/LIST:items-->
				</tbody>
	  </table>
		<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
			<tr>
			<td width="40%">&nbsp;<a>[[.display.]]</a>
			  <select name="item_per_page" class="select" style="width:50px" size="1" onchange="document.NewsAdmin.submit( );" id="item_per_page" ></select>&nbsp;[[.of.]]&nbsp;[[|total|]]</td>
			<td width="60%">[[|paging|]]</td>
			</tr></table>
			<table width="100%" class="table_page_setting">
	</table>
		<input type="hidden" name="cmd" value="" id="cmd">
  </form>
  <div style="#height:8px"></div>
</fieldset>