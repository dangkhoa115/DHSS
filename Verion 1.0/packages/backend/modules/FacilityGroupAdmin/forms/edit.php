<?php
class EditFacilityGroupAdminForm extends Form
{
	function EditFacilityGroupAdminForm()
	{
		Form::Form('EditFacilityGroupAdminForm');
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
							DB::update_id('facility_group',array('name'=>$facility['name']),$facility['id']);
						}
					}else
					{
						DB::insert('facility_group',array('name'=>$facility['name']));
					}
				}
			}
			if($group_deleted_ids = Url::get('group_deleted_ids'))
			{
				$delete_ids = explode(',',$group_deleted_ids);
				foreach($delete_ids as $value)
				{
					DB::delete_id('facility_group',intval($value));
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
		$total = DB::fetch('select count(*) as acount from policies','acount');
		$this->map['paging'] = paging($total,$item_per_page);
		
		$sql = 'SELECT 
					facility_group.*
				FROM 
					facility_group
				ORDER BY
					facility_group.id
				LIMIT
					'.($page_no-1)*$item_per_page.','.$item_per_page.'
				';
		$_REQUEST['mi_facility_group'] = DB::fetch_all($sql);
		$this->parse_layout('edit',$this->map);
	}
}
?>
