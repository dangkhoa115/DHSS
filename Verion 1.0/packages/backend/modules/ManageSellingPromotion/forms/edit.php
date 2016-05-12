<?php
class EditManageSellingPromotionForm extends Form{
	function EditManageSellingPromotionForm(){
		Form::Form('EditManageSellingPromotionForm');
		$this->add('selling_promotion.name',new TextType(true,'invalid_name',0,255)); 
	}
	function on_submit(){
		if($this->check() and URL::get('confirm_edit')){
			if(isset($_REQUEST['mi_selling_promotion'])){
				foreach($_REQUEST['mi_selling_promotion'] as $key=>$record){
					if($record['id']=='(auto)'){
						$record['id']=false;
					}
					if($record['id'] and DB::exists_id('selling_promotion',$record['id'])){
						DB::update('selling_promotion',$record,'id='.$record['id']);
					}else{
						unset($record['id']);
						$record['id'] = DB::insert('selling_promotion',$record);
					}
				}
				if (isset($ids) and sizeof($ids)){
					$_REQUEST['selected_ids'].=','.join(',',$ids);
				}
			}
			if(URL::get('deleted_ids')){
				$ids = explode(',',URL::get('deleted_ids'));
				foreach($ids as $id){
					DB::delete_id('selling_promotion',$id);
					DB::delete_id('selling_promotion_item','where status_id = '.$id.'');
				}
			}
			//update_mi_upload_file();
			Url::redirect_current(array());
		}
	}	
	function draw(){
		$this->map = array();
		$paging = '';
		if(!isset($_REQUEST['mi_selling_promotion'])){
			$cond = '
			1>0 '
			;
			$item_per_page = 20;
			DB::query('
				select 
					count(*) as acount
				from 
					selling_promotion
				where 
					'.$cond.'
			');
			$count = DB::fetch();
			require_once 'packages/core/includes/utils/paging.php';
			$paging = paging($count['acount'],$item_per_page);
			DB::query('
				select 
					selling_promotion.*
				from 
					selling_promotion
				where 
					'.$cond.'
				order by 
					name asc
				LIMIT
					'.((page_no()-1)*$item_per_page).','.$item_per_page.'
			');
			$mi_selling_promotion = DB::fetch_all();
			$_REQUEST['mi_selling_promotion'] = $mi_selling_promotion;
		}
		$this->map['paging'] = $paging;
		$this->parse_layout('edit',$this->map);
	}
}
?>