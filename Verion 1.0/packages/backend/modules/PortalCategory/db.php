<?php
class PortalCategoryDB
{
	static function get_categories($structure_id='1040000000000000000',$cond)
	{		
		return DB::fetch_all('
			SELECT
				id,
				name_id,
				name_'.Portal::language().' as name,
				structure_id,
				status,
				url,
				type
			FROM
				category
			WHERE
				1 = 1
				and portal_id="'.PORTAL_ID.'"
				and '.IDStructure::direct_child_cond($structure_id).'		
				'.$cond.'
			ORDER BY
				structure_id			
		');		
	}
	static function get_all_categories($categories)
	{
		$new_categories=array();
		foreach($categories as $id=>$category)
		{
			$new_categories[$id]=$category;
			$new_categories[$id]['childs']=PortalCategoryDB::get_categories($category['structure_id']);
		}
		return $new_categories;
	}
	static function check_categories($categories)
	{
		foreach($categories as $id=>$category)
		{
			if(!User::can_view(false,$category['structure_id']))
			{
				unset($categories[$id]);
			}
		}
		return $categories;
	}
}
?>