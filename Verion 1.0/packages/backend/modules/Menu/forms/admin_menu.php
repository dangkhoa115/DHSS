<?php
class MenuForm extends Form
{
	function MenuForm()
	{
		Form::Form('MenuForm');
		$this->link_js('packages/core/includes/js/jquery/jquery.js'); //1.11
		$this->link_css('skins/default/css/global.css');
		$this->link_css('skins/admin/css/menu.css');
		$this->link_css('skins/admin/css/style.css');
		$this->link_css('skins/default/css/jquery/tabs.css');
		$this->link_js('skins/admin/scripts/datepicker.js');
		$this->link_css('skins/admin/css/datepicker.css');
	}
	function draw()
	{
		$this->map = array();
		$user = Session::get('data_user');
		$this->map['full_name'] = $user['full_name'];
		require 'packages/core/includes/utils/category.php';
		$layout = 'admin_menu';
		if(User::can_admin(false,ANY_CATEGORY)){
			require_once 'cache/tables/function.cache.php';
		}else{
			$categories = array();
			$layout = 'admin_menu';
			$privilege_categories = DB::fetch_all('SELECT account_privilege.id, account_id,function.structure_id FROM account_privilege INNER JOIN function ON function.id = category_id WHERE account_id = \''.Session::get('user_id').'\'');
			foreach($privilege_categories as $value){
				$categories += DB::fetch_all('
					select
						*
						,name_'.Portal::language().' as name
						,group_name_'.Portal::language().'
					from
						function
					where
					function.status <> "HIDE"
					and '.IDstructure::child_cond($value['structure_id'],false,'function.')
					.' order by structure_id'
				);
			}
		}
		$this->map['categories'] = String::array2tree($categories,'child');
		$this->map['current_hotel'] = '';
		if(isset($_SESSION['hotel_name']) and isset($_SESSION['hotel_id'])){
			$this->map['current_hotel'] = $_SESSION['hotel_name'].' | ';
			$this->map['hotel_user_id'] = DB::fetch('select id,account_id,hotel_id from hotel_account where hotel_id = '.$_SESSION['hotel_id'].'','account_id');
		}
		$this->parse_layout($layout,$this->map);
	}
}
?>