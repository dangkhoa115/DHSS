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
		document.ListLanguageForm.submit();
	}
</script><fieldset id="toolbar">
	<legend>[[.config_manage.]]</legend>
	<div id="toolbar-info">
		[[.language.]] <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		<?php 
		if(URL::get('cmd')=='delete' and User::can_delete(false,ANY_CATEGORY)){?> 
		 	<td id="toolbar-trash"  align="center"><a onclick="ListLanguageForm.cmd.value='delete';ListLanguageForm.submit();"> <span title="Trash"> </span> [[.Trash.]] </a> </td>
			<td id="toolbar-back"  align="center"><a href="<?php echo URL::build_current();?>"> <span title="Back"> </span> [[.Back.]] </a> </td>
		<?php 
		}else{ 
		if(User::can_add(false,ANY_CATEGORY)){?>
				<td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'add'));?>#"> <span title="New"> </span> [[.New.]] </a> </td>
			<?php }?>
		<?php if(User::can_delete(false,ANY_CATEGORY)){?>
		 <td id="toolbar-trash"  align="center"><a  onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> [[.Trash.]] </a> </td>
		<?php }
		}?>
		  <td id="toolbar-publish" align="center"><a href="<?php echo Url::build_current(array('cmd'=>'cache'));?>#"> <span title="[[.Cache.]]"> </span> [[.Cache.]] </a> </td>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
	<table cellpadding="0" cellspacing="0" width="100%" align="center">
	<tr >
		<td width="100%">
			<form name="ListLanguageForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
			<input name="cmd" type="hidden" id="cmd" />
			<input name="confirm" type="hidden" id="confirm" value="1"/>
			<table  cellspacing="0" width="100%">
			<tr>
				<td width="100%">
					<a name="top_anchor"></a>
					<table cellpadding="5" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
					
						<tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
							<th width="3%" title="[[.check_all.]]"><input type="checkbox" value="1" id="Language_all_checkbox" onclick="select_all_checkbox(this.form, 'Language',this.checked,'#FFFFEC','white');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
							<th width="32%" align="left" nowrap >
								<a href="<?php echo URL::build_current(((URL::get('order_by')=='language.code' and URL::get('order_dir')!='desc')?array('order_dir'=>'desc'):array())+array('order_by'=>'language.code'));?>" title="[[.sort.]]">
								<?php if(URL::get('order_by')=='language.code') echo '<img src="'.'skins/default/images/buttons/'.((URL::get('order_dir')!='desc')?'down':'up').'_arrow.gif" alt="">';?>								[[.code.]]								</a>							</th><th width="53%" align="left" nowrap >
								<a href="<?php echo URL::build_current(((URL::get('order_by')=='language.name' and URL::get('order_dir')!='desc')?array('order_dir'=>'desc'):array())+array('order_by'=>'language.name'));?>" title="[[.sort.]]">
								<?php if(URL::get('order_by')=='language.name') echo '<img src="'.'skins/default/images/buttons/'.((URL::get('order_dir')!='desc')?'down':'up').'_arrow.gif" alt="">';?>								[[.name.]]								</a>
							</th>
						    <th width="12%" align="left" nowrap ><a>[[.image_url.]]</a></th>
						</tr>
						<!--LIST:items-->
						<tr bgcolor="<?php if((URL::get('just_edited_id',0)==[[=items.id=]]) or (is_numeric(array_search(MAP['items']['current']['id'],MAP['just_edited_ids'])))){ echo '#EFFFDF';} else {echo 'white';}?>" valign="middle" <?php Draw::hover('#FFFFDD');?> style="cursor:pointer;" id="Language_tr_[[|items.id|]]">
							<td><?php if([[=items.id=]]!=1){?><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'Language',this,'#FFFFEC','white');" <?php if(URL::get('cmd')=='delete') echo 'checked';?>><?php }?></td>
							<td nowrap align="left" onclick="location='<?php echo URL::build_current(array('cmd'=>'edit','id'=>[[=items.id=]]));?>';">
									[[|items.code|]]								</td><td align="left" nowrap onclick="location='<?php echo URL::build_current(array('cmd'=>'edit','id'=>[[=items.id=]]));?>';">
									[[|items.name|]]
								</td>
						            <td align="left" nowrap onclick="location='<?php echo URL::build_current(array('cmd'=>'edit','id'=>[[=items.id=]]));?>';"><img src="[[|items.icon_url|]]" width="20"></td>
						</tr>
						<!--/LIST:items-->
					</table>
				</td>
			</tr>
			</table>
			[[|paging|]]
					<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
			<tr>
			<td width="100%">
				[[.select.]]:&nbsp;
				<a  onclick="select_all_checkbox(document.ListLanguageForm,'Language',true,'#FFFFEC','white');">[[.select_all.]]</a>&nbsp;
				<a  onclick="select_all_checkbox(document.ListLanguageForm,'Language',false,'#FFFFEC','white');">[[.select_none.]]</a>
				<a  onclick="select_all_checkbox(document.ListLanguageForm,'Language',-1,'#FFFFEC','white');">[[.select_invert.]]</a>
			</td>
			<td>
				<a name="bottom_anchor" ><img src="skins/default/images/top.gif" alt="[[.top.]]" width="49" height="23" border="0" title="[[.top.]]"></a>			</td>
			</tr></table>
			</form>
			<input type="hidden" name="cmd" value="delete"/>
<input type="hidden" name="page_no" value="1"/>
<!--IF:delete(URL::get('cmd')=='delete')-->
				<input type="hidden" name="confirm" value="1" />
				<!--/IF:delete-->
		</td>
</tr>
	</table>	
	
</fieldset>