<?php
class ProductCompareForm extends Form
{
	function ProductCompareForm()
	{
		Form::Form('ProductCompareForm');
		$this->link_css(Portal::template('default').'/css/product.css');
	}
	function draw()
	{
		$this->map = array();
		if(Url::get('selected'))
		{
			$products_ids = Url::get('selected');
			$str = implode(',',$products_ids);
			$cond = ' product.id in ('.$str.')';
			if($products = ProductCompareDB::get_products($cond))
			{
				$this->map['products'] = $products;
			}
			$this->parse_layout('list',$this->map);
		}
	}
}
?>