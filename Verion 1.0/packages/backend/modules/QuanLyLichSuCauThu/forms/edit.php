<?php
class EditQuanLyLichSuCauThuForm extends Form{
	function EditQuanLyLichSuCauThuForm(){
		Form::Form('EditQuanLyLichSuCauThuForm');
		//$this->add('ssnh_cau_thu.ten',new TextType(true,'Lỗi nhập tên cầu thủ',0,255)); 
	}
	function on_submit(){
		//System::Debug($_REQUEST);exit();
		if(URL::get('confirm_edit') and !Url::get('search')){
			//echo 1;exit();
			if(isset($_REQUEST['mi_lich_su']) and Url::iget('clb_id') and Url::iget('vong_dau_id')){
				$type = 'multi update';
				$title = 'Cập nhật lịch sửa cầu thủ';
				$description = '';
				foreach($_REQUEST['mi_lich_su'] as $key=>$record){
					$record['clb_id'] = Url::iget('clb_id');
					$record['vong_dau_id'] = Url::iget('vong_dau_id');
					if(Url::get('doi_cao_nhat') or isset($record['cao_nhat'])){
						$record['cao_nhat'] = isset($record['cao_nhat'])?1:0;
					}
					$record['cao_nhat_doi'] = isset($record['cao_nhat_doi'])?1:0;
					unset($record['ten']);
					unset($record['ma_vi_tri']);
					if($record['id']=='(auto)'){
						$record['id']=false;
					}
					if($record['id'] and DB::select('ssnh_lich_su_cau_thu','id="'.$record['id'].'"')){
						DB::update('ssnh_lich_su_cau_thu',$record,'id='.$record['id']);
					}else{
						unset($record['id']);
						$record['id'] = DB::insert('ssnh_lich_su_cau_thu',$record);
					}
					if(isset($record['cao_nhat']) and $record['cao_nhat'] == 1 and $record['clb_id']){
						require_once ROOT_PATH.'packages/backend/includes/php/nguoi_choi.php';
						update_diem_nguoi_choi($record['vong_dau_id'],$record['clb_id']);
						require_once 'packages/fmgame/includes/php/fmgame.php';
						FMGAME::cache_power($record['vong_dau_id']);
						//update_diem_nguoi_choi($record['vong_dau_id'],$record['clb_id'],'_beta');
					}
					$description .= (str_replace("&","<br>",http_build_query($record)))."\n<br>";
					$this->save_item_image('anh_dai_dien_'.$key,$record['id']);
				}
				if (isset($ids) and sizeof($ids)){
					$_REQUEST['selected_ids'].=','.join(',',$ids);
				}
			}
			if(URL::get('deleted_ids')){
				$type = 'delete';
				$title = 'Xóa lịch sử cầu thủ';
				$description = 'Xóa lịch sử cầu thủ: '.URL::get('deleted_ids').'';
				$ids = explode(',',URL::get('deleted_ids'));
				foreach($ids as $id){
					DB::delete_id('ssnh_lich_su_cau_thu',$id);
				}
			}
			//exit();
			System::log($type, $title, $description ,'', '', Session::get('user_id'));
			//update_mi_upload_file();
			Url::redirect_current(array('clb_id','vong_dau_id'));
		}
	}	
	function draw(){
		$this->map = array();
		$paging = '';
		$cond = '1>0
				'.(Url::iget('vong_dau_id')?' AND ssnh_lich_su_cau_thu.vong_dau_id='.Url::iget('vong_dau_id').'':'').'
				'.(Url::iget('clb_id')?' AND ssnh_cau_thu_clb.clb_id='.Url::iget('clb_id').'':'').'
				'.(Url::get('keyword')?' AND ssnh_cau_thu.ten LIKE "%'.Url::get('keyword').'%"':'').'
			';		
		//if(!isset($_REQUEST['mi_lich_su']))
		{
			$item_per_page = 100;
			/////////////////////Get total///////////////////
			DB::query('
				select 
					count(*) as acount
				from 
					ssnh_cau_thu
					inner join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id
				where 
					1=1
			');
			$count = DB::fetch();
			$this->map['total'] = $count['acount'];
			//////////////////////////////////////////
			DB::query('
				select 
					count(*) as acount
				from 
					ssnh_lich_su_cau_thu
					inner join ssnh_cau_thu ON ssnh_cau_thu.id = ssnh_lich_su_cau_thu.cau_thu_id
					inner join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id
					left outer join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id
					left outer join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
					inner join ssnh_vong_dau ON ssnh_vong_dau.id = ssnh_lich_su_cau_thu.vong_dau_id
				where 
					'.$cond.'
			');
			$count = DB::fetch();
			require_once 'packages/core/includes/utils/paging.php';
			$paging = paging($count['acount'],$item_per_page);
			$sql = '
				select
					ssnh_lich_su_cau_thu.*,
					vttn.vi_tri_id,CONCAT(vtts.ma_vi_tri," - ",ssnh_cau_thu.ten) AS ten,vtts.ma_vi_tri
				from 
					ssnh_lich_su_cau_thu
					LEFT OUTER JOIN ssnh_cau_thu ON ssnh_cau_thu.id = ssnh_lich_su_cau_thu.cau_thu_id
					LEFT OUTER JOIN ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id
					LEFT OUTER JOIN ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id AND vttn.mua_giai_id = '.MUA_GIAI_ID.'
					LEFT OUTER JOIN ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
				where 
					'.$cond.'
				order by 
					ssnh_lich_su_cau_thu.diem DESC,ssnh_cau_thu.ten
				LIMIT
					'.((page_no()-1)*$item_per_page).','.$item_per_page.'
			';
			if($mi_lich_su = DB::fetch_all($sql)){
			//System::Debug($mi_lich_su);
				if(!Url::get('clb_id') or !Url::get('vong_dau_id')){
					$mi_lich_su = array();
				}
			}
			{
				if(Url::get('clb_id') and Url::get('vong_dau_id')){
					$cond = 'ssnh_cau_thu_clb.mua_giai_id = '.Session::get('mua_giai_id').'
						'.(Url::iget('clb_id')?' AND ssnh_cau_thu_clb.clb_id='.Url::iget('clb_id').'':'').'
					';	
					$sql = '
						select 
							distinct concat("cau_thu_",ssnh_cau_thu.id) AS id,
							CONCAT(vtts.ma_vi_tri," - ",ssnh_cau_thu.ten) AS ten,
							ssnh_cau_thu.id as cau_thu_id,
							vtts.ma_vi_tri
						from 
							ssnh_cau_thu
							inner join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id
							left outer join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id
							left outer join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
						where 
							'.$cond.'
						order by 
							ssnh_cau_thu.so_thu_tu asc
						LIMIT
							'.((page_no()-1)*$item_per_page).','.$item_per_page.'
					';
					$mi_lich_su_ = DB::fetch_all($sql);
				}else{
					$mi_lich_su_ = array();
				}
				if(empty($mi_lich_su)){
					$mi_lich_su = $mi_lich_su_;
				}else{
					foreach($mi_lich_su as $key=>$value){
						if(isset($mi_lich_su_['cau_thu_'.$value['cau_thu_id']])){
							unset($mi_lich_su_['cau_thu_'.$value['cau_thu_id']]);
						}
					}
					$mi_lich_su += $mi_lich_su_;
				}
			}
			$_REQUEST['mi_lich_su'] = $mi_lich_su;
		}
		$this->map['paging'] = $paging;
		////////////////////////////////
		$sql = '
			select 
				ssnh_cau_thu.id,CONCAT(vtts.ma_vi_tri," - ",ssnh_cau_thu.ten) AS ten,clb.ten AS ten_clb,vtts.ma_vi_tri
			from 
				ssnh_cau_thu
				inner join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id
				left outer join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id
				left outer join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
				inner join ssnh_cau_lac_bo AS clb ON clb.id = ssnh_cau_thu_clb.clb_id
			where 
				ssnh_cau_thu_clb.mua_giai_id = '.Session::get('mua_giai_id').'
			order by 
				ssnh_cau_thu_clb.clb_id,ssnh_cau_thu.so_thu_tu,ssnh_cau_thu.ten
		';
		$cau_thus = DB::fetch_all($sql);
		$this->map['cau_thus'] = $cau_thus;
		$this->map['cau_thu_options'] = '<option value="">Chọn CLB</option>';
		foreach($cau_thus as $key=>$value){
				$this->map['cau_thu_options'] .= '<option value="'.$value['id'].'" '.((Url::iget('cau_thu_id')==$key)?'selected':'').'>'.$value['ten'].'</option>';
		}
		////////////////////////////////
		$year = date('Y');
		if(Url::get('nam')){
			$year = Url::get('nam');
		}
		$year = date('Y');
		$clbs = get_clbs(false,'ssnh_mua_giai.id='.Session::get('mua_giai_id').'');
		$this->map['clbs'] = $clbs;
		////////////////////////////////
		$vongdaus = get_vongdaus();
		$this->map['vong_dau_id_list'] = array('Chọn vòng đấu') + String::get_list($vongdaus,'ten');
		$this->map['vongdaus'] = $vongdaus;
		if(empty($mi_lich_su)){
			$this->map['notification'] = '<h3 class="notification">Chọn vòng đấu để cập nhật lịch sử cầu thủ</h3>';
		}else{
			$this->map['notification'] = '';
		}
		$this->map['cau_thu'] = '';
		$this->map['clb'] = '';		
		$this->map['diem'] = '';		
		if($vong_dau_id=Url::iget('vong_dau_id') and $top_vong=$this->get_top_vong($vong_dau_id)){
			$this->map['cau_thu'] = $top_vong['cau_thu'];
			$this->map['clb'] = $top_vong['clb'];	
			$this->map['cao_nhat_clb_id'] = $top_vong['clb_id'];	
			$this->map['diem'] = $top_vong['diem'];				
		}
		$this->parse_layout('edit',$this->map);
	}
	function save_item_image($file,$id){
		require_once 'packages/core/includes/utils/upload_file.php';
		$dir = substr(PORTAL_ID,1).'/item/';
		if(isset($_FILES[$file]) and $_FILES[$file]){
			update_upload_file($file,$dir);
			$row = array();
			if(Url::get($file)){
				DB::update('ssnh_lich_su_cau_thu',array('anh_dai_dien'=>Url::get($file)),'id='.$id);
			}
		}
	}
	function get_top_vong($vong_dau_id){
		$sql = '
			SELECT
				LSCT.id,
				LSCT.diem,
				ct.ten as cau_thu,
				clb.ten as clb,
				clb.id as clb_id
			FROM
				ssnh_lich_su_cau_thu AS LSCT
				INNER JOIN ssnh_cau_thu AS ct ON ct.id = LSCT.cau_thu_id
				INNER JOIN ssnh_cau_thu_clb ON ssnh_cau_thu_clb.cau_thu_id = ct.id
				INNER JOIN ssnh_cau_lac_bo AS clb ON clb.id = ssnh_cau_thu_clb.clb_id
			WHERE
				LSCT.vong_dau_id ='.$vong_dau_id.'
				AND LSCT.cao_nhat
		';
		if($item = DB::fetch($sql)){
			return $item;
		}else{
			return false;
		}
	}
}
?>