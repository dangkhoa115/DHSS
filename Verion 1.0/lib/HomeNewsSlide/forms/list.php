<?php
class HomeNewsSlideForm extends Form
{
	function HomeNewsSlideForm()
	{
		Form::Form('HomeNewsSlideForm');
		$this->link_js('packages/core/includes/js/jquery/jCarousel.js');
		$this->link_css(Portal::template('news').'/css/home.css');
	}	
	function draw()
	{
		$this->map = array();
		$cond = 'news.type="NEWS" and news.status!="HIDE"';
		$limit = 10;
		$this->map['news'] = HomeNewsSlideDB::get_news($cond,$limit);
		if($this->map['news']){
/*			foreach($this->map['news'] as $key=>$value){
				if($value['image_url']=='' or !file_exists($value['image_url'])){
					unset($this->map['news'][$key]);
				}
			}
*/			$this->parse_layout('list',$this->map);
		}
		//System::debug($this->map['news']);
	}
}
?>