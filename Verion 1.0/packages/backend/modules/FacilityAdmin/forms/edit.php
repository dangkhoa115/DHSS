<?php
class EditFacilityAdminForm extends Form
{
	function EditFacilityAdminForm()
	{
		Form::Form('EditFacilityAdminForm');
		$this->link_css('skins/default/css/cms.css');
		$this->link_css('skins/default/css/tabs/tabpane.css');
		$this->link_js('skins/default/css/tabs/tabpane.js');
		$this->link_js('packages/core/includes/js/multi_items.js');
	}
	function on_submit()
	{
		if(User::can_admin(false,ANY_CATEGORY))
		{
			if($facilities = Url::get('mi_facility_group') and is_array($facilities))
			{
				foreach($facilities as $key=>$facility)
				{
					if($facility['id'])
					{
						if($facility['name'])
						{
							DB::update_id('facility',array('name'=>$facility['name'],'facility_group_id'=>$facility['facility_group_id']),$facility['id']);
						}
					}else
					{
						DB::insert('facility',array('name'=>$facility['name'],'facility_group_id'=>$facility['facility_group_id'],'type'=>'HOTEL'));
					}
				}
			}
			if($group_deleted_ids = Url::get('group_deleted_ids'))
			{
				$delete_ids = explode(',',$group_deleted_ids);
				foreach($delete_ids as $value)
				{
					DB::delete_id('facility',intval($value));
				}
			}
			echo '<script>alert("Update successfull!");window.location="'.Url::build('panel',array('category_id'=>75)).'"; </script>';
		}
	}
	function draw()
	{
		$this->map = array();
		require_once 'packages/core/includes/utils/paging.php';
		$item_per_page = 100;
		$page_no = page_no();
		$total = DB::fetch('select count(*) as acount from facility where facility.type="HOTEL"','acount');
		$this->map['paging'] = paging($total,$item_per_page);
		
		$sql = 'SELECT 
					facility.*, facility_group.name as group_name
				FROM 
					facility
					INNER JOIN facility_group on facility_group.id = facility.facility_group_id
				WHERE
					facility.type="HOTEL"
				ORDER BY
					facility_group.id, facility.id
				LIMIT
					'.($page_no-1)*$item_per_page.','.$item_per_page.'
				';
		$_REQUEST['mi_facility_group'] = DB::fetch_all($sql);
		
		$facility_group = DB::fetch_all('select * from facility_group');
		$this->map['facility_group'] = '';
		foreach($facility_group as $key=>$value)
		{
			$this->map['facility_group'] .= '<option value="'.$key.'">'.$value['name'].'</option>';
		}
		$this->parse_layout('edit',$this->map);
	}
}
?>
