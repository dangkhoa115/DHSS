<?php 
class ManageOrderDB
{
	function get_total($cond = '1',$join=false)
	{
		return DB::fetch('
			SELECT
				count(*) as acount
			FROM
				shopping_order
				'.$join.'
			WHERE
				'.$cond.'
		');
	}
	function get_items($item_per_page,$cond = '1',$join=false)
	{
		return DB::fetch_all('
			SELECT
				shopping_order.*
			FROM
				shopping_order
				'.$join.'
			WHERE
				'.$cond.' 
			ORDER BY
				shopping_order.time desc
			limit '.((page_no()-1)*$item_per_page).','.$item_per_page.'				
		');
	}
	function get_item()
	{
		return DB::fetch('
			SELECT
				shopping_order.*
			FROM
				shopping_order
			WHERE
				shopping_order.id='.intval(Url::sget('id')).' 
			');
	}
	function get_item_details($cond = '1')
	{
		$items = DB::fetch_all('
			SELECT
				shopping_order_detail.*,item.*,item_category.name_id as category_name_id
			FROM
				shopping_order_detail
				INNER JOIN item ON item.id = shopping_order_detail.product_id
				INNER JOIN item_category ON item_category.id = item.category_id
			WHERE
				'.$cond.' 
			ORDER BY
				shopping_order_detail.id desc
		');
		foreach($items as $key=>$value){
			$items[$key]['thumb_url'] = str_replace('image_url','thumb_url',$value['image_url']);
			$items[$key]['price'] = System::display_number($value['price']);
			$items[$key]['amount'] = System::display_number($value['quantity']*$value['price']);
			$items[$key]['quantity'] = $value['quantity'];
			$items[$key]['thumb_url'] = str_replace('image_url','image_url',$value['image_url']);
			$items[$key]['content'] = String::display_sort_title(str_replace(array('"','\''),array('',''),$value['content']),20);
		}
		return $items;
	}
}
?>