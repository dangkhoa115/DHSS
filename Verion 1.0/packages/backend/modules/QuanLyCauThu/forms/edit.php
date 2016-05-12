<?php
class EditQuanLyCauThuForm extends Form{
	function EditQuanLyCauThuForm(){
		Form::Form('EditQuanLyCauThuForm');
		$this->add('ssnh_cau_thu.ten',new TextType(true,'Lỗi nhập tên cầu thủ',0,255)); 
		$this->add('ssnh_cau_thu.clb_id',new TextType(true,'Lỗi nhập CLB',0,255)); 		
	}
	function on_submit(){
		if($this->check() and URL::get('confirm_edit') and !Url::get('search')){
			require_once 'packages/core/includes/utils/vn_code.php';
			if(isset($_REQUEST['mi_cau_thu'])){
				foreach($_REQUEST['mi_cau_thu'] as $key=>$record){
					//System::Debug($record);
					if($record['id']=='(auto)'){
						$record['id']=false;
					}
					$record['name_id'] = convert_utf8_to_url_rewrite($record['ten']);
					$vi_tri_id = isset($record['vi_tri_id'])?$record['vi_tri_id']:0;
					$clb_id = isset($record['clb_id'])?$record['clb_id']:0;
					if(isset($record['mua_giai_id']) and $record['mua_giai_id']){
						$mua_giai_id = $record['mua_giai_id'];
					}else{
						$mua_giai_id = 0;
					}
					$record['off'] = isset($record['off'])?1:0;
					unset($record['vi_tri_id']);
					unset($record['clb_id']);
					unset($record['mua_giai_id']);
					$cost = $record['cost'];
					unset($record['cost']);
					if($record['id'] and DB::exists_id('ssnh_cau_thu',$record['id'])){
						if($record['id']==126){
							//System::Debug($record);exit();
						}
						DB::update('ssnh_cau_thu',$record,'id='.$record['id']);
					}else{
						unset($record['id']);
						$record['id'] = DB::insert('ssnh_cau_thu',$record);
					}
					if($clb_id and $mua_giai_id and $record['id']){
						$this->update_clb($clb_id,$record['id'],$mua_giai_id);
					}
					if($vi_tri_id){
						$this->update_vi_tri($vi_tri_id,$record['id'],$cost,$mua_giai_id);
					}
					$this->save_item_image('anh_dai_dien_'.$key,$record['id']);
				}
				if (isset($ids) and sizeof($ids)){
					$_REQUEST['selected_ids'].=','.join(',',$ids);
				}
			}
			if(URL::get('deleted_ids')){
				$ids = explode(',',URL::get('deleted_ids'));
				foreach($ids as $id){
					$this->delete_cauthu($id);
				}
			}
			//exit();
			//update_mi_upload_file();
			Url::redirect_current(array('clb_id'));
		}
	}	
	function draw(){
		$this->map = array();
		$paging = '';
		$cond = 'ssnh_cau_thu_clb.mua_giai_id='.Session::get('mua_giai_id').'
				'.(Url::iget('clb_id')?' AND ssnh_cau_thu_clb.clb_id='.Url::iget('clb_id').'':'').'
				'.(Url::get('keyword')?' AND ssnh_cau_thu.ten LIKE "%'.Url::get('keyword').'%"':'').'
			';		
		//if(!isset($_REQUEST['mi_cau_thu']))
		{
			$item_per_page = 50;
			DB::query('
				select 
					count(distinct ssnh_cau_thu.id) as acount
				from 
					ssnh_cau_thu
					left outer join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id
					left outer join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id
					left outer join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
				where 
					'.$cond.'
			');
			$count = DB::fetch();
			$this->map['total'] = $count['acount'];
			require_once 'packages/core/includes/utils/paging.php';
			$paging = paging($count['acount'],$item_per_page);
			DB::query('
				select 
					distinct ssnh_cau_thu.id as id,ssnh_cau_thu.ten,ssnh_cau_thu.anh_dai_dien
					,ssnh_cau_thu.name_id,ssnh_cau_thu.ngay_sinh,ssnh_cau_thu.so_thu_tu,ssnh_cau_thu.so_ao
					,ssnh_cau_thu.chieu_cao,ssnh_cau_thu.can_nang,quoc_tich_id,ssnh_cau_thu.muc_luong
					,vttn.vi_tri_id,ssnh_cau_thu_clb.clb_id,ssnh_cau_thu_clb.mua_giai_id
					,vttn.cost
					,ssnh_cau_thu.off
				from 
					ssnh_cau_thu
					left outer join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id
					left outer join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id
					left outer join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
				where 
					'.$cond.'
				order by 
					ssnh_cau_thu.id DESC
				LIMIT
					'.((page_no()-1)*$item_per_page).','.$item_per_page.'
			');
			$mi_cau_thu = DB::fetch_all();
			$_REQUEST['mi_cau_thu'] = $mi_cau_thu;
		}
		$this->map['paging'] = $paging;
		////////////////////////////////
		$clbs = get_clbs(false,false);
		$this->map['clbs'] = $clbs;
		$this->map['clb_options'] = '<option value="">Chọn CLB</option>';
		foreach($clbs as $key=>$value){
				$this->map['clb_options'] .= '<option value="'.$value['id'].'" '.((Url::iget('clb_id')==$key)?'selected':'').'>'.$value['ten'].'</option>';
		}
		////////////////////////////////
		$vi_tris = get_vi_tris();
		$this->map['vi_tris'] = $vi_tris;
		$this->map['vi_tri_options'] = '<option value="">Chọn vị trí</option>';
		foreach($vi_tris as $key=>$value){
				$this->map['vi_tri_options'] .= '<option value="'.$value['id'].'" '.((Url::iget('vi_tri_id')==$key)?'selected':'').'>'.$value['ten'].'</option>';
		}
		////////////////////////////////
		$quoc_tichs = get_quoc_tichs();
		$this->map['quoc_tich_options'] = '<option value="">Chọn quốc tịch</option>';
		foreach($quoc_tichs as $key=>$value){
				$this->map['quoc_tich_options'] .= '<option value="'.$value['id'].'" '.((Url::iget('quoc_tich_id')==$key)?'selected':'').'>'.$value['ten'].'</option>';
		}
		////////////////////////////////
		$mua_giais = get_muagiais();
		$this->map['move_mua_giai_id_list'] = array(''=>'Chuyển theo') + String::get_list($mua_giais,'ten');
		//$this->map['ssnh_mua_giais'] = $clbs;
		$this->map['mua_giai_options'] = '<option value="">Chọn</option>';
		foreach($mua_giais as $key=>$value){
				$this->map['mua_giai_options'] .= '<option value="'.$value['id'].'" '.(($key==2)?' style="color:#f00 !important;"':'').'>'.$value['ten'].'</option>';
		}
		////////////////////////////////
		$this->parse_layout('edit',$this->map);
	}
	function save_item_image($file,$id){
		require_once 'packages/core/includes/utils/upload_file.php';
		$dir = substr(PORTAL_ID,1).'/item/';
		if(isset($_FILES[$file]) and $_FILES[$file]){
			update_upload_file($file,$dir);
			$row = array();
			if(Url::get($file)){
				DB::update('ssnh_cau_thu',array('anh_dai_dien'=>Url::get($file)),'id='.$id);
			}
		}
	}
	function update_vi_tri($vi_tri_id,$cau_thu_id,$cost,$mua_giai_id=2){
		$nam = date('Y');// nam='.$nam.' and 
		if($row = DB::fetch('select * from ssnh_vi_tri_theo_nam where cau_thu_id = '.$cau_thu_id.'')){
			DB::update('ssnh_vi_tri_theo_nam',array(
				'nam'=>$nam,
				'vi_tri_id'=>$vi_tri_id,
				'cau_thu_id'=>$cau_thu_id,
				'cost'=>$cost,
				'mua_giai_id'=>$mua_giai_id
			),'id='.$row['id']);
		}else{
			DB::insert('ssnh_vi_tri_theo_nam',array(
				'nam'=>$nam,
				'vi_tri_id'=>$vi_tri_id,
				'cau_thu_id'=>$cau_thu_id,
				'cost'=>$cost,
				'mua_giai_id'=>$mua_giai_id
			));
		}
	}
	function update_clb($clb_id,$cau_thu_id,$mua_giai_id){
		$nam = date('Y');
		if($row = DB::fetch('select * from ssnh_cau_thu_clb where cau_thu_id = '.$cau_thu_id.' and mua_giai_id='.$mua_giai_id.'')){
			DB::update('ssnh_cau_thu_clb',array(
				'clb_id'=>$clb_id,
				'cau_thu_id'=>$cau_thu_id,
				'mua_giai_id'=>$mua_giai_id
			),'id='.$row['id']);
		}else{
			DB::insert('ssnh_cau_thu_clb',array(
				'clb_id'=>$clb_id,
				'cau_thu_id'=>$cau_thu_id,				
				'mua_giai_id'=>$mua_giai_id
			));
		}
	}
	function delete_cauthu($id){
		DB::delete_id('ssnh_cau_thu',$id);
		DB::delete('ssnh_cau_thu_clb','cau_thu_id='.$id);
		DB::delete('ssnh_lich_su_cau_thu','cau_thu_id='.$id);
		//DB::delete_id('ssnh_cau_thu',$id);
	}
}
?>