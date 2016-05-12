<?php
class EditQuanLyViTriForm extends Form{
	function EditQuanLyViTriForm(){
		Form::Form('EditQuanLyViTriForm');
		$this->add('ssnh_vi_tri_tren_san.name',new TextType(true,'invalid_name',0,255)); 
	}
	function on_submit(){
		if($this->check() and URL::get('confirm_edit')){
			require_once 'packages/core/includes/utils/vn_code.php';
			if(isset($_REQUEST['mi_clb'])){
				foreach($_REQUEST['mi_clb'] as $key=>$record){
					if($record['id']=='(auto)'){
						$record['id']=false;
					}
					$record['name_id'] = convert_utf8_to_url_rewrite($record['ten']);
					if($record['id'] and DB::exists_id('ssnh_vi_tri_tren_san',$record['id'])){
						DB::update('ssnh_vi_tri_tren_san',$record,'id='.$record['id']);
					}else{
						unset($record['id']);
						$record['id'] = DB::insert('ssnh_vi_tri_tren_san',$record);
					}
					$this->save_item_image('logo_'.$key,$record['id']);
				}
				if (isset($ids) and sizeof($ids)){
					$_REQUEST['selected_ids'].=','.join(',',$ids);
				}
			}
			if(URL::get('deleted_ids')){
				$ids = explode(',',URL::get('deleted_ids'));
				foreach($ids as $id){
					DB::delete_id('ssnh_vi_tri_tren_san',$id);
				}
			}
			//update_mi_upload_file();
			//exit();
			Url::redirect_current(array());
		}
	}	
	function draw(){
		$this->map = array();
		$paging = '';
		//if(!isset($_REQUEST['mi_clb']))
		{
			$cond = '1>0
				'.(Url::iget('id')?' AND ssnh_vi_tri_tren_san.id='.Url::iget('id').'':'').'
				'.(Url::get('keyword')?' AND ssnh_vi_tri_tren_san.ten LIKE "%'.Url::get('keyword').'%"':'').'
			';
			$item_per_page = 100;
			DB::query('
				select 
					count(*) as acount
				from 
					ssnh_vi_tri_tren_san
				where 
					'.$cond.'
			');
			$count = DB::fetch();
			require_once 'packages/core/includes/utils/paging.php';
			$paging = paging($count['acount'],$item_per_page);
			DB::query('
				select 
					ssnh_vi_tri_tren_san.*
				from 
					ssnh_vi_tri_tren_san
				where 
					'.$cond.'
				order by 
					ssnh_vi_tri_tren_san.so_thu_tu asc
				LIMIT
					'.((page_no()-1)*$item_per_page).','.$item_per_page.'
			');
			$mi_clb = DB::fetch_all();
			$_REQUEST['mi_clb'] = $mi_clb;
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
				DB::update('ssnh_vi_tri_tren_san',array('logo'=>Url::get($file)),'id='.$id);
			}
		}
	}
}
?>