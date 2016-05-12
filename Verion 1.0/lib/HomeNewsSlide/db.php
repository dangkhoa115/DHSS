<?php
class HomeNewsSlideDB
{
	static function get_news($cond,$limit=9)
	{
		return DB::fetch_all('
			SELECT 
				news.id,
				news.name_'.Portal::language().' as name,news.brief_'.Portal::language().' as brief,news.image_url,news.small_thumb_url,news.status,news.name_id
			FROM
				news
			WHERE 
				'.$cond.'
			ORDER BY
				news.position desc,news.time desc
			LIMIT 
				0,'.$limit.'
		');
	}
}
?>