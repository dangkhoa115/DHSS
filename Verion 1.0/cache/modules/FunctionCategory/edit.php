<script src="skins/default/css/tabs/tabpane.js" type="text/javascript"></script>
<?php 
$title = (URL::get('cmd')=='edit')?Portal::language('function_edit'):Portal::language('function_add');
$action = (URL::get('cmd')=='edit')?'edit':'add';
System::set_page_title($title);?>
<table cellpadding="15" cellspacing="0" width="100%" border="0" bordercolor="#CCCCCC"  class="table-bound">
	<tr>
		<td width="100%" class="form-title"><?php echo $title;?></td>
		<td width="" align="right"><a class="button-medium-save" onclick="EditCategoryForm.submit();"><?php echo Portal::language('save');?></a></td>
        <td><a class="button-medium-back" onclick="location='<?php echo URL::build_current();?>';"><?php echo Portal::language('back');?></a></td>
		<?php if($action=='edit' and User::can_delete(false,ANY_CATEGORY)){?>
		<td><a class="button-medium-delete" onclick="location='<?php echo URL::build_current(array('cmd'=>'delete','id'));?>';"><?php echo Portal::language('Delete');?></a></td>
		<?php }?>
	</tr>
</table>
<table cellpadding="15" cellspacing="0" width="100%" border="0" bordercolor="#CCCCCC" class="table-bound">	
	<tr>
	<td style="width:100%" valign="top">
	<?php if(Form::$current->is_error())
	{
	?>
	<strong>B&#225;o l&#7895;i</strong><br>
	<?php echo Form::$current->error_messages();?><br>
	<?php
	}
	?>
	<form name="EditCategoryForm" method="post" enctype="multipart/form-data" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
	<input type="hidden" name="confirm_edit" value="1" />
	<table cellspacing="0" width="100%"><tr><td>
	<div class="tab-pane-1" id="tab-pane-category">
	<?php
					if(isset($this->map['languages']) and is_array($this->map['languages']))
					{
						foreach($this->map['languages'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['languages']['current'] = &$item1;?>
	<div class="tab-page" id="tab-page-category-<?php echo $this->map['languages']['current']['id'];?>">
	<h2 class="tab"><?php echo $this->map['languages']['current']['name'];?></h2>
	<div class="form_input_label"><?php echo Portal::language('name');?>:</div>
	<div class="form_input">
	<input  name="name_<?php echo $this->map['languages']['current']['id'];?>" id="name_<?php echo $this->map['languages']['current']['id'];?>" style="width:400"  type ="text" value="<?php echo String::html_normalize(URL::get('name_'.$this->map['languages']['current']['id']));?>">
	</div>
	<div class="form_input_label"><?php echo Portal::language('description');?>:</div>
	<div class="form_input">
	<textarea  name="description_<?php echo $this->map['languages']['current']['id'];?>" id="description_<?php echo $this->map['languages']['current']['id'];?>" style="width:100%" rows="10" ><?php echo String::html_normalize(URL::get('description_'.$this->map['languages']['current']['id'],''));?></textarea><br />
	</div>
	<div class="form_input_label"><?php echo Portal::language('group_name');?>:</div>
	<div class="form_input">
	<input  name="group_name_<?php echo $this->map['languages']['current']['id'];?>" id="group_name_<?php echo $this->map['languages']['current']['id'];?>" style="width:400"  type ="text" value="<?php echo String::html_normalize(URL::get('group_name_'.$this->map['languages']['current']['id']));?>">
	</div>
	</div>
	
							
						<?php
							}
						}
					unset($this->map['languages']['current']);
					} ?>
	</div>
	</td></tr></table>
	
	<div class="form_input_label"><?php echo Portal::language('parent_name');?>:</div>
	<div class="form_input">
	<select  name="parent_id" id="parent_id"><?php
					if(isset($this->map['parent_id_list']))
					{
						foreach($this->map['parent_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('parent_id').value = "<?php echo addslashes(URL::get('parent_id',isset($this->map['parent_id'])?$this->map['parent_id']:''));?>";</script>
	</select></div>
	<div class="form_input_label"><?php echo Portal::language('url');?>:</div>
	<div class="form_input">
	<input  name="url" id="url" style="width:400" type ="text" value="<?php echo String::html_normalize(URL::get('url'));?>">
	</div>
	<div class="form_input_label"><?php echo Portal::language('status');?>:</div>
	<div class="form_input">
	<select  name="status" id="status"><?php
					if(isset($this->map['status_list']))
					{
						foreach($this->map['status_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('status').value = "<?php echo addslashes(URL::get('status',isset($this->map['status'])?$this->map['status']:''));?>";</script>
	</select>
	</div><div class="form_input_label"><?php echo Portal::language('icon_url');?>:</div>
	<div class="form_input">
	<img style="padding:0 0 0 0" id="img_icon_url" src="<?php echo URL::get('icon_url')?URL::get('icon_url'):Portal::template('cms').'/images/spacer.gif';?>" height="100" width="120" border="0">
	<input  name="delete_icon_url" id="delete_icon_url" type ="hidden" value="<?php echo String::html_normalize(URL::get('delete_icon_url'));?>">
	<input name="icon_url" style="width:30px;border:0px solid white;" type="file" id="icon_url" onchange="$('img_icon_url').src='file:///'+this.value;" >
	</div>
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
	</td>
	<td valign="top">
	</td>
	</tr>
</table>
<script>
<?php 
				if(($this->map['parent_id']))
				{?>
jQuery('#parent_id').val(<?php echo $this->map['parent_id'];?>);

				<?php
				}
				?>
</script>