<script src="packages/core/includes/js/jquery/jquery-1.7.1.js"></script>
<script src="packages/core/includes/js/jquery/ui.tabs.js"></script>
<script>
function make_cmd(cmd)
{
	jQuery('#cmd').val(cmd);
	document.AccountSettingForm.submit();
}
</script><fieldset id="toolbar">
	<legend>[[.config_manage.]]</legend>
	<div id="toolbar-info">[[.Account_setting.]]</div>
	<div id="toolbar-content">
	<table align="right">
	  <tbody>
		<tr>
		<td id="toolbar-save"  align="center"><a onclick="make_cmd('save');"><span title="[[.Save.]"> </span> [[.Save.]] </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<div style="height:8px;"></div>
 <fieldset id="toolbar">
<form name="AccountSettingForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>" id="AccountSettingForm" enctype="multipart/form-data">	
  <div id="AccountSetting" align="center">
	<!--IF:cond1(User::is_admin())-->
	<div id="system_config">
		<br>
			<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
				<tr style="background-color:#F0F0F0">
					<th width="20%" align="left"><a>[[.Setting_name.]]</a></th>
					<th width="80%" align="left"><a>[[.Value.]]</a></th>
				</tr>					<tr>
					<td width="20%" align="left" title="portal_template">[[.templates.]]</td>
					<td width="80%" align="left"><input name="config_portal_template" type="text" id="portal_template" class="input-big-huge"></td>
				</tr>	
				<tr>
					<td width="20%" align="left" title="size_upload">[[.size_upload.]] /(1[[.times.]] [[.upload.]])</td>
					<td width="80%" align="left"><input name="config_size_upload" type="text" id="size_upload" class="input-large"></td>
				</tr>	
				<tr>
					<td width="20%" align="left" title="type_image_upload">[[.type_image_upload.]]</td>
					<td width="80%" align="left"><input name="config_type_image_upload" type="text" id="type_image_upload" class="input-big-huge"></td>
				</tr>	
				<tr>
					<td width="20%" align="left" title="type_file_upload">[[.type_file_upload.]]</td>
					<td width="80%" align="left"><input name="config_type_file_upload" type="text" id="type_file_upload" class="input-big-huge"></td>
				</tr>						
				<tr>
					<td width="20%" align="left" title="use_cache">[[.Use_cache.]]</td>
					<td width="80%" align="left">
						<select name="config_use_cache" class="select" id="config_use_cache"></select>
						<script>jQuery('#config_use_cache').val(<?php echo Url::get('config_use_cache',0)?>);</script>					</td>
				</tr>	
				<tr>
					<td valign="top"  align="left" title="rewrite">[[.rewrite_url.]]</td>
					<td  align="left"><select name="config_rewrite" id="config_rewrite" class="select"></select>
					<script>jQuery('#config_rewrite').val(<?php echo Url::get('config_rewrite',0)?>);</script>					</td>
				</tr>	
				<tr>
					<td valign="top"  align="left" title="use_double_click">[[.use_double_click.]]</td>
					<td  align="left"><select name="config_use_double_click" class="select" id="config_use_double_click"></select>
					<script>jQuery('#config_use_double_click').val(<?php echo Url::get('config_use_double_click',0)?>);</script>					</td>
				</tr>
				<tr>
					<td valign="top"  align="left" title="use_log">[[.use_log.]]</td>
					<td  align="left"><select name="config_use_log" class="select" id="config_use_log"></select>
					<script>jQuery('#config_use_log').val(<?php echo Url::get('config_use_log',0)?>);</script>					</td>
				</tr>
				<tr>
					<td valign="top"  align="left" title="use_recycle_bin">[[.use_recycle_bin.]]</td>
					<td  align="left"><select name="config_use_recycle_bin" class="select" id="config_use_recycle_bin"></select>
					<script>jQuery('#config_use_recycle_bin').val(<?php echo Url::get('config_use_recycle_bin',0)?>);</script>					</td>
				</tr>
                <tr>
					<td valign="top"  align="left" title="use_recycle_bin">[[.use_price.]]</td>
					<td  align="left"><select name="config_use_price" class="select" id="config_use_price"></select>
					<script>jQuery('#config_use_price').val(<?php echo Url::get('config_use_price',0)?>);</script>					</td>
				</tr>
			</table>	
	</div>	
	<!--/IF:cond1-->
	<div id="front_back_config">
		<br>
			<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
				<tr style="background-color:#F0F0F0">
					<th width="20%" align="left"><a>[[.Setting_name.]]</a></th>
					<th width="80%" align="left"><a>[[.Value.]]</a></th>
				</tr> 
				<tr>
				  <td width="20%" align="left" valign="top" title="email_webmaster">[[.email_webmaster.]]</td>
				  <td width="80%" align="left"><input name="config_email_webmaster" type="text" id="email_webmaster" class="input-big-huge"></td>
				  </tr>
				<tr>
				  <td align="left" valign="top" title="email_webmaster">Email support KH</td>
				  <td align="left"><input name="config_support_email" type="text" id="support_email" class="input-big-huge" /></td>
				  </tr>
				<tr>
				  <td width="20%" align="left" valign="top" title="support_online">[[.support_online.]] ([[.nick_name.]]:[[.nick.]],..)</td>
				  <td width="80%" align="left"><input name="config_support_online" type="text" id="support_online" class="input-big-huge"></td>
				  </tr>
				<tr>
					<td width="20%" align="left" valign="top" title="support_skype">[[.support_skype.]] ([[.skype_name.]]:[[.skype.]],..)</td>
					<td width="80%" align="left"><input name="config_support_skype" type="text" id="support_skype" class="input-big-huge"></td>
				</tr>
				<tr>
					<td width="20%" align="left" valign="top" title="company_adress">[[.company_adress.]]</td>
					<td width="80%" align="left"><input name="config_company_adress" type="text" id="company_adress" class="input-big-huge"></td>
				</tr>
				<tr>
					<td width="20%" align="left" valign="top" title="company_phone">[[.company_phone.]]</td>
					<td width="80%" align="left"><input name="config_company_phone" type="text" id="company_phone" class="input-big-huge"></td>
				</tr>
				<tr>
					<td width="20%" align="left" valign="top" title="company_fax">[[.company_fax.]]</td>
					<td width="80%" align="left"><input name="config_company_fax" type="text" id="company_fax" class="input-big-huge"></td>
				</tr>
				<tr>
				  <td width="20%" align="left" valign="top" title="is_active">[[.site_status.]]</td>
				  <td width="80%" align="left">
				    <select name="config_is_active" class="select-large" id="config_is_active"></select>
				    <script>jQuery('#config_is_active').val(<?php echo Url::get('config_is_active',0)?>);</script>					</td>
				  </tr>
				<tr>
					<td width="20%" align="left" valign="top" title="notification_when_interrption">[[.notification_when_interrption.]]</td>
					<td width="80%" align="left"><textarea name="config_notification_when_interrption" class="textarea-small" id="notification_when_interrption"></textarea></td>
				</tr>
				<tr>
				  <td align="left" valign="top" title="bed_word_list">[[.bed_word_list.]] ([[.regular_expression.]]) </td>
				  <td align="left"><textarea name="config_bed_word_list" class="textarea-small" id="bed_word_list"></textarea></td>
				  </tr>
			</table>	
	</div>	
</div>
<input name="cmd" type="hidden" id="cmd" value="save">
</form>	
<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
	<tr>
		<td align="right">&nbsp;</td>
	</tr>
</table>

</fieldset> 
