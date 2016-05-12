<fieldset id="toolbar">
	<legend>[[.manage_media.]]</legend>
 	<div id="toolbar-title">
		<?php echo Portal::language(Url::sget('page'));?> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		 <?php if(User::can_view(false,ANY_CATEGORY)){?> <td id="toolbar-preview"  align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Move"> </span> [[.Preview.]] </a> </td><?php }?>
		 <?php if(User::can_edit(false,ANY_CATEGORY)){?> <td id="toolbar-save"  align="center"><a onclick="jQuery('#save').val('save');EditMediaAdmin.submit();"> <span title="Save"> </span> [[.Save.]] </a> </td><?php }?>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-cancel"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'list'));?>#"> <span title="New"> </span> [[.Cancel.]] </a> </td><?php }?>
		 <?php if(User::can_view(false,ANY_CATEGORY)){?> <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
 </fieldset>
  <br clear="all">
<fieldset id="toolbar">
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
	<form name="EditMediaAdmin" id="EditMediaAdmin" method="post" enctype="multipart/form-data">
	<table  cellpadding="2" cellspacing="0" border="0" width="100%" align="center" style="margin-top:5px;">
		<tr>
			<td valign="top" width="320">
					<table width="100%" style="border: 1px dashed silver;margin-top:-2px;" cellpadding="4" cellspacing="2">
					<tr>
					  <td><b>[[.Rating.]]</b></td>
					  <td><?php echo Url::get('rating','0');?></td>
					  </tr>
					<tr>
						<td><b>[[.Hitcount.]]</b></td>
						<td><?php echo Url::get('hitcount','0');?></td>
					</tr>
					<tr>
						<td><b>[[.Created.]]</b></td>
						<td><?php echo date('h:i d/m/Y',Url::get('time',time()));?></td>					
					</tr>
					<tr>
						<td><b>[[.Modified.]]</b></td>
						<td><?php echo Url::get('last_time_update')?date('hh:i d/m/Y',Url::get('last_time_update')):'Not modified';?></td>
					</tr>				
				</table>	
				<div id="panel_1" style="margin-top:8px;">
					<span>[[.Parameters_properties.]]</span>
					<table cellpadding="4" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">	
						<tr>
							<td align="right">[[.category_id.]]</td>
							<td align="left"><select name="category_id" id="category_id" class="select-large"></select></td>
						</tr>						
						<tr>
						  <td align="right">Vòng đấu</td>
						  <td align="left"><select name="vong_dau_id" id="vong_dau_id" class="select-large" onChange="EditMediaAdmin.submit();"></select></td>
						  </tr>
              <tr>
						  <td align="right">Cặp đấu</td>
						  <td align="left"><select name="cap_dau_id" id="cap_dau_id" class="select-large">
						    </select></td>
						  </tr>
						<tr>
						<tr>
							<td align="right">[[.image_url.]]</td>
							<td align="left">
								<input name="image_url" type="file" id="image_url" class="file" size="17"><div id="delete_image_url"><?php if(Url::get('image_url') and file_exists(Url::get('image_url'))){?>[<a href="<?php echo Url::get('image_url');?>" target="_blank" style="color:#FF0000">[[.view.]]</a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','link'=>Url::get('image_url')));?>" onclick="jQuery('#delete_image_url').html('');" target="_blank" style="color:#FF0000">[[.delete.]]</a>]<?php }?></div>
							</td>
						</tr>	
						<tr>
							<td align="right">[[.url.]]</td>
							<td align="left"><input name="url" type="text" id="url" class="input-large" size="17"></td>
						</tr>								
						<tr>
						  <td align="right">Mã nhúng</td>
						  <td align="left"><textarea name="embed" id="embed" class="input-large" style="width:240px;height:100px;"></textarea></td>
					  </tr>
						<tr>
							<td align="right">[[.status.]]</td>
							<td align="left"><select name="status" id="status" class="select"></select></td>
						</tr>	
						<tr>
							<td align="right">[[.position.]]</td>
							<td align="left"><input name="position" type="text" id="position" class="input-large" size="17"></td>
						</tr>
						<tr>
							<td align="right">[[.hitcount.]]</td>
							<td align="left"><input name="hitcount" type="text" id="hitcount" class="input-large" size="17"></td>
						</tr>				
					</table>
				</div>	
				<div id="panel_1"  style="margin-top:8px;">
					<table cellpadding="4" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">
						<tr style="display:none;">
						  <td align="right">[[.keywords.]]</td>
						  <td align="left"><input name="keywords" type="text" id="keywords" class="input-large"></td>
						</tr>	
						<tr>
						  <td align="right">[[.tags.]]</td>
						  <td align="left"><textarea name="tags" id="tags" class="input-large" style="width:240px;height:100px;"></textarea></td>
						</tr>					
					</table>
				</div>
			</td>
			<td style="width:1px;"></td>
			<td  style="border:1px solid  #C0C0C0" valign="top">
			<div class="tab-pane-1" id="tab-pane-category">
			<!--LIST:languages-->
			<div class="tab-page" id="tab-page-category-[[|languages.id|]]">
				<h2 class="tab">[[|languages.name|]]</h2>
				<div class="form_input_label">[[.name.]] (<span class="require">*</span>)</div>
				<div class="form_input">
					 <input name="name_[[|languages.id|]]" type="text" id="name_[[|languages.id|]]" class="input-big-huge"  />
				</div>
				<div class="form_input_label">[[.description.]]</div>
				<div class="form_input">
					<textarea id="description_[[|languages.id|]]" name="description_[[|languages.id|]]" cols="75" rows="20" style="width:100%; height:295px;overflow:hidden"><?php echo Url::get('description_'.[[=languages.id=]],'');?></textarea><br />
					<script>advance_mce('description_[[|languages.id|]]');</script>
				</div>
			</div>
			<!--/LIST:languages-->
			</div>
			</td>
	   </tr>
	</table>
  <input  name="save" type="hidden" id="save" value="">
	</form>
</fieldset>