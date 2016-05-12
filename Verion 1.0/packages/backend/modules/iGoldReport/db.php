<?php 
class iGoldReportDB
{
	static function get_total_item($cond)
	{
		return DB::fetch('
			select 
				count(*) as account
			from
				igold
			where 
				1=1 '.$cond.'		
					
		','account');
	}
	static function get_items($cond = '',$item_per_page=20)
	{
		$items = DB::fetch_all('
			select
				id,account_id,type,value,description,time
			from
				igold
			where	
				1=1 '.$cond.'
			order by 
				id desc
			limit
				'.((page_no()-1)*$item_per_page).','.$item_per_page.'		
		');
		foreach($items as $key=>$value){
			$color = '#999';
			$color = ($value['value']>=5 and $value['value']<10)?'#ff8000':(($value['value']>=10 and $value['value']<20)?'#ea3515':(($value['value']>=20)?'#F00':'#999'));
			$items[$key]['color'] = $color;
		}
		return $items;
	}
	static function get_top_igold(){
		$items = DB::fetch_all('
			select
				id,account_id,type,value,description,time
			from
				igold
			where	
				value > 0
				'.(Url::get('top_igold_date')?' AND (time>='.Date_Time::to_time(Url::get('top_igold_date')).' AND time<'.(Date_Time::to_time(Url::get('top_igold_date'))+24*3600).')':'').'
			order by 
				value DESC,time desc
			limit
				0,20
		');
		return $items;
	}
}
?>