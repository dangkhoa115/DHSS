<?php
// WRITEN BY: MINHTC
class MenuHome extends Module{
	function MenuHome($row){
		Module::Module($row);
		require_once 'db.php';
		if(User::is_login()){
			if(!Url::get('category_id')){
				$_REQUEST['category_id'] = 5; 
			}
			if(User::can_admin()){
				require_once 'forms/list.php';
				$this->add_form(new MenuHomeForm());
			}else{
				require_once 'forms/user_list.php';
				$this->add_form(new UserMenuHomeForm());
			}
		}else{
			Url::redirect('sign_in');
		}
	}
}
?>
