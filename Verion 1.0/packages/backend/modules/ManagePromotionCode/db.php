<?php
class ManagePromotionCodeDB
{
	function get_total_item($cond)
	{
		return DB::fetch(
			'select
				count(*) as acount
			from
				promotion_code
			where
				'.$cond.'
				'
			,'acount');
	}
	function get_items($cond,$item_per_page)
	{
		$items = DB::fetch_all('
			SELECT
				promotion_code.id
				,promotion_code.type
				,promotion_code.value
				,promotion_code.start_date
				,promotion_code.end_date
				,promotion_code.rand_code
			FROM
				promotion_code
			WHERE
				'.$cond.'
			ORDER BY
				id desc
			LIMIT
				'.((page_no()-1)*$item_per_page).','.$item_per_page.'
		');
		$i = 1;
		foreach($items as $key =>$value)
		{
			$value['index'] = $i++;
			$value['start_date'] = Date_Time::to_common_date($value['start_date']);
			$value['end_date'] = Date_Time::to_common_date($value['end_date']);
			if(Date_Time::to_time($value['end_date']) < time()){
				$value['passed_label'] = Portal::language('expired');
				$value['passed_label_color'] = 'bgcolor="#BBBBBB"';
			}else{
				$value['passed_label'] = '';
				$value['passed_label_color'] = '';
			}
			$items[$key] = $value;
		}
		return ($items);
	}
	function get_promotion($id)
	{
		return DB::fetch('
			SELECT
				promotion_code.*
			FROM
				promotion_code
			WHERE
				promotion_code.id = '.intval($id).'
		');
	}
}
?>
