<?php 
class LogDB
{
	static function get_total_item($cond)
	{
		return DB::fetch('
			select 
				count(*) as account
			from
				log
			where 
				1 
				and  portal_id="'.PORTAL_ID.'" '.$cond.'		
					
		','account');
	}
	static function get_items($cond = '',$item_per_page=20)
	{
		return DB::fetch_all('
			select
				*
			from
				log
			where	
				1 
				and  portal_id="'.PORTAL_ID.'" '.$cond.'
			order by 
				id desc	
			limit
				'.((page_no()-1)*$item_per_page).','.$item_per_page.'		
		');
	}
}
?>