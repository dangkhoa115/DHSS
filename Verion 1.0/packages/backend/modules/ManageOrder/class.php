<?php 
/******************************
COPY RIGHT BY Catbeloved - Framework
******************************/
class ManageOrder extends Module
{
	function ManageOrder($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::is_login())
		{
			if(Url::sget('page') == 'manage_order')
			{
				switch(Url::get('cmd'))
				{
					case 'delete':
						$this->delete_order();
						break;
					case 'check':
						$this->check_contact();
						Url::redirect_current(array('cmd'=>'success'));
						break;
					case 'detail':
						$this->check_contact();
						require_once 'forms/detail.php';
						$this->add_form(new ManageOrderDetailForm());
						break;
					default:
						require_once 'forms/list.php';
						$this->add_form(new ManageOrderForm());
						break;
				}
			}
			else
			{
				require_once 'forms/newsletter.php';
				$this->add_form(new ManageNewsletterForm());
			}	
		}
		else
		{
			Url::access_denied();
		}	
	}
	function delete_order(){
		if(Url::get('id') and $item = DB::select('shopping_order','md5(concat(id,"catbeloved")) = "'.Url::get('id').'"'))
		{
			DB::delete('shopping_order','md5(concat(id,"catbeloved")) = "'.Url::get('id').'"');
			DB::delete('shopping_order_detail','md5(concat(order_id,"catbeloved")) = "'.Url::get('id').'"');
			//save_log(Url::get('id'));
		}
		Url::redirect_current();	
	}
	function check_contact()
	{
		if(User::can_edit(false,ANY_CATEGORY) and  Url::get('id') and $contact = DB::fetch('select id,checked from shopping_order where id='.intval(Url::sget('id')).' and checked=0'))
		{
			DB::update_id('shopping_order',array('checked'=>$contact['checked']==0?'1':'0'),$contact['id']);
		}
	}
}
?>