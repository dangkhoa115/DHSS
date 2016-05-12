<?php
class EditFunctionCategoryForm extends Form
{
	function EditFunctionCategoryForm()
	{
		Form::Form('EditFunctionCategoryForm');
		if(URL::get('cmd')=='edit')
		{
			$this->add('id',new IDType(true,'object_not_exists','function'));
		}
		$languages = DB::select_all('language');	
		foreach($languages as $language)
		{
			$this->add('name_'.$language['id'],new TextType(true,'invalid_name',0,2000)); 
			$this->add('description_'.$language['id'],new TextType(false,'invalid_description',0,200000)); 
		}
		$this->link_css('skins/default/css/tabs/tabpane.css');
	}
	function on_submit()
	{
		require_once 'packages/core/includes/utils/upload_file.php';
		$dir = 'default/icon/';
		update_upload_file('icon_url',$dir);
		if($this->check() and URL::get('confirm_edit'))
		{
				if(URL::get('cmd')=='edit')
				{
					$this->old_value = DB::select('function','id="'.addslashes($_REQUEST['id']).'"');
					if(file_exists($this->old_value['icon_url']))
					{
						@unlink($this->old_value['icon_url']);		
					}	
				}
				$this->save_item();
				Url::redirect_current(array('just_edited_id'=>$this->id));
		}
	}	
	function draw()
	{
		$languages = DB::select_all('language');
		require_once 'cache/config/status.php';
		require_once 'packages/core/includes/utils/category.php';
		$this->init_edit_mode();
		$this->get_parents();
		category_indent($this->parents);
		$this->parse_layout('edit',
			($this->edit_mode?$this->init_value:array())+
			array(
			'languages'=>$languages,
			'status_list'=>$status,
			'parent_id_list'=>String::get_list(FunctionCategoryDB::check_categories($this->parents)),
			'parent_id'=>($this->edit_mode?si_parent_id('function',$this->init_value['structure_id']):1)
			)
		);
	}
	function save_item()
	{
		$extra = array();
		$languages = DB::select_all('language');
		foreach($languages as $language)
		{
			$extra=$extra+array('name_'.$language['id']=>Url::get('name_'.$language['id'],1)); 
			$extra=$extra+array('group_name_'.$language['id']=>Url::get('group_name_'.$language['id'],1)); 
			$extra=$extra+array('description_'.$language['id']=>Url::get('description_'.$language['id'],1)); 
		}
		$new_row = $extra+
		array(
			'status', 
			'url'
		);
		if(Url::get('icon_url')!="")
		{
			$new_row['icon_url'] = Url::get('icon_url');
		}
		if(URL::get('cmd')=='edit')
		{
			$this->id = $_REQUEST['id'];
			DB::update_id('function', $new_row,$this->id);
			DB::update('function', array('status'=>Url::get('status')),''.IDStructure::child_cond($this->old_value['structure_id']).'');
			if($this->old_value['structure_id']!=ID_ROOT)
			{
				if (Url::check(array('parent_id')))
				{
					$parent = DB::select('function',$_REQUEST['parent_id']);
					if($parent['structure_id']==$this->old_value['structure_id'])
					{
						$this->error('id','invalid_parent');
					}
					else
					{
						require_once 'packages/core/includes/system/si_database.php';
						if(!si_move('function',$this->old_value['structure_id'],$parent['structure_id']))
						{
							$this->error('id','invalid_parent');
						}
					}
				}
			}
		}
		else
		{
			require_once 'packages/core/includes/system/si_database.php';
			if(isset($_REQUEST['parent_id']))
			{	
				$this->id = DB::insert('function', $new_row+array('structure_id'=>si_child('function',structure_id('function',$_REQUEST['parent_id']))));			
			}
			else
			{
				$this->id = DB::insert('function', $new_row+array('structure_id'=>ID_ROOT));		
			}				
		}
		save_log($this->id);
	}
	function init_edit_mode()
	{
		if(URL::get('cmd')=='edit' and $this->init_value= DB::fetch('select * from function where id='.intval(URL::sget('id')).''))
		{		
			foreach($this->init_value as $key=>$value)
			{
				if(is_string($value) and !isset($_REQUEST[$key]))
				{
					$_REQUEST[$key] = $value;
				}
			}
			$this->edit_mode = true;
		}
		else
		{
			$this->edit_mode = false;
		}
	}
	function get_parents()
	{
		require_once 'packages/core/includes/system/si_database.php';
		$sql = '
			select 
				id,
				structure_id
				,name_'.Portal::language().' as name  
			from 
			 	function
			where 
				1
			order by 
				structure_id
		';
		$items = DB::fetch_all($sql,false);
		foreach($items as $key=>$value){
			$level = IDStructure::level($value['structure_id']);
			$items[$key]['name'] = str_pad($value['name'],strlen($value['name']) + $level*3,'---',STR_PAD_LEFT);
		}
		$this->parents = $items;
	}	
}
?>