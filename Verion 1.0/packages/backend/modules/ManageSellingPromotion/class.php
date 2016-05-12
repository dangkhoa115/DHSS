<?php 
class ManageSellingPromotion extends Module{
	function ManageSellingPromotion($row){
		Module::Module($row);
		if(User::can_view(false,ANY_CATEGORY)){
			require_once 'forms/edit.php';
			$this->add_form(new EditManageSellingPromotionForm());
		}else{
			URL::access_denied();
		}
	}
}
?>