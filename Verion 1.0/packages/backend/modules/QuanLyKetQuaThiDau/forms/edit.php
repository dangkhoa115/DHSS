<?php
class EditQuanLyKetQuaThiDauForm extends Form{
	function EditQuanLyKetQuaThiDauForm(){
		Form::Form('EditQuanLyKetQuaThiDauForm');
		$this->add('ssnh_ket_qua_thi_dau.vong_dau_id',new TextType(true,'Chưa nhập vòng đấu',0,255)); 
	}
	function on_submit(){
		if($this->check() and URL::get('confirm_edit') and !Url::get('search')){
			require_once 'packages/core/includes/utils/vn_code.php';
			if(isset($_REQUEST['mi_ket_qua']) and Url::iget('vong_dau_id')){
				foreach($_REQUEST['mi_ket_qua'] as $key=>$record){
					//$record['thong_tin_tran_dau'] = nl2br($record['thong_tin_tran_dau']);
					//System::Debug($record);
					//exit();
					if($record['id']=='(auto)'){
						$record['id']=false;
					}
					$record['vong_dau_id'] = Url::iget('vong_dau_id');
					$record['mua_giai_id'] = DB::fetch('select mua_giai_id from ssnh_vong_dau where id = '.$record['vong_dau_id'].'','mua_giai_id');
					
					$record['thoi_gian'] = Date_Time::to_time($record['thoi_gian']);
					if($record['id'] and DB::exists_id('ssnh_ket_qua_thi_dau',$record['id'])){
						DB::update('ssnh_ket_qua_thi_dau',$record,'id='.$record['id']);
					}else{
						unset($record['id']);
						$record['id'] = DB::insert('ssnh_ket_qua_thi_dau',$record);
					}
				//	$this->save_item_image('anh_dai_dien_'.$key,$record['id']);
				}
				if (isset($ids) and sizeof($ids)){
					$_REQUEST['selected_ids'].=','.join(',',$ids);
				}
			}
			if(URL::get('deleted_ids')){
				$ids = explode(',',URL::get('deleted_ids'));
				foreach($ids as $id){
					DB::delete_id('ssnh_ket_qua_thi_dau',$id);
				}
			}
			$this->cache_bxh_clb();
			//update_mi_upload_file();
			//exit();
			Url::redirect_current(array('vong_dau_id','ids'));
		}
	}	
	function draw(){
		require_once 'packages/backend/includes/php/nguoi_choi.php';
		$this->map = array();
		$paging = '';
		
		if(!isset($_REQUEST['vong_dau_id']) and $vong_dau_id=get_vong_dau_theo_sms()){
			//$_REQUEST['vong_dau_id'] = $vong_dau_id;
		}
		$this->map['ban_thang'] = Url::get('vong_dau_id')?get_tong_ban_thang($_REQUEST['vong_dau_id']):'';
		$cond = 'ssnh_clb_mua_giai.mua_giai_id='.Session::get('mua_giai_id').'
				'.(Url::get('keyword')?' AND (
					dchn.ten LIKE "%'.Url::get('keyword').'%" OR dkh.ten LIKE "%'.Url::get('keyword').'%"
					or dchn.ten_viet_tat LIKE "%'.Url::get('keyword').'%" OR dkh.ten_viet_tat LIKE "%'.Url::get('keyword').'%"
				)':'').'
				'.(Url::get('ids')?' AND (kqtd.id IN ('.Url::get('ids').'))':'').'
				'.(Url::iget('vong_dau_id')?' AND kqtd.vong_dau_id = '.Url::iget('vong_dau_id').'':' AND 1=2').'
			';		
		//if(!isset($_REQUEST['mi_ket_qua']))
		{
			$item_per_page = 100;
			DB::query('
				select 
					count(distinct kqtd.id) as acount
				from 
					ssnh_ket_qua_thi_dau as kqtd
					inner join ssnh_cau_lac_bo AS dchn ON dchn.id = kqtd.doi_chu_nha_id
					inner join ssnh_cau_lac_bo AS dkh ON dkh.id = kqtd.doi_khach_id
					inner join ssnh_clb_mua_giai on ssnh_clb_mua_giai.clb_id = dchn.id
				where 
					'.$cond.'
			');
			$count = DB::fetch();
			
			require_once 'packages/core/includes/utils/paging.php';
			$paging = paging($count['acount'],$item_per_page);
			DB::query('
				select 
					kqtd.*
				from 
					ssnh_ket_qua_thi_dau as kqtd
					inner join ssnh_cau_lac_bo AS dchn ON dchn.id = kqtd.doi_chu_nha_id
					inner join ssnh_cau_lac_bo AS dkh ON dkh.id = kqtd.doi_khach_id
					inner join ssnh_clb_mua_giai on ssnh_clb_mua_giai.clb_id = dchn.id
				where 
					'.$cond.'
				order by 
					kqtd.so_thu_tu asc
				LIMIT
					'.((page_no()-1)*$item_per_page).','.$item_per_page.'
			');
			$mi_ket_qua = DB::fetch_all();
			foreach($mi_ket_qua as $key=>$value){
				$mi_ket_qua[$key]['thoi_gian'] = date('d/m/Y H:i',$value['thoi_gian']);
				$mi_ket_qua[$key]['thong_tin_tran_dau'] = str_replace(array("\t","\s","\n"),'',$value['thong_tin_tran_dau']);
			}
			if(Url::get('do')=='add'){
				$_REQUEST['mi_ket_qua'] = array();
			}else{
				$_REQUEST['mi_ket_qua'] = $mi_ket_qua;
			}
		}
		$this->map['paging'] = $paging;
		////////////////////////////////
		$sql = '
			select 
				ssnh_cau_lac_bo.id,ssnh_cau_lac_bo.ten
			from 
				ssnh_cau_lac_bo
				inner join ssnh_clb_mua_giai on ssnh_clb_mua_giai.clb_id = ssnh_cau_lac_bo.id
			where 
				ssnh_clb_mua_giai.mua_giai_id='.Session::get('mua_giai_id').'
			order by 
				ssnh_cau_lac_bo.so_thu_tu asc
		';
		$clbs = DB::fetch_all($sql);
		$this->map['doi_chu_nha_options'] = $clbs;
		$this->map['doi_chu_nha_options'] = '<option value="">Chọn CLB</option>';
		foreach($clbs as $key=>$value){
				$this->map['doi_chu_nha_options'] .= '<option value="'.$value['id'].'">'.$value['ten'].'</option>';
		}
		$this->map['doi_khach_options'] = $this->map['doi_chu_nha_options'];
		////////////////////////////////
		$vongdaus = get_vongdaus('ssnh_vong_dau.mua_giai_id='.Session::get('mua_giai_id'));
		$this->map['vong_dau_options'] = '<option value="">Chọn vòng đấu</option>';
		foreach($vongdaus as $key=>$value){
				$this->map['vong_dau_options'] .= '<option value="'.$value['id'].'" '.((Url::iget('vi_tri_id')==$key)?'selected':'').'>'.$value['ten'].'</option>';
		}
		$this->map['vongdaus'] = $vongdaus;
		$this->parse_layout('edit',$this->map);
	}
	function save_item_image($file,$id){
		require_once 'packages/core/includes/utils/upload_file.php';
		$dir = substr(PORTAL_ID,1).'/item/';
		if(isset($_FILES[$file]) and $_FILES[$file]){
			update_upload_file($file,$dir);
			$row = array();
			if(Url::get($file)){
				DB::update('ssnh_ket_qua_thi_dau',array('anh_dai_dien'=>Url::get($file)),'id='.$id);
			}
		}
	}
	function update_vi_tri($vi_tri_id,$cau_thu_id){
		$nam = date('Y');
		if($row = DB::fetch('select * from ssnh_vi_tri_theo_nam where nam='.$nam.' and cau_thu_id = '.$cau_thu_id.'')){
			DB::update('ssnh_vi_tri_theo_nam',array(
				'nam'=>$nam,
				'cau_thu_id'=>$cau_thu_id
			),'id='.$row['id']);
		}else{
			DB::insert('ssnh_vi_tri_theo_nam',array(
				'nam'=>$nam,
				'vi_tri_id'=>$vi_tri_id,
				'cau_thu_id'=>$cau_thu_id
			));
		}
	}
	function cache_bxh_clb(){
		$clbs = get_bangxephang('ssnh_clb_mua_giai.mua_giai_id='.Session::get('mua_giai_id').'',Session::get('mua_giai_id'));
		$path = 'cache/tables/bxh_clb.cache.php';
		$hand = fopen($path,'w+');
		fwrite($hand,'<?php $clbs = '.var_export($clbs,true).';?>');
		fclose($hand);
	}
}
?>