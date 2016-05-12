<?php
/*
	writer : sangvt
	date : 09/07/2009
	Function : Hieu ung lightbox; Hieu ung anh phong to thu nho

*/
	class Gallery extends Module
	{
		function Gallery($row)
		{
			Module::Module($row);
			require_once 'db.php';
			require_once 'forms/list.php';
			$this->add_form(new GalleryForm());
		}
	}
?>