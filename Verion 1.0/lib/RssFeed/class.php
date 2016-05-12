<?php
// WRITER   : TRINH CONG MINH
// DATE     : 13/07/2009
// FUNCTION : Hien thi cac kenh RSS
class RssFeed extends Module
{
	function RssFeed($row)
	{
		Module::Module($row);
		require_once 'db.php';
		require_once 'forms/list.php';
		$this->add_form(new RssFeedForm());		
	}
}
?>