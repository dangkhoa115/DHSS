<?php 
class ManageSlide extends Module
{
	function ManageSlide($row)
	{
		Module::Module($row);
		if(User::can_view(false,ANY_CATEGORY))
		{
			
			require_once 'forms/edit.php';
			$this->add_form(new EditManageSlideForm());
		}
		else
		{
			URL::access_denied();
		}
	}
}
?>