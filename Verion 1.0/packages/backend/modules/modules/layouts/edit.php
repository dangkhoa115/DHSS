<form name="EditHotelAdmin" id="EditHotelAdmin" method="post" enctype="multipart/form-data">
<input  type="hidden" name="hotel_id" value="[[|hotel_id|]]" />
<fieldset id="toolbar">
	<legend><?php echo isset($_SESSION['hotel_name'])?$_SESSION['hotel_name']:'Manage hotel'; ?> <img style="height:9px" src="<?php echo Portal::template('booking').'images/'.[[=star=]].'stars.png' ; ?>" /></legend>
 	<div id="toolbar-title">		
		[[.General_information.]]
	</div>	
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <td id="toolbar-save"  align="center"><a onclick="if(check_content()){ EditHotelAdmin.submit(); }"> <span title="Edit"> </span> [[.Save.]] </a> </td>
		  <td id="toolbar-cancel"  align="center"><a href="<?php echo Url::is_admin()?Url::build('manage_hotel'):Url::build('panel');?>#"> <span title="New"> </span> [[.Cancel.]] </a> </td>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br clear="all">
<fieldset id="toolbar">
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>	
	<table cellspacing="4" cellpadding="4" border="0" width="100%" style="background-color:#FFFFFF;">
	<tr>
		<td valign="top">
			<table cellpadding="4" cellspacing="0" border="0" width="100%" style="background-color:#F9F9F9;border:1px solid #D5D5D5">
				<!--IF:is_admin(User::is_admin())-->
                <tr>
                	<td><label for="name">Hotel's name: </label></td><td colspan="2">
					<input name="name" type="text" id="name" style="width:50%;" />
					<label for="star" style="margin-left:10px;">Star: </label>
					<select name="star" id="star"></select>
                    <label for="type" style="margin-left:10px;">Type: </label>
					<select name="type" id="type"></select>
					</td>
                </tr>
                <!--/IF:is_admin-->
                <!--IF:is_admin(User::is_admin())-->
                <tr>
                  <td align="left">[[.website_title.]]</td>
                  <td colspan="2" align="left">
                  	<input name="site_title" type="text" id="site_title" style="width:50%" />
                    <label for="star" style="margin-left:10px;">SHOW: </label>
					<input  name="is_shown" type="checkbox" id="is_shown" value="1">
                    <script>
						jQuery('#is_shown').attr('checked',<?php echo [[=is_shown=]]?1:0;?>);
					</script>
                   </td>
                </tr>
                <tr>
                  <td align="left">[[.keyword.]]</td>
                  <td colspan="2" align="left"><input name="site_keyword" type="text" id="site_keyword" style="width:50%" /></td>
                </tr>
                <tr>
                  <td align="left">[[.quote.]]</td>
                  <td colspan="2" align="left"><input name="site_quote" type="text" id="site_quote" style="width:50%" /></td>
                </tr>
                 <!--/IF:is_admin-->
                <tr>
					<td width="20%" align="left">City(*) </td>
					<td colspan="2" align="left">
						<select name="city_id" id="city_id" onchange="get_district(this)" class="select-large"></select>					    District
					    <select name="district_id" id="district_id" style="width:153px" disabled="disabled">
			        </select></td>
				</tr>
				<tr>
				  <td align="right"><span style="color:#FF0000;cursor:pointer;"><img src="skins/default/images/googlemaps.png" width="32" align="absmiddle" /></span></td>
				  <td align="left" colspan="2"><div onclick="show_map();" style="color:#FF0000;cursor:pointer;"> [[.select_from_map.]]</div></td>
			  </tr>
				<tr>
					<td width="20%" align="left"></td>
					<td width="28%" align="left" colspan="1"><input type="text" name="lat" id="lat" value="<?php echo Url::get('latitude'); ?>" />
					  <label> Latitude</label></td>
					<td width="55%" align="left"><input type="text" name="long" id="long" value="<?php echo Url::get('longtitude'); ?>" /><label> Longtitude</label></td>
				</tr>
			</table>
			<table  cellpadding="4" cellspacing="0" border="0" width="100%" style="background-color:#F9F9F9;border:1px solid #D5D5D5;margin-top:8px;" align="center">
