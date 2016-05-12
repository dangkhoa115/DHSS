<?php
class GalleryForm extends Form
{
	function GalleryForm()
	{
		Form::Form('GalleryForm');
		$this->link_css(Portal::template('core').'/css/gallery.css');
		$this->link_css(Portal::template('core').'/css/visual_lightbox.css');
		$this->link_js('packages/interface/packages/media/includes/js/prototype.js');
		$this->link_js('packages/interface/packages/media/includes/js/scriptaculous.js?load=effects,builder');
		$this->link_js('packages/interface/packages/media/includes/js/lightbox.js');
	}	
	function on_submit(){
	}
	function draw()
	{
		$cond=' and media.type="PHOTO" and media.portal_id="'.PORTAL_ID.'" and media.status!="HIDE"';
		if(Url::get('category_id') and $category=DB::select_id('category',intval(Url::get('category_id'))))
		{
			$cond.=' and '.IDStructure::child_cond($category['structure_id']);
		}
		$item_per_page =20;
		require_once 'packages/core/includes/utils/paging.php';
		$total_item = GalleryDB::get_total_items($cond);
		$paging = paging($total_item['acount'],$item_per_page,10,REWRITE,'page_no',array('category_id'),Portal::language('page'));		
		$items=GalleryDB::get_items($cond,$item_per_page);
/*		$this->parse_layout('list',array(
				'items'=>$items,
				'paging'=>$paging
			));
*/		
		$this->parse_layout('lightbox',array(
				'items'=>$items,
				'paging'=>$paging
			));
	}
}
?>
