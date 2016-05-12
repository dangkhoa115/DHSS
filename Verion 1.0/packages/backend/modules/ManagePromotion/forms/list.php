<?php
class ListManagePromotionForm extends Form
{
	function ListManagePromotionForm()
	{
		Form::Form('ListManagePromotionForm');
		$this->link_css('skins/default/css/cms.css');
	}
	function on_submit()
	{
		switch(Url::get('cmd'))
		{
			case 'update_position':
				$this->save_position();
				break;
			case 'delete':
				$this->delete();
				break;
		}
	}
	function draw()
	{
		$cond = '1=1';
		$cond.=$this->get_condition();
		$this->get_just_edited_id();
		require_once 'packages/core/includes/utils/paging.php';
		$item_per_page = 100;
		$total = ManagePromotionDB::get_total_item($cond);
		$paging = paging($total,$item_per_page,10,false,'page_no',array('cmd'));
		$items = ManagePromotionDB::get_items($cond,$item_per_page);
		$item_per_page_list = array(20=>20,30=>30,50=>50,100=>100);
		$accounts = DB::select_all('account','account.id="maiphuong" or account.id="ngocthuy"');
		$this->parse_layout('list',$this->just_edited_id+array(
			'passed_list'=>array('2'=>Portal::language('all_passed'),0=>Portal::language('not_passed'),1=>Portal::language('passed')),
			'items'=>$items,
			'paging'=>$paging,
			'total'=>$total,
			'item_per_page_list'=>$item_per_page_list
		));
	}
	function save_position()
	{
		foreach($_REQUEST as $key=>$value)
		{
			if(preg_match('/position_([0-9]+)/',$key,$match) and isset($match[1]))
			{
				DB::update_id('promotion',array('position'=>Url::get('position_'.$match[1])),$match[1]);
			}
		}
		Url::redirect_current();
	}
	function delete()
	{
		if(isset($_REQUEST['selected_ids']) and count($_REQUEST['selected_ids'])>0)
		{
			$selected_ids = implode(',',$_REQUEST['selected_ids']);
			if($items = DB::fetch_all('SELECT * FROM promotion WHERE id IN ('.$selected_ids.')')){
				foreach($items as $key=>$item){
					DB::delete('promotion','id in ('.$selected_ids.')');
				}
			}
		}
		Url::redirect_current();
	}
	function get_just_edited_id()
	{
		$this->just_edited_id['just_edited_ids'] = array();
		if (UrL::get('selected_ids'))
		{
			if(is_string(UrL::get('selected_ids')))
			{
				if (strstr(UrL::get('selected_ids'),','))
				{
					$this->just_edited_id['just_edited_ids']=explode(',',UrL::get('selected_ids'));
				}
				else
				{
					$this->just_edited_id['just_edited_ids']=array('0'=>UrL::get('selected_ids'));
				}
			}
		}
	}
	function get_condition()
	{
		$cond = '';
		if(Url::get('search')){
			$cond .= URL::get('search')? ' AND (promotion.description LIKE "%'.addslashes(URL::sget('search')).'%" or item_model.name LIKE "%'.addslashes(URL::sget('search')).'%" or item_maker.name LIKE "%'.addslashes(URL::sget('search')).'%")':'';
		}
		return $cond;
	}
}
?>
