<?php
class HomeNewsCategoryForm extends Form
{
	function HomeNewsCategoryForm()
	{
		Form::Form('HomeNewsCategoryForm');
		$this->link_css(Portal::template('news').'/css/home.css');
	}	
	function draw()
	{
		$this->map = array();
		$cond = '1 and category.status<>"HIDE" and category.type="NEWS" and category.portal_id="'.PORTAL_ID.'" and '.IDStructure::direct_child_cond(ID_ROOT).' and category.structure_id<>'.ID_ROOT;
		$cond_category = '1 and category.type="NEWS" and category.portal_id="'.PORTAL_ID.'" and '.IDStructure::child_cond(ID_ROOT).' and category.structure_id<>'.ID_ROOT;
		$cond_item = '1 and news.status<>"HIDE" and news.type="NEWS" and news.portal_id="'.PORTAL_ID.'"';
		$direct_categories = HomeNewsCategoryDB::get_categories($cond);
		$categories = HomeNewsCategoryDB::get_categories($cond_category);
		$items = HomeNewsCategoryDB::get_items($cond_item);
		$new_categories = array();
		$new_category_id = 0;
		foreach($direct_categories as $id=>$category)
		{
			$i = 1;
			$cond_item = '1 and news.status<>"HIDE" and news.type="NEWS" and news.status<>"HOT" and news.portal_id="'.PORTAL_ID.'" and '.IDStructure::child_cond($category['structure_id']);
			foreach($categories as $key=>$sub_category)
			{
				if(IDStructure::parent($sub_category['structure_id'])==$category['structure_id'] and $i<5)
				{
					$direct_categories[$id]['categories'][$key] = $sub_category;
					$i++;
				}
			}
			$direct_categories[$id]['items'] = HomeNewsCategoryDB::get_items($cond_item);
		}
		$this->map['categories'] = $direct_categories;
		$this->parse_layout('list',$this->map);
	}
}
?>