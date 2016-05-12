<?php
class NewsCategoryDB
{
	static function get_items($cond,$limit='')
	{
		return DB::fetch_all('
			SELECT 
				news.id,
				news.name_'.Portal::language().' as name,
				news.brief_'.Portal::language().' as brief,
				news.small_thumb_url,
				news.image_url,
				news.name_id,
				news.show_time,
				news.show_author,
				news.time,
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
			'.($limit?'limit 0,'.$limit:'').'
		');
	}
	static function get_count($cond)
	{
		return DB::fetch('
			SELECT
				count(*) as acount
			FROM
				news
				INNER JOIN category on news.category_id=category.id
			WHERE
				'.$cond.'
		','acount');
	}
	static function get_categories($cond)
	{
		return DB::fetch_all('
			SELECT
				category.id,
				category.name_'.Portal::language().' as category_name,
				category.structure_id,
				category.name_id as c_name_id
			FROM
				category
			WHERE
				'.$cond.'
			ORDER BY
				structure_id
		');
	}
	static function get_category($cond)
	{
		return DB::fetch('
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