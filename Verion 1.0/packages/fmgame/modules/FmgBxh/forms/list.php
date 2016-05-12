<?php
class FmgBxhForm extends Form
{
	function FmgBxhForm()
	{
		Form::Form('FmgBxhForm');
	}
	function on_submit(){
		Url::redirect_current(array('vong_dau_id','server_id','lien-dau','lien_dau_server_id','status'));
	}
	function draw()
	{
		$mua_giai_id = MUA_GIAI_ID;
		$this->map = array();
		$this->map['vong_dau'] = '';
		$vong_dau_id = Url::iget('vong_dau_id');	
		$status = Url::get('status')?Url::get('status'):'OPEN';
		$sql = '
			select 
				fmg_server.id
				,fmg_server.name
				,(select count(fmg_clb_server.id) from fmg_clb_server where fmg_clb_server.server_id=fmg_server.id) as tong_clb
			from 
				fmg_server
			where 
				fmg_server.status="'.$status.'"
				AND (select count(fmg_clb_server.id) from fmg_clb_server where fmg_clb_server.server_id=fmg_server.id) >='.MAX_TEAM.'
			order by
				fmg_server.id
		';
		$servers = DB::fetch_all($sql);
		$this->map['servers'] = $servers;
		$servers_ = $servers;
		$this->map['server_name'] = '';
		if(!Url::get('server_id')){
			$temp = array_shift($servers_);
			$this->map['server_name'] = $temp['name'];
			$_REQUEST['server_id'] = $temp['id'];
		}
		$this->map['bxh_clbs'] = array();
		$this->map['vong_dau'] = '';
		if($server_id = $_REQUEST['server_id'] and $server = DB::select('fmg_server','id='.$server_id)){
			$this->map['server_name'] = $server['name'];
			$this->map['vong_dau'] = DB::fetch('select id,ten from fmg_vong_dau where id = '.$vong_dau_id.'','ten');
			$item_per_page = 50;
			$cond = '';
			$items = FMGAME::get_lichthidaus($vong_dau_id,30,' and kqtd.server_id='.$server_id.'');
			$this->map['items'] = $items;
			$this->map['vong_dau_id_list'] = array(''=>'Vòng đấu') + String::get_list(FMGAME::get_vongdaus($server_id,true),'ten');
			$clbs = FMGAME::get_bangxephang($server_id);
			foreach($clbs as $key=>$val){
				$clbs[$key]['phong_do'] = FMGAME::get_phong_do($val['id']);	
			}
			$this->map['bxh_clbs'] = $clbs;
			/*if(@file_exists('cache/tables/dhss/bxh_clb_'..'.cache.php')){
				require_once('cache/tables/dhss/bxh_clb_'.$server_id.'.cache.php');
			}*/
		}
		$this->parse_layout('list',$this->map);
	}
}
?>
