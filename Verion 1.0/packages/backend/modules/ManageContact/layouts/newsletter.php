<fieldset id="toolbar">
	<legend>[[.manage_profile.]]</legend>
	<div id="toolbar-personal">[[.manage_newsletter.]]</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build('help');?>#"> <span title="Help"> </span> [[.Help.]] </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<div style="margin-top:5px;"></div>
<fieldset id="toolbar">
<table width="100%" cellpadding="6" cellspacing="0" style="border:1px solid #E7E7E7;#width:99%;margin-top:8px;margin-bottom:8px" align="center">
<tr style="background-color:#F0F0F0;border:1px solid #E7E7E7;">
	<th align="center"><a>[[.newsletter_list.]]</a></th>
</tr>
<tr>
	<td><textarea style="width:100%;height:300px;border:0px;overflow:auto">[[|content|]]</textarea></td>
</tr>	
<tr style="background-color:#F0F0F0;border:1px solid #E7E7E7;">
	<td>&nbsp;</td>
</tr>
</table>
</fieldset>