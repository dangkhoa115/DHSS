<?php
// Cac ham xu ly thong tin nguoi choi
function dang_ky_nguoi_choi($user_id){
	if ($row=DB::fetch('select * from `party` where `user_id`="'.$user_id.'"')){
		$id = DB::fetch('select id from ssnh_nguoi_choi where account_id="'.$user_id.'"','id');	
		$message = '';
	}else{
		$ten_nguoi_choi = 'Người chơi';
		$arr = array(	
			'user_id'=>$user_id,
			'full_name'=>$ten_nguoi_choi,
			'type'=>'USER',
			'time'=>time(),
			'status'=>'SHOW',
			'last_update_time'=>time(),
			'portal_id'=>PORTAL_ID,
			'kind'=>2,
			'gender'=>1
		);
		DB::insert('party',$arr);
		////////////////////////////////////////////////
		$password = rand(000000,999999);// mat khau sinh tu dong
		$account=array(
			'id'=>$user_id,
			'last_online_time'=>time(),
			'password'=>User::encode_password($password),
			'create_date'=>Date_Time::to_sql_date(date('d/m/Y',time())),
			'is_active'=>1,
			'type'=>'USER'
		);
		DB::insert('account',$account);
		////////////////////////////////////////////////
		$nguoi_choi_arr = array(
			'ten'=>$ten_nguoi_choi,
			'dien_thoai'=>$user_id,
			'account_id'=>$user_id
		);
		$id = DB::insert('ssnh_nguoi_choi',$nguoi_choi_arr);
		$message = sms_tai_khoan($user_id,$password);
	}
	return array(
		'id'=>$id,
		'message'=>$message
	);
}
function update_luot_binh_chon_qua_web($nguoi_choi_id,$clb_id,$vong_dau_id,$beta='',$auto=0){
	if(DB::exists('select id from ssnh_cau_lac_bo where id="'.$clb_id.'"')){
		if($delete_ids = Url::get('delete_ids')){
			DB::query('delete from ssnh_luot_binh_chon'.$beta.' where clb_id IN ('.$delete_ids.') and nguoi_choi_id = '.$nguoi_choi_id.' and vong_dau_id='.$vong_dau_id.'');
		}
		if(check_binh_chon($nguoi_choi_id,$vong_dau_id,$beta)){
			$arr = array(
				'nguoi_choi_id'=>$nguoi_choi_id,
				'clb_id'=>$clb_id,
				'vong_dau_id'=>$vong_dau_id,
				'thoi_gian_binh_chon'=>time(),
				'time'=>time(),
				'from_web'=>1,
				'auto'=>$auto,
				'mua_giai_id'=>MUA_GIAI_ID
			);
			//$old_clbs = DB::fetch_all('select id from ssnh_luot_binh_chon where nguoi_choi_id = '.$nguoi_choi_id.' and vong_dau_id='.$vong_dau_id.'');
			
			if(!DB::exists('select id from ssnh_luot_binh_chon'.$beta.' where nguoi_choi_id = '.$nguoi_choi_id.' and clb_id='.$clb_id.' and vong_dau_id='.$vong_dau_id.'')){
				DB::insert('ssnh_luot_binh_chon'.$beta.'',$arr);
				$arr = array(
					'nguoi_choi_id'=>$nguoi_choi_id,
					'vong_dau_id'=>$vong_dau_id,
					'diem'=>0,
					'mua_giai_id'=>MUA_GIAI_ID
				);
				if($nguoi_choi = DB::fetch('select id from ssnh_diem_nguoi_choi'.$beta.' where nguoi_choi_id='.$nguoi_choi_id.' and vong_dau_id = '.$vong_dau_id.'')){
					DB::update('ssnh_diem_nguoi_choi'.$beta.'',$arr,'id='.$nguoi_choi['id']);
				}else{
					DB::insert('ssnh_diem_nguoi_choi'.$beta.'',$arr);
				}
			}
		}
	}
}
function check_binh_chon($nguoi_choi_id,$vong_dau_id,$beta=''){
	$total = DB::fetch('select count(*) as total from ssnh_luot_binh_chon'.$beta.' where nguoi_choi_id = '.$nguoi_choi_id.' and vong_dau_id='.$vong_dau_id.'','total');
	if($total<3){
		return true;
	}else{
		return false;
	}
}
function check_binh_chon_auto($nguoi_choi_id,$vong_dau_id,$beta=''){
	$total = DB::fetch('select count(*) as total from ssnh_luot_binh_chon'.$beta.' where nguoi_choi_id = '.$nguoi_choi_id.' and vong_dau_id='.$vong_dau_id.' and auto=1','total');
	if($total<=0){
		return true;
	}else{
		return false;
	}
}
function check_x2($nguoi_choi_id,$vong_dau_id,$beta=''){
	$total = DB::fetch('select count(*) as total from ssnh_luot_binh_chon'.$beta.' where nguoi_choi_id = '.$nguoi_choi_id.' and vong_dau_id='.$vong_dau_id.' and x2=1','total');
	if($total<3){
		return true;
	}else{
		return false;
	}
}

