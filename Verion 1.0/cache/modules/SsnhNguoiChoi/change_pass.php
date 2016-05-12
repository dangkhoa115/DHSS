<script type="text/javascript" src="skins/default/css/tabs/tabpane.js"></script>
<div class="changepass" style="float:left;width:100%;min-height:300px;">
<fieldset id="toolbar">
	<div id="toolbar-title"><?php echo Portal::language('Change_password');?></div>
	<div id="toolbar-content">
	<table align="right">
	  <tbody>
		<tr>
		<?php if(User::is_login()){?><td id="toolbar-save"  align="center"><a onclick="document.ChangePassword.submit();"> <span title="<?php echo Portal::language('Save');?>"> </span> <?php echo Portal::language('Save');?> </a> </td><?php }?>
    <?php 
				if((Url::get('page') == 'trang-ca-nhan-dhss'))
				{?>
    <?php if(User::is_login()){?><td id="toolbar-config"  align="center"><a href="trang-ca-nhan-dhss.html"> <span title="<?php echo Portal::language('information');?>"></span>Quay lại</a> </td><?php }?>
		 <?php }else{ ?>
		<?php if(User::is_login()){?><td id="toolbar-config"  align="center"><a href="tong-hop.html"> <span title="<?php echo Portal::language('information');?>"></span><?php echo Portal::language('Information');?></a> </td><?php }?>
    
				<?php
				}
				?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<div style="height:6px;"></div>
<fieldset id="toolbar">
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>	
	<form method="post" name="ChangePassword" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>" id="ChangePassword">
		<table cellpadding="4" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="0" bordercolor="#E7E7E7" align="center">
			 <tr align="center">
				<td colspan="3" style="height:10px"></td>
			</tr>
			<tr class="change_pass_text">
				<td align="right" class="change_pass_text"><?php echo Portal::language('old_password');?></td>
				<td align=left><input  name="old_password" id="old_password" class="input-large" type ="password" value="<?php echo String::html_normalize(URL::get('old_password'));?>"></td>
			</tr>
			<tr class="change_pass_text">
				<td width=37% align="right" class="change_pass_text"><?php echo Portal::language('new_password');?></td>
				<td width=63% align=left><input  name="new_password" id="new_password" class="input-large" type ="password" value="<?php echo String::html_normalize(URL::get('new_password'));?>"></td>
			</tr>
			<tr class="change_pass_text">
				<td width=37% align="right"><?php echo Portal::language('retype_new_password');?></td>
				<td width=63% align=left><input  name="retype_new_password" id="retype_new_password" class="input-large" type ="password" value="<?php echo String::html_normalize(URL::get('retype_new_password'));?>"></td>
			</tr>
			 <tr align="center">
				<td colspan="3" style="height:10px"></td>
			</tr>
		</table> 
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
				
</fieldset>
</div>