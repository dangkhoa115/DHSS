<script type="text/javascript" src="packages/core/includes/js/jquery/jquery.validate.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#email').focus();
	jQuery('#Register').validate({
		rules: {
			register_password:{
				required: true,
				minlength: 6
			},
			retype_password:{
				required: true,
				equalTo: "#register_password"
			},
			full_name:{
				required: true
			},
			identity_card: {
				required: true
			},
			zone_id: {
				required: true
			},
			email: {
				required: true,
				email: true,
				remote : 'form.php?block_id=<?php echo Module::block_id(); ?>&cmd=check_email'
			},
			phone: {
				required: true
			},
			verify_comfirm_code: {
				required: true,
				minlength: 4,
				remote : 'form.php?block_id=<?php echo Module::block_id(); ?>&cmd=check_code'
			}
		},
		messages: {
			register_password:{
				required: 'Yêu cầu phải nhập',
				minlength: 'Phải nhập tối thiểu 6 ký tự'
			},
			retype_password:{
				required: 'Yêu cầu phải nhập',
				equalTo: 'Phải nhập trùng với mật khẩu bạn đã nhập ở trên'
			},
			full_name:{
				required: 'Yêu cầu phải nhập'
			},
			identity_card: {
				required: 'Yêu cầu phải nhập'
			},
			zone_id: {
				required: 'Yêu cầu phải nhập'
			},
			email: {
				required: 'Yêu cầu phải nhập',
				email: 'Bạn phải nhập email đúng định dạng',
				remote:'Email này đã được đăng ký bởi tài khoản khác'
			},
			phone: {
				required: 'Yêu cầu phải nhập'
			},
			verify_comfirm_code: {
				required: 'Yêu cầu phải nhập',
				minlength: 'Bạn phải nhập ít nhất 4 ký tự',
				remote:'Mã xác nhận không hợp lệ'
			}
		}
	});
});
</script>
<div class="row register-wrapper">
<div class="col-md-12">
<div class="row">
<?php if(Url::get('act')=='success'){?>
	<center><br><br><img src="skins/ssnh/images/welldone.png" alt="success"></center>
	<div class="register-thanks">
  <br><div class="register-thanks">Cám ơn bạn đã đăng ký tài khoản</div><br><br>
	<span><strong style="color:#FF0004">Vào hòm thư</strong> của bạn để xác nhận đăng ký và <strong style="color:#FF0004">kích hoạt</strong> tài khoản !</span>
	</div>
<?php } elseif(Url::get('act')=='actived'){?>	
	<div class="title"><h2>Tài khoản đã được kích hoạt thành công</h2>
	<div>Nhấn chuột vào <a href="dang-nhap.html"><strong>đây</strong></a> để đăng nhập!</div><br>
	<div><a href="/">Về trang chủ</a>!</div>
	</div>
<?php } elseif(Url::get('act')=='not_actived'){?>	
	<div class="register-thanks">Tài khoản chưa được kích hoạt <a href="<?php echo Url::build('trang-chu','',REWRITE);?>"><?php echo Portal::get_setting('website_title');?></a></div>
<?php } elseif(Url::get('act')=='invalid'){?>	
	<div class="register-thanks">Tài khoản không tồn tại<a href="<?php echo Url::build('trang-chu','',REWRITE);?>"><?php echo Portal::get_setting('website_title');?></a></div>
<?php }else{?>
	<div class="title"><h1>Đăng ký tài khoản</h1></div>
	<div class="col-md-9 register-content">
		<form method="post" enctype="multipart/form-data" name="Register" id="Register">
		<div class="register_error"><?php echo Form::$current->error_messages();?></div>
		<div class="register-infomation">
		<div id="register_infomation">
    	<div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">Email <strong>*</strong></label>	
            <input  name="email" id="email" class="form-control" maxlength="255" placeholder="Email dùng để đăng nhập và kích hoạt tài khoản" type ="text" value="<?php echo String::html_normalize(URL::get('email'));?>">
          </div>
        </div>
        <div class="col-md-6">
        	<div class="form-group">
            <label for="full_name">Họ và tên <strong>*</strong></label>
            <input  name="full_name" id="full_name" class="form-control" maxlength="100" type ="text" value="<?php echo String::html_normalize(URL::get('full_name'));?>"> 
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="register_password">Mật khẩu <strong>*</strong></label>
            <input  name="register_password" id="register_password" class="form-control" maxlength="50" autocomplete="off" / type ="password" value="<?php echo String::html_normalize(URL::get('register_password'));?>">
          </div>
         </div>
         <div class="col-md-6">
          <div class="form-group">
            <label for="retype_password">Nhập lại mật khẩu <strong>*</strong></label>
            <input  name="retype_password" id="retype_password" class="form-control" maxlength="50" autocomplete="off" / type ="password" value="<?php echo String::html_normalize(URL::get('retype_password'));?>">
          </div>
        </div>
       </div>	
       <div class="row">
        <div class="col-md-6">
          <div class="form-group">
              <label for="gender">Giới tính</label>
          <span><select  name="gender" id="gender" class="form-control"><?php
					if(isset($this->map['gender_list']))
					{
						foreach($this->map['gender_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('gender').value = "<?php echo addslashes(URL::get('gender',isset($this->map['gender'])?$this->map['gender']:''));?>";</script>
	</select></span>
              
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
          <label for="identity_card">Số CMTND hoặc Hộ chiếu <strong>*</strong></label>
          <span><input  name="identity_card" id="identity_card" class="form-control" maxlength="50" placeholder="Bạn phải nhập chính xác số CMT của bạn!" autocomplete="off" / type ="text" value="<?php echo String::html_normalize(URL::get('identity_card'));?>"></span>
          
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
              <label for="phone">Điện thoại <strong>*</strong></label>
            <span><input  name="phone" id="phone" class="form-control" maxlength="255" / type ="text" value="<?php echo String::html_normalize(URL::get('phone'));?>"></span>
              
          </div>
        </div>
        <div class="col-md-6">
           <div class="form-group">
              <label for="gender">Tỉnh / thành phố</label>
              <span><select  name="zone_id" id="zone_id" class="form-control"><?php
					if(isset($this->map['zone_id_list']))
					{
						foreach($this->map['zone_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('zone_id').value = "<?php echo addslashes(URL::get('zone_id',isset($this->map['zone_id'])?$this->map['zone_id']:''));?>";</script>
	</select></span>
              
          </div>
       </div>
     </div>
       <div class="form-group hide">
          <label for="gender">CLB yêu thích</label>
          <span><select  name="clb_id" id="clb_id" class="form-control"><?php
					if(isset($this->map['clb_id_list']))
					{
						foreach($this->map['clb_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('clb_id').value = "<?php echo addslashes(URL::get('clb_id',isset($this->map['clb_id'])?$this->map['clb_id']:''));?>";</script>
	</select></span>
          
      </div>            
			<div class="form-group">
				<span>
				<label for="verify_comfirm_code">Mã bảo vệ <strong>*</strong></label></span>
				<span><img id="imgCaptcha" src="capcha.php" /></span><span><a class="refresh" href="#" onClick="jQuery('#imgCaptcha').attr('src','capcha.php');return false;">[Refresh]</a></span>
				<input  name="verify_comfirm_code" id="verify_comfirm_code" maxlength="4" class="form-control" / type ="text" value="<?php echo String::html_normalize(URL::get('verify_comfirm_code'));?>">
				
			</div>
      <div class="form-group">
        <label for="">&nbsp;</label>
        <div class="alert alert-danger">Tôi đồng ý với <a target="_blank" href="tin-tuc/game-show/dieu-khoan-dieu-kien.html" class="term"><strong>chính sách và điều khoản</strong></a></div>
        <div class="alert alert-success"><strong>Chú ý*:</strong> <br>Sau khi đăng ký bạn phải <strong>vào hòm thư email</strong> mà bạn đã chọn để đăng ký để <strong>kích hoạt</strong> tài khoản.</div>
      </div>
		</div>
		<div class="register-buotton-wrapper">
      <center><input  name="register_button" id="register_button" value="Đăng ký" class="btn btn-primary btn-lg" type ="submit" value="<?php echo String::html_normalize(URL::get('register_button'));?>"></center>
			<br clear="all"><br>
		</div>
	</div>
  <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
</div>
<div class="intro col-md-3">
	<div class="title">Lợi ích khi đăng ký tài khoản</div>
	<div class="content">
    	<p> + Bạn có thể tham gia trò chơi trực tiếp trên Website của chương trình</p>
      <!-- <p>Bạn sẽ được thưởng <a href="nap_igold.html"> 70 <img src="skins/ssnh/images/igold_16_text.png" height="16" alt=""/></a></p>-->
      <p> + Viết bài để nhận được <a href="nap_igold.html" class="igold">20 iGold</a> / bài viết (<strong>Một lần bình chọn</strong> chỉ mất <strong>3</strong> iGold)</p>
    </div>
</div>
<?php }?>
</div>
</div>
</div>