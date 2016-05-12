<?php
class FmgChampionsForm extends Form
{
	function FmgChampionsForm()
	{
		Form::Form('FmgChampionsForm');
	}
	function draw()
	{
		$mua_giai_id = MUA_GIAI_ID;
		$this->map = array();
		$sql = '
			SELECT
				fmg_clb_server.id,fmg_clb.logo,fmg_clb.name,fmg_clb_server.power,fmg_clb_server.diem,fmg_clb_server.win,fmg_server.name as server
				,fmg_clb.id as clb_id
				
			FROM
				fmg_clb_server
				INNER JOIN fmg_clb ON fmg_clb.id = fmg_clb_server.clb_id
				INNER JOIN fmg_server ON fmg_server.id = fmg_clb_server.server_id
			WHERE
				fmg_clb_server.win = 1
			ORDER BY
				fmg_clb_server.server_id desc
		';
		$this->map['clbs'] =  DB::fetch_all($sql);
		$this->parse_layout('list',$this->map);
	}
}
?>
