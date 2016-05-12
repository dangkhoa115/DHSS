<?php
class FmBannerDB{
	static function get_language(){
		return DB::fetch_all('
			SELECT
				id,name
			FROM
				language
		');
	}
	function get_zone_list()
	{
		return DB::fetch_all('
			SELECT
				id,name,structure_id
			FROM
				zone
			WHERE
				'.IDStructure::path_cond(DB::structure_id('zone',intval(Url::sget('zone_id')))).'
				 and structure_id<>'.ID_ROOT.'
			ORDER BY
				structure_id
		');
	}
	static function get_top_new(){
		$item = DB::fetch('
			SELECT
				news.id,news.name_id,news.name_1 AS name,news.brief_1 as brief,news.image_url,category.name_id as category_name_id
			FROM
				news
				INNER JOIN category ON category.id = news.category_id
			WHERE
				news.status = "POPUP"
			ORDER BY
				news.id DESC
			LIMIT
				0,1
		');
		//$item['brief'] = String::display_sort_title($item['brief'],20);
		return $item;
	}
}
?>