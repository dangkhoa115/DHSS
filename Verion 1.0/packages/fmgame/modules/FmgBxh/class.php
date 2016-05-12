<?php
class FmgBxh extends Module{
	static $item = false;
	function FmgBxh($row){
		Module::Module($row);
		require_once 'packages/backend/includes/php/ssnh.php';
		require_once 'packages/backend/includes/php/igold.php';
		require_once 'packages/backend/includes/php/message.php';
		require_once 'packages/fmgame/includes/php/fmgame_local.php';
		require_once 'db.php';
		if(User::is_login()){
			if(FMGAME::get_team_server_id(MUA_GIAI_ID) and !isset($_REQUEST['server_id'])){
				$_REQUEST['server_id'] = FMGAME::get_team_server_id(MUA_GIAI_ID);
			}
			require_once 'forms/list.php';
			$this->add_form(new FmgBxhForm());
		}else{
			header('location:dhss-dang-nhap.html?href=dhss');
			exit();
		}
		Portal::$document_title = 'Bảng xếp hạng Đội hình siêu sao';
		//Portal::$meta_keywords = 'Lịch thi đấu, ngoại Hạng, ngoại hạng anh, lich thi dau, ngoai hang anh';
		//Portal::$meta_description = 'Lịch thi đấu ngoại hạng anh , lich thi dau ngoai hang anh 2015-2016 , theo dõi lịch thi đấu ngoại hạng anh cập nhật từng ngày để không bỏ lỡ những trận cầu nảy lửa';
	}
}
?>