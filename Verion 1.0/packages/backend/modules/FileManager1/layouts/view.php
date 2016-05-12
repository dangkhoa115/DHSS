<form method="post" name="data" id="data" enctype="multipart/form-data">
<div class="fm-bound">
	<div class="fm-menu-bound">
	<table width="99%" class="fm-menu" border="1">
		<tr>
			<td colspan="2" align="center">
				<div style="float:left; width:100px;" id="back">
					<img style="width:25px; height:25px" src="skins/default/images/tree_files/back.png" /><br />
					[[.parent_folder.]]
				</div>
				<div style="float:left; width:100px;">
					<div id="create_folder" rel="[[|current|]]">
						<img style="width:25px; height:25px" src="skins/default/images/tree_files/new_folder.jpeg" /><br />
						[[.create_folder.]]
					</div>					
				</div>
				<div style="float:left; width:100px;display:none;" class="fm-create-folder">
					<input type="text" name="folder_name" id="folder_name" />
				</div>
			</td>
			<td>/Root[[|current|]]</td>
		</tr>
		<tr>
			<td width="50%" align="center">
				URL : <input type="text" readonly="true" style="width:70%" id="url" />
				<input type="button" value="insert" id="returnValue"  />
			</td>
			<td align="center" class="fm-upload" colspan="2">
				<span style="font-weight:bold">[[.upload_image.]]</span>
				<input type="file" name="upload" id="upload" />
				<input type="button" value="[[.upload.]]" id="upload-btn"/>
			</td>
		</tr>
	</table>
	</div>
	<div class="fm-list-bound">	
	<!--LIST:list-->
		<!--IF:folder([[=list.type=]]=='folder')-->
			<div class="fm-folder" rel="[[|list.name|]]">
				<img src="skins/default/images/tree_files/directory.png" />
				<div class="fm-name">[[|list.name|]]</div>
			</div>
		<!--/IF:folder-->
		<!--IF:file([[=list.type=]]=='file')-->
			<div class="fm-file" path="[[|list.src|]]" rel="[[|list.name|]]">
				<!--IF:image([[=list.ext=]]=='image')-->
				<img src="[[|list.src|]]" />
				<!--ELSE-->
				<img src="skins/default/images/tree_files/[[|list.ext|]].png" />
				<!--/IF:image-->
				<div class="fm-name">[[|list.name|]]</div>
			</div>
		<!--/IF:file-->
	<!--/LIST:list-->
	</div>
	<div class="clear"></div>
</div>
<div class="fm-menu-command" id="fm-menu-command">
	<div id="delete"><a >[[.delete.]]</a></div>
	<div id="rename"><a >[[.rename.]]</a></div>
</div>
	<input type="hidden" value="[[|current|]]" name="currentFolder" id="currentFolder" />
	<input type="hidden" value="" name="selectedFolder" id="selectedFolder" />
	<input type="hidden" value="" name="type" id="type" />
	<input type="hidden" value="" name="cmd" id="cmd" />
	<input type="submit" style="display:none" />
</form>
<script>
jQuery(function(){
	//tinyMCEPopup.executeOnLoad('init();');
	var FileBrowserDialogue = {
		init : function () {

		},
		mySubmit : function () {
			var URL = document.data.url.value;
			var win = tinyMCEPopup.getWindowArg("window");
			win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = URL;	
			if (typeof(win.ImageDialog) != "undefined") {
				if (win.ImageDialog.getImageData)
					win.ImageDialog.getImageData();
				if (win.ImageDialog.showPreviewImage)
					win.ImageDialog.showPreviewImage(URL);
			}
			tinyMCEPopup.close();
		}
	}
	//tinyMCEPopup.onInit.add(FileBrowserDialogue.init, FileBrowserDialogue);
	
	jQuery('#returnValue').click(function(){
		FileBrowserDialogue.mySubmit();
	});
	jQuery('.fm-folder *').click(function(){
		jQuery('#selectedFolder').val(jQuery(this).parent().attr('rel'));
		jQuery('#type').val('folder');
		if(jQuery(this).parent().hasClass('fm-folder-selected'))
		{
			jQuery(this).parent().removeClass('fm-folder-selected');
		}else
		{
			jQuery('.fm-folder').removeClass('fm-folder-selected');
			jQuery(this).parent().addClass('fm-folder-selected');
		}
	}).dblclick(function(){
		jQuery('#selectedFolder').val(jQuery(this).parent().attr('rel'));
		jQuery('#type').val('folder');
		jQuery('#cmd').val('view');
		Submit();
	}).rightClick(function(e){
		jQuery('.fm-menu-command').css({
			'top':e.pageY,'left':e.pageX
		}).show().mouseout(function(){
			jQuery(this).hide();
		}).children().mouseover(function(){
			jQuery(this).parent().show();
		});		
		jQuery('#selectedFolder').val(jQuery(this).parent().attr('rel'));
		jQuery('#type').val('folder');
	});
	jQuery('#back').click(function(){
		jQuery('#cmd').val('back');
		Submit();
	});
	jQuery('#delete').click(function(){
		//alert('[[.this_function_is_locking.]]');
		if(confirm('[[.Are_you_want_to_delete_this_file.]]'))
		{
			jQuery('#cmd').val('delete');
			Submit();
		}
	});
	jQuery('#rename').click(function(){
		jQuery('#cmd').val('rename');
		var input = '<input type="text" style="width:60px" name="new_name" id="new_name" value="'+jQuery('#selectedFolder').val()+'" />';
		jQuery('*[rel='+jQuery('#selectedFolder').val()+'] .fm-name').html(input);
		jQuery(this).parent().hide();
		jQuery('#new_name').focus().keyup(function(e){
			if(e.which==27)
			{
				jQuery('.fm-folder[rel='+jQuery('#selectedFolder').val()+'] .fm-folder-name').html(jQuery('#selectedFolder').val());
			}
		}).blur(function(){
			Submit();
		});
	});
	jQuery('#create_folder').toggle(
		function(){
			jQuery('.fm-create-folder').fadeIn('500');
			jQuery('#cmd').val(jQuery(this).attr('id'));
			jQuery('#folder_name').focus();
		},
		function()
		{
			jQuery('.fm-create-folder').fadeOut('500');
		}
	);
	jQuery('#upload-btn').click(function(){
		if(jQuery('#upload').val())
		{
			jQuery('#cmd').val('upload');
			Submit();
		}else
		{
			alert('[[.You_must_select_file_before_upload.]]');
		}
	});
	jQuery('.fm-file *').click(function(){
		jQuery('#url').val('http://<?php echo $_SERVER['SERVER_NAME']; ?>/'+jQuery(this).parent().attr('path'));
	}).rightClick(function(e){
		jQuery('.fm-menu-command').css({
			'top':e.pageY,'left':e.pageX
		}).show().mouseout(function(){
			jQuery(this).hide();
		}).children().mouseover(function(){
			jQuery(this).parent().show();
		});
		jQuery('#selectedFolder').val(jQuery(this).parent().attr('rel'));
		jQuery('#type').val('file');
	}).dblclick(function(){
		FileBrowserDialogue.mySubmit();
	});
});
function Submit()
{
	jQuery('#data').submit();
}
</script>