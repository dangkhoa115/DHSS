<fieldset id="toolbar">
	<legend>[[.manage_profile.]]</legend>
	<div id="toolbar-personal">[[.contact_detail.]]</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <td id="toolbar-back" align="center"><a onclick="history.go(-1)"><span title="back"></span>[[.back.]] </a></td>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build('help');?>#"> <span title="Help"> </span> [[.Help.]] </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<div style="padding:5px;">
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td colspan="3" align="center">
			<div id="div_[[|id|]]">
				<table cellpadding="4" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;background-color:#FFFFFF" border="1" bordercolor="#E7E7E7" align="center">
`					<tr>
						<td align="right" colspan="2">[[.is_check.]]&nbsp; <input  name="confirm_[[|id|]]"  type="checkbox" <?php if([[=is_check=]]==1){ echo 'checked="checked"';}?> value="1" onclick="location='<?php echo Url::build_current(array('cmd'=>'check','id'=>[[=id=]]));?>'"></td>
					</tr>
					<tr>
						<td colspan="2" width="30%" align="left"><b>[[.content.]]</b></td>
					</tr>
					<tr>
						<td colspan="3" >[[|content|]]</td>
					</tr>
					<tr>
						<td  align="left"><b>[[.sender.]]</b></td>
						<td colspan="2"  align="left"><b>[[.email.]]</b></td>
					</tr>
					<tr>
						<td  align="left">[[|name|]]</td>
						<td colspan="2"  >[[|email|]]</td>
						</tr>
				</table>								
			</div>
		</td>
	</tr>
</table>
</div>