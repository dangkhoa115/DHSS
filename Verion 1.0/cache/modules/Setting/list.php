<script>
function make_cmd(cmd)
{
	jQuery('#cmd').val(cmd);
	document.SeoConfigForm.submit();
}
</script><fieldset id="toolbar">
	<div id="toolbar-info"><?php echo Portal::language('SEO_config');?></div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		<td id="toolbar-save"  align="center"><a onclick="make_cmd('seo');"> <span title="<?php echo Portal::language('Save');?>"> </span> <?php echo Portal::language('Save');?> </a> </td>
		 <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="<?php echo Portal::language('Help');?>"> </span> <?php echo Portal::language('Help');?> </a> </td>
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
		  <th width="26%" align="left"><a><?php echo Portal::language('Setting_name');?></a></th>
		  <th width="74%" align="left"><a><?php echo Portal::language('Value');?></a></th>
		  </tr>			
		<tr>
		  <td align="left" valign="top" title="site_title"><?php echo Portal::language('site_title');?></td>
		  <td align="left"><input name="<?php echo $this->map['prefix'];?>site_title" type="text" id="<?php echo $this->map['prefix'];?>site_title" class="input-big-huge" value="<?php echo $this->map['site_title'];?>" /></td>
		  </tr>
		<tr>
		  <td align="left" valign="top" title="site_name"><?php echo Portal::language('site_name');?></td>
		  <td align="left"><input name="<?php echo $this->map['prefix'];?>site_name" type="text" id="<?php echo $this->map['prefix'];?>site_name" class="input-big-huge" value="<?php echo $this->map['site_name'];?>" /></td>
		  </tr>
		<tr>
		  <td align="left" valign="top" title="email_support"><?php echo Portal::language('email_support_online');?></td>
		  <td align="left"><input name="email_support_online" type="text" id="email_support" class="input-big-huge" value="<?php echo $this->map['email_support_online'];?>" /></td>
		  </tr>
		<tr>
		  <td valign="top" title="website_keywords"><?php echo Portal::language('website_keywords');?></td>
		  <td><textarea  name="website_keywords" class="textarea-small" id="website_keywords"><?php echo String::html_normalize(URL::get('website_keywords',''.$this->map['website_keywords']));?></textarea></td>
		  </tr>		
		<tr>
			<td valign="top" title="website_description"><?php echo Portal::language('website_description');?></td>
			<td><textarea  name="website_description" class="textarea-small" id="website_description"><?php echo String::html_normalize(URL::get('website_description',''.$this->map['website_description']));?></textarea></textarea></td>
		</tr>		
		<tr>
			<td valign="top" title="google_analytics"><?php echo Portal::language('google_analytics');?></td>
			<td><textarea  name="google_analytics" class="textarea-medium" id="google_analytics"><?php echo String::html_normalize(URL::get('google_analytics',''.$this->map['google_analytics']));?></textarea></textarea></td>
		</tr>
     <tr>
			<td valign="top" title="auto_link">Auto link</td>
			<td><textarea  name="auto_link" class="textarea-medium" id="auto_link"><?php echo String::html_normalize(URL::get('auto_link',''.$this->map['auto_link']));?></textarea></td>
		</tr>
	</table>	
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
				
<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
	<tr>
		<td align="right">&nbsp;</td>
	</tr>
</table>
<div style="#height:8px"></div>
</fieldset> 