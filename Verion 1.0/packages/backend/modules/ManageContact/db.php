<?php 
class ManageContactDB
{
	static function get_total($cond = '1')
	{
		return DB::fetch('
			SELECT
				count(*) as acount
			FROM
				contact
				left outer join zone on contact.zone_id = zone.id
			WHERE
				'.$cond.'
				and contact.portal_id="'.PORTAL_ID.'"			
		');
	}
	static function get_items($item_per_page,$cond = '1')
	{
		return DB::fetch_all('
			SELECT
				contact.*
			FROM
				contact
				left outer join zone on contact.zone_id = zone.id
			WHERE
				'.$cond.' 
				and contact.portal_id="'.PORTAL_ID.'"
			ORDER BY
				contact.time desc
			limit '.((page_no()-1)*$item_per_page).','.$item_per_page.'				
		');
	}
	static function get_item()
	{
		return DB::fetch('
			SELECT
				contact.*
			FROM
				contact
				left outer join zone on contact.zone_id = zone.id
			WHERE
				contact.id='.intval(Url::sget('id')).' 
				and contact.portal_id="'.PORTAL_ID.'"
			');
	}
}
?>