<?php
class AvailableTeamForm extends Form{
	function AvailableTeamForm(){
		Form::Form('AvailableTeamForm');
	}

	function get_condition()
	{
		
		$cond = '';
		if(Url::get('keyword'))
		{
			$cond .= URL::get('keyword')? ' AND (((party.full_name) LIKE "%'.addslashes(URL::sget('keyword')).'%")OR ((fmg_clb.name) LIKE "%'.addslashes(URL::sget('keyword')).'%"))':'';
			// $cond .= URL::get('keyword')? ' OR ((fmg_clb.name) LIKE "%'.addslashes(URL::sget('keyword')).'%")':'';
		}
		return $cond;
	}


	function draw(){
		$cond='1=1';
		$cond.=$this->get_condition();
		$this->map = array();
		require_once 'packages/core/includes/utils/paging.php';
		$item_per_page = 20;
		//$bxh_hlv = FmgBxhHlvDB::bxh_hlv($item_per_page,$cond);
		// System::debug($bxh_hlv);
		$this->map['bxh_hlv'] = FmgBxhHlvDB::bxh_hlv($item_per_page,$cond);
		// $hlv_number = DB::fetch_all('select id from fmg_clb where "'.$cond.'"');
		$hlv_number = FmgBxhHlvDB::get_all_hlv($cond);
		$this->map['paging'] = paging(sizeof($hlv_number),$item_per_page,10,false,'page_no',array('keyword'));
		// echo Url::build_current(array('do'=>'thach_dau','dcn_id'=>FMGAME::my_team_id(),'dkh_id'=>[[=clbs.id=]]))
		$this->parse_layout('available_team',$this->map);
	}
}
?>
