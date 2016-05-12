<?php
class ContentAdminDB
{
	function get_total_item($cond)
	{
		return DB::fetch(
			'select 
				count(*) as acount 
			from 
				news
				inner join category on category.id = news.category_id
			where 
				'.$cond.'
				and news.portal_id="'.PORTAL_ID.'"
				'
			,'acount');
	}
	function get_items($cond,$order_by,$item_per_page)
	{
		return DB::fetch_all('
			SELECT
				news.id
				,news.status
				,news.position
				,news.user_id
				,news.time
				,news.hitcount
				,news.file
				,news.name_'.Portal::language().' as name
				,category.name_'.Portal::language().' as category_name
			FROM
				news
				INNER JOIN category ON news.category_id=category.id
			WHERE
				'.$cond.'
				and news.portal_id="'.PORTAL_ID.'"
			ORDER BY
				'.$order_by.'
			LIMIT
				'.((page_no()-1)*$item_per_page).','.$item_per_page.'
		');
	}	
	function get_category()
	{
		return DB::fetch_all('
			SELECT
				id
				,name_'.Portal::language().' as name
				,structure_id
			FROM
				category
			WHERE
				category.type="CONTENT"
				and category.portal_id="'.PORTAL_ID.'"	
			ORDER BY structure_id		
		');
	}
	function get_user()
	{
		return DB::fetch_all('
			SELECT 
				distinct user_id as name
				,user_id as id 
			FROM
				news	
			WHERE
				user_id!=""				
		');
	}
}
?>
