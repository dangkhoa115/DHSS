<?php
class NewsCategoryForm extends Form
{
	function NewsCategoryForm()
	{
		Form::Form('NewsCategoryForm');
		$this->link_css(Portal::template().'/css/news.css');
	}	
	function draw()
	{
		$this->map = array();		
		//get categories
		$cond = 'category.status<>"HIDE" and category.type="NEWS" and category.portal_id="'.PORTAL_ID.'"';
		
		if(($name_id = Url::get('name_id')) and ($category = NewsCategoryDB::get_category('type="NEWS" and name_id = "'.$name_id.'"')))
		{
			$cond .= ' and '.IDStructure::direct_child_cond($category['structure_id']);
		}else{
			$cond .= ' and '.IDStructure::direct_child_cond(ID_ROOT).' and category.structure_id<>'.ID_ROOT;
		}
		$categories = NewsCategoryDB::get_categories($cond);
		//get items follow category
		$cond = 'news.status<>"HIDE" and news.type="NEWS" and news.portal_id="'.PORTAL_ID.'" and publish=1';
		if($categories)
		{
			//list theo danh muc
			$layout = 'list_category';
			foreach($categories as $key=>$value)
			{
				$extra_cond = ' and '.IDStructure::child_cond($value['structure_id']);
				$categories[$key]['child'] = NewsCategoryDB::get_items($cond.$extra_cond,4);
				if($categories[$key]['child'])
				{
					unset($categories[$key]['id']);
					$categories[$key] += current($categories[$key]['child']);
					unset($categories[$key]['child'][$categories[$key]['id']]);
				}else
				{
					unset($categories[$key]);
				}
			}
			$this->map['categories'] = $categories;
		}else{
			//list all
			$layout = 'list';
			if(isset($category) and $category)
			{
				$cond .= ' and news.category_id = '.$category['id'];
				$this->map['category_name'] = $category['name'];
			}else
			{
				$this->map['category_name'] = Portal::language('news');
			}
			$item_per_page = 2;
			require_once 'packages/core/includes/utils/paging.php';
			$total = NewsCategoryDB::get_count($cond);
			$this->map['paging'] = paging($total,$item_per_page,10,REWRITE,'page_no',array('name_id'),Portal::language('page'));		
			$this->map['items'] = NewsCategoryDB::get_items($cond,$item_per_page);
		}
		//System::debug($this->map);
		$this->parse_layout($layout,$this->map);
	}
}
?>