<?php
class SendEmail extends Module
{
	function SendEmail($row)
	{
		define('TYPE','TRAVEL');
		Module::Module($row);
		require_once 'db.php';
		if(User::can_edit(false,ANY_CATEGORY)){
			if(Url::get('cmd') == 'UpdateFullName'){
				if(Url::get('email')){
					echo $this->UpdateFullName(false,Url::get('email'));
				}elseif(Url::get('nguoi_choi_id')){
					echo $this->UpdateFullName(Url::get('nguoi_choi_id'),false);
				}
				exit();
			}
		}
		if(User::can_view(false,ANY_CATEGORY))
		{
			switch(Url::get('cmd')){
				default:
					$this->list_cmd();
					break;
			}
		}
		else
		{
			Url::access_denied();
		}
	}
	function list_cmd()
	{
		require_once 'forms/list.php';
		$this->add_form(new ListSendEmailForm());
	}
	function UpdateFullName($nguoi_choi_id,$email){
		if($booking_id){
			DB::update('ssnh_nguoi_choi',array('ten'=>Url::get('value')),'id='.$nguoi_choi_id);
			return Url::get('value');
		}elseif($email){
			DB::update('party',array('full_name'=>Url::get('value')),'email="'.$email.'"');
			return Url::get('value');
		}
		
	}
}
?>