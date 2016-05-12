<?php 
class ManageStoreStatus extends Module{
	function ManageStoreStatus($row){
		Module::Module($row);
		if(User::can_view(false,ANY_CATEGORY)){
			require_once 'forms/edit.php';
			$this->add_form(new EditManageStoreStatusForm());
		}else{
			URL::access_denied();
		}
	}
}
?>