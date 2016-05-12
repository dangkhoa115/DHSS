<script src="packages/core/includes/js/multi_items.js" type="text/javascript"></script>
<span style="display:none;">
	<span id="mi_survey_options_sample">
		<span id="input_group_#xxxx#" style="width:100%;text-align:left;">
			<input  name="mi_survey_options[#xxxx#][id]" type="hidden" id="id_#xxxx#">
			<?php
					if(isset($this->map['languages']) and is_array($this->map['languages']))
					{
						foreach($this->map['languages'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['languages']['current'] = &$item1;?>
			<span class="multi_input">	
				<textarea  name="mi_survey_options[#xxxx#][name_<?php echo $this->map['languages']['current']['id'];?>]" style="width:285px;height:20px;" id="name_<?php echo $this->map['languages']['current']['id'];?>_#xxxx#"></textarea>
			</span>
			
							
						<?php
							}
						}
					unset($this->map['languages']['current']);
					} ?>
			<span class="multi_input">
					<input  name="mi_survey_options[#xxxx#][position]" style="width:60px;" type="text" id="position_#xxxx#">
			</span><span class="multi_input">
					<input  name="mi_survey_options[#xxxx#][count]" style="width:60px;" type="text" id="count_#xxxx#">
			</span>
			<span class="multi_input"><span style="width:20;">
				<img src="skins/default/images/buttons/delete.gif" onClick="mi_delete_row($('input_group_#xxxx#'),'mi_survey_options','#xxxx#');if(document.all)event.returnValue=false; else return false;" style="cursor:pointer;"/>
			</span></span><br>
		</span>
	</span> 
</span>
<script>
	function check_selected()
	{
		var status = false;
		jQuery('form :checkbox').each(function(e){
			if(this.checked && this.id=='PublisherForm_checkbox')
			{
				status = true;
			}
		});	
		return status;
	}
	function make_cmd(cmd)
	{
		document.EditSurveyAdminForm.submit();
	}
</script>
<fieldset id="toolbar">
	<legend><?php echo Portal::language('content_manage_system');?></legend>
	<div id="toolbar-title"><?php echo Portal::language('survey_admin');?></div>
	<div id="toolbar-content"  align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_edit(false,ANY_CATEGORY)){?><td id="toolbar-save"  align="center"><a onclick="make_cmd('save')"> <span title="Save"> </span> <?php echo Portal::language('Save');?> </a> </td><?php }?>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-cancel"  align="center"><a href="<?php echo Url::build_current();?>"> <span title="Cancel"> </span> <?php echo Portal::language('Cancel');?> </a> </td><?php }?>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> <?php echo Portal::language('Help');?> </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
<?php if(Form::$current->is_error())
		{
		?>
		<strong>B&#225;o l&#7895;i</strong><br>
		<?php echo Form::$current->error_messages();?><br>
		<?php
		}
		?>
		<form name="EditSurveyAdminForm" method="post"  action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
	<table cellspacing="0" width="100%"><tr><td>
				<div class="tab-pane-1" id="tab-pane-survey">
				<?php
					if(isset($this->map['languages']) and is_array($this->map['languages']))
					{
						foreach($this->map['languages'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['languages']['current'] = &$item2;?>
				<div class="tab-page" id="tab-page-survey-<?php echo $this->map['languages']['current']['id'];?>">
					<h2 class="tab"><?php echo $this->map['languages']['current']['name'];?></h2>
					<div class="form-input-label"><?php echo Portal::language('name');?> (<span class="require">*</span>)</div>
					<div class="form_input">
							<input  name="name_<?php echo $this->map['languages']['current']['id'];?>" id="name_<?php echo $this->map['languages']['current']['id'];?>" style="width:300px" type ="text" value="<?php echo String::html_normalize(URL::get('name_'.$this->map['languages']['current']['id']));?>">
					</div><div class="form-input-label"><?php echo Portal::language('question');?></div>
					<div class="form_input">
							<textarea id="question_<?php echo $this->map['languages']['current']['id'];?>" name="question_<?php echo $this->map['languages']['current']['id'];?>" cols="75" rows="10" style="width:99%; height:200px;overflow:hidden"></textarea><br />
					</div>
				</div>
				
							
						<?php
							}
						}
					unset($this->map['languages']['current']);
					} ?>
				</div>
				</td></tr></table>

		<div class="form-input-label"><?php echo Portal::language('multi_is_select');?>:
		<input name="multi" id="multi" type="checkbox" value="1" <?php echo (URL::get('multi')?'checked':'');?>>
		</div>
		<?php
	if(URL::get('cmd')!='delete')
	{
	?>
		<fieldset>
			<legend><?php echo Portal::language('survey_options');?></legend>
			<div id="mi_survey_options_all_elems">
				<span>
					<?php
					if(isset($this->map['languages']) and is_array($this->map['languages']))
					{
						foreach($this->map['languages'] as $key3=>&$item3)
						{
							if($key3!='current')
							{
								$this->map['languages']['current'] = &$item3;?>
					<span class="multi-input-header" style="float:left"><span style="width:285px;float:left;"><?php echo Portal::language('name');?>(<?php echo $this->map['languages']['current']['name'];?>)</span></span>
					
							
						<?php
							}
						}
					unset($this->map['languages']['current']);
					} ?>
					<span class="multi-input-header">
					<span style="width:60px;"><?php echo Portal::language('position');?></span></span><span class="multi-input-header"><span style="width:60px;margin-left:20px"><?php echo Portal::language('count');?></span></span>
					<span class="multi-input-header"><span style="width:20px;">&nbsp;</span></span>
					<br>
				</span>
				<br>
			</div>
			<input type="button" value="<?php echo Portal::language('Add');?>" onclick="mi_add_new_row('mi_survey_options');">
		</fieldset>
		<?php
	}
	?>
	<input type="hidden" value="1" name="confirm_edit"/>
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
</fieldset>
<script type="text/javascript">
	mi_init_rows('mi_survey_options',
	<?php if(isset($_REQUEST['mi_survey_options']))
	{
		echo String::array2js($_REQUEST['mi_survey_options']);
	}
	else
	{
		echo '{}';
	}
	?>
); 
</script>
