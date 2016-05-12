<?php
class NewsDetailForm extends Form
{
	function NewsDetailForm()
	{
		Form::Form('NewsDetailForm');
		$this->link_css(Portal::template().'/css/news.css');
		$this->link_css(Portal::template().'/css/m_home.css');
	}	
	function on_submit(){
	}
	function draw()
	{
		$item = array('id'=>'0','category_id'=>'0');
		//require_once 'packages/core/includes/utils/format_text.php';
		$this->map = array();
		$mode = false;
		if(($name_id = Url::get('name_id')) and $item = ItemDetail::$item)
		{
			$this->parse_layout('list',$item+$this->map);	
		}else
		{
			$this->parse_layout('list',$this->map);
		}
	}
}
?>
