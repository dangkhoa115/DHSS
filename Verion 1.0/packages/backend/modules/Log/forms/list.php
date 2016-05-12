<?php
class ListLogForm extends Form
{
	function ListLogForm()
	{
		Form::Form('ListLogForm');
		$this->link_css('skins/default/css/cms.css');
	}
	function on_submit()
	{
		if(Url::get('cmd') == 'delete' and Url::get('selected_ids') and count(Url::get('selected_ids'))>0)
		{
			foreach(Url::get('selected_ids') as $key=>$value)
			{
				DB::delete_id('log',$value);
			}	
			Url::redirect_current();
		}
	}
	function draw()
	{
		$cond = '';
		if(Url::get('from_date'))
		{
			$cond .= ' and time >='.Date_Time::to_time(Url::get('from_date'));
		}
		if(Url::get('to_date'))
		{
			$cond .= ' and time <='.Date_Time::to_time(Url::get('to_date'));
		}
		if(Url::get('keyword'))
		{
			$cond .= ' and (log.description LIKE "%'.Url::get('keyword').'%" or log.user_id LIKE "%'.Url::get('keyword').'%")';
		}
		if(!User::can_admin(false,ANY_CATEGORY)){
			if(Session::get('hotel_id')){
				$cond .= ' AND hotel_id = '.Session::get('hotel_id').'';
			}else{
				$cond .= '1=2';
			}
		}
		$total = LogDB::get_total_item($cond);
		require_once 'packages/core/includes/utils/paging.php';
		$item_per_page = 50;
		$paging = paging($total,$item_per_page,10,false,'Trang',array('from_date','to_date','keyword'));
		$items = LogDB::get_items($cond,$item_per_page);
		$this->parse_layout('list',array(
			'paging'=>$paging
			,'items'=>$items
			,'total'=>$total
		));
	}
}
?>