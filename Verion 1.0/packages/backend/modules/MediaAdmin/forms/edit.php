<?php
class EditMediaAdminForm extends Form
{
	function EditMediaAdminForm()
	{
		Form::Form('EditMediaAdminForm');
		$this->add('name_1',new TextType(true,'invalid_name_1',0,255)); 
		$this->add('category_id',new TextType(false,'invalid_category_id',0,2000)); 
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
			$rows += array('description_'.$language['id']=>Url::get('description_'.$language['id'],1)); 
		}
		require_once 'packages/core/includes/utils/search.php';
		require_once 'packages/core/includes/utils/vn_code.php';
		$rows['keywords']=extend_search_keywords(convert_utf8_to_telex($rows['name_1']));
		$rows += array(
			'status'
			,'type'=>Url::get('type')
			,'tags'
			,'url'
			,'embed'
			,'category_id'
			,'hitcount'
			,'position'
			,'user_id'=>Session::get('user_id')
			,'portal_id'=>PORTAL_ID
			,'vong_dau_id'
			,'cap_dau_id'
			);			
			$name_id = convert_utf8_to_url_rewrite($rows['name_1']); 			
			$rows+=array('name_id'=>$name_id);
		return ($rows);
	}	
	function save_image($file,$id)
	{
		require_once 'packages/core/includes/utils/upload_file.php';
		$dir = substr(PORTAL_ID,1).'/media/';
		update_upload_file('image_url',$dir);
		$row = array();
		if(Url::get('image_url')!='')
		{
			$row['image_url'] =Url::get('image_url');
		}		
		DB::update_id('media',$row,$id);
	}
	function on_submit()
	{		
		if(Url::get('save') and $this->check())
		{
			$rows = $this->save_item();			
			if(Url::get('cmd')=='edit' and $item = DB::exists_id('media',Url::get('id')))
			{
				$id = intval(Url::get('id'));
				$rows += array('last_time_update'=>time());
				DB::update_id('media',$rows,$id);
			}
			else
			{
				$rows += array('time'=>time());
				$id = DB::insert('media',$rows);
			}
			$this->save_image($_FILES,$id);
			save_log($id);
			if($id)
			{
				echo '<script>if(confirm("'.Portal::language('update_success_are_you_continous').'")){location="'.Url::build_current(array('cmd'=>'add')).'";}else{location="'.Url::build_current(array('cmd'=>'list','just_edited_id'=>$id)).'";}</script>';
			}
		}
	}
	function draw()
	{		
		require_once 'cache/config/status.php';
		require_once Portal::template_js('core').'/tinymce/init_tinyMCE.php';
		$languages = DB::select_all('language');
		if(Url::get('cmd')=='edit' and Url::get('id') and $news = DB::exists_id('media',intval(Url::get('id'))))
		{
			foreach($news as $key=>$value)
			{
				if(is_string($value) and !isset($_REQUEST[$key]))
				{
					$_REQUEST[$key] = $value;
				}
			}
		}
		$categories = MediaAdminDB::get_category();
		require_once 'packages/backend/includes/php/ssnh.php';
		$vongdaus = get_vongdaus();
		$this->map['vong_dau_id_list'] = array('Chọn vọng đấu')+String::get_list($vongdaus,'ten');
		$vong_dau_id = Url::get('vong_dau_id')?Url::get('vong_dau_id'):0;
		$items = get_lichthidaus($vong_dau_id,30);
		$this->map['cap_dau_id_list'] = array('Chọn cặp đấu')+String::get_list($items,'cap_dau');
		$this->parse_layout('edit',$this->map+array(
			'status_list'=>$status,
			'languages'=>$languages,
			'category_id_list'=>array(''=>'Chọn danh mục')+String::get_list($categories)
		));
	}
}
?>
