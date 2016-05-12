<?php
class ListNewsAdminForm extends Form
{
	function ListNewsAdminForm()
	{
		Form::Form('ListNewsAdminForm');
		$this->link_css('skins/default/css/cms.css');
	}
	function save_position()
	{
		foreach($_REQUEST as $key=>$value)
		{			
			if(preg_match('/position_([0-9]+)/',$key,$match) and isset($match[1]))
			{
				DB::update_id('news',array('position'=>Url::get('position_'.$match[1])),$match[1]);
			}
		}
		Url::redirect_current();
	}
	function delete()
	{
		if(isset($_REQUEST['selected_ids']) and count($_REQUEST['selected_ids'])>0)
		{
			$selected_ids = implode(',',$_REQUEST['selected_ids']);
			$items = DB::fetch_all('select * from news where id in ('.$selected_ids.')');
			foreach($items as $key=>$item){
				save_recycle_bin('news',$item);
				@unlink($item['image_url']);
				@unlink($item['small_thumb_url']);
				save_log($key);
			}
			DB::delete('news','id in ('.$selected_ids.')');
			
			/*foreach($_REQUEST['selected_ids'] as $key)
			{
				if($item = DB::exists_id('news',$key))
				{
					save_recycle_bin('news',$item);
					DB::delete_id('news',intval($key));
					@unlink($item['image_url']);
					@unlink($item['small_thumb_url']);
					save_log($key);
				}	
			}*/
		}	
		Url::redirect_current();
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
		$cond = '1 and news.type="NEWS"';
		$cond.=$this->get_condition();
		$this->get_just_edited_id();
		require_once 'packages/core/includes/utils/paging.php';
		require_once 'cache/config/status.php';
		$item_per_page = Url::get('item_per_page',20);
		$total = NewsAdminDB::get_total_item($cond);
		$paging = paging($total,$item_per_page,10,false,'page_no',array('cmd','type','category_id'));
		$order_by = ''.(Url::get('order_by')?Url::get('order_by'):'news.id').' '.(Url::get('dir')?Url::get('dir'):'DESC').'';
		$items = NewsAdminDB::get_items($cond,$order_by,$item_per_page);		
		$item_per_page_list = array(20=>20,30=>30,50=>50,100=>100);
		$this->parse_layout('list',$this->just_edited_id+array(
			'items'=>$items,
			'paging'=>$paging,
			'total'=>$total,
			'category_id_list'=>array(Portal::language('select_category'))+String::get_list(NewsAdminDB::get_category()),
			'status_list'=>array(Portal::language('select_status'))+$status,
			'search_user_id_list'=>array(Portal::language('select_user'))+String::get_list(NewsAdminDB::get_user()),
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
		if(Url::get('category_id') and DB::exists_id('category',intval(Url::sget('category_id'))))
		{
			$cond.= ' and '.IDStructure::child_cond(DB::structure_id('category',intval(Url::sget('category_id'))));
		}
		if(Url::get('status'))
		{
			$cond.= ' and news.status="'.Url::get('status').'"';
		}
		if(Url::get('search_user_id'))
		{
			$cond.= ' and news.user_id="'.Url::get('search_user_id').'"';
		}
		if(Url::get('search'))
		{
			$cond .= URL::get('search')? ' AND ((news.name_1) LIKE "%'.addslashes(URL::sget('search')).'%")':'';
		}
		if(Session::get('doc_gia')==1)
		{
			$cond.= ' and news.author <> ""';
		}else{
			$cond.= ' and news.author = ""';
		}
		return $cond;
	}
}
?>
