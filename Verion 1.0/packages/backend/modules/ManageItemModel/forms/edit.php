<?php
class EditManageItemModelForm extends Form{
	function EditManageItemModelForm(){
		Form::Form('EditManageItemModelForm');
		$this->add('item_model.name',new TextType(true,'invalid_name',0,255)); 
	}
	function on_submit(){
		if($this->check() and URL::get('confirm_edit')){
			//require_once 'packages/core/includes/utils/vn_code.php';
			if(isset($_REQUEST['mi_model'])){
				foreach($_REQUEST['mi_model'] as $key=>$record){
					if($record['id']=='(auto)'){
						$record['id']=false;
					}
					//$record['name_id'] = convert_utf8_to_url_rewrite($record['name']);
					if($record['id'] and DB::exists_id('item_model',$record['id'])){
						DB::update('item_model',$record,'id='.$record['id']);
					}else{
						unset($record['id']);
						DB::insert('item_model',$record);
					}
				}
				if (isset($ids) and sizeof($ids)){
					$_REQUEST['selected_ids'].=','.join(',',$ids);
				}
			}
			if(URL::get('deleted_ids')){
				$ids = explode(',',URL::get('deleted_ids'));
				foreach($ids as $id){
					DB::delete_id('item_model',$id);
				}
			}
			Url::redirect_current(array());
		}
	}	
	function draw(){
		$this->map = array();
		$paging = '';
		if(!isset($_REQUEST['mi_model'])){
			$cond = '
			1>0 '
			;
			$item_per_page = 100;
			DB::query('
				select 
					count(*) as acount
				from 
					item_model
				where 
					'.$cond.'
			');
			$count = DB::fetch();
			require_once 'packages/core/includes/utils/paging.php';
			$paging = paging($count['acount'],$item_per_page);
			$sql = '
				select 
					item_model.*
				from 
					item_model
					LEFT OUTER JOIN item_maker ON item_maker.id = item_model.maker_id
				where 
					'.$cond.'
				order by 
					item_maker.name,item_model.name ASC
				LIMIT
					'.((page_no()-1)*$item_per_page).','.$item_per_page.'
			';
			$mi_model = DB::fetch_all($sql);
			$_REQUEST['mi_model'] = $mi_model;
		}
		$this->map['paging'] = $paging;
		DB::query('select id, name from item_maker order by name');
		$db_items = DB::fetch_all();
		$maker_id_options = '';
		foreach($db_items as $item)
		{
			$maker_id_options .= '<option value="'.$item['id'].'">'.$item['name'].'</option>';
		}
		$this->map['maker_id_options'] = $maker_id_options;
		$this->parse_layout('edit',$this->map);
	}
}
?>