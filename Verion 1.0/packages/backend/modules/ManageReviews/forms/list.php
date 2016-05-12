<?php
class ManageReviewsForm extends Form
{
	function ManageReviewsForm()
	{
		Form::Form('ManageReviewsForm');
		$this->link_css('skins/default/css/cms.css');
	}
	function on_submit()
	{
	}
	function draw()
	{
		$cond = $this->get_cond();
		$item_per_page = 100;
		$order = Url::get('publish')=='down'?'order by hotel_review.status desc,hotel_review.time desc':'order by hotel_review.status, hotel_review.time desc';
		$count = ManageReviewsDB::get_total_review($cond);
		require_once 'packages/core/includes/utils/paging.php';
		$this->map['paging'] = paging($count['acount'],$item_per_page);
		$this->map['reviews'] = ManageReviewsDB::get_reviews($item_per_page,$cond,$order);
		require_once 'cache/tables/countries.cache.php';
		$this->map['countries_list'] = array(0=>'Select Country')+String::get_list($countries,'name',' ');
		$this->parse_layout('list',$this->map);
	}
	function get_cond()
	{
		$cond = '1';
		if(!User::can_admin(false,ANY_CATEGORY) and Session::is_set('hotel_id'))
		{
			$cond .= ' and hotel_review.hotel_id ='.Session::get('hotel_id');
			if($zone_id = Url::get('zone_id'))
			{
				$cond .= ' and '.IDStructure::child_cond(DB::structure_id('zone',$zone_id),false,'country.');
			}elseif($zone_id = Url::get('countries'))
			{
				$cond .= ' and '.IDStructure::child_cond(DB::structure_id('zone',$zone_id),false,'country.');
			}
		}elseif(User::can_admin(false,ANY_CATEGORY))
		{
			$cond .= Url::get('hotel_id')?' and hotel_review.hotel_id ='. intval(Url::get('hotel_id')):'';
			if($zone_id = Url::get('zone_id'))
			{
				$cond .= ' and '.IDStructure::child_cond(DB::structure_id('zone',$zone_id),false,'zone.');
			}elseif($zone_id = Url::get('countries'))
			{
				$cond .= ' and '.IDStructure::child_cond(DB::structure_id('zone',$zone_id),false,'zone.');
			}
			if($name = Url::get('hotel_name'))
			{
				$cond .= ' and hotel.name like "%'.$name.'%"';
			}
		}
		return $cond;
	}
}
?>