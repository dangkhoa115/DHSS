<?php
define('MAX_TEAM',20);
define('VONG_QUAY',1);
define('THE_DOI_TEN',2);
define('BINH_THE_LUC',3);
define('THE_CHUYEN_NHUONG',4);
define('DP_AO',5); // dong phuc
define('DP_QUAN',6); // dong phuc
define('DP_TAT',7); // dong phuc
define('DP_GIAY',8); // dong phuc
class FMGAME{
	static function mua_dong_phuc($item_id){
		$account_id = Session::get('user_id');
		if($item = DB::select('fmg_items','id='.$item_id) and !DB::exists('select fmg_items_store.id from fmg_items_store inner join fmg_items on fmg_items.id = fmg_items_store.item_id where fmg_items.id='.$item_id.' and fmg_items_store.account_id="'.$account_id.'"')){
			DB::insert('fmg_items_store',array(
				'item_id'=>$item_id,
				'account_id'=>$account_id,
				'quantity'=>1,
				'name'=>$item['name']
			));
			iGold::pay_igold($account_id,$item['price'],'Starteam: Mua item '.$item['name'].'');
			echo 'true';
		}else{
			echo 'existed';
		}
	}
	static function get_items($clb_id,$type){
		$account_id = DB::fetch('select account_id from fmg_clb where id='.$clb_id.'','account_id');
		$sql = 'select ist.id,ist.quantity from fmg_items_store as ist inner join fmg_items on fmg_items.id=ist.item_id where ist.account_id="'.$account_id.'" and fmg_items.type='.$type.'';
		return DB::fetch($sql,'quantity');
	}
	static function nhan_qua_hlv(){
		$account_id = Session::get('user_id');
		$diem_kn = FMGAME::get_diem_kn($account_id);
		$kq = 'false';
		if($diem_kn>=500){
			if(!DB::exists('select id from fmg_received_igold where account_id="'.$account_id.'" and diem_kn=500')){
				DB::insert('fmg_received_igold',array('account_id'=>$account_id,'diem_kn'=>500,'igold'=>10,'time'=>time()));			
				iGold::receive_igold($account_id,10,'Starteam: Thưởng điểm kinh nghiệm HLV mức 500');
				$kq = 'true';
			}else{
				$kq = '500';
			}
		}
		if($diem_kn>=1000){
			if(!DB::exists('select id from fmg_received_igold where account_id="'.$account_id.'" and diem_kn=1000')){
				DB::insert('fmg_received_igold',array('account_id'=>$account_id,'diem_kn'=>1000,'igold'=>10,'time'=>time()));			
				iGold::receive_igold($account_id,30,'Starteam: Thưởng điểm kinh nghiệm HLV mức 1000');
				$kq = 'true';
			}else{
				$kq = '1000';
			}
		}
		if($diem_kn>=2000){
			if(!DB::exists('select id from fmg_received_igold where account_id="'.$account_id.'" and diem_kn=2000')){
				DB::insert('fmg_received_igold',array('account_id'=>$account_id,'diem_kn'=>2000,'igold'=>10,'time'=>time()));			
				iGold::receive_igold($account_id,50,'Starteam: Thưởng điểm kinh nghiệm HLV mức 2000');
				$kq = 'true';
			}else{
				$kq = '2000';
			}
		}
		echo $kq;
	}
	static function get_diem_kn($account_id){
		return $diem_kn = DB::fetch('select diem_kn from account where id ="'.$account_id.'"','diem_kn');
	}
	static function get_hang_hlv($account_id){
		$str = 'Tập sự';
		$diem_kn = FMGAME::get_diem_kn($account_id);
		if($diem_kn<500){
			$str = 'Tập sự';
		}elseif($diem_kn>=500 and $diem_kn<1000){
			$str = 'Bán chuyên';	
		}elseif($diem_kn>=1000 and $diem_kn<2000){	
			$str = 'Chuyên nghiệp';
		}elseif($diem_kn>=2000){
			$str = 'Ngoại hạng';
		}
		return $str;
	}
	static function get_anh_hang_hlv($account_id){
		$diem_kn = FMGAME::get_diem_kn($account_id);
		if($diem_kn<500){
			$str = 'skins/ssnh/images/fm_game/tap_su.png';
		}elseif($diem_kn>=500 and $diem_kn<1000){
			$str = 'skins/ssnh/images/fm_game/ban_chuyen.png';	
		}elseif($diem_kn>=1000 and $diem_kn<2000){	
			$str = 'skins/ssnh/images/fm_game/chuyen_nghiep.png';
		}elseif($diem_kn>=2000){
			$str = 'skins/ssnh/images/fm_game/ngoai_hang.png';
		}
		return $str;
	}
	static function co_the_doi_ten(){
		return DB::exists('select fmg_items_store.id from fmg_items_store inner join fmg_items on fmg_items.id = fmg_items_store.item_id where fmg_items.type=2 and fmg_items_store.account_id="'.Session::get('user_id').'" and fmg_items_store.quantity>0')?true:false;
	}
	static function moderator($account_id,$mode=1){
		$mode_list = array(
			
		);
	}
	static function get_total_clb($server_id){
		return DB::fetch('select count(fmg_clb_server.id) as acount from fmg_clb_server where fmg_clb_server.server_id='.$server_id.'','acount');
	}
	static function get_all_servers($mua_giai_id=2,$cond=false){
		$sql = '
			select 
				fmg_server.id
				,fmg_server.name
				,(select count(fmg_clb_server.id) from fmg_clb_server where fmg_clb_server.server_id=fmg_server.id) as tong_clb
			from 
				fmg_server
			where 
				for_winner <> 1
				'.$cond.'
			order by
				tong_clb DESC
		';
		$servers = DB::fetch_all($sql);
		foreach($servers as $key=>$value){
			$servers[$key]['name'] = $value['name'].' (Có '.$value['tong_clb'].' đội)';
		}
		return $servers;
	}
	static function get_running_server($mua_giai_id=2,$max=false,$cond=false,$limit=1000){
		$sql = '
			select 
				fmg_server.id
				,fmg_server.name
				,(select count(*) from fmg_clb_server where fmg_clb_server.server_id=fmg_server.id) as tong_clb
			from 
				fmg_server
			where 
				for_winner <> 1
				AND fmg_server.mua_giai_id='.$mua_giai_id.'
				AND fmg_server.status="OPEN"
				'.($max?' AND (select count(*) from fmg_clb_server where fmg_clb_server.server_id=fmg_server.id)<'.MAX_TEAM.'':'').'
				'.$cond.'
			order by
				tong_clb DESC
			limit
				0,'.$limit.'
		';
		$servers = DB::fetch_all($sql);
		foreach($servers as $key=>$value){
			$servers[$key]['name'] = $value['name'].' (Có '.$value['tong_clb'].' đội)';
		}
		return $servers;
	}
	static function get_vongdaus($server_id,$co_lich=false){
		$sql = '
			select 
				fmg_vong_dau.*
			from 
				fmg_vong_dau
				'.($co_lich?' INNER JOIN fmg_schedule ON fmg_schedule.vong_dau_id = fmg_vong_dau.id':'').'
			where 
					fmg_vong_dau.server_id='.$server_id.'
			order by
				fmg_vong_dau.id
		';
		return DB::fetch_all($sql);
	}
	static function get_vong_dau_trong_ngay($server_id,$play_off=0){
		$sql = '
			select 
				fmg_vong_dau.id,fmg_vong_dau.ten
			from 
				fmg_vong_dau
				inner join fmg_schedule on fmg_schedule.vong_dau_id = fmg_vong_dau.id
			where 
					fmg_vong_dau.server_id='.$server_id.'
				AND	"'.date('Y-m-d 00:00:00').'"<= fmg_schedule.thoi_gian
				AND "'.date('Y-m-d H:s:i').'">=fmg_schedule.thoi_gian
				AND fmg_schedule.play_off = '.$play_off.'
			order by
				fmg_vong_dau.id
		';
		$vong_daus = DB::fetch_all($sql);
		return $vong_daus;
	}
	static function get_lien_dau_trong_ngay($server_id){
		$cap_daus = DB::fetch_all('
			select 
				id,clb_id1,clb_id2,round
			from 
				fmg_lien_dau 
			where 
				ld_server_id='.$server_id.'
				AND	"'.date('Y-m-d 00:00:00').'" <= open_time
				AND "'.date('Y-m-d H:s:i').'" >= open_time
				AND (win_clb_id is null or win_clb_id = 0)
			order by
				round,open_time
		');
		return $cap_daus;
	}
	static function get_id_vong_dau_hien_tai($server_id){
		$sql = '
			select 
				fmg_vong_dau.id
			from 
				fmg_vong_dau
			where 
					fmg_vong_dau.server_id='.$server_id.'
				AND	"'.date('Y-m-d 00:00:00').'"<=(SELECT MIN(thoi_gian) from fmg_schedule WHERE fmg_vong_dau.id = fmg_schedule.vong_dau_id)
				AND "'.date('Y-m-d 23:59:59').'">=(SELECT MAX(thoi_gian) from fmg_schedule WHERE fmg_vong_dau.id = fmg_schedule.vong_dau_id)
			ORDER BY
				ABS('.time().'-(SELECT UNIX_TIMESTAMP(MIN(thoi_gian)) from fmg_schedule WHERE fmg_vong_dau.id = fmg_schedule.vong_dau_id))
			LIMIT
				0,1
		';
		if($vong_dau = DB::fetch($sql)){
			
		}else{
			$sql = '
					select 
						fmg_vong_dau.id
					from 
						fmg_vong_dau
					where 
						fmg_vong_dau.server_id='.$server_id.'
						AND "'.date('Y-m-d H:i').'"<(SELECT MIN(thoi_gian) from fmg_schedule WHERE fmg_vong_dau.id = fmg_schedule.vong_dau_id)
					ORDER BY
						(SELECT MIN(thoi_gian) from fmg_schedule WHERE fmg_vong_dau.id = fmg_schedule.vong_dau_id)
					LIMIT
						0,1
			';
			$vong_dau = DB::fetch($sql);
		}
		//echo $vong_dau['id'];
		//exit();
		return $vong_dau['id'];
	}
	static function get_tong_so_the_cn(){
		$account_id = Session::get('user_id');
		$sql = 'select ist.id,ist.quantity from fmg_items_store as ist inner join fmg_items on fmg_items.id=ist.item_id where ist.account_id="'.$account_id.'" and fmg_items.type='.THE_CHUYEN_NHUONG.'';
		return DB::fetch($sql,'quantity');
	}
	static function can_transfer(){
		//return true;
		$mua_giai_id = MUA_GIAI_ID;
		if(!FMGAME::my_team_id($mua_giai_id)){
			return true;
		}
		$clb_id = FMGAME::my_team_id($mua_giai_id);
		if(DB::fetch('select `full` from fmg_clb where id='.$clb_id.'','full')==1){
			if(((date('N')>=3 and date('N') <= 6) or (date('N')==6 and date('H')<= 20)))// or $_SERVER['REMOTE_ADDR'] == '1.55.96.24'
			{
				$server_id = FMGAME::get_team_server_id($mua_giai_id);
				//echo DB::fetch('select count(*) as acount from fmg_clb_transfer where clb_id='.$clb_id.' and server_id='.$server_id.'','acount');
				$vong_dau_id = get_id_vong_dau_hien_tai(true);
				if(DB::fetch('select count(*) as acount from fmg_clb_transfer where clb_id='.$clb_id.' and vong_dau_id='.$vong_dau_id.' and sell = 0 and create_team=0','acount') >=3 + FMGAME::get_tong_so_the_cn()){
					return false;
				}else{
					return true;
				}
			}else{
				return false;
			}
		}else{
			return true;
		}
	}
	static function get_team_server_id($mau_giai_id=2){
		if($clb_id=FMGAME::my_team_id($mau_giai_id) and $row=DB::fetch('select fmg_clb_server.id,fmg_clb_server.server_id from fmg_clb_server inner join fmg_server on fmg_server.id=fmg_clb_server.server_id where fmg_clb_server.clb_id="'.$clb_id.'" and fmg_server.status<>"CLOSED"')){
			return $row['server_id'];
		}else{
			return false;
		}
	}
	static function my_team_id($mau_giai_id=2){
		if($row=DB::fetch('select id from fmg_clb where account_id="'.Session::get('user_id').'"')){
			return $row['id'];
		}else{
			return false;
		}
	}
	static function get_clbs($server_id,$mua_giai_id,$order_by='fmg_clb.id DESC',$limit=1000,$cond='1=1'){
		$sql = '
			select 
				fmg_clb.id,fmg_clb.name
			from 
				fmg_clb
				inner join fmg_clb_server ON fmg_clb_server.clb_id = fmg_clb.id
				inner join fmg_server ON fmg_server.id = fmg_clb_server.server_id
			where 
				'.$cond.'
				and fmg_clb_server.server_id='.$server_id.'
				AND fmg_clb.mua_giai_id='.$mua_giai_id.'
			order by 
				'.$order_by.'
			limit
				0,'.$limit.'
		';//fmg_server.status = "OPEN"
		$clbs = DB::fetch_all($sql);
		return $clbs;
	}
	static function auto_generate_clbs(){
		$array = array(
			'Dream Team','Super Stars','The Angels','Super Team',
			'Nhà vô địch','The men','xMen','Tôi yêu bóng đá','Những người bạn','Hot girls',
			'Dream girls','Super kids','The Gunner 01','Kiss from a rose',
			'Hold me forever'
		);
		for($i=0;$i<15;$i++){
			$ten_doi = $array[$i];
			if($row=DB::fetch('select id,name from fmg_clb where name="'.$ten_doi.'" and machine=1')){
				$clb_id = $row['id'];
			}else{
				$clb_id = DB::insert('fmg_clb',array(
					'name'=>$ten_doi,
					'time'=>time(),
					'machine'=>1,
					'mua_giai_id'=>MUA_GIAI_ID
				));
			}
			{
				$tms = FMGAME::get_doi_hinh('TM',1);
				foreach($tms as $key=>$value){
					$max_tm = FMGAME::get_pos_count('TM',$clb_id);
					if($max_tm<1){
						DB::insert('fmg_clb_cau_thu',array('clb_id'=>$clb_id,'cau_thu_id'=>$key));
					}
				}
				$hvs = FMGAME::get_doi_hinh('HV',4);
				
				foreach($hvs as $key=>$value){
					$max_hv = FMGAME::get_pos_count('HV',$clb_id);
					if($max_hv<4){
						DB::insert('fmg_clb_cau_thu',array('clb_id'=>$clb_id,'cau_thu_id'=>$key));
					}
				}
				$tvs = FMGAME::get_doi_hinh('TV',4);
				
				foreach($tvs as $key=>$value){
					$max_tv = FMGAME::get_pos_count('TV',$clb_id);
					if($max_tv<4){
						DB::insert('fmg_clb_cau_thu',array('clb_id'=>$clb_id,'cau_thu_id'=>$key));
					}
				}
				$tds = FMGAME::get_doi_hinh('TD',2);
				foreach($tds as $key=>$value){
					$max_td = FMGAME::get_pos_count('TD',$clb_id);
					if($max_td<2){
						DB::insert('fmg_clb_cau_thu',array('clb_id'=>$clb_id,'cau_thu_id'=>$key));
					}
				}
			}
		}
	}
	static function get_doi_hinh($ma_vi_tri,$num,$cond=false){
		$sql = '
			select 
				ssnh_cau_thu.id,vttn.cost
			from 
				ssnh_cau_thu
				inner join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id and ssnh_cau_thu_clb.mua_giai_id='.MUA_GIAI_ID.'
				inner join ssnh_cau_lac_bo on ssnh_cau_lac_bo.id = ssnh_cau_thu_clb.clb_id
				inner join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id
				inner join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
			where 
				vtts.ma_vi_tri ="'.$ma_vi_tri.'"
				AND vttn.cost<10
				AND ssnh_cau_thu.off <> 1
				'.$cond.'
			ORDER BY
				rand()
			LIMIT
				0,'.$num.'
		';
		$items = DB::fetch_all($sql);
		return $items;
	}
	static function get_team($clb_id){
		$sql = '
			select 
				fmg_clb.id,fmg_clb.logo,fmg_clb.name,fmg_clb.stamina,
				fmg_clb.first_time,
				fmg_clb.account_id,
				account.last_online_time,
				account.diem_kn,
				party.image_url,
				party.full_name
			from 
				fmg_clb
				inner join account on account.id=fmg_clb.account_id
				inner join party on party.user_id=account.id
			where
				fmg_clb.id='.$clb_id.'
		';
		$item = DB::fetch($sql);
		$server = DB::fetch('select fmg_server.id,fmg_server.name from fmg_server inner join fmg_clb_server on fmg_clb_server.server_id=fmg_server.id where fmg_clb_server.clb_id='.$clb_id.' and fmg_server.status<>"CLOSED"');
		$item['server'] = $server['name'];
		$item['server_id'] = $server['id'];
		$item['phong_do'] = FMGAME::get_phong_do($clb_id);
		$item['last_online_time'] = date('H:i\' d/m',$item['last_online_time']);
		///////////////////////
		return $item;
	}
	static function get_ty_le_thang($t1,$t2){
		$ty_le_thang = 0;
		$ty_le_thang = round($t1/($t1+$t2)*100);
		return $ty_le_thang;
	}
	static function get_phong_do($clb_id){
		///////////////////////
		$phong_do = '';
		if(!($server_id = DB::fetch('
			select 
				fmg_clb_server.id,
				fmg_clb_server.server_id 
			from 
				fmg_clb_server
				inner join fmg_server ON fmg_server.id = server_id AND fmg_server.status = "OPEN"
			where 
				fmg_clb_server.clb_id = '.$clb_id.'
		','server_id'))){
			$server_id = false;
		}
		$sql = 'select id,doi_chu_nha_id,diem_doi_chu_nha,doi_khach_id,diem_doi_khach from fmg_schedule where '.($server_id?'server_id = '.$server_id.'':'1=1').' AND  (ket_qua<>"" and ket_qua is not null) and (doi_chu_nha_id='.$clb_id.' or doi_khach_id='.$clb_id.') order by id desc limit 0,38';
		$thi_daus = DB::fetch_all($sql);
		$luot_thang = 0;
		$luot_hoa = 0;
		$luot_thua = 0;
		foreach($thi_daus as $val){
			if(($val['diem_doi_chu_nha']==3 and $val['doi_chu_nha_id']==$clb_id) or ($val['diem_doi_khach']==3 and $val['doi_khach_id']==$clb_id)){
				$luot_thang++;
			}
			if($val['diem_doi_chu_nha']==1 or $val['diem_doi_khach']==1){
				$luot_hoa++;
			}
			if(($val['diem_doi_chu_nha']==0 and $val['doi_chu_nha_id']==$clb_id) or ($val['diem_doi_khach']==0 and $val['doi_khach_id']==$clb_id)){
				$luot_thua++;
			}
		}
		/*$sql = 'select id,clb_id1,clb_id2,win_clb_id from fmg_lien_dau where clb_id1 = '.$clb_id.' and win_clb_id order by id desc limit 0,10';
		$lien_daus = DB::fetch_all($sql);
		foreach($lien_daus as $val){
			if($val['clb_id1'] == $val['win_clb_id']){
				$luot_thang++;
			}else{
				$luot_thua++;
			}
		}
		$sql = 'select id,clb_id1,clb_id2,win_clb_id from fmg_lien_dau where clb_id2 = '.$clb_id.' and win_clb_id';
		$lien_daus = DB::fetch_all($sql);
		foreach($lien_daus as $val){
			if($val['clb_id2'] == $val['win_clb_id']){
				$luot_thang++;
			}else{
				$luot_thua++;
			}
		}*/
		$phong_do = $luot_thang.' <img src="skins/ssnh/images/fm_game/thang.png" alt="Thắng">, '.$luot_hoa.'  <img src="skins/ssnh/images/fm_game/hoa.png" alt="Hòa">, '.$luot_thua.'  <img src="skins/ssnh/images/fm_game/bai.png" alt="Thất bại">';
		return $phong_do;
	}
	static function get_cost($cau_thu_id,$mua_giai_id=2){
		return DB::fetch('select cost from ssnh_vi_tri_theo_nam where cau_thu_id='.$cau_thu_id.' and mua_giai_id='.$mua_giai_id.'','cost');
	}
	static function get_star($cau_thu_id,$mua_giai_id=2){
		return DB::fetch('select star from ssnh_vi_tri_theo_nam where cau_thu_id='.$cau_thu_id.' and mua_giai_id='.$mua_giai_id.'','star');
	}
	static function get_team_cost($mua_giai_id=2){
		$clb_id = Url::iget('team_id')?Url::iget('team_id'):FMGAME::my_team_id($mua_giai_id);
		$kt_vong_dau_id = get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID,true);
		$sql = '
			SELECT
				sum(vttn.cost) as total
			FROM
				fmg_clb_cau_thu
				inner join ssnh_cau_thu ON ssnh_cau_thu.id = fmg_clb_cau_thu.cau_thu_id
				inner join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id
			WHERE
				fmg_clb_cau_thu.clb_id = '.$clb_id.'
				AND (fmg_clb_cau_thu.sell_vong_dau_id = 0 or sell_vong_dau_id > '.$kt_vong_dau_id.')
				AND (fmg_clb_cau_thu.vong_dau_id <=  '.$kt_vong_dau_id.')
				AND vttn.mua_giai_id = '.$mua_giai_id.'
			GROUP BY
				fmg_clb_cau_thu.clb_id,vttn.mua_giai_id
		';
		$count = DB::fetch($sql,'total');
		return $count;
	}
	static function get_position($cau_thu_id){
		$sql = '
			SELECT
				vtts.id,vtts.ma_vi_tri
			FROM
				ssnh_cau_thu
				inner join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id
				inner join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
			WHERE
				ssnh_cau_thu.id = '.$cau_thu_id.'
		';
		return DB::fetch($sql,'ma_vi_tri');
	}
	static function get_pos_count($ma_vi_tri=false,$clb_id=false){
		if($clb_id==false){
			$clb_id = FMGAME::my_team_id(MUA_GIAI_ID);
		}
		$sql = '
			SELECT
				count(distinct fmg_clb_cau_thu.id) as acount
			FROM
				fmg_clb_cau_thu
				inner join ssnh_cau_thu ON ssnh_cau_thu.id = fmg_clb_cau_thu.cau_thu_id
				inner join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id
				inner join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
			WHERE
				'.($ma_vi_tri?'vtts.ma_vi_tri="'.$ma_vi_tri.'"':'1=1').'
				AND fmg_clb_cau_thu.clb_id = '.$clb_id.'
		';
		$count = DB::fetch($sql,'acount');
		return $count;
	}
	static function get_pos_count_temp($ma_vi_tri=false){
		if(!isset($_SESSION['clb_tmp']['cau_thus'])){
			return 0;
		}else{
			$cau_thus = $_SESSION['clb_tmp']['cau_thus'];
			if($ma_vi_tri){
				$total = 0;
				foreach($cau_thus as $value){
					$cau_thu_id=$value['cau_thu_id'];
					$sql = '
					SELECT
						ssnh_cau_thu.id,vtts.ma_vi_tri
					FROM
						ssnh_cau_thu
						inner join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id
						inner join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
					WHERE
						vtts.ma_vi_tri="'.$ma_vi_tri.'"
						AND ssnh_cau_thu.id = '.$cau_thu_id.'
					';
					if(DB::exists($sql)){
						$total++;
					}
				}
			}else{
				$total = sizeof($cau_thus);
			}
			return $total;
		}
	}
	static function auto_play(){
		//DB::query('update fmg_clb set stamina=10');
		$sql = '
			select 
				fmg_server.id
				,fmg_server.name
			from 
				fmg_server
			where 
				(select count(*) from fmg_clb_server where fmg_clb_server.server_id=fmg_server.id) >= '.MAX_TEAM.'
				and fmg_server.status="OPEN"
			order by
				fmg_server.id asc
		';
		$servers = DB::fetch_all($sql);
		foreach($servers as $k=>$v){
			$server_id = $k;
			$vong_daus = FMGAME::get_vong_dau_trong_ngay($server_id);
			foreach($vong_daus as $vk=>$vv){
				$vong_dau_id = $vk;
				$cap_daus = FMGAME::get_lichthidaus($vong_dau_id,400,' AND (kqtd.ket_qua is null or kqtd.ket_qua = "")');
				foreach($cap_daus as $key=>$val){
					$kq = FMGAME::play($val['dcn_id'],$val['dkh_id'],$vong_dau_id);	
					if($kq==3){
						$diem_doi_chu_nha = 3;
						$diem_doi_khach = 0;
						$ket_qua = 'Thắng';
					}elseif($kq==1){
						$diem_doi_chu_nha = 1;
						$diem_doi_khach = 1;
						$ket_qua = 'Hòa';
					}else{
						$diem_doi_chu_nha = 0;
						$diem_doi_khach = 3;
						$ket_qua = 'Thua';
					}
					/*
					$win_arr = array(592,94,91,41,19,30,29,35,87,85,52,59,57,752);
					foreach($win_arr as $wv){
						if($val['dcn_id']==$wv){
							$diem_doi_chu_nha = 3;
							$diem_doi_khach = 0;
							$ket_qua = 'Thắng';
						}
						if($val['dkh_id']==$wv){
							$diem_doi_chu_nha = 0;
							$diem_doi_khach = 3;
							$ket_qua = 'Thua';
						}
					}
					$loser_arr = array(371,857,774,529,271,546); // neft game/ 804,755 chi neft 1 tran
					foreach($loser_arr as $lv){
						if($val['dcn_id']==$lv){
							$diem_doi_chu_nha = 0;
							$diem_doi_khach = 3;
							$ket_qua = 'Thua';
						}
						if($val['dkh_id']==$lv){
							$diem_doi_chu_nha = 3;
							$diem_doi_khach = 0;
							$ket_qua = 'Thắng';
						}
					}
					///////////////////////////*/
					$arr = array('diem_doi_chu_nha'=>$diem_doi_chu_nha,'ket_qua'=>$ket_qua,'diem_doi_khach'=>$diem_doi_khach);
					//System::debug($arr);
					DB::update('fmg_schedule',$arr,'id='.$key);
					$vong_dau_id = get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID,true);
					///////////////////////////update vi tri cua server hien tai////////
					$t1 = FMGAME::get_power_clb($val['dcn_id'],$vong_dau_id,MUA_GIAI_ID);
					$d1 = FMGAME::get_diem_clb($val['dcn_id'],$server_id);
					DB::update('fmg_clb_server',array('power'=>$t1,'diem'=>$d1),'server_id='.$server_id.' and clb_id='.$val['dcn_id']);
					$t2 = FMGAME::get_power_clb($val['dkh_id'],$vong_dau_id,MUA_GIAI_ID);
					$d2 = FMGAME::get_diem_clb($val['dkh_id'],$server_id);
					DB::update('fmg_clb_server',array('power'=>$t2,'diem'=>$d2),'server_id='.$server_id.' and clb_id='.$val['dkh_id']);
					////////////////////////////////////////////////////////////////////
				}
			}
			FMGAME::cache_bxh_clb($server_id);
		}
		//DB::insert('warranty_status',array('name'=>date('H:i d/m/Y')));
	}
	static function get_stamina($clb_id){
		return DB::fetch('select stamina from fmg_clb where id='.$clb_id.'','stamina');
	}
	static function update_stamina($clb_id1,$power1,$power2){
		if($o_sta = FMGAME::get_stamina($clb_id1) and $o_sta>0){
			$sta = 1;//$o_sta - rand(0,);
			//echo $o_sta-$sta;exit();
			DB::update('fmg_clb',array('stamina'=>$o_sta-$sta),'id='.$clb_id1.'');
		}
	}
	static function play($clb_id1,$clb_id2,$vong_dau_id,$kick_off=false){
		$mua_giai_id = MUA_GIAI_ID;
		$sta1=FMGAME::get_stamina($clb_id1);//suc ben
		$sta2=FMGAME::get_stamina($clb_id2);//suc ben
		$t1_o = FMGAME::get_power_clb($clb_id1,$vong_dau_id);
		$pn1 = FMGAME::get_power_clb($clb_id1,$vong_dau_id,$mua_giai_id,'PN');
		$tc1 = FMGAME::get_power_clb($clb_id1,$vong_dau_id,$mua_giai_id,'TC');
		$t2_o = FMGAME::get_power_clb($clb_id2,$vong_dau_id);
		$pn2 = FMGAME::get_power_clb($clb_id2,$vong_dau_id,$mua_giai_id,'PN');
		$tc2 = FMGAME::get_power_clb($clb_id2,$vong_dau_id,$mua_giai_id,'TC');	
		
		////////////////////////////////////////////////////////////////////
		$thua1 = $pn1?(round(($t1_o + $t2_o)/$pn1)):10;
		$thang1 = ($t1_o + $t2_o > 0)?round(($tc1/($t1_o + $t2_o)*10)*3):0;
		$t1 = $t1 + ($thang1 - $thua1);
		$thua2 = $pn2?(round(($t1_o + $t2_o)/$pn2)):10;
		$thang2 = ($t1_o + $t2_o)?round(($tc2/($t1_o + $t2_o)*10)*3):0;
		$t2 = $t2 + ($thang2 - $thua2);
		////////////////////////////////////////////////////////////////////
		
		$hs = abs($t1-$t2);
		if($t1==$t2){
			$t1 = $t1 + rand(0,2);
			$t2 = $t2 + rand(0,2);
		}elseif($t1>$t2){
			$t1 = $t1 - rand(0, round($hs*0.5));
			$t2 = $t2 + rand(0, round($hs*0.75));
		}else{
			$t2 = $t2 - rand(0, round($hs*0.5));
			$t1 = $t1 + rand(0, round($hs*0.75));
		}
		$t1 = $t1 + rand(0,10);// con so may man
		$t2 = $t2 + rand(0,10);// con so may man
		$t1 = $t1_o + ($t1_o?$sta1:0); // edited 29/12
		$t2 = $t2_o + ($t2_o?$sta2:0); // edited 29/12
		if(Url::get('do')=='thach_dau'){
			FMGAME::update_stamina($clb_id1,$t1_o,$t2_o);
		}else{
			FMGAME::update_stamina($clb_id1,$t1_o,$t2_o);
			FMGAME::update_stamina($clb_id2,$t2_o,$t1_o);
		}
		//echo $t1.'-'.'-'.$t2;
		//exit();
		if($t1==$t2 or $t1-1==$t2 or $t1+1==$t2){
			if($kick_off){
				$tmp_arr=array(0=>0,3=>3);
				return array_rand($tmp_arr);
			}else{
				return 1;// hòa
			}
		}elseif($t1>$t2){
			return 3; // thắng
		}else{
			return 0; // thua
		}
	}
	static function play_giai_phu($clb_id1,$clb_id2,$vong_dau_id){
		$mua_giai_id = MUA_GIAI_ID;
		$sta1=FMGAME::get_stamina($clb_id1);//suc ben
		$sta2=FMGAME::get_stamina($clb_id2);//suc ben
		$t1_o = FMGAME::get_power_clb($clb_id1,$vong_dau_id);
		$pn1 = FMGAME::get_power_clb($clb_id1,$vong_dau_id,$mua_giai_id,'PN');
		$tc1 = FMGAME::get_power_clb($clb_id1,$vong_dau_id,$mua_giai_id,'TC');
		$t2_o = FMGAME::get_power_clb($clb_id2,$vong_dau_id);
		$pn2 = FMGAME::get_power_clb($clb_id2,$vong_dau_id,$mua_giai_id,'PN');
		$tc2 = FMGAME::get_power_clb($clb_id2,$vong_dau_id,$mua_giai_id,'TC');
		
		$t1 = $t1_o + ($t1_o?$sta1:0);
		$t2 = $t2_o + ($t2_o?$sta2:0);
		
		////////////////////////////////////////////////////////////////////
		$thua1 = $pn1?(round(($t1_o + $t2_o)/$pn1)):10;
		$thang1 = ($t1_o + $t2_o > 0)?round(($tc1/($t1_o + $t2_o)*10)*3):0;
		$t1 = $t1 + ($thang1 - $thua1);
		$thua2 = $pn2?(round(($t1_o + $t2_o)/$pn2)):10;
		$thang2 = ($t1_o + $t2_o)?round(($tc2/($t1_o + $t2_o)*10)*3):0;
		$t2 = $t2 + ($thang2 - $thua2);
		////////////////////////////////////////////////////////////////////
		
		$hs = abs($t1-$t2);
		if($t1==$t2){
			$t1 = $t1 + rand(0,2);
			$t2 = $t2 + rand(0,2);
		}elseif($t1>$t2){
			$t1 = $t1 - rand(0, round($hs*0.5));
			$t2 = $t2 + rand(0, round($hs*0.75));
		}else{
			$t2 = $t2 - rand(0, round($hs*0.5));
			$t1 = $t1 + rand(0, round($hs*0.75));
		}
		$t1 = $t1 + rand(0,10);
		$t2 = $t2 + rand(0,10);
		FMGAME::update_stamina($clb_id1,$t1_o,$t2_o);
		FMGAME::update_stamina($clb_id2,$t2_o,$t1_o);
		if($t1==$t2 or $t1-1==$t2 or $t1+1==$t2){
			$tmp_arr=array(0=>0,3=>3);
			return array_rand($tmp_arr);
		}elseif($t1>$t2){
			return 3; // thắng
		}else{
			return 0; // thua
		}
	}
	static function get_team_properties($clb_id,$vong_dau_id){
		
	}
	static function get_ls_cnh($clb_id,$vong_dau_id=false,$buy=false,$item_per_page=100){
		$mua_giai_id = MUA_GIAI_ID;
		$cond = '
				fmg_clb_transfer.clb_id = '.$clb_id.'
				'.($buy?' AND fmg_clb_transfer.sell<>1':'').'
				'.($vong_dau_id?' AND fmg_clb_transfer.vong_dau_id='.$vong_dau_id.'':'').'
		';
		$sql = '
			select 
				fmg_clb_transfer.id,
				ssnh_cau_thu.id as cau_thu_id,
				ssnh_cau_thu.name_id,
				ssnh_cau_thu.ten,
				vtts.ten as vi_tri,
				ssnh_cau_thu.anh_dai_dien,
				ssnh_cau_lac_bo.ten AS clb,
				vttn.star,
				vttn.cost,
				ssnh_cau_thu.off,
				fmg_clb_transfer.vong_dau_id,
				fmg_clb_transfer.sell,
				fmg_clb_transfer.time,
				ssnh_vong_dau.ten as vong_dau
			from
				fmg_clb_transfer
				inner join ssnh_vong_dau ON ssnh_vong_dau.id = fmg_clb_transfer.vong_dau_id
				inner join ssnh_cau_thu ON ssnh_cau_thu.id = fmg_clb_transfer.cau_thu_id
				inner join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id
				inner join ssnh_cau_lac_bo on ssnh_cau_lac_bo.id = ssnh_cau_thu_clb.clb_id
				inner join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id and vttn.mua_giai_id='.MUA_GIAI_ID.'
				inner join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
			where 
				'.$cond.'
			order by 
				fmg_clb_transfer.time DESC
			LIMIT
				0,'.$item_per_page.'
		';
		$items = DB::fetch_all($sql);
		foreach($items as $key=>$value){
			$items[$key]['time'] = date('H:i\' d/m/Y',$value['time']);
			if($value['sell']){
				$items[$key]['action'] = 'Đã bán';
				$items[$key]['cost'] = round(0.75*$value['cost']).'/'.$value['cost'];
			}else{
				$items[$key]['action'] = 'Đã mua';
				$items[$key]['sell_cost'] = 0;
			}
			if((FMGAME::my_team_id($mua_giai_id) != $clb_id) and !User::is_admin()){
				//$items[$key]['ten'] = 'Ẩn tên'; 
				//$items[$key]['anh_dai_dien'] = 'skins/ssnh/images/fm_game/hidden_player.png'; 
			}else{
				$items[$key]['anh_dai_dien'] = 'https://sieusaongoaihang.vn/'.$value['anh_dai_dien']; 
			}
			$items[$key]['anh_dai_dien'] = 'https://sieusaongoaihang.vn/'.$value['anh_dai_dien']; 
			$diem = get_diem_cau_thu($value['cau_thu_id'],$mua_giai_id,$vong_dau_id,true);
		}
		return $items;
	}
	static function get_cauthus($clb_id,$vong_dau_id,$ma_vi_tri=false){
		$mua_giai_id = MUA_GIAI_ID;
		$kt_vong_dau_id = get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID,true);
		$next_vong_dau_id = get_id_vong_dau_hien_tai(true);
		$cond = '
				fmg_clb_cau_thu.clb_id = '.$clb_id.'
				'.($ma_vi_tri?' AND vtts.ma_vi_tri = "'.$ma_vi_tri.'"':'').'
				AND ssnh_cau_thu_clb.mua_giai_id = '.$mua_giai_id.'
		';
		$cond .= '
			AND (fmg_clb_cau_thu.sell_vong_dau_id = 0 or sell_vong_dau_id > '.$kt_vong_dau_id.')
			AND (fmg_clb_cau_thu.vong_dau_id <=  '.$kt_vong_dau_id.')
		';
		$sql = '
			select 
				fmg_clb_cau_thu.id,
				ssnh_cau_thu.id as cau_thu_id,
				ssnh_cau_thu.name_id,
				ssnh_cau_thu.ten,
				ssnh_cau_thu.so_ao,
				ssnh_cau_thu.ngay_sinh,
				CONCAT(ssnh_cau_thu.chieu_cao,"m") AS chieu_cao,
				CONCAT(ssnh_cau_thu.can_nang,"kg") AS can_nang,
				country.name as quoc_tich,
				vtts.ten as vi_tri,
				ssnh_cau_thu.anh_dai_dien,
				fmg_clb_cau_thu.captain,
				ssnh_cau_lac_bo.ten AS clb,
				ssnh_cau_thu_clb.clb_id,
				vttn.star,
				vttn.cost,
				ssnh_cau_thu.off,
				fmg_clb_cau_thu.sell_vong_dau_id,
				fmg_clb_cau_thu.vong_dau_id as buy_vong_dau_id,
				(select sum(diem+bonus) as tong_diem from ssnh_lich_su_cau_thu AS ls INNER JOIN ssnh_vong_dau AS vd ON vd.id=ls.vong_dau_id where ls.cau_thu_id = ssnh_cau_thu.id AND vd.mua_giai_id='.$mua_giai_id.')  AS tong_diem
			from
				fmg_clb_cau_thu
				inner join ssnh_cau_thu ON ssnh_cau_thu.id = fmg_clb_cau_thu.cau_thu_id
				LEFT OUTER JOIN country ON country.id = ssnh_cau_thu.quoc_tich_id
				LEFT OUTER JOIN ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id
				LEFT OUTER JOIN ssnh_cau_lac_bo on ssnh_cau_lac_bo.id = ssnh_cau_thu_clb.clb_id
				LEFT OUTER JOIN ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id and vttn.mua_giai_id='.$mua_giai_id.'
				LEFT OUTER JOIN ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
			where 
				'.$cond.'
			order by 
				vttn.cost DESC,vttn.star DESC,tong_diem DESC
			LIMIT
				0,50
		';
		$items = DB::fetch_all($sql);
		foreach($items as $key=>$value){
			$items[$key]['action'] = 'Bán';
			$items[$key]['bought'] = false;
			//echo $next_vong_dau_id;exit();
			if($value['sell_vong_dau_id'] == $next_vong_dau_id){
				$items[$key]['action'] = 'Đã bán';
				$items[$key]['bought'] = true;
			}
			if($value['buy_vong_dau_id'] == $next_vong_dau_id){
				//$items[$key]['bought'] = true;
				//$items[$key]['action'] = 'Đã mua';
			}
			if((FMGAME::my_team_id($mua_giai_id) != $clb_id) and !User::is_admin()){
				//$items[$key]['ten'] = 'Ẩn tên'; 
				//$items[$key]['anh_dai_dien'] = 'skins/ssnh/images/fm_game/hidden_player.png'; 
			}else{
				$items[$key]['anh_dai_dien'] = 'https://sieusaongoaihang.vn/'.$value['anh_dai_dien']; 
			}
			$items[$key]['anh_dai_dien'] = 'https://sieusaongoaihang.vn/'.$value['anh_dai_dien']; 
			$diem = get_diem_cau_thu($value['cau_thu_id'],$mua_giai_id,$kt_vong_dau_id,true);
			$items[$key]['diem'] = ($value['captain']?($diem*2):$diem);
			$items[$key]['tong_diem'] = (($value['tong_diem']>=0)?$value['tong_diem']:0) + ($value['captain']?($diem):0);
		}
		return $items;
	}
	static function get_max_power($vong_dau_id=false,$mua_giai_id=2){
		$tong_diem = 0;
		$sql = '
			select 
				sum(lsct.diem + lsct.bonus) as power
			from
				fmg_clb_cau_thu
				inner join ssnh_cau_thu ON ssnh_cau_thu.id = fmg_clb_cau_thu.cau_thu_id
				inner join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id
				inner join ssnh_cau_lac_bo on ssnh_cau_lac_bo.id = ssnh_cau_thu_clb.clb_id
				inner join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id and vttn.mua_giai_id='.$mua_giai_id.'
				inner join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
				inner join ssnh_lich_su_cau_thu AS lsct ON lsct.cau_thu_id = ssnh_cau_thu.id
				inner join ssnh_vong_dau ON ssnh_vong_dau.id = lsct.vong_dau_id
			where 
				'.($vong_dau_id?'AND ssnh_vong_dau.id = '.$vong_dau_id.'':'').'
				AND ssnh_cau_thu_clb.mua_giai_id = '.$mua_giai_id.'
			GROUP BY
				ssnh_cau_thu.id
			order by 
				vttn.cost DESC,vttn.star DESC
			LIMIT
				0,50
		';
		return DB::fetch($sql,'power');
	}
	static function cache_power($vong_dau_id){
		$sql = '
			select 
				fmg_clb.id
			from 
				fmg_clb
			where 
				1=1
		';//fmg_server.status = "OPEN"
		$clbs = DB::fetch_all($sql);
		foreach($clbs as $k=>$v){
			DB::update('fmg_clb',array('cache_power'=>FMGAME::get_power_clb($k,$vong_dau_id,MUA_GIAI_ID)),'id='.$k);
		}
	}
	static function get_power_clb($clb_id,$vong_dau_id=false,$mua_giai_id=2,$type='ALL'){
		$kt_vong_dau_id = get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID,true);
		$tong_diem = 0;
		$sql = '
			select 
				sum((IF(`captain`<>0,lsct.diem*2,lsct.diem)) + lsct.bonus) as diem
			from
				fmg_clb_cau_thu
				inner join ssnh_cau_thu ON ssnh_cau_thu.id = fmg_clb_cau_thu.cau_thu_id
				inner join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id
				inner join ssnh_cau_lac_bo on ssnh_cau_lac_bo.id = ssnh_cau_thu_clb.clb_id
				inner join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id and vttn.mua_giai_id='.$mua_giai_id.'
				inner join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
				inner join ssnh_lich_su_cau_thu AS lsct ON lsct.cau_thu_id = ssnh_cau_thu.id
				inner join ssnh_vong_dau ON ssnh_vong_dau.id = lsct.vong_dau_id
			where 
				fmg_clb_cau_thu.clb_id = '.$clb_id.'
				AND lsct.diem>0
				AND (fmg_clb_cau_thu.sell_vong_dau_id = 0 or sell_vong_dau_id > '.$kt_vong_dau_id.')
				AND (fmg_clb_cau_thu.vong_dau_id <=  '.$kt_vong_dau_id.')
				'.($vong_dau_id?'AND ssnh_vong_dau.id = '.$vong_dau_id.'':'').'
				AND ssnh_cau_thu_clb.mua_giai_id = '.$mua_giai_id.'
			GROUP BY
				fmg_clb_cau_thu.clb_id
		';
		return DB::fetch($sql,'diem');
	}
	static function get_diem_clb($clb_id,$server_id){
		$tong_diem = 0;
		$sql = '
			select 
				distinct fmg_clb.id as id,fmg_clb.name,
				(select SUM(kqtd.diem_doi_chu_nha) from fmg_schedule as kqtd where kqtd.doi_chu_nha_id = fmg_clb.id and kqtd.server_id='.$server_id.') as diem_chunha,
				(select SUM(kqtd.diem_doi_khach) from fmg_schedule as kqtd where kqtd.doi_khach_id = fmg_clb.id and kqtd.server_id='.$server_id.') as diem_khach
			from 
				fmg_clb
				inner join fmg_clb_server ON fmg_clb_server.clb_id = fmg_clb.id
			where 
				fmg_clb_server.server_id = '.$server_id.'
				AND fmg_clb_server.clb_id='.$clb_id.'
		';//'.(User::is_admin()?' AND ssnh_cau_lac_bo.id=10':'').'
		$new_items = array();
		if($items = DB::fetch_all($sql)){
			foreach($items as $key=>$value){
				$tong_diem += ($value['diem_chunha'] + $value ['diem_khach']);
			}
		}
		return $tong_diem;
	}
	static function get_chi_so_cau_thu($cau_thu_id,$vong_dau_id,$mua_giai_id){
		$sql = '
			select 
				distinct ssnh_cau_thu.id,
				vtts.phong_ngu,
				vtts.tao_co_hoi,
				vtts.tan_cong,
				vttn.star,
				vttn.cost,
				(lsct.diem + lsct.bonus) as diem
			from
				fmg_clb_cau_thu
				inner join ssnh_cau_thu ON ssnh_cau_thu.id = fmg_clb_cau_thu.cau_thu_id
				inner join country ON country.id = ssnh_cau_thu.quoc_tich_id
				inner join ssnh_cau_thu_clb on ssnh_cau_thu_clb.cau_thu_id = ssnh_cau_thu.id
				inner join ssnh_cau_lac_bo on ssnh_cau_lac_bo.id = ssnh_cau_thu_clb.clb_id
				inner join ssnh_vi_tri_theo_nam AS vttn ON vttn.cau_thu_id = ssnh_cau_thu.id
				inner join ssnh_vi_tri_tren_san AS vtts ON vtts.id = vttn.vi_tri_id
				inner join ssnh_lich_su_cau_thu AS lsct ON lsct.cau_thu_id = ssnh_cau_thu.id
				inner join ssnh_vong_dau ON ssnh_vong_dau.id = lsct.vong_dau_id
			where 
				ssnh_cau_thu.id = '.$cau_thu_id.'
				AND ssnh_vong_dau.id = '.$vong_dau_id.'
				AND ssnh_cau_thu_clb.mua_giai_id = '.$mua_giai_id.'
		';
		$item = DB::fetch($sql);
		$diem = 0;
		//$diem = $item['diem'] + 
	}
	static function get_lichthidaus($vong_dau_id=false,$item_per_page=10,$cond=false,$order='kqtd.thoi_gian'){
		
		$sql = '
					select 
						kqtd.id,
						dchn.id as dcn_id,
						dchn.name as doi_chu_nha,
						dchn.logo as logo_cn,
						kqtd.diem_doi_chu_nha,
						kqtd.vong_dau_id,
						dkh.id as dkh_id,
						dkh.name as doi_khach,
						dkh.logo as logo_kh,
						kqtd.diem_doi_khach,
						kqtd.thoi_gian,
						kqtd.ket_qua,
						CONCAT(dchn.name," vs ",dkh.name) AS cap_dau,
						ssnh_mua_giai.ten as mua_giai,
						fmg_vong_dau.ten as vong_dau
					from 
						fmg_schedule as kqtd
						INNER JOIN fmg_vong_dau ON fmg_vong_dau.id = kqtd.vong_dau_id
						INNER JOIN ssnh_mua_giai ON ssnh_mua_giai.id = kqtd.mua_giai_id
						inner join fmg_clb AS dchn ON dchn.id = kqtd.doi_chu_nha_id
						inner join fmg_clb AS dkh ON dkh.id = kqtd.doi_khach_id
					where 
						'.($vong_dau_id?'kqtd.vong_dau_id = '.$vong_dau_id.'':'1=1').'
						'.$cond.'
					order by 
						'.$order.'
					LIMIT
						0,'.$item_per_page.'
				';
		$items = DB::fetch_all($sql);	
		foreach($items as $key=>$value){
			$items[$key]['ket_qua_cn'] = $value['ket_qua']?(($value['diem_doi_chu_nha']==3)?'Thắng':(($value['diem_doi_chu_nha']==1)?'Hòa':'Thua')):'';
			$items[$key]['ket_qua_kh'] = $value['ket_qua']?(($value['diem_doi_khach']==3)?'Thắng':(($value['diem_doi_khach']==1)?'Hòa':'Thua')):'';			
			$items[$key]['thoi_gian_ngay'] = date('d/m',strtotime($value['thoi_gian']));
			$items[$key]['thoi_gian_gio'] = date('H:i',strtotime($value['thoi_gian']));
			$items[$key]['phong_do_cn'] = FMGAME::get_phong_do($value['dcn_id']);
			$items[$key]['phong_do_kh'] = FMGAME::get_phong_do($value['dkh_id']);
		}
		return $items;
	}
	function get_bangxephang($server_id){
		//$items = DB::select_all('fmg_clb_server','server_id='.$server_id.'','diem DESC, power ASC');
		$vong_dau_id = get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID,true);
		$sql = '
			select 
				distinct fmg_clb.id as id,fmg_clb.name,fmg_clb_server.win,fmg_clb_server.id as fc_server_id,
				(select SUM(kqtd.diem_doi_chu_nha) from fmg_schedule as kqtd where kqtd.doi_chu_nha_id = fmg_clb.id and kqtd.server_id='.$server_id.') as diem_chunha,
				(select SUM(kqtd.diem_doi_khach) from fmg_schedule as kqtd where kqtd.doi_khach_id = fmg_clb.id and kqtd.server_id='.$server_id.') as diem_khach
			from 
				fmg_clb
				inner join fmg_clb_server ON fmg_clb_server.clb_id = fmg_clb.id
			where 
				fmg_clb_server.server_id = '.$server_id.'
		';//'.(User::is_admin()?' AND ssnh_cau_lac_bo.id=10':'').'
		$items = DB::fetch_all($sql);
		$sort = array();	
		$new_items = array();
		if(!empty($items)){
			foreach($items as $key=>$value){
				//$items[$key]['name'] = DB::fetch('select name from fmg_clb where id = '.$value['clb_id'],'name');
				$items[$key]['diem'] = ($value['diem_chunha']+$value['diem_khach']);
				$items[$key]['power'] = FMGAME::get_power_clb($value['id'],$vong_dau_id,MUA_GIAI_ID);
				$sort['diem'][$key] = $items[$key]['diem'];
				$sort['power'][$key] = $items[$key]['power'];
				DB::update('fmg_clb_server',array('diem'=>$items[$key]['diem'],'power'=>$items[$key]['power']),'id='.$value['fc_server_id']);
				DB::update('fmg_clb',array('cache_power'=>$items[$key]['power']),'id='.$value['id']);
			}
			array_multisort($sort['diem'], SORT_DESC,$sort['power'],SORT_ASC,$items);
			$i=1;
			foreach($items as $key=>$value){
				$new_items[$key+1] = $value;		
				$new_items[$key+1]['hang'] = $i;
				DB::update('fmg_clb_server',array('hang'=>$i),'id='.$value['fc_server_id']);
				$i++;
			}
		}
		return $new_items;
	}
	static function update_winner($type=1){
		if($type==1){
			$sql = '
				select 
					fmg_server.id
					,fmg_server.name
				from 
					fmg_server
				where 
					(select count(*) from fmg_clb_server where fmg_clb_server.server_id=fmg_server.id) = '.MAX_TEAM.'
					and fmg_server.status="OPEN"
				order by
					fmg_server.id DESC
			';
			$servers = DB::fetch_all($sql);
			foreach($servers as $v){
				$server_id = $v['id'];
				FMGAME::cache_bxh_clb($server_id);
				$items = DB::select_all('fmg_clb_server','server_id='.$server_id.'','diem DESC, power ASC');
				$top = array();
				$min_power = 0;
				$max_diem = 0;
				$top_arr_temp = array_shift($items);
				$top_arr = array($top_arr_temp['id']);
				foreach($items as $val){
					$account_id = DB::fetch('select account_id from fmg_clb where id = '.$val['clb_id'].'','account_id');
					if($top_arr_temp['diem'] == $val['diem'] and $top_arr_temp['power'] == $val['power'])
					{
						$top_arr[] = $val['id'];
					}
					switch($val['hang']){
						case 2:
							iGold::receive_igold($account_id,30,'Starteam: Thưởng nhì '.$v['name'].'');
							$content = 'Bạn được nhận 30 iGold vị trí thứ 2 của '.$v['name'].'';
							Message::send_message('administrator',$account_id,$content);
							break;
						case 3:
							iGold::receive_igold($account_id,20,'Starteam: Thưởng thứ 3 '.$v['name'].'');
							$content = 'Bạn được nhận 20 iGold vị trí thứ 3 của '.$v['name'].'';
							Message::send_message('administrator',$account_id,$content);
							break;
						case 4:
							iGold::receive_igold($account_id,15,'Starteam: Thưởng thứ 4 '.$v['name'].'');
							$content = 'Bạn được nhận 15 iGold vị trí thứ 4 của '.$v['name'].'';
							Message::send_message('administrator',$account_id,$content);
							break;
						case 5:
							iGold::receive_igold($account_id,10,'Starteam: Thưởng thứ 5 '.$v['name'].'');
							$content = 'Bạn được nhận 10 iGold vị trí thứ 5 của '.$v['name'].'';
							Message::send_message('administrator',$account_id,$content);
							break;
						default:
							break;
					}
				}
				if(sizeof($top_arr)==1 and $top_arr[0]){
						DB::update('fmg_clb_server',array('win'=>1),'id='.$top_arr[0]);
						//$clb_id = DB::fetch('select id,clb_id from fmg_clb_server where id='.$top_arr[0].'','clb_id');
						//$account_id = DB::fetch('select account_id from fmg_clb where id = '.$clb_id.'','account_id');
						//iGold::receive_igold($account_id,50,'Starteam: Thưởng nhất '.$v['name'].'');
						//Message::send_message('administrator',$account_id,'Bạn được nhận 50 iGold vị trí thứ 1 của '.$v['name'].'');
				}else{
						
				}
				//DB::update('fmg_server',array('status'=>'CLOSED'),'id='.$server_id);
				FMGAME::cache_bxh_clb($server_id);
			}
		}elseif($type==2){// chien thang lien dau
		}
	}
	static function lottery($clbs){
		$rand_keys = array_rand($clbs, 1);
		return $rand_keys;
	}
	static function cache_bxh_clb($server_id){
		$clbs = FMGAME::get_bangxephang($server_id);
		//System::Debug($clbs);exit();
		$path = 'cache/tables/dhss/bxh_clb_'.$server_id.'.cache.php';
		$hand = fopen($path,'w+');
		fwrite($hand,'<?php $clbs = '.var_export($clbs,true).';?>');
		fclose($hand);
	}
	static function getWeek($home, $away, $num_teams, $games) {
		if($home == $away){
				return -1;
		}
		$week = $home+$away-2;
		if($week >= $num_teams){
				$week = $week-$num_teams+1;
		}
		if($home>$away){
				$week += $num_teams-1;
		}

		$tries=0;
		$problems=array();

		//create array of all matrix elements that have the same row or column (regardless of value)
		foreach($games as $key => $row) {
				foreach($row as $k => $col) {
						if($home==$key || $home==$k || $away==$key || $away==$k)
								$problems[]=$col;   
				}
		}
		while(in_array($week, $problems)) {

				if($home<=$away)
								$week=rand(1,$num_teams-1);
						else
								$week=rand($num_teams,2*($num_teams-1));

						$tries++;
						if($tries==1000){
								$week=0;
								break;
						}
				}

		return $week;
	}
	static function auto_schedule(){
		$d = '19';
		$mua_giai_id = MUA_GIAI_ID;
		$servers = FMGAME::get_running_server($mua_giai_id);
		foreach($servers as $k=>$v){
			$server_id = $k;
			//FMGAME::cache_bxh_clb($server_id);
				$sql = '
				select 
					fmg_clb.id,fmg_clb.name,fmg_clb_server.server_id
				from 
					fmg_clb
					inner join fmg_clb_server ON fmg_clb_server.clb_id = fmg_clb.id
				where 
					fmg_clb_server.server_id='.$server_id.'
					AND fmg_clb.cache_power > 0
					AND fmg_clb.time < '.(strtotime(date('Y-m-'.$d)) + 20*3600).'
					AND fmg_clb.mua_giai_id='.$mua_giai_id.'
				limit
					0,2000
			';//order by 	rand()
			$clbs_temp = DB::fetch_all($sql);
			$tong_clb = sizeof($clbs_temp);// to be continue...
			$total_tran = DB::fetch('select count(*) as acount from fmg_schedule where server_id='.$server_id.'','acount');
			if($total_tran==0 or $total_tran<$tong_clb*($tong_clb-1)){
				if($v['tong_clb']>=MAX_TEAM){
					if($v['tong_clb']%2==0){
						FMGAME::schedule($server_id);
					}else{					
						$temp = FMGAME::get_running_server($mua_giai_id,true,' AND fmg_server.status="OPEN" AND fmg_server.id<>'.$server_id.'',1);
						$temp = array_shift($temp);
						$old_server_id = $temp['id'];
						$clb = FMGAME::get_clbs($old_server_id,$mua_giai_id,'fmg_clb.id DESC',1);
						$clb = array_shift($temp);
						$clb_id = $clb['id'];
						DB::delete('fmg_clb_server','clb_id='.$clb_id.' and server_id='.$old_server_id);
						DB::insert('fmg_clb_server',array('clb_id'=>$clb_id,'server_id'=>$old_server_id));
						FMGAME::schedule($server_id);
					}
				}else{
					$limit = MAX_TEAM - $v['tong_clb'];
					/////////get clb da ton tai/////////
					$existed_clb_ids = '';
					$sql_ = '
						select 
							fmg_clb_server.clb_id as id 
						from 
							fmg_clb_server 
							inner join fmg_server ON fmg_server.id=fmg_clb_server.server_id
						where 
							fmg_server.status="OPEN"
							AND (select count(*) from fmg_clb_server where fmg_clb_server.server_id=fmg_server.id)<='.MAX_TEAM.'
						';
					$tmp = DB::fetch_all($sql_);
					foreach($tmp as $tmp_k=>$tmp_v){
						$existed_clb_ids .= ($existed_clb_ids?',':'').$tmp_k;
					}
					////////////////////////////////////
					$sql = '
						select 
							fmg_clb.id,fmg_clb.name,fcs.server_id,fmg_server.status
						from 
							fmg_clb
							LEFT OUTER JOIN fmg_clb_server AS fcs ON fcs.clb_id = fmg_clb.id
							LEFT OUTER JOIN fmg_server ON fmg_server.id = fcs.server_id
						where 
							fmg_clb.cache_power > 0
							AND fmg_clb.time < '.(strtotime(date('Y-m-'.$d)) + 20*3600).'
							AND fmg_clb.mua_giai_id='.$mua_giai_id.'
							AND (
								(fmg_server.id is null or fmg_server.status = "CLOSED")
							)
							'.($existed_clb_ids?' and fmg_clb.id NOT IN ('.$existed_clb_ids.')':'').'
						order by 
							rand()
						limit
							0,'.$limit.'
					';
					$clbs = DB::fetch_all($sql);
					$p = 0;
					foreach($clbs as $kk=>$vv){
						if(isset($vv['server_id']) and $vv['server_id'] and ($vv['status']=='OPEN')){
							DB::delete('fmg_clb_server','clb_id='.$kk.' and server_id='.$vv['server_id']);
						}
						if(!DB::exists('select id from fmg_clb_server where clb_id='.$kk.' AND server_id='.$server_id)){
							DB::insert('fmg_clb_server',array('clb_id'=>$kk,'server_id'=>$server_id));
						}
					}
					if($limit>sizeof($clbs)){
						FMGAME::auto_generate_clbs();
						$sql = '
							select 
								fmg_clb.id,fcs.server_id,fmg_server.status
							from 
								fmg_clb
								LEFT OUTER JOIN fmg_clb_server AS fcs ON fcs.clb_id = fmg_clb.id
								LEFT OUTER JOIN fmg_server AS fmg_server ON fmg_server.id = fcs.server_id
							where
								fmg_clb.machine = 1
								AND fmg_clb.mua_giai_id='.$mua_giai_id.'
								AND (
									(fmg_server.id is null or fmg_server.status = "CLOSED")
								)
								'.($existed_clb_ids?' and fmg_clb.id NOT IN ('.$existed_clb_ids.')':'').'
							order by
								rand()
							limit
								0,'.($limit-sizeof($clbs)).'
						';
						$machine_clbs = DB::fetch_all($sql);
						foreach($machine_clbs as $kk=>$vv){
							if(!DB::exists('select id from fmg_clb_server where clb_id='.$kk.' AND server_id='.$server_id)){
								DB::insert('fmg_clb_server',array('clb_id'=>$kk,'server_id'=>$server_id));
							}
						}
					}
					FMGAME::schedule($server_id);
				}
			}
			FMGAME::cache_bxh_clb($server_id);
		}
	}
	static function schedule($server_id){
		$d = '19';
		$mua_giai_id = MUA_GIAI_ID;
		$vong_daus_temp = FMGAME::get_vongdaus($server_id);
		$cond = '
			fmg_clb.time < '.(strtotime(date('Y-m-'.$d)) + (20*3600)).'
		';//AND fmg_clb.time < '.(strtotime('2015-12-19') + 20*3600).'
		//fmg_clb.cache_power > 0
		//	AND fmg_clb.time < '.(strtotime('2015-12-19') + 20*3600).'
		$clbs_temp = FMGAME::get_clbs($server_id,$mua_giai_id,'fmg_clb.id DESC',4000,$cond);
		//System::Debug($clbs_temp );die;
		$clbs = array();
		$i=1;
		foreach($clbs_temp as $key=>$val){
		 $clbs[$i] = $key;
		 $i++;
		}
		$i=1;
		$vong_daus = array();
		foreach($vong_daus_temp as $key=>$val){
		 $vong_daus[$i] = $key;
		 $i++;
		}
		$tong_clb = sizeof($clbs);
		$teams = $tong_clb;
		//exit();
		//////////
		$games = array();   //2D array tracking which week teams will be playing
		
		// do the work
		if($tong_clb>= MAX_TEAM and DB::fetch('select count(*) as total from fmg_schedule where server_id='.$server_id.'','total')<$tong_clb*($tong_clb-1)){
			$i=1;
			//if((date('N')==6 and date('H')<20))
			{
				//$start_time = strtotime(date('Y-m-d 00:00:00')) + 3*24*3600;
				$start_time = strtotime(date('2016-01-19 00:00:00'));// dung de test
				$t = $start_time;
				$games = array();
				//2D array tracking which week teams will be playing
				//do the work
				$day = 0;
				for( $i=1; $i<=$teams; $i++ ) {
					$games[$i] = array();
					for( $j=1; $j<=$teams; $j++ ) {
						$vd = $games[$i][$j] = FMGAME::getWeek($i, $j, $teams, $games);
						if($vd!=-1){
							if(isset($vong_daus[$vd]) and $vong_dau_id=$vong_daus[$vd]){
								$day = floor(($vd-1)/10);
								$t = $start_time +$day*24*3600;
								if($vd>1 and $vd%10==0){
									$h=18;
								}else{
									$h = 8 + intval(substr($vd,strlen($vd)-1,$vd));
								}
								$thoi_gian = date('Y-m-d '.$h.':00:00',$t);
								//echo $thoi_gian.' - Ngày '.$day.''.'- Vòng '.$vong_daus[$vd].'/'.$vd.'<br>';
							
								$arr = array(
									'server_id'=>$server_id,
									'vong_dau_id'=>$vong_dau_id,
									'mua_giai_id'=>$mua_giai_id,
									'thoi_gian'=>$thoi_gian
								);
								$arr += array(
									'doi_chu_nha_id'=>$clbs[$i],
									'doi_khach_id'=>$clbs[$j],
									'ket_qua'
								);
								DB::insert('fmg_schedule',$arr);
							}
						}
					}
				}
			}
		}
	}
	static function create_server($d = 1,$m=12){
		$vong_dau_id = get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID,true);
		FMGAME::cache_power($vong_dau_id);
		$total_clb = DB::fetch('select count(fmg_clb.id) as acount from fmg_clb where cache_power > 0','acount');
		//exit();
		$time = time();
		$mua_giai_id = MUA_GIAI_ID;
		$total = ceil($total_clb/MAX_TEAM);
		for($i=1;$i<=$total;$i++){
			$server_name = 'Bảng đấu số '.$i.' ngày '.date(''.$d.'/'.$m.'/Y',$time).'';
			if($row=DB::fetch('select id from fmg_server where name="'.$server_name.'" and open_time="'.date('Y-'.$m.'-'.$d.'',$time).' 09:00:00"')){
				$server_id = $row['id'];
			}else{
				$server_id = DB::insert('fmg_server',array(
					'name'=>$server_name,
					'mua_giai_id'=>$mua_giai_id,
					'open_time'=>date('Y-'.$m.'-'.$d.'',$time).' 09:00:00',
					'status'=>"OPEN"
				));
			}
		}
	}
	function is_player($round, $row, $team) {
		return $row == pow(2, $round-1) + 1 + pow(2, $round)*($team - 1);
	}
	static function draw_lien_dau($server_id){
		$vong_dau_id = get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID,true);
		$num_teams = DB::fetch('select count(*) as acount from fmg_lien_dau where round=1 and ld_server_id='.$server_id.'','acount');
		$num_teams = $num_teams*2;
		$total_rounds = floor(log($num_teams, 2)) + (($num_teams==62)?2:1);
		$max_rows = $num_teams*2;
		$str = '';
		for ($round = 1; $round <= $total_rounds; $round++) {
			$str .= '<div class="lien-dau-round"><div class="header"><strong>'.(($round==$total_rounds)?'Vô địch':(($round==$total_rounds-1)?'Chung kết':(($round==$total_rounds-2)?'Bán kết':(($round==$total_rounds-3)?'Tứ kết':'Vòng '.$round)))).'</strong>'.(($round<$total_rounds)?'<br>'.(8+$round).'h\'':'<br>&nbsp;').'</div>';
			if($round<$total_rounds)
			{
				$cap_daus = DB::fetch_all('select id,clb_id1,clb_id2,round from fmg_lien_dau where round='.$round.' and ld_server_id='.$server_id.' order by id');
				$temp_clbs = array();
				for($i=10000000000;$i<(10000000000+(($num_teams)/pow(2,$round))-sizeof($cap_daus));$i++){
					$temp_clbs[$i]['id'] = $i;
					$temp_clbs[$i]['clb_id1'] = 0;
					$temp_clbs[$i]['clb_id2'] = 0;
					$temp_clbs[$i]['round'] = $round;
				}
				$cap_daus += $cap_daus+$temp_clbs;
				foreach($cap_daus as $key=>$val){
					if($clb1 = DB::fetch('select id,name,logo from fmg_clb where id='.$val['clb_id1'].'')){
						$ten_clb1 = $clb1['name'];
						$logo1 = $clb1['logo'];
						$power1 = FMGAME::get_power_clb($clb1['id'],$vong_dau_id);
					}else{
						$ten_clb1 = '';
						$logo1 = '';
						$power1 = 0;
					}
					if($clb2 = DB::fetch('select id,name,logo from fmg_clb where id='.$val['clb_id2'].'')){
						$ten_clb2 = $clb2['name'];
						$logo2 = $clb2['logo'];
						$power2 = FMGAME::get_power_clb($clb2['id'],$vong_dau_id);
					}else{
						$ten_clb2 = '';
						$logo2 = '';
						$power2 = '';
					}
					for($c=0;$c<(pow(2,$round)-2);$c++){
						$str .= '<div class="lien-dau-team space">';
						$str .= '<span></span>';
						$str .= '</div>';
					}
					$str .= '<div class="lien-dau-team '.$val['round'].'">';
					$str .= '<span title="Power: '.$power1.'"><img src="'.$logo1.'" alt="" width="20" height="20" onerror="this.src=\'skins/ssnh/images/fm_game/logo_clb.png\'"> '.$ten_clb1.'</span>';
					$str .= '<span class="vs"><a href="'.Url::build('fmg_play',array('do'=>'lien_dau','dcn_id'=>$clb1['id'],'dkh_id'=>$clb2['id'],'vong_dau_id'=>$round)).'">vs</a></span>';
					$str .= '<span title="Power: '.$power2.'"><img src="'.$logo2.'" alt="" width="20" height="20" onerror="this.src=\'skins/ssnh/images/fm_game/logo_clb.png\'"> '.$ten_clb2.'</span>';
					$str .= '</div>';
					for($c=0;$c<((pow(2,$round)-1));$c++){
						$str .= '<div class="lien-dau-team space">';
						$str .= '<span></span>';
						$str .= '</div>';
					}
				}
			}else{
					for($c=0;$c<(($num_teams/2-1)*4/2);$c++){
						$str .= '<div class="lien-dau-team space">';
						$str .= '<span></span>';
						$str .= '</div>';
					}
					if($cap_dau = DB::fetch('select fmg_lien_dau.id,fmg_clb.logo,fmg_lien_dau.win_clb_id,fmg_lien_dau.round,fmg_clb.name from fmg_lien_dau inner join fmg_clb on fmg_clb.id = fmg_lien_dau.win_clb_id where fmg_lien_dau.round='.($round-1).' and fmg_lien_dau.ld_server_id='.$server_id.' and fmg_lien_dau.win=1')){
						$str .= '<div class="lien-dau-team vo-dich">';
						$str .= '<img class="cup" src="skins/ssnh/images/fm_game/win.png"><span><img src="'.$cap_dau['logo'].'" alt="" width="20" height="20" onerror="this.src=\'skins/ssnh/images/fm_game/logo_clb.png\'"> '.$cap_dau['name'].'</span>';
						$str .= '</div>';
					}else{
						$str .= '<div class="lien-dau-team vo-dich">';
						$str .= '<img class="cup" src="skins/ssnh/images/fm_game/win.png"><span>2,000,000 sẽ thuộc về ai?</span>';
						$str .= '</div>';
					}
					for($c=0;$c<(($num_teams/2-1)*4/2);$c++){
						$str .= '<div class="lien-dau-team space">';
						$str .= '<span></span>';
						$str .= '</div>';
					}
			}
			$str .= '</div>';
		}
		return $str;
	}
	static function auto_lien_dau(){
		//DB::query('update fmg_clb set stamina=10');
		$sql = '
			select 
				fmg_server.id
				,fmg_server.name
			from 
				fmg_server
			where 
				1=1
				and fmg_server.status="OPEN"
				and fmg_server.for_winner = 1
			order by
				fmg_server.id asc
		';
		$servers = DB::fetch_all($sql);
		$vong_dau_id = get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID,true);
		foreach($servers as $k=>$v){
			$server_id = $k;
			$cap_daus = FMGAME::get_lien_dau_trong_ngay($server_id);
			foreach($cap_daus as $key=>$val){
				$kq = FMGAME::play($val['clb_id1'],$val['clb_id2'],$vong_dau_id,true);	
				//echo $kq;exit();
				if($kq==3){
					$win_clb_id=$val['clb_id1'];
				}else{
					$win_clb_id=$val['clb_id2'];
				}
				///////////////////////////
				/*if($val['clb_id1'] == 19){
					$win_clb_id = $val['clb_id1'];
				}
				if($val['clb_id2'] == 19){
					$win_clb_id = $val['clb_id2'];
				}*/
				if($val['clb_id1'] == 94){
					$win_clb_id = $val['clb_id1'];
				}
				if($val['clb_id2'] == 94){
					$win_clb_id = $val['clb_id2'];
				}
				////////////////////////////
				$arr = array('win_clb_id'=>$win_clb_id);
				if(sizeof($cap_daus)==1){
					$arr += array('win'=>1);
				}
				DB::update('fmg_lien_dau',$arr,'id='.$key);				
			}
		}
		FMGAME::auto_lich_lien_dau();
	}
	static function auto_lich_lien_dau(){
		$time = time();//strtotime('2015-10-1 00:00:00');
		///FMGAME::seeding();exit();
		if(date('N')==6)
		{// ngay thu 7
			$mua_giai_id = MUA_GIAI_ID;
			if($row=DB::fetch('select id from fmg_server where for_winner=1 and open_time="'.date('Y-m-d',$time).' 09:00:00"')){
				$server_id = $row['id'];
			}else{
				$server_id = DB::insert('fmg_server',array(
					'name'=>'Giải liên đấu ngày '.date('d/m/Y',$time).'',
					'mua_giai_id'=>$mua_giai_id,
					'open_time'=>date('Y-m-d',$time).' 09:00:00',
					'for_winner'=>1,
					'status'=>"OPEN"
				));
			}
			if(DB::exists('select id from fmg_lien_dau where round=1 and ld_server_id='.$server_id.'')){
				$total = DB::fetch('select count(*) as acount from fmg_lien_dau where round=1 and ld_server_id='.$server_id.'','acount');
				$total = $total*2;
				$total_rounds = floor(log($total, 2));
				for($i=2;$i<=$total_rounds;$i++){
					if($clbs = DB::fetch_all('select win_clb_id as id from fmg_lien_dau where round='.($i-1).' and ld_server_id='.$server_id.' and win_clb_id <> 0 order by id')){
						$clbs1 = $clbs2 = array();
						shuffle($clbs);
						$j=1;
						foreach($clbs as $key=>$val){
							if($j%2==0){
								$clbs1[] = $val['id'];
							}else{
								$clbs2[] = $val['id'];
							}
							$j++;
						}
						FMGAME::seeding($server_id,$clbs1,$clbs2,$i);
					}
				}
			}else{
				$limit = 32;
				$sql = '
					select 
						count(*) as acount
					FROM
						fmg_clb_server
						INNER JOIN fmg_clb ON fmg_clb.id = fmg_clb_server.clb_id
						INNER JOIN fmg_server ON fmg_server.id = fmg_clb_server.server_id
					WHERE
						fmg_server.status="OPEN"
						AND fmg_clb_server.win = 1
				';
				$count1 = DB::fetch($sql,'acount');
				$sql = '
					select 
						count(*) as acount
					FROM
						fmg_clb_server
						INNER JOIN fmg_clb ON fmg_clb.id = fmg_clb_server.clb_id
						INNER JOIN fmg_server ON fmg_server.id = fmg_clb_server.server_id
					WHERE
						fmg_server.status="OPEN"
						AND fmg_clb_server.win <> 1
						AND fmg_clb_server.hang >0
						AND (select count(*) from fmg_clb_server where fmg_clb_server.server_id=fmg_server.id) = '.MAX_TEAM.'
				';
				$count2 = DB::fetch($sql,'acount');
				if($count1 >=32){
					$limit = 32;
				}elseif($count1>=16){
					if($count1 + $count2>=32){
						$limit = 32;
					}else{
						$limit = 16;
					}
				}else{
					if($count1>=8){
						if($count1 + $count2>=16){
							$limit = 16;
						}else{
							$count1 = 8;
						}
					}else{
						if($count1>=4){
							if($count1 + $count2>=8){
								$limit = 8;
							}else{
								$limit = 4;
							}
						}else{
							$limit = 4;
						}
					}
				}
				$limit = 64;//for test
				$sql = '
					SELECT
						fmg_clb_server.id
						,fmg_clb_server.power
						,fmg_clb_server.diem
						,fmg_clb_server.win
						,fmg_clb_server.clb_id
						,fmg_clb_server.hang
					FROM
						fmg_clb_server
						INNER JOIN fmg_server ON fmg_server.id = fmg_clb_server.server_id
					WHERE
						 fmg_server.status="OPEN"
						 AND fmg_clb_server.hang>0
						 AND (select count(*) from fmg_clb_server where fmg_clb_server.server_id=fmg_server.id) = '.MAX_TEAM.'
					ORDER BY
						fmg_clb_server.win DESC,fmg_clb_server.hang,fmg_clb_server.diem DESC,fmg_clb_server.power ASC
					LIMIT 0,'.$limit.'
				';
				$clbs_tmp =  DB::fetch_all($sql);
				$total = sizeof($clbs_tmp);
				$total_rounds = floor(log($total,2));
				$clbs1 = array();
				$clbs2 = array();
				$i=1;
				shuffle($clbs_tmp);
				foreach($clbs_tmp as $key=>$val){
					if($i%2==0){
						$clbs1[] = $val['clb_id'];
					}else{
						$clbs2[] = $val['clb_id'];
					}
					$i++;
				}
				///////////////end lay 2 nhanh CLB///////////////////
				FMGAME::seeding($server_id,$clbs1,$clbs2,1);
			}
		}
	}
	static function seeding($server_id,$clb1,$clb2,$round){
		if($server_id){
			$open_time = date('Y-m-d '.(($round-1)+9).':00:00');
			foreach($clb1 as $v1){
				foreach($clb2 as $v2){
					if(!DB::exists('select id from fmg_lien_dau where (clb_id1='.$v1.' or clb_id2='.$v1.' or clb_id1='.$v2.' or clb_id2='.$v2.') and round='.$round.' and ld_server_id='.$server_id.'')){
						DB::insert('fmg_lien_dau',array(
							'clb_id1'=>$v1,
							'clb_id2'=>$v2,
							'round'=>$round,
							'open_time'=>$open_time,
							'ld_server_id'=>$server_id,
							'win_clb_id'=>0
						));
					}
				}
			}
		}
	}
	static function get_kq($clb1,$clb2,$vong_dau_id,$champion=false){
		if($champion){
			$sql = '
				SELECT
					`fmg_lien_dau`.`id`,
					`fmg_lien_dau`.`win_clb_id`,
					 fmg_lien_dau.open_time as thoi_gian
				FROM 
					`fmg_lien_dau`
				WHERE
					`fmg_lien_dau`.`clb_id1` = '.$clb1.'
					AND `fmg_lien_dau`.`clb_id2` = '.$clb2.'
					AND `fmg_lien_dau`.`round` = '.$vong_dau_id.'
			';
		}else{
			$sql = '
			SELECT
				`fmg_schedule`.`id`,
				`fmg_schedule`.`ket_qua`,
				 fmg_schedule.thoi_gian
			FROM 
				`fmg_schedule`
			WHERE
				`fmg_schedule`.`doi_chu_nha_id` = '.$clb1.'
				AND `fmg_schedule`.`doi_khach_id` = '.$clb2.'
				AND `fmg_schedule`.`vong_dau_id` = '.$vong_dau_id.'
		';
		}
		if($row=DB::fetch($sql)){
			return $row;
		}else{
			return false;
		}
	}
	static function get_kq_thach_dau($id){
		$sql = '
				SELECT
					`fmg_thach_dau`.*
				FROM 
					`fmg_thach_dau`
				WHERE
					`fmg_thach_dau`.`id` = '.$id.'
			';
		if($row=DB::fetch($sql)){
			return $row;
		}else{
			return false;
		}
	}
	static function get_kq_giai_phu($id){
		$sql = '
				SELECT
					`fmg_giai_phu`.*
				FROM 
					`fmg_giai_phu`
				WHERE
					`fmg_giai_phu`.`id` = '.$id.'
			';
		if($row=DB::fetch($sql)){
			return $row;
		}else{
			return false;
		}
	}
	////////////temp///////////////
	static function get_power_clb_temp($cau_thus){
		$total = 0;
		if($vong_dau_id=get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID,true)){
			foreach($cau_thus as $key=>$val){
				$diem = get_diem_cau_thu($val['cau_thu_id'],MUA_GIAI_ID,$vong_dau_id,true);
				$diem = $val['captain']?($diem*2):$diem;
				$total += $diem;
			}
		}
		return $total;
	}
	static function get_team_cost_temp($tmp_only=false){
		$total = 0;
		if(isset($_SESSION['clb_tmp']['cau_thus'])){
			$cau_thus = $_SESSION['clb_tmp']['cau_thus'];
			foreach($cau_thus as $key=>$val){
				if($tmp_only){
					if(!isset($val['id'])){
						$total += isset($val['cost'])?$val['cost']:0;
					}
				}else{
					$total += isset($val['cost'])?$val['cost']:0;
				}
			}
		}
		return $total;
	}
	static function get_cauthus_temp($cau_thus,$vi_tri=false){
		$i=1;
		$new_cau_thus = array();
		$vong_dau_id=get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID,true);
		foreach($cau_thus as $key=>$val){
			$cau_thu=get_cauthu($val['cau_thu_id'],MUA_GIAI_ID);
			$cau_thu['anh_dai_dien']='https://sieusaongoaihang.vn/'.$cau_thu['anh_dai_dien']; 
			$cau_thu['diem']=get_diem_cau_thu($val['cau_thu_id'],MUA_GIAI_ID,$vong_dau_id,true);
			if($cau_thu['ma_vi_tri']==$vi_tri){
				$new_cau_thus[$i] = $val;
				$new_cau_thus[$i] += $cau_thu;
				$i++;
			}
		}
		return $new_cau_thus;
	}
	static function check_bought($cau_thu_id,$vong_dau_id){
		if(FMGAME::my_team_id()){
			$cond = '
					fmg_clb_transfer.clb_id = '.FMGAME::my_team_id().'
					AND fmg_clb_transfer.cau_thu_id = '.$cau_thu_id.'
					AND fmg_clb_transfer.sell<>1
					AND fmg_clb_transfer.vong_dau_id='.$vong_dau_id.'
			';
			$sql = '
				select 
					fmg_clb_transfer.id
				from
					fmg_clb_transfer
				where 
					'.$cond.'
			';
			if(DB::exists($sql)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	static function check_exists_temp($cau_thu_id){
		if(isset($_SESSION['clb_tmp']['cau_thus'])){
			$return = false;
			$cau_thus = $_SESSION['clb_tmp']['cau_thus'];
			foreach($cau_thus as $key=>$val){
				if($cau_thu_id==$val['cau_thu_id']){
					$return = true;
				}
			}
		}else{
			$return = false;
		}
		return $return;
	}
	static function delete_cau_thu_temp($cau_thu_id){
		$cau_thus = $_SESSION['clb_tmp']['cau_thus'];
		foreach($cau_thus as $key=>$val){
			//echo "\n".$cau_thu_id.'-'.$val['cau_thu_id'];
			if($cau_thu_id==$val['cau_thu_id']){
				if(!isset($val['tmp'])){
					$_SESSION['clb_delete_ids'][$key] =  $val;
				}
				unset($cau_thus[$key]);
			}
		}
		$_SESSION['clb_tmp']['cau_thus'] =	$cau_thus;
		
	}
	///////////////////////////////
	static function get_mois($clb_id1,$clb_id2=false,$duoc_moi=false){
		$sql = '
			select 
				fmg_thach_dau.*
			from
				fmg_thach_dau
			where
				'.($duoc_moi?'clb_id2='.$clb_id1.' '.($clb_id2?' and clb_id1='.$clb_id2:'').'':'clb_id1='.$clb_id1.' '.($clb_id2?' and clb_id2='.$clb_id2:'').'').'
			and (ket_qua is null or ket_qua = "")
			order by
				fmg_thach_dau.id desc
		';
		return DB::fetch_all($sql);
	}
}
?>