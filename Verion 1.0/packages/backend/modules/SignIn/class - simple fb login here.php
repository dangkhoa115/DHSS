<?php
class SignIn extends Module
{
	function SignIn($row)
	{
		Module::Module($row);
		require_once 'db.php';
		switch (Url::get('do')){
			case 'fb_login':
				$app_id = "507319962772216";
				$app_secret = "e482bc39a84b125d238bd9dda34ec039";
				$redirect_uri = urlencode("https://sieusaongoaihang.vn/dhss-dang-nhap.html?do=fb_login");
				// Get code value
				if($code = Url::get('code')){
		
					// Get access token info
					$facebook_access_token_uri = "https://graph.facebook.com/oauth/access_token?client_id=$app_id&redirect_uri=$redirect_uri&client_secret=$app_secret&code=$code";
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $facebook_access_token_uri);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
			
					$response = curl_exec($ch);
					curl_close($ch);
					// Get access token
					$arr = explode("&", $response);
					$access_token = str_replace('access_token=', '', $arr[0]);
					//get fb user
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/me?access_token=$access_token");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
					
					$response = curl_exec($ch);
					curl_close($ch);
					
					$user = json_decode($response);
					System::Debug($user);exit();
					if($user != NULL and $user->name){
						$full_name = $user->name;
						$user_id = $user->id;
						if(!DB::exists('select id from account where id="'.$user_id.'"')){
							SignInDB::register($user_id,$full_name);
						}
						if($row=DB::fetch('select account.id,account.is_block,account.igold,account.password,account.type,account.create_date,account.last_online_time,account.is_active,party.kind,party.email,full_name from account inner join party on party.user_id=account.id where (account.id = "'.$user_id.'" OR party.email = "'.$user_id.'") and account.type="USER"')){
							$today=getdate();
							$check_date = strtotime($today['year'].'/'.$today['mon'].'/'.$today['mday']);
							Session::set('user_id',$row['id']);
							if($nguoichoi = DB::fetch('select id from ssnh_nguoi_choi where account_id="'.$row['id'].'"')){
								$row['nguoi_choi_id'] = $nguoichoi['id'];
							}
							Session::set('user_data',$row);
							if(isset($_SESSION['clb_tmp'])){
								unset($_SESSION['clb_tmp']);
							}
							DB::query('update account set last_online_time='.time().' where id="'.Session::get('user_id').'"');
							echo '<script>window.location="/dhss";</script>';
						}
					}
				}else{
					die('Lỗi đăng nhập FB. Vui lòng thử lại');
				}
			break;
			default:
				require_once 'forms/sign_in.php';
				$this->add_form(new SignInForm);
			break;
		}
	}
}
?>