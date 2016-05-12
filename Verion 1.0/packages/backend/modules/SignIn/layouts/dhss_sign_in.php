<div class="page-container dhss-sign-in">
    <div style="text-align: center;margin-bottom: 30px;"><a href="starteam" class="hvr-pulse"><img src="starteam/images/logo.png"/></a></div>
    <div class="row">
    	<div class="col-md-4"></div>
    	<div class="body col-md-4">
      	<a href="https://www.facebook.com/dialog/oauth?client_id=507319962772216&redirect_uri=http://doihinhsieusao.com/dhss-dang-nhap.html?do=fb_login"><img src="skins/ssnh/images/fm_game/login-with-facebook.png" width="411" alt="Đăng nhập bằng Facebook"/></a>
        <div class="error"><?php echo Form::$current->error_messages();?></div>
        <form name="SignInForm" id="SignInForm" method="post">
            <input name="user_id" type="text" id="user_id" tabindex="1" value="<?php if(isset($_COOKIE['forgot_user'])){echo substr($_COOKIE['forgot_user'],0,strpos($_COOKIE['forgot_user'],'_'));}?>" class="username" placeholder="Tài khoản hoặc email" required autofocus/>
            <input name="password" type="password" id="password" tabindex="2" value="<?php if(isset($_COOKIE['forgot_user'])){echo substr($_COOKIE['forgot_user'],strpos($_COOKIE['forgot_user'],'_')+1);}?>" class="password" placeholder="Mật khẩu" required />
            <div class="manipulation">
                <div class="col-l">
                    <input name="save_password" type="checkbox" id="save_password" value="1" /> <span class="remember-pass">Ghi nhớ tài khoản</span>
                </div>
                <div class="col-r">
                
                </div>
            </div>
            <button type="submit" class="hvr-buzz-out">Đăng nhập</button>
            <div class="error"><span>+</span></div>
        </form>
        <div class="connect">
            <p class="b1"><a href="quen-mat-khau-dhss.html">Khôi phục mật khẩu</a></p>
            <p class="b2"><a class="register" onClick="window.location='dang-ky-dhss.html'">Đăng ký tài khoản</a></p>
        </div>
      </div>
      <div class="col-md-4"></div>
    </div>
<!-- CSS -->
<link rel="stylesheet" href="skins/signin/css/style.css"/>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Javascript -->
<script type="text/javascript">
jQuery(function(){
	jQuery('#user_id').focus();
});
</script>