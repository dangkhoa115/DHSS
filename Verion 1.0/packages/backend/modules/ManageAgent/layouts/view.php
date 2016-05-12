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
<fieldset id="toolbar">
   	<legend style="font-weight:bold; color:#0000FF; font-size:14px; padding:0px 10px;">[[.Information_agent.]]</legend>
	<div class="manage-agent-content">
		<table width="99%" border="0">
			<tr>
				<td width="10%">[[.Name.]]</td>
				<td width="35%">[[|name|]]</td>
				<td>[[.Acount.]]</td>
				<td>[[|id|]]</td>
			</tr>
			<tr>
				<td>[[.Address.]]</td>
				<td>[[|address|]]</td>
				<td>[[.Password.]]</td>
				<td>******</td>
			</tr>
			<tr>
				<td>[[.Email.]]</td>
				<td>[[|email|]]&nbsp;</td>
				<td rowspan="4" valign="top">[[.Logo.]]</td>
				<td rowspan="4" valign="top">
					<!--IF:logo(isset([[=logo=]]) and file_exists([[=logo=]]))-->
						<img src="[[|logo|]]" style="width:100px; height:100px; float:left; margin-right:10px;" />
					<!--/IF:logo-->&nbsp;
				</td>
			</tr>
			<tr>
				<td>[[.Website.]]</td>
				<td>[[|website|]]&nbsp;</td>
			</tr>
			<tr>
				<td>[[.Phone.]]</td>
				<td>[[|phone|]]</td>
			</tr>
			<tr>
				<td>[[.Fax.]]</td>
				<td>[[|fax|]]&nbsp;</td>
			</tr>
			<tr>
				<td>[[.City.]]</td>
				<td>[[|city_name|]]</td>
			</tr>
			<tr>
				<td>[[.Introduction.]]</td>
				<td colspan="3">[[|description|]]</td>
			</tr>
		</table>
	</div>
</fieldset>