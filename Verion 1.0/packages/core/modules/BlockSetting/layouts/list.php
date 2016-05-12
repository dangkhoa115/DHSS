<script language="javascript" type="text/javascript" src="packages/core/includes/js/custom_input.js"></script>
<?php 
$title = (URL::get('cmd')=='delete')?Portal::language('delete_title'):Portal::language('list_title');
$action = (URL::get('cmd')=='delete')?'delete':'list';
System::set_page_title(Portal::get_setting('website_title','').' '.$title);?>
<TEXTAREA ID="holdtext" STYLE="display:none;">
</TEXTAREA>
<h1 style="color:#000000;">[[.setting_for.]] [[|name|]] </h1> 
<table width="100%"><tr><td style="font-size:16px;"><a target="_blank" href="<?php echo URL::build([[=page_name=]]);?>"><?php echo ucfirst([[=region=]]);?> [[.of.]] [[|page_name|]]</a></td><td align="right"><a target="_blank" href="<?php echo URL::build('module_setting',array('module_id'=>[[=module_id=]]));?>">[[.module_setting.]]</a></td></tr></table><br />
<div class="form_bound" style="background-color:#EFEFEF;border:1px solid #CCCCCC;padding:10px;">
	<div>
		<!--IF:copy(sizeof([[=copy_setting_id_list=]])>1)-->
		<form name="CopyBlockSettingForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
			<input type="hidden" value="copy_setting" name="cmd" />
			<table><tr><td width="150">[[.copy_from.]]</td><td> <select name="copy_setting_id"></select> <input type="submit" name="copy_setting" value="  [[.copy.]]  "/></td></tr></table>
		</form>
		<!--/IF:copy-->
		<form name="ListBlockSettingForm" method="post" enctype="multipart/form-data" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<p><table><tr><td width="150">[[.name.]]</td><td> <input name="name" type="text" id="name" /></td></tr></table></p>
		<?php $column = 1;?>
<div class="tab-pane-1" id="tab-pane-item_type_field">
<!--LIST:groups-->
	<div class="tab-page" id="tab-page-item_type_field-[[|groups.id|]]" style="height:100%;z-index:10;"> 
		<h1 class="tab">[[|groups.name|]]</h1>
		<?php 
			$first = true;
		?>
			<table cellpadding="0" cellspacing="0" width="99%">
			<tr valign="top"><td>
			<!--LIST:groups.items-->
			<?php if([[=groups.items.group_column=]] != 1)
			{
				echo '</td><td>';
			}
			else
			if(!$first)
			{
				echo '</td></tr></table>';
				echo '<table cellpadding="0" cellspacing="0" width="99%">
					<tr valign="top"><td>';
			}
			else
			{
				$first = false;
			}
			?>
			<p>
			<a id="anchor_[[|groups.items.id|]]"></a>
			<!--IF:inline([[=groups.items.style=]]==1)-->
			<div style="display:inline;width:250px;" title="[[|groups.items.id|]]" onclick="holdtext.innerText = '[[|groups.items.id|]]';Copied = holdtext.createTextRange(); Copied.execCommand('Copy');">
					<strong>[[|groups.items.name|]]</strong>
			</div>
			<!--ELSE-->
				<span style="font-weight:bold;font-size:14px" title="[[|groups.items.id|]]" onclick="holdtext.innerText = '[[|groups.items.id|]]';Copied = holdtext.createTextRange(); Copied.execCommand('Copy');">[[|groups.items.name|]]</span><br />
				<!--IF:description([[=groups.items.description=]]!="")-->
				<p>[[|groups.items.description|]]</p>
				<!--/IF:description-->
			<!--/IF:inline-->
			[[|groups.items.value|]]
			<!--IF:inline([[=groups.items.style=]]==1)-->
				<!--IF:description([[=groups.items.description=]]!="")-->
				<p>[[|groups.items.description|]]</p>
				<!--/IF:description-->
			<!--/IF:inline-->
			</p>
			<!--/LIST:groups.items-->
			</td></tr></table>
</div>
<!--/LIST:groups-->
</div>		
<table width="100%" id="util_options"><tr>
<td id="notice" align="right" style="color:#FF3300;font-weight:bold;display:none;" width="50%">[[.data_is_updated.]]...!</td>
<td align="right">
<input type="button" value=" [[.close.]] " class="big_button" onclick="window.close();">
<input type="submit" name="save" value="   [[.save.]]   " class="big_button">
<a name="bottom_anchor" ><img src="<?php echo Portal::template('core');?>/images/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a>
</td>
</tr></table>      
<input type="hidden" name="confirm" value="1" />
</form>
</div>
</div>
<?php if(Url::get('suss')){?>
<script type="text/javascript">
$('notice').style.display = ''
setTimeout("$('notice').style.display = 'none'",2000);
</script>
<?php }?>