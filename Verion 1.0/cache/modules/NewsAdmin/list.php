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
		document.NewsAdmin.submit();
	}
</script>
<fieldset id="toolbar">
	<div id="toolbar-title">
		Quản trị nội dung <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content">
	<table align="right">
	  <tbody>
		<tr>
		<td id="toolbar-move"  align="center"><a onclick="if(check_selected()){make_cmd('move')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}"> <span title="Move"> </span> <?php echo Portal::language('Move');?> </a> </td>
		 <?php if(User::can_edit(false,ANY_CATEGORY)){?> <td id="toolbar-copy"  align="center"><a onclick="if(check_selected()){make_cmd('copy')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}"> <span title="Copy"> </span> <?php echo Portal::language('Copy');?> </a> </td><?php }?>
		  <?php if(User::can_delete(false,ANY_CATEGORY)){?><td id="toolbar-trash"  align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> Xóa </a> </td><?php }?>
		  <?php if(User::can_add(false,ANY_CATEGORY)){?><td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'add'));?>#"> <span title="New"> </span> <?php echo Portal::language('New');?> </a> </td><?php }?>
		  
		</tr>
	  </tbody>
	</table>
  </div>
</fieldset>
<br>
<fieldset id="toolbar">
	<form name="NewsAdmin" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
  		<nav class="tab">
      	<ul>
        	<li<?php echo (!Session::get('doc_gia'))?' class="active"':''?>><a href="?page=news_admin&qtr=1">Quản trị viên</a></li>
          <li<?php echo (Session::get('doc_gia'))?' class="active"':''?>><a href="?page=news_admin&doc_gia=1">Độc giả</a></li>
        </ul>
      </nav>
			<table cellpadding="0" cellspacing="6" width="100%">
				<tr>
					<td width="100%">
						<input  name="search" id="search" size="30" style="font-weight:bold;" placeholder="Nhập từ khóa" type ="text" value="<?php echo String::html_normalize(URL::get('search'));?>"><input type="submit" value=" OK ">
					</td>
					<td nowrap="nowrap">
					<select  name="category_id" class="inputbox"  id="category_id" size="1" onchange="document.NewsAdmin.submit();"><?php
					if(isset($this->map['category_id_list']))
					{
						foreach($this->map['category_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('category_id').value = "<?php echo addslashes(URL::get('category_id',isset($this->map['category_id'])?$this->map['category_id']:''));?>";</script>
	</select>
					<select  name="search_user_id" id="search_user_id" class="inputbox" size="1" onchange="document.NewsAdmin.submit();"><?php
					if(isset($this->map['search_user_id_list']))
					{
						foreach($this->map['search_user_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('search_user_id').value = "<?php echo addslashes(URL::get('search_user_id',isset($this->map['search_user_id'])?$this->map['search_user_id']:''));?>";</script>
	</select>
					<select  name="status" id="status" class="inputbox" size="1" onchange="document.NewsAdmin.submit();"><?php
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
					  <input type="checkbox" value="1" id="NewsAdmin_all_checkbox" onclick="select_all_checkbox(this.form,'NewsAdmin',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
					<th width="1%" title="<?php echo Portal::language('check_all');?>">&nbsp;</th>
					<th width="36%" align="left"><a><?php echo Portal::language('name');?></a></th>
					<th width="2%" align="center" nowrap>Duyệt</th>
					<th width="2%" align="left" nowrap><a><?php echo Portal::language('status');?></a></th>
					<th width="10%" align="left" nowrap><a><?php echo Portal::language('positon');?></a><img src="skins/default/images/cms/menu/filesave.png" onclick="jQuery('#cmd').val('update_position');document.NewsAdmin.submit();" style="cursor:pointer"></th>
					<th width="12%" align="left" nowrap><a><?php echo Portal::language('category_name');?></a></th>
					<th width="7%" align="left" nowrap><a>Acc</a></th>
					<th width="4%" align="left" nowrap><a><?php echo Portal::language('date');?></a></th>
					<th width="5%" align="left" nowrap><a href="<?php echo Url::build_current(array('category_id','page_no','status','search','order_by'=>'hitcount','dir'=>(Url::get('dir')=='DESC')?'ASC':'DESC'))?>"><?php echo Portal::language('hitcount');?></a></th>
					<th width="4%" align="left" nowrap><a><?php echo Portal::language('id');?></a></th>
					<?php if(User::can_edit(false,ANY_CATEGORY))
					{?>
					<th width="2%" align="left" nowrap><a><?php echo Portal::language('edit');?></a></th>
					<?php }?>
				</tr>
		  </thead>
				<tbody>		
				<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>	
				<tr bgcolor="<?php if((URL::get('just_edited_id',0)==$this->map['items']['current']['id']) or (is_numeric(array_search($this->map['items']['current']['id'],$this->map['just_edited_ids'])))){ echo Portal::get_setting('crud_just_edited_item_bgcolor','#FFFFDD');} else {echo Portal::get_setting('crud_item_bgcolor','white');}?>" valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if($this->map['items']['current']['index']%2){echo 'background-color:#F9F9F9';}?>" id="NewsAdmin_tr_<?php echo $this->map['items']['current']['id'];?>">
					<th width="1%" align="left" nowrap><a><?php echo $this->map['items']['current']['index'];?></a></th>
					<td width="1%"><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'NewsAdmin',this,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');" id="NewsAdmin_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td >
					<td width="1%"><img src="<?php echo $this->map['items']['current']['small_thumb_url'];?>" width="50" /></td >
					<td  align="left"><a href="tin-tuc/<?php echo $this->map['items']['current']['category_name_id'];?>/<?php echo $this->map['items']['current']['name_id'];?>.html" target="_blank"> <?php echo $this->map['items']['current']['name'];?></a>&nbsp;&nbsp;<?php if($this->map['items']['current']['total_comment']>0){?><a  style="color:#FF0000" href="<?php echo Url::build('manage_comment',array('item_id'=>$this->map['items']['current']['id']));?>">[<?php echo $this->map['items']['current']['total_comment'];?>]</a><img src="skins/default/images/cms/comment.gif"><?php }?></td>
					<td align="center" nowrap><?php echo $this->map['items']['current']['publish'];?> </td>
					<td align="left" nowrap><?php echo $this->map['items']['current']['status'];?>			  </td>
					<td align="left" nowrap><input  name="position_<?php echo $this->map['items']['current']['id'];?>" id="position_<?php echo $this->map['items']['current']['id'];?>" style="width:40px;height:14px;" value="<?php echo $this->map['items']['current']['position'];?>" type ="text" value="<?php echo String::html_normalize(URL::get('position_'.$this->map['items']['current']['id']));?>"></td>
					<td align="left" nowrap><?php echo $this->map['items']['current']['category_name'];?></td>
					<td align="left" nowrap><?php echo $this->map['items']['current']['user_id'];?></td>
					<td align="left" nowrap><?php echo date('H:i d/m/Y',$this->map['items']['current']['time']);?></td>
					<td align="left" nowrap><?php echo $this->map['items']['current']['hitcount'];?></td>
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
			<td width="40%">&nbsp;<a><?php echo Portal::language('display');?></a>
			  <select  name="item_per_page" class="select" style="width:50px" size="1" onchange="document.NewsAdmin.submit( );" id="item_per_page" ><?php
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
			<td width="60%"><?php echo $this->map['paging'];?></td>
			</tr></table>
			<table width="100%" class="table_page_setting">
	</table>
		<input type="hidden" name="cmd" value="" id="cmd">
  <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
  <div style="#height:8px"></div>
</fieldset>