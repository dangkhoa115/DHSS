<?php 
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class ManageAgent extends Module
{
	function ManageAgent($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view(false,ANY_CATEGORY))
		{
			switch(Url::get('cmd'))
			{
				case 'add':
				case 'edit':
					require_once 'forms/edit.php';
					$this->add_form(new ManageAgentAddForm());
					break;
				case 'view':
					require_once 'forms/view.php';
					$this->add_form(new ManageAgentDetailForm());
					break;
				case 'delete':
					$this->delete();
					break;
				default:
					require_once 'forms/list.php';
					$this->add_form(new ManageAgentListForm());
					break;
			}
		}
		else
		{
			Url::access_denied();
		}	
	}
	function delete(){
		DB::delete('party','user_id = "'.Url::get('id').'"');
		DB::delete('account','is_agent and id = "'.Url::get('id').'"');
		Url::redirect_current();
	}
}
?>