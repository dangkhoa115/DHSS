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
		document.ListSurveyAdminForm.submit();
	}
</script>
<fieldset id="toolbar">
	<legend><?php echo Portal::language('content_manage_system');?></legend>
	<div id="toolbar-title"><?php echo Portal::language('survey_admin');?></div>
	<div  id="toolbar-content"  align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_add(false,ANY_CATEGORY)){?><td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'add'));?>#"> <span title="New"> </span> <?php echo Portal::language('New');?> </a> </td><?php }?>
		  <?php if(User::can_delete(false,ANY_CATEGORY)){?><td id="toolbar-trash"  align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> <?php echo Portal::language('Trash');?> </a> </td><?php }?>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> <?php echo Portal::language('Help');?> </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
<form name="ListSurveyAdminForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
	<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
		<tr style="background-color:#F0F0F0">
			<th width="1%" title="<?php echo Portal::language('check_all');?>"><input type="checkbox" value="1" id="SurveyAdmin_all_checkbox" onclick="select_all_checkbox(this.form, 'SurveyAdmin',this.checked,'#FFFFEC','white');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
			<th nowrap align="left">
				<a title="<?php echo Portal::language('sort');?>" href="<?php echo URL::build_current(((URL::get('order_by')=='survey.name_'.Portal::language() and URL::get('order_dir')!='desc')?array('order_dir'=>'desc'):array())+array('order_by'=>'survey.name_'.Portal::language()));?>" >
				<?php if(URL::get('order_by')=='survey.name_'.Portal::language()) echo '<img src="'.Portal::template('core').'/images/buttons/'.((URL::get('order_dir')!='desc')?'down':'up').'_arrow.gif" alt="">';?>
				<?php echo Portal::language('name');?>
				</a>
			</th><th nowrap align="left">
				<?php echo Portal::language('question');?>
			</th>
		</tr>
		<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?> 
		<tr bgcolor="<?php if((URL::get('just_edited_id',0)==$this->map['items']['current']['id']) or (is_numeric(array_search($this->map['items']['current']['id'],$this->map['just_edited_ids'])))){ echo '#EFFFDF';} else {echo 'white';}?>" valign="middle" <?php Draw::hover('#FFFFDD');?> style="cursor:pointer;" id="SurveyAdmin_tr_<?php echo $this->map['items']['current']['id'];?>">
			<td><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'SurveyAdmin',this,'#FFFFEC','white'\);" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td>
			<td nowrap align="left" onclick="location='<?php echo Url::check('href')? Url::build_current(array('href','block_id')).'&survey_id='.$this->map['items']['current']['id']:(URL::build_current().'&cmd=edit&id='.$this->map['items']['current']['id']);?>';">
					<?php echo $this->map['items']['current']['name'];?>
		  </td><td nowrap align="left" onclick="location='<?php echo Url::check('href')? Url::build_current(array('href','block_id')).'&survey_id='.$this->map['items']['current']['id']:(URL::build_current().'&cmd=edit&id='.$this->map['items']['current']['id']);?>';">
					<?php echo $this->map['items']['current']['question'];?>
				</td>
		</tr>
		
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
	</table>
	<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
		<tr>
		<td width="50%">
			<?php echo Portal::language('select');?>:&nbsp;
			<a onclick="select_all_checkbox(document.ListSurveyAdminForm,'SurveyAdmin',true,'#FFFFEC','white');"><?php echo Portal::language('select_all');?></a>&nbsp;
			<a onclick="select_all_checkbox(document.ListSurveyAdminForm,'SurveyAdmin',false,'#FFFFEC','white');"><?php echo Portal::language('select_none');?></a>
			<a onclick="select_all_checkbox(document.ListSurveyAdminForm,'SurveyAdmin',-1,'#FFFFEC','white');"><?php echo Portal::language('select_invert');?></a>		</td>
		<td width="50%"><?php echo $this->map['paging'];?></td>
		</tr></table>
	<input type="hidden" name="cmd" value="delete"/>
	<input type="hidden" name="page_no" value="1"/>
	<?php 
				if((URL::get('cmd')=='delete'))
				{?>
	<input type="hidden" name="confirm" value="1" />
	
				<?php
				}
				?>
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			

</fieldset>