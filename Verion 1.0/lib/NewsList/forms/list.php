<?php
class NewsListForm extends Form
{
	function NewsListForm()
	{
		Form::Form('NewsListForm');
		$this->link_css(Portal::template().'css/news.css');
	}	
	function on_submit(){
	}
	function draw()
	{
		/*
			read xml
		*/		
		$layout = 'list';
		$item_per_page = 10;
		$cond =  'news.type = "NEWS" and news.status<>"HIDE" and publish=1 and news.portal_id = "'.PORTAL_ID.'"';		
		if(($name_id = Url::get('name_id')) and $category = DB::select('category','name_id="'.addslashes($name_id).'"') and !IDStructure::have_child('category',$category['structure_id']))
		{
			$cond .= ' and '.IDStructure::child_cond($category['structure_id']);
		}
		require_once 'packages/core/includes/utils/paging.php';
		$count = NewsListDB::get_total_item($cond);
		$this->map['paging'] = paging($count['acount'],$item_per_page,5,REWRITE,'page_no',array('name_id'));
		$this->map['items'] = NewsListDB::get_items($cond,$item_per_page);
		$this->parse_layout($layout,$this->map);
	}
}
?>