<script type="text/javascript">
jQuery(function(){
	jQuery('#full_name').focus();
	jQuery('#reset').click(function(){
		jQuery('#full_name').focus();
	});
});
</script>
<div class="contact-us">
  <div class="title"><h3><img alt="Barclays Premier League" src="skins/ssnh/images/sb_lt_logo.png" class="barclay-icon">Liên hệ với chúng tôi</h3></div>
   <!--contact-->
   <div class="contact">
        <!--<div class="map"></div> -->
        <div class="add">
            <div class="info clearfix">
            <p class="address"><strong>Địa chỉ:</strong> <?php echo Portal::get_setting('company_adress');?></p>
            </div>
            <div class="info clearfix">
              <p class="email"><strong>Email:</strong> <?php echo Portal::get_setting('email_support_online');?></p>
            </div>
            <div class="info clearfix">
              <p class="tele-phone"><strong>Cố định: </strong><?php echo Portal::get_setting('company_phone');?></p>
            </div>
        </div>
     <div class="clear-both"></div>
   </div>
   <!--end contact-->
   <!--form-->
   <div class="chat">
      <div class="contact_form">
        <h3>GỬI THÔNG TIN LIÊN HỆ</h3>
        <span>* là mục bắt buộc phải điền</span><br /><br />
        <?php if(Form::$current->is_error()) echo Form::$current->error_messages();?>
        <form name="SendContactUsForm" method="post" id="SendContactUsForm" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">	
        <div class="self_info col-md-6">
        	<div class="form-group">
              <p>
                <label for="ten">Họ tên đệm*:</label>
                <input  name="first_name" id="first_name" class="form-control" required data-error="Lỗi nhập họ và tên đệm" / type ="text" value="<?php echo String::html_normalize(URL::get('first_name'));?>">
              </p>
              <p>
                <label for="ten">Tên*:</label>
                <input  name="last_name" id="last_name" class="form-control" required data-error="Lỗi nhập tên" / type ="text" value="<?php echo String::html_normalize(URL::get('last_name'));?>">
              </p>
              <p>
                <label for="email">Địa chỉ email:</label>
                <input  name="email" id="email" class="form-control" required data-error="Lỗi nhập email" / type ="text" value="<?php echo String::html_normalize(URL::get('email'));?>">
              </p>
              <p>
                <label for="phone">Số điện thoại:</label>
                <input  name="phone" id="phone" class="form-control" required data-error="Lỗi nhập điện thoại"/ type ="text" value="<?php echo String::html_normalize(URL::get('phone'));?>">
              </p>
              <!-- <p>
                <label for="verify_confirm_code">Nhập mã bảo vệ*</label>
                <input  name="verify_confirm_code" id="verify_confirm_code" maxlength="4"/ type ="text" value="<?php echo String::html_normalize(URL::get('verify_confirm_code'));?>">
                <img id="imgCaptcha" src="capcha.php" />
              </p> -->
            </div>
        </div>
        <div class="full_text col-md-6">
          <label for="content">Nội dung*</label>
          <textarea  name="content" id="content" class="form-control"><?php echo String::html_normalize(URL::get('content',''));?></textarea>
          <input type="submit" name="send" id="send" value="Gửi liên hệ" />
        </div>
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
    </div>
    <br clear="all">
   <!--end form-->
  </div>
</div><!--Enf .contact-us-->