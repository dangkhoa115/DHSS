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
	<legend><?php echo Portal::language('config_manage');?></legend>
	<div id="toolbar-info">
		<?php echo Portal::language('language');?> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		<?php 
		if(URL::get('cmd')=='delete' and User::can_delete(false,ANY_CATEGORY)){?> 
		 	<td id="toolbar-trash"  align="center"><a onclick="ListLanguageForm.cmd.value='delete';ListLanguageForm.submit();"> <span title="Trash"> </span> <?php echo Portal::language('Trash');?> </a> </td>
			<td id="toolbar-back"  align="center"><a href="<?php echo URL::build_current();?>"> <span title="Back"> </span> <?php echo Portal::language('Back');?> </a> </td>
		<?php 
		}else{ 
		if(User::can_add(false,ANY_CATEGORY)){?>
				<td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'add'));?>#"> <span title="New"> </span> <?php echo Portal::language('New');?> </a> </td>
			<?php }?>
		<?php if(User::can_delete(false,ANY_CATEGORY)){?>
		 <td id="toolbar-trash"  align="center"><a  onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> <?php echo Portal::language('Trash');?> </a> </td>
		<?php }
		}?>
		  <td id="toolbar-publish" align="center"><a href="<?php echo Url::build_current(array('cmd'=>'cache'));?>#"> <span title="<?php echo Portal::language('Cache');?>"> </span> <?php echo Portal::language('Cache');?> </a> </td>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> <?php echo Portal::language('Help');?> </a> </td>
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
			<input  name="cmd" id="cmd" / type ="hidden" value="<?php echo String::html_normalize(URL::get('cmd'));?>">
			<input  name="confirm" id="confirm" value="1"/ type ="hidden" value="<?php echo String::html_normalize(URL::get('confirm'));?>">
			<table  cellspacing="0" width="100%">
			<tr>
				<td width="100%">
					<a name="top_anchor"></a>
					<table cellpadding="5" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
					
						<tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
							<th width="3%" title="<?php echo Portal::language('check_all');?>"><input type="checkbox" value="1" id="Language_all_checkbox" onclick="select_all_checkbox(this.form, 'Language',this.checked,'#FFFFEC','white');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
							<th width="32%" align="left" nowrap >
								<a href="<?php echo URL::build_current(((URL::get('order_by')=='language.code' and URL::get('order_dir')!='desc')?array('order_dir'=>'desc'):array())+array('order_by'=>'language.code'));?>" title="<?php echo Portal::language('sort');?>">
								<?php if(URL::get('order_by')=='language.code') echo '<img src="'.'skins/default/images/buttons/'.((URL::get('order_dir')!='desc')?'down':'up').'_arrow.gif" alt="">';?>								<?php echo Portal::language('code');?>								</a>							</th><th width="53%" align="left" nowrap >
								<a href="<?php echo URL::build_current(((URL::get('order_by')=='language.name' and URL::get('order_dir')!='desc')?array('order_dir'=>'desc'):array())+array('order_by'=>'language.name'));?>" title="<?php echo Portal::language('sort');?>">
								<?php if(URL::get('order_by')=='language.name') echo '<img src="'.'skins/default/images/buttons/'.((URL::get('order_dir')!='desc')?'down':'up').'_arrow.gif" alt="">';?>								<?php echo Portal::language('name');?>								</a>
							</th>
						    <th width="12%" align="left" nowrap ><a><?php echo Portal::language('image_url');?></a></th>
						</tr>
						<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
						<tr bgcolor="<?php if((URL::get('just_edited_id',0)==$this->map['items']['current']['id']) or (is_numeric(array_search($this->map['items']['current']['id'],$this->map['just_edited_ids'])))){ echo '#EFFFDF';} else {echo 'white';}?>" valign="middle" <?php Draw::hover('#FFFFDD');?> style="cursor:pointer;" id="Language_tr_<?php echo $this->map['items']['current']['id'];?>">
							<td><?php if($this->map['items']['current']['id']!=1){?><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'Language',this,'#FFFFEC','white');" <?php if(URL::get('cmd')=='delete') echo 'checked';?>><?php }?></td>
							<td nowrap align="left" onclick="location='<?php echo URL::build_current(array('cmd'=>'edit','id'=>$this->map['items']['current']['id']));?>';">
									<?php echo $this->map['items']['current']['code'];?>								</td><td align="left" nowrap onclick="location='<?php echo URL::build_current(array('cmd'=>'edit','id'=>$this->map['items']['current']['id']));?>';">
									<?php echo $this->map['items']['current']['name'];?>
								</td>
						            <td align="left" nowrap onclick="location='<?php echo URL::build_current(array('cmd'=>'edit','id'=>$this->map['items']['current']['id']));?>';"><img src="<?php echo $this->map['items']['current']['icon_url'];?>" width="20"></td>
						</tr>
						
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
					</table>
				</td>
			</tr>
			</table>
			<?php echo $this->map['paging'];?>
					<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
			<tr>
			<td width="100%">
				<?php echo Portal::language('select');?>:&nbsp;
				<a  onclick="select_all_checkbox(document.ListLanguageForm,'Language',true,'#FFFFEC','white');"><?php echo Portal::language('select_all');?></a>&nbsp;
				<a  onclick="select_all_checkbox(document.ListLanguageForm,'Language',false,'#FFFFEC','white');"><?php echo Portal::language('select_none');?></a>
				<a  onclick="select_all_checkbox(document.ListLanguageForm,'Language',-1,'#FFFFEC','white');"><?php echo Portal::language('select_invert');?></a>
			</td>
			<td>
				<a name="bottom_anchor" ><img src="skins/default/images/top.gif" alt="<?php echo Portal::language('top');?>" width="49" height="23" border="0" title="<?php echo Portal::language('top');?>"></a>			</td>
			</tr></table>
			<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
			<input type="hidden" name="cmd" value="delete"/>
<input type="hidden" name="page_no" value="1"/>
<?php 
				if((URL::get('cmd')=='delete'))
				{?>
				<input type="hidden" name="confirm" value="1" />
				
				<?php
				}
				?>
		</td>
</tr>
	</table>	
	
</fieldset>