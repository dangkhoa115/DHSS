<?php
class ListCustomerServiceAdminForm extends Form
{
	function ListCustomerServiceAdminForm()
	{
		Form::Form('ListCustomerServiceAdminForm');
		$this->link_css('skins/default/css/cms.css');
	}
	function delete()
	{
		if(isset($_REQUEST['selected_ids']) and count($_REQUEST['selected_ids'])>0)
		{
			foreach($_REQUEST['selected_ids'] as $key)
			{
				if($item = DB::exists_id('customer_service',$key))
				{
					DB::delete_id('customer_service',intval($key));
					@unlink($item['image_url']);
				}	
			}
		}	
		Url::redirect_current();
	}	
	function on_submit()
	{
		switch(Url::get('cmd'))
		{
			case 'delete':
				$this->delete();	
				break;			
		}		
	}
	function draw()
	{
		$cond = '1';
		$cond.=$this->get_condition();
		$this->get_just_edited_id();
		require_once 'packages/core/includes/utils/paging.php';
		$item_per_page = Url::get('item_per_page',20);
		$total = CustomerServiceAdminDB::get_total_item($cond);
		$paging = paging($total,$item_per_page,10,false,'page_no');
		$items = CustomerServiceAdminDB::get_items($cond,'customer_service.id DESC',$item_per_page);
		$item_per_page_list = array(20=>20,30=>30,50=>50,100=>100);
		$this->parse_layout('list',$this->just_edited_id+array(
			'items'=>$items,
			'paging'=>$paging,
			'total'=>$total,
			'item_per_page_list'=>$item_per_page_list
		));
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
		if(Url::get('search'))
		{
			$cond .= URL::get('search')? ' AND ((customer_service.name) LIKE "%'.addslashes(URL::sget('search')).'%")':'';
		}
		return $cond;
	}
}
?>
