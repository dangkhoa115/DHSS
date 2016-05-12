<?php 
class ManageCommentDB
{
	function get_total_comment($table = 'news',$cond = '1')
	{
		return DB::fetch('
			SELECT
				count(*) as acount
			FROM
				comment
				inner join '.$table.' on '.$table.'.id=comment.item_id
			WHERE
				'.$cond.'
				and '.$table.'.portal_id="'.PORTAL_ID.'"			
		');
	}
	function get_comments($item_per_page,$table = 'news',$cond = '1')
	{
		$comments = DB::fetch_all('
			SELECT
				'.$table.'.id as item_id
				,'.$table.'.name_'.Portal::language().' as name
				,'.$table.'.name_id,
				'.$table.'.category_id
				,category.structure_id
				,comment.*				
			FROM
				comment
				inner join '.$table.' on '.$table.'.id=comment.item_id
				inner join category on category.id = '.$table.'.category_id
			WHERE
				'.$cond.' 
				and '.$table.'.portal_id="'.PORTAL_ID.'"
			ORDER BY
				comment.time desc
			limit '.((page_no()-1)*$item_per_page).','.$item_per_page.'				
		');
		return $comments;
	}
}
?>