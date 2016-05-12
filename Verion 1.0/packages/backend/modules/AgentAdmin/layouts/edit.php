<fieldset id="toolbar">
	<legend>[[.manage_profile.]]</legend>
 	<div id="toolbar-personal">
		[[.Agent_admin.]] <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <td id="toolbar-save"  align="center"><a onclick="EditAgentAdminForm.submit();"> <span title="Edit"> </span> [[.Save.]] </a> </td>
		  <td id="toolbar-cancel"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'list'));?>#"> <span title="[[.Cancel.]]"> </span> [[.Cancel.]] </a> </td>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="[[.Help.]]"> </span> [[.Help.]] </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<div style="height:6px;"></div>
<fieldset id="toolbar">
	<legend>[[.information.]]</legend>
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
	<form name="EditAgentAdminForm" method="post"  enctype="multipart/form-data">
		<input type="hidden" name="privilege_deleted_ids" value=""/>
		<div class="agent-title">[[.company_information.]]</div>		
		<table cellpadding="4" cellspacing="0" border="0" width="100%">
			<tr>
				<td align="right" width="100px">[[.user_name.]]</td>
				<td width="300px"><input name="id" type="text" id="id" class="input-large" readonly="readonly" /></td>
				<td align="right" width="100px">[[.password.]]</td>
				<td><input name="password" type="text" id="password" class="input-large" /> </td>
				<td rowspan="6" valign="top" align="left">
					<label>[[.image_url.]]:</label><br />
					<img src="[[|image_url|]]" width="200px" /><br />
					<input name="image_url" type="file" id="image_url" />
				</td>
			</tr>
			<tr>
				<td align="right">[[.company_name.]]</td>
				<td><input name="full_name" type="text" id="full_name" class="input-large"/></td>
				<td align="right">[[.email.]]</td>
				<td><input name="email" type="text" id="email" class="input-large"/></td>
			</tr>
			<tr>
				<td align="right">[[.active.]]</td>
				<td><input name="active" id="active" type="checkbox" value="1" <?php echo (URL::get('active')?'checked':'');?> /></td>
			</tr>
			<tr>
				<td align="right">[[.address.]]</td>
				<td><input name="address" type="text" id="address" class="input-large"/></td>
				<td align="right">[[.phone_number.]]</td>
				<td><input name="telephone" type="text" id="telephone" class="input"/></td>
			</tr>
			<tr>
				<td align="right">[[.zone_id.]]</td>
				<td><select name="zone_id" id="zone_id" class="select-large"></select></td>
				<td align="right">[[.join_date.]]</td>
				<td><input name="join_date" type="text" id="join_date" class="input"></td>
			</tr>
			<tr>
				<td align="right">[[.zipcode.]]</td>
				<td><input name="zipcode" type="text" id="zipcode" class="input" /></td>
			</tr>
		</table>
		<div class="agent-title">[[.Contact_person.]]</div>
		<table cellpadding="4" cellspacing="0" border="0" width="100%">
			<tr>
				<td align="right" width="100px">[[.first_name.]]</td>
				<td width="300px"><input name="first_name" type="text" id="first_name" class="input" /></td>
				<td align="right" width="100px">[[.last_name.]]</td>
				<td><input name="last_name" type="text" id="last_name" class="input-large"></td>
			</tr>
			<tr>
				<td align="right">[[.gender.]]</td>
				<td><input type="radio" name="gender" value="1" id="male" <?php if([[=gender=]]){?>checked="checked"<?php }?> /><label for="male" style="margin-right:5px;">[[.male.]]</label><input type="radio" name="gender" value="0" id="female" <?php if(![[=gender=]]){?>checked="checked"<?php }?>/><label for="female">[[.female.]]</label></td>
				<td align="right">[[.identity_card.]]</td>
				<td><input name="identity_card" type="text" id="identity_card" class="input-large"></td>
			</tr>
			<tr>
				<td align="right">[[.position.]]</td>
				<td><input name="position" type="text" id="position" class="input-large" /></td>
				<td align="right">[[.department.]]</td>
				<td><input name="department" type="text" id="department" class="input-large"></td>
			</tr>
			<tr>
				<td align="right">[[.phone.]]</td>
				<td><input name="phone" type="text" id="phone" class="input-large" /></td>
			</tr>
		</table>		
		<input type="hidden" value="1" name="confirm_edit" >
	</form>
</fieldset>