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
		document.ListModeratorForm.submit();
	}
</script>
<fieldset id="toolbar">
	<legend><?php echo Portal::language('System_manage');?></legend>
	<div id="toolbar-info">
		<?php echo Portal::language('grant_privilege');?> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_add(false,ANY_CATEGORY)){?><td id="toolbar-config"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'cache'));?>#"> <span title="Cache"> </span> <?php echo Portal::language('Cache');?> </a> </td><?php }?>
		  <?php if(User::can_add(false,ANY_CATEGORY)){?><td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'grant'));?>#"> <span title="New"> </span> <?php echo Portal::language('New');?> </a> </td><?php }?>
		  <?php if(User::can_delete(false,ANY_CATEGORY)){?><td id="toolbar-trash"  align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> <?php echo Portal::language('Trash');?> </a> </td><?php }?>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> <?php echo Portal::language('Help');?> </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<div style="height:8px;"></div>
<fieldset id="toolbar">
<a name="top_anchor"></a>
<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>	
	<form name="ListModeratorForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<?php if(User::can_view(false,ANY_CATEGORY)){?>
		<?php echo Portal::language('user');?> <input  name="user_id" id="user_id" size="30"/ type ="text" value="<?php echo String::html_normalize(URL::get('user_id'));?>">&nbsp;<input type="submit" value="<?php echo Portal::language('go');?>" />
		<?php }?>
	<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
		<tr bgcolor="#EFEFEF" valign="top">		
			<th width="2%" title="<?php echo Portal::language('check_all');?>">
					<input type="checkbox" value="1" id="Moderator_all_checkbox" onclick="select_all_checkbox(this.form,'Moderator',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>>
				</th>				
				<th width="29%" title="<?php echo Portal::language('check_all');?>" align="left"><a><?php echo Portal::language('account_id');?></a></th>
				<th width="28%" align="left" nowrap><a><?php echo Portal::language('category_id');?></a></th>
		      <th width="23%" align="left" nowrap><a><?php echo Portal::language('grant');?></a></th>
		      <th width="16%" align="left" nowrap><a><?php echo Portal::language('portal_id');?></a></th>
			  <?php 
				if((User::can_admin(false,ANY_CATEGORY)))
				{?><th width="2%" title="<?php echo Portal::language('check_all');?>"><a><?php echo Portal::language('Edit');?></a></th>
				<?php
				}
				?>
			</tr>
			<?php $i = 0;?>
			<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
			<?php $i ++;?>
				<tr bgcolor="<?php if((URL::get('just_edited_id',0)==$this->map['items']['current']['id']) or (is_numeric(array_search($this->map['items']['current']['id'],$this->map['just_edited_ids'])))){ echo '#F7F7F7';} else {echo 'white';}?>" valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if($i%2){echo 'background-color:#F9F9F9';}?>" id="Moderator_tr_<?php echo $this->map['items']['current']['id'];?>">
					<td width="2%"><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'Moderator',this,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');" id="Moderator_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td />
				   <td width="29%"><?php echo $this->map['items']['current']['account_id'];?></td />
					<td width="28%" align="left"  nowrap><?php echo $this->map['items']['current']['category_name'];?></td>
		          <td width="23%" align="left"  nowrap><?php echo $this->map['items']['current']['title'];?></td>
	              <td width="16%" align="left"  nowrap><?php echo $this->map['items']['current']['portal_id'];?></td>
				 <?php 
				if((User::can_admin(false,ANY_CATEGORY)))
				{?><td width="2%"><a href="<?php echo Url::build_current(array('cmd'=>'grant','id'=>$this->map['items']['current']['id']));?>"><img src="skins/default/images/buttons/edit.jpg"></a></td />
				<?php
				}
				?>
				</tr>
			
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
		</table>		
	 <table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
		<tr>
			<td>
				<?php echo Portal::language('select');?>:&nbsp;
				<a onclick="select_all_checkbox(document.ListModeratorForm,'Moderator',true,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"><?php echo Portal::language('select_all');?></a>&nbsp;| 
				<a onclick="select_all_checkbox(document.ListModeratorForm,'Moderator',false,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"><?php echo Portal::language('select_none');?></a>
|				<a onclick="select_all_checkbox(document.ListModeratorForm,'Moderator',-1,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"><?php echo Portal::language('select_invert');?></a>
			</td>
			<td><?php echo $this->map['paging'];?></td>
			<td align="right">
				<a name="bottom_anchor" href="#top_anchor"><img alt="" src="skins/default/images/top.gif" title="<?php echo Portal::language('top');?>" border="0" alt="<?php echo Portal::language('top');?>"></a>
			</td>			
		</tr>
		</table>
		<input type="hidden" name="cmd" value="" id="cmd"/>
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
	<div style="#height:8px"></div>
</fieldset>