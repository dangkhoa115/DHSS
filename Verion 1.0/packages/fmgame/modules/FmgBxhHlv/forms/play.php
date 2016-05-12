<?php
class SsnhPlayForm extends Form
{
	function SsnhPlayForm()
	{
		Form::Form('SsnhPlayForm');
	}
	function draw()
	{
		$mua_giai_id = MUA_GIAI_ID;
		$this->map = array();
		$vong_dau_id = get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID,true);
		$arr = array(1=>'Hòa',3=>'Thắng',0=>'Thua');
		$thang = 0;
		$hoa = 0;
		$thua = 0;
		$thach_dau = DB::select('fmg_thach_dau','id='.Url::get('id'));
		$clb_id1 = $thach_dau['clb_id1'];
		$clb_id2 = $thach_dau['clb_id2'];
		$clb1 = FMGAME::get_team($clb_id1);
		$this->map['cn_ten'] = $clb1['name'];
		$this->map['cn_logo'] = $clb1['logo'];
		$this->map['cn_tong_diem'] = FMGAME::get_power_clb($clb_id1,$vong_dau_id);
		$this->map['phong_ngu_cn'] = FMGAME::get_power_clb($clb_id1,$vong_dau_id,$mua_giai_id,'PN');
		$this->map['tan_cong_cn'] = FMGAME::get_power_clb($clb_id1,$vong_dau_id,$mua_giai_id,'TC');
		$this->map['phong_do_cn'] = $clb1['phong_do'];
		$this->map['stamina_cn'] =  $clb1['stamina'];

		$clb2 =  FMGAME::get_team($clb_id2);
		$this->map['kh_ten'] = $clb2['name'];
		$this->map['kh_logo'] = $clb2['logo'];
		$this->map['kh_tong_diem'] = FMGAME::get_power_clb($clb_id2,$vong_dau_id);
		$this->map['phong_ngu_kh'] = FMGAME::get_power_clb($clb_id2,$vong_dau_id,$mua_giai_id,'PN');
		$this->map['tan_cong_kh'] = FMGAME::get_power_clb($clb_id2,$vong_dau_id,$mua_giai_id,'TC');
		$this->map['phong_do_kh'] = $clb2['phong_do'];
		$this->map['stamina_kh'] =  $clb2['stamina'];
		
		$this->map['ty_le_thang_cn'] = FMGAME::get_ty_le_thang($this->map['cn_tong_diem'] + $clb1['stamina'],$this->map['kh_tong_diem'] + $clb2['stamina']);
		$this->map['ty_le_thang_kh'] = FMGAME::get_ty_le_thang($this->map['kh_tong_diem'] + $clb2['stamina'],$this->map['cn_tong_diem'] + $clb1['stamina']);
		
		$this->map['cn_thu_mon'] = FMGAME::get_cauthus($clb_id1,$vong_dau_id,'TM');
		$this->map['cn_hau_ve'] = FMGAME::get_cauthus($clb_id1,$vong_dau_id,'HV');
		$this->map['cn_tien_ve'] = FMGAME::get_cauthus($clb_id1,$vong_dau_id,'TV');
		$this->map['cn_tien_dao'] = FMGAME::get_cauthus($clb_id1,$vong_dau_id,'TD');
		
		$this->map['kh_thu_mon'] = FMGAME::get_cauthus($clb_id2,$vong_dau_id,'TM');
		$this->map['kh_hau_ve'] = FMGAME::get_cauthus($clb_id2,$vong_dau_id,'HV');
		$this->map['kh_tien_ve'] = FMGAME::get_cauthus($clb_id2,$vong_dau_id,'TV');
		$this->map['kh_tien_dao'] = FMGAME::get_cauthus($clb_id2,$vong_dau_id,'TD');
		$this->map['duration'] = 2000;
		$trang_thai = 'PENDDING';
		$this->map['thach_dau'] = false;
		$this->map['du_bao_cn'] = '';
		$this->map['du_bao_kh'] = '';
		$layout = 'play';
		if($thach_dau['ket_qua']){
			$this->map['kq'] = $thach_dau['ket_qua'];
			$this->map['time'] = (strtotime($thach_dau['thoi_gian']) - time());
			$this->map['thoi_gian'] = date('H:i\' d/m/Y',strtotime($thach_dau['thoi_gian']));
			if($this->map['kq']){
				$trang_thai = 'END';
			}else{
				if(strtotime($kq['thoi_gian']) <=time() and time()<=strtotime($thach_dau['thoi_gian'])+(5*60)){
					$trang_thai = 'PLAYING';
					$this->map['duration'] = ((strtotime($kq['thoi_gian'])+(5*60)) - time())*1000;
				}
			}
		}
		else{
			$trang_thai = 'PLAYING';
			$this->map['duration'] = 10*1000;
			$kq = FMGAME::play($clb_id1,$clb_id2,get_id_vong_dau_ket_thuc_gan_nhat(MUA_GIAI_ID,true));
			$this->map['kq'] = ($kq==1)?'Hòa':(($kq==3)?'Thắng':'Thua');
			$account_id1 = DB::fetch('select account_id from fmg_clb where id='.$thach_dau['clb_id1'].'','account_id');
			$account_id2 = DB::fetch('select account_id from fmg_clb where id='.$thach_dau['clb_id2'].'','account_id');
			if($kq==1){
				iGold::receive_igold($account_id1,$thach_dau['igold'],'Nhận lại igold thách đấu');
				Message::send_message('administrator',$account_id1,'Kết quả thách đấu: Hòa. <a href="?page=fmg_thach_dau&do=ls">( >>Xem )</a>');
				//Message::send_message('admin',$account_id2,'Kết quả thách đấu: Hòa. <a href="?page=fmg_thach_dau&do=ls">( >>Xem )</a>');
			}elseif($kq==3){
				iGold::receive_igold($account_id1,$thach_dau['igold']+$thach_dau['igold'],'Thắng thách đấu');
				iGold::pay_igold($account_id2,$thach_dau['igold'],'Thua thách đấu');
				Message::send_message('administrator',$account_id1,'Kết quả thách đấu: Thắng. <a href="?page=fmg_thach_dau&do=ls">( >>Xem )</a>');
				//Message::send_message('admin',$account_id2,'Kết quả thách đấu: Thua. <a href="?page=fmg_thach_dau&do=ls">( >>Xem )</a>');
			}else{
				//iGold::pay_igold($account_id1,$thach_dau['igold'],'Thua thách đấu');
				iGold::receive_igold($account_id2,$thach_dau['igold'],'Thắng thách đấu');
				Message::send_message('administrator',$account_id1,'Kết quả thách đấu: Thua. <a href="?page=fmg_thach_dau&do=ls">( >>Xem )</a>');
				Message::send_message('administrator',$account_id2,'Kết quả thách đấu: Thắng. <a href="?page=fmg_thach_dau&do=ls">( >>Xem )</a>');
			}
			DB::update('fmg_thach_dau',array('ket_qua'=>$this->map['kq']),'id='.$thach_dau['id']);
			$this->map['thach_dau'] = true;
		}
		$this->map['trang_thai'] = $trang_thai;
		$this->parse_layout($layout,$this->map);
	}
	
}
?>
