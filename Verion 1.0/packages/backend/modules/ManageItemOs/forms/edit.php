<?php
class EditManageItemOsForm extends Form{
	function EditManageItemOsForm(){
		Form::Form('EditManageItemOsForm');
		$this->add('item_os.name',new TextType(true,'invalid_name',0,255)); 
	}
	function on_submit(){
		if($this->check() and URL::get('confirm_edit')){
			require_once 'packages/core/includes/utils/vn_code.php';
			if(isset($_REQUEST['mi_maker'])){
				foreach($_REQUEST['mi_maker'] as $key=>$record){
					if($record['id']=='(auto)'){
						$record['id']=false;
					}
					$record['name_id'] = convert_utf8_to_url_rewrite($record['name']);
					if($record['id'] and DB::exists_id('item_os',$record['id'])){
						DB::update('item_os',$record,'id='.$record['id']);
					}else{
						unset($record['id']);
						$record['id'] = DB::insert('item_os',$record);
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
					DB::delete_id('item_os',$id);
				}
			}
			//update_mi_upload_file();
			Url::redirect_current(array());
		}
	}	
	function draw(){
		$this->map = array();
		$paging = '';
		if(!isset($_REQUEST['mi_maker'])){
			$cond = '
			1>0 '
			;
			$item_per_page = 20;
			DB::query('
				select 
					count(*) as acount
				from 
					item_os
				where 
					'.$cond.'
			');
			$count = DB::fetch();
			require_once 'packages/core/includes/utils/paging.php';
			$paging = paging($count['acount'],$item_per_page);
			DB::query('
				select 
					item_os.*
				from 
					item_os
				where 
					'.$cond.'
				order by 
					name asc
				LIMIT
					'.((page_no()-1)*$item_per_page).','.$item_per_page.'
			');
			$mi_maker = DB::fetch_all();
			$_REQUEST['mi_maker'] = $mi_maker;
		}
		$this->map['paging'] = $paging;
		$this->parse_layout('edit',$this->map);
	}
	function save_item_image($file,$id){
		require_once 'packages/core/includes/utils/upload_file.php';
		$dir = substr(PORTAL_ID,1).'/item/';
		if(isset($_FILES[$file]) and $_FILES[$file]){
			update_upload_file($file,$dir);
			$row = array();
			if(Url::get($file)){
				DB::update('item_os',array('icon_url'=>Url::get($file)),'id='.$id);
			}
		}
	}
}
?>