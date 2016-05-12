<?php
class LichSuThachDauForm extends Form{
	function LichSuThachDauForm(){
		Form::Form('LichSuThachDauForm');
	}
	function draw(){
		// echo Url::build_current(array('do'=>'thach_dau','dcn_id'=>FMGAME::my_team_id(),'dkh_id'=>[[=clbs.id=]]))
		$vong_dau_id = get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID,true);
		$this->map = array();
		$this->map['co_the_moi_thach_dau'] = true;
		require_once 'packages/core/includes/utils/paging.php';
		$item_per_page = 50;
		$cond = 'ket_qua <> "" and ket_qua IS NOT NULL
			AND (hlv1.account_id = "'.Session::get('user_id').'" or hlv2.account_id = "'.Session::get('user_id').'")
		';
		$cond .= '
			'.(strip_tags(Url::sget('keyword'))?' AND fmg_clb.name LIKE "%'.strip_tags(Url::sget('keyword')).'%"':'').'
		';
		$sql = '
			select 
				count(*) as acount
			from 
				fmg_thach_dau
				INNER JOIN fmg_clb as clb1 ON clb1.id = fmg_thach_dau.clb_id1
				INNER JOIN fmg_clb as clb2 ON clb2.id = fmg_thach_dau.clb_id2
			where 
			'.$cond.'
			order by 
				fmg_clb.name
		';
		$clb_number = DB::fetch($sql,'acount');
		$this->map['paging'] = paging($clb_number,$item_per_page,10,false,'page_no',array('order','keyword','do'));
		$order = 'fmg_thach_dau.time DESC';
		if(Url::get('order')=='power_desc'){
			$order = 'fmg_clb.cache_power DESC';
		}elseif(Url::get('order')=='power_asc'){
			$order = 'fmg_clb.cache_power asc';
		}
		$sql = '
			select 
				fmg_thach_dau.id,
				clb1.id as clb_id1,
				clb1.name as clb1_name,
				clb1.logo as clb1_logo,
				clb2.id as clb_id2,
				clb2.name as clb2_name,
				clb2.logo as clb2_logo,
				fmg_thach_dau.igold,
				fmg_thach_dau.thoi_gian,
				fmg_thach_dau.ket_qua,
				fmg_thach_dau.time,
				hlv1.ten as hlv1_name,
				hlv2.ten as hlv2_name
			from 
				fmg_thach_dau
				INNER JOIN fmg_clb as clb1 ON clb1.id = fmg_thach_dau.clb_id1
				left outer join ssnh_nguoi_choi as hlv1 ON hlv1.account_id = clb1.account_id
				INNER JOIN fmg_clb as clb2 ON clb2.id = fmg_thach_dau.clb_id2
				left outer join ssnh_nguoi_choi as hlv2 ON hlv2.account_id = clb2.account_id
			where 
				'.$cond.'
			order by 
				'.$order.'
			Limit
				'.(((page_no()-1)*$item_per_page)).','.$item_per_page.'
		';
		$clbs = DB::fetch_all($sql);
		$i=1;
		foreach($clbs as $key=>$val){
			//DB::update('fmg_clb',array('cache_power'=>FMGAME::get_power_clb($key,$vong_dau_id,MUA_GIAI_ID)),'id='.$key);
			//$clbs[$key]['power'] = FMGAME::get_power_clb($key,$vong_dau_id);
			$clbs[$key]['time'] = date('H:i\' d/m/Y',$val['time']);
			$clbs[$key]['stt'] = $i + $item_per_page*(page_no()-1);
			$i++;
		}
		$this->map['clbs'] = $clbs;
		$this->parse_layout('ls',$this->map);
	}
}
?>
