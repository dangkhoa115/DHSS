<?php 
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class Publisher extends Module
{
	function Publisher($row)
	{
		if(User::can_admin(MODULE_PUBLISHER,ANY_CATEGORY))
		{
			if(Url::get('doc_gia')==1){
				Session::set('doc_gia',1);
			}if(Url::get('qtr')==1){
				Session::delete('doc_gia');
			}
			Module::Module($row);
			require_once 'db.php';
			require_once 'forms/list.php';
			$this->add_form(new PublisherForm());		
		}
		else
		{
			Url::access_denied();
		}	
	}
}
?>