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
		document.ListManageAdvertismentForm.submit();
	}
</script>
<fieldset id="toolbar">
	<legend><?php echo Portal::language('content_manage_system');?></legend>
	<div id="toolbar-title"><?php echo Portal::language('manage_advertisment');?> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span></div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_delete(false,ANY_CATEGORY)){?><td id="toolbar-trash"  align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> <?php echo Portal::language('Trash');?> </a> </td><?php }?>
		  <?php if(User::can_add(false,ANY_CATEGORY)){?><td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'advertisment'));?>#"> <span title="New"> </span> <?php echo Portal::language('New');?> </a> </td><?php }?>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> <?php echo Portal::language('Help');?> </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
	<form name="ListManageAdvertismentForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<div>
		<?php if(Form::$current->is_error())
		{
		?>
			<strong>B&#225;o l&#7895;i</strong> 
			<?php echo Form::$current->error_messages();?>
			<?php
		}
		?>
		<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
		<thead>
			<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
				<th width="1%" title="<?php echo Portal::language('check_all');?>">
				<input type="checkbox" value="1" id="ManageAdvertisment_all_checkbox" onclick="select_all_checkbox(this.form,'ManageAdvertisment',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
				<th width="1%"  align="left" ><a><?php echo Portal::language('Edit');?></a></th>
				<th width="3%"  align="left" ><a><?php echo Portal::language('id');?></a></th>
				<th width="20%"  align="left"><a><?php echo Portal::language('name');?></a></th>
				<th width="4%"  align="left" nowrap="nowrap"><a><?php echo Portal::language('image_url');?></a></th>
				<th width="10%"  align="left"><a><?php echo Portal::language('region');?></a></th>
				<th width="10%" align="left"><a><?php echo Portal::language('category_id');?></a></th>
				<th width="5%" align="left"><a><?php echo Portal::language('position');?></a></th>
				<th width="10%" align="left"><a><?php echo Portal::language('start_time');?></a></th>
				<th width="10%" align="left"><a><?php echo Portal::language('end_time');?></a></th>
			</tr>
		  </thead>
			<tbody>
			<?php $i=0;?>
			<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
				<tr bgcolor="<?php if((URL::get('just_edited_id',0)==$this->map['items']['current']['id']) or (is_numeric(array_search($this->map['items']['current']['id'],$this->map['just_edited_ids'])))){ echo Portal::get_setting('crud_just_edited_item_bgcolor','#F7F7F7');} else {echo Portal::get_setting('crud_item_bgcolor','white');}?>" valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#F7F7F7'));?> style="cursor:hand;<?php if($i%2){echo 'background-color:#F9F9F9';}?>" id="ManageAdvertisment_tr_<?php echo $this->map['items']['current']['id'];?>">
					<td><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'ManageAdvertisment',this,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');" id="ManageAdvertisment_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td>
					<td><a href="<?php echo Url::build_current(array('cmd'=>'advertisment','id'=>$this->map['items']['current']['id']));?>"><img src="skins/default/images/buttons/edit.gif"></a></td>
					<td><?php echo $this->map['items']['current']['id'];?></td>
					<td><?php echo $this->map['items']['current']['name'];?></td>
					<td align="center">
					<?php 
					if(preg_match_all('/.swf/',$this->map['items']['current']['image_url'],$matches))
					{
						echo '<embed src="'.$this->map['items']['current']['image_url'].'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="60" height="50"></embed>';
					}
					else
					{
						echo '<img src="'.$this->map['items']['current']['image_url'].'" width="60" height="50" onerror="this.src=\'skins/default/images/no_image.gif\'">';
					}
					?>
					</td>
					<td><?php echo $this->map['items']['current']['region'];?></td>
					<td><?php echo $this->map['items']['current']['category_name'];?></td>
					<td><?php echo $this->map['items']['current']['position'];?></td>
					<td><?php echo date('h\h:i d-m-Y',$this->map['items']['current']['start_time']);?></td>
					<td><?php echo date('h\h:i d-m-Y',$this->map['items']['current']['end_time']);?></td>
				</tr>
				<?php $i++;?>
			
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
			</tbody>
		</table>		
		<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
		<tr>
			<td width="50%">
				<?php echo Portal::language('select');?>:&nbsp;
				<a onclick="select_all_checkbox(document.ListManageAdvertismentForm,'ManageAdvertisment',true,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"><?php echo Portal::language('select_all');?></a>&nbsp;| 
				<a onclick="select_all_checkbox(document.ListManageAdvertismentForm,'ManageAdvertisment',false,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"><?php echo Portal::language('select_none');?></a>|				<a onclick="select_all_checkbox(document.ListManageAdvertismentForm,'ManageAdvertisment',-1,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"><?php echo Portal::language('select_invert');?></a></td>
			<td width="50%"><?php echo $this->map['paging'];?></td>
		</tr>
		</table>
		<input type="hidden" name="cmd" value="" id="cmd"/>
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
	<div style="#height:8px"></div>
</fieldset>