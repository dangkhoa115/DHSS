<?php
class UserMenuHomeForm extends Form
{
	function UserMenuHomeForm()
	{
		Form::Form('UserMenuHomeForm');
		//$this->link_css('skins/default/css/menu.css');
		//$this->link_css('skins/admin/css/menu.css');
	}
	function draw()
	{
		$this->map = array();
		require 'cache/tables/function.cache.php';
		$this->map['categories'] = $categories;
		if(Session::is_set('hotel_id'))
		{			
			$cond = 'status!="HIDE" and id!=67 and url!="" and '.IDStructure::child_cond(DB::structure_id('function',67));
			$items = MenuHomeDB::get_hotel_menu($cond);
			unset($items[68]);
			$this->map['categories'] = $items;
		}
		elseif(Session::is_set('agent_id'))
		{
			$cond = 'status!="HIDE" and '.IDStructure::direct_child_cond(DB::structure_id('function',93));
			$this->map['categories'] = MenuHomeDB::get_hotel_menu($cond);		
		}	
		else
		{
			$items = array();
			$items[85] = array('id'=>85,'name'=>'Booking list','url'=>'?page=user_booking_report','icon_url' => 'upload/default/icon//icon_report.png');		
			$items[90] = $this->map['categories'][90];
			$items[86] = $this->map['categories'][86];
			$this->map['categories'] = $items;
		}	
		$this->parse_layout('hotel',$this->map);
	}
}
?>
