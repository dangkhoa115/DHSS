<?php
// WRITER   : TRINH CONG MINH
// DATE     : 07/09/2009
// FUNCTION : Hien thi tin kieu slide o trang chu
class HomeNewsSlide extends Module
{
	function HomeNewsSlide($row)
	{
		Module::Module($row);
		require_once 'db.php';
		require_once 'forms/list.php';
		$this->add_form(new HomeNewsSlideForm());		
	}
}
?>