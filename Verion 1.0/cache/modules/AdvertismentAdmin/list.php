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
		document.AdvertismentAdmin.submit();
	}
</script>
<fieldset id="toolbar">
	<legend><?php echo Portal::language('content_manage_system');?></legend>
	<div id="toolbar-title">
		<?php echo Portal::language('advertisment_admin');?> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content">
	<table align="right">
	  <tbody>
		<tr>
		  <?php if(User::can_delete(false,ANY_CATEGORY)){?><td id="toolbar-trash"  align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> <?php echo Portal::language('Trash');?> </a> </td><?php }?>
		  <?php if(User::can_add(false,ANY_CATEGORY)){?><td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'add'));?>#"> <span title="New"> </span> <?php echo Portal::language('New');?> </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
	<form name="AdvertismentAdmin" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<a name="top_anchor"></a>		
			<table cellpadding="0" cellspacing="6" width="100%">
				<tr>
					<td width="100%">
						<?php echo Portal::language('Filter');?>:
						<input  name="search" id="search"  class="text_area" type ="text" value="<?php echo String::html_normalize(URL::get('search'));?>">
						<button onclick="document.AdvertismentAdmin.submit();">&nbsp;<?php echo Portal::language('Go');?>&nbsp;</button>
					</td>
					<td nowrap="nowrap">					
					<select  name="status" id="status" class="inputbox" size="1" onchange="document.AdvertismentAdmin.submit();"><?php
					if(isset($this->map['status_list']))
					{
						foreach($this->map['status_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('status').value = "<?php echo addslashes(URL::get('status',isset($this->map['status'])?$this->map['status']:''));?>";</script>
	</select>	
				  </td>
				</tr>
		</table>
		<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
			<thead>
					<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
					<th width="1%" align="left" nowrap><a>#</a></th>
					<th width="1%" title="<?php echo Portal::language('check_all');?>">
					  <input type="checkbox" value="1" id="AdvertismentAdmin_all_checkbox" onclick="select_all_checkbox(this.form,'AdvertismentAdmin',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th />
					<th width="26%" align="left" nowrap><a><?php echo Portal::language('name');?></a></th>
					<th width="5%" align="left" nowrap><a><?php echo Portal::language('image_url');?></a></th>
					<th width="15%" align="left" nowrap><a><?php echo Portal::language('url');?></a></th>
					<th width="2%" align="left" nowrap><a><?php echo Portal::language('status');?></a></th>
					<th width="7%" align="left" nowrap><a><?php echo Portal::language('user_id');?></a></th>
					<th width="4%" align="left" nowrap><a><?php echo Portal::language('date');?></a></th>
					<th width="4%" align="left" nowrap><a><?php echo Portal::language('id');?></a></th>
					<?php if(User::can_edit(false,ANY_CATEGORY))
					{?>
					<th width="2%" align="left" nowrap><a><?php echo Portal::language('edit');?></a></th>
					<?php }?>
				</tr>
		  </thead>
				<tbody>		
				<?php $i=0;$total = $this->map['total'];?>
				<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>	
				<tr bgcolor="<?php if((URL::get('just_edited_id',0)==$this->map['items']['current']['id']) or (is_numeric(array_search($this->map['items']['current']['id'],$this->map['just_edited_ids'])))){ echo Portal::get_setting('crud_just_edited_item_bgcolor','#FFFFDD');} else {echo Portal::get_setting('crud_item_bgcolor','white');}?>" valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if($i%2){echo 'background-color:#F9F9F9';}?>" id="AdvertismentAdmin_tr_<?php echo $this->map['items']['current']['id'];?>">
					<th width="1%" align="left" nowrap><a><?php echo ++$i;?></a></th>
					<td width="1%"><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'AdvertismentAdmin',this,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');" id="AdvertismentAdmin_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td />
					<td align="left" nowrap><?php echo $this->map['items']['current']['name'];?></td>
					<td align="center" nowrap>
					<?php 
					if(preg_match_all('/.swf/',$this->map['items']['current']['image_url'],$matches))
					{
						echo '<embed src="'.$this->map['items']['current']['image_url'].'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="60" height="50"></embed>';
					}
					else
					{
						echo '<img src="'.$this->map['items']['current']['image_url'].'" width="60" height="50" onerror="this.src=\'skins/default/images/no_image.gif\'">';
					}
					?>
					</td>
					<td align="left"><?php echo $this->map['items']['current']['url'];?></td>
					<td align="left" nowrap><?php echo $this->map['items']['current']['status'];?></td>
					<td align="left" nowrap><?php echo $this->map['items']['current']['user_id'];?></td>
					<td align="left" nowrap><?php echo date('hh:i d/m/Y',$this->map['items']['current']['time']);?></td>
					<td align="left" nowrap><?php echo $this->map['items']['current']['id'];?></td>
					<?php if(User::can_edit(false,ANY_CATEGORY))
					{?>
					<td align="left" nowrap width="2%"><a href="<?php echo Url::build_current(array('id'=>$this->map['items']['current']['id'],'cmd'=>'edit'));?>"><img src="skins/default/images/buttons/edit.jpg"></a></td>
					<?php }?>
				</tr>
				
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
				</tbody>
	  </table>
		<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
			<tr>
			<td width="48%" align="left">
				<?php echo Portal::language('select');?>:&nbsp;
				<a onclick="select_all_checkbox(document.AdvertismentAdmin,'AdvertismentAdmin',true,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"><?php echo Portal::language('select_all');?></a>&nbsp;
				<a onclick="select_all_checkbox(document.AdvertismentAdmin,'AdvertismentAdmin',false,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"><?php echo Portal::language('select_none');?></a>
				<a onclick="select_all_checkbox(document.AdvertismentAdmin,'AdvertismentAdmin',-1,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"><?php echo Portal::language('select_invert');?></a>		</td>
			<td width="18%">&nbsp;<a><?php echo Portal::language('display');?></a>
			  <select  name="item_per_page" class="select" style="width:50px" size="1" onchange="document.AdvertismentAdmin.submit( );" id="item_per_page" ><?php
					if(isset($this->map['item_per_page_list']))
					{
						foreach($this->map['item_per_page_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('item_per_page').value = "<?php echo addslashes(URL::get('item_per_page',isset($this->map['item_per_page'])?$this->map['item_per_page']:''));?>";</script>
	</select>&nbsp;<?php echo Portal::language('of');?>&nbsp;<?php echo $this->map['total'];?></td>
			<td width="31%"><?php echo $this->map['paging'];?></td>
			<td width="3%">
				<a name="bottom_anchor" href="#top_anchor"><img src="skins/default/images/top.gif" title="<?php echo Portal::language('top');?>" border="0" alt="<?php echo Portal::language('top');?>"></a>		</td>
			</tr></table>
			<table width="100%" class="table_page_setting">
	</table>
		<input type="hidden" name="cmd" value="" id="cmd"/>
  <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
  
</fieldset>