<?php
class ListiGoldReportForm extends Form{
	function ListiGoldReportForm(){
		Form::Form('ListiGoldReportForm');
		$this->link_css('skins/default/css/cms.css');
		$this->link_js('skins/admin/scripts/datepicker.js');
		$this->link_css('skins/admin/css/datepicker.css');
	}
	function on_submit(){
		if(Url::get('cmd') == 'delete' and Url::get('selected_ids') and count(Url::get('selected_ids'))>0){
			foreach(Url::get('selected_ids') as $key=>$value){
				DB::delete_id('igold',$value);
			}	
			Url::redirect_current();
		}
	}
	function draw(){
		$cond = '';
		if(Url::get('from_date')){
			$cond .= ' and time >= '.Date_Time::to_time(Url::get('from_date'));
		}
		if(Url::get('to_date')){
			$cond .= ' and time < '.(Date_Time::to_time(Url::get('to_date')) + 24*3600);
		}
		if(Url::get('keyword')){
			$cond .= ' and (igold.description LIKE "%'.Url::get('keyword').'%" or igold.account_id LIKE "%'.Url::get('keyword').'%")';
		}
		if(Url::get('from_value')){
			$cond .= ' AND value >= "'.Url::get('from_value').'"';
		}
		if(Url::get('to_value')){
			$cond .= ' AND value <= "'.Url::get('to_value').'"';
		}
		if(Url::get('search_account_id')){
			$cond .= ' AND account_id ="'.Url::get('search_account_id').'"';
		}
		$total = iGoldReportDB::get_total_item($cond);
		require_once 'packages/core/includes/utils/paging.php';
		$item_per_page = 100;
		$paging = paging($total,$item_per_page,10,false,'page_no',array('from_date','to_date','keyword','search_account_id'));
		$items = iGoldReportDB::get_items($cond,$item_per_page);
		$this->parse_layout('list',array(
			'paging'=>$paging
			,'items'=>$items
			,'total'=>$total
			,'top_igolds'=>iGoldReportDB::get_top_igold()
			,'top_accounts'=>get_top_account_by_igold()
			,'top_paid_accounts'=>get_top_account_by_paid_igold()
		));
	}
}
?>