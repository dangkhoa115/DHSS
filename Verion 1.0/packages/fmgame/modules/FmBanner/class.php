<?php
class FmBanner extends Module
{
	function FmBanner($row)
	{
		Module::Module($row);
		if(User::is_login()){
			require_once 'packages/backend/includes/php/igold.php';
			require_once 'packages/backend/includes/php/ssnh.php';
			require_once 'packages/backend/includes/php/message.php';
			require_once 'packages/backend/includes/php/nguoi_choi.php';
			require_once 'packages/fmgame/includes/php/fmgame_local.php';
			require_once 'db.php';
			if(Url::get('do') == 'count_message'){
				echo  Message::count_unread_message();
				exit();
			}else{
				require_once 'forms/list.php';
				$this->add_form(new FmBannerForm());
			}
		}
	}
}
?>