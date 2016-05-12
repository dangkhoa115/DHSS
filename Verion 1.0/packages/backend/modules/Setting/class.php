<?php 
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class Setting extends Module
{
	function Setting($row)
	{
		if(User::can_admin(MODULE_SETTING,ANY_CATEGORY))
		{	
			Module::Module($row);
			switch(Url::get('cmd'))
			{
				case 'seo':
					$this->seo_config();
					break;
				case 'front_end':
					$this->front_back();
					break;	
				case 'unlink':
					$this->delete_file();	
					break;	
				default:
					$this->account_setting();
					break;	
			}
		}
		else
		{
			Url::access_denied();
		}	
	}
	function delete_file()
	{
		if(Url::get('link') and file_exists(Url::get('link')) and User::can_delete(false,ANY_CATEGORY))
		{
			@unlink(Url::get('link'));
		}
		echo '<script>window.close();</script>';
	}
	function seo_config()
	{
		require_once 'forms/list.php';
		$this->add_form(new SettingForm());			
	}
	function front_back()
	{
		require_once 'forms/front.php';
		$this->add_form(new FrontEndForm());	
	}
	function account_setting()
	{
		require_once 'forms/account_setting.php';
		$this->add_form(new AccountSettingForm());			
	}
}
?>