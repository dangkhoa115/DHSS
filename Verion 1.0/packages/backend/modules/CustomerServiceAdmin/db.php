<?php
class CustomerServiceAdminDB
{
	function get_total_item($cond)
	{
		return DB::fetch(
			'select 
				count(*) as acount 
			from 
				customer_service
				inner join zone on customer_service.zone_id = zone.id
			where 
				'.$cond.'
				'
			,'acount');
	}
	function get_items($cond,$order_by,$item_per_page)
	{
		return DB::fetch_all('
			SELECT
				customer_service.id,
				customer_service.name,
				customer_service.brief,
				customer_service.phone,
				customer_service.image_url,
				zone.name as zone_name,
				customer_service.type
			FROM
				customer_service
				inner join zone on customer_service.zone_id = zone.id
			WHERE
				'.$cond.'
			ORDER BY
				'.$order_by.'
			LIMIT
				'.((page_no()-1)*$item_per_page).','.$item_per_page.'
		');
	}		
}
?>
