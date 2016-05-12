<fieldset id="toolbar">
	<legend><?php echo Portal::language('content_manage_system');?></legend>
	<div id="toolbar-title">
		<?php echo Portal::language(strtolower(Url::get('type')).'_category');?> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		<td id="toolbar-save"  align="center"><a onclick="EditCategoryForm.submit();" > <span title="save"> </span> <?php echo Portal::language('save');?> </a> </td>
		 <td id="toolbar-back"  align="center"><a href="<?php echo URL::build_current();?>"> <span title="Back"> </span> <?php echo Portal::language('Back');?> </a> </td>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> <?php echo Portal::language('Help');?> </a> </td>
		</tr>
	  </tbody>
	</table>
</fieldset>
<br>
<fieldset id="toolbar">
		<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
		<form name="EditCategoryForm" method="post" enctype="multipart/form-data" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<input type="hidden" name="confirm_edit" value="1" />
		<table cellspacing="4" cellpadding="4" border="0" width="100%" style="background-color:#FFFFFF;">
		<tr>
		  <td valign="top">
			<table  cellpadding="4" cellspacing="0" border="0" width="100%" style="background-color:#F9F9F9;border:1px solid #D5D5D5" align="center">
			<tr>
				<td>
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
					<div class="form_input_label"><?php echo Portal::language('name');?> (<span class="require">*</span>)</div>
					<div class="form_input">
						<input  name="name_<?php echo $this->map['languages']['current']['id'];?>" id="name_<?php echo $this->map['languages']['current']['id'];?>" style="width:50%"  type ="text" value="<?php echo String::html_normalize(URL::get('name_'.$this->map['languages']['current']['id']));?>">
					</div>
					<div class="form_input_label"><?php echo Portal::language('brief');?></div>
					<div class="form_input">
						<textarea id="brief_<?php echo $this->map['languages']['current']['id'];?>" name="brief_<?php echo $this->map['languages']['current']['id'];?>" cols="75" rows="20" style="width:99%; height:200px;overflow:hidden"><?php echo Url::get('brief_'.$this->map['languages']['current']['id'],'');?></textarea><br />
						<script>simple_mce('brief_<?php echo $this->map['languages']['current']['id'];?>');</script>	
					</div>
					<div class="form_input_label"><?php echo Portal::language('description');?></div>
					<div class="form_input">
						<textarea id="description_<?php echo $this->map['languages']['current']['id'];?>" name="description_<?php echo $this->map['languages']['current']['id'];?>" cols="75" rows="20" style="width:99%; height:350px;overflow:hidden"><?php echo Url::get('description_'.$this->map['languages']['current']['id'],'');?></textarea><br />
						<script>advance_mce('description_<?php echo $this->map['languages']['current']['id'];?>');</script>					
					</div>
				</div>
				
							
						<?php
							}
						}
					unset($this->map['languages']['current']);
					} ?>
				</div>
				</td>
			   </tr>
			</table>				
		</td>
		<td valign="top" style="width:320px;">
		<table width="100%" style="border: 1px dashed silver;" cellpadding="4" cellspacing="2">
				<tr>
					<td><strong><?php echo Portal::language('Status');?></strong></td>
					<td><?php echo Url::get('status','0');?></td>				
				</tr>				
				<tr>
					<td><strong><?php echo Portal::language('Total_item');?></strong></td>
					<td><?php echo Url::get('total_item','0');?></td>
				</tr>
				<tr>
					<td><strong><?php echo Portal::language('Created');?></strong></td>
					<td><?php echo date('h\h:i d/m/Y',Url::get('time',time()));?></td>					
				</tr>
				<tr>
					<td><strong><?php echo Portal::language('Modified');?></strong></td>
					<td><?php echo Url::get('last_time_update')?date('h\h:i d/m/Y',Url::get('last_time_update')):'Not modified';?></td>
				</tr>				
				</table>
		<div id="panel_1" style="margin-top:8px;">
			<span><?php echo Portal::language('Parameters_article');?></span>
			<table cellpadding="4" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9" style="margin-top:2px;">
				<tr>
				  <td>Title tùy chọn</td>
				  <td><input  name="site_title" id="site_title" class="input-large" type ="text" value="<?php echo String::html_normalize(URL::get('site_title'));?>"></td>
				  </tr>
				<tr>
					<td><?php echo Portal::language('parent_name');?></td>
					<td><select  name="parent_id" id="parent_id" class="select-large"><?php
					if(isset($this->map['parent_id_list']))
					{
						foreach($this->map['parent_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('parent_id').value = "<?php echo addslashes(URL::get('parent_id',isset($this->map['parent_id'])?$this->map['parent_id']:''));?>";</script>
	</select></td>				
				</tr>
				<tr>
					<td><?php echo Portal::language('type');?></td>
					<td><select  name="type" id="type"  onchange="jQuery('#extra_type').val(this.value)"  class="select-large"><?php
					if(isset($this->map['type_list']))
					{
						foreach($this->map['type_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('type').value = "<?php echo addslashes(URL::get('type',isset($this->map['type'])?$this->map['type']:''));?>";</script>
	</select></td>
				</tr>
				<tr>
					<td><?php echo Portal::language('url');?></td>
					<td><input  name="url" id="url" class="input-large" type ="text" value="<?php echo String::html_normalize(URL::get('url'));?>"></td>				
				</tr>
				<tr>
					<td><?php echo Portal::language('status');?></td>
					<td><select  name="status" id="status"  class="select"><?php
					if(isset($this->map['status_list']))
					{
						foreach($this->map['status_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('status').value = "<?php echo addslashes(URL::get('status',isset($this->map['status'])?$this->map['status']:''));?>";</script>
	</select></td>				
				</tr>
				<tr>
					<td valign="top"><?php echo Portal::language('icon_url');?></td>
					<td>
						<input  name="icon_url" id="icon_url" class="file" size="18" type ="file" value="<?php echo String::html_normalize(URL::get('icon_url'));?>"><div id="delete_icon_url"><?php if(Url::get('icon_url') and file_exists(Url::get('icon_url'))){?>[<a href="<?php echo Url::get('icon_url');?>" target="_blank" style="color:#FF0000"><?php echo Portal::language('view');?></a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','link'=>Url::get('icon_url')));?>" onclick="jQuery('#delete_icon_url').html('');" target="_blank" style="color:#FF0000"><?php echo Portal::language('delete');?></a>]<?php }?></div>					</td>				
				</tr>
			</table>
		  </div>
		</td>
		</tr>
		</table>
		<input  name="extra_type" id="extra_type" type ="hidden" value="<?php echo String::html_normalize(URL::get('extra_type'));?>">
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
</fieldset>