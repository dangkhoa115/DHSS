<?php
class ManageNewsletterForm extends Form
{
	function ManageNewsletterForm()
	{
		Form::Form('ManageNewsletterForm');
		$this->link_css('skins/default/css/cms.css');
	}
	function on_submit()
	{
	}
	function draw()
	{
		$file = 'upload/'.substr(PORTAL_ID,1).'/newsletter/newsletter.txt';
		$this->map['content'] = '';
		if(file_exists($file))
		{
			$this->map['content'] = file_get_contents($file);		
		}
		$this->parse_layout('newsletter',$this->map);
	}
}
?>