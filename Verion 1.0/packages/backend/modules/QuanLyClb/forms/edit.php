<?php
class EditQuanLyClbForm extends Form{
	function EditQuanLyClbForm(){
		Form::Form('EditQuanLyClbForm');
		$this->add('ssnh_cau_lac_bo.name',new TextType(true,'invalid_name',0,255)); 
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
					$mua_giai_id = $record['mua_giai_id'];
					unset($record['mua_giai_id']);
					if($record['id'] and DB::exists_id('ssnh_cau_lac_bo',$record['id'])){
						DB::update('ssnh_cau_lac_bo',$record,'id='.$record['id']);
					}else{
						unset($record['id']);
						$record['id'] = DB::insert('ssnh_cau_lac_bo',$record);
					}
					if($record['id'] and $mua_giai_id){
						$this->update_mua_giai($mua_giai_id,$record['id']);
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
					//DB::delete_id('ssnh_cau_lac_bo',$id);
					if(!DB::exists('select id from ssnh_clb_mua_giai where clb_id='.$id.'')){
						DB::delete_id('ssnh_cau_lac_bo',$id);
					}
					DB::delete('ssnh_clb_mua_giai','clb_id='.$id.' and mua_giai_id = '.Session::get('mua_giai_id').'');
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
			$cond = 'ssnh_mua_giai.id='.Session::get('mua_giai_id').'
				'.(Url::iget('id')?' AND ssnh_cau_lac_bo.id='.Url::iget('id').'':'').'
				'.(Url::get('keyword')?' AND ssnh_cau_lac_bo.ten LIKE "%'.Url::get('keyword').'%"':'').'
			';
			$item_per_page = 100;
			DB::query('
				select 
					count(*) as acount
				from 
					ssnh_cau_lac_bo
					left outer join ssnh_clb_mua_giai on ssnh_clb_mua_giai.clb_id = ssnh_cau_lac_bo.id
					left outer join ssnh_mua_giai on ssnh_mua_giai.id = ssnh_clb_mua_giai.mua_giai_id
				where 
					'.$cond.'
			');
			$count = DB::fetch();
			require_once 'packages/core/includes/utils/paging.php';
			$paging = paging($count['acount'],$item_per_page);
			DB::query('
				select 
					ssnh_cau_lac_bo.*,ssnh_clb_mua_giai.mua_giai_id
				from 
					ssnh_cau_lac_bo
					left outer join ssnh_clb_mua_giai on ssnh_clb_mua_giai.clb_id = ssnh_cau_lac_bo.id
					left outer join ssnh_mua_giai on ssnh_mua_giai.id = ssnh_clb_mua_giai.mua_giai_id
				where 
					'.$cond.'
				order by 
					ssnh_clb_mua_giai.mua_giai_id desc,ssnh_cau_lac_bo.so_thu_tu asc
				LIMIT
					'.((page_no()-1)*$item_per_page).','.$item_per_page.'
			');
			$mi_clb = DB::fetch_all();
			$_REQUEST['mi_clb'] = $mi_clb;
		}
		////////////////////////////////
		$sql = '
			select 
				ssnh_mua_giai.*				
			from 
				ssnh_mua_giai
			where 
				1=1
			order by 
				ssnh_mua_giai.tu_ngay
		';
		$clbs = DB::fetch_all($sql);
		//$this->map['ssnh_mua_giais'] = $clbs;
		$this->map['mua_giai_options'] = '<option value="">Chọn</option>';
		foreach($clbs as $key=>$value){
				$this->map['mua_giai_options'] .= '<option value="'.$value['id'].'">'.$value['ten'].'</option>';
		}
		////////////////////////////////
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
				DB::update('ssnh_cau_lac_bo',array('logo'=>Url::get($file)),'id='.$id);
			}
		}
	}
	function update_mua_giai($mua_giai_id,$clb_id){
		if($row = DB::fetch('select * from ssnh_clb_mua_giai where mua_giai_id='.$mua_giai_id.' and clb_id = '.$clb_id.'')){
			DB::update('ssnh_clb_mua_giai',array(
				'mua_giai_id'=>$mua_giai_id,
				'clb_id'=>$clb_id
			),'id='.$row['id']);
		}else{
			DB::insert('ssnh_clb_mua_giai',array(
				'mua_giai_id'=>$mua_giai_id,
				'clb_id'=>$clb_id
			));
		}
	}
}
?>