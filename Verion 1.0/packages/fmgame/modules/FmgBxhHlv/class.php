<?php
class FmgBxhHlv extends Module{
	static $item = false;
	function FmgBxhHlv($row){
		Module::Module($row);
		if(User::is_login()){
			require_once 'packages/backend/includes/php/igold.php';
			require_once 'packages/backend/includes/php/ssnh.php';
			require_once 'packages/fmgame/includes/php/fmgame_local.php';
			require_once 'packages/backend/includes/php/message.php';
			require_once 'db.php';
			$this->update_seo();
			switch(Url::get('do')){
				case 'cache_hlv':
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
							1=1
						ORDER BY
							account.diem_kn DESC
						LIMIT
							0,2000
					';
		
					$items = DB::fetch_all($sql);
					$i = 1;
					foreach ($items as $key => $value) {
						$chiso = FmgBxhHlvDB::tong_diem_giai_chinh($value['id']) + FmgBxhHlvDB::tong_diem_thach_dau($value['id']) + FmgBxhHlvDB::tong_diem_lien_dau($value['id']) + FmgBxhHlvDB::tong_diem_giai_phu($value['id']) +FmgBxhHlvDB::vo_dich_giai_phu($value['id']) +FmgBxhHlvDB::vo_dich_lien_dau($value['id']) +FmgBxhHlvDB::vo_dich_giai_chinh($value['id']);
						DB::update('account',array('diem_kn'=>$chiso),'id="'.$value['acc'].'"');
					}
				break;
				case 'invite':
					if(Url::iget('dcn_id') and Url::iget('dkh_id') and (Url::iget('igold')==5 or Url::iget('igold')==10)){
						if(!DB::exists('select id from fmg_thach_dau where clb_id1='.Url::iget('dcn_id').' and  clb_id2='.Url::iget('dkh_id').' and (ket_qua is null or ket_qua = "")')){
							if(iGold::pay_igold(Session::get('user_id'),Url::iget('igold'),'Đặt cọc thách đấu')){
								$invite_id = DB::insert('fmg_thach_dau',array(
									'clb_id1'=>Url::iget('dcn_id'),
									'clb_id2'=>Url::iget('dkh_id'),
									'igold'=>Url::iget('igold'),
									'accepted'=>0,
									'time'=>time()
								));
								$clb = DB::select('fmg_clb','id='.Url::iget('dcn_id'));
								$kh_account_id = DB::fetch('select id,account_id from fmg_clb where id = '.Url::iget('dkh_id').'','account_id');
								Message::send_message(Session::get('user_id'),$kh_account_id,'Bạn nhận được lời thách đấu từ <strong>'.$clb['name'].'</strong>. <a href="?page=fmg_thach_dau&act=duoc_moi">( >>Xem ngay )</a>');
								echo '<script>alert("Bạn đã gửi lời mời thách đấu thành công!");window.location="'.Url::build_current(array('act'=>'moi')).'";</script>';
							}else{
								echo '<script>alert("Bạn không đủ iGold để thách đấu");window.location="'.Url::build_current(array('act','page_no')).'";</script>';
							}
						}
					}else{
						echo '<script>alert("Có lỗi xảy ra. Xin vui lòng kiểm tra lại tham số!");window.location="'.Url::build_current(array('act','page_no')).'";</script>';
					}
					exit();
				break;
				case 'accepted':
					if(Url::iget('id')){
						if($row=DB::fetch('select id,ket_qua,igold from fmg_thach_dau where id='.Url::iget('id').' and clb_id2 = '.FMGAME::my_team_id().'')){
							if(iGold::get_igold(Session::get('user_id')) >= $row['igold']){
								if(!$row['ket_qua']){
									DB::update('fmg_thach_dau',array('thoi_gian'=>date('Y-m-d H:i:s')),'id='.$row['id']);
								}
								require_once 'forms/play.php';
								$this->add_form(new SsnhPlayForm());
							}else{
								echo '<script>alert("Bạn không đủ iGold để nhận lời thách đấu. Vui lòng nạp thêm!");window.location="'.Url::build_current(array('act','page_no')).'";</script>';	
							}
						}else{
							echo '<script>alert("Có lỗi xảy ra. Xin vui lòng kiểm tra lại tham số!");window.location="'.Url::build_current(array('act','page_no')).'";</script>';
						}
					}else{
						echo '<script>alert("Có lỗi xảy ra. Xin vui lòng kiểm tra lại tham số!");window.location="'.Url::build_current(array('act','page_no')).'";</script>';
					}
				break;
				case 'deny':
					if(Url::iget('dcn_id') and Url::iget('dkh_id')){
						if($row = DB::fetch('select id,igold from fmg_thach_dau where clb_id1='.Url::iget('dcn_id').' and clb_id2='.Url::iget('dkh_id').' and clb_id2 = '.FMGAME::my_team_id().' and (ket_qua is null or ket_qua="")')){
							$account_id = DB::fetch('select account_id from fmg_clb where id='.Url::iget('dcn_id').'','account_id');
							iGold::receive_igold($account_id,$row['igold'],'Nhận lại igold thách đấu');
							DB::delete('fmg_thach_dau','id='.$row['id']);	
							Url::redirect_current(array('act','page_no'));
						}else{
							echo '<script>alert("Có lỗi xảy ra. Xin vui lòng kiểm tra lại tham số!");window.location="'.Url::build_current(array('act','page_no')).'";</script>';				
						}
					}else{
						echo '<script>alert("Có lỗi xảy ra. Xin vui lòng kiểm tra lại tham số!");window.location="'.Url::build_current(array('act','page_no')).'";</script>';
					}
				break;
				case 'cancel':
					if(Url::iget('dcn_id') and Url::iget('dkh_id')){
						if($row = DB::fetch('select id,igold from fmg_thach_dau where clb_id1='.Url::iget('dcn_id').' and clb_id2='.Url::iget('dkh_id').' and clb_id1 = '.FMGAME::my_team_id().' and accepted=0')){
							iGold::receive_igold(Session::get('user_id'),$row['igold'],'Nhận lại igold hủy thách đấu');
							DB::delete('fmg_thach_dau','id='.$row['id']);
							Url::redirect_current(array('act','page_no'));
						}else{
							echo '<script>alert("1. Có lỗi xảy ra. Xin vui lòng kiểm tra lại tham số!");window.location="'.Url::build_current(array('act','page_no')).'";</script>';				
						}
					}else{
						echo '<script>alert("2. Có lỗi xảy ra. Xin vui lòng kiểm tra lại tham số!");window.location="'.Url::build_current(array('act','page_no')).'";</script>';
					}
				case 'ls':
					require_once 'forms/ls.php';
					$this->add_form(new LichSuThachDauForm());
				break;
				default:
					require_once 'forms/available_team.php';
					$this->add_form(new AvailableTeamForm());
				break;
			}
		}else{
			header('location:dhss-dang-nhap.html?href=dhss');
			exit();
		}
	}
	function update_seo($name=false,$description=false,$logo_url=false){
		Portal::$document_title = (Url::get('do')=='thach_dau')?'Thách đấu':'Thi đấu';
	}
}
?>