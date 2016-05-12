<?php
class SignOut{}
if(User::is_login())
{
	if (Session::is_set('user_id'))
	{		
		$id=Session::get('user_id');
		DB::update('account',array('last_online_time'=>time(),'cache_privilege'=>''),'id="'.$id.'"');
		setcookie('user_id',"",time()-3600);
		Session::delete('user_id');
		Session::delete('user_data');
	}
	if(URL::check('href'))
	{
		URL::redirect_url($_REQUEST['href']);
	}
	else
	{
		//Url::redirect('index',array(),REWRITE);
		echo '<script>window.location="/";</script>';
	}
}
else
{
	//Url::redirect('index',array(),REWRITE);
	echo '<script>window.location="/";</script>';
}
?>
