<form method="post" name="SearchCategoryForm">
<table cellpadding="15" cellspacing="0" width="100%" border="0" bordercolor="#CCCCCC" class="table-bound">
	<tr>
		<td width="35%" class="form-title">[[.list_all_function_of_system.]]</td>
		<td width="1%" align="right"><a href="<?php echo URL::build_current(array('cmd'=>'export_cache'));?>" class="button-medium-export">[[.cache.]]</a></td>
		<?php 
		if(URL::get('cmd')=='delete' and User::can_delete(false,ANY_CATEGORY)){?>
		<td width="1%"><a onclick="$('cmd').cmd='delete';ListCategoryForm.submit();"  class="button-medium-delete">[[.Delete.]]</a></td>
		<td width="1%"><a href="<?php echo URL::build_current();?>"  class="button-medium-back">[[.back.]]</a></td>
		<?php 
		}else{ 
		if(User::can_add(false,ANY_CATEGORY)){?>
		<td width="1%"><a href="<?php echo URL::build_current(array('cmd'=>'add'));?>"  class="button-medium-add">[[.Add.]]</a></td>
		<?php }?>
		<?php if(User::can_delete(false,ANY_CATEGORY)){?>
		<td width="1%"><a onclick="ListCategoryForm.cmd.value='delete';ListCategoryForm.submit();"  class="button-medium-delete">[[.Delete.]]</a></td>
		<?php }
		}?>
	</tr>
</table>
</form>	
<form name="ListCategoryForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
	<a name="top_anchor"></a>		
	<table cellpadding="2" cellspacing="0" width="100%" border="1" bordercolor="<?php echo Portal::get_setting('crud_list_item_frame_color','#C3C3C3');?>">
		<thead>
			<tr valign="middle" bgcolor="<?php echo Portal::get_setting('crud_list_item_bgcolor','#E6E6E6');?>" style="line-height:20px">
				<th width="1%" title="[[.check_all.]]" align="left">
				<input type="checkbox" value="1" id="Category_all_checkbox" onclick="select_all_checkbox(this.form,'Category',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th />
				<th width="1%">&nbsp;</th />
				<th width="70%" align="left" nowrap>
				  <a title="[[.sort.]]" href="<?php echo URL::build_current(((URL::get('order_by')=='item_category.name_'.Portal::language() and URL::get('order_dir')!='desc')?array('order_dir'=>'desc'):array())+array('order_by'=>'item_category.name_'.Portal::language()));?>" >
			    <?php if(URL::get('order_by')=='item_category.name_'.Portal::language()) echo '<img alt="" src="skins/default/images/buttons/'.((URL::get('order_dir')!='desc')?'down':'up').'_arrow.gif">';?>
		    [[.name.]]					</a>				</th>
				<th width="1%" align="left" nowrap>&nbsp;</th>
				<th width="1%" align="left" nowrap>&nbsp;</th>
				<th width="1%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0;?>
			<!--LIST:items-->
			<?php $onclick = 'location=\''.URL::build_current().'&cmd=edit&id='.([[=items.id=]]).'\';"';?>
			<tr bgcolor="<?php if(true){ echo Portal::get_setting('crud_just_edited_item_bgcolor','#F7F7F7');} else {echo Portal::get_setting('crud_item_bgcolor','white');}?>" valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?>  style="cursor:hand;" id="Category_tr_[[|items.id|]]">
				<td align="left">
        	<!--IF:cond([[=items.can_delete=]])-->
        	<input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'Category',this,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');" id="Category_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>>
          <!--/IF:cond-->
        </td />
				<td width="1%" align="left"><!--IF:cond([[=items.icon_url=]])--><img src="[[|items.icon_url|]]" width="32"><!--/IF:cond--></td />
				<td align="left" nowrap onclick="window.location='<?php echo Url::build_current().'&cmd=edit&id='.[[=items.id=]];?>'">
				  [[|items.indent|]]
				  [[|items.indent_image|]]
				  <span class="page_indent">&nbsp;</span>
			  [[|items.name|]]</td>
				<td align="left" nowrap <?php echo $onclick;?>>[[|items.status|]]</td>
				<td align="left" nowrap <?php echo $onclick;?>>[[|items.move_up|]]</td>
				<td align="center">[[|items.move_down|]]</td>
			</tr>
			<!--/LIST:items-->
		</tbody>
	</table>
	<table width="100%">
	  <tr>
			<td width="100%">
			[[.select.]]:&nbsp;
			<a onclick="select_all_checkbox(document.ListCategoryForm,'Category',true,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_all.]]</a>&nbsp;
			<a onclick="select_all_checkbox(document.ListCategoryForm,'Category',false,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_none.]]</a>
			<a onclick="select_all_checkbox(document.ListCategoryForm,'Category',-1,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_invert.]]</a>
			</td>
			<td>
			<a name="bottom_anchor" href="#top_anchor"><img alt="" src="skins/default/images/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a>
			</td>
		</tr>
	</table>		
	<input type="hidden" name="cmd" value="" id="cmd"/>
	<!--IF:delete(URL::get('cmd')=='delete')-->
	<input type="hidden" name="confirm" value="1" />
	<!--/IF:delete-->
</form>
