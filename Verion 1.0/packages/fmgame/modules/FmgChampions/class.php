<?php
class FmgChampions extends Module{
	static $item = false;
	function FmgChampions($row){
		Module::Module($row);
		require_once 'packages/fmgame/includes/php/fmgame_local.php';
		require_once 'db.php';
		//$this->map['vong_dau'] = DB::fetch('select id,ten from fmg_vong_dau where id = '.$vong_dau_id.'','ten');
		switch(Url::get('do')){
			case 'auto_play':
				FMGAME::auto_play();
				exit();
				break;
			case 'update_winner':
				FMGAME::update_winner();
				exit();
				break;
			default:
				if(User::is_login()){
					if(!Url::iget('vong_dau_id') and FMGAME::get_team_server_id()){
						$_REQUEST['vong_dau_id'] = FMGAME::get_id_vong_dau_hien_tai(FMGAME::get_team_server_id());
					}
					$vong_dau_id = Url::iget('vong_dau_id');
					require_once 'forms/list.php';
					$this->add_form(new FmgChampionsForm());
				}
			break;
		}
		//Portal::$document_title = 'Lịch thi đấu Ngoại hạng Anh, lich thi dau ngoai hang anh, mua bong 2015/2016 '.$this->map['vong_dau'].'';
		//Portal::$meta_keywords = 'Lịch thi đấu, ngoại Hạng, ngoại hạng anh, lich thi dau, ngoai hang anh';
		//Portal::$meta_description = 'Lịch thi đấu ngoại hạng anh , lich thi dau ngoai hang anh 2015-2016 , theo dõi lịch thi đấu ngoại hạng anh cập nhật từng ngày để không bỏ lỡ những trận cầu nảy lửa';
	}
}
?>