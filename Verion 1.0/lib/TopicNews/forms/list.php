<?php
class TopicNewsForm extends Form
{
	function TopicNewsForm()
	{
		Form::Form('TopicNewsForm');
		$this->link_css(Portal::template().'/css/news.css');
		$this->link_css(Portal::template().'/css/m_home.css');
	}	
	function on_submit(){
	}
	function draw()
	{
		$item = array('id'=>'0','category_id'=>'0');
		$this->map = array();
		if(($name_id = Url::get('name_id')) and ($category_id = Url::get('category_id')))
		{
			$cond = 'news.portal_id="'.PORTAL_ID.'" and news.type="NEWS" and news.name_id !="'.$name_id.'"';
			$this->map['related_items'] = TopicNewsDB::get_items($cond.' and '.IDStructure::child_cond(DB::structure_id('category',$category_id)));
		}
		$this->parse_layout('list',$this->map);
	}
}
?>
