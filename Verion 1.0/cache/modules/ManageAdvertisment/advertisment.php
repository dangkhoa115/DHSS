<script type="text/javascript" src="skins/ssnh/scripts/datetimepicker.js"></script>
<link type="text/css" href="skins/ssnh/styles/datetimepicker.css" rel="stylesheet" />
<script>	
	function make_cmd(cmd)
	{
		jQuery('#cmd').val(cmd);
		document.ManageAdvertisment.submit();
	}
	jQuery(document).ready(function(){
		jQuery('#start_time').datepicker({ yearRange: '2008:2020' });
		jQuery('#end_time').datepicker({ yearRange: '2008:2020' });
	});	
</script>
<fieldset id="toolbar">
	<legend><?php echo Portal::language('content_manage_system');?></legend>
	<div id="toolbar-title" style="width:600px;"><?php echo Portal::language('manage_advertisment');?> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span></div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_edit(false,ANY_CATEGORY)){?><td id="toolbar-save"  align="center"><a onclick="ManageAdvertisment.submit();"> <span title="Save"> </span> <?php echo Portal::language('Save');?> </a> </td><?php }?>
		   <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-cancel"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'list'));?>#"> <span title="Cancel"> </span> <?php echo Portal::language('Cancel');?> </a> </td><?php }?>
		   <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> <?php echo Portal::language('Help');?> </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
	<form name="ManageAdvertisment" method="post">
		<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
		  <tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
			<th width="76%" height="25" align="left"><a style="text-decoration:none"><?php echo Portal::language('chose_page');?>:&nbsp;
		    <select  name="page_name" id="page_name" onchange="location='<?php echo Url::build_current();?>&cmd=advertisment<?php if(Url::get('id')){echo '&id='.Url::get('id');}?>&page_name='+this.value;"><?php
					if(isset($this->map['page_name_list']))
					{
						foreach($this->map['page_name_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('page_name').value = "<?php echo addslashes(URL::get('page_name',isset($this->map['page_name'])?$this->map['page_name']:''));?>";</script>
	</select></a></th>
			<th width="24%" align="left"><a><?php echo Portal::language('category');?></a></th>
		  </tr>
		  <tr style="padding:10px">
			<td valign="top">
				<table width="100%" cellspacing="0" cellpadding="2"  border="1" bordercolor="#E7E7E7" align="center">
						<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
						  <td><?php echo Portal::language('region');?></td>
						  <td><?php echo Portal::language('position');?></td>
				 		 </tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
				  </tr>
						<tr>
							<td><select  name="region" id="region" class="select-large"><?php
					if(isset($this->map['region_list']))
					{
						foreach($this->map['region_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('region').value = "<?php echo addslashes(URL::get('region',isset($this->map['region'])?$this->map['region']:''));?>";</script>
	</select></td>
							<td><input  name="position" id="position" class="input-large" type ="text" value="<?php echo String::html_normalize(URL::get('position'));?>"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
							<td height="25" style="border-right:1px solid #ECE9D8"><?php echo Portal::language('start_time');?></td>
							<td><?php echo Portal::language('end_time');?></td>
						</tr>			
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><input  name="start_time" id="start_time" size="20"  class="input-large" type ="text" value="<?php echo String::html_normalize(URL::get('start_time'));?>"></td>
							<td><input  name="end_time" id="end_time" size="20" class="input-large"/ type ="text" value="<?php echo String::html_normalize(URL::get('end_time'));?>"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp; </td>
						</tr>
						<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
							<td colspan="2"><?php echo Portal::language('list_advertisment');?></td>
						</tr>						
						<tr>
							<td colspan="2">
								<div style="width:100%;height:300px;overflow:auto">
									<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
										<div style="float:left;width:70px;margin:8px;border:1px solid #E7E7E7;padding:2px;padding-bottom:0px;">
											<div>
											<?php 
												if(preg_match_all('/.swf/',$this->map['items']['current']['image_url'],$matches))
												{
													echo '<embed src="'.$this->map['items']['current']['image_url'].'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="70" height="70"></embed>';
												}
												else
												{
													echo '<img src="'.$this->map['items']['current']['image_url'].'" width="70" height="70" onerror="this.src=\'skins/default/images/no_image.gif\'">';
												}
											?>
											</div>
											<div>
											<?php if($this->map['items']['current']['id'] == Url::get('item_id')){?>
												<input  name="item_list_<?php echo $this->map['items']['current']['id'];?>" id="item_list_<?php echo $this->map['items']['current']['id'];?>" checked="checked" type ="checkbox" value="<?php echo String::html_normalize(URL::get('item_list_'.$this->map['items']['current']['id']));?>">
											<?php }else{?>	
												<input  name="item_list_<?php echo $this->map['items']['current']['id'];?>" id="item_list_<?php echo $this->map['items']['current']['id'];?>" type ="checkbox" value="<?php echo String::html_normalize(URL::get('item_list_'.$this->map['items']['current']['id']));?>">
											<?php }?>
												<span><?php echo String::display_sort_title($this->map['items']['current']['name'],2);?></span>
											</div>
										</div>	
									
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
								</div>
							</td>
						</tr>					
					</table>			
			</td>
			<td width="24%" valign="top">
				<select  name="categories[]"<?php if(!URL::get('id')) echo ' size="20"  multiple="multiple" style="width:290px;height:510px;border:1px solid #E7E7E7;padding-left:10px;"';?> style="width:290px;" id="categories[]"><?php
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
				<?php if(Url::get('category_id')){?><script>document.getElementById("categories[]").value = '<?php echo Url::get('category_id');?>';</script><?php }?>
			</td>
		 </tr>
	  </table>
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
</fieldset>	