<tr>
					<td>
					<div class="tab-pane-1" id="tab-pane-category">
						<div class="form_input_label">[[.address.]]</div>
						<div class="form_input">
							 <input name="street" type="text" id="street" style="width:95%;border:1px solid #CCCCCC;"  />
						</div>
						<div class="form_input_label">[[.brief.]]</div>
						<div class="form_input">
							<textarea id="brief" name="brief" cols="75" rows="20" style="width:98%; height:120px;overflow:hidden"><?php echo Url::get('brief'); ?></textarea><br />
							<script>simple_mce('brief');</script>
						</div>
						<div class="form_input_label">[[.description.]]</div>
						<div class="form_input">
							<textarea id="description" name="description" cols="75" rows="20" style="width:98%; height:250px;overflow:hidden"><?php echo Url::get('description'); ?></textarea><br />
							<script>simple_mce('description');</script>
						</div>
						<div class="form_input_label"><input type="checkbox" <?php if(Url::get('show_food_bebagage')){ echo 'checked="checked"';} ?> name="show_food_bebagage" onclick="Show(this,'food_bebagage_bound')" /> [[.food_bebagage.]]</div>
						<div class="form_input" id="food_bebagage_bound" <?php if(!Url::get('show_food_bebagage')){ echo 'style="display:none"';} ?>>
							<textarea id="food_bebagage" name="food_bebagage" cols="75" rows="20" style="width:98%; height:120px;overflow:hidden"><?php echo Url::get('food_bebagage');?></textarea><br />
							<script>simple_mce('food_bebagage');</script>
						</div>
						<div class="form_input_label"><input type="checkbox" <?php if(Url::get('show_room_information')){ echo 'checked="checked"';} ?> name="show_room_information" onclick="Show(this,'room_information_bound')" /> [[.Room_information.]]</div>
						<div class="form_input" id="room_information_bound" <?php if(!Url::get('show_room_information')){ echo 'style="display:none"';} ?>>
							<textarea id="room_information" name="room_information" cols="75" rows="20" style="width:98%; height:120px;overflow:hidden"><?php echo Url::get('room_information');?></textarea><br />
							<script>simple_mce('room_information');</script>
						</div>
						<div class="form_input_label"><input type="checkbox" <?php if(Url::get('show_important_information')){ echo 'checked="checked"';} ?> name="show_important_information" onclick="Show(this,'important_information_bound')" /> [[.important_information.]]</div>
						<div class="form_input" id="important_information_bound" <?php if(!Url::get('show_important_information')){ echo 'style="display:none"';} ?>>
							<textarea id="important_information" name="important_information" cols="75" rows="20" style="width:98%; height:120px;overflow:hidden"><?php echo Url::get('important_information');?></textarea><br />
							<script>simple_mce('important_information');</script>
						</div>
						<div class="form_input_label"><input type="checkbox" <?php if(Url::get('show_area_information')){ echo 'checked="checked"';} ?> name="show_area_information" onclick="Show(this,'area_information_bound')" /> [[.area_information.]]</div>
						<div class="form_input" id="area_information_bound" <?php if(!Url::get('show_area_information')){ echo 'style="display:none"';} ?>>
							<textarea id="area_information" name="area_information" cols="75" rows="20" style="width:98%; height:120px;overflow:hidden"><?php echo Url::get('area_information');?></textarea><br />
							<script>simple_mce('area_information');</script>
						</div>
					</div>						
					</td>
			   </tr>
			</table>				
		</td>
		<td valign="top" style="width:300px;">
			<table width="100%" style="border: 1px dashed silver;" cellpadding="4" cellspacing="2">
			<tr>
			  <td colspan="2" bgcolor="#FFFFCC"><strong>Người liên hệ</strong></td>
			  </tr>
			<tr>
			  <td>[[.Full_name.]]</td>
			  <td>[[|contact_full_name|]]</td>
			  </tr>
			<tr>
			  <td>[[.gender.]]</td>
			  <td>[[|contact_gender|]]</td>
			  </tr>
			<tr>
			  <td>[[.job_title.]]</td>
			  <td>[[|contact_position|]]</td>
			  </tr>
			<tr>
			  <td>[[.birth_date.]]</td>
			  <td>[[|contact_birth_date|]]</td>
			  </tr>
			<tr>
			  <td>[[.mobile_phone.]]</td>
			  <td>[[|contact_telephone|]]</td>
			  </tr>
			<tr>
			  <td>[[.email.]]</td>
			  <td>[[|contact_email|]]</td>
			  </tr>
			<tr>
			  <td colspan="2" bgcolor="#FFFFCC">&nbsp;</td>
			  </tr>
			<tr>
				<td><strong>[[.is_active.]]</strong></td>
				<td><?php echo Url::get('is_active','0');?></td>				
			</tr>
			<tr>
				<td><strong>[[.Type_of_accommodation.]]</strong></td>
				<td>[[|accommodation|]]</td>				
			</tr>
			<tr>
			  <td><strong>[[.Mark.]]</strong></td>
			  <td><?php echo intval(Url::get('mark','0'))/10;?></td>
			  </tr>
			<tr>
				<td><strong>[[.Review.]]</strong></td>
				<td><?php echo Url::get('review','0');?></td>
			</tr>
			<tr>
				<td><strong>[[.Register_date.]]</strong></td>
				<td><?php echo date('d/m/Y',Url::get('time',time()));?></td>					
			</tr>
			<tr>
				<td><strong>[[.Modified.]]</strong></td>
				<td><?php echo Url::get('last_time_update')?date('h\h:i d/m/Y',Url::get('last_time_update')):'Not modified';?></td>
			</tr>				
			</table>
			<div id="panel">
				<div id="panel_1"  style="margin-top:8px;">
				<span>[[.images.]]</span>
				<table cellpadding="4" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">
					<tr><td colspan="2" align="center"><img src="[[|image_url|]]" style="width:250px;" onerror="this.src='skins/default/images/no_image.jpg'"></td></tr>
				  <tr>
					<td width="40%" align="right" valign="top" nowrap="nowrap">[[.image_url.]]</td>
						<td width="60%" align="left">
							<input name="image_url" type="file" id="image_url" class="file" size="18">
							<!--<div id="delete_image_url"><?php //if(Url::get('image_url') and file_exists(Url::get('image_url'))){?>[<a href="<?php //echo Url::get('image_url');?>" target="_blank" style="color:#FF0000">[[.view.]]</a>]&nbsp;[<a href="<?php //echo Url::build_current(array('cmd'=>'unlink','link'=>Url::get('image_url')));?>" onclick="jQuery('#delete_image_url').html('');" target="_blank" style="color:#FF0000">[[.delete.]]</a>]<?php //}?></div>-->
						</td>
					</tr>
				</table>
				</div>
				<div id="panel_1"  style="margin-top:8px;">
				<span>[[.Other_information.]]</span>
				<table cellpadding="4" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">
					<tr style="background:#E6EDF6">	<td>[[.Website.]]</td><td><input name="website" type="text" id="website" style="width:90%" /></td></tr>
					<tr style="background:#E6EDF6">	<td nowrap="nowrap">[[.number_of_room.]]</td><td colspan="2"><input name="number_of_room" type="text" id="number_of_room" style="width:90%" /></td></tr>
					<tr style="background:#E6EDF6">	<td>[[.telephone.]]</td><td><input name="telephone" type="text" id="telephone" style="width:90%" /></td></tr>
					<tr style="background:#E6EDF6">	<td>[[.fax.]]</td><td><input name="fax" type="text" id="fax" style="width:90%" /></td></tr>
					<tr style="background:#E6EDF6">
						<td colspan="2">[[.themes.]]</td>
					</tr>
					<!--LIST:themes-->
					<tr>
						<td width="1%"><input type="checkbox" <?php if("checked"==[[=themes.checked=]]) echo 'checked="checked"'; ?> name="themes[[[|themes.hotel_theme_id|]]]" id="themes_[[|themes.id|]]" value="[[|themes.id|]]" /></td>
						<td>[[|themes.name|]]</td>
					</tr>
					<!--/LIST:themes-->
					
					<tr style="background:#E6EDF6">
						<td colspan="2">[[.Accept_credit_card.]]</td>
					</tr>
					<!--LIST:credit_cards-->
					<tr>
						<td width="1%"><input type="checkbox" <?php if("checked"==[[=credit_cards.checked=]]) echo 'checked="checked"'; ?> name="credit_cards[[[|credit_cards.hotel_credit_card_id|]]]" id="credit_cards_[[|credit_cards.id|]]" value="[[|credit_cards.id|]]" /></td>
						<td>[[|credit_cards.name|]]</td>
					</tr>
					<!--/LIST:credit_cards-->
				</table>
				</div>
				<div id="panel_1"  style="margin-top:8px; display:none">
				<span>[[.Metadata_information.]]</span>
				<table cellpadding="4" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">
					<tr>
						<td width="30%" align="right">[[.keywords.]]</td>
					  <td width="70%" align="left"><input name="keywords" type="text" id="keywords" class="input-large"></td>
					</tr>	
					<tr>
						<td width="30%" align="right">[[.tags.]]</td>
					  <td width="70%" align="left"><input name="tags" type="text" id="tags" class="input-large"></td>
					</tr>					
				</table>
				</div>
			</div>
		</td>
	</tr>
	</table>
