<span style="display:none">
	<span id="mi_privilege_module_sample">
		<div id="input_group_#xxxx#">
			<input  name="mi_privilege_module[#xxxx#][id]" type="hidden" id="id_#xxxx#">
			<span class="multi-input">
				<input type="text" name="mi_privilege_module[#xxxx#][module_name]"  class="input-large"  id="module_name_#xxxx#" />
			</span><span class="multi-input" style="width:60px;text-align:center">
					<input  type="checkbox" value="1" name="mi_privilege_module[#xxxx#][view]" id="view_#xxxx#">
			</span><span class="multi-input" style="width:60px;text-align:center">
					<input  type="checkbox" value="1" name="mi_privilege_module[#xxxx#][view_detail]" id="view_detail_#xxxx#">
			</span><span class="multi-input" style="width:60px;text-align:center">
					<input  type="checkbox" value="1" name="mi_privilege_module[#xxxx#][add]" id="add_#xxxx#">
			</span><span class="multi-input" style="width:60px;text-align:center">
					<input  type="checkbox" value="1" name="mi_privilege_module[#xxxx#][edit]" id="edit_#xxxx#">
			</span><span class="multi-input" style="width:60px;text-align:center">
					<input  type="checkbox" value="1" name="mi_privilege_module[#xxxx#][delete]" id="delete_#xxxx#">
			</span><span class="multi-input" style="width:80px;text-align:center">
					<input  type="checkbox" value="1" name="mi_privilege_module[#xxxx#][special]" id="special_#xxxx#">
			</span><span class="multi-input" style="width:80px;text-align:center">
					<input  type="checkbox" value="1" name="mi_privilege_module[#xxxx#][reserve]" id="reserve_#xxxx#">
			</span><span class="multi-input" style="width:80px;text-align:center">
					<input  type="checkbox" value="1" name="mi_privilege_module[#xxxx#][admin]" id="admin_#xxxx#"  onclick="select_all_column('#xxxx#');">
			</span>
			<span class="multi-input"><span style="width:20px;padding-left:5px;">
				<img src="skins/default/images/buttons/delete.gif" onClick="mi_delete_row(getId('input_group_#xxxx#'),'mi_privilege_module','#xxxx#');if(document.all)event.returnValue=false; else return false;" style="cursor:pointer;"/>
			</span></span><br clear="left">
		</div>
	</span>
