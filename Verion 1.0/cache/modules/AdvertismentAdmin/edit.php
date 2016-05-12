<script src="skins/default/css/tabs/tabpane.js" type="text/javascript"></script>
<fieldset id="toolbar">
	<legend><?php echo Portal::language('content_manage_system');?></legend>
 	<div id="toolbar-title">
		<?php echo Portal::language('advertisment_admin');?> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <td id="toolbar-preview"  align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Move"> </span> <?php echo Portal::language('Preview');?> </a> </td>
		  <td id="toolbar-save"  align="center"><a onclick="EditAdvertismentAdmin.submit();"> <span title="Save"> </span> <?php echo Portal::language('Save');?> </a> </td>
		  <td id="toolbar-cancel"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'list'));?>#"> <span title="New"> </span> <?php echo Portal::language('Cancel');?> </a> </td>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> <?php echo Portal::language('Help');?> </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
 </fieldset>
  <br clear="all">
<fieldset id="toolbar">
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
	<form name="EditAdvertismentAdmin" id="EditAdvertismentAdmin" method="post" enctype="multipart/form-data">
	<table  cellpadding="2" cellspacing="0" border="0" width="100%" align="center" style="margin-top:5px;">
		<tr>
			<td valign="top" width="320">
					<table width="100%" style="border: 1px dashed silver;margin-top:-2px;" cellpadding="4" cellspacing="2">
					<tr>
					  <td><?php echo Portal::language('Rating');?></td>
					  <td><?php echo Url::get('rating','0');?></td>
					  </tr>
					<tr>
						<td><?php echo Portal::language('Hitcount');?></td>
						<td><?php echo Url::get('hitcount','0');?></td>
					</tr>
					<tr>
						<td><?php echo Portal::language('Created');?></td>
						<td><?php echo date('hh:i d/m/Y',Url::get('time',time()));?></td>					
					</tr>
					<tr>
						<td><?php echo Portal::language('Modified');?></td>
						<td><?php echo Url::get('last_time_update')?date('hh:i d/m/Y',Url::get('last_time_update')):'Not modified';?></td>
					</tr>				
				</table>	
				<div id="panel_1" style="margin-top:8px;">
					<span><?php echo Portal::language('Parameters_properties');?></span>
					<table cellpadding="4" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">						
						<tr>
							<td align="right"><?php echo Portal::language('image_url');?></td>
							<td align="left">
								<input  name="image_url" id="image_url" class="file" size="17" type ="file" value="<?php echo String::html_normalize(URL::get('image_url'));?>"><div id="delete_image_url"><?php if(Url::get('image_url') and file_exists(Url::get('image_url'))){?>[<a href="<?php echo Url::get('image_url');?>" target="_blank" style="color:#FF0000"><?php echo Portal::language('view');?></a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','link'=>Url::get('image_url')));?>" onclick="jQuery('#delete_image_url').html('');" target="_blank" style="color:#FF0000"><?php echo Portal::language('delete');?></a>]<?php }?></div>
							</td>
						</tr>	
						<tr>
							<td align="right"><?php echo Portal::language('url');?> (<span style="color:#FF0000" class="require">*</span>)</td>
							<td align="left"><input  name="url" id="url" class="input-large" size="17" type ="text" value="<?php echo String::html_normalize(URL::get('url'));?>"></td>
						</tr>	
						<tr>
							<td align="right"><?php echo Portal::language('width');?></td>
							<td align="left"><input  name="width" id="width" class="input-large" size="17" type ="text" value="<?php echo String::html_normalize(URL::get('width'));?>"></td>
						</tr>	
						<tr>
							<td align="right"><?php echo Portal::language('height');?></td>
							<td align="left"><input  name="height" id="height" class="input-large" size="17" type ="text" value="<?php echo String::html_normalize(URL::get('height'));?>"></td>
						</tr>		
						<tr>
							<td align="right"><?php echo Portal::language('status');?></td>
							<td align="left"><select  name="status" id="status" class="select"><?php
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
					</table>
				</div>	
				<div id="panel_1"  style="margin-top:8px;">
					<span><?php echo Portal::language('Metadata_information');?></span>
					<table cellpadding="4" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">
						<tr>
						  <td align="right"><?php echo Portal::language('keywords');?></td>
						  <td align="left"><input  name="keywords" id="keywords" class="input-large" type ="text" value="<?php echo String::html_normalize(URL::get('keywords'));?>"></td>
						</tr>	
						<tr>
						  <td align="right"><?php echo Portal::language('tags');?></td>
						  <td align="left"><input  name="tags" id="tags" class="input-large" type ="text" value="<?php echo String::html_normalize(URL::get('tags'));?>"></td>
						</tr>					
					</table>
				</div>
			</td>
			<td style="width:1px;"></td>
			<td  style="border:1px solid  #C0C0C0" valign="top">
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
					 <input  name="name_<?php echo $this->map['languages']['current']['id'];?>" id="name_<?php echo $this->map['languages']['current']['id'];?>" class="input-big-huge"/ type ="text" value="<?php echo String::html_normalize(URL::get('name_'.$this->map['languages']['current']['id']));?>">
				</div>
				<div class="form_input_label"><?php echo Portal::language('description');?></div>
				<div class="form_input">
					<textarea id="description_<?php echo $this->map['languages']['current']['id'];?>" name="description_<?php echo $this->map['languages']['current']['id'];?>" cols="75" rows="20" style="width:100%; height:270px;overflow:hidden"><?php echo Url::get('description_'.$this->map['languages']['current']['id'],'');?></textarea><br />
					<script>simple_mce('description_<?php echo $this->map['languages']['current']['id'];?>');</script>
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
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
</fieldset>