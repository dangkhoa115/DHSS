<link rel="stylesheet" href="skins/ssnh/styles/bootstrap.min.css"/>
<link rel="stylesheet" href="skins/ssnh/styles/fmgame.css"/>
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
			email: {
				required: true,
				email: true,
				remote : 'form.php?block_id=<?php echo Module::block_id(); ?>&cmd=check_email'
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
			email: {
				required: 'Yêu cầu phải nhập',
				email: 'Bạn phải nhập email đúng định dạng',
				remote:'Email này đã được đăng ký bởi tài khoản khác'
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
<div class="row">
<div class="container register">
<div class="col-md-12"><br>
	<div class="logo"><center><a href="starteam"><img src="starteam/images/smlogo.png" alt="starteam" width="200"></a></center></div>	
	<div class="col-md-6 register-content">
	<?php if(Url::get('act')=='success'){?>
  	<div class="title"><h1>XÁC NHẬN ĐĂNG KÝ</h1></div>
    <center><br><br><img src="skins/ssnh/images/welldone.png" alt="success"></center>
    <div class="register-thanks">
      Cám ơn bạn đã đăng ký tài khoản<br><br>
    <span><strong style="color:#FF0004">Vào hòm thư</strong> của bạn để xác nhận đăng ký và <strong style="color:#FF0004">kích hoạt</strong> tài khoản !</span>
    </div>
  <?php } elseif(Url::get('act')=='actived'){?>	
   <div class="title"><h1>Tài khoản kích hoạt thành công</h1></div>
    <center>Nhấn chuột vào <a href="dhss-dang-nhap.html"><strong>đây</strong></a> để đăng nhập!</center><br>
    <center><a href="/">Về trang chủ</a>!</center>
  <?php } elseif(Url::get('act')=='not_actived'){?>	
    <div class="register-thanks">Tài khoản chưa được kích hoạt <a href="<?php echo Url::build('trang-chu','',REWRITE);?>"><?php echo Portal::get_setting('website_title');?></a></div>
  <?php } elseif(Url::get('act')=='invalid'){?>	
    <div class="register-thanks">Tài khoản không tồn tại<a href="<?php echo Url::build('trang-chu','',REWRITE);?>"><?php echo Portal::get_setting('website_title');?></a></div>
  <?php }else{?>
  	<div class="title"><h1>Đăng ký tài khoản</h1></div>
		<form method="post" enctype="multipart/form-data" name="Register" id="Register">
		<div class="register_error"><?php echo Form::$current->error_messages();?></div>
		<div class="register-infomation">
		<div id="register_infomation">
    	<div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">Email <strong>*</strong></label>	
            <input  name="email" id="email" class="form-control" maxlength="255" placeholder="Email để kích hoạt và đăng nhập" type ="text" value="<?php echo String::html_normalize(URL::get('email'));?>">
          </div>
        </div>
        <div class="col-md-6">
        	<div class="form-group">
            <label for="full_name">Họ và tên <strong>*</strong></label>
            <input  name="full_name" id="full_name" class="form-control" maxlength="100" title="Họ và tên" type ="text" value="<?php echo String::html_normalize(URL::get('full_name'));?>"> 
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
            <span>
            <label for="verify_comfirm_code">Mã bảo vệ <strong>*</strong></label></span>
            <span><img id="imgCaptcha" src="capcha.php" /></span><span><a class="refresh" href="#" onClick="jQuery('#imgCaptcha').attr('src','capcha.php');return false;">[Refresh]</a></span>
            <input  name="verify_comfirm_code" id="verify_comfirm_code" maxlength="4" class="form-control" / type ="text" value="<?php echo String::html_normalize(URL::get('verify_comfirm_code'));?>">
          </div>
        </div>
      </div>        
      <div class="form-group">
        <label for="">&nbsp;</label>
        <div class="alert alert-danger">Tôi đồng ý với <a target="_blank" href="tin-tuc/game-show/dieu-khoan-dieu-kien.html" class="term"><strong>chính sách và điều khoản</strong></a></div>
        <div class="alert alert-success"><strong>Chú ý*:</strong> <br>Sau khi đăng ký bạn phải <strong>vào hòm thư email</strong> mà bạn đã chọn để đăng ký để <strong>kích hoạt</strong> tài khoản.</div>
      </div>
		</div>
		<div class="register-buotton-wrapper">
      <center><input  name="register_button" id="register_button" value="Đăng ký" class="btn btn-danger btn-lg" type ="submit" value="<?php echo String::html_normalize(URL::get('register_button'));?>"></center>
			<br clear="all"><br>
		</div>
	</div>
  <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
	<?php }?>
	</div>
  <div class="col-md-6 center trophy">
  	<img src="skins/fmgame/images/phanthuong.png">
  </div>
</div>
</div>
</div>