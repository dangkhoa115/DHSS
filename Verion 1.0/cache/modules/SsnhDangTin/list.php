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
		Danh sách tin bài đã đăng
	</div>
	<div id="toolbar-content">
	<table align="right">
	  <tbody>
		<tr>
		<td id="toolbar-move"  align="center">&nbsp;</td>
		</tr>
	  </tbody>
	</table>
</fieldset>
<br>
<fieldset id="toolbar">
	<form name="NewsAdmin" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<a name="top_anchor"></a>		
			<table cellpadding="5" cellspacing="0" width="100%">
				<tr>
					<td width="100%">
						<input  name="keyword" id="keyword" size="20" placeholder="Nhập từ khóa tìm kiếm" type ="text" value="<?php echo String::html_normalize(URL::get('keyword'));?>"><input  name="search" value="OK" / type ="submit" value="<?php echo String::html_normalize(URL::get('search'));?>">
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
				  </td>
				</tr>
		</table>
		<table cellpadding="2" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
			<thead>
					<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
					<th width="1%" align="left" nowrap>#</th>
					<th width="1%" title="<?php echo Portal::language('check_all');?>">&nbsp;</th>
					<th width="36%" align="left"><?php echo Portal::language('name');?></th>
					<th width="2%" align="left" nowrap><?php echo Portal::language('status');?></th>
					<th width="12%" align="left" nowrap>Danh mục</th>
					<th width="4%" align="left" nowrap><?php echo Portal::language('date');?></th>
					<th width="5%" align="left" nowrap><a href="<?php echo Url::build_current(array('category_id','page_no','status','search','order_by'=>'hitcount','dir'=>(Url::get('dir')=='DESC')?'ASC':'DESC'))?>"><?php echo Portal::language('hitcount');?></a></th>
					<th width="4%" align="left" nowrap><?php echo Portal::language('id');?></th>
					<th width="2%" align="left" nowrap><?php echo Portal::language('edit');?></th>
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
					<td width="1%"><img src="<?php echo $this->map['items']['current']['small_thumb_url'];?>" width="50" /></td >
					<td  align="left"><a href="tin-tuc/<?php echo $this->map['items']['current']['category_name_id'];?>/<?php echo $this->map['items']['current']['name_id'];?>.html" target="_blank"> <?php echo $this->map['items']['current']['name'];?></a>&nbsp;&nbsp;<?php if($this->map['items']['current']['total_comment']>0){?><a  style="color:#FF0000" href="<?php echo Url::build('manage_comment',array('item_id'=>$this->map['items']['current']['id']));?>">[<?php echo $this->map['items']['current']['total_comment'];?>]</a><img src="skins/default/images/cms/comment.gif"><?php }?></td>
					<td align="left" nowrap><?php echo $this->map['items']['current']['publish']?'Đã duyệt':'<span style="color:#F00;">Chờ duyệt</span>'?></td>
					<td align="left" nowrap><?php echo $this->map['items']['current']['category_name'];?></td>
					<td align="left" nowrap><?php echo date('h\h:i d/m/Y',$this->map['items']['current']['time']);?></td>
					<td align="left" nowrap><?php echo $this->map['items']['current']['hitcount'];?></td>
					<td align="left" nowrap><?php echo $this->map['items']['current']['id'];?></td>
					<td align="left" nowrap width="2%"><a href="dang-tin.html?do=edit&id=<?php echo $this->map['items']['current']['id'];?>"><img src="skins/default/images/buttons/edit.jpg"></a></td>
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
			<td width="48%" align="left">&nbsp;</td>
			<td width="18%">&nbsp;<a><?php echo Portal::language('display');?></a>
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
			<td width="31%"><?php echo $this->map['paging'];?></td>
			<td width="3%">&nbsp;</td>
			</tr></table>
			<table width="100%" class="table_page_setting">
	</table>
		<input type="hidden" name="cmd" value="" id="cmd">
  <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
</fieldset>
<p>&nbsp;</p>