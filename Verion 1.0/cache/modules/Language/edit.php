<fieldset id="toolbar">
	<legend><?php echo Portal::language('config_manage');?></legend>
	<div id="toolbar-info">
		<?php echo Portal::language('language');?> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		<td id="toolbar-save"  align="center"><a onclick="EditLanguageForm.submit();" > <span title="save"> </span> <?php echo Portal::language('save');?> </a> </td>
		 <td id="toolbar-back"  align="center"><a href="<?php echo URL::build_current();?>"> <span title="Back"> </span> <?php echo Portal::language('Back');?> </a> </td>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> <?php echo Portal::language('Help');?> </a> </td>
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
		<div class="form_input_label"><?php echo Portal::language('code');?>:</div>
		<div class="form_input">
			<input  name="code" id="code" style="width:80" type ="text" value="<?php echo String::html_normalize(URL::get('code'));?>">
		</div>
		<div class="form_input_label"><?php echo Portal::language('name');?>:</div>
		<div class="form_input">
			<input  name="name" id="name" style="width:200" type ="text" value="<?php echo String::html_normalize(URL::get('name'));?>">
		</div>
		<div class="form_input_label"><?php echo Portal::language('convert_url');?>:</div>
		<div class="form_input">
			<input  name="convert_url" id="convert_url" style="width:200" type ="text" value="<?php echo String::html_normalize(URL::get('convert_url'));?>">
		</div>
		<div class="form_input_label"><?php echo Portal::language('icon_url');?>:</div>
		<div class="form_input">
			<input type="hidden" value="1" name="delete_icon_url" id="delete_icon_url"/>
			<?php if(Url::get('icon_url')){?><img src="<?php echo Url::get('icon_url');?>" width="100" height="100" id="image_url"><img src="skins/default/images/buttons/delete.gif" onclick="document.getElementById('image_url').src='';document.getElementById('delete_icon_url').value='0'"><?php }?><input  name="icon_url"  id="icon_url"/ type ="file" value="<?php echo String::html_normalize(URL::get('icon_url'));?>">
		</div>
	<input type="hidden" value="1" name="confirm_edit"/>
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
	</td>
	</tr>
	</table>
	<br>
</fieldset>
