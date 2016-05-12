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
		document.FAQAdmin.submit();
	}
</script>
<fieldset id="toolbar">
	<legend>[[.content_manage_system.]]</legend>
	<div id="toolbar-title">
		[[.faq_admin.]] <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_add(false,ANY_CATEGORY)){?><td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'add'));?>#"> <span title="New"> </span> [[.New.]] </a> </td><?php }?>
  		  <?php if(User::can_delete(false,ANY_CATEGORY)){?><td id="toolbar-trash"  align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> [[.Trash.]] </a> </td><?php }?>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
	<form name="FAQAdmin" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<a name="top_anchor"></a>		
			<table cellpadding="0" cellspacing="6" width="100%">
				<tr>
					<td width="100%">
						[[.Filter.]]:
						<input name="search" type="text" id="search"  class="text_area">
						<button onclick="document.FAQAdmin.submit();">&nbsp;[[.Go.]]&nbsp;</button>
					</td>
					<td nowrap="nowrap">					
					<select name="author" id="author" class="inputbox" size="1" onchange="document.FAQAdmin.submit();"></select>	
					<select name="status" id="status" class="inputbox" size="1" onchange="document.FAQAdmin.submit();"></select>	
				  </td>
				</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td style="width:20%;" valign="top">
				<table cellpadding="5" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;background-color:#F0F0F0" border="1" bordercolor="#E7E7E7" align="center">
				<!--LIST:categories-->
				  <tr>
					<td><a  href="<?php echo Url::build_current(array('category_id'=>[[=categories.id=]]));?>">[[|categories.indent|]]
						[[|categories.indent_image|]]
						<span class="page_indent">&nbsp;</span>
						[[|categories.name|]]</a>
					</td>
				  </tr>
			  	<!--/LIST:categories-->
				</table>
			</td>
			<td style="width:80%" valign="top">
				<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
					<thead>
							<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
							<th width="1%" align="left" nowrap><a>#</a></th>
							<th width="1%" title="[[.check_all.]]">
							  <input type="checkbox" value="1" id="FAQAdmin_all_checkbox" onclick="select_all_checkbox(this.form,'FAQAdmin',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
							<th width="36%" align="left" nowrap><a>[[.name.]]</a></th>
							<th width="2%" align="left" nowrap><a>[[.status.]]</a></th>
							<th width="8%" align="left" nowrap><a>[[.positon.]]</a><img src="skins/default/images/cms/menu/filesave.png" onclick="jQuery('#cmd').val('update_position');document.FAQAdmin.submit();" style="cursor:pointer"></th>
							<th width="7%" align="left" nowrap><a>[[.user_id.]]</a></th>
							<th width="4%" align="left" nowrap><a>[[.date.]]</a></th>
							<th width="5%" align="left" nowrap><a>[[.hitcount.]]</a></th>
							<th width="4%" align="left" nowrap><a>[[.id.]]</a></th>
							<?php if(User::can_edit(false,ANY_CATEGORY))
							{?>
							<th width="2%" align="left" nowrap><a>[[.edit.]]</a></th>
							<?php }?>
						</tr>
				  </thead>
						<tbody>		
						<?php $i=0;$total = [[=total=]];?>
						<!--LIST:items-->	
						<tr bgcolor="<?php if((URL::get('just_edited_id',0)==[[=items.id=]]) or (is_numeric(array_search(MAP['items']['current']['id'],[[=just_edited_ids=]])))){ echo Portal::get_setting('crud_just_edited_item_bgcolor','#FFFFDD');} else {echo Portal::get_setting('crud_item_bgcolor','white');}?>" valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if($i%2){echo 'background-color:#F9F9F9';}?>" id="FAQAdmin_tr_[[|items.id|]]">
							<th width="1%" align="left" nowrap><a><?php echo ++$i;?></a></th>
							<td width="1%"><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'FAQAdmin',this,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');" id="FAQAdmin_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td>
							<td nowrap align="left">[[|items.name|]]</td>
							<td align="left" nowrap>[[|items.status|]]			  </td>
							<td align="left" nowrap><div style="width:40px;float:left"><?php if($i<$total){?><a><img src="skins/default/images/cms/menu/downarrow.png"></a><?php } if($i>1){?><a><img src="skins/default/images/cms/menu/uparrow.png"></a><?php }?></div><input name="position_[[|items.id|]]" type="text" id="position_[[|items.id|]]" style="width:40px;height:14px;" value="[[|items.position|]]"></td>
							<td align="left" nowrap>[[|items.user_id|]]</td>
							<td align="left" nowrap><?php echo date('h\h:i d/m/Y',[[=items.time=]]);?></td>
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
			</td>
		  </tr>
		</table>		
		<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
			<tr>
			<td width="20%" align="left">&nbsp;</td>
			<td align="left">[[.select.]]:&nbsp; <a onclick="select_all_checkbox(document.FAQAdmin,'FAQAdmin',true,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_all.]]</a>&nbsp; <a onclick="select_all_checkbox(document.FAQAdmin,'FAQAdmin',false,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_none.]]</a> <a onclick="select_all_checkbox(document.FAQAdmin,'FAQAdmin',-1,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_invert.]]</a>&nbsp;<a>[[.display.]]</a>
			  <select name="item_per_page" class="select" style="width:50px" size="1" onchange="document.FAQAdmin.submit( );" id="item_per_page" >
		      </select>			  &nbsp;[[.of.]]&nbsp;[[|total|]][[|paging|]]</td>
			</tr></table>
			<table width="100%" class="table_page_setting">
	</table>
		<input type="hidden" name="cmd" value="" id="cmd"/>
  </form>
  
</fieldset>