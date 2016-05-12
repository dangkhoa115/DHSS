<?php 
class ColumnLayout extends Module
{
	function ColumnLayout($row)
	{
		Module::Module($row);
		if(!System::check_user_agent()){
			require_once 'forms/list.php';
			$this->add_form(new ColumnLayoutForm());
		}
	}
}
?>