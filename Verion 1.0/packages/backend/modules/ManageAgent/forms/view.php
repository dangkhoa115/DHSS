<?php
class ManageAgentDetailForm extends Form
{
	function ManageAgentDetailForm()
	{
		Form::Form('ManageAgentDetailForm');
		$this->link_css('skins/default/css/cms.css');
	}
	function draw()
	{
		$this->map = array();
		if(($id = Url::get('id')) and ($agent = ManageAgentDB::get_agent('party.type="AGENT" and party.user_id="'.$id.'"')))
		{
			$this->map = $agent;
		}
		$this->parse_layout('view',$this->map);
	}
}
?>