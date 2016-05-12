<?php
class ManageItemCategoryDB{	
	static function check_categories($categories){
		foreach($categories as $id=>$category){
			if(!User::can_view(false,$category['structure_id'])){
				unset($categories[$id]);
			}
		}
		return $categories;
	}
	static function get_categories($cond=false){
		return DB::fetch_all('select item_category.* from item_category where '.$cond.' order by structure_id');
	}
}
?>