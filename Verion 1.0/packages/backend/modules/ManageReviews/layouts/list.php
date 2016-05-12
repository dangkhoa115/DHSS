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
   	<form name="filter" id="filter" method="post">
	<table>
		<tr>
			<td>Country : <select name="countries" id="countries" onchange="get_countries(this)" class="select-large"></select></td>
			<td>City : <select name="zone_id" id="zone_id" style="width:153px"></select></td>			
			<td>
				<?php if(User::can_edit(false,ANY_CATEGORY)){?>
				Name filter <input type="text" name="hotel_name" id="hotel_name" />
				<?php }?>
				<input type="submit" value="Search" />
			</td>			
		</tr>
	</table>
	</form>
	<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
		<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
        	<th align="left">#</th>
            <th align="left">[[.Guest_name.]]</a></th>
            <th align="left">[[.Hotel.]]</th>
            <th align="left">[[.Good.]]</th>
            <th align="left">[[.Not_good.]]</th>
            <th align="left">[[.day_post.]]</th>
            <?php if(User::can_edit(false,ANY_CATEGORY)){?><th width="5%" align="left" nowrap="nowrap"><a href="<?php echo Url::build_current(array('publish'=>(Url::get('publish')=='down')?'up':'down')); ?>">[[.publish.]]</a></th><?php }?>
            <?php if(User::can_delete(false,ANY_CATEGORY)){?><th width="5%" align="left"><a>[[.delete.]]</a></th><?php }?>
        </tr>
		<?php $i=1;?>
    	<!--LIST:reviews-->
        <tr <?php if($i%2==0){echo 'bgcolor="#F9F9F9"';}?>>
            <td align="left" valign="top"><?php echo $i++;?></td>
            <td width="1%" nowrap="nowrap" align="left" valign="top"><img style="width:20px;" src="[[|reviews.image_url|]]" /> [[|reviews.full_name|]] </td>
            <td width="1%" nowrap="nowrap" align="left" valign="top"><a title="Click to view all reviews for this hotel" href="<?php echo Url::build_current(array('hotel_id'=>[[=reviews.hotel_id=]])); ?>"> [[|reviews.hotel_name|]] ([[|reviews.zone|]])</a></td>
            <td align="left" valign="top">[[|reviews.good|]]</td>
            <td align="left" valign="top">[[|reviews.not_good|]]</td>
            <td align="left" valign="top"><?php echo date('H:i d/m/Y',[[=reviews.time=]]);?></td>
			<?php if(User::can_edit(false,ANY_CATEGORY)){?>
			<td align="center" valign="top"><input  name="publish_[[|reviews.id|]]" type="checkbox" id="publish_[[|reviews.id|]]" value="[[|reviews.id|]]" <?php if([[=reviews.status=]]=="SHOW"){?>checked="checked"<?php }?> onclick="publish(this,[[|reviews.id|]]);" /></td>
			<?php }?>	
           <?php if(User::can_delete(false,ANY_CATEGORY)){?>
		    <td align="center" valign="top"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_delete');?>')){return true}else{return false}" href="<?php echo Url::build_current(array('cmd'=>'delete','id'=>[[=reviews.id=]]))?>"><img src="skins/default/images/cms/menu/publish0.png"></a></td>
   		  <?php }?>
        </tr>
    	<!--/LIST:reviews-->
       </table>
		<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
			<tr>
				<td align="right">&nbsp;</td>
				<td align="right">[[|paging|]]</td>
			</tr>
		</table>
		
</fieldset>
<script>
	function publish(obj,id)
	{
		if(confirm('Are you sure show/hide this review'))
		{
			window.location='<?php echo Url::build_current(array('cmd'=>'check'));?>&id='+id;
		}else{
			obj.checked = !obj.checked;
		}
	}
	function get_countries(obj)
	{
		if(obj.id != 0)
		{
			jQuery.ajax({
				method: "POST",
				url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
				data : {
					cmd:'get_cities',
					country_id:obj.value
				},
				beforeSend: function(){
					jQuery('#zone_id').html('<option>loading.....</option>');
				},
				success: function(content){
					//autocomplate({zone_id:obj.value});
					jQuery('#zone_id').html(content);
				}
			});
		}
	}
</script>