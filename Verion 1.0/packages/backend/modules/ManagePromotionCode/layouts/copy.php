<fieldset id="toolbar">
	<legend>[[.content_manage_system.]]</legend>
 	<div id="toolbar-title">
		[[.manage_news.]] <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <td id="toolbar-save"  align="center"><a onclick="make_cmd('<?php echo Url::get('cmd','copy')?>');"> <span title="Edit"> </span> [[.Save.]] </a> </td>
		  <td id="toolbar-cancel"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'list'));?>#"> <span title="New"> </span> [[.Cancel.]] </a> </td>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td>
		</tr>
	  </tbody>
	</table>
 </fieldset>
  <br clear="all">
<fieldset id="toolbar">
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
	<form name="CopyManagePromotionCode" id="CopyManagePromotionCode" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<table cellspacing="4" cellpadding="4" border="0" width="100%" style="background-color:#FFFFFF;">
		<tr>
			<td>
				[[.category_id.]]
			</td>
		 </tr>
		 <tr>
			<td>
				<select name="category_id"  class="select-large" id="category_id"   size="20" style="height:200px"></select>
			</td>
		 </tr>
		 </table>
		 <input type="hidden" name="cmd" value="" id="cmd"/>
		 <input  name="selected_ids" type="hidden" id="selected_ids" value="<?php echo implode(',',$_REQUEST['selected_ids']);?>">
	</form>
</fieldset>