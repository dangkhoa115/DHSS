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
		document.ListUserAdminForm.submit();
	}
</script>
<fieldset id="toolbar">
	<div id="toolbar-personal">
		<?php echo $this->map['title'];?>
	</div>
	<div id="toolbar-content" align="right">
	<table align="right">
	  <tbody>
		<tr>
			<td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('kind','cmd'=>'add'));?>#"> <span title="New"> </span> Thêm mới </a> </td>
		  <?php if(Url::get('cmd')!='delete')
		  {?>
		  	<td id="toolbar-trash"  align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> <?php echo Portal::language('delete');?> </a> </td>
			<?php }else{?>
				<td id="toolbar-trash"  align="center"><a onclick="if(check_selected()){make_cmd('delete')}"> <span title="Xóa"> </span> Xóa </a> </td>
			<?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
	<form method="post" name="SearchUserAdminForm">
		<table>
			<tr>
				<td align="right" nowrap style="font-weight:bold">Từ khóa</td>
				<td nowrap>
					<input  name="keyword" id="keyword" style="width:200px;" type ="text" value="<?php echo String::html_normalize(URL::get('keyword'));?>">
          <label for="search_from_web"><input  name="search_from_web" type ="checkbox" id="b" value="<?php echo String::html_normalize(URL::get('search_from_web','1'));?>"> Qua web</label>
					<input type="submit" value="Tìm kiếm" class="button">
           (<?php echo $this->map['total'];?> kết quả)
				</td>
			</tr>
		</table>
		<input type="hidden" name="page_no" value="1" />
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
	<a name="top"></a>
	<form name="ListUserAdminForm" method="post">
	<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
		<tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
			<th width="1%" title="<?php echo Portal::language('check_all');?>"><input type="checkbox" value="1" id="UserAdmin_all_checkbox" onclick="select_all_checkbox(this.form, 'UserAdmin',this.checked,'#FFFFEC','white');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
			<th nowrap align="center" >STT</th>
			<th nowrap align="left" >&nbsp;</th>
			<th nowrap align="left" ><a>Tên TK/Phone</a></th>
			<th nowrap align="left" >iGold</th>
				<th nowrap align="left" ><a><?php echo Portal::language('full_name');?></a></th>
				<th nowrap align="left" >Contact</th>
				<th nowrap align="left" ><a>Ngày gia nhập</a></th>
				<th nowrap align="left" ><a>Khu vực</a></th>
				<th nowrap align="center" width="150">Chiến thắng tháng</th>
				<th width="80" align="center" nowrap="nowrap">Block</th>
				<th width="80" align="center" nowrap="nowrap">Kích hoạt</th>
				<th nowrap align="left" width="1%"><a>Phân quyền</a></th>
		</tr>
		<?php $i = 1;?>
		<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
		<?php $i++;?>
		<tr bgcolor="<?php if((URL::get('just_edited_id',0)==$this->map['items']['current']['id']) or (is_numeric(array_search($this->map['items']['current']['id'],$this->map['just_edited_ids'])))){ echo 'white';} else {echo 'white';}?>" valign="middle" <?php Draw::hover('#FFFFDD');?> style="cursor:hand;<?php if($i%2){echo 'background-color:#F9F9F9';}?>" id="UserAdmin_tr_<?php echo $this->map['items']['current']['id'];?>">
			<td><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'UserAdmin',this,'#FFFFEC','white');" id="UserAdmin_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td>
			<td align="left" nowrap><?php echo $this->map['items']['current']['stt'];?></td>
			<td align="left" width="1%"><img src="<?php echo $this->map['items']['current']['image_url'];?>" width="50" alt=""></td>
			<td align="left" nowrap>
			    <a href="<?php echo URL::build_current();?>&cmd=edit&id=<?php echo $this->map['items']['current']['id'];?>">
          <?php echo ($this->map['items']['current']['kind']==2)?(($this->map['items']['current']['from_web'])?'<img src="skins/ssnh/images/from_web.png">':'<img src="skins/ssnh/images/from_mobile.png">'):'';?>
          <?php echo $this->map['items']['current']['nguoi_choi_id'];?> - <strong><?php echo $this->map['items']['current']['id'];?> </strong></a>
          <br>CMTND: <?php echo $this->map['items']['current']['cmtnd'];?>
          </td>
			<td align="right"><span style="color:#F00;"><?php echo $this->map['items']['current']['igold'];?></span>
      	<?php 
				if((User::can_admin(MODULE_USERADMIN,ANY_CATEGORY)))
				{?>
        <a target="_blank" href="<?php echo Url::build_current(array('kind','cmd'=>'si','user_id'=>$this->map['items']['current']['id']))?>">>></a>
        
				<?php
				}
				?>
        
      </td>
			<td nowrap align="left"><a href="<?php echo URL::build_current();?>&cmd=edit&id=<?php echo $this->map['items']['current']['id'];?>"><?php echo $this->map['items']['current']['full_name'];?></a></td>
			<td align="left" nowrap onclick="location='<?php echo URL::build_current();?>&cmd=edit&id=<?php echo $this->map['items']['current']['id'];?>';">
					<?php echo $this->map['items']['current']['email'];?><br>Tel: <?php echo $this->map['items']['current']['dien_thoai'];?></td>
			<td nowrap align="left">
					<?php echo date('d/m/Y H:i\'',$this->map['items']['current']['time'])?>			</td>
			<td align="left" nowrap onclick="location='<?php echo URL::build_current();?>&cmd=edit&id=<?php echo $this->map['items']['current']['id'];?>';"><?php echo $this->map['items']['current']['zone_name'];?></td>
			<td align="center"><a href="<?php echo URL::build_current();?>&cmd=chien_thang&id=<?php echo $this->map['items']['current']['id'];?>">[Cập nhật]</a></td>
			<td align="center" nowrap="nowrap"><input name="is_block_<?php echo $this->map['items']['current']['is_block'];?>" <?php if($this->map['items']['current']['is_block']==1){?> checked="checked" <?php }?> type="checkbox"  onclick="location='<?php echo URL::build_current(array('kind'=>Url::get('kind'),'cmd'=>'block'));?>&amp;is_block=<?php echo $this->map['items']['current']['is_block'];?>&amp;id=<?php echo $this->map['items']['current']['id'];?>';" /></td>
			<td align="center" nowrap="nowrap"><input name="is_active_<?php echo $this->map['items']['current']['is_active'];?>" <?php if($this->map['items']['current']['is_active']==1){?> checked="checked" <?php }?> type="checkbox"  onclick="location='<?php echo URL::build_current(array('kind'=>Url::get('kind'),'cmd'=>'active'));?>&amp;is_active=<?php echo $this->map['items']['current']['is_active'];?>&amp;id=<?php echo $this->map['items']['current']['id'];?>';" /></td>
			<td align="center" nowrap onclick="location='<?php echo URL::build_current();?>&cmd=edit&id=<?php echo $this->map['items']['current']['id'];?>';">
			  <?php if(User::can_admin(false,ANY_CATEGORY)){ ?>
			  <a href="<?php echo Url::build('grant_privilege',array('account_id'=>$this->map['items']['current']['id'],'cmd'=>'grant'));?>"><img src="skins/default/images/privilege.png"></a>
			  <?php } ?>
			  </td>
		</tr>
		
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
	  </table>
		<table  width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;#width:99%" align="center">
			<tr>
				<td width="50%">
					<?php echo Portal::language('select');?>:&nbsp;
					<a onclick="select_all_checkbox(document.ListUserAdminForm,'UserAdmin',true,'#FFFFEC','white');"><?php echo Portal::language('select_all');?></a>&nbsp;
					<a onclick="select_all_checkbox(document.ListUserAdminForm,'UserAdmin',false,'#FFFFEC','white');"><?php echo Portal::language('select_none');?></a>
					<a onclick="select_all_checkbox(document.ListUserAdminForm,'UserAdmin',-1,'#FFFFEC','white');"><?php echo Portal::language('select_invert');?></a>				</td>
				<td align="right"><?php echo $this->map['paging'];?></td>
			</tr>
		</table>
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
			
			
<div style="#height:8px;"></div>
</fieldset>