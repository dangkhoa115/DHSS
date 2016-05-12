<?php
class EditAgentAdminForm extends Form
{
	function EditAgentAdminForm()
	{
		Form::Form('EditAgentAdminForm');
		if(URL::get('cmd')=='edit')
		{
			$this->add('id',new IDType(true,'object_not_exists','account'));
		}
		else
		{
			$this->add('id',new UniqueType('Duplicate identifier (T&#234;n t&#224;i kho&#7843;n &#273;&#227; &#273;&#432;&#7907;c s&#7917; d&#7909;ng)','account','id'));
		}
		$this->add('password',new TextType(false,'invalid_password',0,255)); 
		$this->add('email',new EmailType(true,'invalid_email')); 
		$this->add('full_name',new TextType(true,'invalid_full_name',0,255)); 
		$this->add('address',new TextType(true,'invalid_address',0,255)); 
		$this->add('join_date',new DateType(false,'invalid_join_date')); 
		$this->add('phone',new TextType(false,'invalid_phone_number',0,255)); 
		$this->add('zone_id',new IDType(true,'invalid_zone_id','zone')); 
		$this->link_css('skins/default/css/cms.css');
	}
	function on_submit()
	{
		require_once 'packages/core/includes/utils/upload_file.php';
		if(URL::get('cmd')=='edit')
		{
			$row = DB::select('account',$_REQUEST['id']);
		}
		if($this->check() and URL::get('confirm_edit'))
		{	
			$image_url = update_upload_file('image_url','agent','IMAGE');	
			$account_new_row = array(
				'create_date'=>Date_Time::to_sql_date((URL::get('join_date'))),
				'is_active'=>URL::get('active'), 
				'is_block'=>URL::get('block'),
				'type'=>'USER',
				'cache_privilege'=>'',
			)+(URL::get('password')?array('password'=>User::encode_password($_REQUEST['password'])):array());
			$party_new_row = 
				array(
					'zone_id', 
					'email',
					'birth_date'=>Date_Time::to_sql_date((URL::get('birth_date'))), 
					'address', 
					'gender', 
					'telephone'=>URL::get('telephone'),
					'type'=>'AGENT',
					'zipcode',
					'status'=>'SHOW',
					'image_url'=>$image_url,
					'full_name',
					'first_name',
					'last_name',
					'gender',
					'identity_card',
					'position',
					'department',
					'phone'
				);
			if(URL::get('cmd')=='edit')
			{
				$id = $_REQUEST['id'];
				DB::update('party', $party_new_row,'user_id="'.$id.'" and type="AGENT"');
				DB::update('account', $account_new_row,'id="'.$id.'"');
			}
			else
			{
				require_once 'packages/core/includes/system/si_database.php';
				$id = DB::insert('party', $party_new_row+array('user_id'=>URL::get('id')));
				DB::insert('account', $account_new_row+array('id'=>URL::get('id')));
			}
			if(Url::get('active') and DB::select('account','id="'.$id.'" and is_active=0'))
			{
			
				AgentAdminDB::grant_privilege($id);
				$mail_content = @file_get_contents('cache/email_template/active_agent.html');
				$mail_content = str_replace('[[|full_name|]]',Url::get('full_name'),$mail_content);
				System::send_mail('info@modern.net',Url::get('email'),'Checkinvietnam.com - Active your account',$mail_content);
				//-----------------------------------------------
				$contract_email_title = 'Checkinvietnam.com - Contract at modern.net';
				$contract_email_content = file_get_contents('cache/email_template/tour_contract.html');
				$link_download = '';
				$contract_array_data = array('[[|company_name|]]','[[|link_download|]]');
				$contract_array_replace = array($row['full_name'],$link_download);
				$contract_email_content = str_replace($contract_array_data,$contract_array_replace,$contract_email_content);
				System::send_mail('info@modern.net',$row['email'],$contract_email_title,$contract_email_content);				
			}
			Url::redirect_current(array('join_date_start','join_date_end',  'active'=>isset($_GET['active'])?$_GET['active']:'', 'block'=>isset($_GET['block'])?$_GET['block']:'',  'user_id'=>isset($_GET['user_id'])?$_GET['user_id']:'')+array('just_edited_id'=>$id));
		}
	}	
	function draw()
	{	
		if(URL::get('cmd')=='edit' and $row=DB::select('party','user_id="'.URL::sget('id').'"') and $account = DB::select('account',URL::sget('id')))
		{
			$row['id'] = $account['id'];
			$row['join_date'] = $account['create_date'];
			$row['active'] = $account['is_active'];
			$row['block'] = $account['is_block'];
			if($row['birth_date']<>'0000-00-00')
			{
				$row['birth_date'] = Date_Time::to_common_date($row['birth_date']);
			}
			else
			{
				$row['birth_date'] = '';
			}  
			if($row['join_date']<>'0000-00-00')
			{
				$row['join_date'] = Date_Time::to_common_date($row['join_date']);
			}
			else
			{
				$row['join_date'] = '';
			}      
			unset($row['password']);
			foreach($row as $key=>$value)
			{
				if(is_string($value) and !isset($_POST[$key]))
				{
					$_REQUEST[$key] = $value;
				}
			}
			$edit_mode = true;
		}
		else
		{
			$edit_mode = false;
		}
		require_once 'cache/tables/zones.cache.php';
		$this->parse_layout('edit',
			($edit_mode?$row:array())+
			array(
				'zone_id_list'=>String::get_list($zones),
				'gender_list'=>array('1'=>Portal::language('male'),'0'=>Portal::language('female'))
			)
		);
	}
}
?>
