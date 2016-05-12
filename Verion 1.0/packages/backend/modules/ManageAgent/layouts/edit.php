<style>
.manage-agent-content{
}
.manage-agent-content table tr td{
	line-height:28px;
}
.manage-agent-content table tr td input{
	width:70%;
}
</style>
<fieldset id="toolbar">
	<legend style="font-weight:bold; padding:0px 10px;">[[.document_manage_system.]]</legend>
	<div id="toolbar-title"><?php echo Portal::language(Url::sget('page'));?></div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
			<td id="toolbar-preview"  align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Move"> </span> [[.Preview.]] </a> </td>
			<td id="toolbar-save"  align="center"><a onclick="ManageAgent.submit();"> <span title="Edit"> </span> [[.Save.]] </a> </td>
			<td id="toolbar-cancel"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'list'));?>#"> <span title="New"> </span> [[.Cancel.]] </a> </td>> </td>
			<td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<form method="post" name="ManageAgent" id="ManageAgent" enctype="multipart/form-data">

<fieldset id="toolbar">
   	<legend style="font-weight:bold; color:#0000FF; font-size:14px; padding:0px 10px;">[[.Information_agent.]]</legend>
	<div class="manage-agent-content">
		<table width="99%" border="0">
			<tr>
				<td width="10%">[[.Name.]]</td>
				<td width="35%"><input name="name" type="text" id="name" /></td>
				<td>[[.Acount.]]</td>
				<td><input name="account" type="text" id="account" /></td>
			</tr>
			<tr>
				<td>[[.Address.]]</td>
				<td><input name="address" type="text" id="address"  /></td>
				<td>[[.Password.]]</td>
				<td><input name="password" type="password" id="password" /></td>
			</tr>
			<tr>
				<td>[[.Email.]]</td>
				<td><input name="email" type="text" id="email"  /></td>
				<td>[[.Is_active.]]</td>
				<td align="left"><input name="active" type="checkbox" id="active" <?php if(isset($_REQUEST['active']) and $_REQUEST['active']==1) echo 'checked="checked"';?> /></td>
			</tr>
			<tr>
				<td>[[.Website.]]</td>
				<td><input name="website" type="text" id="website"  /></td>
				<td rowspan="3" valign="top">[[.Logo.]]</td>
				<td rowspan="3" valign="top">
					<!--IF:logo(isset([[=logo=]]) and file_exists([[=logo=]]))-->
						<img src="[[|logo|]]" style="width:100px; height:100px; float:left; margin-right:10px;" />
					<!--/IF:logo-->
					<input type="file" name="logo" id="logo" />
				</td>
			</tr>
			<tr>
				<td>[[.Phone.]]</td>
				<td><input name="phone" type="text" id="phone"  /></td>
			</tr>
			<tr>
				<td>[[.Fax.]]</td>
				<td><input name="fax" type="text" id="fax"  /></td>
			</tr>
			<tr>
				<td>[[.City.]]</td>
				<td><select name="city" id="city"></select></td>
			</tr>
			<tr>
				<td>[[.Introduction.]]</td>
				<td colspan="3"><textarea name="description" id="description" style="width:100%"></textarea>
				<script>simple_mce('description');</script></td>
			</tr>
		</table>
	</div>
</fieldset>
</form>