<fieldset id="toolbar">
	<legend>[[.manage_zone.]]</legend>
 	<div id="toolbar-title">
		[[.customer_service_admin.]] <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <td id="toolbar-preview"  align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Move"> </span> [[.Preview.]] </a> </td>
		  <td id="toolbar-save"  align="center"><a onclick="EditCustomerServiceAdmin.submit();"> <span title="Edit"> </span> [[.Save.]] </a> </td>
		  <td id="toolbar-cancel"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'list'));?>#"> <span title="New"> </span> [[.Cancel.]] </a> </td>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br clear="all">
<fieldset id="toolbar">
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
	<form name="EditCustomerServiceAdmin" id="EditCustomerServiceAdmin" method="post" enctype="multipart/form-data">
		<table cellspacing="4" cellpadding="4" border="0" width="100%" style="background-color:#FFFFFF;">
		<tr>
		  <td valign="top">
	    <table cellpadding="4" cellspacing="0" border="0" width="100%" style="background-color:#F9F9F9;border:1px solid #D5D5D5">
					<tr>
					  <td width="16%" align="right">[[.zone_id.]]<span class="form_input_label">(<span class="require">*</span>)</span></td>
					  <td width="28%" align="left"><select name="zone_id" id="zone_id" class="select-large" ></select></td>
					  <td width="12%" align="right">[[.phone.]]<span class="form_input_label">(<span class="require">*</span>)</span></td>
					  <td width="44%" align="left"><input name="phone" type="text" id="phone" class="input-large"></td>
				  </tr>									
					<tr>
						<td align="right">[[.type.]]</td>
						<td align="left"><select name="type" id="type" class="select-large"></select></td>
						<td align="right">[[.image_url.]]</td>
						<td align="left"><input name="image_url" type="file" id="image_url" class="file" size="15"><div id="delete_image_url"><?php if(Url::get('image_url') and file_exists(Url::get('image_url'))){?>[<a href="<?php echo Url::get('image_url');?>" target="_blank" style="color:#FF0000">[[.view.]]</a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','link'=>Url::get('image_url')));?>" onclick="jQuery('#delete_image_url').html('');" target="_blank" style="color:#FF0000">[[.delete.]]</a>]<?php }?></div></td>
					</tr>
				</table>
				<br>
				<table  cellpadding="4" cellspacing="0" border="0" width="100%" style="background-color:#F9F9F9;border:1px solid #D5D5D5" align="center">
					<tr>
						<td>
						<div class="tab-pane-1" id="tab-pane-category">
						<div class="tab-page" id="tab-page-category-1">
							<div class="form_input_label">[[.name.]] </div>
							<div class="form_input">
								 <input name="name" type="text" id="name" style="width:60%;border:1px solid #CCCCCC;"  />
							</div>
							<div class="form_input_label">[[.description.]]</div>
							<div class="form_input">
								<textarea id="brief" name="brief" cols="75" rows="20" style="width:99%; height:350px;overflow:hidden"><?php echo Url::get('brief');?></textarea><br />
								<script>advance_mce('brief');</script>
							</div>
						</div>
						<!--/LIST:languages-->
						</div>						
						</td>
				   </tr>
				</table>				
		  </td>
		</tr>
		</table>
	</form>
</fieldset>