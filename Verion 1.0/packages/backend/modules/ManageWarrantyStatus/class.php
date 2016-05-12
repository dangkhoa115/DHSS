<?php 
class ManageWarrantyStatus extends Module{
	function ManageWarrantyStatus($row){
		Module::Module($row);
		if(User::can_view(false,ANY_CATEGORY)){
			require_once 'forms/edit.php';
			$this->add_form(new EditManageWarrantyStatusForm());
		}else{
			URL::access_denied();
		}
	}
}
?>