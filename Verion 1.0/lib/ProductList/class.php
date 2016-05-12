<?php
/*
	create by : ngocnv
	date : 10/07/2009
	edit :
	Function : Danh sach san pham

*/
class ProductList extends Module
{
	static $category = array();
	function ProductList($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(Url::get('name_id') and $category = DB::select('category','name_id="'.addslashes(Url::get('name_id')).'" and type="PRODUCT"'))
		{
			ProductList::$category = $category;
			$_REQUEST['category_id'] = $category['id'];
			Portal::$document_title = $category['name_'.Portal::language()];
		}
		require_once 'forms/list.php';
		$this->add_form(new ProductListForm());		
	}
}
?>