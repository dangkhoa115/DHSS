<?php
class FmgBxhHlvDB{
	
	static function get_muagiais($order_by='ssnh_mua_giai.tu_ngay'){
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

	static function tong_diem_giai_chinh($clb_id){
		$total = DB::fetch('
			SELECT
				count(*) as acount
			FROM
				fmg_schedule
			WHERE
				(doi_chu_nha_id= "'.$clb_id.'" and ket_qua = "Thắng")
				or
				(doi_khach_id= "'.$clb_id.'" and ket_qua = "Thua")
		','acount');
		return $total*5;
	}

	static function tong_diem_thach_dau($clb_id){
		$total = DB::fetch('
			SELECT 
				count(*) as acount
			FROM
				fmg_thach_dau
			WHERE
				(clb_id1 = "'.$clb_id.'" and ket_qua = "Thắng")
				or
				(clb_id2 = "'.$clb_id.'" and ket_qua = "Thua")

		','acount');
		return $total;
	}

	static function tong_diem_lien_dau($clb_id){
		$total = DB::fetch('
			SELECT 
				count(*) as acount
			FROM
				fmg_lien_dau
			WHERE
				win_clb_id = "'.$clb_id.'" 
		','acount');
		return $total*10;
	}

	static function tong_diem_giai_phu($clb_id){
		return 0;
		/*$total = DB::fetch('
			SELECT 
				count(*) as acount
			FROM
				fmg_giai_phu
			WHERE
				win_clb_id = "'.$clb_id.'" 
		','acount');
		return $total*2;*/
	}

	static function vo_dich_giai_phu($clb_id){
		$total = DB::fetch('
			SELECT 
				count(*) as acount
			FROM
				fmg_giai_phu
			WHERE
				win_clb_id= "'.$clb_id.'" 
				and win = "1"

		','acount');
		return $total*10;
	}

	static function vo_dich_lien_dau($clb_id){
		$total = DB::fetch('
			SELECT 
				count(*) as acount
			FROM
				fmg_lien_dau
			WHERE
				win_clb_id= "'.$clb_id.'" 
				and win = "1"

		','acount');
		return $total*30;
	}

	static function vo_dich_giai_chinh($clb_id){
		$total = DB::fetch('
			SELECT 
				count(*) as acount
			FROM
				fmg_clb_server
			WHERE
				clb_id = "'.$clb_id.'" 
				and win = "1"

		','acount');
		return $total*20;
	}

	static function bxh_hlv($bxh_hlv_per_page,$cond){
		$sql = '
				SELECT 
					fmg_clb.id,
					fmg_clb.name as name_clb,
					party.full_name as name_hlv,
					party.image_url as image_url,
					fmg_clb.account_id	as acc,
					account.diem_kn,
					fmg_clb.cache_power,
					fmg_clb.account_id
				FROM 
					fmg_clb
					INNER JOIN account ON fmg_clb.account_id = account.id
					INNER JOIN party  ON party.user_id = account.id
				WHERE 
					'.$cond.'
				ORDER BY
					account.diem_kn DESC
				LIMIT
					'.((page_no()-1)*$bxh_hlv_per_page).','.$bxh_hlv_per_page.'
			';
			$items = DB::fetch_all($sql);
			$i = 1;
			foreach ($items as $key => $value) {
				//$chiso = FmgBxhHlvDB::tong_diem_giai_chinh($value['id']) + FmgBxhHlvDB::tong_diem_thach_dau($value['id']) + FmgBxhHlvDB::tong_diem_lien_dau($value['id']) + FmgBxhHlvDB::tong_diem_giai_phu($value['id']) +FmgBxhHlvDB::vo_dich_giai_phu($value['id']) +FmgBxhHlvDB::vo_dich_lien_dau($value['id']) +FmgBxhHlvDB::vo_dich_giai_chinh($value['id']);
				//DB::update('account',array('diem_kn'=>$chiso),'id="'.$value['acc'].'"');
				$items[$key]['stt'] = ($i++)+((page_no()-1)*$bxh_hlv_per_page);
				$items[$key]['level'] = FMGAME::get_hang_hlv($value['account_id']);
			}
			// System::debug($items);die;
			return $items;
	}

	static function get_all_hlv($cond){
		$sql = '
				SELECT 
					fmg_clb.id,
					fmg_clb.name as name_clb,
					party.full_name as name_hlv,
					party.image_url as image_url,
					fmg_clb.account_id	as acc,
					account.diem_kn,
					fmg_clb.cache_power

				FROM 
					fmg_clb
					INNER JOIN account ON fmg_clb.account_id = account.id
					INNER JOIN party  ON party.user_id = account.id
				WHERE 
					 '.$cond.'
			';
			$items = DB::fetch_all($sql);
			return $items;
	}
}
?>
