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
		document.ListCategoryForm.submit();
	}
</script>
<form method="post" name="SearchCategoryForm" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
<fieldset id="toolbar">
	<legend><?php echo Portal::language('content_manage_system');?></legend>
	<div id="toolbar-title">
		<?php echo Portal::language(strtolower(Url::get('type')).'_category');?> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		<?php 
		if(URL::get('cmd')=='delete' and User::can_delete(false,ANY_CATEGORY)){?> 
		 	<td id="toolbar-trash"  align="center"><a onclick="$('cmd').cmd='delete';ListCategoryForm.submit();" > <span title="Trash"> </span> <?php echo Portal::language('Trash');?> </a> </td>
			<td id="toolbar-back"  align="center"><a href="<?php echo URL::build_current();?>"> <span title="Back"> </span> <?php echo Portal::language('Back');?> </a> </td>
		<?php 
		}else{ 
		if(User::can_add(false,ANY_CATEGORY)){?>
				<td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'add'));?>#"> <span title="New"> </span> <?php echo Portal::language('New');?> </a> </td>
			<?php }?>
		<?php if(User::can_delete(false,ANY_CATEGORY)){?>
		 <td id="toolbar-trash"  align="center"><a  onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> <?php echo Portal::language('Trash');?> </a> </td>
		<?php }
		}?>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current(array('cmd'=>'export_cache'));?>#"> <span title="Help"> </span> Tạo menu </a> </td>
		</tr>
	  </tbody>
	</table>
  </div>
</fieldset>
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
				
<br>
<fieldset id="toolbar">
	<form name="ListCategoryForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<a name="top_anchor"></a>		
		<table cellpadding="4" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
		<thead>
				<tr valign="middle" bgcolor="<?php echo Portal::get_setting('crud_list_item_bgcolor','#F0F0F0');?>" style="line-height:20px">
				<th width="1%" title="<?php echo Portal::language('check_all');?>">
					<input type="checkbox" value="1" id="Category_all_checkbox" onclick="select_all_checkbox(this.form,'Category',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th />
				<th nowrap align="left">
					<a title="<?php echo Portal::language('sort');?>" href="<?php echo URL::build_current(((URL::get('order_by')=='category.name_'.Portal::language() and URL::get('order_dir')!='desc')?array('order_dir'=>'desc'):array())+array('order_by'=>'category.name_'.Portal::language()));?>" >
					<?php if(URL::get('order_by')=='category.name_'.Portal::language()) echo '<img alt="" src="skins/default/images/buttons/'.((URL::get('order_dir')!='desc')?'down':'up').'_arrow.gif">';?>
					<?php echo Portal::language('name');?>					</a>				</th>
				<?php 
				if((Url::sget('page')=='portal_category'))
				{?><th nowrap align="left"><a><?php echo Portal::language('type');?></a></th>
				<?php
				}
				?>
				<th nowrap align="left">
					<a href="<?php echo URL::build_current(((URL::get('order_by')=='category.status' and URL::get('order_dir')!='desc')?array('order_dir'=>'desc'):array())+array('order_by'=>'category.status'));?>" title="<?php echo Portal::language('sort');?>">
					<?php if(URL::get('order_by')=='category.status') echo '<img alt="" src="skins/default/images/buttons/'.((URL::get('order_dir')!='desc')?'down':'up').'_arrow.gif">';?>
					<?php echo Portal::language('status');?>					</a>				</th>
				<?php if(User::can_edit(false,ANY_CATEGORY))
				{?>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<?php }?>
			</tr>
			</thead>
			<tbody>
			<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
			<?php $onclick = 'location=\''.URL::build_current().'&cmd=edit&id='.urlencode($this->map['items']['current']['id']).'\';"';?>
			<tr bgcolor="<?php if((URL::get('just_edited_id',0)==$this->map['items']['current']['id']) or (is_numeric(array_search($this->map['items']['current']['id'],$this->map['just_edited_ids'])))){ echo '#F7F7F7';} else {echo 'white';}?>" valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if($this->map['items']['current']['i']%2){echo 'background-color:#F9F9F9';}?>" id="Category_tr_<?php echo $this->map['items']['current']['id'];?>">
				<td><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'Category',this,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');" id="Category_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td />
				<td align="left" nowrap onclick="window.location='<?php echo Url::build_current().'&cmd=edit&id='.$this->map['items']['current']['id'];?>'" <?php if(User::can_edit(false,ANY_CATEGORY)){?> <?php }?>>
						<?php echo $this->map['items']['current']['indent'];?>
						<?php echo $this->map['items']['current']['indent_image'];?>
						<span class="page_indent">&nbsp;</span>
						<?php echo $this->map['items']['current']['name'];?></td>
				<?php 
				if((Url::sget('page')=='portal_category'))
				{?><td><?php echo $this->map['items']['current']['type'];?></td>
				<?php
				}
				?>
				<td nowrap align="left">
						<?php echo $this->map['items']['current']['status'];?>					</td>
				<?php if(User::can_edit(false,ANY_CATEGORY))
				{?><td width="24px" align="center"><?php echo $this->map['items']['current']['move_up'];?></td>
				<td width="24px" align="center"><?php echo $this->map['items']['current']['move_down'];?></td>
				<?php }?>
			</tr>
			
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
			</tbody>
		</table>
		<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
		<tr>
			<td align="left">
			<?php echo Portal::language('select');?>:&nbsp;
			<a onclick="select_all_checkbox(document.ListCategoryForm,'Category',true,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"><?php echo Portal::language('select_all');?></a>&nbsp;
			<a onclick="select_all_checkbox(document.ListCategoryForm,'Category',false,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"><?php echo Portal::language('select_none');?></a>
			<a onclick="select_all_checkbox(document.ListCategoryForm,'Category',-1,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"><?php echo Portal::language('select_invert');?></a>
			</td>
		</tr>
		</table>				
		<table width="100%" class="table_page_setting">
		</table>
		<input type="hidden" name="cmd" value="" id="cmd"/>
		<?php 
				if((URL::get('cmd')=='delete'))
				{?>
		<input type="hidden" name="confirm" value="1" />
			
				<?php
				}
				?>
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
		
</fieldset>