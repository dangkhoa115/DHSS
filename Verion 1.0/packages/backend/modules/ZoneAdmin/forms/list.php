<?php
class ListZoneAdminForm extends Form
{
	function ListZoneAdminForm()
	{
		Form::Form('ListZoneAdminForm');
		$this->link_css('skins/default/css/cms.css');
	}
	function on_submit()
	{
		if(Url::get('cmd')=='delete' and Url::get('selected_ids')){
			$this->deleted_selected_ids();
		}
	}
	function draw()
	{
		$this->get_just_edited_id();
		$this->get_select_condition();
		if(Url::get('city_id') and $zone = DB::fetch('select id,structure_id from zone where id='.intval(Url::get('city_id')))){
			$this->cond = ''.IDStructure::child_cond($zone['structure_id']).'';
			$check_flag = false;
		}else{
			$check_flag = true;
		}
		$this->get_items();
		$items = $this->items;
		//System::debug($items);
		//require_once 'cache/tables/countries.cache.php';
		$cities = DB::fetch_all('select id,name,type from zone where type=3 order by structure_id');
		$this->parse_layout('list',$this->just_edited_id+
			array(
				'items'=>$items,
				'check_flag'=>$check_flag,
				'city_id_list'=>array('0'=>Portal::language('select_city'))+String::get_list($cities,'name',' ')
			)
		);
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
	function deleted_selected_ids()
	{
		require_once 'detail.php';
		foreach(URL::get('selected_ids') as $id)
		{
			if($id and $category=DB::exists_id('zone',$id) and User::can_edit(false,$category['structure_id']))
			{
				save_recycle_bin('zone',$category);
				DB::delete_id('zone',$id);
				@unlink($category['image_url']);
				save_log($id);
			}	
			if($this->is_error())
			{
				return;
			}
		}
		Url::redirect_current(array('countries'));
	}
	function get_items()
	{
	   	require_once 'cache/config/zone_type.php';
		$this->items = DB::fetch_all('
			select 
				zone.id
				,zone.structure_id
				,zone.status 
				,zone.image_url 
				,zone.name
                ,zone.type
				,zone.description
				,zone.lat
				,zone.long
				,zone.flag
			from 
			 	zone
			where
				 '.$this->cond.'
			order by 
				zone.structure_id
		');
		require_once 'packages/core/includes/utils/category.php';
		category_indent($this->items);
		$i=0;
		foreach ($this->items as $key=>$value)
		{
            $this->items[$key]['type'] = $zone_type[$value['type']]; 
			$this->items[$key]['i']=$i++;
			if($value['level'] >= 3 ){
				unset($this->items[$key]);
			}
			if(!User::can_view(false,$value['structure_id']))
			{
				unset($this->items[$key]);
			}
		}
	}
	function get_select_condition()
	{
		$this->cond = '1 '.((URL::get('cmd')=='delete' and is_array(URL::get('selected_ids')))?' and zone.id in ("'.join(URL::get('selected_ids'),'","').'")':'');
	}
	
}
?>