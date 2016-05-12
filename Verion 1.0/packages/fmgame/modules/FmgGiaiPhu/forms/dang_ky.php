<?php
class DangKyGiaiPhuForm extends Form
{
	function DangKyGiaiPhuForm()
	{
		Form::Form('DangKyGiaiPhuForm');
	}
	function on_submit(){
		Url::redirect_current(array('vong_dau_id','server_id','status'));
	}
	function draw()
	{
		
		
		/*
		$sql = 'select * from fmg_clb where cache_power > 0 limit 0,150';
		$clbs = DB::fetch_all($sql);
		foreach($clbs as $key=>$val){
			$clb_id = $key;
			$power = FmgGiaiPhuDB::get_power($clb_id);
			if($servers = DB::fetch_all('select fmg_server_phu.id from fmg_server_phu where (select count(*) from fmg_clb_server_phu where fmg_clb_server_phu.server_id=fmg_server_phu.id) < 16 and fmg_server_phu.status = "OPEN" and fmg_server_phu.power_from <= '.$power.' and '.$power.' < fmg_server_phu.power_to order by (select count(*) from fmg_clb_server_phu where fmg_clb_server_phu.server_id=fmg_server_phu.id) DESC')){
				foreach($servers as $key=>$val){
					$server_id = $key;
					//'fmg_clb_server_phu'
					if(!DB::exists('select id from fmg_clb_server_phu where server_id='.$server_id.' and clb_id='.$clb_id.'')){
						DB::insert('fmg_clb_server_phu',array(
							'server_id'=>$server_id,
							'clb_id'=>$clb_id,
							'power'=>$power,
							'time'=>time()
						));
						break;
					}
				}
			}
		}
		*/
		$mua_giai_id = MUA_GIAI_ID;
		$this->map = array();
		$_REQUEST['server_id'] = $this->map['server_id'] = FmgGiaiPhuDB::get_server_id();
		$this->map['vong_dau'] = '';	
		$status = Url::get('status')?Url::get('status'):'OPEN';
		$this->map['power'] = FmgGiaiPhuDB::get_power();
		$sql = '
			select 
				fmg_server_phu.id
				,fmg_server_phu.name
				,fmg_server_phu.power_from
				,fmg_server_phu.power_to
				,(select count(fmg_clb_server_phu.id) from fmg_clb_server_phu where fmg_clb_server_phu.server_id=fmg_server_phu.id) as tong_clb
			from 
				fmg_server_phu
			where 
				fmg_server_phu.mua_giai_id = '.$mua_giai_id.'
				AND fmg_server_phu.status="'.$status.'"
				AND (select count(fmg_clb_server_phu.id) from fmg_clb_server_phu where fmg_clb_server_phu.server_id=fmg_server_phu.id) > 0
			order by
				fmg_server_phu.name
		';
		$servers = DB::fetch_all($sql);
		$this->map['servers'] = $servers;
		$layout = 'dang_ky';
		$this->parse_layout($layout,$this->map);
	}
}
?>
