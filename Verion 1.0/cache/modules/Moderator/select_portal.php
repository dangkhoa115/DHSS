<script>
var data = <?php echo String::array2suggest($this->map['users']);?>;	
jQuery(document).ready(function(){
	jQuery("#account_id").autocomplete(data,{
		minChars: 0,
		width: 145,
		matchContains: true,
		autoFill: false,
		formatItem: function(row, i, max) {
			return '<span style="color:#FFFFFF"> ' + row.name + '</span>';
		},
		formatMatch: function(row, i, max) {
			return row.id + ' ' + row.name;
		},
		formatResult: function(row) {			
			return row.id;
		}
	});
});
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
		  <?php if(User::can_edit(false,ANY_CATEGORY)){?> <td id="toolbar-save"  align="center"><a onclick="GrantPrivilege.submit();"> <span title="Save"> </span> <?php echo Portal::language('Save');?> </a> </td><?php }?>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?> <td id="toolbar-list"  align="center"><a href="<?php echo Url::build_current();?>#"> <span title="<?php echo Portal::language('List');?>"> </span> <?php echo Portal::language('List');?> </a> </td><?php }?>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> <?php echo Portal::language('Help');?> </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<div style="height:8px;"></div>
<fieldset id="toolbar">
<a name="top_anchor"></a>
<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>	
<form name="GrantPrivilege" method="post">
<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
	<tr bgcolor="#EFEFEF" valign="top">		
    <th width="16%" align="left"><a><?php echo Portal::language('portal_id');?></a></th>
    <th width="17%"  align="left"><a><?php echo Portal::language('account_id');?></a></th>
    <th width="26%"  align="left"><a><?php echo Portal::language('Grant');?></a></th>
    <th width="26%"  align="left"><a><?php echo Portal::language('category');?></a></th>
  </tr>
  <tr style="padding:10px">
    <td width="16%" valign="top"><input  name="portal_id" id="portal_id" size="20" readonly/ type ="text" value="<?php echo String::html_normalize(URL::get('portal_id'));?>"></td>
    <td width="17%" valign="top"><input  name="account_id" id="account_id" size="20" type ="text" value="<?php echo String::html_normalize(URL::get('account_id'));?>"></td>    
    <td width="26%" valign="top">    
		<?php
					if(isset($this->map['privilege']) and is_array($this->map['privilege']))
					{
						foreach($this->map['privilege'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['privilege']['current'] = &$item1;?>
			<div style="line-height:20px;">
				<div style="float:left"><input name="privilege_id[]" type="checkbox" value="<?php echo $this->map['privilege']['current']['id'];?>" id="privilege_id_<?php echo $this->map['privilege']['current']['id'];?>"></div>				
				<div>&nbsp;<?php echo $this->map['privilege']['current']['title'];?></div>
			</div>
			<div style="clear:both"></div>
		
							
						<?php
							}
						}
					unset($this->map['privilege']['current']);
					} ?>
		<script>
			<?php if(Url::get('privilege_id')){?>
				jQuery('#privilege_id_<?php echo Url::get('privilege_id');?>').attr('checked', true);
			<?php }?>
		</script>
     </td>
	 <td valign="top">
       <select  name="categories[]" <?php if(!URL::get('id')) echo ' size="20" multiple="multiple"';?> style="width:300px;overflow:auto" id="categories[]"><?php
					if(isset($this->map['categories[]_list']))
					{
						foreach($this->map['categories[]_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('categories[]').value = "<?php echo addslashes(URL::get('categories[]',isset($this->map['categories[]'])?$this->map['categories[]']:''));?>";</script>
	</select>
	</td>
  </tr>
</table>
 <table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">	
 	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
</fieldset>