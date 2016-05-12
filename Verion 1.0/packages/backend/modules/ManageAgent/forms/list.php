<?php
class ManageAgentListForm extends Form
{
	function ManageAgentListForm()
	{
		Form::Form('ManageAgentListForm');
		$this->link_css('skins/default/css/cms.css');
	}
	function on_submit()
	{
	}
	function draw()
	{
		$this->map['agents'] = ManageAgentDB::get_agents('is_agent');
		$this->parse_layout('list',$this->map);
	}
}
?>