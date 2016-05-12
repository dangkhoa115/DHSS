<?php
class ManageOrderDetailForm extends Form
{
	function ManageOrderDetailForm()
	{
		Form::Form('ManageOrderDetailForm');
		$this->link_css('skins/default/css/cms.css');
		DB::update('shopping_order',array('checked'=>1),'id = '.Url::iget('id'));
	}
	function on_submit()
	{
	}
	function draw()
	{
		$this->map = array();
		$this->map = ManageOrderDB::get_item();
		require_once('cache/tables/zones.cache.php');
		require_once('packages/core/includes/utils/category.php');
		category_indent($zones);
		foreach($zones as $key=>$value){
			$zones[$key]['name'] = $value['indent'].$value['name'];
		}
		$this->map['zone_id_list'] = $this->map['ship_zone_id_list'] = array(''=>'Chọn tỉnh/TP') + String::get_list($zones);
		$this->map['items'] = ManageOrderDB::get_item_details('shopping_order_detail.order_id = '.$this->map['id'].'');
		$this->parse_layout('detail',$this->map);
	}
}
?>