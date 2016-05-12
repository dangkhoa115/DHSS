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
		  <td id="toolbar-preview"  align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Move"> </span> [[.Preview.]] </a> </td>
		  <td id="toolbar-save"  align="center"><a onclick="EditContentAdmin.submit();"> <span title="Edit"> </span> [[.Save.]] </a> </td>
		  <td id="toolbar-cancel"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'list'));?>#"> <span title="New"> </span> [[.Cancel.]] </a> </td>
		  <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td>
		</tr>
	  </tbody>
	</table>
 </fieldset>
  <br clear="all">
<fieldset id="toolbar">
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
	<form name="EditContentAdmin" id="EditContentAdmin" method="post" enctype="multipart/form-data">
    <table cellspacing="4" cellpadding="4" border="0" width="100%" style="background-color:#FFFFFF;">
    <tr>
      <td valign="top">
	    <table cellpadding="4" cellspacing="0" border="0" width="100%" style="background-color:#F9F9F9;border:1px solid #D5D5D5">					
            <tr>
              <td align="left" nowrap="nowrap" width="1%">[[.category_id.]]</td>
              <td align="left"><select name="category_id" id="category_id" class="select-large"></select></td>
                <td align="left" nowrap="nowrap" width="1%" style="padding-left:30px;">[[.position.]]</td>
                <td align="left"><input name="position" type="text" id="position" class="input-large" /></td>
            </tr>
            <tr>
                <td align="left" nowrap="nowrap" width="1%">[[.path_link.]]</td>
                <td align="left"><input name="file" type="text" id="file" class="input-large" /></td>
              <td align="left" nowrap="nowrap" width="1%" style="padding-left:30px;">[[.status.]]</td>
              <td width="88%" align="left"><select name="status" id="status" class="select-large"></select></td>
            </tr>
        </table>
        <br>
        <table  cellpadding="4" cellspacing="0" border="0" width="100%" style="background-color:#F9F9F9;border:1px solid #D5D5D5" align="center">
            <tr>
                <td>
                <div class="tab-pane-1" id="tab-pane-category">
                <!--LIST:languages-->
                <div class="tab-page" id="tab-page-category-[[|languages.id|]]">
                    <h2 class="tab">[[|languages.name|]]</h2>
                    <div class="form_input_label">[[.name.]] (<span class="require">*</span>)</div>
                    <div class="form_input">
                         <input name="name_[[|languages.id|]]" type="text" id="name_[[|languages.id|]]" class="input" style="width:60%"  />
                    </div>
                    <div class="form_input_label">[[.description.]]</div>
                    <div class="form_input">
                        <textarea id="description_[[|languages.id|]]" name="description_[[|languages.id|]]" cols="75" rows="20" style="width:100%; height:350px;overflow:hidden"><?php echo Url::get('description_'.[[=languages.id=]],'');?></textarea><br />
                        <script>advance_mce('description_[[|languages.id|]]');</script>
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