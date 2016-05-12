<script>
function make_cmd(cmd)
{
	jQuery('#cmd').val(cmd);
	document.SeoConfigForm.submit();
}
</script><fieldset id="toolbar">
	<div id="toolbar-info">[[.SEO_config.]]</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		<td id="toolbar-save"  align="center"><a onclick="make_cmd('seo');"> <span title="[[.Save.]]"> </span> [[.Save.]] </a> </td>
		 <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="[[.Help.]]"> </span> [[.Help.]] </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<div style="height:8px;"></div>
<fieldset id="toolbar">
<form name="SeoConfigForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">	
	<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
		<tr style="background-color:#F0F0F0">
		  <th width="26%" align="left"><a>[[.Setting_name.]]</a></th>
		  <th width="74%" align="left"><a>[[.Value.]]</a></th>
		  </tr>			
		<tr>
		  <td align="left" valign="top" title="site_title">[[.site_title.]]</td>
		  <td align="left"><input name="[[|prefix|]]site_title" type="text" id="[[|prefix|]]site_title" class="input-big-huge" value="[[|site_title|]]" /></td>
		  </tr>
		<tr>
		  <td align="left" valign="top" title="site_name">[[.site_name.]]</td>
		  <td align="left"><input name="[[|prefix|]]site_name" type="text" id="[[|prefix|]]site_name" class="input-big-huge" value="[[|site_name|]]" /></td>
		  </tr>
		<tr>
		  <td align="left" valign="top" title="email_support">[[.email_support_online.]]</td>
		  <td align="left"><input name="email_support_online" type="text" id="email_support" class="input-big-huge" value="[[|email_support_online|]]" /></td>
		  </tr>
		<tr>
		  <td valign="top" title="website_keywords">[[.website_keywords.]]</td>
		  <td><textarea name="website_keywords" class="textarea-small" id="website_keywords">[[|website_keywords|]]</textarea></td>
		  </tr>		
		<tr>
			<td valign="top" title="website_description">[[.website_description.]]</td>
			<td><textarea name="website_description" class="textarea-small" id="website_description">[[|website_description|]]</textarea></textarea></td>
		</tr>		
		<tr>
			<td valign="top" title="google_analytics">[[.google_analytics.]]</td>
			<td><textarea name="google_analytics" class="textarea-medium" id="google_analytics">[[|google_analytics|]]</textarea></textarea></td>
		</tr>
     <tr>
			<td valign="top" title="auto_link">Auto link</td>
			<td><textarea name="auto_link" class="textarea-medium" id="auto_link">[[|auto_link|]]</textarea></td>
		</tr>
	</table>	
</form>	
<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
	<tr>
		<td align="right">&nbsp;</td>
	</tr>
</table>
<div style="#height:8px"></div>
</fieldset> 