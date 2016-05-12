<?php 
class ManageItemMaker extends Module
{
	function ManageItemMaker($row)
	{
		Module::Module($row);
		if(User::can_view(false,ANY_CATEGORY))
		{
			
			require_once 'forms/edit.php';
			$this->add_form(new EditManageItemMakerForm());
		}
		else
		{
			URL::access_denied();
		}
	}
}
?>