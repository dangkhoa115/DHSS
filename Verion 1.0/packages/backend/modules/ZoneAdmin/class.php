<?php 
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class ZoneAdmin extends Module
{
	function ZoneAdmin($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view(false,ANY_CATEGORY))
		{
			switch(URL::get('cmd'))
			{			
				case 'cache':
					$this->export_cache();
					break;
				case 'get_zone_id':
					$this->get_zone(intval(Url::get('zone_id')));
					exit();
				case 'delete':				
					$this->delete_cmd();
					break;
				case 'edit':				
					$this->edit_cmd();
					break;
				case 'unlink':
					$this->delete_file();		
				case 'add':				
					$this->add_cmd();
					break;
				case 'view':
					$this->view_cmd();
					break;
				case 'move_up':
				case 'move_down':
					$this->move_cmd();
					break;
				default: 
					$this->list_cmd();
					break;
			}
		}
		else
		{
			URL::access_denied();
		}
	}	
	function get_zone($id)
	{
		if(Url::get('zone_id') and $zone=DB::select_id('zone',intval(Url::get('zone_id')))){
			$region_cond = '(area.area_type_id in (0,4,6)) and area.zone_id='.$zone['id'];
		}
		$zone['zoom'] = $this->zoom($zone['structure_id']);
		echo 'var lat='.$zone['lat'].'; var long='.$zone['long'].'; var zoom='.$zone['zoom'].'; var arr = '.String::array2js(String::get_list(ZoneAdminDB::get_regions($region_cond))).';';
	}
	function export_cache()
	{
		$zones = DB::fetch_all('
			SELECT
				id,name,name_id,
				structure_id
			FROM
				zone
			WHERE
				portal_id="'.PORTAL_ID.'" 
				and '.IDstructure::direct_child_cond(ID_ROOT).'
				and status != "HIDE"
			ORDER BY
				structure_id'
		);
		$temp_zones = $zones;	
		foreach($zones as $key=>$value)
		{
			$zones[$key]['countries'] = $this->get_zone_child($value['structure_id']);
		}
		foreach($temp_zones as $key=>$value)
		{
			$temp_zones[$key]['zone'] = $this->get_zone_child($value['structure_id'],' LIMIT 0,10');
		}
		$items = DB::fetch_all('select * from zone where type = 3 and status != "HIDE" order by name');
		$this->export_file('cache/tables/cities.cache.php','cities',$items);
		$items_ = DB::fetch_all('select id,name,name_id,structure_id from zone where type = 3 or type = 4 and status != "HIDE" order by structure_id');
		$this->export_file('cache/tables/zones.cache.php','zones',$items_);
		$this->export_file('cache/tables/destination_favorites.cache.php','destination_favorites',$temp_zones);
		Url::redirect_current();
	}
	function delete_file()
	{
		if(Url::get('link') and file_exists(Url::get('link')) and User::can_delete(false,ANY_CATEGORY))
		{
			@unlink(Url::get('link'));
		}
		echo '<script>window.close();</script>';
	}
	function add_cmd()
	{
		if(User::can_add(false,ANY_CATEGORY))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditZoneAdminForm());
		}
		else
		{
			Url::redirect_current();
		}
	}
	function delete_cmd()
	{
		if(is_array(URL::get('selected_ids')) and sizeof(URL::get('selected_ids'))>0 and User::can_delete(false,ANY_CATEGORY))
		{
			if(sizeof(URL::get('selected_ids'))>1)
			{
				require_once 'forms/list.php';
				$this->add_form(new ListZoneAdminForm());
			}
			else
			{
				$ids = URL::get('selected_ids');
				$_REQUEST['id'] = $ids[0];
				require_once 'forms/detail.php';
				$this->add_form(new ZoneAdminForm());
			}
		}
		else
		if(User::can_delete(false,ANY_CATEGORY) and Url::check('id') and DB::exists_id('zone',$_REQUEST['id']))
		{
			require_once 'forms/detail.php';
			$this->add_form(new ZoneAdminForm());
		}
		else
		{
			Url::redirect_current();
		}
	}
	function edit_cmd()
	{
		if(Url::get('id') and $category=DB::fetch('select id,structure_id from zone where id='.intval(Url::get('id'))) and User::can_edit(false,$category['structure_id']))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditZoneAdminForm());
		}
		else
		{
			Url::redirect_current();
		}
	}
	function list_cmd()
	{
		require_once 'forms/list.php';
		$this->add_form(new ListZoneAdminForm());
	}
	function view_cmd()
	{
		if(User::can_view_detail(false,ANY_CATEGORY) and Url::check('id') and DB::exists_id('zone',$_REQUEST['id']))
		{
			require_once 'forms/detail.php';
			$this->add_form(new ZoneAdminForm());
		}
		else
		{
			Url::redirect_current();
		}
	}
	function move_cmd()
	{
		if(User::can_edit(false,ANY_CATEGORY)and Url::check('id')and $category=DB::exists_id('zone',$_REQUEST['id']))
		{
			if($category['structure_id']!=ID_ROOT)
			{
				require_once 'packages/core/includes/system/si_database.php';
				si_move_position('zone',' and 1');
			}
			Url::redirect_current(array('countries'));
		}
		else
		{
			Url::redirect_current(array('countries'));
		}
	}
	function zoom($structure_id){
		$level = IDStructure::level($structure_id);
		switch ($level){
			case 1:
				$zoom = 2; break;
			case 2:
				$zoom = 5; break;
			case 3:
				$zoom = 11; break;
			case 4:
				$zoom = 12; break;
			default:
				$zoom = 11; break;
		}
		return $zoom;
	}
	function get_zone_child($structure_id,$limit='',$cond=''){
		return DB::fetch_all('
			SELECT
				*
			FROM
				zone
			WHERE
				portal_id="'.PORTAL_ID.'" and '.IDstructure::direct_child_cond($structure_id).' '.$cond.'
			ORDER BY 
				structure_id
			'.$limit.'
		');
	}
	function export_file($path,$file_name,$content){
		$content = '<?php $'.$file_name.' = '.var_export($content,true).';?>';
		$handler = fopen($path,'w+');
		fwrite($handler,$content);
		fclose($handler);
	}
}
?>