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
            <input name="save_only" type="button" value="  <?php echo Portal::language('save');?>  " class="button" onclick="if(jQuery(\'#send_email\').val()){var i = jQuery(\'#send_email\').val();jQuery(\'#send_email\').val(\'\');CheckActive(jQuery(\'#active_\'+i),i);}" />\
			<input id="cancel_active" type="button" value="<?php echo Portal::language('cancel');?>" class="button" onclick="jQuery(\'#mask\').hide();jQuery(\'.window\').hide();var itemId = jQuery(\'#send_email\').val();jQuery(\'#active_\'+itemId).attr(\'checked\',jQuery(\'#active_\'+itemId).attr(\'checked\')?false:true);jQuery(\'#send_email\').val(\'\');" />\
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
            <input name="save_only" type="button" value="<?php echo Portal::language('save');?>" class="button" onclick="if(jQuery(\'#send_email\').val()){var i = jQuery(\'#send_email\').val();jQuery(\'#send_email\').val(\'\');CheckHot(jQuery(\'#hot_\'+i),i);}" />\
			<input id="cancel_hot" type="button" value="<?php echo Portal::language('cancel');?>" class="button" onclick="jQuery(\'#mask\').hide();jQuery(\'.window\').hide();var itemId = jQuery(\'#send_email\').val();jQuery(\'#hot_\'+itemId).attr(\'checked\',jQuery(\'#hot_\'+itemId).attr(\'checked\')?false:true);jQuery(\'#send_email\').val(\'\');" />\
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
            <input name="save_only" type="button" value="<?php echo Portal::language('save');?>" class="button" onclick="if(jQuery(\'#send_email\').val()){var i = jQuery(\'#send_email\').val();jQuery(\'#send_email\').val(\'\');CheckPromote(jQuery(\'#promote_\'+i),i);}" />\
			<input id="cancel_promote" type="button" value="<?php echo Portal::language('cancel');?>" class="button" onclick="jQuery(\'#mask\').hide();jQuery(\'.window\').hide();var itemId = jQuery(\'#send_email\').val();jQuery(\'#promote_\'+itemId).attr(\'checked\',jQuery(\'#promote_\'+itemId).attr(\'checked\')?false:true);jQuery(\'#send_email\').val(\'\');" />\
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
	function make_cmd(cmd){
		jQuery('#cmd').val(cmd);
		document.ManageItem.submit();
	}
	function pickValue(id){
		if(window.opener.document.getElementById('item_id')){
			window.opener.document.getElementById('item_id').value = id;
		}
		if(window.opener.document.getElementById('item_name')){
			window.opener.document.getElementById('item_name').value = (getId('item_name_'+id).innerText).replace(/^\s*|\s(?=\s)|\s*$/g, "");
		}
		window.close();
	}
