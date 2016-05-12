<?php
class EditManageSlideForm extends Form{
	function EditManageSlideForm(){
		Form::Form('EditManageSlideForm');
		$this->add('slide.name',new TextType(true,'invalid_name',0,255)); 
	}
	function on_submit(){
		if($this->check() and URL::get('confirm_edit')){
			require_once 'packages/core/includes/utils/vn_code.php';
			if(isset($_REQUEST['mi_slide'])){
				foreach($_REQUEST['mi_slide'] as $key=>$record){
					if($record['id']=='(auto)'){
						$record['id']=false;
					}
					if($record['id'] and DB::exists_id('slide',$record['id'])){
						DB::update('slide',$record,'id='.$record['id']);
					}else{
						unset($record['id']);
						$record['id'] = DB::insert('slide',$record);
					}
					$this->save_item_image('image_url_'.$key,$record['id']);
				}
				if (isset($ids) and sizeof($ids)){
					$_REQUEST['selected_ids'].=','.join(',',$ids);
				}
			}
			if(URL::get('deleted_ids')){
				$ids = explode(',',URL::get('deleted_ids'));
				foreach($ids as $id){
					DB::delete_id('slide',$id);
				}
			}
			//update_mi_upload_file();
			Url::redirect_current(array());
		}
	}	
	function draw(){
		$this->map = array();
		$paging = '';
		if(!isset($_REQUEST['mi_slide'])){
			$cond = '
			1>0 '
			;
			$item_per_page = 20;
			DB::query('
				select 
					count(*) as acount
				from 
					slide
				where 
					'.$cond.'
			');
			$count = DB::fetch();
			require_once 'packages/core/includes/utils/paging.php';
			$paging = paging($count['acount'],$item_per_page);
			DB::query('
				select 
					slide.id,slide.name,slide.position,slide.href,slide.image_url as icon_url
				from 
					slide
				where 
					'.$cond.'
				order by 
					name asc
				LIMIT
					'.((page_no()-1)*$item_per_page).','.$item_per_page.'
			');
			$mi_slide = DB::fetch_all();
			$_REQUEST['mi_slide'] = $mi_slide;
		}
		$this->map['paging'] = $paging;
		$this->parse_layout('edit',$this->map);
	}
	function save_item_image($file,$id){
		require_once 'packages/core/includes/utils/upload_file.php';
		$dir = substr(PORTAL_ID,1).'/item/';
		if(isset($_FILES[$file]) and $_FILES[$file]){
			update_upload_file($file, $dir,$type='IMAGE',$old_file=false,$new_width=130,$new_height=55);
			$row = array();
			if(Url::get($file)){
				if($image_url = DB::fetch('select image_url from slide where id = '.$id.'','image_url')){
					$thumb_url = str_replace('image_url','thumb_url',$image_url);
					if(file_exists($image_url)){
						unlink($image_url);
					}
					if(file_exists($thumb_url)){
						unlink($thumb_url);
					}
				}
				DB::update('slide',array('image_url'=>Url::get($file)),'id='.$id);
			}
		}
	}
}
?>