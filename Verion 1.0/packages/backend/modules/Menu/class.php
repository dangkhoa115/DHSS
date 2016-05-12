<?php
class Menu extends Module{
	function Menu($row){
		if(User::is_login()){
			Module::Module($row);
			require_once 'db.php';
			if(User::can_admin(MODULE_QUANLYCLB,ANY_CATEGORY) or User::can_admin(MODULE_NEWSADMIN,ANY_CATEGORY)){
				require_once 'forms/admin_menu.php';
				$this->add_form(new MenuForm());
			}else{
				require_once 'forms/user_menu.php';
				$this->add_form(new UserMenuForm());
			}
		}
		else
		{
			Url::access_denied();
		}
	}
}
?>
