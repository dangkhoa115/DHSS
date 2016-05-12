<?php
class EditThemeAdminForm extends Form
{
	function EditThemeAdminForm()
	{
		Form::Form('EditThemeAdminForm');
		$this->link_css('skins/default/css/cms.css');
		$this->link_css('skins/default/css/tabs/tabpane.css');
		$this->link_js('skins/default/css/tabs/tabpane.js');
		$this->link_js('packages/core/includes/js/multi_items.js');
	}
	function on_submit()
	{
		if(User::can_admin(false,ANY_CATEGORY))
		{
			if($themes = Url::get('mi_theme_group') and is_array($themes))
			{
				foreach($themes as $key=>$theme)
				{
					if($theme['id'])
					{
						if($theme['name'])
						{
							DB::update_id('theme',array('name'=>$theme['name']),$theme['id']);
						}
					}else
					{
						DB::insert('theme',array('name'=>$theme['name']));
					}
				}
			}
			if($group_deleted_ids = Url::get('group_deleted_ids'))
			{
				$delete_ids = explode(',',$group_deleted_ids);
				foreach($delete_ids as $value)
				{
					DB::delete_id('theme',intval($value));
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
		$total = DB::fetch('select count(*) as acount from theme','acount');
		$this->map['paging'] = paging($total,$item_per_page);
		
		$sql = 'SELECT 
					theme.*
				FROM 
					theme
				ORDER BY
					theme.id
				LIMIT
					'.($page_no-1)*$item_per_page.','.$item_per_page.'
				';
		$_REQUEST['mi_theme_group'] = DB::fetch_all($sql);
		$this->parse_layout('edit',$this->map);
	}
}
?>
