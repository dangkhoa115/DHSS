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
		document.ListPrivilegeForm.submit();
	}
</script>
<fieldset id="toolbar">
	<legend><?php echo Portal::language('System_manage');?></legend>
	<div id="toolbar-info">
		<?php echo Portal::language('privilege');?> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		<?php if(User::can_admin()){?><td id="toolbar-config"  align="center"><a href="<?php echo URL::build_current(array('cmd'=>'make_cache'));?>"> <span title="<?php echo Portal::language('Cache');?>"> </span> <?php echo Portal::language('Cache');?> </a> </td><?php }?>
		  <?php if(User::can_add()){?><td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'add'));?>#"> <span title="New"> </span> <?php echo Portal::language('New');?> </a> </td><?php }?>
		  <?php if(User::can_delete()){?><td id="toolbar-trash"  align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> <?php echo Portal::language('Trash');?> </a> </td><?php }?>
		  <?php if(User::can_view()){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> <?php echo Portal::language('Help');?> </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<div style="height:8px;"></div>
<fieldset id="toolbar">
<a name="top_anchor"></a>
<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>	
<form name="ListPrivilegeForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
	<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
		<tr bgcolor="#EFEFEF" valign="top">		
				<th width="1%" title="<?php echo Portal::language('check_all');?>"><input type="checkbox" value="1" id="Privilege_all_checkbox" onclick="select_all_checkbox(this.form, 'Privilege',this.checked,'#FFFFEC','white');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
				<th nowrap align="left" >
					<a href="<?php echo URL::build_current(((URL::get('order_by')=='privilege.title_1' and URL::get('order_dir')!='desc')?array('order_dir'=>'desc'):array())+array('order_by'=>'privilege.title_1'));?>" title="<?php echo Portal::language('sort');?>">
					<?php if(URL::get('order_by')=='privilege.title_1') echo '<img src="'.Portal::template('core').'/images/buttons/'.((URL::get('order_dir')!='desc')?'down':'up').'_arrow.gif" alt="">';?>
					<?php echo Portal::language('title');?>					</a>				</th>
				<th nowrap align="left" ><a><?php echo Portal::language('function_name');?></a></th>
				<th nowrap align="left">
					<a href="<?php echo URL::build_current(((URL::get('order_by')=='package_id' and URL::get('order_dir')!='desc')?array('order_dir'=>'desc'):array())+array('order_by'=>'package_id'));?>" title="<?php echo Portal::language('sort');?>">
					<?php if(URL::get('order_by')=='package_id') echo '<img src="'.Portal::template('core').'/images/buttons/'.((URL::get('order_dir')!='desc')?'down':'up').'_arrow.gif" alt="">';?>
					<?php echo Portal::language('package_id');?>					</a>				</th>
				<?php if(User::can_edit())
				{
				?><th nowrap="nowrap" width="1%"><a><?php echo Portal::language('Edit');?></a></th>
				<th nowrap="nowrap" width="1%"><a><?php echo Portal::language('grant');?></a></th><?php
				}?>
			</tr>
			<?php $i=-1;?>
			<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
			<?php 
			$i++;
			$action = User::can_edit()?' onclick="location=\''.URL::build_current().'&cmd=edit&id='.$this->map['items']['current']['id'].'\';"':'';?>
			<tr <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if($i%2){echo 'background-color:#F9F9F9';}?>" id="Privilege_tr_<?php echo $this->map['items']['current']['id'];?>">
				<td><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'Privilege',this,'#FFFFEC','white');" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td>
				<td align="left" nowrap <?php echo $action;?>>
						<?php echo $this->map['items']['current']['title'];?>				</td>
				<td align="left" nowrap <?php echo $action;?>><?php echo $this->map['items']['current']['function_name'];?></td>
				<td nowrap align="left" <?php echo $action;?>>
				  <?php echo $this->map['items']['current']['package_id'];?>				</td>
				<?php 
				if(User::can_edit())
				{
				?>
				<td align="center">
					<a href="<?php echo Url::build_current(array('package_id'=>isset($_GET['package_id'])?$_GET['package_id']:'', 
)+array('cmd'=>'edit','id'=>$this->map['items']['current']['id'])); ?>"><img src="skins/default/images/buttons/edit.gif" alt="<?php echo Portal::language('Edit');?>" width="16" height="16" border="0"></a></td>
				<td align="center">
					<a href="<?php echo Url::build_current(array('package_id'=>isset($_GET['package_id'])?$_GET['package_id']:'')+array('cmd'=>'grant','id'=>$this->map['items']['current']['id'])); ?>"><img src="skins/default/images/buttons/generate_button.gif" alt="<?php echo Portal::language('Edit');?>" width="16" height="16" border="0"></a></td>
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
					<a onclick="select_all_checkbox(document.ListPrivilegeForm,'Privilege',true,'#FFFFEC','white');"><?php echo Portal::language('select_all');?></a>&nbsp;
					<a onclick="select_all_checkbox(document.ListPrivilegeForm,'Privilege',false,'#FFFFEC','white');"><?php echo Portal::language('select_none');?></a>
					<a onclick="select_all_checkbox(document.ListPrivilegeForm,'Privilege',-1,'#FFFFEC','white');"><?php echo Portal::language('select_invert');?></a>
				</td>
				<td align="right"><?php echo $this->map['paging'];?></td>
				<td align="right"></td>
			</tr>
  </table>		
		<input type="hidden" name="cmd" value="delete" id="cmd"/>
		<input type="hidden" name="page_no" value="1"/>
		<?php 
				if((URL::get('cmd')=='delete'))
				{?>
		<input type="hidden" name="confirm" value="1" />
		
				<?php
				}
				?>
		</td>
		</tr>
	</table>	
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
<div style="#height:8px"></div>
</fieldset>