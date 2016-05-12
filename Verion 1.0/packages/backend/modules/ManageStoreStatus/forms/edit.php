<?php
class EditManageStoreStatusForm extends Form{
	function EditManageStoreStatusForm(){
		Form::Form('EditManageStoreStatusForm');
		$this->add('store_status.name',new TextType(true,'invalid_name',0,255)); 
	}
	function on_submit(){
		if($this->check() and URL::get('confirm_edit')){
			if(isset($_REQUEST['mi_store_status'])){
				foreach($_REQUEST['mi_store_status'] as $key=>$record){
					if($record['id']=='(auto)'){
						$record['id']=false;
					}
					if($record['id'] and DB::exists_id('store_status',$record['id'])){
						DB::update('store_status',$record,'id='.$record['id']);
					}else{
						unset($record['id']);
						$record['id'] = DB::insert('store_status',$record);
					}
				}
				if (isset($ids) and sizeof($ids)){
					$_REQUEST['selected_ids'].=','.join(',',$ids);
				}
			}
			if(URL::get('deleted_ids')){
				$ids = explode(',',URL::get('deleted_ids'));
				foreach($ids as $id){
					DB::delete_id('store_status',$id);
					DB::delete_id('store_status_item','where status_id = '.$id.'');
				}
			}
			//update_mi_upload_file();
			Url::redirect_current(array());
		}
	}	
	function draw(){
		$this->map = array();
		$paging = '';
		if(!isset($_REQUEST['mi_store_status'])){
			$cond = '
			1>0 '
			;
			$item_per_page = 20;
			DB::query('
				select 
					count(*) as acount
				from 
					store_status
				where 
					'.$cond.'
			');
			$count = DB::fetch();
			require_once 'packages/core/includes/utils/paging.php';
			$paging = paging($count['acount'],$item_per_page);
			DB::query('
				select 
					store_status.*
				from 
					store_status
				where 
					'.$cond.'
				order by 
					name asc
				LIMIT
					'.((page_no()-1)*$item_per_page).','.$item_per_page.'
			');
			$mi_store_status = DB::fetch_all();
			$_REQUEST['mi_store_status'] = $mi_store_status;
		}
		$this->map['paging'] = $paging;
		$this->parse_layout('edit',$this->map);
	}
}
?>