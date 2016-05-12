<script type="text/javascript">
function get_cities(obj)
{
	if(obj.id != 0)
	{
		jQuery.ajax({
			method: "POST",
			url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
			data : {
				cmd:'get_cities',
				city_id:obj.value
			},
			beforeSend: function(){
				jQuery('#cities').html('<option>loading.....</option>');
			},
			success: function(content){
				//autocomplate({zone_id:obj.value});
				if(content=='false')
				{
					jQuery('#cities').html('<option value="0">Select City</option>').attr('disabled','disabled');
				}else
				{
					jQuery('#cities').html(content).removeAttr('disabled');
				}
			}
		});
	}
}
</script>
<fieldset id="toolbar">
	<legend><?php echo Portal::language('manage_profile');?></legend>
 	<div id="toolbar-personal">
		<?php echo Portal::language('user_admin');?> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table align="right">
	  <tbody>
		<tr>
		  <td id="toolbar-save"  align="center"><a onclick="EditUserAdminForm.submit();"> <span title="Edit"> </span> <?php echo Portal::language('Save');?> </a> </td>
		  <td id="toolbar-cancel"  align="center"><a href="<?php echo Url::build_current(array('kind','cmd'=>'list'));?>#"> <span title="<?php echo Portal::language('Cancel');?>"> </span> Hủy bỏ </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<div style="height:6px;"></div>
<fieldset id="toolbar">
	<legend><?php echo Portal::language('information');?></legend>
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
	<form name="EditUserAdminForm" method="post" enctype="multipart/form-data">
		<input type="hidden" name="privilege_deleted_ids" value=""/>
		<input type="hidden" name="group_deleted_ids" value=""/>
		<table cellpadding="4" cellspacing="0" border="1" width="100%" bordercolor="#CCC" bgcolor="#FFF">
			<tr>
				<td width="10%" align="right"><?php echo Portal::language('user_name');?></td>
				<td width="20%"><input  name="id" id="id" class="input-large" / type ="text" value="<?php echo String::html_normalize(URL::get('id'));?>"></td>
				<td width="10%" align="right"><?php echo Portal::language('full_name');?></td>
				<td width="20%"><input  name="full_name" id="full_name" class="input-large"/ type ="text" value="<?php echo String::html_normalize(URL::get('full_name'));?>"></td>
				<td width="10%" align="right"><?php echo Portal::language('email');?></td>
				<td width="20%"><input  name="email" id="email" class="input-large"/ type ="text" value="<?php echo String::html_normalize(URL::get('email'));?>"></td>
			</tr>
			<tr>
			  <td align="right"><?php echo Portal::language('password');?></td>
			  <td><input  name="password" id="password" class="input-large" / type ="text" value="<?php echo String::html_normalize(URL::get('password'));?>"></td>
			  <td align="right"><?php echo Portal::language('active');?></td>
			  <td><input name="active" id="active" type="checkbox" value="1" <?php echo (URL::get('active')?'checked':'');?> /></td>
			  <td align="right"><?php echo Portal::language('birth_date');?></td>
			  <td><input  name="birth_date" id="birth_date" class="input" type ="text" value="<?php echo String::html_normalize(URL::get('birth_date'));?>"></td>
			</tr>
			<tr>
				<td align="right"><?php echo Portal::language('gender');?></td>
				<td><select  name="gender" id="gender" class="select"><?php
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
				<td align="right"><?php echo Portal::language('block');?></td>
				<td><input name="block" id="block" type="checkbox" value="1" <?php echo (URL::get('block')?'checked':'');?>/></td>
				<td align="right"><?php echo Portal::language('phone_number');?></td>
				<td><input  name="phone" id="phone" class="input"/ type ="text" value="<?php echo String::html_normalize(URL::get('phone'));?>"></td>
			</tr>
			<tr>
			  <td align="right"><?php echo Portal::language('address');?></td>
			  <td><input  name="address" id="address" class="input-large"/ type ="text" value="<?php echo String::html_normalize(URL::get('address'));?>"></td>
			  <td align="right"><?php echo Portal::language('join_date');?></td>
			  <td><input name="join_date" value="<?php echo date('d/m/Y');?>" type="text" id="join_date" class="input"></td>
				<td align="right">CMTND</td>
				<td><input  name="cmtnd" id="cmtnd" class="input"/ type ="text" value="<?php echo String::html_normalize(URL::get('cmtnd'));?>"></td>
			</tr>
			<tr>
				<td align="right">Ảnh đại diện</td>
				<td><img src="<?php echo Url::get('image_url')?>" width="200"><br>
				<input  name="image_url" id="image_url" type ="file" value="<?php echo String::html_normalize(URL::get('image_url'));?>">
        <span class="require">200x200 pixel (*.jpg, *.jpeg, *.gif)</span>
        </td>
				<td align="right">&nbsp;</td>
				<td align="right">&nbsp;</td>
				<td align="right">&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>		
		<input type="hidden" value="1" name="confirm_edit" >
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
</fieldset>
<script>
jQuery("#birth_date").datepicker();
jQuery("#join_date").datepicker();
</script>