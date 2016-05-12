<script type="text/javascript" src="skins/admin/scripts/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "#description_1",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<fieldset id="toolbar">
	<legend><?php echo Portal::language('content_manage_system');?></legend>
 	<div id="toolbar-title">
		<?php echo Portal::language('manage_news');?> <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content">
	<table align="right">
	  <tbody>
		<tr>
		  <td id="toolbar-save"  align="center"><a onclick="EditNewsAdmin.submit();"> <span title="Edit"> </span> Ghi lại </a> </td>
		  <td id="toolbar-cancel"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'list'));?>#"> <span title="New"> </span> Quay lại </a> </td>
		</tr>
	  </tbody>
	</table>
</fieldset>
<br clear="all">
<fieldset id="toolbar">
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
	<form name="EditNewsAdmin" id="EditNewsAdmin" method="post" enctype="multipart/form-data">
		<table cellspacing="4" cellpadding="4" border="0" width="100%" style="background-color:#FFFFFF;">
		<tr>
		  <td valign="top">
	    <table cellpadding="4" cellspacing="0" border="0" width="100%" style="background-color:#F9F9F9;border:1px solid #D5D5D5">
					<tr>
					  <td width="16%" align="left"><?php echo Portal::language('category_id');?> (<span class="require">*</span>)</td>
					  <td width="28%" align="left"><select  name="category_id" id="category_id" class="select-large"><?php
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
					  <td width="12%" align="left"><?php if(User::can_admin(false,ANY_CATEGORY)){?><?php echo Portal::language('publish');?><?php }?></td>
					  <td width="44%" align="left"><?php if(User::can_admin(false,ANY_CATEGORY)){?><input  name="publish" type="checkbox" value="1" id="publish" <?php if(Url::get('publish')==1){echo 'checked="checked"';}?>><?php }?></td>
				  </tr>
					<tr>
						<td align="left"><?php echo Portal::language('status');?></td>
						<td align="left"><select  name="status" id="status" class="select-large"><?php
					if(isset($this->map['status_list']))
					{
						foreach($this->map['status_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('status').value = "<?php echo addslashes(URL::get('status',isset($this->map['status'])?$this->map['status']:''));?>";</script>
	</select></td>
						<td align="left"><?php echo Portal::language('position');?></td>
						<td align="left"><input  name="position" id="position" class="input" type ="text" value="<?php echo String::html_normalize(URL::get('position'));?>"></td>
					</tr>
				</table>
				<br>
				<table  cellpadding="4" cellspacing="0" border="0" width="100%" style="background-color:#F9F9F9;border:1px solid #D5D5D5" align="center">
					<tr>
						<td>
						<div class="tab-pane-1" id="tab-pane-category">
						
						<div class="tab-page" id="tab-page-category-1">
							<h2 class="tab">Tiếng Việt</h2>
							<div class="form_input_label"><?php echo Portal::language('name');?> (<span class="require">*</span>)</div>
							<div class="form_input">
								 <input  name="name_1" id="name_1" style="width:60%;border:1px solid #CCCCCC;"  / type ="text" value="<?php echo String::html_normalize(URL::get('name_1'));?>">
							</div>
							<div class="form_input_label"><?php echo Portal::language('brief');?></div>
							<div class="form_input">
								<textarea id="brief_1" name="brief_1" cols="75" rows="20" style="width:99%; height:200px;overflow:hidden"><?php echo Url::get('brief_1');?></textarea><br />
							</div>
							<div class="form_input_label"><?php echo Portal::language('description');?></div>
							<div class="form_input">
								<textarea id="description_1" name="description_1" cols="75" rows="20" style="width:99%; height:350px;overflow:hidden"><?php echo Url::get('description_1');?></textarea><br />
							</div>
						</div>
						
						</div>						
						</td>
				   </tr>
				</table>				
			</td>
			<td valign="top" style="width:320px;">
				<table width="100%" style="border: 1px dashed silver;" cellpadding="4" cellspacing="2">
				<tr>
					<td><strong><?php echo Portal::language('Status');?></strong></td>
					<td><?php echo Url::get('status','0');?></td>				
				</tr>
				<tr>
				  <td><strong><?php echo Portal::language('Rating');?></strong></td>
				  <td><?php echo Url::get('rating','0');?></td>
				  </tr>
				<tr>
					<td><strong><?php echo Portal::language('Hitcount');?></strong></td>
					<td><?php echo Url::get('hitcount','0');?></td>
				</tr>
				<tr>
					<td><strong><?php echo Portal::language('Created');?></strong></td>
					<td><?php echo date('h\h:i d/m/Y',Url::get('time',time()));?></td>					
				</tr>
				<tr>
					<td><strong><?php echo Portal::language('Modified');?></strong></td>
					<td><?php echo Url::get('last_time_update')?date('h\h:i d/m/Y',Url::get('last_time_update')):'Not modified';?></td>
				</tr>				
				</table>
				<div id="panel">
					<div id="panel_1"  style="margin-top:8px;">
					<span><?php echo Portal::language('images');?></span>
					<table cellpadding="4" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">
						<tr>
							<td width="30%" align="right"><?php echo Portal::language('small_thumb');?></td>
						    <td width="70%" align="left"><input  name="small_thumb_url" id="small_thumb_url" class="file" size="18" type ="file" value="<?php echo String::html_normalize(URL::get('small_thumb_url'));?>"><div id="delete_small_thumb_url"><?php if(Url::get('small_thumb_url') and file_exists(Url::get('small_thumb_url'))){?>[<a href="<?php echo Url::get('small_thumb_url');?>" target="_blank" style="color:#FF0000"><?php echo Portal::language('view');?></a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','link'=>Url::get('small_thumb_url')));?>" onclick="jQuery('#delete_small_thumb_url').html('');" target="_blank" style="color:#FF0000"><?php echo Portal::language('delete');?></a>]<?php }?></div></td>
						</tr>	
						<tr>
							<td width="30%" align="right"><?php echo Portal::language('image_url');?></td>
						    <td width="70%" align="left"><input  name="image_url" id="image_url" class="file" size="18" type ="file" value="<?php echo String::html_normalize(URL::get('image_url'));?>"><div id="delete_image_url"><?php if(Url::get('image_url') and file_exists(Url::get('image_url'))){?>[<a href="<?php echo Url::get('image_url');?>" target="_blank" style="color:#FF0000"><?php echo Portal::language('view');?></a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','link'=>Url::get('image_url')));?>" onclick="jQuery('#delete_image_url').html('');" target="_blank" style="color:#FF0000"><?php echo Portal::language('delete');?></a>]<?php }?></div></td>
						</tr>
						<tr>
							<td width="30%" align="right"><?php echo Portal::language('attach_file');?></td>
						    <td width="70%" align="left"><input  name="file" id="file" class="file" size="18" type ="file" value="<?php echo String::html_normalize(URL::get('file'));?>"><div id="delete_file"><?php if(Url::get('file') and file_exists(Url::get('file'))){?>[<a href="<?php echo Url::get('file');?>" target="_blank" style="color:#FF0000"><?php echo Portal::language('view');?></a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','link'=>Url::get('file')));?>" onclick="jQuery('#delete_file').html('');" target="_blank" style="color:#FF0000"><?php echo Portal::language('delete');?></a>]<?php }?></div></td>
						</tr>		
            <tr>
							<td align="center" colspan="2"><a href="#" onClick="window.open('?page=file_manager','Quan ly thu vien anh','width=950,height=600,left=280');return false;">Quản lý thư viện ảnh</a></td>
						</tr>					
					</table>
					</div>
					<div id="panel_1" style="margin-top:8px;">
					<span><?php echo Portal::language('Parameters_article');?></span>
					<table cellpadding="4" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9" style="margin-top:2px;">
						<tr>
							<td width="49%" align="right"><?php echo Portal::language('author');?></td>
						  <td width="51%" align="left"><?php echo Url::get('author')?></td>
						</tr>
						<tr>
							<td width="49%" align="right"><?php echo Portal::language('hitcount');?></td>
						  <td width="51%" align="left"><input  name="hitcount" id="hitcount" class="input" type ="text" value="<?php echo String::html_normalize(URL::get('hitcount'));?>"></td>
						</tr>
						<tr>
						  <td width="49%" align="right"><?php echo Portal::language('show_image_in_detail');?></td>
						  <td width="51%" align="left"><select  name="show_image" id="show_image" class="select"><?php
					if(isset($this->map['show_image_list']))
					{
						foreach($this->map['show_image_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('show_image').value = "<?php echo addslashes(URL::get('show_image',isset($this->map['show_image'])?$this->map['show_image']:''));?>";</script>
	</select></td>
						  </tr>
						<tr>
							<td width="49%" align="right"><?php echo Portal::language('pdf_icon');?></td>
						  <td width="51%" align="left"><select  name="pdf_icon" id="pdf_icon" class="select"><?php
					if(isset($this->map['pdf_icon_list']))
					{
						foreach($this->map['pdf_icon_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('pdf_icon').value = "<?php echo addslashes(URL::get('pdf_icon',isset($this->map['pdf_icon'])?$this->map['pdf_icon']:''));?>";</script>
	</select></td>
						</tr>
						<tr>
							<td width="49%" align="right"><?php echo Portal::language('print_icon');?></td>
						  <td width="51%" align="left"><select  name="print_icon" id="print_icon" class="select"><?php
					if(isset($this->map['print_icon_list']))
					{
						foreach($this->map['print_icon_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('print_icon').value = "<?php echo addslashes(URL::get('print_icon',isset($this->map['print_icon'])?$this->map['print_icon']:''));?>";</script>
	</select></td>
						</tr>
						<tr>
							<td width="49%" align="right"><?php echo Portal::language('email_icon');?></td>
						  <td width="51%" align="left"><select  name="email_icon" id="email_icon" class="select"><?php
					if(isset($this->map['email_icon_list']))
					{
						foreach($this->map['email_icon_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('email_icon').value = "<?php echo addslashes(URL::get('email_icon',isset($this->map['email_icon'])?$this->map['email_icon']:''));?>";</script>
	</select></td>
						</tr>
						<tr>
							<td width="49%" align="right"><?php echo Portal::language('show_time');?></td>
						  <td width="51%" align="left"><select  name="show_time" id="show_time" class="select"><?php
					if(isset($this->map['show_time_list']))
					{
						foreach($this->map['show_time_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('show_time').value = "<?php echo addslashes(URL::get('show_time',isset($this->map['show_time'])?$this->map['show_time']:''));?>";</script>
	</select></td>
						</tr>
						<tr>
							<td width="49%" align="right"><?php echo Portal::language('show_author');?></td>
						  <td width="51%" align="left"><select  name="show_author" id="show_author" class="select"><?php
					if(isset($this->map['show_author_list']))
					{
						foreach($this->map['show_author_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('show_author').value = "<?php echo addslashes(URL::get('show_author',isset($this->map['show_author'])?$this->map['show_author']:''));?>";</script>
	</select></td>
						</tr>
						<tr>
							<td width="49%" align="right"><?php echo Portal::language('show_comment');?></td>
						  <td width="51%" align="left"><select  name="show_comment" id="show_comment" class="select"><?php
					if(isset($this->map['show_comment_list']))
					{
						foreach($this->map['show_comment_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('show_comment').value = "<?php echo addslashes(URL::get('show_comment',isset($this->map['show_comment'])?$this->map['show_comment']:''));?>";</script>
	</select></td>
						</tr>
					</table>
					</div>
					<div id="panel_1"  style="margin-top:8px;">
					<span><?php echo Portal::language('Metadata_information');?></span>
					<table cellpadding="4" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">
          <tr>
							<td width="30%" align="right">Title tùy chọn</td>
						  <td width="70%" align="left"><textarea  name="site_title" id="site_title" class="input-large" style="width:99%;" rows="3"><?php echo String::html_normalize(URL::get('site_title',''));?></textarea></td>
						</tr>	
						<tr>
							<td width="30%" align="right"><?php echo Portal::language('keywords');?></td>
						  <td width="70%" align="left"><textarea  name="keywords" id="keywords" class="input-large" style="width:99%;" rows="5"><?php echo String::html_normalize(URL::get('keywords',''));?></textarea></td>
						</tr>	
						<tr>
							<td width="30%" align="right"><?php echo Portal::language('tags');?></td>
						  <td width="70%" align="left"><textarea  name="tags" id="tags" class="input-large" style="width:99%;" rows="5"><?php echo String::html_normalize(URL::get('tags',''));?></textarea></td>
						</tr>					
					</table>
					</div>
				</div>
			</td>
		</tr>
		</table>
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
</fieldset>
<script>
		jQuery('#category_id').val(<?php echo Url::get('category_id')?>);
		jQuery('#status').val("<?php echo Url::get('status')?>");
</script>