function update_luot_binh_chon($sms_id,$nguoi_choi_id,$ma_clb,$vong_dau_id,$time){
	if($clb_id = DB::fetch('select id from ssnh_cau_lac_bo where ten_viet_tat="'.$ma_clb.'"','id')){
		$arr = array(
			'nguoi_choi_id'=>$nguoi_choi_id,
			'clb_id'=>$clb_id,
			'vong_dau_id'=>$vong_dau_id,
			'thoi_gian_binh_chon'=>time(),
			'tg_bc_sms'=>$time - 7*3600,
			'id_sms'=>$sms_id,
			'mua_giai_id'=>MUA_GIAI_ID
		);
		if(!DB::exists('select id from ssnh_luot_binh_chon where id_sms = '.$sms_id.'')){
			DB::insert('ssnh_luot_binh_chon',$arr);
			$arr = array(
				'nguoi_choi_id'=>$nguoi_choi_id,
				'vong_dau_id'=>$vong_dau_id,
				'diem'=>0,
				'mua_giai_id'=>MUA_GIAI_ID
			);
			if($nguoi_choi = DB::fetch('select id from ssnh_diem_nguoi_choi where nguoi_choi_id='.$nguoi_choi_id.' and vong_dau_id = '.$vong_dau_id.'')){
				DB::update('ssnh_diem_nguoi_choi',$arr,'id='.$nguoi_choi['id']);
			}else{
				DB::insert('ssnh_diem_nguoi_choi',$arr);
			}
			return 1;
		}else{
			return -2;//loi trung sms id
		}
	}else{
		return -1;
	}
}
function sms_sai_ma_binh_chon(){
	return '';
}
function sms_tai_khoan($user_id,$password){
	return 'Tai khoan nguoi choi Sieusaongoaihang.vn: Ten tai khoan la '.$user_id.', Mat khau la '.$password.'';
}
function update_nguoi_chien_thang($vong_dau_id,$nguoi_choi_id,$thu_hang=1){
	DB::update('ssnh_diem_nguoi_choi',array('chien_thang'=>$thu_hang),'nguoi_choi_id='.$nguoi_choi_id.' and vong_dau_id='.$vong_dau_id.'');
	/////////////////
	//DB::update('ssnh_diem_nguoi_choi_beta',array('chien_thang'=>0),'vong_dau_id='.$vong_dau_id.'');
	//DB::update('ssnh_diem_nguoi_choi_beta',array('chien_thang'=>1),'nguoi_choi_id='.$nguoi_choi_id.' and vong_dau_id='.$vong_dau_id.'');
}
function update_diem_nguoi_choi($vong_dau_id,$clb_id,$beta=''){
	require_once('packages/backend/includes/php/igold.php');
	$sql = '
		SELECT
			bc.id,bc.nguoi_choi_id,bc.clb_id,nc.account_id,bc.hop_le
		FROM
			ssnh_luot_binh_chon'.$beta.' AS bc
			INNER JOIN ssnh_nguoi_choi AS nc ON nc.id = bc.nguoi_choi_id
		WHERE
			bc.vong_dau_id = '.$vong_dau_id.' and bc.clb_id = '.$clb_id.'
	';
	$binh_chons = DB::fetch_all($sql);
	foreach($binh_chons as $key=>$value){
		$sql = '
			SELECT
				bc.id,bc.nguoi_choi_id,bc.clb_id,bc.x2
			FROM
				ssnh_luot_binh_chon'.$beta.' AS bc
				inner join ssnh_nguoi_choi AS nc ON nc.id = bc.nguoi_choi_id
			WHERE
				bc.nguoi_choi_id = '.$value['nguoi_choi_id'].' 
				AND bc.vong_dau_id = '.$vong_dau_id.'
				AND nc.cmtnd
			ORDER BY
				bc.tg_bc_sms DESC
			LIMIT 0,3
		';// danh rieng cho ban beta
		$bc_cua_ncs = DB::fetch_all($sql);
		$arr = array('diem'=>0);
		////reset luot binh chon va diem nguoi choi//////////////////////
		//DB::update('ssnh_diem_nguoi_choi'.$beta,$arr,'nguoi_choi_id='.$value['nguoi_choi_id'].' and vong_dau_id='.$vong_dau_id.'');
		//DB::update('ssnh_luot_binh_chon'.$beta,array('hop_le'=>0),'vong_dau_id='.$vong_dau_id);
		///////////////////////////////////////////////////////////////////
		$igold = 0;
		foreach($bc_cua_ncs as $k=>$v){
			if($v['clb_id'] == $value['clb_id']){
				$diem = 10;
				if($v['x2'] == 1){
					$diem = $diem*2;	
				}
				$arr = array('diem'=>$diem);
				DB::update('ssnh_luot_binh_chon'.$beta,array('hop_le'=>1),'id='.$k);
				$igold = 1;
				break;
			}
		}
		//DB::query('update account set igold = igold + '.$igold.' where id="'.$value['account_id'].'"');
		if($igold > 0 and $value['hop_le'] != 1){
			iGold::receive_igold($value['account_id'],$igold,'Đoán đúng vòng đấu');
		}
		DB::update('ssnh_diem_nguoi_choi'.$beta,$arr,'nguoi_choi_id='.$value['nguoi_choi_id'].' and vong_dau_id='.$vong_dau_id.'');
	}
}
function get_clb_diem_cao_nhat($vong_dau_id,$temporary=false){// tra ve dang mang
	$sql = '
		SELECT
			LS.clb_id AS id,CLB.ten
		FROM
			ssnh_lich_su_cau_thu AS LS
			INNER JOIN ssnh_cau_lac_bo AS CLB ON CLB.id = LS.clb_id
		WHERE
			LS.vong_dau_id = '.$vong_dau_id.'
			'.(($temporary==false)?' AND LS.cao_nhat=1':'').'
		ORDER BY
			'.(($temporary==false)?' LS.diem DESC':'').'
		'.(($temporary==false)?' LIMIT 0,1':'').'	
	';
	if($clb = DB::fetch($sql)){
		return $clb;
	}else{
		return false;
	}
}
function get_tong_binhchon($cond,$beta=''){
	$sql = '
		SELECT 
			COUNT(LBC.id) AS total
		FROM
			ssnh_luot_binh_chon'.$beta.' AS LBC
			INNER JOIN ssnh_nguoi_choi AS NC ON NC.id = LBC.nguoi_choi_id
			INNER JOIN ssnh_cau_lac_bo AS CLB ON CLB.id = LBC.clb_id
			INNER JOIN ssnh_vong_dau AS VD ON VD.id = LBC.vong_dau_id
			INNER JOIN ssnh_diem_nguoi_choi'.$beta.' AS DNC ON DNC.vong_dau_id = VD.id AND DNC.nguoi_choi_id = NC.id
		WHERE
			'.$cond.'
	';
	return DB::fetch($sql,'total');
}
function get_binhchons($cond,$item_per_page=20,$page_no=false,$beta=''){
		$sql = '
		SELECT 
			LBC.id,LBC.thoi_gian_binh_chon,
			LBC.tg_bc_sms,
			CLB.ten AS clb,
			CLB.ten_viet_tat AS ma_clb,			
			LBC.vong_dau_id,
			LBC.clb_id,
			LBC.from_web,
			LBC.get_igold,
			VD.ten AS vong_dau,
			DNC.diem,
			LBC.nguoi_choi_id,
			NC.ten AS nguoi_choi,
			NC.account_id,
			NC.cmtnd,
			NC.dien_thoai,
			party.image_url AS anh_dai_dien,
			LBC.hop_le,
			LBC.auto,
			LBC.x2
		FROM
			ssnh_luot_binh_chon'.$beta.' AS LBC
			INNER JOIN ssnh_nguoi_choi AS NC ON NC.id = LBC.nguoi_choi_id
			INNER JOIN party ON party.user_id = NC.account_id
			INNER JOIN ssnh_cau_lac_bo AS CLB ON CLB.id = LBC.clb_id
			INNER JOIN ssnh_vong_dau AS VD ON VD.id = LBC.vong_dau_id
			INNER JOIN ssnh_diem_nguoi_choi'.$beta.' AS DNC ON DNC.vong_dau_id = VD.id AND DNC.nguoi_choi_id = NC.id
		WHERE
			'.$cond.'
		ORDER BY
			LBC.id DESC
		'.($page_no?('LIMIT '.(($page_no-1)*$item_per_page).','.$item_per_page.''):'LIMIT 0,'.$item_per_page.'').'
	';
	if(User::is_admin()){
		//echo $sql;exit();
	}
	$items = DB::fetch_all($sql);
	$stt = 1;
	foreach($items as $key=>$value){
		$items[$key]['i'] = $stt;
		$stt++;
		$items[$key]['thoi_gian_binh_chon'] = date('d/m/Y H:i:s\'',($value['from_web']?$value['thoi_gian_binh_chon']:$value['tg_bc_sms']));
//		if($value['nguoi_choi_id'] == get_nguoi_chien_thang($value['vong_dau_id'])){
		if($value['hop_le']){
			$items[$key]['chien_thang'] = '<span class="winner"></span>';
		}else{
			$items[$key]['chien_thang'] = '<span style="width:12px;height:12px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>';
		}
		$can_view_auto = false;
		$vong_dau_id = $value['vong_dau_id'];
		if($vong_dau_id and get_id_vong_dau_ket_thuc_gan_nhat()>=$vong_dau_id){
			$can_view_auto = true;
		}
		if($vong_dau_id and get_vong_dau_truoc_sms()>=$vong_dau_id){
			$can_view_auto = true;
		}
		if($value['auto']==1 and $can_view_auto==false){
			$items[$key]['clb'] = 'auto';
		}
		$items[$key]['nguoi_choi'] = an_so_dien_thoai($value['account_id']);
		$items[$key]['cmtnd'] = an_so_dien_thoai($value['cmtnd'],3);
	}
	return $items;
}
function get_tong_diem_nguoi_choi($nguoi_choi_id,$beta=''){
	$sql = '
		SELECT 
			SUM(DNC.diem) AS diem
		FROM
			ssnh_diem_nguoi_choi'.$beta.' DNC
		WHERE
			DNC.nguoi_choi_id = '.$nguoi_choi_id.'
			AND DNC.mua_giai_id = '.MUA_GIAI_ID.'
		GROUP BY
			DNC.nguoi_choi_id
	';
	return DB::fetch($sql,'diem');
}
function get_nguoi_chien_thang($vong_dau_id){
	$sql = '
		SELECT 
			DNC.nguoi_choi_id
		FROM
			ssnh_diem_nguoi_choi AS DNC
		WHERE
			DNC.vong_dau_id = '.$vong_dau_id.'
			AND DNC.mua_giai_id = '.MUA_GIAI_ID.'
			AND DNC.diem > 0
		GROUP BY
			DNC.nguoi_choi_id
	';
	if($nguoi_choi_id = DB::fetch($sql,'nguoi_choi_id')){
		return $nguoi_choi_id;
	}else{
		return false;
	}
}
function get_vong_dau_theo_sms(){
	// lay ra vong dau thoa man dieu kien mo sms hien tai
	if(get_vong_dau_dang_dien_ra_sms()){
		return get_vong_dau_dang_dien_ra_sms();
	}else{
		return get_vong_dau_tiep_theo_sms();
	}
	
}

