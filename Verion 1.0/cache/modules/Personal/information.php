<fieldset id="toolbar">
	<legend><?php echo Portal::language('manage_profile');?></legend>
	<div id="toolbar-normal">
		<img src="<?php if(Url::get('image_url') and file_exists(Url::get('image_url'))){ echo Url::get('image_url');}?>" onerror="this.src='skins/default/images/cms/header/icon-48-user.png'" style="border:1px solid #CCCCCC;width:50px;padding:1px;">
		<?php echo Url::get('blast',Portal::language('personal'));?>
	</div>
	<div id="toolbar-content">
	<table align="right">
	  <tbody>
		<tr>
		<?php if(User::is_login()){?><td id="toolbar-save"  align="center"><a onclick="document.EditUser.submit();"> <span title="<?php echo Portal::language('Save');?>"> </span> <?php echo Portal::language('Save');?> </a> </td><?php }?>
		<?php if(User::is_login()){?><td id="toolbar-param"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'change_pass'));?>"> <span title="<?php echo Portal::language('Change_pass');?>"></span><?php echo Portal::language('Edit_pass');?></a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<fieldset id="toolbar">
	<legend><b><?php echo Portal::language('change_information_user');?>&nbsp;:&nbsp;<a><?php echo Session::get('user_id');?></a></b></legend>
<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>	
	<form name="EditUser" method="post" id="EditUser" enctype="multipart/form-data">
		<table cellpadding="4" cellspacing="0" width="100%" align="center">			
				<tr>
					<td width="32%" align="right"><?php echo Portal::language('full_name');?></td>
				  <td width="68%"><input  name="full_name" id="full_name" class="input-huge" type ="text" value="<?php echo String::html_normalize(URL::get('full_name'));?>"></td>
				</tr>	
				<tr>
					<td width="32%" align="right"><?php echo Portal::language('address');?></td>
				  <td width="68%"><input  name="address" id="address" class="input-huge" style="width:400px" type ="text" value="<?php echo String::html_normalize(URL::get('address'));?>"></td>
				</tr>			
				<tr>
					<td width="32%" align="right"><?php echo Portal::language('Country');?></td>
					<td width="68%"><select  name="zone_id" class="select-large" id="zone_id"><?php
					if(isset($this->map['zone_id_list']))
					{
						foreach($this->map['zone_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('zone_id').value = "<?php echo addslashes(URL::get('zone_id',isset($this->map['zone_id'])?$this->map['zone_id']:''));?>";</script>
	</select>
					<script>document.getElementById('zone_id').value ='<?php echo Url::get('zone_id',1);?>';</script>					</td>
				</tr>
				<tr>
					<td width="32%" align="right"><?php echo Portal::language('gender');?></td>
					<td width="68%"><select  name="gender" class="select" id="gender"><?php
					if(isset($this->map['gender_list']))
					{
						foreach($this->map['gender_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('gender').value = "<?php echo addslashes(URL::get('gender',isset($this->map['gender'])?$this->map['gender']:''));?>";</script>
	</select></td>
				</tr>
				<tr>
					<td width="32%" align="right"><?php echo Portal::language('birth_date');?></td>
					<td width="68%"><input  name="birth_date" id="birth_date" class="input" type ="text" value="<?php echo String::html_normalize(URL::get('birth_date'));?>"></td>
				</tr>
				<tr>
					<td width="32%" align="right"><?php echo Portal::language('Passport');?></td>
					<td width="68%"><input  name="identity_card" id="identity_card" class="input" maxlength="9" type ="text" value="<?php echo String::html_normalize(URL::get('identity_card'));?>"></td>
				</tr>
				<tr>
					<td width="32%" align="right"><?php echo Portal::language('phone_number');?></td>
					<td width="68%"><input  name="phone" id="phone" class="input-huge" type ="text" value="<?php echo String::html_normalize(URL::get('phone'));?>"></td>
				</tr>
				<tr>
					<td width="32%" align="right"><?php echo Portal::language('mobile_phone');?></td>
					<td width="68%"><input  name="telephone" id="telephone" class="input-huge" type ="text" value="<?php echo String::html_normalize(URL::get('telephone'));?>"></td>
				</tr>
				<tr>
					<td width="32%" align="right"><?php echo Portal::language('fax');?></td>
					<td width="68%"><input  name="fax" id="fax" class="input-huge" type ="text" value="<?php echo String::html_normalize(URL::get('fax'));?>"></td>
				</tr>
				<tr>
					<td width="32%" align="right"><?php echo Portal::language('yahoo');?></td>
					<td width="68%"><input  name="yahoo" id="yahoo" class="input-huge" type ="text" value="<?php echo String::html_normalize(URL::get('yahoo'));?>"></td>
				</tr>
				<tr>
					<td width="32%" align="right"><?php echo Portal::language('skype');?></td>
					<td width="68%"><input  name="skype" id="skype" class="input-huge" type ="text" value="<?php echo String::html_normalize(URL::get('skype'));?>"></td>
				</tr>
				<tr>
					<td width="32%" align="right"><?php echo Portal::language('email');?></td>
					<td width="68%"><input  name="email" id="email" class="input-huge" type ="text" value="<?php echo String::html_normalize(URL::get('email'));?>"></td>
				</tr>
				<tr>
					<td width="32%" align="right"><?php echo Portal::language('website');?></td>
					<td width="68%"><input  name="website" id="website" class="input-huge" type ="text" value="<?php echo String::html_normalize(URL::get('website'));?>"></td>
				</tr>				
				<tr>
					<td width="32%" align="right" valign="top"><?php echo Portal::language('information_contact');?></td>
					<td width="68%"><textarea  name="description" class="textarea-nomarl" id="description"><?php echo String::html_normalize(URL::get('description',''));?></textarea></td>
				</tr>
				<tr>
					<td width="32%" align="right" valign="top"><?php echo Portal::language('avatar');?></td>
				  <td width="68%"><input  name="image_url" id="image_url" type ="file" value="<?php echo String::html_normalize(URL::get('image_url'));?>">
				  &nbsp;<span class="require">100x100 pixel (*.jpg, *.jpeg, *.gif)</span> </td>
				</tr>
		</table>
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
				
</fieldset>
