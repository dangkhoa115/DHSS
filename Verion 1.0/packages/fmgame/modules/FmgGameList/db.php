<?php
class FmgGameListDB
{
	static function get_total_item($cond)
	{
		return DB::fetch(
			'select 
				count(*) as acount 
			from 
				game 
				left outer join category on game.category_id=category.id
			where 
				'.$cond.'
				and game.portal_id="'.PORTAL_ID.'"
				'
			,'acount');
	}
	static function get_items($cond,$order_by,$item_per_page)
	{
		$items = DB::fetch_all('
			SELECT
				game.id
				,game.name_id
				,game.publish
				,game.front_page
				,game.status
				,game.position
				,game.user_id
				,game.image_url
				,game.small_thumb_url
				,game.time
				,game.hitcount
				,game.name_'.Portal::language().' as name
				,game.brief_'.Portal::language().' as brief
				,game.description_1
				,category.name_'.Portal::language().' as category_name
				,category.structure_id
				,category.name_id as category_name_id
			FROM
				game
				left outer join category on category.id = game.category_id
			WHERE
				'.$cond.'
				and game.portal_id="'.PORTAL_ID.'"
			ORDER BY
				'.$order_by.'
			LIMIT
				'.((page_no()-1)*$item_per_page).','.$item_per_page.'
		');
		$comments = DB::fetch_all(
			'SELECT
				count(*) as total_comment
				,game.id as id
			 FROM
				comment
				inner join game on comment.item_id = game.id
			WHERE 
				1 and comment.type="GAME"
			GROUP BY
				comment.item_id					
			');
		$i = 1;	
		foreach($items as $key =>$value)
		{		
			$value['index'] = $i++;	
			if(isset($comments[$key]))
			{
				$value['total_comment'] = $comments[$key]['total_comment'];
			}
			else
			{
				$value['total_comment'] = 0;
			}
			$items[$key] = $value;
		}
		return ($items);
	}	
	static function get_category()
	{
		return DB::fetch_all('
			SELECT
				id
				,name_'.Portal::language().' as name
				,structure_id
			FROM
				category
			WHERE
				category.type="GAME"
			ORDER BY
				structure_id	
		');
	}
	static function get_user()
	{
		return DB::fetch_all('
			SELECT 
				distinct user_id as name
				,user_id as id 
			FROM
				game	
			WHERE
				user_id!=""				
		');
	}
}
?>
