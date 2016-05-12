<?php 
class AgentAdmin extends Module
{
	function AgentAdmin($row)
	{
		if(User::can_admin(MODULE_AGENTADMIN,ANY_CATEGORY))
		{
			require_once 'db.php';
			Module::Module($row);
			switch(URL::get('cmd'))
			{
				case 'edit':
					require_once 'forms/edit.php';
					$this->add_form(new EditAgentAdminForm());
					break;
				case 'active':
					$this->active();
					exit();
				default: 
					require_once 'forms/list.php';
					$this->add_form(new ListAgentAdminForm());
					break;
			}		
		}
		else
		{
			URL::access_denied();
		}
	}
	function active()
	{
		if(Url::get('account_id') and $row = AgentAdminDB::get_agent(addslashes(Url::get('account_id'))))
		{
			if(!$row['is_active'])
			{
				if(DB::update('account',array('is_active'=>1),'id="'.addslashes(Url::get('account_id')).'"'))
				{
					AgentAdminDB::grant_privilege(addslashes(Url::get('account_id')));
					$mail_content = @file_get_contents('cache/email_template/active_agent.html');
					$mail_content = str_replace('[[|full_name|]]',$row['full_name'],$mail_content);
					System::send_mail('info@modern.net',$row['email'],'Checkinvietnam.com - Active your account',$mail_content);
					
					$contract_email_title = 'Checkinvietnam.com - Contract at modern.net';
					$contract_email_content = file_get_contents('cache/email_template/tour_contract.html');
					$link_download = '';
					$contract_array_data = array('[[|company_name|]]','[[|link_download|]]');
					$contract_array_replace = array($row['full_name'],$link_download);
					$contract_email_content = str_replace($contract_array_data,$contract_array_replace,$contract_email_content);
					System::send_mail('info@modern.net',$row['email'],$contract_email_title,$contract_email_content);
					
				}
			}
			else
			{
				if(DB::update('account',array('is_active'=>0),'id="'.addslashes(Url::get('account_id')).'"'))
				{				
					$mail_content = @file_get_contents('cache/email_template/active_agent.html');
					$mail_content = str_replace('[[|full_name|]]',$row['full_name'],$mail_content);
					System::send_mail('info@modern.net',$row['email'],'Checkinvietnam.com - Disactive your account',$mail_content);
				}			
			}
			Url::redirect_current();
		}
	}
}
?>
