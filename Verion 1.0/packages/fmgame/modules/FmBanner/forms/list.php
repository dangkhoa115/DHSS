<?php
class FmBannerForm extends Form
{
	function FmBannerForm()
	{
		Form::Form('FmBannerForm');
		$this->link_js('skins/ssnh/scripts/jquery.js');
		$this->link_js('skins/ssnh/scripts/bootstrap.min.js');
		//$this->link_js('skins/ssnh/scripts/jquery.prettyPhoto.js');
		$this->link_js('skins/ssnh/scripts/jquery.isotope.min.js');
		$this->link_js('skins/ssnh/scripts/wow.min.js');
		$this->link_js('skins/ssnh/scripts/countdown/countdown.js');
        
		$this->link_css('skins/ssnh/styles/bootstrap.min.css');
		$this->link_css('skins/ssnh/styles/font-awesome.min.css');
		$this->link_css('skins/ssnh/styles/animate.min.css');
		//$this->link_css('skins/ssnh/styles/prettyPhoto.css');
		//$this->link_css('skins/ssnh/styles/responsive.css');
		$this->link_css('skins/ssnh/styles/fmgame.css');
		$this->link_css('skins/ssnh/styles/hover.css');
		$this->link_css('http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');
	}	
	function on_submit(){
		header('location:http://'.$_SERVER['SERVER_NAME'].'/search.html?q='.str_replace(' ','+',Url::get('keyword')));
	}
	function draw()
	{
		$this->map = array();
		$this->map['full_name'] = '';
		$this->map['tpl'] = Portal::tpl('ssnh');
		$this->map['new_message'] = '';
		$this->map['number_message'] = Message::count_unread_message();
		if(User::is_login() and $user=DB::fetch('select account.id,party.full_name from party inner join account where party.user_id="'.Session::get('user_id').'"')){
			$this->map['full_name'] = $user['full_name'];
		}
		require_once 'cache/tables/categories.cache.php';
		$this->map['item_ul_categories'] = $categogies;
		$this->map['da_dang_ky_giai_phu'] = false;
		if(FMGAME::my_team_id()){
			$sql = '
				select 
					csvp.id 
				from
					fmg_clb_server_phu as csvp
					inner join fmg_server_phu as sp ON sp.id = csvp.server_id 
				where 
					csvp.clb_id='.FMGAME::my_team_id().'
					and sp.status="OPEN"
			';
			if(DB::exists($sql)){
				$this->map['da_dang_ky_giai_phu'] = true;
			}
		}
		$this->parse_layout('list',$this->map);
	}
}
?>