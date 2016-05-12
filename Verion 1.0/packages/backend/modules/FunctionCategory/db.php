<?php
class FunctionCategoryDB
{	
	function GetZone($structure_id='1010000000000000000')
	{
		return DB::fetch_all('
			SELECT
				*
			FROM
				zone 
			WHERE
				'.IDStructure::direct_child_cond($structure_id,true).'	
			ORDER BY
				structure_id		
		');	
	}	
	static function check_categories($categories)
	{
		foreach($categories as $id=>$category)
		{
			if(!User::can_view(false,$category['structure_id']))
			{
				//unset($categories[$id]);
			}
		}
		return $categories;
	}
	static function get_categories()
	{
		return DB::fetch_all('select function.id,function.name_1,function.structure_id,function.icon_url,function.url,function.group_name_'.Portal::language().' as group_name from function where structure_id <>'.ID_ROOT.' and status <> "HIDE" order by function.structure_id');
	}
}
?>