<?php
class ManageItemDB{
	function get_total_item($cond){
		$sql = '
			SELECT 
				count(*) as acount
			FROM 
				item
				left outer join item_category as ic on ic.id = item.category_id				
			WHERE 
				'.$cond;
		return DB::fetch($sql,'acount');
	}
	function get_items($cond,$order_by,$item_per_page){
		require_once('packages/core/includes/utils/like.php');
		$sql = '
			SELECT
				item.*,ic.name as category
			FROM
				item
				left outer join item_category as ic on ic.id = item.category_id
			WHERE
				'.$cond.'
			ORDER BY
				'.$order_by.'
			LIMIT
				'.((page_no()-1)*$item_per_page).','.$item_per_page.'
		';
		$items = DB::fetch_all($sql);
		$i = 0;
		foreach($items as $key=>$value){
			$items[$key]['i'] = ++$i;
			//$fb = Like::get_facebook_count('http://www.socngon.net/xem/c'.$value['category_id'].'/id'.$value['id'].'.html');
			$items[$key]['likes'] = 0;//$fb['likes'];
		}
		return ($items);
	}
	function get_category(){
		return DB::fetch_all('
			SELECT
				id
				,name
				,structure_id
			FROM
				item_category
			WHERE
				1=1
			ORDER BY
				structure_id	
		');
	}
	function get_model(){
		return DB::fetch_all('
			SELECT
				item_model.id,
				CONCAT(item_maker.name," - ",item_model.name) AS name
			FROM
				item_model
				INNER JOIN item_maker ON item_maker.id = item_model.maker_id
			WHERE
				1=1
			ORDER BY
				item_maker.name,item_model.name
		');
	}
	function get_os(){
		return DB::fetch_all('
			SELECT
				id,name
			FROM
				item_os
			WHERE
				1=1
			ORDER BY
				item_os.name
		');
	}
	function get_item($id){
		return DB::fetch('
			SELECT
				item.*,
				item_info.*
			FROM
				item
				INNER JOIN item_info ON item_info.id = item.id
			WHERE
				item.id = '.$id.'
		');
	}
	function delete_item($item_id){
		$item_images = DB::select_all('item_image','item_id='.$item_id.'');
		foreach($item_images as $value){
			if(file_exists($value['image_url'])){
				@unlink($value['image_url']);
			}
		}
		DB::delete_id('item_image','item_id = '.$item_id);
		DB::delete_id('item_info','id = '.$item_id);
		DB::delete_id('item_like','item_id = '.$item_id);		
		DB::delete_id('form_status_item','item_id = '.$item_id);		
		DB::delete_id('warranty_status_item','item_id = '.$item_id);		
		DB::delete_id('item',$item_id);
	}
}
?>
