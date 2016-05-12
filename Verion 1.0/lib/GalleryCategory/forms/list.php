<?php
class GalleryCategoryForm extends Form
{
	function GalleryCategoryForm()
	{
		Form::Form('GalleryCategoryForm');
		$this->link_css(Portal::template().'/css/gallery.css');
		$this->link_css(Portal::template('core').'/css/jquery/jquery.lightbox-0.5.css');
		$this->link_js('packages/core/includes/js/jquery/jquery.lightbox-0.5.min.js');
	}	
	function on_submit(){
	}
	function draw()
	{
		$this->map = array();
		if(Url::get('name_id') and $row = DB::select('category','name_id="'.Url::get('name_id').'"'))
		{
			$cond_category = 'portal_id="'.PORTAL_ID.'" and type="PHOTO" and '.IDStructure::direct_child_cond($row['structure_id']);
		}
		else
		{
			$cond_category = 'portal_id="'.PORTAL_ID.'" and type="PHOTO" and '.IDStructure::direct_child_cond(ID_ROOT);
		}
		$this->map['categories'] = GalleryCategoryDB::get_categories($cond_category);
		//System::debug($cond_category);
		$categories = GalleryCategoryDB::get_categories($cond_category);
		$this->map['count_categories'] = GalleryCategoryDB::get_total_category($cond_category);
		if($categories)
		{
			foreach($categories as $key=>$value)
			{
				$cond_item = 'media.type="PHOTO" and media.status!="HIDE" and '.IDStructure::child_cond($value['structure_id']);
				$this->map['categories'][$key]['items'] = GalleryCategoryDB::get_items($cond_item);
			}
			$this->parse_layout('list',$this->map);
		}
		else
		{
			$cond = 'media.type="PHOTO" and media.portal_id="'.PORTAL_ID.'"';
			if (isset($row))
			{
				$this->map['category_name'] = $row['name_'.Portal::language()];
				$cond = 'media.category_id = '.$row['id'] ;
			}
			else{
				$this->map['category_name'] = '';
			}
			$item_per_page = 24;
			require_once 'packages/core/includes/utils/paging.php';
			$total_item = GalleryCategoryDB::get_total_items($cond);
			$this->map['paging'] = paging($total_item['acount'],$item_per_page,10,REWRITE,'page_no',array('name_id'),Portal::language('page'));		
			$this->map['items'] = GalleryCategoryDB::get_all_items($cond,$item_per_page);
			
			$this->parse_layout('item_list',$this->map);
		}
	}
}
?>
