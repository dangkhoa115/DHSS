<?php
class NewsListDB
{
	static function get_items($cond,$item_per_page)
	{
		return DB::fetch_all('
			SELECT
				news.id,
				news.name_'.Portal::language().' as name,
				news.brief_'.Portal::language().' as brief,
				news.image_url,
				news.small_thumb_url,
				news.time,
				news.category_id,
				news.name_id,
				news.show_time,
				news.pdf_icon,
				news.print_icon,
				news.email_icon,
				news.author,
				news.show_author,
				news.show_comment,
				news.front_page,
				news.hitcount,
				news.parent_id,
				news.meta,
				news.file,
				news.rating,
				party.name_1 as user
			FROM
				news
				inner join category on category.id = news.category_id
				inner join party on news.user_id = party.user_id
			WHERE
				'.$cond.'				
			ORDER BY
				news.id desc
			LIMIT
				'.((page_no()-1)*$item_per_page).','.$item_per_page.'
		');
	}
	static function get_total_item($cond)
	{
		return DB::fetch('
			SELECT
				count(*) as acount
			FROM
				news
				inner join category on category.id = news.category_id
			WHERE
				'.$cond.'				
		');
	}
}
?>