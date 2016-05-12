<?php
class SendEmailDB
{
	function get_total_item($cond)
	{
		$sql = '
			SELECT
				count(distinct party.id) as acount
			FROM
				`account`
				inner join `party` on `party`.user_id=`account`.id and `account`.`type`="USER"
				left outer join `zone` on `zone`.id=`party`.`zone_id` 
				left outer join ssnh_nguoi_choi on ssnh_nguoi_choi.account_id = account.id
			WHERE
				'.$cond.' and account.type="USER"' 
		;	
		return DB::fetch($sql,'acount');
	}
	function get_items($cond,$order_by,$item_per_page)
	{
		$sql = '
			select 
				`account`.id
				,`account`.from_web				
				,`account`.`password` ,
				`party`.`email` ,
				`party`.full_name ,
				IF(`party`.`birth_date`<>"0000-00-00",DATE_FORMAT(`party`.`birth_date`,"%d/%m/%Y"),"") as birth_date ,
				`party`.`address` ,
				IF(`account`.`create_date`<>"0000-00-00",DATE_FORMAT(`account`.`create_date`,"%d/%m/%Y"),"") as create_date ,
				`party`.`phone` as `phone_number`
				,IF(`party`.`gender`=1, "Male","Female") as gender
				,IF(`account`.`is_block`=1,"Yes","No") as block
				,`zone`.name as zone_name
				,account.is_active
				,account.is_block
				,round(account.igold) as igold
				,ssnh_nguoi_choi.id as nguoi_choi_id
				,ssnh_nguoi_choi.cmtnd
				,party.kind
				,party.time
			from 
			 	`account`
				inner join `party` on `party`.user_id=`account`.id and `account`.`type`="USER"
				left outer join `zone` on `zone`.id=`party`.`zone_id` 
				left outer join ssnh_nguoi_choi on ssnh_nguoi_choi.account_id = account.id
			where 
				'.$cond.'
			'.(URL::get('order_by')?'order by '.URL::get('order_by').(URL::get('order_dir')?' '.URL::get('order_dir'):''):'order by party.id desc').'
			limit '.((page_no()-1)*$item_per_page).','.$item_per_page.'
		';
		$items = DB::fetch_all($sql);
		$i = 0;
		foreach($items as $key=>$value){
			$items[$key]['i'] = $i + (page_no() - 1)*$item_per_page;
			$i++;
		}
		return $items;
	}
	function get_all_item($cond='1'){
		return DB::fetch_all('
	        SELECT
				party.id,
				account.create_date,
				party.full_name,
				party.email,
				party.address,
				party.type,
				zone.name as zone
			FROM
				account
                INNER JOIN party on account.id = party.user_id
				LEFT OUTER join zone on party.zone_id = zone.id
			WHERE '
				.$cond.'
				and email!=""
			'
		);
	}
	function get_template($id){
		return DB::fetch('
			SELECT
				*
			FROM
				template_email
			WHERE
				id='.$id.'
			order by
				template_email.name
		');
	}
	function get_templates($cond='1'){
		return DB::fetch_all('
			SELECT
				id,name
			FROM
				template_email
			WHERE '
			.$cond
		);
	}
	function get_zone($cond=1){
		return DB::fetch_all('
			SELECT
				id
				,name_'.Portal::language().' as name
			FROM
				zone
			WHERE '
				.IDstructure::direct_child_cond(ID_ROOT).'
			ORDER BY
				name'
		);
	}
}
?>
