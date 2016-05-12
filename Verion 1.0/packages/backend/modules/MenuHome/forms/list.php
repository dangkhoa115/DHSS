<?php
class MenuHomeForm extends Form
{
	function MenuHomeForm()
	{
		Form::Form('MenuHomeForm');
		//$this->link_css('skins/default/css/menu.css');
		//$this->link_css('skins/admin/css/menu.css');
	}
	function draw()
	{
		require 'cache/tables/function.cache.php';
		$categories = String::array2tree($categories,'child');
		$category_id = intval(Url::get('category_id'));
		if(isset($categories[$category_id]))
		{
			$this->map['name'] = $categories[$category_id]['name_'.Portal::language()];
			$this->map['child'] = DB::fetch_all('select id, name_'.Portal::language().' as name_1,url, icon_url, structure_id from function where status<>\'HIDE\' and '.IDStructure::child_cond($categories[$category_id]['structure_id']).' and structure_id <> \''.$categories[$category_id]['structure_id'].'\'  order by structure_id');
			$this->parse_layout('list',$this->map);
		}
		else
		{
			Url::redirect('home');
		}
	}
}
?>
