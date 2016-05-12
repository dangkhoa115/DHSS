<div class="page-container">
    <div style="text-align: center;margin-bottom: 30px;"><a href=""><img src="skins/signin/img/logo.png"/></a></div>
    <h1>Đăng nhập</h1>
    <div class="error"><?php echo Form::$current->error_messages();?></div>
    <form name="SignInForm" id="SignInForm" method="post">
        <input name="user_id" type="text" id="user_id" tabindex="1" value="<?php if(isset($_COOKIE['forgot_user'])){echo substr($_COOKIE['forgot_user'],0,strpos($_COOKIE['forgot_user'],'_'));}?>" class="username" placeholder="Tên đăng nhập hoặc email" required autofocus/>
        <input name="password" type="password" id="password" tabindex="2" value="<?php if(isset($_COOKIE['forgot_user'])){echo substr($_COOKIE['forgot_user'],strpos($_COOKIE['forgot_user'],'_')+1);}?>" class="password" placeholder="Mật khẩu" required />
        <div class="manipulation">
            <div class="col-l">
                <input name="save_password" type="checkbox" id="save_password" value="1" /> <span>Ghi nhớ tài khoản</span>
            </div>
            <div class="col-r">
            
            </div>
        </div>
        <button type="submit">Đăng nhập</button>
        <div class="error"><span>+</span></div>
    </form>
    <div class="connect">
        <p class="b1">Bạn quên mật khẩu: <a class="btn btn-default" href="quen-mat-khau.html">Khôi phục</a></p>
        <!--<p class="b2">Soạn tin nhắn với cú pháp:</p>
        <p class="b3">EPL PASS gửi 6002 <em>(Cước phí 1000vnđ)</em></p>-->
    </div>

<!-- CSS -->
<link rel="stylesheet" href="skins/signin/css/reset.css"/>
<link rel="stylesheet" href="skins/signin/css/supersized.css"/>
<link rel="stylesheet" href="skins/signin/css/style.css"/>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Javascript -->
<script src="skins/signin/js/jquery-1.8.2.min.js"></script>
<script src="skins/signin/js/supersized.3.2.7.min.js"></script>
<script src="skins/signin/js/supersized-init.js"></script>
<script src="skins/signin/js/scripts.js"></script>
<script type="text/javascript">
jQuery(function(){
	jQuery('#user_id').focus();
});
</script>