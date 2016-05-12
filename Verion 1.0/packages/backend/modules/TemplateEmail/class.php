<?php
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class TemplateEmail extends Module
{
	function TemplateEmail($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view(false,ANY_CATEGORY))
		{
			switch(Url::get('cmd'))
			{
				case 'add':
					$this->add_cmd();
					break;
				case 'edit':
					$this->edit_cmd();
					break;	
				case 'unlink':
					$this->delete_file();	
					break;
				default:
					$this->list_cmd();
					break;
			}
		}
		else
		{
			Url::access_denied();
		}
	}	
	function list_cmd()
	{
		require_once 'forms/list.php';
		$this->add_form(new ListTemplateEmailForm());
	}
	function add_cmd()
	{
		if(User::can_add(false,ANY_CATEGORY))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditTemplateEmailForm());
		}	
		else
		{
			Url::access_denied();
		}
	}
	function edit_cmd()
	{
		if(User::can_edit(false,ANY_CATEGORY))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditTemplateEmailForm());
		}	
		else
		{
			Url::access_denied();
		}
	}
}
?>
