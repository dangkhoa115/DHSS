<?php
class ManageContactDetailForm extends Form
{
	function ManageContactDetailForm()
	{
		Form::Form('ManageContactDetailForm');
		$this->link_css('skins/default/css/cms.css');
	}
	function on_submit()
	{
	}
	function draw()
	{
		$this->map = array();
		$this->map = ManageContactDB::get_item();
		$this->parse_layout('detail',$this->map);
	}
}
?>