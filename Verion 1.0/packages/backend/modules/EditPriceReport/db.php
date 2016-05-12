<?php 
class EditPriceReportDB
{
	function get_total_item($cond)
	{
		return DB::fetch('
			select 
				count(*) as account
			from
				(select
					log.id
				from
					log
					inner join hotel on log.hotel_id = hotel.id
					inner join zone on zone.id = hotel.zone_id
				where 
					log.portal_id="'.PORTAL_ID.'" '.$cond.'
				group by
					hotel.name,log.type,log.user_id,from_unixtime(log.time,"%d-%m-%Y")
				) as log
		','account');
	}
	function get_items($cond = '',$item_per_page=20)
	{
		return DB::fetch_all('
			select
				log.*, hotel.name as hotel_name, hotel.website, hotel.name_id, zone.name_id as zone_name_id
			from
				log
				inner join hotel on log.hotel_id = hotel.id
				inner join zone on zone.id = hotel.zone_id
			where	
				log.portal_id="'.PORTAL_ID.'" '.$cond.'
			group by
				hotel.name,log.type,log.user_id,from_unixtime(log.time,"%d-%m-%Y")
			order by 
				id desc	
			limit
				'.((page_no()-1)*$item_per_page).','.$item_per_page.'		
		');
	}
}
?>