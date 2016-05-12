<?php
class FmgGiaiPhuForm extends Form
{
	function FmgGiaiPhuForm()
	{
		Form::Form('FmgGiaiPhuForm');
	}
	function on_submit(){
		Url::redirect_current(array('vong_dau_id','server_id','status'));
	}
	function draw()
	{
		//echo 1;
		//FmgGiaiPhuDB::tra_lai_igold();
		$mua_giai_id = MUA_GIAI_ID;
		$this->map = array();
		$this->map['vong_dau'] = '';
		$vong_dau_id = Url::iget('vong_dau_id');	
		$status = Url::get('status')?Url::get('status'):'OPEN';
		$sql = '
			select 
				fmg_server_phu.id
				,fmg_server_phu.name
				,(select count(fmg_clb_server_phu.id) from fmg_clb_server_phu where fmg_clb_server_phu.server_id=fmg_server_phu.id) as tong_clb
			from 
				fmg_server_phu
			where 
				1=1
			order by
				fmg_server_phu.id
		';
		$servers = DB::fetch_all($sql);
		$servers_ = $servers;
		if(!Url::get('server_id')){
			if(FmgGiaiPhuDB::get_server_id()){
				$_REQUEST['server_id'] = FmgGiaiPhuDB::get_server_id();
			}else{
				$server_id = DB::fetch('select id from fmg_server_phu order by id desc limit 0,1','id');
				$_REQUEST['server_id'] = $server_id;
			}
		}
		$this->map['bxh_clbs'] = array();
		$this->map['servers'] = array();
		$this->map['vong_dau'] = '';
		$this->map['server_id_list'] = array('Xem bảng đấu') + String::get_list($servers);
		$layout = 'giai_phu';
		if($server_id = $_REQUEST['server_id']){
			$this->map['vong_dau'] = DB::fetch('select id,ten from fmg_vong_dau where id = '.$vong_dau_id.'','ten');
			$item_per_page = 50;
			$cond = '';
			$items = FMGAME::get_lichthidaus($vong_dau_id,30,' and kqtd.server_id='.$server_id.'');
			$this->map['items'] = $items;
			$this->map['vong_dau_id_list'] = array(''=>'Vòng đấu') + String::get_list(FMGAME::get_vongdaus($server_id,true),'ten');
			if(@file_exists('cache/tables/dhss/bxh_clb_'.$server_id.'.cache.php')){
				require_once('cache/tables/dhss/bxh_clb_'.$server_id.'.cache.php');
				$this->map['bxh_clbs'] = $clbs;
			}
		}
		$status = Url::get('status')?Url::get('status'):'OPEN';
		$sql = '
			select 
				fmg_server_phu.id,fmg_server_phu.name
			FROM
				fmg_server_phu
			WHERE	
				1=1
				AND 
					(
						(select count(fmg_clb_server_phu.id) from fmg_clb_server_phu where fmg_clb_server_phu.server_id=fmg_server_phu.id) = 8
				or	(select count(fmg_clb_server_phu.id) from fmg_clb_server_phu where fmg_clb_server_phu.server_id=fmg_server_phu.id) = 16
					)
				order by
					fmg_server_phu.id desc
		';
		$this->map['server_id_list'] = array('Xem theo server') + String::get_list(DB::fetch_all($sql));
		if($server_id=Url::iget('server_id')){
			$this->map['lich'] = FmgGiaiPhuDB::draw_giai_phu($server_id);
		}elseif($server_id = DB::fetch('select id from fmg_server_phu where open_time="'.date('Y-m-d').' 09:00:00" and status="OPEN"','id')){
			$this->map['lich'] = FmgGiaiPhuDB::draw_giai_phu($server_id);
		}else{
			$this->map['lich'] = ''; //FmgGiaiPhuDB::draw_giai_phu($server_id);;
		}
		//$this->map['lich'] = '';
		$this->map['server_id'] = FmgGiaiPhuDB::get_server_id();
		$this->parse_layout($layout,$this->map);
	}
}
?>
