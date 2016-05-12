<?php
class MenuHomeDB{
	static function get_hotel_menu($cond){
		return DB::fetch_all('
			SELECT
				id,name_'.Portal::language().' as name,url,icon_url,status
			FROM
				function
			WHERE
				'.$cond.'
			ORDER BY
				structure_id
		');
	}
}
?>
