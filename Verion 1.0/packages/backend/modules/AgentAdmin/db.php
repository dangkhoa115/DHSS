<?php
class AgentAdminDB{
	function get_agent($account_id)
	{
		return DB::fetch('
			SELECT
				account.id,account.is_active,
				party.full_name,party.email
			FROM
				account
				inner join party on party.user_id = account.id and account.type="USER"
			WHERE
				account.id="'.$account_id.'" and party.type="AGENT"
		');
	}
	function grant_privilege($account_id)
	{
		if(!DB::fetch('select id from account_privilege where account_id="'.$account_id.'" and privilege_id = 24'))
		{
			DB::insert('account_privilege',array('account_id'=>$account_id,'privilege_id'=>24,'portal_id'=>PORTAL_ID,'category_id'=>191));
			DB::update('account',array('cache_privilege'=>''),'id="'.$account_id.'"');
		}
	}
}
?>