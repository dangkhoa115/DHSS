<?php 
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class EditPriceReport extends Module
{
	function EditPriceReport($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_admin(false,ANY_CATEGORY))
		{
			require_once 'forms/list.php';
			$this->add_form(new ListEditPriceReportForm());	
		}
		else
		{
			URL::access_denied();
		}
	}
}
?>