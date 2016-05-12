<?php
/*
	writer : sangvt
	date : 10/07/2009
	edit :
	Function : Danh sach anh theo Category , item

*/
class GalleryCategory extends Module
{
	function GalleryCategory($row)
	{
		Module::Module($row);
		require_once 'db.php';
		require_once 'forms/list.php';
		$this->add_form(new GalleryCategoryForm());		
	}
}
?>