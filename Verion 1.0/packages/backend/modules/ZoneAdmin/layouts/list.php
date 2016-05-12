<script>
	function check_selected()
	{
		var status = false;
		jQuery('form :checkbox').each(function(e){
			if(this.checked)
			{
				status = true;
			}
		});	
		return status;
	}
	function make_cmd(cmd)
	{
		jQuery('#cmd').val(cmd);
		document.ListCategoryForm.submit();
	}
</script>
<form method="post" name="SearchCategoryForm" id="SearchCategoryForm" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
<fieldset id="toolbar">
	<legend>[[.content_manage_system.]]</legend>
	<div id="toolbar-title">
		<?php echo Portal::language(Url::sget('page'));?> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table width="50%">
	  <tbody>
		<tr>
		<?php 
		if(URL::get('cmd')=='delete' and User::can_delete(false,ANY_CATEGORY)){?> 
		 	<td id="toolbar-trash"  align="center"><a onclick="$('cmd').cmd='delete';ListCategoryForm.submit();" > <span title="Trash"> </span> [[.Trash.]] </a> </td>
			<td id="toolbar-back"  align="center"><a href="<?php echo URL::build_current();?>"> <span title="Back"> </span> [[.Back.]] </a> </td>
		<?php 
		}else{ 
		if(User::can_add(false,ANY_CATEGORY) and Url::sget('page')!='portal_category'){?>
				<td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'add')); if(Url::get('countries')) echo '&countries='.Url::get('countries');?>#"> <span title="New"> </span> [[.New.]] </a> </td>
			<?php }?>
		<?php if(User::can_delete(false,ANY_CATEGORY)){?>
		 <td id="toolbar-trash"  align="center"><a  onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> [[.Trash.]] </a> </td>
		<?php }
		}?>
		  <td id="toolbar-publish" align="center"><a href="<?php echo Url::build_current(array('cmd'=>'cache'));?>#"> <span title="[[.Cache.]]"> </span> [[.Cache.]] </a> </td>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td>
          <td align="right" width="70%">[[.city.]]: 
            <select name="city_id" id="city_id" onchange="document.SearchCategoryForm.submit();"></select></td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
</form>	
<br>
<fieldset id="toolbar">
	<form name="ListCategoryForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<a name="top_anchor"></a>		
		<table cellpadding="4" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
		<thead>
				<tr valign="middle" bgcolor="<?php echo Portal::get_setting('crud_list_item_bgcolor','#F0F0F0');?>" style="line-height:20px">
				<th width="1%" title="[[.check_all.]]"><input type="checkbox" value="1" id="Category_all_checkbox" onclick="select_all_checkbox(this.form,'Category',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th />
                <!--IF:check_flag([[=check_flag=]])-->
                <th><a>Flag</a></th>
                <!--/IF:check_flag-->
                <th>&nbsp;</th>
				<th nowrap align="left">
					<a title="[[.sort.]]" href="<?php echo URL::build_current(((URL::get('order_by')=='category.name_'.Portal::language() and URL::get('order_dir')!='desc')?array('order_dir'=>'desc'):array())+array('order_by'=>'category.name_'.Portal::language()));?>" >
					<?php if(URL::get('order_by')=='category.name_'.Portal::language()) echo '<img alt="" src="skins/default/images/buttons/'.((URL::get('order_dir')!='desc')?'down':'up').'_arrow.gif">';?>
					[[.name.]]					</a>				</th>				
				<th nowrap align="left"><a>[[.latitude.]]</a></th>
				<th nowrap align="left"><a>[[.longitude.]]</a></th>
                <th nowrap align="left"><a>[[.type.]]</a></th>
				<th nowrap align="left">
					<a href="<?php echo URL::build_current(((URL::get('order_by')=='category.status' and URL::get('order_dir')!='desc')?array('order_dir'=>'desc'):array())+array('order_by'=>'category.status'));?>" title="[[.sort.]]">
					<?php if(URL::get('order_by')=='category.status') echo '<img alt="" src="skins/default/images/buttons/'.((URL::get('order_dir')!='desc')?'down':'up').'_arrow.gif">';?>
					[[.status.]]					</a>				</th>
				<?php if(User::can_edit(false,ANY_CATEGORY))
				{?>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<?php }?>
			</tr>
			</thead>
			<tbody>
			<!--LIST:items-->
			<?php $onclick = 'location=\''.URL::build_current().'&cmd=edit&id='.urlencode([[=items.id=]]).'\';"';?>
			<tr bgcolor="<?php if((URL::get('just_edited_id',0)==[[=items.id=]]) or (is_numeric(array_search(MAP['items']['current']['id'],[[=just_edited_ids=]])))){ echo '#F7F7F7';} else {echo 'white';}?>" valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if([[=items.i=]]%2){echo 'background-color:#F9F9F9';}?>" id="Category_tr_[[|items.id|]]">
				<td><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'Category',this,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');" id="Category_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td />
                 <!--IF:check_flag([[=check_flag=]])-->
                <td width="1%" nowrap="nowrap"><!--IF:flag([[=items.flag=]] and file_exists([[=items.flag=]]))--><img src="[[|items.flag|]]" style="width:24px;" /><!--/IF:flag--></td>
                <!--/IF:check_flag-->
				<td width="1%" nowrap="nowrap"><img src="[[|items.image_url|]]" style="width:30px;" onerror="this.src='skins/default/images/no_image.jpeg'"></td>
				<td align="left" nowrap <?php if(User::can_edit(false,ANY_CATEGORY) and Url::sget('page')!='portal_category'){?> <?php }?>>
                    [[|items.indent|]]
                    [[|items.indent_image|]]
                    <span class="page_indent">&nbsp;</span>
                    <a href="<?php echo Url::build_current().'&cmd=edit&id='.[[=items.id=]]; if(Url::get('countries')) echo '&countries='.Url::get('countries');?>">[[|items.name|]]</a>
                </td>
				<td>[[|items.lat|]]</td>
				<td>[[|items.long|]]</td>
                <td>[[|items.type|]]</td>
				<td nowrap align="left">
						[[|items.status|]]					</td>
				<?php if(User::can_edit(false,ANY_CATEGORY))
				{?><td width="24px" align="center">[[|items.move_up|]]</td>
				<td width="24px" align="center">[[|items.move_down|]]</td>
				<?php }?>
			</tr>
			<!--/LIST:items-->
			</tbody>
		</table>
		<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
	  <tr>
			<td align="left">
			[[.select.]]:&nbsp;
			<a onclick="select_all_checkbox(document.ListCategoryForm,'Category',true,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_all.]]</a>&nbsp;
			<a onclick="select_all_checkbox(document.ListCategoryForm,'Category',false,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_none.]]</a>
			<a onclick="select_all_checkbox(document.ListCategoryForm,'Category',-1,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_invert.]]</a>
			</td>
		</tr>
		</table>				
		<table width="100%" class="table_page_setting">
		</table>
		<input type="hidden" name="cmd" value="" id="cmd"/>
</form>
		
</fieldset>