function get_vong_dau_dang_dien_ra_sms(){
	 $sql = '
			select 
				ssnh_vong_dau.id
			from 
				ssnh_vong_dau
			where 
				ssnh_vong_dau.tu_ngay_sms<="'.date('Y-m-d H:i').'" AND ssnh_vong_dau.den_ngay_sms>="'.date('Y-m-d H:i').'"
			LIMIT
				0,1
	';
	
	if($vong_dau = DB::fetch($sql)){
		$vong_dau = DB::fetch($sql);
		return $vong_dau['id'];
	}else{
		return false;
	}
}
function get_vong_dau_truoc_sms(){
	$sql = '
			select 
				ssnh_vong_dau.id
			from 
				ssnh_vong_dau
			where 
				ssnh_vong_dau.den_ngay_sms<"'.date('Y-m-d H:i').'"
			ORDER BY
				ssnh_vong_dau.tu_ngay_sms DESC
			LIMIT
				0,1
	';	
	if($vong_dau = DB::fetch($sql)){
		$vong_dau = DB::fetch($sql);
		return $vong_dau['id'];
	}else{
		return false;
	}
}
function get_vong_dau_tiep_theo_sms(){
	$sql = '
			select 
				ssnh_vong_dau.id
			from 
				ssnh_vong_dau
			where 
				ssnh_vong_dau.tu_ngay_sms>"'.date('Y-m-d H:i').'"
			ORDER BY
				ssnh_vong_dau.tu_ngay_sms ASC
			LIMIT
				0,1
	';
	if($vong_dau = DB::fetch($sql)){
		$vong_dau = DB::fetch($sql);
		return $vong_dau['id'];
	}else{
		return false;
	}
}
function an_so_dien_thoai($number,$hide_number=7){
	if(User::can_admin(MODULE_QUANLYCAUTHU,ANY_CATEGORY)){
		return $number;
	}else{
		return '.....'.substr($number,$hide_number,strlen($number)-$hide_number);
	}
}
function reset_mat_khau($sdt,$mdv,$content){
	$sdt = trim($sdt);
	if($mdv == 'EPL' and strtoupper($content) == 'PASS'){
		if ($row=DB::fetch('select * from `party` where `user_id`="'.$sdt.'"')){
			$id = DB::fetch('select id from ssnh_nguoi_choi where account_id="'.$sdt.'"','id');	
			$password = rand(000000,999999);// mat khau sinh tu dong
			$acc_arr=array(
				'password'=>User::encode_password($password),
			);
			DB::update('account',$acc_arr,'id="'.$sdt.'"');
			$message = 'Sieusaongoaihang.vn doi mat khau thanh cong. Mau khau moi cua ban la: '.$password.'';
			echo '{"message":"'.$message.'","status":3}'; // sai so dt
		}else{
			echo '{"message":"So dien thoan nay chua dang ky tai khoan Sieusaongoaihang.vn","status":-3}'; // sai so dt
		}
	}else{
		echo '{"message":"SMS khoi phuc mat khau cua ban khong hop le. Vui long kiem tra lai","status":-4}'; // ma reset mat khau khong hop le
	}
}
function get_tong_tongket_nguoichoi($nguoi_choi_id=false,$cond='1=1'){
	$sql = '
		SELECT 
			count(distinct dnc.nguoi_choi_id) as total
		FROM
			ssnh_diem_nguoi_choi AS dnc
			INNER JOIN ssnh_vong_dau AS vd ON vd.id = dnc.vong_dau_id
			INNER JOIN ssnh_nguoi_choi AS nc ON nc.id = dnc.nguoi_choi_id
		WHERE
			'.$cond.'
	';
	return DB::fetch($sql,'total');
}
function get_tongket_nguoichois($nguoi_choi_id=false,$item_per_page=20,$cond='1=1'){
	$having = '';
	$month = false;
	if($y = Url::iget('year') and $m = Url::iget('month')){
		$month = true;
		$extra_cond = '';//'AND ( "'.$y.'-'.$m.'-01"<=vd.tu_ngay_sms AND vd.tu_ngay_sms<="'.$y.'-'.$m.'-'.cal_days_in_month(CAL_GREGORIAN,$m,$y).'")';
	}else{
		$extra_cond = '';
	}
	$diem_quy = false;
	if($quy = Url::get('quy')){
		$diem_quy = true;
		if($quy == 2){
			$start_date = '2015-11-01 00:00:00';
			$end_date = '2016-01-31 23:59:59';
		}else{
			$start_date = '2015-08-01 00:00:00';
			$end_date = '2015-10-31 23:59:59';
		}
	}
	$sql = '
		SELECT 
			dnc.nguoi_choi_id as id,
			nc.ten as nguoi_choi,
			nc.cmtnd,
			nc.dien_thoai,
			zone.name as tinh_thanh,
			(SELECT COUNT(*) FROM ssnh_diem_nguoi_choi WHERE ssnh_diem_nguoi_choi.nguoi_choi_id = nc.id and ssnh_diem_nguoi_choi.mua_giai_id="'.MUA_GIAI_ID.'") AS so_vong_dau,
			(SELECT COUNT(*) FROM ssnh_diem_nguoi_choi WHERE ssnh_diem_nguoi_choi.nguoi_choi_id = nc.id and ssnh_diem_nguoi_choi.mua_giai_id="'.MUA_GIAI_ID.'" AND ssnh_diem_nguoi_choi.chien_thang = 1) AS so_lan_chien_thang,
			(SELECT COUNT(*) FROM ssnh_diem_nguoi_choi WHERE ssnh_diem_nguoi_choi.nguoi_choi_id = nc.id and ssnh_diem_nguoi_choi.mua_giai_id="'.MUA_GIAI_ID.'" AND ssnh_diem_nguoi_choi.diem > 0) AS du_doan_dung,
			'.($month?'(
				SELECT 
					sum(ssnh_diem_nguoi_choi.diem) 
				FROM 
					ssnh_diem_nguoi_choi 
					INNER JOIN ssnh_vong_dau ON ssnh_vong_dau.id = ssnh_diem_nguoi_choi.vong_dau_id
				WHERE 
					ssnh_diem_nguoi_choi.nguoi_choi_id = nc.id AND  "'.$y.'-'.$m.'-01 00:00:00"<=ssnh_vong_dau.den_ngay_sms 
					AND ssnh_vong_dau.mua_giai_id='.MUA_GIAI_ID.'
					AND ssnh_vong_dau.den_ngay_sms<="'.$y.'-'.$m.'-'.cal_days_in_month(CAL_GREGORIAN,$m,$y).' 23:59:00") AS diem_thang,':'0 as diem_thang,').'
				'.($diem_quy?'(
				SELECT 
					sum(ssnh_diem_nguoi_choi.diem) 
				FROM 
					ssnh_diem_nguoi_choi 
					INNER JOIN ssnh_vong_dau ON ssnh_vong_dau.id = ssnh_diem_nguoi_choi.vong_dau_id
				WHERE 
					ssnh_diem_nguoi_choi.nguoi_choi_id = nc.id AND  "'.$start_date.'"<=ssnh_vong_dau.den_ngay_sms 
					AND ssnh_vong_dau.mua_giai_id='.MUA_GIAI_ID.'
					AND ssnh_vong_dau.den_ngay_sms<="'.$end_date.'") AS diem_quy,':'0 as diem_quy,').'	
			SUM(dnc.diem) AS diem
		FROM
			ssnh_diem_nguoi_choi AS dnc
			INNER JOIN ssnh_nguoi_choi AS nc ON nc.id = dnc.nguoi_choi_id
			INNER JOIN zone ON zone.id = nc.khu_vuc_id
		WHERE
			'.$cond.'
			'.$extra_cond.'
		GROUP BY
			dnc.nguoi_choi_id
		ORDER BY
			'.($month?'diem_thang DESC, SUM(dnc.diem) DESC':($diem_quy?'diem_quy DESC':'SUM(dnc.diem) DESC')).',so_lan_chien_thang DESC,dnc.nguoi_choi_id
		LIMIT
			'.((page_no('pn_tk')-1)*$item_per_page).','.$item_per_page.'
	';
	if(User::is_admin()){
		//echo '<pre>'.$sql;exit();
	}
	$items = DB::fetch_all($sql,'nguoi_choi_id');
	$i=1 + (page_no('pn_tk') - 1)*$item_per_page;
	foreach($items as $k=>$v) {
			$items[$k]['dien_thoai'] = an_so_dien_thoai($v['dien_thoai']);
			$items[$k]['cmtnd'] = an_so_dien_thoai($v['cmtnd'],1);
			$items[$k]['thu_hang'] = $i;
			$i++;
	}
	return $items;
}
function get_vi_tri_nguoi_choi($nguoi_choi_id,$vong_dau_id=false){
	$sql = '
		SELECT * FROM (
			SELECT s.*, @rank := @rank + 1 rank FROM (
				SELECT nguoi_choi_id, mua_giai_id,sum(diem) TotalPoints FROM ssnh_diem_nguoi_choi AS t
				GROUP BY nguoi_choi_id
			) s, (SELECT @rank := 0) init
			ORDER BY TotalPoints DESC,(SELECT COUNT(*) FROM ssnh_diem_nguoi_choi WHERE ssnh_diem_nguoi_choi.nguoi_choi_id = s.nguoi_choi_id AND ssnh_diem_nguoi_choi.chien_thang = 1 AND ssnh_diem_nguoi_choi.mua_giai_id='.MUA_GIAI_ID.')  DESC,s.nguoi_choi_id
		) r
		WHERE nguoi_choi_id = '.$nguoi_choi_id.' AND mua_giai_id='.MUA_GIAI_ID.'
	';
	if($item=DB::fetch($sql)){
		return $item['rank'];
	}else{
		return 0;
	}
}
function get_nguoi_chien_thangs($item_per_page=38,$mua_giai_id=1,$show_phone=false,$page_no=false){
	$sql = '
		SELECT 
			dnc.id,
			dnc.diem,
			nc.ten AS nguoi_choi,
			nc.id as nguoi_choi_id,
			nc.dien_thoai,
			vd.ten AS vong_dau,
			clb.ten AS clb,
			lbc.clb_id,
			party.image_url AS anh_dai_dien,
			dnc.chien_thang
		FROM
			ssnh_diem_nguoi_choi AS dnc
			INNER JOIN ssnh_nguoi_choi AS nc ON nc.id = dnc.nguoi_choi_id
			INNER JOIN party ON party.user_id = nc.account_id
			INNER JOIN ssnh_vong_dau AS vd On vd.id = dnc.vong_dau_id
			INNER JOIN ssnh_luot_binh_chon AS lbc ON lbc.nguoi_choi_id = nc.id and lbc.vong_dau_id = vd.id
			INNER JOIN (
				SELECT 
					ssnh_cau_lac_bo.id,ssnh_cau_lac_bo.ten,ssnh_lich_su_cau_thu.cau_thu_id,ssnh_lich_su_cau_thu.vong_dau_id
				FROM	
					ssnh_cau_lac_bo
					INNER JOIN ssnh_lich_su_cau_thu ON ssnh_lich_su_cau_thu.clb_id = ssnh_cau_lac_bo.id
				WHERE
					ssnh_lich_su_cau_thu.cao_nhat
				ORDER BY
					ssnh_lich_su_cau_thu.id DESC
			) clb ON clb.id = lbc.clb_id and clb.vong_dau_id = vd.id
			
		WHERE
			dnc.mua_giai_id='.$mua_giai_id.'
			AND dnc.chien_thang
		GROUP BY
			dnc.id
		ORDER BY
			vd.tu_ngay DESC,dnc.chien_thang,dnc.diem DESC,dnc.nguoi_choi_id
		LIMIT
			'.($page_no?(($page_no-1)*$item_per_page).','.$item_per_page:'0,'.$item_per_page.'').'
	';
	$items = DB::fetch_all($sql);
	foreach($items as $k=>$v) {
		if(!$show_phone){
			$items[$k]['dien_thoai'] = an_so_dien_thoai($v['dien_thoai']);
		}
		$items[$k]['giai_thuong'] = ($v['chien_thang']==1)?'<span class="giai-nhat">Giải nhất</span>':(($v['chien_thang']==2)?'<span class="giai-nhi">Giải nhì</span>':'Giải ba');
	}
	if(User::is_admin()){
		//echo '<pre>'.$sql;
		//System::debug($items);
		//exit();
	}
	return $items;
}
function get_nguoi_chien_thang_thangs($item_per_page=8,$mua_giai_id=2,$show_phone=false){
	$sql = '
		SELECT 
			nc.id,	
			nc.ten AS nguoi_choi,
			nc.dien_thoai,
			nc_cth_thang.thang,
			nc_cth_thang.giai
		FROM
			ssnh_nc_ch_th_thang AS nc_cth_thang
			INNER JOIN ssnh_nguoi_choi AS nc ON nc.account_id = nc_cth_thang.user_id
		WHERE
			1=1
			AND nc_cth_thang.mua_giai_id = '.$mua_giai_id.'
		ORDER BY
			nc_cth_thang.nam DESC,nc_cth_thang.thang,nc_cth_thang.giai
		LIMIT
			0,'.$item_per_page.'
	';
	$items = DB::fetch_all($sql);
	foreach($items as $k=>$v) {
		if(!$show_phone){
			$items[$k]['dien_thoai'] = an_so_dien_thoai($v['dien_thoai']);
		}
	}
	return $items;
}
function xem_clb_trong_binh_chon($nguoi_choi_id,$vong_dau_id=false){
	$return = false;
	if(User::can_edit(MODULE_QUANLYCAUTHU,ANY_CATEGORY)){
		$return = true;
	}
	if(isset($_SESSION['user_data']['nguoi_choi_id']) and $nguoi_choi_id == $_SESSION['user_data']['nguoi_choi_id']){
		$return = true;
	}
	//return $return; // tam thoi
	//if(User::is_admin())
	{
		//echo get_id_vong_dau_ket_thuc_gan_nhat();exit();
	}
	if($vong_dau_id and get_id_vong_dau_ket_thuc_gan_nhat()>=$vong_dau_id){
		$return = true;
	}
	if($vong_dau_id and get_vong_dau_truoc_sms()>=$vong_dau_id){
		$return = true;
	}
	/*$sms_vong_dau_id = 0;
	if(get_vong_dau_dang_dien_ra_sms()){
		$sms_vong_dau_id = get_vong_dau_dang_dien_ra_sms();
		$second = DB::fetch('select den_ngay_sms from ssnh_vong_dau where id = '.$sms_vong_dau_id.'','den_ngay_sms');
	}else{
		if($sms_vong_dau_id == get_vong_dau_tiep_theo_sms()){
			$vd = DB::fetch('select ten,tu_ngay_sms from ssnh_vong_dau where id = '.$sms_vong_dau_id.'');
			$second = $vd['tu_ngay_sms'];
		}else{
			$second = 0;
		}
	}
	if(Session::get('user_id') == 'le.do.tien@lasermedia.vn'){
		//echo $second;
		//echo (time()).'<br>'.(strtotime($second)  - 30*3600);
			//exit();
	}*/
	return $return;
}
/*function check_valid_binh_chon($binh_chon_id,$nguoi_choi_id,$vongdau_id){
	// 3 tin nhan cuoi cung cua 
	$sql = '
		SELECT
				bc.id,bc.nguoi_choi_id,bc.clb_id
			FROM
				ssnh_luot_binh_chon AS bc
				inner join ssnh_nguoi_choi AS nc ON nc.id = bc.nguoi_choi_id
			WHERE
				bc.nguoi_choi_id = '.$nguoi_choi_id.'
				AND bc.vong_dau_id = '.$vong_dau_id.'
				AND nc.cmtnd
			ORDER BY
				bc.tg_bc_sms DESC
			LIMIT 0,3
	';
	$items = DB::fetch_all($sql);
}*/
function get_level($account_id){
	$total = DB::fetch('SELECT COUNT(*) AS total FROM news WHERE user_id="'.$account_id.'" AND publish AND type="NEWS"','total');
	if($total<100){
		return 1;// beginner
	}elseif($total>=100 and $total<=500){
		return 2; // advance
	}else{
		return 3; // pro
	}
}
function get_igold_by_level($account_id){
	$igold = 20;
	if(get_level($account_id)==2){
		$igold = 30;
	}elseif(get_level($account_id)==3){
		$igold = 50;
	}
	return $igold;
}
function get_top_account_by_igold(){
	$items = DB::fetch_all('
		select
			id,igold
		from
			account
		where	
			igold > 0
		order by 
			igold DESC
		limit
			0,20
	');
	return $items;
}
function get_top_account_by_paid_igold(){
	$items = DB::fetch_all('
		select
			igold.account_id as id,SUM(igold.value) as igold
		from
			igold
		where	
			igold.value < 0
		GROUP BY
			igold.account_id
		order by 
			SUM(abs(igold.value)) DESC
		limit
			0,20
	');
	return $items;
}