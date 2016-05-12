<?php
class SignInForm extends Form{
	function SignInForm(){
		Form::Form('SignInForm');
		$this->link_js('packages/core/includes/js/jquery/jquery.cookie.js');
		$this->add('user_id',new TextType(true,'invalid_user_id',3,255));
		$this->add('password',new PasswordType(false,'invalid_password'));
		if(Url::get('user_id') and Url::get('password')){
			$this->sign_in();
		}
		$this->link_js('skins/ssnh/scripts/jquery-1.7.1.min.js');
		$this->link_css('skins/ssnh/styles/style.css');
		$this->link_css('skins/ssnh/styles/hover.css');
	}
	function on_submit(){
		if ($this->check() and !User::is_login()){
			$this->sign_in();
		}
	}
	function sign_in(){
		$user = trim(Url::sget('user_id'));
		if(strpos($user,'0',0) === 0){
			$user = (84).substr($user,-(strlen($user) - 1),strlen($user) - 1);
		}
		$password = trim(Url::sget('password'));
		$is_login = false;
		if(!$row=DB::fetch('select account.id,account.is_block,account.igold,account.password,account.type,account.create_date,account.last_online_time,account.is_active,party.kind,party.email,full_name from account inner join party on party.user_id=account.id where (account.id = "'.$user.'" OR party.email = "'.$user.'") and account.type="USER" and password="'.User::encode_password($password).'"')){
			$this->error('user_id','invalid_username_or_password');
		}else{
			if($row['is_block']==1){
				echo '<script>alert("Tài khoản của bạn đã bị Khóa. Vui lòng liên hệ BTC để được hỗ trợ");window.location="dang-nhap.html";</script>';
				exit();
			}
			if(!$row['is_active']){
				$this->error('user_not_actived','user_not_actived');
			}else{
				$is_login = true;
			}
		}
		if($is_login){
			$today=getdate();
			$check_date = strtotime($today['year'].'/'.$today['mon'].'/'.$today['mday']);
			Session::set('user_id',$row['id']);
			if($nguoichoi = DB::fetch('select id from ssnh_nguoi_choi where account_id="'.$row['id'].'"')){
				$row['nguoi_choi_id'] = $nguoichoi['id'];
			}
			Session::set('user_data',$row);
			if(Url::get('save_password')){
				setcookie('forgot_user',$row['id'].'_'.Url::get('password'));
			}
			if(isset($_SESSION['clb_tmp'])){
				unset($_SESSION['clb_tmp']);
			}
			require_once 'packages/fmgame/includes/php/fmgame.php';
			if(!$row['last_online_time'] or $row['last_online_time'] < strtotime(date('Y-m-d'))){
				require_once 'packages/backend/includes/php/igold.php';
				require_once 'packages/backend/includes/php/message.php';
				$igold = 2;
				$content = 'Starteam: tặng '.$igold.' igold điểm danh trong ngày';
				if(FMGAME::get_diem_kn(Session::get('user_id'))>=1000){// chi duoc diem danh voi HLV hang chuyen nghiep
					iGold::receive_igold(Session::get('user_id'),$igold,$content);
					Message::send_message('administrator',Session::get('user_id'),$content);
				}
			}
			DB::query('update account set last_online_time='.time().' where id="'.Session::get('user_id').'"');
			if(Url::get('href')){
				echo '<script>window.location="'.Url::sget('href').'";</script>';
			}else{
				if(Url::get('dhss-dang-nhap')){
					echo '<script>window.location="dhss";</script>';
				}else{
					if($row['kind'] == 2){
						echo '<script>window.location="dhss";</script>';
					}else{
						echo '<script>window.location="";</script>';
					}
				}
			}
		}
	}
	function draw(){
		if(User::is_login()){
			$this->map = $_SESSION['user_data'];//User::$current->data;
			$layout = 'account_info';
			if(Url::get('page')=='dhss-dang-nhap'){
				echo '<script>window.location="/dhss";</script>';
			}
		}else{
			$this->map = array();
			if(Url::get('page')=='dhss-dang-nhap'){
				$layout = 'dhss_sign_in';
			}else{	
				$layout = 'sign_in';
			}
		}
		$this->parse_layout($layout,$this->map);
	}
}
?>