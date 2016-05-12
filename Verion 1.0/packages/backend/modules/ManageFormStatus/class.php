<?php 
class ManageFormStatus extends Module{
	function ManageFormStatus($row){
		Module::Module($row);
		if(User::can_view(false,ANY_CATEGORY)){
			require_once 'forms/edit.php';
			$this->add_form(new EditManageFormStatusForm());
		}else{
			URL::access_denied();
		}
	}
}
?>