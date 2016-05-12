<?php
// WRITER   : TRINH CONG MINH
// DATE     : 07/09/2009
// FUNCTION : Hien thi tin co the scroll
class HomeNewsScroll extends Module
{
	function HomeNewsScroll($row)
	{
		Module::Module($row);
		require_once 'db.php';
		require_once 'forms/list.php';
		$this->add_form(new HomeNewsScrollForm());		
	}
}
?>