<?php
class EditNewsAdminForm extends Form{
	function EditNewsAdminForm(){
		Form::Form('EditNewsAdminForm');
		//$languages = DB::select_all('language');
		$this->add('name_1',new TextType(true,'invalid_name_1',0,255)); 
		$this->add('category_id',new TextType(true,'invalid_category_id',0,2000)); 
		$this->link_css('skins/default/css/cms.css');
		$this->link_css('skins/default/css/tabs/tabpane.css');
		$this->link_js('skins/default/css/tabs/tabpane.js');
	}
	function save_item(){
		$rows = array();
		$dest = Url::get('description_1',1);
		$rows += array('name_1'=>Url::get('name_1',1)); 
		$rows += array('brief_1'=>Url::get('brief_1',1)); 
		$rows += array('site_title'=>Url::get('site_title'));
		$rows += array('description_1'=>$this->set_autolink($dest)); 
		require_once 'packages/core/includes/utils/vn_code.php';
		require_once 'packages/core/includes/utils/search.php';
		
		$rows['keywords'] = Url::get('keywords')?Url::get('keywords'):str_replace(array(' ','"','\'','-','“','”',':'),array(',','','','','','',''),strtolower($rows['name_1']));
		//extend_search_keywords(convert_utf8_to_telex($rows['name_1'].' '.$rows['brief_1']));
		$rows += array(
			'category_id'
			,'publish'=>Url::get('publish')==1?1:0
			,'hitcount'
			,'status'
			,'type'=>'NEWS'
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
			if(Url::get('position')==''){
				$position = DB::fetch('select max(position)+1 as id from news where type="NEWS"');
				$rows['position'] = $position['id'];				
			}
			else{
				$rows['position'] = Url::get('position'); 
			}			
			$name_id = convert_utf8_to_url_rewrite($rows['name_1']); 			
			if(!DB::fetch('select name_id from news where name_id LIKE "%'.$name_id.'%" and portal_id="'.PORTAL_ID.'" and news.type="NEWS"')){
				$rows+=array('name_id'=>$name_id);
			}
			else{
				if(Url::get('id') and Url::get('cmd')=='edit'){
					$rows+=array('name_id'=>$name_id);
				}
				else{
					$this->error('name','duplicate_name');
				}	
			}		
		return ($rows);
	}
	function save_image($file,$id){
		require_once 'packages/core/includes/utils/upload_file.php';
		$dir = substr(PORTAL_ID,1).'/content/anh_dai_dien';		
		update_upload_file('small_thumb_url',$dir);
		update_upload_file('image_url',$dir);
		update_upload_file('file',$dir,'FILE');
		$row = array();
		if(Url::get('small_thumb_url')!=''){
			$row['small_thumb_url'] =Url::get('small_thumb_url');
		}
		if(Url::get('image_url')!=''){
			$row['image_url'] =Url::get('image_url');
		}
		if(Url::get('file')!=''){
			$row['file'] =Url::get('file');
		}
	
		DB::update_id('news',$row,$id);
	}
	function on_submit(){		
		if($this->check()){
			$rows = $this->save_item();
			if(!$this->is_error()){
				if(Url::get('cmd')=='edit' and $item = DB::exists_id('news',Url::get('id'))){
					$id = intval(Url::get('id'));
					$rows += array('last_time_update'=>time());
					DB::update_id('news',$rows,$id);
				}
				else{
					$rows += array('time'=>time(),'user_id'=>Session::get('user_id'));
					$id = DB::insert('news',$rows);
				}
				$this->save_image($_FILES,$id);
				
				save_log($id);
				if($id){
					echo '<script>location="'.Url::build_current(array('just_edited_id'=>$id)).'";</script>';
				}
			}	
		}
	}
	function draw(){		
		//require_once Portal::template_js('core').'/tinymce/init_tinyMCE.php';
		require_once 'cache/config/status.php';
		$languages = DB::select_all('language');
		$arr = array('1'=>'YES','0'=>'NO');
		if(Url::get('cmd')=='edit' and Url::get('id') and $news = DB::exists_id('news',intval(Url::get('id')))){
			foreach($news as $key=>$value){
				if(is_string($value) and !isset($_REQUEST[$key])){
					$_REQUEST[$key] = $value;
				}
			}
		}
		$categories = NewsAdminDB::get_category();
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
	function set_autolink($content){
		$str = Portal::get_setting('auto_link')."\n";
		require_once 'packages/backend/includes/php/ssnh.php';
		$clbs = get_clbs();
		foreach($clbs as $key=>$value){
			$str .= $value['ten'].'=>clb/'.$value['name_id'].'.html'."\n";
		}
		if($str){
			$arr = explode("\n",$str);
			foreach($arr as $key=>$value){
				$tmp_arr = explode("=>",$value);
				if($value){
					if(preg_match("/\<a ([^\>]+)\>$tmp_arr[0]<\/a\>/",$content)){
						break;
					}else{
						if(isset($tmp_arr[1]) and $tmp_arr[1]){
							$content = preg_replace("/".$tmp_arr[0]."/","<a class=\"no-highlight\" target=\"_blank\" href=\"$tmp_arr[1]\" title=\"$tmp_arr[0]\">$tmp_arr[0]</a>",$content,1);	
							break;
						}
					}
				}
			}
		}
		return $content;
	}
}
?>
