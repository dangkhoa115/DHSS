<?php
// WRITER   : MINH DUC
// DATE		: 10/07/2009
// COPYRIGHT: NGO VAN NGOC
class NewsCategory extends Module
{
	function NewsCategory($row)
	{
		Module::Module($row);
		require_once 'db.php';
		require_once 'forms/list.php';
		$this->add_form(new NewsCategoryForm());		
	}
}
?>