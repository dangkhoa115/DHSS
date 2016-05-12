<?php
class TravelBacklinksForm extends Form
{
	function TravelBacklinksForm()
	{
		Form::Form('TravelBacklinksForm');
	}	
	function draw()
	{
		$cond = ' and zone.status <> "HIDE"';
		$items = TravelBacklinksDB::get_destination($cond);
		$this->parse_layout('list',array(
			'items'=>$items
		));
	}
}
?>