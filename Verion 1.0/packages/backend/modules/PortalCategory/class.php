<?php 
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class PortalCATEGORY extends Module
{
	function PortalCATEGORY($row)
	{
		Module::Module($row);
		require_once 'db.php';
		$arr = array('news_category'=>'NEWS','video_category'=>'VIDEO','album'=>'PHOTO','clip_category'=>'MUSIC','game_category'=>'GAME');
		if(isset($arr[Url::sget('page')]))
		{
			$_REQUEST['type'] = $arr[Url::sget('page')];
		}
		$this->redirect_parameters = array('type');
		if(User::can_view(false,ANY_CATEGORY))
		{
			switch(URL::get('cmd'))
			{			
			case 'export_cache':				
				$this->export_cache();
				break;
			case 'delete':				
				$this->delete_cmd();
				break;
			case 'edit':				
				$this->edit_cmd();
				break;
			case 'unlink':
				$this->delete_file();		
			case 'add':				
				$this->add_cmd();
				break;
			case 'view':
				$this->view_cmd();
				break;
			case 'move_up':
			case 'move_down':
				$this->move_cmd();
				break;
			default: 
				$this->list_cmd();
				break;
			}
		}
		else
		{
			URL::access_denied();
		}
	}	
	function export_cache()
	{
		if(User::can_view(false,ANY_CATEGORY))
		{
			$this->export();
			Url::redirect_current();
		}
	}
	// tao cache file voi category va zone
	function export()
	{
		require 'packages/core/includes/utils/category.php';
		$m_categogies = $categogies_ = $categogies = PortalCategoryDB::get_categories(ID_ROOT,'AND STATUS="HOME"');
		$categogies = convert_item_cat_to_ul($categogies);
		$path = 'cache/tables/categories.cache.php';
		$hand = fopen($path,'w+');
		fwrite($hand,'<?php $categogies = '.var_export($categogies,true).';?>');
		fclose($hand);
		// for footer
		$path = 'cache/tables/footer_categories.cache.php';
		$hand = fopen($path,'w+');
		$categogies_ = convert_item_cat_to_ul($categogies_,false,false,true);
		fwrite($hand,'<?php $footer_categories = '.var_export($categogies_,true).';?>');
		fclose($hand);
		// for mobile
		$path = 'cache/tables/m.categories.cache.php';
		$hand = fopen($path,'w+');
		$m_categogies = convert_item_cat_to_ul($m_categogies,false,false,false);
		fwrite($hand,'<?php $categogies = '.var_export($m_categogies,true).';?>');
		fclose($hand);
	}
	function delete_file(){
		if(Url::get('link') and file_exists(Url::get('link')) and User::can_delete(false,ANY_CATEGORY)){
			@unlink(Url::get('link'));
		}
		echo '<script>window.close();</script>';
	}
	function add_cmd()
	{
		if(User::can_add(false,ANY_CATEGORY))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditPortalCategoryForm());
		}
		else
		{
			Url::redirect_current();
		}
	}
	function delete_cmd()
	{
		if(is_array(URL::get('selected_ids')) and sizeof(URL::get('selected_ids'))>0 and User::can_delete(false,ANY_CATEGORY))
		{
			if(sizeof(URL::get('selected_ids'))>1)
			{
				require_once 'forms/list.php';
				$this->add_form(new ListPortalCategoryForm());
			}
			else
			{
				$ids = URL::get('selected_ids');
				$_REQUEST['id'] = $ids[0];
				require_once 'forms/detail.php';
				$this->add_form(new PortalCategoryForm());
			}
		}
		else
		if(User::can_delete(false,ANY_CATEGORY) and Url::check('id') and DB::exists_id('category',$_REQUEST['id']))
		{
			require_once 'forms/detail.php';
			$this->add_form(new PortalCategoryForm());
		}
		else
		{
			Url::redirect_current();
		}
	}
	function edit_cmd()
	{
		if(Url::get('id') and $category=DB::fetch('select id,structure_id from category where id='.intval(Url::get('id'))) and User::can_edit(false,$category['structure_id']))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditPortalCategoryForm());
		}
		else
		{
			Url::redirect_current();
		}
	}
	function list_cmd()
	{
		require_once 'forms/list.php';
		$this->add_form(new ListPortalCategoryForm());
	}
	function view_cmd()
	{
		if(User::can_view_detail(false,ANY_CATEGORY) and Url::check('id') and DB::exists_id('category',$_REQUEST['id']))
		{
			require_once 'forms/detail.php';
			$this->add_form(new PortalCategoryForm());
		}
		else
		{
			Url::redirect_current();
		}
	}
	function move_cmd()
	{
		if(User::can_edit(false,ANY_CATEGORY)and Url::check('id')and $category=DB::exists_id('category',$_REQUEST['id']))
		{
			if($category['structure_id']!=ID_ROOT)
			{
				require_once 'packages/core/includes/system/si_database.php';
				si_move_position('category',' and portal_id="'.PORTAL_ID.'"');
			}
			Url::redirect_current();
		}
		else
		{
			Url::redirect_current();
		}
	}
}
?>