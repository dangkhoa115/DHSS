<?php
class TopicNewsDB{
static function get_items($cond=1)
	{
		return DB::fetch_all('
			SELECT
				news.id,
				news.name_'.Portal::language().' as name,
				news.image_url,
				news.category_id,
				news.time,
				news.name_id
			FROM
				news
				inner join category on news.category_id=category.id
			WHERE
				'.$cond.'
			ORDER BY
				news.position,news.id desc
			LIMIT
				0,10
		');
	}
}
?>
