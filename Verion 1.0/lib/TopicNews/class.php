<?php
class TopicNews extends Module
{
	function TopicNews($row)
	{
		Module::Module($row);
		require_once 'db.php';
		require_once 'packages/interface/packages/news/includes/item_detail.php';
		require_once 'forms/list.php';
		$this->add_form(new TopicNewsForm());		
	}
}
?>