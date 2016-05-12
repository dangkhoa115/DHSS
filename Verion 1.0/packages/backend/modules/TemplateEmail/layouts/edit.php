<script src="skins/default/css/tabs/tabpane.js" type="text/javascript"></script>
<fieldset id="toolbar">
	<legend>[[.content_manage_system.]]</legend>
 	<div id="toolbar-title">
		[[.content_admin.]] <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <td id="toolbar-save"  align="center"><a onclick="EditTemplateEmail.submit();"> <span title="Edit"> </span> [[.Save.]] </a> </td>
		  <td id="toolbar-cancel"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'list'));?>#"> <span title="New"> </span> [[.Cancel.]] </a> </td>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td>
		</tr>
	  </tbody>
	</table>
 </fieldset>
  <br clear="all">
<fieldset id="toolbar">
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
	<form name="EditTemplateEmail" id="EditTemplateEmail" method="post" enctype="multipart/form-data">
    <table cellspacing="4" cellpadding="4" border="0" width="100%" style="background-color:#FFFFFF;">
    <tr>
      <td valign="top">
	    <table cellpadding="4" cellspacing="0" border="0" width="100%" style="background-color:#F9F9F9;border:1px solid #D5D5D5">					
            <tr>
              <td align="left" nowrap="nowrap" width="1%">[[.folder.]]</td>
              <td align="left"><select name="folder" id="folder" class="select-large"></select> (<span class="require">*</span>)</td>
            </tr>
            <tr>
                <td align="left" nowrap="nowrap" width="1%">[[.path_link.]]</td>
                <td align="left"><input name="file" type="text" id="file" class="input-large" /></td>
            </tr>
        </table>
        <br>
        <table  cellpadding="4" cellspacing="0" border="0" width="100%" style="background-color:#F9F9F9;border:1px solid #D5D5D5" align="center">
            <tr>
                <td>
                <div class="tab-pane-1">
                <div class="tab-page">
                    <div class="form_input_label">[[.name.]] (<span class="require">*</span>)</div>
                    <div class="form_input">
                         <input  name="name" type="text" id="name" value="[[|name|]]" class="input" style="width:60%" <?php if(Url::get('cmd')=='edit'){?> readonly="readonly"<?php }?>  />
                    </div>
                    <div class="form_input_label">[[.description.]]</div>
                    <div class="form_input">
                        <textarea id="description" name="description" cols="75" rows="20" style="width:100%; height:350px;overflow:hidden"><?php echo Url::get('description','');?></textarea><br />
                    </div>
                </div>
                <!--/LIST:languages-->
                </div>
                </td>
           </tr>
        </table>				
      </td>			
    </tr>
    </table>
	</form>
</fieldset>