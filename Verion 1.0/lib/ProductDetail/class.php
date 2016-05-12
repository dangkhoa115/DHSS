<?php
/*
	create by : ngocnv
	date : 14/07/2009
	edit :
	Function : Chi tiet san pham

*/
class ProductDetail extends Module
{
	static $category = array();
	function ProductDetail($row)
	{
		Module::Module($row);
		require_once 'db.php';
		require_once 'forms/list.php';
		$this->add_form(new ProductDetailForm());		
	}
}
?>