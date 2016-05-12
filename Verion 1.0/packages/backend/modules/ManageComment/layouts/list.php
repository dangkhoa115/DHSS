<fieldset id="toolbar">
	<legend>[[.content_manage_system.]]</legend>
	<div id="toolbar-title"><?php echo Portal::language(Url::sget('page'));?></div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
   	<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
		<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
        	<th width="2%" align="left"><a>#</a></th>
            <th width="18%" align="left"><a>[[.title.]]</a></th>
            <th width="40%" align="left"><a>[[.content.]]</a></th>
            <th width="10%" align="left"><a>[[.user_post.]]</a></th>
            <th width="20%" align="left"><a>[[.item.]]</a></th>
            <th width="10%" align="left"><a>[[.day_post.]]</a></th>
            <?php if(User::can_edit(false,ANY_CATEGORY)){?><th width="5%" align="left" nowrap="nowrap"><a>[[.publish.]]</a></th><?php }?>
            <?php if(User::can_delete(false,ANY_CATEGORY)){?><th width="5%" align="left"><a>[[.delete.]]</a></th><?php }?>
        </tr>
		<?php $i=1;?>
    	<!--LIST:comments-->
        <tr <?php if($i%2==0){echo 'bgcolor="#F9F9F9"';}?>>
            <td align="left"><?php echo $i++;?></td>
            <td align="left"> [[|comments.title|]]</td>
            <td align="left">[[|comments.content|]]</td>
            <td align="left">[[|comments.user_id|]]</td>
            <td align="left">[[|comments.name|]]&nbsp;<a target="_blank" href="<?php echo Url::build([[=table=]]=='news'?'xem-tin-tuc':'xem-san-pham',array('name_id'=>[[=comments.name_id=]]),REWRITE)?>"><img src="skins/default/images/buttons/search.gif" width="20"></a></td>
            <td align="left"><?php echo date('H:i d/m/Y',[[=comments.time=]]);?></td>
			<?php if(User::can_edit(false,ANY_CATEGORY)){?>
			<td align="center"><input  name="publish_[[|comments.id|]]" type="checkbox" id="publish_[[|comments.id|]]" value="[[|comments.id|]]" <?php if([[=comments.publish=]]){?>checked="checked"<?php }?>onclick="window.location='<?php echo Url::build_current(array('cmd'=>'check','id'=>[[=comments.id=]]))?>'" /></td>
			<?php }?>	
           <?php if(User::can_delete(false,ANY_CATEGORY)){?>
		    <td align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){return true}else{return false}" href="<?php echo Url::build_current(array('cmd'=>'delete','id'=>[[=comments.id=]]))?>"><img src="skins/default/images/cms/menu/publish0.png"></a></td>
   		  <?php }?>
        </tr>
    	<!--/LIST:comments-->
       </table>
		<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
			<tr>
				<td align="right">&nbsp;</td>
				<td align="right">[[|paging|]]</td>
			</tr>
		</table>
		
</fieldset>