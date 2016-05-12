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
		jQuery('#cmd').val(cmd);
		document.PublisherForm.submit();
	}
</script><fieldset id="toolbar">
	<div id="toolbar-title"><?php echo Portal::language('publisher');?></div>
	<div id="toolbar-content">
	<table align="right">
	  <tbody>
		<tr>
		 <?php if(User::can_edit(false,ANY_CATEGORY)){?> <td id="toolbar-save"  align="center"><a onclick="make_cmd('save');"> <span title="<?php echo Portal::language('Save');?>"> </span> <?php echo Portal::language('Save');?> </a> </td><?php }?>
		  <?php if(User::can_delete(false,ANY_CATEGORY)){?><td id="toolbar-trash"  align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> Xóa </a> </td><?php }?>
		  
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
<form name="PublisherForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
<nav class="tab">
    <ul>
      <li<?php echo (!Session::get('doc_gia'))?' class="active"':''?>><a href="?page=publisher&qtr=1">Quản trị viên</a></li>
      <li<?php echo (Session::get('doc_gia'))?' class="active"':''?>><a href="?page=publisher&doc_gia=1">Độc giả</a></li>
    </ul>
  </nav>
  <div><input  name="search_user_id" id="search_user_id" placeholder="Nhập từ khóa tìm kiếm" type ="text" value="<?php echo String::html_normalize(URL::get('search_user_id'));?>"><input type="submit" value="Tìm kiếm"></div>
	<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
	  <tr style="background-color:#F0F0F0">
		<th width="3%" align="left"><input type="checkbox" value="1" id="PublisherForm_all_checkbox" onclick="select_all_checkbox(this.form,'PublisherForm',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
		<th width="29%" align="left"><a>Bài viết</a></th>
		<th width="11%" align="left"><a>Danh mục</a></th>
		<th width="6%" align="left"><a>Acc</a></th>
		<th width="6%" align="left"><a>Trạng thái</a></th>
		<th width="6%" align="left">Kiểm duyệt</th>
		<th width="8%" align="left">Nhận iGold</th>
		<th width="8%" align="left"><a>Thời gian</a></th>
		<th width="8%" align="left"><a>Cập nhật</a></th>
		<th width="5%" align="left">&nbsp;</th>	
	  </tr>
	  <?php $ids='';$first = true;$i=0;?>
	<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
	  <tr valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if($i%2){echo 'background-color:#F9F9F9';}?>" id="Publisher_tr_<?php echo $this->map['items']['current']['id'];?>">
		<td>
		<?php 
		$i++;
		if($first)
		{
			$ids .= $this->map['items']['current']['id'];
			$first = false;
		}
		else
		{
			$ids .= ','.$this->map['items']['current']['id'];
		}	
		?>
		<input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'PublisherForm',this,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');" id="PublisherForm_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td>
		<td><?php echo $this->map['items']['current']['name'];?></td>
		<td><?php echo $this->map['items']['current']['category_name'];?></td>		
		<td><?php echo $this->map['items']['current']['user_id'];?></td>
		<td><select  name="status_<?php echo $this->map['items']['current']['id'];?>" id="status_<?php echo $this->map['items']['current']['id'];?>">
		  <?php foreach($this->map['status'] as $key=>$value){?><option value="<?php echo $key;?>"><?php echo $value;?></option><?php }?>
		  </select>
		  <script>document.getElementById('status_<?php echo $this->map['items']['current']['id'];?>').value='<?php echo $this->map['items']['current']['status'];?>';</script>
		  </td>
		<td align="center">			
			<input  name="publish_<?php echo $this->map['items']['current']['id'];?>" type="checkbox" id="publish_<?php echo $this->map['items']['current']['id'];?>" value="1">
			<?php 
				if(($this->map['items']['current']['publish']!=0))
				{?><script>document.getElementById('publish_<?php echo $this->map['items']['current']['id'];?>').checked=true;</script>
				<?php
				}
				?>
		</td>
		<td align="right" nowrap="nowrap"><?php echo $this->map['items']['current']['got_igold'];?></td>
		<td nowrap="nowrap"><?php echo date('h:i  d/m/Y',$this->map['items']['current']['time']);?></td>
		<td nowrap="nowrap"><?php echo date('h:i  d/m/Y',$this->map['items']['current']['last_time_update']?$this->map['items']['current']['last_time_update']:0);?></td>
		<td align="center"><a target="_blank" href="tin-tuc/<?php echo $this->map['items']['current']['category_name_id'];?>/<?php echo $this->map['items']['current']['name_id'];?>.html"><img src="skins/default/images/buttons/search.gif" width="25"></a></td>
	  </tr>
	
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
	</table>
	<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
	  <tr>
		<td><?php echo $this->map['total'];?>  Tin bài</td>
		<td align="right"><?php echo $this->map['paging'];?></td>
	  </tr>
	</table>
	<input type="hidden" name="cmd" value="" id="cmd"/>
	<input type="hidden" name="ids" value="<?php echo $ids;?>" id="ids"/>
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			

</fieldset>
