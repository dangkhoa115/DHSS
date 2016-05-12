<?php
class EditCreditCardAdminForm extends Form
{
	function EditCreditCardAdminForm()
	{
		Form::Form('EditCreditCardAdminForm');
		$this->link_css('skins/default/css/cms.css');
		$this->link_css('skins/default/css/tabs/tabpane.css');
		$this->link_js('skins/default/css/tabs/tabpane.js');
		$this->link_js('packages/core/includes/js/multi_items.js');
	}
	function on_submit()
	{
		if(User::can_admin(false,ANY_CATEGORY))
		{
			if($credit_cards = Url::get('mi_credit_card_group') and is_array($credit_cards))
			{
				foreach($credit_cards as $key=>$credit_card)
				{
					if($credit_card['id'])
					{
						if($credit_card['name'])
						{
							DB::update_id('credit_card',array('name'=>$credit_card['name']),$credit_card['id']);
						}
					}else
					{
						DB::insert('credit_card',array('name'=>$credit_card['name']));
					}
				}
			}
			if($group_deleted_ids = Url::get('group_deleted_ids'))
			{
				$delete_ids = explode(',',$group_deleted_ids);
				foreach($delete_ids as $value)
				{
					DB::delete_id('credit_card',intval($value));
				}
			}
			echo '<script>alert("Update successfull!");window.location="'.Url::build('panel',array('category_id'=>75)).'"; </script>';
		}
	}
	function draw()
	{
		$this->map = array();
		require_once 'packages/core/includes/utils/paging.php';
		$item_per_page = 100;
		$page_no = page_no();
		$total = DB::fetch('select count(*) as acount from credit_card','acount');
		$this->map['paging'] = paging($total,$item_per_page);
		
		$sql = 'SELECT 
					credit_card.*
				FROM 
					credit_card
				ORDER BY
					credit_card.id
				LIMIT
					'.($page_no-1)*$item_per_page.','.$item_per_page.'
				';
		$_REQUEST['mi_credit_card_group'] = DB::fetch_all($sql);
		$this->parse_layout('edit',$this->map);
	}
}
?>
