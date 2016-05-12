<?php
class FmgBxhDB{
    function get_field_category($cond=' 1',$field='id'){
        return DB::fetch('SELECT * FROM category WHERE '.$cond,$field);
    }
	static function get_item($cond)
	{
		return DB::fetch('
			SELECT
				news.id,
				news.name_'.Portal::language().' as name,
				news.brief_'.Portal::language().' as brief,
				news.description_'.Portal::language().' as description,
				news.image_url,
				news.category_id,
				news.file,
				news.time,
        news.name_id,
				news.hitcount
			FROM
				news
			WHERE
				'.$cond.'
		');
	}
	static function get_items($cond=1)
	{
		return DB::fetch_all('
			SELECT
				news.id,
				news.name_'.Portal::language().' as name,
				news.brief_'.Portal::language().' as brief,
				news.description_'.Portal::language().' as description,
				news.image_url,
				news.category_id,
				news.time,
				news.file,
				news.name_id,
				category.name_id as category_name
			FROM
				news
				inner join category on news.category_id=category.id
			WHERE
				'.$cond.'
			ORDER BY
				news.position desc,news.id desc
			LIMIT
				0,10
		');
	}
	static function get_category($cond){
		return DB::fetch('
			SELECT
				news.id,news.name_id,category.id as category_id,category.name_'.Portal::language().' as category_name,category.name_id as category_name_id
			FROM
				news
				INNER JOIN category ON item.category_id=category.id
			WHERE
				'.$cond.'
		');
	}
	function get_news($cond)
	{
		$items = DB::fetch_all('
			SELECT
				news.id
        ,news.name_id
				,news.publish
				,news.front_page
				,news.status
				,news.position
				,news.user_id
				,news.image_url
				,news.small_thumb_url
				,news.time
				,news.hitcount
				,news.name_'.Portal::language().' as name
				,news.brief_'.Portal::language().' as brief
				,news.description_'.Portal::language().' as description
				,category.name_'.Portal::language().' as category_name
				,category.structure_id
			FROM
				news
				left outer join category on category.id = news.category_id
			WHERE
				'.$cond.'
      ORDER BY 
			 news.position DESC,news.id DESC
      LIMIT
				0,8
		');
		return ($items);
	}
	function update_news_comment($news_id){
		$arr = array(
			'news_id'=>$news_id,
			'full_name',
			'email',
			'content',
			'time'=>time(),
		);
		DB::insert('news_comment',$arr);
	}
}
?>
