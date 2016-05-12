<?php
define('CURRENT_CATEGORY',1);
define('ANY_CATEGORY',2);
class User{
	var $groups = array();
	var $privilege = array();
	var $actions = array();
	var $settings = array();
	static $current=false;
	function User($id=false){
		//require 'packages/core/includes/utils/facebook/facebook.php';
		//$facebook = new Facebook(array(
		//	'appId'  => '354449474651325',
		//	'secret' => 'd06458e198433910dc30de98c3bac535',
		//));
		//$user = $facebook->getUser();		
		if(!$id){
			if(!Session::is_set('user_id')){
				Session::set('user_id','guest');
			}
			if($this->data=DB::select_id('account',Session::get('user_id'))){
				if($this->data['cache_privilege']==''){
					require_once 'packages/core/includes/system/make_user_privilege_cache.php';
					eval(make_user_privilege_cache(Session::get('user_id')));
				}else{
					eval($this->data['cache_privilege']);
				}
				if(!$this->data['cache_setting']){
					require_once 'packages/core/includes/system/make_account_setting_cache.php';
					$code = make_account_setting_cache(Session::get('user_id'));
					eval('$this->settings='.$code);
				}else{
					eval('$this->settings='.$this->data['cache_setting']);
				}
			}/*else{
				if($user){
					if(Session::is_set($row) == false){
						$user_profile = $facebook->api('/me');
						$row = array
						(
								'id' => "admin",
								'password' => "acb82d39a27c17b1fcc393d331e8d681",
								'type' => "USER",
								'is_active' => "1",
								'is_block' => "0",
								'create_date' => "2011-11-18",
								'cache_privilege' => "",
								'cache_setting' => "",
								'last_online_time' => "1352444200",
								'is_agent' => "0",
								'is_hotel' => "0",
								'party_type' => "USER",
								'email' => "dangkhoa115@gmail.com",
								'full_name' => "Nguyễn Đăng Khoa"
						);
						Session::set('user_data',$row);
					}
				}
			}*/
		}
	}
	static function id(){
		if(Session::is_set('user_id')){
			return Session::get('user_id');
		}
		return 'guest';
	}
	static function is_login(){
		return Session::is_set('user_id') and Session::get('user_id')!='guest' and DB::exists_id('account',Session::get('user_id'));
	}
	
	static function is_online($id){
		$row=DB::select('account', 'id="'.$id.'" and last_online_time>'.(time()-600));
		if ($row){
			return true;
		}
		return false;
	}
	static function encode_password($password){
		return md5($password.'catbeloved');
	}
	static function is_in_group($user_id,$group_id){
		$row=DB::select('user_group',' user_id="'.$user_id.'" and group_id="'.$group_id.'"');
		if ($row or User::is_admin()){
			return true;
		}else{
			return false;
		}
	}
	static function groups(){	
		return $this->groups;
	}
	static function home_page(){
		if(User::$current and User::$current->groups){
			$group = reset(User::$current->groups);
			if($group['home_page']==''){
				$group['home_page'] = URL::build('home');
			}
			return $group['home_page'];
		}
		return URL::build('home');
	}
	
	function is_admin_user(){
		return isset($this->groups[3]);
	}
	static function is_admin(){
		if(isset(User::$current)){
			return User::$current->is_admin_user();
		}
	}
	static function can_do_action($action,$pos,$module_id=false, $structure_id = 0, $portal_id = false){
		if(!$portal_id){
			$portal_id = PORTAL_ID;
		}
		if(User::is_admin()){
			return true;
		}
		if(!$module_id){
			if(isset(Module::$current->data)){
				$module_id = Module::$current->data['module']['id'];
				//$is_service = Module::$current->data['module']['type']=='SERVICE';
			}else{
				$module_id=false;
			}
		}
		if(!$module_id){
			return;
		}
		if($structure_id){
			if($structure_id==CURRENT_CATEGORY){
				$structure_id=0;
				if(URL::sget('category_id')){
					$structure_id=DB::structure_id('static function',URL::sget('category_id'));
				}
				if(!$structure_id){
					$structure_id = ID_ROOT;
				}
			}			
			if(isset(User::$current->actions[$portal_id][$module_id][0])){
				return User::$current->actions[$portal_id][$module_id][0]&(1 << (7-$pos));
			}
			if($structure_id==ANY_CATEGORY){
				if(isset(User::$current->actions[$portal_id]) and isset(User::$current->actions[$portal_id][$module_id])){
					foreach(User::$current->actions[$portal_id][$module_id] as $category_privilege){	
						if($category_privilege&(1 << (7-$pos))){
							return true;
						}
					}
				}
				return false;
			}else{
				while(1){				
					if(isset(User::$current->actions[$portal_id][$module_id][$structure_id])){
						return User::$current->actions[$portal_id][$module_id][$structure_id]&(1 << (7-$pos));
					}
					else
					if($structure_id <= ID_ROOT){
						break;
					}else{
						$structure_id = IDStructure::parent($structure_id);
					}
				}
			}
			return false;
		}else{
			return isset(User::$current->actions[$portal_id][$module_id][0]) and (User::$current->actions[$portal_id][$module_id][0]&(1 << (7-$pos)));
		}
	}
	static function can_view($module_id=false, $structure_id = 0, $portal_id = false){
		return USER::can_do_action('view',0,$module_id, $structure_id);
	}
	static function can_view_detail($module_id=false, $structure_id = 0, $portal_id = false){
		return USER::can_do_action('view_detail',1,$module_id, $structure_id);
	}
	static function can_add($module_id=false, $structure_id = 0, $portal_id = false){
		return USER::can_do_action('add',2,$module_id, $structure_id);
	}
	static function can_edit($module_id=false, $structure_id = 0, $portal_id = false){
		return USER::can_do_action('edit',3,$module_id, $structure_id);
	}
	static function can_delete($module_id=false, $structure_id = 0, $portal_id = false){
		return USER::can_do_action('delete',4,$module_id, $structure_id);
	}	
	static function can_moderator($module_id=false, $structure_id = 0, $portal_id = false){
		return USER::can_do_action('moderator',5,$module_id, $structure_id);
	}
	static function can_reserve($module_id=false, $structure_id = 0, $portal_id = false){
		return USER::can_do_action('reserve',6,$module_id, $structure_id);
	}
	static function can_admin($module_id=false, $structure_id = 0, $portal_id = false){
		return USER::can_do_action('admin',7,$module_id, $structure_id);
	}
	static function check_categories($categories,$module=false){
		foreach($categories as $key=>$value){
			if(isset($value['structure_id']) and !User::can_view($module,$value['structure_id'])){
				unset($categories[$key]);
			}
		}
		return $categories;
	}	
	static function get_setting($name,$default=''){
		return Portal::get_setting($name,$default, User::id());
	}
	static function set_setting($name, $value,$user_id=false){
		if(!$user_id){
			$user_id = Session::get('user_id');
		}
		Portal::set_setting($name, $value,$user_id);
	}
}
User::$current = new User();
if(!Session::is_set('user_id') and isset($_COOKIE['user_id'])and $_COOKIE['user_id']){
	setcookie('user_id',"",time()-3600);
}
?>