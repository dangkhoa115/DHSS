<?php
class ListEditPriceReportForm extends Form
{
	function ListEditPriceReportForm()
	{
		Form::Form('ListEditPriceReportForm');
		$this->link_js(Portal::template_js('core').'jquery/datepicker.js');
		$this->link_css('skins/default/css/cms.css');
		$this->link_css('skins/default/css/jquery/datepicker.css');		
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
		$cond = ' and log.module_id = 72310 and log.hotel_id != 0';
		if(Url::get('from_date'))
		{
			$cond .= ' and log.time >='.Date_Time::to_time(Url::get('from_date'));
		}
		if(Url::get('to_date'))
		{
			$cond .= ' and log.time <='.Date_Time::to_time(Url::get('to_date'));
		}
		$total = EditPriceReportDB::get_total_item($cond);
		require_once 'packages/core/includes/utils/paging.php';
		$item_per_page = 50;
		$paging = paging($total,$item_per_page,10);
		$items = EditPriceReportDB::get_items($cond,$item_per_page);
		//System::debug($items);
		$this->parse_layout('list',array(
			'paging'=>$paging
			,'items'=>$items
			,'total'=>$total
		));
	}
}
?>