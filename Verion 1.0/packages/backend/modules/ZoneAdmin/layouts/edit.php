<fieldset id="toolbar">
	<legend>[[.content_manage_system.]]</legend>
	<div id="toolbar-title">
		<a href="<?php echo Url::build('zone_admin');?>">[[.zone_admin.]]</a> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>	
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		<td id="toolbar-save"  align="center"><a onclick="EditCategoryForm.submit();" > <span title="save"> </span> [[.save.]] </a> </td>
		 <td id="toolbar-back"  align="center"><a href="<?php echo URL::build_current();?>"> <span title="Back"> </span> [[.Back.]] </a> </td>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
		<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
		<form name="EditCategoryForm" method="post" enctype="multipart/form-data" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<input type="hidden" name="confirm_edit" value="1" />
		<table cellspacing="4" cellpadding="4" border="0" width="100%" style="background-color:#FFFFFF;">
		<tr>
		  <td valign="top">
			<table  cellpadding="4" cellspacing="0" border="0" width="100%" style="background-color:#F9F9F9;border:1px solid #D5D5D5" align="center">
			<tr>
				<td>
					<div class="form_input_label">[[.name.]] (<span class="require">*</span>)</div>
					<div class="form_input">
						<input name="name" type="text" id="name" style="width:50%" >
					</div>
					<div class="form_input_label">[[.description.]]</div>
					<div class="form_input">
						<textarea id="description" name="description" cols="75" rows="20" style="width:99%; height:350px;overflow:hidden"><?php echo Url::get('description');?></textarea><br />
						<script>advance_mce('description');</script>					
					</div>
				</td>
			   </tr>
			</table>				
		</td>
		<td valign="top" style="width:320px;">
		<table width="100%" style="border: 1px dashed silver;" cellpadding="4" cellspacing="2">
				<tr>
					<td><strong>[[.Status.]]</strong></td>
					<td><?php echo Url::get('status','0');?></td>				
				</tr>
				<tr>
					<td><strong>[[.Created.]]</strong></td>
					<td><?php echo date('h\h:i d/m/Y',Url::get('time',time()));?></td>					
				</tr>
				<tr>
					<td><strong>[[.Modified.]]</strong></td>
					<td><?php echo Url::get('last_time_update')?date('h\h:i d/m/Y',Url::get('last_time_update')):'Not modified';?></td>
				</tr>
                <tr>
				  <td align="left">[[.website_title.]]</td>
				  <td><input name="site_title" type="text" id="site_title" style="width:220px;" /></td>
    		    </tr>
    				<tr>
    				  <td align="left">[[.keyword.]]</td>
    				  <td><input name="site_keyword" type="text" id="site_keyword" style="width:220px;" /></td>
    		    </tr>
    				<tr>
    				  <td align="left">[[.quote.]]</td>
    				  <td><textarea name="site_quote" id="site_quote" style="width:220px;" rows="3"></textarea></td>
    		    </tr>
				</table>
		<div id="panel_1" style="margin-top:8px;">
			<span>[[.Parameters_article.]]</span>
			<table cellpadding="4" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9" style="margin-top:2px;">
				<tr>
					<td width="1%" nowrap="nowrap">[[.zone_parent.]]</td>
					<td><select name="parent_id" id="parent_id" class="select-large" onchange="change_zone(this.value);"></select></td>				
				</tr>
				<tr>
					<td>[[.type.]]</td>
					<td><select name="type" id="type" class="select-large"></select></td>
				</tr>
				<tr>
				  <td>[[.view_map.]]</td>
				  <td>
				  <div onclick="show_map();" style="color:#FF0000;cursor:pointer;text-decoration:underline">[[.select_map.]]</div>
				  </td>
			  </tr>
				<tr>
					<td>[[.latitude.]]</td>
					<td><input name="lat" type="text" id="lat" class="input-large"></td>				
				</tr>
				<tr>
					<td>[[.longitude.]]</td>
					<td><input name="long" type="text" id="long" class="input-large"></td>				
				</tr>
				<tr>
					<td>[[.radius.]]</td>
					<td><input name="radius" type="text" id="radius" class="input-large"></td>				
				</tr>
				<tr>
					<td>[[.status.]]</td>
					<td><select name="status" id="status"  class="select"></select></td>				
				</tr>
				<tr>
				  <td colspan="2" valign="top"><!--IF:cond(isset([[=image_url=]]))--><img src="[[|image_url|]]" style="width:300px; height:180px;" /><!--/IF:cond--></td>
			  </tr>
				<tr>
					<td valign="top">[[.image_url.]]</td>
					<td>
						<input name="image_url" type="file" id="image_url" class="file" size="18"><div id="delete_image_url"><?php if(Url::get('image_url') and file_exists(Url::get('image_url'))){?>[<a href="<?php echo Url::get('image_url');?>" target="_blank" style="color:#FF0000">[[.view.]]</a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','link'=>Url::get('image_url')));?>" onclick="jQuery('#delete_image_url').html('');" target="_blank" style="color:#FF0000">[[.delete.]]</a>]<?php }?></div>					</td>				
				</tr>
				<tr>
					<td valign="top">[[.map.]]</td>
					<td>
						<input name="map" type="file" id="map" class="file" size="18"><div id="delete_map"><?php if(Url::get('map') and file_exists(Url::get('map'))){?>[<a href="<?php echo Url::get('map');?>" target="_blank" style="color:#FF0000">[[.view.]]</a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','link'=>Url::get('map')));?>" onclick="jQuery('#delete_map').html('');" target="_blank" style="color:#FF0000">[[.delete.]]</a>]<?php }?></div>					</td>				
				</tr>
				<tr>
					<td valign="top">[[.Flag.]]</td>
					<td>
						<input name="flag" type="file" id="flag" class="file" size="18"><div id="delete_flag"><?php if(Url::get('flag') and file_exists(Url::get('flag'))){?>[<a href="<?php echo Url::get('flag');?>" target="_blank" style="color:#FF0000">[[.view.]]</a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','link'=>Url::get('flag')));?>" onclick="jQuery('#delete_flag').html('');" target="_blank" style="color:#FF0000">[[.delete.]]</a>]<?php }?></div>					</td>				
				</tr>
			</table>
		  </div>
		</td>
		</tr>
		</table>
	</form>
</fieldset>
<div class="zone-info" lat="[[|parent_lat|]]" long="[[|parent_long|]]" zoom="[[|parent_zoom|]]"></div>
<script>
function show_map()
{
	var lat = jQuery('.zone-info').attr('lat');
	var long = jQuery('.zone-info').attr('long');
	var zoom = jQuery('.zone-info').attr('zoom');
	window.open('<?php echo Url::build('show_map');?>&lat='+lat+'&long='+long+'&zoom='+zoom,'show_map','status=1,resizable=0,width=600,height=500');
}
function change_zone(zone_id)
{
	jQuery.ajax({
		type: "POST",
		url: "<?php echo Url::build('zone_admin',array('cmd'=>'get_zone_id'));?>",
		data: "zone_id="+zone_id,
		success: function(msg){
			eval(msg);
			jQuery('.zone-info').attr({'lat':lat,'long':long,'zoom':zoom});
			makeRegion(arr);
		}
	});
}
function makeRegion(arr){
	var str = '';
	for(i in arr)
	{
		str += '<option value="'+i+'">'+arr[i]+'</option>'
	}
	jQuery('#region_id').html(str);
}
</script>