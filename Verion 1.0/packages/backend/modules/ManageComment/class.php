<?php 
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class ManageComment extends Module
{
	function ManageComment($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view(false,ANY_CATEGORY))
		{
			switch(Url::get('cmd'))
			{
				case 'delete':
					$this->delete_comment();
					break;
				case 'check':
					$this->check_comment();
					break;
				default:
					require_once 'forms/list.php';
					$this->add_form(new ManageCommentForm());
					break;
			}
		}
		else
		{
			Url::access_denied();
		}	
	}
	function delete_comment()
	{
		if(User::can_delete(false,ANY_CATEGORY) and Url::get('id') and $item = DB::fetch('select * from comment where id = '.intval(Url::get('id'))))
		{
			save_recycle_bin('comment',$item);
			DB::delete('comment','id='.intval(Url::get('id')));
			save_log(Url::get('id'));
		}
		Url::redirect_current();	
	}
	function check_comment()
	{
		if(User::can_edit(false,ANY_CATEGORY) and  Url::get('id') and $comment = DB::fetch('select id,publish from comment where id='.intval(Url::sget('id'))))
		{
			DB::update('comment',array('publish'=>$comment['publish']==1?'0':'1'),'id='.intval(Url::sget('id')));
			Url::redirect_current(array('cmd'=>'success'));
		}
	}
}
?>