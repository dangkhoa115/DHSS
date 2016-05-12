<script type="text/javascript" src="packages/core/includes/js/jquery/jquery.validate.js"></script>
<script type="text/javascript">
jQuery(function(){
	jQuery('#expired_date').datepicker({
			minDate: new Date(), 
			maxDate: '12m',
			dateFormat:'dd/mm/yy'
	});
	jQuery('#PostItemsForm').validate({
		success: function(label) {
			label.html("").addClass("success");
		},
		rules: {
			category_id: {
				required: true
			},
			name: {
				required: true,
				minlength: 3,
				maxlength: 1000
			},
			price: {
				required: true
			},
			verify_confirm_code: {
				required: true,
				minlength: 4
			
			}
		},//	remote : 'form.php?block_id=<?php //echo Module::block_id(); ?>&cmd=check_ajax'
		messages: {	
			category_id: {
				required: '<br>Yêu cầu nhập'
			},
			name: {
				required: '<br>Yêu cầu nhập',
				minlength: '<br>Phải nhập tối thiểu 3 ký tự',
				maxlength: '<?php echo Portal::language('please_enter_at_smaller_or_with_1000_characters');?>'
			},
			price: {
				required: '<br>Yêu cầu nhập'
			}
		}
	});
	jQuery('#discount').change(function(){
		updatePrice();	
	});
	jQuery('#public_price').change(function(){
		jQuery('#public_price').val(numberFormat(jQuery('#public_price').val()));
		updatePrice();	
	});
	jQuery('#price').change(function(){
		jQuery('#price').val(numberFormat(jQuery('#price').val()));
	});
});
function updatePrice(){
	var publicPrice = to_numeric(jQuery('#public_price').val());
	var discountPercent = to_numeric(jQuery('#discount').val());	
	var price = publicPrice - roundNumber(publicPrice*(discountPercent/100),2);
	price = numberFormat(price);
	jQuery('#price').val(price);
}
/*
,
			verify_confirm_code: {
				required: '<?php echo Portal::language('verity_confirm_code_is_required');?>',
				minlength: '<?php echo Portal::language('verity_confirm_code_is_smaller_4');?>'
			}//remote: '<br><?php echo Portal::language('verify_confirm_code_is_invalid');?>'
*/
</script>
<div class="catalogue">
<div class="show post">
	<div class="post-items-message"></div>
	<div style="padding:5px;" id="post_items_body">
		<div style="text-align:left;"><?php if(Form::$current->is_error()) echo Form::$current->error_messages();?></div>
		<form name="PostItemsForm" method="post" id="PostItemsForm" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>" enctype="multipart/form-data" onsubmit="check();">	
	    <h3><span><img src="skins/trieumua/images/title_06.png" /></span>Đăng bán sản phẩm<span><img src="skins/trieumua/images/title_06.png" /></span></h3>
		<div class="note"><div><strong>Ch&uacute; &yacute;:</strong> <br />B&#7841;n ph&#7843;i g&#7917;i ti&#7871;ng Vi&#7879;t c&oacute; d&#7845;u. <br /></div>
		</div>
    <div class="content-bound">
      <div class="left">
        Phân loại
        <div><select  name="category_id" id="category_id" class="textfield"><?php
					if(isset($this->map['category_id_list']))
					{
						foreach($this->map['category_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('category_id').value = "<?php echo addslashes(URL::get('category_id',isset($this->map['category_id'])?$this->map['category_id']:''));?>";</script>
	</select></div>
        <div class="post-info" id="image_url_bound"><div>
          Ảnh minh họa (Tối đa 2Mb)<br /><input  name="image_url" type="file" id="image_url" style="border:0px;" onchange="jQuery('#preview_image_url').attr('src',this.value)" value="" />
        </div></div><br clear="all" />
        Tên sản phẩm
        <div><input  name="name" id="name" class="textfield" / type ="text" value="<?php echo String::html_normalize(URL::get('name'));?>"></div>
        Giá gốc ( VND)
        <div><input  name="public_price" id="public_price" class="textfield" style="width:90px;" / type ="text" value="<?php echo String::html_normalize(URL::get('public_price'));?>"> Giảm giá <input  name="discount" id="discount" class="textfield" style="width:30px;" / type ="text" value="<?php echo String::html_normalize(URL::get('discount'));?>"> %</div>
        Giá bán ( VND)
        <div><input  name="price" id="price" class="textfield" / type ="text" value="<?php echo String::html_normalize(URL::get('price'));?>"></div>
        Ngày hết hạn (Dành cho sản phẩm khuyến mại)
        <div><input  name="expired_date" id="expired_date" class="textfield" / type ="text" value="<?php echo String::html_normalize(URL::get('expired_date'));?>"></div>
      </div>
      <div class="right">
        <div class="note">Chú ý: không dùng ảnh GIF và ảnh BMP</div>
      	<ul class="item-image-bound">
          <li>Ảnh số 01<input type="file" name="item_image_url1" id="item_image_url1" /></li>
          <li>Ảnh số 02<input type="file" name="item_image_url2" id="item_image_url2" /></li>
          <li>Ảnh số 03<input type="file" name="item_image_url3" id="item_image_url3" /></li>
          <li>Ảnh số 04<input type="file" name="item_image_url4" id="item_image_url4" /></li>
          <li>Ảnh số 05<input type="file" name="item_image_url5" id="item_image_url5" /></li>
          <li>Ảnh số 06<input type="file" name="item_image_url6" id="item_image_url6" /></li>
          <li>Ảnh số 07<input type="file" name="item_image_url7" id="item_image_url7" /></li>
          <li>Ảnh số 08<input type="file" name="item_image_url8" id="item_image_url8" /></li>
          <li>Ảnh số 09<input type="file" name="item_image_url8" id="item_image_url9" /></li>
        </ul>
      </div><br clear="all" />
      <div class="post-info">
      	Giới thiệu sản phẩm
        <div><textarea  name="content" id="content"  class="textfield" rows="40" style="height:400px;width:99%;"><?php echo String::html_normalize(URL::get('content',''));?></textarea>
          <script>advance_mce('content');</script>
        </div>
       <!-- M&atilde; b&#7843;o v&#7879;
        <div><input  name="verify_confirm_code" id="verify_confirm_code"  style="width:50px;height:20px;" maxlength="4" / type ="text" value="<?php echo String::html_normalize(URL::get('verify_confirm_code'));?>"> <img id="imgCaptcha" src="capcha.php" align="top" height="19" /></div> -->
        <span id="next_post_button_bound"></span>
      </div>
      <div class="post-button-bound">
        <span id="post_button_bound"><input  name="post" value="Đăng tin" id="post" class="button" / type ="submit" value="<?php echo String::html_normalize(URL::get('post'));?>"></span>
      </div>
    </div>
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
	</div>
</div>
</div>
<script>
//jQuery('.hidden').hide();
<?php 
				if((Url::get('content')))
				{?>
jQuery('.hidden').show();
//$('next_post_button_bound').innerHTML = $('post_button_bound').innerHTML;$('post_button_bound').innerHTML = '';

				<?php
				}
				?>
function check(){
	if(!jQuery('#image_url').attr('value')){
		alert('Bạn phải nhập ảnh');
		return false;
	}
}
</script>