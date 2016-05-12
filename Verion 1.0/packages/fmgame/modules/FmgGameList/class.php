<?php
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class FmgGameList extends Module
{
	function FmgGameList($row)
	{
		Module::Module($row);
		require_once 'db.php';
		$this->list_cmd();
	}
	function copy_items()
	{
		if(User::can_edit(false,ANY_CATEGORY) and isset($_REQUEST['selected_ids']) and count($_REQUEST['selected_ids'])>0)
		{
			require_once 'forms/copy.php';
			$this->add_form(new CopyFmgGameListForm());	
		}
		else
		{
			Url::redirect_current(array('cmd'=>'list'));
		}
	}	
	function delete_file()
	{
		if(Url::get('link') and file_exists(Url::get('link')) and User::can_delete(false,ANY_CATEGORY))
		{
			@unlink(Url::get('link'));
		}
		echo '<script>window.close();</script>';
	}
	function front_page()
	{
		if(Url::get('id') and $game = DB::exists_id('game',intval(Url::get('id'))) and User::can_edit(false,ANY_CATEGORY))
		{
			DB::update_id('game',array('front_page'=>$game['front_page']==1?'0':'1'),intval(Url::get('id')));			
		}
		echo '<script>location="'.Url::redirect_current(array('cmd'=>'list','just_edited_id'=>Url::get('id',1))).'";</script>';
	}
	function list_cmd()
	{
		require_once 'forms/list.php';
		$this->add_form(new ListFmgGameListForm());
	}
	function add_cmd()
	{
		if(User::can_add(false,ANY_CATEGORY))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditFmgGameListForm());
		}	
		else
		{
			Url::access_denied();
		}
	}
	function edit_cmd()
	{
		if(User::can_edit(false,ANY_CATEGORY))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditFmgGameListForm());
		}	
		else
		{
			Url::access_denied();
		}
	}
}
?>
