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
		document.ListAgentAdminForm.submit();
	}
</script>
<fieldset id="toolbar">
	<legend>[[.manage_profile.]]</legend>
	<div id="toolbar-personal">
		[[.Agent_admin.]] <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(Url::get('cmd')!='delete')
		  {?>
		  	<td id="toolbar-trash"  align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> [[.Trash.]] </a> </td>
			<?php }else{?>
				<td id="toolbar-trash"  align="center"><a onclick="if(check_selected()){make_cmd('delete')}"> <span title="Trash"> </span> [[.Trash.]] </a> </td>
			<?php }?>	
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
	<form method="post" name="SearchAgentAdminForm">
		<table>
			<tr>
				<td align="right" nowrap style="font-weight:bold">[[.user_name.]]</td>
				<td nowrap>
					<input name="user_id" type="text" id="user_id" style="width:300">
					<input type="submit" value="[[.search.]]">				
				</td>
			</tr>
		</table>
		<input type="hidden" name="page_no" value="1" />
	</form>
	<a name="top"></a>
	<form name="ListAgentAdminForm" method="post">
	<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
		<tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
			<th width="1%" title="[[.check_all.]]"><input type="checkbox" value="1" id="AgentAdmin_all_checkbox" onclick="select_all_checkbox(this.form, 'AgentAdmin',this.checked,'#FFFFEC','white');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
			<th nowrap align="left" ><a>[[.user_name.]]</a></th>
				<th nowrap align="left" ><a>[[.full_name.]]</a></th>
				<th nowrap align="left" ><a>[[.email.]]</a></th>
				<th nowrap align="left" ><a>[[.join_date.]]</a></th>
				<th nowrap align="left" ><a>[[.zone.]]</a></th>
		        <th nowrap align="left" width="1%"><a>[[.active.]]</a></th>
                <th nowrap align="left" width="1%"><a>[[.edit.]]</a></th>
		</tr>
		<?php $i = 1;?>
		<!--LIST:items-->
		<?php $i++;?>
		<tr bgcolor="<?php if((URL::get('just_edited_id',0)==[[=items.id=]]) or (is_numeric(array_search(MAP['items']['current']['id'],MAP['just_edited_ids'])))){ echo 'white';} else {echo 'white';}?>" valign="middle" <?php Draw::hover('#FFFFDD');?> style="cursor:hand;<?php if($i%2){echo 'background-color:#F9F9F9';}?>" id="AgentAdmin_tr_[[|items.id|]]">
			<td><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'AgentAdmin',this,'#FFFFEC','white');" id="AgentAdmin_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td>
			<td nowrap align="left" onclick="location='<?php echo URL::build_current();?>&cmd=edit&id=[[|items.id|]]';">
					[[|items.id|]]			</td>
			<td nowrap align="left" onclick="location='<?php echo URL::build_current();?>&cmd=edit&id=[[|items.id|]]';">[[|items.full_name|]]</td>
			<td nowrap align="left" onclick="location='<?php echo URL::build_current();?>&cmd=edit&id=[[|items.id|]]';">
					[[|items.email|]]			</td>
			<td nowrap align="left" onclick="location='<?php echo URL::build_current();?>&cmd=edit&id=[[|items.id|]]';">
					[[|items.create_date|]]			</td>
			<td align="left" nowrap onclick="location='<?php echo URL::build_current();?>&cmd=edit&id=[[|items.id|]]';">
					[[|items.zone_name|]]			</td>	
		    <td align="left"><input type="checkbox" name="is_active" id="is_active" <?php if([[=items.is_active=]]){?>checked="checked"<?php }?> onclick="window.location='<?php echo Url::build_current(array('account_id'=>[[=items.id=]],'cmd'=>'active'));?>';" /></td>
			<td nowrap align="left"><a href="<?php echo URL::build_current(array('cmd'=>'edit','id'=>[[=items.id=]]));?>"><img src="skins/default/images/buttons/edit.gif" /></a></td>
		</tr>
		<!--/LIST:items-->
	  </table>		
		<table  width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;#width:99%" align="center">
			<tr>
				<td width="73%">
					[[.select.]]:&nbsp;
					<a onclick="select_all_checkbox(document.ListAgentAdminForm,'AgentAdmin',true,'#FFFFEC','white');">[[.select_all.]]</a>&nbsp;
					<a onclick="select_all_checkbox(document.ListAgentAdminForm,'AgentAdmin',false,'#FFFFEC','white');">[[.select_none.]]</a>
					<a onclick="select_all_checkbox(document.ListAgentAdminForm,'AgentAdmin',-1,'#FFFFEC','white');">[[.select_invert.]]</a>				</td>
				<td width="12%">[[|paging|]]</td>
				<td width="15%" align="right">
					<a name="bottom_anchor" href="<?php echo Url::build_current();?>#top"><img src="skins/default/images/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a>				
				</td>
			</tr>
		</table>
		<input type="hidden" name="cmd" value="delete"/>
		<input type="hidden" name="page_no" value="1"/>
		<!--IF:delete(URL::get('cmd')=='delete')-->
		<input type="hidden" name="confirm" value="1" />
		<!--/IF:delete-->
</form>

</fieldset>