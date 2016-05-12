<?php 
class Family{
	public static function get_relationship($mem_id,$type){
		$sql = '
			SELECT
				rs.id,rs.first_name,rs.middle_name,rs.surname,rs.gender,rs.birth_date,rs.death_date
			FROM
				family_member AS rs
				INNER JOIN family_relationship AS fr ON fr.partner_id = rs.id
			WHERE
				fr.member_id = '.$mem_id.' 
				AND fr.type = "'.$type.'"
		';
		return DB::fetch($sql);
	}
	public static function get_members($from_id=false){
		$sql = '
			SELECT
				rs.*
			FROM
				family_member AS rs
			WHERE
				1 = 1
		';
		$items = DB::fetch_all($sql);
		return $items;
	}
	public static function child_cond($mem_id){//get all children
		
	}
}
?>