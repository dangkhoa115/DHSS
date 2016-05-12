<?php
class PolicyAdminDB
{
	function get_total_item($cond)
	{
		return DB::fetch(
			'select 
				count(*) as acount 
			from 
				hotel
				inner join zone on zone.id = hotel.zone_id
			where 
				'.$cond
			,'acount');
	}
	function get_items($cond,$order_by,$item_per_page)
	{
		$items = DB::fetch_all('
			SELECT
				hotel.*,
				zone.name as zone_name
			FROM
				hotel
				inner join zone on zone.id = hotel.zone_id
			WHERE
				'.$cond.'
			ORDER BY
				'.$order_by.'
			LIMIT
				'.((page_no()-1)*$item_per_page).','.$item_per_page.'
		');
		return ($items);
	}	
	function get_zone()
	{
		return DB::fetch_all('
			SELECT
				id
				,name
				,structure_id
			FROM
				zone
			WHERE
				1
			ORDER BY
				structure_id	
		');
	}
}
?>
