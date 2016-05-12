<?php
class EditZoneAdminForm extends Form
{
	function EditZoneAdminForm()
	{
		Form::Form('EditZoneAdminForm');
		if(URL::get('cmd')=='edit')
		{
			$this->add('id',new IDType(true,'object_not_exists','zone'));
		}
		$this->add('name',new TextType(true,'invalid_name',0,2000)); 
		$this->add('description',new TextType(false,'invalid_description',0,200000)); 
		$this->link_css('skins/default/css/cms.css');
	}
	function on_submit()
	{
		//System::debug($_REQUEST); exit();
		require_once 'packages/core/includes/utils/upload_file.php';
		update_upload_file('image_url',str_replace('#','',PORTAL_ID).'/zone');
		update_upload_file('map',str_replace('#','',PORTAL_ID).'/zone');
		update_upload_file('flag',str_replace('#','',PORTAL_ID).'/zone');
		if($this->check() and URL::get('confirm_edit'))
		{
			if(URL::get('cmd')=='edit')
			{
				$this->old_value = DB::select('zone','id="'.addslashes($_REQUEST['id']).'"');
				if(Url::get('delete_image_url')=='0')
				{
					@unlink($this->old_value['image_url']);
					DB::update_id('zone',array('image_url'=>''),$_REQUEST['id']);
				}	
				if(Url::get('delete_map')=='0')
				{
					@unlink($this->old_value['map']);
					DB::update_id('zone',array('map'=>''),$_REQUEST['id']);
				}	
				if(Url::get('delete_flag')=='0')
				{
					@unlink($this->old_value['flag']);
					DB::update_id('zone',array('flag'=>''),$_REQUEST['id']);
				}	
			}
			$this->save_item();
			if(!$this->is_error())
			{
				Url::redirect_current(array('just_edited_id'=>$this->id,'countries'));
			}
		}
	}	
	function draw()
	{
		$this->init_edit_mode();
		$this->get_parents();
		require_once 'cache/config/status.php';
		require_once 'cache/config/zone_type.php';
		require_once Portal::template_js('core').'/tinymce/init_tinyMCE.php';
		$zone = array();
		$zone_id['id'] = '';
		$zone_id['lat'] = '';
		$zone_id['long'] = '';
		$zone_id['zoom'] = '';
		$zone_id['structure_id'] = ''; 
		if(Url::get('countries') and $zone=DB::fetch('select zone.id,zone.structure_id,zone.lat,zone.long from zone where zone.id='.intval(Url::get('countries')))){
			$_REQUEST['parent_id']=$zone['id'];
		}
		if($this->edit_mode){
			require_once 'packages/core/includes/system/si_database.php';
			$zone_id = si_parent('zone',$this->init_value['structure_id']);
			$zone_id['zoom'] = $this->zoom($zone_id['structure_id']);
			$parent_lat = Url::get('lat')?Url::get('lat'):$zone_id['lat'];
			$parent_long = Url::get('long')?Url::get('long'):$zone_id['long'];
			$parent_zoom = Url::get('zoom')?7:$zone_id['zoom'];
		}else{
			if($zone){
				$parent_lat = $zone['lat'];
				$parent_long = $zone['long'];
				$parent_zoom = $this->zoom($zone['structure_id']);
			}else{
				$parent_lat = 0;
				$parent_long = 0;
				$parent_zoom = 1;
			}
		}
		$this->parse_layout('edit',
			($this->edit_mode?$this->init_value:array())+
			array(
				'parent_id_list'=>String::get_list(ZoneAdminDB::check_categories($this->parents)),
				'parent_id'=>($this->edit_mode?si_parent_id('zone',$this->init_value['structure_id'],''):1),
				'status_list'=>$status,
				'type_list'=>$zone_type,
				'parent_lat'=>$parent_lat,
				'parent_long'=>$parent_long,
				'parent_zoom'=>$parent_zoom
			)
		);
	}
	function save_item()
	{
		$extra = array('site_title','site_keyword','site_quote');
		$extra=$extra+array('name'=>Url::get('name',1)); 
		$extra=$extra+array('description'=>Url::get('description',1)); 
		$extra=$extra+array('lat'=>Url::get('lat',1)); 
		$extra=$extra+array('long'=>Url::get('long',1)); 
		$extra=$extra+array('radius'=>Url::get('radius',1));
		$extra=$extra+array('type'=>Url::get('type',0));
		$new_row = $extra+
		$new_row = $extra+array('status'=>Url::get('status'),'portal_id'=>PORTAL_ID);
		if(Url::get('image_url')!='')
		{
			$new_row['image_url'] =Url::get('image_url');
		}
		if(Url::get('map')!='')
		{
			$new_row['map'] =Url::get('map');
		}
		if(Url::get('flag')!='')
		{
			$new_row['flag'] =Url::get('flag');
		}
		require_once 'packages/core/includes/utils/vn_code.php';
		if(!$this->is_error())
		{
			$name_id = convert_utf8_to_url_rewrite($new_row['name']);
			$new_row+=array('name_id'=>$name_id);
			if(URL::get('cmd')=='edit')
			{
				$this->id = $_REQUEST['id'];
				$new_row['last_time_update'] = time();
				if($old = DB::fetch('select id,name_id,structure_id from zone where name_id="'.$name_id.'" and portal_id="'.PORTAL_ID.'"'))
				{
					if(!Url::get('id') or !Url::get('cmd')=='edit')
					{
						$this->error('name','duplicate_name');
					}	
				}
				//end
				$structure_id = $old['structure_id'];
				if(Url::get('status')=='HIDE')
				{
					$status_arr = array('status'=>'HIDE');
				}else{
					$status_arr = array('status'=>'SHOW');
				}
				$childs = DB::fetch_all('select id from zone where '.IDStructure::child_cond($structure_id));
				foreach($childs as $id=>$child)
				{
					DB::update_id('zone',$status_arr,$id);	
				}
				DB::update_id('zone', $new_row,$this->id);
				if($this->old_value['structure_id']!=ID_ROOT)
				{
					if (Url::check(array('parent_id')))
					{
						$parent = DB::select('zone',$_REQUEST['parent_id']);
						if($parent['structure_id']==$this->old_value['structure_id'])
						{
							$this->error('id','invalid_parent');
						}
						else
						{
							require_once 'packages/core/includes/system/si_database.php';
							if(!si_move('zone',$this->old_value['structure_id'],$parent['structure_id']))
							{
								$this->error('id','invalid_parent');
							}
						}
					}
				}
			}
			else
			{
				require_once 'packages/core/includes/system/si_database.php';
				$new_row['time'] = time();
				if(isset($_REQUEST['parent_id']))
				{
					$this->id = DB::insert('zone', $new_row+array('structure_id'=>si_child('zone',structure_id('zone',$_REQUEST['parent_id']),'')));
				}
				else
				{
					$this->id = DB::insert('zone', $new_row+array('structure_id'=>ID_ROOT));		
				}				
			}
			save_log($this->id);
		}	
	}
	function init_edit_mode()
	{
		if(URL::get('cmd')=='edit' and $this->init_value=DB::select('zone','id='.intval(URL::sget('id')).''))
		{
			foreach($this->init_value as $key=>$value)
			{
				if(is_string($value) and !isset($_REQUEST[$key]))
				{
					$_REQUEST[$key] = $value;
				}
			}
			$this->edit_mode = true;
		}
		else
		{
			$this->edit_mode = false;
		}
	}
	function get_parents($cond=1)
	{
		require_once 'packages/core/includes/system/si_database.php';
		$sql = '
			select 
				id,
				structure_id
				,name
			from 
			 	zone
			where 
				'.$cond.'
			order by 
				structure_id
		';
		$this->parents = DB::fetch_all($sql);
	}
	function zoom($structure_id){
		$level = IDStructure::level($structure_id);
		switch ($level){
			case 0:
				$zoom = 2; break;
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
}
?>