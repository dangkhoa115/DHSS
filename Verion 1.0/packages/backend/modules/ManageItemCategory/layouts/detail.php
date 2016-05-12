<?php 
$title = (URL::get('cmd')=='delete')?'Delete':'view';
$action = (URL::get('cmd')=='delete')?'delete':'detail';
?>
<div class="form_bound">
	<table cellpadding="0" width="100%"><tr><td  class="form_title"><?php echo $title;?></td><?php 
			if(URL::get('cmd')=='delete'){?><?php 
			}else{ 
				if(User::can_edit(false,ANY_CATEGORY)){?><?php } 
				if(User::can_delete(false,ANY_CATEGORY)){?><?php }
			}?>
			</tr></table>
	</script>
<div class="form_content">
<table cellspacing="0" align="center">
  <tr valign="top" >
  <td rowspan="5" align="center" valign="top">&nbsp;</td>
    <td class="form_detail_label">&nbsp;</td>
    <td width="1">&nbsp;</td>
    <td class="form_detail_value">&nbsp;</td>
  </tr>
  	<tr>
		<td class="form_detail_label">&nbsp;</td>
		<td>&nbsp;</td>
		<td class="form_detail_value">&nbsp;</td>
	</tr><tr>
		<td class="form_detail_label">&nbsp;</td>
		<td>&nbsp;</td>
		<td class="form_detail_value">&nbsp;</td>
	</tr>
	</table>
	<!--IF:delete(URL::get('cmd')=='delete')-->
	<form name="CategoryForm" method="post" action="../../ManageItemCategory/layouts/?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
	<input type="hidden" value="<?php echo URL::get('id');?>" name="selected_ids[]"/>
	<input type="hidden" value="1" name="confirm"/>
	<input type="hidden" value="delete" name="cmd"/>
	<input type="submit" value="  [[.Delete.]]  "/>
	<!--ELSE-->
		<!--IF:can_edit(User::can_edit())-->
		<input type="button" value="   [[.Edit.]]   " onclick="location='<?php echo URL::build_current(+array('cmd'=>'edit','id'=>$_REQUEST['id']));?>';" />
		<!--/IF:can_edit-->
		<!--IF:can_delete(User::can_delete())-->
		<input type="button" value="   [[.Delete.]]   " onclick="location='<?php echo URL::build_current(+array('cmd'=>'delete','id'=>$_REQUEST['id']));?>';" />
		<!--/IF:can_delete-->
	<!--/IF:delete-->
		<input type="button" value="   [[.list.]]   " onclick="location='<?php echo URL::build_current();?>';" />
	<!--IF:delete(URL::get('cmd')=='delete')-->
	</form>
	<!--/IF:delete-->
  </div>
</div>