<?php
define('MAX_TEAM_PHU',8);
class FmgGiaiPhuDB{
	static function dang_ky(){
		if(date('H')>=15){
			echo '<script>
				alert("Đã hết thời gian đăng ký giải phụ, bạn vui lòng đợi ngày hôm sau");
				window.location="'.Url::build_current().'";
			</script>';
			exit();
		}else{
			$clb_id = FMGAME::my_team_id();
			$power = FmgGiaiPhuDB::get_power();
			if($servers = DB::fetch_all('select fmg_server_phu.id from fmg_server_phu where (select count(*) from fmg_clb_server_phu where fmg_clb_server_phu.server_id=fmg_server_phu.id) < '.MAX_TEAM_PHU.' and fmg_server_phu.status = "OPEN" and fmg_server_phu.power_from <= '.$power.' and '.$power.' <= fmg_server_phu.power_to order by (select count(*) from fmg_clb_server_phu where fmg_clb_server_phu.server_id=fmg_server_phu.id) DESC, fmg_server_phu.id')){
				foreach($servers as $key=>$val){
					$server_id = $key;
					//'fmg_clb_server_phu'
					$sql = '
						select 
							csvp.id 
						from
							fmg_clb_server_phu as csvp
							inner join fmg_server_phu as sp ON sp.id = csvp.server_id 
						where 
							csvp.clb_id='.$clb_id.'
							and sp.status="OPEN"
					';
					if(!DB::exists($sql)){
						if(iGold::pay_igold(Session::get('user_id'),5,'Đăng ký giải đấu phụ')){
							DB::insert('fmg_clb_server_phu',array(
								'server_id'=>$server_id,
								'clb_id'=>$clb_id,
								'power'=>$power,
								'time'=>time()
							));
							echo '<script>
								alert("Bạn đã đăng ký thành công!");
								window.location="'.Url::build_current(array('do'=>'dang_Ky')).'";
							</script>';
							exit();
							break;
						}else{
							echo '<script>
								alert("Bạn không đủ số igold để đăng ký. Bạn vui lòng nạp thêm!");
								window.location="'.Url::build_current(array('do'=>'dang_Ky')).'";
							</script>';
							exit();
						}
					}else{
						echo '<script>
							alert("Bạn đã đăng ký!");
							window.location="'.Url::build_current(array('do'=>'dang_ky')).'";
						</script>';
						exit();
					}
				}
			}
		}
	}
	static function get_server_id(){
		$clb_id = FMGAME::my_team_id();
		$power = FmgGiaiPhuDB::get_power();
		$sql = '
			select 
				csvp.id,
				csvp.server_id
			from
				fmg_clb_server_phu as csvp
				inner join fmg_server_phu as sp ON sp.id = csvp.server_id 
			where 
				csvp.clb_id='.$clb_id.'
				and sp.status="OPEN"
		';
		if($row = DB::fetch($sql)){
			return $row['server_id'];
		}else{
			$server_id = false;
		}
		return $server_id;
	}
	static function get_power($clb_id=false){
		$clb_id=$clb_id?$clb_id:FMGAME::my_team_id();
		$vong_dau_id = get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID);
		///////////////////////////update vi tri cua server hien tai////////
		return FMGAME::get_power_clb($clb_id,$vong_dau_id,MUA_GIAI_ID);
	}
  static function auto_create_server($power_from,$power_to){
		$d = 'd';
		$vong_dau_id = get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID);
		FMGAME::cache_power($vong_dau_id);
		$total_clb = DB::fetch('select count(fmg_clb.id) as acount from fmg_clb where cache_power >= '.$power_from.' and cache_power <= '.$power_to.'','acount');
		$time = time();
		$mua_giai_id = MUA_GIAI_ID;
		$total = ceil($total_clb/MAX_TEAM_PHU);
		for($i=1;$i<=$total;$i++){
			$server_name = 'Giải đấu power '.$power_from.' - '.$power_to.' số '.$i.' ngày '.date(''.$d.'/m/Y',$time).'';
			if($row=DB::fetch('select id from fmg_server_phu where name="'.$server_name.'"  open_time="'.date('Y-m-'.$d.'',$time).' 09:00:00" where power_from = '.$power_from.' and power_to='.$power_to.'')){
				$server_id = $row['id'];
			}else{
				$server_id = DB::insert('fmg_server_phu',array(
					'name'=>$server_name,
					'mua_giai_id'=>$mua_giai_id,
					'open_time'=>date('Y-m-'.$d.'',$time).' 14:00:00',
					'status'=>"OPEN",
					'power_from'=>$power_from,
					'power_to'=>$power_to
				));
			}
		}
	}
	 static function tra_lai_igold(){
		 $max_team = MAX_TEAM_PHU;
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
					fmg_server_phu.mua_giai_id = '.MUA_GIAI_ID.'
					AND fmg_server_phu.status="OPEN"
					AND (select count(fmg_clb_server_phu.id) from fmg_clb_server_phu where fmg_clb_server_phu.server_id=fmg_server_phu.id) < '.MAX_TEAM_PHU.'
				order by
					fmg_server_phu.power_from
			';
		$servers = DB::fetch_all($sql);
		foreach($servers as $key=>$val){			
			$sql = 'select id,clb_id from fmg_clb_server_phu where fmg_clb_server_phu.server_id='.$key.'';
			$clb_id = DB::fetch($sql,'clb_id');
			if($account_id = DB::fetch('select id,account_id from fmg_clb where id = '.$clb_id.'','account_id')){
				iGold::receive_igold($account_id,5,'Đăng ký giải phụ không đủ '.MAX_TEAM_PHU.' đội');
				$content = 'Bạn nhận lại 5 iGold vì đăng ký giải phụ không đủ '.MAX_TEAM_PHU.' đội';
				Message::send_message('administrator',$account_id,$content);
				DB::delete('fmg_clb_server_phu','server_id='.$key);
			}
		}
	 }
	 static function auto_lich_giai_phu(){
		 $max_team = MAX_TEAM_PHU;
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
					fmg_server_phu.mua_giai_id = '.MUA_GIAI_ID.'
					AND fmg_server_phu.status="OPEN"
					AND (select count(fmg_clb_server_phu.id) from fmg_clb_server_phu where fmg_clb_server_phu.server_id=fmg_server_phu.id) = '.MAX_TEAM_PHU.'
				order by
					fmg_server_phu.power_from
			';
		$servers = DB::fetch_all($sql);
		foreach($servers as $key=>$val){
		 $server_id = $key;
		 if(DB::exists('select id from fmg_giai_phu where round=1 and server_id='.$server_id.'')){
			$total = DB::fetch('select count(*) as acount from fmg_giai_phu where round=1 and server_id='.$server_id.'','acount');
			$total = $total*2;
			$total_rounds = floor(log($total, 2));
			for($i=2;$i<=$total_rounds;$i++){
				if($clbs = DB::fetch_all('select win_clb_id as id from fmg_giai_phu where round='.($i-1).' and server_id='.$server_id.' and win_clb_id <> 0 order by id')){
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
					FmgGiaiPhuDB::seeding($server_id,$clbs1,$clbs2,$i);
				}
			}
		}else{
				$limit = 8;
				/*$sql = '
					select 
						count(*) as acount
					FROM
						fmg_clb_server_phu
						INNER JOIN fmg_clb ON fmg_clb.id = fmg_clb_server_phu.clb_id
						INNER JOIN fmg_server_phu ON fmg_server_phu.id = fmg_clb_server_phu.server_id
					WHERE
						fmg_server_phu.status="OPEN"
						 AND fmg_server_phu.id = '.$server_id.'
				';
				$count1 = DB::fetch($sql,'acount');
				if($count1<16){
					$limit = 16;
				}*/
				$sql = '
					SELECT
						fmg_clb_server_phu.id
						,fmg_clb_server_phu.power
						,fmg_clb_server_phu.diem
						,fmg_clb_server_phu.win
						,fmg_clb_server_phu.clb_id
						,fmg_clb_server_phu.hang
					FROM
						fmg_clb_server_phu
						INNER JOIN fmg_server_phu ON fmg_server_phu.id = fmg_clb_server_phu.server_id
					WHERE
						 fmg_server_phu.status="OPEN"
						 AND fmg_server_phu.id = '.$server_id.'
						 AND (select count(*) from fmg_clb_server_phu where fmg_clb_server_phu.server_id=fmg_server_phu.id) = '.$max_team.'
					ORDER BY
						fmg_clb_server_phu.id DESC
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
				FmgGiaiPhuDB::seeding($server_id,$clbs1,$clbs2,1);
			}
		}
		FmgGiaiPhuDB::tra_lai_igold();
	 }
	 static function seeding($server_id,$clb1,$clb2,$round){
		$d = 'd';
		$sql = '
			select 
				fmg_server_phu.id
			from 
				fmg_server_phu
			where 
				fmg_server_phu.mua_giai_id = '.MUA_GIAI_ID.'
				AND fmg_server_phu.status="OPEN"
				AND (select count(fmg_clb_server_phu.id) from fmg_clb_server_phu where fmg_clb_server_phu.server_id=fmg_server_phu.id) = '.MAX_TEAM_PHU.'
			order by
				fmg_server_phu.power_from
		';
		$servers = DB::fetch_all($sql);
		$open_server_ids = '';
		foreach($servers as $k=>$v){
			$open_server_ids .= ($open_server_ids?',':'').$k;	
		}
		if($server_id){
			$open_time = date('Y-m-'.$d.' '.(($round-1)+14).':00:00');
			foreach($clb1 as $v1){
				foreach($clb2 as $v2){
					 $sql = '
						select 
							fmg_giai_phu.id
						from 
							fmg_giai_phu							
							inner join fmg_server_phu ON fmg_server_phu.id = fmg_giai_phu.server_id
							inner join fmg_clb_server_phu ON fmg_clb_server_phu.server_id = fmg_server_phu.id
						where 
							fmg_server_phu.status = "OPEN"
							and (clb_id1='.$v1.' or clb_id2='.$v1.' or clb_id1='.$v2.' or clb_id2='.$v2.') 
							and round='.$round.' 
							and fmg_giai_phu.server_id = '.$server_id.'
					';//and fmg_giai_phu.server_id IN ('.$open_server_ids.')				
					if(!DB::exists($sql)){
						DB::insert('fmg_giai_phu',array(
							'clb_id1'=>$v1,
							'clb_id2'=>$v2,
							'round'=>$round,
							'open_time'=>$open_time,
							'server_id'=>$server_id,
							'win_clb_id'=>0
						));
					}else{
						//echo $v1.'-'.$v2.'-server '.$server_id.'<br>';
					}
					
				}
			}
		}
	}
	static function get_kq($clb1,$clb2,$vong_dau_id,$champion=false){
		$sql = '
			SELECT
				`fmg_giai_phu`.`id`,
				`fmg_giai_phu`.`win_clb_id`,
				 fmg_giai_phu.open_time as thoi_gian
			FROM 
				`fmg_giai_phu`
			WHERE
				`fmg_giai_phu`.`clb_id1` = '.$clb1.'
				AND `fmg_giai_phu`.`clb_id2` = '.$clb2.'
				AND `fmg_giai_phu`.`round` = '.$vong_dau_id.'
		';
		if($row=DB::fetch($sql)){
			return $row;
		}else{
			return false;
		}
	}
	static function auto_dau_giai_phu(){
		$d = 'd';
		//DB::query('update fmg_clb set stamina=10');
		$sql = '
			select 
				fmg_server_phu.id
				,fmg_server_phu.name
			from 
				fmg_server_phu
			where 
				(select count(*) from fmg_clb_server_phu where fmg_clb_server_phu.server_id=fmg_server_phu.id) =  '.MAX_TEAM_PHU.'
				and fmg_server_phu.status="OPEN"
				and fmg_server_phu.open_time <= "'.date('Y-m-'.$d.' H:i:s').'"
			order by
				fmg_server_phu.id asc
		';
		
		$servers = DB::fetch_all($sql);
		$vong_dau_id = get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID);
		$end=false;
		foreach($servers as $k=>$v){
			$server_id = $k;
			$cap_daus = DB::fetch_all('
				select 
					id,clb_id1,clb_id2,round
				from 
					fmg_giai_phu 
				where 
					server_id='.$server_id.'
					AND	"'.date('Y-m-'.$d.' 00:00:00').'" <= open_time
					AND "'.date('Y-m-'.$d.' H:s:i').'" >= open_time
					AND (win_clb_id is null or win_clb_id = 0)
				order by
					round,open_time
			');
			$total_igold = 8;
			foreach($cap_daus as $key=>$val){
				$kq = FMGAME::play_giai_phu($val['clb_id1'],$val['clb_id2'],$vong_dau_id,true);	

				if($kq==3){
					$win_clb_id=$val['clb_id1'];
				}else{
					$win_clb_id=$val['clb_id2'];
				}
				$arr = array('win_clb_id'=>$win_clb_id);
				if(sizeof($cap_daus)==1){
					$arr += array('win'=>1);
					/************/
					//$clb_id = DB::fetch('select id,clb_id from fmg_clb_server_phu where id='.$win_clb_id.'','clb_id');
					$account_id = DB::fetch('select account_id from fmg_clb where id = '.$win_clb_id.'','account_id');
					iGold::receive_igold($account_id,(($total_igold*5)*0.85),'Starteam: Vô địch '.$v['name'].'');
					$content = 'Chúc mừng nhà vô địch với '.((($total_igold*5)*0.85)).' (BTC đã thu 15% phí tổ chức) iGold';
					Message::send_message('administrator',$account_id,$content);
					$end = true;
					/************/
				}
				DB::update('fmg_giai_phu',$arr,'id='.$key);				
			}
		}
		if($end){
			DB::update('fmg_server_phu',array('status'=>'CLOSED'),'1=1');//dong server
		}
		FmgGiaiPhuDB::auto_lich_giai_phu();
	}
	static function draw_giai_phu($server_id){
		$vong_dau_id = get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID);
		$num_teams = DB::fetch('select count(*) as acount from fmg_giai_phu where round=1 and server_id='.$server_id.'','acount');
		$num_teams = $num_teams*2;
		$total_rounds = floor(log($num_teams, 2)) + 1;
		$max_rows = $num_teams*2;
		$str = '';
		for ($round = 1; $round <= $total_rounds; $round++) {
			$str .= '<div class="lien-dau-round"><div class="header"><strong>'.(($round==$total_rounds)?'Vô địch':(($round==$total_rounds-1)?'Chung kết':(($round==$total_rounds-2)?'Bán kết':(($round==$total_rounds-3)?'Tứ kết':'Vòng '.$round)))).'</strong>'.(($round<$total_rounds)?'<br>'.(14+$round).'h\'':'<br>&nbsp;').'</div>';
			if($round<$total_rounds)
			{
				$cap_daus = DB::fetch_all('select id,clb_id1,clb_id2,round from fmg_giai_phu where round='.$round.' and server_id='.$server_id.' order by id');
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
					$str .= '<span class="vs"><a href="'.Url::build('fmg_play',array('do'=>'giai_phu','id'=>$key,'dcn_id'=>$clb1['id'],'dkh_id'=>$clb2['id'],'vong_dau_id'=>$round)).'">vs</a></span>';
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
					if($cap_dau = DB::fetch('select fmg_giai_phu.id,fmg_clb.logo,fmg_giai_phu.win_clb_id,fmg_giai_phu.round,fmg_clb.name from fmg_giai_phu inner join fmg_clb on fmg_clb.id = fmg_giai_phu.win_clb_id where fmg_giai_phu.round='.($round-1).' and fmg_giai_phu.server_id='.$server_id.' and fmg_giai_phu.win=1')){
						$str .= '<div class="lien-dau-team vo-dich">';
						$str .= '<img class="cup" src="skins/ssnh/images/fm_game/win.png"><span><img src="'.$cap_dau['logo'].'" alt="" width="20" height="20" onerror="this.src=\'skins/ssnh/images/fm_game/logo_clb.png\'"> '.$cap_dau['name'].'</span>';
						$str .= '</div>';
					}else{
						$str .= '<div class="lien-dau-team vo-dich">';
						$str .= '<img class="cup" src="skins/ssnh/images/fm_game/win.png"><span>'.($num_teams*5).' iGold sẽ thuộc về ai?</span>';
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
}
?>
