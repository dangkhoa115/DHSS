<script>
function make_cmd(cmd)
{
	jQuery('#cmd').val(cmd);
	document.FrontEndForm.submit();
}
</script><fieldset id="toolbar">
	<legend>[[.config_manage.]]</legend>
	<div id="toolbar-info">[[.front_end_config.]]</div>
	<div id="toolbar-content">
	<table align="right">
	  <tbody>
		<tr>
		<td id="toolbar-save"  align="center"><a onclick="make_cmd('save');"> <span title="[[.Save.]]"> </span> [[.Save.]] </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<div style="height:8px;"></div>
 <fieldset id="toolbar">
<form name="FrontEndForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>" enctype="multipart/form-data">	
	<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
		<tr style="background-color:#F0F0F0">
			<th width="26%" align="left"><a>[[.Setting_name.]]</a></th>
			<th width="80%" align="left"><a>[[.Value.]]</a></th>
		</tr>        			
        <tr>
          <td align="left" valign="top" title="site_icon">[[.icon_on_address.]] (*.icon)</td>
          <td align="left"><input name="config_site_icon" type="file" id="config_site_icon" class="file">
            <div id="delete_site_icon">
              <?php if(Url::get('config_site_icon') and file_exists(Url::get('config_site_icon'))){?>
              [<a href="<?php echo Url::get('config_site_icon');?>" target="_blank" style="color:#FF0000">[[.view.]]</a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','link'=>Url::get('config_site_icon')));?>" onclick="jQuery('#delete_site_icon').html('');" target="_blank" style="color:#FF0000">[[.delete.]]</a>]
              <?php }?>
            </div></td>
        </tr>
        <tr>
          <td align="left" valign="top" title="thumb">[[.thumb.]]</td>
          <td align="left"><input name="config_thumb" type="file" id="thumb" class="file">
            <div id="delete_thumb">
              <?php if(Url::get('config_thumb') and file_exists(Url::get('config_thumb'))){?>
              [<a href="<?php echo Url::get('config_thumb');?>" target="_blank" style="color:#FF0000">[[.view.]]</a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','link'=>Url::get('config_thumb')));?>" onclick="jQuery('#delete_thumb').html('');" target="_blank" style="color:#FF0000">[[.delete.]]</a>]
              <?php }?>
            </div></td>
        </tr>
        <tr>
          <td align="left" valign="top" title="support_phone">Hình nền</td>
          <td align="left"><input name="config_background" type="file" id="background" class="file">
            <div id="delete_background">
              <?php if(Url::get('config_background') and file_exists(Url::get('config_background'))){?>
              [<a href="<?php echo Url::get('config_background');?>" target="_blank" style="color:#FF0000">[[.view.]]</a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','link'=>Url::get('config_background')));?>" onclick="jQuery('#delete_background').html('');" target="_blank" style="color:#FF0000">[[.delete.]]</a>]
  <?php }?>
          </div></td>
        </tr>
        <tr>
            <td width="26%" align="left" valign="top" title="support_phone">Video nhà tài trợ</td>
            <td width="80%" align="left"><pre><textarea name="config_sponsor_video" class="textarea-small" id="sponsor_video" style="height:100px;"><?php echo Portal::get_setting('sponsor_video',false,PORTAL_ID);?></textarea></pre></td>
        </tr>
        <tr>
            <td width="26%" align="left" valign="top" title="support_online">[[.footer_content.]]</td>
            <td width="80%" align="left"><textarea name="config_footer_content" class="textarea-small" id="footer_content" style="height:200px"></textarea></td>
        </tr>                
	</table>	

    <input name="cmd" type="hidden" id="cmd" value="front_end">
</form>	
<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%;" align="center">
	<tr>
		<td align="right">&nbsp;</td>
	</tr>
</table>
</fieldset> 