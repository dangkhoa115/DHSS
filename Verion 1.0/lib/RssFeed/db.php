<?php
class RssFeedDB{
	static function get_categories($cond)
	{
		return DB::fetch_all('
			SELECT
				id,name_'.Portal::language().' as name,structure_id,category.name_id as category_name_id,icon_url
			FROM
				category
			WHERE
				'.$cond.'
			ORDER BY
				structure_id
		');
	}
	static function get_items($cond){
		return DB::fetch_all('
			SELECT
				news.id,news.name_'.Portal::language().' as name,news.brief_'.Portal::language().' as brief,news.description_'.Portal::language().' as description,news.time,news.name_id
			FROM
				news
				INNER JOIN category ON news.category_id=category.id
			WHERE
				'.$cond.'
			ORDER BY
				news.id desc,news.time desc
			LIMIT
				0,20
		');
	}
}
?>