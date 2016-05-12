<?php 
class ManageAgentDB
{
	static function get_agents($cond)
	{
		return DB::fetch_all('
			SELECT
				account.id ,party.address, party.name_1 as name, zone.name_1 as city
			FROM
				account
				inner join party on account.id = party.user_id
				inner join zone on zone.id = party.zone_id
			WHERE
				'.$cond.'
			LIMIT
				0,10
		');
	}
	static function get_agent($cond)
	{
		return DB::fetch('
			SELECT
				account.id, party.name_1 as name , party.email, party.phone, party.address, fax, 
				account.is_active as active, party.website, party.user_id as account, party.image_url as logo,
				party.description_1 as description, party.zone_id as city, zone.name_1 as city_name
			FROM
				account
				inner join party on account.id = party.user_id
				inner join zone on party.zone_id = zone.id
			WHERE
				'.$cond.'
				and portal_id = "'.PORTAL_ID.'"
		');
	}
}
?>