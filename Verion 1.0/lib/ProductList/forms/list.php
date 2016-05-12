<?php
class ProductListForm extends Form
{
	function ProductListForm()
	{
		Form::Form('ProductListForm');
		$this->link_css(Portal::template('default').'/css/product.css');
	}
	function draw()
	{
		$this->map = array();
		$item_per_page = 18;
		require_once 'packages/core/includes/utils/paging.php';
		if(Url::get('name_id') and $category = ProductList::$category)
		{
			$this->map['category_name'] = $category['name_'.Portal::language()];
			$cond = 'product.status<>"HIDE" and '.IDStructure::child_cond($category['structure_id']);
			$count = ProductListDB::get_total_item($cond);
			$this->map['paging'] = paging($count['acount'],$item_per_page,5,REWRITE,'page_no',array('name_id'));
			$this->map['items'] = ProductListDB::get_products($cond,$item_per_page);
			array_shift($this->map['items']);
			foreach($this->map['items'] as $key=>$value)
			{
				$this->map['items'][$value['id']] = $value;
				unset($this->map['items'][$key]);
			}
			foreach($this->map['items'] as $key=>$value){
				$this->map['items'][$key]['price'] = System::display_number($value['price']);
				$this->map['items'][$key]['price_agent'] = System::display_number($value['price_agent']);
				$this->map['items'][$key]['saving'] = System::display_number($value['price_agent'] - $value['price']);
			}			
			$this->parse_layout('list',$this->map);			
		}
		else
		{
			$this->map['category_name'] = '';
			$cond = 'product.status<>"HIDE"';
			$count = ProductListDB::get_total_item($cond);
			$this->map['paging'] = paging($count['acount'],$item_per_page,5,REWRITE,'page_no',array('name_id'));
			$this->map['items'] = ProductListDB::get_products($cond,$item_per_page);
			foreach($this->map['items'] as $key=>$value){
				$this->map['items'][$key]['price'] = System::display_number($value['price']);
				$this->map['items'][$key]['price_agent'] = System::display_number($value['price_agent']);
				$this->map['items'][$key]['saving'] = System::display_number($value['price_agent'] - $value['price']);
			}
			$this->parse_layout('list',$this->map);
		}
	
	}
}
?>