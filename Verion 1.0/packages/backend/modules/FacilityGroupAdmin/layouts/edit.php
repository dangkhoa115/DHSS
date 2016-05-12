<span style="display:none">
	<span id="mi_facility_group_sample">
		<span id="input_group_#xxxx#" style="width:100%;text-align:left;">
			<input  name="mi_facility_group[#xxxx#][id]" type="hidden" id="id_#xxxx#">			
			<span class="multi-input">
				<input name="mi_facility_group[#xxxx#][name]" style="width:385px;" id="name_#xxxx#">
			</span>
			<span class="multi-input"><span style="width:20px;">
				<img src="skins/default/images/buttons/delete.gif" onClick="mi_delete_row($('input_group_#xxxx#'),'mi_facility_group','#xxxx#','group_');return false;" style="cursor:pointer;" align="top">
			</span>
			</span><br clear="all">
		</span>
	</span>
</span>

<fieldset id="toolbar">
	<legend>[[.Manage_hotel.]]</legend>
 	<div id="toolbar-title">		
		[[.Manage_Policy.]]
	</div>	
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <td id="toolbar-save"  align="center"><a onclick="FacilityGroupAdmin.submit();"> <span title="Edit"> </span> [[.Save.]] </a> </td>
		  <td id="toolbar-back"  align="center"><a href="<?php echo Url::build('panel',array('category_id'=>'75'));?>"> <span title="Back"> </span> [[.Back.]] </a> </td>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<form name="FacilityGroupAdmin" id="FacilityGroupAdmin" method="post" enctype="multipart/form-data">
<div class="policy-admin-bound">
	<fieldset>
		<legend>[[.Policy.]]</legend>
			<span id="mi_facility_group_all_elems" style="text-align:left;">
				<span style="background:#CCCCCC; ">
					<span class="multi-input_header"><span style="width:400px;float:left; font-weight:bold">[[.Name.]]</span></span>
					<span class="multi-input_header"><span style="width:205px;float:left; font-weight:bold">[[.Delete.]]</span></span>
					<br>
				</span>
			</span>			
		<input type="button" value="   [[.add_item.]]   " onclick="mi_add_new_row('mi_facility_group');">
		<div style="margin:20px;" >[[|paging|]]</div>
	</fieldset>
</div>
<input type="hidden" name="group_deleted_ids"  id="group_deleted_ids" />
</form>
<script>
	mi_init_rows('mi_facility_group',
		<?php if(isset($_REQUEST['mi_facility_group']))
		{
			echo String::array2js($_REQUEST['mi_facility_group']);
		}
		else
		{
			echo '{}';
		}
		?>
	); 
</script>