<?php
class GalleryCategoryDB
{
	static function get_categories($cond)
	{
		return DB::fetch_all('
			SELECT
				id,name_'.Portal::language().' as category_name,icon_url,
				brief_'.Portal::language().' as brief,structure_id,icon_url,name_id
			FROM
				category
			WHERE
				'.$cond.'
			ORDER BY
				structure_id
		');
	}
	static function get_total_category($cond){
		$total = DB::fetch('
			SELECT
				count(*) as total
			FROM
				category
			WHERE
				'.$cond.'
		');
		return $total['total'];
	}
	static function get_items($cond_item)
	{
		return DB::fetch_all('
			SELECT
				media.id,
				media.name_'.Portal::language().' as name,
				media.image_url,
				media.status,
				media.name_id
			FROM
				media
				inner join category on category.id = media.category_id
			WHERE
				'.$cond_item.'
			ORDER BY
				media.time desc
			LIMIT
				0,3
		');
	}
	static function get_all_items($cond,$item_per_page=20)
	{
		return DB::fetch_all('
			SELECT
				media.id,
				media.name_'.Portal::language().' as name,
				media.image_url,
				media.category_id,
				media.name_id,
				category.name_'.Portal::language().' as category_name
			FROM
				media
				inner join category on media.category_id=category.id
			WHERE
				'.$cond.'		
			ORDER BY
				media.id DESC,media.position
			LIMIT
				'.((page_no()-1)*$item_per_page).','.$item_per_page.'	
		');
	}
	static function get_total_items($cond)
	{
		return DB::fetch('
			SELECT
				count(*) as acount
			FROM
				media
				inner join category on category.id=media.category_id
			WHERE
				'.$cond.'
		');
	}	
}
?>