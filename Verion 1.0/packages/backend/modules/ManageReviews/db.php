<?php 
class ManageReviewsDB
{
	function get_total_review($cond = '1')
	{
		return DB::fetch('
			SELECT
				count(*) as acount
			FROM
				hotel_review
				inner join hotel on hotel.id=hotel_review.hotel_id
				inner join booking on booking.id = hotel_review.booking_id
				inner join zone on zone.id = hotel.zone_id
				inner join zone as country on country.id = booking.country_id
			WHERE
				'.$cond.'
		');
	}
	function get_reviews($item_per_page,$cond = '1',$order='')
	{
		$sql = '
			SELECT
				hotel_review.*,
				hotel.name as hotel_name,
				hotel.id as hotel_id,
				booking.full_name,
				zone.name as zone,
				country.image_url
			FROM
				hotel_review
				inner join hotel on hotel.id=hotel_review.hotel_id
				inner join zone on hotel.zone_id = zone.id
				inner join booking on booking.id = hotel_review.booking_id
				inner join zone as country on country.id = booking.country_id
			WHERE
				'.$cond.'
			'.$order.'
			limit '.((page_no()-1)*$item_per_page).','.$item_per_page.'				
		';
		return DB::fetch_all($sql);
	}
}
?>