<?php
// List function to get data from ssnh
function get_muagiais($order_by='ssnh_mua_giai.tu_ngay'){
	$sql = '
			select 
				ssnh_mua_giai.*				
			from 
				ssnh_mua_giai
			where 
				1=1
			order by 
				'.$order_by.'
		';
		$items = DB::fetch_all($sql);
		return $items;
}

function get_vongdaus($cond=false,$mua_giai=true){
	if(!$cond){
		$cond = 'ssnh_mua_giai.id='.MUA_GIAI_ID.'';
	}
	$sql = '
			select 
				ssnh_vong_dau.id,'.($mua_giai?'CONCAT(ssnh_vong_dau.ten,CONCAT(" / ",ssnh_mua_giai.ten)) as ten':'ssnh_mua_giai.ten').',ssnh_mua_giai.ten as mua_giai
			from 
				ssnh_vong_dau
				inner join ssnh_mua_giai on ssnh_mua_giai.id = ssnh_vong_dau.mua_giai_id
			where 
				'.$cond.'
			order by 
				ssnh_mua_giai.id desc,ssnh_vong_dau.ten asc
		';
		$vongdaus = DB::fetch_all($sql);
		return $vongdaus;
}
function get_id_vong_dau_dang_dien_ra(){
	$sql = '
			select 
				ssnh_vong_dau.id
			from 
				ssnh_vong_dau
			where 
				ssnh_vong_dau.tu_ngay<="'.date('Y-m-d').'" AND ssnh_vong_dau.den_ngay>="'.date('Y-m-d').'"
			LIMIT
				0,1
	';
	if($vong_dau = DB::fetch($sql)){
		return $vong_dau['id'];
	}else{
		return false;
	}
}
function get_id_vong_dau_hien_tai($disabled=false){
	$sql = '
			select 
				ssnh_vong_dau.id
			from 
				ssnh_vong_dau
			where 
				ssnh_vong_dau.tu_ngay<="'.date('Y-m-d').'" AND ssnh_vong_dau.den_ngay>="'.date('Y-m-d').'"
				'.($disabled?' and ssnh_vong_dau.disabled<>1':'').'
			LIMIT
				0,1
	';
	if($vong_dau = DB::fetch($sql)){
		
	}else{
		$sql = '
				select 
					ssnh_vong_dau.id
				from 
					ssnh_vong_dau
				where 
					ssnh_vong_dau.tu_ngay>"'.date('Y-m-d').'"
					'.($disabled?' and ssnh_vong_dau.disabled<>1':'').'
				ORDER BY
					ssnh_vong_dau.tu_ngay ASC
				LIMIT
					0,1
		';
		$vong_dau = DB::fetch($sql);
	}
	return $vong_dau['id'];
}
function get_id_vong_dau_gan_nhat(){
	$sql = '
			select 
				ssnh_vong_dau.id
			from 
				ssnh_vong_dau
			where 
				ssnh_vong_dau.tu_ngay>"'.date('Y-m-d').'"
			ORDER BY
				ssnh_vong_dau.den_ngay ASC
			LIMIT
				0,1
	';
	if($vong_dau = DB::fetch($sql)){
		return $vong_dau['id'];
	}else{
		return 0;
	}
}
function get_id_vong_dau_ket_thuc_gan_nhat($mua_giai_id=false,$disabled=false){
	$sql = '
			select 
				ssnh_vong_dau.id
			from 
				ssnh_vong_dau
			where 
				ssnh_vong_dau.den_ngay<"'.date('Y-m-d').'"
				'.($disabled?' and ssnh_vong_dau.disabled<>1':'').'
				'.($mua_giai_id?' and ssnh_vong_dau.mua_giai_id='.$mua_giai_id.'':'').'
			ORDER BY
				ssnh_vong_dau.den_ngay DESC
			LIMIT
				0,1
	';
	if($vong_dau = DB::fetch($sql)){
		return $vong_dau['id'];
	}else{
		return 0;
	}
}
function get_vi_tris(){
	$sql = '
		select 
			ssnh_vi_tri_tren_san.id,ssnh_vi_tri_tren_san.ten
		from 
			ssnh_vi_tri_tren_san
		where 
			1=1
		order by 
			ssnh_vi_tri_tren_san.so_thu_tu asc
	';
	$vi_tris = DB::fetch_all($sql);
	return $vi_tris;
}
function get_quoc_tichs(){
	$sql = '
		select 
			country.id, country.name as ten
		from 
			country
		where 
			1=1
		order by 
			country.name
	';
	$items = DB::fetch_all($sql);
	return $items;
}
function get_tong_clb($cond){
	$sql = '
		select 
			count(*) AS total
		from 
			ssnh_cau_lac_bo
		where 
			'.$cond.'
		';
		return DB::fetch($sql,'total');
}
function get_clbs($ko_tinh_cau_thu=false,$cond=false,$page_no=false,$item_per_page=50){
		$sql = '
		select 
			distinct ssnh_cau_lac_bo.id,
			ssnh_cau_lac_bo.name_id,
			ssnh_cau_lac_bo.ten,
			ssnh_cau_lac_bo.ten_viet_tat,
			ssnh_cau_lac_bo.ngay_thanh_lap,
			ssnh_cau_lac_bo.san_van_dong,
			ssnh_cau_lac_bo.logo,
			ssnh_mua_giai.ten as mua_giai
			'.($ko_tinh_cau_thu?'':',(select count(distinct ssnh_cau_thu.id) from ssnh_cau_thu inner join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id where ssnh_cau_thu_clb.clb_id = ssnh_cau_lac_bo.id '.((Session::is_set('mua_giai_id') and Session::get('mua_giai_id'))?' and ssnh_cau_thu_clb.mua_giai_id='.Session::get('mua_giai_id').'':'').') as sl_cau_thu').'
		from 
			ssnh_cau_lac_bo
			INNER JOIN ssnh_clb_mua_giai ON ssnh_clb_mua_giai.clb_id = ssnh_cau_lac_bo.id 
			INNER JOIN ssnh_mua_giai ON ssnh_mua_giai.id = ssnh_clb_mua_giai.mua_giai_id
		where 
			'.($cond?$cond:'1=1').'
			'.((Session::is_set('mua_giai_id') and Session::get('mua_giai_id'))?' and ssnh_mua_giai.id='.Session::get('mua_giai_id').'':'').'
		order by 
			ssnh_cau_lac_bo.ten asc
		'.($page_no?('LIMIT '.((page_no()-1)*$item_per_page).','.$item_per_page.''):'LIMIT 0,'.$item_per_page.'').'
	';
	$clbs = DB::fetch_all($sql);
	return $clbs;
}
function get_clb($name_id){
	DB::query('
		select 
			ssnh_cau_lac_bo.id,
			ssnh_cau_lac_bo.name_id,
			ssnh_cau_lac_bo.ten,
			ssnh_cau_lac_bo.ten_viet_tat,
			ssnh_cau_lac_bo.mo_ta,
			ssnh_cau_lac_bo.logo,
			(select count(*) from ssnh_cau_thu inner join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id where ssnh_cau_thu_clb.clb_id = ssnh_cau_lac_bo.id) as sl_cau_thu
		from 
			ssnh_cau_lac_bo
		where 
			ssnh_cau_lac_bo.name_id = "'.$name_id.'"
	');
	$clb = DB::fetch();
	return $clb;
}
function get_hieuso_thangthua($clb_id,$mua_giai_id=false){
	$ban_thang = 0;
	$ban_thua = 0;
	$sql = '
		select 
			kqtd.id,kqtd.ket_qua
		from 
			ssnh_ket_qua_thi_dau as kqtd 
		where 
			kqtd.doi_khach_id = '.$clb_id.' 
			'.($mua_giai_id?' AND kqtd.mua_giai_id='.$mua_giai_id.'':'').'
			AND ket_qua IS NOT NULL';
	$items = DB::fetch_all($sql);
	foreach($items as $key=>$value){
		$temp = explode(':',$value['ket_qua']);
		if(isset($temp[0]) and isset($temp[1]))
		{
			$ban_thang += intval($temp[1]);
			$ban_thua += intval($temp[0]);
		}
	}
	$sql = '
		select 
			kqtd.doi_chu_nha_id,kqtd.id,kqtd.ket_qua
		from 
			ssnh_ket_qua_thi_dau as kqtd 
		where 
			kqtd.doi_chu_nha_id = '.$clb_id.' 
			'.($mua_giai_id?' AND kqtd.mua_giai_id='.$mua_giai_id.'':'').'
			AND ket_qua IS NOT NULL';	
	$items = DB::fetch_all($sql);
	foreach($items as $key=>$value){
		$temp = explode(':',$value['ket_qua']);
		if(isset($temp[0]) and isset($temp[1]))
		{
			$ban_thang += intval($temp[0]);
			$ban_thua += intval($temp[1]);
		}
	}
	return array('ban_thang'=>$ban_thang,'ban_thua'=>$ban_thua);
}
function get_tong_ban_thang($vong_dau_id){
	$ban_thang = 0;
	$sql = '
		select 
			kqtd.id,kqtd.ket_qua
		from 
			ssnh_ket_qua_thi_dau as kqtd 
		where 
			kqtd.vong_dau_id = '.$vong_dau_id.' AND ket_qua IS NOT NULL
			';
	$items = DB::fetch_all($sql);
	foreach($items as $key=>$value){
		$temp = explode(':',$value['ket_qua']);
		if(isset($temp[0]) and isset($temp[1]))
		{
			$ban_thang += intval($temp[1]) + intval($temp[0]);
		}
	}
	return $ban_thang;
}
function get_bangxephang($cond='1=1',$mua_giai_id=1){
	$sql = '
		select 
			distinct ssnh_cau_lac_bo.id as id,ssnh_cau_lac_bo.name_id,ssnh_cau_lac_bo.ten,ssnh_cau_lac_bo.so_thu_tu,
			(select SUM(kqtd.diem_doi_chu_nha) from ssnh_ket_qua_thi_dau as kqtd where kqtd.doi_chu_nha_id = ssnh_cau_lac_bo.id and kqtd.mua_giai_id='.$mua_giai_id.') as diem_chunha,
			(select SUM(kqtd.diem_doi_khach) from ssnh_ket_qua_thi_dau as kqtd where kqtd.doi_khach_id = ssnh_cau_lac_bo.id and kqtd.mua_giai_id='.$mua_giai_id.') as diem_khach
		from 
			ssnh_cau_lac_bo
			INNER JOIN ssnh_clb_mua_giai ON ssnh_clb_mua_giai.clb_id = ssnh_cau_lac_bo.id
			INNER JOIN ssnh_mua_giai ON ssnh_mua_giai.id = ssnh_clb_mua_giai.mua_giai_id
		where 
			'.$cond.'
			AND ssnh_cau_lac_bo.trang_thai<>"OFF"
		order by 
			ssnh_cau_lac_bo.so_thu_tu asc
	';//'.(User::is_admin()?' AND ssnh_cau_lac_bo.id=10':'').'
	$items = DB::fetch_all($sql);
	foreach($items as $key=>$value){
		$items[$key]['diem'] = $value['diem_chunha'] + $value ['diem_khach'];
		$hieuso = get_hieuso_thangthua($value['id'],$mua_giai_id);
		$items[$key]['ban_thang'] = $hieuso['ban_thang'];
		$items[$key]['ban_thua'] = $hieuso['ban_thua'];
		$items[$key]['hieu_so'] = $hieuso['ban_thang'] - $hieuso['ban_thua'];
	}
	$sort = array();	
	foreach($items as $k=>$v) {
			$sort['diem'][$k] = $v['diem'];
			$sort['hieu_so'][$k] = $v['hieu_so'];
			$sort['ban_thang'][$k] = $v['ban_thang'];			
			$sort['ban_thua'][$k] = $v['ban_thua'];			
			$sort['so_thu_tu'][$k] = $v['so_thu_tu'];
	}
	# sort by event_type desc and then title asc
	array_multisort($sort['diem'], SORT_DESC,$sort['hieu_so'], SORT_DESC,$sort['ban_thang'], SORT_DESC,$sort['so_thu_tu'], SORT_ASC,$items);
	$i=1;
	$new_items = array();
	foreach($items as $key=>$value){
		$new_items[$key+1] = $value;		
		$new_items[$key+1]['hang'] = $i;
		$i++;
	}
	return $new_items;
}
function get_cap_dau($cap_dau_id){
	$sql = '
				select 
					kqtd.id,
					CONCAT(dchn.ten," vs ",dkh.ten) AS cap_dau
				from 
					ssnh_ket_qua_thi_dau as kqtd
					inner join ssnh_cau_lac_bo AS dchn ON dchn.id = kqtd.doi_chu_nha_id
					inner join ssnh_cau_lac_bo AS dkh ON dkh.id = kqtd.doi_khach_id
				where 
					kqtd.id='.$cap_dau_id.'
			';
	$item = DB::fetch($sql);	
	return $item['cap_dau'];
}
function get_lichthidaus($vong_dau_id=false,$item_per_page=10,$cond=false){
	$sql = '
				select 
					kqtd.id,
					dchn.id as dcn_id,
					dchn.ten_viet_tat as ma_doi_chu_nha,
					dchn.ten as doi_chu_nha,
					dchn.logo as logo_cn,
					dkh.id as dkh_id,
					dkh.ten_viet_tat as ma_doi_khach,
					dkh.ten as doi_khach,
					dkh.logo as logo_kh,
					kqtd.thoi_gian,
					kqtd.ket_qua,
					kqtd.thong_tin_tran_dau,
					CONCAT(dchn.ten," vs ",dkh.ten) AS cap_dau,
					ssnh_mua_giai.ten as mua_giai
				from 
					ssnh_ket_qua_thi_dau as kqtd
					INNER JOIN ssnh_mua_giai ON ssnh_mua_giai.id = kqtd.mua_giai_id
					inner join ssnh_cau_lac_bo AS dchn ON dchn.id = kqtd.doi_chu_nha_id
					inner join ssnh_cau_lac_bo AS dkh ON dkh.id = kqtd.doi_khach_id
				where 
					'.($vong_dau_id?'kqtd.vong_dau_id = '.$vong_dau_id.'':'1=1').'
					
					'.$cond.'
				order by 
					kqtd.thoi_gian
				LIMIT
					0,'.$item_per_page.'
			';
	$items = DB::fetch_all($sql);	
	foreach($items as $key=>$value){
		$items[$key]['thoi_gian_ngay'] = date('d/m',$value['thoi_gian']);
		$items[$key]['thoi_gian_gio'] = date('H:i',$value['thoi_gian']);
	}
	return $items;
}
function get_top_cua_thus($cond,$item_per_page=5,$order='lsct.diem DESC'){
		$sql = '
			select 
				distinct lsct.id,
				ssnh_cau_thu.name_id,
				ssnh_cau_thu.ten,
				ssnh_cau_thu.so_ao,
				ssnh_cau_thu.ngay_sinh,
				CONCAT(ssnh_cau_thu.chieu_cao,"m") AS chieu_cao,
				CONCAT(ssnh_cau_thu.can_nang,"kg") AS can_nang,
				country.name as quoc_tich,
				vtts.ten as vi_tri,
				ssnh_cau_thu.anh_dai_dien,
				lsct.anh_dai_dien as anh_vong_dau,
				lsct.video,
				lsct.diem,
				lsct.vong_dau_id,
				lsct.cau_thu_id,
				ssnh_vong_dau.ten as vong_dau,
				ssnh_cau_lac_bo.ten AS clb,
				ssnh_cau_thu_clb.clb_id
			from 
				ssnh_lich_su_cau_thu as lsct join (select vong_dau_id, max(diem) as diem from ssnh_lich_su_cau_thu where cao_nhat group by vong_dau_id) lsct1
				on lsct1.vong_dau_id = lsct1.vong_dau_id and lsct.diem = lsct1.diem
				inner join ssnh_cau_thu ON ssnh_cau_thu.id = lsct.cau_thu_id
				inner join country ON country.id = ssnh_cau_thu.quoc_tich_id
				inner join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id
				inner join ssnh_cau_lac_bo on ssnh_cau_lac_bo.id = ssnh_cau_thu_clb.clb_id
				inner join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id
				inner join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
				inner join ssnh_mua_giai ON ssnh_mua_giai.id = ssnh_cau_thu_clb.mua_giai_id
				inner join ssnh_vong_dau ON ssnh_vong_dau.id = lsct.vong_dau_id
			WHERE
				'.$cond.'
				AND ssnh_vong_dau.mua_giai_id = '.MUA_GIAI_ID.'
			ORDER BY
				lsct.vong_dau_id DESC
			LIMIT
					0,'.$item_per_page.'
	';
	if(User::is_admin()){
		//echo $sql;exit();
	}
	$items = DB::fetch_all($sql);
	foreach($items as $key=>$value){
		//$items[$key]['thoi_gian_ngay'] = date('d/m',$value['thoi_gian']);
		//$items[$key]['thoi_gian_gio'] = date('H:i',$value['thoi_gian']);
	}
	return $items;
}
function get_tong_cauthu($cond){
	$sql = '
		select 
			count(distinct ssnh_cau_thu.id) AS total
		from 
			ssnh_cau_thu
			inner join country ON country.id = ssnh_cau_thu.quoc_tich_id
			inner join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id
			inner join ssnh_cau_lac_bo on ssnh_cau_lac_bo.id = ssnh_cau_thu_clb.clb_id
			inner join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id
			inner join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
			inner join ssnh_mua_giai ON ssnh_mua_giai.id = ssnh_cau_thu_clb.mua_giai_id
			left outer join ssnh_lich_su_cau_thu AS lsct ON lsct.cau_thu_id = ssnh_cau_thu.id
			left outer join ssnh_vong_dau ON ssnh_vong_dau.id = lsct.vong_dau_id
		where 
			'.$cond.'
		';
		return DB::fetch($sql,'total');
}
function get_cauthus($cond,$item_per_page=5,$page_no=false,$order='tong_diem DESC',$vong_dau_id=false){
	$vong_dau_id = $vong_dau_id?$vong_dau_id:Url::iget('vong_dau_id');
	$mua_giai_id = Session::get('mua_giai_id')?Session::get('mua_giai_id'):MUA_GIAI_ID;
	$sql = '
		select 
			distinct ssnh_cau_thu.id,
			ssnh_cau_thu.name_id,
			ssnh_cau_thu.ten,
			ssnh_cau_thu.so_ao,
			ssnh_cau_thu.ngay_sinh,
			CONCAT(ssnh_cau_thu.chieu_cao,"m") AS chieu_cao,
			CONCAT(ssnh_cau_thu.can_nang,"kg") AS can_nang,
			country.name as quoc_tich,
			vtts.ten as vi_tri,
			ssnh_cau_thu.anh_dai_dien,
			ssnh_cau_lac_bo.ten AS clb,
			ssnh_cau_lac_bo.ten_viet_tat AS ma_clb,
			ssnh_cau_thu_clb.clb_id,
			'.($vong_dau_id?'(SELECT ssnh_lich_su_cau_thu.diem FROM ssnh_lich_su_cau_thu WHERE ssnh_lich_su_cau_thu.cau_thu_id=ssnh_cau_thu.id AND ssnh_lich_su_cau_thu.vong_dau_id = '.$vong_dau_id.' LIMIT 0,1) as diem_vong_hien_tai':'"" as diem_vong_hien_tai').',
			(select sum(diem) as tong_diem from ssnh_lich_su_cau_thu AS ls INNER JOIN ssnh_vong_dau AS vd ON vd.id=ls.vong_dau_id where ls.cau_thu_id = ssnh_cau_thu.id AND vd.mua_giai_id='.$mua_giai_id.')  AS tong_diem,
			vttn.cost,
			ssnh_cau_thu.off
		from 
			ssnh_cau_thu
			inner join country ON country.id = ssnh_cau_thu.quoc_tich_id
			inner join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id
			inner join ssnh_cau_lac_bo on ssnh_cau_lac_bo.id = ssnh_cau_thu_clb.clb_id
			inner join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id AND vttn.mua_giai_id='.$mua_giai_id.'
			inner join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
			inner join ssnh_mua_giai ON ssnh_mua_giai.id = ssnh_cau_thu_clb.mua_giai_id
			LEFT OUTER JOIN ssnh_lich_su_cau_thu AS lsct ON lsct.cau_thu_id = ssnh_cau_thu.id
		where 
			'.$cond.'
		GROUP BY
			ssnh_cau_thu.id
		order by 
			'.$order.'
		LIMIT
			'.($page_no?(''.(($page_no-1)*$item_per_page).','.$item_per_page.''):'0,'.$item_per_page.'').'
	';
	//if(User::is_admin()){
		//echo '<pre>'.$sql;
	//}
	$items = DB::fetch_all($sql);
	foreach($items as $key=>$value){
		//$items[$key]['thoi_gian_ngay'] = date('d/m',$value['thoi_gian']);
		//$items[$key]['thoi_gian_gio'] = date('H:i',$value['thoi_gian']);
	}
	return $items;
}
function get_cauthu($id,$mua_giai_id=1){
	$sql = '
		select 
			ssnh_cau_thu.id,
			ssnh_cau_thu.name_id,
			ssnh_cau_thu.ten,
			ssnh_cau_thu.so_ao,
			ssnh_cau_thu.ngay_sinh,
			CONCAT(ssnh_cau_thu.chieu_cao,"m") AS chieu_cao,
			CONCAT(ssnh_cau_thu.can_nang,"kg") AS can_nang,
			country.name as quoc_tich,
			vtts.ten as vi_tri,
			vtts.ma_vi_tri,
			ssnh_cau_thu.anh_dai_dien,
			ssnh_cau_lac_bo.name_id as clb_name_id,
			ssnh_cau_lac_bo.ten AS clb,
			ssnh_cau_thu_clb.clb_id,
			ssnh_cau_lac_bo.logo,
			vttn.cost,
			ssnh_cau_thu.off
		from 
			ssnh_cau_thu
			inner join country ON country.id = ssnh_cau_thu.quoc_tich_id
			inner join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id AND ssnh_cau_thu_clb.mua_giai_id='.$mua_giai_id.'
			inner join ssnh_cau_lac_bo on ssnh_cau_lac_bo.id = ssnh_cau_thu_clb.clb_id
			inner join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id
			inner join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
			inner join ssnh_mua_giai ON ssnh_mua_giai.id = ssnh_cau_thu_clb.mua_giai_id
			LEFT OUTER JOIN ssnh_lich_su_cau_thu AS lsct ON lsct.cau_thu_id = ssnh_cau_thu.id
		where 
			ssnh_cau_thu.id='.$id.'
		order by 
			ssnh_cau_thu.so_thu_tu asc
	';
	$item = DB::fetch($sql);
	$item['diem'] = get_diem_cau_thu($item['id'],$mua_giai_id);
	return $item;
}
function get_diem_cau_thu($cau_thu_id,$mua_giai_id=1,$vong_dau_id=false,$bonus=false){
	return DB::fetch('
		select 
			sum(lsct.diem + '.($bonus?'lsct.bonus':'0').') as tong_diem 
		from 
			ssnh_lich_su_cau_thu as lsct
			inner join ssnh_vong_dau ON ssnh_vong_dau.id = lsct.vong_dau_id
		where 
			lsct.cau_thu_id = '.$cau_thu_id.'
			AND ssnh_vong_dau.mua_giai_id='.$mua_giai_id.'
			'.($vong_dau_id?' AND lsct.vong_dau_id= '.$vong_dau_id.'':'').'
			'
	,'tong_diem');
}
function get_doi_hinh($ma_vi_tri,$clb_id,$vong_dau_id){	
		$sql = '
		select 
			ssnh_cau_thu.id,
			ssnh_cau_thu.name_id,
			ssnh_cau_thu.ten,
			ssnh_cau_thu.so_ao,
			ssnh_cau_thu.ngay_sinh,
			CONCAT(ssnh_cau_thu.chieu_cao,"m") AS chieu_cao,
			CONCAT(ssnh_cau_thu.can_nang,"kg") AS can_nang,
			country.name as quoc_tich,
			vtts.ten as vi_tri,
			ssnh_cau_thu.anh_dai_dien,
			lsct.anh_dai_dien as anh_vong_dau,
			lsct.diem,
			lsct.cao_nhat_doi,
			lsct.cao_nhat,
			ssnh_vong_dau.ten as vong_dau,
			ssnh_cau_lac_bo.ten AS clb
		from 
			ssnh_cau_thu
			inner join country ON country.id = ssnh_cau_thu.quoc_tich_id
			inner join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id and ssnh_cau_thu_clb.mua_giai_id='.MUA_GIAI_ID.'
			inner join ssnh_cau_lac_bo on ssnh_cau_lac_bo.id = ssnh_cau_thu_clb.clb_id
			inner join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id
			inner join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
			inner join ssnh_mua_giai ON ssnh_mua_giai.id = ssnh_cau_thu_clb.mua_giai_id
			inner join ssnh_lich_su_cau_thu AS lsct ON lsct.cau_thu_id = ssnh_cau_thu.id
			inner join ssnh_vong_dau ON ssnh_vong_dau.id = lsct.vong_dau_id
		where 
			vtts.ma_vi_tri ="'.$ma_vi_tri.'"
			AND ssnh_cau_lac_bo.id ="'.$clb_id.'"
			AND ssnh_vong_dau.id ="'.$vong_dau_id.'"
			AND lsct.so_phut_thi_dau > 0
		order by 
			ssnh_cau_thu.so_thu_tu asc
	';
	$items = DB::fetch_all($sql);
	foreach($items as $key=>$value){
		
		//$items[$key]['thoi_gian_ngay'] = date('d/m',$value['thoi_gian']);
		//$items[$key]['thoi_gian_gio'] = date('H:i',$value['thoi_gian']);
	}
	return $items;
}
function get_khoang_vong_daus(){
	$vong_daus = get_vongdaus();
	$arr = array();
	$i = 1;
	$str = '';
	$vong_label = '';
	foreach($vong_daus as $key=>$value){
			$str .= ($str?',':'').$key;
			$vong_label .= ($vong_label?',':'').($i).'';
			if(($i%5==0) or $i== sizeof($vong_daus)){
				if(!isset($arr[$str])){
					$arr[$str] = 'Vòng '.$vong_label;
					$str = '';
					$vong_label = '';
				}
			}
			$i++;
	}
	return $arr;
}
function lich_su_cau_thu_vong_hien_tai($cau_thu_id,$vong_dau_id,$mua_giai_id=false){
	$sql = '
		SELECT
			lsct.*
		FROM
			ssnh_lich_su_cau_thu AS lsct
			inner join ssnh_vong_dau ON ssnh_vong_dau.id = lsct.vong_dau_id
		WHERE
			lsct.cau_thu_id = '.$cau_thu_id.'
			AND lsct.vong_dau_id = '.$vong_dau_id.'
			'.($mua_giai_id?' AND ssnh_vong_dau.mua_giai_id = '.$mua_giai_id:'').'
	';
	$items = DB::fetch_all($sql);
	return $items;
}
function get_doi_thus($clb_id,$cond,$item_per_page=3,$order_by='ssnh_vong_dau.tu_ngay'){
	
	$sql = '
		select 
			kqtd.id,
			dkh.ten_viet_tat,
			dkh.ten,
			kqtd.thoi_gian,
			kqtd.ket_qua
		from 
			ssnh_ket_qua_thi_dau as kqtd
			inner join ssnh_cau_lac_bo AS dchn ON dchn.id = kqtd.doi_chu_nha_id
			inner join ssnh_cau_lac_bo AS dkh ON dkh.id = kqtd.doi_khach_id
			inner join ssnh_vong_dau ON ssnh_vong_dau.id = kqtd.vong_dau_id			
		where 
			dchn.id= '.$clb_id.'
			'.$cond.'
		order by 
			'.$order_by.'
		LIMIT
			0,'.$item_per_page.'
	';
	if(!($items = DB::fetch_all($sql))){
		$sql = '
			select 
				kqtd.id,
				dchn.ten,
				dchn.ten_viet_tat,
				kqtd.thoi_gian,
				kqtd.ket_qua
			from 
				ssnh_ket_qua_thi_dau as kqtd
				inner join ssnh_cau_lac_bo AS dchn ON dchn.id = kqtd.doi_chu_nha_id
				inner join ssnh_cau_lac_bo AS dkh ON dkh.id = kqtd.doi_khach_id
				inner join ssnh_vong_dau ON ssnh_vong_dau.id = kqtd.vong_dau_id
			where 
				dkh.id= '.$clb_id.'
				'.$cond.'
			order by 
				'.$order_by.'
			LIMIT
				0,'.$item_per_page.'
		';
		$items = DB::fetch_all($sql);
	}
	foreach($items as $key=>$value){
		$items[$key]['thoi_gian_ngay'] = date('d/m',$value['thoi_gian']);
		$items[$key]['thoi_gian_gio'] = date('H:i',$value['thoi_gian']);
	}
	return $items;
}
function get_doi_thu($clb_id,$vong_dau_id){
	$sql = '
			SELECT 
				kqtd.id,
				dchn.ten as cn_ten,
				dchn.ten as cn_ten_viet_tat,
				dkh.ten as kh_ten,
				dkh.ten_viet_tat as kh_ten_viet_tat,
				kqtd.thoi_gian,
				kqtd.ket_qua,
				kqtd.doi_chu_nha_id,
				kqtd.doi_khach_id
			FROM 
				ssnh_ket_qua_thi_dau as kqtd
				inner join ssnh_cau_lac_bo AS dchn ON dchn.id = kqtd.doi_chu_nha_id
				inner join ssnh_cau_lac_bo AS dkh ON dkh.id = kqtd.doi_khach_id
				inner join ssnh_vong_dau ON ssnh_vong_dau.id = kqtd.vong_dau_id
			WHERE 
				(dchn.id = '.$clb_id.' or dkh.id = '.$clb_id.')
				AND kqtd.vong_dau_id = '.$vong_dau_id.'
		';
		$items = DB::fetch_all($sql);
		foreach($items as $value){
			if($value['doi_chu_nha_id'] == $clb_id){
				return array('doi_thu'=>$value['kh_ten_viet_tat'],'thoi_gian'=>$value['thoi_gian']);
			}else{
				return array('doi_thu'=>$value['cn_ten_viet_tat'],'thoi_gian'=>$value['thoi_gian']);
			}
		}
}
function lich_su_thi_daus($cau_thu_id,$mua_giai_id=false){
	$sql = '
		SELECT
			lsct.*,
			ssnh_cau_thu_clb.clb_id,
			cn.ten as cn_ten,
			kh.ten as kh_ten
		FROM
			ssnh_lich_su_cau_thu AS lsct
			INNER JOIN ssnh_vong_dau ON ssnh_vong_dau.id = lsct.vong_dau_id
			INNER JOIN ssnh_cau_thu ON ssnh_cau_thu.id = lsct.cau_thu_id
			INNER JOIN ssnh_cau_thu_clb ON ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id
			INNER JOIN ssnh_ket_qua_thi_dau AS kqtd_cn ON kqtd_cn.doi_chu_nha_id = ssnh_cau_thu_clb.clb_id
			INNER JOIN ssnh_cau_lac_bo AS cn ON cn.id = kqtd_cn.doi_chu_nha_id
			INNER JOIN ssnh_ket_qua_thi_dau AS kqtd_kh ON kqtd_kh.doi_khach_id = ssnh_cau_thu_clb.clb_id			
			INNER JOIN ssnh_cau_lac_bo AS kh ON kh.id = kqtd_kh.doi_khach_id
		WHERE
			lsct.cau_thu_id = '.$cau_thu_id.'
			'.($mua_giai_id?' AND ssnh_vong_dau.mua_giai_id='.$mua_giai_id.'':'').'
		ORDER BY
			ssnh_vong_dau.tu_ngay
	';
	$items = DB::fetch_all($sql);
	foreach($items as $key=>$value){
		$arr = get_doi_thu($value['clb_id'],$value['vong_dau_id']);
		$items[$key]['thoi_gian_ngay'] = date('d/m',$arr['thoi_gian']);
		$items[$key]['thoi_gian_gio'] = date('H:i',$arr['thoi_gian']);
		$items[$key]['doi_thu_vt'] = $arr['doi_thu'];
		$items[$key]['doi_thu'] = $arr['doi_thu'];
	}
	return $items;
}