<?php
class ManageAgentAddForm extends Form
{
	function ManageAgentAddForm()
	{
		Form::Form('ManageAgentAddForm');
		if(URL::get('cmd')=='edit')
		{
			$this->add('account',new IDType(true,'object_not_exists','account'));
		}
		else
		{
			$this->add('account',new UniqueType('Duplicate identifier (T&#234;n t&#224;i kho&#7843;n &#273;&#227; &#273;&#432;&#7907;c s&#7917; d&#7909;ng)','account','id'));
			$this->add('password',new TextType(false,'invalid_password',0,255));
		}
		$this->add('name',new TextType(false,'invalid_full_name',0,255)); 
		$this->add('address',new TextType(false,'invalid_address',0,255)); 
		$this->add('phone',new TextType(false,'invalid_phone_number',0,255)); 
		$this->add('city',new IDType(true,'invalid_zone_id','zone'));
		$this->link_css('skins/default/css/cms.css');
	}
	function on_submit()
	{
		if(URL::get('cmd')=='edit')
		{
			$row = DB::select('account','id="'.$_REQUEST['account'].'"');
		}		
		if($this->check())
		{
			if(isset($_FILES['logo']))
			{
				require_once 'packages/core/includes/utils/upload_file.php';
				update_upload_file('logo',str_replace('#','',PORTAL_ID).'/images');
			}
			$active = Url::get('active')?1:0;
			$account_new_row = array(
				'type'=>"USER",
				'is_agent'=>1,
				'cache_privilege'=>'',
				'is_active'=>$active,
			)+(URL::get('password')?array('password'=>User::encode_password($_REQUEST['password'])):array());
			
			$party_new_row = array(
					'portal_id'=>PORTAL_ID,
					'name_1'=>Url::get('name'),
					'email',
					'fax',
					'phone',
					'address',
					'website',
					'image_url'=>Url::get('logo'),
					'type'=>"USER",
					'zone_id'=>Url::get('city'),
					'description_1'=>Url::get('description')
				);
			if(URL::get('cmd')=='edit')
			{
				$id = $_REQUEST['account'];
				DB::update('party', $party_new_row,'user_id="'.$id.'"');
				DB::update('account', $account_new_row,'id="'.$id.'" and is_agent');
			}
			else
			{
				require_once 'packages/core/includes/system/si_database.php';
				$id = DB::insert('party', $party_new_row+array('user_id'=>URL::get('account')));
				DB::insert('account', $account_new_row+array('id'=>URL::get('account')));
			}
			Url::redirect_current(array('just_edited_id'=>$id));
		}
	}
	function draw()
	{
		require_once Portal::template_js('core').'/tinymce/init_tinyMCE.php';
		//Structure_id VietNam
		$sql = 'select id,name_1 as name from zone where '.IDStructure::direct_child_cond(1010000000000000000).' order by structure_id';
		$this->map['city_list'] = String::get_list(DB::fetch_all($sql));
		if(($id = Url::get('id')) and ($agent = ManageAgentDB::get_agent('is_agent and party.user_id="'.$id.'"')))
		{
			foreach($agent as $k=>$v)
			{
				$_REQUEST[$k]=$v;
			}
			$this->map['logo'] = $agent['logo'];
		}
		$this->parse_layout('edit',$this->map);
	}
}
?>