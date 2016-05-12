<script type="text/javascript" src="packages/core/includes/js/jquery/jquery.validate.js"></script>
<script type="text/javascript">
jQuery(function(){
	for(i=1;i<=10;i++){
		jQuery('#item_image_url'+i).change(function(){
			readURL(this,'#preview_image_'+i);
		});
	}
	$rules = {
		category_id: {
			required: true
		},
		title: {
			required: true,
			minlength: 3,
			maxlength: 225
		},
		content: {
			required: true,
			minlength: 3,
			maxlength: 20000
		}
	};
	$messages = {	
		category_id: {
			required: '<br>Yêu cầu nhập'
		},
		title: {
			required: '<br>Yêu cầu nhập',
			minlength: '<br>Phải nhập tối thiểu 3 ký tự',
			maxlength: 'Bạn chỉ được nhập tiêu đề tối đa 225 ký tự'
		},
		content: {
			required: '<br>Yêu cầu nhập',
			minlength: '<br>Phải nhập tối thiểu 3 ký tự',
			maxlength: 'Bạn chỉ được nhập tiêu đề tối đa 20000 ký tự'
		}
	};
	<?php 
				if((Url::get('do')!='edit'))
				{?>
	$rules.image_url = {required: true};
	$messages.image_url = {required: 'Vui lòng nhập ảnh đại diện'};
	
				<?php
				}
				?>
	jQuery('#SsnhDangTinForm').validate({
		success: function(label) {
			label.html("").addClass("success");
		},
		rules: $rules,//	remote : 'form.php?block_id=<?php //echo Module::block_id(); ?>&cmd=check_ajax'
		messages: $messages
	});
});
function readURL(input,target) {
		if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
						jQuery(target).attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
		}
}
</script>
<div class="row post">
	<div class="col-md-12" id="post_items_body">
  	<div class="title-all"><h1>Đăng tin bài</h1><a href="#" class="huong-dan"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Hướng dẫn đăng bài viết</a></div>
    <div class="note">(*) Bài viết thể hiện quan điểm cá nhân của bạn về lĩnh vực bóng đá. Không sử dụng các từ thiếu thuần phong mỹ tục của Việt Nam. Khi bài của bạn đăng được kiểm duyệt thành công, bạn sẽ nhận được phần thưởng iGold:<br>
		+ <strong>20</strong> <a href="#"><strong>iGold</strong></a> cho hạng Beginer (Đăng dưới 100 bài)<br />
    + <strong>30</strong> <a href="#"><strong>iGold</strong></a> cho hạng Advanced (Đăng 100 đến 500 bài)<br />
    + <strong>50</strong> <a href="#"><strong>iGold</strong></a> cho hạng Pro (Đăng trên 500 bài)
    </div>
		<div style="text-align:left;"><?php if(Form::$current->is_error()) echo Form::$current->error_messages();?></div>
		<form name="SsnhDangTinForm" method="post" id="SsnhDangTinForm" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>" enctype="multipart/form-data">	
    <div class="body">
    	<div class="form-group">
      	<label for="title">Tiêu đề tin bài</label>
        <input  name="title" id="title" class="form-control title" / type ="text" value="<?php echo String::html_normalize(URL::get('title'));?>">
      </div>
      <div class="form-group">
        <label for="category_id">Danh mục tin</label>
        <select  name="category_id" id="category_id" class="form-control"><?php
					if(isset($this->map['category_id_list']))
					{
						foreach($this->map['category_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('category_id').value = "<?php echo addslashes(URL::get('category_id',isset($this->map['category_id'])?$this->map['category_id']:''));?>";</script>
	</select>
        <div class="alert alert-warning">
        	Chú ý: <br>
          + Bạn thể hiện cảm nhận cá nhân thì vui lòng chọn mục Cảm nhận. Trường hợp này bạn sẽ không nhận được iGold và chúng tôi sẽ hiển bị của bạn dễ dàng hơn.<br>
          + Bài viết thể hiện quan điểm cá nhân nhưng cần có phân tích nhận định về một vấn đề cụ thể thì cần phải có ảnh minh họa trong bài viết. Các bạn vui lòng chờ BTC xét duyệt để được nhận iGold.
        </div>
      </div>
      <div class="form-group">
      	<a name="content"></a>
      	<label for="content">Nội dung tin bài</label>
        <div><textarea  name="content" id="content"  class="textfield" rows="40" style="height:400px;width:100%;"><?php echo String::html_normalize(URL::get('content',''));?></textarea>
          <script>simple_mce('content');</script>
        </div>
       <!-- M&atilde; b&#7843;o v&#7879;
        <div><input  name="verify_confirm_code" id="verify_confirm_code"  style="width:50px;height:20px;" maxlength="4" / type ="text" value="<?php echo String::html_normalize(URL::get('verify_confirm_code'));?>"> <img id="imgCaptcha" src="capcha.php" align="top" height="19" /></div> -->
        <span id="next_post_button_bound"></span>
      </div>
      <div class="alert alert-danger"><strong>Chú ý*:</strong><br>
			+ Tin bài cần có hình ảnh trong bài làm minh họa để tăng khả năng được duyệt.<br>
			+ Mọi hành vi <strong>sao chép</strong> nội dung từ website khác chúng tôi sẽ xóa mà không cần thông báo.</div>
      <div class="form-group img-container">
      	<div class="row">
          <div class="col-md-4" id="image_url_bound">
            <img id="preview_image" src="#" alt="Preview Image" onerror="this.src='skins/default/images/no_image.jpg'">
            <div>
              Ảnh đại diện (Tối đa 2Mb)<br /><input  name="image_url" type="file" id="image_url" style="border:0px;" onchange="readURL(this,'#preview_image');" value="" accept="image/x-png, image/gif, image/jpeg" />
            </div>
          </div>
          <div class="col-md-8">
            <div class="note">Chú ý: không dùng ảnh GIF và ảnh BMP - Đề xuất kích thước ảnh chiều rộng 500px</div>
            <ul class="item-image-bound">
              <?php for($i=1;$i<=10;$i++){?>
              <li><a href="#" onClick="insertImage('preview_image_<?php echo $i;?>');return false;" class="insert-image" title="Nhấn vào đây để chèn ảnh vào bài viết"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span></a>Ảnh số <?php echo $i;?><input  type="file" name="item_image_url<?php echo $i;?>" id="item_image_url<?php echo $i;?>" onChange="readURL(this,'#preview_image_<?php echo $i;?>');" accept="image/x-png, image/gif, image/jpeg" /><img id="preview_image_<?php echo $i;?>" src="#" alt="Ảnh <?php echo $i;?>" onerror="this.src='skins/default/images/no_image.png'" width="100%"></li>
              <?php }?>
            </ul>
          </div>
         </div>
      </div>
      <div class="post-button-bound">
        <span id="post_button_bound"><input  name="post" value="Đăng tin" id="post" class="btn btn-primary" / type ="submit" value="<?php echo String::html_normalize(URL::get('post'));?>"></span>
      </div>
    </div>
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
	</div>
</div>
<script>
jQuery(document).ready(function() {
	jQuery('#preview_image').attr('src','<?php echo Url::get('small_thumb_url');?>');
  <?php 
				if((Url::get('do')=='edit'))
				{?>
	<?php for($i=1;$i<=sizeof($this->map['images']);$i++){?>
		<?php if($this->map['images'][$i]['image_url']){?>
			jQuery('#preview_image_<?php echo $i?>').attr('src','<?php echo $this->map['images'][$i]['image_url'];?>');
		<?php }?>
	<?php }?>
	
				<?php
				}
				?>
});
function insertImage(img){
	var image = jQuery('#'+img);
	if(image.attr('src') == 'skins/default/images/no_image.png'){
		alert(image.attr('alt') + ' chưa có file ảnh');
		return false;
	}else{
		var ed = tinyMCE.get('content');                // get editor instance
		ed.focus();
		var range = ed.selection.getRng(true);                  // get range
		var newNode = ed.getDoc().createElement ( "p" );  // create img node
		newNode.innerHTML = '['+image.attr('alt')+']';                         // add src attribute
		range.insertNode(newNode);
		jQuery('html, body').animate({
				scrollTop: jQuery( 'a[name=content]' ).offset().top - 30
		}, 500); 
	}
}
</script>