</script>
<fieldset id="toolbar">
	<div id="toolbar-title" style="text-align:left"><?php echo Portal::language('manage_item');?> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
			<td id="toolbar-move"  align="center"></td>
      <?php if(User::can_add(false,ANY_CATEGORY)){?><td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'add'));?>"> <span title="Thêm mới"> </span> Thêm </a> </td><?php }?>
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
					<input  name="keyword" id="keyword" size="15" style="font-weight:bold;width:200px;" type ="text" value="<?php echo String::html_normalize(URL::get('keyword'));?>">
					Người đăng:
					<input  name="poster" id="poster" size="10" style="font-weight:bold;" type ="text" value="<?php echo String::html_normalize(URL::get('poster'));?>"> <input type="submit" value="Tìm kiếm" /></td>
					<td width="1%" nowrap="nowrap">&nbsp;</td>
					<td width="1%" nowrap="nowrap"><select  name="category_id" id="category_id" class="inputbox" onchange="document.ManageItem.submit();"><?php
					if(isset($this->map['category_id_list']))
					{
						foreach($this->map['category_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('category_id').value = "<?php echo addslashes(URL::get('category_id',isset($this->map['category_id'])?$this->map['category_id']:''));?>";</script>
	</select></td>
					<td width="1%" nowrap="nowrap"><select  name="checked" id="checked" class="inputbox" onchange="document.ManageItem.submit();"><?php
					if(isset($this->map['checked_list']))
					{
						foreach($this->map['checked_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('checked').value = "<?php echo addslashes(URL::get('checked',isset($this->map['checked'])?$this->map['checked']:''));?>";</script>
	</select></td>
					<td width="1%" nowrap="nowrap"><select  name="is_hot" class="inputbox"  id="is_hot" onchange="document.ManageItem.submit();"><?php
					if(isset($this->map['is_hot_list']))
					{
						foreach($this->map['is_hot_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('is_hot').value = "<?php echo addslashes(URL::get('is_hot',isset($this->map['is_hot'])?$this->map['is_hot']:''));?>";</script>
	</select></td>
                  <td width="1%" nowrap="nowrap">&nbsp;</td>
				</tr>
		</table>
		<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" align="center">
			<thead>
					<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
					<th width="1%" align="left" nowrap>No</th>
					<th width="1%" title="<?php echo Portal::language('check_all');?>">
					  <input type="checkbox" value="1" id="ManageItem_all_checkbox" onclick="select_all_checkbox(this.form,'ManageItem',this.checked,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
					<th width="25%" align="left"><a> </a></th>
					<!--<img src="skins/default/images/cms/menu/filesave.png" onclick="jQuery('#cmd').val('update_position');document.ManageItem.submit();" style="cursor:pointer"> -->
					<th width="4%" align="left" nowrap><a>Thời gian </a></th>
					<th width="4%" align="center" nowrap="nowrap">Giá</th>
					<th width="4%" align="left" nowrap>Image</th>
					<th width="4%" align="left" nowrap>Phân loại </th>
					<th width="4%" align="left" nowrap="nowrap">Thông tin người đăng </th>
                    <?php 
				if((User::can_admin(false,ANY_CATEGORY)))
				{?>
					<th width="4%" align="left" nowrap="nowrap">Đã duyệt </th>
					<th width="4%" align="left" nowrap>Hot</th>
					<th width="4%" align="left" nowrap="nowrap">KM</th>
					
				<?php
				}
				?>
				</tr>
		  </thead>
			<tbody>		
			<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>	
			<tr bgcolor="#EFEFEF" valign="top" id="ManageItem_tr_<?php echo $this->map['items']['current']['id'];?>" <?php echo ($this->map['items']['current']['i']%2==0)?'bgcolor="#DAF2FE"':'bgcolor="#FFFFFF"';?>>
				<th width="1%" align="left" nowrap><a href="<?php echo Url::build_current(array('id'=>$this->map['items']['current']['id'],'cmd'=>'edit'));?>"><?php echo $this->map['items']['current']['i'];?> [edit]</a></th>
				<td width="1%"><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'ManageItem',this,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');" id="ManageItem_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td >
				<td  align="left" style="border-right:1px solid #333;border-bottom:1px solid #333" bgcolor="#FFFFFF">
					<span class="label">Tên:</span><div id="name_<?php echo $this->map['items']['current']['id'];?>" style="font-size:14px;"><?php 
				if((Url::get('act')=='select_item'))
				{?><a href="#" onclick="pickValue(<?php echo $this->map['items']['current']['id'];?>);return false;" style="color:#F00;font-weight:bold;">[ Chọn ]</a> 
				<?php
				}
				?><span id="item_name_<?php echo $this->map['items']['current']['id'];?>"><?php echo $this->map['items']['current']['name'];?> (Vị trí: <?php echo $this->map['items']['current']['position'];?>)</span></div></td>
				<td align="left" nowrap><a href="<?php echo Url::build_current(array('cmd'=>'up','id'=>$this->map['items']['current']['id'],'keyword','poster','page_no'));?>" title="<?php echo Portal::language('up_time');?>"><img src="skins/default/images/buttons/up.jpg" /></a> <?php echo date('H:i\' d/m/Y',$this->map['items']['current']['time']);?></td>
				<td align="right" nowrap="nowrap">
        	<?php 
				if(($this->map['items']['current']['public_price']))
				{?>
          Gốc: <strong><?php echo $this->map['items']['current']['public_price'];?></strong><br />
          
				<?php
				}
				?>
				  Bán: <strong><?php echo $this->map['items']['current']['price'];?></strong></td>
				<td align="left" nowrap="nowrap" width="1%"><span id="image_bound_<?php echo $this->map['items']['current']['id'];?>"><?php 
				if(($this->map['items']['current']['image_url']))
				{?><br /><img src="<?php echo $this->map['items']['current']['image_url'];?>" width="50" height="50" onclick="window.open('<?php echo $this->map['items']['current']['image_url'];?>','','width:800px,height:500px');"> <?php }else{ ?>
				<?php
				}
				?></span></td>
				<td align="left" nowrap="nowrap" width="1%"><select   name="category_id_<?php echo $this->map['items']['current']['id'];?>" id="category_id_<?php echo $this->map['items']['current']['id'];?>" onchange="updateCategory(<?php echo $this->map['items']['current']['id'];?>,this.value)"><?php echo $this->map['category_options'];?></select></td>
				<td width="1%" align="left">User: <strong><?php echo $this->map['items']['current']['poster'];?></strong><br />Email: <?php echo $this->map['items']['current']['email'];?></td>
                <?php 
				if((User::can_admin(false,ANY_CATEGORY)))
				{?>
				<td align="center" nowrap="nowrap">
                    <input type="checkbox" name="active[<?php echo $this->map['items']['current']['id'];?>]" id="active_<?php echo $this->map['items']['current']['id'];?>" <?php if($this->map['items']['current']['checked']) echo 'checked="checked"'; ?> readonly="readonly" onclick="return false" />
                    <a href="#dialog" name="modal_active" target="_blank" id="modal_active" lang="<?php echo $this->map['items']['current']['id'];?>" xml:lang="<?php echo $this->map['items']['current']['id'];?>">Change</a> </td>
				<td align="center" nowrap>
                	<input type="checkbox" name="hot[<?php echo $this->map['items']['current']['id'];?>]" id="hot_<?php echo $this->map['items']['current']['id'];?>" <?php if($this->map['items']['current']['is_hot']) echo 'checked="checked"'; ?> readonly="readonly" onclick="return false" />
                    <a target="_blank" href="#dialog" lang="<?php echo $this->map['items']['current']['id'];?>" name="modal_hot">Change</a></td>
				<td align="center" nowrap="nowrap"><input type="checkbox" name="promote[<?php echo $this->map['items']['current']['id'];?>]" id="promote_<?php echo $this->map['items']['current']['id'];?>" <?php if($this->map['items']['current']['promote']) echo 'checked="checked"'; ?> readonly="readonly" onclick="return false" />
										<a target="_blank" href="#dialog" lang="<?php echo $this->map['items']['current']['id'];?>" name="modal_promote">Change</a></td>
				
				<?php
				}
				?>    
			</tr>
     		 <script>
				jQuery('#category_id_<?php echo $this->map['items']['current']['id'];?>').val(<?php echo $this->map['items']['current']['category_id'];?>);
			</script>
			
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
			</tbody>
    </table>
		<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
			<tr>
			<td width="28%" align="left">
				<?php echo Portal::language('select');?>:&nbsp;
				<a onclick="select_all_checkbox(document.ManageItem,'ManageItem',true,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"><?php echo Portal::language('select_all');?></a>&nbsp;
				<a onclick="select_all_checkbox(document.ManageItem,'ManageItem',false,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"><?php echo Portal::language('select_none');?></a>
				<a onclick="select_all_checkbox(document.ManageItem,'ManageItem',-1,'<?php echo Portal::get_setting('crud_list_item_selected_bgcolor','#FFFFEC');?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"><?php echo Portal::language('select_invert');?></a>		</td>
			<td width="18%">&nbsp;<a><?php echo Portal::language('display');?></a>
			  <select  name="item_per_page" class="select" style="width:50px" size="1" onchange="document.ManageItem.submit( );" id="item_per_page" ><?php
					if(isset($this->map['item_per_page_list']))
					{
						foreach($this->map['item_per_page_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('item_per_page').value = "<?php echo addslashes(URL::get('item_per_page',isset($this->map['item_per_page'])?$this->map['item_per_page']:''));?>";</script>
	</select>
			  / <?php echo Portal::language('total');?>:&nbsp;<strong><?php echo $this->map['total'];?> </strong><?php echo Portal::language('record');?></td>
			<td align="center"><?php echo $this->map['paging'];?></td>
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
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
	<div style="#height:8px"></div>
</fieldset>
<div id="boxes">
    <div id="dialog" class="window"></div>
    <div id="mask"></div>
</div>
<script>
	<?php 
				if((Url::get('category_id')))
				{?>
	document.getElementById('category_id').value = <?php echo Url::iget('category_id');?>;
	
				<?php
				}
				?>
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