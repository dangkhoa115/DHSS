<?php
class FmgGiaiPhu extends Module{
	static $item = false;
	function FmgGiaiPhu($row){
		Module::Module($row);
		require_once 'packages/backend/includes/php/ssnh.php';
		require_once 'packages/backend/includes/php/igold.php';
		require_once 'packages/backend/includes/php/message.php';
		require_once 'packages/fmgame/includes/php/fmgame.php';
		require_once 'db.php';
		//$this->map['vong_dau'] = DB::fetch('select id,ten from fmg_vong_dau where id = '.$vong_dau_id.'','ten');
		switch(Url::get('do')){
			case 'close_all':
				DB::update('fmg_server_phu',array('status'=>'CLOSED'),'1=1');
				Url::redirect_current();
				break;
			case 'tra_lai_igold':
				FmgGiaiPhuDB::tra_lai_igold();
				Url::redirect_current();
				break;	
			case 'auto_create_server':
				FmgGiaiPhuDB::auto_create_server(20,39);
				FmgGiaiPhuDB::auto_create_server(40,59);
				FmgGiaiPhuDB::auto_create_server(60,79);
				FmgGiaiPhuDB::auto_create_server(80,99);
				FmgGiaiPhuDB::auto_create_server(100,159);				
				exit();
				break;
			case 'auto_lich_giai_phu':
				FmgGiaiPhuDB::auto_lich_giai_phu();
				break;
			case 'auto_dau_giai_phu':
				FmgGiaiPhuDB::auto_dau_giai_phu();
				exit();
				break;
			case 'dang_ky':
				if(User::is_login()){
					require_once 'forms/dang_ky.php';
					$this->add_form(new DangKyGiaiPhuForm());
				}else{
					header('location:dhss-dang-nhap.html?href='.htmlentities('?page=fmg_giai_phu&do=dang_ky').'');
					exit();
				}
				break;
			case 'xn_dang_ky':
				FmgGiaiPhuDB::dang_ky();
				break;
			default:
				if(User::is_login()){
					require_once 'forms/list.php';
					$this->add_form(new FmgGiaiPhuForm());
				}else{
					header('location:dhss-dang-nhap.html?href=dhss');
					exit();
				}
			break;
		}
		//Portal::$document_title = 'Lịch thi đấu Ngoại hạng Anh, lich thi dau ngoai hang anh, mua bong 2015/2016 '.$this->map['vong_dau'].'';
		//Portal::$meta_keywords = 'Lịch thi đấu, ngoại Hạng, ngoại hạng anh, lich thi dau, ngoai hang anh';
		//Portal::$meta_description = 'Lịch thi đấu ngoại hạng anh , lich thi dau ngoai hang anh 2015-2016 , theo dõi lịch thi đấu ngoại hạng anh cập nhật từng ngày để không bỏ lỡ những trận cầu nảy lửa';
	}
}
?>