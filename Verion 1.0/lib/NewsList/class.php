<?php
/* 	Writen by 	:	Minh Duc
	Date		:	09/07/2009
	Function	:	List tin
	Input		:	Category_name_id ( default = '' )
	Output		:	List tin theo danh muc cho truoc ( default : Liat tat ca )
*/
class NewsList extends Module
{
	function NewsList($row)
	{
		Module::Module($row);
		require_once 'db.php';
		require_once 'forms/list.php';
		$this->add_form(new NewsListForm());		
	}
}
?>