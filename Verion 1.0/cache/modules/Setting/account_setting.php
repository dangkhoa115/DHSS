<script src="packages/core/includes/js/jquery/jquery-1.7.1.js"></script>
<script src="packages/core/includes/js/jquery/ui.tabs.js"></script>
<script>
function make_cmd(cmd)
{
	jQuery('#cmd').val(cmd);
	document.AccountSettingForm.submit();
}
</script><fieldset id="toolbar">
	<legend><?php echo Portal::language('config_manage');?></legend>
	<div id="toolbar-info"><?php echo Portal::language('Account_setting');?></div>
	<div id="toolbar-content">
	<table align="right">
	  <tbody>
		<tr>
		<td id="toolbar-save"  align="center"><a onclick="make_cmd('save');"><span title="[[.Save.]"> </span> <?php echo Portal::language('Save');?> </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<div style="height:8px;"></div>
 <fieldset id="toolbar">
<form name="AccountSettingForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>" id="AccountSettingForm" enctype="multipart/form-data">	
  <div id="AccountSetting" align="center">
	<?php 
				if((User::is_admin()))
				{?>
	<div id="system_config">
		<br>
			<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
				<tr style="background-color:#F0F0F0">
					<th width="20%" align="left"><a><?php echo Portal::language('Setting_name');?></a></th>
					<th width="80%" align="left"><a><?php echo Portal::language('Value');?></a></th>
				</tr>					<tr>
					<td width="20%" align="left" title="portal_template"><?php echo Portal::language('templates');?></td>
					<td width="80%" align="left"><input  name="config_portal_template" id="portal_template" class="input-big-huge" type ="text" value="<?php echo String::html_normalize(URL::get('config_portal_template'));?>"></td>
				</tr>	
				<tr>
					<td width="20%" align="left" title="size_upload"><?php echo Portal::language('size_upload');?> /(1<?php echo Portal::language('times');?> <?php echo Portal::language('upload');?>)</td>
					<td width="80%" align="left"><input  name="config_size_upload" id="size_upload" class="input-large" type ="text" value="<?php echo String::html_normalize(URL::get('config_size_upload'));?>"></td>
				</tr>	
				<tr>
					<td width="20%" align="left" title="type_image_upload"><?php echo Portal::language('type_image_upload');?></td>
					<td width="80%" align="left"><input  name="config_type_image_upload" id="type_image_upload" class="input-big-huge" type ="text" value="<?php echo String::html_normalize(URL::get('config_type_image_upload'));?>"></td>
				</tr>	
				<tr>
					<td width="20%" align="left" title="type_file_upload"><?php echo Portal::language('type_file_upload');?></td>
					<td width="80%" align="left"><input  name="config_type_file_upload" id="type_file_upload" class="input-big-huge" type ="text" value="<?php echo String::html_normalize(URL::get('config_type_file_upload'));?>"></td>
				</tr>						
				<tr>
					<td width="20%" align="left" title="use_cache"><?php echo Portal::language('Use_cache');?></td>
					<td width="80%" align="left">
						<select  name="config_use_cache" class="select" id="config_use_cache"><?php
					if(isset($this->map['config_use_cache_list']))
					{
						foreach($this->map['config_use_cache_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('config_use_cache').value = "<?php echo addslashes(URL::get('config_use_cache',isset($this->map['config_use_cache'])?$this->map['config_use_cache']:''));?>";</script>
	</select>
						<script>jQuery('#config_use_cache').val(<?php echo Url::get('config_use_cache',0)?>);</script>					</td>
				</tr>	
				<tr>
					<td valign="top"  align="left" title="rewrite"><?php echo Portal::language('rewrite_url');?></td>
					<td  align="left"><select  name="config_rewrite" id="config_rewrite" class="select"><?php
					if(isset($this->map['config_rewrite_list']))
					{
						foreach($this->map['config_rewrite_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('config_rewrite').value = "<?php echo addslashes(URL::get('config_rewrite',isset($this->map['config_rewrite'])?$this->map['config_rewrite']:''));?>";</script>
	</select>
					<script>jQuery('#config_rewrite').val(<?php echo Url::get('config_rewrite',0)?>);</script>					</td>
				</tr>	
				<tr>
					<td valign="top"  align="left" title="use_double_click"><?php echo Portal::language('use_double_click');?></td>
					<td  align="left"><select  name="config_use_double_click" class="select" id="config_use_double_click"><?php
					if(isset($this->map['config_use_double_click_list']))
					{
						foreach($this->map['config_use_double_click_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('config_use_double_click').value = "<?php echo addslashes(URL::get('config_use_double_click',isset($this->map['config_use_double_click'])?$this->map['config_use_double_click']:''));?>";</script>
	</select>
					<script>jQuery('#config_use_double_click').val(<?php echo Url::get('config_use_double_click',0)?>);</script>					</td>
				</tr>
				<tr>
					<td valign="top"  align="left" title="use_log"><?php echo Portal::language('use_log');?></td>
					<td  align="left"><select  name="config_use_log" class="select" id="config_use_log"><?php
					if(isset($this->map['config_use_log_list']))
					{
						foreach($this->map['config_use_log_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('config_use_log').value = "<?php echo addslashes(URL::get('config_use_log',isset($this->map['config_use_log'])?$this->map['config_use_log']:''));?>";</script>
	</select>
					<script>jQuery('#config_use_log').val(<?php echo Url::get('config_use_log',0)?>);</script>					</td>
				</tr>
				<tr>
					<td valign="top"  align="left" title="use_recycle_bin"><?php echo Portal::language('use_recycle_bin');?></td>
					<td  align="left"><select  name="config_use_recycle_bin" class="select" id="config_use_recycle_bin"><?php
					if(isset($this->map['config_use_recycle_bin_list']))
					{
						foreach($this->map['config_use_recycle_bin_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('config_use_recycle_bin').value = "<?php echo addslashes(URL::get('config_use_recycle_bin',isset($this->map['config_use_recycle_bin'])?$this->map['config_use_recycle_bin']:''));?>";</script>
	</select>
					<script>jQuery('#config_use_recycle_bin').val(<?php echo Url::get('config_use_recycle_bin',0)?>);</script>					</td>
				</tr>
                <tr>
					<td valign="top"  align="left" title="use_recycle_bin"><?php echo Portal::language('use_price');?></td>
					<td  align="left"><select  name="config_use_price" class="select" id="config_use_price"><?php
					if(isset($this->map['config_use_price_list']))
					{
						foreach($this->map['config_use_price_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('config_use_price').value = "<?php echo addslashes(URL::get('config_use_price',isset($this->map['config_use_price'])?$this->map['config_use_price']:''));?>";</script>
	</select>
					<script>jQuery('#config_use_price').val(<?php echo Url::get('config_use_price',0)?>);</script>					</td>
				</tr>
			</table>	
	</div>	
	
				<?php
				}
				?>
	<div id="front_back_config">
		<br>
			<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
				<tr style="background-color:#F0F0F0">
					<th width="20%" align="left"><a><?php echo Portal::language('Setting_name');?></a></th>
					<th width="80%" align="left"><a><?php echo Portal::language('Value');?></a></th>
				</tr> 
				<tr>
				  <td width="20%" align="left" valign="top" title="email_webmaster"><?php echo Portal::language('email_webmaster');?></td>
				  <td width="80%" align="left"><input  name="config_email_webmaster" id="email_webmaster" class="input-big-huge" type ="text" value="<?php echo String::html_normalize(URL::get('config_email_webmaster'));?>"></td>
				  </tr>
				<tr>
				  <td align="left" valign="top" title="email_webmaster">Email support KH</td>
				  <td align="left"><input  name="config_support_email" id="support_email" class="input-big-huge" / type ="text" value="<?php echo String::html_normalize(URL::get('config_support_email'));?>"></td>
				  </tr>
				<tr>
				  <td width="20%" align="left" valign="top" title="support_online"><?php echo Portal::language('support_online');?> (<?php echo Portal::language('nick_name');?>:<?php echo Portal::language('nick');?>,..)</td>
				  <td width="80%" align="left"><input  name="config_support_online" id="support_online" class="input-big-huge" type ="text" value="<?php echo String::html_normalize(URL::get('config_support_online'));?>"></td>
				  </tr>
				<tr>
					<td width="20%" align="left" valign="top" title="support_skype"><?php echo Portal::language('support_skype');?> (<?php echo Portal::language('skype_name');?>:<?php echo Portal::language('skype');?>,..)</td>
					<td width="80%" align="left"><input  name="config_support_skype" id="support_skype" class="input-big-huge" type ="text" value="<?php echo String::html_normalize(URL::get('config_support_skype'));?>"></td>
				</tr>
				<tr>
					<td width="20%" align="left" valign="top" title="company_adress"><?php echo Portal::language('company_adress');?></td>
					<td width="80%" align="left"><input  name="config_company_adress" id="company_adress" class="input-big-huge" type ="text" value="<?php echo String::html_normalize(URL::get('config_company_adress'));?>"></td>
				</tr>
				<tr>
					<td width="20%" align="left" valign="top" title="company_phone"><?php echo Portal::language('company_phone');?></td>
					<td width="80%" align="left"><input  name="config_company_phone" id="company_phone" class="input-big-huge" type ="text" value="<?php echo String::html_normalize(URL::get('config_company_phone'));?>"></td>
				</tr>
				<tr>
					<td width="20%" align="left" valign="top" title="company_fax"><?php echo Portal::language('company_fax');?></td>
					<td width="80%" align="left"><input  name="config_company_fax" id="company_fax" class="input-big-huge" type ="text" value="<?php echo String::html_normalize(URL::get('config_company_fax'));?>"></td>
				</tr>
				<tr>
				  <td width="20%" align="left" valign="top" title="is_active"><?php echo Portal::language('site_status');?></td>
				  <td width="80%" align="left">
				    <select  name="config_is_active" class="select-large" id="config_is_active"><?php
					if(isset($this->map['config_is_active_list']))
					{
						foreach($this->map['config_is_active_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('config_is_active').value = "<?php echo addslashes(URL::get('config_is_active',isset($this->map['config_is_active'])?$this->map['config_is_active']:''));?>";</script>
	</select>
				    <script>jQuery('#config_is_active').val(<?php echo Url::get('config_is_active',0)?>);</script>					</td>
				  </tr>
				<tr>
					<td width="20%" align="left" valign="top" title="notification_when_interrption"><?php echo Portal::language('notification_when_interrption');?></td>
					<td width="80%" align="left"><textarea  name="config_notification_when_interrption" class="textarea-small" id="notification_when_interrption"><?php echo String::html_normalize(URL::get('config_notification_when_interrption',''));?></textarea></td>
				</tr>
				<tr>
				  <td align="left" valign="top" title="bed_word_list"><?php echo Portal::language('bed_word_list');?> (<?php echo Portal::language('regular_expression');?>) </td>
				  <td align="left"><textarea  name="config_bed_word_list" class="textarea-small" id="bed_word_list"><?php echo String::html_normalize(URL::get('config_bed_word_list',''));?></textarea></td>
				  </tr>
			</table>	
	</div>	
</div>
<input  name="cmd" type ="hidden" id="d" value="<?php echo String::html_normalize(URL::get('cmd','save'));?>">
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
				
<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
	<tr>
		<td align="right">&nbsp;</td>
	</tr>
</table>

</fieldset> 
