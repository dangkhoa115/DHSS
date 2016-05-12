<?php
class HomeNewsScrollForm extends Form
{
	function HomeNewsScrollForm()
	{
		Form::Form('HomeNewsScrollForm');
		$this->link_js('packages/core/includes/js/jquery/jquery.scrollPage.js');
		$this->link_css(Portal::template('news').'/css/home.css');
	}	
	function draw()
	{
		$this->map = array();
		$cond = 'news.type="NEWS" and news.status!="HIDE"';
		$limit = 12;
		$this->map['news'] = HomeNewsScrollDB::get_news($cond,$limit);
		//System::debug($this->map['news']);
		$this->parse_layout('list',$this->map);
	}
}
?>