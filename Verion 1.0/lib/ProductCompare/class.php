<?php
/*
	create by : ngocnv
	date : 13/07/2009
	edit :
	Function : So sanh san pham

*/
class ProductCompare extends Module
{
	function ProductCompare($row)
	{
		Module::Module($row);
		require_once 'db.php';
		require_once 'forms/list.php';
		$this->add_form(new ProductCompareForm());		
	}
}
?>