<?php 
class ManageItemOs extends Module
{
	function ManageItemOs($row)
	{
		Module::Module($row);
		if(User::can_view(false,ANY_CATEGORY))
		{
			
			require_once 'forms/edit.php';
			$this->add_form(new EditManageItemOsForm());
		}
		else
		{
			URL::access_denied();
		}
	}
}
?>