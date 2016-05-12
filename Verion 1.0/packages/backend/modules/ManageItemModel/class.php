<?php 
class ManageItemModel extends Module
{
	function ManageItemModel($row)
	{
		Module::Module($row);
		if(User::can_view(false,ANY_CATEGORY))
		{
			
			require_once 'forms/edit.php';
			$this->add_form(new EditManageItemModelForm());
		}
		else
		{
			URL::access_denied();
		}
	}
}
?>