<div class="page-container">
<div style="text-align: center;margin-bottom: 30px;"><a href=""><img src="skins/signin/img/logo.png"/></a></div>
<div class="sign-in-wrapper">
	<div class="body">
		<div class="sign-in-error"><?php echo Form::error_messages();?></div>
		<div class="sign-in-content">
			<ul>
            <h2><?php echo Portal::language('welcome');?> : <?php echo Session::get('user_id')?></a></h2>
            <?php 
				if(($this->map['kind']==2))
				{?>
            <li class="link"><a target="_blank" href="tong-hop.html">Tổng hợp thông tin người chơi</a></li>
             <?php }else{ ?>
            <li class="link"><a target="_blank" href="?page=quan_ly_ket_qua_thi_dau">Trang quản trị</a></li>
            
				<?php
				}
				?>
            <a class="sign-in-link" href="<?php echo URL::build('sign_out');?>&href=?<?php echo urlencode($_SERVER['QUERY_STRING'])?>"><?php echo Portal::language('logout');?></a>
			</ul>
		</div>
	</div>
</div>
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