</fieldset>
<div class="position-info" lat="<?php echo Url::get('latitude'); ?>" long="<?php echo Url::get('longtitude'); ?>" zoom="15"></div>
<input type="hidden" name="radius" id="radius" />
</form>
<script>
	function change_zone(zone_id){
		jQuery.ajax({
			type: "POST",
			url: "<?php echo Url::build('area_admin',array('cmd'=>'get_zone_id'));?>",
			data: "zone_id="+zone_id,
			success: function(msg){
				eval(msg);
				jQuery('.position-info').attr({'lat':lat,'long':long,'zoom':zoom});
			}
		});
	}
	function show_map()
	{
		var lat = jQuery('.position-info').attr('lat');
		var long = jQuery('.position-info').attr('long');
		var zoom = jQuery('.position-info').attr('zoom');
		window.open('<?php echo Url::build('show_map');?>&lat='+lat+'&long='+long+'&zoom='+zoom,'show_map','status=1,resizable=0,width=600,height=500,left=300,top=100');
	}
	function check_content()
	{
		value = jQuery('#zone_id').attr('value');
		if(value=='' || value==0)
		{
			alert('you must select city before save');
			return false;
		}else
		{
			return true;
		}
	}
	function get_district(obj)
	{
		if(obj.id != 0)
		{
			jQuery.ajax({
				method: "POST",
				url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
				data : {
					cmd:'get_district',
					city_id:obj.value
				},
				beforeSend: function(){
					jQuery('#district_id').html('<option>loading.....</option>');
				},
				success: function(content){
					//autocomplate({zone_id:obj.value});
					if(content=='false')
					{
						jQuery('#district_id').html('<option value="0">Select district</option>').attr('disabled','disabled');
					}else
					{
						jQuery('#district_id').html(content).removeAttr('disabled');
					}
				}
			});
		}
	}
	function Show(obj,id)
	{
		if(obj.checked)
		{
			jQuery('#'+id).css('display','');
		}else{
			jQuery('#'+id).css('display','none');
		}
	}
	<?php if(Url::get('city_id')){?>
		jQuery('#district_id').attr('disabled',false);
	<?php }?>
</script>