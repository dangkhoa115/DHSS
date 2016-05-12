<?php
class ManageOrderForm extends Form
{
	function ManageOrderForm()
	{
		Form::Form('ManageOrderForm');
		$this->link_css('skins/default/css/cms.css');
	}
	function on_submit()
	{
	}
	function draw()
	{
		$this->map = array();
		$item_per_page = 100;
		if(User::can_admin(false,ANY_CATEGORY)){
			$cond = '1=1';
			$join = false;
		}else{
			$cond = 'item.poster = "'.Session::get('user_id').'"';
			$join = '	INNER JOIN shopping_order_detail AS sod ON sod.order_id = shopping_order.id	
						INNER JOIN item ON item.id = sod.product_id';
		}
		$count = ManageOrderDB::get_total($cond,$join);
		require_once 'packages/core/includes/utils/paging.php';
		$this->map['paging'] = paging($count['acount'],$item_per_page);
		$this->map['items'] = ManageOrderDB::get_items($item_per_page,$cond,$join);
		$this->parse_layout('list',$this->map);
	}
}
?>