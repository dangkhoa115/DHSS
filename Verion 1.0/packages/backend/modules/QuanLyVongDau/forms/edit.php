<?php
class EditQuanLyVongDauForm extends Form{
	function EditQuanLyVongDauForm(){
		Form::Form('EditQuanLyVongDauForm');
		$this->add('ssnh_vong_dau.ten',new TextType(true,'Chưa nhập tên vòng đấu',0,255)); 
	}
	function on_submit(){
		if($this->check() and URL::get('confirm_edit') and !Url::get('search')){
			require_once 'packages/core/includes/utils/vn_code.php';
			if(isset($_REQUEST['mi_vong_dau'])){
				foreach($_REQUEST['mi_vong_dau'] as $key=>$record){
					if($record['id']=='(auto)'){
						$record['id']=false;
					}
					if(Url::get('do')=='ct'){
						if(isset($record['nguoi_chien_thang'])){
							$nguoi_chien_thang = explode(',',$record['nguoi_chien_thang']);
							unset($record['nguoi_chien_thang']);
						}else{
							$nguoi_chien_thang = array();
						}
					}
					$record['name_id'] = convert_utf8_to_url_rewrite($record['ten']);
					
					if($record['id'] and DB::exists_id('ssnh_vong_dau',$record['id'])){
						DB::update('ssnh_vong_dau',$record,'id='.$record['id']);
					}else{
						unset($record['id']);
						$record['id'] = DB::insert('ssnh_vong_dau',$record);
					}
					/////
					if(Url::get('do')=='ct'){
						$this->update_chien_thang($record['id'],$nguoi_chien_thang);
					}
					//$this->save_item_image('anh_dai_dien_'.$key,$record['id']);
				}
				if (isset($ids) and sizeof($ids)){
					$_REQUEST['selected_ids'].=','.join(',',$ids);
				}
			}
			if(URL::get('deleted_ids')){
				$ids = explode(',',URL::get('deleted_ids'));
				foreach($ids as $id){
					DB::delete_id('ssnh_vong_dau',$id);
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
		$cond = 'ssnh_vong_dau.mua_giai_id='.Session::get('mua_giai_id').'
				'.(Url::get('keyword')?' AND ssnh_vong_dau.ten LIKE "%'.Url::get('keyword').'%"':'').'
			';		
		//if(!isset($_REQUEST['mi_vong_dau']))
		{
			$item_per_page = 100;
			DB::query('
				select 
					count(*) as acount
				from 
					ssnh_vong_dau
					left outer join ssnh_diem_nguoi_choi as dnc on dnc.vong_dau_id = ssnh_vong_dau.id
					left outer join ssnh_nguoi_choi as nc on nc.id = dnc.nguoi_choi_id and dnc.chien_thang = 1
				where 
					1=1
			');
			$count = DB::fetch();
			$this->map['total'] = $count['acount'];
			DB::query('
				select 
					count(distinct ssnh_vong_dau.id) as acount
				from 
					ssnh_vong_dau
				where 
					'.$cond.'
			');
			$count = DB::fetch();
			require_once 'packages/core/includes/utils/paging.php';
			$paging = paging($count['acount'],$item_per_page);
			$sql = '
				select 
					distinct ssnh_vong_dau.id,ssnh_vong_dau.ten,
					ssnh_vong_dau.disabled,
					ssnh_vong_dau.so_thu_tu,
					ssnh_vong_dau.tin_lien_quan_ids,					
					ssnh_vong_dau.tu_ngay,ssnh_vong_dau.den_ngay,
					ssnh_vong_dau.tu_ngay_sms,ssnh_vong_dau.den_ngay_sms,
					ssnh_vong_dau.mua_giai_id
				from 
					ssnh_vong_dau
				WHERE
					'.$cond.'
				GROUP BY
					ssnh_vong_dau.id
				order by 
					ssnh_vong_dau.so_thu_tu asc
				LIMIT
					'.((page_no()-1)*$item_per_page).','.$item_per_page.'
			';
			$mi_vong_dau = DB::fetch_all($sql);
			foreach($mi_vong_dau as $key=>$value){
				$mi_vong_dau[$key]['nguoi_chien_thang'] = $this->get_chien_thang($key);
			}
			$_REQUEST['mi_vong_dau'] = $mi_vong_dau;
		}
		$this->map['paging'] = $paging;
		////////////////////////////////
		$sql = '
			select 
				ssnh_cau_lac_bo.id,ssnh_cau_lac_bo.ten
			from 
				ssnh_cau_lac_bo
			where 
				1=1
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
		$sql = '
			select 
				ssnh_vi_tri_tren_san.id,ssnh_vi_tri_tren_san.ten,
				(select count(*) from ssnh_vong_dau inner join ssnh_vi_tri_theo_nam on ssnh_vi_tri_theo_nam.cau_thu_id = ssnh_vong_dau.id where ssnh_vi_tri_theo_nam.vi_tri_id = ssnh_vi_tri_tren_san.id) as sl_cau_thu
			from 
				ssnh_vi_tri_tren_san
			where 
				1=1
			order by 
				ssnh_vi_tri_tren_san.so_thu_tu asc
		';
		$clbs = DB::fetch_all($sql);
		$this->map['vi_tris'] = $clbs;
		$this->map['vi_tri_options'] = '<option value="">Chọn vị trí</option>';
		foreach($clbs as $key=>$value){
				$this->map['vi_tri_options'] .= '<option value="'.$value['id'].'" '.((Url::iget('vi_tri_id')==$key)?'selected':'').'>'.$value['ten'].'</option>';
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
				$this->map['mua_giai_options'] .= '<option value="'.$value['id'].'" '.((Session::get('mua_giai_id')==$key)?'selected':'').'>'.$value['ten'].'</option>';
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
				DB::update('ssnh_vong_dau',array('anh_dai_dien'=>Url::get($file)),'id='.$id);
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
	function update_chien_thang($vong_dau_id,$nguoi_chien_thang){
		$i=1;
		DB::update('ssnh_diem_nguoi_choi',array('chien_thang'=>0),'vong_dau_id='.$vong_dau_id.'');
		foreach($nguoi_chien_thang as $key=>$value){
			if($nguoichoi = DB::fetch('select id from ssnh_nguoi_choi where account_id = "'.$value.'"')){
				require_once 'packages/backend/includes/php/nguoi_choi.php';
				update_nguoi_chien_thang($vong_dau_id,$nguoichoi['id'],$i);
				$i++;
			}
		}
	}
	function get_chien_thang($vong_dau_id){
		$sql = '
		SELECT 
			dnc.id,
			dnc.diem,
			nc.account_id,
			nc.ten AS nguoi_choi,
			nc.id as nguoi_choi_id,
			nc.dien_thoai
		FROM
			ssnh_diem_nguoi_choi AS dnc
			INNER JOIN ssnh_nguoi_choi AS nc ON nc.id = dnc.nguoi_choi_id
		WHERE
			dnc.vong_dau_id = '.$vong_dau_id.'
			AND dnc.chien_thang
		GROUP BY
			dnc.id
		ORDER BY
			dnc.chien_thang
		';
		$items = DB::fetch_all($sql,'nguoi_choi_id');
		$str = '';
		foreach($items as $k=>$v) {
			$str .= ($str?',':'').$v['account_id'];
		}
		return $str;
	}
}
?>