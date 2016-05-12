<?php
class SignInDB{
	static function register($user_id,$full_name,$email=false,$phone=false,$gender=false){
		$password = '';
		if (!DB::exists('select * from `party` where `user_id`="'.$user_id.'"') and !DB::exists('select * from `account` where `id`="'.$user_id.'"')){
			$arr=array(	
				'user_id'=>$user_id,
				'full_name'=>$full_name,
				'phone'=>$phone,
				'gender'=>$gender,
				'email'=>$email,
				'type'=>'USER',
				'time'=>time(),
				'status'=>'SHOW',
				'portal_id'=>PORTAL_ID,
				'zone_id',
				'kind'=>2// nguoi choi
			);
			DB::insert('party',$arr);
			$account=array(
				'id'=>$user_id,
				'last_online_time'=>time(),
				'password'=>User::encode_password($password),
				'create_date'=>Date_Time::to_sql_date(date('d/m/Y',time())),
				'is_active'=>1,
				'type'=>'USER',
				'igold'=>0,
				'from_web'=>1,
				'openid'=>$user_id
			);
			DB::insert('account',$account);
			//////////////////////////////////////////////
			$nguoi_choi_arr = array(
				'ten'=>$full_name,
				'dien_thoai'=>$phone,
				'email'=>$email,
				'account_id'=>$user_id
			);
			DB::insert('ssnh_nguoi_choi',$nguoi_choi_arr);
			//////////////////////////////////////////////
		}
	}
}
?>