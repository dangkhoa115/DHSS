<?php 
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class Log extends Module
{
	function Log($row)
	{
		Module::Module($row);
		require_once 'db.php';
		//if(User::can_admin(false,ANY_CATEGORY))
		if(User::is_admin() or Session::get('user_id') == 'tienld')
		{
			require_once 'forms/list.php';
			$this->add_form(new ListLogForm());	
		}
		else
		{
			URL::access_denied();
		}
	}
}
?>