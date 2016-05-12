<style>
.manage-agent-title td{ font-weight:bold; line-height:30px; text-align:center; background:#CCCCCC}
</style>
<fieldset id="toolbar">
	<legend style="font-weight:bold; padding:0px 10px;">[[.document_manage_system.]]</legend>
	<div id="toolbar-title"><?php echo Portal::language(Url::sget('page'));?></div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
			<?php if(User::can_add(false,ANY_CATEGORY)){?><td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'add'));?>#"> <span title="New"> </span> [[.New.]] </a> </td><?php }?>
			<?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar" style="padding:20px 5px">
   	<legend style="font-weight:bold; padding:0px 10px; ">[[.List_agents.]]</legend>
	<table border="1" width="99%">
		<tr class="manage-agent-title">
			<td>[[.Name.]]</td>
			<td>[[.Address.]]</td>
			<td>[[.City.]]</td>
			<td>[[.Edit.]]</td>
			<td>[[.Delete.]]</td>
		</tr>
		<!--LIST:agents-->
		<tr>
			<td onclick="window.location='<?php echo Url::build_current(array('cmd'=>'view','id'=>[[=agents.id=]])); ?>'" style="line-height:20px; cursor:pointer"><b>[[|agents.name|]]</b></td>
			<td>[[|agents.address|]]</td>
			<td>[[|agents.city|]]</td>
			<td align="center"><a href="<?php echo Url::build_current(array('cmd'=>'edit','id'=>[[=agents.id=]])); ?>">[[.Edit.]]</a></td>
			<td align="center"><a onclick="return(confirm('[[.Are_you_sure_delete_account.]] [[|agents.id|]]'));" href="<?php echo Url::build_current(array('cmd'=>'delete','id'=>[[=agents.id=]])); ?>">[[.Delete.]]</a></td>
		</tr>
		<!--/LIST:agents-->
	</table>
</fieldset>