<?php
class HomeNewsCategoryDB
{
	static function get_items($cond)
	{
		return DB::fetch_all('
			SELECT 
				news.id,
				news.name_'.Portal::language().' as name,news.brief_'.Portal::language().' as brief,
				news.small_thumb_url,news.image_url,news.name_id,
				category.name_'.Portal::language().' as category_name,
				category.id as category_id,
				category.structure_id
			FROM
				news
				INNER JOIN category on news.category_id=category.id
			WHERE 
				'.$cond.'
			ORDER By
				news.position desc,news.time DESC
			LIMIT
				0,6
		');
	}
	static function get_categories($cond)
	{
		return DB::fetch_all('
			SELECT
				category.id,
				category.name_'.Portal::language().' as name,
				category.structure_id,
				category.name_id
			FROM
				category
			WHERE
				'.$cond.'
			ORDER BY
				structure_id
		');
	}
}
?>