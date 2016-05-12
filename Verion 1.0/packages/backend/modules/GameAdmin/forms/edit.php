<?php
class EditGameAdminForm extends Form
{
	function EditGameAdminForm()
	{
		Form::Form('EditGameAdminForm');
		$languages = DB::select_all('language');
		foreach($languages as $language)
		{
			//$this->add('name_'.$language['id'],new TextType(true,'invalid_name_'.$language['id'],0,2000)); 
		}
		$this->add('name_1',new TextType(true,'invalid_name_1',0,2000)); 
		$this->add('category_id',new TextType(true,'invalid_category_id',0,2000)); 
		$this->link_css('skins/default/css/cms.css');
		$this->link_css('skins/default/css/tabs/tabpane.css');
		$this->link_js('skins/default/css/tabs/tabpane.js');
	}
	function save_item()
	{
		$rows = array();
		$languages = DB::select_all('language');
		foreach($languages as $language)
		{
			$rows += array('name_'.$language['id']=>Url::get('name_'.$language['id'],1)); 
			$rows += array('brief_'.$language['id']=>Url::get('brief_'.$language['id'],1)); 
			$rows += array('description_'.$language['id']=>Url::get('description_'.$language['id'],1)); 
		}
		require_once 'packages/core/includes/utils/vn_code.php';
		require_once 'packages/core/includes/utils/search.php';
		$rows['keywords']=extend_search_keywords(convert_utf8_to_telex($rows['name_1'].' '.$rows['brief_1']));
		$rows += array(
			'category_id'
			,'publish'=>Url::get('publish')==1?1:0
			,'hitcount'
			,'status'
			,'type'=>'NEWS'
			,'author'
			,'front_page'
			,'show_image'
			,'pdf_icon'
			,'print_icon'
			,'email_icon'
			,'show_time'
			,'show_author'
			,'show_comment'
			,'tags'
			,'portal_id'=>PORTAL_ID
			);
			if(Url::get('position')=='')
			{
				$position = DB::fetch('select max(position)+1 as id from game where type="NEWS"');
				$rows['position'] = $position['id'];				
			}
			else
			{
				$rows['position'] = Url::get('position'); 
			}			
			$name_id = convert_utf8_to_url_rewrite($rows['name_1']); 			
			if(!DB::fetch('select name_id from game where name_id="'.$name_id.'" and portal_id="'.PORTAL_ID.'" and game.type="NEWS"'))
			{
				$rows+=array('name_id'=>$name_id);
			}
			else
			{
				if(Url::get('id') and Url::get('cmd')=='edit')
				{
					$rows+=array('name_id'=>$name_id);
				}
				else
				{
					$this->error('name','duplicate_name');
				}	
			}		
		return ($rows);
	}
	function save_image($file,$id)
	{
		require_once 'packages/core/includes/utils/upload_file.php';
		$dir = substr(PORTAL_ID,1).'/content/';		
		update_upload_file('small_thumb_url',$dir);
		update_upload_file('image_url',$dir);
		update_upload_file('file',$dir,'FILE');
		$row = array();
		if(Url::get('small_thumb_url')!='')
		{
			$row['small_thumb_url'] =Url::get('small_thumb_url');
		}
		if(Url::get('image_url')!='')
		{
			$row['image_url'] =Url::get('image_url');
		}
		if(Url::get('file')!='')
		{
			$row['file'] =Url::get('file');
		}
	
		DB::update_id('game',$row,$id);
	}
	function on_submit()
	{		
		if($this->check())
		{
			$rows = $this->save_item();
			if(!$this->is_error())
			{
				if(Url::get('cmd')=='edit' and $item = DB::exists_id('game',Url::get('id')))
				{
					$id = intval(Url::get('id'));
					$rows += array('last_time_update'=>time());
					DB::update_id('game',$rows,$id);
				}
				else
				{
					$rows += array('time'=>time(),'user_id'=>Session::get('user_id'));
					$id = DB::insert('game',$rows);
				}
				$this->save_image($_FILES,$id);
				save_log($id);
				if($id)
				{
					echo '<script>if(confirm("'.Portal::language('update_success_are_you_continous').'")){location="'.Url::build_current(array('cmd'=>'add')).'";}else{location="'.Url::build_current(array('cmd'=>'list','just_edited_id'=>$id)).'";}</script>';
				}
			}	
		}
	}
	function draw()
	{		
		//require_once Portal::template_js('core').'/tinymce/init_tinyMCE.php';
		require_once 'cache/config/status.php';
		$languages = DB::select_all('language');
		$arr = array('1'=>'YES','0'=>'NO');
		if(Url::get('cmd')=='edit' and Url::get('id') and $game = DB::exists_id('game',intval(Url::get('id'))))
		{
			foreach($game as $key=>$value)
			{
				if(is_string($value) and !isset($_REQUEST[$key]))
				{
					$_REQUEST[$key] = $value;
				}
			}
		}
		$categories = GameAdminDB::get_category();
		require_once 'packages/core/includes/utils/category.php';
		combobox_indent($categories);
		$this->parse_layout('edit',array(
			'category_id_list'=>String::get_list($categories),
			'status_list'=>$status,
			'languages'=>$languages,
			'show_image_list'=>$arr,
			'pdf_icon_list'=>$arr,
			'print_icon_list'=>$arr,
			'email_icon_list'=>$arr,
			'show_time_list'=>$arr,
			'show_author_list'=>$arr,
			'show_comment_list'=>$arr,
			'front_page_list'=>$arr
		));
	}
}
?>
