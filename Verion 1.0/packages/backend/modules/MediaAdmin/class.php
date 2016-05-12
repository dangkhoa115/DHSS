<?php
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class MediaAdmin extends Module
{
	function MediaAdmin($row)
	{
		Module::Module($row);
		require_once 'db.php';
		$arr = array('photo_admin'=>'PHOTO','video_admin'=>'VIDEO');
		if(isset($arr[Url::sget('page')]))
		{
			$_REQUEST['type'] = $arr[Url::sget('page')];
		}
		else
		{
			$_REQUEST['type'] = 'PHOTO';
		}
		if(User::can_view(false,ANY_CATEGORY))
		{
			switch(Url::get('cmd'))
			{
				case 'add':
					$this->add_cmd();
					break;
				case 'edit':
					$this->edit_cmd();
					break;	
				case 'unlink':
					$this->delete_file();	
					break;		
				case 'make_slide':
					$this->make_slide();	
					break;		
				case 'view_slide':
					$this->view_slide();	
					break;				
				case 'slide_list':		
					$this->list_slide();
					break;
				default:
					$this->list_cmd();
					break;
			}
		}
		else
		{
			Url::access_denied();
		}
	}
	function view_slide()
	{
		if(User::can_edit(false,ANY_CATEGORY))
		{
			require_once 'forms/view.php';
			$this->add_form(new ViewSlideMediaAdminForm());
		}
		else
		{
			Url::access_denied();
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
	function list_slide()
	{
		if(User::can_admin(false,ANY_CATEGORY) and Url::sget('page')=='photo_admin')
		{
			require_once 'forms/slide_list.php';
			$this->add_form(new SlideListMediaAdminForm());
		}	
		else
		{
			Url::redirect_current();
		}	
	}
	function make_slide()
	{
		if(User::can_admin(false,ANY_CATEGORY) and Url::sget('page')=='photo_admin')
		{
			require_once 'forms/slide.php';
			$this->add_form(new MakeSlideMediaAdminForm());
		}	
		else
		{
			Url::redirect_current();
		}
	}
	function list_cmd()
	{
		require_once 'forms/list.php';
		$this->add_form(new ListMediaAdminForm());
	}
	function add_cmd()
	{
		if(User::can_add(false,ANY_CATEGORY))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditMediaAdminForm());
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
			$this->add_form(new EditMediaAdminForm());
		}	
		else
		{
			Url::access_denied();
		}
	}
}
?>
