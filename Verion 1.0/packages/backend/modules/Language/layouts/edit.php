<fieldset id="toolbar">
	<legend>[[.config_manage.]]</legend>
	<div id="toolbar-info">
		[[.language.]] <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		<td id="toolbar-save"  align="center"><a onclick="EditLanguageForm.submit();" > <span title="save"> </span> [[.save.]] </a> </td>
		 <td id="toolbar-back"  align="center"><a href="<?php echo URL::build_current();?>"> <span title="Back"> </span> [[.Back.]] </a> </td>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td>
		</tr>
	  </tbody>
	</table>
</fieldset>
<br>
<fieldset id="toolbar">
<table cellpadding="4" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">	 
	  <tr>
    <td style="width:100%;padding-left:10px;" valign="top">
<?php if(Form::$current->is_error())
		{
		?>		<strong>B&#225;o l&#7895;i</strong><br>
		<?php echo Form::$current->error_messages();?><br>
		<?php
		}
		?>		
		<form name="EditLanguageForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>" enctype="multipart/form-data">		
		<div class="form_input_label">[[.code.]]:</div>
		<div class="form_input">
			<input name="code" type="text" id="code" style="width:80">
		</div>
		<div class="form_input_label">[[.name.]]:</div>
		<div class="form_input">
			<input name="name" type="text" id="name" style="width:200">
		</div>
		<div class="form_input_label">[[.convert_url.]]:</div>
		<div class="form_input">
			<input name="convert_url" type="text" id="convert_url" style="width:200">
		</div>
		<div class="form_input_label">[[.icon_url.]]:</div>
		<div class="form_input">
			<input type="hidden" value="1" name="delete_icon_url" id="delete_icon_url"/>
			<?php if(Url::get('icon_url')){?><img src="<?php echo Url::get('icon_url');?>" width="100" height="100" id="image_url"><img src="skins/default/images/buttons/delete.gif" onclick="document.getElementById('image_url').src='';document.getElementById('delete_icon_url').value='0'"><?php }?><input name="icon_url" type="file"  id="icon_url"/>
		</div>
	<input type="hidden" value="1" name="confirm_edit"/>
	</form>
	</td>
	</tr>
	</table>
	<br>
</fieldset>