</span>
<fieldset id="toolbar">
	<legend><?php echo Portal::language('System_manage');?></legend>
	<div id="toolbar-info">
		<?php echo Portal::language('privilege');?> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		 <?php if(User::can_edit()){?> <td id="toolbar-save"  align="center"><a onclick="GrantPrivilegeForm.submit();"> <span title="Save"> </span> <?php echo Portal::language('Save');?> </a> </td><?php }?>
		  <?php if(User::can_view()){?><td id="toolbar-back"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'list'));?>#"> <span title="<?php echo Portal::language('Back');?>"> </span> <?php echo Portal::language('Back');?> </a> </td><?php }?>
  		  <?php if(User::can_view()){?><td id="toolbar-list"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'list'));?>#"> <span title="<?php echo Portal::language('List');?>"> </span> <?php echo Portal::language('List');?> </a> </td><?php }?>
		 <?php if(User::can_view()){?> <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> <?php echo Portal::language('Help');?> </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<div style="height:8px;"></div>
<a name="top_anchor"></a>
<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>	
<form name="GrantPrivilegeForm" method="post"  action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
<input  name="deleted_ids" id="deleted_ids"/ type ="hidden" value="<?php echo String::html_normalize(URL::get('deleted_ids'));?>">
	<table width="100%">
<?php if(Form::$current->is_error())
	{
	?>
	<tr bgcolor="#EFEFEF" valign="top">
	<td bgcolor="#C8E1C3"><?php echo Form::$current->error_messages();?></td>
	</tr>
	<?php
	}
	?>
	<tr valign="top">
		<td>
		<strong><?php echo Portal::language('privilege_id');?></strong>	<select  name="id" id="id" onchange="location='<?php echo URL::build_current(array('cmd'));?>&id='+this.value;"><?php
					if(isset($this->map['id_list']))
					{
						foreach($this->map['id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('id').value = "<?php echo addslashes(URL::get('id',isset($this->map['id'])?$this->map['id']:''));?>";</script>
	</select>
		<br>
		<fieldset id="toolbar">
			<legend><?php echo Portal::language('multiple_item');?></legend>
					<span id="mi_privilege_module_all_elems">
					<span>
						<span class="multi-input-header"><span style="width:210px;float:left"><?php echo Portal::language('module_id');?></span></span>
						<span class="multi-input-header"><span style="width:65px;text-align:center;float:left"><a onclick="select_all_module('view');"><?php echo Portal::language('view');?></a></span></span>
						<span class="multi-input-header"><span style="width:60px;text-align:center;float:left"><a onclick="select_all_module('view_detail');"><?php echo Portal::language('detail');?></a></span></span>
						<span class="multi-input-header"><span style="width:65px;text-align:center;float:left"><a onclick="select_all_module('add');"><?php echo Portal::language('Add');?></a></span></span>
						<span class="multi-input-header"><span style="width:65px;text-align:center;float:left"><a onclick="select_all_module('edit');"><?php echo Portal::language('Edit');?></a></span></span>
						<span class="multi-input-header"><span style="width:65px;text-align:center;float:left"><a onclick="select_all_module('delete');"><?php echo Portal::language('Delete');?></a></span></span>
						<span class="multi-input-header"><span style="width:85px;text-align:center;float:left"><a onclick="select_all_module('special');"><?php echo Portal::language('Moderator');?></a></span></span>
						<span class="multi-input-header"><span style="width:85px;text-align:center;float:left"><a onclick="select_all_module('reserve');"><?php echo Portal::language('reserve');?></a></span></span>
						<span class="multi-input-header"><span style="width:85px;text-align:center;float:left"><a onclick="select_all_module('admin');"><?php echo Portal::language('admin');?></a></span></span>
						<span class="multi-input-header"><span style="width:20px;text-align:center;float:left"><img src="skins/default/images/spacer.gif"/></span></span>
						<br clear="all">
					</span>
				</span>
			<input type="button" value="  <?php echo Portal::language('Add');?>  " onclick="mi_add_new_row('mi_privilege_module');">
		</fieldset>
		</td>
	</tr>
	</table>
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
<script type="text/javascript">
mi_init_rows('mi_privilege_module',
	<?php if(isset($_REQUEST['mi_privilege_module']))
	{
		echo String::array2js($_REQUEST['mi_privilege_module']);
	}
	else
	{
		echo '{}';
	}
	?>
);
function select_all_module(action)
{
	if(typeof(all_forms['mi_privilege_module'])!='undefined')
	{
		var checked = -1;
		for(var i=0;i<all_forms['mi_privilege_module'].length;i++)
		{
			if(checked==-1)
			{
				checked = !getId(action+'_'+all_forms['mi_privilege_module'][i]).checked;
			}
			getId(action+'_'+all_forms['mi_privilege_module'][i]).checked=checked;
		}
	}
}
function select_all_column(index)
{
	$admin = getId('admin_'+index).checked;
	jQuery('#add_'+index).attr('checked',$admin);
	jQuery('#edit_'+index).attr('checked',$admin);
	jQuery('#delete_'+index).attr('checked',$admin);
	jQuery('#view_'+index).attr('checked',$admin);
	jQuery('#view_detail_'+index).attr('checked',$admin);
	jQuery('#special_'+index).attr('checked',$admin);
	jQuery('#reserve_'+index).attr('checked',$admin);
}
<?php 
				if((Url::get('id')))
				{?>
jQuery('#id').val(<?php echo Url::get('id');?>);

				<?php
				}
				?>
</script>
