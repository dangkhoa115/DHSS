<fieldset id="toolbar">
	<div id="toolbar-personal">[[.manage_contact.]]</div>
	<div id="toolbar-content">
	<table align="right">
	  <tbody>
		<tr>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build('help');?>#"> <span title="Help"> </span> [[.Help.]] </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<div style="padding:5px;">
<form name="ContactList" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
	<table width="100%" cellpadding="3" cellspacing="0" border="1" style="border-collapse:collapse;" bordercolor="#CCCCCC">
		<tr bgcolor="#EBE8D6">
			<th>[[.stt.]]</th>
			<th align="left">[[.full_name.]]</th>
			<th align="left">[[.subject.]]</th>
			<th align="left">[[.time.]]</th>
			<th>[[.checked.]]</th>
			<th>[[.delete.]]</th>
		</tr>
		<?php $i=1;?>
		<!--LIST:items-->
		<tr style="<?php if([[=items.is_check=]]==1){?>font-weight:normal;<?php }else{?>font-weight:bold;<?php }?>cursor:pointer;"<?php if([[=items.is_check=]]!=1){?>bgcolor="#FFFFFF"<?php }else{?>bgcolor="#F2F2F2"<?php }?>>
			<td align="center" onclick="window.location='<?php echo Url::build_current(array('cmd'=>'detail','id'=>[[=items.id=]]))?>'"><?php echo $i;?></td>
			<td onclick="window.location='<?php echo Url::build_current(array('cmd'=>'detail','id'=>[[=items.id=]]))?>'" width="20%" valign="top" style="line-height:18px;;">[[|items.name|]]</td>
			<td onclick="window.location='<?php echo Url::build_current(array('cmd'=>'detail','id'=>[[=items.id=]]))?>'" width="50%" valign="top" style="line-height:18px;;">
      	[[|items.subject|]]<hr>[[|items.content|]]
      </td>
			<td onclick="window.location='<?php echo Url::build_current(array('cmd'=>'detail','id'=>[[=items.id=]]))?>'" nowrap="nowrap"><?php echo date('H:i d/m/Y',[[=items.time=]]);?></td>		
			<td valign="top" nowrap="nowrap" align="center">
				<!--IF:cond([[=items.is_check=]]==1)-->
				<input name="check_[[|items.id|]]"  type="checkbox" id="check_[[|items.id|]]" checked="checked"  onclick="location='<?php echo Url::build_current(array('cmd'=>'check','id'=>[[=items.id=]]));?>'" />
				<!--ELSE-->
				<input name="check_[[|items.id|]]"  type="checkbox" id="check_[[|items.id|]]"  onclick="location='<?php echo Url::build_current(array('cmd'=>'check','id'=>[[=items.id=]]));?>'" />
				<!--/IF:cond-->
			</td>
			<td align="center"><a href="<?php echo URL::build_current(array('cmd'=>'delete'));?>&id=[[|items.id|]]" title="Delete"><img src="skins/default/images/icon/delete2.png" /></a></td>
		</tr>
		<?php $i++;?>
		<!--/LIST:items-->
	</table>
</form>
</div>
<table width="100%" cellpadding="6" cellspacing="0">
<tr>
	<td>[[|paging|]]&nbsp;</td>
</tr>
</table>
<script language="javascript">
function change_display_status(obj, detail_div)
{
	if(obj.style.display=='none')
	{
		obj.style.display='';
		detail_div.innerHTML='[[.close.]]';	
		<!--LIST:items-->
		if('div_[[|items.id|]]' != obj.id)
		{
			$('div_[[|items.id|]]').style.display = 'none';
		}
		<!--/LIST:items-->		
	}
	else
	{
		obj.style.display='none';
		detail_div.innerHTML='[[.detail.]]';
	}
}
</script>