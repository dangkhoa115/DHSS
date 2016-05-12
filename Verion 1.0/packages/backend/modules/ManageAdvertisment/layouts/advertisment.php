<script type="text/javascript" src="skins/ssnh/scripts/datetimepicker.js"></script>
<link type="text/css" href="skins/ssnh/styles/datetimepicker.css" rel="stylesheet" />
<script>	
	function make_cmd(cmd)
	{
		jQuery('#cmd').val(cmd);
		document.ManageAdvertisment.submit();
	}
	jQuery(document).ready(function(){
		jQuery('#start_time').datepicker({ yearRange: '2008:2020' });
		jQuery('#end_time').datepicker({ yearRange: '2008:2020' });
	});	
</script>
<fieldset id="toolbar">
	<legend>[[.content_manage_system.]]</legend>
	<div id="toolbar-title" style="width:600px;">[[.manage_advertisment.]] <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span></div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_edit(false,ANY_CATEGORY)){?><td id="toolbar-save"  align="center"><a onclick="ManageAdvertisment.submit();"> <span title="Save"> </span> [[.Save.]] </a> </td><?php }?>
		   <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-cancel"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'list'));?>#"> <span title="Cancel"> </span> [[.Cancel.]] </a> </td><?php }?>
		   <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
	<form name="ManageAdvertisment" method="post">
		<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
		  <tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
			<th width="76%" height="25" align="left"><a style="text-decoration:none">[[.chose_page.]]:&nbsp;
		    <select name="page_name" id="page_name" onchange="location='<?php echo Url::build_current();?>&cmd=advertisment<?php if(Url::get('id')){echo '&id='.Url::get('id');}?>&page_name='+this.value;"></select></a></th>
			<th width="24%" align="left"><a>[[.category.]]</a></th>
		  </tr>
		  <tr style="padding:10px">
			<td valign="top">
				<table width="100%" cellspacing="0" cellpadding="2"  border="1" bordercolor="#E7E7E7" align="center">
						<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
						  <td>[[.region.]]</td>
						  <td>[[.position.]]</td>
				 		 </tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
				  </tr>
						<tr>
							<td><select name="region" id="region" class="select-large"></select></td>
							<td><input name="position" type="text" id="position" class="input-large"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
							<td height="25" style="border-right:1px solid #ECE9D8">[[.start_time.]]</td>
							<td>[[.end_time.]]</td>
						</tr>			
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><input name="start_time" type="text" id="start_time" size="20"  class="input-large"></td>
							<td><input name="end_time" type="text" id="end_time" size="20" class="input-large"/></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp; </td>
						</tr>
						<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
							<td colspan="2">[[.list_advertisment.]]</td>
						</tr>						
						<tr>
							<td colspan="2">
								<div style="width:100%;height:300px;overflow:auto">
									<!--LIST:items-->
										<div style="float:left;width:70px;margin:8px;border:1px solid #E7E7E7;padding:2px;padding-bottom:0px;">
											<div>
											<?php 
												if(preg_match_all('/.swf/',[[=items.image_url=]],$matches))
												{
													echo '<embed src="'.[[=items.image_url=]].'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="70" height="70"></embed>';
												}
												else
												{
													echo '<img src="'.[[=items.image_url=]].'" width="70" height="70" onerror="this.src=\'skins/default/images/no_image.gif\'">';
												}
											?>
											</div>
											<div>
											<?php if([[=items.id=]] == Url::get('item_id')){?>
												<input name="item_list_[[|items.id|]]" type="checkbox" id="item_list_[[|items.id|]]" checked="checked">
											<?php }else{?>	
												<input name="item_list_[[|items.id|]]" type="checkbox" id="item_list_[[|items.id|]]">
											<?php }?>
												<span><?php echo String::display_sort_title([[=items.name=]],2);?></span>
											</div>
										</div>	
									<!--/LIST:items-->
								</div>
							</td>
						</tr>					
					</table>			
			</td>
			<td width="24%" valign="top">
				<select name="categories[]"<?php if(!URL::get('id')) echo ' size="20"  multiple="multiple" style="width:290px;height:510px;border:1px solid #E7E7E7;padding-left:10px;"';?> style="width:290px;" id="categories[]"></select>			 
				<?php if(Url::get('category_id')){?><script>document.getElementById("categories[]").value = '<?php echo Url::get('category_id');?>';</script><?php }?>
			</td>
		 </tr>
	  </table>
	</form>
</fieldset>	