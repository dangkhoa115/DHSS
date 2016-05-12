<?php
class ProductDetailForm extends Form
{
	function ProductDetailForm()
	{
		Form::Form('ProductDetailForm');
		$this->link_css(Portal::template('default').'/css/product.css');
		$this->link_css(Portal::template('default').'/css/jquery/jquery.lightbox-0.5.css');		
		$this->link_js('packages/core/includes/js/jquery/jquery.lightbox-0.5.min.js');		
	}
	function draw()
	{
		$this->map = array();
		if(Url::get('id') and $item = ProductDetailDB::get_product(intval(Url::sget('id'))))
		{
			DB::update_hit_count('product',intval(Url::sget('id')));
			if(($item['price_agent']-$item['price'])>0)
			{
				$item['saving'] = System::display_number($item['price_agent']-$item['price']);
			}
			else
			{
				$item['saving'] = 0;
			}
			$item['price_agent'] = System::display_number($item['price_agent']);
			$item['price'] = System::display_number($item['price']);
			$this->map = $item;
			$this->parse_layout('list',$this->map);
		}
	}
}
?>