<?php
class GalleryDB
{
	static function get_items($cond,$item_per_page)
	{
		return DB::fetch_all('
			SELECT
				media.id,
				media.name_'.Portal::language().' as name,
				media.image_url,
				media.time				
			FROM
				media
				inner join category on media.category_id=category.id
			WHERE
				1
				'.$cond.'
			ORDER BY
				media.position,media.id	
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
				1
				'.$cond.'
		');
	}
	
}
?>
