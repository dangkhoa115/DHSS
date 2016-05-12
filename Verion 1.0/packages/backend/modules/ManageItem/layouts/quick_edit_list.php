<style>
	.label{color:#00C;cursor:pointer;}
	#notice{position:fixed;top:50%;left:50%;background:#09F;color:#FF9;padding:5px 10px;display:none;}
</style>
<script type="text/javascript" src="packages/core/includes/js/jquery/jquery-1.2.6.js"></script>
<script type="text/javascript" src="packages/core/includes/js/jquery/ajaxfileupload.js"></script>
<script>
	jQuery(document).ready(function() {	
		//select all the a tag with name equal to modal
		jQuery('a[name=modal_active]').click(function(e) {
			jQuery('#dialog').html('<div>\
            <input name="save_only" type="button" value="  [[.save.]]  " class="button" onclick="if(jQuery(\'#send_email\').val()){var i = jQuery(\'#send_email\').val();jQuery(\'#send_email\').val(\'\');CheckActive(jQuery(\'#active_\'+i),i);}" />\
			<input id="cancel_active" type="button" value="[[.cancel.]]" class="button" onclick="jQuery(\'#mask\').hide();jQuery(\'.window\').hide();var itemId = jQuery(\'#send_email\').val();jQuery(\'#active_\'+itemId).attr(\'checked\',jQuery(\'#active_\'+itemId).attr(\'checked\')?false:true);jQuery(\'#send_email\').val(\'\');" />\
        	</div>');	
			//Cancel the link behavior
			e.preventDefault();
			
			//Get the A tag
			var id = jQuery(this).attr('href');
			//Get the screen height and width
			var maskHeight = jQuery(document).height();
			var maskWidth = jQuery(window).width();
		
			//Set heigth and width to mask to fill up the whole screen
			jQuery('#mask').css({'width':maskWidth,'height':maskHeight});
			
			//transition effect		
			jQuery('#mask').fadeIn(1000);	
			jQuery('#mask').fadeTo("slow",0.8);	
		
			//Get the window height and width
			var winH = jQuery(document).height();
			var winW = jQuery(window).width();
				  
			//Set the popup window to center
			//jQuery(id).css('top',  winH/2-jQuery(id).height()/2);
			//jQuery(id).css('left', winW/2-jQuery(id).width()/2);
			
			/////////////////////////////////////////////////////
			var itemId = jQuery(this).attr('lang');
			jQuery('#send_email').val(itemId);
			jQuery('#active_'+itemId).attr('checked',jQuery('#active_'+itemId).attr('checked')?false:true);
			//transition effect
			jQuery(id).fadeIn(1000); 
		
		});
		
		jQuery('a[name=modal_hot]').click(function(e) {
			jQuery('#dialog').html('<div>\
            <input name="save_only" type="button" value="[[.save.]]" class="button" onclick="if(jQuery(\'#send_email\').val()){var i = jQuery(\'#send_email\').val();jQuery(\'#send_email\').val(\'\');CheckHot(jQuery(\'#hot_\'+i),i);}" />\
			<input id="cancel_hot" type="button" value="[[.cancel.]]" class="button" onclick="jQuery(\'#mask\').hide();jQuery(\'.window\').hide();var itemId = jQuery(\'#send_email\').val();jQuery(\'#hot_\'+itemId).attr(\'checked\',jQuery(\'#hot_\'+itemId).attr(\'checked\')?false:true);jQuery(\'#send_email\').val(\'\');" />\
        	</div>');
			//Cancel the link behavior
			e.preventDefault();
			
			//Get the A tag
			var id = jQuery(this).attr('href');
			//Get the screen height and width
			var maskHeight = jQuery(document).height();
			var maskWidth = jQuery(window).width();
		
			//Set heigth and width to mask to fill up the whole screen
			jQuery('#mask').css({'width':maskWidth,'height':maskHeight});
			
			//transition effect		
			jQuery('#mask').fadeIn(1000);	
			jQuery('#mask').fadeTo("slow",0.8);	
		
			//Get the window height and width
			var winH = jQuery(document).height();
			var winW = jQuery(window).width();
				  
			//Set the popup window to center
			//jQuery(id).css('top',  jQuery(id).height()/2);
			//jQuery(id).css('left', jQuery(id).width()/2);
			
			/////////////////////////////////////////////////////
			var itemId = jQuery(this).attr('lang');
			jQuery('#send_email').val(itemId);
			jQuery('#hot_'+itemId).attr('checked',jQuery('#hot_'+itemId).attr('checked')?false:true);
			//transition effect
			jQuery(id).fadeIn(1000); 
		
		});
	jQuery('a[name=modal_promote]').click(function(e) {
			jQuery('#dialog').html('<div>\
            <input name="save_only" type="button" value="[[.save.]]" class="button" onclick="if(jQuery(\'#send_email\').val()){var i = jQuery(\'#send_email\').val();jQuery(\'#send_email\').val(\'\');CheckPromote(jQuery(\'#promote_\'+i),i);}" />\
			<input id="cancel_promote" type="button" value="[[.cancel.]]" class="button" onclick="jQuery(\'#mask\').hide();jQuery(\'.window\').hide();var itemId = jQuery(\'#send_email\').val();jQuery(\'#promote_\'+itemId).attr(\'checked\',jQuery(\'#promote_\'+itemId).attr(\'checked\')?false:true);jQuery(\'#send_email\').val(\'\');" />\
        	</div>');
			//Cancel the link behavior
			e.preventDefault();
			
			//Get the A tag
			var id = jQuery(this).attr('href');
			//Get the screen height and width
			var maskHeight = jQuery(document).height();
			var maskWidth = jQuery(window).width();
		
			//Set heigth and width to mask to fill up the whole screen
			jQuery('#mask').css({'width':maskWidth,'height':maskHeight});
			
			//transition effect		
			jQuery('#mask').fadeIn(1000);	
			jQuery('#mask').fadeTo("slow",0.8);	
		
			//Get the window height and width
			var winH = jQuery(document).height();
			var winW = jQuery(window).width();
				  
			//Set the popup window to center
			//jQuery(id).css('top',  jQuery(id).height()/2);
			//jQuery(id).css('left', jQuery(id).width()/2);
			
			/////////////////////////////////////////////////////
			var itemId = jQuery(this).attr('lang');
			jQuery('#send_email').val(itemId);
			jQuery('#promote_'+itemId).attr('checked',jQuery('#promote_'+itemId).attr('checked')?false:true);
			//transition effect
			jQuery(id).fadeIn(1000); 
		});
	});
	function check_selected()
	{
		var status = false;
		jQuery('form :checkbox').each(function(e){
			if(this.checked)
			{
				status = true;
			}
		});	
		return status;
	}
	function make_cmd(cmd)
	{
		jQuery('#cmd').val(cmd);
		document.ManageItem.submit();
	}
</script>
<fieldset id="toolbar">
	<div id="toolbar-title" style="text-align:left">[[.manage_item.]] <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
			<td id="toolbar-move"  align="center"></td>
		  <?php if(User::can_admin(false,ANY_CATEGORY)){?><td id="toolbar-trash"  align="center"><a onclick="if(confirm('Are you sure delete?')){if(check_selected()){make_cmd('delete')}else{alert('<?php echo Portal::language('You_must_select_atleast_item');?>');}}"> <span title="Trash"> </span> Xóa </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<div id="notice"></div>
<fieldset id="toolbar">
	<form name="ManageItem" method="post" enctype="multipart/form-data">
		<a name="top_anchor"></a>		
			<table cellpadding="0" cellspacing="6" width="100%">
				<tr>
					<td align="left">
					Từ khóa:
					<input name="keyword" type="text" id="keyword" size="15" style="font-weight:bold;width:200px;">
					Người đăng:
					<input name="poster" type="text" id="poster" size="10" style="font-weight:bold;"> <input type="submit" value="Tìm kiếm" /></td>
					<td width="1%" nowrap="nowrap">&nbsp;</td>
					<td width="1%" nowrap="nowrap"><select name="category_id" id="category_id" class="inputbox" onchange="document.ManageItem.submit();"></select></td>
					<td width="1%" nowrap="nowrap"><select name="checked" id="checked" class="inputbox" onchange="document.ManageItem.submit();"></select></td>
					<td width="1%" nowrap="nowrap"><select name="is_hot" class="inputbox"  id="is_hot" onchange="document.ManageItem.submit();"></select></td>
                  <td width="1%" nowrap="nowrap">&nbsp;</td>
				</tr>
		</table>
		<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" align="center">
			<thead>
					<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
					<th width="1%" align="left" nowrap>No</th>
					<th width="1%" title="[[.check_all.]]">
					  <input type="checkbox" value="1" id="ManageItem_all_checkbox" onclick="select_all_checkbox(this.form,'ManageItem',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
					<th width="25%" align="left"><a> </a></th>
					<!--<img src="skins/default/images/cms/menu/filesave.png" onclick="jQuery('#cmd').val('update_position');document.ManageItem.submit();" style="cursor:pointer"> -->
					<th width="4%" align="left" nowrap><a>Thời gian </a></th>
					<th width="4%" align="left" nowrap="nowrap">Giá</th>
					<th width="4%" align="left" nowrap>Image</th>
					<th width="4%" align="left" nowrap>Phân loại </th>
					<th width="4%" align="left" nowrap="nowrap">Thông tin người đăng </th>
                    <!--IF:user_cond(User::can_admin(false,ANY_CATEGORY))-->
					<th width="4%" align="left" nowrap="nowrap">Đã duyệt </th>
					<th width="4%" align="left" nowrap>Hot</th>
					<th width="4%" align="left" nowrap="nowrap">KM</th>
					<!--/IF:user_cond-->
				</tr>
		  </thead>
			<tbody>		
			<!--LIST:items-->	
			<tr bgcolor="#EFEFEF" valign="top" id="ManageItem_tr_[[|items.id|]]" <?php echo ([[=items.i=]]%2==0)?'bgcolor="#DAF2FE"':'bgcolor="#FFFFFF"';?>>
				<th width="1%" align="left" nowrap><a href="<?php echo Url::build_current(array('id'=>[[=items.id=]],'cmd'=>'edit'));?>">[[|items.i|]] [edit]</a></th>
				<td width="1%"><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'ManageItem',this,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');" id="ManageItem_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td >
				<td  align="left" style="border-right:1px solid #333;border-bottom:1px solid #333" bgcolor="#FFFFFF">
					<span class="label" onclick="drawEditDialog(getId('name_[[|items.id|]]'),'[[|items.id|]]','[[|items.name|]]','NAME')" title="Sửa">Tên:</span><div id="name_[[|items.id|]]" style="font-size:14px;">[[|items.name|]]</div>
                    <hr size="1" color="#CCCCCC">
					<span class="label" onclick="drawEditDialog(getId('content_[[|items.id|]]'),'[[|items.id|]]','<?php echo strip_tags([[=items.content=]]);?>','CONTENT')" title="Sửa">Diễn giải:</span><div id="content_[[|items.id|]]"><?php echo strip_tags([[=items.content=]]);?></div>
                    <hr size="1" color="#CCCCCC">
                    <span class="label" onclick="drawEditDialog(getId('youtube_[[|items.id|]]'),'[[|items.id|]]','[[|items.youtube|]]','YOUTUBE')" title="Sửa">Youtube:</span><div id="youtube_[[|items.id|]]" style="font-size:14px;">[[|items.youtube|]]</div>
				<td align="left" nowrap><a href="<?php echo Url::build_current(array('cmd'=>'up','id'=>[[=items.id=]],'keyword','poster','page_no'));?>" title="[[.up_time.]]"><img src="skins/default/images/buttons/up.jpg" /></a> <?php echo date('H:i\' d/m/Y',[[=items.time=]]);?></td>
				<td align="left" nowrap="nowrap"><input  name="price_[[|items.id|]]" type="text" id="price_[[|items.id|]]" value="[[|items.price|]]" style="width:70px;text-align:right;"  onchange='updateContent(this,[[|items.id|]],this.value,&quot;PRICE&quot;);' onblur='updateContent(this,[[|items.id|]],this.value,&quot;PRICE&quot;);' /></td>
				<td align="left" nowrap="nowrap" width="1%"><div ondblclick=""><input name="image_url_[[|items.id|]]" type="file" id="image_url_[[|items.id|]]" style="width:85px;border:0px;" onchange="updateImageUrl(this,[[|items.id|]],this.value);" /><span id="image_bound_[[|items.id|]]"><!--IF:cond([[=items.image_url=]])--><br /><img src="[[|items.image_url|]]" width="50" height="50" onclick="window.open('[[|items.image_url|]]','','width:800px,height:500px');"><!--ELSE--><!--/IF:cond--></span></div></td>
				<td align="left" nowrap="nowrap" width="1%"><select  name="category_id_[[|items.id|]]" id="category_id_[[|items.id|]]" onchange="updateCategory([[|items.id|]],this.value)">[[|category_options|]]</select></td>
				<td width="1%" align="left">User: <strong>[[|items.poster|]]</strong><br />Email: <input name="email_[[|items.id|]]" type="text" value="[[|items.email|]]" style="width:50px;font-size:11px;" /></td>
                <!--IF:user_cond(User::can_admin(false,ANY_CATEGORY))-->
				<td align="center" nowrap="nowrap">
                    <input type="checkbox" name="active[[[|items.id|]]]" id="active_[[|items.id|]]" <?php if([[=items.checked=]]) echo 'checked="checked"'; ?> readonly="readonly" onclick="return false" />
                    <a href="#dialog" name="modal_active" target="_blank" id="modal_active" lang="[[|items.id|]]" xml:lang="[[|items.id|]]">Change</a> </td>
				<td align="center" nowrap>
                	<input type="checkbox" name="hot[[[|items.id|]]]" id="hot_[[|items.id|]]" <?php if([[=items.is_hot=]]) echo 'checked="checked"'; ?> readonly="readonly" onclick="return false" />
                    <a target="_blank" href="#dialog" lang="[[|items.id|]]" name="modal_hot">Change</a></td>
				<td align="center" nowrap="nowrap"><input type="checkbox" name="promote[[[|items.id|]]]" id="promote_[[|items.id|]]" <?php if([[=items.promote=]]) echo 'checked="checked"'; ?> readonly="readonly" onclick="return false" />
										<a target="_blank" href="#dialog" lang="[[|items.id|]]" name="modal_promote">Change</a></td>
				<!--/IF:user_cond-->    
			</tr>
     		 <script>
				jQuery('#category_id_[[|items.id|]]').val([[|items.category_id|]]);
			</script>
			<!--/LIST:items-->
			</tbody>
    </table>
		<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
			<tr>
			<td width="28%" align="left">
				[[.select.]]:&nbsp;
				<a onclick="select_all_checkbox(document.ManageItem,'ManageItem',true,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_all.]]</a>&nbsp;
				<a onclick="select_all_checkbox(document.ManageItem,'ManageItem',false,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_none.]]</a>
				<a onclick="select_all_checkbox(document.ManageItem,'ManageItem',-1,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');">[[.select_invert.]]</a>		</td>
			<td width="18%">&nbsp;<a>[[.display.]]</a>
			  <select name="item_per_page" class="select" style="width:50px" size="1" onchange="document.ManageItem.submit( );" id="item_per_page" ></select>
			  / [[.total.]]:&nbsp;<strong>[[|total|]] </strong>[[.record.]]</td>
			<td align="center">[[|paging|]]</td>
		  </tr>
  </table>
		<table width="100%" class="table_page_setting">
		</table>
		<input type="hidden" name="cmd" value="" id="cmd">
		<input type="hidden" name="page_no" value="1" id="page_no">
		<input type="hidden" name="active_id" value="" id="active_id">
		<input type="hidden" name="active_value" value="" id="active_value">
    <input type="hidden" name="send_email" value="" id="send_email">
    <div id="loading" style="display:none;padding:5px 20px 5px 20px;float:left;background:#FF0;font-size:14px;font-weight:bold;color:#666;position:fixed;">Loading...</div>
	</form>
	<div style="#height:8px"></div>
</fieldset>
<div id="boxes">
    <div id="dialog" class="window"></div>
    <div id="mask"></div>
</div>
<script>
	<!--IF:cond(Url::get('category_id'))-->
	document.getElementById('category_id').value = <?php echo Url::iget('category_id');?>;
	<!--/IF:cond-->
	function CheckActive(obj,id){
		value = obj.attr('checked')?1:0;
		jQuery('#cmd').val('check_active');
		jQuery('#active_id').val(id);
		jQuery('#active_value').val(value);
		jQuery('#page_no').val(<?php echo Url::get('page_no'); ?>);
		document.ManageItem.submit();
	}
	function CheckHot(obj,id){
		value = obj.attr('checked')?1:0;
		jQuery('#cmd').val('check_hot');
		jQuery('#active_id').val(id);
		jQuery('#active_value').val(value);
		jQuery('#page_no').val(<?php echo Url::get('page_no'); ?>);
		document.ManageItem.submit();
	}
	function CheckPromote(obj,id){
		value = obj.attr('checked')?1:0;
		jQuery('#cmd').val('check_promote');
		jQuery('#active_id').val(id);
		jQuery('#active_value').val(value);
		jQuery('#page_no').val(<?php echo Url::get('page_no'); ?>);
		document.ManageItem.submit();
	}
	function drawEditDialog(obj,itemId,value,type){
		oldContent = obj.innerHTML;
		if(type == 'CONTENT'){
			var content_ = document.createElement('textarea');
			content_.id = 'content_'+itemId;
			content_.name = 'content_'+itemId;
			obj.innerHTML = "<textarea name='content_"+itemId+"' id='content_"+itemId+"' style='width:99%;height:200px;' onchange='updateContent(this,"+itemId+",this.value,\"CONTENT\");' onBlur='updateContent(this,"+itemId+",this.value,\"CONTENT\");'>"+value+"</textarea>";
			advance_mce('content_'+itemId);
		}else if(type == 'NAME'){
			obj.innerHTML = "<input name='name_"+itemId+"' type='text' id='name_"+itemId+"' value='"+value+"' style='width:99%;height:30px;' onchange='updateContent(this,"+itemId+",this.value,\"NAME\");' onBlur='updateContent(this,"+itemId+",this.value,\"NAME\");'>";
		}else if(type == 'YOUTUBE'){
			obj.innerHTML = "<input name='youtube_"+itemId+"' type='text' id='youtube_"+itemId+"' value='"+value+"' style='width:99%;height:30px;' onchange='updateContent(this,"+itemId+",this.value,\"YOUTUBE\");' onBlur='updateContent(this,"+itemId+",this.value,\"YOUTUBE\");'>";
		}
	}
	function updateCategory(itemId,categoryId){
		jQuery.ajax({
			method: "POST",
			url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
			data : {
				cmd:'update_category',
				item_id:itemId,
				category_id:categoryId
			},
			beforeSend: function(){
				//jQuery('#notice').html('<h3>loading...</h3>');
			},
			success: function(){
				alert('Update thành công');
			}
		});
	}
	function updateContent(obj,itemId,content,type){
		if(type == 'CONTENT'){
			var cmd = 'update_content';
		}else if(type == 'NAME'){	
			var cmd = 'update_name';
		}else if(type == 'YOUTUBE'){
			var cmd = 'update_youtube';
		}else if(type == 'PRICE'){
			var cmd = 'update_price';
		}else{
			var cmd = '';
		}
		if(type == 'PRICE'){
			
		}else{
			jQuery('#'+(obj.id)).html(content);
		}
		jQuery.ajax({
			method: "POST",
			url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
			data : {
				cmd:cmd,
				item_id:itemId,
				content:content
			},
			beforeSend: function(){
				jQuery('#notice').html('<h3>loading...</h3>');
				jQuery('#notice').fadeIn();
			},
			success: function(content){
				//autocomplate({zone_id:obj.value});
				jQuery('#notice').html('');
				jQuery('#notice').hide();
			}
		});
	}
	function updateImageUrl(obj,itemId){
		jQuery("#loading").ajaxStart(function(){
			jQuery(this).show();
		}).ajaxComplete(function(){
			jQuery(this).hide();
		});
		jQuery.ajaxFileUpload
		(
			{
				url:"form.php?block_id=<?php echo Module::block_id(); ?>",
				fileElementId:'image_url_'+itemId,
				dataType:'json',
				data:{cmd:'update_image_url', item_id:itemId},
				success: function (content,status){
					jQuery("image_bound_"+itemId).html("<img src="+content.msg+" width='50'>");
					location.reload();
				},
				error: function (content, status, e){
					alert(e);
				}
			}
		);
	}
</script>