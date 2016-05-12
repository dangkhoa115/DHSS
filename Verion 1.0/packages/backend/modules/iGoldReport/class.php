<?php 
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class iGoldReport extends Module
{
	function iGoldReport($row)
	{
		Module::Module($row);
		require_once 'packages/backend/includes/php/nguoi_choi.php';
		require_once 'db.php';
		//if(User::can_admin(false,ANY_CATEGORY))
		if(User::is_login())
		{
			require_once 'forms/list.php';
			$this->add_form(new ListiGoldReportForm());	
		}
		else
		{
			URL::access_denied();
		}
	}
}
?>