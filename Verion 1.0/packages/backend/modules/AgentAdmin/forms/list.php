<?php
class ListAgentAdminForm extends Form
{
	function ListAgentAdminForm()
	{
		Form::Form('ListAgentAdminForm');
		$this->link_css('skins/default/css/cms.css');
	}
	function on_submit()
	{
		if(URL::get('confirm'))
		{
			foreach(URL::get('selected_ids') as $id)
			{
				DB::delete('party','user_id = "'.$id.'" and type="AGENT"');	
				DB::delete_id('account',$id);			
			}
			require_once 'packages/core/includes/system/update_privilege.php';
			make_privilege_cache();
			Url::redirect_current();
		}
	}
	function draw()
	{
		$selected_ids="";
		if(URL::get('selected_ids'))
		{
			$selected_ids=URL::get('selected_ids');
			foreach($selected_ids as $key=>$selected_id)
			{
				$selected_ids[$key]='"'.$selected_id.'"';
			}
		}
		$cond = '
				1  and party.type="AGENT"'
				.((URL::get('cmd')=='delete' and is_array(URL::get('selected_ids')))?' and `account`.id in ("'.join(URL::get('selected_ids'),'","').'")':'')
				.(Url::get('user_id')?' and account.id like CONVERT( _utf8 "%'.addslashes(Url::get('user_id')).'%" USING latin1)':'')
		;
		$item_per_page = 100;
		DB::query('
			select count(*) as acount
			from 
				`account`
				inner join `party` on `party`.user_id=`account`.id and `account`.`type`="USER"
				left outer join tour on tour.agent_id  = account.id
				left outer join `zone` on `zone`.id=`party`.`zone_id`
			where 
				'.$cond.'
			'.(URL::get('order_by')?'order by '.URL::get('order_by').(URL::get('order_dir')?' '.URL::get('order_dir'):''):'').'
			limit 0,1
		');
		$count = DB::fetch();
		require_once 'packages/core/includes/utils/paging.php';
		$paging = paging($count['acount'],$item_per_page);
		DB::query('
			select 
				`account`.id
				,`account`.`password` ,`account`.`is_active`,
				`party`.`email` ,
				`party`.full_name ,
				IF(`party`.`birth_date`<>"0000-00-00",DATE_FORMAT(`party`.`birth_date`,"%d/%m/%Y"),"") as birth_date ,
				`party`.`address` ,
				IF(`account`.`create_date`<>"0000-00-00",DATE_FORMAT(`account`.`create_date`,"%d/%m/%Y"),"") as create_date ,
				`party`.`phone` as `phone_number` 
				,`zone`.name as zone_name 
			from 
			 	`account`
				inner join `party` on `party`.user_id=`account`.id and `account`.`type`="USER"
				left outer join tour on tour.agent_id  = account.id
				left outer join `zone` on `zone`.id=`party`.`zone_id` 				
			where 
				'.$cond.'
			'.(URL::get('order_by')?'order by '.URL::get('order_by').(URL::get('order_dir')?' '.URL::get('order_dir'):''):'order by account.create_date desc').'
			limit '.((page_no()-1)*$item_per_page).','.$item_per_page.'
		');
		$items = DB::fetch_all();
		$i=1;
		foreach ($items as $key=>$value)
		{
			$items[$key]['i']=$i++;
		}
		$just_edited_id['just_edited_ids'] = array();
		if (UrL::get('selected_ids'))
		{
			if(is_string(UrL::get('selected_ids')))
			{
				if (strstr(UrL::get('selected_ids'),','))
				{
					$just_edited_id['just_edited_ids']=explode(',',UrL::get('selected_ids'));
				}
				else
				{
					$just_edited_id['just_edited_ids']=array('0'=>UrL::get('selected_ids'));
				}
			}
		}
		$this->parse_layout('list',$just_edited_id+
			array(
				'items'=>$items,
				'paging'=>$paging,
			)
		);
	}
}
?>
