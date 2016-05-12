<?php
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class FacilityAdmin extends Module
{
	function FacilityAdmin($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view(false,ANY_CATEGORY))
		{
			switch(Url::get('cmd'))
			{
				case 'unlink':
					$this->delete_file();	
					break;
				default:					
					$this->edit_cmd();
			}
		}
		else
		{
			if(User::can_admin(false,ANY_CATEGORY))
			{
				Url::redirect('manage_hotel');
			}else
			{
				Url::access_denied();
			}
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
	function edit_cmd()
	{
		if(User::can_edit(false,ANY_CATEGORY))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditFacilityAdminForm());
		}	
		else
		{
			Url::access_denied();
		}
	}
}
?>
