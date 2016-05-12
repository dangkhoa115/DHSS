<?php 
class QuanLyCauThu extends Module
{
	function QuanLyCauThu($row)
	{
		Module::Module($row);
		if(User::can_view(false,ANY_CATEGORY))
		{
			if(Url::get('mua_giai_id')){
				Session::set('mua_giai_id',Url::get('mua_giai_id'));
			}
			if(!Session::is_set('mua_giai_id')){
				Session::set('mua_giai_id',2);
			}
			require_once 'packages/backend/includes/php/ssnh.php';
			require_once 'forms/edit.php';
			$this->add_form(new EditQuanLyCauThuForm());
		}
		else
		{
			URL::access_denied();
		}
	}
}
?>