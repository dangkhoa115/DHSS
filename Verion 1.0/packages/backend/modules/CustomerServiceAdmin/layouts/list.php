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
		document.CustomerServiceAdmin.submit();
	}
</script>
<fieldset id="toolbar">
	<legend>[[.manage_zone.]]</legend>
	<div id="toolbar-title">
		[[.customer_service_admin.]] <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_delete(false,ANY_CATEGORY)){?><td id="toolbar-trash"  align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> [[.Trash.]] </a> </td><?php }?>
		  <?php if(User::can_add(false,ANY_CATEGORY)){?><td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'add'));?>#"> <span title="New"> </span> [[.New.]] </a> </td><?php }?>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
	<form name="CustomerServiceAdmin" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<a name="top_anchor"></a>		
			<table cellpadding="0" cellspacing="6" width="100%">
				<tr>
					<td width="100%">
						[[.Filter.]]:
						<input name="search" type="text" id="search"  class="text_area">
						<button onclick="document.CustomerServiceAdmin.submit();">&nbsp;[[.Go.]]&nbsp;</button>
					</td>
					<td nowrap="nowrap">
				  </td>
				</tr>
		</table>
		<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
			<thead>
					<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
					<th width="3%" align="left" nowrap><a>#</a></th>
					<th width="2%" title="[[.check_all.]]" align="center">
					  <input type="checkbox" value="1" id="CustomerServiceAdmin_all_checkbox" onclick="select_all_checkbox(this.form,'CustomerServiceAdmin',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th />
					<th width="28%" align="left" nowrap><a>[[.phone.]]</a></th>
					<th width="8%" align="left" nowrap><a>[[.brief.]]</a></th>
					<th width="7%" align="left" nowrap><a>[[.zone.]]</a></th>
					<th width="8%" align="left" nowrap>[[.type.]]</th>
					<th width="10%" align="left"><a>[[.image_url.]]</a></th>
					<th width="5%" align="left" nowrap><a>[[.id.]]</a></th>
					<?php if(User::can_edit(false,ANY_CATEGORY))
					{?>
					<th width="7%" align="left" nowrap><a>[[.edit.]]</a></th>
					<?php }?>
				</tr>
		  </thead>
				<tbody>		
				<?php $i=0;$total = [[=total=]];?>
				<!--LIST:items-->	
				<tr bgcolor="<?php if((URL::get('just_edited_id',0)==[[=items.id=]]) or (is_numeric(array_search(MAP['items']['current']['id'],[[=just_edited_ids=]])))){ echo Portal::get_setting('crud_just_edited_item_bgcolor','#FFFFDD');} else {echo Portal::get_setting('crud_item_bgcolor','white');}?>" valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if($i%2){echo 'background-color:#F9F9F9';}?>" id="CustomerServiceAdmin_tr_[[|items.id|]]">
					<th width="3%" align="left" nowrap><a><?php echo ++$i;?></a></th>
					<td width="2%" align="center"><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'CustomerServiceAdmin',this,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');" id="CustomerServiceAdmin_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td>
					<td align="left" nowrap>[[|items.phone|]]</td>
					<td align="left" nowrap>[[|items.brief|]]</td>
					<td align="left" nowrap>[[|items.zone_name|]]</td>
					<td align="left" nowrap><?php if([[=items.type=]]==0){echo Portal::language('service');}else{echo Portal::language('reservation');}?></td>
					<td align="center" width="50"><!--IF:cond([[=items.image_url=]] && file_exists([[=items.image_url=]]))--><img src="[[|items.image_url|]]" width="30"><!--/IF:cond--></td>
					<td align="left" nowrap>[[|items.id|]]</td>
					<?php if(User::can_edit(false,ANY_CATEGORY))
					{?>
					<td align="left" nowrap width="7%"><a href="<?php echo Url::build_current(array('id'=>[[=items.id=]],'cmd'=>'edit'));?>"><img src="skins/default/images/buttons/edit.jpg"></a></td>
					<?php }?>
				</tr>
				<!--/LIST:items-->
				</tbody>
	  </table>
		<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
		<tr>
			<td width="48%" align="left">
				[[.select.]]:&nbsp;
				<a onclick="select_all_checkbox(document.CustomerServiceAdmin,'CustomerServiceAdmin',true,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_all.]]</a>&nbsp;
				<a onclick="select_all_checkbox(document.CustomerServiceAdmin,'CustomerServiceAdmin',false,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_none.]]</a>
				<a onclick="select_all_checkbox(document.CustomerServiceAdmin,'CustomerServiceAdmin',-1,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_invert.]]</a>		</td>
			<td width="18%">&nbsp;<a>[[.display.]]</a>
			  <select name="item_per_page" class="select" style="width:50px" size="1" onchange="document.CustomerServiceAdmin.submit( );" id="item_per_page" ></select>&nbsp;[[.of.]]&nbsp;[[|total|]]</td>
			<td width="31%">[[|paging|]]</td>
			<td width="3%">
				<a name="bottom_anchor" href="#top_anchor"><img src="skins/default/images/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a>		</td>
		  </tr></table>
			<table width="100%" class="table_page_setting">
	</table>
		<input type="hidden" name="cmd" value="" id="cmd"/>
  </form>
  
</fieldset>