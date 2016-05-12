<?php
// WRITER   : NGO VAN NGOC (01/07/2009)
// EDIT     : TRINH CONG MINH (10/07/2009)
// FUNCTION : LIST TIN THEO DANH MUC
class HomeNewsCategory extends Module
{
	function HomeNewsCategory($row)
	{
		Module::Module($row);
		require_once 'db.php';
		require_once 'forms/list.php';
		$this->add_form(new HomeNewsCategoryForm());		
	}
}
?>