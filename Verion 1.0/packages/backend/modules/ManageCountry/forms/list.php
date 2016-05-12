<?php
class ManageCountryForm extends Form
{
	function ManageCountryForm()
	{
		Form::Form('ManageCountryForm');
		$this->link_css('skins/default/css/cms.css');
	}
	function on_submit()
	{
		
	}
	function draw()
	{
		$items = ManageCountryDB::get_items();
		$this->parse_layout('list',array(
			'items'=>$items
		));
	}
}
?>