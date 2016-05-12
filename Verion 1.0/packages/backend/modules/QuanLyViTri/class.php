<?php 
class QuanLyViTri extends Module
{
	function QuanLyViTri($row)
	{
		Module::Module($row);
		if(User::can_view(false,ANY_CATEGORY))
		{
			
			require_once 'forms/edit.php';
			$this->add_form(new EditQuanLyViTriForm());
		}
		else
		{
			URL::access_denied();
		}
	}
}
?>