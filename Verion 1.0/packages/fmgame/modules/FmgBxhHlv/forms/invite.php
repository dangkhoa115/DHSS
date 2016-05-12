<?php
class SsnhInviteForm extends Form{
	function SsnhInviteForm(){
		Form::Form('SsnhInviteForm');
	}
	function draw(){
		// echo Url::build_current(array('do'=>'thach_dau','dcn_id'=>FMGAME::my_team_id(),'dkh_id'=>[[=clbs.id=]]))
		$vong_dau_id = get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID,true);
		$this->map = array();
		require_once 'packages/core/includes/utils/paging.php';
		$item_per_page = 50;
		$sql = '
			select 
				count(*) as acount
			from 
				fmg_clb
			where 
			'.(FMGAME::my_team_id(MUA_GIAI_ID)?'id <> '.FMGAME::my_team_id(MUA_GIAI_ID).'':'1=1').'
			order by 
				fmg_clb.name
		';
		$clb_number = DB::fetch($sql,'acount');
		$this->map['paging'] = paging($clb_number,$item_per_page,10,false,'page_no',array());
		$sql = '
			select 
				fmg_clb.id,fmg_clb.account_id,fmg_clb.name,fmg_clb.logo,
				ssnh_nguoi_choi.ten as hlv
			from 
				fmg_clb
				left outer join ssnh_nguoi_choi ON ssnh_nguoi_choi.account_id = fmg_clb.account_id
			where 
				'.(FMGAME::my_team_id(MUA_GIAI_ID)?'fmg_clb.id <> '.FMGAME::my_team_id(MUA_GIAI_ID).'':'1=1').'
			order by 
				fmg_clb.id DESC
			Limit
				'.(((page_no()-1)*$item_per_page)).','.$item_per_page.'
		';
		$clbs = DB::fetch_all($sql);
		$i=1;
		foreach($clbs as $key=>$val){
			$clbs[$key]['power'] = FMGAME::get_power_clb($key,$vong_dau_id);
			$clbs[$key]['phong_do'] = FMGAME::get_phong_do($key);
			$clbs[$key]['stt'] = $i + $item_per_page*(page_no()-1);
			$clbs[$key]['online_status'] = '<img src="skins/fmgame/images/offline.png" alt="Đang offline"/>';	
			if(User::is_online($val['account_id'])){
					$clbs[$key]['online_status'] = '<img src="skins/fmgame/images/online.png" alt="Đang online"/>';
			}
			$i++;
		}
		$this->map['clbs'] = $clbs;
		$this->parse_layout('available_team',$this->map);
	}
}
?>
